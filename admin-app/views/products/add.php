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
					<span class="caption-subject bold uppercase">Add Product </span>
				</div>				
			</div>
			<input type="hidden" data-ng-model="product_id">
					
			<div class="portlet-body form">
				<form class="form-horizontal form-bordered ng-pristine ng-valid" id="formaddproduct" name="frmaddproduct" novalidate  >
					<div class="form-group">
						<label class="col-md-2 control-label">SKU: <span class="required"> * </span>
						</label>
						<div class="col-md-6">
							<input readonly="readonly" type="text" class="form-control" name="product_sku" placeholder="" data-ng-model="product_sku" >
							
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Name: <span class="required"> * </span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="product_name" placeholder="" data-ng-model="product_name" required>
								
							<span style="color:red" ng-show="hasError('product_name', 'required')">
							Product name is required.
							</span>      

						</div>
					</div>
										<div class="form-group">
						<label class="col-md-2 control-label">Product Type: <span class="required"> * </span></label>
						<div class="col-md-6">
							<select name="product_type" data-ng-model="product_type" class="form-control" required>
								<option value="">Select property type</option>
								<option ng-repeat="p_type in product_type_list" value="{{p_type.id}}">
										  {{p_type.type_name}}
										</option>
							</select>
							<span style="color:red" ng-show="hasError('product_type', 'required')">Product type is required.</span>
							

						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2 control-label">Description: <span class="required"> * </span></label>
						<div class="col-md-6">
							<textarea class="form-control" name="product_description" data-ng-model="product_description" required></textarea>
							<span style="color:red" ng-show="hasError('product_description', 'required')">Product description is required.
							</span>     
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Item Count: <span class="required"> * </span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="product_item_count" placeholder="" data-ng-model="product_item_count" required>
							<span style="color:red" ng-show="hasError('product_item_count', 'required')">item count is required.</span>
							
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Categories: <span class="required"> * </span></label>
						<div class="col-md-6">
							<div class="form-control height-auto">
								<div class="scroller" style="height:200px;" data-always-visible="1">
									<ul class="list-unstyled">
										<li data-ng-repeat="c in category">
											<label><input type="checkbox" name="product[categories][]" value="{{c.category_id}}"> {{c.category_name}}</label>
										</li>
										
									</ul>
								</div>
							</div>
							<span class="help-block">select one or more categories </span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Active: <span class="required"> * </span></label>
						<div class="col-md-6">
							<select class="table-group-action-input form-control input-medium" name="product_status" data-ng-model="product_status" required>
								<option value="">Select...</option>
								<option value="Active">Yes</option>
								<option value="Inactive">No</option>
							</select>
							<span style="color:red" ng-show="hasError('product_status', 'required')">status is required.</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Manufactured Qty:</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="product_manufactured_qty" placeholder="" data-ng-model="product_manufactured_qty">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Inventory Qty:</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="product_inventory_qty" placeholder="" data-ng-model="product_inventory_qty">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Reorder:</label>
						<div class="col-md-6">
							<select class="table-group-action-input form-control input-medium" name="product_reorder_status" data-ng-model="product_reorder_status">
								<option value="">Select...</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Reorder Qty:</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="product_reorder_qty" placeholder="" data-ng-model="product_reorder_qty">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Price: <span class="required"> * </span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="product_price" placeholder="" data-ng-model="product_price" required>
							<span style="color:red" ng-show="hasError('product_price', 'required')">Product price is required.
							</span>

						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-2 control-label">Is Featured:</label>
						<div class="col-md-6">
							<select class="form-control input-medium" name="is_featured" data-ng-model="is_featured">
								<option value="">Select...</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
						</div>
					</div>
					
					<div class="form-group" data-ng-init="any_retailer_status='Yes'">
						<label class="col-md-2 control-label">Any Retailer:</label>
						<div class="col-md-6">
							<label data-ng-repeat="a in ['Yes','No']">
								<input type="radio" name="any_retailer" ng-data-model="any_retailer" value="{{a}}" data-ng-click="getRetailer(a)" class="yes_r_status" >{{a}}
							</label>
						</div>
					</div>

					<div class="form-group" data-ng-hide="any_retailer_status">
						<label class="col-md-2 control-label">Retailer Name: <span class="required"> * </span></label>
						<div class="col-md-6">
							<div class="form-control height-auto">
								<div class="scroller" style="height:200px;" data-always-visible="1">
									<ul class="list-unstyled">
										<li data-ng-repeat="w in wholesalers">
											<label><input type="checkbox" name="product[retailer][]" value="{{w.wholesaler_id}}"> {{w.wholesaler_name}}</label>
										</li>
									
									</ul>
								</div>
							</div>
							<span class="help-block">select one or more retailer </span>
						</div>
					</div>


					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn purple"  type="submit" data-ng-click="productAdd($event)" ><i class="fa fa-check"></i> Submit</button>
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

