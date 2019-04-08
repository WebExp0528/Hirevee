<?php if(!isset($no_visible_elements) || !$no_visible_elements) { ?>
<!-- left menu starts -->
<div class="span2 main-menu-span">
	<div class="well nav-collapse sidebar-nav">
		<ul class="nav nav-tabs nav-stacked main-menu">
			<li class="nav-header hidden-tablet"><i class="icon-home"></i> Main</li>
			<li <?php if (isset($menu) && $menu == 'dashboard') echo 'class="active"';?>><a class="ajax-link" href="<?php echo site_url('admin/main/index');?>"><span class="hidden-tablet"> Dashboard</span></a></li>
			<li <?php if (isset($menu) && $menu == 'notice') echo 'class="active"';?>><a class="ajax-link" href="<?php echo site_url('admin/main/notice');?>"><span class="hidden-tablet"> Notice</span></a></li>
			<li class="nav-header hidden-tablet"><i class="icon-user"></i> Users</li>
			<li <?php if (isset($menu) && $menu == 'user') echo 'class="active"';?>><a class="ajax-link" href="<?php echo site_url('admin/user/index');?>"><span class="hidden-tablet"> All Users</span></a></li>
			<!--<li><a class="ajax-link" href="<?php echo site_url('admin/user/options');?>"><span class="hidden-tablet"> Options</span></a></li>-->
			<li class="nav-header hidden-tablet"><i class="icon-list-alt"></i> Blogs</li>
			<li <?php if (isset($menu) && $menu == 'blog') echo 'class="active"';?>><a class="ajax-link" href="<?php echo site_url('admin/blog/index');?>"><span class="hidden-tablet"> All Blogs</span></a></li>
			<li <?php if (isset($menu) && $menu == 'blog_category') echo 'class="active"';?>><a class="ajax-link" href="<?php echo site_url('admin/blog/category');?>"><span class="hidden-tablet"> Blog Category</span></a></li>
			<li class="nav-header hidden-tablet"><i class="icon-cog"></i> Site Settings</li>
			<li <?php if (isset($menu) && $menu == 'profile') echo 'class="active"';?>><a class="ajax-link" href="<?php echo site_url('admin/profile');?>"><span class="hidden-tablet"> Admin Profile</span></a></li>
		</ul>
	</div><!--/.well -->
</div><!--/span-->
<!-- left menu ends -->

<div id="content" class="span10">
<!-- content starts -->
<?php } ?>
