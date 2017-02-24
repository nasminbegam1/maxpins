<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.1
Version: 3.6.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js" data-ng-app="MetronicApp"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js" data-ng-app="MetronicApp"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" data-ng-app="MetronicApp">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<title data-ng-bind="'Metronic AngularJS | ' + $state.current.data.pageTitle"></title>

<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<script>
var base_url = 'http://192.168.2.5/travel/agent/';
//var base_url = 'http://codeigniter-development.com/travel/angularjs/';
</script>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_URL; ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_URL; ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_URL; ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_URL; ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN DYMANICLY LOADED CSS FILES(all plugin and page related styles must be loaded between GLOBAL and THEME css files ) -->
<link id="ng_load_plugins_before"/>
<!-- END DYMANICLY LOADED CSS FILES -->

<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="<?php echo AGENT_URL; ?>assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_URL; ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_URL; ?>assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_URL; ?>assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo AGENT_URL; ?>assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo AGENT_URL; ?>assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->

<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body ng-controller="AppController" class="page-on-load">

	<!-- BEGIN PAGE SPINNER -->
	<div ng-spinner-bar class="page-spinner-bar">
		<div class="bounce1"></div>
		<div class="bounce2"></div>
		<div class="bounce3"></div>
	</div>
	<!-- END PAGE SPINNER -->

	<!-- BEGIN HEADER -->
	<div data-ng-include="'<?php echo AGENT_URL; ?>header'" data-ng-controller="HeaderController" class="page-header">
	</div>
	<!-- END HEADER -->

	<div class="clearfix">
	</div>

	<!-- BEGIN CONTAINER -->
	<div class="page-container">

		<!-- BEGIN PAGE HEAD -->
		<div data-ng-include="'tpl/page-head.html'" data-ng-controller="PageHeadController" class="page-head">			
		</div>
		<!-- END PAGE HEAD -->
		
		<!-- BEGIN PAGE CONTENT -->
		<div class="page-content">
			<div class="container">
				<!-- BEGIN ACTUAL CONTENT -->
				<div ui-view class="fade-in-up">
				</div> 
				<!-- END ACTUAL CONTENT -->
			</div>
		</div>
		<!-- END PAGE CONTENT -->

	</div>
	<!-- END CONTAINER -->

	<!-- BEGIN FOOTER -->
	<div data-ng-include="'tpl/footer.html'" data-ng-controller="FooterController" class="page-footer">
	</div>
	<!-- END FOOTER -->

	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

	<!-- BEGIN CORE JQUERY PLUGINS -->
	<!--[if lt IE 9]>
	<script src="<?php echo AGENT_URL; ?>assets/global/plugins/respond.min.js"></script>
	<script src="<?php echo AGENT_URL; ?>assets/global/plugins/excanvas.min.js"></script> 
	<![endif]-->
	<script src="<?php echo AGENT_URL; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo AGENT_URL; ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
	<script src="<?php echo AGENT_URL; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo AGENT_URL; ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="<?php echo AGENT_URL; ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo AGENT_URL; ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<?php echo AGENT_URL; ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
	<script src="<?php echo AGENT_URL; ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
	<!-- END CORE JQUERY PLUGINS -->

	<!-- BEGIN CORE ANGULARJS PLUGINS -->	
	<script src="<?php echo AGENT_URL; ?>assets/global/plugins/angularjs/angular.min.js" type="text/javascript"></script>	
	<script src="<?php echo AGENT_URL; ?>assets/global/plugins/angularjs/angular-sanitize.min.js" type="text/javascript"></script>
	<script src="<?php echo AGENT_URL; ?>assets/global/plugins/angularjs/angular-touch.min.js" type="text/javascript"></script>	
	<script src="<?php echo AGENT_URL; ?>assets/global/plugins/angularjs/plugins/angular-ui-router.min.js" type="text/javascript"></script>
	<script src="<?php echo AGENT_URL; ?>assets/global/plugins/angularjs/plugins/ocLazyLoad.min.js" type="text/javascript"></script>
	<script src="<?php echo AGENT_URL; ?>assets/global/plugins/angularjs/plugins/ui-bootstrap-tpls.min.js" type="text/javascript"></script>
	
	<script src="https://cdn.firebase.com/js/client/2.2.1/firebase.js"></script>
	<script src="https://cdn.firebase.com/libs/angularfire/1.0.0/angularfire.min.js"></script>
	<!-- END CORE ANGULARJS PLUGINS -->
	
	<!-- BEGIN APP LEVEL ANGULARJS SCRIPTS -->
	<script src="<?php echo AGENT_URL; ?>js/app.js" type="text/javascript"></script>
	<script src="<?php echo AGENT_URL; ?>js/directives.js" type="text/javascript"></script>
	<!-- END APP LEVEL ANGULARJS SCRIPTS -->
	
       <script src="//static.opentok.com/webrtc/v2.2/js/opentok.min.js"></script>
    

	<!-- BEGIN APP LEVEL JQUERY SCRIPTS -->
	<script src="<?php echo AGENT_URL; ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
	<script src="<?php echo AGENT_URL; ?>assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
	<script src="<?php echo AGENT_URL; ?>assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>  
	<!-- END APP LEVEL JQUERY SCRIPTS -->

	<script type="text/javascript">
		/* Init Metronic's core jquery plugins and layout scripts */
		$(document).ready(function() {   
			Metronic.init(); // Run metronic theme
			Metronic.setAssetsPath('assets/'); // Set the assets folder path			
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>