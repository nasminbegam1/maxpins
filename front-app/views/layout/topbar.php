<div class="btn-group"> <!-- ui-toggle="uiSidebarLeft" -->
  <div class="btn sidebar-toggle" data-ng-init="mobNav = false" data-ng-click="mobNav = !mobNav">
	<i class="fa fa-bars" ></i> Menu
  </div>
</div>
<ul class="{{mobNav?'mobNavShow':'mobNavHide'}}">
	<li><a href="#/" data-ng-click="mobNav = false">Home</a></li>
	<li><a href="#/products" data-ng-click="mobNav = false">Products</a></li>
	<li><a href="#/route-66" data-ng-click="mobNav = false">Route 66</a></li>
	<li><a href="#/marketing" data-ng-click="mobNav = false">Marketing</a></li>
	<li><a href="#/special-events" data-ng-click="mobNav = false">Special events</a></li>
	<li><a href="#/destinations" data-ng-click="mobNav = false">Destinations</a></li>
	<li><a href="#/retail" data-ng-click="mobNav = false">Retail</a></li>
	<li><a href="#/about-us" data-ng-click="mobNav = false">About</a></li>
	<li><a href="#/contact-us" data-ng-click="mobNav = false">Contact</a></li>
</ul>