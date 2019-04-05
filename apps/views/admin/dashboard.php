<div>
	<ul class="breadcrumb">
		<li><?php echo anchor(site_url('/admin/main'), 'Main');?> <span class="divider">/</span></li>
		<li><?php echo anchor(site_url('/admin/main/dashboard'), 'Dashboard');?></li>
	</ul>
</div>
<div class="sortable row-fluid">
	<a data-rel="tooltip" title="<?php echo $online_total_user;?> online users." class="well span3 top-block" href="#">
		<span class="icon32 icon-red icon-users"></span>
		<div>Total Users</div>
		<div><?php echo $total_user;?></div>
		<span class="notification"><?php echo $online_total_user;?></span>
	</a>

	<a data-rel="tooltip" title="<?php echo $online_recruiter_counts;?> online users." class="well span3 top-block" href="#">
		<span class="icon32 icon-orange icon-user"></span>
		<div>Recruiter Counts</div>
		<div><?php echo $recruiter_counts;?></div>
		<span class="notification green"><?php echo $online_recruiter_counts;?></span>
	</a>

	<a data-rel="tooltip" title="<?php echo $activated_client;?> activated." class="well span3 top-block" href="#">
		<span class="icon32 icon-green icon-user"></span>
		<div>Total Clients</div>
		<div><?php echo $total_client;?></div>
		<span class="notification yellow"><?php echo $activated_client;?></span>
	</a>
	
	<a data-rel="tooltip" title="<?php echo $new_blogs;?> new blogs." class="well span3 top-block" href="#">
		<span class="icon32 icon-blue icon-document"></span>
		<div>Blogs</div>
		<div><?php echo $total_blogs;?></div>
		<span class="notification red"><?php echo $new_blogs;?></span>
	</a>
</div>

<div class="row-fluid sortable">
	<div class="box span4">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-list"></i> Sub1</h2>
		</div>
		<div class="box-content buttons">
			<p>
			</p>
		</div>
	</div><!--/span-->
		
	<div class="box span4">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-list"></i> Sub2</h2>
		</div>
		<div class="box-content buttons">
			<p>
			</p>
		</div>
	</div><!--/span-->
		
	<div class="box span4">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-list"></i> Sub3</h2>
		</div>
		<div class="box-content buttons">
			<p>
			</p>
		</div>
	</div><!--/span-->
</div><!--/row-->
