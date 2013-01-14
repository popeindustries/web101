<?php include '../_header.php' ?>
<article>
	<header class="current">
		<h4>lesson 3</h4>
		<h1>CSS <span>part 2</span></h1>
	</header>

	<section>
		<h2 class="outline" id="typography">Typography</h2>
		<p>Although CSS can very capably position and style text, the typographic control available still pales in comparison to those in print.
			Combined with varied screen size and platform rendering differences, typography on the web is a challenge.
			Fortunately, however, there are many tools at our disposal, as well as several exciting additions currently in development.
		</p>
	</section>

	<section>
		<h3 class="outline" id="fontProperties">font-* property group</h3>
		<p>The <code>font-*</code> group of properties deals mainly with the selection and appearance of individual typefaces:
		</p>
		<ul class="partial">
			<li><code>font-family</code>: list of specific names or a generic font type</li>
			<li><code>font-size</code>: absolute or relative size</li>
			<li><code>font-style</code>: italic version (<code>normal | italic</code>)</li>
			<li><code>font-weight</code>: lightness or boldness</li>
			<li><code>font-variant</code>: small-caps (<code>normal | small-caps</code>)</li>
		</ul>
	</section>

	<section>
		<h4 class="outline" id="fontFamily">font-family</h4>
		<p>The font-family property is a prioritized list of font family names, or generic family types, used to select a font in which to render selected element text.
			<span class="ref">From highest to lowest priority, the selection of family to use is based on the availability of individual character glyphs, and takes into account other <code>font-*</code> properties applied. In general, the browser will select the first font on the list that is installed on the computer (or that can be downloaded using the information provided by an <code>@font-face</code> at-rule), or the system default for a generic font family type if one is specified</span></p>
		</p>
		<pre class="partial"><code class="language-css">
body {
  font-family: Georgia, Times, "Times New Roman", serif;
}
		</code></pre>
		<p class="rule partial">
			Always include a generic family name (<code>serif</code>, <code>sans-serif</code>, <code>cursive</code>, <code>fantasy</code>, <code>monospace</code>) as a final fallback
		</p>
	</section>

	<section>
		<h5 class="outline" id="fontFace">@font-face</h5>
		<p>Unfortunately, there are very few <code>font-family</code> choices that work by default across platforms/devices, so our choice of font families is limited.
			Fortunately, however, it is possible to use web friendly versions of any font with the <code>@font-face</code> at-rule. Doing so, we are able to load specific font styles and weights at runtime:
		</p>
  </section>
  <section>
		<pre><code class="language-css">
@font-face {
  font-family: 'MavenProBold';
  src: url('../fonts/mavenpro-bold-webfont.eot');
  src: url('../fonts/mavenpro-bold-webfont.eot?#iefix') format('embedded-opentype'),
    url('../fonts/mavenpro-bold-webfont.woff') format('woff'),
    url('../fonts/mavenpro-bold-webfont.ttf') format('truetype'),
    url('../fonts/mavenpro-bold-webfont.svg#MavenProBold') format('svg');
  font-weight: normal;
  font-style: normal;
}
		</code></pre>
		<p class="rule partial">
			use the <a href="http://www.fontsquirrel.com/fontface/generator">font squirrel</a> <code>@font-face</code> generator to convert a font to a web font
		</p>
	</section>

	<section>
		<h4 class="outline" id="fontSize">font-size</h4>
		<p><code>font-size</code> is the primary basis for establishing a consistent and unified typographic layout.
			Remembering that many typographic styles are <a href="../lesson2/#inheritance">inheritable</a>,
			setting the base <code>font-size</code> on the <code>body</code> will define a starting value from which all others may be derived.
			Using <code>em</code> values to specify an element's <code>font-size</code> will then be based off this initial value:
		</p>
  </section>
  <section>
		<pre class=""><code class="language-css">
body {
  font-size: 100%; /* browser default of 16px */
}
h1 {
  font-size: 2.5em; /* 40px = 16px * 2.5 */
}

body {
  font-size: 87.5%; /* 14px = 16px * 0.875 */
}
h1 {
  font-size: 2.5em; /* 35px = 16px * 2.5 */
}
		</code></pre>
  </section>
  <section>
		<p class="">Be aware that <code>em</code> values are compounded because they are relative to an element's parent value.
			As a result, if a parent element specifies a <code>font-size</code> of <code>0.875em</code> (<code>14px</code>), a child element with a <code>font-size</code> of <code>0.75em</code> is equivalent to <code>10.5px</code>, not <code>12px</code>.
		</p>
		<p class="rule partial">
			<code>em</code> values are relative to a <strong>parent</strong>'s <code>font-size</code>
		</p>
  </section>
  <section>
		<p>An alternative to <code>em</code> is the <code>rem</code> unit. This unit behaves exactly the same, with the exception that it is relative only to the base <code>font-size</code> value:
		</p>
		<pre class="partial"><code class="language-css">
body {
  font-size: 100%;
}
section {
  font-size: 0.875rem; /* 14px = 16px * 0.875 */
}
  section p {
    font-size: 0.75rem; /* 12px = 16px * 0.75 */
  }
		</code></pre>
		<p class="rule partial">
			<code>rem</code> values are relative to the <strong>root</strong> <code>font-size</code>
		</p>
		<div class="compatibility partial"><span class="no">oldIE</span><span class="yes">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div>
	</section>

	<section>
		<h5 class="outline" id="lineHeight">line-height</h5>
		<p>While <code>font-size</code> defines the amount of vertical space a line of text should occupy, the <code>line-height</code> property is used to set the vertical space between multiple lines.
			<span class="ref">In typesetting terms, <code>line-height</code> is equivalent to <em>leading</em>. In CSS terms, it is the value used to determine the amount of space above and below an in-line box.</span>
			It accepts the following values:
		</p>
		<ul class="partial">
			<li><code>normal</code>: browser default value (roughly 1.2)</li>
			<li><code>number</code>: unitless number to be multiplied by an element's font size (recommended)</li>
			<li><code>length</code>: specific size in px</li>
			<li><code>percentage</code>: relative to element's font size</li>
		</ul>
  </section>
  <section>
    <pre class=""><code class="language-css">
body {
  font-size: 100%; /* browser default of 16px */
  line-height: 1.5; /* 24px = 16px * 1.5 */
  /* each line will have 4px of negative space above and below */
}
    </code></pre>
		<p class="rule partial">
			percentage and em values have poor inheritance behaviour.<br>
			Use a unitless number instead
		</p>
	</section>

	<section>
		<h4 class="outline" id="fontWeight">font-weight</h4>
		<p>A font's weight is defined by keyword or value, and only applies if the current family supports multiple weights, otherwise the closest available weight is used:
		</p>
		<ul class="partial">
			<li><code>normal</code>: default weight (equivalent to <code>400</code>)</li>
			<li><code>bold</code>: bold weight (equivalent to <code>700</code>)</li>
			<li><code>lighter</code>: one weight lighter than parent element</li>
			<li><code>bolder</code>: one weight bolder than parent element</li>
			<li><code>100</code>, <code>200</code>, <code>300</code>, <code>400</code>: light weights (default to <code>normal</code> if no lighter weights available)</li>
			<li><code>600</code>, <code>700</code>, <code>800</code>, <code>900</code>: bold weights (default to <code>bold</code> if no other bold weights available)</li>
		</ul>
	</section>

	<section>
		<h4 class="outline" id="fontShortcut">font shortcut</h4>
		<p>The <code>font</code> property is a shortcut property combining all of the above properties into one:
		</p>
		<pre class="partial"><code class="language-css">
body {
  /* style(opt) weight(opt) variant(opt) size(opt)/line-height(opt) family */
  font: italic bold small-caps 100%/1.5 sans-serif;
}
		</code></pre>
	</section>

	<section>
		<h3 class="outline" id="textProperties">text-* property group</h3>
		<p>The <code>text-*</code> group of properties deals with the styling and placement of individual characters, words, and paragraphs:
		</p>
  </section>
  <section>
		<ul class="">
			<li><code>text-align</code>: text alignment in parent container (<code>left | center | right | justify</code>)</li>
			<li><code>text-decoration</code>: line drawn over, under, or through (<code>none | underline | overline | linethrough</code>)</li>
			<li><code>text-indent</code>: shift the first line of a paragraph from the edge of the container (negative values possible)</li>
			<li><code>text-overflow</code>: how overflowed text is displayed</li>
			<li><code>text-shadow</code>: drop shadow applied to text and it's <code>text-decoration</code></li>
			<li><code>text-transform</code>: text capitalization (<code>none | capitalize | uppercase | lowercase</code>)</li>
			<li><code>letter-spacing</code>: spacing between letters (length indicates increase/decrease <em>in addition</em> to the default value)</li>
		</ul>
	</section>

	<section>
		<h4 class="outline" id="textOverflow">text-overflow</h4>
		<p>Text that breaks outside of it's container can be truncated by setting <code>text-overflow</code> to either <code>clip</code> (cut text off) or <code>ellipsis</code> (replace trailing letters with '...'):
		</p>
		<div class="example-container partial">
			<pre class=""><code class="language-css">
h2.title {
  white-space: nowrap; /* prevent line from wrapping */
  overflow: hidden; /* REQUIRED */
  -o-text-overflow: ellipsis;
  text-overflow: ellipsis;
}
			</code></pre>
			<div class="example">
				<p style="width:220px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding-bottom:0">This is really inconveniently long title</p>
			</div>
		</div>
	</section>

	<section>
		<h4 class="outline" id="textShadow">text-shadow</h4>
		<p>One or several (separated by commas) drop shadows can be applied to text with the <code>text-shadow</code> property:
		</p>
		<div class="example-container partial">
			<pre class=""><code class="language-css">
span.shadow {
  color: white;
  /* offset-x offset-y blur-radius colour */
  text-shadow: 0px 1px 1px black;
}
			</code></pre>
			<div class="example">
				<h4 style="width:220px; color:white; text-shadow:0px 1px 3px black; margin:0; padding:0; text-align:center; font-size:1.2em; font-weight:bold;">shadow text</h4>
			</div>
		</div>
		<p class="rule partial"><code>
      text-shadow</code> does not require vendor prefixes (amazingly)
    </p>
		<div class="compatibility partial"><span class="no">oldIE</span><span class="no">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div>
	</section>

  <section>
    <h3 class="outline" id="rhythmAndScale">rhythm and scale</h3>
    <p>Typography is more than just selecting a font family, size, and styling. A page of text is a composition of words, sentences, and paragraphs that form a visual rhythm and tempo.
      Controlling the layout and sizing of elements should therefore conform to some sort of rule-based order.
    </p>
  </section>
  <section>
    <h4 class="outline " id="layoutBaselinesAndGrids">baselines and grids</h4>
    <p>One way to compose an ordered visual tempo is possible through the use of a combination of grid and baseline:
    </p>
  </section>
  <section>
    <h5 class="outline" id="grid">Grid</h5>
    <p>In a grid-based system, horizontal tempo is established by dividing the page width into evenly sized columns and gutters.
      <span class="ref">There are several approaches possible, and many grid systems <a href="http://960.gs" target="_blank">exist</a> <a href="http://cssgrid.net/" target="_blank">out</a> <a href="http://blueprintcss.org/" target="_blank">there</a>, but at it's most basic, column widths are set with a specific <code>width</code> value, and column placement is set with a specific <code>margin-left</code> value, pushing an element to the right in alignment with other elements in that column:</span>
    </p>
    <pre class="partial"><code class="language-css">
body {
  font-size: 100%;
  width: 960px;
}
/* column width of 60px and gutters of 20px */
.col1 { margin-left: 10px; }
.col2 { margin-left: 90px; }
...
.colSpan1 { width: 60px; }
.colSpan2 { width: 140px; }
...
    </code></pre>
  </section>

	<section>
		<h5 class="outline" id="baseline">Baseline</h5>
		<p>In a strict grid-based system, vertical tempo can be enforced by the use of a baseline value to evenly space elements vertically in the page.
      <span class="ref">Using this 'magic' value, it's possible to define sizing and spacing combinations that conform to this layout for headings, images, and all other content.</span>
      Naturally, a baseline value equivalent to the base <code>line-height</code> makes an ideal starting point:
		</p>
  </section>
  <section>
    <pre class=""><code class="language-css">
body {
  font-size: 100%; /* browser default of 16px */
  line-height: 1.5; /* 24px = 16px * 1.5 */
  /* 24px is our magic baseline number */
}
h1 {
  font-size: 2em; /* 32px = 16px * 2 */
  margin: 0;
  padding: 0.75em 0;
  /* total height = line-height + padding-top + padding-bottom */
  /* 72px = (32px * 1.5) + ((0.75 * 16px) * 2) */
}
    </code></pre>
    <p class="rule partial">
      when enforcing a baseline grid, it's often best to use <code>padding</code> rather than <code>margin</code> to enforce spacing in order to avoid <a href="https://developer.mozilla.org/en/CSS/margin_collapsing">margin collapsing</a>
    </p>
	</section>

	<section>
		<h4 class="outline" id="modularScale">modular scale</h4>
    <p>Another approach to rule-based layout order is the creation of a modular scale of meaningful, resonant numbers that can be used for sizing, spacing, and dimensioning of elements.
      Inspired by work in <a href="http://www.amazon.com/gp/product/0881792063?ie=UTF8&tag=keepswimming-20&linkCode=as2&camp=1789&creative=9325&creativeASIN=0881792063" target="_blank">The Elements of Typographic Style</a>, modular scales are often based on a significant ratio, from the golden section (1:1.618), to musical scales (the perfect fourth 4:3, the perfect fifth 3:2, etc).
    </p>
    <p class="ref">There are several tools available for generating modular scales (<a href="http://lamb.cc/typograph/" target="_blank">typograph</a>, <a href="http://modularscale.com/" target="_blank">modularscale.com</a>), and lots of <a href="http://blog.8thlight.com/billy-whited/2011/10/28/r-a-ela-tional-design.html#tips" target="_blank">nerdy</a>, <a href="http://24ways.org/2011/composing-the-new-canon" target="_blank">explanations</a> on <a href="http://www.alistapart.com/articles/more-meaningful-typography/" target="_blank">why</a> you should be doing so.
    </p>
	</section>

	<section>
		<h2 class="outline" id="colourValues">Colours</h2>
		<p>Several CSS properties accept colour values, including <code>color</code>, <code>background-color</code>, and <code>border-color</code>. Although hex colour is the most common way, several colour formats are valid:
		</p>
  </section>
  <section>
		<ul class="">
			<li><strong>keyword</strong> (<code>red</code>, <code>blue</code>, <code>green</code>, etc): output varies by platform, but often useful for quick and dirty debugging</li>
			<li><strong>hex</strong> (<code>#ff9933</code> or <code>#f93</code>): each colour channel (r, g, b) expressed in hexadecimal notation</li>
			<li><strong>rgb</strong> (<code>rgb(0,128,255)</code>): each colour channel from 0-255 expressed in functional notation </li>
			<li><strong>hsl</strong> (<code>hsl(0,50%,25%)</code>): a hue angle from 0-360, followed by saturation and lightness percentage values from 0-100%, expressed in functional notation
			<div class="compatibility"><span class="no">oldIE</span><span class="yes">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div></li>
			<li><strong>rgba</strong> (<code>rgba(0,128,255,0.5)</code>): each colour channel from 0-255, plus an additional alpha value from 0-1, expressed in functional notation
			<div class="compatibility"><span class="no">oldIE</span><span class="yes">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div></li>
			<li><strong>hsla</strong> (<code>hsla(0,50%,25%,0.5)</code>): a hue angle from 0-360, followed by saturation and lightness percentage values from 0-100%,  plus an additional alpha value from 0-1, expressed in functional notation
			<div class="compatibility"><span class="no">oldIE</span><span class="yes">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div></li>
			<li><strong>transparent</strong> (<code>transparent</code>): no colour (useful for resetting previously applied colour)</li>
		</ul>
	</section>

	<section>
		<h2 class="outline" id="backgrounds">Backgrounds</h2>
		<p><span class="ref">Remembering that each element is a <a href="../lesson2/#box-model">rectangular box</a>, we can style our content by filling an element's background.</span>
			CSS allows us to fill an element with a background colour and/or one or more images (including generated gradients). There are several <code>background-*</code> properties available to control how an element's background appears:
		</p>
  </section>
  <section>
		<ul class="">
			<li><code>background-color</code>: a valid colour value (hex, rbg, rgba, hsl, hsla)</li>
			<li><code>background-image</code>: one or more image urls (or gradients)</li>
			<li><code>background-position</code>: initial position of each image</li>
			<li><code>background-repeat</code>: how each image repeats horizontally and vertically (<code>no-repeat | repeat</code>)</li>
			<li><code>background-attachment</code>: fix/scroll image with the viewport (<code>scroll | fixed | local</code>)</li>
			<li><code>background-size</code>: size of image</li>
		</ul>
	</section>

	<section>
		<h3 class="outline" id="backgroundImage">background-image</h3>
		<p>The <code>background-image</code> property attaches one or more images to an element's background area.
			Multiple backgrounds are simple separated by a comma:
		</p>
		<div class="example-container partial">
			<pre class=""><code class="language-css">
div.box {
  background-image: url('cat.jpg'), url('dog.jpg');
  background-repeat: no-repeat;
  background-position: top left, bottom right;
}
			</code></pre>
			<div class="example">
				<div style="width:70px; height:70px; background-image: url('../assets/images/little-image.jpg'), url('../assets/images/puppy.jpg'); background-repeat: no-repeat; background-position: top left, bottom right;"></div>
			</div>
		</div>
		<p class="rule partial">
			When using multiple <code>background-images</code>, the z-order is reversed, with the first image on top
		</p>
    <div class="compatibility partial"><span class="no">oldIE (multiple bg)</span><span class="yes">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div>
	</section>

	<section>
		<h4 class="outline" id="gradients">gradients</h4>
		<p>CSS3 makes it possible to generate gradient images for use in the <code>background-image</code> property.
			Gradients come in both linear and radial flavours:
		</p>
		<div class="example-container partial">
			<pre class=""><code class="language-css">
div.box {
  /* requires vendor prefixed versions */
  background-image: linear-gradient(to bottom right, blue, white);
}

			</code></pre>
			<div class="example">
				<div style="width:50px; height:50px; background-image: -webkit-linear-gradient(left top, #009bc8, white); background-image: -moz-linear-gradient(left top, #009bc8, white); background-image: linear-gradient(to right bottom, #009bc8, white);"></div>
			</div>
		</div>
		<p class="rule partial">
			as the syntax is still under development, it's advisable to use a syntax <a href="http://www.colorzilla.com/gradient-editor/">generator</a> or preprocessor to cover all the variations
		</p>
		<div class="compatibility partial"><span class="no">oldIE</span><span class="no">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div>
		<p class="ref">There are a number of <a href="http://lea.verou.me/css3patterns/">impressive</a> background patterns that can be generated with gradients.</p>
	</section>

	<section>
		<h4 class="outline" id="spriteSheets">sprite sheets</h4>
		<p>Sprite sheets are a great way to reduce the number of http requests by combining a number of images into one file.
			This enables the same file to used for multiple element backgrounds:
		</p>
  </section>
  <section>
		<div class="example-container">
			<pre class=""><code class="language-css">
div.circle {
  background-image: url('sprite.png');
  width: 50px;
  height: 50px;
}
#blackCircle {
  background-position: -10px -10px;
}
#greenCircle {
  background-position: -110px -10px;
}

			</code></pre>
			<div class="example">
				<div style="width:50px; height:50px; background-image: url('../assets/images/sprite.png'); background-position: -10px -10px;"></div>
				<div style="width:50px; height:50px; background-image: url('../assets/images/sprite.png'); background-position: -110px -10px; margin-top: 10px;"></div>
			</div>
		</div>
		<p class="rule partial">
			be sure to use a logical layout grid in your .psd, and remember to leave enough transparent area around each image
		</p>
	</section>

	<section>
		<h4 class="outline" id="inline">inline</h4>
		<p>In certain circumstances (when not using a sprite sheet, for example) it may be desirable to embed an image directly in CSS.
			This saves making an additional http request, and is ideal for small icons:
		</p>
  </section>
  <section>
		<div class="example-container ">
			<pre class=""><code class="language-css">
div.box {
  background-image: url('data:image/png;base64,R0lGODlhDwALANUAACYpK////
    7KztEhLTJKUlU5QUv7+/mNlZy8yNCksLWttbjo8PmFjZJCRkk9RU7W2t9rb29jY2Zqbn
    udnpmam0tNT9/f30dKS01QUb/AwUBCRCksLkBDRUFERqanqP39/S8xM/X19ebn59bX13
    V3eNnZ2uDh4Xh6e42PkCwvMWhqbPz8/Jyen/Hx8X+Bgvj4+O3t7js+QK+wsa2urwAAAA
    AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAPAAsAAA
    ZUQIBwOKwciMIOgjiAvThIhakRE0YCAcuAmFgFQiQVFltCygzYzxgrYAwL63jANQQR5A
    EDJqXZDCFyFEIXLDMSEyJxGUQFI3ItBEhCDigCDx4nC0hBADs=');
}

			</code></pre>
			<div class="example">
				<div class="example-inline" style="width:20px; height:20px;"></div>
			</div>
		</div>
		<p class="rule partial">
			open terminal and use the following command to copy the generated data to the clipboard:<br>
			<code>openssl base64 < path/to/file | tr -d '\n' | pbcopy</code>
		</p>
	</section>

	<section>
		<h3 class="outline" id="backgroundPosition">background-position</h3>
		<p>The positioning of background images is specified by the following values:
		</p>
		<ul class="partial">
			<li>percentages: size of the background, minus the size of the image (0% = <code>top</code>/<code>left</code>, 50% = <code>center</code>, 100% = <code>bottom</code>/<code>right</code>)</li>
			<li>lengths: px/em/etc placement from the <code>left</code> and <code>top</code></li>
			<li>keywords: <code>top</code>, <code>right</code>, <code>bottom</code>, <code>left</code>, <code>center</code></li>
		</ul>
  </section>
  <section>
		<div class="example-container ">
			<pre class=""><code class="language-css">
div.box {
  background-image: url('cat.jpg');
  background-position: 50% 50%;
  background-repeat: no-repeat;
  background-color: black;
}
			</code></pre>
			<div class="example">
				<div style="width:70px; height:60px; background-image: url('../assets/images/little-image.jpg'); background-repeat:no-repeat; background-position:50% 50%; background-color:#33342c"></div>
			</div>
		</div>
		<p class="rule partial">
			centering a background image behaves as expected: <code>50%</code> or <code>center</code> places the image in the middle of the background automatically
		</p>
	</section>

	<section>
		<h3 class="outline" id="backgroundSize">background-size</h3>
		<p>The background-size property enables resizing of background images, and is specified by the following values:
		</p>
		<ul class="partial">
			<li>percentage: relative to background area (horizontal and vertical)</li>
			<li>lengths: px/em/etc value (horizontal and vertical)</li>
			<li>keywords: <code>contain</code> (fill background with letterboxing) or <code>cover</code> (fill background with cropping)</li>
		</ul>
  </section>
  <section>
		<div class="example-container">
			<pre class=""><code class="language-css">
div.box {
  background-image: url('cat.jpg');
  background-size: cover;
}
			</code></pre>
			<div class="example">
				<div style="width:70px; height:60px; background-image: url('../assets/images/little-image.jpg'); background-size:cover"></div>
			</div>
		</div>
		<p class="rule partial">
			it's possible to simulate <code>background-size: cover</code> on oldIE by using the following filter: <code>filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='myBackground.jpg', sizingMethod='scale')";</code>
		</p>
		<div class="compatibility partial"><span class="no">oldIE</span><span class="yes">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div>
	</section>

	<section>
		<h3 class="outline" id="borderRadius">border-radius</h3>
		<p>The <code>border-radius</code> property allows us to modify an element's rectangular bounding box by adding rounded corners:
		</p>
  </section>
  <section>
		<div class="example-container ">
			<pre class=""><code class="language-css">
div.box {
  -webkit-border-radius:10px;
  -moz-border-radius:10px;
  -o-border-radius:10px;
  -ms-border-radius:10px;
  border-radius:10px;
}
div.circle {
  -webkit-border-radius:25px;
  -moz-border-radius:25px;
  -o-border-radius:25px;
  -ms-border-radius:25px;
  border-radius:25px;
}
			</code></pre>
			<div class="example">
				<div style="width:50px; height:50px; background-color:#009bc8; -webkit-border-radius:10px; -moz-border-radius:10px; border-radius:10px;"></div>
				<div style="width:50px; height:50px; background-color:#009bc8; -webkit-border-radius:25px; -moz-border-radius:25px; border-radius:25px; margin-top: 10px;"></div>
			</div>
		</div>
  </section>
  <section>
		<p class="rule">
			<code>border-radius</code> is a shortcut property, so it's also possible to set the radius on individual corners: <br>
			<code>border-top-left-radius</code>, <code>border-top-right-radius</code>, <code>border-bottom-right-radius</code>, <code>border-bottom-left-radius</code>
		</p>
		<div class="compatibility partial"><span class="no">oldIE</span><span class="yes">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div>
	</section>

	<section>
		<h3 class="outline" id="boxShadow">box-shadow</h3>
		<p>The <code>box-shadow</code> property makes it possible to add one or more drop shadow effects to the outside or inside of an element's bounding box:
		</p>
  </section>
  <section>
		<div class="example-container">
			<pre class=""><code class="language-css">
div.box {
  /* inset(opt) offset-x offset-y blur-radius(opt) spread-radius(opt) colour */
  -webkit-box-shadow: 0 2px 2px 1px rgba(0,0,0,0.5);
  -moz-box-shadow:0 2px 2px 1px rgba(0,0,0,0.5);
  -o-box-shadow:0 2px 2px 1px rgba(0,0,0,0.5);
  -ms-box-shadow:0 2px 2px 1px rgba(0,0,0,0.5);
  box-shadow:0 2px 2px 1px rgba(0,0,0,0.5);
}
			</code></pre>
			<div class="example">
				<div style="width:50px; height:50px; background-color:white; -webkit-box-shadow: 0 2px 2px 1px rgba(0,0,0,0.5); -moz-box-shadow:0 2px 2px 1px rgba(0,0,0,0.5); box-shadow:0 2px 2px 1px rgba(0,0,0,0.5);"></div>
			</div>
		</div>
		<p class="rule partial">
			When using multiple shadows, the z-order is reversed, with the first shadow on top
		</p>
		<div class="compatibility partial"><span class="no">oldIE</span><span class="yes">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div>
	</section>

	<section>
		<h2 class="outline" id="generatedContent">Generated Content</h2>
		<p>With the goal of keeping <a href="../lesson1/#semantics">presentational markup</a> out of our html, sometimes it's necessary to generate content directly inside of CSS.
			The <code>:before</code> and <code>:after</code> pseudo-elements allow us do just that by allowing us to define new content and styling on any <strong>container</strong> element:
		</p>
  </section>
  <section>
		<div class="example-container">
			<pre class=""><code class="language-css">
h2.title:after {
  content: ''; /* can be text content or image url() */
  display: block;
  position: absolute;
  bottom: 10px;
  left: 25%;
  width: 50%;
  height: 2px;
  background-color: blue;
}
			</code></pre>
			<div class="example">
				<h2 class="example-after" style="text-align:center; padding:0; margin:0; color:#009bc8; ">some title</h2>
			</div>
		</div>
		<p class="rule partial">
			generated content cannot (currently) take advantage of css-transitions
		</p>
		<div class="compatibility partial"><span class="no">oldIE (:after)</span><span class="yes">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div>
		<p class="ref">Take a look at all the fancy things you can do with these pseudo-elements: <a href="http://nicolasgallagher.com/css-drop-shadows-without-images/" target="_blank">totally</a>, <a href="http://css-tricks.com/pseudo-element-roundup/">cool!</a></p>
	</section>

	<section>
		<h2 class="outline" id="transitions">Transitions</h2>
    <p>CSS transitions allow property changes to be applied over time. Not all properties can be transitioned, but, in general, colours and properties with numeric values can all be changed over time.
      Transitions are defined with the following properties:
    </p>
    <ul class="partial">
      <li><code>transition-property</code>: the property to transition (<code>none | all | <em>property name</em></code>) </li>
      <li><code>transition-duration</code>: the duration in seconds(s) or milliseconds(ms)</li>
      <li><code>transition-timing-function</code>: the function used to determine how intermediate values are computed (<code>ease | linear | ease-in | ease-out | ease-in-out | <em>cubic bezier formula</em></code>)</li>
      <li><code>transition-delay</code>: the delay in seconds(s) or milliseconds(ms)</li>
    </ul>
  </section>
  <section>
    <p>To enable transitions on a selector, the <code>transition-*</code> properties must be defined up front. When a transitioned property's value is changed later on, the property will then animate for the specified duration:
    </p>
    <div class="example-container partial">
      <pre class=""><code class="language-css">
div.rollMe {
  background-color: blue;
  /* vender prefixes required */
  transition-property: background-color;
  transition-duration: 500ms;
  transition-timing-function: ease-out;
}
div.rollMe:hover {
  background-color: yellow;
}
      </code></pre>
      <div class="example">
        <div class="example-transition" style="width:50px; height: 50px; background-color:#009bc8; "></div>
      </div>
    </div>
  </section>
  <section>
    <p>The <code>transition</code> property is a shortcut property combining all of the above properties into one:
    </p>
    <pre class="partial"><code class="language-css">
a {
  /* property duration timing-function delay */
  -webkit-transition: all 500ms ease 100ms;
  -moz-transition: all 500ms ease 100ms;
  -o-transition: all 500ms ease 100ms;
  transition: all 500ms ease 100ms;
}
    </code></pre>
  </section>
  <section>
    <ul class="">In general, there are three ways to change a property:
      <li>selector pseudo class (<code>:hover</code>, <code>:focus</code>, etc)</li>
      <li>adding/removing an element's class with javascript</li>
      <li>modifying an element's css property directly with javascript</li>
    </ul>
    <p class="rule partial">
      as long as transitions are only for sexiness sake, there is generally no need to provide a javascript fallback for IE
    </p>
    <div class="compatibility partial"><span class="no">oldIE</span><span class="no">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div>
  </section>

	<section>
		<h2 class="outline" id="transformations">Transformations</h2>
    <p>CSS transforms modify the coordinate space of affected content without disrupting the normal page flow. Transforms enable rotation, scaling, skewing, and translation.
    </p>
    <p>There are two properties used to define a transformation:
    </p>
    <ul class="partial">
      <li><code>transform-origin</code>: position of origin (<code><em>percentage</em> | <em>length</em> | top | right | bottom | left</code>)</li>
      <li><code>transform</code>: a space separated list of transforms to apply (<code>none | <em>transform function</em> [rotate | scale | scaleX | scaleY | skewX | skewY | translate | translateX | translateY | matrix]</code>)</li>
    </ul>
  </section>
  <section>
    <div class="example-container">
      <pre class=""><code class="language-css">
div.rotateMe {
  background-color: blue;
  /* vender prefixes required */
  transform-origin: 50% 50%/
}
div.rotateMe:hover {
  /* vender prefixes required */
  transform: rotate(45deg);
}
      </code></pre>
      <div class="example">
        <div class="example-transform" style="width:50px; height: 50px; background-color:#009bc8; transform-origin: 50% 50%; "></div>
      </div>
    </div>
    <p class="rule partial">
      3D transforms are also possible on certain platforms
    </p>
    <div class="compatibility partial"><span class="no">oldIE</span><span class="yes">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div>
	</section>

	<section>
		<h2 class="outline" id="mediaQueries">Media Queries</h2>
    <p>Media queries allow us to limit style scope based on the current media's features (width, height, colour, pixel-density, etc.).
      This allows us to target styles for specific ranges of device. We have already seen that <a href="../lesson1/#head-runtime-env-media-queries">media queries in html</a> can be used to load different style sheets, but it's also possible to use media query statements directly in CSS as well:
    </p>
  </section>
  <section>
   <pre class=""><code class="language-css">
/* big screen */
@media screen and (min-width: 1200px) { /* styles here */ }
/* medium screen */
@media screen and (min-width: 700px)
  and (max-wdith: 1199px) { /* styles here */ }
/* small screen */
@media screen and (max-width: 699px) { /* styles here */ }
/* smart phone */
@media screen and (min-device-width: 320px)
  and (max-device-width: 480px) { /* styles here */ }
/* tablet: landscape */
@media screen and (min-device-width: 768px)
  and (max-device-width: 1024px)
  and (orientation: landscape) { /* styles here */ }
/* high pixel density device */
@media screen and (-webkit-min-device-pixel-ratio: 2),
  screen and (min-device-pixel-ratio: 2) { /* styles here */ }
    </code></pre>
  </section>
  <section>
    <p class="rule ">
      a fluid layout with adjustments at small/medium/large sizes will be the most device friendly approach:
      targeting specific pixel sizes may not cover all possible devices
    </p>
    <div class="compatibility partial"><span class="no">oldIE</span><span class="yes">IE</span><span  class="yes">Webkit</span><span  class="yes">Firefox</span><span  class="yes">iOS</span><span  class="yes">Android</span></div>
	</section>

	<section>
		<h2 class="outline" id="preprocessors">Preprocessors</h2>
    <p>CSS is rich with features, but because it's a standardized language, change can come slowly, and when it does come, it is often burdened with experimental prefixes (and more typing).
      As a result, there are many tools available that treat CSS as a compile target. These preprocessors can simplify development by improving syntax and other shortcuts, then generate CSS on command.
      Some of the features available can include:
    </p>
  </section>
  <section>
    <ul class="">
      <li>clean syntax (no brackets or semicolons)</li>
      <li>nested rules</li>
      <li>reusable variables</li>
      <li>reusable functions</li>
      <li>vendor prefixing</li>
    </ul>
    <p class="partial">Some of the most popular preprocessors include <a href="http://learnboost.github.com/stylus/" target="_blank">Stylus</a>, <a href="http://lesscss.org/" target="_blank">Less</a>, and <a href="http://sass-lang.com/" target="_blank">Sass</a>.
    </p>
    <p class="rule partial">
      all preprocessors rely on an underlying programming environment (Node.js, Ruby, etc), and are generally not for the terminal shy
    </p>
	</section>

	<section>
		<h2 class="outline" id="debugging">Debugging</h2>
    <p>The best way to debug CSS is directly in the browser. Modern browsers all have excellent debugging tools built in, just right-click an element and 'inspect' it.
    </p>
  </section>
  <section>
    <img class="" src="../assets/images/debugger.jpg" alt="debugger">
    <p class="partial">From within the inspector panel it's possible to see which styles are currently being applied, and edit those styles in real-time, including adding new ones.
    </p>
    <p class="rule partial">
      do yourself a favour and learn to love the debugging inspector
    </p>
	</section>

	<footer>
		<div class="highlight">
			<h2 class="outline" id="links">Links</h2>
			<ul>
				<li><a href="http://www.alistapart.com/articles/howtosizetextincss/" target="_blank">How to size text</a></li>
				<li><a href="http://coding.smashingmagazine.com/2011/03/14/technical-web-typography-guidelines-and-techniques/" target="_blank">Technical web typography</a></li>
				<li><a href="https://developer.mozilla.org/en/CSS/color_value" target="_blank">CSS colours explained</a></li>
        <li><a href="http://coding.smashingmagazine.com/2011/07/13/learning-to-use-the-before-and-after-pseudo-elements-in-css/" target="_blank">Learning to use :before and :after pseudo-elements</a></li>
				<li><a href="http://www.westciv.com/tools/transforms/" target="_blank">Transforms generator</a></li>

			</ul>
		</div>
	</footer>
</article>
<?php include '../_footer.php' ?>