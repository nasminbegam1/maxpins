<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js" data-ng-app="MaxpinsApp"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js" data-ng-app="MaxpinsApp"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" data-ng-app="MaxpinsApp">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<title data-ng-bind="'Maxpins Admin Panel | ' + $state.current.data.pageTitle"></title>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<script>
var base_url 	= '<?php echo base_url(); ?>';
var adminID	= '<?php echo $this->nsession->userdata('ADMIN_ID');?>'; 
</script>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADMIN_URL; ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADMIN_URL; ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADMIN_URL; ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADMIN_URL; ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN DYMANICLY LOADED CSS FILES(all plugin and page related styles must be loaded between GLOBAL and THEME css files ) -->
<link id="ng_load_plugins_before"/>
<!-- END DYMANICLY LOADED CSS FILES -->

<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_URL; ?>assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_URL; ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="<?php echo ADMIN_URL; ?>assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADMIN_URL; ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADMIN_URL; ?>assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADMIN_URL; ?>assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo ADMIN_URL; ?>assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADMIN_URL; ?>assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->

<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_URL; ?>css/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_URL; ?>css/bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_URL; ?>css/bootstrap-summernote/summernote.css">
<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_URL ;?>css/monthpicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_URL ;?>css/bootstrap/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_URL ;?>css/bootstrap/css/bootstrap-datetimepicker.min.css"/>

<link href="<?php echo ADMIN_URL ;?>css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADMIN_URL ;?>css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADMIN_URL ;?>css/layout.css" rel="stylesheet" type="text/css"/>

<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body ng-controller="AppController" class="page-on-load">
	<input type="hidden" id="order_field" value=""><input type="hidden" id="order_type" value="">
	<input type="hidden" id="product_order_field" value=""><input type="hidden" id="product_order_type" value="">
	<!-- BEGIN PAGE SPINNER -->
	<div ng-spinner-bar class="page-spinner-bar">
		<div class="bounce1"></div>
		<div class="bounce2"></div>
		<div class="bounce3"></div>
	</div>
	<!-- END PAGE SPINNER -->
	<!-- BEGIN HEADER -->
	<div class="page-header">
            <?=isset($content_for_layout_header)?$content_for_layout_header:'';?>
	</div>
	<!-- END HEADER -->

	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN PAGE HEAD -->
		<div class="page-head">
                    <?=isset($content_for_layout_topbar)?$content_for_layout_topbar:'';?>
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
	<div class="page-footer">
            <?=isset($content_for_layout_footer)?$content_for_layout_footer:'';?>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE JQUERY PLUGINS -->
	<!--[if lt IE 9]>
	<script src="<?php echo ADMIN_URL; ?>assets/global/plugins/respond.min.js"></script>
	<script src="<?php echo ADMIN_URL; ?>assets/global/plugins/excanvas.min.js"></script> 
	<![endif]-->
	<script src="<?php echo ADMIN_URL; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_URL; ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_URL; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_URL; ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_URL; ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_URL; ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_URL; ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_URL; ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
	<!-- END CORE JQUERY PLUGINS -->

	<!-- BEGIN CORE ANGULARJS PLUGINS -->	
	<script src="<?php echo ADMIN_URL; ?>assets/global/plugins/angularjs/angular.min.js" type="text/javascript"></script>	
	<script src="<?php echo ADMIN_URL; ?>assets/global/plugins/angularjs/angular-sanitize.min.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_URL; ?>assets/global/plugins/angularjs/angular-touch.min.js" type="text/javascript"></script>	
	<script src="<?php echo ADMIN_URL; ?>assets/global/plugins/angularjs/plugins/angular-ui-router.min.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_URL; ?>assets/global/plugins/angularjs/plugins/ocLazyLoad.min.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_URL; ?>assets/global/plugins/angularjs/plugins/ui-bootstrap-tpls.min.js" type="text/javascript"></script>
	
	<!-- BEGIN APP LEVEL ANGULARJS SCRIPTS -->
	  <script src='http://cdnjs.cloudflare.com/ajax/libs/textAngular/1.2.2/textAngular-sanitize.min.js'></script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/textAngular/1.2.2/textAngular.min.js'></script>
  <script src="http://code.angularjs.org/1.2.0-rc.3/angular-sanitize.min.js"></script>
  <script src="<?php echo ADMIN_URL; ?>js/angular-file-upload.js" type="text/javascript"></script>
  
  <script src="//cdn.ckeditor.com/4.4.7/full/ckeditor.js"></script>

	<script src="<?php echo ADMIN_URL; ?>js/app.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_URL; ?>js/directives.js" type="text/javascript"></script>
	<!-- END APP LEVEL ANGULARJS SCRIPTS -->
	
	<!-- END CORE ANGULARJS PLUGINS -->
      
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script type="text/javascript" src="<?php echo ADMIN_URL; ?>assets/global/plugins/select2/select2.min.js"></script>
	
	<script type="text/javascript" src="<?php echo ADMIN_URL; ?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo ADMIN_URL; ?>assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
	
	<script type="text/javascript" src="<?php echo ADMIN_URL; ?>assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_URL; ?>assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>

	<script type="text/javascript" src="<?php echo ADMIN_URL; ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->

	
	<!-- BEGIN APP LEVEL JQUERY SCRIPTS -->
	<script src="<?php echo ADMIN_URL; ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_URL; ?>assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_URL; ?>assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_URL; ?>assets/admin/pages/scripts/table-managed.js" type="text/javascript"></script>
	<!-- END APP LEVEL JQUERY SCRIPTS -->

	<script type="text/javascript" src="<?php echo ADMIN_URL; ?>js/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
	<script type="text/javascript" src="<?php echo ADMIN_URL; ?>js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
	<script src="<?php echo ADMIN_URL; ?>js/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_URL; ?>js/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_URL; ?>js/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
	

	
	
	
	<script type="text/javascript">
		/* Init Metronic's core jquery plugins and layout scripts */
		$(document).ready(function() {   
			Metronic.init(); // Run metronic theme
			Layout.init(); // init layout
			Metronic.setAssetsPath('assets/'); // Set the assets folder path
			TableManaged.init();
			 
		});
	</script>
	<!-- END JAVASCRIPTS -->
	
	
</body>
<!-- END BODY -->
</html>