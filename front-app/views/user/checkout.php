<div class="checkoutPan">
	<div data-ng-hide="aStatus">
		<div class="checkoutPanLeft">
			<h3>Billing Address</h3>
			<label>Name</label><span>{{userData.wholesaler_name}} </span>
			<label>Address</label><span>{{userData.wholesaler_billing_address}}</span>
			<label>City</label><span>{{userData.wholesaler_billing_city}}</span>
			<label>State</label><span>{{userData.wholesaler_billing_state}}</span>
			<label>Country</label><span>{{userData.wholesaler_billing_country}}</span>
			<label>Zip</label><span>{{userData.wholesaler_billing_zip}}</span>
			
		</div>
		<div class="checkoutPanRight">
			<h3>Shipping Address</h3>
			<label>Name</label><span>{{userData.wholesaler_name}} </span>
			<label>Address</label><span>{{userData.wholesaler_shipping_address}}</span>
			<label>City</label><span>{{userData.wholesaler_shipping_city}}</span>
			<label>State</label><span>{{userData.wholesaler_shipping_state}}</span>
			<label>Country</label><span>{{userData.wholesaler_shipping_country}}</span>
			<label>Zip</label><span>{{userData.wholesaler_shipping_zip}}</span>
		</div>
	</div>
	<div data-ng-show="aStatus" class="adminWholsaler">
		<label>Select Wholesaler</label>
		<select
			data-ng-model="order_wholesaler"
			data-ng-change="getShipping()"
			data-ng-options="value.wholesaler_id as value.wholesaler_name group by value.group for value in wholesalers">
			<option value="">Select any Wholesaler</option>
		    </select>
		<span class="errorMsg" data-ng-show="wmsg">{{wmsg}}</span>
		
	</div>
	<br class="spacer"/>
	<div data-ng-hide="aStatus">
	<div class="editInfo">want to update your billing or shipping address? <a href="javascript:void(0);" data-ng-click="goToProfile()">Click Here</a></div>
	</div>
	<div class="OrderPan">
		<h3>Your Order</h3>
		<table cellpadding="0" cellspecing="0" border="0">
			<tbody>
				<tr>
					<th>Product</th>
					<th>Qty</th>
					<th align="right" >Unit Price</th>
					<th align="right" >Sub Total</th>
				</tr>
			</tbody>
			<tbody>
				<tr data-ng-repeat="item in cartData | orderBy:'cart_item_name'">
					<td>{{item.name}}</td>
					<td >{{item.qty}}</td>
					<td align="right" >$ {{item.price}}</td>
					<td align="right" >$ {{item.subtotal}}</td>
				</tr>
				
			</tbody>
			<tbody>
				
				<tr data-ng-class='(shipping_method || aStatus)? "ng-show":"ng-hide"'>
					
					<td colspan="3" align="right" ><strong>Shipping </strong>
						<span data-ng-show="aStatus">
						<select
			data-ng-model="select_shipping_method"
			data-ng-change="getShippingAmt()"
			data-ng-options="value.id as value.method_name group by value.group for value in shippingMethod" >
			<option value="">Select any shipping</option>
		    </select></span>
					<span  data-ng-hide="aStatus">{{shipping_method}}</span>
				</td>
					<td align="right">$ {{shppingPrice}}</td>
					
				</tr>
				<tr data-ng-show='aStatus'>
					
					<td colspan="3" align="right" ><strong>Discount</strong></td>
					<td align="right">
						$<input type="text" data-ng-model="discount" data-ng-focus="checkDiscount()" data-ng-keyup="getDiscount()" class="discountPrice"  />
						<span data-ng-show="diserr" class="diserrmsg">{{diserr}}</span>
					</td>
					
				</tr>
				<tr>
					<td  align="right"><strong>Order Item</strong></td>
					<!--<td>{{orderTotalItem}}</td>-->
					<td align="left" > {{orderTotalItem}}</td>
					
					
					<td  align="right"><strong>Order Total</strong></td>
					<!--<td>{{orderTotalItem}}</td>-->
					<td align="right" >$ {{orderTotal |number:2}} <span data-ng-show="toterr" class="diserrmsg">{{toterr}}</span></td>
					
				</tr>
			</tbody>
		</table>
	</div>
	<div class="paymentPan">
		<h3>Payment</h3>
		<div class="paymentPanIn">
		<div data-ng-show="msg" class="errorMsg" ng-bind-html="msg | to_trusted"><i class="fa fa-times-circle-o"></i> </div>
				

		<p>
				<input type="radio" name="payment_type" data-ng-model="payment_type" value="paypal" /><span>Paypal</span>
		</p><p>
				<input type="radio" name="payment_type" data-ng-model="payment_type" value="net_30" /><span>Net 30</span>
		</p><p data-ng-show='aStatus'>
				<input type="radio" name="payment_type" data-ng-model="payment_type" value="success" /><span>Paid</span>
		</p>
		</div>
		<br class="spacer"/>
		<button  type="submit" name="order_now" data-ng-click="orderNow()" class="checkCartBtn">Order Now</button>
		<div  class="loading_small"  data-ng-show="loadProcess">
			<i class="fa fa-spinner fa-spin" ></i> Processing, Please wait...
		</div>
		<br class="spacer"/>
	</div>
<!--	<div class="paymentPan">
		<h3>Payment</h3>
		<div data-ng-show="msg" class="errorMsg" ng-bind-html="msg | to_trusted"><i class="fa fa-times-circle-o"></i> </div>
		
		<form  name="paymentFrm"  novalidate>
		<label>Card No <span class="required">*</span></label>
		<input type="text" name="card_no" data-ng-model="pay.card_no" autocomplete="off" required/>
		<span class="requiredText" ng-show="paymentFrm.card_no.$dirty && paymentFrm.card_no.$invalid"> 
			<span ng-show="paymentFrm.card_no.$error.required">Card is required.</span> 
		</span>		
		<br class="spacer" />
		<label >Exp Date <span class="required">*</span></label>
		<input data-ng-init="pay.exp_month=currentMonth" class="exp_num" name="exp_month" type="number" min="1" max="12"  data-ng-model="pay.exp_month" required />
		<input data-ng-init="pay.exp_year=currentYear" class="exp_num" name="exp_year" type="number" min="{{currentYear}}"  data-ng-model="pay.exp_year" required />
		<span class="requiredText" ng-show="paymentFrm.exp_month.$dirty && paymentFrm.exp_month.$invalid"> 
			<span ng-show="paymentFrm.exp_month.$error.required">Exp month is required.</span>
			<span class="error" ng-show="paymentFrm.exp_month.$error.number">Month must be a number</span>
			<span class="error" ng-show="paymentFrm.exp_month.$error.min">Month min 1</span>
			<span class="error" ng-show="paymentFrm.exp_month.$error.max">Month max 12</span>
		</span>
		<span class="requiredText" ng-show="paymentFrm.exp_year.$dirty && paymentFrm.exp_year.$invalid"> 
			<span ng-show="paymentFrm.exp_year.$error.required">Exp year is required.</span>
			<span class="error" ng-show="paymentFrm.exp_year.$error.number">Month must be a number</span>
			<span class="error" ng-show="paymentFrm.exp_year.$error.min">Year min {{currentYear}}</span>
		</span>
		<br class="spacer" />
		<label>CVV <span class="required">*</span></label>
		<input type="text" name="cvv_no" data-ng-model="pay.cvv" autocomplete="off" required/>
		<span class="requiredText" ng-show="paymentFrm.cvv_no.$dirty && paymentFrm.card_no.$invalid"> 
			<span ng-show="paymentFrm.cvv_no.$error.required">CVV is required.</span> 
		</span>	
		<br class="spacer" />
		<button  type="submit" name="order_now" data-ng-click="orderNow()" class="checkCartBtn">Order Now</button>
		<div  class="loading_small"  data-ng-show="loadProcess">
			<i class="fa fa-spinner fa-spin" ></i> Processing, Please wait...
		</div>
		
		<br class="spacer" />
		</form>
	</div>
-->	
</div>







  <!--<div class="modal modal-overlay" ui-if='modal2' ui-state='modal2'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close"
                ui-turn-off="modal2">&times;</button>
        <h4 class="modal-title">&nbsp;</h4>
      </div>
      <div class="modal-body">
        <div ng-include="'./user/profile'"></div>
      </div>
      <div class="modal-footer">
        <button ui-turn-off="modal2" class="btn btn-default">Close</button>
        <button ui-turn-off="modal2" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>-->


