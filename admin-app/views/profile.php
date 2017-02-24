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
<div  class="margin-top-10">
	
	
	
	<div class="row">
		
		<div class="portlet box yellow-crusta">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i>My Profile Details
				</div>
				<div class="tools">
					<a class="collapse" href="javascript:;" data-original-title="" title="">
					</a>
					<a class="config" data-toggle="modal" href="#" data-original-title="" title="">
					</a>
					<a class="reload" href="javascript:;" data-original-title="" title="">
					</a>
					<a class="remove" href="javascript:;" data-original-title="" title="">
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<form class="form-horizontal form-bordered ng-pristine ng-valid" id="formProfile" name="formProfile" >
					<div class="form-group">
						<label class="col-sm-3 control-label">First Name</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control tt-hint"  data-ng-model="first_name">
								</span>
							</div>
							
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Last Name</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control tt-hint"  data-ng-model="last_name">
								</span>
							</div>
							
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Email</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control tt-hint" readonly="readonly"  data-ng-model="email_id">
								</span>
							</div>
							
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Password</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="password" class="form-control tt-hint" data-ng-model="password">
								</span>
							</div>
							
						</div>
					</div>
					
					<!--<div class="form-group">
						<label class="col-sm-3 control-label">Confirm Password</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="password" class="form-control tt-hint"   data-ng-model="confirm_password" compare-to="password" name="confirm_password">
								</span>
							</div>
							
						</div>
					</div>-->



					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn purple" type="submit" data-ng-click="profileSubmit()" ><i class="fa fa-check"></i> Submit</button>
								
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- END MAIN CONTENT -->
<!-- BEGIN MAIN JS & CSS -->

<!-- BEGIN MAIN JS & CSS -->