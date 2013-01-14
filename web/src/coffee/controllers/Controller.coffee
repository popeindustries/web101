state = require('models/modelstate')

module.exports = class Controller
	constructor: (@model) ->
		@model.set({'lesson': /lesson(\d)/.exec(document.location.href)[1]})

		@changeMode(state.MODE_REFERENCE)

	changeMode: (value) ->
		mode = value or if @model.get('mode') is state.MODE_REFERENCE then state.MODE_PRESENTATION else state.MODE_REFERENCE
		@model.set({mode})

	nextSlide: ->
		current = @model.get('slide')
		@model.set({slide: current+1}) if current + 1 < @model.get('totalSlides')

	prevSlide: ->
		current = @model.get('slide')
		@model.set({slide: current-1}) if current - 1 >= 0


