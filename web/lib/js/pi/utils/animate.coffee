polyfill = require('./polyfill')
easing = require('./easing')
css = require('../dom/css')
objectUtils = require('./objectutils')
win = window
doc = win.document

FRAME_RATE = 60
DEFAULT_DURATION = 0.5
anims = {}
length = 0
pool = []
uid = 1
tick = 0
last = 0
running = false
csstransitions = css.csstransitions

animate =
module.exports = (target, keep = false) ->
	# reuse from the object pool
	anim = if pool.length then pool.pop() else new Anim
	anim.id = uid++
	anim.target = target
	anim.keep = keep
	anim

add = (anim) ->
	unless anims[anim.id]
		anims[anim.id] = anim
		anim.isRunning = true
		length++
		# start if not running
		unless running
			running = true
			tick = 0
			last = +new Date
			_onTick()

remove = (anim) ->
	anim.isRunning = false
	delete anims[anim.id]
	length--
	# stop if no longer any anims
	running = false unless length

destroy = (anim) ->
	# Check that this is eligible for destruction
	if anim.id
		remove(anim) if anim.isRunning
		anim.id = null
		anim.target = null
		anim.duration = 0
		anim.elapsed = 0
		anim.properties = {}
		anim.easing = easing['outCubic']
		anim.tickCallbacks = []
		anim.completeCallbacks = []
		anim.keep = false
		anim.isRunning = false
		anim.useCssTransitions = false
		anim.transitionStyle = ''
		pool.push(anim)

_onTick = (time) ->
	now = +new Date
	tick = now - last
	last = now
	for id, anim of anims
		anim._render(tick)
	win.requestAnimationFrame(_onTick) if running

class Anim
	constructor: ->
		@id = null
		@target = null
		@duration = 0
		@elapsed = 0
		@properties = {}
		@easing = easing['outCubic']
		@tickCallbacks = []
		@completeCallbacks = []
		@isRunning = false
		@keep = false
		@useCssTransitions = false
		@transitionStyle = ''

	# Animate from existing values to target values
	# properties     an object containing properties and their target values
	# duration       the duration in seconds
	# ease           the easing equation name
	to: (properties, duration = DEFAULT_DURATION, ease) ->
		@duration = duration * 1000
		@elapsed = 0
		@easing = easing[ease] if ease?
		@properties = {}
		@useCssTransitions = false
		for prop, val of properties
			p = {start: 0, current: 0, end: val, type: 0}
			# Property is function
			if objectUtils.isFunction(@target[prop])
				p.start = @target[prop]()
				p.type = 1
			# Property is property
			else if prop of @target
				p.start = @target[prop]
				p.type = 2
			# Property is css
			else
				current = css.getNumericStyle(@target, prop)
				p.start = current[0]
				# Use ending unit if a string is passed
				if objectUtils.isString(val)
					end = css.parseNumber(val, prop)
					p.unit = end[1]
					p.end = end[0]
				# Use the current unit if none specified
				else
					p.unit = current[1]
					p.end = val
				# Use css transitions if available
				if csstransitions
					# First set up transition
					unless @useCssTransitions
						s1 = (@target.getAttribute('style') or '').length
						css.setStyle(@target, {'transition-property': 'all', 'transition-duration': "#{@duration}ms"})
						css.setStyle(@target, 'transition-timing-function', easing.css[ease]) if ease
						# Protect against styles getting translated to shorthand (Chrome)
						@transitionStyle = @target.getAttribute('style')[s1..]
						@useCssTransitions = true
					p.type = 4
					css.setStyle(@target, prop, p.end + p.unit)
				else
					p.type = 3
			@properties[prop] = p
		add(@)
		@

	getProperty: (property) ->
		if @isRunning
			@properties[property]?.current

	setProperty: (property, value) ->
		if @isRunning
			@properties[property]?.end = value

	onTick: (callback, args...) ->
		@tickCallbacks.push({func: callback, args})
		@

	onComplete: (callback, args...) ->
		@completeCallbacks.push({func: callback, args})
		@

	stop: ->
		if @isRunning
			if @keep then remove(@) else destroy(@)

	destroy: ->
		destroy(@)
		null

	_render: (time) =>
		@elapsed += time
		# Make sure total time does not exceed duration
		dur = if @elapsed < @duration then @elapsed else @duration
		for prop, propObj of @properties
			if propObj.type < 4
				b = propObj.start
				c = propObj.end - b
				value = propObj.current = @easing(dur, b, c, @duration)
				switch propObj.type
					when 1
						@target[prop](value)
					when 2
						@target[prop] = value
					when 3
						css.setStyle(@target, prop, "#{value}#{propObj.unit}")

		# Call tick callbacks
		if @tickCallbacks.length
			if @tickCallbacks.length is 1
				@tickCallbacks[0].func.apply(null, @tickCallbacks[0].args)
			else
				callback.func.apply(null, callback.args) for callback in @tickCallbacks

		# On complete...
		if @elapsed >= @duration
			# Remove css transition syntax
			if @useCssTransitions
				@target.setAttribute('style', @target.getAttribute('style').replace(@transitionStyle, ''))
				@useCssTransitions = false
				@transitionStyle = ''
			# Reset
			cbs = @completeCallbacks.slice()
			@tickCallbacks = []
			@completeCallbacks = []
			@properties = {}
			if @keep then remove(@) else destroy(@)
			# Trigger callbacks
			if cbs.length
				# Delay 1 frame to allow for GC and cleanup
				win.requestAnimationFrame ->
					if cbs.length is 1
						cbs[0].func.apply(null, cbs[0].args)
					else
						callback.func.apply(null, callback.args) for callback in cbs
					cbs = null
