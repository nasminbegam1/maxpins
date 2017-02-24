<div class="loginPage">
	<div class="homeTopBar">
		<div class="searchPan">
			<form action="#" id="search">
				<input type="text" value="Search your product" class="searchText" />
				<input type="button" value="" class="searchBtn" />
			</form>
		</div>
	</div>
	<h2>Forgot Password</h2>
	<div class="loginBox">
		<div data-ng-show="errmsg" class="errorMsg"><i class="fa fa-times-circle-o"></i> {{errmsg}}</div>
		<div data-ng-show="succmsg" class="succMsg"><i class="fa fa-check-circle-o"></i> {{succmsg}}</div>
		<form id="formLogin" name="formLogin" data-ng-model="formLogin" novalidate>
			<label>Email <span class="required">*</span></label>
			<input type="email" name="email" data-ng-model="email" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formLogin.email.$dirty && formLogin.email.$invalid "> 
				<span ng-show="formLogin.email.$error.required">Email is required.</span> 
				<span ng-show="formLogin.email.$error.email">Invalid email address.</span> 
			</span>
			
			<label>&nbsp;</label>
			<button class="loginBtn" ng-disabled="formLogin.$invalid" type="submit" data-ng-click="submitFP()" >Submit</button><br class="spacer" /><a href="#/login" title="Click here to Login" class="forgetPass">Back to Login</a>
		</form>
	</div>
</div>