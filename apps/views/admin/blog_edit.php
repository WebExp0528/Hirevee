<div>
	<ul class="breadcrumb">
		<li><?php echo anchor(site_url('/admin/blog'), 'Blog');?> <span class="divider">/</span></li>
		<li><?php echo anchor(site_url('/admin/blog/edit/'.$contents->id), 'Edit');?></li>
	</ul>
</div>
<script type="text/javascript">
<!--
$(document).ready(function(e) {
	$('#frm_edit').validate({
		rules: {
			b_subject: { required: true }
		}
	});
	$('#btn_cancel').click(function(e){
		location.href = '<?php echo site_url('admin/blog/view/'.$contents->id);?>';
	});
});
//-->
</script>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i> Blog edit </h2>
		</div>
		<div class="box-content">
			<form class="form-horizontal" id="frm_edit" method="post">
			<input type="hidden" name="mode" value="update" />
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="b_category">Category</label>
						<div class="controls">
						<?php 
						$categorys = get_blog_category_list();
						echo form_dropdown('b_category', $categorys, array($contents->id_category), ' id="b_category" data-rel="chosen"');
						?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="b_subject">Subject</label>
						<div class="controls"><input class="input-xlarge" id="b_subject" name="b_subject" type="text" value="<?php echo $contents->subject;?>"></div>
					</div>
					<?php if ($contents->attach_file && !empty($contents->attach_file)) { ?>
					<div class="control-group">
					  <label class="control-label" for="b_del_attach">Attach file</label>
					  <div class="controls"><?php echo $contents->attach_file;?>&nbsp;&nbsp;&nbsp;<input type="checkbox" id="b_del_attach" name="b_del_attach" value="yes">Delete</div>
					</div>
					<?php } ?>
					<div class="control-group">
					  <label class="control-label" for="b_content">Content</label>
					  <div class="controls"><textarea class="cleditor" id="b_content" name="b_content" rows="3"><?php echo $contents->content;?></textarea></div>
					</div>
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary"><i class="icon icon-save icon-white"></i> Save</button>
					<a class="btn" href="#" id="btn_cancel"><i class="icon icon-cancel icon-darkgray"></i> Cancel</a>
				  </div>
				</fieldset>
			  </form>
		
		</div>
	</div><!--/span-->

</div><!--/row-->
