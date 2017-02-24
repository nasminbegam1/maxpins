<div class="logo">
	<a href="index.html">
	<img src="images/MaxPins.png" alt=""/>
	</a>
</div>
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" name="loginFrm" novalidate>
		<div class="form-title">
			<span class="form-title">Welcome.</span>
			<span class="form-subtitle">Please login.</span>
		</div>
		<div data-ng-show="err" data-ng-bind="errmsg" style="color:red;font-style: italic;"></div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<input class="form-control form-control-solid placeholder-no-fix" data-ng-model="email" type="email" autocomplete="off" placeholder="email" name="email" required/>
			<span style="color:red" ng-show="loginFrm.email.$dirty && loginFrm.email.$invalid">
                                <span ng-show="loginFrm.email.$error.required">Email is required.</span>
                                <span ng-show="loginFrm.email.$error.email">Email is not valid.</span>
                        </span>    
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<input class="form-control form-control-solid placeholder-no-fix" data-ng-model="password" type="password" autocomplete="off" placeholder="Password" name="password" required/>
			<span style="color:red" ng-show="loginFrm.password.$dirty && loginFrm.password.$invalid">
                                <span ng-show="loginFrm.password.$error.required">Password is required.</span>  
                        </span>     
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary btn-block uppercase" data-ng-disabled="loginFrm.$invalid" data-ng-click="loginSubmit()">Login</button>
		</div>
		
	</form>
	<!-- END LOGIN FORM -->
	
</div>
<div class="copyright hide">
	 2014 © Metronic. Admin Dashboard Template.
</div>
<!-- END LOGIN -->