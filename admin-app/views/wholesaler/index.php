<style>
	.sortable{
		cursor: pointer;
	}
</style>
<div class="row">
	<div class="col-md-12">
          <div class="portlet light">
             <div class="portlet-title">
                <div class="caption">
                     <i class="fa fa-cogs"></i>Wholesaler Search
                </div>
             </div>
	     <form class="form-horizontal form-bordered ng-pristine ng-valid" id="formProfile" name="frmSP" novalidate >
	     <div class="portlet-body">                 
                     <div class="form-group col-md-12">                       
                       <div class="col-md-4">
                            <label>Wholesaler Name/Email</label>
                            <input type="text" name="wholesaler_name_email" class="form-control" data-ng-model="wholesaler_name_email"  required />
			    <span style="color:red" ng-show="frmSP.wholesaler_name_email.$dirty && frmSP.wholesaler_name_email.$invalid">
<span ng-show="frmSP.wholesaler_name_email.$error.required">Wholesaler name/email is required.</span>  
                       </div>
		      
		       <div class="col-md-4">
			<label>&nbsp;</label><br class="clear">
                            <button class="btn purple" ng-disabled="frmSP.$invalid" data-ng-click="searchWholesaler();">Search</button>
			    <button class="btn green" data-ng-click="clearAll();">Clear Search</button>
                       </div>
                     </div>
	     </div>
	     </form>
	  </div>
	</div>
</div>

<div class="row">
<div class="col-md-12">
	<!-- BEGIN EXAMPLE TABLE PORTLET-->
	<div class="portlet box grey-cascade">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-globe"></i>Wholesaler Lists
			</div>
			<div class="actions btn-set">
					<div class="btn-group">
						<a class="btn btn-default btn-circle" data-toggle="dropdown" href="#/wholesaler/add"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Wholesaler</a>
					</div>
			</div>
			
		</div>
		
		<div class="portlet-body">
			<div class="table-toolbar">
				<div class="row">
					
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
			<table class="table sortableTable table-striped table-bordered table-hover" id="sample_1">                                                     

			<thead>
			<tr>
				<th class="sortable" ng-click="sortType = 'wholesaler_name'; sortReverse = !sortReverse;customSorting(); ">
					Wholesaler Name
					<span ng-show="sortType == 'wholesaler_name' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'wholesaler_name' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th class="sortable" ng-click="sortType = 'wholesaler_email'; sortReverse = !sortReverse;customSorting(); ">
					Wholesaler Email
					<span ng-show="sortType == 'wholesaler_email' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'wholesaler_email' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th class="sortable" ng-click="sortType = 'wholesaler_status'; sortReverse = !sortReverse;customSorting(); ">
					Status
					<span ng-show="sortType == 'wholesaler_status' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'wholesaler_status' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th>Action</th>
			</tr>
			</thead>
			
			<tbody>
			<tr class="odd gradeX" data-ng-repeat="w in wholesalerlist ">
				<td>{{w.wholesaler_name}}</td>
				<td>{{w.wholesaler_email}}</td>
				<td>{{w.wholesaler_status}}</td>
				<td>
					<a href="#/wholesaler/edit/{{w.wholesaler_id}}">Edit</a>
					|
					<a href="javascript:void(0)" ng-click="deleteWholesaler(w.wholesaler_id)">Delete</a>
				</td>
			</tr>
			
			<tr class="{{wholesalerlist==false?'ng-show':'ng-hide'}}">
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