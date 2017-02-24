<div class="row">
<div class="col-md-12">
	<!-- BEGIN EXAMPLE TABLE PORTLET-->
	<div class="portlet box grey-cascade">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-globe"></i>Product Type Listing
			</div>
			<div class="actions btn-set">
				<div class="btn-group">
					<a class="btn btn-default btn-circle" data-toggle="dropdown" href="#/producttype/add"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product Type</a>
				</div>
			</div>
		</div>
		
		<div class="portlet-body">
			<table class="table table-striped table-bordered table-hover" id="sample_1">
			<thead>
			<tr>
				<th>Type Name</th>
				<th>Status</th>
				<th>Actions</th>
			</tr>
			</thead>
			
			<tbody>
			<tr class="odd gradeX" data-ng-repeat="c in producttypelist">
				<td>{{c.type_name}}</td>
				<td>{{c.status}}</td>
				<td>
					<a href="#/producttype/edit/{{c.id}}">Edit</a>
					|
					<a href="javascript:void(0)" ng-click="deleteCategory(c.id)">Delete</a>
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