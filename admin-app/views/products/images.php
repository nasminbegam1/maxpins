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
					<span class="caption-subject bold uppercase">Product Images </span>
				</div>				
			</div>
			<input type="hidden" data-ng-model="product_id">
					
			<div class="portlet-body form">
				<form class="form-horizontal form-bordered ng-pristine ng-valid" id="formaddproduct" name="frmaddproduct" novalidate  >
					
					
					<div class="form-group">
						 <div class="col-md-3">

                    <input type="file" nv-file-select="" uploader="uploader" multiple  /><br/>

                </div>

                <div class="col-md-9" style="margin-bottom: 40px">
                    

                    <table class="table" data-ng-init="imgCount=0">
                        <thead>
                            <tr>
                                <th width="50%">Name</th>
                                <th ng-show="uploader.isHTML5">Size</th>
                                <th ng-show="uploader.isHTML5">Progress</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
			<tbody id="pre_images">
				<tr data-ng-repeat="item in images">
					<td>
					    <strong>{{ item.image_name }}</strong>
					    <div><img src="{{item.image_url}}?{{toTimestamp()}}" style="width: 100px;height=100px;"/></div>
					</td>
					<td nowrap>{{ item.image_size/1024/1024|number:3 }} MB</td>
					<td >
					    <div class="progress" style="margin-bottom: 0;">
						<div class="progress-bar" role="progressbar" ng-style="{ 'width': 100 + '%' }"></div>
					    </div>
					</td>
					<td class="text-center">
					    <span><i class="glyphicon glyphicon-ok"></i></span>
					    
					</td>
					<td nowrap>
					  
					    <button type="button" class="btn btn-danger btn-xs" ng-click="removeImage(item.image_id)">
						<span class="glyphicon glyphicon-trash"></span> Remove
					    </button>
					</td>
                                </tr>	
			</tbody>
			
			
                        <tbody>
                            <tr ng-repeat="item in uploader.queue">
                                <td>
                                    <strong>{{ item.file.name }}</strong>
                                    <div ng-show="uploader.isHTML5" ng-thumb="{ file: item._file, height: 100 }"></div>
                                </td>
                                <td ng-show="uploader.isHTML5" nowrap>{{ item.file.size/1024/1024|number:2 }} MB</td>
                                <td ng-show="uploader.isHTML5">
                                    <div class="progress" style="margin-bottom: 0;">
                                        <div class="progress-bar" role="progressbar" ng-style="{ 'width': item.progress + '%' }"></div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span ng-show="item.isSuccess"><i class="glyphicon glyphicon-ok"></i></span>
                                    <span ng-show="item.isCancel"><i class="glyphicon glyphicon-ban-circle"></i></span>
                                    <span ng-show="item.isError"><i class="glyphicon glyphicon-remove"></i></span>
                                </td>
                                <td nowrap>
                                    <button type="button" class="btn btn-success btn-xs" ng-click="item.upload()" ng-disabled="item.isReady || item.isUploading || item.isSuccess">
                                        <span class="glyphicon glyphicon-upload"></span> Upload
                                    </button>
                                    <button type="button" class="btn btn-danger btn-xs" ng-click="item.remove()">
                                        <span class="glyphicon glyphicon-trash"></span> Remove
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div>
                        <div ng-hide="!uploader.queue.length">
                            Queue progress:
                            <div class="progress" style="" >
                                <div class="progress-bar" role="progressbar" ng-style="{ 'width': uploader.progress + '%' }"></div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success btn-s" ng-click="uploader.uploadAll()" ng-hide="!uploader.getNotUploadedItems().length">
                            <span class="glyphicon glyphicon-upload"></span> Upload all
                        </button>
                        <button type="button" class="btn btn-danger btn-s" ng-click="uploader.clearQueue()" ng-hide="!uploader.queue.length">
                            <span class="glyphicon glyphicon-trash"></span> Remove all
                        </button>
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

