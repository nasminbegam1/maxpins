
MaxpinsApp.controller('shippingMethodController', function($rootScope, $scope, $http, $location, $timeout,$sce) {
    
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
    
    $scope.back = function(){
      $location.path('/shipping_methods');
    }
    
    $scope.deleteShippingMethod =function(sId){
        var c= confirm('are you sure ?');
        if (c==true) {
            $http({
            url:'./shipping_methods/delete',
            method:'post',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data:"sId="+sId
            }).success( function(res){
                  if(res == 0)
                  {
                    alert('Unable to delete. This method is used by wholesaler.');
                  }
                  else
                  {
                    alert('Record successfully deleted');
                    $http({
                          url:'./shipping_methods/listing',
                          method:'post',
                          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                          data:"start=0"
                          }).success( function(res){
                                $scope.methodList = res.data;
                                $scope.pagiLink = res.pagination_links;
                          });
                  }
                  $location.path('/shipping_methods');
                
            });     
        }
       
    }
    
    $scope.content_warning_msg = "Please don't delete anything within {{ }} and curly brackets";
      
    var shippingMethodMode = $location.$$path.replace('/shipping_methods', '');
    
    if(shippingMethodMode == '')
    {
        $http({
                 url:'./shipping_methods/listing',
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 data:"start=0"
                 }).success( function(res){
                       $scope.methodList = res.data;
                       $scope.pagiLink = res.pagination_links;
                 });
        
    }
    else
    {
        var explodedShippingMethodMode = shippingMethodMode.split("/");
        
        if(explodedShippingMethodMode[1] == 'edit')
        {
            $http({
                 url:'./shipping_methods/get_details/' + explodedShippingMethodMode[2],
                 method:'post',
                 
                 headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                 }).success( function(res){ 
                        if (res.code == 1)
                        {
                              record                   = res.data;
                              $scope.id                = record.id;
                              $scope.method_name       = record.method_name;
                              $scope.method_status     = record.method_status;
                              $scope.prices            = record.prices
                              $scope.priceLen = $scope.prices.length
                        }
                        else
                        {
                              alert('Record not found');
                              $location.path('/shipping_methods');
                        }
                 });
            
            $scope.validateField = function(){
                  //
            }
            
            $scope.addNewPrice = function(){
                  var newItemNo = $scope.prices.length+1;
                  $scope.prices.push({'id':'price'+newItemNo});
                  $scope.priceLen = $scope.prices.length
            }
            $scope.removePrice = function(){
                  var lastItem = $scope.prices.length-1;
                  $scope.prices.splice(lastItem);
                  $scope.priceLen = $scope.prices.length
            }
            
            
            $scope.methodUpdate = function(){
            
            $http({
                    url:'./shipping_methods/do_edit_method',
                    method:'post',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                    //data:"id="+$scope.id+"&method_name="+encodeURIComponent($scope.method_name)+"&method_status="+encodeURIComponent($scope.method_status)
                    data: angular.element( document.querySelector( '#formShippingMethod' ) ).serialize(),
                    }).success( function(res){                        
                          if (res.code > 0)
                          {
                              alert(res.msg);
                              $location.path('/shipping_methods');
                          }
                          else
                          {
                              alert(res.msg);      
                          }
                    });
            }
        }
        
        else if(explodedShippingMethodMode[1] == 'add')
        {
            $scope.prices = [{id: 'price1'}];
            
            $scope.addNewPrice = function(){
                  var newItemNo = $scope.prices.length+1;
                  $scope.prices.push({'id':'price'+newItemNo});
                  $scope.priceLen = $scope.prices.length
            }
            
            $scope.removePrice = function(){
                  var lastItem = $scope.prices.length-1;
                  $scope.prices.splice(lastItem);
                  $scope.priceLen = $scope.prices.length
            }
            
            $scope.methodAdd = function(){                  
                $http({
                     url:'./shipping_methods/do_add_method',
                     method:'post',
                     headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                     //data:"id="+$scope.id+"&method_name="+$scope.method_name+"&method_status="+$scope.method_status
                     data: angular.element( document.querySelector( '#formShippingMethod' ) ).serialize(),
                        }).success( function(res){                              
                              if (parseInt(res.code) > 0)
                              {
                                    alert(res.msg);
                                    $location.path('/shipping_methods');
                              }
                              else
                              {
                                    alert(res.msg);
                              }
                    });
            }
        }
        
        else if (explodedShippingMethodMode[1]=='listing') {
             var page  = explodedShippingMethodMode[2];
             $http({
                 url:'./shipping_methods/listing/'+page,
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                 }).success( function(res){
                       $scope.methodList = res.data;
                       $scope.pagiLink = res.pagination_links;
                 });
        }
        
        
        
    }
    
    
    
    
      
});

