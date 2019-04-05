<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="<?php echo config_item('charset')?>">
	<title><?php echo config_item('admin_title');?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Hire Vee">
	<meta http-equiv="keywords" content="hire vee, hire, vee, interview, employee, recruiter">
	
	<link id="bs-css" href="<?php echo config_item('admin_css_url').'bootstrap-cerulean.css'?>" rel="stylesheet">
	<link href="<?php echo config_item('admin_css_url').'bootstrap-responsive.css'?>" rel="stylesheet">
	<link href="<?php echo config_item('admin_css_url').'jquery-ui-1.8.21.custom.css'?>" rel="stylesheet">
	<link href="<?php echo config_item('admin_css_url').'fullcalendar.css'?>" rel="stylesheet">
	<link href="<?php echo config_item('admin_css_url').'fullcalendar.print.css'?>" rel="stylesheet" media='print'>
	<link href="<?php echo config_item('admin_css_url').'chosen.css'?>" rel="stylesheet">
	<link href="<?php echo config_item('admin_css_url').'uniform.default.css'?>" rel="stylesheet">
	<link href="<?php echo config_item('admin_css_url').'colorbox.css'?>" rel="stylesheet">
	<link href="<?php echo config_item('admin_css_url').'jquery.cleditor.css'?>" rel="stylesheet">
	<link href="<?php echo config_item('admin_css_url').'jquery.noty.css'?>" rel="stylesheet">
	<link href="<?php echo config_item('admin_css_url').'noty_theme_default.css'?>" rel="stylesheet">
	<link href="<?php echo config_item('admin_css_url').'elfinder.min.css'?>" rel="stylesheet">
	<link href="<?php echo config_item('admin_css_url').'elfinder.theme.css'?>" rel="stylesheet">
	<link href="<?php echo config_item('admin_css_url').'jquery.iphone.toggle.css'?>" rel="stylesheet">
	<link href="<?php echo config_item('admin_css_url').'opa-icons.css'?>" rel="stylesheet">
	<link href="<?php echo config_item('admin_css_url').'uploadify.css'?>" rel="stylesheet">
	<link href="<?php echo config_item('admin_css_url').'hirevee-app.css'?>" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- jQuery -->
	<script src="<?php echo config_item('admin_js_url').'jquery-1.7.2.min.js';?>"></script>
	<!-- jQuery UI -->
	<script src="<?php echo config_item('admin_js_url').'jquery-ui-1.8.21.custom.min.js';?>"></script>
	<!-- transition / effect library -->
	<script src="<?php echo config_item('admin_js_url').'bootstrap-transition.js';?>"></script>
	<!-- alert enhancer library -->
	<script src="<?php echo config_item('admin_js_url').'bootstrap-alert.js';?>"></script>
	<!-- modal / dialog library -->
	<script src="<?php echo config_item('admin_js_url').'bootstrap-modal.js';?>"></script>
	<!-- custom dropdown library -->
	<script src="<?php echo config_item('admin_js_url').'bootstrap-dropdown.js';?>"></script>
	<!-- scrolspy library -->
	<script src="<?php echo config_item('admin_js_url').'bootstrap-scrollspy.js';?>"></script>
	<!-- library for creating tabs -->
	<script src="<?php echo config_item('admin_js_url').'bootstrap-tab.js';?>"></script>
	<!-- library for advanced tooltip -->
	<script src="<?php echo config_item('admin_js_url').'bootstrap-tooltip.js';?>"></script>
	<!-- popover effect library -->
	<script src="<?php echo config_item('admin_js_url').'bootstrap-popover.js';?>"></script>
	<!-- button enhancer library -->
	<script src="<?php echo config_item('admin_js_url').'bootstrap-button.js';?>"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="<?php echo config_item('admin_js_url').'bootstrap-collapse.js';?>"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="<?php echo config_item('admin_js_url').'bootstrap-carousel.js';?>"></script>
	<!-- autocomplete library -->
	<script src="<?php echo config_item('admin_js_url').'bootstrap-typeahead.js';?>"></script>
	<!-- tour library -->
	<script src="<?php echo config_item('admin_js_url').'bootstrap-tour.js';?>"></script>
	<!-- library for cookie management -->
	<script src="<?php echo config_item('admin_js_url').'jquery.cookie.js';?>"></script>
	<!-- calander plugin -->
	<script src="<?php echo config_item('admin_js_url').'fullcalendar.min.js';?>"></script>
	<!-- data table plugin -->
<!--	<script src="<?php echo config_item('admin_js_url').'jquery.dataTables.min.js';?>"></script>-->

	<!-- chart libraries start -->
	<script src="<?php echo config_item('admin_js_url').'excanvas.js';?>"></script>
	<script src="<?php echo config_item('admin_js_url').'jquery.flot.min.js';?>"></script>
	<script src="<?php echo config_item('admin_js_url').'jquery.flot.pie.min.js';?>"></script>
	<script src="<?php echo config_item('admin_js_url').'jquery.flot.stack.js';?>"></script>
	<script src="<?php echo config_item('admin_js_url').'jquery.flot.resize.min.js';?>"></script>
	<!-- chart libraries end -->

	<!-- validate -->
	<script src="<?php echo config_item('admin_js_url').'jquery.validate.js';?>"></script>
	<!-- select or dropdown enhancer -->
	<script src="<?php echo config_item('admin_js_url').'jquery.chosen.min.js';?>"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="<?php echo config_item('admin_js_url').'jquery.uniform.min.js';?>"></script>
	<!-- plugin for gallery image view -->
	<script src="<?php echo config_item('admin_js_url').'jquery.colorbox.min.js';?>"></script>
	<!-- rich text editor library -->
	<script src="<?php echo config_item('admin_js_url').'jquery.cleditor.min.js';?>"></script>
	<!-- notification plugin -->
	<script src="<?php echo config_item('admin_js_url').'jquery.noty.js';?>"></script>
	<!-- file manager library -->
	<script src="<?php echo config_item('admin_js_url').'jquery.elfinder.min.js';?>"></script>
	<!-- star rating plugin -->
	<script src="<?php echo config_item('admin_js_url').'jquery.raty.min.js';?>"></script>
	<!-- for iOS style toggle switch -->
	<script src="<?php echo config_item('admin_js_url').'jquery.iphone.toggle.js';?>"></script>
	<!-- autogrowing textarea plugin -->
	<script src="<?php echo config_item('admin_js_url').'jquery.autogrow-textarea.js';?>"></script>
	<!-- multiple file upload plugin -->
	<script src="<?php echo config_item('admin_js_url').'jquery.uploadify-3.1.min.js';?>"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="<?php echo config_item('admin_js_url').'jquery.history.js';?>"></script>
	<!-- application script for Charisma demo -->
	<script src="<?php echo config_item('admin_js_url').'hirevee.js';?>"></script>

	<!-- The fav icon -->
	<link rel="shortcut icon" href="<?php echo config_item('admin_image_url').'favicon.ico';?>" type="image/x-icon" />
		
</head>

<body>
	<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
	<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="<?php echo site_url('/admin');?>"> <img alt="Administrator Logo" src="<?php echo config_item('admin_image_url').'logo20.png';?>" /> <span>Administrator</span></a>
				
				<!-- theme selector starts -->
				<!--<div class="btn-group pull-right theme-container" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-tint"></i><span class="hidden-phone"> Change Theme / Skin</span>
						<span class="caret"></span>
					</a>
				</div>-->
				<!-- theme selector ends -->
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> admin</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><?php echo anchor(site_url('admin/profile'), 'Profile');?></li>
						<li class="divider"></li>
						<li><?php echo anchor(site_url('admin/user/logout'), 'Logout');?></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse">
					<ul class="nav">
						<li><a href="<?php echo site_url();?>">Visit Site</a></li>
						<!--<li>
							<form class="navbar-search pull-left">
								<input placeholder="Search" class="search-query span2" name="query" type="text">
							</form>
						</li>-->
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<!-- topbar ends -->
	<?php } ?>
	<div class="container-fluid">
		<div class="row-fluid">
