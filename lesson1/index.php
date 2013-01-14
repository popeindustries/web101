<?php include '../_header.php' ?>
<article>
	<header class="current">
		<h4>lesson 1</h4>
		<h1>HTML</h1>
	</header>
	<section>
		<h2 class="outline" id="html5">what is HTML5?</h2>
		<p class="ref">
			It's difficult to properly discuss <span class="sans">HTML</span> these days without addressing <span class="sans">HTML5</span> directly.
			It's a term that, in daily usage, encompasses far more than it outght to, and in general is used as a synonym for 'modern' or 'new' browser capabilities.
			Because newness is a moving target, attaching a number to the term can lead to confussion. So, what is <span class="sans">HTML5</span>, really?
		</p>
	</section>
	<section>
		<p class="highlight">
			<span class="sans">HTML5</span> is the fifth major revision of the Hypertext Markup Language.
			It describes the elements and associated <span class="sans">DOM APIs</span> used to write <em>.html</em> documents.
		</p>
		<p class="partial">From a developer's point of view, <span class="sans">HTML5</span> is just <span class="sans">HTML</span><span class="small">(version)</span><span class="sans">5</span>.</p>
		<p class="partial">From a marketer's point of view, <span class="sans">HTML5</span> is the new <span class="shine">shiny</span>.</p>
	</section>
	<section>
		<h4>HTML<span class="small">(v)</span>5 is:</h4>
		<ul>
			<li class="partial">new media elements: <code>video</code> and <code>audio</code></li>
			<li class="partial">new structural elements: <code>article</code>, <code>section</code>, <code>header</code>, <code>footer</code>, <code>aside</code>, etc</li>
			<li class="partial">new graphics element: <code>canvas</code></li>
			<li class="partial">new form elements and input types: <code>tel</code>, <code>email</code>, <code>number</code>, <code>color</code>, etc</li>
			<li class="partial">new support for local offline storage</li>
			<li class="partial">new support for drag and drop user interaction</li>
		</ul>
	</section>
	<section>
		<h4>HTML<span class="small">(v)</span>5 isn't:</h4>
		<ul>
			<li class="partial"><a href="http://isgeolocationpartofhtml5.com/" target="_blank">Geolocation API</a></li>
			<li class="partial">WebGL</li>
			<li class="partial">CSS3</li>
			<li class="partial">ECMAScript5</li>
			<li class="partial">webworkers</li>
			<li class="partial">web sockets</li>
		</ul>
	</section>
	<section>
		<p>
			<span class="ref">Most importantly, </span><span class="sans">HTML5</span> is whatever the browser vendors say it is.
			The main goal of the standards process is to document and standardize the technologies that are shipping in browsers today.
		</p>
		<p class="partial">
			This is sometimes referred to as <em>paving the cowpaths</em>
		</p>
	</section>
	<section>
		<h2 class="outline" id="doc-description">The Document description</h2>
	</section>
	<section>
		<h3 class="outline" id="doctype">The doctype</h3>
		<p>
			<span class="ref">Doctypes were introduced in order to allow developers to 'opt in' to writing standards compliant markup.
			As vendors started improving their browsers, older pages written with known bugs in mind no longer rendered properly.</span>
			Doctypes have been used as a way to explicitly state that pages should be rendered in 'standards' mode, and not 'quirks' (ie. broken) mode.
			<span class="ref">Of course, browsers did things their own way, and there were soon dozens of doctypes to trigger either standards or quirks modes.</span>
			Now that <span class="sans">HTML5</span> has established a rendering specification, there is now only one way to trigger standards mode:
		</p>
		<pre class="partial"><code class="language-html">
&lt;!-- The new and improved way --&gt;
&lt;!DOCTYPE html&gt;
&lt;!-- The old and crappy way --&gt;
&lt;!DOCTYPE html PUBLIC
  &quot;-//W3C//DTD XHTML 1.0 Strict//EN&quot;
  &quot;http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd&quot;&gt;
		</code></pre>
	</section>
	<section>
		<h3 class="outline" id="root">The root Element</h3>
		<p>
			Like the doctype, the root element syntax has also been simplified:
		</p>
		<pre class="partial"><code class="language-html">
&lt;!DOCTYPE html&gt;
&lt;!-- The new and improved way --&gt;
&lt;html lang=&quot;en&quot;&gt;
&lt;!-- The old and crappy way --&gt;
&lt;html xmlns=&quot;http://www.w3.org/1999/xhtml&quot; lang=&quot;en&quot; xml:lang=&quot;en&quot;&gt;
		</code></pre>
	</section>
	<section>
		<h3 class="outline" id="head">The <code>&lt;head&gt;</code> Element</h3>
		<p>
			The head element contains metadata about the page and links to external resources.
		</p>
		<div class="partial">
			<h4 class="outline" id="head-metadata">metadata</h4>
			<p>
				The most important metadata is the character encoding of the page.
				<span class="ref">Since some developers were forgetting to quote attribute values, most browsers now only care about the <span class="sans">charset</span> and ignore the rest.
				So, simplified again:</span>
			</p>
		</div>
		<pre class="partial"><code class="language-html">
&lt;!DOCTYPE html&gt;
&lt;html lang=&quot;en&quot;&gt;
  &lt;!-- The new and improved way --&gt;
  &lt;meta charset=&quot;utf-8&quot; /&gt;
  &lt;!-- The old and crappy way --&gt;
  &lt;meta http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=utf-8&quot;&gt;
		</code></pre>
	</section>
	<section>
		<p>
			Although web servers send the encoding format in request headers, failing to specify character encoding is a serious
			<a href="http://securethoughts.com/2009/05/exploiting-ie8-utf-7-xss-vulnerability-using-local-redirection/" target="_blank">security</a>
			<a href="http://openmya.hacker.jp/hasegawa/security/utf7cs.html" target="_blank">vulnerability</a>.
		</p>
		<p class="rule partial">
			Always specify character encoding with <code>&lt;meta charset=&quot;utf-8&quot; /&gt;</code>
		</p>
	</section>
	<section>
		<h5 class="outline" id="head-metadata-mobile">Mobile</h5>
		<p class="ref">
			Metadata is a bit of a free-for-all, and there have been many different kinds introduced by interested parties.
			Apple was first to the modern mobile browser party, so they came up with this (now standard) syntax to define the behaviour of the viewport:
		</p>
		<pre><code class="language-html">
&lt;!DOCTYPE html&gt;
&lt;html lang=&quot;en&quot;&gt;
  &lt;meta charset=&quot;utf-8&quot; /&gt;
  &lt;meta name=&quot;viewport&quot; content=&quot;width=device-width,
    initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=0&quot; /&gt;
		</code></pre>
		<p class="ref">
			These attributes allow you to override the default width (set at 980px for iOS) and zoomability of the page.
			The above settings prevent all scaling and removes the ability to zoom. Use with caution!
		</p>
		<p class="ref">
			Here's a couple more Apple-only settings to allow you to make your page more app-alicious:
		</p>
		<pre class="partial"><code class="language-html">
  &lt;meta name=&quot;apple-mobile-web-app-capable&quot; content=&quot;yes&quot; /&gt;
  &lt;meta name=&quot;apple-mobile-web-app-status-bar-style&quot; content=&quot;black&quot; /&gt;
		</code></pre>
	</section>
	<section>
		<h5 class="outline" id="head-metadata-facebook">Facebook</h5>
		<p class="ref">
			Facebook has their own set of metadata for Open Graph configuration:
		</p>
		<pre><code class="language-html">
  &lt;meta property=&quot;og:title&quot; content=&quot;Some title&quot;/&gt;
  &lt;meta property=&quot;og:type&quot; content=&quot;website&quot;/&gt;
  &lt;meta property=&quot;og:url&quot; content=&quot;Some url&quot;/&gt;
  &lt;meta property=&quot;og:image&quot; content=&quot;Some image&quot;/&gt;
  &lt;meta property=&quot;og:site_name&quot; content=&quot;Some site name&quot;/&gt;
  &lt;meta property=&quot;og:description&quot; content=&quot;Some description&quot;/&gt;
  &lt;meta property=&quot;fb:app_id&quot; content=&quot;1234567890&quot;/&gt;
		</code></pre>
	</section>
	<section>
		<h4 class="outline" id="head-links">links and external resources</h4>
		<h5 class="outline" id="head-links-stylesheets">Stylesheets</h5>
		<p>
			Although there are several others, the most important <code>&lt;link&gt;</code> to include in the <code>&lt;head&gt;</code> is to external stylesheets.
			<span class="ref">Since there is only one kind of style sheet format, we can dispense with the <code>type</code> attribute:</span>
		</p>
		<pre class="partial"><code class="language-html">
  &lt;!-- The new and improved way --&gt;
  &lt;link rel=&quot;stylesheet&quot; href=&quot;main.css&quot; /&gt;
  &lt;!-- The old and crappy way --&gt;
  &lt;link rel=&quot;stylesheet&quot; href=&quot;main.css&quot; type=&quot;text/css&quot; /&gt;
		</code></pre>
	</section>
	<section>
		<h5 class="outline" id="head-links-scripts">Scripts</h5>
		<p>
			<code>&lt;script&gt;</code> tags can also be included in the <code>&lt;head&gt;</code>,
			but beware that loading an external <em>.js</em> file will block page rendering<span class="ref">, and generally make things feel very sloooooow,
			so you'd better have a good reason to do so.</span>
		</p>
		<p class="rule partial">
			External <em>.js</em> should (<a href="#head-runtime-env-feature-detection">almost</a>) always be loaded at the bottom of the <code>&lt;body&gt;</code>
		</p>
		<p class="ref">
			Since there is also only one kind of script file format, we can also dispense with a lot of fluff:
		</p>
		<pre class="partial"><code class="language-html">
  &lt;!-- The new and improved way --&gt;
  &lt;script src=&quot;js/main.js&quot; charset=&quot;utf-8&quot;&gt;&lt;/script&gt;
  &lt;!-- The old and crappy way --&gt;
  &lt;script src=&quot;js/main.js&quot; type=&quot;text/javascript&quot; charset=&quot;utf-8&quot;&gt;&lt;/script&gt;
		</code></pre>
	</section>
	<section>
		<h4 class="outline" id="head-runtime-env">Identifying the runtime environment</h4>
		<p class="partial">
			Because the <code>&lt;head&gt;</code> is parsed before any visible content, it is the best place to identify the current runtime environment,
			and allows us to react appropriately in order to avoid some nasty <abbr title="Flash of unstyled content">FOUC</abbr>.
		</p>
	</section>
	<section>
		<h5 class="outline" id="head-runtime-env-root-classes">Root classes</h5>
		<p>
			Classes attached to the top-level <code>&lt;html&gt;</code> tag can be used to separate style declarations in <span class="sans">CSS</span>,
			making it possible to handle different runtimes individually.
			<span class="ref">The most basic test is whether we are running in an environment that has <span class="sans">Javascript</span> enabled:</span>
		</p>
		<pre class="partial"><code class="language-html">
&lt;!DOCTYPE html&gt;
&lt;html lang=&quot;en&quot; class=&quot;no-js&quot;&gt;
		</code></pre>
		<p>
			At the first opportunity to execute <span class="sans">Javascript</span>, we can replace the <code>no-js</code> class with <code>js</code>.
		</p>
	</section>
	<section>
		<h5 class="outline" id="head-runtime-env-ie-comments">Conditional IE comments</h5>
		<p>
			<span class="ref">Browser wars are generally good for developers, but there is one war that will make your heart ache: <em>Internet Explorer</em> vs. everyone else.</span>
			One way to make life easier is with <em>IE</em>-only conditional comments wrapping the <code>&lt;html&gt;</code> tag.
			This technique makes it possible to set root classes based on the version of <em>oldIE</em> in use,
			giving you the opportunity to handle those browsers individually:
		</p>
		<pre class="partial"><code class="language-html">
&lt;!DOCTYPE html&gt;
&lt;!--[if lt IE 9]&gt; &lt;html class=&quot;ie&quot; lang=&quot;en&quot;&gt; &lt;![endif]--&gt;
&lt;!--[if (gte IE 9)|!(IE)]&gt;&lt;!--&gt; &lt;html lang=&quot;en&quot;&gt; &lt;!--&lt;![endif]--&gt;
		</code></pre>
	</section>
	<section>
		<h5 class="outline" id="head-runtime-env-feature-detection">Feature detection</h5>
		<p>
			Taking this approach further, we can use <span class="sans">Javascript</span> to run a series of feature detection tests before the <code>&lt;body&gt;</code>
			is rendered to determine what features the current runtime supports<span class="ref">, setting root classes for immediate reference:</span>
		</p>
		<pre class="partial"><code class="language-html">
&lt;!DOCTYPE html&gt;
&lt;!-- classes set at runtime via Modernizr --&gt;
&lt;html lang=&quot;en&quot; class=&quot;js no-touch postmessage
  history multiplebgs boxshadow opacity cssanimations csscolumns
  cssgradients csstransforms...&quot;&gt;

  &lt;script src=&quot;js/libs/modernizr-2.5.0.min.js&quot;&gt;&lt;/script&gt;
		</code></pre>
		<p class="rule partial">
			Avoid <em>User Agent</em> sniffing to determine capabilities. Feature detection is a far more reliable approach.
		</p>
		<p class="ref">
			Although we want to avoid loading external <span class="sans">Javascript</span> in the <code>&lt;head&gt;</code>,
			using a library like <a href="http://modernizr.com" target="_blank">Modernizr</a> to run feature detection tests is often worth the expense of delayed rendering.
		</p>
	</section>
	<section>
		<h5 class="outline" id="head-runtime-env-media-queries">Media queries</h5>
		<p>
			Media queries enable the conditional loading of <em>.css</em> files based on various environment properties, including <code>width</code>, <code>height</code>,
			<code>device-width</code>, <code>device-height</code>, <code>color</code>, <code>orientation</code>, and <code>resolution</code>:
		</p>
		<pre class="partial"><code class="language-html">
  &lt;link rel=&quot;stylesheet&quot; href=&quot;/css/mobile.css&quot;
    media=&quot;only screen and (min-width: 320px) and (max-width: 640px)&quot; /&gt;
  &lt;link rel=&quot;stylesheet&quot; href=&quot;/css/desktop.css&quot;
    media=&quot;only screen and (min-width: 640px)&quot; /&gt;
		</code></pre>
		<p class="ref">
			It's important to note that similar syntax is (more conveniently) available within <span class="sans">CSS</span> itself.
		</p>
	</section>
	<div class="ref">
		<p>
			Putting it all together:
		</p>
		<pre><code class="language-html">
&lt;!DOCTYPE html&gt;
&lt;!--[if lt IE 9 ]&gt; &lt;html lang=&quot;no&quot; class=&quot;no-js ie&quot;&gt; &lt;![endif]--&gt;
&lt;!--[if (gte IE 9)|!(IE)]&gt;&lt;!--&gt; &lt;html lang=&quot;no&quot; class=&quot;no-js&quot;&gt; &lt;!--&lt;![endif]--&gt;
  &lt;head&gt;
    &lt;meta charset=&quot;utf-8&quot;&gt;

    &lt;title&gt;Page title&lt;/title&gt;

    &lt;meta name=&quot;description&quot; content=&quot;A web page&quot;&gt;
    &lt;meta name=&quot;author&quot; content=&quot;Me&quot;&gt;
    &lt;meta name=&quot;viewport&quot; content=&quot;width=device-width,
      initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=0&quot; /&gt;
    &lt;meta name=&quot;apple-mobile-web-app-capable&quot; content=&quot;yes&quot; /&gt;
    &lt;meta name=&quot;apple-mobile-web-app-status-bar-style&quot; content=&quot;black&quot; /&gt;
    &lt;meta property=&quot;og:title&quot; content=&quot;Some title&quot;/&gt;
    &lt;meta property=&quot;og:type&quot; content=&quot;website&quot;/&gt;
    &lt;meta property=&quot;og:url&quot; content=&quot;Some url&quot;/&gt;
    &lt;meta property=&quot;og:image&quot; content=&quot;Some image&quot;/&gt;
    &lt;meta property=&quot;og:site_name&quot; content=&quot;Some site name&quot;/&gt;
    &lt;meta property=&quot;og:description&quot; content=&quot;Some description&quot;/&gt;
    &lt;meta property=&quot;fb:app_id&quot; content=&quot;1234567890&quot;/&gt;

    &lt;link rel=&quot;shortcut icon&quot; href=&quot;favicon.ico&quot;&gt;
    &lt;link rel=&quot;apple-touch-icon-precomposed&quot;
      href=&quot;images/apple-touch-icon-precomposed.png&quot;&gt;

    &lt;link rel=&quot;stylesheet&quot; href=&quot;/css/basic.css&quot; /&gt;
    &lt;link rel=&quot;stylesheet&quot; href=&quot;/css/mobile.css&quot;
      media=&quot;only screen and (min-width: 320px) and (max-width: 640px)&quot; /&gt;
    &lt;link rel=&quot;stylesheet&quot; href=&quot;/css/desktop.css&quot;
      media=&quot;only screen and (min-width: 640px)&quot; /&gt;

    &lt;script src=&quot;js/libs/modernizr-2.5.0.min.js&quot;&gt;&lt;/script&gt;
  &lt;/head&gt;
		</code></pre>
		<p>
			More <a href="http://html5boilerplate.com/docs/head-Tips/" target="_blank">tips</a> for your <code>&lt;head&gt;</code>.
		</p>
	</div>
	<section>
		<h2 class="outline" id="doc-body">the document body</h2>
	</section>
	<section>
		<h3 class="outline" id="semantics">Semantics</h3>
		<p>
			<span class="sans">HTML</span>, like human languages, has a defined vocabulary with which one can express meaning and intent (semantics).
			With only a 100 or so words (<code>&lt;elements&gt;</code>) to choose from, however, picking the right ones can be a challenge.
			Semantic correctness helps improve accessibility and searchability, however, so it's generally worth the effort.
			Choose the most semantically appropriate element to enclose your content.
		</p>
		<p class="rule partial">
			Pick the right tag: don't use an <code>a</code> tag if you're not <em>linking</em> somewhere. Use a <code>button</code> instead
		</p>
	</section>
	<section>
		<p>
			Like other languages, being concise is just as important as being correct, so when writing markup, less is best.
			<span class="ref">As a result, it's important to avoid mixing extra presentational markup along with the semantic kind.
			Wrappers, spacers, containers, etc. are often necessary, but in all cases obfuscate meaning.</span>
		</p>
		<p class="rule partial">
			As much as possible, avoid presentational elements in your markup
		</p>
	</section>
	<section>
		<h3 class="outline" id="attributes">Attributes</h3>
		<p>
			Each element, depending on it's type, may support one or more attributes in addition to the default ones
			(<code>id</code>, <code>class</code>, <code>style</code>, <code>title</code>).
			<span class="ref">Tag specific attributes are used to provide additional information or configuration. </span>
			The majority of attributes are <code>name="value"</code> pairs, though some are boolean attributes:
		</p>
		<pre class="partial"><code class="language-html">
&lt;input type=&#x27;checkbox&#x27; checked /&gt; &lt;!-- true --&gt;
&lt;input type=&#x27;checkbox&#x27; checked=&quot;&quot; /&gt; &lt;!-- true --&gt;
&lt;input type=&#x27;checkbox&#x27; checked=&quot;checked&quot; /&gt; &lt;!-- true --&gt;
&lt;input type=&#x27;checkbox&#x27; checked=&quot;totally-checked-out&quot; /&gt; &lt;!-- true, but weird --&gt;
&lt;input type=&#x27;checkbox&#x27; checked=&quot;true&quot; /&gt; &lt;!-- true, but wrong syntax --&gt;
&lt;input type=&#x27;checkbox&#x27; checked=&quot;false&quot; /&gt; &lt;!-- still true! --&gt;
&lt;input type=&#x27;checkbox&#x27; /&gt; &lt;!-- false --&gt;
		</code></pre>
		<p class="rule partial">
			Boolean attributes are only <code>false</code> when they don't exist
		</p>
	</section>
	<section>
		<h4 class="outline" id="attr-id-classes">IDs and Classes</h4>
		<p>
			All elements can have a unique <code>id</code> attribute. This serves both as an anchor link target for linking within a page,
			and a means to identify an element in <span class="sans">CSS</span> or <span class="sans">Javascript</span>.
		</p>
		<p class="partial">
			Elements can also have one or more <code>class</code> attributes. Classes are not unique, and enable multiple elements to share styling rules.
		</p>
		<p class="rule partial">
			In general, <code>id</code>s are for scripting and <code>class</code>es are for styling
		</p>
	</section>
	<section>
		<h4 class="outline" id="attr-data">data-Attributes</h4>
		<p>
			<span class="sans">HTML5</span> introduced the concept of <code>data-attributes</code>, which are custom attributes prefixed with '<code>data-</code>'.
			<span class="ref">Although it's always been possible to add arbitrary attributes to any element, <code>data-attributes</code> are an approved way of doing so,
			and enable the storage of custom data that can be retrieved later with <span class="sans">Javascript</span>:</span>
		</p>
		<pre class="partial"><code class="language-html">
&lt;img src=&quot;small.jpg&quot; data-src-medium=&quot;medium.jpg&quot; data-src-large=&quot;big.jpg&quot;&gt;
		</code></pre>
	</section>
	<section>
		<h3 class="outline" id="structural-elements">Structural Elements</h3>
		<div class="partial">
			<h4 class="outline" id="structural-elements-block-vs-inline">Block vs. Inline</h4>
			<p>
				All visual elements are, by default, one of two types: <em>block</em> or <em>inline</em>.
			</p>
		</div>
		<p class="partial">
			Block level elements begin on a new line, take up all available width, and can contain child elements, including other block level elements.
		</p>
		<p class="partial">
			Inline level elements, on the other hand, fall into the normal document flow, only take up their necessary width, and can only contain other inline elements as children.
		</p>
		<p class="rule partial">
			Use <code>div</code> for block wrapping, <code>span</code> for inline wrapping
		</p>
	</section>
	<section>
		<h4 class="outline" id="structural-elements-html5">HTML5 elements</h4>
		<p>
			<span class="sans">HTML5</span> has introduced a number of new structural elements to help with semantics.
			<code>article</code>, <code>header</code>, <code>nav</code>, <code>section</code>, <code>aside</code>, and <code>footer</code> are some of the most important additions.
			<span class="ref">Choosing when to use each one can be a challenge, however, so here's a handy <a href="http://html5doctor.com/downloads/h5d-sectioning-flowchart.png" target="_blank">flow chart</a>.</span>
		</p>
		<img class="partial" src="/assets/images/html5-elements.png" width="500px" height="500px" >
		<ul class="ref">
			In general:
			<li><code>article</code>: a collection of elements that can stand alone (news feed item, forum post, comment, story, etc)</li>
			<li><code>header</code>: a collection of introductory or navigational aids for a page or section</li>
			<li><code>nav</code>: major navigation within a page or site (not just a link or two)</li>
			<li><code>section</code>: a collection of content that has a heading. Not a replacement for <code>div</code></li>
			<li><code>aside</code>: content not related to the main content</li>
			<li><code>footer</code>: a collection of metadata about the enclosing page or section</li>
		</ul>
		<p class="rule ref">
			The <code>section</code> tag is not a wrapper for styling: use <code>div</code> for that
		</p>
	</section>
	<section>
		<p>
			As with most things, we have to find a workaround for <em>oldIE</em> if we want to use any new <span class="sans">HTML5</span> elements.
			<span class="ref">All browsers ignore unknown elements and render them with default inherited styling.
			Applying custom styling behaviour is therefore up to developers, and is easily added with basic <span class="sans">CSS</span>.
			<em>OldIE</em>, on the other hand, refuses to style <em>any</em> element is doesn't recognize, and simply ignores any style rules applied.
			It will also remove any children of a block-level element it doesn't recognize, adding them as siblings instead.
			Fortunately, there is a fix for both behaviours: create dummy elements first with <span class="sans">Javascript</span> before any unknown elements are parsed.</span>
			The best way to do this is add some <span class="sans">Javascript</span> to our <code>&lt;head&gt;</code>.
			<span class="sans">Modernizr</span> does this for us by default, otherwise you can include an <a href="http://code.google.com/p/html5shiv/" target="_blank">html5shiv</a>.
		</p>
		<p class="rule partial">
			Remember to patch <span class="sans">HTML5</span> elements for <em>oldIE</em>
		</p>
	</section>
	<section>
		<h3 class="outline" id="media-elements">Media Elements</h3>
		<p>
			The <code>video</code> and <code>audio</code> elements add significant native multimedia capabilities to the browser,
			but they are also significant for their introduction of nested source content:
		</p>
		<pre class="partial"><code class="language-html">
&lt;video width=&quot;640&quot; height=&quot;360&quot; controls&gt;
  &lt;source src=&quot;high.MP4&quot;  type=&quot;video/mp4&quot; media=&quot;all and (min-width:601px)&quot; /&gt;
  &lt;source src=&quot;low.MP4&quot;  type=&quot;video/mp4&quot; media=&quot;all and (max-width:600px)&quot; /&gt;
  &lt;source src=&quot;regular.WEBM&quot;  type=&quot;video/webm&quot; /&gt;
  &lt;source src=&quot;regular.OGV&quot;  type=&quot;video/ogg&quot; /&gt;
  &lt;object width=&quot;640&quot; height=&quot;360&quot;
    type=&quot;application/x-shockwave-flash&quot; data=&quot;fallback.SWF&quot;&gt;
    &lt;param name=&quot;movie&quot; value=&quot;fallback.SWF&quot; /&gt;
    &lt;img src=&quot;poster.JPG&quot; width=&quot;640&quot; height=&quot;360&quot; alt=&quot;__TITLE__&quot;
      title=&quot;No video playback capabilities, please download the video below&quot; /&gt;
    &lt;/object&gt;
&lt;/video&gt;
		</code></pre>
	</section>
	<section>
		<p>
			This simple construct enables browsers to choose the first appropriate format, and degrades gracefully on all devices.
			With any luck, one day we could have this for images so we can serve low resolution versions easily to mobile devices:
		</p>
		<pre class="partial"><code class="language-html">
&lt;!-- Not real code, just wishful thinking --&gt;
&lt;picture alt=&quot;responsive image&quot;&gt;
  &lt;source src=&quot;hires.png&quot; media=&quot;min-width:800px&quot;&gt;
  &lt;source src=&quot;midres.png&quot; media=&quot;network-speed:3g&quot;&gt;
  &lt;source src=&quot;lores.png&quot;&gt;
     &lt;!-- fallback for browsers without support --&gt;
     &lt;img src=&quot;midres.png&quot;&gt;
&lt;/picture&gt;
		</code></pre>
	</section>
	<section>
		<h3 class="outline" id="graphics-elements">Graphics Elements</h3>
		<p>
			There are two primary graphics elements available: <code>svg</code> and <code>canvas</code>
		</p>
		<p class="partial">
			<code>svg</code> is a type of retained mode graphics, where each object exists on a separate layer, and need not be redrawn repeatedly when moved.
			<span class="ref">It is a vector engine that generates drawn DOM elements, allowing for <span class="sans">Javascript</span> event handling and interactivity.
			<code>svg</code> syntax is an <code>xml</code> derivative, and is not supported on <em>oldIE</em>.
			The <a href="http://raphaeljs.com/">Raphaël</a> library is a good cross-browser alternative.</span>
		</p>
		<p class="partial">
			<code>canvas</code>, on the other hand, is a type of immediate mode graphics engine on a single layer, requiring global redraws for object movement.
			<span class="ref">It is a pixel manipulation engine with a vector-like drawing API, text rendering, and support for exporting to static image files.</span>
			It comes in 2D and 3D (<span class="sans">WebGL</span>) flavours.
		</p>
	</section>
	<section>
		<h3 class="outline" id="forms">Forms</h3>
		<p class="ref">
			Forms are a world unto themselves, and have traditionally been the only mode of interaction between user and server.
			Because of this importance and interactive nature, forms can often turn ugly and complex. Beware!
		</p>
		<p>
			At a basic level, a <code>form</code> is just a series of <code>input</code> elements that are sent to a server when submitted:
		</p>
		<pre class="partial"><code class="language-html">
&lt;form action=&quot;path/to/some/script&quot; method=&quot;post-or-get&quot;&gt;
  &lt;input id=&quot;name&quot; type=&quot;text&quot; value=&quot;&quot;&gt;
  &lt;input id=&quot;sex&quot; type=&quot;radio&quot; value=&quot;male&quot;&gt;
  &lt;input id=&quot;submit&quot; type=&quot;submit&quot; value=&quot;Submit&quot;&gt;
&lt;/form&gt;
		</code></pre>
		<p class="ref">
			In practice, <code>form</code>s are a web of interconnected and complex ui elements you have little control over.
			There are dozens of <code>input</code> types, each with it's own ui and styling unique to individual browsers.
			There are <code>date</code>-pickers, <code>ranges</code>, <code>checkbox</code>es, <code>color</code>-pickers, <code>file</code>-uploaders,
			and <code>radio</code> buttons, among others. There is even a <code>hidden</code> type used for all kinds of server voodoo.
		</p>
		<p class="ref">
			<strong>Warning</strong>: actual <a href="/form.html" target="_blank">code</a>.
		</p>
	</section>
	<section>
		<p>
			Keeping things simple will generally get the job done. Some guidelines:
		</p>
		<ul>
			<li class="partial"><code>form</code> needs an <code>action</code> and a <code>method</code></li>
			<li class="partial">an <code>input</code> can be assigned a default value by prefilling the <code>value</code> attribute (required by <code>radio</code> and <code>checkbox</code>)</li>
			<li class="partial">associate a <code>label</code> with a specific form element by nesting the element within the <code>label</code> tag</li>
			<li class="partial">or, associate a <code>label</code> with a specific form element by setting the <code>for</code> attribute to the element's <code>id</code></li>
			<li class="partial"><code>radio</code> buttons with the same <code>name</code> attribute are in the same group, with only one activated at a time</li>
			<li class="partial">there are no restrictions on the types of elements nested within a <code>form</code> (<code>div</code>, <code>span</code>, <code>h1</code>, etc.)</li>
		</ul>
	</section>
	<section>
		<pre><code class="language-html">
&lt;form action=&quot;path/to/some/script&quot; method=&quot;post-or-get&quot;&gt;
  &lt;label for=&quot;first_name&quot;&gt;First Name&lt;/label&gt;
  &lt;input type=&quot;text&quot; name=&quot;first_name&quot; value=&quot;&quot;&gt;
  &lt;label for=&quot;last_name&quot;&gt;Last Name&lt;/label&gt;
  &lt;input type=&quot;text&quot; name=&quot;last_name&quot; value=&quot;&quot;&gt;
  &lt;label&gt;&lt;input type=&quot;radio&quot; name=&quot;sex&quot;
    id=&quot;sexMale&quot; value=&quot;male&quot;&gt; male&lt;/label&gt;
  &lt;label&gt;&lt;input type=&quot;radio&quot; name=&quot;sex&quot;
    id=&quot;sexFemale&quot; value=&quot;female&quot;&gt; female&lt;/label&gt;
  &lt;label for=&quot;email&quot;&gt;Email&lt;/label&gt;
  &lt;input type=&quot;email&quot; name=&quot;email&quot; value=&quot;&quot;&gt;
  &lt;input id=&quot;submit&quot; type=&quot;submit&quot; value=&quot;Submit form&quot;&gt;
&lt;/form&gt;
		</code></pre>
	</section>
	<section>
		<h4 class="outline" id="forms-html5">HTML5 forms</h4>
		<p>
			Much of the <span code="sans">HTML5</span> spec involves improvements to forms:
		</p>
		<ul>
			<li class="partial">new input types: <code>color</code>, <code>number</code>, <code>date</code>, <code>range</code>, <code>email</code>, <code>tel</code>, <code>search</code>, <code>url</code>, etc</li>
			<li class="partial">new attributes: <code>placeholder</code>, <code>autocomplete</code>, <code>autofocus</code>, <code>maxlength</code>, <code>multiple</code>, <code>pattern</code>, <code>required</code>, etc</li>
			<li class="partial">validation of input values</li>
		</ul>
		<p class="partial">
			Not all of these new toys are ready to play with, but since the default input <code>type</code> is <code>text</code>, you can safely use most of these <em>today</em>.
		</p>
		<p class="rule partial">
			Use input types <code>email</code>, <code>tel</code>, <code>url</code> to customize the keyboard for mobile devices
		</p>
	</section>
	<section>
		<h3 class="outline" id="navigation">Menus</h3>
		<p>
			The markup for menubars, dropdowns, sidebar navigation, and similar generally follows a common approach.
			The link tags used to redirect the user are wrapped in one of two list types: ordered (<code>ol</code>) or unordered (<code>ul</code>):
		</p>
		<pre><code class="language-html">
&lt;nav class=&quot;sidebar-menu&quot; id=&quot;sidebarMenu&quot;&gt;
  &lt;ul&gt;
    &lt;li&gt;&lt;a href=&quot;section1&quot;&gt;section1&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href=&quot;section2&quot;&gt;section2&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href=&quot;section3&quot;&gt;section3&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href=&quot;section4&quot;&gt;section4&lt;/a&gt;&lt;/li&gt;
  &lt;/ul&gt;
&lt;/nav&gt;
		</code></pre>
		<p>
			This approach illustrates clearly the concept of semantics and the separation of presentation from markup.
			A menu is just a collection of links, and, from an <span class="sans">HTML</span> point of view, that's all there is to it.
			The visual magic is all handled in <span class="sans">CSS</span>, which brings us to our <a href="/lesson2">next lesson...</a>
		</p>
	</section>
	<section>
		<h2 class="pres">next up...CSS</h2>
	</section>
	<footer>
		<div class="highlight">
			<h2 class="outline" id="links">Links</h2>
			<ul>
				<li><a href="http://www.modernizr.com/" target="_blank">Modernizr</a></li>
				<li><a href="http://html5boilerplate.com/" target="_blank">HTML5 Boilerplate</a></li>
				<li><a href="http://code.google.com/p/html5shiv/" target="_blank">html5shiv</a></li>
				<li><a href="http://www.raphaeljs.com" target="_blank">Raphaël</a></li>
				<li><a href="http://caniuse.com/" target="_blank">CanIUse</a></li>
				<li><a href="http://html5please.us/" target="_blank">HTML5 please</a></li>
				<li><a href="http://developers.whatwg.org/" target="_blank">The WHATWG HTML5 technical spec for developers</a></li>
				<li><a href="http://diveintohtml5.info/index.html" target="_blank">Dive into HTML5 book</a></li>
				<li><a href="http://coding.smashingmagazine.com/2011/11/18/html5-semantics/" target="_blank">HTML5 semantics article</a></li>
				<li><a href="http://html5doctor.com/element-index/" target="_blank">HTML5Doctor element index</a></li>
				<li><a href="http://www.brucelawson.co.uk/2010/html5-articles-and-sections-whats-the-difference/" target="_blank">Articles and Sections, what's the difference?</a></li>
				<li><a href="http://html5boilerplate.com/docs/head-Tips/" target="_blank">Tips for your &lt;head&gt;</a></li>
				<li><a href="https://developer.apple.com/library/safari/#documentation/AppleApplications/Reference/SafariWebContent/UsingtheViewport/UsingtheViewport.html#//apple_ref/doc/uid/TP40006509-SW1" target="_blank">Setting up iOS viewport</a></li>
			</ul>
		</div>
	</footer>
</article>
<?php include '../_footer.php' ?>