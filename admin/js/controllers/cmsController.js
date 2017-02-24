
MaxpinsApp.controller('cmsController', function($rootScope, $scope, $http, $location, $timeout,$sce) {
    
    /* check admin id */

      $http({
      url:'./home/get_session_values',
      method:'post',
           
      headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
      }).success( function(res){
          if(res.admin_id == 0 || res.admin_id == '')
          {
              $location.path('/login');
          }
      });

      /* check admin id */
    
    $scope.back = function() {
        $location.path('/cms');
    }
      
    var cmsMode = $location.$$path.replace('/cms', ''); 
    
    if(cmsMode == '')
    {
        $http({
                 url:'./cms/listing',
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                 data:"start=0"
                 }).success( function(res){
                       $scope.cmslist = res.data;
                       $scope.pagiLink = res.pagination_links;
                 });
        
    }
    else
    {
        var explodedCmsMode = cmsMode.split("/");
        
        if(explodedCmsMode[1] == 'edit')
        {
            $http({
                 url:'./cms/get_details/' + explodedCmsMode[2],
                 method:'post',
                 
                 headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                 }).success( function(res){
                        
                       $scope.cms_id            = res.cms_id;
                       $scope.cms_title         = res.cms_title;
                       $scope.cms_content       = res.cms_content;
                       $scope.cms_meta_title    = res.cms_meta_title;
                       $scope.cms_meta_key      = res.cms_meta_key;
                       $scope.cms_meta_desc     = res.cms_meta_desc;
                       $scope.featured          = res.featured;
                 });
            
            $scope.cmsUpdate = function(){
            
            $http({
                    url:'./cms/update_cms',
                    method:'post',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                    data:"cms_id="+$scope.cms_id+"cms_title="+encodeURIComponent($scope.cms_title)+"&cms_content="+encodeURIComponent($scope.cms_content)+"&cms_meta_title="+encodeURIComponent($scope.cms_meta_title)+"&cms_meta_key="+encodeURIComponent($scope.cms_meta_key)+"&cms_meta_desc="+encodeURIComponent($scope.cms_meta_desc)+"&featured="+encodeURIComponent($scope.featured)
                    }).success( function(res){
                          if (res > 0)
                          {
                                alert('Record successfully updated');
                                $location.path('/cms');
                          }
                          else
                          {
                                alert('Unable to update');      
                          }
                    });
            }
        }
        
        else if(explodedCmsMode[1] == 'add')
        {
            $scope.cmsAdd = function(){
                $http({
                     url:'./cms/add_cms_action',
                     method:'post',
                     headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                     data:"cms_title="+$scope.cms_title+"&cms_content="+$scope.cms_content+"&cms_meta_title="+$scope.cms_meta_title+"&cms_meta_key="+$scope.cms_meta_key+"&cms_meta_desc="+$scope.cms_meta_desc+"&featured="+$scope.featured
                        }).success( function(res){
                              if (res > 0)
                              {
                                    alert('Record successfully inserted');
                                    $location.path('/cms');
                              }
                              else
                              {
                                    alert('Unable to update. Page is already exists');      
                              }
                    });
            }
        }
        
        else if (explodedCmsMode[1]=='listing') {
             var page  = explodedCmsMode[2];
             $http({
                 url:'./cms/listing/'+page,
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'}
                 }).success( function(res){
                
                       $scope.cmslist = res.data;
                       $scope.pagiLink = res.pagination_links;
                 });
        }
        
        
        
      }
    
    
    
    
      
});

