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
					<i class="fa fa-gift"></i>Edit Wholesaler
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
				<form class="form-horizontal form-bordered ng-pristine ng-valid" id="formProfile" name="formWS" novalidate >
					<div class="form-group">
						<label class="col-sm-3 control-label">Name</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control tt-hint"  data-ng-model="form.wholesaler_name">
									<span style="color:red" ng-show="formWS.wholesaler_name.$dirty && formWS.wholesaler_name.$invalid">
<span ng-show="formWS.wholesaler_name.$error.required">Wholesaler name is required.</span>
								</span>
							</div>
							
						</div>
					</div>
						
					<div class="form-group">
						<label class="col-sm-3 control-label">Billing Address</label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
								<span class="twitter-typeahead">
									<textarea name="billing_address" ng-model="form.billing_address" class="form-control"></textarea>
									<span style="color:red" ng-show="formWS.billing_address.$dirty && formWS.billing_address.$invalid">
<span ng-show="formWS.billing_address.$error.required">Billing address is required.</span>
  
								</span>
							</div>
							
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Billing City</label>
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
						<label class="col-sm-3 control-label">Billing Country</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
									<select ng-model="form.billing_country" required class="form-control">
										<option ng-selected="{{operator.id == billing_country}}" ng-repeat="operator in countryList" value="{{operator.id}}">
										  {{operator.country_name}}
										</option>
									</select>
								</span>      
								
							</div>
							
						</div>
					</div>

					
					<div class="form-group">
						<label class="col-sm-3 control-label">Billing State</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control tt-hint" data-ng-model="form.billing_state" name="billing_state" required>
									<span style="color:red" ng-show="formWS.billing_state.$dirty && formCms.billing_state.$invalid">
<span ng-show="formWS.billing_state.$error.required">Billing state is required.</span>
</span>      
								
								</span>
							</div>
							
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Business Zip</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control" name="billing_zip" id="billing_zip" data-ng-model="form.billing_zip"></span>
								<span style="color:red" ng-show="formWS.billing_zip.$dirty && formWS.billing_zip.$invalid">
<span ng-show="formWS.billing_zip.$error.required">Billing Zip is required.</span>
</span>      
								
							</div>
							
						</div>
					</div>
					

					
					<div class="form-group">
						<label class="col-sm-3 control-label">Shipping Address</label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
								<span class="twitter-typeahead">
									<textarea name="shipping_address" ng-model="form.shipping_address" class="form-control"></textarea>
									<span style="color:red" ng-show="formWS.billing_address.$dirty && formWS.shipping_address.$invalid">
<span ng-show="formWS.shipping_address.$error.required">Shipping address is required.</span>
  
								</span>
							</div>
							
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Shipping City</label>
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
						<label class="col-sm-3 control-label">Shipping Country</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
									<select ng-model="form.shipping_country"  class="form-control">
										<option ng-selected="{{operator.id == shipping_country}}" ng-repeat="operator in countryList" value="{{operator.id}}">
										  {{operator.country_name}}
										</option>
									</select>
								</span>      
								
							</div>
							
						</div>
					</div>

					
					<div class="form-group">
						<label class="col-sm-3 control-label">Shipping State</label>
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
						<label class="col-sm-3 control-label">Shipping Zip</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control" name="shipping_zip" id="shipping_zip" data-ng-model="form.shipping_zip"></span>
								<span style="color:red" ng-show="formWS.shipping_zip.$dirty && formWS.shipping_zip.$invalid">
<span ng-show="formWS.shipping_zip.$error.required">Billing Zip is required.</span>
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
						<label class="col-sm-3 control-label">Wholesaler Email</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control" name="wholesaler_email" id="wholesaler_email" data-ng-model="form.wholesaler_email"></span>
								<span style="color:red" ng-show="formWS.wholesaler_email.$dirty && formWS.wholesaler_email.$invalid">
<span ng-show="formWS.wholesaler_email.$error.required">Wholesaler email is required.</span>
</span>      
								
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Wholesaler Password</label>
						<div class="col-sm-4">
							<div class="input-group">
								<input type="button" name="btn-send-password" id="btn-send-password" value="Send Password" class="btn green" data-ng-click="sendPassword();">
								<!--<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="password" class="form-control" name="wholesaler_password" id="wholesaler_password" data-ng-model="form.wholesaler_password" ></span>-->											
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
						<label class="col-sm-3 control-label">Shipping Method</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
									<select ng-model="form.shipping_method"  class="form-control" required>
										<option ng-repeat="sl in shippingList" value="{{sl.id}}" ng-selected="{{sl.id == wholesaler_shipping_method}}">
										  {{sl.method_name}}
										</option>
									</select>
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
						<label class="col-sm-3 control-label">Wholesaler ID</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
									<input type="text" name="wholesaler_customer_id" data-ng-model="form.wholesaler_customer_id" class="form-control">
								</span>
								
							</div>
							
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Wholesaler Status</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
									<select name="wholesaler_status" ng-model="form.wholesaler_status" class="form-control input-medium">
										<option value="Active" selected="{{wholesaler_status == 'Active' ? 'selected' : ''}}">Active</option>
										<option value="Inactive" selected="{{wholesaler_status == 'Inactive' ? 'selected' : ''}}">Inactive</option>
									</select>
								</span>      
								
							</div>
							
						</div>
					</div>
					
					
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9"> <!--ng-disabled="formWS.$invalid" -->
								<button class="btn purple" type="submit" data-ng-click="wholesalerUpdate()" ><i class="fa fa-check"></i> Submit</button>
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

