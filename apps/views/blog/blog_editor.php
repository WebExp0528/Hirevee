<script type="text/javascript" src="<?php echo base_url('/template/fckeditor/')?>/fckeditor.js"></script>
<!--**************************************** editor body *********************************************-->
<?php if (!isset($blog_data)):?>
<?php 

	echo form_open_multipart('blog/add_blog', array('method' => 'post', 'id' => 'add_blogform', 'name' => 'addblog'));
	
	?>
<div class="row-fluid blog_editor">
	<div class="row-fuid blog_editor_header">
	
		<div class="span2 info offset1" >
		<div class="control-group info">
		<input id="subject" name="subject" type="text" placeholder=" Type Subject "></div>
		 </div>
		<div class="span4 ">	
			<div class="control-group info">			  
			  <span class="control-label" for="inputInfo"> select category </span>
				   <select name="category">
				   <?php foreach ($category as $item):?>
					  <option><?php echo $item->category;?></option>
					  <?php endforeach;?>
					</select>		    			
			</div>				 	
		</div>
		<div class="span4 info" >
			<div class="control-group info">
					<input type="file" name='file_uploaded' id="upload_file"  >						
									
			</div>
		</div> 

	</div>
	<div class="row-fluid blog_editor_body" >
		<div class="blog_editor span12 offset1 " >						
			<script type="text/javascript">
				var oFCKeditor = new FCKeditor( 'content' ) ; 
				oFCKeditor.BasePath	= "<?php echo base_url('/template/fckeditor')?>/";
				oFCKeditor.Height	=450 ;  
				oFCKeditor.Width	="70%" ;				   
				oFCKeditor.ToolbarSet = "Default";
				oFCKeditor.Value	= '' ;
				oFCKeditor.Create() ;  
					
			</script>
			</div>
	</div>
	<div class="blog_editor_submit offset1">
		<p>
			<input type="hidden" name="blog_content" id="content_blog" value=''>
		  <button id="add_btn" class="btn btn-small btn-primary" type="submit"> addblog_btn  </button>
		  <button class="btn btn-small" type="reset" onclick="cancel()">Cancel</button>
		</p>
	</div>


</div>
</form>
<?php else :?>
<?php 

	echo form_open_multipart('blog/update_blog', array('method' => 'post', 'id' => 'update_blogform', 'name' => 'updateblog'));
	
	?>
<div class="row-fluid blog_editor">
	<div class="row-fuid blog_editor_header offset1">
	
		<div class="span2 info" >
		<div class="control-group info">
		<input id="subject" name="subject" type="text" value="<?php echo $blog_data[0]->subject;?>" ></div>
		 </div>
		<div class="span4 ">	
			<div class="control-group info">			  
			  <span class="control-label" for="inputInfo"> select category </span>
				   <select name="category">
				   <?php foreach ($category as $item):?>
					  <option><?php echo $item->category;?></option>
					  <?php endforeach;?>
					</select>		    			
			</div>				 	
		</div>
		<div class="span4 info" >
			<div class="control-group info">
					<input type="file" name='file_uploaded' id="upload_file"  >						
									
			</div>
		</div> 

	</div>
	<div class="row-fluid blog_editor_body" >
		<div class="blog_editor span12 offset1" >						
			<script type="text/javascript">
				var oFCKeditor = new FCKeditor( 'content' ) ; 
				oFCKeditor.BasePath	= "<?php echo base_url('/template/fckeditor')?>/";
				oFCKeditor.Height	=450 ;  
				oFCKeditor.Width	="70%" ;				   
				oFCKeditor.ToolbarSet = "Default";
				oFCKeditor.Value	= '<?php echo $blog_data[0]->content;?>' ;
				oFCKeditor.Create() ;  
					
			</script>
			</div>
	</div>
	<div class="blog_editor_submit offset1">
		<p>
			<input type="hidden" name="blog_id" id="blog_blog" value="<?php echo $blog_id; ?>">
			<input type="hidden" name="update" id="update" value=''>
		  <button id="add_btn" class="btn btn-small btn-primary" type="submit"> update  </button>
		  <button class="btn btn-small" type="reset" onclick="cancel()">Cancel</button>
		</p>
	</div>


</div>
</form>

<?php endif;?>
<script type="text/javascript">

 function cancel(){
		window.location='<?php echo base_url('blog');?>';
 }
 var fckObj;
 function FCKeditor_OnComplete( editorInstance ) {
     fckObj=editorInstance;
 } 
 $('#add_blogform').submit(function() {		
	   
	    if($('#subject').val()== '') {
		   	 alert("Type your subject!");
	         return false;
	    }else if(fckObj.GetHTML()==''){
				alert("input blog content!");
				return false;
	    } 
	    else {
		   	$('#content_blog').val( fckObj. GetHTML());		  
		    return true;
	    }
	});

 $('#update_blogform').submit(function() {		
	   
	    if($('#subject').val()== '') {
		   	 alert("Type your subject!");
	         return false;
	    }else if(fckObj.GetHTML()==''){
				alert("input blog content!");
				return false;
	    } 
	    else {
		   	$('#update').val( fckObj. GetHTML());		   
		   return true;
	    }
	});
</script>