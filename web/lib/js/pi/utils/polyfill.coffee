# indexOf polyfill
unless Array::indexOf
	Array::indexOf = (item) ->
		for prop, i in @
			return i if item is prop
		return -1

# requestAnimationFrame polyfill
lastFrameTime = null
vendors = ['ms', 'moz', 'webkit', 'o']
for vendor in vendors when not window.requestAnimationFrame
	window.requestAnimationFrame = window[vendor+'RequestAnimationFrame']
	window.cancelAnimationFrame = window[vendor+'CancelAnimationFrame'] or window[vendor+'CancelRequestAnimationFrame']
unless window.requestAnimationFrame
	window.requestAnimationFrame = (callback, element) ->
		currFrameTime = +new Date
		lastFrameTime ?= currFrameTime
		interval = Math.max(0, 16 - (currFrameTime - lastFrameTime))
		id = window.setTimeout((-> callback(currFrameTime + interval)), interval)
		lastTime = currFrameTime + interval
		id
unless window.cancelAnimationFrame
	window.cancelAnimationFrame = (id) ->
		clearTimeout(id)
