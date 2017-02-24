

app.controller('homeController', function($rootScope, $scope, $location,$http,Global) {
  
   $scope.cmsContent ={};
     $http({
          url       :'./home/getCmsContent/home',
          method    :'post',
          headers   : {'Content-Type': 'application/x-www-form-urlencoded'},
                   
        }).success(function(res){
          $scope.cmsContent = res.data.cms_content;
          
        });
     
      $http({
          url       :'./home/getFeatureProductImage',
          method    :'post',
          headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                   
        }).success(function(res){
          $scope.productImage = res.data;
          $scope.productName = res.product_name;
        });
  
     $scope.searchProduct = function(){
        Global.setSearchKey($scope.keyword);
        $http({
              url       :'./product/addSearchkeyWord',
              method    :'post',
              headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
              data      : "keyword="+$scope.keyword
                        
            }).success(function(res){
            $location.path("/products/search/"+$scope.keyword);
        });
        
    }
  
});
app.controller('forgetPasswordController', function($rootScope, $scope, $location,$http,Global) {
    $scope.errmsg = "";Global.setLog('');
    $scope.submitFP =  function(){
    $http({
          url       :'./user/do_forget_password',
          method    :'post',
          headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
          data      : "email="+$scope.email
                    
        }).success(function(res){            
            if (res.code == 0) {
                $scope.errmsg = res.msg;
                $scope.succmsg = '';
            }
            else if (res.code == 1)
            {
                $scope.errmsg = '';
                $scope.succmsg = res.msg;
            }
        });
  }

});

app.controller('profileController', function($rootScope, $scope, $location,$http,Global) {
    
    $scope.errmsg = "";
    if (Global.log() == '') {
        $location.path('/login');    
    }
    
    $http({
        url:'./user/get_details/',
        method:'post',
    
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        }).success( function(res){ 

            if (res.code == 1)
            {
                rec = res.data;
                $scope.wholesaler_name      = rec.wholesaler_name;
                $scope.wholesaler_customer_id  = rec.wholesaler_customer_id;
                $scope.billing_address      = rec.wholesaler_billing_address;
                $scope.billing_city         = rec.wholesaler_billing_city;
                
                $scope.billing_country      = rec.wholesaler_billing_country;
                
                if ($scope.billing_country == 1)
                {
                  $scope.billing_state        = rec.wholesaler_billing_state;
                  $scope.billing_text_state   = '';
                }
                else
                {
                  $scope.billing_state        = '';
                  $scope.billing_text_state   = rec.wholesaler_billing_state;
                }
                
                $scope.billing_zip          = rec.wholesaler_billing_zip;
                $scope.shipping_address     = rec.wholesaler_shipping_address;
                $scope.shipping_city        = rec.wholesaler_shipping_city;
                $scope.shipping_state       = rec.wholesaler_shipping_state;
                $scope.shipping_country     = rec.wholesaler_shipping_country;
                
                if ($scope.shipping_country == 1)
                {
                  $scope.shipping_state      = rec.wholesaler_shipping_state;
                  $scope.shipping_text_state = '';
                }
                else
                {
                  $scope.shipping_state      = '';
                  $scope.shipping_text_state = rec.wholesaler_shipping_state;
                }
                
                $scope.shipping_zip         = rec.wholesaler_shipping_zip;
                $scope.wholesaler_email     = rec.wholesaler_email;
                $scope.wholesaler_phone     = rec.wholesaler_phone;
                $scope.wholesaler_contact   = rec.wholesaler_contact;
                $scope.shipping_method      = rec.shipping_method;
                $scope.wholesaler_note      = rec.wholesaler_note;
                
                $scope.countryList          = res['country'];
                $scope.shippingList         = res['shipping'];
                $scope.stateList            = res['state'];
                
            }
            else
            {
                alert('Record not found');
                $location.path('/');
            }
    });
    
    
    $scope.updateProfile =  function(){ 
      $http({
          url       :'./user/do_update_profile',
          method    :'post',
          headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
          data      :"wholesaler_name="+$scope.wholesaler_name+"&wholesaler_password="+$scope.wholesaler_password+"&wholesaler_customer_id="+$scope.wholesaler_customer_id+"&billing_address="+$scope.billing_address+"&billing_city="+$scope.billing_city+"&billing_state="+$scope.billing_state+"&billing_text_state="+$scope.billing_text_state+"&billing_country="+$scope.billing_country+"&shipping_address="+$scope.shipping_address+"&shipping_city="+$scope.shipping_city+"&shipping_state="+$scope.shipping_state+"&shipping_text_state="+$scope.shipping_text_state+"&shipping_country="+$scope.shipping_country+"&wholesaler_phone="+$scope.wholesaler_phone+"&wholesaler_email="+$scope.wholesaler_email+"&billing_zip="+$scope.billing_zip+"&shipping_zip="+$scope.shipping_zip+"&wholesaler_contact="+$scope.wholesaler_contact+"&wholesaler_customer_id="+$scope.wholesaler_customer_id+"&shipping_method="+$scope.shipping_method
                    
        }).success(function(res){ 
            $scope.succmsg = res.msg;
            if(Global.checkoutStatus()=='1'){
             $location.path('/checkout');
            }
            
        });
  }

});

app.controller('orderController', function($rootScope, $scope, $location,$http,Global) {
   if (Global.log() == '') {
      $location.path('/login');    
   }
  $http({
        url       :'./product/getCustomProducts',
        method    :'post',
        headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                   
      }).success(function(res){
          $scope.products = res;
      });
  
  
  $scope.setReorder = function(orderId){
      $http({
        url       :'./product/setreorderdata',
        method    :'post',
        headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
        data      : 'orderId='+orderId
      }).success(function(res){
         $location.path("/setreorder");
      });
  
  }
   
       $scope.addProductCart =function($event){
      angular.element($event.target.parentElement.parentElement.parentElement).find('.errstatus').hide();
      angular.element($event.target.parentElement.parentElement.parentElement).find('.succstatus').hide();
      var parentLi = $event.target.parentElement.parentElement.parentElement;
      
      var span = angular.element(parentLi.querySelectorAll('.checkPan'));
      span.addClass("ng-show");
      span.removeClass("ng-hide");
      //console.log(parentLi.querySelectorAll('.checkPan'));
      var proId = $event.target.getAttribute('data-element');
      var maxQty = $event.target.getAttribute('data-max-qty');
      if (maxQty!=0) {
        
            $http({
              url       :'./product/addToCart',
              method    :'post',
              headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
              data      : "proId="+proId+"&cartQty=1"
                        
            }).success(function(res){
              
               switch(res.code)
               {
                case 0:
                  $scope.msg = 'Unable to add to cart';
                     angular.element($event.target.parentElement.parentElement.parentElement).find('.errstatus').show();
                     angular.element($event.target.parentElement.parentElement.parentElement).find('.succstatus').hide();
                  break;
                case 1:
                  $scope.msg = 'Product is added into cart successfully. Do you want to <a href="#/products"><strong>continue</strong></a> or <a href="#/mycart"><strong>check out</strong></a> ?';
                  angular.element($event.target.parentElement.parentElement.parentElement).find('.succstatus').show();
                  angular.element($event.target.parentElement.parentElement.parentElement).find('.errstatus').hide();
                  break;
                case 2:
                  $scope.msg = 'Quantity is grater than the stoke';
                     angular.element($event.target.parentElement.parentElement.parentElement).find('.errstatus').show();
                     angular.element($event.target.parentElement.parentElement.parentElement).find('.succstatus').hide();
                  break;
               }
                $http({
                  url:"./product/cartItemCount",
                  method:'get'
                  }).success(function(res){
                 
                        Global.getCart(res);
                  });
               
            });
           
            $scope.estatus = '';
          }else{
            $scope.estatus = 'true';
            angular.element($event.target.parentElement.parentElement.parentElement).find('.errstatus').show();
            angular.element($event.target.parentElement.parentElement.parentElement).find('.succstatus').hide();
          }
       }

   
   
   angular.element(document.getElementsByClassName('noRecord')).hide();
   $scope.orders     = {};   

   $http({
       url       :'./order/get_orders',
       method    :'post',
       headers   : {'Content-Type': 'application/x-www-form-urlencoded'},
                
      }).success(function(res){
      if (res!='false') {
       $scope.orders = res;  
      }else{
          angular.element(document.getElementsByClassName('noRecord')).show();
      }
       
       
   });  
});

app.controller('orderDetailsController', function($rootScope, $scope, $location,$http,Global) {
   //if (Global.log() == '') {
   //   $location.path('/login');    
   //}
   var verifyUrl = $location.$$path.replace('/orders', '');
   verifyUrlArr = verifyUrl.split('/');
   $scope.userData   = {};
   $scope.orders     = {};
   $scope.order_total   = {};
   $scope.order_qty   = {};
   $scope.price_total   = {};
      $http({
          url       :'./user/get_details',
          method    :'post',
          headers   : {'Content-Type': 'application/x-www-form-urlencoded'},
                   
         }).success(function(res){
         if (res.code == 1) {
            $scope.userData = res.data;            
         }else if (res.code  == 0) {
            $location.path('/page-not-found');
         }
   });
   $http.post(
             './order/order_details/'+verifyUrlArr[1]
             )
  .success(function(res){
      if (res.code == 1) {         
          $scope.orders = res.data.data;
          $scope.shipping_method = res.data.shipping_method_name;
          $scope.shipping_price = res.data.shipping_price;
          $scope.order_total = res.data.ord_total;
          $scope.order_qty = res.data.ord_qty;
          $scope.price_total = res.data.price_total;
          $scope.ord_slug = res.ord_slug;
          //$scope.proId =  $scope.product.product_id;
          //$scope.bigImage = res.data.images[0].image_name;
          
      }else if (res.code  == 0) {
          $location.path('/page-not-found');
      }
      
      }); 
});