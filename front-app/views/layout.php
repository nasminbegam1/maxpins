<!DOCTYPE html>
<html ng-app="maxpins" ng-controller="MainController">
<head>
<meta charset="utf-8" />
<title>{{pgTitle}}</title>
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
<meta name="keywords" content="{{meta_keywords}}" />
<meta name="description" content="{{meta_descriptions}}" />

<link rel="stylesheet" href="<?php echo FRONTEND_URL; ?>css/style.css" />
<link rel="stylesheet" href="<?php echo FRONTEND_URL; ?>css/font-awesome.css" />
<link rel="stylesheet" href="<?php echo FRONTEND_URL; ?>css/flexslider.css" />



</head>
<body>
<div class="wrapper">
	<div class="container"> 		
		<div  class="headerTop">
			<?=isset($content_for_layout_header)?$content_for_layout_header:'';?>
		</div>
		<div  class="navigation">
			<?=isset($content_for_layout_topbar)?$content_for_layout_topbar:'';?>
		</div>
		<div class="contentPan">
			<div class="loading" ><!--ng-class="{loading: loading}"-->
			<div ng-show="loading" class="app-content-loading">
				<i class="fa fa-spinner fa-spin loading-spinner"></i>
		        </div>
			<ng-view></ng-view>
			</div>
		</div>		
		<div  class="footer">
			<?=isset($content_for_layout_footer)?$content_for_layout_footer:'';?>
		</div>
	</div>
</div>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> 
<script src="<?php echo FRONTEND_URL; ?>js/jquery.flexslider.js"></script>

<script src="<?php echo FRONTEND_URL; ?>js/angular.min.js"></script>
<script src="<?php echo FRONTEND_URL; ?>js/angular-flexslider.js"></script>
<script src="<?php echo FRONTEND_URL; ?>js/app.js"></script>
<script src="<?php echo FRONTEND_URL; ?>js/controllers.js"></script>
<script src="<?php echo FRONTEND_URL; ?>js/controllers2.js"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63865513-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
