<?php //pr($cms_info);?>
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb hide">
	<li>
		<a href="#">Home</a><i class="fa fa-circle"></i>
	</li>
	<li class="active">
		Dashboard
	</li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN MAIN CONTENT -->
<div  class="margin-top-10">
	
	
	
	<div class="row">
		<div class="portlet box grey-cascade">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-basket font-green-sharp"></i>
					<span class="caption-subject bold uppercase">Edit Settings </span>
				</div>				
			</div>
			<input type="hidden" data-ng-model="product_id">
					
			<div class="portlet-body form">
				<form class="form-horizontal form-bordered ng-pristine ng-valid" id="formsettings" name="frmsettings" novalidate  >
					<div class="form-group">
						<label class="col-md-2 control-label">Settings name: <span class="required"> * </span>
						</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="sitesettings_lebel" placeholder="" data-ng-model="sitesettings_lebel" readonly="readonly">
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-2 control-label">Settings Value: <span class="required"> * </span>
						</label>
						<div class="col-md-6">
							<div data-ng-class="(sitesettings_type!='COMBO')? 'ng-show':'ng-hide'">
								<textarea name="sitesettings_value" data-ng-model="sitesettings_value" class="form-control" required></textarea>
								<span style="color:red" ng-show="frmsettings.sitesettings_value.$dirty && frmsettings.sitesettings_value.$invalid">
								<span ng-show="frmsettings.sitesettings_value.$error.required">Settings Value is required.</span>
								</span>
							</div>
							<div data-ng-class="(sitesettings_type=='COMBO' && sitesettings_name=='payment_mode')? 'ng-show':'ng-hide'">
								<input type="radio" name="sitesettings_value" value="sandbox" class="make-switch" ng-checked="sitesettings_value=='sandbox'" data-ng-model="sitesettings_value"> SandBox
								<br/>
								<input name="sitesettings_value" type="radio"  value="live" class="make-switch"  ng-checked="sitesettings_value=='live'" data-ng-model="sitesettings_value"> Live
											
							</div>
						</div>
					</div>


					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<input type="text" style="display: none;" data-ng-model="sitesettings_id" name="sitesettings_id"/>
								<button class="btn purple" ng-disabled="frmsettings.$invalid" type="submit" data-ng-click="settingUpdate()" ><i class="fa fa-check"></i> Submit</button>
								<button class="btn red" type="button" data-ng-click="back()" ><i class="fa fa-times"></i> Cancel</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
  <script type="text/javascript">
	
  </script>

<!-- END MAIN CONTENT -->
<!-- BEGIN MAIN JS & CSS -->

<!-- BEGIN MAIN JS & CSS -->

