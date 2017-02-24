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
					<i class="fa fa-gift"></i>Add Wholesaler
				</div>
				<!--<div class="tools">
					<a class="collapse" href="javascript:;" data-original-title="" title="">
					</a>
					<a class="config" data-toggle="modal" href="#" data-original-title="" title="">
					</a>
					<a class="reload" href="javascript:;" data-original-title="" title="">
					</a>
					<a class="remove" href="javascript:;" data-original-title="" title="">
					</a>
				</div>-->
			</div>
			<input type="hidden" data-ng-model="form.wholesaler_id">
					
			<div class="portlet-body form">
				<form class="form-horizontal form-bordered ng-pristine ng-valid" id="formProfile"  name="formWS" novalidate ng-submit="formWS.$valid && wholesalerAdd()">
					<div class="form-group">
						<label class="col-sm-3 control-label">Name <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control tt-hint" name="wholesaler_name"  data-ng-model="form.wholesaler_name" required>
									<span style="color:red" ng-show="formWS.wholesaler_name.$dirty && formWS.wholesaler_name.$invalid || submitted">
<span ng-show="formWS.wholesaler_name.$error.required">Wholesaler name is required.</span>
								</span>
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Wholesaler Email <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control" name="wholesaler_email" id="wholesaler_email" data-ng-model="form.wholesaler_email" required></span>
								<span style="color:red" ng-show="formWS.wholesaler_email.$dirty && formWS.wholesaler_email.$invalid">
<span ng-show="formWS.wholesaler_email.$error.required">Wholesaler email is required.</span>
</span>      
								
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Wholesaler Password <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="password" class="form-control" name="wholesaler_password" id="wholesaler_password" data-ng-model="form.wholesaler_password" required></span>
								<span style="color:red" ng-show="formWS.wholesaler_password.$dirty && formWS.wholesaler_password.$invalid">
<span ng-show="formWS.wholesaler_password.$error.required">Wholesaler password is required.</span>
</span>      
								
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Wholesaler Phone</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control" name="wholesaler_phone" id="wholesaler_phone" data-ng-model="form.wholesaler_phone"></span>
								
</span>      
								
							</div>
							
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Wholesaler Contact</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control" name="wholesaler_contact" id="wholesaler_contact" data-ng-model="form.wholesaler_contact"></span>
								
</span>      
								
							</div>
							
						</div>
					</div>
			
					<div class="form-group">
						<label class="col-sm-3 control-label">Wholesaler Note</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
									<textarea name="wholesaler_note" data-ng-model="form.wholesaler_note" class="form-control"></textarea>
								</span>
								
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Wholesaler ID <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
									<input type="text" name="wholesaler_customer_id" data-ng-model="form.wholesaler_customer_id" class="form-control" required>
								</span>
								<span style="color:red" ng-show="formWS.wholesaler_customer_id.$dirty && formWS.wholesaler_customer_id.$invalid">
<span ng-show="formWS.wholesaler_customer_id.$error.required">Wholesaler ID is required.</span>
								</span>
								
							</div>
							
						</div>
					</div>
						
					<div class="form-group">
						<label class="col-sm-3 control-label">Billing Address <span class="required"> * </span></label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
								<span class="twitter-typeahead">
									<textarea name="billing_address" ng-model="form.billing_address" class="form-control" required></textarea>
									<span style="color:red" ng-show="formWS.billing_address.$dirty && formWS.billing_address.$invalid">
<span ng-show="formWS.billing_address.$error.required">Billing address is required.</span>
  
								</span>
							</div>
							
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Billing City <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control tt-hint"  data-ng-model="form.billing_city" name="billing_city" required>
								<span style="color:red" ng-show="formWS.billing_city.$dirty && formWS.billing_city.$invalid">
<span ng-show="formWS.billing_city.$error.required">Billing city is required.</span>
</span>      
								</span>
							</div>
							
						</div>
					</div>
										<div class="form-group">
						<label class="col-sm-3 control-label">Billing Country <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
									<select data-ng-model="form.billing_country" name="billing_country" required class="form-control input-medium">
										<option ng-repeat="operator in countryList" value="{{operator.id}}">
										  {{operator.country_name}}
										</option>
									</select>
									
									<span style="color:red" ng-show="formWS.billing_state.$dirty && formWS.billing_country.$invalid">
<span ng-show="formWS.billing_country.$error.required">Billing country is required.</span>
								</span>      
								
							</div>
							
						</div>
					</div>

					
					<div class="form-group">
						<label class="col-sm-3 control-label">Billing State <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control tt-hint" data-ng-model="form.billing_state" name="billing_state" required>
									<span style="color:red" ng-show="formWS.billing_state.$dirty && formWS.billing_state.$invalid">
<span ng-show="formWS.billing_state.$error.required">Billing state is required.</span>
</span>      
								
								</span>
							</div>
							
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Business Zip <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control" name="billing_zip" id="billing_zip" data-ng-model="form.billing_zip" required></span>
								<span style="color:red" ng-show="formWS.billing_zip.$dirty && formWS.billing_zip.$invalid">
<span ng-show="formWS.billing_zip.$error.required">Billing Zip is required.</span>
</span>      
								
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Shipping Address <span class="required"> * </span></label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
								<span class="twitter-typeahead">
									<textarea name="shipping_address" ng-model="form.shipping_address" class="form-control" required></textarea>
									<span style="color:red" ng-show="formWS.billing_address.$dirty && formWS.shipping_address.$invalid">
<span ng-show="formWS.shipping_address.$error.required">Shipping address is required.</span>
  
								</span>
							</div>
							
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Shipping City <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control tt-hint"  data-ng-model="form.shipping_city" name="shipping_city" required>
								<span style="color:red" ng-show="formWS.shipping_city.$dirty && formWS.shipping_city.$invalid">
<span ng-show="formWS.shipping_city.$error.required">Shipping city is required.</span>
</span>      
								</span>
							</div>
							
						</div>
					</div>
										<div class="form-group">
						<label class="col-sm-3 control-label">Shipping Country <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
									<select ng-model="form.shipping_country" name="shipping_country" required class="form-control input-medium">
										<option ng-repeat="operator in countryList" value="{{operator.id}}">
										  {{operator.country_name}}
										</option>
									</select>
									<span style="color:red" ng-show="formWS.shipping_country.$dirty && formWS.shipping_country.$invalid">
<span ng-show="formWS.shipping_country.$error.required">Shipping country is required.</span>
								</span>      
								
							</div>
							
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Shipping State <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control tt-hint" data-ng-model="form.shipping_state" name="shipping_state" required>
									<span style="color:red" ng-show="formWS.shipping_state.$dirty && formWS.shipping_state.$invalid">
<span ng-show="formWS.shipping_state.$error.required">Shipping state is required.</span>
</span>      
								
								</span>
							</div>
							
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Shipping Zip <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control" name="shipping_zip" id="shipping_zip" data-ng-model="form.shipping_zip" required></span>
								<span style="color:red" ng-show="formWS.shipping_zip.$dirty && formWS.shipping_zip.$invalid">
<span ng-show="formWS.shipping_zip.$error.required">Billing Zip is required.</span>
</span>      
								
							</div>
							
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Shipping Method</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
									<select data-ng-model="form.shipping_method" name="shipping_method" required class="form-control input-medium">
										<option value="">Select...</option>
										<option ng-repeat="sl in shippingList" value="{{sl.id}}" ng-selected="{{sl.id == wholesaler_shipping_method}}">
										  {{sl.method_name}}
										</option>
									</select>
									<span style="color:red" ng-show="formWS.shipping_method.$dirty && formWS.shipping_method.$invalid">
<span ng-show="formWS.shipping_method.$error.required">Billing Method is required.</span>
								</span>
								
							</div>
							
						</div>
					</div>
					
					
					
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Wholesaler Status <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
									<select name="wholesaler_status" data-ng-model="form.wholesaler_status" class="form-control input-medium" required>
										<option value="">Select...</option>
										<option value="Active" selected="{{wholesaler_status == 'Active' ? 'selected' : ''}}">Active</option>
										<option value="Inactive" selected="{{wholesaler_status == 'Active' ? 'selected' : ''}}">Inactive</option>
									</select>
									<span style="color:red" ng-show="formWS.wholesaler_status.$dirty && formWS.wholesaler_status.$invalid">
<span ng-show="formWS.wholesaler_status.$error.required">Wholesaler Status is required.</span>
								</span>
								</span>      
								
							</div>
							
						</div>
					</div>
					
					
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn purple"  type="submit" data-ng-click=" submitted=true;"  ><i class="fa fa-check"></i> Submit </button>
								&nbsp;
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

