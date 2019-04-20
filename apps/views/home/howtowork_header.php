
<header><!--   *********************************************************** header contents ******************************************-->
<div class="header row-fluid">
	<div class="header_up row-fluid">
		<div class="header_logo"></div>
		<div>
			<div class="header_link">
				<a href="#about">About</a>
				<a href="#emp_rec">Employers & Recruiters</a>
				<a href="#staff">Prospective staff</a>
				<a href="#contact">Contact us</a>
				<a href="#">Blog</a>
				<a href="#">Members</a><!--
				<?php 
				if ($this->logged_user->is_loggedin()) { 
					echo '<a href="#" id="signout_link">Sign out</a>';
				} else {
					echo '<a href="#signin_modal" data-toggle="modal" data-target="#signin_modal">Sign in</a>';
				}
				?>
				
			--></div>	
			<div class="header_image"><?php echo img(array('src' => config_item('image_url').'blog_header_mark.gif', 'class' => 'header_mark'));?></div>
		</div>
	</div>
	<div class="header_down row-fluid">
		<div class="span3 offset2">
			<br><p class="top_title_big "><b><?php echo $title; ?></b></p><br>
			<p class="top_title_small pull-left">HireVee&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;<?php echo $subtitle; ?></p>
		</div>		
	</div>
</div>
</header>
