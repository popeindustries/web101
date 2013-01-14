app = window.app
event = require('pi/event')
element = require('pi/dom/element')
dom = require('pi/dom')
state = require('models/modelstate')
LessonMenu = require('./lessonmenu')
doc = window.document

module.exports = class MainView

	constructor: (@model, @controller, @el) ->
		@html = doc.documentElement
		@elLesson = @el.find('article')[0]
		@elProgress = @el.find('#progress')[0]
		@elCountdown = @elProgress.find('p')[0]
		menu = new LessonMenu(@model, @el.find('nav')[0], @el.find('.outline'))
		@btnPresentation = @el.find('#btnPresentation')[0]
		@slides = [dom.select('header', @el)[0]].concat(dom.select('section', @el))
		log @slides
		@examples = @el.find('.example-container')[0]
		@partials = []
		@current = null
		@start = 0
		@last = 0
		@countdown = parseInt(@elCountdown.getText(), 10)

		@model.set({totalSlides: @slides.length})
		@setMode({value: @model.get('mode')})

		event.on(@btnPresentation, 'click', @onModeClick);
		@model.on('change:mode', @onModeChange)
		@model.on('change:slide', @onSlideChange)
		event.on(doc, 'keyup', @onKeyDown)

	setMode: (data) ->
		dom.classList.removeClass(@html, "#{data.old}-mode") if data.old
		dom.classList.addClass(@html, "#{data.value}-mode")
		if data.value is state.MODE_PRESENTATION
			@start = @last = +new Date
			@presentationTick()

	changeSlide: (data) ->
		log data, @slides[data.old]
		@elLesson.addClass('hide')
		setTimeout =>
			dom.classList.removeClass(@slides[data.old], 'current')
			dom.classList.addClass(@slides[data.value], 'current')
			@elLesson.removeClass('hide')
		, 250
		@current = @slides[data.value]
		@partials = []
		p = dom.select('.partial:not(.show)', @current)
		if p?
			@partials = if p.length then p else [p]

	setProgress: (value) ->
		@elProgress.width("#{value}%")

	showPartial: ->
		dom.classList.addClass(@partials.shift(), 'show')

	presentationTick: (time) =>
		now = +new Date
		# log(now - @last)
		if now - @last > 60000
			@elCountdown.setText(--@countdown)
			@last = now
		window.requestAnimationFrame(@presentationTick) if @countdown

	onModeChange: (event) =>
		@setMode(event.data)

	onSlideChange: (event) =>
		@changeSlide(event.data)
		@setProgress(event.data.value / @model.get('totalSlides') * 100)

	onModeClick: (event) =>
		@controller.changeMode()

	onKeyDown: (event) =>
		switch event.domEvent.keyCode
			when 39
				if @partials.length then @showPartial() else @controller.nextSlide()
			when 37 then @controller.prevSlide()
			when 27 then @controller.changeMode()
