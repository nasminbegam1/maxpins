// 
// Here is how to define your module 
// has dependent on mobile-angular-ui
//
var baseUrl  = "";

var app = angular.module('maxpins', [
  
  'ngRoute',
  'mobile-angular-ui',
  'angular-flexslider',
  'ngDropdowns',
  
  // touch/drag feature: this is from 'mobile-angular-ui.gestures.js'
  // it is at a very beginning stage, so please be careful if you like to use
  // in production. This is intended to provide a flexible, integrated and and 
  // easy to use alternative to other 3rd party libs like hammer.js, with the
  // final pourpose to integrate gestures into default ui interactions like 
  // opening sidebars, turning switches on/off ..
  'mobile-angular-ui.gestures'
]);


app.factory('Global', function(){
   var keyword ='';
   var log = '';var cart = 0;var checkoutStatus=''; var page_title = 'Welcome to Maxpins'; var meta_keyword = ''; var meta_desc = '';
   return {
     log: function() { return log; },
     setLog: function(newLog) { log = newLog; },
     getCart:function(cartCount){cart =  cartCount;},
     cart:function(){return cart;},
     setcheckoutStatus:function(status){checkoutStatus =  status;},
     checkoutStatus:function(){return checkoutStatus},
     setPageTitle:function(ptitle){page_title = ptitle;},
     pageTitle:function(){return page_title;},
     setMetaKeyword:function(keyword){meta_keyword = keyword;},
     getMetaKeyword:function(){return meta_keyword;},
     setMetaDesc:function(desc){meta_desc = desc;},
     getMetaDesc:function(){return meta_desc;},
     setSearchKey: function(key){ keyword = key ; },
     getSearchKey: function(){ return keyword ; }
   };
 });



// 
// You can configure ngRoute as always, but to take advantage of SharedState location
// feature (i.e. close sidebar on backbutton) you should setup 'reloadOnSearch: false' 
// in order to avoid unwanted routing.
// 
app.config(function($routeProvider) {
   
  $routeProvider.when('/',              {templateUrl: baseUrl+"home/index_page",controller:"homeController", reloadOnSearch: false});
  
  $routeProvider.when('/login',
		      {templateUrl: './home/login',controller: 'loginController'}
		      );
  
  
  
  $routeProvider.when('/profile',
		      {templateUrl: './user/profile',controller: 'profileController'}
		      );
  
  $routeProvider.when('/forget_password',
		      {templateUrl: './user/forget_password',controller: 'forgetPasswordController'}
		      );
  
  $routeProvider.when('/registration',
		      {templateUrl: './home/signup',controller: 'signupController'}
		      );
  $routeProvider.when('/signupsuccess',
		      {templateUrl: './home/signupsuccess',controller: 'signupController'}
		      );
    $routeProvider.when('/verification/:verCode',
		      {
			templateUrl: function(params){ return './home/verification/' + params.verCode; },
			controller: 'verifyController'}
		      );
    
    $routeProvider.when('/dashboard',
		      {templateUrl: './home/dashboard',controller: 'dashboardController'}
		      );
    $routeProvider.when('/logout',
		      {templateUrl: './home/logout',resolve:{
			myvar:function($location){
			  $location.path('/login');
			}
			}}
		      );
  
  $routeProvider.when('/products',
		      {
			templateUrl: './product/listing',
			controller: 'productController'
		      });
  $routeProvider.when('/setreorder',
		      {
                        templateUrl: './product/setreorder',
			controller: 'cartController'
		      });
  
  
  $routeProvider.when('/products/:slug',
		      {
			templateUrl: function(params){ return './product/details/' + params.slug; },
			controller: 'productDetailsController'
		      });
  
   $routeProvider.when('/mycart',
		      {
			templateUrl: './product/cartDetails',
			controller: 'cartController'
		      });
   
   $routeProvider.when('/checkout',
		      {
			templateUrl: './product/checkout',
			controller: 'checkoutController'
		      });
   
   
  
  $routeProvider.when('/products/search/:key',
		      {
			templateUrl: './product/listing',
			controller: 'productController'
		      });
  
  $routeProvider.when('/page/:slug',
		      {
			templateUrl: function(params){ return './cms/details/' + params.slug; },
			controller: 'cmsDetailsController'
		      });
  
  $routeProvider.when('/page-not-found',
		      {
			templateUrl: './home/page_not_found',
			
		      });
    $routeProvider.when('/contact-us',      {templateUrl: function(params){ return './cms/details/contact-us' ; },
			controller: 'cmsDetailsController'});
    $routeProvider.when('/about-us',        {templateUrl: function(params){ return './cms/details/about-us' ; },
			controller: 'cmsDetailsController'});
    $routeProvider.when('/retail',        {templateUrl: function(params){ return './cms/details/retail' ; },
			controller: 'cmsDetailsController'});
    
   $routeProvider.when('/destinations',        {templateUrl: function(params){ return './cms/details/destinations' ; },
			controller: 'cmsDetailsController'});
   
   $routeProvider.when('/special-events',        {templateUrl: function(params){ return './cms/details/special-events' ; },
			controller: 'cmsDetailsController'});
   
   $routeProvider.when('/marketing',        {templateUrl: function(params){ return './cms/details/marketing' ; },
			controller: 'cmsDetailsController'});
   $routeProvider.when('/route-66',        {templateUrl: function(params){ return './cms/details/route-66' ; },
			controller: 'cmsDetailsController'});
   $routeProvider.when('/sitemap',        {templateUrl: function(params){ return './cms/details/sitemap' ; },
			controller: 'cmsDetailsController'});
  
  
  
   
  


  
  //$routeProvider.when('/ragistration',      {templateUrl: 'ragistration.html', reloadOnSearch: false});
  $routeProvider.when('/home-after-login',      {templateUrl: 'home-after-login.html', reloadOnSearch: false});
  $routeProvider.when('/product-details',      {templateUrl: 'product-details.html', reloadOnSearch: false});
  $routeProvider.when('/orders',
		      {
			templateUrl: './order/listing',
			controller: 'orderController'
		      });
  $routeProvider.when('/paymentprocess/:wid',
		      {
                        templateUrl: function(params){ return './payment/paymentprocess/' + params.wid; },
			
		      });
  $routeProvider.when('/paymentsuccess/:slug',
		      {
			templateUrl: function(params){ return './payment/success/' + params.slug; },
		      });
  
  
  
   $routeProvider.when('/orders/success/:slug',
		      {
			templateUrl: function(params){ return './payment/success/' + params.slug; },
		      });
   $routeProvider.when('/orders/:slug',
		      {
			templateUrl: function(params){ return './order/details/' + params.slug; },
			controller: 'orderDetailsController'
		      });
});


app.run( function($rootScope, $location,$window,$http,Global) {
    
     $rootScope.$on('$viewContentLoaded', function(event) {
      $window.ga('send', 'pageview', { page: $location.url() });
    });
     
    // register listener to watch route changes
    $rootScope.$on( "$routeChangeStart", function(event, next, current) {
        Global.setPageTitle('Welcome to Maxpins');
        $rootScope.pgTitle = Global.pageTitle();
        
        Global.setMetaKeyword('Welcome to Maxpins');
        $rootScope.meta_keywords = Global.getMetaKeyword();
        
        Global.setMetaDesc('Welcome to Maxpins');
        $rootScope.meta_descriptions = Global.getMetaDesc();
        
        $http({
	  url:"./home/loginCheck",
	  method:'get'
	  }).success(function(res){
		if(res=='0'){
		  Global.setLog('');
		  //$location.path('/login');
		}
		else if(res=='1'){
		  Global.setLog('1');
		  //$location.path('/login');
		}
	  });
        
        $http({
	  url:"./product/cartItemCount",
	  method:'get'
	  }).success(function(res){
         
		Global.getCart(res);
	  });
        
    });
 
 
 
 })



 app.filter('to_trusted', ['$sce', function($sce){
        return function(text) {
            return $sce.trustAsHtml(text);
        };
    }]);




//
// `$drag` example: drag to dismiss
//
app.directive('dragToDismiss', function($drag, $parse, $timeout){
  return {
    restrict: 'A',
    compile: function(elem, attrs) {
      var dismissFn = $parse(attrs.dragToDismiss);
      return function(scope, elem, attrs){
        var dismiss = false;

        $drag.bind(elem, {
          constraint: {
            minX: 0, 
            minY: 0, 
            maxY: 0 
          },
          move: function(c) {
            if( c.left >= c.width / 4) {
              dismiss = true;
              elem.addClass('dismiss');
            } else {
              dismiss = false;
              elem.removeClass('dismiss');
            }
          },
          cancel: function(){
            elem.removeClass('dismiss');
          },
          end: function(c, undo, reset) {
            if (dismiss) {
              elem.addClass('dismitted');
              $timeout(function() { 
                scope.$apply(function() {
                  dismissFn(scope);  
                });
              }, 400);
            } else {
              reset();
            }
          }
        });
      };
    }
  };
});

//
// Another `$drag` usage example: this is how you could create 
// a touch enabled "deck of cards" carousel. See `carousel.html` for markup.
//
app.directive('carousel', function(){
  return {
    restrict: 'C',
    scope: {},
    controller: function($scope) {
      this.itemCount = 0;
      this.activeItem = null;

      this.addItem = function(){
        var newId = this.itemCount++;
        this.activeItem = this.itemCount == 1 ? newId : this.activeItem;
        return newId;
      };

      this.next = function(){
        this.activeItem = this.activeItem || 0;
        this.activeItem = this.activeItem == this.itemCount - 1 ? 0 : this.activeItem + 1;
      };

      this.prev = function(){
        this.activeItem = this.activeItem || 0;
        this.activeItem = this.activeItem === 0 ? this.itemCount - 1 : this.activeItem - 1;
      };
    }
  };
});

app.directive('carouselItem', function($drag) {
  return {
    restrict: 'C',
    require: '^carousel',
    scope: {},
    transclude: true,
    template: '<div class="item"><div ng-transclude></div></div>',
    link: function(scope, elem, attrs, carousel) {
      scope.carousel = carousel;
      var id = carousel.addItem();
      
      var zIndex = function(){
        var res = 0;
        if (id == carousel.activeItem){
          res = 2000;
        } else if (carousel.activeItem < id) {
          res = 2000 - (id - carousel.activeItem);
        } else {
          res = 2000 - (carousel.itemCount - 1 - carousel.activeItem + id);
        }
        return res;
      };

      scope.$watch(function(){
        return carousel.activeItem;
      }, function(n, o){
        elem[0].style['z-index']=zIndex();
      });
      

      $drag.bind(elem, {
        constraint: { minY: 0, maxY: 0 },
        adaptTransform: function(t, dx, dy, x, y, x0, y0) {
          var maxAngle = 15;
          var velocity = 0.02;
          var r = t.getRotation();
          var newRot = r + Math.round(dx * velocity);
          newRot = Math.min(newRot, maxAngle);
          newRot = Math.max(newRot, -maxAngle);
          t.rotate(-r);
          t.rotate(newRot);
        },
        move: function(c){
          if(c.left >= c.width / 4 || c.left <= -(c.width / 4)) {
            elem.addClass('dismiss');  
          } else {
            elem.removeClass('dismiss');  
          }          
        },
        cancel: function(){
          elem.removeClass('dismiss');
        },
        end: function(c, undo, reset) {
          elem.removeClass('dismiss');
          if(c.left >= c.width / 4) {
            scope.$apply(function() {
              carousel.next();
            });
          } else if (c.left <= -(c.width / 4)) {
            scope.$apply(function() {
              carousel.next();
            });
          }
          reset();
        }
      });
    }
  };
});


//
// For this trivial demo we have just a unique MainController 
// for everything
//





app.controller('MainController', function($rootScope, $scope,Global){

  $scope.Global = Global;
  // User agent displayed in home page
  $scope.userAgent = navigator.userAgent;
  
  // Needed for the loading screen
  $rootScope.$on('$routeChangeStart', function(){
    $rootScope.loading = true;
  });

  $rootScope.$on('$routeChangeSuccess', function(){
    $rootScope.loading = false;
  });
  
  

  // Fake text i used here and there.
  $scope.lorem = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel explicabo, aliquid eaque soluta nihil eligendi adipisci error, illum corrupti nam fuga omnis quod quaerat mollitia expedita impedit dolores ipsam. Obcaecati.';

  // 
  // 'Scroll' screen
  // 
  var scrollItems = [];

  for (var i=1; i<=100; i++) {
    scrollItems.push('Item ' + i);
  }

  $scope.scrollItems = scrollItems;

  $scope.bottomReached = function() {
    alert('Congrats you scrolled to the end of the list!');
  }
  
  

  // 
  // Right Sidebar
  // 
  $scope.chatUsers = [
    { name: 'Carlos  Flowers', online: true },
    { name: 'Byron Taylor', online: true },
    { name: 'Jana  Terry', online: true },
    { name: 'Darryl  Stone', online: true },
    { name: 'Fannie  Carlson', online: true },
    { name: 'Holly Nguyen', online: true },
    { name: 'Bill  Chavez', online: true },
    { name: 'Veronica  Maxwell', online: true },
    { name: 'Jessica Webster', online: true },
    { name: 'Jackie  Barton', online: true },
    { name: 'Crystal Drake', online: false },
    { name: 'Milton  Dean', online: false },
    { name: 'Joann Johnston', online: false },
    { name: 'Cora  Vaughn', online: false },
    { name: 'Nina  Briggs', online: false },
    { name: 'Casey Turner', online: false },
    { name: 'Jimmie  Wilson', online: false },
    { name: 'Nathaniel Steele', online: false },
    { name: 'Aubrey  Cole', online: false },
    { name: 'Donnie  Summers', online: false },
    { name: 'Kate  Myers', online: false },
    { name: 'Priscilla Hawkins', online: false },
    { name: 'Joe Barker', online: false },
    { name: 'Lee Norman', online: false },
    { name: 'Ebony Rice', online: false }
  ];

  //
  // 'Forms' screen
  //  
  $scope.rememberMe = true;
  //$scope.email = 'me@example.com';
  
  $scope.login = function() {
    //alert('You submitted the login form');
  };
  
  
  
  $scope.registation = function() {
    alert('Write your validation script');
  };

  // 
  // 'Drag' screen
  // 
  $scope.notices = [];
  
  for (var j = 0; j < 10; j++) {
    $scope.notices.push({icon: 'envelope', message: 'Notice ' + (j + 1) });
  }

  $scope.deleteNotice = function(notice) {
    var index = $scope.notices.indexOf(notice);
    if (index > -1) {
      $scope.notices.splice(index, 1);
    }
  };
});

app.controller('homeController', function($rootScope, $scope) {
	
 $scope.productList = []; 
  for (var j = 1; j < 9; j++) {
	  img = 'images/product/pro-img-'+j+'.jpg'	
    $scope.productList.push({id: j, image: img });	
  }
});

app.controller('categoryController', function($rootScope, $scope) {
	
 $scope.categoryList = []; 
  for (var k = 1; k < 7; k++) {
	  img = 'images/category/cat-img-'+k+'.jpg'	
    $scope.categoryList.push({id: k, imagecat: img });	
  }
});

app.controller('catListController', function($rootScope, $scope) {
	
 $scope.categoryListMenu = []; 
 
  $scope.categoryListMenu.push({id: 1,text: 'Route 66'})
  $scope.categoryListMenu.push({id: 2,text: 'California'})
  $scope.categoryListMenu.push({id: 3,text: 'Arizona'})
  $scope.categoryListMenu.push({id: 4,text: 'New Mexico'})
  $scope.categoryListMenu.push({id: 5,text: 'Texas'})
  $scope.categoryListMenu.push({id: 6,text: 'Oklahoma'})
  $scope.categoryListMenu.push({id: 7,text: 'Kansas'})
  $scope.categoryListMenu.push({id: 8,text: 'Missouri'})
  $scope.categoryListMenu.push({id: 9,text: 'Illinois'})
  
 
  
  
});




app.controller('AppCtrl', function($scope) {
  
  $scope.ddMenuSelected2 = {};
  $scope.ddMenuOptions3 = [
   
    {
      text: 'My Profile',
      href: '#/profile'
    },
     {
      text: 'Activity',
      href: '#/orders'
    },
    {
      text: 'Logout',
      href: '#/logout'
    }
  ];

  $scope.ddMenuSelected3 = {};
});


app.controller('BasicSliderCtrl', function($http,$rootScope, $scope){
   
    $http({
          url       :'./home/getFeatureProductImage',
          method    :'post',
          headers   : {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                   
        }).success(function(res){
          $scope.slides = res.data;
        });
   
});







