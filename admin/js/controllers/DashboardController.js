
MaxpinsApp.controller('DashboardController', function($rootScope, $scope, $http, $location, $timeout) {
    
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
            url:'./home/get_dashboard_data',
            method:'post'
            }).success( function(res){
        //console.log(res);
                $rootScope.admin_name       = '';
                $scope.totalProduct         = res.total_product;
                $scope.totalWholesaler      = res.total_wholesaler;
                $scope.total_visitor        = res.analytics.total_users;
                $scope.total_page_views     = res.analytics.total_page_views_per_session;
                $scope.avg_session_duration = res.analytics.total_avg_session_duration;
                $scope.bounce_rate          = res.analytics.total_bounce_rate;
                $scope.new_order            = res.new_order;
                $rootScope.admin_name       = res.admin_name;
                
            });
    $scope.goToOrder = function(){
        $http({
                 url:'./order/setAdminOrder',
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 }).success( function(res){
            var folder = '/maxpins';
            //var folder = '';
            var url = "http://"+document.location.host+folder+"/#/products";
             window.location.href =url; 
            });
     }
   
      
});




