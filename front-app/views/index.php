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
	<h1>Welcome to MaxPins . . . Finest Cloisonne Products!</h1>
	<p ng-bind-html="cmsContent | to_trusted" ></p>
	
	<!--<p>Cloisonné products are by far the best quality, most beautiful and longest lasting of all the lapel pin, medallion and jewelry making techniques. At MaxPins we specialize in working with this ancient and elegant process. Our designs take the utmost advantage of this craft to customize products of the highest quality that you will be proud to have displayed and worn.</p>
	<p>We offer Cloisonné products for retail marketing, business logos, organization events, marketing products and a complete lines of US Route 66 and Southwestern states tourist products. .</p>
	<p class="blueText">A sampling of artwork for some of our products. Visit the above links to learn more and see more samples in each category.</p>-->
	<!--<div class="homeSlide"><img src="images/home-slide.jpg" alt="" /></div>-->
	<h3>Our Featured Pins</h3>
	<div ng-controller="BasicSliderCtrl">

	<flex-slider class="carousel" slide="s in slides" animation="slide" animation-loop="false" item-width="145" item-margin="5">
		<li>
			<a href="#/products/{{productName[s]}}">
				<img ng-src="<?php echo FRONTEND_URL."upload/product/thumb/"; ?>{{s}}">
			</a>
				
		</li>
	</flex-slider>
	</div>
	
	<!--<ul class="rn-carousel">
		<li ng-repeat="slide in slides track by slide.id" ng-class="'id-' + slide.id">
			<div ng-style="{'background-image': 'url(' + slide.img + ')'}"  class="bgimage">
			    #{{ slide.id }}
			</div>
		</li>
	</ul>-->
</div>
