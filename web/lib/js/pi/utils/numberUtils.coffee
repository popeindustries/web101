exports.TWO_PI = (-> Math.PI * 2)()
exports.HALF_PI = (-> Math.PI * 0.5)()

exports.degreesToRadians = (deg) ->
	(deg * Math.PI)/180

exports.radiansToDegrees = (rad) ->
	(180*rad)/Math.PI

# Takes a value within a given range and converts it to a number between 0 and 1.
# value      The value to normalize
# minimum	  The lower limit in the range
# maximum	  The upper limit in the range
# return the value normalized to between 0 and 1
normalize = exports.normalize = (value, min, max) ->
	if min is max then 1 else (value - min) / (max - min)

# Takes a normalized value and a range and returns the actual value in that range.
# normValue     The normalized value
# minimum       The lower limit in the range
# maximum       The upper limit in the range
# return the value interpolated between the given range
interplate = exports.interpolate = (normValue, min, max) ->
	min + (max - min) * normValue

# Takes a value in a given range (min1, max1) and finds the corresonding value in the next range (min2, max2).
# value     The value to map
# min1      The lower limit in the range
# max1      The upper limit in the range
# min2      The lower limit in the new range
# max2      The upper limit in the new range
# return the mapped value between the new range
map = exports.map = (value, min1, max1, min2, max2) ->
	interplate(normalize(value, min1, max1), min2, max2)

# Takes a value and limits it to fall within a given range.
# value     The value to limit
# minimum   The lower limit in the range
# maximum   The upper limit in the range
# return the value limited between the given range
limit = exports.limit = (value, min, max) ->
	Math.min(Math.max(min, value), max)

# Generates a random number between a given range.
# low    The lower limit in the range
# high   The upper limit in the range
# return the random number between the given range
rangedRandom = exports.rangedRandom = (low, high) ->
	map(Math.random(), 0, 1, low, high)