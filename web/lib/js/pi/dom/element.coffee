classList = require('./classlist')
select = require('./select')
text = require('./text')
css = require('./css')
event = require('../event')
objectUtils = require('../utils/objectutils')
numberUtils = require('../utils/numberutils')
animate = require('../utils/animate')
win = window
doc = win.document

elements = []
id = 0

elementFactory = (domElement) ->
	for item in elements
		return item if item.domElement is domElement
	el = new Element(domElement)
	elements.push(el)
	el

module.exports = (selector, context = doc, tag) ->
	# Retrieve dom element(s) if passed a selector string
	if objectUtils.isString(selector)
		selector = select(selector, context, tag)
	# Error if not passed dom element or array
	else if not (objectUtils.isElement(selector) or objectUtils.isArray(selector))
		throw 'not a valid element object or selector'

	# Return array of Elements
	if objectUtils.isArray(selector)
		(elementFactory(element) for element in selector when objectUtils.isElement(element))
	# Return a single Element
	else if selector?
		elementFactory(selector)
	else
		null

class Element
	constructor: (@domElement) ->
		@anim = null
		@id = @domElement.id
		@_id = id++
		@tagName = @domElement.tagName

	width: (value) ->
		if value?
			@setStyle('width', value)
			@domElement.width = value if @domElement.width?
			@
		else
			@domElement.offsetWidth

	height: (value) ->
		if value?
			@setStyle('height', value)
			@domElement.height = value if @domElement.height?
			@
		else
			@domElement.offsetHeight

	opacity: (value) ->
		if value?
			@setStyle('opacity', numberUtils.limit(parseFloat(value), 0, 1))
			@
		else
			@getStyle('opacity')

	offset: ->
		top: @domElement.offsetTop
		left: @domElement.offsetLeft

	position: ->
		top = @domElement.offsetTop
		left = @domElement.offsetLeft
		# Loop through all parent offsets
		if (el = @domElement).offsetParent
			while (el = el.offsetParent)
				top += el.offsetTop
				left += el.offsetLeft
		{top, left}

	hasClass: (clas) ->
		classList.hasClass(@domElement, clas)

	matchClass: (clas) ->
		classList.matchClass(@domElement, clas)

	addClass: (clas) ->
		classList.addClass(@domElement, clas)
		@

	removeClass: (clas) ->
		classList.removeClass(@domElement, clas)
		@

	toggleClass: (clas) ->
		classList.toggleClass(@domElement, clas)
		@

	replaceClass: (clasOld, clasNew) ->
		classList.replaceClass(@domElement, clasOld, clasNew)
		@

	addTemporaryClass: (clas, duration) ->
		classList.addTemporaryClass(@domElement, clas, duration)
		@

	getText: -> text.getText(@domElement)

	setText: (value) ->
		text.setText(@domElement, value)
		@

	getHTML: -> @domElement.innerHTML

	setHTML: (value) ->
		@domElement.innerHTML = value
		@

	getStyle: (property) -> css.getStyle(@domElement, property)

	getNumericStyle: (property) -> css.getNumericStyle(@domElement, property)

	setStyle: (property, value) ->
		css.setStyle(@domElement, property, value)
		@

	clearStyle: (property) ->
		css.clearStyle(@domElement, property)
		@

	on: (type, callback, data) ->
		event.on(@, type, callback, data)
		@

	off: (type, callback) ->
		event.off(@, type, callback)
		@

	one: (type, callback, data) ->
		event.one(@, type, callback, data)
		@

	animate: -> @anim ?= animate(@domElement, true)

	getAttribute: (type) -> @domElement.getAttribute(type)

	setAttribute: (type, value) ->
		@domElement.setAttribute(type, value)
		@

	find: (selector) -> module.exports(selector, @)

	parent: (asElement = true) -> if asElement then new Element(@domElement.parentNode) else @domElement.parentNode

	children: (asElement = true) -> ((if asElement then new Element(child) else child) for child in @domElement.childNodes when child?.nodeType is 1)

	firstChild: (asElement = true) -> if asElement then new Element(@domElement.firstChild) else @domElement.firstChild

	lastChild: (asElement = true) -> if asElement then new Element(@domElement.lastChild) else @domElement.lastChild

	appendChild: (element) ->
		@domElement.appendChild(element.domElement or element)

	removeChild: (element) ->
		@domElement.removeChild(element.domElement or element)

	replaceChild: (newElement, oldElement) ->
		@domElement.replaceChild(newElement.domElement or newElement, oldElement.domElement or oldElement)
		oldElement

	remove: ->
		@parent().removeChild(@domElement)

	insertBefore: (element, referenceElement) -> @domElement.insertBefore(element.domElement or element, referenceElement.domElement or referenceElement)

	clone: (deep, asElement = true) -> if asElement then new Element(@domElement.clone(deep)) else @domElement.clone(deep)

	destroy: (remove = false) ->
		event.offAll(@)
		if @anim?
			# Setting keep to false will trigger destroy automatically
			if @anim.isRunning
				@anim.keep = false
			else
				@anim.destroy()
			@anim = null
		# Remove from DOM
		@domElement.parentNode.removeChild(@domElement) if remove
		@domElement = null
		# TODO: remove listeners
		# Remove from cache
		for item, idx in elements
			elements.splice(idx, 1) if item is @
			break