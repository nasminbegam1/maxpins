<div class="row">
	<div class="col-md-12">
          <div class="portlet light">
             <div class="portlet-title">
                <div class="caption">
                     <i class="fa fa-cogs"></i>Product Search
                </div>
             </div>
	     <form class="form-horizontal form-bordered ng-pristine ng-valid" id="formProfile" name="frmSP" novalidate >
	     <div class="portlet-body">                 
                     <div class="form-group col-md-12">                       
                       <div class="col-md-3">
                            <label>Product Name/SKU</label>
                            <input type="text" name="product_name_sku" class="form-control" data-ng-model="product_name_sku"   />
			    <span style="color:red" ng-show="frmSP.product_name_sku.$dirty && frmSP.product_name_sku.$invalid">
<span ng-show="frmSP.product_name_sku.$error.required">Wholesaler name/SKU is required.</span>  
                       </div>
			<div class="col-md-3">
                            <label>Product Type</label>
			    <select name="search_product_type" data-ng-model="search_product_type" class="form-control" >
				<option value="">Select any Product type</option>
				<option  ng-repeat="p_type in productTypeList" value="{{p_type.id}}" ng-selected="{{p_type.id == selectedType}}" >
						  {{p_type.type_name}}
						</option>
			    </select>

                       </div>
			<div class="col-md-3">
                            <label>Product Category</label>
			    <select name="search_product_category" data-ng-model="search_product_category" class="form-control" >
				<option value="">Select any Product Category</option>
				<option  ng-repeat="c_type in productCategoryList" value="{{c_type.category_id}}" ng-selected="{{c_type.category_id== selectedCategory}}" >
						  {{c_type.category_name}}
						</option>
			    </select>

                       </div>

		      
		       <div class="col-md-3">
			<label>&nbsp;</label><br class="clear">
                            <button class="btn purple"  data-ng-click="searchProduct();">Search</button>
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
				<i class="fa fa-globe"></i>Product Lists
			</div>
			<div class="actions btn-set">
				<div class="btn-group">
					<a class="btn btn-default btn-circle" data-toggle="dropdown" href="#/products/add"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a>
				</div>
			</div>
		</div>
		
		<div class="portlet-body">
			<table class="table table-striped table-bordered table-hover" id="sample_1">
			<thead>
			<tr>
				<th>Image</th>
				<th class="sortable" ng-click="sortType = 'product_name'; sortReverse = !sortReverse;customSorting();">
					Product Name
					<span ng-show="sortType == 'product_name' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'product_name' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th class="sortable" ng-click="sortType = 'product_sku'; sortReverse = !sortReverse;customSorting();">
					SKU
					<span ng-show="sortType == 'product_sku' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'product_sku' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th class="sortable" ng-click="sortType = 'product_type'; sortReverse = !sortReverse;customSorting();">
					Type
					<span ng-show="sortType == 'product_type' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'product_type' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th class="sortable" ng-click="sortType = 'product_category'; sortReverse = !sortReverse;customSorting();">
					Category
					<span ng-show="sortType == 'product_category' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'product_category' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th class="sortable" ng-click="sortType = 'inventory_qty'; sortReverse = !sortReverse;customSorting();">
					Inv. Qty
					<span ng-show="sortType == 'inventory_qty' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'inventory_qty' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th class="sortable" ng-click="sortType = 'manufactured_qty'; sortReverse = !sortReverse;customSorting();">
					Man. Qty
					<span ng-show="sortType == 'manufactured_qty' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'manufactured_qty' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th class="sortable" ng-click="sortType = 'price'; sortReverse = !sortReverse;customSorting();">
					Price
					<span ng-show="sortType == 'price' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'price' && sortReverse" class="fa fa-caret-up"></span>
				</th>				
				<th class="sortable" ng-click="sortType = 'product_status'; sortReverse = !sortReverse;customSorting();">
					Status
					<span ng-show="sortType == 'product_status' && !sortReverse" class="fa fa-caret-down"></span>
					<span ng-show="sortType == 'product_status' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th>Action</th>
			</tr>
			</thead>
			
			<tbody>
			<tr class="odd gradeX" data-ng-repeat="p in productlist">
				<td><img src="{{p.image_name}}" /></td>
				<td>{{p.product_name}}</td>
				<td>{{p.product_sku}}</td>
				<td>{{p.product_type}}</td>
				<td>{{p.category_name}}</td>
				<td class="product_inventory_qty_{{p.product_id}}">{{p.inventory_qty}}</td>
				<td class="product_manufactured_qty_{{p.product_id}}">{{p.manufactured_qty}}</td>
				<td>{{p.price}}</td>
				<td>{{p.product_status}}</td>
				<td width="230">
					<a href="#/products/edit/{{p.product_id}}">Edit</a>
					|
					<a href="#/products/images/{{p.product_id}}">Images</a>
					|
					<a href="javascript:void(0)" ng-click="deleteProduct(p.product_id)">Delete</a>
					|
					<a href="javascript:void(0)" ng-click="viewReceivedProduct(p.product_id)">Received</a>
					<div class="receiveProductBox product_rec_{{p.product_id}}" style="display: none" >
						<div class="" style="float: left;width:74%">
						<input type="text" class="productQty  form-control product_rec_qty_{{p.product_id}}" />
						</div>
						<div class="" style="float: left">
						<input type="button" class="btn btn-success" value="Ok" ng-click="addReceiveProduct(p.product_id)"  />
						</div>
					</div>
				</td>
			</tr>
			
			<tr class="{{productlist==false?'ng-show':'ng-hide'}}">
					<td colspan="8">No Record found</td>
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