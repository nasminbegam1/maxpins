<div style="padding: 10px;color:red;">{{not_added_product}}</div>
<div class="cartPan" data-ng-class="(itemCount>0)?'ng-show':'ng-hide'">
<table class="cartPanTable"  >
	<tr>
		<th>Product</th>
		
		<th>Price</th>
		<th>Qty</th>
		<th>Total</th>
		<th></th>
	</tr>
	<tr data-ng-repeat="item in cartItems | orderBy:'cart_item_name'" >
		<td>
			<img ng-src="{{item.image_name}}" />
			{{item.name}}
		</td>
		
		<td>${{item.price}}</td>
		<td>
			
			<div class="numberControl">
				<input type="number" class="cartItem" data-item="{{item.rowid}}" min="0" max="{{item.inv_qty}}" name="itemQty" value="{{item.qty}}" />
				<i class="upArrow fa fa-caret-up" data-ng-click="countUp($event)"></i>
				<i class="downArrow fa fa-caret-down" data-ng-click="countDown($event)"></i>
			</div>
			<br/>
			<span class="minQty" style="display: none;color: red;"><i>Min 1 qty is needed to process</i></span>
			<span class="maxQty" style="display: none;color: red;"><i>Max {{item.inv_qty}} qty are avabilable</i></span>
		</td>
		<td>${{item.subtotal}}</td>
		<td><a href="javascript:void(0)" data-ng-click="removeItem(item.rowid)"> <i class="fa fa-times"></i></a></td>
	</tr>
</table>
<div class="cartActionPan">
	<button class="checkCartBtn" data-ng-click="continueShopping()">Continue Shopping</button>
	<button class="updateCartBtn" data-ng-click="updateCart()">Update Cart</button>
	<button class="checkCartBtn" data-ng-click="checkOut()">Check out</button>
</div>

<div class="totalCartPan">
	<h2>Cart Total</h2>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td>Order Total</td>
			<td><strong>${{total}}</strong></td>
		</tr>
	</table>
</div>

</div>
<div class="noCartPan" data-ng-class="(itemCount==0)?'ng-show':'ng-hide'">
	<span> <i class="fa fa-shopping-cart"></i> Your cart is empty</span>
</div>