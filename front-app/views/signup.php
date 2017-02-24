<div class="loginPage">
	<div class="homeTopBar">
		<div class="searchPan">
		<form action="#" id="search">
			<input type="text" value="Search your product" class="searchText" />
			<input type="button" value="" class="searchBtn" />
		</form>
		</div>
	</div>
	<h2>Registration</h2>
	<div class="loginBox">
		<div data-ng-show="errmsg" class="errorMsg"><i class="fa fa-times-circle-o"></i> {{errmsg}}</div>
		<div data-ng-show="succmsg" class="succMsg"><i class="fa fa-check-circle-o"></i> {{succmsg}}</div>
		<form id="formRagistration" name="formRagistration" data-ng-model="formRagistration" novalidate>
			<label>Business Name <span class="required">*</span></label>
			<input type="text" name="name" data-ng-model="form.name" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formRagistration.name.$dirty && formRagistration.name.$invalid"> 
				<span ng-show="formRagistration.name.$error.required">Name is required.</span> 
			</span>			
			<label>Email <span class="required">*</span></label>
			<input type="email" name="email" data-ng-model="form.email" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formRagistration.email.$dirty && formRagistration.email.$invalid "> 
				<span ng-show="formRagistration.email.$error.required">Email is required.</span> 
				<span ng-show="formRagistration.email.$error.email">Invalid email address.</span> 
			</span>
			<label>Phone <span class="required">*</span></label>
			<input type="text" name="phone" data-ng-model="form.phone" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formRagistration.phone.$dirty && formRagistration.phone.$invalid"> 
				<span ng-show="formRagistration.phone.$error.required">Phone is required.</span> 
			</span>	
			
			<label>Password <span class="required">*</span></label>
			<input type="password" name="password" data-ng-model="form.password" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formRagistration.password.$dirty && formRagistration.password.$invalid"> 
				<span ng-show="formRagistration.password.$error.required">Password is required.</span> 
			</span>
			
			<label>Wholesaler ID <span class="required">*</span></label>
			<input type="text" name="wholesaler_customer_id" data-ng-model="form.wholesaler_customer_id" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formRagistration.wholesaler_customer_id.$dirty && formRagistration.wholesaler_customer_id.$invalid"> 
				<span ng-show="formRagistration.wholesaler_customer_id.$error.required">Wholesaler ID is required.</span> 
			</span>
			
			<label>Contact <span class="required">*</span></label>
			<input type="tel"  name="contact" data-ng-model="form.contact" class="form-control loginText" required />
			<span class="requiredText" ng-show="formRagistration.contact.$dirty && formRagistration.contact.$invalid"> 
				<span ng-show="formRagistration.contact.$error.required">Contact is required.</span> 
			</span>
			<br class="spacer" />
			<h3>Billing</h3>
			<label>Address <span class="required">*</span></label>
			<input type="text" name="address" data-ng-model="form.b_address" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formRagistration.address.$dirty && formRagistration.address.$invalid"> 
				<span ng-show="formRagistration.address.$error.required">Address is required.</span> 
			</span>
			<label>City <span class="required">*</span></label>
			<input type="text" name="city" data-ng-model="form.b_city" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formRagistration.city.$dirty && formRagistration.city.$invalid"> 
				<span ng-show="formRagistration.city.$error.required">City is required.</span> 
			</span>
			
			<label>Country <span class="required">*</span></label>
			<select data-ng-model="form.b_country" name="b_country" class="form-control loginText"  required>
				<option data-ng-repeat="c in country" value="{{c.id}}" ng-selected="{{b_country == c.id}}">{{c.country_name}}</option>
			</select>
			<!--<input type="text" name="country" data-ng-model="country" class="form-control loginText"  required />-->
			<span class="requiredText" ng-show="formRagistration.b_country.$dirty && formRagistration.b_country.$invalid"> 
				<span ng-show="formRagistration.b_country.$error.required">Country is required.</span> 
			</span>
			
			
			<label>State <span class="required">*</span></label>
			<select data-ng-model="form.b_state" name="b_state" class="form-control loginText {{(form.b_country!=1)?'ng-hide':'ng-show'}}"   required>
				<option data-ng-repeat="s in state" value="{{s.default_name}}" ng-selected="{{s.default_name == b_state}}" >{{s.default_name}}</option>
			</select>
			
			<input type="text" name="b_text_state" data-ng-model="form.b_text_state"  class="form-control loginText {{(form.b_country==1)?'ng-hide':'ng-show'}}"  />
			
			<span class="requiredText" ng-show="b_text_state_err"> 
				<span ng-show="b_text_state_err">State is required.</span> 
			</span>
			
			<label>Zip <span class="required">*</span></label>
			<input name="b_zip" type="text" data-ng-model="form.b_zip" class="form-control loginText"/>
			<br class="spacer" />
			<h3>Shipping <span style="color:#FFFFFF;font-size:12px;"> <input type="checkbox"  data-ng-click="sameAsBill($event)" /> 	Same as Billing</span></h3>
			
			<label>Address <span class="required">*</span></label>
			<input type="text" name="address" data-ng-model="form.s_address" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formRagistration.address.$dirty && formRagistration.address.$invalid"> 
				<span ng-show="formRagistration.address.$error.required">Address is required.</span> 
			</span>
			<label>City <span class="required">*</span></label>
			<input type="text" name="city" data-ng-model="form.s_city" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formRagistration.city.$dirty && formRagistration.city.$invalid"> 
				<span ng-show="formRagistration.city.$error.required">City is required.</span> 
			</span>
			
			<label>Country <span class="required">*</span></label>
			<select data-ng-model="form.s_country" name="s_country" class="form-control loginText"  required>
				<option data-ng-repeat="c in country" value="{{c.id}}" ng-selected="{{s_country == c.id}}">{{c.country_name}}</option>
			</select>
			<span class="requiredText" ng-show="formRagistration.s.$dirty && formRagistration.s_country.$invalid"> 
				<span ng-show="formRagistration.s_country.$error.required">Country is required.</span> 
			</span>
			
			<label>State <span class="required">*</span></label>
			<select data-ng-model="form.s_state" name="s.state" class="form-control loginText {{(form.s_country==1)?'ng-show':'ng-hide'}}"  required>
				<option data-ng-repeat="s in state" value="{{s.default_name}}" ng-selected="{{s.default_name == s_state}}">{{s.default_name}}</option>
			</select>
			<input name="s_text_state" type="text" data-ng-model="form.s_text_state" class="form-control loginText {{(form.s_country!=1)?'ng-show':'ng-hide'}}" />
		
			
			<span class="requiredText" ng-show="s_text_state_err"> 
				<span ng-show="s_text_state_err">State is required.</span> 
			</span>
			
			<!--<input type="text" name="country" data-ng-model="country" class="form-control loginText"  required />-->
			
			<label>Zip <span class="required">*</span></label>
			<input name="s_zip" type="text" data-ng-model="form.s_zip" class="form-control loginText"/>
			
			<label>Shipping </label>
			<select data-ng-model="form.shipping_method" name="shipping_method" class="form-control loginText" >
				<option value="">Select One</option>
				<option data-ng-repeat="sl in shippingList" value="{{sl.id}}" ng-selected="{{sl.id == 1}}">{{sl.method_name}}</option>
			</select>
			
			<label>&nbsp;</label> <!--ng-disabled="formRagistration.$invalid"-->
			
			<button class="loginBtn" ng-disabled="formRagistration.$invalid" type="submit" data-ng-click="signUpSubmit()" >Submit</button>
			
			<span  class="loading_small"  data-ng-show="loadProcess" style="float: left; padding-left:10px;">
				<i class="fa fa-spinner fa-spin" ></i> Processing, Please wait...
			</span>
			
		</form>
	</div>
</div>