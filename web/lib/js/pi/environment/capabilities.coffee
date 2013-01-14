win = window
doc = win.document
nav = navigator

exports.hasVideo = ->
	hasVideo = !!doc.createElement('video').canPlayType
	exports.hasVideo = -> hasVideo
	return hasVideo

exports.hasFlash = ->
	if typeof nav.plugins?['Shockwave Flash'] is 'object'
		desc = nav.plugins['Shockwave Flash'].description
		if desc and not (nav.mimeTypes?['application/x-shockwave-flash'] and not nav.mimeTypes['application/x-shockwave-flash'].enabledPlugin)
			version = parseInt(desc.match(/^.*\s+([^\s]+)\.[^\s]+\s+[^\s]+$/)[1], 10)
	else if win.ActiveXObject?
		try
			testObject = new ActiveXObject('ShockwaveFlash.ShockwaveFlash')
			version = parseInt(testObject.GetVariable('$version').match(/^[^\s]+\s(\d+)/)[1], 10) if testObject
		catch e
	exports.flashVersion = version
	exports.hasFlash = -> exports.flashVersion > 0
	return version > 0

exports.flashVersion = 0

exports.hasNativeFullscreen = ->
	hasNativeFullscreen = typeof doc.createElement('video').webkitEnterFullScreen is 'function'
	exports.hasNativeFullscreen = -> hasNativeFullscreen
	return hasNativeFullscreen

exports.hasCanvas = ->
	elem = doc.createElement('canvas')
	hasCanvas = !!(elem.getContext and elem.getContext('2d'))
	exports.hasCanvas = -> hasCanvas
	return hasCanvas

exports.hasTouch = ->
	hasTouch = 'ontouchstart' of win or (win.DocumentTouch and doc instanceof DocumentTouch)
	exports.hasTouch = -> hasTouch
	return hasTouch
