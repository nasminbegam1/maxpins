
MaxpinsApp.controller('emailTemplateController', function($rootScope, $scope, $http, $location, $timeout,$sce) {
    
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
    
    $scope.back = function(){
      $location.path('/email_template');
    }
    
    $scope.content_warning_msg = "Please don't delete anything within {{ }} and curly brackets";
      
    var emailTemplateMode = $location.$$path.replace('/email_template', '');
    
    if(emailTemplateMode == '')
    {
        $http({
                 url:'./email_template/listing',
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                 data:"start=0"
                 }).success( function(res){
                       $scope.templateList = res.data;
                       $scope.pagiLink = res.pagination_links;
                 });
        
    }
    else
    {
        var explodedEmailTemplateMode = emailTemplateMode.split("/");
        
        if(explodedEmailTemplateMode[1] == 'edit')
        {
            $http({
                 url:'./email_template/get_details/' + explodedEmailTemplateMode[2],
                 method:'post',
                 
                 headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                 }).success( function(res){ 
                        if (res.code == 1)
                        {
                              record                   = res.data;
                              $scope.template_id       = record.template_id;
                              $scope.template_name     = record.template_name;
                              $scope.response_email    = record.response_email;
                              $scope.email_subject     = record.email_subject;
                              $scope.email_content     = record.email_content;
                        }
                        else
                        {
                              alert('Record not found');
                              $location.path('/email_template');
                        }
                 });
            
            $scope.templateUpdate = function(){
            
            $http({
                    url:'./email_template/do_edit_template',
                    method:'post',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'},
                    data:"template_id="+$scope.template_id+"&template_name="+encodeURIComponent($scope.template_name)+"&response_email="+encodeURIComponent($scope.response_email)+"&email_subject="+encodeURIComponent($scope.email_subject)+"&email_content="+encodeURIComponent($scope.email_content)
                    }).success( function(res){
                          if (res.code > 0)
                          {
                                alert(res.msg);
                                $location.path('/email_template');
                          }
                          else
                          {
                                alert(res.msg);      
                          }
                    });
            }
        }
        
        else if(explodedEmailTemplateMode[1] == 'add')
        {
            $scope.templateAdd = function(){
                  
                $http({
                     url:'./email_template/do_add_template',
                     method:'post',
                     headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                     data:"template_id="+$scope.template_id+"&template_name="+$scope.template_name+"&response_email="+$scope.response_email+"&email_subject="+$scope.email_subject+"&email_content="+$scope.email_content
                        }).success( function(res){
                              if (res > 0)
                              {
                                    alert(res.msg);
                                    $location.path('/email_template');
                              }
                              else
                              {
                                    alert(res.msg);
                              }
                    });
            }
        }
        
        else if (explodedEmailTemplateMode[1]=='listing') {
             var page  = explodedEmailTemplateMode[2];
             $http({
                 url:'./email_template/listing/'+page,
                 method:'post',
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                 }).success( function(res){
                
                       $scope.templateList = res.data;
                       $scope.pagiLink = res.pagination_links;
                 });
             
        }
        
        
        
    }
    
    
    
    
      
});

