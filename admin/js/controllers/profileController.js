
MaxpinsApp.controller('profileController', function($rootScope, $scope, $location, $http) {

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
      
      $http({
             url:'./home/get_details',
             method:'post',
             
             headers: {'Content-Type': 'application/x-www-form-urlencoded'},
             }).success( function(res){
                   if(res.admin_id > 0)
                   {
                        
                       $scope.first_name = res.first_name;
                       $scope.last_name  = res.last_name;
                       $scope.email_id   = res.email;
                   }
                   else
                   {
                       
                   }
             });
      
      $scope.profileSubmit = function(){
        var pass ='';

        if($scope.password != 'undefined')
        {
            pass = $scope.password;
        }
        
         $http({
            url:'./home/update_profile',
            method:'post',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data:"first_name="+$scope.first_name+"&last_name="+$scope.last_name+"&password="+pass
            }).success( function(res){
                  if (res > 0)
                  {
                        alert('Record successfully updated');
                  }
                  else
                  {
                        alert('Unable to update');      
                  }
            });
      }
             
        
});


