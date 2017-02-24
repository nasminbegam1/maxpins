<?php //pr($cms_info);?>
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
		<div class="portlet box grey-cascade">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-basket font-green-sharp"></i>
					<span class="caption-subject bold uppercase">Edit Property Type </span>
				</div>				
			</div>
			<input type="hidden" data-ng-model="product_id">
					
			<div class="portlet-body form">
				<form class="form-horizontal form-bordered ng-pristine ng-valid" id="formedittype" name="formedittype" novalidate  >
					<input type="hidden" data-ng-model="producttype_id" name="producttype_id"/>
					<div class="form-group">
						<label class="col-md-2 control-label"> Type Name: <span class="required"> * </span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="propertytype_name" placeholder="" data-ng-model="producttype_name" required>
							<span style="color:red" ng-show="formedittype.producttype_name.$dirty && frmeditcategory.producttype_name.$invalid">
							<span ng-show="formedittype.producttype_name.$error.required">Product Type name is required.</span>
							</span>      

						</div>
					</div>
					
					
					<div class="form-group">
						<label class="col-md-2 control-label">Status:</label>
						<div class="col-md-6">
							<select class="table-group-action-input form-control input-medium" name="producttype_status" data-ng-model="producttype_status">
								<option value="Active" selected="{{status == 'Active' ? 'selected' : ''}}">Active</option>
								<option value="Inactive" selected="{{status == 'Inactive' ? 'selected' : ''}}">Inactive</option>
							</select>
							
						</div>
					</div>
					
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn purple" ng-disabled="formedittype.$invalid" type="submit" data-ng-click="typeUpdate()" ><i class="fa fa-check"></i> Submit</button>&nbsp;
								<button class="btn red" type="button" data-ng-click="back()" ><i class="fa fa-times"></i> Cancel</button>
								
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
  <script type="text/javascript">
	
  </script>

<!-- END MAIN CONTENT -->
<!-- BEGIN MAIN JS & CSS -->

<!-- BEGIN MAIN JS & CSS -->