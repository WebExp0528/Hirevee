<section>
<div class="blog_contents row-fluid "><!--   *********************************************************** Blog contents ******************************************-->

	<div class="blog_left span6 offset2">
			
	<h2 class="post_title">Search result for " <?php echo $search_key;?> " -Total - <?php echo $total_number ;?> </h2><!-----*********************************** lastest post *******************************---------------------------->
			<hr>

<?php if (!empty($search_blog)):?> 
	<?php foreach($search_blog as $item): ?>
		<div class="latest_posts row-fluid">
							
								
						<div class="blog_image span4">
						
						 <?php if (!empty($item->attach_file)):?>
						 	<img class="thumbnail" src="<?php echo base_url('template/upload/blog_attach');?>/<?php echo $item->attach_file?>" alt="no image!" />
						 <?php else :?>
							<img class="thumbnail"  src="<?php echo config_item('image_url');?>/default_blog.png" alt="no image!"  />
						<?php endif;?>
						</div>		
						
						<div class="lastest_post span8">
						 <div class="lasted_content">
									 <a class="blog_subject" href ="<?php echo  config_item('base_url')?>blog/innerblog/<?php echo $item->id;?>"><?php echo $item->subject; ?></a> <br>
									  <span class="blog_publish_date"><?php echo substr($item->publish_date, 0, 10) ?>
									  &nbsp&nbsp|&nbsp &nbspAuthor: </span>
									  <span class="blog_publish_after"><?php echo $item->name ?>
									  &nbsp&nbsp|&nbsp&nbsp <?php echo $item->comment?> &nbsp comments</span>
									  <br><br>
									 
							<?php
						 $i=0;
						 $contenstr=htmlspecialchars_decode($item->content);
						 $temp=explode('>', $contenstr);
						 foreach ($temp as $value) {
						 	$value_content=explode('<', $value);
						 	$i++;	
						 	$length=strlen($value_content[0]);
						 	if($length>250){
						 		$value_content[0]=substr($value_content[0],1,250);
						 		echo $value_content[0];
						 		break;
						 	}							 	
						 	echo $value_content[0];
						 	if ($i>5)
						 		break;
						 };?>
						 
						
						  <br>
						 
						 <?php if ($this->logged_user->is_loggedin()):?>
						 	<?php if ($this->logged_user->get_item('id')==$item->id_user):?>	
						 	<a href="<?php echo config_item('base_url');?>blog/blog_editor/<?php echo $item->id;?>"><div style="float: left;color: blue;">Edit</div></a>
						 	<?php endif;?>
						 <?php endif;?>
						 </div>
						</div>
	</div>
	<hr>
	<?php endforeach; ?>		
	<?php else:?>
		<span> There is no Blog!</span>
	<?php endif;?>
	<div class="row-fluid"><center><?php $this->pagination->suffix='_'.$search_key ;echo $this->pagination->create_links(); ?></center></div>
</div>
<!-----------------********************************** Post end *****************************************************---------------------------->
	<div class="blog_right span2"><!-----------------********************************** right bar start *****************************************************---------------------------->
			<div class="category_box"><!-- Category ---------------------------->
				<h3 class="category_title">Categories</h3>
				<ul class="nav nav-tabs nav-stacked ">
					  <?php foreach($blog_category as $item): ?>
					 
					  <li> <a href="<?php echo  config_item('base_url')?>blog/index/<?php echo $this->pagination->cur_page .'_'.$item->id; ?>"><?php echo $item->category; ?></a> </li>
					  <?php  endforeach;?>				

				</ul> 
			</div>
				<div class="twiterfeed_box">
				<h2 class="twiterfeed_title">Twitter feed</h2><!-- Twitter feed ---------------------------->
							 <hr>
								  <p>
									Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
									commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla non metus auctor fringilla.
									<small>Someone famous <cite title="Source ">Source Title</cite></small>
									</p>
							  <hr>
									 <p>
									Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
									<small>Someone famous <cite title="Source ">Source Title</cite></small>
								</p>
							  <hr>
							  </div>
							  <div class="google_widget">
									<h4 class="google_widget_title"></h4>
										<div class="row-fluid widget_contents">	
											<div class="google_icon span4"> </div>
											<div class="google_title_name span7"> 
												<address>
												  <strong>Scripttr Version</strong><br>
												  <a href="#">AddtoCircle</a>
												</address>
											</div>
										</div>
										<ul class="inline widget_content">

											  <address>
											  <strong >Twitter, Inc.</strong><br>
											  795 Folsom Ave, Suite 600<br>
											  San Francisco, CA 94107<br>
											  <abbr title="Phone">P:</abbr> (123) 456-7890
											</address>
											 
											<address>
											  <strong>Full Name</strong><br>
											  <a href="mailto:#">first.last@example.com</a>
											</address>
										</ul>
								</div>
							<div class="linked_in"> <!-- linked in---------------------------->
								<h2 class="twiterfeed_title">linked in</h2>
								<hr>	  <p class="text-info">Cum sociis natoque penatibus<br>
											<p><h6 class="muted">project manager<h6><p>
											</p>
								<hr>	  <p class="text-info">Cum sociis natoque penatibus<br>
											<p><h6 class="muted">Wab designer<h6><p>
											</p>
								<hr>	  <p class="text-info">Cum sociis natoque penatibus<br>
											<p><h6 class="muted">project manager<h6><p>
											</p>
							    <hr>
							</div>
							<div class="facebook_box">
								<div class="facebox_title"><strong>Find us onFacebook </strong></div>
								<div class="facebox_icon"></div><hr class="divider">
								<p class="facebook_label"><small>262,513 people  like <strong>HireVee<strong></small></p>
								<div class="facebox_contents row-fluid">
									<div class="facebook_pic span3"><img src="./images/face_man.png" class="img-rounded"><p class="muted"><small>Margin</small></p></div>
									<div class="facebook_pic span3"><img src="./images/face_man.png" class="img-rounded"><p class="muted"><small>Margin</small></p></div>
									<div class="facebook_pic span3"><img src="./images/face_man.png" class="img-rounded"><p class="muted"><small>Margin</small></p></div>				
								</div>
								<div class="facebox_contents row-fluid">
									<div class="facebook_pic span3"><img src="./images/face_man.png" class="img-rounded"><p class="muted"><small>Margin</small></p></div>
									<div class="facebook_pic span3"><img src="./images/face_man.png" class="img-rounded"><p class="muted"><small>Margin</small></p></div>
									<div class="facebook_pic span3"><img src="./images/face_man.png" class="img-rounded"><p class="muted"><small>Margin</small></p></div>				
								</div>
								<div class="facebox_contents row-fluid">
									<div class="facebook_pic span3"><img src="./images/face_man.png" class="img-rounded"><p class="muted"><small>Margin</small></p></div>
									<div class="facebook_pic span3"><img src="./images/face_man.png" class="img-rounded"><p class="muted"><small>Margin</small></p></div>
									<div class="facebook_pic span3"><img src="./images/face_man.png" class="img-rounded"><p class="muted"><small>Margin</small></p></div>				
								</div><hr>
								<div class="facebook_footer row-fluid">
									<div class="span2"> <img src="./images/facebook_footer_icon.png" ></div>
									<div class="span10"><p class="muted"><small>Facebook social plugin</small></p></div>
								</div>
						</div>

	</div><!-----------------********************************** footer start *****************************************************---------------------------->
 
</div>

</section>
<script type="text/javascript">
<!--

(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
//-->
</script>

       
      
     
    

