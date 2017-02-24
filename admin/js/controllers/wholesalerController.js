
MaxpinsApp.factory(
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

MaxpinsApp.controller('wholesalerController', function($rootScope, $scope, $http, $location, $timeout,$sce,transformRequestAsFormPost) {
    
    $scope.sortType               = 'wholesaler_name'; 
    $scope.sortReverse            = false;
    //document.getElementById('order_field').value = $scope.sortType;
    //document.getElementById('order_type').value = $scope.sortReverse;
    //searchKey.setKey($scope.sortType);
    //searchKey.setType($scope.sortReverse);
    /* check admin id */

      $http({
      url:'./home/get_session_values',
      method:'post',
           
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      }).success( function(res){
          if(res.admin_id == 0 || res.admin_id == '')
          {
              $location.path('/login');
          }
      });

      /* check admin id */
    
    $scope.customSorting = function(item) {
            document.getElementById('order_field').value = $scope.sortType;
            document.getElementById('order_type').value = $scope.sortReverse;
      
            var order_field = document.getElementById('order_field').value;
            var order_type = document.getElementById('order_type').value;
            $http({
                   url:'./wholesaler/setOrder',
                  method:'post',
                  headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                  data:"order_field="+order_field+"&order_type="+order_type
                  }).success(function(){
                  $http({
                    url:'./wholesaler/listing/'+page,
                    method:'post',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data:'order_field='+order_field+'&order_type='+order_type
                    }).success( function(res){
                   
                          $scope.wholesalerlist = res.data;
                          $scope.pagiLink = res.pagination_links;
                    });
                  });
            
    }
    
    $scope.back = function() {
        $location.path('/wholesaler');
    }
    
    $scope.sendPassword = function(){
        $http({
            url:'./wholesaler/send_password',
            method:'post',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data:"wid="+$scope.form.wholesaler_id
            }).success( function(res){
                alert(res.msg);
            });
    }
    
    $scope.deleteWholesaler =function(wsId){
        var c= confirm('are you sure ?');
        if (c==true) {
            $http({
            url:'./wholesaler/delete',
            method:'post',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data:"wsId="+wsId
            }).success( function(res){
                if(res == 0)
                {
                  alert('Unable to delete. This category has product. Please delete product first');
                }
                else
                {
                  alert('Record successfully deleted');
                   $scope.wholesalerlist  = res.data;
                   $scope.pagiLink        = res.pagination_links;
                }
            });     
        }
       
    }
    
    var wholesalerMode = $location.$$path.replace('/wholesaler', '');  
    
    if(wholesalerMode == '')
    {
        var order_field = document.getElementById('order_field').value;
        var order_type = document.getElementById('order_type').value;
        $http({
                 url:'./wholesaler/listing',
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 data:"start=0&order_field="+order_field+"&order_type="+order_type
                 }).success( function(res){ 
                       $scope.wholesalerlist = res.data;
                       $scope.pagiLink = res.pagination_links;
                 });
        
    }
    else
    {
        var explodedWSMode = wholesalerMode.split("/");
        
        if(explodedWSMode[1] == 'edit')
        {
            $scope.form = '';
            $http({
                 url:'./wholesaler/get_details/' + explodedWSMode[2],
                 method:'post',
                 
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 }).success( function(res){
                        $scope.form = res[0];
                        
                        //$scope.form.wholesaler_id                = res[0].wholesaler_id;
                        //
                        //$scope.form.wholesaler_name              = res[0].wholesaler_name;
                        $scope.form.billing_address              = res[0].wholesaler_billing_address;
                        $scope.form.billing_city                 = res[0].wholesaler_billing_city;
                        $scope.form.billing_state                = res[0].wholesaler_billing_state;
                        $scope.form.billing_country              = res[0].wholesaler_billing_country;
                        $scope.form.billing_zip                  = res[0].wholesaler_billing_zip;
                        $scope.form.shipping_address             = res[0].wholesaler_shipping_address;
                        $scope.form.shipping_city                = res[0].wholesaler_shipping_city;
                        $scope.form.shipping_state               = res[0].wholesaler_shipping_state;
                        $scope.form.shipping_country             = res[0].wholesaler_shipping_country;
                        $scope.form.shipping_state                = res[0].wholesaler_shipping_state;
                        $scope.form.shipping_zip                 = res[0].wholesaler_shipping_zip;
                        //$scope.form.wholesaler_phone             = res[0].wholesaler_phone;
                        //$scope.form.wholesaler_email             = res[0].wholesaler_email;
                        //$scope.form.wholesaler_contact           = res[0].wholesaler_contact;
                        //$scope.form.wholesaler_shipping_method   = res[0].shipping_method;
                        //$scope.form.wholesaler_customer_id       = res[0].wholesaler_customer_id;
                        //$scope.form.wholesaler_note              = res[0].wholesaler_note;
                        //$scope.form.wholesaler_status            = res[0].wholesaler_status;
                        //alert(res[1]);
                        console.log($scope.form);
                        $scope.countryList          = res[1];
                        $scope.shippingList         = res[2];
                 });
            $scope.wholesaler_password = '';
            $scope.wholesalerUpdate = function(){
            
            $http({
                    url:'./wholesaler/update_wholesaler',
                    method:'post',
                    //transformRequest: transformRequestAsFormPost,
                    //data: $scope.form
                     headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                    
                    data:"wholesaler_id="+encodeURIComponent($scope.form.wholesaler_id)
                         +"&wholesaler_name="+encodeURIComponent($scope.form.wholesaler_name)
                         +"&billing_address="+encodeURIComponent($scope.form.billing_address)
                         +"&billing_city="+encodeURIComponent($scope.form.billing_city)
                         +"&billing_state="+encodeURIComponent($scope.form.billing_state)
                         +"&billing_country="+encodeURIComponent($scope.form.billing_country)
                         +"&shipping_address="+encodeURIComponent($scope.form.shipping_address)
                         +"&shipping_city="+encodeURIComponent($scope.form.shipping_city)
                         +"&shipping_state="+encodeURIComponent($scope.form.shipping_state)
                         +"&shipping_country="+encodeURIComponent($scope.form.shipping_country)
                         +"&wholesaler_phone="+encodeURIComponent($scope.form.wholesaler_phone)
                         +"&wholesaler_email="+encodeURIComponent($scope.form.wholesaler_email)
                         +"&wholesaler_password="+encodeURIComponent($scope.form.wholesaler_password)
                         +"&billing_zip="+encodeURIComponent($scope.form.billing_zip)
                         +"&shipping_zip="+encodeURIComponent($scope.form.shipping_zip)
                         +"&wholesaler_contact="+encodeURIComponent($scope.form.wholesaler_contact)
                         +"&wholesaler_customer_id="+encodeURIComponent($scope.form.wholesaler_customer_id)
                         +"&shipping_method="+encodeURIComponent($scope.form.shipping_method)
                         +"&wholesaler_note="+encodeURIComponent($scope.form.wholesaler_note)
                         +"&wholesaler_status="+encodeURIComponent($scope.form.wholesaler_status)
                    
                    }).success( function(res){
                              
                        alert('Record successfully updated');
                        $location.path('/wholesaler');
                  
                    });
            }
            
            
        }
        
        else if(explodedWSMode[1] == 'add')
        {
            $http({
                 url:'./wholesaler/get_details/' + explodedWSMode[2],
                 method:'post',
                 
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 }).success( function(res){
                    $scope.countryList          = res[0];
                    $scope.shippingList         = res[1];
                });
            
            $scope.wholesalerAdd = function(){

                $http({
                        url:'./wholesaler/do_add_wholesaler',
                        method:'post',
                        //transformRequest: transformRequestAsFormPost,
                        headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                        data:"wholesaler_id="+encodeURIComponent($scope.form.wholesaler_id)
                            +"&wholesaler_name="+encodeURIComponent($scope.form.wholesaler_name)
                            +"&billing_address="+encodeURIComponent($scope.form.billing_address)
                            +"&billing_city="+encodeURIComponent($scope.form.billing_city)
                            +"&billing_state="+encodeURIComponent($scope.form.billing_state)
                            +"&billing_country="+encodeURIComponent($scope.form.billing_country)
                            +"&shipping_address="+encodeURIComponent($scope.form.shipping_address)
                            +"&shipping_city="+encodeURIComponent($scope.form.shipping_city)
                            +"&shipping_state="+encodeURIComponent($scope.form.shipping_state)
                            +"&shipping_country="+encodeURIComponent($scope.form.shipping_country)
                            +"&wholesaler_phone="+encodeURIComponent($scope.form.wholesaler_phone)
                            +"&wholesaler_email="+encodeURIComponent($scope.form.wholesaler_email)
                            +"&billing_zip="+encodeURIComponent($scope.form.billing_zip)
                            +"&shipping_zip="+encodeURIComponent($scope.form.shipping_zip)
                            +"&wholesaler_contact="+encodeURIComponent($scope.form.wholesaler_contact)
                            +"&wholesaler_customer_id="+encodeURIComponent($scope.form.wholesaler_customer_id)
                            +"&shipping_method="+encodeURIComponent($scope.form.shipping_method)
                            +"&wholesaler_note="+encodeURIComponent($scope.form.wholesaler_note)
                            +"&wholesaler_status="+encodeURIComponent($scope.form.wholesaler_status)
                        //data: $scope.form
                        }).success( function(res){
                              if (res > 0)
                              {
                                    alert('Record successfully added');
                                    $location.path('/wholesaler');
                              }
                              else
                              {
                                    alert('Unable to update');      
                              }
                        });
                
            }
        }
        
        else if (explodedWSMode[1]=='listing') {
             var order_field = document.getElementById('order_field').value;
            var order_type = document.getElementById('order_type').value;
             var page  = explodedWSMode[2];
             $http({
                 url:'./wholesaler/listing/'+page,
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 data:"order_field="+order_field+"&order_type="+order_type
                 }).success( function(res){
                
                       $scope.wholesalerlist = res.data;
                       $scope.pagiLink = res.pagination_links;
                 });
        }
        
        
        
    }
    
    $scope.searchWholesaler = function() {
        $http({
            url:'./wholesaler/listing',
            method:'post',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data:"wholesaler_name_email="+$scope.wholesaler_name_email
        
            }).success( function(res){
                $scope.wholesalerlist = res.data;
                $scope.pagiLink = res.pagination_links;
            });
    }
    
    $scope.clearAll = function(){
        $scope.wholesaler_name_email = ' ';
        $http({
            url:'./wholesaler/listing',
            method:'post',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data:"wholesaler_name_email="
        
            }).success( function(res){
                $scope.wholesalerlist = res.data;
                $scope.pagiLink = res.pagination_links;
            });
    }
    
    
      
});

