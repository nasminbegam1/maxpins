<div class="row">
<div class="col-md-12">
	<!-- BEGIN EXAMPLE TABLE PORTLET-->
	<div class="portlet box grey-cascade">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-globe"></i>Category Listing
			</div>
			<div class="actions btn-set">
				<div class="btn-group">
					<a class="btn btn-default btn-circle" data-toggle="dropdown" href="#/category/add"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Category</a>
				</div>
			</div>
		</div>
		
		<div class="portlet-body">
			<table class="table table-striped table-bordered table-hover" id="sample_1">
			<thead>
			<tr>
				<th>Category Name</th>
				<th>Status</th>
				<th>Actions</th>
			</tr>
			</thead>
			
			<tbody>
			<tr class="odd gradeX" data-ng-repeat="c in categorylist">
				<td>{{c.category_name}}</td>
				<td>{{c.category_status}}</td>
				<td>
					<a href="#/category/edit/{{c.category_id}}">Edit</a>
					|
					<a href="javascript:void(0)" ng-click="deleteCategory(c.category_id)">Delete</a>
				</td>
			</tr>
			
			<tr class="{{categorylist==false?'ng-show':'ng-hide'}}">
					<td colspan="4">No Record found</td>
			</tr>
			
			</tbody>
			<tfoot>
					<tr>
					<td colspan="4">
										
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