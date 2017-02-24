
MaxpinsApp.controller('productController', function( $scope, $http, $location, $timeout,$interval,$sce,FileUploader) {
    
    /* check admin id */
    $scope.product_name_sku        = '';
    $scope.tmp_product_type     = '';
    $scope.search_status           = '';
    $scope.hasError = function(field, validation){
        if(validation){
          return ($scope.frmaddproduct[field].$dirty && $scope.frmaddproduct[field].$error[validation]) || ($scope.submitted && $scope.frmaddproduct[field].$error[validation]);
        }
        return ($scope.frmaddproduct[field].$dirty && $scope.frmaddproduct[field].$invalid) || ($scope.submitted && $scope.frmaddproduct[field].$invalid);
      };
      
     

      $http({
      url:'./home/get_session_values',
      method:'post',
           
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      }).success( function(res){
          
          if(res.admin_id == 0 || res.admin_id == '')
          {
              $location.path('/login');
          }else{
               if (res.SEARCH_PRODUCT_SKU != undefined) {
                    $scope.product_name_sku = res.SEARCH_PRODUCT_SKU;
                    
               }
               if (res.SEARCH_PRODUCT_TYPE != undefined ) {
                    $scope.tmp_product_type = res.SEARCH_PRODUCT_TYPE;
                    
               }
             
               
          }
      });

      /* check admin id */
      
    $scope.back = function() {
        $location.path('/products');
    }
    
    $scope.sortType               = 'product_name'; 
    $scope.sortReverse            = false;  
    $scope.customSorting = function() {
            document.getElementById('product_order_field').value = $scope.sortType;
            document.getElementById('product_order_type').value = $scope.sortReverse;
      
            var order_field = document.getElementById('product_order_field').value;
            var order_type = document.getElementById('product_order_type').value;
            
            $http({
                   url:'./products/setOrder',
                  method:'post',
                  headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                  data:"order_field="+order_field+"&order_type="+order_type
                  }).success(function(){
                    $http({
                    url:'./products/listing',
                    method:'post',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data:"start=0&order_field="+order_field+"&order_type="+order_type
                    }).success( function(res){                       
                          $scope.productlist = res.data;
                          $scope.pagiLink = res.pagination_links;
                    });
                 });
             
     }
    
    $scope.deleteProduct =function(pId){
        var order_field = document.getElementById('product_order_field').value;
        var order_type = document.getElementById('product_order_type').value;
        var c= confirm('are you sure ?');
        if (c==true) {
            $http({
            url:'./products/delete',
            method:'post',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data:"pId="+pId
            }).success( function(res){
                alert('Record is deleted');
                $http({
                    url:'./products/listing',
                    method:'post',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data:"start=0&order_field="+order_field+"&order_type="+order_type
                    }).success( function(res){
                          $scope.productlist = res.data;
                          $scope.pagiLink = res.pagination_links;
                    });
                
                $location.path('/products');
            });     
        }
       
    }
    
    $scope.viewReceivedProduct = function(element){
        $(".receiveProductBox").hide();
      $(".product_rec_"+element).toggle();
    };
    $scope.addReceiveProduct = function(productId){
      var qty = $(".product_rec_qty_"+productId).val();
      $(".product_rec_qty_"+productId).addClass('spinner');
      if (Number(qty)>0) {
        $http({
            url:'./products/addProductQty',
            method:'post',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data:"pId="+productId+"&qty="+qty,
            }).success( function(res){
           
              $(".product_inventory_qty_"+productId).text( res.inventory_qty );
              $(".product_manufactured_qty_"+productId).text( res.manufactured_qty );
              $(".product_rec_"+productId).hide();
              $(".product_rec_qty_"+productId).val('');
              $(".product_rec_qty_"+productId).removeClass('spinner');
        });     
      }else{
        alert('Quantity must be grater than 0');
        $(".product_rec_qty_"+productId).val('');
        $(".product_rec_qty_"+productId).removeClass('spinner');
      }
    };
    
    $scope.toTimestamp = function() {
      return new Date().getTime();
    };
  
  
    var wholesalerMode = $location.$$path.replace('/products', '');   
    $scope.productlist  = {};$scope.pagiLink ='';
    if(wholesalerMode == '')
    {
       var order_field = document.getElementById('product_order_field').value;
       var order_type = document.getElementById('product_order_type').value;
        $http({
          url:'./products/product_type_list',
          method:'post',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data:"start=0"
          }).success( function(res){
                $scope.productTypeList = res.productType;
                $scope.selectedType = res.selectedtype;
                $scope.productCategoryList =  res.productCategory;
                $scope.selectedCategory =  res.selectedcategory;
               
                
          });
        
        $http({
                 url:'./products/listing',
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 data:"start=0&order_field="+order_field+"&order_type="+order_type
                 }).success( function(res){
            $scope.productlist  = {};$scope.pagiLink ='';
                       $scope.productlist = res.data;
                       $scope.pagiLink = res.pagination_links;
                       
                 });
        
    }
    else
    {
        var explodedWSMode = wholesalerMode.split("/");
        
        
        if(explodedWSMode[1] == 'edit')
        {
            $http({
                 url:'./products/get_details/' + explodedWSMode[2],
                 method:'post',
                 
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 }).success( function(res){
                        if (res.code == 1) {
                            res = res.data;
                            $scope.product_id               = res.product_id;
                            $scope.product_sku              = res.product_sku;
                            $scope.product_name             = res.product_name;
                            $scope.product_description      = res.product_description ;
                            $scope.product_item_count       = res.item_count;
                            $scope.product_manufactured_qty = res.manufactured_qty;
                            $scope.product_inventory_qty    = res.inventory_qty;
                            $scope.product_reorder_qty      = res.auto_reorder_qty;
                            $scope.product_price            = res.price;
                            $scope.is_featured              = res.is_featured;
                            $scope.auto_reorder             = res.auto_reorder;
                            $scope.product_status           = res.product_status;
                            $scope.selected_category        = res.category_id;
                            $scope.selected_retailer        = res.retailer_id;
                            
                            $scope.category = res.category;
                            $scope.wholesalers = res.wholesalers;
                            $scope.any_retailer_status = res.any_retailer;
                            $scope.any_retailer = res.any_retailer;
                            $scope.selected_product_type      = res.product_type;
                            $scope.product_type               = res.product_type;
                            $scope.product_type_list          = res.product_type_list;
                            
                            $scope.getRetailer = function(type){
                                //alert(type);
                                switch (type) {
                                    case "Yes":
                                        $scope.any_retailer_status = 'yes';
                                        angular.element('input[value=Yes]').prop('checked',true)
                                        break;
                                    case "No":
                                        $scope.any_retailer_status = '';
                                        angular.element('input[value=No]').prop('checked',true)
                                        break;
                                }
                            };
                            $scope.getRetailer(res.any_retailer);
                            
                        }else{
                               alert('Record not found');
                               $location.path('/products');
                        }
                 });
            
            $scope.productUpdate = function($event){
                  $scope.submitted= true;
                  if ($scope.frmaddproduct.$invalid) {
                      $event.preventDefault();  
                  }else{
                        var dataObj  = angular.element('#formaddproduct').serialize();
                         $http({
                                 url:'./products/edit_product_action',
                                 method:'post',
                                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                                 data:dataObj
                                    }).success( function(res){
                                          if (res.code ==  1)
                                          {
                                                alert(res.msg);
                                                $location.path('/products');
                                          }
                                          else
                                          {
                                                alert(res.msg);      
                                          }
                                });
                  }
            }
        }
        
        else if(explodedWSMode[1] == 'add')
        {
            $http({
                    url:'./products/get_new_product_data',
                }).success( function(res){
                            $scope.product_sku         = res.new_sku_code;
                            $scope.category            = res.category;
                            $scope.wholesalers         = res.wholesalers;
                            $scope.product_type_list   = res.product_type_list;
                            //angular.element('.yes_r_status').trigger('click');
                            $scope.getRetailer = function(type){
                                switch (type) {
                                    case "Yes":
                                        $scope.any_retailer_status = 'yes';
                                        angular.element('input[value=Yes]').prop('checked',true)
                                        break;
                                    case "No":
                                        $scope.any_retailer_status = '';
                                        angular.element('input[value=No]').prop('checked',true)
                                        break;
                                }
                            };
                            $scope.getRetailer('Yes');
                   });
            
            
            $scope.productAdd = function($event){
                  $scope.submitted= true;
                  if ($scope.frmaddproduct.$invalid) {
                      $event.preventDefault();  
                  }else{
                        var dataObj  = angular.element('#formaddproduct').serialize();
                        $http({
                             url:'./products/add_product_action',
                             method:'post',
                             headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                             data:dataObj
                                }).success( function(res){
                                      if (res.code ==  1)
                                      {
                                            alert(res.msg);
                                            $location.path('/products');
                                      }
                                      else
                                      {
                                            alert(res.msg);      
                                      }
                            });
                  }
                
            }
        }
        else if (explodedWSMode[1]=='listing') {
          $http({
          url:'./products/product_type_list',
          method:'post',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data:"start=0"
          }).success( function(res){
               $scope.productTypeList = res.productType;
               $scope.selectedType = res.selectedtype;
                 $scope.productCategoryList =  res.productCategory;
                $scope.selectedCategory =  res.selectedcategory;
               
          });
            var order_field = document.getElementById('product_order_field').value;
            var order_type = document.getElementById('product_order_type').value;
             var page  = explodedWSMode[2];
             $http({
                 url:'./products/listing/'+page,
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 data:"order_field="+order_field+"&order_type="+order_type
                 }).success( function(res){
                
                       $scope.productlist = res.data;
                       $scope.pagiLink = res.pagination_links;
                       
                       
                 });
        }
        
        
        if(explodedWSMode[1] == 'images')
        {
           
            var pId = explodedWSMode[2];
            var uploader = $scope.uploader = new FileUploader({
                
                    url:'./products/uploadImage/' + explodedWSMode[2],
                   // queueLimit:4
            });
            
              $http({
                 url:"./products/get_product_images",
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 data:"pId="+pId
                }).success(function(res){
                    $scope.images = res;
                    var total_images = res.length;
                    uploadImage(uploader,total_images,$location);
                });
              
              $scope.removeImage = function(imgId){
                var c = confirm('are you sure ?');
                if (c==true) {
                    $http({
                     url:"./products/remove_product_images",
                     method:'post',
                     headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                     data:"pId="+pId+"&imgId="+imgId
                    }).success(function(res){
                         alert('image is removed');
                         $scope.images = res;
                         var total_images = res.length;
                          
                         uploadImage(uploader,total_images,$location);
                             
                    });
                }
                    
              }
                
        }
        
        
    }
    
          $scope.product_name_sku = '';$scope.search_product_type='';
          $scope.searchProduct = function() {
          
          var order_field = document.getElementById('product_order_field').value;
          var order_type = document.getElementById('product_order_type').value;
          $http({
               url:'./products/setSearchData',
               method:'post',
               headers: {'Content-Type': 'application/x-www-form-urlencoded'},
               data:"product_name_sku="+$scope.product_name_sku
                    +"&product_type="+$scope.search_product_type
                    +"&search_product_category="+$scope.search_product_category
                    +"&order_field="+order_field
                    +"&order_type="+order_type
           
               }).success( function(res){
                    $http({
                         url:'./products/listing',
                         method:'post',
                         headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                         data:"product_name_sku="+$scope.product_name_sku
                              +"&product_type="+$scope.search_product_type
                              +"&order_field="+order_field
                              +"&order_type="+order_type
                     
                         }).success( function(res){
                             $scope.productlist = res.data;
                             $scope.pagiLink = res.pagination_links;
                         });
               });
          
        
    }
    
    $scope.clearAll = function(){
        $scope.product_name_sku = '';
        $scope.search_product_type = '';
         $http({
               url:'./products/clearSearch',
               method:'post',
               headers: {'Content-Type': 'application/x-www-form-urlencoded'},
               }).success( function(res){
                  $scope.searchProduct();
               });
        
        
    }
    
    
});
function uploadImage(uploader,limit,$location){
    uploader.queueLimit = 4-limit;
    uploader.filters.push({
            
            name: 'imageFilter',
            fn: function(item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        });
        
        uploader.onCompleteAll = function() {
            alert('Images are uploaded successfully');
            $location.path('/products');
        };
  
    
}
MaxpinsApp.directive("checkboxGroupCategory", function() {
        return {
            restrict: "A",
            link: function(scope, elem, attrs) {
                // Determine initial checked boxes
                if (scope.selected_category.indexOf(scope.c.category_id) !== -1) {
                    elem[0].checked = true;
                }
                
               
                // Update array on click
            }
        }
    });

MaxpinsApp.directive("checkboxGroupRetailer", function() {
        return {
            restrict: "A",
            link: function(scope, elem, attrs) {
                // Determine initial checked boxes
                if (scope.selected_retailer.indexOf(scope.w.wholesaler_id) !== -1) {
                    elem[0].checked = true;
                }
                
               
                // Update array on click
            }
        }
    });

