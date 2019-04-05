<div>
	<ul class="breadcrumb">
		<li><?php echo anchor(site_url('/admin/blog'), 'Blog');?> <span class="divider">/</span></li>
		<li><?php echo anchor(site_url('/admin/blog/view/'.$contents->id), 'View');?></li>
	</ul>
</div>
<script type="text/javascript">
$(document).ready(function(e) {
	$('.comment_state').click(function(){
		var url;
		var obj = $(this);
		state = obj.attr('data-state');
		$.post("<?php echo site_url('admin/blog/comment_set_state');?>", {cmtid:$(this).attr('data-id'), curr_state:state}, function(result){
			
			if (result == 'ok') {
				if (state == "active") {
					obj.attr('data-state', 'disable');
					obj.html('<i class="icon-remove"></i> Disable');
				} else if (state == "disable") {
					obj.attr('data-state', 'active');
					obj.html('<i class="icon-ok"></i> Avtivate');
				}
			} else {
				alert(result);
			}
		});
	});
	$('.commant_delete').click(function(){
		if (confirm('Do you want to delete this comment?'))
		{
			$.post("<?php echo site_url('admin/blog/comment_delete');?>", {cmtid:$(this).attr('data-id')}, function(result){
				if (result == 'ok') {
					location.reload();
				} else {
					alert(result);
				}
			});
		}
	});
});

</script>
<div class="row-fluid sortable">
	<div class="box">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-list-alt"></i> View Blog</h2>
		</div>
		<div class="box-content">
			<div class="alert alert-info row-fluid detail span12">
				<b>Category:</b> <span class="label label-info"><?php echo $contents->category;?></span>
				<b>Author:</b> <span class="label label-info"><?php echo $contents->name;?></span>
				<b>Email:</b> <a class="label label-info" href="mailto:<?php echo $contents->email;?>"><?php echo $contents->email;?></a>
				<span class="label label-info"><?php echo $contents->publish_date;?></span>
				<b>Comments:</b> <span class="label label-info"><?php echo $contents->comments;?></span>
			</div>
			<div class="page-header">
				<h2><?php echo $contents->subject;?></h2>
			</div>     
			<div class="row-fluid ">            
				<p><?php echo $contents->content;?></p>
			</div><!--/row -->                           
		</div>
		<div class="form-actions">
			<a class="btn btn-small btn-primary" href="<?php echo site_url('/admin/blog/edit/'.$contents->id);?>"><i class="icon-edit icon-white"></i> Edit</a>
			<a class="btn btn-small btn-primary"  href="<?php echo site_url('/admin/blog/index');?>"><i class="icon-list icon-white"></i> List</a>
			<?php if ($contents->allow == 'N') { ?>
			<a class="btn btn-small btn-success"  href="<?php echo site_url('/admin/blog/set_state/allow/'.$contents->id);?>"><i class="icon-ok icon-white"></i> Allow</a>
			<?php } else {?>
			<a class="btn btn-small btn-warning"  href="<?php echo site_url('/admin/blog/set_state/deny/'.$contents->id);?>"><i class="icon-remove icon-white"></i> Deny</a>
			<?php } ?>
			<a class="btn btn-small btn-danger"  href="#" onclick="if (confirm('Do you want to delete the blog?')){location.href='<?php echo site_url('/admin/blog/delete/'.$contents->id);?>';}"><i class="icon-trash icon-white"></i> Delete</a>
		</div>
		<?php if ($comments->num_rows() > 0) { ?>
		<div class="box-content" style="margin: 10px 20px;">
			<div class="row-fluid">
				<h2 class="red">Comments</h2>
			</div>
			<hr />
			<?php 
			foreach ($comments->result() as $item)
			{
			?>
			<div class="row-fluid ">
				<h3><?php echo $item->subject;?></h3>
				<h3><small>
					<span style="margin-right: 20px;"><?php echo date('Y/m/d H:i:s', strtotime($item->post_date));?></span> 
					<span style="margin-right: 20px;">name: <?php echo $item->author_name;?> </span> 
					<span>email: <a href="mailto:<?php echo $item->author_email;?>"><?php echo $item->author_email;?></a></span>
				</small></h3>
				<p><?php echo $item->comment;?></p>
			</div><!--/row -->
			<div class="row-fluid ">
				<?php if ($item->allow == 'N') { ?>
				<a class="btn btn-small comment_state" href="#" data-state="active" data-id="<?php echo $item->id;?>"><i class="icon-ok"></i> Avtivate</a>
				<?php } else { ?>
				<a class="btn btn-small comment_state" href="#" data-state="disable" data-id="<?php echo $item->id;?>"><i class="icon-remove"></i> Disable</a>
				<?php } ?>
				<a class="btn btn-small commant_delete" href="#" data-id="<?php echo $item->id;?>"><i class="icon-trash"></i> Delete</a>
			</div> 
			<hr />
			<?php 
			}
			?>                     
		</div>
		<?php } ?>
	</div><!--/span-->
</div><!--/row-->
