<div class="loginPage">
	<div class="homeTopBar">
		<div class="searchPan">
<!--		<form action="#" id="search">
			<input type="text" value="Search your product" class="searchText" />
			<input type="button" value="" class="searchBtn" />
		</form>
-->		</div>
	</div>
	<h2>My Profile</h2>
	<div class="loginBox">
		
		<div data-ng-show="errmsg" class="errorMsg"><i class="fa fa-times-circle-o"></i> {{errmsg}}</div>
		<div data-ng-show="succmsg" class="succMsg"><i class="fa fa-check-circle-o"></i> {{succmsg}}</div>
		
		<h3>Update your Profile</h3>
		
		<form id="formRagistration" name="formRagistration" data-ng-model="formRagistration" novalidate>
			<label>Name <span class="required">*</span></label>
			<input type="text" name="wholesaler_name" data-ng-model="wholesaler_name" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formRagistration.name.$dirty && formRagistration.name.$invalid"> 
				<span ng-show="formRagistration.wholesaler_name.$error.required">Name is required.</span> 
			</span>			
			<label>Email <span class="required">*</span></label>
			<input type="email" name="wholesaler_email" data-ng-model="wholesaler_email" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formRagistration.wholesaler_email.$dirty && formRagistration.wholesaler_email.$invalid "> 
				<span ng-show="formRagistration.wholesaler_email.$error.required">Email is required.</span> 
				<span ng-show="formRagistration.wholesaler_email.$error.email">Invalid email address.</span> 
			</span>
			<label>Phone <span class="required">*</span></label>
			<input type="text" pattern="[0-9]{10}" name="wholesaler_phone" data-ng-model="wholesaler_phone" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formRagistration.wholesaler_phone.$dirty && formRagistration.wholesaler_phone.$invalid"> 
				<span ng-show="formRagistration.wholesaler_phone.$error.required">Phone is required.</span> 
			</span>	
			
			<label>Password</label>
			<input type="password" name="wholesaler_password" data-ng-model="wholesaler_password" class="form-control loginText"  />
			
			<label>Wholesaler ID <span class="required">*</span></label>
			<input type="text" name="wholesaler_customer_id" data-ng-model="wholesaler_customer_id" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formRagistration.wholesaler_customer_id.$dirty && formRagistration.wholesaler_customer_id.$invalid"> 
				<span ng-show="formRagistration.wholesaler_customer_id.$error.required">Wholesaler ID is required.</span> 
			</span>
			
			<label>Contact <span class="required">*</span></label>
			<input type="tel" name="wholesaler_contact" data-ng-model="wholesaler_contact" class="form-control loginText" required />
			<span class="requiredText" ng-show="formRagistration.wholesaler_contact.$dirty && formRagistration.wholesaler_contact.$invalid"> 
				<span ng-show="formRagistration.wholesaler_contact.$error.required">Contact is required.</span> 
			</span>
			<br class="spacer" />
			<h3>Billing</h3>
			<label>Address <span class="required">*</span></label>
			<input type="text" name="billing_address" data-ng-model="billing_address" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formRagistration.billing_address.$dirty && formRagistration.billing_address.$invalid"> 
				<span ng-show="formRagistration.billing_address.$error.required">Billing Address is required.</span> 
			</span>
			<label>City <span class="required">*</span></label>
			<input type="text" name="billing_city" data-ng-model="billing_city" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formRagistration.billing_city.$dirty && formRagistration.billing_city.$invalid"> 
				<span ng-show="formRagistration.billing_city.$error.required">Billing City is required.</span> 
			</span>
			
			<label>Country <span class="required">*</span></label>
			<select data-ng-model="billing_country" name="billing_country" class="form-control loginText"  required>
				<option data-ng-repeat="c in countryList" value="{{c.id}}" ng-selected="{{billing_country == c.id}}">{{c.country_name}}</option>
			</select>
			<!--<input type="text" name="country" data-ng-model="country" class="form-control loginText"  required />-->
			<span class="requiredText" ng-show="formRagistration.billing_country.$dirty && formRagistration.billing_country.$invalid"> 
				<span ng-show="formRagistration.billing_country.$error.required">Billing Country is required.</span> 
			</span>
			
			
			<label>State <span class="required">*</span></label>
			<select data-ng-model="billing_state" name="billing_state" class="form-control loginText {{(billing_country!=1)?'ng-hide':'ng-show'}}" >
				<option data-ng-repeat="s in stateList" value="{{s.default_name}}" ng-selected="{{s.default_name == billing_state}}" >{{s.default_name}}</option>
			</select>
			
			<input type="text" name="billing_text_state" data-ng-model="billing_text_state" class="form-control loginText {{(billing_country==1)?'ng-hide':'ng-show'}}"  />
			
			<!--<span class="requiredText" ng-show="b_text_state_err"> 
				<span ng-show="b_text_state_err">Billing State is required.</span> 
			</span>-->
			
			<label>Zip <span class="required">*</span></label>
			<input name="billing_zip" type="text" data-ng-model="billing_zip" class="form-control loginText"/>
			<br class="spacer" />
			<h3>Shipping</h3>
			
			<label>Address <span class="required">*</span></label>
			<input type="text" name="shipping_address" data-ng-model="shipping_address" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formRagistration.shipping_address.$dirty && formRagistration.shipping_address.$invalid"> 
				<span ng-show="formRagistration.shipping_address.$error.required">Shipping Address is required.</span> 
			</span>
			<label>City <span class="required">*</span></label>
			<input type="text" name="shipping_city" data-ng-model="shipping_city" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formRagistration.shipping_city.$dirty && formRagistration.shipping_city.$invalid"> 
				<span ng-show="formRagistration.shipping_city.$error.required">Shipping City is required.</span> 
			</span>
			
			<label>Country <span class="required">*</span></label>
			<select data-ng-model="shipping_country" name="shipping_country" class="form-control loginText"  required>
				<option data-ng-repeat="c in countryList" value="{{c.id}}" ng-selected="{{shipping_country == c.id}}">{{c.country_name}}</option>
			</select>
			<span class="requiredText" ng-show="formRagistration.shipping_country.$dirty && formRagistration.shipping_country.$invalid"> 
				<span ng-show="formRagistration.shipping_country.$error.required">Country is required.</span> 
			</span>
			
			<label>State </label>
			<select data-ng-model="shipping_state" name="shipping_state" class="form-control loginText {{(shipping_country==1)?'ng-show':'ng-hide'}}" >
				<option data-ng-repeat="s in stateList" value="{{s.default_name}}" ng-selected="{{s.default_name == shipping_state}}">{{s.default_name}}</option>
			</select>
			<input name="shipping_text_state" type="text" data-ng-model="shipping_text_state" class="form-control loginText {{(shipping_country!=1)?'ng-show':'ng-hide'}}" />
		
			
			<!--<span class="requiredText" ng-show="s_text_state_err"> 
				<span ng-show="s_text_state_err">Shipping State is required.</span> 
			</span>-->
			
			<!--<input type="text" name="country" data-ng-model="country" class="form-control loginText"  required />-->
			
			<label>Zip <span class="required">*</span></label>
			<input name="shipping_zip" type="text" data-ng-model="shipping_zip" class="form-control loginText"/>
			
			<label>Shipping <span class="required">*</span></label>
			<select data-ng-model="shipping_method" name="shipping_method" class="form-control loginText"  required>
				<option data-ng-repeat="sl in shippingList" value="{{sl.id}}" ng-selected="{{shipping_method == sl.id}}">{{sl.method_name}}</option>
			</select>
			<span class="requiredText" ng-show="formRagistration.s.$dirty && formRagistration.s_country.$invalid"> 
				<span ng-show="formRagistration.s_country.$error.required">Country is required.</span> 
			</span>
			
			<label>&nbsp;</label> <!--ng-disabled="formRagistration.$invalid"-->
			<button class="loginBtn" ng-disabled="formRagistration.$invalid" type="submit" data-ng-click="updateProfile()" >Submit</button>
			<br class="spacer" />
		</form>
	</div>
</div>