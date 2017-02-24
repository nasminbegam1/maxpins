<style>
    .OrderPan table td{
        width: 25% !important;
    }
</style>
<div class="checkoutPan">
    <div class="checkoutTop">
        <div class="checkoutTopBtn">
        <a class="blueBtn" href="#/orders">Back to Order List</a>
        <a class="blueBtn" href="<?php echo base_url();?>order/print_invoice/{{ord_slug}}" target="_blank">Print Invoice</a>
        </div>
        </div>
        <br class="spacer"/>
	<div class="checkoutPanLeft">
		<h3>Billing Address</h3>
		<label>Name</label><span>{{userData.wholesaler_name}} </span>
		<label>Address</label><span>{{userData.wholesaler_billing_address}}</span>
		<label>City</label><span>{{userData.wholesaler_billing_city}}</span>
		<label>State</label><span>{{userData.wholesaler_billing_state}}</span>
		<label>Country</label><span>{{userData.wholesaler_billing_country_text}}</span>
		<label>Zip</label><span>{{userData.wholesaler_billing_zip}}</span>
		
	</div>
	<div class="checkoutPanRight">
		<h3>Shipping Address</h3>
		<label>Name</label><span>{{userData.wholesaler_name}} </span>
		<label>Address</label><span>{{userData.wholesaler_shipping_address}}</span>
		<label>City</label><span>{{userData.wholesaler_shipping_city}}</span>
		<label>State</label><span>{{userData.wholesaler_shipping_state}}</span>
		<label>Country</label><span>{{userData.wholesaler_billing_country_text}}</span>
		<label>Zip</label><span>{{userData.wholesaler_shipping_zip}}</span>
	</div>
	<br class="spacer"/>	
	<div class="OrderPan">
		<h3>Your Order</h3>
		<table cellpadding="0" cellspecing="0" border="0">
			<tbody>
				<tr>
                                    <td>Product</td>
                                    <td>Qty</td>
                                    <td>Sub Total</td>
                                    <td>Total</td>
				</tr>
			</tbody>
			<tbody>
				<tr data-ng-repeat="item in orders">
                                    <td><a href="#/products/{{item.product_slug}}">{{item.product_name}}</a></td>
                                    <td >{{item.product_quantity}}</td>
                                    <td>$ {{item.product_price}}</td>
                                    <td>$ {{item.total_price}}</td>
				</tr>
				
			</tbody>
		</table>
	</div>
	
        <br class="spacer"/>
        	<div class="OrderPan">
		<h3>Order Total</h3>
		<table cellpadding="0" cellspecing="0" border="0">
			
			<tbody>
                                <tr>
					<td><strong>Shipping Price</strong></td>
					<td><strong>Shipping Method :</strong> {{shipping_method}}</td>
					
                                        <td><strong>$ {{shipping_price}}</strong></td>
					
				</tr>
				<tr>
					<td><strong>Grand Total</strong></td>
					<td><strong>Qty :</strong> {{order_qty}}</td>
					
                                        <td><strong>$ {{order_total}}</strong></td>
					
				</tr>
			</tbody>
		</table>
	</div>

</div>