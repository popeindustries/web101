objectUtils = require('pi/utils/objectutils')
win = window
doc = win.document

RE_UNITS = /(px|%|em|ms|s)$/
RE_IE_OPACITY = /opacity=(\d+)/i
RE_RGB = /rgb\((\d+),\s?(\d+),\s?(\d+)\)/
VENDOR_PREFIXES = ['-webkit-', '-moz-', '-ms-', '-o-']

# Hash of prefixed versions of properties
# (values to be replaced by platform specific property)
prefixed =
	'border-bottom-left-radius': false
	'border-bottom-right-radius': false
	'border-top-left-radius': false
	'border-top-right-radius': false
	'box-shadow': false
	'transform': false
	'transform-origin': false
	'transform-style': false
	'transition-delay': false
	'transition-duration': false
	'transition-property': false
	'transition-timing-function': false
	'perspective': false
	'perspective-origin': false

# Hash of default unit values
numeric =
	'top': 'px'
	'bottom': 'px'
	'left': 'px'
	'right': 'px'
	'width': 'px'
	'height': 'px'
	'margin-top': 'px'
	'margin-bottom': 'px'
	'margin-left': 'px'
	'margin-right': 'px'
	'padding-top': 'px'
	'padding-bottom': 'px'
	'padding-left': 'px'
	'padding-right': 'px'
	'border-bottom-left-radius': 'px'
	'border-bottom-right-radius': 'px'
	'border-top-left-radius': 'px'
	'border-top-right-radius': 'px'
	'transition-duration': 'ms'
	'opacity': ''
	'font-size': 'px'

colour =
	'background-color': 'color'
	'color': 'color'
	'border-color': 'color'

# Hash of shorthand properties
shorthand =
	'border-radius': [
		'border-bottom-left-radius',
		'border-bottom-right-radius',
		'border-top-left-radius',
		'border-top-right-radius'
	]
	'border-color': [
		'border-bottom-color',
		'border-left-color',
		'border-top-color',
		'border-right-color'
	]
	'margin': [
		'margin-top',
		'margin-right',
		'margin-left',
		'margin-bottom'
	]
	'padding': [
		'padding-top',
		'padding-right',
		'padding-left',
		'padding-bottom'
	]

# Retrieve current computed style
current = (element, property) ->
	if win.getComputedStyle
		if property then win.getComputedStyle(element).getPropertyValue(property) else win.getComputedStyle(element)
	else
		if property then element.currentStyle[property] else element.currentStyle

# Store all possible styles this platform supports
defaultStyles = {}
s = current(doc.documentElement)
if s.length
	defaultStyles[prop] = true for prop in s
else
	defaultStyles[prop] = true for prop of s

# Store opacity property name
opacity = if not defaultStyles['opacity'] and defaultStyles['filter'] then 'filter' else 'opacity'

camelCase = (str) ->
	# TODO: check that IE doesn't capitalize -ms prefix
	str.replace(/-([a-z])/g, ($0, $1) -> $1.toUpperCase()).replace('-','')

# Get the prefixed version of the property
exports.getPrefixed =
getPrefixed = (property) ->
	# If property is prefixed, set if necessary and retrieve
	if prefixed.hasOwnProperty(property)
		setPrefixed(property) unless prefixed[property]
		property = prefixed[property]
	property

# Store the prefixed version of the property
setPrefixed = (property) ->
	# Check if we have unprefixed prop
	prefixed[property] = property if defaultStyles[property]
	# Try prefixed version
	for vendor in VENDOR_PREFIXES when not prefixed[property]
		prefixed[property] = vendor + property if defaultStyles[vendor + property]

# Get a proxy property to use for shorthand properties
getShorthand = (property) ->
	shorthand[property]?[0] or property

# Expand shorthand properties
expandShorthand = (property, value) ->
	if shorthand[property]?
		props = {}
		(props[p] = value) for p in shorthand[property]
		return props
	property

parseOpacity = (element) ->
	value = current(element, opacity)
	if value is ''
		null
	else if opacity is 'filter'
		match = value.match(RE_IE_OPACITY)
		parseInt(match[1])/100 if match?
	else
		parseFloat(value)

getOpacityValue = (value) ->
	val = parseFloat(value)
	if opacity is 'filter'
		val = "alpha(opacity=#{val*100})"
	val

# Css Transition support test
exports.csstransitions = getPrefixed('transition-duration') isnt false

# Split a value into a number and unit
exports.parseNumber =
parseNumber = (value, property) ->
	if colour[property]
		unless value?.charAt(0) is '#'
			channels = RE_RGB.exec(value)
			if channels
				["#" + ((1 << 24) | (channels[1] << 16) | (channels[2] << 8) | channels[3]).toString(16).slice(1), 'hex']
			else
				['#ffffff', 'hex']
		else
			[value or '#ffffff', 'hex']
	else
		num = parseFloat(value)
		if objectUtils.isNaN(num)
			[value, '']
		else
			unit = RE_UNITS.exec(value)?[1]
			# Set default
			unit ?= if numeric[property]? then numeric[property] else 'px'
			[num, unit]

exports.getStyle =
getStyle = (element, property) ->
	return parseOpacity(element) if property is 'opacity'
	# Retrieve longhand and prefixed version
	property = getPrefixed(getShorthand(property))
	value = current(element, property)
	value ?= current(element, camelCase(property))
	switch value
		when '' then null
		when 'auto' then 0
		else value

exports.getNumericStyle =
getNumericStyle = (element, property) ->
	parseNumber(getStyle(element, property), property)

exports.setStyle =
setStyle = (element, property, value) ->
	# Expand shorthands
	property = expandShorthand(property, value)
	if objectUtils.isObject(property)
		setStyle(element, prop, val) for prop, val of property
		return
	# Fix opacity
	if property is 'opacity'
		property = opacity
		value = getOpacityValue(value)
	# Look up prefixed property
	property = getPrefixed(property)
	# Look up default numeric unit if none provided
	if value isnt 'auto' and value isnt 'inherit' and numeric[property] and not RE_UNITS.test(value)
		value += numeric[property]
	element.style[camelCase(property)] = value

# TODO: more tests on IE8
exports.clearStyle =
clearStyle = (element, property) ->
	# Expand shorthand
	isShorthand = shorthand[property]?
	shortProp = property
	property = shorthand[property] or property
	# Loop through collection
	if objectUtils.isArray(property)
		clearStyle(element, prop) for prop in property
		# MS uses shorthand syntax when all longhand props have the same value, so remove shorthand too
		if isShorthand then property = shortProp else return
	style = element.getAttribute('style') or ''
	re = new RegExp("\\s?#{getPrefixed(property)}:\\s[^;]+")
	match = re.exec(style)
	element.setAttribute('style', style.replace(match+';', '')) if match?

if win.testing
	exports.getPrefixed = getPrefixed
	exports.setPrefixed = setPrefixed
	exports.getShorthand = getShorthand
	exports.expandShorthand = expandShorthand
