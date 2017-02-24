<div class="row">
					<div class="col-md-12">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet box grey-cascade">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-globe"></i>Managed Table
								</div>
								<!--<div class="actions btn-set">
										<div class="btn-group">
											<a class="btn btn-default btn-circle" data-toggle="dropdown" href="#/cms/add"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add CMS</a>
										</div>
					                        </div>-->
								
							</div>
							
							<div class="portlet-body">
								<div class="table-toolbar">
									<div class="row">
										<!--<div class="col-md-6">
											<div class="btn-group">-->
												<!--<button id="sample_editable_1_new" class="btn green">
												Add New <i class="fa fa-plus"></i>
												</button>-->
												<!--<a href="#/cms/add">Add CMS</a>
											</div>
										</div>-->
										<!--<div class="col-md-6">
											<div class="btn-group pull-right">
												<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
												</button>
												<ul class="dropdown-menu pull-right">
													<li>
														<a href="#">
														Print </a>
													</li>
													<li>
														<a href="#">
														Save as PDF </a>
													</li>
													<li>
														<a href="#">
														Export to Excel </a>
													</li>
												</ul>
											</div>
										</div>-->
									</div>
								</div>
								<table class="table table-striped table-bordered table-hover" id="sample_1">
								<thead>
								<tr>
									<th>
										 CMS Title
									</th>
									<th>
										 CMS Status
									</th>
									<th>
										 Actions
									</th>
								</tr>
								</thead>
								<tbody>
								<tr class="odd gradeX" data-ng-repeat="c in cmslist">
									<td>{{c.cms_title}}</td>
									<td>{{c.cms_status=='1' ? 'Active' : 'Inactive'}}</td>
									<td>
										<a href="#/cms/edit/{{c.cms_id}}">Edit</a>
										<!--<br>
										<a href="#/cms/edit/{{c.cms_id}}">Delete</a>-->
									</td>
								</tr>
								
								</tbody>
								<tfoot>
										<tr>
										<td colspan="3">
															
										<div class="pagination-container" ng-bind-html="pagiLink"></div>
										</td>
										</tr>
								</tfoot>
								</table>
							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->
					</div>
				</div>