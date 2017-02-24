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
					<i class="fa fa-gift"></i>Add Order
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
								
			<div class="portlet-body form" data-ng-show="no_paypal">
				<form class="form-horizontal form-bordered ng-pristine ng-valid" id="formAddOrder"  name="formAddOrder" novalidate>
				<div class="form-group">
						<label class="col-sm-3 control-label">Wholesaler Name <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
								<span class="twitter-typeahead">
									<select name="wholesaler_name" id="wholesaler_name" data-ng-model="wholesaler_name" class="form-control loginText" required data-ng-change="getShippingMethod();">
										<option value="">Select...</option>
										<option data-ng-repeat="w in wholesalerList" value="{{w.wholesaler_id}}">{{w.wholesaler_name}}</option>
									</select>
								</span>
									<span style="color:red" ng-show="formAddOrder.wholesaler_name.$dirty && formAddOrder.wholesaler_name.$invalid || submitted">
<span ng-show="formAddOrder.wholesaler_name.$error.required">Wholesaler name is required.</span>
								</span>
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Product Name - SKU
						<span class="help-block"><i>(select one or more product) </i></span> </label>
						<div class="col-md-6">
							<div class="form-control height-auto">
								<div class="scroller" style="height:750px;" data-always-visible="1">
									<ul class="list-unstyled">
										<li data-ng-repeat="p in productList">
											<div class="unstyledDiv">
												<input type="checkbox" name="product[name][]" value="{{p.product_id}}"  data-ng-model="product_name" data-ng-click="calculateOrdTotal();" data-element-id = "{{p.product_id}}" data-element-price = "{{p.price}}" class="chkItem">
												{{p.product_name}} - {{p.product_sku}}
												<div class="qtyDiv">Quantity<input type="text" name="product[quantity][{{p.product_id}}]" id="qty_{{p.product_id}}" value="1" class="form-control smallText" title="Quantity" data-ng-keyup="calculateOrdTotal();">
												<div class="priceDiv">$ {{p.price}}</div></div></div>
										</li>
									
									</ul>
								</div>
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Shipping Method <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
								<span class="twitter-typeahead">
									<!--<input type="text" name="shipping_method_name" id="shipping_method_name" data-ng-model="shipping_method_name" class="form-control loginText" data-ng-readonly="true">
									<input type="hidden" name="shipping_method" id="shipping_method" data-ng-model="shipping_method" class="form-control loginText" value="{{sm_id}}">-->
									
									
									<select data-ng-model="shipping_method" name="shipping_method" required class="form-control input-medium">
										<option value="">Select...</option>
										<option data-ng-repeat="sl in shippingList" value="{{sl.id}}" >
										  {{sl.method_name}}
										</option>
									</select>
									<br>
									<span style="color:red" ng-show="formAddOrder.shipping_method.$dirty && formAddOrder.shipping_method.$invalid || submitted">
<span ng-show="formAddOrder.shipping_method.$error.required">Shipping method is required.</span>
								</span>
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Total Order </label>
						<div class="col-sm-4">
							<div class="input-group">
								<strong id="ordTotalDisp">$ {{ordTotal | number:2}}</strong>
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Payment Status <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
									<select name="payment_status" id="payment_status" data-ng-model="payment_status" class="form-control loginText" required>
										<option value="">Select...</option>
										<option data-ng-repeat="pay in paymentList" value="{{pay.value}}">{{pay.name}}</option>
									</select>
								</span>
								<span style="color:red" ng-show="formAddOrder.payment_status.$dirty && formAddOrder.payment_status.$invalid || submitted">
<span ng-show="formAddOrder.payment_status.$error.required">Payment status is required.</span>
								
							</div>
							
						</div>
					</div>
			
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn purple" ng-disabled="formAddOrder.$invalid"  type="submit" data-ng-click="orderAdd();"><i class="fa fa-check"></i> Submit </button>
								&nbsp;
								<button class="btn red" type="button" data-ng-click="back()" ><i class="fa fa-times"></i> Cancel</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<div data-ng-show="paypal_form" id="paypal_form">{{paypal_display_form}}</div>
	</div>
</div>
  <script type="text/javascript">
$(document).ready(function() {   
  	
	//$('#paypal_checkout').submit();

    });
  </script>

<!-- END MAIN CONTENT -->
<!-- BEGIN MAIN JS & CSS -->

<!-- BEGIN MAIN JS & CSS -->
<style type="text/css">
.list-unstyled .ng-scope .ng-binding{
	width: 100%;
	clear: both;
	display: inline-block;
	vertical-align: top;
	line-height: 32px;
	margin: 0 0 6px 0;
}
.list-unstyled .ng-scope .ng-binding input[type="checkbox"]{
	float: left;
	margin: 10px 10px 0 0;
}
.list-unstyled .ng-scope .ng-binding .qtyDiv{
	float: right;
	text-align: right;
	width: 44%;
}
.list-unstyled .ng-scope .ng-binding .qtyDiv .priceDiv{
	display: inline-block;
	margin: 0;
	min-width: 28%;
	text-align: left;
	vertical-align: top;
	width: auto;
}
.list-unstyled .ng-scope .ng-binding input[type="text"] {
	display: inline-block;
	margin: 0 10px;
	text-align: center;
	vertical-align: top;
	width: 22%;
}
</style>

