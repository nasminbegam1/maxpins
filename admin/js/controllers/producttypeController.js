
MaxpinsApp.controller('producttypeController', function($rootScope, $scope, $http, $location, $timeout,$sce,FileUploader) {
    
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
      
      $scope.back = function() {
            $location.path('/producttype');
      }
    
      $scope.deleteCategory =function(cId){
        var c= confirm('are you sure ?');
        if (c==true) {
            $http({
            url:'./producttype/delete',
            method:'post',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data:"cId="+cId
            }).success( function(res){
                if(res == 0)
                {
                  alert('Unable to delete. This producttype has product. Please delete product first');
                }
                else
                {
                  alert('Record successfully deleted');
                  $http({
                        url:'./producttype/listing',
                        method:'post',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                        data:"start=0"
                        }).success( function(res){
                              $scope.producttypelist = res.data;
                              $scope.pagiLink = res.pagination_links;
                        });
                }
                $location.path('/producttype');
            });     
        }
       
      }
      
      var producttypeMode = $location.$$path.replace('/producttype', '');
    
    
    if(producttypeMode == '')
    {
        $http({
                 url:'./producttype/listing',
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 data:"start=0"
                 }).success( function(res){
                       $scope.producttypelist = res.data;
                       $scope.pagiLink = res.pagination_links;
                 });
        
    }
    else
    {
        var explodedCMode = producttypeMode.split("/");
        
        
        if(explodedCMode[1] == 'edit')
        {
            $http({
                 url:'./producttype/get_details/' + explodedCMode[2],
                 method:'post',
                 
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 }).success( function(res){
                        if (res.code == 1) {
                            res = res.data;
                            $scope.producttype_id        = res.id;
                            $scope.producttype_name      = res.type_name;
                            $scope.producttype_status    = res.status;
                            
                            
                        }else{
                               alert('Record not found');
                               $location.path('/producttype');
                        }
                 });
            
            $scope.typeUpdate = function(){
            
            $http({
                     url:'./producttype/do_edit_producttype',
                     method:'post',
                     headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                     data:"id="+encodeURIComponent($scope.producttype_id)+"&producttype_name="+encodeURIComponent($scope.producttype_name)+"&producttype_status="+encodeURIComponent($scope.producttype_status)
                        }).success( function(res){
                              if (res.code ==  1)
                              {
                                    alert(res.msg);
                                    $location.path('/producttype');
                              }
                              else
                              {
                                    alert(res.msg);      
                              }
                    });
            }
            
            
        }
        
        else if(explodedCMode[1] == 'add')
        {
            $scope.producttype_status = 'Active';
            $scope.typeAdd = function(){

                $http({
                        url:'./producttype/do_add_producttype',
                        method:'post',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                        data:"producttype_id="+encodeURIComponent($scope.producttype_id)+"&producttype_name="+encodeURIComponent($scope.producttype_name)+"&producttype_status="+encodeURIComponent($scope.producttype_status)
                        
                        }).success( function(res){
                              if (res.code > 0)
                              {
                                    alert('Record successfully added');
                                    $location.path('/producttype');
                              }
                              else
                              {
                                    alert(res.msg);      
                              }
                        });
                
            }
        }
        
        else if (explodedCMode[1]=='listing') {
             var page  = explodedCMode[2]; 
             $http({
                 url:'./producttype/listing/'+page,
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                 }).success( function(res){
                       $scope.producttypelist = res.data;
                       $scope.pagiLink = res.pagination_links;
                 });
        }
        
    }
    
     
});