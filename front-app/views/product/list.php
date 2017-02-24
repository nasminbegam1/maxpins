<div class="homeContent">
	<div class="homeTopBar">
		<!--<a href="#" title="View Collector Catalog" class="catalog">View Collector Catalog</a>-->
		<div class="searchPan">
		<form  id="search" data-ng-submit="searchProduct()">
			<input type="text" placeholder="Search your product" class="searchText" data-ng-model="keyword" />
			<input type="button" value="" class="searchBtn" data-ng-click="searchProduct()"/>
		</form>
		</div>
	</div>
	<h1>Collector Catalog</h1>
	<!--<p ng-bind-html="cmsContent | to_trusted"  >-->
		
	</p>
	<div class="categoriesPan">
		<div class="categoriesLeft" >
		<h2>Product Type</h2>
		<ul>
			<li data-ng-repeat="type in productTypeList"><input type="radio" name="product_type" value="{{type.id}}" id="cat-{{type.id}}" class="categoryChkBx" ng-checked="type.checked" data-ng-click = "searchCheckProductType($event)" /><span>{{type.type_name}}</span></li>
		</ul>
		<h2>Categories</h2>
		<ul>
			<li data-ng-repeat="category in categoryListMenu"><input type="checkbox" name="category[]" value="{{category.category_id}}" id="cat-{{category.category_id}}" class="categoryChkBx" ng-checked="category.checked" data-ng-click = "searchCheckProduct($event)" /><span>{{category.category_name}}</span></li>
		</ul>
		</div>
		<div class="categoriesRight" >
			<div class="proListHome">
			<ul data-ng-class="(products.length > 0)? 'ng-show':'ng-hide'">
				<li data-ng-repeat="product in products" >
					
					<a href="#/products/{{product.product_slug}}" title=""><img src="{{product.image_name}}" alt="" /></a>
					<h3>{{product.product_name}}</h3>
					<p data-ng-class="(Global.log()!='')?'ng-show':'ng-hide'">${{product.price}}</p>
					<span class="blueBox">
						<!--data-ng-class="(Global.log()!='')?'ng-show':'ng-hide'"-->
						<span data-ng-class="(Global.log()!='')?'ng-show':'ng-hide'">
							<a href="#/products/{{product.product_slug}}" title="" data-ng-click="processdetails($event)">Order now</a>
							<!--<a  title="" data-ng-click="processdetails($event)">Order now</a>-->
						</span>
						<span data-ng-class="(Global.log()=='')?'ng-show':'ng-hide'">
						<a href="#/products/{{product.product_slug}}" title="" data-ng-click="processdetails($event)">View details</a>
						</span>
						
					</span>
					
					<span class="checkPan ng-hide">
						
						<a  class="succstatus" style="display: none;">
							<i class="fa fa-spinner fa-spin" ></i> Processing, Please wait...
						</a>
						<!--<span  class="errstatus" style="display: none;position: absolute;top: 50%;margin-top:-20px;left: 0;right:0;" >Product is out of stock<br/>Please try again later</span>-->
					</span>
					
				</li>
			</ul>
			<div class="noRecord" data-ng-class="(products.length == 0)? 'ng-show':'ng-hide'">
				<span> <i class="fa fa-exclamation-triangle"></i> No products were found in this selection of categories. Change your category search and try again.</span>
			</div>
		</div>
		</div>
		<br class="spacer" />
	</div>
	
</div>