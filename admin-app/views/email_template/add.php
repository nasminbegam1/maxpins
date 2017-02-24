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
					<i class="fa fa-gift"></i>Add Email Template
				</div>
				
			</div>
			
					
			<div class="portlet-body form">
				<form class="form-horizontal form-bordered ng-pristine ng-valid" id="formTemplate" name="formTemplate" novalidate >
					<div class="form-group">
						<label class="col-sm-3 control-label">Email Template Name <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control tt-hint"  data-ng-model="template_name" name="template_name" required>
								<span style="color:red" ng-show="formTemplate.template_name.$dirty && formTemplate.template_name.$invalid">
<span ng-show="formTemplate.template_name.$error.required">Email Template Name is required.</span>
								</span>
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Responce Email  <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control tt-hint"  data-ng-model="response_email" name="response_email" required>
								<span style="color:red" ng-show="formTemplate.responce_email.$dirty && formTemplate.responce_email.$invalid">
<span ng-show="formTemplate.responce_email.$error.required">Response Email is required.</span>
								</span>
								
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Email Subject <span class="required"> * </span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control tt-hint"  data-ng-model="email_subject" name="email_subject" required>
								<span style="color:red" ng-show="formTemplate.email_subject.$dirty && formTemplate.email_subject.$invalid">
<span ng-show="formTemplate.email_subject.$error.required">Email Subject is required.</span>
								</span>
								
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Email Template Content <span class="required"> * </span><br><span class="required">{{content_warning_msg}}</span></label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
								<span class="twitter-typeahead">
								<text-angular name="email_content" data-ng-model="email_content" required></text-angular>
								<label class="col-sm-3 control-label"></label>
  
								<span style="color:red" ng-show="formTemplate.email_content.$dirty && formTemplate.email_content.$invalid">
								<span ng-show="formTemplate.email_content.$error.required">Email Content is required.</span>
								</span>
							</div>
							
						</div>
					</div>
					
					
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn purple" ng-disabled="formTemplate.$invalid" type="submit" data-ng-click="templateAdd()" ><i class="fa fa-check"></i> Submit</button>&nbsp;
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

