initialized = false
timestamp = true
locations = '^http(|s):\/\/dev|^http(|s):\/\/localhost'

exports.init = (config) ->
	if config?
		timestamp = config.timestamp or timestamp
		locations = config.locations and new RegExp(locations + '|' + config.locations.join('|'), 'i')
		window.debug = !!(document.location.href.match(locations)) or !!(document.location.hash.match(/debug/));
		window.log = if window.debug then exports.log else (->)
	initialized = true

# Log timestamped messages to the console
# Accepts 1..n arguments
exports.log = (args...) ->
	exports.init() unless initialized

	if window.debug
		try
			d = new Date()
			t = if timestamp then "#{d.getHours()}:#{d.getMinutes()}:#{d.getSeconds()}:#{d.getMilliseconds()}" else ''
			console.log(t, args) if window.console
		catch error

