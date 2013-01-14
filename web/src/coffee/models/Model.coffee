dispatcher = require('pi/event').dispatcher

module.exports = class Model
	constructor: ->
		dispatcher(@)
		@_attributes = {}

		dflt =
			mode: null
			lesson: null
			slide: 0
			totalSlides: 0
		@set(dflt, true)

	# Retrieve an attribute value
	# param  attribute    The attribute id
	get: (attribute) ->
		@_attributes[attribute]

	# Store one or more attribute values
	# param  attributes    A hash of attribute values
	# param  silent        Flag for suppressing change notification
	set: (attributes, silent) ->
		return @ unless attributes
		for attribute, value of attributes
			unless @_attributes[attribute] is value
				old = @_attributes[attribute]
				@_attributes[attribute] = value
				@trigger("change:#{attribute}", {value, old}) unless silent
		@

	# Convert attributes to JSON format
	toJSON: ->
		o = {}
		for attr, value of @_attributes
			o[attr] = value
		o