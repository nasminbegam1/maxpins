<script>
	function goToOrder(){
        $.ajax({
                 url:'./order/setAdminOrder',
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 }).success( function(res){
            //var folder = '/maxpins';
            var folder = '';
            var url = "http://"+document.location.host+folder+"/#/products";
             window.location.href =url; 
            });
     }
</script>
<!-- BEGIN HEADER TOP -->
<div class="page-header-top">
	<div class="container">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="#/dashboard.html"><img src="images/MaxPins.png" alt="logo" class="logo-default" width="100%" height="40"></a>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler"></a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				
				<li class="dropdown dropdown-user dropdown-dark">
					<a href="javascript:;" class="dropdown-toggle" dropdown-menu-hover data-toggle="dropdown" data-close-others="true">
					<!--<img alt="" class="img-circle" src="assets/admin/layout3/img/avatar9.jpg">-->
					<span class="username username-hide-mobile">
					<?php //echo $this->nsession->userdata('ADMIN_NAME');  ?>
					{{admin_name}}
					</span>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="#/profile">
							<i class="icon-user"></i> My Profile </a>
						</li>
						<!--<li>
							<a href="#">
							<i class="icon-calendar"></i> My Calendar </a>
						</li>-->
						
						<li class="divider"></li>
					
						<li>
							<a href="#/logout">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
</div>
<!-- END HEADER TOP -->
<!-- BEGIN HEADER MENU -->
<div class="page-header-menu">
	<div class="container">
		<!-- BEGIN HEADER SEARCH BOX -->
		<!--<form class="search-form" action="extra_search.html" method="GET">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search" name="query">
				<span class="input-group-btn">
				<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
				</span>
			</div>
		</form>-->
		<!-- END HEADER SEARCH BOX -->
		<!-- BEGIN MEGA MENU -->
		<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
		<!-- DOC: Remove dropdown-menu-hover and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
		<div class="hor-menu" >
			<ul class="nav navbar-nav">
				<li class="active">
					<a href="#/dashboard">Dashboard</a>
				</li>
				<li class="menu-dropdown ">
					<a href="javascript:void(0);" class="dropdown-toggle" dropdown-menu-hover data-toggle="dropdown" data-close-others="true">Preferences</a>
					<ul class="dropdown-menu pull-left">
						<li class=" dropdown-submenu">
							<a href="#/cms">CMS</a>
						</li>
						<li class=" dropdown-submenu">
							<a href="#/shipping_methods">Shipping Method</a>
						</li>
						
						<li class=" dropdown-submenu">
							<a href="#/email_template">Email Template</a>
						</li>
						
						<li class=" dropdown-submenu">
							<a href="#/settings">Settings</a>
						</li>
					</ul>
				</li>
				
				
				<li class="active">
					<a href="#/wholesaler">Wholesaler</a>
				</li>
				
				<li class="active">
					<a href="#/category">Category</a>
				</li>
				<li class="active">
					<a href="#/producttype">Product Type</a>
				</li>
				<li class="active">
					<a href="#/products">Products</a>
				</li>
				
				<li class="active">
					<a href="#/order">Order</a>
				</li>
				
				<li class="active">
					<a href="#/phpmyadmin">phpMyAdmin</a>
				</li>
				<li class="active">
					<a href="javascript:void(0);" onclick="goToOrder();">Create Order</a>
				</li>
				
			</ul>
		</div>
		<!-- END MEGA MENU -->
	</div>
</div>
<!-- END HEADER MENU -->