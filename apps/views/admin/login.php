<script type="text/javascript">
<!--
$(document).ready(function(e) {
	$('#login-form').validate({
		rules: {
			username: {
				required: true
			},
			userpasswd: {
				required: true
			}
		},
		messages: {
			username: {
                required: ""
            },
            userpasswd: {
                required: ""
            }
		}
	});
});
-->
</script>
<div class="row-fluid">
	<div class="span12 center login-header">
		<h2><?php echo config_item('site_name').' - '?> Administrator</h2>
	</div><!--/span-->
</div><!--/row-->

<div class="row-fluid">
	<div class="well span5 center login-box">
		<div class="alert alert-info">
			Please login with Username and Password.
		</div>
		<form class="form-horizontal" id="login-form" action="<?php echo site_url('/admin/user/login');?>" method="post">
			<input type="hidden" name="action" value="login">
			<fieldset>
				<?php if ($this->session->flashdata('LOGIN_STATUS') == 'faild') { ?>
				<div class="error input-prepend">Your email or password is invalid.</div>
				<div class="clearfix"></div>
				<?php } else if ($this->session->flashdata('LOGIN_STATUS') == 'block') {?>
				<div class="error input-prepend">You are blocked.</div>
				<div class="clearfix"></div>
				<?php }?>
				
				<div class="input-prepend" title="Username" data-rel="tooltip">
					<span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="username" id="username" type="text" value="" />
				</div>
				<div class="clearfix"></div>

				<div class="input-prepend" title="Password" data-rel="tooltip">
					<span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="userpasswd" id="userpasswd" type="password" value="" />
				</div>
				<div class="clearfix"></div>

				<!-- <div class="input-prepend">
				<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>
				</div>
				<div class="clearfix"></div> -->

				<p class="center span5">
				<button type="submit" class="btn btn-primary">Login</button>
				</p>
			</fieldset>
		</form>
	</div><!--/span-->
</div><!--/row-->

