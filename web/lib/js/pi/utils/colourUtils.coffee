exports.toComponent = (colour) ->
	# Remove hash and spaces
	colour = colour.replace(/[#\s]/g, '')
	if /^rgb/.test(colour)
		re = /^rgb\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3})\)$/
		channels = re.exec(colour)
		r:parseInt(channels[1], 10)
		g:parseInt(channels[2], 10)
		b:parseInt(channels[3], 10)
	else if colour.length is 6
		re = /^(\w{2})(\w{2})(\w{2})$/
		channels = re.exec(colour)
		r:parseInt(channels[1], 16)
		g:parseInt(channels[2], 16)
		b:parseInt(channels[3], 16)
	else if colour.length is 3
		re = /^(\w{1})(\w{1})(\w{1})$/
		channels = re.exec(colour)
		r:parseInt(channels[1]+channels[1], 16)
		g:parseInt(channels[2]+channels[2], 16)
		b:parseInt(channels[3]+channels[3], 16)

exports.rgba = (colour, alpha) ->
	c = exports.toComponent(colour)
	"rgba(#{c.r},#{c.g},#{c.b},#{alpha})"
