
"use strict";
/***
Metronic AngularJS App Main Script
***/

/* Metronic App */
var dbUrl   = 'https://wdcmap.firebaseio.com';
var baseUrl = '/maxpins/admin/';

var MaxpinsApp = angular.module("MaxpinsApp", [
    "ui.router", 
    "ui.bootstrap", 
    "oc.lazyLoad",  
    "ngSanitize",
    "textAngular",
    "angularFileUpload"
]);

 MaxpinsApp.filter('to_trusted', ['$sce', function($sce){
        return function(text) {
            return $sce.trustAsHtml(text);
        };
    }]);

function wysiwygeditor($scope) {
            $scope.orightml = '';
            $scope.htmlcontent = $scope.orightml;
            $scope.disabled = false;

////
// Masquerade perfers the scope value over the innerHTML
// Uncomment this line to see the effect:
// $scope.htmlcontenttwo = "Override originalContents";
    };

/* Configure ocLazyLoader(refer: https://github.com/ocombe/ocLazyLoad) */
MaxpinsApp.config(['$ocLazyLoadProvider', function($ocLazyLoadProvider) {
    $ocLazyLoadProvider.config({
        cssFilesInsertBefore: 'ng_load_plugins_before' // load the above css files before a LINK element with this ID. Dynamic CSS files must be loaded between core and theme css files
    });
}]);

/* Setup global settings */
MaxpinsApp.factory('settings', ['$rootScope', function($rootScope) {
    // supported languages
    var settings = {
        layout: {
            pageAutoScrollOnLoad: 1000 // auto scroll to top on page load
        },
        layoutImgPath: Metronic.getAssetsPath() + 'admin/layout/img/',
        layoutCssPath: Metronic.getAssetsPath() + 'admin/layout/css/'
    };

    $rootScope.settings = settings;

    return settings;
}]);

MaxpinsApp.factory('searchKey',  function($rootScope) {
    // supported languages
    var key ='',type='';
return {
            key: function(){return key;},
            setKey: function(newKey){key = newKey;},
            type: function(){return type;},
            setType: function(newtype){type = newtype;}
}
   
});

/* Setup App Main Controller */
MaxpinsApp.controller('AppController', ['$scope',  function($scope) {
    $scope.$on('$viewContentLoaded', function() {
        Metronic.initComponents(); // init core components
        //Layout.init(); //  Init entire layout(header, footer, sidebar, etc) on page load if the partials included in server side instead of loading with ng-include directive 
    });
    
   
    
}]);


/* Setup Rounting For All Pages */
MaxpinsApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {

    // Redirect any unmatched url
    $urlRouterProvider.otherwise("/login");

    $stateProvider

        // Dashboard
        .state('dashboard', { 
            url: "/dashboard",
            templateUrl: baseUrl+"home/dashboard",            
            data: {pageTitle: 'Dashboard', pageSubTitle: 'statistics & reports'},
            controller: "DashboardController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'MaxpinsApp',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'assets/global/plugins/morris/morris.css',
                            'assets/admin/pages/css/tasks.css',
                            
                            'assets/global/plugins/morris/morris.min.js',
                            'assets/global/plugins/morris/raphael-min.js',
                            'assets/global/plugins/jquery.sparkline.min.js',

                            'assets/admin/pages/scripts/index3.js',
                            'assets/admin/pages/scripts/tasks.js',

                             'js/controllers/DashboardController.js',
                               
                        ] 
                    });
                }]
            }
            
        })


        
        //login
        .state('login', {
            url: "/login",
            templateUrl: baseUrl+"home/login",
            data: {pageTitle: 'Admin Login', pageSubTitle: 'Maxpins Admin Login'},
            controller: "loginController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/loginController.js',
                              
                        ]                    
                    });
                }]
            }
        })
        
        //logout
        .state('logout', {
            url: "/logout",
            templateUrl: baseUrl+"home/logout",
            data: {pageTitle: 'Logout', pageSubTitle: ''},
            controller: "logoutController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/logoutController.js',
                              
                        ]                    
                    });
                }]
            }
        })
        
        //profile
        .state('profile', {
            url: "/profile",
            templateUrl: baseUrl+"home/profile",
            data: {pageTitle: 'My Profile', pageSubTitle: ''},
            controller: "profileController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/profileController.js',
                              
                        ]                    
                    });
                }]
            }
        })
        
         .state('settings', {
            
            url: "/settings",
            templateUrl: baseUrl+"settings/index",
            data: {pageTitle: 'Site Settings', pageSubTitle: ''},
            controller: "settingsController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/settingsController.js',
                           
                        ]                    
                    });
                }]
            }
            
        })
         
         .state('settings/list', {
            
            url: "/settings/listing/:page",
            templateUrl: function(urlattr){
                
                return baseUrl+"settings/index/" + urlattr.page;
            },
            data: {pageTitle: 'Site Settings', pageSubTitle: ''},
            controller: "settingsController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/settingsController.js',
                           
                        ]                    
                    });
                }]
            }
            
        })
         
         .state('settings/edit', {
            
            url: "/settings/edit/:pId",
            templateUrl: function(urlattr){
                
                return baseUrl+"settings/edit/" + urlattr.pId;
            },
            data: {pageTitle: 'Site Settings Edit', pageSubTitle: ''},
            controller: "settingsController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/settingsController.js',
                           
                        ]                    
                    });
                }]
            }
            
        }) 
        //cms
        .state('cms', {
            
            url: "/cms",
            templateUrl: baseUrl+"cms/index",
            data: {pageTitle: 'CMS Pages', pageSubTitle: ''},
            controller: "cmsController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/cmsController.js',
                           
                        ]                    
                    });
                }]
            }
            
        })
        
        
         .state('cms/listing', {
            
            url: "/cms/listing/:page",
            templateUrl: function(urlattr){
                
                return baseUrl+"cms/index/" + urlattr.page;
            },
            data: {pageTitle: 'CMS Pages', pageSubTitle: ''},
            controller: "cmsController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/cmsController.js',
                            
                        ]                    
                    });
                }]
            }
            
        })

        
        //cms edit
        .state('cms/edit', {
            
            url: "/cms/edit/:cmsid",
            templateUrl: function(urlattr){
                return baseUrl+"cms/edit/" + urlattr.cmsid;
            },
            data: {pageTitle: 'CMS Edit', pageSubTitle: ''},
            controller: "cmsController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/cmsController.js',
                          
                        ]                    
                    });
                }]
            }
            
        })
        
        //cms add
        .state('cms/add', {
            
            url: "/cms/add",
            templateUrl: function(){
                return baseUrl+"cms/add_cms";
            },
            data: {pageTitle: 'CMS Add', pageSubTitle: ''},
            controller: "cmsController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/cmsController.js',
                             
                        ]                    
                    });
                }]
            }
            
        })
        
        
        //wholesaler
        .state('wholesaler', {
            
            url: "/wholesaler",
            templateUrl: baseUrl+"wholesaler/index",
            data: {pageTitle: 'Wholesaler Pages', pageSubTitle: ''},
            controller: "wholesalerController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/wholesalerController.js',
                           
                        ]                    
                    });
                }]
            }
            
        })
        
        // wholesaler list
        .state('wholesaler/listing', {
            
            url: "/wholesaler/listing/:page",
            templateUrl: function(urlattr){
                
                return baseUrl+"wholesaler/index/" + urlattr.page;
            },
            data: {pageTitle: 'Wholesaler Pages', pageSubTitle: ''},
            controller: "wholesalerController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/wholesalerController.js',
                            
                        ]                    
                    });
                }]
            }
            
        })

        
        //wholesaler edit
        .state('wholesaler/edit', {
            
            url: "/wholesaler/edit/:wholesalerid",
            templateUrl: function(urlattr){
                return baseUrl+"wholesaler/edit/" + urlattr.wholesalerid;
            },
            data: {pageTitle: 'Wholesaler Edit', pageSubTitle: ''},
            controller: "wholesalerController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/wholesalerController.js',
                           
                        ]                    
                    });
                }]
            }
            
        })
        
        //wholesaler add
        .state('wholesaler/add', {
            
            url: "/wholesaler/add",
            templateUrl: function(){
                return baseUrl+"wholesaler/add_wholesaler";
            },
            data: {pageTitle: 'Wholesaler Add', pageSubTitle: ''},
            controller: "wholesalerController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/wholesalerController.js',
                              
                        ]                    
                    });
                }]
            }
            
        })
        
        //products
        .state('products', {
            
            url: "/products",
            templateUrl: baseUrl+"products/index",
            data: {pageTitle: 'Products', pageSubTitle: ''},
            controller: "productController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/productController.js',
                              
                        ]                    
                    });
                }]
            }
            
        })
        
        .state('products/listing', {
            
           url: "/products/listing/:page",
             templateUrl: function(urlattr){
                
                return baseUrl+"products/index/" + urlattr.page;
            },
            
            data: {pageTitle: 'Products', pageSubTitle: ''},
            controller: "productController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/productController.js',
                              
                        ]                    
                    });
                }]
            }
            
        })
        
        
        
        
        .state('products/add', {
            
            url: "/products/add",
            templateUrl: function(){
                return baseUrl+"products/add_product";
            },
            data: {pageTitle: 'Product', pageSubTitle: 'Add'},
            controller: "productController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/productController.js',
                              
                        ]                    
                    });
                }]
            }
            
        })
        
        .state('products/edit', {
            
            url: "/products/edit/:productid",
            templateUrl: function(urlattr){
                return baseUrl+"products/edit/" + urlattr.productid;
            },
            data: {pageTitle: 'Product Edit', pageSubTitle: ''},
            controller: "productController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            
                            'js/controllers/productController.js',
                              
                        ]                    
                    });
                }]
            }
            
        })
        
        .state('products/images', {
            
            url: "/products/images/:productid",
            templateUrl: function(urlattr){
                return baseUrl+"products/images/" + urlattr.productid;
            },
            data: {pageTitle: 'Product Images', pageSubTitle: ''},
            controller: "productController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            
                            'js/controllers/productController.js',
                              
                        ]                    
                    });
                }]
            }
            
        })
        
        .state('products/delete', {
            
            url: "/products/delete/:productid",
            //templateUrl: function(urlattr){
            //    return baseUrl+"products/delete/" + urlattr.productid;
            //},
            data: {pageTitle: 'Product delete', pageSubTitle: ''},
            controller: "productController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/productController.js',
                              
                        ]                    
                    });
                }]
            }
            
        })
        
        //category
        .state('category', {
            
            url: "/category",
            templateUrl: baseUrl+"category/index",
            data: {pageTitle: 'Category', pageSubTitle: ''},
            controller: "categoryController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/categoryController.js',
                              
                        ]                    
                    });
                }]
            }
            
        })
        
        
        .state('category/listing', {
            
            url: "/category/listing/:page",
            templateUrl: function(urlattr){
                
                return baseUrl+"category/index/" + urlattr.page;
            },
            data: {pageTitle: 'Category Management', pageSubTitle: ''},
            controller: "categoryController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/categoryController.js',
                            
                        ]                    
                    });
                }]
            }
        })
        
        .state('category/edit', {
            
            url: "/category/edit/:categoryid",
            templateUrl: function(urlattr){
                return baseUrl+"category/edit/" + urlattr.categoryid;
            },
            data: {pageTitle: 'Category Edit', pageSubTitle: ''},
            controller: "categoryController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            
                            'js/controllers/categoryController.js',
                              
                        ]                    
                    });
                }]
            }
            
        })
        
        .state('category/add', {
            
            url: "/category/add",
            templateUrl: function(){
                return baseUrl+"category/add/";
            },
            data: {pageTitle: 'Category Add', pageSubTitle: ''},
            controller: "categoryController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            
                            'js/controllers/categoryController.js',
                              
                        ]                    
                    });
                }]
            }
            
        })
        
        
        
        //producttype 
         .state('producttype', {
            
            url: "/producttype",
            templateUrl: baseUrl+"producttype/index",
            data: {pageTitle: 'Product Type', pageSubTitle: ''},
            controller: "producttypeController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/producttypeController.js',
                              
                        ]                    
                    });
                }]
            }
            
        })
        
        
        .state('producttype/listing', {
            
            url: "/producttype/listing/:page",
            templateUrl: function(urlattr){
                
                return baseUrl+"producttype/index/" + urlattr.page;
            },
            data: {pageTitle: 'Product Type Management', pageSubTitle: ''},
            controller: "producttypeController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/producttypeController.js',
                            
                        ]                    
                    });
                }]
            }
        })
        
        .state('producttype/edit', {
            
            url: "/producttype/edit/:producttypeid",
            templateUrl: function(urlattr){
                return baseUrl+"producttype/edit/" + urlattr.producttypeid;
            },
            data: {pageTitle: 'Product Type Edit', pageSubTitle: ''},
            controller: "producttypeController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            
                            'js/controllers/producttypeController.js',
                              
                        ]                    
                    });
                }]
            }
            
        })
        
        .state('producttype/add', {
            
            url: "/producttype/add",
            templateUrl: function(){
                return baseUrl+"producttype/add/";
            },
            data: {pageTitle: 'Product Type Add', pageSubTitle: ''},
            controller: "producttypeController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            
                            'js/controllers/producttypeController.js',
                              
                        ]                    
                    });
                }]
            }
            
        })
        
        //Email Template
        .state('email_template', {
            
            url: "/email_template",
            templateUrl: baseUrl+"email_template/index",
            data: {pageTitle: 'Email Template', pageSubTitle: ''},
            controller: "emailTemplateController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/emailTemplateController.js',
                              
                        ]                    
                    });
                }]
            }
            
        })
        
        .state('email_template/listing', {
            
            url: "/email_template/listing/:page",
            templateUrl: function(urlattr){
                
                return baseUrl+"email_template/index/" + urlattr.page;
            },
            data: {pageTitle: 'Email Template', pageSubTitle: ''},
            controller: "emailTemplateController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/emailTemplateController.js',
                            
                        ]                    
                    });
                }]
            }
        })
        
        .state('email_template/edit', {
            
            url: "/email_template/edit/:email_template_id",
            templateUrl: function(urlattr){
                return baseUrl+"email_template/edit/" + urlattr.email_template_id;
            },
            data: {pageTitle: 'Email Template Edit', pageSubTitle: ''},
            controller: "emailTemplateController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            
                            'js/controllers/emailTemplateController.js',
                              
                        ]                    
                    });
                }]
            }
            
        })
        
        
        .state('email_template/add', {
            
            url: "/email_template/add",
            templateUrl: function(){
                return baseUrl+"email_template/add/";
            },
            data: {pageTitle: 'Email Template Add', pageSubTitle: ''},
            controller: "emailTemplateController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            
                            'js/controllers/emailTemplateController.js',
                              
                        ]                    
                    });
                }]
            }
            
        })
        
        //Order
        .state('order', {
            
            url: "/order",
            templateUrl: baseUrl+"order/index",
            data: {pageTitle: 'Order Management', pageSubTitle: ''},
            controller: "orderController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/orderController.js',
                              
                        ]                    
                    });
                }]
            }
        })
        
        .state('order/listing', {
            
            url: "/order/listing/:page",
            templateUrl: function(urlattr){
                
                return baseUrl+"order/index/" + urlattr.page;
            },
            data: {pageTitle: 'Order Management', pageSubTitle: ''},
            controller: "orderController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/orderController.js',
                            
                        ]                    
                    });
                }]
            }
        })
        
        .state('order/view', {
            
             url: "/order/view/:order_id",
            templateUrl: function(urlattr){
                return baseUrl+"order/view/" + urlattr.order_id;
            },
            data: {pageTitle: 'View Order', pageSubTitle: ''},
            controller: "orderController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            
                            'js/controllers/orderController.js',
                              
                        ]                    
                    });
                }]
            }
            
        }) 
        
        .state('order/add', {
            
            url: "/order/add",
            templateUrl: function(){
                return baseUrl+"order/add/";
            },
            data: {pageTitle: 'Order Add', pageSubTitle: ''},
            controller: "orderController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            
                            'js/controllers/orderController.js',
                              
                        ]                    
                    });
                }]
            }
            
        })
        
        .state('order/paymentprocess', {
            
            url: "/order/paymentprocess",
            templateUrl: function(){
                
                return baseUrl+"order/paymentprocess/";
            },
            data: {pageTitle: 'Order Management', pageSubTitle: ''},
            controller: "orderController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/orderController.js',
                            
                        ]                    
                    });
                }]
            }
        })
        
        // Shipping Methods
        .state('shipping_methods', {
            
            url: "/shipping_methods",
            templateUrl: baseUrl+"shipping_methods/index",
            data: {pageTitle: 'Shipping Methods', pageSubTitle: ''},
            controller: "shippingMethodController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [                            
                            'js/controllers/shippingMethodController.js'                              
                        ]                    
                    });
                }]
            }
            
        })
        
        .state('shipping_methods/add', {
    
            url: "/shipping_methods/add",
            templateUrl: function(){
                return baseUrl+"shipping_methods/add/";
            },
            data: {pageTitle: 'Shipping Method Add', pageSubTitle: ''},
            controller: "shippingMethodController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            
                            'js/controllers/shippingMethodController.js',
                              
                        ]                    
                    });
                }]
            }
            
         })
        
        
         .state('shipping_methods/edit', {    
                        url: "/shipping_methods/edit/:method_id",
                        templateUrl: function(urlattr){
                            return baseUrl+"shipping_methods/edit/" + urlattr.method_id;
                        },
                        data: {pageTitle: 'Shipping Method Edit', pageSubTitle: ''},
                        controller: "shippingMethodController",
                        resolve: {
                            deps: ['$ocLazyLoad', function($ocLazyLoad) {
                                return $ocLazyLoad.load({ 
                                    name: 'MaxpinsApp',  
                                    insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                                    files: [
                                        
                                        'js/controllers/shippingMethodController.js',
                                          
                                    ]                    
                                });
                            }]
                        }
                        
            })
         
        
        .state('shipping_methods/listing', {
            
            url: "/shipping_methods/listing/:page",
            templateUrl: function(urlattr){
                
                return baseUrl+"shipping_methods/index/" + urlattr.page;
            },
            data: {pageTitle: 'Shipping Methods', pageSubTitle: ''},
            controller: "shippingMethodController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'js/controllers/shippingMethodController.js',
                            
                        ]                    
                    });
                }]
            }
            
        })
        
        .state('phpmyadmin', {
            
            url: "/phpmyadmin",
            templateUrl: baseUrl+"phpmyadmin/index.php",
            data: {pageTitle: 'PHPmyadmin', pageSubTitle: 'SQLquery'},
            controller: "phpmyadminController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({ 
                        name: 'MaxpinsApp',  
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [                            
                            'js/controllers/phpmyadminController.js'                              
                        ]                    
                    });
                }]
            }
            
        })
        
   

}]);

/* Init global settings and run the app */
MaxpinsApp.run(["$rootScope", "settings", "$state", function($rootScope, settings, $state) {
    $rootScope.$state = $state; // state to be accessed from view
}]);


MaxpinsApp.filter('stripslash', function(){
return function(input, symbol, place){
            if(isNaN(input)){
              return input;
            } else {
                        input=input.replace(/\\'/g,'\'');
                        input=input.replace(/\\"/g,'"');
                        input=input.replace(/\\0/g,'\0');
                        input=input.replace(/\\\\/g,'\\');
                        return input;
            }
}
});