<div>
	<ul class="breadcrumb">
		<li><?php echo anchor(site_url('/admin/'), 'Main');?> <span class="divider">/</span></li>
		<li><?php echo anchor(site_url('/admin/main/notice'), 'Notice');?></li>
	</ul>
</div>
<script type="text/javascript">
<!--
$('document').ready(function(){
	$(".accordion").collapse();
});
//-->
</script>
<div class="accordion" id="notice-pannel">
	
<?php 
if ($notice && is_array($notice))
{
	$opener = 'in';
	foreach ($notice as $item)
	{
?>
	<div class="accordion-group">
		<div class="accordion-heading box-header well">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#notice-pannel" href="<?php echo '#notice_'.$item->category;?>">
                  <i class="icon-edit"></i> <?php echo $item->category;?> <?php if ($item->state == 'N') { ?><span style="margin-left: 5px; color: #666; font-size: 15px;">[Disabled]</span><?php } ?>
			</a>
		</div>
		<div id="<?php echo 'notice_'.$item->category;?>" class="accordion-body collapse <?php echo $opener;?>">
			<div class="accordion-inner">
				<div class="page-header">
					<?php echo $item->subject;?>
				</div>  			
				<div>
					<div class="well">
					<?php echo $item->content;?>
					</div>
				</div>
  		  	</div>
			<div class="accordion-inner control-group">
			  <a class="btn btn-small btn-primary" href="<?php echo site_url('/admin/main/notice/edit/'.$item->category);?>"><i class="icon-edit icon-white"></i> Edit</a>
			  <?php if ($item->state == 'N') {?>
			  <a class="btn btn-small btn-success" href="<?php echo site_url('/admin/main/notice/activate/'.$item->category);?>"><i class="icon-ok icon-white"></i> Active</a>
			  <?php } else {?>
			  <a class="btn btn-small btn-warning" href="<?php echo site_url('/admin/main/notice/disable/'.$item->category);?>"><i class="icon-remove icon-white"></i> Disable</a>
			  <?php } ?>
			  <a class="btn btn-small btn-danger" href="#" onclick="javascript:if (confirm('Do you want to delete the notice?')) {location.href = '<?php echo site_url('/admin/main/notice/delete/'.$item->category);?>'};"><i class="icon-trash icon-white"></i> Delete</a>
			</div>
		</div>
	</div><!--/span-->
<?php 
		if ($opener == 'in') {
			$opener = '';
		}
	}
}
else {
?>
	<div class="alert alert-error">
	<strong>Warning!</strong> Empty data.
	</div>
<?php 
}
?>
	<div class="box-content control-group">
	  <a class="btn btn-primary" href="<?php echo site_url('/admin/main/notice/new');?>"><i class="icon-plus icon-white"></i> Add new</a>
	</div>
</div><!--/row-->

