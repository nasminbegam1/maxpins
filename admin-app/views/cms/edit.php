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
					<i class="fa fa-gift"></i>Edit CMS
				</div>
				<!--<div class="tools">
					<a class="collapse" href="javascript:;" data-original-title="" title="">
					</a>
					<a class="config" data-toggle="modal" href="#" data-original-title="" title="">
					</a>
					<a class="reload" href="javascript:;" data-original-title="" title="">
					</a>
					<a class="remove" href="javascript:;" data-original-title="" title="">
					</a>
				</div>-->
			</div>
			<input type="hidden" data-ng-model="cms_id">
					
			<div class="portlet-body form">
				<form class="form-horizontal form-bordered ng-pristine ng-valid" id="formProfile" name="formCms" novalidate >
					<div class="form-group">
						<label class="col-sm-3 control-label">CMS Title</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control tt-hint"  data-ng-model="cms_title" readonly="readonly">
								</span>
							</div>
							
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">CMS Content</label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-user"></i>
								</span>
<!--								<span class="twitter-typeahead">
								<text-angular name="cms_content" ng-model="cms_content"></text-angular>
  
								</span>
-->
							<textarea class="ck-editor" ng-model="cms_content"></textarea>
							</div>
							
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Meta Title</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control tt-hint"  data-ng-model="cms_meta_title" name="cms_meta_title" required>
								<span style="color:red" ng-show="formCms.cms_meta_title.$dirty && formCms.cms_meta_title.$invalid">
<span ng-show="formCms.cms_meta_title.$error.required">Meta title is required.</span>
</span>      
								</span>
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Meta Keyword</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<input type="text" class="form-control tt-hint" data-ng-model="cms_meta_key" name="cms_meta_key" required>
									<span style="color:red" ng-show="formCms.cms_meta_key.$dirty && formCms.cms_meta_key.$invalid">
<span ng-show="formCms.cms_meta_key.$error.required">Meta Keyword is required.</span>
</span>      
								
								</span>
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Meta Description</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
								<textarea class="form-control" name="cms_meta_desc" id="cms_meta_desc1" data-ng-model="cms_meta_desc" rows="10" required></textarea></span>
								<span style="color:red" ng-show="formCms.cms_meta_desc.$dirty && formCms.cms_meta_desc.$invalid">
<span ng-show="formCms.cms_meta_desc.$error.required">Meta Description is required.</span>
</span>      
								
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Featured</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i>
								</span>
								<span class="twitter-typeahead">
									<select name="featured" ng-model="featured" class="form-control tt-hint">
										<option value="No" selected="{{featured == 'No' ? 'selected' : ''}}">No</option>
										<option value="Yes" selected="{{featured == 'Yes' ? 'selected' : ''}}">Yes</option>
									</select>
								</span>      
								
							</div>
							
						</div>
					</div>

					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn purple" ng-disabled="formCms.$invalid" type="submit" data-ng-click="cmsUpdate()" ><i class="fa fa-check"></i> Submit</button>
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

