<div class="homeContent">
	<div class="homeTopBar">
		<a href="#" title="View Collector Catalog" class="catalog">View Collector Catalog</a>
		<div class="searchPan">
		<form action="#" id="search">
			<input type="text" value="Search your product" class="searchText" />
			<input type="button" value="" class="searchBtn" />
		</form>
		</div>
	</div>
	<h1>Collector Catalog</h1>
	<p>Cloisonné products are by far the best quality, most beautiful and longest lasting of all the lapel pin, medallion and jewelry making techniques.  At MaxPins we specialize in working with this ancient and elegant process.  Our designs take the utmost advantage of this craft to customize pins of the highest quality that you will be proud to have displayed and wear.</p>
	<p>We offer Cloisonné products for retail marketing, business logos, organization events, marketing products and a complete lines of US Route 66 and Southwestern states tourist products.</p>
	<p>Cloisonné is an ancient technique combining metalworking with other crafts.  It is a multi-step process used to produce icons, plaques, jewelry, vases, and many other items. Each color of a cloisonné object is separated from other colors by silver or gold wires and has the appearance of stone inlay.</p>
	
	<div class="categoriesPan">
		<div class="categoriesLeft" >
		<h2>Categories</h2>
		<ul>
			<li data-ng-repeat="category in categoryListMenu"><input type="checkbox" name="category[]" value="{{category.category_id}}" id="cat-{{category.category_id}}" class="categoryChkBx" data-ng-model="category" /><span>{{category.category_name}}</span></li>
		</ul>
		</div>
		<div class="categoriesRight" >
			<div class="proListHome">
			<ul>
				<li data-ng-repeat="product in products">
					<a href="#/product-details" title=""><!--<img src="{{product.imagecat}}" alt="" />--></a>
					<h3>{{product.product_name}}</h3>
					<p>${{product.price}}</p>
					<span class="blueBox">
						<span><a href="#" title="">Order now</a>
						<strong>/</strong></span>
						<a href="#" title="">View details</a>
					</span>
				</li>
			</ul>
		</div>
		</div>
		<br class="spacer" />
	</div>
	
</div>