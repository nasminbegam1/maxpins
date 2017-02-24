<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb hide">
	<li>
		<a href="#">Home</a><i class="fa fa-circle"></i>
	</li>
	<li class="active">
		Dashboard
	</li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN MAIN CONTENT -->
<div ng-controller="DashboardController" class="margin-top-10">
		<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-3">
				<a href="#/order" class="dashboard-stat dashboard-stat-light blue-soft">
				<div class="visual">
					<i class="fa fa-comments"></i>
				</div>
				<div class="details">
					<div class="number">{{new_order}}</div>
					<div class="desc">New Orders</div>
				</div>
				</a>
			</div>
			<div class="col-lg-3">
				<a href="#/wholesaler" class="dashboard-stat dashboard-stat-light blue-soft">
				<div class="visual">
					<i class="fa fa-group"></i>
				</div>
				<div class="details">
					<div class="number">{{totalWholesaler}}</div>
					<div class="desc">Total Active Wholesalers</div>
				</div>
				</a>
			</div>
			<div class="col-lg-3">
				<a href="#/products" class="dashboard-stat dashboard-stat-light red-soft">
				<div class="visual">
					<i class="fa fa-cubes"></i>
				</div>
				<div class="details">
					<div class="number">{{totalProduct}}</div>
					<div class="desc">Total Products</div>
				</div>
				</a>
			</div>			
			<div class="col-lg-3">
				<a href="javascript:;" class="dashboard-stat dashboard-stat-light red-soft" data-ng-click="goToOrder();">
				<div class="visual">
					<i class="fa fa-cubes"></i>
				</div>
				<div class="details">
					<div class="number">Create</div>
					<div class="desc">Order</div>
				</div>
				</a>
			</div>
		</div>
	</div>

		<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-3">
				<a  class="dashboard-stat dashboard-stat-light green-soft">
				<div class="visual">
					<i class="fa fa-cubes"></i>
				</div>
				<div class="details">
					<div class="number">{{total_visitor}}</div>
					<div class="desc">Visitor</div>
				</div>
				</a>
			</div>
			<div class="col-lg-3">
				<a  class="dashboard-stat dashboard-stat-light red-soft">
				<div class="visual">
					<i class="fa fa-file"></i>
				</div>
				<div class="details">
					<div class="number">{{total_page_views}}</div>
					<div class="desc">Page/Session</div>
				</div>
				</a>
			</div>
			<div class="col-lg-3">
				<a class="dashboard-stat dashboard-stat-light blue-soft">
				<div class="visual">
					<i class="fa fa-clock-o"></i>
				</div>
				<div class="details">
					<div class="number">{{avg_session_duration}} seconds</div>
					<div class="desc">Avg. Session Duration </div>
				</div>
				</a>
			</div>
			<div class="col-lg-3">
				<a  class="dashboard-stat dashboard-stat-light green-soft">
				<div class="visual">
					<i class="fa fa-star"></i>
				</div>
				<div class="details">
					<div class="number">{{bounce_rate}} %</div>
					<div class="desc">Bounce Rate</div>
				</div>
				</a>
			</div>



		</div>
	</div>

	
</div>
<!-- END MAIN CONTENT -->
<!-- BEGIN MAIN JS & CSS -->
<script>
	
</script>
<!-- BEGIN MAIN JS & CSS -->