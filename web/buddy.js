exports.build = {
	js: {
		sources: ['src/coffee', 'lib/js'],
		targets: [
			{
				input: 'src/coffee/main.coffee',
				output: 'www/assets/js/main.js'
			}
		]
	},
	css: {
		sources: ["src/stylus", "lib/stylus"],
		targets: [
			{
				input: "src/stylus/course.styl",
				output: "www/assets/css"
			},
			{
				input: "src/stylus/lesson.styl",
				output: "www/assets/css"
			}
		]
	}
};

exports.dependencies = {
	'lib/vendor': {
		sources: [
			'popeindustries/browser-require'
		],
		output: 'www/assets/js/libs.js'
	},
	'lib/stylus': {
		sources: [
			'visionmedia/nib#lib/nib',
			'popeindustries/normalize.styl#normalize.styl'
		]
	},
	'lib/js': {
		sources: [
			'popeindustries/lib#src/pi'
		]
	}
};