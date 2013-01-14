objectUtils = require('../utils/objectutils')
win = window
doc = win.document

unless doc.getElementsByClassName
	doc.getElementsByClassName = (clazz, tag) ->
		elements = doc.getElementsByTagName(tag or '*')
		return false unless elements.length
		re = new RegExp("(?:^|\\s)#{clazz}(?:\\s|$)")
		matches = (element for element in elements when element.className.match(re))
		return matches

# TODO: add support for live lists?
# TODO: add support for multiple selectors
module.exports = (selector, context, tag) ->
	context = context?.domElement or doc unless objectUtils.isElement(context)
	if context.querySelectorAll?
		elements = context.querySelectorAll(selector)
	else
		switch selector.charAt(0)
			# Id
			when '#' then elements = doc.getElementById(selector.slice(1))
			# Class
			when '.' then elements = doc.getElementsByClassName(selector.slice(1), tag)
			else
				# Tag with class (eg. div.foo)
				if selector.indexOf('.') isnt -1
					sel = selector.split('.')
					elements = doc.getElementsByClassName(sel[1], sel[0])
				# Tag
				else
					elements = context.getElementsByTagName(selector)
	# Return a single element, or an array of elements if more than one (convert NodeList to Array)
	if elements.length?
		return (item for item in elements)
	else
		return null

