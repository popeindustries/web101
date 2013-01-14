element = require('pi/dom/element')
doc = window.document

module.exports = class LessonMenu

	constructor: (@model, @el, outline) ->
		@elOutline = element(doc.createElement('ul'))
		@elOutline.addClass('outline')
		for item in outline
			@elOutline.domElement.innerHTML += "<li class='outline-level-#{+item.domElement.nodeName[1]-1}'><a href='##{item.getAttribute('id')}'>#{item.getText()}</a></li>"
		@initMenu(parseInt(@model.get('lesson'), 10))

	initMenu: (idx) ->
		elList = @el.find('ul')[0]
		elItems = @el.find('li', elList)
		elActive = element(doc.createElement('li'))
		elLink = element('a', elItems[idx-1])[0]
		# Move child nodes
		while elLink.domElement.firstChild
			elActive.appendChild(elLink.domElement.firstChild)
		elActive.appendChild(@elOutline)
		elActive.appendChild(@elOutline)
		# Set active
		elActive.addClass('active')
		# Replace element
		elList.replaceChild(elActive, elItems[idx-1])