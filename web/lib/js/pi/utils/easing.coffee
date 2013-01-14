# t: current time, b: beginning value, c: change in value, d: duration

exports.css = {}

exports.css.linear = 'cubic-bezier(0.250, 0.250, 0.750, 0.750)'
exports.linear = (t, b, c, d) ->
	c*t/d + b

exports.css.inQuad = 'cubic-bezier(0.550, 0.085, 0.680, 0.530)'
exports.inQuad = (t, b, c, d) ->
	c*(t/=d)*t + b

exports.css.outQuad = 'cubic-bezier(0.250, 0.460, 0.450, 0.940)'
exports.outQuad = (t, b, c, d) ->
	-c *(t/=d)*(t-2) + b

exports.inOutQuad = (t, b, c, d) ->
	if ((t/=d/2) < 1)
		return c/2*t*t + b
	-c/2 * ((--t)*(t-2) - 1) + b

exports.css.inCubic = 'cubic-bezier(0.550, 0.055, 0.675, 0.190)'
exports.inCubic = (t, b, c, d) ->
	c*(t/=d)*t*t + b

exports.css.outCubic = 'cubic-bezier(0.215, 0.610, 0.355, 1.000)'
exports.outCubic = (t, b, c, d) ->
	c*((t=t/d-1)*t*t + 1) + b

exports.inOutCubic = (t, b, c, d) ->
	if ((t/=d/2) < 1) 
		return c/2*t*t*t + b
	c/2*((t-=2)*t*t + 2) + b

exports.css.inQuart = 'cubic-bezier(0.895, 0.030, 0.685, 0.220)'
exports.inQuart = (t, b, c, d) ->
	c*(t/=d)*t*t*t + b

exports.css.outQuart = 'cubic-bezier(0.165, 0.840, 0.440, 1.000)'
exports.outQuart = (t, b, c, d) ->
	-c * ((t=t/d-1)*t*t*t - 1) + b

exports.css.inOutQuart = 'cubic-bezier(0.770, 0.000, 0.175, 1.000)'
exports.inOutQuart = (t, b, c, d) ->
	if ((t/=d/2) < 1)
		return c/2*t*t*t*t + b
	-c/2 * ((t-=2)*t*t*t - 2) + b

exports.css.inQuint = 'cubic-bezier(0.755, 0.050, 0.855, 0.060)'
exports.inQuint = (t, b, c, d) ->
	c*(t/=d)*t*t*t*t + b

exports.css.outQuint = 'cubic-bezier(0.230, 1.000, 0.320, 1.000)'
exports.outQuint = (t, b, c, d) ->
	c*((t=t/d-1)*t*t*t*t + 1) + b

exports.css.inOutQuint = 'cubic-bezier(0.860, 0.000, 0.070, 1.000)'
exports.inOutQuint = (t, b, c, d) ->
	if ((t/=d/2) < 1) 
		return c/2*t*t*t*t*t + b
	c/2*((t-=2)*t*t*t*t + 2) + b

exports.css.inSine = 'cubic-bezier(0.470, 0.000, 0.745, 0.715)'
exports.inSine = (t, b, c, d) ->
	-c * Math.cos(t/d * (Math.PI/2)) + c + b

exports.css.outSine = 'cubic-bezier(0.390, 0.575, 0.565, 1.000)'
exports.outSine = (t, b, c, d) ->
	c * Math.sin(t/d * (Math.PI/2)) + b

exports.css.inOutSine = 'cubic-bezier(0.445, 0.050, 0.550, 0.950)'
exports.inOutSine = (t, b, c, d) ->
	-c/2 * (Math.cos(Math.PI*t/d) - 1) + b

exports.css.inExpo = 'cubic-bezier(0.950, 0.050, 0.795, 0.035)'
exports.inExpo = (t, b, c, d) ->
	if t is 0 then b else c * Math.pow(2, 10 * (t/d - 1)) + b

exports.css.outExpo = 'cubic-bezier(0.190, 1.000, 0.220, 1.000)'
exports.outExpo = (t, b, c, d) ->
	if t is d then b+c else c * (-Math.pow(2, -10 * t/d) + 1) + b

exports.css.inOutExpo = 'cubic-bezier(1.000, 0.000, 0.000, 1.000)'
exports.inOutExpo = (t, b, c, d) ->
	if t is 0
		return b
	if t is d
		return b+c
	if ((t/=d/2) < 1)
		return c/2 * Math.pow(2, 10 * (t - 1)) + b
	c/2 * (-Math.pow(2, -10 * --t) + 2) + b

exports.css.inCirc = 'cubic-bezier(0.600, 0.040, 0.980, 0.335)'
exports.inCirc = (t, b, c, d) ->
	-c * (Math.sqrt(1 - (t/=d)*t) - 1) + b

exports.css.outCirc = 'cubic-bezier(0.075, 0.820, 0.165, 1.000)'
exports.outCirc = (t, b, c, d) ->
	c * Math.sqrt(1 - (t=t/d-1)*t) + b

exports.css.outCirc = 'cubic-bezier(0.785, 0.135, 0.150, 0.860)'
exports.inOutCirc = (t, b, c, d) ->
	if ((t/=d/2) < 1) 
		return -c/2 * (Math.sqrt(1 - t*t) - 1) + b
	c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b

exports.inElastic = (t, b, c, d) ->
	if t is 0
		return b
	if (t/=d) is 1
		return b+c
	p = d*.3 if !p
	if (!a or a < Math.abs(c))
		a = c
		s = p/4
	else
	 s = p/(2*Math.PI) * Math.asin(c/a)
	-(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b

exports.outElastic = (t, b, c, d) ->
	if t is 0
		return b
	if (t/=d) is 1
		return b+c
	p = d*.3 if !p
	if (!a or a < Math.abs(c))
		a = c
		s = p/4
	else
		s = p/(2*Math.PI) * Math.asin(c/a)
	a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b

exports.inOutElastic = (t, b, c, d) ->
	if t is 0
		return b
	if (t/=d/2) is 2
		return b+c
	p = d*(.3*1.5) if !p
	if (!a or a < Math.abs(c))
		a = c
		s = p/4
	else
		s = p/(2*Math.PI) * Math.asin (c/a)
	if (t < 1)
		return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b
	a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b

exports.css.inBack = 'cubic-bezier(0.600, -0.280, 0.735, 0.045)'
exports.inBack = (t, b, c, d, s) ->
	s = 1.70158 if s?
	c*(t/=d)*t*((s+1)*t - s) + b

exports.css.outBack = 'cubic-bezier(0.175, 0.885, 0.320, 1.275)'
exports.outBack = (t, b, c, d, s) ->
	s = 1.70158 if s?
	c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b

exports.css.inOutBack = 'cubic-bezier(0.680, -0.550, 0.265, 1.550)'
exports.inOutBack = (t, b, c, d, s) ->
	s = 1.70158 if s?
	if ((t/=d/2) < 1)
		return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b
	c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b

exports.inBounce = (t, b, c, d) ->
	c - exports.outBounce(x, d-t, 0, c, d) + b

exports.outBounce = (t, b, c, d) ->
	if ((t/=d) < (1/2.75))
		return c*(7.5625*t*t) + b
	else if (t < (2/2.75))
		return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b
	else if (t < (2.5/2.75))
		return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b
	else
		return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b

exports.inOutBounce = (t, b, c, d) ->
	if (t < d/2) 
		return exports.inBounce(x, t*2, 0, c, d) * .5 + b
	exports.outBounce(x, t*2-d, 0, c, d) * .5 + c*.5 + b
