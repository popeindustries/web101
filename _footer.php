		<div id="progress" class="pres">
			<p>60</p>
		</div>
		<aside>
			<h1>web 101</h1>
			<nav>
				<ul>
					<li>
						<a href="/lesson1">
							<h4>lesson 1</h4>
							<h2>HTML</h2>
							<p class="description">An exploration of the key elements making up an HTML document</p>
						</a>
					</li>
					<li>
						<a href="/lesson2">
							<h4>lesson 2</h4>
							<h2>CSS <span>part 1</span></h2>
							<p class="description">An introduction to how styles are applied to HTML elements</p>
						</a>
					</li>
					<li>
						<a href="/lesson3">
							<h4>lesson 3</h4>
							<h2>CSS <span>part 2</span></h2>
							<p class="description">An exploration of the visual capabilities of CSS</p>
						</a>
					</li>
					<li class="">
						<a href="/lesson4">
							<h4>lesson 4</h4>
							<h2>JS <span>part 1</span></h2>
							<p class="description">An introduction to JS fundamentals</p>
						</a>
					</li>
					<li class="">
						<a href="/lesson5">
							<h4>lesson 5</h4>
							<h2>JS <span>part 2</span></h2>
							<p class="description">An exploration of JS and the browser</p>
						</a>
					</li>
					<li class="">
						<a href="/lesson6">
							<h4>lesson 6</h4>
							<h2>JS <span>part 3</span></h2>
							<p class="description">An exploration of JS code organization and optimization</p>
						</a>
					</li>
				</ul>
			</nav>
		</aside>
		<script src="/assets/js/highlight.pack.js"></script>
		<script src="/assets/js/libs.js"></script>
		<script src="/assets/js/main.js"></script>
		<script>
			(function() {
				var config = {
					log: {
						locations: ['dev.school']
					}
				};
				// Init when DOM ready
				require('pi/dom/ready')(function() {
					require('main').init(config);
				});
			})();
		</script>
	</body>
</html>