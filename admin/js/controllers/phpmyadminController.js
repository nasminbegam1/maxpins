
MaxpinsApp.controller('phpmyadminController', function($rootScope, $scope, $http, $location, $timeout,$sce) {
    
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

   submitForm = function(){
      
      $http({
      url:'phpmyadmin/index.php',
      method:'post',
      data: angular.element( document.querySelector( '#sql' ) ).serialize(),  
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      }).success( function(res){         
          angular.element( document.querySelector( '.page-content .fade-in-up.ng-scope' ) ).html(res);
      });
   }
   
   submitExport = function(){
      angular.element( document.querySelector( '#sqlq' ) ).val(angular.element( document.querySelector( '#sql_textarea' ) ).val());
   }
    
    
    
      
});

