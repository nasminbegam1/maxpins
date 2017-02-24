
MaxpinsApp.controller('logoutController', function($rootScope, $scope, $location,$http) {


            $http({
                  url:'./home/logout',
                  method:'post',
                  headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                  }).success( function(res){
                        if (res.response_code > 0)
                        {
                              angular.element(".page-header").hide();
                              angular.element(".page-head").hide();
                              angular.element(".page-footer").hide();
                              
                              angular.element(document.querySelector("body")).addClass('login');
                              $location.path('/login');
                        }
                        
                  });
              


       

});