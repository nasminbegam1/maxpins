
MaxpinsApp.controller('categoryController', function($rootScope, $scope, $http, $location, $timeout,$sce,FileUploader) {
    
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
            $location.path('/category');
      }
    
      $scope.deleteCategory =function(cId){
        var c= confirm('are you sure ?');
        if (c==true) {
            $http({
            url:'./category/delete',
            method:'post',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data:"cId="+cId
            }).success( function(res){
                if(res == 0)
                {
                  alert('Unable to delete. This category has product. Please delete product first');
                }
                else
                {
                  alert('Record successfully deleted');
                  $http({
                        url:'./category/listing',
                        method:'post',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                        data:"start=0"
                        }).success( function(res){
                              $scope.categorylist = res.data;
                              $scope.pagiLink = res.pagination_links;
                        });
                }
                $location.path('/category');
            });     
        }
       
      }
      
      var categoryMode = $location.$$path.replace('/category', '');
    
    
    if(categoryMode == '')
    {
        $http({
                 url:'./category/listing',
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 data:"start=0"
                 }).success( function(res){
                       $scope.categorylist = res.data;
                       $scope.pagiLink = res.pagination_links;
                 });
        
    }
    else
    {
        var explodedCMode = categoryMode.split("/");
        
        
        if(explodedCMode[1] == 'edit')
        {
            $http({
                 url:'./category/get_details/' + explodedCMode[2],
                 method:'post',
                 
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 }).success( function(res){
                        if (res.code == 1) {
                            res = res.data;
                            $scope.category_id        = res.category_id;
                            $scope.category_name      = res.category_name;
                            $scope.product_description=res.category_description;
                            $scope.category_status    = res.category_status;
                            
                            
                        }else{
                               alert('Record not found');
                               $location.path('/category');
                        }
                 });
            
            $scope.categoryUpdate = function(){
            
            $http({
                     url:'./category/do_edit_category',
                     method:'post',
                     headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                     data:"category_id="+encodeURIComponent($scope.category_id)+"&category_name="+encodeURIComponent($scope.category_name)+"&category_description="+encodeURIComponent($scope.product_description)+"&category_status="+encodeURIComponent($scope.category_status)
                        }).success( function(res){
                              if (res.code ==  1)
                              {
                                    alert(res.msg);
                                    $location.path('/category');
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
            $scope.category_status = 'Active';
            $scope.categoryAdd = function(){

                $http({
                        url:'./category/do_add_category',
                        method:'post',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                        data:"category_id="+encodeURIComponent($scope.category_id)+"&category_name="+encodeURIComponent($scope.category_name)+"&category_description="+encodeURIComponent($scope.product_description)+"&category_status="+encodeURIComponent($scope.category_status)
                        
                        }).success( function(res){
                              if (res.code > 0)
                              {
                                    alert('Record successfully added');
                                    $location.path('/category');
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
                 url:'./category/listing/'+page,
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                 }).success( function(res){
                       $scope.categorylist = res.data;
                       $scope.pagiLink = res.pagination_links;
                 });
        }
        
    }
    
     
});