exports.isArray = (obj) ->
	if Array.isArray
		return Array.isArray(obj)
	else
		Object::toString.call(obj) is '[object Array]'

exports.isObject = (obj) ->
	obj is Object(obj)

exports.isString = (obj) ->
	Object::toString.call(obj) is '[object String]'

exports.isNumber = (obj) ->
	Object::toString.call(obj) is '[object Number]'

exports.isFunction = (obj) ->
	Object::toString.call(obj) is '[object Function]'

exports.isNaN = (obj) ->
	obj isnt obj

exports.isElement = (obj) ->
	!!(obj?.nodeType is 1)

exports.isBoolean = (obj) ->
	obj is true or obj is false or Object::toString.call(obj) is '[object Boolean]'

exports.extend = (obj, argObjs...) ->
	for argObj in argObjs
		for prop, value of argObj
			obj[prop] = value
	obj

exports.objectify = (key, value) ->
	o = {}
	o[key] = value
	o