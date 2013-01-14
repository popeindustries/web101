RE_TRIM = /^\s+|\s+$/g

exports.hasClass = (element, clas) ->
	if element.classList?
		element.classList.contains(clas)
	else
		classes = element.className.replace(RE_TRIM, '').split(' ')
		clas in classes

exports.matchClass = (element, pattern) ->
	classes = element.className.replace(RE_TRIM, '').split(' ')
	for clas in classes
		if clas.indexOf(pattern) isnt -1
			return clas
	return ''

exports.addClass = (element, clas) ->
	if element.classList?
		element.classList.add(clas)
	else
		element.className += ' ' + clas

exports.removeClass = (element, clas) ->
	if clas
		if element.classList?
			element.classList.remove(clas)
		else
			classes = (c for c in element.className.replace(RE_TRIM, '').split(' ') when c isnt clas)
			element.className = classes.join(' ')

exports.toggleClass = (element, clas) ->
	if exports.hasClass(element, clas) then exports.removeClass(element, clas) else exports.addClass(element, clas)

exports.replaceClass = (element, clasOld, clasNew) ->
	if clasOld
		if clasNew
			element.className = element.className.replace(clasOld, clasNew)
		else
			exports.removeClass(element, clasOld)
	else if clasNew
		exports.addClass(element, clasNew)

exports.addTemporaryClass = (element, clas, duration) ->
	exports.addClass(element, clas)
	setTimeout((=> exports.removeClass(element, clas)), duration)
