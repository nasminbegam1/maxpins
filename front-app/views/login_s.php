<div class="loginPage">
	<div class="homeTopBar">
		<div class="searchPan">
			<form action="#" id="search">
				<input type="text" value="Search your product" class="searchText" />
				<input type="button" value="" class="searchBtn" />
			</form>
		</div>
	</div>
	<h2>Login</h2>
	<div class="loginBox">
		<div data-ng-show="errmsg" class="errorMsg"><i class="fa fa-times-circle-o"></i> {{errmsg}}</div>
		<form id="formLogin" name="formLogin" data-ng-model="formLogin" novalidate>
			<label>Email</label>
			<input type="email" name="email" data-ng-model="email" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formLogin.email.$dirty && formLogin.email.$invalid "> 
				<span ng-show="formLogin.email.$error.required">Email is required.</span> 
				<span ng-show="formLogin.email.$error.email">Invalid email address.</span> 
			</span>
			<label>Password</label>
			<input type="password" name="password" data-ng-model="password" class="form-control loginText"  required />
			<span class="requiredText" ng-show="formLogin.password.$dirty && formLogin.password.$invalid"> 
				<span ng-show="formLogin.password.$error.required">Password is required.</span> 
			</span>
			<label>&nbsp;</label>
			<button class="loginBtn" ng-disabled="formLogin.$invalid" type="submit" data-ng-click="submitLogin()" >Submit</button>
			<span class="createAccount">Or <a href="#/registration" title="Create your account">Create your account</a></span> <br class="spacer" />
			<a href="#/forget_password" title="Forgot password ? click here" class="forgetPass">Forgot password ? click here</a>
		</form>
	</div>
</div>
