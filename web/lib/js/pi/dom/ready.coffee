win = window
doc = win.document
timer = null
isReady = false
initialized = false
readyCallbacks = []

whenReady = ->
	unless isReady
		isReady = true
		# Execute callbacks
		callback() for callback in readyCallbacks
		readyCallbacks = null
		clearTimeout(timer) if timer
		# Remove listeners
		if doc.addEventListener
			doc.removeEventListener('DOMContentLoaded', whenReady, false)
			win.removeEventListener('load', whenReady, false)
		else
			doc.detachEvent('onreadystatechange', whenReady)
			win.detachEvent('onload', whenReady)

# IE hack
scrollCheck = ->
	return if isReady
	try
		doc.documentElement.doScroll('left')
	catch error
		timer = setTimeout(scrollCheck, 11)
		return
	whenReady()

# Register a function to be called when the DOM is ready
# param  callback   The function to be called when the DOM is finished loading
module.exports = (callback) ->
	readyCallbacks.push(callback)

	# Initialize
	unless initialized
		# Already loaded
		if doc.readyState is 'complete' or doc.readyState is 'loaded'
			whenReady()
		# Init watchers
		else if doc.addEventListener
			doc.addEventListener('DOMContentLoaded', whenReady, false)
			# Just in case previous doesn't fire
			win.addEventListener('load', whenReady, false)
		# IE fallbacks
		else if doc.attachEvent
			doc.attachEvent('onreadystatechange', whenReady)
			win.attachEvent('onload', whenReady)
			scrollCheck() if doc.documentElement.doScroll
		initialized = true