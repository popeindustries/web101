{platform, capabilities} = require('./environment')

element = null
win = window
doc = win.document
domListeners = []
id = 0

isValidElement = (element) ->
	!!(element and (element.domElement? or element is win or element.nodeType is 9 or element.nodeType is 1))

# Create handler function
createHandler = (target, type, data, callback) ->
	(event) ->
		callback(new DomEvent(event, target, type, data))

# Remove listener object from cache
removeCachedListener = (target, type, callback) ->
	for item, i in domListeners
		if (item.target.domElement is target.domElement or item.target is target) and item.type is type and item.callback is callback
			return domListeners.splice(i, 1)[0]

getType = (type) ->
	if capabilities.hasTouch()
		switch type
			when 'mousedown' then type = 'touchstart'
			when 'mousemove' then type = 'touchmove'
			when 'mouseup' then type = 'touchend'
	type

# Register for event notification
# param  target     The event target
# param  type       The event name
# param  callback   The function to invoke when the event is triggered
# param  data       Custom data object
exports.on = (target, type, callback, data) ->
	# Late retrieval to prevent circular dependency returning empty object
	element ?= require('./dom/element')
	# DOM event
	if isValidElement(target)
		# Create custom handler
		handler = createHandler(target, type, data, callback)
		handler.id = id++
		# Cache event listener object
		domListeners.push({target, type, handler, callback})
		target = target.domElement if target.domElement
		type = getType(type)
		if target.addEventListener
			target.addEventListener(type, handler, false)
		else if target.attachEvent
			target.attachEvent("on#{type}", handler)
	# Custom event
	else
		target._handlers ?= {}
		target._handlers[type] = [] unless type of target._handlers
		target._handlers[type].push(callback)
	target

# Register for one time event notification
# param  target     The event target
# param  type       The event name
# param  callback   The function to invoke when the event is triggered
# param  data       Custom data object
exports.one = (target, type, callback, data) ->
	exports.on target, type, cb = (event) =>
		callback.call(null, event)
		exports.off(target, type, cb)
	, data
	target

# Unregister for event notification
# param  target     The event target
# param  type       The event name
# param  callback   The function to invoke when the event is triggered
exports.off = (target, type, callback) ->
	# DOM event
	if isValidElement(target)
		# Clear from cache if it exists
		if listener = removeCachedListener(target, type, callback)
			target = target.domElement if target.domElement
			type = getType(type)
			if target.removeEventListener
				target.removeEventListener(type, listener.handler, false)
			else if target.detachEvent
				target.detachEvent("on#{type}", listener.handler)
	# Custom event
	else
		for cb, i in target._handlers[type]
			if callback is cb
				target._handlers[type].splice(i, 1)
				break
	target

exports.offAll = (target) ->
	# DOM event
	if isValidElement(target)
		for listener in domListeners when target is (listener.target.domElement or listener.target)
			exports.off(listener.target, listener.type, listener.callback)
	# Custom event
	else
		target._handlers = null
	target

# Dispatch an event to registered listeners
# param  target     The event target
# param  type       The event name
# param  data       Data object to pass to listeners
exports.trigger = (target, type, data) ->
	# Custom event
	unless isValidElement(target)
		if target._handlers and type of target._handlers
			# copy the callback hash to avoid mutation errors
			list = target._handlers[type].slice()
			evt = new Event(target, type, data)
			# skip loop if only a single listener
			if list.length is 1
				list[0].call(target, evt)
			else
				callback.call(target, evt) for callback in list
			target

# Decorate the passed object with dispatcher behaviour
# param  target    The object to decorate
exports.dispatcher = (target) ->
	# Custom event
	unless isValidElement(target)
		target['on'] = (type, callback) -> exports.on(@, type, callback)
		target['off'] = (type, callback) -> exports.off(@, type, callback)
		target['one'] = (type, callback) -> exports.one(@, type, callback)
		target['trigger'] = (type, data) -> exports.trigger(@, type, data)

class Event
	constructor: (@target, @type, @data) ->

class DomEvent
	constructor: (event, target, @type, @data) ->
		@domEvent = event or win.event
		@currentTarget = target
		@target = @domEvent.target or @domEvent.srcElement or win
		# Text node parent
		@target = @target.parentNode if @target.nodeType is 3
		# Convert to Element if necessary
		@target = element(@target) if not @target.domElement and @target.nodeType is 1

		# Right click
		@rightClick = if @domEvent.which
			@domEvent.which is 3
		else if @domEvent.button
			@domEvent.button is 2
		else
			false
		# Left click
		@leftClick = if @domEvent.which
			@domEvent.which is 1
		else if @domEvent.button
			@domEvent.button is 0 or @domEvent.button is 1
		else
			true

		if @type is 'mousedown' or @type is 'mousemove'
			# Global coordinates
			if @domEvent.touches
				@touches = @domEvent.touches
				if @touches.length
					@pageX = @touches[0].pageX
					@pageY = @touches[0].pageY
			else
				@pageX = if @domEvent.pageX? then @domEvent.pageX else @domEvent.clientX + doc.body.scrollLeft + doc.documentElement.scrollLeft
				@pageY = if @domEvent.pageY? then @domEvent.pageY else @domEvent.clientY + doc.body.scrollTop + doc.documentElement.scrollTop
			# Local coordinates
			if @domEvent.offsetX? and @domEvent.offsetY? and (@domEvent.offsetX isnt 0 and @domEvent.offsetY isnt 0)
				@x = @domEvent.offsetX
				@y = @domEvent.offsetY
			else if @domEvent.x? and @domEvent.y?
				@x = @domEvent.x
				@y = @domEvent.y
			else
				pos = if @target.domElement then @target.position() else {left: @target.offsetLeft, top: @target.offsetTop}
				@x = if @pageX then @pageX - pos.left else 0
				@y = if @pageY then @pageY - pos.top else 0

	preventDefault: ->
		if @domEvent.preventDefault
			@domEvent.preventDefault()
		else
			@domEvent.returnValue = false

	stopPropagation: ->
		if @domEvent.stopPropagation
			@domEvent.stopPropagation()
		else
			@domEvent.cancelBubble = true

	stop: ->
		@preventDefault()
		@stopPropagation()


# Enable :active styles on touch devices
# exports.on(doc, 'touchstart', (->)) if capabilities.hasTouch()

# Clear handlers on window unload to prevent memory leaks (IE)
if win? and win.attachEvent and not win.addEventListener
	win.attachEvent 'onunload', ->
		for listener in domListeners
			try
				exports.off(listener.target, listener.type, listener.callback)
			catch e