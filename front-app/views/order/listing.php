<div class="homeContent">
    <h1>Custom Pins<span>For custom pins, you must order in a quantity of 100 or more</span></h1>
   
    <div class="custompinsbox proListHome clearfix">
        			<ul data-ng-class="(products.length > 0)? 'ng-show':'ng-hide'">
				<li data-ng-repeat="product in products">
					
					<a href="#/products/{{product.product_slug}}" title=""><img src="{{product.image_name}}" alt="" /></a>
					<h3>{{product.product_name}}</h3>
					<p data-ng-class="(Global.log()!='')?'ng-show':'ng-hide'">${{product.price}}</p>
					<span class="blueBox">
						<!--<span data-ng-class="(Global.log()!='')?'ng-show':'ng-hide'">
							<a href="javascript:void(0)" data-ng-click="addProductCart($event)" data-element="{{product.product_id}}" data-max-qty="{{product.inventory_qty}}" title="" >Order now</a>
						<strong>/</strong></span>
						<a href="#/products/{{product.product_slug}}" title="">View details</a>-->
                                                <!--<a href="#/products/{{product.product_slug}}" title="">Order Now</a>-->
                                                <span data-ng-class="(Global.log()!='')?'ng-show':'ng-hide'">
							<a href="#/products/{{product.product_slug}}" title="" >Order now</a>
						</span>
						<span data-ng-class="(Global.log()=='')?'ng-show':'ng-hide'">
                                                    <a href="#/products/{{product.product_slug}}" title="">View details</a>
						</span>
					</span>
					
					<span class="checkPan ng-hide">
						
						<a href="#/checkout" class="succstatus" style="display: none;"></a>
						<span  class="errstatus" style="display: none;position: absolute;top: 50%;margin-top:-20px;left: 0;right:0;" >Product is out of stock<br/>Please try again later</span>
					</span>
					
				</li>
			</ul>

    </div>
    <div class="shop-maxpins"> <a class="blueBtn" href="#/products/">Shop Maxpins</a></div>
    <h1>Order History</h1>
    <div class="cartPan">
        <table class="cartPanTable"  data-ng-class="(orders.length >0)? 'ng-show':'ng-hide'">
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Price</th>
                <th>Payment Status</th>
                <th>Order Status</th>
		<th>Action</th>
            </tr>
            <tr data-ng-repeat="item in orders">
                <td>
		    MX - {{item.id}}
		</td>
                <td>{{item.added_on}}</td>
                <td>$ {{item.total_price}}</td>
                <td>{{item.payment_status}}</td>
                <td>{{item.shipping_status}}</td>
		<td width="20%">
		    <a href="#/orders/{{item.order_slug}}" class="blueBtn" style="padding: 3px;clear: none;margin-right: 3px;">Details</a>
		    &nbsp;&nbsp;
		    <a href="javascript:void(0);" data-ng-click="setReorder(item.id)" class="blueBtn" style="padding: 3px;clear: none;">Reorder</a>
		</td>
            </tr>
        </table>
        
        <div class="noRecord" style="display: none();">
		<span> <i class="fa fa-exclamation-triangle"></i> No Order Found</span>
	</div>
     
    </div>
</div>