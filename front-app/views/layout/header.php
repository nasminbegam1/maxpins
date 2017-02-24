<div class="headerInn">
	<div class="loginPan" data-ng-controller="AppCtrl">
		<span data-ng-class="(Global.log()!='')?'ng-show':'ng-hide'">
			<a href="javascript:void(0);" title="" dropdown-menu="ddMenuOptions3" dropdown-model="ddMenuSelected3" class="login">Wholesaler Menu</a>
		</span>
		<span data-ng-class="(Global.log()=='')?'ng-show':'ng-hide'"">
			<a href="#/login" title="Wholesalers login" class="login">Wholesalers login</a>
		</span>
	</div>
		
		<a href="#/" class="logo_img"><img src="images/logo.jpg" alt=""></a>
        <div class="headerRightBtns">
        <a href="#/products" class="blueBtn">View Collector Catalog</a>
		<a data-ng-class="(Global.log()!='')?'ng-show':'ng-hide'" href="#/mycart" class="cartLink"><i class="fa fa-shopping-cart"></i> Cart ({{Global.cart()}})</a>
        </div>
	
</div>