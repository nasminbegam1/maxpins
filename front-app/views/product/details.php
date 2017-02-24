<div class="homeContent productDetailPan">
	<div class="homeTopBar">
		<div class="searchPan">
		<form  id="search" data-ng-submit="searchProduct()">
			<input type="text" placeholder="Search your product" class="searchText" data-ng-model="keyword" />
			<input type="button" value="" class="searchBtn" data-ng-click="searchProduct()"/>
		</form>
		</div>
	</div>
	<h1>Product details</h1>
	<div class="productDetailLeft">
            <img ng-src="{{bigImage}}"  />
            <div class="thumb-img" data-ng-class="{{(product.images.length > 0)? 'ng-show':'ng-hide'}}" >
                <span data-ng-repeat="img in product.images">
                    <img src="{{img.image_thumb_name}}"  data-ng-click="viewBig(img.image_name)"  />
                </span>
            </div>
        </div>
	<div class="productDetailRight">
		<h2>{{product.product_name}} <!--- {{product.product_sku}}--> </h2>
		
		<span data-ng-class="(Global.log()!='')?'ng-show':'ng-hide'" class="priceText">${{product.price}} </span>
		<span data-ng-class="(product.inv_status=='false')? 'ng-hide':'ng-show'">
		<span class="inventory">Current Inventory : <span>{{product.inventory_qty}}</span></span>		
		</span>
		<span class="inventory">Product Type : <span>{{product.type_name}}</span></span>
		<span data-ng-class="(Global.log()=='')?'ng-show':'ng-hide'" class="inventory">Manufactured Quantity: <span>{{product.manufactured_qty}}</span></span>
		<span class="qtyText" data-ng-class="(Global.log()!='')?'ng-show':'ng-hide'"><span>Qty :</span>
			<!--<div class="numberControl">
				<input type="number" value="0" name="qty" id="qty" data-ng-model="cartQty" />
				<i class="upArrow fa fa-caret-up" data-ng-click="countUp($event)"></i>
				<i class="downArrow fa fa-caret-down" data-ng-click="countDown($event)"></i>
			</div>-->
			
			<div class="SelectAnyQuantity">
				<input type="text" value="0" name="qty" id="qty" data-ng-model="cartQty" />
				<a href="javascript:void(0);" title="" data-ng-click="countUp($event)"><i class="fa fa-caret-up" ></i> Up</a>
				<a href="javascript:void(0);" title="" data-ng-click="countDown($event)"><i class="fa fa-caret-down" ></i> Down</a>
			</div>
			
			<label data-ng-class="(product.custom_pins_status==true && cartQty< 100 )? 'ng-show':'ng-hide' " >Select at least 100 quantity</label>
			<label data-ng-hide="cartQty" >Select any quantity</label> 
		</span>		

		<p>{{product.product_description}}</p>
		<div data-ng-class="(Global.log()!='')?'ng-show':'ng-hide'"  class="cartActionBox">
			<a href="javascript:void(0);" class="add_to_cart details-btn1"  data-ng-click="addToCart()" >
				Add to Cart
			</a>
			<a href="#/products" class="add_to_cart details-btn2"   >
				Continue Shopping
			</a>
			<br class="spacer"/>
			<p data-ng-class="(product.custom_pins=='100')?'ng-show':'ng-hide'" class="custompinsMsg">You can pay now or NET 30 after the product is delivered.  Product delivery is approximately 3 - 4 weeks</p>
			<br class="spacer"/>
			<strong class="cartLoader"   data-ng-show="loadStatus"><i class="fa fa-spinner fa-spin" ></i></strong>
			
			<p data-ng-init="msg=''" data-ng-show="msg" data-ng-bind-html="msg  | to_trusted" class="blueText2"></p>
		</div>

	</div>
	<br class="spacer" />
</div>