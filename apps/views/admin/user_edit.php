<div>
	<ul class="breadcrumb">
		<li><?php echo anchor(site_url('/admin/user'), 'User');?> <span class="divider">/</span></li>
		<li><?php echo anchor(site_url('/admin/user/edit/'.$userinfo->id), 'Edit');?></li>
	</ul>
</div>
<script type="text/javascript">
<!--
$(document).ready(function(e) {
	$('#frm_profile').validate({
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
	<div class="span8">
		<div class="row-fluid sortable">
        	<div class="box span12">
        		<div class="box-header well" data-original-title>
        			<h2><i class="icon-edit"></i> User Logo </h2>
        		</div>
        		<div class="box-content row-fluid">
        			<?php 
        			$banner_color = ($userinfo->banner_color) ? $userinfo->banner_color : '#FFFFFF';
        			$logo_img = ($userinfo->logo_path && !empty($userinfo->logo_path)) ? config_item('logo_recruiter_url').$userinfo->logo_path : config_item('image_url').'add_logo.gif';
        			?>
        			<div class="span6">
                        <div class="user-logo" id="logo_img" style="background-color: <?php echo $banner_color;?>;"
                        data-toggle="modal" data-target="#add_logo_modal">
                        	<img src="<?php echo $logo_img;?>" width="100%" height="100%" title="Change your Logo">
                        </div>
                        
                        <!-- <<<<< ADD LOGO MODAL START --> 
                        <div id="add_logo_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        	<div class="modal-header">
                        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        		<h3 id="myModalLabel">Change Logo Image Here</h3>
                        	</div>
                        	<div class="modal-body">
                        		<div class="row-fluid">
                        			<div class="span6">Your Logo Image URL:</div>
                            		<div class="span6">
                            			<form enctype="multipart/form-data" action="<?php echo site_url('admin/user/add_logo');?>" method="post">
                            				<input type="hidden" name="user_id" id="user_id" value="<?php echo $userinfo->id;?>">
                            				<input type="file" name="userfile" size="27" />
                            				<br /><br /><br />
                            				<button class="btn btn-primary" id="btn_add_logo" type="submit">Save changes</button>
                            				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            			</form>
                            		</div>
                        		</div>
                        	</div>
                        </div>
                        <!-- >>>>>  ADD LOGO MODAL END -->
                        
  					</div>
        			<div class="span6">
        				<div class="user-logo-action">
                  			<div>
                  				<a href="#change_banner_color_modal" role="button" class="change_banner_color btn btn-normal" data-toggle="modal">Change Banner Color</a>
                  			</div>
                            <!-- <<<<< CHANGE BANNER COLOR MODAL START --> 
                            <div id="change_banner_color_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 500px; height: 300px;">
                            	<div class="modal-header">
                            		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            		<h3 id="myModalLabel">Change your banner color here</h3>
                            	</div>
                            	<div class="modal-body" style="width: 500px; height: 200px;">
                            		<div class="row-fluid"><br><br>
                            		<div class="span4 offset1">Your banner color</div>
                            		<div class="span5">
                            		<input class="color input-small" id="banner_color"
                            			onchange="document.getElementById('logo_img').style.backgroundColor = '#'+this.color"
                            			 value="<?php echo $banner_color;?>">
                            		</div>
                            		</div>
                            	</div>
                            	<div class="modal-footer">
                            		<span class="message_banner"></span>
                            		<a class="close" data-dismiss="alert" href="#"></a>
                            		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            		<button class="btn btn-primary" id="btn_change_banner_color">Change</button>
                            	</div>
                            </div>
                            <!-- >>>>>  CHANGE BANNER COLOR MODAL END -->
                  			<div>
                  				<a href="#change_banner_image_modal" role="button" class="change_banner_image btn btn-normal" data-toggle="modal">Change Banner Image</a>
                  			</div>
                  			<div>
                  				<a href="#add_profile_video_modal" role="button" class="add_profile_video btn btn-normal" data-toggle="modal">Add Opening Profile Video</a>
                  			</div>
              			</div>
        			</div>
        		</div>
        	</div>
		</div>
        <div class="row-fluid sortable">
        	<div class="box span6">
        		<div class="box-header well" data-original-title>
        			<h2><i class="icon-edit"></i> Jobs </h2>
        		</div>
        		<div class="box-content">
                    <span class="span4 input-xlarge uneditable-input" style="width: auto; height: 120px; overflow: auto; text-align: left;">
                    <?php 
                    if ($jobs && count($jobs) > 0)
                    {
                    	foreach ($jobs as $job)
                    	{
                    		echo $job->job_name.'<br>';
                    	}
                    }
                    else
                    {
                        echo 'Empty data';
                    }
                    ?>
                    </span>
                    <a href="#add_job_modal" role="button" class="btn btn-primary" data-toggle="modal">Add Job</a>
        		</div>
        	</div>
        	<div class="box span6">
        		<div class="box-header well" data-original-title>
        			<h2><i class="icon-edit"></i> Industries </h2>
        		</div>
        		<div class="box-content">
          			<span class="span4 input-xlarge uneditable-input" style="width: auto; height: 120px; overflow: auto; text-align: left;">
          			<?php 
                    if ($industries && count($industries) > 0)
                    {
                    	foreach ($industries as $industry)
                    	{
                    		echo $industry->industry_name.'<br>';
                    	}
                    }
                    else
                    {
                        echo 'Empty data';
                    }
          			?>
          			</span>
          			<a href="#add_industry_modal" role="button" class="btn btn-primary" data-toggle="modal">Add Industries</a>
        		</div>
        	</div>
        </div>
        <div class="row-fluid sortable">
        	<div class="box span12">
        		<div class="box-header well" data-original-title>
        			<h2><i class="icon-edit"></i> Questions </h2>
        		</div>
        		<div class="box-content">
                    <span class="span4 input-xlarge uneditable-input" style="width: auto; height: 120px; overflow: auto; text-align: left;">
                    <?php 
                    if ($questions && count($questions) > 0)
                    {
                    	foreach ($questions as $question)
                    	{
                    		echo $question->question.'<br>';
                    	}
                    }
                    else
                    {
                        echo 'Empty data';
                    }
                    ?>
                    </span><br>
                    <a href="#add_questions_modal" role="button" class="btn btn-primary" data-toggle="modal">Add Questions</a>
        		</div>
        	</div>
        </div>
	</div>
	<div class="box span4">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i> User Profile </h2>
		</div>
		<div class="box-content">
			<form class="form-horizontal frm-subbox" id="frm_profile" method="post">
			<input type="hidden" name="mode" value="update" />
				<fieldset>
                    <div class="control-group">
                        <label class="control-label" for="u_name">Name</label>
                        <div class="controls"><input class=" focused" id="u_name" name="u_name" type="text" value="<?php echo $userinfo->name;?>"></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="u_email">Email</label>
                        <div class="controls"><input class="" id="u_email" name="u_email" type="text" value="<?php echo $userinfo->email;?>"></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="u_company">Company</label>
                        <div class="controls"><input type="text" class="" id="u_company" name="u_company" value="<?php echo $userinfo->company;?>"></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="u_balance">Balance</label>
                        <div class="controls"><input type="text" class="" id="u_balance" name="u_balance" value="<?php echo $userinfo->balance;?>"></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Allow</label>
                        <div class="controls">
                            <label class="radio inline"><input type="radio" name="u_allow" id="u_allow" value="Y" <?php if ($userinfo->allow == 'Y') echo 'checked'?>>Allow</label>
                            <label class="radio inline"><input type="radio" name="u_allow" id="u_deny" value="N" <?php if ($userinfo->allow == 'N') echo 'checked'?>>Deny</label>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"><i class="icon icon-save icon-white"></i> Save</button>
                        <a class="btn" href="#" id="btn_cancel"><i class="icon icon-cancel icon-darkgray"></i> Cancel</a>
                    </div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
