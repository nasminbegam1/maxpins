
app.controller('loginController', function($rootScope, $scope, $location,$http,Global) {
  $scope.errmsg = "";Global.setLog('');
  $scope.submitLogin =  function(){
    $http({
          url       :'./home/loginAction',
          method    :'post',
          headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
          data      : "email="+$scope.email+"&password="+$scope.password
                    
        }).success(function(res){
            if (res.code == 0) {
                $scope.errmsg = res.msg;
            }else if (res.code == 1) {
                  Global.setLog('true');
                 
                 $location.path('/orders');
            }
        });
  }
  
  $scope.createAccount = function() {
      $location.path('/registration');
  }

});


app.controller('dashboardController', function($rootScope, $scope, $location,$http,Global) {

 Global.setLog('1');

});


app.controller('signupController', function($rootScope, $scope, $location,$http) {
    $scope.form = {};
    $scope.country = {};
     $http({
                url       :'./home/getCountry'
                          
              }).success(function(res){// alert(res);
        $scope.form.b_country = 1;
        $scope.form.s_country = 1;
        
        $scope.form.b_state = 1;
        $scope.form.s_state = 1;
        
        $scope.country          = res.country;
        $scope.state            = res.state;
        $scope.shippingList     = res.shipping_method;
        $scope.shipping_method  = 1;
        
        });
     
     $scope.sameAsBill = function($event){
        if($event.target.checked){
            $scope.form.s_address     = $scope.form.b_address;
            $scope.form.s_city        = $scope.form.b_city;
            $scope.form.s_country     = $scope.form.b_country;
            $scope.form.s_state       = $scope.form.b_state;
            $scope.form.s_text_state  = $scope.form.b_text_state;
            $scope.form.s_zip         = $scope.form.b_zip;
        }else{
            $scope.form.s_address     = '';
            $scope.form.s_city        = '';
            $scope.form.s_country     = '';
            $scope.form.s_state       = '';
            $scope.form.s_text_state  = '';
            $scope.form.s_zip         = '';
        }
     }
     $scope.b_text_state_err ='';$scope.s_text_state_err="";
     $scope.loadProcess = '';$scope.form.shipping_method=1;
    $scope.signUpSubmit = function(){
     
      $scope.loadProcess = 'true';
          if ($scope.form.b_country !=1 && $scope.form.b_text_state == undefined) {
           $scope.b_text_state_err ='true';
          }else{
           $scope.b_text_state_err ='';
            
          }
          
          if ($scope.form.s_country !=1 && $scope.form.s_text_state == undefined) {
           $scope.s_text_state_err ='true';
          }else{
           $scope.s_text_state_err ='';
           
          }
        if ($scope.b_text_state_err!='' || $scope.b_text_state_err !='') {
          return false;
         
        }
     
       
        var formdata = "name="+ $scope.form.name+"&";
            formdata += "email="+$scope.form.email+"&";
            formdata += "password="+$scope.form.password+"&";
            formdata += "wholesaler_customer_id="+$scope.form.wholesaler_customer_id+"&";
            formdata += "phone="+$scope.form.phone+"&";
            formdata += "contact="+$scope.form.contact+"&";
            formdata += "b_address="+$scope.form.b_address+"&";
            formdata += "b_city="+$scope.form.b_city+"&";
            formdata += "b_state="+$scope.form.b_state+"&";
            formdata += "b_text_state="+$scope.form.b_text_state+"&";
            formdata += "b_country="+$scope.form.b_country+"&";
            formdata += "b_zip="+$scope.form.b_zip+"&";
            formdata += "s_address="+$scope.form.s_address+"&";
            formdata += "s_city="+$scope.form.s_city+"&";
            formdata += "s_state="+$scope.form.s_state+"&";
            formdata += "s_text_state="+$scope.form.s_text_state+"&";
            formdata += "s_country="+$scope.form.s_country+"&";
            formdata += "shipping_method="+$scope.form.shipping_method+"&";
            formdata += "s_zip="+$scope.form.s_zip+"&";
             
            $http({
                url       :'./home/signupAction',
                method    :'post',
                headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                data      : formdata
                          
              }).success(function(res){
                  if (res.code == 0) {
                    $scope.loadProcess = '';
                      $scope.errmsg = res.msg;
                  }else if (res.code == 1) {
                        //$scope.succmsg = "Thank you for sign up. We have sent you a verification email in your provided email address.";
                      $scope.loadProcess = '';
                      //  $scope.form.reset();
                      $location.path('signupsuccess');
                  }
              });

    }
});

app.controller('verifyController', function($rootScope, $scope, $location,$http) {
    var verifyUrl = $location.$$path.replace('/verification', '');
    verifyUrlArr = verifyUrl.split('/');
    $http.post(
               './home/verifyAction/'+verifyUrlArr[1]
               )
    .success(function(res){
        $scope.code = res.code;
        });
});


app.controller('productController', function($rootScope, $scope, $location,$http,Global) {
    
     var verifyUrl = $location.$$path.replace('/products', '');
    verifyUrlArr = verifyUrl.split('/');
   
   
   $scope.processdetails = function($event){
      var element = $event.target;
      $(element).parents('li').find('.checkPan').removeClass('ng-hide');
      $(element).parents('li').find('.checkPan .succstatus').show();
    } 
   
    
    //$scope.cmsContent ={};
    // $http({
    //      url       :'./home/getCmsContent/product-listing',
    //      method    :'post',
    //      headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
    //               
    //    }).success(function(res){
    //      $scope.cmsContent = res.data.cms_content;
    //    });
    $scope.checkCategory = [];
    $scope.searchCheckProduct = function($event){
        
        //var value =document.getElementsByName('category').value;
        //console.log($event.target.value);
        if ($event.target.checked==true) {
            $scope.checkCategory.push($event.target.value);
        }else{
            var index = $scope.checkCategory.indexOf($event.target.value);
            $scope.checkCategory.splice(index, 1);
        }
      
       var category ='';
        if ($scope.checkCategory.length > 0) {
            category =  $scope.checkCategory.join();
           
        }
         $http({
                url       :'./product/addSearchCategory',
                method    :'post',
                headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                data      : "keyword="+category
                          
              }).success(function(res){
              Global.setSearchKey('');
              getProducts($http,$scope);
            });
       
    }
    
    $scope.checkProductType = [];
  $scope.searchCheckProductType = function($event){
        
        //var value =document.getElementsByName('category').value;
        //console.log($event.target.value);
        if ($event.target.checked==true) {
            $scope.checkProductType=$event.target.value;
        }else{
            //var index = $scope.checkProductType.indexOf($event.target.value);
            $scope.checkProductType='';
        }
      
       var producttype ='';
        if ($scope.checkProductType.length > 0) {
             producttype =  $scope.checkProductType;
            
        }
        $http({
              url       :'./product/addSearchProductType',
              method    :'post',
              headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
              data      : "keyword="+producttype
                        
            }).success(function(res){
            Global.setSearchKey('');
            getProducts($http,$scope);
          });
       
    }

    
    $scope.categoryListMenu = []; 
     $http.post(
               './home/getProductType'
               )
    .success(function(res){
        $scope.productTypeList = res;
    });
    
    $scope.categoryListMenu = []; 
     $http.post(
               './home/getCategory'
               )
    .success(function(res){
        $scope.categoryListMenu = res;
    });
    
    
    
    $http.post(
               './product/getSearchkeyWord'
               )
    .success(function(res){
      if (res!='') {
        Global.setSearchKey(res);
      }
      if (Global.getSearchKey() !='' ) {
        $scope.keyword = Global.getSearchKey();
        getSearchProduct($scope,$http,Global);
      }else{
       
        getProducts($http,$scope);
      }
         
    });
    
   
    $scope.products     = {};
    $scope.searchProduct = function(){
        Global.setSearchKey($scope.keyword);
        $http({
              url       :'./product/addSearchkeyWord',
              method    :'post',
              headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
              data      : "keyword="+$scope.keyword
                        
            }).success(function(res){
          $http.post(
               './home/getCategory'
               )
    .success(function(res){
        $scope.categoryListMenu = res;
    });
        });
        getSearchProduct($scope,$http,Global);
        
    }
    
    if (verifyUrlArr.length > 1 && verifyUrlArr[1]=='search') {
        $scope.keyword = verifyUrlArr[2];
        Global.setSearchKey($scope.keyword);
        getSearchProduct($scope,$http,Global);
    }
    
    
    
  
    
});


app.controller('productDetailsController', function($rootScope, $scope, $location,$http,$timeout,Global) {
  
    $scope.countUp = function($event){

      var input = $event.target.parentElement;
      input = input.querySelector('input[type=text]');
      var inputValue  = input.value;
	  if(inputValue==''){inputValue = 0;}
      inputValue = parseInt(inputValue)+1;
      input.value = inputValue;
      $scope.cartQty = inputValue;
    }
    $scope.countDown = function($event){
      var input = $event.target.parentElement;
      input = input.querySelector('input[type=text]');
      var inputValue  = input.value;
	  	  if(inputValue==''){inputValue = 0;}
      if (inputValue >0) {
        
        inputValue = parseInt(inputValue)-1;
        input.value = inputValue;
      $scope.cartQty = inputValue;
      }
    }
  
     var verifyUrl = $location.$$path.replace('/products', '');
    verifyUrlArr = verifyUrl.split('/');
    $scope.cartQty = 0;
    $scope.proId = 0;$scope.custom_pins_status=false;
    $http.post(
               './product/product_details/'+verifyUrlArr[1]
               )
    .success(function(res){
        if (res.code == 1) {
            $scope.product = res.data;
            $scope.custom_pins_status = res.data.custom_pins_status;
            $scope.proId =  $scope.product.product_id;
             $scope.bigImage = res.data.images[0].image_name;
             $scope.cartQty = res.data.custom_pins;
            
        }else if (res.code  == 0) {
            $location.path('/page-not-found');
        }
        
        });
    $scope.viewBig =function(img){
        
        $scope.bigImage= img;
    }
    $http.post(
               './product/getSearchkeyWord'
               )
    .success(function(res){
      if (res!='') {
        Global.setSearchKey(res);
        
      }
      if (Global.getSearchKey() !='' ) {
        $scope.keyword = Global.getSearchKey();
      
      }
         
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
    
    $scope.addToCart = function(){
      
       if(($scope.product.custom_pins_status==false && $scope.cartQty!='') || ($scope.product.custom_pins_status==true && $scope.cartQty>=100)){
        $scope.loadStatus = 'true';
            $http({
              url       :'./product/addToCart',
              method    :'post',
              headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
              data      : "proId="+$scope.proId+"&cartQty="+$scope.cartQty
                        
            }).success(function(res){
              
               switch(res.code)
               {
                case 0:
                  $scope.msg = 'Unable to add to cart';
                  break;
                case 1:
                  $scope.msg = 'Product is added into cart successfully. Do you want to <a href="#/products"><strong>continue</strong></a> or <a href="#/mycart"><strong>check out</strong></a> ?';
                  break;
                case 2:
                  $scope.msg = 'Quantity is greater than the current inventory.  Please contact us directly to order this product.';
                  break;
               }
               Global.getCart(res.itemCount);
               $scope.loadStatus = '';
               $timeout(function(){$scope.msg='';},5000);
            });
       }
    }
});

app.controller('cartController', function($rootScope, $scope, $location,$http,Global) {
  if (Global.log() == '') {
        $location.path('/login');    
    }
    
    $scope.countUp = function($event){
      var input = $event.target.parentElement;
      input = input.querySelector('input[type=number]');
      var inputValue  = input.value;
      inputValue = parseInt(inputValue)+1;
      input.value = inputValue;
    }
    $scope.countDown = function($event){
      var input = $event.target.parentElement;
      input = input.querySelector('input[type=number]');
      var inputValue  = input.value;
      if (inputValue >0) {
        
        inputValue = parseInt(inputValue)-1;
        input.value = inputValue;
      
      }
    }
     $http({
              url       :'./product/getCartData',
            }).success(function(res){
      
         $scope.cartItems = res.data;
         $scope.total = res.total;
           $scope.itemCount = res.itemCount;
           Global.getCart(res.itemCount);
           if (res.not_added_product!='') {
            $scope.not_added_product = res.not_added_product+' not added due to less inventory quantity'; 
           }
           
      });
     
     $scope.removeItem = function(row){
      var c = confirm("Are you sure to remove this product from your cart?");
      if (c==true) {
            $http({
              url       :'./product/removeCart',
              method    :'post',
              headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
              data      : "rowId="+row
                        
            }).success(function(res){
              $scope.itemCount = res.itemCount;
              $scope.cartItems = res.data;
               $scope.total = res.total;
               Global.getCart($scope.itemCount);
            });
      }
        
      
     }

    $scope.updateCart = function(){
      angular.element(document.getElementsByClassName('maxQty')).hide();
      angular.element(document.getElementsByClassName('minQty')).hide();
        var elements = document.getElementsByClassName('cartItem');
        var rowId = []; var qty = [];var err =0;
        
        for (var i = 0; i < elements.length; i++) {
              var maxQty = elements[i].getAttribute('max');
              var minQty = elements[i].getAttribute('min');
              
              if (Number(elements[i].value) >  Number(maxQty)) {
                angular.element(elements[i].parentElement.parentElement).find('.maxQty').show();
                angular.element(elements[i].parentElement.parentElement).find('.minQty').hide();
                err = Number(err)+1;
              }
              if (Number(elements[i].value) <=  Number(minQty)) {
                angular.element(elements[i].parentElement.parentElement).find('.minQty').show();
                angular.element(elements[i].parentElement.parentElement).find('.maxQty').hide();
                err = Number(err)+1;
              }
              rowId.push(elements[i].getAttribute('data-item'));
              qty.push(elements[i].value);
        }
     
        
        if (rowId.length > 0 && qty.length > 0 && err == 0) {
           $http({
              url       :'./product/updateCart',
              method    :'post',
              headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
              data      : "rowId="+rowId+"&qty="+qty
                        
            }).success(function(res){
              $scope.cartItems = res.data;
               $scope.total = res.total;
               Global.getCart(res.itemCount);
            });
        }
        
    }
    $scope.continueShopping = function(){
        $location.path("/products");
    } 
    $scope.checkOut = function(){
      $location.path("/checkout");
    }
});


app.controller('checkoutController', function($rootScope, $scope, $location,$http,Global,transformRequestAsFormPost) {
  if (Global.log() == '') {
        $location.path('/login');    
    }
    $scope.orderTotalForDis =0;
    $scope.discount ='0.00';
    $scope.aStatus='';
    $scope.order_wholesaler ='';
    $http({
        url       :'./home/checkAdmin',
      }).success(function(res){
          $scope.aStatus = res;
      });
    $scope.getShippingAmt = function(){
          $http({
            url:'./product/getShippingAmt',
            method    :'post',
            headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
            data:'shipping_method='+$scope.select_shipping_method
          }).success(function(res){
              $scope.orderTotal       = res.order_total;
              $scope.orderTotalForDis = res.order_total;
              $scope.shppingPrice     = res.shipping_price;
          });
    }
    $scope.getShipping =function(){
       if ($scope.order_wholesaler == undefined || $scope.order_wholesaler =='') {
        $scope.wmsg= 'Please select any wholesaler';
        $scope.msg= 'Please select any wholesaler'; 
      }else{
        $scope.wmsg= '';$scope.msg= ''; 
      }
        $http({
            url:'./product/getShipping',
            method    :'post',
            headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
            data:'wholesaler='+$scope.order_wholesaler
          }).success(function(res){
              $scope.orderTotal       = res.order_total;
              $scope.orderTotalForDis = res.order_total;
              $scope.shppingPrice     = res.shipping_price;
              $scope.shipping_method  = res.shipping_method;
          });
    }
    $scope.checkDiscount =  function(){
      if ($scope.order_wholesaler == undefined || $scope.order_wholesaler =='') {
        $scope.wmsg= 'Please select any wholesaler';
      }
    }
    $scope.getDiscount =function(){
      if ($scope.order_wholesaler == undefined || $scope.order_wholesaler =='') {
        $scope.wmsg= 'Please select any wholesaler';
      }else{
        
          var discount = 0;
          if ($scope.discount!='') {
            discount = parseFloat($scope.discount);  
          }
          var total = parseFloat($scope.orderTotalForDis);
          total     = total-discount;
         if (total <=0) {
          $scope.diserr ='discount must be less than order total';
         }else{
          $scope.diserr ='';
         }
          $scope.orderTotal = total;
          $http({
                url:'./payment/setDiscount',
                method    :'post',
                headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                data:'discount='+discount
              });
      }
    }
   
    
    $scope.pay='';
    
    $scope.goToProfile =  function(){
      Global.setcheckoutStatus(1);
      $location.path("/profile");
    }
    $scope.shipping_method = '';$scope.shippingMethod=[];
    $scope.currentYear = new Date().getFullYear();
    $scope.currentMonth = Number(new Date().getMonth())+1;
            $http({
              url       :'./product/checkoutData',
            }).success(function(res){
              $scope.shippingMethod=[];
              $scope.userData         = res.user_data;
              $scope.order_wholesaler = res.user_data.wholesaler_id;
              $scope.cartData         = res.cart_data;
              $scope.orderTotal       = res.order_total;
              $scope.orderTotalForDis = res.order_total;
              $scope.orderTotalItem   = res.order_total_item;
              $scope.shppingPrice     = res.shipping_price;
              
              $scope.shipping_method  = res.shipping_method;  
              
              
              $scope.wholesalers      = res.wholesaler_list;
              $scope.shippingMethod   = res.shippingMethod;
              var index = $scope.shippingMethod.map(function(e) { return e.method_name; }).indexOf(res.shipping_method);
              $scope.select_shipping_method= (index+1);
            });
            $scope.payment_type='';
    $scope.orderNow = function(){
      
      if ($scope.order_wholesaler == undefined || $scope.order_wholesaler =='') {
        $scope.wmsg= 'Please select any wholesaler';
        $scope.msg= 'Please select any wholesaler'; 
      }
      else if ($scope.orderTotal <= $scope.discount ) {
        $scope.diserr ='discount must be less than order total';
      }
      else if ($scope.orderTotal <= 0 ) {
        $scope.toterr ='discount must be less than order total';
      }
      else if ($scope.payment_type == '') {
        $scope.msg= 'Please select any payment method';
      }else{
          if ($scope.payment_type=='paypal') {
            $location.path('/paymentprocess/'+$scope.order_wholesaler);
          }
          else{
            $scope.loading_small ='true';
            $http({
                url       :'./payment/payNotPaypal',
                method    :'post',
                headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                data:'payment_type='+$scope.payment_type+
                     '&wholesaler_id='+$scope.order_wholesaler+
                     '&discount='+$scope.discount
                     
             }).success(function(res){
                if (res.code==2) {
                  $scope.msg= 'Your cart is empty';
                }
                else if (res.code==1 && $scope.aStatus == '' ) {
                  $location.path('/orders/success/'+res.order_code);
                }else if (res.code==1 && $scope.aStatus != '' ) {
                  var folder = '/maxpins';
                  //var folder = '';
                  var url = "http://"+document.location.host+folder+"/admin/#/order/view/"+res.order_id;
                  
                  window.location.href =url; 
                }
             });
          }
      }
      
       //$location.path('/paymentprocess');
    }
});

    

app.controller('cmsDetailsController', function($rootScope, $scope, $location,$http, Global) {        
        var verifyUrl = $location.$$path.replace('/page', '');
        verifyUrlArr = verifyUrl.split('/');
        
        $http.post(
                   './cms/cms_details/'+verifyUrlArr[1]
                   )
        .success(function(res){
            if (res.code == 1) {
                Global.setPageTitle(res.data.cms_meta_title);
                $rootScope.pgTitle = Global.pageTitle();
                
                Global.setMetaKeyword(res.data.cms_meta_key);
                $rootScope.meta_keywords = Global.setMetaKeyword();
                
                Global.setMetaDesc(res.data.cms_meta_desc);
                $rootScope.meta_descriptions = Global.getMetaDesc();
                
                $scope.page = res.data;
                if($scope.page['cms_slug'] == 'special-events'){
                  $scope.image_slides = [
                                         'upload/cms/SpecialEvents/1.jpg',
                                         'upload/cms/SpecialEvents/2.jpg',
                                         'upload/cms/SpecialEvents/3.jpg',
                                         'upload/cms/SpecialEvents/4.jpg',
                                         'upload/cms/SpecialEvents/5.jpg',
                                         'upload/cms/SpecialEvents/6.jpg',
                                         'upload/cms/SpecialEvents/7.jpg',
                                         'upload/cms/SpecialEvents/8.jpg',
                                         'upload/cms/SpecialEvents/9.jpg',
                                         'upload/cms/SpecialEvents/10.jpg',
                                         'upload/cms/SpecialEvents/11.jpg',
                                         'upload/cms/SpecialEvents/12.jpg',
                                         'upload/cms/SpecialEvents/13.jpg',
                                         'upload/cms/SpecialEvents/14.jpg',
                                         'upload/cms/SpecialEvents/15.jpg',
                                         'upload/cms/SpecialEvents/16.jpg',
                                         'upload/cms/SpecialEvents/17.jpg',
                                        ];
                  $scope.image_slides_alt = ['image01','image02','image03','image04','image05','image06','image07','image08','image09','image10','image11','image12','image13','image14','image15','image16','image17'];
                }else if($scope.page['cms_slug'] == 'marketing'){
                  $scope.image_slides = [
                                         'upload/cms/marketing/1.jpg',
                                         'upload/cms/marketing/2.jpg',
                                         'upload/cms/marketing/3.jpg',
                                         'upload/cms/marketing/4.jpg',
                                         'upload/cms/marketing/5.jpg',
                                         'upload/cms/marketing/6.jpg',
                                         'upload/cms/marketing/7.jpg',
                                         'upload/cms/marketing/8.jpg',
                                         'upload/cms/marketing/9.jpg'
                                        ];
                  $scope.image_slides_alt = ['image01','image02','image03','image04','image05','image06','image07','image08','image09'];
                }else if($scope.page['cms_slug'] == 'destinations'){
                  $scope.image_slides = [
                                         'upload/cms/destinations/1.jpg',
                                         'upload/cms/destinations/2.jpg',
                                         'upload/cms/destinations/3.jpg',
                                         'upload/cms/destinations/4.jpg',
                                         'upload/cms/destinations/5.jpg',
                                         'upload/cms/destinations/6.jpg',
                                         'upload/cms/destinations/7.jpg',
                                         'upload/cms/destinations/8.jpg'
                                        ];
                  $scope.image_slides_alt = ['image01','image02','image03','image04','image05','image06','image07','image08'];
                }else if($scope.page['cms_slug'] == 'about-us'){
                  $scope.image_slides = [
                                         'upload/cms/about/1.jpg',
                                         'upload/cms/about/2.jpg',
                                         'upload/cms/about/3.jpg',
                                         'upload/cms/about/4.jpg',
                                         'upload/cms/about/5.jpg',
                                         'upload/cms/about/6.jpg',
                                         'upload/cms/about/7.jpg'
                                        ];
                  $scope.image_slides_alt = ['image01','image02','image03','image04','image05','image06','image07'];
                }
            }else if (res.code  == 0) {
                $location.path('/page-not-found');
            }
        });
        $http({
          url       :'./home/getFeatureProductImage',
          method    :'post',
          headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                   
        }).success(function(res){
          $scope.productImage = res.data;
          $scope.productName = res.product_name;
        });
})




function getProducts($http,$scope){
    var category = "";var product_type ='';
    if ($scope.checkCategory.length > 0) {
        category =  $scope.checkCategory.join();
    }
    if ($scope.checkProductType.length > 0) {
        product_type =  $scope.checkProductType;
    }
    $http({
        url       :'./product/getProducts',
        method    :'post',
        headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
        data      : "category_id="+category+"&product_type="+product_type
                  
      }).success(function(res){
          $scope.products = res;
      });
 
}


function getSearchProduct($scope,$http,Global){
  //alert($scope.keyword );
    $http({
          url       :'./product/search',
          method    :'post',
          headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
          data      :  "keyword="+Global.getSearchKey()  
        }).success(function(res){
           $scope.products = res;
        });
   
}


app.factory(
            "transformRequestAsFormPost",
            function() {

                // I prepare the request data for the form post.
                function transformRequest( data, getHeaders ) {

                    var headers = getHeaders();

                    headers[ "Content-type" ] = "application/x-www-form-urlencoded; charset=utf-8";

                    return( serializeData( data ) );

                }


                // Return the factory value.
                return( transformRequest );


                // ---
                // PRVIATE METHODS.
                // ---


                // I serialize the given Object into a key-value pair string. This
                // method expects an object and will default to the toString() method.
                // --
                // NOTE: This is an atered version of the jQuery.param() method which
                // will serialize a data collection for Form posting.
                // --
                // https://github.com/jquery/jquery/blob/master/src/serialize.js#L45
                function serializeData( data ) {

                    // If this is not an object, defer to native stringification.
                    if ( ! angular.isObject( data ) ) {

                        return( ( data == null ) ? "" : data.toString() );

                    }

                    var buffer = [];

                    // Serialize each key in the object.
                    for ( var name in data ) {

                        if ( ! data.hasOwnProperty( name ) ) {

                            continue;

                        }

                        var value = data[ name ];

                        buffer.push(
                            encodeURIComponent( name ) +
                            "=" +
                            encodeURIComponent( ( value == null ) ? "" : value )
                        );

                    }

                    // Serialize the buffer and clean it up for transportation.
                    var source = buffer
                        .join( "&" )
                        .replace( /%20/g, "+" )
                    ;

                    return( source );

                }

            }
        );