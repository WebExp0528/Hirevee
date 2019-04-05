<div>
	<ul class="breadcrumb">
		<li><?php echo anchor(site_url('/admin'), 'Main');?> <span class="divider">/</span></li>
		<li><?php echo anchor(site_url('/admin/main/notice'), 'Notice');?> <span class="divider">/</span></li>
		<li><?php echo anchor(site_url('/admin/main/notice/new'), 'New');?></li>
	</ul>
</div>
<script type="text/javascript">
<!--
$(document).ready(function(e) {
	$('#frm_edit').validate({
		rules: {
			nt_category: { 
				required: true,
                remote: {
                    type: "POST",
                    url: "<?php echo site_url('/admin/main/check_notice_category');?>",
                    data: {
                    	new_cate: function () {
                           return $('#nt_category').val();
                        }
                    }
                }
			}
		},
        messages: {
        	nt_category: {
        		required: "Please enter a category",
                remote: jQuery.format("\"{0}\" is already exist")
            }
        }
	});
	$('#btn_cancel').click(function(e){
		location.href = '<?php echo site_url('admin/main/notice');?>';
	});
});
//-->
</script>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i> Add new Notice </h2>
		</div>
		<div class="box-content">
			<form class="form-horizontal" id="frm_edit" method="post" action="<?php echo site_url('admin/main/notice/add');?>">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="nt_category">Category</label>
						<div class="controls"><input class="input-xlarge focused" id="nt_category" name="nt_category" type="text" value=""></div>
					</div>
					<div class="control-group">
						<label class="control-label" for="nt_subject">Subject</label>
						<div class="controls subject"><textarea class="cleditor" id="nt_subject" name="nt_subject"></textarea></div>
					</div>
					<div class="control-group">
						<label class="control-label" for="nt_content">Content</label>
						<div class="controls content"><textarea class="cleditor" id="nt_content" name="nt_content"></textarea></div>
					</div>
					<div class="control-group">
					  	<label class="control-label">State</label>
					  	<div class="controls">
						  <label class="radio inline"><input type="radio" name="nt_state" id="nt_activated" value="Y" checked>Activated</label>
						  <label class="radio inline"><input type="radio" name="nt_state" id="nt_disabled" value="N") echo 'checked'?>>Disabled</label>
			  			</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary"><i class="icon icon-save icon-white"></i> Save </button>
						<a class="btn" href="#" id="btn_cancel"><i class="icon icon-cancel icon-darkgray"></i> Cancel</a>
					</div>
				</fieldset>
			  </form>
		
		</div>
	</div><!--/span-->

</div><!--/row-->
