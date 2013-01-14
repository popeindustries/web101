require('pi/utils/polyfill')
# Make sure we include Ready source for use from html
require('pi/dom/ready')
element = require('pi/dom/element')
Model = require('models/model')
Controller = require('controllers/controller')
MainView = require('views/mainview')
win = window
doc = window.document

exports.init = (config) ->
	require('pi/utils/log').init(config.log)
	model = new Model
	controller = new Controller(model)
	mainView = new MainView(model, controller, element('body')[0])

	hljs.initHighlightingOnLoad()
