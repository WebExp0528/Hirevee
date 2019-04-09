<section>
<div class="blog_contents row-fluid "><!--   *********************************************************** Blog contents ******************************************-->
<div class="blog_left span7 offset2">
<h2 class="article_title"><?php echo $innerblog[0]->subject; ?></h2>
<hr>
<div class="blog_article row-fluid" id="scroll_bar">
		<?php foreach($innerblog as $item ):?>
		<div class="innnerBlog_content">
		 <span class="blog_publish_date"><?php echo substr($item->publish_date, 0, 10) ?>
									  &nbsp&nbsp|&nbsp &nbsp Author: </span>
									  <span class="blog_publish_after"><?php echo $item->name?>
									  &nbsp&nbsp|&nbsp&nbsp <?php echo $item->comment?> &nbsp comments</span>
									  <br>								  
			
			<div class="contents">
			<p>
				<div class="blog_content_img">
				
				<?php if (!empty($item->attach_file)):?>
					<a id="fancybox" title="<?php echo $item->subject;?>" href= "<?php echo base_url('template/upload/blog_attach');?>/<?php echo $item->attach_file;?>"  >
				 	<img class="thumbnail" src="<?php echo base_url('template/upload/blog_attach');?>/<?php echo $item->attach_file?>" alt="no image!" style="display: block;" />
				 	</a>
				 <?php else :?>
				 		<img class="thumbnail"  src="<?php echo config_item('image_url');?>/default_blog.png" alt="no image!" style="display: block;" />
				<?php endif;?>
				
						
				</div>
				<?php echo $item->content;?>
			</p>
			</div>
			</div>
			<?php endforeach; $blog_id=$item->id;?>
					<hr>
		<p>				
	<span class='st_facebook_hcount' 
	st_title='HireVee.com'
	st_url='<?php echo base_url('blog/innerblog').'/'.$blog_id ;?>'
	displayText='facebook'></span>
	
	<span class='st_twitter_hcount'
	st_title='HireVee.com'
	st_url='<?php echo base_url('blog/innerblog').'/'.$blog_id ;?>'	
	displayText='twitter'></span>
	
	<span class='st_plusone_hcount'	
	st_title='HireVee.com'
	st_url='<?php echo base_url('blog/innerblog').'/'.$blog_id ;?>'	
	displayText='plusone'></span></p>
						
						
						
						
						
			<?php $comment_number = $blog_comment->num_rows();?>
			<div class="comments_title_bar row-fluid">
			<div class="span8 comment_title pull-left">
			<h3><?php echo $comment_number;?>comments</h3>
</div>
<div class="span4 comment_btn "><a href="#reply"
	class="btn btn-primary pull-right">Leave a reply</a></div>
</div>
<!-- comments --->
<hr><?php foreach($blog_comment->result() as $item ):?>
	<div class="row-fluid">
		<div class="span2 comment-left">
		<span class="comment-author-name"><strong><?php echo $item->author_name;?></strong></span><br>
		<span class="comment-post-date"><?php echo $item->post_date;?></span></div>
		<div class="span10 comment-right">
		<?php echo $item->comment;?><br><a href="#reply">reply >></a></div></div>
		<hr>
		<?php endforeach;?>
<div id="reply" class="row-fluid leave_reply_form">
<h2>Leave a reply</h2>
</div>
<form id="reply_form" name="frm_reply" action="<?php echo base_url('/blog/reply' );?>" method="post">
	<input type="hidden" name="blog_id"	value="<?php echo $blog_id;?>" />
	<div class="reply_address row-fluid">
	<div class="span4 leave_addres_field ">
	<input id="user_name" name="user_name" type="text" placeholder="Your name*"> 
	<input id="email" name="email" type="text" placeholder="Your e-mail address*">
	<input id="subject" name="subject" type="text" placeholder="Subject*"></div>
	<div class="span6 pull-left"><textarea id="comment" name="comment"	class="comment_message  span14" rows="5"></textarea></div>
	</div>
	<div class="sendmail_btn row-fluid">
	<button type="submit" class="btn btn-primary">Post comment</button>
</div>
</form>

</div>
</div>
<!-----------------********************************** Post end *****************************************************---------------------------->
<div class="blog_right span2"><!-----------------********************************** right bar start *****************************************************---------------------------->
<div class="category_box"><!-- Category ---------------------------->
<h3 class="category_title"> Categories </h3>
<ul class="nav ">
	 <?php foreach($blog_category as $item): ?>
					 
					  <li> <a class="catigory_list" href="<?php echo  config_item('base_url')?>blog/index/<?php echo $this->pagination->cur_page .'_'.$item->id; ?>"><?php echo $item->category; ?></a> </li>
					  <?php  endforeach;?>				

</ul>
</div>
<div class="twiterfeed_box">
<h2 class="twiterfeed_title">Twitter feed</h2>
<!-- Twitter feed ---------------------------->
<hr>
<p>Cum sociis natoque penatibus et magnis dis parturient montes,
nascetur ridiculus mus. commodo luctus, nisi erat porttitor ligula, eget
lacinia odio sem nec elit. Donec ullamcorper nulla non metus auctor
fringilla. <small>Someone famous <cite title="Source ">Source Title</cite></small>
</p>
<hr>
<p>Cum sociis natoque penatibus et magnis dis parturient montes,
nascetur ridiculus mus. <small>Someone famous <cite title="Source ">Source
Title</cite></small></p>
<hr>
</div>
<div class="google_widget">
<h4 class="google_widget_title"></h4>
<div class="row-fluid widget_contents">
<div class="google_icon span4"></div>
<div class="google_title_name span7">
<address><strong>Scripttr Version</strong><br>
<a href="#">AddtoCircle</a></address>
</div>
</div>
<ul class="inline widget_content">

	<address><strong>Twitter, Inc.</strong><br>
	795 Folsom Ave, Suite 600<br>
	San Francisco, CA 94107<br>
	<abbr title="Phone">P:</abbr> (123) 456-7890</address>

	<address><strong>Full Name</strong><br>
	<a href="mailto:#">first.last@example.com</a></address>
</ul>
</div>
<div class="linked_in"><!-- linked in---------------------------->
<h2 class="twiterfeed_title">linked in</h2>
<hr>
<p class="text-info">Cum sociis natoque penatibus<br>


<p>


<h6 class="muted">project manager
<h6>
<p></p>
<hr>
<p class="text-info">Cum sociis natoque penatibus<br>


<p>


<h6 class="muted">Wab designer
<h6>
<p></p>
<hr>
<p class="text-info">Cum sociis natoque penatibus<br>
<p>
<h6 class="muted">project manager
<h6>
<p></p>
<hr>

</div>
<div class="facebook_box">
<div class="facebox_title"><strong>Find us onFacebook </strong></div>
<div class="facebox_icon"></div>
<hr class="divider">
<p class="facebook_label"><small>262,513 people like <strong>HireVee<strong></small></p>
<div class="facebox_contents row-fluid">
<div class="facebook_pic span3"><img src="./images/face_man.png"
	class="img-rounded">
<p class="muted"><small>Margin</small></p>
</div>
<div class="facebook_pic span3"><img src="./images/face_man.png"
	class="img-rounded">
<p class="muted"><small>Margin</small></p>
</div>
<div class="facebook_pic span3"><img src="./images/face_man.png"
	class="img-rounded">
<p class="muted"><small>Margin</small></p>
</div>
</div>
<div class="facebox_contents row-fluid">
<div class="facebook_pic span3"><img src="./images/face_man.png"
	class="img-rounded">
<p class="muted"><small>Margin</small></p>
</div>
<div class="facebook_pic span3"><img src="./images/face_man.png"
	class="img-rounded">
<p class="muted"><small>Margin</small></p>
</div>
<div class="facebook_pic span3"><img src="./images/face_man.png"
	class="img-rounded">
<p class="muted"><small>Margin</small></p>
</div>
</div>
<div class="facebox_contents row-fluid">
<div class="facebook_pic span3"><img src="./images/face_man.png"
	class="img-rounded">
<p class="muted"><small>Margin</small></p>
</div>
<div class="facebook_pic span3"><img src="./images/face_man.png"
	class="img-rounded">
<p class="muted"><small>Margin</small></p>
</div>
<div class="facebook_pic span3"><img src="./images/face_man.png"
	class="img-rounded">
<p class="muted"><small>Margin</small></p>
</div>
</div>
<hr>
<div class="facebook_footer row-fluid">
<div class="span2"><img src="./images/facebook_footer_icon.png"></div>
<div class="span10">
<p class="muted"><small>Facebook social plugin</small></p>
</div>
</div>
</div>

</div>
<!-----------------********************************** footer start *****************************************************---------------------------->

</div>
</section>
<script type="text/javascript" src="<?php echo config_item('js_url');?>jquery.lightbox-0.5.js"></script>
<script type="text/javascript">
<!--
$(document).ready(function () {

	$("#fancybox").lightBox();


	
	 $("#reply_form").validate({
	        rules: {
	        	user_name: "required",
	        	subject:"required",
	            email: {
	                required: true,
	                email: true               
	            },
	            comment:"required"
	        },
	        messages: {
	            name: "Enter your name.",
	            subject: "Enter your subject.",
	            
	            password: {
	                required: "Provide a password",
	                rangelength: jQuery.format("Enter at least {0} characters")
	            },
	            
	            email: {
	                required: "Please enter a valid email address"	                              
	            }
	        }
	    });
		



$('#search_form').submit(function() {		
    if($('#search_key').val()== '') {
         return false;
    } else {
	    return true;
    }
});



});
//-->
</script>