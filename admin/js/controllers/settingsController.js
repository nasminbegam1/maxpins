
MaxpinsApp.controller('settingsController', function($rootScope, $scope, $http, $location) {
    
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
    
    var settingsMode = $location.$$path.replace('/settings', '');   
    
    if(settingsMode == '')
    {
        $http({
                 url:'./settings/listing',
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 data:"start=0"
                 }).success( function(res){
                       $scope.settinglist = res.data;
                       $scope.pagiLink = res.pagination_links;
                 });
        
    }
    else
    {
        var explodedWSMode = settingsMode.split("/");
        
        if (explodedWSMode[1]=='listing') {
             var page  = explodedWSMode[2];
             $http({
                 url:'./settings/listing/'+page,
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                 }).success( function(res){
                
                       $scope.settinglist = res.data;
                       $scope.pagiLink = res.pagination_links;
                       
                 });
        }
        else  if(explodedWSMode[1] == 'edit')
        {
            var settingId = explodedWSMode[2]; 
             $http({
                 url:'./settings/get_details',
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 data:"settingId="+settingId
                 }).success( function(res){
                
                       $scope.sitesettings_name       = res.sitesettings_name;
                       $scope.sitesettings_lebel      = res.sitesettings_lebel;
                       $scope.sitesettings_value      = res.sitesettings_value;
                       $scope.sitesettings_id         = res.sitesettings_id;
                       $scope.sitesettings_type       = res.sitesettings_type;
                 });
             
            $scope.settingUpdate = function(){
                   var dataObj  = angular.element('#formsettings').serialize();
                   $http({
                     url:'./settings/edit_settings_action',
                     method:'post',
                     headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                     data:dataObj
                        }).success( function(res){
                              if (res.code ==  1)
                              {
                                    alert(res.msg);
                                    $location.path('/settings');
                              }
                              else
                              {
                                    alert(res.msg);      
                              }
                    });
            
                  
            }
        }
    }
    
    $scope.back = function() {
        $location.path('/settings');
    }
    
    
    
});