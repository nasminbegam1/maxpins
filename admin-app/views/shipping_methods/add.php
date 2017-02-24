<!--<style>
	input.ng-invalid, input.ng-invalid-required, input.ng-invalid-pattern{
		border: 1px solid red;
	}
	
</style>-->
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
					<i class="fa fa-gift"></i>Add Shipping Method
				</div>
				
			</div>
			
					
			<div class="portlet-body form">
				<form class="form-horizontal form-bordered ng-pristine ng-valid" id="formShippingMethod" name="formShippingMethod" novalidate >
					<!--<div class="alert alert-danger" ng-show="formShippingMethod.$error.required && formShippingMethod.$dirty"><strong>{{formShippingMethod.$error.required.length}}</strong> more required field left</div>-->
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Method Name <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control tt-hint"  data-ng-model="method_name" name="method_name" required>
								<span style="color:red" ng-show="formShippingMethod.method_name.$dirty && formShippingMethod.method_name.$invalid">
<span ng-show="formShippingMethod.method_name.$error.required">Method Name is required.</span>
								</span>
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Status  <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
								<span class="twitter-typeahead">
									<select data-ng-model="method_status" name="method_status" class="form-control tt-hint" required>
										<option value=""></option>
										<option value="Active">Active</option>
										<option value="Inactive">Inactive</option>
										
									</select>
								<span style="color:red" ng-show="formShippingMethod.method_status.$dirty && formShippingMethod.method_status.$invalid">
<span ng-show="formShippingMethod.method_status.$error.required">Status is required.</span>
								</span>
								
							</div>
							
						</div>
					</div>
					
					<div class="form-group" data-ng-repeat="price in prices">
						<div class="col-sm-3 control-label"> Prices  <span class="required"> * </span>
							<br>
							<button class="remove btn red" ng-show="$last && priceLen>1" ng-click="removePrice()">X</button>
						</div>
						<div class="col-sm-3">
							<div class="input-group">
								<label>Lower Qty</label>
								<input type="text" ng-pattern='/^\d+$/' class="form-control tt-hint" name="lower_qty[]"  data-ng-model="price.lower_qty"  required>
				
								
							</div>
						</div>
						<div class="col-sm-3">
							<div class="input-group">
								<label>Upper Qty</label>
								<input type="text" ng-pattern='/^\d+$/' class="form-control tt-hint" name="higher_qty[]"  data-ng-model="price.higher_qty"  required>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="input-group">
								<label>Price</label>
								<input type="text" ng-pattern='/^\-?\d+((\.|\,)\d+)?$/' class="form-control tt-hint" name="price[]"  data-ng-model="price.price"  required>
								
								
							</div>
							
							
						</div>
						
					</div>
					
					<div class="form-group">
						<div class="col-md-offset-3 col-md-9">
							<button class="btn green" type="button" data-ng-click="addNewPrice()" > <i class="fa fa-check"></i> Add More Prices</button>
						</div>
					</div>
					
					
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn purple" ng-disabled="formShippingMethod.$invalid" type="submit" data-ng-click="methodAdd()" ><i class="fa fa-check"></i> Submit</button>&nbsp;
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

