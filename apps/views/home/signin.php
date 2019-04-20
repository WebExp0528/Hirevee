	<div class="basic-modal-login">
		<div class="signin">
			<div class="alert_inner_window">
				<div class="titleContainer">
					<span class="title">Derzeit geschlossen!</span>
				</div>
				<div class="lightboxContent_login">
					<div class="loginBox">
						<form id="head_loginform_form" method="post" action="<?php echo base_url('/verifing');?>">
							<div class="loginInputfields">
								<div class="loginInputfield">
									<input class="inputSmall" type="text" name="enter_email" id="enter_email" placeholder="E-Mail"/>
								</div>
								<div class="loginInputfield">
									<input class="inputSmall" type="text" name="enter_code" id="enter_code" placeholder="VerifyCode"/>
								</div>
								<div class="clear-both"></div>
							</div>
							<p class="message"></p>
							<div>
							<div class="submit">
									<div class="loginLinkPwd">
										Passwort vergessen?
									</div>

								<input class="loginSubmit" id="id-login-btn" type="submit" value="Login">
							</div>
							</div>
						</form>
					</div>
				</div>
			</div>
</div>