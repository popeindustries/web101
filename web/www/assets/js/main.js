/*BUILT Mon Jan 14 2013 12:21:57 GMT+0100 (CET)*/
require.register('pi/utils/polyfill', function(module, exports, require) {
  var lastFrameTime, vendor, vendors, _i, _len;
  
  if (!Array.prototype.indexOf) {
    Array.prototype.indexOf = function(item) {
      var i, prop, _i, _len;
      for (i = _i = 0, _len = this.length; _i < _len; i = ++_i) {
        prop = this[i];
        if (item === prop) {
          return i;
        }
      }
      return -1;
    };
  }
  
  lastFrameTime = null;
  
  vendors = ['ms', 'moz', 'webkit', 'o'];
  
  for (_i = 0, _len = vendors.length; _i < _len; _i++) {
    vendor = vendors[_i];
    if (!(!window.requestAnimationFrame)) {
      continue;
    }
    window.requestAnimationFrame = window[vendor + 'RequestAnimationFrame'];
    window.cancelAnimationFrame = window[vendor + 'CancelAnimationFrame'] || window[vendor + 'CancelRequestAnimationFrame'];
  }
  
  if (!window.requestAnimationFrame) {
    window.requestAnimationFrame = function(callback, element) {
      var currFrameTime, id, interval, lastTime;
      currFrameTime = +(new Date);
      if (lastFrameTime == null) {
        lastFrameTime = currFrameTime;
      }
      interval = Math.max(0, 16 - (currFrameTime - lastFrameTime));
      id = window.setTimeout((function() {
        return callback(currFrameTime + interval);
      }), interval);
      lastTime = currFrameTime + interval;
      return id;
    };
  }
  
  if (!window.cancelAnimationFrame) {
    window.cancelAnimationFrame = function(id) {
      return clearTimeout(id);
    };
  }
  
});
require.register('pi/dom/ready', function(module, exports, require) {
  var doc, initialized, isReady, readyCallbacks, scrollCheck, timer, whenReady, win;
  
  win = window;
  
  doc = win.document;
  
  timer = null;
  
  isReady = false;
  
  initialized = false;
  
  readyCallbacks = [];
  
  whenReady = function() {
    var callback, _i, _len;
    if (!isReady) {
      isReady = true;
      for (_i = 0, _len = readyCallbacks.length; _i < _len; _i++) {
        callback = readyCallbacks[_i];
        callback();
      }
      readyCallbacks = null;
      if (timer) {
        clearTimeout(timer);
      }
      if (doc.addEventListener) {
        doc.removeEventListener('DOMContentLoaded', whenReady, false);
        return win.removeEventListener('load', whenReady, false);
      } else {
        doc.detachEvent('onreadystatechange', whenReady);
        return win.detachEvent('onload', whenReady);
      }
    }
  };
  
  scrollCheck = function() {
    if (isReady) {
      return;
    }
    try {
      doc.documentElement.doScroll('left');
    } catch (error) {
      timer = setTimeout(scrollCheck, 11);
      return;
    }
    return whenReady();
  };
  
  module.exports = function(callback) {
    readyCallbacks.push(callback);
    if (!initialized) {
      if (doc.readyState === 'complete' || doc.readyState === 'loaded') {
        whenReady();
      } else if (doc.addEventListener) {
        doc.addEventListener('DOMContentLoaded', whenReady, false);
        win.addEventListener('load', whenReady, false);
      } else if (doc.attachEvent) {
        doc.attachEvent('onreadystatechange', whenReady);
        win.attachEvent('onload', whenReady);
        if (doc.documentElement.doScroll) {
          scrollCheck();
        }
      }
      return initialized = true;
    }
  };
  
});
require.register('pi/dom/classlist', function(module, exports, require) {
  var RE_TRIM,
    __indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; };
  
  RE_TRIM = /^\s+|\s+$/g;
  
  exports.hasClass = function(element, clas) {
    var classes;
    if (element.classList != null) {
      return element.classList.contains(clas);
    } else {
      classes = element.className.replace(RE_TRIM, '').split(' ');
      return __indexOf.call(classes, clas) >= 0;
    }
  };
  
  exports.matchClass = function(element, pattern) {
    var clas, classes, _i, _len;
    classes = element.className.replace(RE_TRIM, '').split(' ');
    for (_i = 0, _len = classes.length; _i < _len; _i++) {
      clas = classes[_i];
      if (clas.indexOf(pattern) !== -1) {
        return clas;
      }
    }
    return '';
  };
  
  exports.addClass = function(element, clas) {
    if (element.classList != null) {
      return element.classList.add(clas);
    } else {
      return element.className += ' ' + clas;
    }
  };
  
  exports.removeClass = function(element, clas) {
    var c, classes;
    if (clas) {
      if (element.classList != null) {
        return element.classList.remove(clas);
      } else {
        classes = (function() {
          var _i, _len, _ref, _results;
          _ref = element.className.replace(RE_TRIM, '').split(' ');
          _results = [];
          for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            c = _ref[_i];
            if (c !== clas) {
              _results.push(c);
            }
          }
          return _results;
        })();
        return element.className = classes.join(' ');
      }
    }
  };
  
  exports.toggleClass = function(element, clas) {
    if (exports.hasClass(element, clas)) {
      return exports.removeClass(element, clas);
    } else {
      return exports.addClass(element, clas);
    }
  };
  
  exports.replaceClass = function(element, clasOld, clasNew) {
    if (clasOld) {
      if (clasNew) {
        return element.className = element.className.replace(clasOld, clasNew);
      } else {
        return exports.removeClass(element, clasOld);
      }
    } else if (clasNew) {
      return exports.addClass(element, clasNew);
    }
  };
  
  exports.addTemporaryClass = function(element, clas, duration) {
    var _this = this;
    exports.addClass(element, clas);
    return setTimeout((function() {
      return exports.removeClass(element, clas);
    }), duration);
  };
  
});
require.register('pi/dom/select', function(module, exports, require) {
  var doc, objectUtils, win;
  
  objectUtils = require('../utils/objectutils');
  
  win = window;
  
  doc = win.document;
  
  if (!doc.getElementsByClassName) {
    doc.getElementsByClassName = function(clazz, tag) {
      var element, elements, matches, re;
      elements = doc.getElementsByTagName(tag || '*');
      if (!elements.length) {
        return false;
      }
      re = new RegExp("(?:^|\\s)" + clazz + "(?:\\s|$)");
      matches = (function() {
        var _i, _len, _results;
        _results = [];
        for (_i = 0, _len = elements.length; _i < _len; _i++) {
          element = elements[_i];
          if (element.className.match(re)) {
            _results.push(element);
          }
        }
        return _results;
      })();
      return matches;
    };
  }
  
  module.exports = function(selector, context, tag) {
    var elements, item, sel;
    if (!objectUtils.isElement(context)) {
      context = (context != null ? context.domElement : void 0) || doc;
    }
    if (context.querySelectorAll != null) {
      elements = context.querySelectorAll(selector);
    } else {
      switch (selector.charAt(0)) {
        case '#':
          elements = doc.getElementById(selector.slice(1));
          break;
        case '.':
          elements = doc.getElementsByClassName(selector.slice(1), tag);
          break;
        default:
          if (selector.indexOf('.') !== -1) {
            sel = selector.split('.');
            elements = doc.getElementsByClassName(sel[1], sel[0]);
          } else {
            elements = context.getElementsByTagName(selector);
          }
      }
    }
    if (elements.length != null) {
      return (function() {
        var _i, _len, _results;
        _results = [];
        for (_i = 0, _len = elements.length; _i < _len; _i++) {
          item = elements[_i];
          _results.push(item);
        }
        return _results;
      })();
    } else {
      return null;
    }
  };
  
});
require.register('pi/dom/text', function(module, exports, require) {
  var textProp;
  
  textProp = document.documentElement.textContent != null ? 'textContent' : 'innerText';
  
  exports.getText = function(element) {
    return element[textProp];
  };
  
  exports.setText = function(element, text) {
    return element[textProp] = text;
  };
  
});
require.register('pi/dom/css', function(module, exports, require) {
  var RE_IE_OPACITY, RE_RGB, RE_UNITS, VENDOR_PREFIXES, camelCase, clearStyle, colour, current, defaultStyles, doc, expandShorthand, getNumericStyle, getOpacityValue, getPrefixed, getShorthand, getStyle, numeric, objectUtils, opacity, parseNumber, parseOpacity, prefixed, prop, s, setPrefixed, setStyle, shorthand, win, _i, _len;
  
  objectUtils = require('pi/utils/objectutils');
  
  win = window;
  
  doc = win.document;
  
  RE_UNITS = /(px|%|em|ms|s)$/;
  
  RE_IE_OPACITY = /opacity=(\d+)/i;
  
  RE_RGB = /rgb\((\d+),\s?(\d+),\s?(\d+)\)/;
  
  VENDOR_PREFIXES = ['-webkit-', '-moz-', '-ms-', '-o-'];
  
  prefixed = {
    'border-bottom-left-radius': false,
    'border-bottom-right-radius': false,
    'border-top-left-radius': false,
    'border-top-right-radius': false,
    'box-shadow': false,
    'transform': false,
    'transform-origin': false,
    'transform-style': false,
    'transition-delay': false,
    'transition-duration': false,
    'transition-property': false,
    'transition-timing-function': false,
    'perspective': false,
    'perspective-origin': false
  };
  
  numeric = {
    'top': 'px',
    'bottom': 'px',
    'left': 'px',
    'right': 'px',
    'width': 'px',
    'height': 'px',
    'margin-top': 'px',
    'margin-bottom': 'px',
    'margin-left': 'px',
    'margin-right': 'px',
    'padding-top': 'px',
    'padding-bottom': 'px',
    'padding-left': 'px',
    'padding-right': 'px',
    'border-bottom-left-radius': 'px',
    'border-bottom-right-radius': 'px',
    'border-top-left-radius': 'px',
    'border-top-right-radius': 'px',
    'transition-duration': 'ms',
    'opacity': '',
    'font-size': 'px'
  };
  
  colour = {
    'background-color': 'color',
    'color': 'color',
    'border-color': 'color'
  };
  
  shorthand = {
    'border-radius': ['border-bottom-left-radius', 'border-bottom-right-radius', 'border-top-left-radius', 'border-top-right-radius'],
    'border-color': ['border-bottom-color', 'border-left-color', 'border-top-color', 'border-right-color'],
    'margin': ['margin-top', 'margin-right', 'margin-left', 'margin-bottom'],
    'padding': ['padding-top', 'padding-right', 'padding-left', 'padding-bottom']
  };
  
  current = function(element, property) {
    if (win.getComputedStyle) {
      if (property) {
        return win.getComputedStyle(element).getPropertyValue(property);
      } else {
        return win.getComputedStyle(element);
      }
    } else {
      if (property) {
        return element.currentStyle[property];
      } else {
        return element.currentStyle;
      }
    }
  };
  
  defaultStyles = {};
  
  s = current(doc.documentElement);
  
  if (s.length) {
    for (_i = 0, _len = s.length; _i < _len; _i++) {
      prop = s[_i];
      defaultStyles[prop] = true;
    }
  } else {
    for (prop in s) {
      defaultStyles[prop] = true;
    }
  }
  
  opacity = !defaultStyles['opacity'] && defaultStyles['filter'] ? 'filter' : 'opacity';
  
  camelCase = function(str) {
    return str.replace(/-([a-z])/g, function($0, $1) {
      return $1.toUpperCase();
    }).replace('-', '');
  };
  
  exports.getPrefixed = getPrefixed = function(property) {
    if (prefixed.hasOwnProperty(property)) {
      if (!prefixed[property]) {
        setPrefixed(property);
      }
      property = prefixed[property];
    }
    return property;
  };
  
  setPrefixed = function(property) {
    var vendor, _j, _len1, _results;
    if (defaultStyles[property]) {
      prefixed[property] = property;
    }
    _results = [];
    for (_j = 0, _len1 = VENDOR_PREFIXES.length; _j < _len1; _j++) {
      vendor = VENDOR_PREFIXES[_j];
      if (!prefixed[property]) {
        if (defaultStyles[vendor + property]) {
          _results.push(prefixed[property] = vendor + property);
        } else {
          _results.push(void 0);
        }
      }
    }
    return _results;
  };
  
  getShorthand = function(property) {
    var _ref;
    return ((_ref = shorthand[property]) != null ? _ref[0] : void 0) || property;
  };
  
  expandShorthand = function(property, value) {
    var p, props, _j, _len1, _ref;
    if (shorthand[property] != null) {
      props = {};
      _ref = shorthand[property];
      for (_j = 0, _len1 = _ref.length; _j < _len1; _j++) {
        p = _ref[_j];
        props[p] = value;
      }
      return props;
    }
    return property;
  };
  
  parseOpacity = function(element) {
    var match, value;
    value = current(element, opacity);
    if (value === '') {
      return null;
    } else if (opacity === 'filter') {
      match = value.match(RE_IE_OPACITY);
      if (match != null) {
        return parseInt(match[1]) / 100;
      }
    } else {
      return parseFloat(value);
    }
  };
  
  getOpacityValue = function(value) {
    var val;
    val = parseFloat(value);
    if (opacity === 'filter') {
      val = "alpha(opacity=" + (val * 100) + ")";
    }
    return val;
  };
  
  exports.csstransitions = getPrefixed('transition-duration') !== false;
  
  exports.parseNumber = parseNumber = function(value, property) {
    var channels, num, unit, _ref;
    if (colour[property]) {
      if ((value != null ? value.charAt(0) : void 0) !== '#') {
        channels = RE_RGB.exec(value);
        if (channels) {
          return ["#" + ((1 << 24) | (channels[1] << 16) | (channels[2] << 8) | channels[3]).toString(16).slice(1), 'hex'];
        } else {
          return ['#ffffff', 'hex'];
        }
      } else {
        return [value || '#ffffff', 'hex'];
      }
    } else {
      num = parseFloat(value);
      if (objectUtils.isNaN(num)) {
        return [value, ''];
      } else {
        unit = (_ref = RE_UNITS.exec(value)) != null ? _ref[1] : void 0;
        if (unit == null) {
          unit = numeric[property] != null ? numeric[property] : 'px';
        }
        return [num, unit];
      }
    }
  };
  
  exports.getStyle = getStyle = function(element, property) {
    var value;
    if (property === 'opacity') {
      return parseOpacity(element);
    }
    property = getPrefixed(getShorthand(property));
    value = current(element, property);
    if (value == null) {
      value = current(element, camelCase(property));
    }
    switch (value) {
      case '':
        return null;
      case 'auto':
        return 0;
      default:
        return value;
    }
  };
  
  exports.getNumericStyle = getNumericStyle = function(element, property) {
    return parseNumber(getStyle(element, property), property);
  };
  
  exports.setStyle = setStyle = function(element, property, value) {
    var val;
    property = expandShorthand(property, value);
    if (objectUtils.isObject(property)) {
      for (prop in property) {
        val = property[prop];
        setStyle(element, prop, val);
      }
      return;
    }
    if (property === 'opacity') {
      property = opacity;
      value = getOpacityValue(value);
    }
    property = getPrefixed(property);
    if (value !== 'auto' && value !== 'inherit' && numeric[property] && !RE_UNITS.test(value)) {
      value += numeric[property];
    }
    return element.style[camelCase(property)] = value;
  };
  
  exports.clearStyle = clearStyle = function(element, property) {
    var isShorthand, match, re, shortProp, style, _j, _len1;
    isShorthand = shorthand[property] != null;
    shortProp = property;
    property = shorthand[property] || property;
    if (objectUtils.isArray(property)) {
      for (_j = 0, _len1 = property.length; _j < _len1; _j++) {
        prop = property[_j];
        clearStyle(element, prop);
      }
      if (isShorthand) {
        property = shortProp;
      } else {
        return;
      }
    }
    style = element.getAttribute('style') || '';
    re = new RegExp("\\s?" + (getPrefixed(property)) + ":\\s[^;]+");
    match = re.exec(style);
    if (match != null) {
      return element.setAttribute('style', style.replace(match + ';', ''));
    }
  };
  
  if (win.testing) {
    exports.getPrefixed = getPrefixed;
    exports.setPrefixed = setPrefixed;
    exports.getShorthand = getShorthand;
    exports.expandShorthand = expandShorthand;
  }
  
});
require.register('pi/environment/capabilities', function(module, exports, require) {
  var doc, nav, win;
  
  win = window;
  
  doc = win.document;
  
  nav = navigator;
  
  exports.hasVideo = function() {
    var hasVideo;
    hasVideo = !!doc.createElement('video').canPlayType;
    exports.hasVideo = function() {
      return hasVideo;
    };
    return hasVideo;
  };
  
  exports.hasFlash = function() {
    var desc, testObject, version, _ref, _ref1;
    if (typeof ((_ref = nav.plugins) != null ? _ref['Shockwave Flash'] : void 0) === 'object') {
      desc = nav.plugins['Shockwave Flash'].description;
      if (desc && !(((_ref1 = nav.mimeTypes) != null ? _ref1['application/x-shockwave-flash'] : void 0) && !nav.mimeTypes['application/x-shockwave-flash'].enabledPlugin)) {
        version = parseInt(desc.match(/^.*\s+([^\s]+)\.[^\s]+\s+[^\s]+$/)[1], 10);
      }
    } else if (win.ActiveXObject != null) {
      try {
        testObject = new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
        if (testObject) {
          version = parseInt(testObject.GetVariable('$version').match(/^[^\s]+\s(\d+)/)[1], 10);
        }
      } catch (e) {
  
      }
    }
    exports.flashVersion = version;
    exports.hasFlash = function() {
      return exports.flashVersion > 0;
    };
    return version > 0;
  };
  
  exports.flashVersion = 0;
  
  exports.hasNativeFullscreen = function() {
    var hasNativeFullscreen;
    hasNativeFullscreen = typeof doc.createElement('video').webkitEnterFullScreen === 'function';
    exports.hasNativeFullscreen = function() {
      return hasNativeFullscreen;
    };
    return hasNativeFullscreen;
  };
  
  exports.hasCanvas = function() {
    var elem, hasCanvas;
    elem = doc.createElement('canvas');
    hasCanvas = !!(elem.getContext && elem.getContext('2d'));
    exports.hasCanvas = function() {
      return hasCanvas;
    };
    return hasCanvas;
  };
  
  exports.hasTouch = function() {
    var hasTouch;
    hasTouch = 'ontouchstart' in win || (win.DocumentTouch && doc instanceof DocumentTouch);
    exports.hasTouch = function() {
      return hasTouch;
    };
    return hasTouch;
  };
  
});
require.register('pi/environment/platform', function(module, exports, require) {
  var ua;
  
  ua = navigator.userAgent;
  
  exports.isIE = (function() {
    return !+"\v1";
  })();
  
  exports.isIPad = (function() {
    return /ipad/i.test(ua);
  })();
  
  exports.isIPhone = (function() {
    return /iphone/i.test(ua);
  })();
  
  exports.isIOS = (function() {
    return exports.isIPhone || exports.isIPad || false;
  })();
  
  exports.isMobileSafari = (function() {
    return exports.isIPhone && /safari/i.test(ua);
  })();
  
  exports.iOSVersion = (function() {
    var match;
    match = navigator.userAgent.match(/os (\d+)_/i);
    if (match != null ? match[1] : void 0) {
      return match[1];
    }
  })();
  
  exports.isAndroid = (function() {
    return /android/i.test(ua);
  })();
  
  exports.androidVersion = (function() {
    var match;
    match = navigator.userAgent.match(/android (\d+)\./i);
    if (match != null ? match[1] : void 0) {
      return match[1];
    }
  })();
  
  exports.isMobile = (function() {
    return /mobile/i.test(ua) && !exports.isIPad;
  })();
  
});
require.register('pi/environment/viewport', function(module, exports, require) {
  var doc, win;
  
  win = window;
  
  doc = win.document;
  
  exports.getWidth = function() {
    return doc.documentElement.clientWidth;
  };
  
  exports.getHeight = function() {
    return doc.documentElement.clientHeight;
  };
  
});
require.register('pi/environment/index', function(module, exports, require) {
  
  exports.capabilities = require('./capabilities');
  
  exports.platform = require('./platform');
  
  exports.viewport = require('./viewport');
  
});
require.register('pi/event', function(module, exports, require) {
  var DomEvent, Event, capabilities, createHandler, doc, domListeners, element, getType, id, isValidElement, platform, removeCachedListener, win, _ref;
  
  _ref = require('./environment'), platform = _ref.platform, capabilities = _ref.capabilities;
  
  element = null;
  
  win = window;
  
  doc = win.document;
  
  domListeners = [];
  
  id = 0;
  
  isValidElement = function(element) {
    return !!(element && ((element.domElement != null) || element === win || element.nodeType === 9 || element.nodeType === 1));
  };
  
  createHandler = function(target, type, data, callback) {
    return function(event) {
      return callback(new DomEvent(event, target, type, data));
    };
  };
  
  removeCachedListener = function(target, type, callback) {
    var i, item, _i, _len;
    for (i = _i = 0, _len = domListeners.length; _i < _len; i = ++_i) {
      item = domListeners[i];
      if ((item.target.domElement === target.domElement || item.target === target) && item.type === type && item.callback === callback) {
        return domListeners.splice(i, 1)[0];
      }
    }
  };
  
  getType = function(type) {
    if (capabilities.hasTouch()) {
      switch (type) {
        case 'mousedown':
          type = 'touchstart';
          break;
        case 'mousemove':
          type = 'touchmove';
          break;
        case 'mouseup':
          type = 'touchend';
      }
    }
    return type;
  };
  
  exports.on = function(target, type, callback, data) {
    var handler, _ref1;
    if (element == null) {
      element = require('./dom/element');
    }
    if (isValidElement(target)) {
      handler = createHandler(target, type, data, callback);
      handler.id = id++;
      domListeners.push({
        target: target,
        type: type,
        handler: handler,
        callback: callback
      });
      if (target.domElement) {
        target = target.domElement;
      }
      type = getType(type);
      if (target.addEventListener) {
        target.addEventListener(type, handler, false);
      } else if (target.attachEvent) {
        target.attachEvent("on" + type, handler);
      }
    } else {
      if ((_ref1 = target._handlers) == null) {
        target._handlers = {};
      }
      if (!(type in target._handlers)) {
        target._handlers[type] = [];
      }
      target._handlers[type].push(callback);
    }
    return target;
  };
  
  exports.one = function(target, type, callback, data) {
    var cb,
      _this = this;
    exports.on(target, type, cb = function(event) {
      callback.call(null, event);
      return exports.off(target, type, cb);
    }, data);
    return target;
  };
  
  exports.off = function(target, type, callback) {
    var cb, i, listener, _i, _len, _ref1;
    if (isValidElement(target)) {
      if (listener = removeCachedListener(target, type, callback)) {
        if (target.domElement) {
          target = target.domElement;
        }
        type = getType(type);
        if (target.removeEventListener) {
          target.removeEventListener(type, listener.handler, false);
        } else if (target.detachEvent) {
          target.detachEvent("on" + type, listener.handler);
        }
      }
    } else {
      _ref1 = target._handlers[type];
      for (i = _i = 0, _len = _ref1.length; _i < _len; i = ++_i) {
        cb = _ref1[i];
        if (callback === cb) {
          target._handlers[type].splice(i, 1);
          break;
        }
      }
    }
    return target;
  };
  
  exports.offAll = function(target) {
    var listener, _i, _len;
    if (isValidElement(target)) {
      for (_i = 0, _len = domListeners.length; _i < _len; _i++) {
        listener = domListeners[_i];
        if (target === (listener.target.domElement || listener.target)) {
          exports.off(listener.target, listener.type, listener.callback);
        }
      }
    } else {
      target._handlers = null;
    }
    return target;
  };
  
  exports.trigger = function(target, type, data) {
    var callback, evt, list, _i, _len;
    if (!isValidElement(target)) {
      if (target._handlers && type in target._handlers) {
        list = target._handlers[type].slice();
        evt = new Event(target, type, data);
        if (list.length === 1) {
          list[0].call(target, evt);
        } else {
          for (_i = 0, _len = list.length; _i < _len; _i++) {
            callback = list[_i];
            callback.call(target, evt);
          }
        }
        return target;
      }
    }
  };
  
  exports.dispatcher = function(target) {
    if (!isValidElement(target)) {
      target['on'] = function(type, callback) {
        return exports.on(this, type, callback);
      };
      target['off'] = function(type, callback) {
        return exports.off(this, type, callback);
      };
      target['one'] = function(type, callback) {
        return exports.one(this, type, callback);
      };
      return target['trigger'] = function(type, data) {
        return exports.trigger(this, type, data);
      };
    }
  };
  
  Event = (function() {
  
    function Event(target, type, data) {
      this.target = target;
      this.type = type;
      this.data = data;
    }
  
    return Event;
  
  })();
  
  DomEvent = (function() {
  
    function DomEvent(event, target, type, data) {
      var pos;
      this.type = type;
      this.data = data;
      this.domEvent = event || win.event;
      this.currentTarget = target;
      this.target = this.domEvent.target || this.domEvent.srcElement || win;
      if (this.target.nodeType === 3) {
        this.target = this.target.parentNode;
      }
      if (!this.target.domElement && this.target.nodeType === 1) {
        this.target = element(this.target);
      }
      this.rightClick = this.domEvent.which ? this.domEvent.which === 3 : this.domEvent.button ? this.domEvent.button === 2 : false;
      this.leftClick = this.domEvent.which ? this.domEvent.which === 1 : this.domEvent.button ? this.domEvent.button === 0 || this.domEvent.button === 1 : true;
      if (this.type === 'mousedown' || this.type === 'mousemove') {
        if (this.domEvent.touches) {
          this.touches = this.domEvent.touches;
          if (this.touches.length) {
            this.pageX = this.touches[0].pageX;
            this.pageY = this.touches[0].pageY;
          }
        } else {
          this.pageX = this.domEvent.pageX != null ? this.domEvent.pageX : this.domEvent.clientX + doc.body.scrollLeft + doc.documentElement.scrollLeft;
          this.pageY = this.domEvent.pageY != null ? this.domEvent.pageY : this.domEvent.clientY + doc.body.scrollTop + doc.documentElement.scrollTop;
        }
        if ((this.domEvent.offsetX != null) && (this.domEvent.offsetY != null) && (this.domEvent.offsetX !== 0 && this.domEvent.offsetY !== 0)) {
          this.x = this.domEvent.offsetX;
          this.y = this.domEvent.offsetY;
        } else if ((this.domEvent.x != null) && (this.domEvent.y != null)) {
          this.x = this.domEvent.x;
          this.y = this.domEvent.y;
        } else {
          pos = this.target.domElement ? this.target.position() : {
            left: this.target.offsetLeft,
            top: this.target.offsetTop
          };
          this.x = this.pageX ? this.pageX - pos.left : 0;
          this.y = this.pageY ? this.pageY - pos.top : 0;
        }
      }
    }
  
    DomEvent.prototype.preventDefault = function() {
      if (this.domEvent.preventDefault) {
        return this.domEvent.preventDefault();
      } else {
        return this.domEvent.returnValue = false;
      }
    };
  
    DomEvent.prototype.stopPropagation = function() {
      if (this.domEvent.stopPropagation) {
        return this.domEvent.stopPropagation();
      } else {
        return this.domEvent.cancelBubble = true;
      }
    };
  
    DomEvent.prototype.stop = function() {
      this.preventDefault();
      return this.stopPropagation();
    };
  
    return DomEvent;
  
  })();
  
  if ((win != null) && win.attachEvent && !win.addEventListener) {
    win.attachEvent('onunload', function() {
      var listener, _i, _len, _results;
      _results = [];
      for (_i = 0, _len = domListeners.length; _i < _len; _i++) {
        listener = domListeners[_i];
        try {
          _results.push(exports.off(listener.target, listener.type, listener.callback));
        } catch (e) {
  
        }
      }
      return _results;
    });
  }
  
});
require.register('pi/utils/objectutils', function(module, exports, require) {
  var __slice = [].slice;
  
  exports.isArray = function(obj) {
    if (Array.isArray) {
      return Array.isArray(obj);
    } else {
      return Object.prototype.toString.call(obj) === '[object Array]';
    }
  };
  
  exports.isObject = function(obj) {
    return obj === Object(obj);
  };
  
  exports.isString = function(obj) {
    return Object.prototype.toString.call(obj) === '[object String]';
  };
  
  exports.isNumber = function(obj) {
    return Object.prototype.toString.call(obj) === '[object Number]';
  };
  
  exports.isFunction = function(obj) {
    return Object.prototype.toString.call(obj) === '[object Function]';
  };
  
  exports.isNaN = function(obj) {
    return obj !== obj;
  };
  
  exports.isElement = function(obj) {
    return !!((obj != null ? obj.nodeType : void 0) === 1);
  };
  
  exports.isBoolean = function(obj) {
    return obj === true || obj === false || Object.prototype.toString.call(obj) === '[object Boolean]';
  };
  
  exports.extend = function() {
    var argObj, argObjs, obj, prop, value, _i, _len;
    obj = arguments[0], argObjs = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
    for (_i = 0, _len = argObjs.length; _i < _len; _i++) {
      argObj = argObjs[_i];
      for (prop in argObj) {
        value = argObj[prop];
        obj[prop] = value;
      }
    }
    return obj;
  };
  
  exports.objectify = function(key, value) {
    var o;
    o = {};
    o[key] = value;
    return o;
  };
  
});
require.register('pi/utils/numberutils', function(module, exports, require) {
  var interplate, limit, map, normalize, rangedRandom;
  
  exports.TWO_PI = (function() {
    return Math.PI * 2;
  })();
  
  exports.HALF_PI = (function() {
    return Math.PI * 0.5;
  })();
  
  exports.degreesToRadians = function(deg) {
    return (deg * Math.PI) / 180;
  };
  
  exports.radiansToDegrees = function(rad) {
    return (180 * rad) / Math.PI;
  };
  
  normalize = exports.normalize = function(value, min, max) {
    if (min === max) {
      return 1;
    } else {
      return (value - min) / (max - min);
    }
  };
  
  interplate = exports.interpolate = function(normValue, min, max) {
    return min + (max - min) * normValue;
  };
  
  map = exports.map = function(value, min1, max1, min2, max2) {
    return interplate(normalize(value, min1, max1), min2, max2);
  };
  
  limit = exports.limit = function(value, min, max) {
    return Math.min(Math.max(min, value), max);
  };
  
  rangedRandom = exports.rangedRandom = function(low, high) {
    return map(Math.random(), 0, 1, low, high);
  };
  
});
require.register('pi/utils/easing', function(module, exports, require) {
  
  exports.css = {};
  
  exports.css.linear = 'cubic-bezier(0.250, 0.250, 0.750, 0.750)';
  
  exports.linear = function(t, b, c, d) {
    return c * t / d + b;
  };
  
  exports.css.inQuad = 'cubic-bezier(0.550, 0.085, 0.680, 0.530)';
  
  exports.inQuad = function(t, b, c, d) {
    return c * (t /= d) * t + b;
  };
  
  exports.css.outQuad = 'cubic-bezier(0.250, 0.460, 0.450, 0.940)';
  
  exports.outQuad = function(t, b, c, d) {
    return -c * (t /= d) * (t - 2) + b;
  };
  
  exports.inOutQuad = function(t, b, c, d) {
    if ((t /= d / 2) < 1) {
      return c / 2 * t * t + b;
    }
    return -c / 2 * ((--t) * (t - 2) - 1) + b;
  };
  
  exports.css.inCubic = 'cubic-bezier(0.550, 0.055, 0.675, 0.190)';
  
  exports.inCubic = function(t, b, c, d) {
    return c * (t /= d) * t * t + b;
  };
  
  exports.css.outCubic = 'cubic-bezier(0.215, 0.610, 0.355, 1.000)';
  
  exports.outCubic = function(t, b, c, d) {
    return c * ((t = t / d - 1) * t * t + 1) + b;
  };
  
  exports.inOutCubic = function(t, b, c, d) {
    if ((t /= d / 2) < 1) {
      return c / 2 * t * t * t + b;
    }
    return c / 2 * ((t -= 2) * t * t + 2) + b;
  };
  
  exports.css.inQuart = 'cubic-bezier(0.895, 0.030, 0.685, 0.220)';
  
  exports.inQuart = function(t, b, c, d) {
    return c * (t /= d) * t * t * t + b;
  };
  
  exports.css.outQuart = 'cubic-bezier(0.165, 0.840, 0.440, 1.000)';
  
  exports.outQuart = function(t, b, c, d) {
    return -c * ((t = t / d - 1) * t * t * t - 1) + b;
  };
  
  exports.css.inOutQuart = 'cubic-bezier(0.770, 0.000, 0.175, 1.000)';
  
  exports.inOutQuart = function(t, b, c, d) {
    if ((t /= d / 2) < 1) {
      return c / 2 * t * t * t * t + b;
    }
    return -c / 2 * ((t -= 2) * t * t * t - 2) + b;
  };
  
  exports.css.inQuint = 'cubic-bezier(0.755, 0.050, 0.855, 0.060)';
  
  exports.inQuint = function(t, b, c, d) {
    return c * (t /= d) * t * t * t * t + b;
  };
  
  exports.css.outQuint = 'cubic-bezier(0.230, 1.000, 0.320, 1.000)';
  
  exports.outQuint = function(t, b, c, d) {
    return c * ((t = t / d - 1) * t * t * t * t + 1) + b;
  };
  
  exports.css.inOutQuint = 'cubic-bezier(0.860, 0.000, 0.070, 1.000)';
  
  exports.inOutQuint = function(t, b, c, d) {
    if ((t /= d / 2) < 1) {
      return c / 2 * t * t * t * t * t + b;
    }
    return c / 2 * ((t -= 2) * t * t * t * t + 2) + b;
  };
  
  exports.css.inSine = 'cubic-bezier(0.470, 0.000, 0.745, 0.715)';
  
  exports.inSine = function(t, b, c, d) {
    return -c * Math.cos(t / d * (Math.PI / 2)) + c + b;
  };
  
  exports.css.outSine = 'cubic-bezier(0.390, 0.575, 0.565, 1.000)';
  
  exports.outSine = function(t, b, c, d) {
    return c * Math.sin(t / d * (Math.PI / 2)) + b;
  };
  
  exports.css.inOutSine = 'cubic-bezier(0.445, 0.050, 0.550, 0.950)';
  
  exports.inOutSine = function(t, b, c, d) {
    return -c / 2 * (Math.cos(Math.PI * t / d) - 1) + b;
  };
  
  exports.css.inExpo = 'cubic-bezier(0.950, 0.050, 0.795, 0.035)';
  
  exports.inExpo = function(t, b, c, d) {
    if (t === 0) {
      return b;
    } else {
      return c * Math.pow(2, 10 * (t / d - 1)) + b;
    }
  };
  
  exports.css.outExpo = 'cubic-bezier(0.190, 1.000, 0.220, 1.000)';
  
  exports.outExpo = function(t, b, c, d) {
    if (t === d) {
      return b + c;
    } else {
      return c * (-Math.pow(2, -10 * t / d) + 1) + b;
    }
  };
  
  exports.css.inOutExpo = 'cubic-bezier(1.000, 0.000, 0.000, 1.000)';
  
  exports.inOutExpo = function(t, b, c, d) {
    if (t === 0) {
      return b;
    }
    if (t === d) {
      return b + c;
    }
    if ((t /= d / 2) < 1) {
      return c / 2 * Math.pow(2, 10 * (t - 1)) + b;
    }
    return c / 2 * (-Math.pow(2, -10 * --t) + 2) + b;
  };
  
  exports.css.inCirc = 'cubic-bezier(0.600, 0.040, 0.980, 0.335)';
  
  exports.inCirc = function(t, b, c, d) {
    return -c * (Math.sqrt(1 - (t /= d) * t) - 1) + b;
  };
  
  exports.css.outCirc = 'cubic-bezier(0.075, 0.820, 0.165, 1.000)';
  
  exports.outCirc = function(t, b, c, d) {
    return c * Math.sqrt(1 - (t = t / d - 1) * t) + b;
  };
  
  exports.css.outCirc = 'cubic-bezier(0.785, 0.135, 0.150, 0.860)';
  
  exports.inOutCirc = function(t, b, c, d) {
    if ((t /= d / 2) < 1) {
      return -c / 2 * (Math.sqrt(1 - t * t) - 1) + b;
    }
    return c / 2 * (Math.sqrt(1 - (t -= 2) * t) + 1) + b;
  };
  
  exports.inElastic = function(t, b, c, d) {
    var a, p, s;
    if (t === 0) {
      return b;
    }
    if ((t /= d) === 1) {
      return b + c;
    }
    if (!p) {
      p = d * .3;
    }
    if (!a || a < Math.abs(c)) {
      a = c;
      s = p / 4;
    } else {
      s = p / (2 * Math.PI) * Math.asin(c / a);
    }
    return -(a * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p)) + b;
  };
  
  exports.outElastic = function(t, b, c, d) {
    var a, p, s;
    if (t === 0) {
      return b;
    }
    if ((t /= d) === 1) {
      return b + c;
    }
    if (!p) {
      p = d * .3;
    }
    if (!a || a < Math.abs(c)) {
      a = c;
      s = p / 4;
    } else {
      s = p / (2 * Math.PI) * Math.asin(c / a);
    }
    return a * Math.pow(2, -10 * t) * Math.sin((t * d - s) * (2 * Math.PI) / p) + c + b;
  };
  
  exports.inOutElastic = function(t, b, c, d) {
    var a, p, s;
    if (t === 0) {
      return b;
    }
    if ((t /= d / 2) === 2) {
      return b + c;
    }
    if (!p) {
      p = d * (.3 * 1.5);
    }
    if (!a || a < Math.abs(c)) {
      a = c;
      s = p / 4;
    } else {
      s = p / (2 * Math.PI) * Math.asin(c / a);
    }
    if (t < 1) {
      return -.5 * (a * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p)) + b;
    }
    return a * Math.pow(2, -10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p) * .5 + c + b;
  };
  
  exports.css.inBack = 'cubic-bezier(0.600, -0.280, 0.735, 0.045)';
  
  exports.inBack = function(t, b, c, d, s) {
    if (s != null) {
      s = 1.70158;
    }
    return c * (t /= d) * t * ((s + 1) * t - s) + b;
  };
  
  exports.css.outBack = 'cubic-bezier(0.175, 0.885, 0.320, 1.275)';
  
  exports.outBack = function(t, b, c, d, s) {
    if (s != null) {
      s = 1.70158;
    }
    return c * ((t = t / d - 1) * t * ((s + 1) * t + s) + 1) + b;
  };
  
  exports.css.inOutBack = 'cubic-bezier(0.680, -0.550, 0.265, 1.550)';
  
  exports.inOutBack = function(t, b, c, d, s) {
    if (s != null) {
      s = 1.70158;
    }
    if ((t /= d / 2) < 1) {
      return c / 2 * (t * t * (((s *= 1.525) + 1) * t - s)) + b;
    }
    return c / 2 * ((t -= 2) * t * (((s *= 1.525) + 1) * t + s) + 2) + b;
  };
  
  exports.inBounce = function(t, b, c, d) {
    return c - exports.outBounce(x, d - t, 0, c, d) + b;
  };
  
  exports.outBounce = function(t, b, c, d) {
    if ((t /= d) < (1 / 2.75)) {
      return c * (7.5625 * t * t) + b;
    } else if (t < (2 / 2.75)) {
      return c * (7.5625 * (t -= 1.5 / 2.75) * t + .75) + b;
    } else if (t < (2.5 / 2.75)) {
      return c * (7.5625 * (t -= 2.25 / 2.75) * t + .9375) + b;
    } else {
      return c * (7.5625 * (t -= 2.625 / 2.75) * t + .984375) + b;
    }
  };
  
  exports.inOutBounce = function(t, b, c, d) {
    if (t < d / 2) {
      return exports.inBounce(x, t * 2, 0, c, d) * .5 + b;
    }
    return exports.outBounce(x, t * 2 - d, 0, c, d) * .5 + c * .5 + b;
  };
  
});
require.register('pi/utils/animate', function(module, exports, require) {
  var Anim, DEFAULT_DURATION, FRAME_RATE, add, animate, anims, css, csstransitions, destroy, doc, easing, last, length, objectUtils, polyfill, pool, remove, running, tick, uid, win, _onTick,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; },
    __slice = [].slice;
  
  polyfill = require('./polyfill');
  
  easing = require('./easing');
  
  css = require('../dom/css');
  
  objectUtils = require('./objectutils');
  
  win = window;
  
  doc = win.document;
  
  FRAME_RATE = 60;
  
  DEFAULT_DURATION = 0.5;
  
  anims = {};
  
  length = 0;
  
  pool = [];
  
  uid = 1;
  
  tick = 0;
  
  last = 0;
  
  running = false;
  
  csstransitions = css.csstransitions;
  
  animate = module.exports = function(target, keep) {
    var anim;
    if (keep == null) {
      keep = false;
    }
    anim = pool.length ? pool.pop() : new Anim;
    anim.id = uid++;
    anim.target = target;
    anim.keep = keep;
    return anim;
  };
  
  add = function(anim) {
    if (!anims[anim.id]) {
      anims[anim.id] = anim;
      anim.isRunning = true;
      length++;
      if (!running) {
        running = true;
        tick = 0;
        last = +(new Date);
        return _onTick();
      }
    }
  };
  
  remove = function(anim) {
    anim.isRunning = false;
    delete anims[anim.id];
    length--;
    if (!length) {
      return running = false;
    }
  };
  
  destroy = function(anim) {
    if (anim.id) {
      if (anim.isRunning) {
        remove(anim);
      }
      anim.id = null;
      anim.target = null;
      anim.duration = 0;
      anim.elapsed = 0;
      anim.properties = {};
      anim.easing = easing['outCubic'];
      anim.tickCallbacks = [];
      anim.completeCallbacks = [];
      anim.keep = false;
      anim.isRunning = false;
      anim.useCssTransitions = false;
      anim.transitionStyle = '';
      return pool.push(anim);
    }
  };
  
  _onTick = function(time) {
    var anim, id, now;
    now = +(new Date);
    tick = now - last;
    last = now;
    for (id in anims) {
      anim = anims[id];
      anim._render(tick);
    }
    if (running) {
      return win.requestAnimationFrame(_onTick);
    }
  };
  
  Anim = (function() {
  
    function Anim() {
      this._render = __bind(this._render, this);
      this.id = null;
      this.target = null;
      this.duration = 0;
      this.elapsed = 0;
      this.properties = {};
      this.easing = easing['outCubic'];
      this.tickCallbacks = [];
      this.completeCallbacks = [];
      this.isRunning = false;
      this.keep = false;
      this.useCssTransitions = false;
      this.transitionStyle = '';
    }
  
    Anim.prototype.to = function(properties, duration, ease) {
      var current, end, p, prop, s1, val;
      if (duration == null) {
        duration = DEFAULT_DURATION;
      }
      this.duration = duration * 1000;
      this.elapsed = 0;
      if (ease != null) {
        this.easing = easing[ease];
      }
      this.properties = {};
      this.useCssTransitions = false;
      for (prop in properties) {
        val = properties[prop];
        p = {
          start: 0,
          current: 0,
          end: val,
          type: 0
        };
        if (objectUtils.isFunction(this.target[prop])) {
          p.start = this.target[prop]();
          p.type = 1;
        } else if (prop in this.target) {
          p.start = this.target[prop];
          p.type = 2;
        } else {
          current = css.getNumericStyle(this.target, prop);
          p.start = current[0];
          if (objectUtils.isString(val)) {
            end = css.parseNumber(val, prop);
            p.unit = end[1];
            p.end = end[0];
          } else {
            p.unit = current[1];
            p.end = val;
          }
          if (csstransitions) {
            if (!this.useCssTransitions) {
              s1 = (this.target.getAttribute('style') || '').length;
              css.setStyle(this.target, {
                'transition-property': 'all',
                'transition-duration': "" + this.duration + "ms"
              });
              if (ease) {
                css.setStyle(this.target, 'transition-timing-function', easing.css[ease]);
              }
              this.transitionStyle = this.target.getAttribute('style').slice(s1);
              this.useCssTransitions = true;
            }
            p.type = 4;
            css.setStyle(this.target, prop, p.end + p.unit);
          } else {
            p.type = 3;
          }
        }
        this.properties[prop] = p;
      }
      add(this);
      return this;
    };
  
    Anim.prototype.getProperty = function(property) {
      var _ref;
      if (this.isRunning) {
        return (_ref = this.properties[property]) != null ? _ref.current : void 0;
      }
    };
  
    Anim.prototype.setProperty = function(property, value) {
      var _ref;
      if (this.isRunning) {
        return (_ref = this.properties[property]) != null ? _ref.end = value : void 0;
      }
    };
  
    Anim.prototype.onTick = function() {
      var args, callback;
      callback = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      this.tickCallbacks.push({
        func: callback,
        args: args
      });
      return this;
    };
  
    Anim.prototype.onComplete = function() {
      var args, callback;
      callback = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      this.completeCallbacks.push({
        func: callback,
        args: args
      });
      return this;
    };
  
    Anim.prototype.stop = function() {
      if (this.isRunning) {
        if (this.keep) {
          return remove(this);
        } else {
          return destroy(this);
        }
      }
    };
  
    Anim.prototype.destroy = function() {
      destroy(this);
      return null;
    };
  
    Anim.prototype._render = function(time) {
      var b, c, callback, cbs, dur, prop, propObj, value, _i, _len, _ref, _ref1;
      this.elapsed += time;
      dur = this.elapsed < this.duration ? this.elapsed : this.duration;
      _ref = this.properties;
      for (prop in _ref) {
        propObj = _ref[prop];
        if (propObj.type < 4) {
          b = propObj.start;
          c = propObj.end - b;
          value = propObj.current = this.easing(dur, b, c, this.duration);
          switch (propObj.type) {
            case 1:
              this.target[prop](value);
              break;
            case 2:
              this.target[prop] = value;
              break;
            case 3:
              css.setStyle(this.target, prop, "" + value + propObj.unit);
          }
        }
      }
      if (this.tickCallbacks.length) {
        if (this.tickCallbacks.length === 1) {
          this.tickCallbacks[0].func.apply(null, this.tickCallbacks[0].args);
        } else {
          _ref1 = this.tickCallbacks;
          for (_i = 0, _len = _ref1.length; _i < _len; _i++) {
            callback = _ref1[_i];
            callback.func.apply(null, callback.args);
          }
        }
      }
      if (this.elapsed >= this.duration) {
        if (this.useCssTransitions) {
          this.target.setAttribute('style', this.target.getAttribute('style').replace(this.transitionStyle, ''));
          this.useCssTransitions = false;
          this.transitionStyle = '';
        }
        cbs = this.completeCallbacks.slice();
        this.tickCallbacks = [];
        this.completeCallbacks = [];
        this.properties = {};
        if (this.keep) {
          remove(this);
        } else {
          destroy(this);
        }
        if (cbs.length) {
          return win.requestAnimationFrame(function() {
            var _j, _len1;
            if (cbs.length === 1) {
              cbs[0].func.apply(null, cbs[0].args);
            } else {
              for (_j = 0, _len1 = cbs.length; _j < _len1; _j++) {
                callback = cbs[_j];
                callback.func.apply(null, callback.args);
              }
            }
            return cbs = null;
          });
        }
      }
    };
  
    return Anim;
  
  })();
  
});
require.register('pi/dom/element', function(module, exports, require) {
  var Element, animate, classList, css, doc, elementFactory, elements, event, id, numberUtils, objectUtils, select, text, win;
  
  classList = require('./classlist');
  
  select = require('./select');
  
  text = require('./text');
  
  css = require('./css');
  
  event = require('../event');
  
  objectUtils = require('../utils/objectutils');
  
  numberUtils = require('../utils/numberutils');
  
  animate = require('../utils/animate');
  
  win = window;
  
  doc = win.document;
  
  elements = [];
  
  id = 0;
  
  elementFactory = function(domElement) {
    var el, item, _i, _len;
    for (_i = 0, _len = elements.length; _i < _len; _i++) {
      item = elements[_i];
      if (item.domElement === domElement) {
        return item;
      }
    }
    el = new Element(domElement);
    elements.push(el);
    return el;
  };
  
  module.exports = function(selector, context, tag) {
    var element, _i, _len, _results;
    if (context == null) {
      context = doc;
    }
    if (objectUtils.isString(selector)) {
      selector = select(selector, context, tag);
    } else if (!(objectUtils.isElement(selector) || objectUtils.isArray(selector))) {
      throw 'not a valid element object or selector';
    }
    if (objectUtils.isArray(selector)) {
      _results = [];
      for (_i = 0, _len = selector.length; _i < _len; _i++) {
        element = selector[_i];
        if (objectUtils.isElement(element)) {
          _results.push(elementFactory(element));
        }
      }
      return _results;
    } else if (selector != null) {
      return elementFactory(selector);
    } else {
      return null;
    }
  };
  
  Element = (function() {
  
    function Element(domElement) {
      this.domElement = domElement;
      this.anim = null;
      this.id = this.domElement.id;
      this._id = id++;
      this.tagName = this.domElement.tagName;
    }
  
    Element.prototype.width = function(value) {
      if (value != null) {
        this.setStyle('width', value);
        if (this.domElement.width != null) {
          this.domElement.width = value;
        }
        return this;
      } else {
        return this.domElement.offsetWidth;
      }
    };
  
    Element.prototype.height = function(value) {
      if (value != null) {
        this.setStyle('height', value);
        if (this.domElement.height != null) {
          this.domElement.height = value;
        }
        return this;
      } else {
        return this.domElement.offsetHeight;
      }
    };
  
    Element.prototype.opacity = function(value) {
      if (value != null) {
        this.setStyle('opacity', numberUtils.limit(parseFloat(value), 0, 1));
        return this;
      } else {
        return this.getStyle('opacity');
      }
    };
  
    Element.prototype.offset = function() {
      return {
        top: this.domElement.offsetTop,
        left: this.domElement.offsetLeft
      };
    };
  
    Element.prototype.position = function() {
      var el, left, top;
      top = this.domElement.offsetTop;
      left = this.domElement.offsetLeft;
      if ((el = this.domElement).offsetParent) {
        while ((el = el.offsetParent)) {
          top += el.offsetTop;
          left += el.offsetLeft;
        }
      }
      return {
        top: top,
        left: left
      };
    };
  
    Element.prototype.hasClass = function(clas) {
      return classList.hasClass(this.domElement, clas);
    };
  
    Element.prototype.matchClass = function(clas) {
      return classList.matchClass(this.domElement, clas);
    };
  
    Element.prototype.addClass = function(clas) {
      classList.addClass(this.domElement, clas);
      return this;
    };
  
    Element.prototype.removeClass = function(clas) {
      classList.removeClass(this.domElement, clas);
      return this;
    };
  
    Element.prototype.toggleClass = function(clas) {
      classList.toggleClass(this.domElement, clas);
      return this;
    };
  
    Element.prototype.replaceClass = function(clasOld, clasNew) {
      classList.replaceClass(this.domElement, clasOld, clasNew);
      return this;
    };
  
    Element.prototype.addTemporaryClass = function(clas, duration) {
      classList.addTemporaryClass(this.domElement, clas, duration);
      return this;
    };
  
    Element.prototype.getText = function() {
      return text.getText(this.domElement);
    };
  
    Element.prototype.setText = function(value) {
      text.setText(this.domElement, value);
      return this;
    };
  
    Element.prototype.getHTML = function() {
      return this.domElement.innerHTML;
    };
  
    Element.prototype.setHTML = function(value) {
      this.domElement.innerHTML = value;
      return this;
    };
  
    Element.prototype.getStyle = function(property) {
      return css.getStyle(this.domElement, property);
    };
  
    Element.prototype.getNumericStyle = function(property) {
      return css.getNumericStyle(this.domElement, property);
    };
  
    Element.prototype.setStyle = function(property, value) {
      css.setStyle(this.domElement, property, value);
      return this;
    };
  
    Element.prototype.clearStyle = function(property) {
      css.clearStyle(this.domElement, property);
      return this;
    };
  
    Element.prototype.on = function(type, callback, data) {
      event.on(this, type, callback, data);
      return this;
    };
  
    Element.prototype.off = function(type, callback) {
      event.off(this, type, callback);
      return this;
    };
  
    Element.prototype.one = function(type, callback, data) {
      event.one(this, type, callback, data);
      return this;
    };
  
    Element.prototype.animate = function() {
      var _ref;
      return (_ref = this.anim) != null ? _ref : this.anim = animate(this.domElement, true);
    };
  
    Element.prototype.getAttribute = function(type) {
      return this.domElement.getAttribute(type);
    };
  
    Element.prototype.setAttribute = function(type, value) {
      this.domElement.setAttribute(type, value);
      return this;
    };
  
    Element.prototype.find = function(selector) {
      return module.exports(selector, this);
    };
  
    Element.prototype.parent = function(asElement) {
      if (asElement == null) {
        asElement = true;
      }
      if (asElement) {
        return new Element(this.domElement.parentNode);
      } else {
        return this.domElement.parentNode;
      }
    };
  
    Element.prototype.children = function(asElement) {
      var child, _i, _len, _ref, _results;
      if (asElement == null) {
        asElement = true;
      }
      _ref = this.domElement.childNodes;
      _results = [];
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        child = _ref[_i];
        if ((child != null ? child.nodeType : void 0) === 1) {
          _results.push(asElement ? new Element(child) : child);
        }
      }
      return _results;
    };
  
    Element.prototype.firstChild = function(asElement) {
      if (asElement == null) {
        asElement = true;
      }
      if (asElement) {
        return new Element(this.domElement.firstChild);
      } else {
        return this.domElement.firstChild;
      }
    };
  
    Element.prototype.lastChild = function(asElement) {
      if (asElement == null) {
        asElement = true;
      }
      if (asElement) {
        return new Element(this.domElement.lastChild);
      } else {
        return this.domElement.lastChild;
      }
    };
  
    Element.prototype.appendChild = function(element) {
      return this.domElement.appendChild(element.domElement || element);
    };
  
    Element.prototype.removeChild = function(element) {
      return this.domElement.removeChild(element.domElement || element);
    };
  
    Element.prototype.replaceChild = function(newElement, oldElement) {
      this.domElement.replaceChild(newElement.domElement || newElement, oldElement.domElement || oldElement);
      return oldElement;
    };
  
    Element.prototype.remove = function() {
      return this.parent().removeChild(this.domElement);
    };
  
    Element.prototype.insertBefore = function(element, referenceElement) {
      return this.domElement.insertBefore(element.domElement || element, referenceElement.domElement || referenceElement);
    };
  
    Element.prototype.clone = function(deep, asElement) {
      if (asElement == null) {
        asElement = true;
      }
      if (asElement) {
        return new Element(this.domElement.clone(deep));
      } else {
        return this.domElement.clone(deep);
      }
    };
  
    Element.prototype.destroy = function(remove) {
      var idx, item, _i, _len, _results;
      if (remove == null) {
        remove = false;
      }
      event.offAll(this);
      if (this.anim != null) {
        if (this.anim.isRunning) {
          this.anim.keep = false;
        } else {
          this.anim.destroy();
        }
        this.anim = null;
      }
      if (remove) {
        this.domElement.parentNode.removeChild(this.domElement);
      }
      this.domElement = null;
      _results = [];
      for (idx = _i = 0, _len = elements.length; _i < _len; idx = ++_i) {
        item = elements[idx];
        if (item === this) {
          elements.splice(idx, 1);
        }
        break;
      }
      return _results;
    };
  
    return Element;
  
  })();
  
});
require.register('models/model', function(module, exports, require) {
  var Model, dispatcher;
  
  dispatcher = require('pi/event').dispatcher;
  
  module.exports = Model = (function() {
  
    function Model() {
      var dflt;
      dispatcher(this);
      this._attributes = {};
      dflt = {
        mode: null,
        lesson: null,
        slide: 0,
        totalSlides: 0
      };
      this.set(dflt, true);
    }
  
    Model.prototype.get = function(attribute) {
      return this._attributes[attribute];
    };
  
    Model.prototype.set = function(attributes, silent) {
      var attribute, old, value;
      if (!attributes) {
        return this;
      }
      for (attribute in attributes) {
        value = attributes[attribute];
        if (this._attributes[attribute] !== value) {
          old = this._attributes[attribute];
          this._attributes[attribute] = value;
          if (!silent) {
            this.trigger("change:" + attribute, {
              value: value,
              old: old
            });
          }
        }
      }
      return this;
    };
  
    Model.prototype.toJSON = function() {
      var attr, o, value, _ref;
      o = {};
      _ref = this._attributes;
      for (attr in _ref) {
        value = _ref[attr];
        o[attr] = value;
      }
      return o;
    };
  
    return Model;
  
  })();
  
});
require.register('models/modelstate', function(module, exports, require) {
  
  exports.MODE_PRESENTATION = 'presentation';
  
  exports.MODE_REFERENCE = 'reference';
  
});
require.register('controllers/controller', function(module, exports, require) {
  var Controller, state;
  
  state = require('models/modelstate');
  
  module.exports = Controller = (function() {
  
    function Controller(model) {
      this.model = model;
      this.model.set({
        'lesson': /lesson(\d)/.exec(document.location.href)[1]
      });
      this.changeMode(state.MODE_REFERENCE);
    }
  
    Controller.prototype.changeMode = function(value) {
      var mode;
      mode = value || (this.model.get('mode') === state.MODE_REFERENCE ? state.MODE_PRESENTATION : state.MODE_REFERENCE);
      return this.model.set({
        mode: mode
      });
    };
  
    Controller.prototype.nextSlide = function() {
      var current;
      current = this.model.get('slide');
      if (current + 1 < this.model.get('totalSlides')) {
        return this.model.set({
          slide: current + 1
        });
      }
    };
  
    Controller.prototype.prevSlide = function() {
      var current;
      current = this.model.get('slide');
      if (current - 1 >= 0) {
        return this.model.set({
          slide: current - 1
        });
      }
    };
  
    return Controller;
  
  })();
  
});
require.register('pi/dom/index', function(module, exports, require) {
  
  exports.css = require('./css');
  
  exports.select = require('./select');
  
  exports.classList = require('./classlist');
  
  exports.text = require('./text');
  
  exports.element = require('./element');
  
  exports.ready = require('./ready');
  
});
require.register('views/lessonmenu', function(module, exports, require) {
  var LessonMenu, doc, element;
  
  element = require('pi/dom/element');
  
  doc = window.document;
  
  module.exports = LessonMenu = (function() {
  
    function LessonMenu(model, el, outline) {
      var item, _i, _len;
      this.model = model;
      this.el = el;
      this.elOutline = element(doc.createElement('ul'));
      this.elOutline.addClass('outline');
      for (_i = 0, _len = outline.length; _i < _len; _i++) {
        item = outline[_i];
        this.elOutline.domElement.innerHTML += "<li class='outline-level-" + (+item.domElement.nodeName[1] - 1) + "'><a href='#" + (item.getAttribute('id')) + "'>" + (item.getText()) + "</a></li>";
      }
      this.initMenu(parseInt(this.model.get('lesson'), 10));
    }
  
    LessonMenu.prototype.initMenu = function(idx) {
      var elActive, elItems, elLink, elList;
      elList = this.el.find('ul')[0];
      elItems = this.el.find('li', elList);
      elActive = element(doc.createElement('li'));
      elLink = element('a', elItems[idx - 1])[0];
      while (elLink.domElement.firstChild) {
        elActive.appendChild(elLink.domElement.firstChild);
      }
      elActive.appendChild(this.elOutline);
      elActive.appendChild(this.elOutline);
      elActive.addClass('active');
      return elList.replaceChild(elActive, elItems[idx - 1]);
    };
  
    return LessonMenu;
  
  })();
  
});
require.register('views/mainview', function(module, exports, require) {
  var LessonMenu, MainView, app, doc, dom, element, event, state,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };
  
  app = window.app;
  
  event = require('pi/event');
  
  element = require('pi/dom/element');
  
  dom = require('pi/dom');
  
  state = require('models/modelstate');
  
  LessonMenu = require('./lessonmenu');
  
  doc = window.document;
  
  module.exports = MainView = (function() {
  
    function MainView(model, controller, el) {
      var menu;
      this.model = model;
      this.controller = controller;
      this.el = el;
      this.onKeyDown = __bind(this.onKeyDown, this);
  
      this.onModeClick = __bind(this.onModeClick, this);
  
      this.onSlideChange = __bind(this.onSlideChange, this);
  
      this.onModeChange = __bind(this.onModeChange, this);
  
      this.presentationTick = __bind(this.presentationTick, this);
  
      this.html = doc.documentElement;
      this.elLesson = this.el.find('article')[0];
      this.elProgress = this.el.find('#progress')[0];
      this.elCountdown = this.elProgress.find('p')[0];
      menu = new LessonMenu(this.model, this.el.find('nav')[0], this.el.find('.outline'));
      this.btnPresentation = this.el.find('#btnPresentation')[0];
      this.slides = [dom.select('header', this.el)[0]].concat(dom.select('section', this.el));
      log(this.slides);
      this.examples = this.el.find('.example-container')[0];
      this.partials = [];
      this.current = null;
      this.start = 0;
      this.last = 0;
      this.countdown = parseInt(this.elCountdown.getText(), 10);
      this.model.set({
        totalSlides: this.slides.length
      });
      this.setMode({
        value: this.model.get('mode')
      });
      event.on(this.btnPresentation, 'click', this.onModeClick);
      this.model.on('change:mode', this.onModeChange);
      this.model.on('change:slide', this.onSlideChange);
      event.on(doc, 'keyup', this.onKeyDown);
    }
  
    MainView.prototype.setMode = function(data) {
      if (data.old) {
        dom.classList.removeClass(this.html, "" + data.old + "-mode");
      }
      dom.classList.addClass(this.html, "" + data.value + "-mode");
      if (data.value === state.MODE_PRESENTATION) {
        this.start = this.last = +(new Date);
        return this.presentationTick();
      }
    };
  
    MainView.prototype.changeSlide = function(data) {
      var p,
        _this = this;
      log(data, this.slides[data.old]);
      this.elLesson.addClass('hide');
      setTimeout(function() {
        dom.classList.removeClass(_this.slides[data.old], 'current');
        dom.classList.addClass(_this.slides[data.value], 'current');
        return _this.elLesson.removeClass('hide');
      }, 250);
      this.current = this.slides[data.value];
      this.partials = [];
      p = dom.select('.partial:not(.show)', this.current);
      if (p != null) {
        return this.partials = p.length ? p : [p];
      }
    };
  
    MainView.prototype.setProgress = function(value) {
      return this.elProgress.width("" + value + "%");
    };
  
    MainView.prototype.showPartial = function() {
      return dom.classList.addClass(this.partials.shift(), 'show');
    };
  
    MainView.prototype.presentationTick = function(time) {
      var now;
      now = +(new Date);
      if (now - this.last > 60000) {
        this.elCountdown.setText(--this.countdown);
        this.last = now;
      }
      if (this.countdown) {
        return window.requestAnimationFrame(this.presentationTick);
      }
    };
  
    MainView.prototype.onModeChange = function(event) {
      return this.setMode(event.data);
    };
  
    MainView.prototype.onSlideChange = function(event) {
      this.changeSlide(event.data);
      return this.setProgress(event.data.value / this.model.get('totalSlides') * 100);
    };
  
    MainView.prototype.onModeClick = function(event) {
      return this.controller.changeMode();
    };
  
    MainView.prototype.onKeyDown = function(event) {
      switch (event.domEvent.keyCode) {
        case 39:
          if (this.partials.length) {
            return this.showPartial();
          } else {
            return this.controller.nextSlide();
          }
          break;
        case 37:
          return this.controller.prevSlide();
        case 27:
          return this.controller.changeMode();
      }
    };
  
    return MainView;
  
  })();
  
});
require.register('pi/utils/log', function(module, exports, require) {
  var initialized, locations, timestamp,
    __slice = [].slice;
  
  initialized = false;
  
  timestamp = true;
  
  locations = '^http(|s):\/\/dev|^http(|s):\/\/localhost';
  
  exports.init = function(config) {
    if (config != null) {
      timestamp = config.timestamp || timestamp;
      locations = config.locations && new RegExp(locations + '|' + config.locations.join('|'), 'i');
      window.debug = !!(document.location.href.match(locations)) || !!(document.location.hash.match(/debug/));
      window.log = window.debug ? exports.log : (function() {});
    }
    return initialized = true;
  };
  
  exports.log = function() {
    var args, d, t;
    args = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
    if (!initialized) {
      exports.init();
    }
    if (window.debug) {
      try {
        d = new Date();
        t = timestamp ? "" + (d.getHours()) + ":" + (d.getMinutes()) + ":" + (d.getSeconds()) + ":" + (d.getMilliseconds()) : '';
        if (window.console) {
          return console.log(t, args);
        }
      } catch (error) {
  
      }
    }
  };
  
});
require.register('main', function(module, exports, require) {
  var Controller, MainView, Model, doc, element, win;
  
  require('pi/utils/polyfill');
  
  require('pi/dom/ready');
  
  element = require('pi/dom/element');
  
  Model = require('models/model');
  
  Controller = require('controllers/controller');
  
  MainView = require('views/mainview');
  
  win = window;
  
  doc = window.document;
  
  exports.init = function(config) {
    var controller, mainView, model;
    require('pi/utils/log').init(config.log);
    model = new Model;
    controller = new Controller(model);
    mainView = new MainView(model, controller, element('body')[0]);
    return hljs.initHighlightingOnLoad();
  };
  
});