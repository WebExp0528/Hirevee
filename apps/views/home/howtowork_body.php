<?php 
	if(empty($id))
		$id=0;
	else 
	$id--;
?>
<section>
<div class="howto_contents row-fluid ">
	<div class="howto_side_nav span2 offset2">
		<div class="howtomenu_box">					<!-- How to menu ---------------------------->
				<h3 class="howtomenu_title">How it works</h3>
				<ul class="nav nav-tabs nav-stacked ">
					<?php foreach ($category as $value):?>
						<?php if (($id+1)==$value->id):?>
							<li style= "background-color: #54befe"   > <a style="color: #ffffff"  href="<?php echo config_item('base_url').'home/howtowork/'.$value->id;?>"><?php echo $value->category;?></a> </li>
						<?php else:?>
						  	<li> <a href="<?php echo config_item('base_url').'home/howtowork/'.$value->id;?>"><?php echo $value->category;?></a> </li>
					  	<?php endif;?>
					<?php endforeach;?>
				</ul> 
			</div>
		<div class="signup_btn row-fluid">
			<a href="<?php echo config_item('base_url').'home/open_signup/'?>" class="btn btn-primary sign_up_free">
			<b>Sign up free</b></a>
		</div>
	
	
	</div>
	
	<div class="howto_side_contents span6"><!-----------------********************************** popular post   *****************************---------------------------->
		<h2 class="post_title"><?php echo $category[$id]->subject;?></h2>
			<hr>
		
	 	 <div class="post_content_text"><p>
	 	 	<?php echo $category[$id]->content;?>
			</p>
		</div>
		<hr>		
	</div>
</div>
</section>