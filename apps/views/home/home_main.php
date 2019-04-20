<!-----------------********************************** Interview Staff ******************---------------------------->
<section>
<script type="text/javascript">
$(document).ready(function(e) {
	$('.entercode').click( function(){
		$('#entercode_link').click();
	});
	$('#getstarted').click( function(){
		document.location.href = "<?php echo site_url('/home/open_signup');?>";
	});
	$('#signup').click( function(){
		document.location.href = "<?php echo site_url('/home/open_signup');?>";
	});
});
</script>
<div class="home_staff row-fluid">
	<div class="span1"></div>
	<div class="staff_category span3">
		<div class="staff_seeking">
			<div class="staff_caption">Seeking Work</div>
			<div class="seeking_work"></div>
			<div class="entercode">Enter Code</div>
		</div>
	</div>
	<div class="span4">
		<?php echo $notice['staff']->subject;?>
		<hr>
		<?php echo $notice['staff']->content;?>
	</div>
	<div class="staff_category span3">
		<div class="staff_signup">
			<div class="staff_caption">Recruiters</div>
			<div class="recruiters"></div>
			<div class="signup" id="signup">Sign up</div>
		</div>
	</div>
	<div class="span1"></div>
</div>
</section>
<!-----------------********************************** Staff Details ******************---------------------------->
<section>
<div class="home_staff_detail row-fluid">
	<div class="span2"></div>
	<div class="span8">
		<div class="row-fluid">
			<div class="staff_detail span4">
				<h3>Suggest any business</h3>
				<p class="detail">Etiam sodales erat in libero. In at mi. Vestibulum mi odio, dapibus in, tincidunt non, tincidunt.</p>
				<span>
				<img alt="Suggest any business" src="<?php echo config_item('image_url');?>/logo_staff_1.png">
				</span>
			</div>
			<div class="staff_detail span4">
				<h3>Flexible</h3>
				<p class="detail">Etiam sodales erat in libero. In at mi. Vestibulum mi odio, dapibus in, tincidunt non, tincidunt.</p>
				<span>
				<img alt="Flexible" src="<?php echo config_item('image_url');?>/logo_staff_2.png">
				</span>
			</div>
			<div class="staff_detail span4">
				<h3>An experience</h3>
				<p class="detail">Etiam sodales erat in libero. In at mi. Vestibulum mi odio, dapibus in, tincidunt non, tincidunt.</p>
				<span>
				<img alt="An experience" src="<?php echo config_item('image_url');?>/logo_staff_3.png">
				</span>
			</div>
		</div>
	</div>
	<div class="span2"></div>
</div>
</section>

<!-----------------********************************** Our Mission ******************---------------------------->

<section>
<div class="home_our_mission row-fluid">
	<div class="span2"></div>
	<div class="span8">
		<div class="home_caption row-fluid">
			<h2>Our Mission</h2>
			<div class="sep_bar"></div>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<div class="mission_content row-fluid">
					<div>
						<h4>Gift cards are thoughtful, but wasteful</h4>
						<p class="detail">Aliquam tincidunt vestibulum dui. 
						Pellentesque sagittis lorem convallis purus. In nunc quam, imperdiet eget, ornare sed, ullamcorper semper, odio. 
						Quisque vel turpis vel arcu euismod tincidunt. Vestibulum porttitor. 
						Proin in erat. Donec pharetra ultricies eros. Maecenas nonummy, massa eu faucibus feugiat.</p>
					</div>
					<div>
						<h4>Keep the good, leave the bad</h4>
						<p class="detail">Aliquam tincidunt vestibulum dui. 
						Pellentesque sagittis lorem convallis purus. In nunc quam, imperdiet eget, ornare sed, ullamcorper semper, odio. 
						Quisque vel turpis vel arcu euismod tincidunt. Vestibulum porttitor.</p>
					</div>
					<div>
						<h4>Send an online gift card</h4>
						<p class="detail">Aliquam tincidunt vestibulum dui. 
						Pellentesque sagittis lorem convallis purus. In nunc quam, imperdiet eget, ornare sed, ullamcorper semper, odio. 
						Quisque vel turpis vel arcu euismod tincidunt.</p>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="mission_logo">
					<img src="<?php echo config_item('image_url');?>/logo_mission.png">
				</div>
			</div>
		</div>
		<div class="mission_foot row-fluid">
			<h3>Website to wordpress migration - <span class="caption_color">$395 USD</span></h3>
			<div class="started" id="getstarted">Get Started!</div>
			<p class="detail">no hidden fees or gimmicks</p>
		</div>
	</div>
	<div class="span2"></div>
</div>
</section>

<!-----------------********************************** Latest Blogs ******************---------------------------->
<section>
<?php if ($lastblog && is_array($lastblog)) : ?>
<div class="home_latest_blog row-fluid">
	<div class="span2"></div>
	<div class="span8">
		<div class="home_caption row-fluid">
			<h2>Latest blog posts</h2>
			<div class="sep_bar"></div>
		</div>
		<div class="row-fluid">
		<?php  foreach($lastblog as $item): ?>
			<div class="span4 blog_contents">
							
						<?php if (!empty($item->attach_file)):?>
						  <div class="blog_img"><img class="thumbnail"  src="<?php echo base_url('template/upload/blog_attach/');?>/<?php echo $item->attach_file?>"/></div>
						 <?php else :?>
							<div class="blog_img"><img class="thumbnail" src="<?php echo config_item('image_url');?>/logo_staff_1.png"/></div>
						<?php endif;?>
						
				
			
				<div class="blog_title">
					<a href="<?php echo  config_item('base_url')?>blog/innerblog/<?php echo $item->id;?>"><?php echo $item->subject;?></a>
				</div>
				<div class="social_link">
					<a href="http://www.twitter.com/intelisystems" 	target="_blank" class="link_tweet"><img 
					src="<?php echo config_item('image_url');?>/btn_home_blog_tweet.png" width="73" height="30"></a><a href="http://www.facebook.com/InteliSystems" 	target="_blank" class="link_tweet"><img 
					src="<?php echo config_item('image_url');?>/btn_home_blog_facebook.png" width="73" height="30"></a><a href="https://plus.google.com/107170967702765950092/posts" 	target="_blank" class="link_tweet"><img 
					src="<?php echo config_item('image_url');?>/btn_home_blog_google.png" width="73" height="30"></a><a target="_blank"  href="https://pinterest.com/login/?next=/pin/create/button/%3Fmedia%3Dhttp%253A%252F%252Fs7.addthis.com%252Fstatic%252Ft00%252Flogo100100.png%26url%3Dhttps%253A%252F%252Fwww.addthis.com%252Fget%252Fsharing%253Ffrm%253Dhp%2526flag%253Dlogin%2526lb%253D1%26description%3DGet%2520Sharing%2520Tools%2520%257C%2520AddThis" class="link_tweet"><img 
					src="<?php echo config_item('image_url');?>/btn_home_blog_pinit.png" width="74" height="30"></a>
				</div>
			</div>
			<?php endforeach;?>
		</div>
	</div>
	<div class="span2"></div>
</div>
<?php endif;?>
</section>
