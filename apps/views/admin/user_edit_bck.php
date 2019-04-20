<div>
	<ul class="breadcrumb">
		<li><?php echo anchor(site_url('/admin/user'), 'User');?> <span class="divider">/</span></li>
		<li><?php echo anchor(site_url('/admin/user/edit/'.$contents->id), 'Edit');?></li>
	</ul>
</div>
<script type="text/javascript">
<!--
$(document).ready(function(e) {
	$('#frm_edit').validate({
		rules: {
			u_name: { required: true },
			u_last_name: { required: true },
			u_email: { required: true, email: true },
			u_company: { required: true },
			u_balance: { required: true, number: true }
		}
	});
	$('#btn_cancel').click(function(e){
		location.href = '<?php echo site_url('admin/user/index');?>';
	});
});
//-->
</script>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i> User edit </h2>
		</div>
		<div class="box-content">
			<form class="form-horizontal" id="frm_edit" method="post">
			<input type="hidden" name="mode" value="update" />
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="u_name">Name</label>
						<div class="controls"><input class="input-xlarge focused" id="u_name" name="u_name" type="text" value="<?php echo $contents->name;?>"></div>
					</div>
					<div class="control-group">
						<label class="control-label" for="u_email">Email</label>
						<div class="controls"><input class="input-xlarge" id="u_email" name="u_email" type="text" value="<?php echo $contents->email;?>"></div>
					</div>
					<div class="control-group">
					  <label class="control-label" for="u_company">Company</label>
					  <div class="controls"><input type="text" class="input-xlarge" id="u_company" name="u_company" value="<?php echo $contents->company;?>"></div>
					</div>
					<div class="control-group">
					  <label class="control-label" for="u_balance">Balance</label>
					  <div class="controls"><input type="text" class="input-xlarge" id="u_balance" name="u_balance" value="<?php echo $contents->balance;?>"></div>
					</div>
<!--					<div class="control-group">-->
<!--					  <label class="control-label" for="u_banner_color">Banner color</label>-->
<!--					  <div class="controls"><input type="text" class="color input-small" id="u_banner_color" name="u_banner_color" value="<?php echo '#'.$contents->banner_color;?>"></div>-->
<!--					</div>-->
					
				  <div class="control-group">
					<label class="control-label">Allow</label>
					<div class="controls">
					  <label class="radio inline"><input type="radio" name="u_allow" id="u_allow" value="Y" <?php if ($contents->allow == 'Y') echo 'checked'?>>Allow</label>
					  <label class="radio inline"><input type="radio" name="u_allow" id="u_deny" value="N" <?php if ($contents->allow == 'N') echo 'checked'?>>Deny</label>
					</div>
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
