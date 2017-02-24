<div class="homeContent">
<h1>{{page.cms_title}}</h1>
<div class="cmsContent" ng-bind-html="page.cms_content | to_trusted">
	
</div>
<div data-ng-class="(page.cms_slug=='special-events' || page.cms_slug=='marketing' || page.cms_slug=='destinations' || page.cms_slug=='about-us')? 'ng-show':'ng-hide'" ng-controller="BasicSliderCtrl">
<br>
	<flex-slider  class="carousel cmsSlider" slide="s in image_slides" animation="slide" animation-loop="false" item-width="145" item-margin="5">
		<li>
		    <img data-ng-src="{{s}}" alt="{{image_slides_alt[image_slides.indexOf(s)]}}">
				
		</li>
	</flex-slider>
	</div>
</div>

<!--<div data-ng-class="(page.featured=='Yes')? 'ng-show':'ng-hide'" ng-controller="BasicSliderCtrl">
<br>
<h3>Our Featured Pins</h3>
	<flex-slider class="carousel" slide="s in slides" animation="slide" animation-loop="false" item-width="145" item-margin="5">
		<li>
			<a href="#/products/{{productName[s]}}">
				<img ng-src="<?php echo FRONTEND_URL."upload/product/thumb/"; ?>{{s}}">
			</a>
				
		</li>
	</flex-slider>
	</div>
</div>-->