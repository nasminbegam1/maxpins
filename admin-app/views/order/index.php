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
                     <i class="fa fa-cogs"></i>Order Filtration
                </div>
             </div>
	     <div class="portlet-body">                 
                     <div class="form-group col-md-12">                       
                       <div class="col-md-4">
                            <label>Wholesaler Name</label>
                            <select name="wholesaler_name" data-ng-model="wholesaler_name" class="form-control">
                               <option value="">--Select--</option>
                               <option ng-repeat="w in wholesalerList" value="{{w.wholesaler_id}}" ng-selected="{{ search_wholesaler_name==w.wholesaler_id }}">{{w.wholesaler_name}}</option>
			    </select>                           
                       </div>
		       <div class="col-md-4">
                            <label>Start Date</label>
                            <input type="text" name="start_date"  datepicker-popup="{{format}}" data-ng-model="start_date" is-open="openedStartDatePicker" datepicker-options="dateOptions" close-text="Close" class="form-control search_start_date" readonly="readonly" ng-click="openStartDatePicker($event)" ng-change="getDatePickerValue()" data-date="">     
                       </div>
		       <div class="col-md-4">
                            <label>End Date</label>
                            <input type="text" name="end_date" data-ng-model="end_date" datepicker-popup="{{format}}" is-open="openedEndDatePicker" datepicker-options="dateOptions" close-text="Close" class="form-control search_end_date" data-date="" readonly="readonly" ng-click="openEndDatePicker($event)" ng-change="getEndDatePickerValue()">    
                       </div>
                     </div>
		     <div class="form-group col-md-12">                       
                       <div class="col-md-4">
                            <label>Payment Status</label>
                            <select name="payment_status" data-ng-model="payment_status" class="form-control">
                               <option value="">--Select--</option>
			       <option value="Net 30" ng-selected="{{ search_payment_status=='Net 30'}}">Net 30</option>
                               <!--<option value="Failure">Failure</option>-->
			       <option value="Processing"  ng-selected="{{ search_payment_status=='Processing'}}">Processing</option>
			       <option value="Success"  ng-selected="{{ search_payment_status=='Success'}}">Paid</option>
			    </select>                           
                       </div>
		       <div class="col-md-4">
                            <label>Order Status</label>
                            <select name="shipment_status" data-ng-model="shipment_status" class="form-control">
                               <option value="">--Select--</option>
                               <option value="New" >New</option>
			       <option value="Ordered">Ordered</option>			       
			       <option value="Shipped">Shipped</option>
			       <option value="Cancel">Cancel</option>
			    </select>                           
                       </div>
		       <div class="col-md-4">
                            <label style="min-height:39px;"></label>
                            <button class="btn purple" data-ng-click="doSearch();">Search</button>
			    <button class="btn green" data-ng-click="clearAll();">Clear Search</button>
                       </div>
                     </div>
	     </div>
	  </div>
	</div>
</div>
<div class="row">
<div class="col-md-12">
	<!-- BEGIN EXAMPLE TABLE PORTLET-->
	<div class="portlet box grey-cascade">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-globe"></i>Order Listing
			</div>
			
			<div class="actions btn-set">
				<div class="btn-group">
					<a class="btn btn-default btn-circle" data-toggle="dropdown" data-ng-click="goToOrder()" ><i class="fa fa-plus"></i>&nbsp;&nbsp;Create Order</a>
				</div>
			</div>
		</div>
		
		<div class="portlet-body">
			<table class="table sortableTable table-striped table-bordered table-hover" id="sample_1">
			<thead>
			<tr>
				<th class="sortable" ng-click="sortType = 'id'; sortReverse = !sortReverse">					
					Order #
					<span ng-show="sortType == 'id' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'id' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th class="sortable" ng-click="sortType = 'added_date'; sortReverse = !sortReverse">
					Date
					<span ng-show="sortType == 'added_date' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'added_date' && sortReverse" class="fa fa-caret-up"></span>
				</th>
<!--				<th class="sortable" ng-click="sortType = 'wholesaler_customer_id'; sortReverse = !sortReverse">
					Wholesaler No
					<span ng-show="sortType == 'wholesaler_customer_id' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'wholesaler_customer_id' && sortReverse" class="fa fa-caret-up"></span>
				</th>
-->				<th class="sortable" ng-click="sortType = 'wholesaler_name'; sortReverse = !sortReverse">
					Wholesaler Name
					<span ng-show="sortType == 'wholesaler_name' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'wholesaler_name' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th class="sortable" ng-click="sortType = 'total_price'; sortReverse = !sortReverse">
					Pieces
					<span ng-show="sortType == 'total_item' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'total_item' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th class="sortable" ng-click="sortType = 'total_price'; sortReverse = !sortReverse">
					Order Total
					<span ng-show="sortType == 'total_price' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'total_price' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th class="sortable" ng-click="sortType = 'payment_status'; sortReverse = !sortReverse">
					Payment Status
					<span ng-show="sortType == 'payment_status' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'payment_status' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th class="sortable" ng-click="sortType = 'shipping_status'; sortReverse = !sortReverse">
					Order Status
					<span ng-show="sortType == 'shipping_status' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'shipping_status' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th>Action</th>
			</tr>
			</thead>
			
			<tbody>
			<tr class="odd gradeX" data-ng-repeat="o in orderList | orderBy:customSorting:sortReverse">
				<td>MX-{{o.order_id}}</td>
				<td>{{o.added_date}}</td>
				
				<td>{{o.wholesaler_name}}</td>
				<td>{{o.item_count}}</td>
				<td>${{o.total_price | number:2}}</td>
				<td>
					{{o.payment_status=='Success' ? 'Paid' : o.payment_status}}
					
				</td>
				<td>{{o.shipping_status}}</td>
				<td>
					<a href="#/order/view/{{o.id}}" title="View Order">View</a>
					|
					<a href="javascript:;" title="Delete Order" data-ng-click="deleteOrder(o.id);">Delete</a>
					|
					<a href="javascript:void(0)" data-ng-click="goToReorder(o.id)" title="View Order">Reorder</a>
					
				</td>
			</tr>
			
			
			<tr class="{{orderList==false?'ng-show':'ng-hide'}}">
					<td colspan="8" align="center">No Record found</td>
			</tr>
			<tr ng-class="(orderList.length > 0)?'ng-show':'ng-hide'">
					<td colspan="2" style="text-align: right"><strong>Total Item Count</strong></td>
					<td colspan="2"><strong>{{total_item_count }}</strong></td>
					<td colspan="2" style="text-align: right"><strong>Total Orders</strong></td>
					<td colspan="2"><strong>${{total_orders }}</strong></td>
			</tr>
			
			</tbody>
			<tfoot>
					<tr>
					<td colspan="8">
										
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