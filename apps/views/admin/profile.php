<div>
	<ul class="breadcrumb">
		<li><?php echo anchor(site_url('/admin/profile'), 'Profile');?> <span class="divider"></span></li>
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
			u_new_passwd: { equalTo: "#u_conf_passwd" },
			u_conf_passwd: { equalTo: "#u_new_passwd" },
			u_company: { required: true },
		}
	});
	$('#btn_cancel').click(function(e){
		location.href = '<?php echo site_url('admin/profile/index');?>';
	});
});
//-->
</script>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i> Profile edit </h2>
		</div>
		<div class="box-content">
			<form class="form-horizontal" id="frm_edit" method="post" action="<?php echo site_url('admin/profile/update');?>">
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
						<label class="control-label" for="u_new_passwd">New Password</label>
						<div class="controls"><input class="input-xlarge" id="u_new_passwd" name="u_new_passwd" type="password" value=""></div>
					</div>
					<div class="control-group">
						<label class="control-label" for="u_conf_passwd">Confirm Password</label>
						<div class="controls"><input class="input-xlarge" id="u_conf_passwd" name="u_conf_passwd" type="password" value=""></div>
					</div>
					<div class="control-group">
					  <label class="control-label" for="u_company">Company</label>
					  <div class="controls"><input class="input-xlarge" id="u_company" name="u_company" type="text" value="<?php echo $contents->company;?>"></div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary" style="width: 100px;"> Save </button>
					</div>
				</fieldset>
			  </form>
		
		</div>
	</div><!--/span-->

</div><!--/row-->
