<div class="row">
<div class="col-md-12">
	<!-- BEGIN EXAMPLE TABLE PORTLET-->
	<div class="portlet box grey-cascade">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-globe"></i>Listing
			</div>
		</div>
		
		<div class="portlet-body">
			<table class="table table-striped table-bordered table-hover" id="sample_1">
			<thead>
			<tr>
				<th>Settings Name</th>
				<th>Settings Value</th>
				<th>Actions</th>
			</tr>
			</thead>
			
			<tbody>
			<tr class="odd gradeX" data-ng-repeat="s in settinglist">
				<td>{{s.sitesettings_lebel}}</td>
				<td>{{s.sitesettings_value}}</td>
				<td>
					<a href="#/settings/edit/{{s.sitesettings_id}}">Edit</a>
				</td>
			</tr>
			
			<tr class="{{settinglist==false?'ng-show':'ng-hide'}}">
					<td colspan="3">No Record found</td>
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