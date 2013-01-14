<?php include '../_header.php' ?>
<article>
	<header class="current">
		<h4>lesson 5</h4>
		<h1>JS <span>part 2</span></h1>
	</header>

	<section>
		<h2 class="outline" id="dom">DOM</h2>
		<p>One of the primary roles of JavaScript in the browser is as a scripting interface to the Document Object Model (DOM). The DOM is an API for HTML documents, exposing a structural representation of the document, and enabling modification of its content and visual presentation.
		</p>
	</section>

	<section>
		<h3 class="outline" id="dataTypes">data types</h3>
		<p>The API exposes several different objects and data types, each with their own set of properties and methods.
		</p>
	</section>

	<section>
		<h4 class="outline" id="window">window</h4>
		<p>The <code>window</code> object represents the default parent view for a browser page, as well as being the browser's global JavaScript object. Here are some of the key properties and methods available:
		</p>
	</section>

	<section>
		<h5 class="outline" id="windowLocation">location</h5>
		<p><code>window.location</code> returns an object containing information about the URL of the document:
		</p>
		<ul class="partial">
			<li><code>window.location.href</code>: entire URL</li>
			<li><code>window.location.pathname</code>: path relative to the host</li>
			<li><code>window.location.hash</code>: part of the URL after the # symbol</li>
			<li><code>window.location.search</code>: part of the URL after a ? (query) symbol </li>
		</ul>
		<pre class="partial"><code class="language-js">
console.log(window.location.href); // "http://skole.apt10.kjapt.no/lesson5/"
console.log(window.location.pathname); // "/lesson5/"
		</code></pre>
	</section>

	<section>
		<h5 class="outline" id="windowNavigator">navigator</h5>
		<p><code>window.navigator</code> returns an object containing information about the browser:
		</p>
		<ul class="partial">
			<li><code>window.navigator.userAgent</code>: user agent string</li>
			<li><code>window.navigator.plugins</code>: array of installed browser plugins</li>
		</ul>
		<pre class="partial"><code class="language-js">
console.log(window.navigator.ua);
//"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_3) ... Safari/534.55.3"
		</code></pre>
	</section>

	<section>
		<h5 class="outline" id="windowHistory">history</h5>
		<p><code>window.history</code> returns an object that enables manipulation of the browser's session history, including changing the URL without causing a page refresh:
		</p>
		<ul class="partial">
			<li><code>window.history.back()</code>: go to previous page in session history</li>
			<li><code>window.history.forward()</code>: go to next page in session history</li>
			<li><code>window.history.pushState(data, title, url)</code>: add location to session history stack</li>
			<li><code>window.history.replaceState(data, title, url)</code>: update current location entry</li>
		</ul>
		<p class="rule partial">
			it's possible to fallback to <code>location.hash</code> changes in order to simulate history session management
		</p>
		<div class="partial compatibility"><span class="no">oldIE</span><span class="no">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="no">Android</span></div>
	</section>

	<section>
		<h5 class="outline" id="windowScroll">scroll properties</h5>
		<p>The following <code>window</code> properties store information regarding the window's scroll state:
		</p>
		<ul class="partial">
			<li><code>window.scrollY</code>: number of pixels the document has scrolled vertically</li>
			<li><code>window.scrollX</code>: number of pixels the document has scrolled horizontally</li>
			<li><code>window.scrollMaxY</code>: maximum vertical scroll offset in pixels</li>
			<li><code>window.scrollMaxX</code>: maximum horizontal scroll offset in pixels</li>
			<li><code>window.scrollTo(x, y)</code>: scroll to a particular coordinate in the document</li>
		</ul>
	</section>

	<section>
		<h5 class="outline" id="windowTimer">timer methods</h5>
		<p>The following <code>window</code> methods can be used to execute functions after a specified delay:
		</p>
		<ul class="partial">
			<li><code>window.setTimeout(callback, delay)</code>: executes the callback after delay in milliseconds (returns unique id)</li>
			<li><code>window.setInterval(callback, interval)</code>: executes the callback each interval in milliseconds (returns unique id)</li>
			<li><code>window.clearTimeout(id)</code>: clears delay set by <code>window.setTimeout()</code></li>
			<li><code>window.clearInterval(id)</code>: clears interval set by <code>window.setInterval()</code></li>
		</ul>
		<p class="rule partial">
			delays and intervals are approximate: the minimum delay/interval varies by browser (usually 4ms), with lesser values rounded up; execution may be delayed while the browser performs complex computations
		</p>
	</section>
	<section>
		<p><code>window.requestAnimationFrame</code> is a new API for efficiently executing interval code, allowing browsers to better control timing, including throttling requests for content in hidden tabs:
		</p>
		<pre class="partial"><code class="language-js">
// will be called approximately every 16ms (60HZ)
function tick() {
  doSomething();
  doSomethingElse();
  // vendor prefixes required
  window.requestAnimationFrame(tick);
}
tick();
		</code></pre>
		<p class="partial rule">
			it's possible to <a href="https://gist.github.com/1579671" target="_blank">polyfill</a> this behaviour with <code>window.setTimeout()</code> for browsers that don't yet support it
		</p>
		<div class="partial compatibility"><span class="no">oldIE</span><span class="no">IE</span><span class="yes">Chrome</span><span class="yes">Firefox</span><span class="no">Safari</span><span class="no">iOS</span><span class="no">Android</span></div>
	</section>

	<section>
		<h4 class="outline" id="document">document</h4>
		<p>The <code>document</code> object serves as the entry point for a page's DOM tree, and contains a direct reference to some of the main page elements:
		</p>
		<ul class="partial">
			<li><code>document.documentElement</code>: returns the <code>&lt;html&gt;</code> element</li>
			<li><code>document.head</code>: returns the <code>&lt;head&gt;</code> element</li>
			<li><code>document.body</code>: returns the <code>&lt;body&gt;</code> element</li>
		</ul>
	</section>

	<section>
		<h4 class="outline" id="element">element</h4>
		<p><code>element</code> objects generally make up the bulk of a page's DOM tree, and include all the element types we are familiar with: <code>div</code>, <code>span</code>, <code>p</code>, <code>ul</code>, etc. An <code>element</code> inherits functionality for navigating/accessing connected nodes:
		</p>
	</section>
	<section>
		<ul>
			<li><code>childNodes</code>: live collection of child nodes</li>
			<li><code>firstChild</code>: first direct child node</li>
			<li><code>lastChild</code>: last direct child node</li>
			<li><code>nextSibling</code>: immediately following node</li>
			<li><code>previousSibling</code>: immediately preceding node</li>
			<li><code>parentNode</code>: parent node</li>
			<li><code>nodeType</code>: number representing node type (1 for <code>element</code>)</li>
			<li><code>nodeName</code>: name of node (LI, P, etc)</li>
			<li><code>appendChild(node)</code>: insert a node as last child</li>
			<li><code>insertBefore(newNode, referenceNode)</code>: inserts the specified node (as a child) before a reference child</li>
			<li><code>removeChild(node)</code>: remove a child node</li>
			<li><code>replaceChild(node)</code>: replace a child node with another</li>
			<li><code>cloneNode(deep)</code>: clone a node, and (optionally) all of its contents</li>
			<li><code>haschildNodes()</code>: check if any child nodes are present</li>
		</ul>
	</section>
	<section>
		<p><code>element</code>s also provide the ability to read and modify their content and visual state:
		</p>
	</section>
	<section>
		<ul class="">
			<li><code>attributes</code>: returns all attributes</li>
			<li><code>id</code>: get/set value of <code>id</code> attribute</li>
			<li><code>className</code>: get/set value of <code>class</code> attribute</li>
			<li><code>style</code>: get/set value of <code>style</code> attribute</li>
			<li><code>clientHeight/clientWidth</code>: inner dimensions</li>
			<li><code>offsetHeight/offsetWidth</code>: dimensions including padding and borders</li>
			<li><code>offsetTop/offsetLeft</code>: offset from border to parent's border</li>
			<li><code>offsetParent</code>: parent element from which all offset calculations are made</li>
			<li><code>scrollHeight/scrollWidth</code>: total dimensions including overflow</li>
			<li><code>scrollTop/scrollLeft</code>: scroll offset</li>
			<li><code>innerHTML</code>: get/set HTML content</li>
			<li><code>textContent</code>: get/set text content</li>
			<li><code>getAttribute(name)</code>: retrieve the value of named attribute</li>
			<li><code>setAttribute(name, value)</code>: set the value of named attribute</li>
			<li><code>hasAttribute(name)</code>: check if has named attribute</li>
			<li><code>removeAttribute(name)</code>: remove the named attribute</li>
		</ul>
	</section>

	<section>
		<h3 class="outline" id="events">events</h3>
		<p><code>window</code>, <code>document</code>, and all <code>element</code>s emit several events that can be listened for via JavaScript. By employing a registration API, it is easy to add and remove multiple event handlers to objects:
		</p>
		<pre class="partial"><code class="language-js">
element.addEventListener('click', clickHandler, false);
function clickHandler(evt) {
  console.log('clicked');
  element.removeEventListener('click', clickHandler);
}
		</code></pre>
	</section>
	<section>
		<p>Naturally, oldIE did things a little differently, so a more cross-browser approach requires a little more work:
		</p>
	</section>
	<section>
		<pre class=""><code class="language-js">
if (element.addEventListener) {
  element.addEventListener('click', clickHandler, false);
} else {
  element.attachEvent('onclick', clickHandler);
}
function clickHandler(evt) {
  console.log('clicked');
  if (element.removeEventListener) {
    element.removeEventListener('click', clickHandler);
  } else {
    element.detachEvent('onclick', clickHandler);
  }
}
		</code></pre>
		<p class="rule ref">
			using a library is recommended for robust event handling across platforms
		</p>
	</section>

	<section>
		<h4 class="outline" id="bubbling">bubbling</h4>
		<p>Because of the DOM's structure, events are able to "bubble" up the tree, ultimately arriving at <code>window</code>. In practice, this means that it is possible for a parent element to listen for events triggered on one of it's children. This event <em>delegation</em> can be more efficient by keeping the number of event registrations to a minimum:
		</p>
		<pre class="partial"><code class="language-js">
// parent is a menu of buttons
parent.addEventListener('click', clickHandler, false);
function clickHandler(evt) {
  console.log('clicked', evt.target); // clicked, button element
}
		</code></pre>
	</section>

	<section>
		<h4 class="outline" id="domReady">DOM ready</h4>
		<p>The <code>document</code> object emits a <em><code>load</code></em> event when a page is rendered after all images and assets have been downloaded. However, instead of waiting for all assets to load, it is often preferable to execute code as soon as the page is parsed and the DOM hierarchy has been fully constructed. Modern browsers emit a <em><code>DOMContentLoaded</code></em> event for this reason, and we can see the result in this inspector screen-shot (blue line is <em><code>DOMContentLoaded</code></em>, red is <em><code>load</code></em>):
		</p>
	</section>
	<section>
		<img class="" src="../assets/images/dom-ready.jpg" alt="dom ready">
		<p class="rule ref">
			using a library is recommended in order to enable <em><code>DOMContentLoaded</code></em> behaviour in oldIE
		</p>
	</section>

	<section>
		<h3 class="outline" id="workingWithElements">working with elements</h3>
		<p>Most JavaScript in the browser involves the creation and manipulation of DOM <code>element</code>s.
		</p>
	</section>

	<section>
		<h4 class="outline" id="elementSelection">selection</h4>
		<p>Before an <code>element</code> can be modified, it must first be retrieved from the DOM, and it turns out there are several ways to select an <code>element</code>:
		</p>
	</section>

	<section>
		<h5 class="outline" id="selectionByID">by ID</h5>
		<p>Because ids are unique, selecting an <code>element</code> by id is the most efficient way of retrieval from the DOM:
		</p>
		<pre class="partial"><code class="language-js">
var element = document.getElementById('elementId');
		</code></pre>
	</section>

	<section>
		<h5 class="outline" id="selectionByTag">by tag name</h5>
		<p>Selecting all elements of the same tag type returns a collection of <code>element</code>s:
		</p>
		<pre class="partial"><code class="language-js">
var elements = document.getElementsByTagName('p');
		</code></pre>
		<p class="rule partial">
			many element collections returned by DOM APIs are "live", and will be updated if matching elements are added or removed from the DOM
		</p>
	</section>

	<section>
		<h5 class="outline" id="selectionByClass">by class name</h5>
		<p>Selecting all elements with the same class name returns a collection of <code>element</code>s:
		</p>
		<pre class="partial"><code class="language-js">
var elements = document.getElementsByClassName('my-class');
var childElements = element.getElementsByClassName('my-class');
		</code></pre>
		<p class="rule partial">
			enabling oldIE compatibility requires first selecting all elements on the page (<code>document.getElementsByTagName('*')</code>), and is therefore quite inefficient
		</p>
		<div class="partial compatibility"><span class="no">oldIE</span><span class="yes">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div>
	</section>

	<section>
		<h5 class="outline" id="selectionQuery">by CSS selector</h5>
		<p>Thanks to the popularity of jQuery (Sizzle selector engine), browsers added similar ability to select <code>element</code>s using CSS selector syntax. Both <code>document</code> and <code>element</code>s inherit <em><code>querySelector()</code></em> for selecting the first matching <code>element</code>, and <em><code>querySelectorAll()</code></em> for matching all <code>element</code>s:
		</p>
		<pre class="partial"><code class="language-js">
var element = document.querySelector('p.red');
var elements = element.querySelectorAll('li&gt;a');
		</code></pre>
		<p class="partial rule">
			<em><code>querySelectorAll()</code></em> returns a non-live collection of <code>element</code>s
		</p>
		<div class="partial compatibility"><span class="no">IE7</span><span class="yes">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div>
	</section>

	<section>
		<h4 class="outline" id="elementClassAttribute">class attribute</h4>
		<p>Manipulating (adding/removing) class attributes in order to apply styles to an <code>element</code> is a very common task, made more difficult by that fact that <code>element.className</code> only returns a space delimited string of classes. Fortunately, it is made easier in modern browsers by the addition of <code>element.classList</code>, which returns a list of class tokens, and supports <code>add()</code>, <code>remove()</code>, <code>toggle()</code>, and <code>contains()</code> operations:
		</p>
		<pre class="partial"><code class="language-js">
element.classList.add('myClass');
element.classList.toggle('myOtherClass');
console.log(element.className); // 'myClass myOtherClass'
element.classList.remove('myClass');
console.log(element.className); // 'myOtherClass'
		</code></pre>
		<div class="partial compatibility"><span class="no">oldIE</span><span class="no">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div>
	</section>

	<section>
		<h4 class="outline" id="elementStyleAttribute">style attribute</h4>
		<p>Directly manipulating an <code>element</code>'s CSS style rules is another very common task, especially when animating an <code>element</code>'s properties with JavaScript.
		</p>
	</section>

	<section>
		<h5 class="outline" id="elementComputedStyle">computed style</h5>
		<p>Although it's simple enough to read values from the <code>element.style</code> object, it will only include values for properties directly set on the <code>element</code>, and not those applied with CSS. In order to read <strong>all</strong> applied styles, we need to use <code>window.getComputedStyle()</code>:
		</p>
	</section>
	<section>
		<pre class=""><code class="language-js">
#myElement {
  background-color: black;
}

var element = document.getElementById('myElement');
element.style.color = '#ff0000';
var style = window.getComputedStyle(element);
var color = style.getPropertyValue('color');
var bgColor = style.getPropertyValue('background-color');
console.log(color, bgColor); // "rgba(255,0,0,1), rgba(0,0,0,1)"
		</code></pre>
		<p class="rule partial">
			oldIE doesn't support <code>window.getComputedStyle()</code>, but the equivalent can be achieved with <code>element.currentStyle</code>
		</p>
		<div class="partial compatibility"><span class="no">oldIE</span><span class="yes">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div>
	</section>

	<section>
		<h4 class="outline" id="elementSizePosition">size and position</h4>
		<p>As outlined above, there are several dimension and placement properties available:
		</p>
	</section>
	<section>
		<pre class=""><code class="language-js">
function getPosition(el) {
  var top = el.offsetTop;
  var left = el.offsetLeft;
  if (el.offsetParent) {
    while (el = el.offsetParent) {
      top += el.offsetTop;
      left += el.offsetLeft;
    }
  }
  return {top: top, left: left};
}

// assume element's parent is offset 20px
var element = document.getElementById('myElement');
console.log(element.offsetWidth, element.offsetHeight); // 235, 20
console.log(element.offsetTop, element.offsetLeft); // 0, 0
console.log(getPosition(element)); //{top:0, left:20}
		</code></pre>
	</section>

	<section>
		<h5 class="outline" id="viewportSize">viewport size</h5>
		<p>With regards to the dimension of the current page, there is only one property that is consistent across devices:
		</p>
		<pre class="partial"><code class="language-js">
var viewportWidth = document.documentElement.clientWidth);
var viewportHeight = document.documentElement.clientHeight);
		</code></pre>
	</section>

	<section>
		<h4 class="outline" id="elementManipulation">manipulation</h4>
		<p>Manipulating the order and composition of the DOM tree is as easy as calling <code>appendChild()</code>, <code>insertBefore()</code>, <code>removeChild()</code>, etc on the <code>document</code> or <code>element</code> directly:
		</p>
		<pre class="partial"><code class="language-js">
var element = document.getElementById('myElement');
var otherElement = document.getElementById('myOtherElement');
otherElement.appendChild(element);
		</code></pre>
		<p class="partial rule">
			appending an existing <code>element</code> elsewhere in the tree will automatically remove it from it's current location
		</p>
	</section>

	<section>
		<h4 class="outline" id="elementCreation">creation</h4>
		<p>Creating a new element at runtime is fairly straightforward, and is most commonly achieved in one of three ways:
		</p>
	</section>

	<section>
		<h5 class="outline" id="createElement">createElement</h5>
		<p>The <code>document.createElement(tagName)</code> method creates an <code>element</code> of the given type:
		</p>
		<pre class="partial"><code class="language-js">
var element = document.createElement('div');
		</code></pre>
	</section>

	<section>
		<h5 class="outline" id="createFragment">createDocumentFragment</h5>
		<p>The <code>document.createDocumentFragment()</code> method creates an empty parent DOM node in memory to which child <code>element</code>s may be attached. Because it is not part of the DOM tree, appending children to it won't cause unnecessary page reflows:
		</p>
		<pre class="partial"><code class="language-js">
var items = ['item1', 'item2', 'item3'];
var ul = document.getElementsByTagName('ul')[0];
var frag = document.createDocumentFragment();
for (var i = 0, n = items.length; i &lt; n; i++) {
  var li = document.createElement('li');
  li.textContent = items[i];
  frag.appendChild(li);
}
ul.appendChild(frag);
		</code></pre>
	</section>

	<section>
		<h5 class="outline" id="elementInnerHTML">innerHTML</h5>
		<p>Modifying <code>element.innerHTML</code> can also be used to generate new elements, though, because it must be formatted as a string, it can be rather cumbersome:
		</p>
		<pre class="partial"><code class="language-js">
var ul = document.getElementsByTagName('ul')[0];
ul.innerHTML = "&lt;li&gt;item1&lt;/li&gt;&lt;li&gt;item2&lt;/li&gt;&lt;li&gt;item3&lt;/li&gt;"
		</code></pre>
		<p class="partial rule">
			be aware that inserting user generated content directly into <code>innerHTML</code> may enable the insertion of unsafe code via <code>&lt;script&gt;</code>
		</p>
	</section>

	<section>
		<h2 class="outline" id="json">JSON</h2>
		<p>JSON (JavaScript Object Notation) is a data-interchange format that closely resembles JavaScript object notation. JSON is capable of representing numbers, booleans, strings, and <code>null</code>, as well as arrays and objects composed of these values.
		</p>
		<p class="partial rule">
			oldIE doesn't support native JSON parsing, so include a library like <a href="http://bestiejs.github.com/json3/" target="_blank">json3</a> to enable support
		</p>
		<div class="partial compatibility"><span class="no">oldIE</span><span class="yes">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div>
		<p>
		</p>
	</section>

	<section>
		<p>JSON behaviour is encapsulated in the native <code>JSON</code> object, which contains two methods for converting to and from JSON-formatted data:
		</p>
	</section>

	<section>
		<h3 class="outline" id="jsonParse">Parse()</h3>
		<p>The <code>JSON.parse()</code> method takes a JSON-formatted string and converts it to JavaScript values:
		</p>
		<pre class="partial"><code class="language-js">
var jsonString = '{"prop1":true, "prop2":["item1","item2","item3"]}'
var obj = JSON.parse(jsonString);
console.log(obj.prop2[1]); //"item2"
		</code></pre>
	</section>

	<section>
		<h3 class="outline" id="jsonStringify">Stringify()</h3>
		<p>The <code>JSON.stringify()</code> method takes JavaScript values and converts to a JSON-formatted string.
		</p>
		<pre class="partial"><code class="language-js">
var obj = {};
obj.prop1 = true;
obj.prop2 = ["item1","item2","item3"];
var jsonString = JSON.stringify(obj);
console.log(jsonString);
//"{'prop1':true,'prop2':'["item1","item2","item3"]'}"
		</code></pre>
	</section>

	<section>
		<h4 class="outline" id="jsonToJson" style="text-transform: none">toJSON</h4>
		<p>If an object being stringified has a method called <code>toJSON()</code>, then the return value will be used to represent the object in JSON notation:
		</p>
		<pre class="partial"><code class="language-js">
var obj = {};
obj.prop1 = true;
obj.toJSON = function() {
  return false;
}
var jsonString = JSON.stringify(obj);
console.log(jsonString); //"false"
		</code></pre>
	</section>

	<section>
		<h2 class="outline" id="ajax">AJAX</h2>
		<p>AJAX (Asynchronous JavaScript + XML) is a term that describes a technique for asynchronously (without forcing a page refresh) communicating with a remote server. Although the 'X' stands for XML, AJAX calls can send and receive data in a variety of other formats, including JSON, HTML, and plain text. <span class="ref">Regardless of the format, the primary benefit of AJAX over other approaches is the ability to efficiently update parts of a page when needed based on user interaction.</span>
		</p>
	</section>

	<section>
		<h3 class="outline" id="xmlhttprequest">XMLHttpRequest</h3>
		<p>All AJAX calls start with an instance of the <code>XMLHttpRequest</code> object and a url/path from which to retrieve data:
		</p>
	</section>
	<section>
		<pre class=""><code class="language-js">
var request = new XMLHttpRequest();
// assign callback handler
request.onreadystatechange = function() {
  if (request.readyState === 4) {
    if (request.status === 200) {
      console.log(request.responseText);
    }
  }
}
request.open('GET', 'path/to/some/data', true);
request.send();
		</code></pre>
	</section>

	<section>
		<h3 class="outline" id="jsonp">JSON-P</h3>
		<p>Because of the potential for malicious code execution, certain types of data transfer via JavaScript is restricted by a <a href="https://developer.mozilla.org/En/Same_origin_policy_for_JavaScript" target="_blank">same-origin policy</a>. In practice, this means that retrieving data via AJAX from a different domain will be prevented.
		</p>
	</section>
	<section>
		<p>One method around this restriction is through the use of JSON-P. More of a technique than a specification, JSON-P uses a dynamically injected <code>&lt;script&gt;</code> tag to call out to a remote data service location. The response handler is passed to this remote script, and subsequently called with the requested JSON data when the loaded JavaScript is executed.
		</p>
		<p class="partial rule">
			because of a lack of specification and enforcement by the browser, JSON-P calls are inherently unsafe and hacky
		</p>
	</section>

	<section>
		<h3 class="outline" id="cors">CORS</h3>
		<p>An emerging solution to cross-domain data loading is CORS (Cross-Origin Resource Sharing). An extension to the XMLHttpRequest object, CORS allows browsers to make calls across domains by first asking the server for permission.</p>
		<p class="partial rule">CORS requires a server configured to intercept and respond to the authorization request-headers
		</p>
		<div class="partial compatibility"><span class="maybe">oldIE</span><span class="maybe">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div>
	</section>

	<section>
		<h2 class="pres">next week...js patterns</h2>
	</section>

	<footer>
		<div class="highlight">
			<h2 class="outline" id="links">Links</h2>
			<ul>
				<li><a href="https://developer.mozilla.org/en/DOM/XMLHttpRequest/Using_XMLHttpRequest" target="_blank">using XMLHttpRequest</a></li>
				<li><a href="http://json-p.org/" target="_blank">JSON-P</a></li>
				<li><a href="https://github.com/ded/reqwest" target="_blank">reqwest.js AJAX library</a></li>
				<li><a href="https://github.com/balupton/History.js/" target="_blank">history.js session management library</a></li>
				<li><a href="http://net.tutsplus.com/tutorials/javascript-ajax/from-jquery-to-javascript-a-reference/" target="_blank">from jQuery to JavaScript</a></li>
			</ul>
		</div>
	</footer>
</article>
<?php include '../_footer.php' ?>