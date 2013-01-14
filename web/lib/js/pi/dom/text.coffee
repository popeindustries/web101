textProp = if document.documentElement.textContent? then 'textContent' else 'innerText'

exports.getText = (element) ->
	element[textProp]

exports.setText = (element, text) ->
	element[textProp] = text

