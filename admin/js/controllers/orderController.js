
MaxpinsApp.controller('orderController', function($rootScope, $scope, $http, $location, $timeout,$sce) {
    
    /* check admin id */
      $scope.wholesaler_name        = ''; $scope.search_wholesaler_name ='';
      $scope.start_date             = ''; $scope.search_start_date='';
      $scope.end_date               = ''; $scope.search_end_date = '';
      $scope.payment_status         = ''; $scope.search_payment_status ='';
      $scope.shipment_status        = ''; $scope.search_shipment_status ='';
      $scope.sortType               = 'id'; 
      $scope.sortReverse            = true;
      $scope.shipment_status        = 'New';
      $scope.getSessionStatus       = '';
      //$scope.folder                 = 'maxpins/';
      $scope.folder                 = '';
      $scope.today = function() {
       //$scope.start_date = new Date();
      };
      $scope.today();

      $scope.clear = function () {
      $scope.start_date = null;
      $scope.end_date = null;
      };
      
      $scope.customSorting = function(item) {
      if(isNaN(item[$scope.sortType]))
       return item[$scope.sortType];
      return parseInt(item[$scope.sortType]);
     }
     
     $scope.goToOrder = function(){
        $http({
                 url:'./order/setAdminOrder',
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 }).success( function(res){
            var folder =$scope.folder;
            //var folder = '';
            var url = "http://"+document.location.host+"/"+folder+"#/products";
             window.location.href =url; 
            });
     }
     $scope.goToReorder = function(order_id){
       $http({
                 url:'./order/setAdminOrder',
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 data: "reorder_order_id="+order_id
                 }).success( function(res){
            var folder =$scope.folder;
            //var folder = '';
            var url = "http://"+document.location.host+"/"+folder+"#/setreorder";
             window.location.href =url; 
            });
     }
     

      // Disable weekend selection
      $scope.disabled = function(date, mode) {
      return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
      };

      $scope.toggleMin = function() {
      $scope.minDate = $scope.minDate ? null : new Date();
      };
      $scope.toggleMin();

      $scope.openStartDatePicker = function($event) {
      $event.preventDefault();
      $event.stopPropagation();

      $scope.openedStartDatePicker = true;
      };
      $scope.openEndDatePicker = function($event) {
      $event.preventDefault();
      $event.stopPropagation();

      $scope.openedEndDatePicker = true;
      };

      $scope.dateOptions = {
      formatYear: 'yy',
      startingDay: 0
      };

      $scope.formats = ['MM-dd-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
      $scope.format = $scope.formats[0];
      
      $scope.getDatePickerValue = function(){
            var start_date =$scope.start_date;
            var dd            = parseInt(start_date.getMonth())+1;
            start_date        = start_date.getDate() + "-" + dd + "-" + start_date.getFullYear();
            $(".search_start_date").attr('data-date',start_date);
      }
      $scope.getEndDatePickerValue =function(){
            var end_date    =$scope.end_date;
            var dd            = parseInt(end_date.getMonth())+1;
            end_date        = end_date.getDate() + "-" + dd + "-" + end_date.getFullYear();
            $(".search_end_date").attr('data-date',end_date); 
      }
      
      $http({
      url:'./home/get_session_values',
      method:'post',
           
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      }).success( function(res){
          if(res.admin_id == 0 || res.admin_id == '')
          {
              $location.path('/login');
          }
          else{
               if (res.SEARCH_ORDER_WHOLESALER_ID != undefined) {
                    $scope.search_wholesaler_name = res.SEARCH_ORDER_WHOLESALER_ID;
                     $scope.wholesaler_name = res.SEARCH_ORDER_WHOLESALER_ID;
               }
               if (res.SEARCH_ORDER_START_DATE != undefined ) {
                    $scope.start_date = res.SEARCH_ORDER_START_DATE;
                    
                   var start_date        = res.SEARCH_ORDER_TMP_START_DATE;
                    $(".search_start_date").attr('data-date',start_date);
               }
               if (res.SEARCH_ORDER_END_DATE != undefined ) {
                    $scope.end_date = res.SEARCH_ORDER_END_DATE;
                    
                    var end_date        = res.SEARCH_ORDER_TMP_END_DATE;
                    $(".search_end_date").attr('data-date',end_date);
               }
               if (res.SEARCH_ORDER_PAYMENT_STATUS != undefined ) {
                    $scope.search_payment_status      = res.SEARCH_ORDER_PAYMENT_STATUS;
                    $scope.payment_status             = res.SEARCH_ORDER_PAYMENT_STATUS;
               }
               if (res.SEARCH_ORDER_SHIPMENT_STATUS != undefined ) {
                    $scope.search_shipment_status     = res.SEARCH_ORDER_SHIPMENT_STATUS;
                    $scope.shipment_status            = res.SEARCH_ORDER_SHIPMENT_STATUS; 
               }
               
               $scope.getSessionStatus ='1';
               
          }
      });

      /* check admin id */
    
    $scope.back = function(){
      $location.path('/order');
    }
    
    $scope.clearAll = function(){
      
      $scope.search_wholesaler_name = '';
      $scope.wholesaler_name = '';
      $scope.start_date = '';
      $(".search_start_date").attr('data-date','');
      $scope.end_date = '';
      $(".search_end_date").attr('data-date','');
      $scope.search_payment_status = '';
      $scope.payment_status = '';
      $scope.search_shipment_status ='';
      $scope.shipment_status = ''; 
      
         $http({
               url:'./order/clearSearch',
               method:'post',
               headers: {'Content-Type': 'application/x-www-form-urlencoded'},
               }).success( function(res){
                  $scope.doSearch();
               });
        
        
    }
    
    $scope.doSearch = function(){
      var start_date  =$(".search_start_date").attr('data-date');
      var end_date  =$(".search_end_date").attr('data-date');
      
      
      $http({
               url:'./order/setSearchData',
               method:'post',
               headers: {'Content-Type': 'application/x-www-form-urlencoded'},
               data:"wholesaler_name="+encodeURIComponent($scope.wholesaler_name)
                    +"&start_date="+encodeURIComponent(start_date)
                    +"&end_date="+encodeURIComponent(end_date)
                    +"&payment_status="+encodeURIComponent($scope.payment_status)
                    +"&shipment_status="+encodeURIComponent($scope.shipment_status)
           
               }).success( function(res){
                              $scope.total_orders = '';
                              var total = 0;
                              var dataString = 'start=0&wholesaler_name=' + encodeURIComponent($scope.wholesaler_name) + '&start_date=' + encodeURIComponent(start_date) + '&end_date=' + encodeURIComponent(end_date) + '&payment_status=' + encodeURIComponent($scope.payment_status) + '&shipment_status=' + encodeURIComponent($scope.shipment_status);
                              $http({
                                         url:'./order/listing',
                                         method:'post',
                                         headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                                         data:dataString
                                         }).success( function(res){
                                               $scope.orderList = res.data;
                                               
                                               for(var i = 0; i < $scope.orderList.length; i++)
                                               {
                                                var order = $scope.orderList[i]; 
                                                total = parseFloat(total) + parseFloat(order.total_price);
                                               }
                                               $scope.total_orders = res.total_orders;
                                               $scope.total_item_count = res.total_item_count;
                                               //$scope.total_orders = res.total_orders;
                                               $scope.pagiLink = res.pagination_links;
                                         });
            });
    }
    
    // DELETE ORDERS
     $scope.deleteOrder = function(oid){
      var dataString = 'oid=' + encodeURIComponent(oid); 
      var c= confirm('are you sure ?');
      if (c==true) {
            $http({
            url:'./order/delete_order/',
            method:'post',
            data:dataString,    
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            }).success( function(res){
                $scope.doSearch();
            });
      }
     }
    
    $scope.content_warning_msg = "Please don't delete anything within {{ }} and curly brackets";
      
    var orderMode = $location.$$path.replace('/order', '');
    
    if(orderMode == '')
    {
      
      var total = 0;
        $http({
                 url:'./order/wholesaler_list',
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 data:"start=0"
                 }).success( function(res){
                       $scope.wholesalerList = res.data;
                 });
        
       var c= setInterval(function(){
            if ($scope.getSessionStatus=='1') {
                  
                  $scope.doSearch();
                  clearInterval(c);
            }
            },5);
        
        
        
        //$http({
        //         url:'./order/listing',
        //         method:'post',
        //         headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        //         data:"start=0&shipment_status=New"
        //         }).success( function(res){
        //               $scope.orderList = res.data;
        //               for(var i = 0; i < $scope.orderList.length; i++)
        //               {
        //                var order = $scope.orderList[i]; 
        //                total = parseFloat(total) + parseFloat(order.total_price);
        //               }
        //               $scope.total_orders = res.total_orders;
        //               $scope.total_item_count = res.total_item_count;
        //               //$scope.total_orders = res.total_orders;
        //               $scope.pagiLink = res.pagination_links;
        //         });
        
    }
    else
    {
        var explodedOrderMode = orderMode.split("/");
        
        
        if(explodedOrderMode[1] == 'view')
        {
            $http({
                 url:'./order/get_details/' + explodedOrderMode[2],
                 method:'post',
                 
                 headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                 }).success( function(res){ 
                        if (res.code == 1)
                        {
                              record                   = res.data;
                              //console.log(record);
                              $scope.order_id          = 'MX - '+record.id;
                              $scope.transaction_id    = record.transaction_id;
                              
                              $scope.wholesaler_name        = record.wholesaler_name;
                              $scope.wholesaler_customer_id = record.wholesaler_customer_id;
                              $scope.wholesaler_email       = record.wholesaler_email;
                              $scope.wholesaler_phone       = record.wholesaler_phone;
                              
                              $scope.billing_info      = record.wholesaler_billing_address+'<br/> '+record.wholesaler_billing_city+', '+record.wholesaler_billing_state+" "+record.wholesaler_billing_zip+'<br/> '+record.billing_country_name;
                              console.log( $scope.billing_info);
                              $scope.shipping_info      = record.wholesaler_shipping_address+'<br/> '+record.wholesaler_shipping_city+', '+record.wholesaler_shipping_state+" "+record.wholesaler_shipping_zip+'<br/>'+record.shipping_country_name;
                              
                              $scope.total_amount           = record.total_price;
                              $scope.payment_status         = record.payment_status;
                              $scope.shipping_status        = record.shipping_status;
                              $scope.shipping_method        = record.shipping_method;
                              $scope.shipping_cost          = record.shipping_cost;
                              $scope.added_on               = record.added_on;                              
                              $scope.discount               = record.discount;
                                
                              details                       = res.order_details;
                              $scope.orderDetailsList       = details; //alert(details.product_name);
                              $scope.total_qty              = res.total_qty;
                              $scope.hidden_order_id        = record.id;
                              $scope.sub_total              = record.sub_total;
                              $scope.sub_shipp_total        = Number(record.sub_total) + Number(record.shipping_cost);
                              $scope.shipping_cost          = record.shipping_cost;
                              
                              $scope.shipping_status_values = [{
                                          name: "New",
                                          }, {
                                                name: "Ordered",
                                          }, {
                                                name: "Shipped",
                                          }, {
                                                name: "Cancel",
                              }];                                                 
                        }
                        else
                        {
                              alert('Record not found');
                              $location.path('/order');
                        }
                 });
        }
        
        else if(explodedOrderMode[1] == 'add')
        {
            $scope.no_paypal        = 1;
            $scope.paypal_form      = 0;
            $http({
                 url:'./order/get_add_details/',
                 method:'post',
                 
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 }).success( function(res){
                        $scope.wholesalerList   = res[0];
                        $scope.productList      = res[1];
                        $scope.shippingList     = res[2];
                        
                        $scope.paymentList      = [{
                                                            name: "PAID",
                                                            value: "Success",
                                                            }, {
                                                                  name: "Net 30",
                                                                  value: "Net 30",
                                                            }, {
                                                                  name: "Paypal",
                                                                  value: "Paypal",
                                                            }];
                        
                        $scope.payment_status_value = 'Succeess';
                });
            
            $scope.getShippingMethod = function (){
                  var wholesaler_id = $scope.wholesaler_name;
                  $http({
                     url:'./order/get_user_shipping_method',
                     method:'post',
                     headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                     data:"wholesaler_id="+wholesaler_id
                        }).success( function(res){ 
                            $scope.shipping_method          = res.shipping_method_id;
                            $scope.sm_id                    = res.shipping_method_id;
                            $scope.shipping_method_name     = res.method_name;  
                    });
            }
            
            $scope.orderAdd = function(){ 
                var dataObj  = angular.element('#formAddOrder').serialize();
                var err =0;
                var errStr = '';
                var errAlert= false;
                //alert($scope.wholesaler_name);
               if($scope.wholesaler_name == undefined  || $scope.wholesaler_name ==''){
                  errStr +="please select any wholesaler name \n";
                  errAlert = true;
               }
               if($scope.shipping_method == undefined || $scope.shipping_method ==''){
                  errStr +="please select any shipping method \n";
                  errAlert = true;
               }
               if($scope.payment_status == undefined || $scope.payment_status ==''){
                  errStr +="please select any payment status \n";
                  errAlert = true;
               }
                angular.forEach(document.getElementsByClassName("chkItem"), function(value,key){
                   if (value.checked==true) {
                        err +=1;
                   }
                });
                if (err == 0) {
                  errStr +='please select atleast one product \n';
                  errAlert = true;
                }
                if (errAlert == true) {
                  alert(errStr);return false;
                }
              
                if($scope.payment_status != 'Paypal')
                {
                  //console.log(dataObj);return false;
                  $http({
                       url:'./order/do_add_order',
                       method:'post',
                       headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                       data:dataObj
                          }).success( function(res){
                                if (res.code ==  1)
                                {
                                      alert('Order has been successfully made');
                                      $location.path('/order/view/'+res.order_master_id);
                                }
                      });
                }
                else
                {
                  $http({
                       url:'./order/paymentprocess',
                       method:'post',
                       headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                       data:dataObj
                          }).success( function(res){
                              angular.element('#paypal_form').html(res);
                                $scope.no_paypal = 0;
                                $scope.paypal_form = 1;
                                //$scope.paypal_display_form = res.;
                      });
                  //$location.path('/order/paymentprocess');
                }
            }
        }
        
        else if (explodedOrderMode[1]=='listing') {
             var page   = explodedOrderMode[2];
             var total  = 0;
             $http({
                 url:'./order/listing/'+page,
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                 }).success( function(res){
                       $scope.orderList = res.data; 
                       for(var i = 0; i < $scope.orderList.length; i++)
                       {
                        var order = $scope.orderList[i];
                        total = parseFloat(total) + parseFloat(order.total_price);
                       }
                       $scope.total_orders = res.total_orders;
                       $scope.total_item_count = res.total_item_count;
                       //$scope.total_orders = res.total_orders;
                       $scope.pagiLink = res.pagination_links;
                       
                 });
        }        
        
   }
   $scope.updatePayStatus = function(){
      $http({
            url:'./order/update_pay_status',
            method:'post',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data:"order_id="+$scope.hidden_order_id+"&pay_status="+$scope.pay_status
            
            }).success( function(res){ 
                        if ($scope.pay_status == 'Success') {
                              $scope.payment_status = 'Paid';      
                        }
                        else{
                              $scope.payment_status = $scope.pay_status;
                        }
                        
                        $scope.cp_view = 0;
                  
                  
                 
      });   
   }
   
   $scope.changePayStatus = function(){ 
      $scope.cp_view = 1;     
   }
    
   $scope.cancelPayStatus = function(){
      $scope.cp_view = 0;     
   }
   
   
    
   $scope.changeShippingStatus = function(){ 
      $scope.dd_view = 1;     
   }
    
   $scope.cancelShippingStatus = function(){
      $scope.dd_view = 0;     
   }
   
   $scope.updateShippingStatus = function() {
      $http({
            url:'./order/update_shipment_status',
            method:'post',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data:"order_id="+$scope.hidden_order_id+"&shipping_status="+$scope.shipping
            
            }).success( function(res){ 
                  if (res > 0)
                  {
                        alert('Record successfully updated');
                        $scope.shipping_status = $scope.shipping;
                  }
                  else
                  {
                        alert('Unable to update');      
                  }
                  $scope.dd_view = 0;
      });   
   }
   
   
   
  
   $scope.ordTotal = 0;
      
   // toggle selection for a given employee by name
   $scope.calculateOrdTotal = function calculateOrdTotal() {
    
      var subTotal      = 0;
      var orderTotal    = 0;
      
      angular.forEach(angular.element($(".chkItem:checked")), function(value,key) {
           
           var pID      = angular.element(value).attr('data-element-id');
           var price    = angular.element(value).attr('data-element-price');
           
           var quantity      = angular.element(document.getElementById('qty_'+pID)).val();
           subTotal          = parseFloat(subTotal) + (Number(quantity) * parseFloat(price));
      });
      
      $scope.ordTotal         = parseFloat(subTotal);
   };
   
});