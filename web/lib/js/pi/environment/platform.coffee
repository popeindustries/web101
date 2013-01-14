ua = navigator.userAgent

exports.isIE = (-> !+"\v1")()
exports.isIPad = (-> /ipad/i.test(ua))()
exports.isIPhone = (-> /iphone/i.test(ua))()
exports.isIOS = (-> exports.isIPhone or exports.isIPad or false)()
exports.isMobileSafari = (-> exports.isIPhone and /safari/i.test(ua))()
exports.iOSVersion = (->
	match = navigator.userAgent.match(/os (\d+)_/i)
	match[1] if match?[1]
)()
exports.isAndroid = (-> /android/i.test(ua))()
exports.androidVersion = (->
	match = navigator.userAgent.match(/android (\d+)\./i)
	match[1] if match?[1]
)()
exports.isMobile = (-> /mobile/i.test(ua) and not exports.isIPad)()
