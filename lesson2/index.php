<?php include '../_header.php' ?>
<article>
	<header class="current">
		<h4>lesson 2</h4>
		<h1>CSS <span>part 1</span></h1>
	</header>
	<section>
		<h2 class="outline" id="syntax">Syntax</h2>
	</section>
	<section>
		<p>
			Each style rule is made up of one selector and one declaration.
			The declaration defines one or more <code>property:value</code> pairs describing a specific style setting,
			and the selector identifies one or more elements to which those settings are to be applied.
		</p>
		<pre class="partial"><code class="language-css">
<em>selector</em> {
  <em>property</em>: <em>value</em>;
}
		</code></pre>
	</section>
	<section>
		<h3 class="outline" id="syntax-shorthand">Shorthand syntax</h3>
		<p>
			A handfull of properties can be written in either short- or longhand notation.
			<code>font</code>, <code>background</code>, <code>margin</code>, <code>padding</code>, <code>border</code>, <code>outline</code>, <code>list-style</code>, and <code>transition</code>
			all have sub-properties that can be written separately, or combined into a single property:
		</p>
	</section>
	<section>
		<pre class=""><code class="language-css">
<em>selector</em> {
  background-color: red;
  background-image: url('/images/red-tile.png');
  background-repeat: repeat;
  background-position: 0 0;
}

<em>selector</em> {
  background: red url('/images/red-tile.png') repeat 0 0;
}

<em>selector</em> {
  margin-top: 5px;
  margin-right: 10px;
  margin-bottom: 15px;
  margin-left: 20px;
}

<em>selector</em> {
  margin: 5px 10px 15px 20px; /* top, right, bottom, left */
  margin: 5px 10px 15px; /* top, left-right, bottom */
  margin: 5px 15px; /* top-bottom, left-right */
  margin: 5px; /* top-right-left-bottom */
}
		</code></pre>
		<p class="rule ref">
			Each property has it's own specific syntax and rules, so keep a reference link <a href="http://dochub.io/#css" target="_blank">handy</a>
		</p>
	</section>
	<section>
		<h3 class="outline" id="syntax-units">Units of measure</h3>
		<p>
			<span class="sans">CSS</span> supports serveral different units of measure, many of which only make sense when printing.
			In a screen based context, there are only three suitable measurement units:
		</p>
		<ul class="partial">
			<li><strong>pixels</strong> (<code>px</code>): the smallest point a screen can physically display (hardware pixel)</li>
			<li><strong>ems</strong> (<code>em</code>): hight of the browser's base text size (usually 16px)</li>
			<li><strong>percentage</strong> (<code>%</code>): the percentage of a reference value (changes based on context)</li>
		</ul>
		<p class="ref">
			Ems and percentage are clearly relative units, but because some newer devices have vastly higher pixel densities, the hardware pixel can be considered a relative value as well.
			Devices like the iPhone 4, with a pixel density of 2, need to render pixel measurements at twice their actual size in order to compensate.
			There are changes afoot to develop an optical reference pixel that would be the same absolute size across all screens, but we aren't there yet.
		</p>
	</section>
	<section>
		<h3 class="outline" id="syntax-prefixes">Vendor Prefixes</h3>
		<p>
			Introduced in <span class="sans">CSS 2.1</span> as a 'beta' flag for new style properties, vendor prefixes allow browser vendors to implement new features before there is a standard syntax.
			On the whole, this is a good idea, but in practice it can mean more typing:
		</p>
		<pre class="partial"><code class="language-css">
-webkit-transition: background-color 0.25s;
-moz-transition: background-color 0.25s;
-ms-transition: background-color 0.25s;
-o-transition: background-color 0.25s;
transition: background-color 0.25s;
		</code></pre>
		<p class="ref">
			Most of the new CSS3 features are still vendor prefixed in the latest versions of browsers, so be sure to consult a
			<a href="http://peter.sh/experiments/vendor-prefixed-css-property-overview/" target="_blank">reference</a> before writting.
		</p>
		<p class="rule partial">
			Vendor prefixes are good for the web: don't just use <code>-webkit-</code> and forget the rest
		</p>
	</section>
	<section>
		<h2 class="outline" id="selectors">Selectors</h2>
	</section>
	<section>
		<p class="">
			A rule's selector can vary from the very specific to the very general, targeting one or many elements at a time.
			Selector syntax is very flexible, and is designed to allow for combining and grouping individual types.
		</p>
	</section>
	<section>
		<h3 class="outline" id="selectors-basics">Basic selectors</h3>
		<h4 class="outline" id="selectors-id">Select by id</h4>
		<p>Select a specific element by id:</p>
		<pre class="partial"><code class="language-css">
#wrapper {
  margin: 20px;
}
		</code></pre>
	</section>
	<section>
		<h4 class="outline" id="selectors-class">Select by class</h4>
		<p>Select one or more elements by class:</p>
		<pre class="partial"><code class="language-css">
.highlight {
  color: yellow;
}
		</code></pre>
	</section>
	<section>
		<h4 class="outline" id="selectors-tag">Select by tag name</h4>
		<p>Select one or more elements by tag name:</p>
		<pre class="partial"><code class="language-css">
p {
  padding: 0 10px 20px;
}
		</code></pre>
	</section>
	<section>
		<h4 class="outline" id="selectors-descendant">Select descendants</h4>
		<p>Select one or more elements nested (at any level) within a parent element:</p>
		<pre class="partial"><code class="language-css">
li a {
  text-decoration: underline;
}
		</code></pre>
	</section>
	<section>
		<h4 class="outline" id="selectors-direct-descendant">Select direct descendants</h4>
		<p>Select one or more elements nested directly below a parent element:</p>
		<pre class="partial"><code class="language-css">
#wrapper>section {
  float: left;
}
		</code></pre>
	</section>
	<section>
		<h4 class="outline" id="selectors-attribute">Select by attribute</h4>
		<p>Select one or more elements based on their attributes:</p>
		<pre class="partial"><code class="language-css">
/* all <em>img</em> elements with a <em>title</em> attribute */
img[title] {
  border: 1px solid red;
}
/* all <em>a</em> elements with a specific link destination */
a[href="#"] {
  background-color: #3c3c3c;
}
/* all <em>a</em> elements starting with a specific value (external links) */
a[href^="http"] {
  background-image: url('images/external-link.png');
}
/* all <em>form</em> submit buttons */
input[type=submit] {
  border: none;
}
		</code></pre>
	</section>
	<section>
		<h4 class="outline" id="selectors-pseudo-class">Select by pseudo class</h4>
		<p>Select one or more elements based on a specific state:</p>
		<pre class="partial"><code class="language-css">
/* all <em>a</em> elements during mouse hover state */
a:hover {
  text-decoration: underline;
}
/* all input textfield elements during keyboard focus */
input[type=text]:focus {
  color: red;
}
/* all divs except for <em>#wrapper</em> */
/* NOT FOR OLDie */
div:not(#wrapper) {
  margin: 2em
}
		</code></pre>
	</section>
	<section>
		<h4 class="outline" id="selectors-pseudo-element">Select a pseudo element</h4>
		<p>Select one or more parts of an element:</p>
		<pre class="partial"><code class="language-css">
/* first line of all paragraphs */
p::first-line {
  padding-left: 10px;
}
/* first letter of all paragraphs */
p::first-letter {
  font-size: 1.2em;
}
		</code></pre>
		<p class="rule partial">
			Pseudo elements are designated by double :: but work with single : for backwards compatibility
		</p>
	</section>
	<section>
		<h3 class="outline" id="selectors-combined">Selector Collections</h3>
		<p>Selectors can be collected in order to apply a style declaration to many elements at the same time:</p>
		<pre class="partial"><code class="language-css">
/* HTML5 reset */
article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section {
  display: block;
}
/* typographic styles common to all headings */
h1, h2, h3, h4, h5 {
  font-family: "Gill Sans", sans-serif;
  letter-spacing: 1px;
}
		</code></pre>
	</section>
	<section>
		<h3 class="outline" id="selectors-parsing">Selector parsing</h3>
		<p>
			Knowing how browsers parse selectors helps avoid inefficient element selection and potential performance issues.
			The right-most selector in a selector combination is referred to as the <em>key selector</em> because selectors are matched from <strong>right to left</strong>.
			This enables browsers to determine which elements <em>don't</em> match as quickly as possible.
		</p>
		<p class="rule partial">
			Selectors with a right-most selector that matches many elements can have an impact on page rendering speed
		</p>
	</section>
	<section>
		<h2 class="outline" id="inheritance">Inheritance</h2>
	</section>
	<section>
		<p class="">
			Certain style properties are inheritable, passed down from parent to child through the DOM tree.
			This allows child elements to automatically adopt styles without any explicit declaration.
			The most important inherited styles are typographic
			(<code>color</code>, <code>font-size</code>, <code>font-weight</code>, <code>font-family</code>, <code>line-height</code>, <code>text-align</code>, etc):
		</p>
		<pre class="partial"><code class="language-css">
body {
  font-size: 14px;
  font-family: sans-serif;
  color: black;
}
		</code></pre>
		<p class="rule partial">
			Define your basic typographic rules on the <code>body</code> in order to force a consistent style
		</p>
	</section>
	<section>
		<h2 class="outline" id="cascade">The Cascade</h2>
	</section>
	<section>
		<p class="">
			The cascade is a set of rules that determine which styles are ultimately applied to an element when there are multiple sources, including which styles prevail during conflict.
			If more than one style is applied from different rules, they are combined, and any conflicts are resolved based on the rule's <em>specificity</em>.
		</p>
	</section>
	<section>
		<h3 class="outline" id="specificity">Specificity</h3>
		<p class="">
			When there are conflicting styles, properties of the most specific style overwrite less specific ones.
			Browsers use a formula to determine a style's specificity based on values assigned to the style's selector:
		</p>
		<ul>
			<li class="partial">Automatic User Agent styles are worth the least</li>
			<li class="partial">Tag and generic selectors are worth more than the built in browser styles</li>
			<li class="partial">Class selectors are worth more than tags</li>
			<li class="partial">ID selectors are worth more than classes</li>
			<li class="partial">Inline styles written in the element <code>style</code> attribute are worth the most</li>
		</ul>
		<p class="rule partial">
			UA styles &lt; tag &lt; class &lt; id &lt; style attr
		</p>
		<p class="partial">
			In the case of a tie, the last style to be applied wins.
		</p>
	</section>
	<section>
		<h4 class="outline" id="specificity-important">!important</h4>
		<p>
			Because of this value based approach, there are some cases where it may be very difficult to override a particular style, particularly when ID selectors have been used.
			In these cases, it is possible to overrule any style no matter it's specificity:
		</p>
		<pre class="partial"><code class="language-css">
#nav a {
  color: red;
}
a {
  color: black !important;
}
		</code></pre>
		<p class="rule partial">
			Avoid the use of <code>!important</code> under all but the most life-threatening circumstances
		</p>
	</section>
	<section>
		<h3 class="outline" id="resets">Resets</h3>
		<p class="">
			Because browsers apply default styling to most elements (especially <code>form</code> elements), it can be desirable to reset styles to a basic state before you begin any styling.
			<span class="ref">As mentioned in the previous lesson, it's sometimes also necessary to apply <code>display:block</code> to <span class="sans">HTML5</span> structural elements. </span>
			These reset rules should be included before all others to ensure that they don't overrule any custom style declarations.
		</p>
		<pre class="ref"><code class="language-css">
/* http://meyerweb.com/eric/tools/css/reset/
   v2.0 | 20110126
   License: none (public domain)
*/
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
  margin: 0;
  padding: 0;
  border: 0;
  font-size: 100%;
  font: inherit;
  vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section {
  display: block;
}
body {
  line-height: 1;
}
ol, ul {
  list-style: none;
}
blockquote, q {
  quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
  content: '';
  content: none;
}
table {
  border-collapse: collapse;
  border-spacing: 0;
}
		</code></pre>
		<p class="rule partial">
			Resets even out browser rendering differences by resetting their default styles
		</p>
	</section>
	<section>
		<h2 class="outline" id="box-model">The Box Model</h2>
	</section>
	<section>
		<p class="">
			Though probably obvious, it's important to note that every element rendered by the browser is bound by a <em>rectangular box</em>.
			This box, and the properties that make up it's dimensions, is known as the <em>box model</em>.
			The model affects the dimensions of elements and how they interact with each other.
		</p>
	</section>
	<section>
		<img src="/assets/images/box-model.png" width="500px" height="500px">
		<ul>
			<li class="partial"><strong>content area</strong>: the space needed to render the content</li>
			<li class="partial"><strong>padding</strong>: the inside space between the content and the content's border (shared background)</li>
			<li class="partial"><strong>border</strong>: the coloured stroke applied to the outside of the element</li>
			<li class="partial"><strong>margin</strong>: the outside space between the element and it's neighbours (transparent)</li>
		</ul>
	</section>
	<section>
		<p>
			By default, the actual dimension of an element, and the space it takes up on screen, includes the padding and border dimensions.
			Although perhaps not entirely logical, the <code>width</code> and <code>height</code> properties define the <em>content</em> width and height only, not it's bounding rectangle.
		</p>
		<p class="rule partial">
			Width = <code>width</code> + <code>padding-left</code> + <code>padding-right</code> + <code>border-left</code> + <code>border-right</code>
		</p>
	</section>
	<section>
		<p>
			This behaviour has implications for defining precise pixel dimensions of elements, as well as relative, percentage based layout:
		</p>
		<pre class="partial"><code class="language-css">
/* actual box dimensions are 540px X 240px */
#box {
  width: 500px;
  height: 200px;
  padding: 20px;
}

/* actual column width is wider than 50% */
.column {
  width: 50%;
  height: 100%;
  padding: 0 20px;
}
		</code></pre>
		<p class="rule partial">
			Remember that the default behaviour for block-level elements is to take up all available width,
			so it's often desirable to set <code>width:auto</code> instead of <code>width:100%</code>.
			This will allow the use of padding and borders where otherwise it would not be possible.
			<a class="ref" href="http://www.456bereastreet.com/archive/201112/the_difference_between_widthauto_and_width100/" target="_blank">More here</a>
		</p>
	</section>
	<section>
		<p>
			This default behaviour can often be frustrating, and will sometimes lead to extra markup to fix layout problems.
			One option, however, is to change the box model behaviour to include padding and border dimensions <strong>inside</strong> width/height declarations:
		</p>
		<pre class="partial"><code class="language-css">
.sane-box-model {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

/* actual width will be 100% and will play nice with the neighbours */
div.sane-box-model {
  width: 100%;
  padding: 40px;
  border: 10px solid red;
}
		</code></pre>
	</section>
	<section>
		<p>
			This property is supported on all browsers since IE8, so it's generally safe, and even
			<a href="http://paulirish.com/2012/box-sizing-border-box-ftw/" target="_blank">recommended</a> by some to apply to all elements:
		</p>
		<pre class="partial"><code class="language-css">
* {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}
		</code></pre>
	</section>
	<section>
		<h2 class="outline" id="display">Display</h2>
	</section>
	<section>
		<p class="">
			Before we embark on questions of layout and positioning, it's useful to first address the various display states available to elements.
			The aptly named <code>display</code> property is the most important way to control an element's rendering:
		</p>
		<ul>
			<li class="partial"><strong><code>none</code></strong>: element display is disabled, including nested children, as though the element did not exist</li>
			<li class="partial"><strong><code>inline</code></strong>: element behaves like an inline-level <span class="sans">HTML</span> element</li>
			<li class="partial"><strong><code>block</code></strong>: element behaves like a block-level <span class="sans">HTML</span> element</li>
			<li class="partial"><strong><code>inline-block</code></strong>: element behaves like a block-level element but flows with surrounding content (can have margins, height, etc) </li>
			<li class="partial"><strong><code>table</code></strong>: element behaves like a <code>table</code> <span class="sans">HTML</span> element</li>
			<li class="partial"><strong><code>additional table related</code></strong>: there are further states that correspond to table specific child element behaviour
			(<code>table-row</code>, <code>table-cell</code>, etc)</li>
		</ul>
	</section>
	<section>
		<h3 class="outline" id="visibility">Visibility</h3>
		<p>
			Another means of controlling the display of an element is with the <code>visiblity</code> property. Unlike <code>display</code>, <code>visiblity</code> does not alter the document flow,
			but simply changes whether the element is visible or not:
		</p>
		<ul>
			<li class="partial"><strong><code>hidden</code></strong>: element is invisible, but document layout is still affected by it's size and position</li>
			<li class="partial"><strong><code>visible</code></strong>: element is fully visible</li>
		</ul>
	</section>
	<section>
		<h3 class="outline" id="opacity">Opacity</h3>
		<p>
			Conceptually related to <code>visibility</code>, the <code>opacity</code> property controls the degree of transparency of an element:
		</p>
		<div class="example-container partial">
			<pre class=""><code class="language-html">
&lt;img src=&quot;/images/image.jpg&quot;&gt;

img {
  opacity: 0.25;
}
			</code></pre>
			<div class="example">
				<div style="text-align:center; width:100px; height:100px; background-color:#666">
					<img src="/assets/images/image.jpg" width="100px" height="100px" style="display:inline; opacity:0.25;">
				</div>
			</div>
		</div>
		<p class="rule partial">
			<em>OldIE</em> doesn't support the <code>opacity</code> property, but you can achieve the same with the IE-only <br>
			<code>filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=50);</code><br>
			[Note that opacity values are from 0-1, and IE filter from 0-100]
		</p>
	</section>
	<section>
		<h3 class="outline" id="overflow">Overflow</h3>
		<p>
			When the content inside an element is larger than it's defined <code>width</code> and <code>height</code>,
			the content can spill outside of it's container in all sorts of odd ways. By specifying an <code>overflow</code> property, you can control the behaviour:
		</p>
		<ul>
			<li class="partial"><strong><code>visible</code></strong>: content is not clipped and may render outside the content box (default)</li>
			<li class="partial"><strong><code>hidden</code></strong>: content is clipped</li>
			<li class="partial"><strong><code>scroll</code></strong>: content is clipped and scrollbars are added whether they are needed or not</li>
			<li class="partial"><strong><code>auto</code></strong>: content is clipped and scrollbars are added if needed</li>
		</ul>
	</section>
	<section>
		<h2 class="outline" id="positioning">Positioning</h2>
	</section>
	<section>
		<p class="">
			Controlling the position of elements is one of the most important, and often challenging, tasks of the styling process.
			The primary tool for directing the position of elements is the <code>position</code> property:
		</p>
		<ul>
			<li class="partial"><strong><code>static</code></strong>: normal position in the flow of the document (default)</li>
			<li class="partial"><strong><code>relative</code></strong>: normal position in the flow of the document, plus optional offsets (<code>top</code>, <code>bottom</code>, <code>left</code>, <code>right</code>).
			Also used to establish a new coordinate space for child elements</li>
			<li class="partial"><strong><code>absolute</code></strong>: outside of normal document flow, and positioned relative to it's nearest positioned ancestor using optional offsets</li>
			<li class="partial"><strong><code>fixed</code></strong>: outside of normal document flow, and positioned relative to the viewport using optional offsets (does not scroll)</li>
		</ul>
	</section>
	<section>
		<div class="example-container">
			<pre class=""><code class="language-html">
&lt;div id=&quot;#wrapper&quot;&gt;
  &lt;div id=&quot;#box1&quot; class=&quot;box&quot;&gt;&lt;/div&gt;
  &lt;div id=&quot;#box2&quot; class=&quot;box&quot;&gt;&lt;/div&gt;
&lt;/div&gt;

#wrapper {
  position: relative;
}
.box {
  width: 40px;
  height: 40px;
  background-color: #f26522;
}
#box1 {
  position: absolute;
  bottom: 10px;
  right: 10px;
  background-color: #009BC8;
}
			</code></pre>
			<div class="example">
				<div style="width:100px; height:100px; background-color:#666">
					<div style="width:40px; height:40px; background-color:#f26522"></div>
					<div style="position:absolute; bottom:20px; right:20px; width:40px; height:40px; background-color:#009BC8"></div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<h3 class="outline" id="centering">Centering</h3>
		<p class="">
			Trying to center an element, either vertically or horizontally, is often more frustrating than you would expect it to be.
			Certainly, centering horizontally is far easier than the vertical variety, and in all cases it's far easier with elements that have a fixed dimension.
		</p>
	</section>
	<section>
		<h4 class="outline" id="margin-auto">Margin auto</h4>
		<p>
			Using margin value of <code>auto</code> for both <code>margin-left</code> and <code>margin-right</code> will center a block element:
		</p>
		<div class="example-container partial">
			<pre class=""><code class="language-html">
&lt;div id=&quot;#box1&quot;&gt;&lt;/div&gt;

#box1 {
  width: 40px;
  height: 40px;
  background-color: #f26522;
  margin: 0 auto;
}
			</code></pre>
			<div class="example">
				<div style="width:100px; height:100px; background-color:#666">
					<div style="margin:0 auto; width:40px; height:40px; background-color:#f26522"></div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<h4 class="outline" id="margin-neg">Negative margins</h4>
		<p>
			Positioning an element absolutely in the middle of it's parent, then applying negative margins equal to half it's height and width will center a fixed sized block element:
		</p>
		<div class="example-container partial">
			<pre class=""><code class="language-html">
&lt;div id=&quot;#wrapper&quot;&gt;
  &lt;div id=&quot;#box1&quot;&gt;&lt;/div&gt;
&lt;/div&gt;

#wrapper {
  position: relative;
}
#box1 {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 40px;
  height: 40px;
  margin-top: -20px;
  margin-left: -20px;
  background-color: #f26522;
}
			</code></pre>
			<div class="example">
				<div style="position:relative; width:100px; height:100px; background-color:#666">
					<div style="position:absolute; top:50%; left:50%; margin-top:-20px; margin-left:-20px; width:40px; height:40px; background-color:#f26522"></div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<h4 class="outline" id="text-align">Text-align center</h4>
		<p>
			Adding <code>text-align:center</code> to a parent container will horizontally center all inline elements (text, images, etc):
		</p>
		<div class="example-container partial">
			<pre class=""><code class="language-html">
&lt;div id=&quot;#wrapper&quot;&gt;
  &lt;p&gt;text&lt;/p&gt;
  &lt;img src=&quot;/images/little-image.jpg&quot;&gt;
&lt;/div&gt;

#wrapper {
  text-align: center;
}
			</code></pre>
			<div class="example">
				<div style="text-align:center; width:100px; height:100px; background-color:#666">
					<p style="color:#f26522; padding:0;">text</p>
					<img src="/assets/images/little-image.jpg" width="50px" height="37px" style="display:inline;">
				</div>
			</div>
		</div>
	</section>
	<section>
		<h4 class="outline" id="text-align">Line-height</h4>
		<p>
			Adding <code>line-height</code> equal to <code>height</code> will center a single line of text vertically:
		</p>
		<div class="example-container partial">
			<pre class=""><code class="language-html">
&lt;li&gt;
  &lt;a&gt;menu link&lt;/a&gt;
&lt;/li&gt;

li {
  background-color: #666666;
}
li a {
  height: 100px;
  line-height: 100px;
}
			</code></pre>
			<div class="example">
				<div style="text-align:center; width:100px; height:100px; background-color:#666">
					<p style="color:#f26522; height:100px; line-height:100px">MENU LINK</p>
				</div>
			</div>
		</div>
		<p class="ref">
			This is just scratching the surface of all the hacky posibilities that lay just one Google search away.
		</p>
		<p class="rule partial">
			Taming the layout beast will require patience and experimentation
		</p>
	</section>
	<section>
		<h3 class="outline" id="floating">Floating</h3>
		<p class="">
			The <code>float</code> property is another way to control layout, allowing an element to pull right or left and have content flow around itself.
			This is often used to wrap text around images, but can also be used to create column layouts and horizontal menus. The values for <code>float</code> include:
		</p>
		<ul>
			<li class="partial"><strong><code>left</code></strong>: element floats on the left side of its containing block</li>
			<li class="partial"><strong><code>right</code></strong>: element floats on the right side of its containing block</li>
			<li class="partial"><strong><code>none</code></strong>: element does not float</li>
		</ul>
	</section>
	<section>
		<p>
			Here is the intended use of floats:
		</p>
		<div class="example-container partial">
			<pre class=""><code class="language-html">
&lt;div id=&quot;#wrapper&quot;&gt;
  &lt;p&gt;I love cats, they are so cute and cuddly and they smell nice.&lt;/p&gt;
  &lt;img src=&quot;/images/little-image.jpg&quot;&gt;
&lt;/div&gt;

img {
  float: left;
}
			</code></pre>
			<div class="example">
				<div style="width:100px; height:100px; background-color:#666">
					<img src="/assets/images/little-image.jpg" width="50px" height="37px" style="padding:0; margin:0; float:left; display:inline;">
					<p class="small" style="color:#f26522; padding:0;">I love cats, they are so cute and cuddly and they smell nice.</p>
				</div>
			</div>
		</div>
	</section>
	<section>
		<p>
			And an example of using it for structural layout:
		</p>
		<div class="example-container partial">
			<pre class=""><code class="language-html">
&lt;div id=&quot;#wrapper&quot;&gt;
  &lt;div id=&quot;#box1&quot; class=&quot;box&quot;&gt;&lt;/div&gt;
  &lt;div id=&quot;#box2&quot; class=&quot;box&quot;&gt;&lt;/div&gt;
&lt;/div&gt;

.box {
  width: 40px;
  height: 40px;
}
#box1 {
  float: left;
  background-color: #f26522;
}
#box2 {
  float: right;
  background-color: #009BC8;
}
			</code></pre>
			<div class="example">
				<div style="width:100px; height:100px; background-color:#666">
					<div style="float:left; width:40px; height:100%; background-color:#f26522"></div>
					<div style="float:right; width:40px; height:100%; background-color:#009BC8"></div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<h3 class="outline" id="clearing">Clearing</h3>
		<p>
			Because floating elements takes them out of the regular flow of the document, we often get undesirable behaviour with content that comes after those elements.
			The <code>clear</code> property is the companion to <code>float</code> in that it determines how non-floated siblings react to a floated brother or sister:
		</p>
		<ul>
			<li class="partial"><strong><code>none</code></strong>: element does not move out of the way of floated content</li>
			<li class="partial"><strong><code>left</code></strong>: element moves down to clear past left floats</li>
			<li class="partial"><strong><code>right</code></strong>: element moves down to clear past right floats</li>
			<li class="partial"><strong><code>both</code></strong>: element moves down to clear past both left and right floats</li>
		</ul>
	</section>
	<section>
		<div class="example-container">
			<pre class=""><code class="language-html">
&lt;div id=&quot;#wrapper&quot;&gt;
  &lt;div id=&quot;#box1&quot; class=&quot;box&quot;&gt;&lt;/div&gt;
  &lt;div id=&quot;#box2&quot; class=&quot;box&quot;&gt;&lt;/div&gt;
  &lt;div id=&quot;#box3&quot;&gt;&lt;/div&gt;
&lt;/div&gt;

.box {
  width: 40px;
  height: 60px;
}
#box1 {
  float: left;
  background-color: #f26522;
}
#box2 {
  float: right;
  background-color: #009BC8;
}
#box3 {
  clear: both;
  width: 100%;
  height: 20px;
  color: #00c830;
}
			</code></pre>
			<div class="example">
				<div style="width:100px; height:100px; background-color:#666">
					<div style="float:left; width:40px; height:60px; background-color:#f26522"></div>
					<div style="float:right; width:40px; height:60px; background-color:#009BC8"></div>
					<div style="clear:both; width:100%; height:20px; background-color:#00c830"></div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<h4 class="outline" id="collapsing">Collapsing</h4>
		<p>
			A side-effect of all this floating is that a container of floated elements will collapse on itself unless it has a defined height
			(floated elements are taken out of the regular flow, remember?). <span class="ref">There are many ways to 'fix' float clearing to prevent collapsing,
			including adding a bottom element with <code>clear:both</code> as in the above example.
			If we wish to avoid extra markup, we can use one of the following tricks:</span>
		</p>
		<pre class="partial"><code class="language-css">
/* this will trick the container into not collapsing... */
/* ...but may hide content */
#wrapper {
  width: 100%;
  overflow: hidden;
}

/* this is the same as adding an extra element in markup, but all in css */
#wrapper:after {
  content: ".";
  display: block;
  height: 0;
  clear: both;
  visibility: hidden;
}
		</code></pre>
	</section>
	<section>
		<h3 class="outline" id="zindex">z-index</h3>
		<p>With the ability to position elements nearly at will, it often becomes necessary to manage element stacking order.
		Controlling the order in which elements overlap is done with the <code>z-index</code> property,
		which simply takes a numeric value (negative or positive) to resolve which element lies above another:
		</p>
	</section>
	<section>
		<div class="example-container">
			<pre class=""><code class="language-html">
&lt;div id=&quot;#wrapper&quot;&gt;
  &lt;div id=&quot;#box1&quot; class=&quot;box&quot;&gt;&lt;/div&gt;
  &lt;div id=&quot;#container&quot;&gt;
    &lt;div id=&quot;#box2&quot; class=&quot;box&quot;&gt;&lt;/div&gt;
    &lt;div id=&quot;#box3&quot; class=&quot;box&quot;&gt;&lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;

#wrapper {
  position: relative;
}
.box {
  position: absolute;
  width: 40px;
  height: 40px;
}
#box1 {
  top: 10px;
  left: 10px;
  z-index: 3;
  background-color: #f26522;
}
#box2 {
  top: 30px;
  left: 30px;
  background-color: #009BC8;
  z-index: 2;
}
#box3 {
  top: 50px;
  left: 50px;
  background-color: #00c830;
  z-index: 1;
}
			</code></pre>
			<div class="example">
				<div style="position:relative; width:100px; height:100px; background-color:#666">
					<div style="z-index:3; position:absolute; top:10px; left:10px; width:40px; height:40px; background-color:#f26522"></div>
					<div style="z-index:2; position:absolute; top:30px; left:30px; width:40px; height:40px; background-color:#009BC8"></div>
					<div style="z-index:1; position:absolute; top:50px; left:50px; width:40px; height:40px; background-color:#00c830"></div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<p class="rule">
			<code>z-index</code> only works on <em>positioned</em> elements (<code>relative</code>, <code>absolute</code>, or <code>fixed</code>)
		</p>
		<p>Stacking order is also subject to the current stacking context, much like positioning is subject to positioning context.
			So, if a group of stacked elements reside in a stacked parent, their stacking order is relative to each other, not the global stacking order:
		</p>
		<div class="example-container">
			<pre class=""><code class="language-html">
&lt;div id=&quot;#wrapper&quot;&gt;
  &lt;div id=&quot;#box1&quot; class=&quot;box&quot;&gt;&lt;/div&gt;
  &lt;div id=&quot;#box2&quot; class=&quot;box&quot;&gt;&lt;/div&gt;
  &lt;div id=&quot;#box3&quot; class=&quot;box&quot;&gt;&lt;/div&gt;
&lt;/div&gt;

#wrapper {
  position: relative;
}
.box, #container {
  position: absolute;
}
#box1 {
  z-index: 3;
  background-color: #f26522;
}
#container {
  z-index: 2;
  background-color: #cccccc;
}
#box2 {
  background-color: #009BC8;
  z-index: 999;
}
#box3 {
  background-color: #00c830;
  z-index: 100;
}
			</code></pre>
			<div class="example">
				<div style="position:relative; width:100px; height:100px; background-color:#666">
					<div style="z-index:3; position:absolute; top:10px; left:10px; width:40px; height:40px; background-color:#f26522"></div>
					<div style="z-index:2; position:absolute; top:20px; left:20px; width:80px; height:80px; background-color:#ccc">
						<div style="z-index:999; position:absolute; top:10px; left:10px; width:40px; height:40px; background-color:#009BC8"></div>
						<div style="z-index:1; position:absolute; top:30px; left:30px; width:40px; height:40px; background-color:#00c830"></div>
					</div>
				</div>
			</div>
		</div>
		<p class="rule">
			the default value for <code>z-index</code> is <code>0</code>, so negative values will position an element <em>behind</em> non-positioned/stacked elements
		</p>
	</section>
	<section>
		<h2 class="pres">next up...more CSS</h2>
	</section>
	<footer>
		<div class="highlight">
			<h2 class="outline" id="links">Links</h2>
			<ul>
				<li><a href="http://net.tutsplus.com/tutorials/html-css-techniques/the-30-css-selectors-you-must-memorize/" target="_blank">30 most important CSS selectors</a></li>
				<li><a href="http://www.quirksmode.org/css/contents.html" target="_blank">CSS browser compatibility table</a></li>
				<li><a href="http://www.stevesouders.com/blog/2009/06/18/simplifying-css-selectors/" target="_blank">Selector parsing and performance</a></li>
				<li><a href="http://calendar.perfplanet.com/2011/css-selector-performance-has-changed-for-the-better/" target="_blank">More selector parsing and performance</a></li>
				<li><a href="http://www.alistapart.com/articles/a-pixel-identity-crisis/" target="_blank">Hardware pixels</a></li>
				<li><a href="http://www.alistapart.com/articles/prefix-or-posthack/" target="_blank">Vendor prefixes</a></li>
				<li><a href="http://peter.sh/experiments/vendor-prefixed-css-property-overview/" target="_blank">Vendor prefix overview</a></li>
				<li><a href="http://paulirish.com/2012/box-sizing-border-box-ftw/" target="_blank">Box-sizing: border-box</a></li>
				<li><a href="http://www.456bereastreet.com/archive/201112/the_difference_between_widthauto_and_width100/" target="_blank">Difference between width:auto and width:100%</a></li>
				<li><a href="http://www.alistapart.com/articles/css-positioning-101/" target="_blank">Positioning 101</a></li>
				<li><a href="http://www.alistapart.com/articles/css-floats-101/" target="_blank">Floating 101</a></li>
				<li><a href="http://complexspiral.com/publications/containing-floats/" target="_blank">Containing floats</a></li>
				<li><a href="http://www.positioniseverything.net/easyclearing.html" target="_blank">Clearing floats</a></li>
			</ul>
		</div>
	</footer>
</article>
<?php include '../_footer.php' ?>