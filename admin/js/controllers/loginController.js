
MaxpinsApp.controller('loginController', function($rootScope, $scope, $location,$http) {
angular.element(".page-header").hide();
angular.element(".page-head").hide();
angular.element(".page-footer").hide();
angular.element(document.querySelector("body")).addClass('login');

 $scope.loginSubmit= function(){
      $http({
              url:'./home/loginAction',
              method:'post',
              
              data:"email="+$scope.email+"&password="+$scope.password,
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              }).success( function(res){
                  
                    if (res.code == '0') {
                            $scope.err='true';
                            $scope.errmsg="username and password are mismatched";         
                    }else if (res.code == '1') {
                     angular.element(".page-header").show();
                     angular.element(".page-head").show();
                     angular.element(".page-footer").show();
                     $location.path('/dashboard');
                    }
              });
             
        
    }

});