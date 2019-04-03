<div>
	<ul class="breadcrumb">
		<li><?php echo anchor(site_url('/admin/blog'), 'Blog');?> <span class="divider">/</span></li>
		<li><?php echo anchor(site_url('/admin/blog/index'), 'List');?></li>
	</ul>
</div>
<script type="text/javascript">
function delete_data(id) {
	if (!confirm('Do you want to delete the user?'))
		return;
	$.post("<?php echo site_url('admin/blog/delete');?>", {blogid:id}, function(result){
		if (result == 'ok') {
			location.reload();
		} else {
			alert(result);
		}
	});
}
</script>
<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-list"></i> Blog management</h2>
			<span class="desc">Total: <?php echo $total_num;?></span>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable">
			<thead>
			<tr>
			  <th class="center">No</th>
			  <th>Category</th>
			  <th>Subject</th>
			  <th>Author</th>
			  <th>Publish Date</th>
			  <th class="center">Allow / Deny</th>
			  <th class="center">Actions</th>
			</tr>
			</thead>   
			<tbody>
				<?php 
				if ($contents) :
				$i = $start_no + 1;
				foreach ($contents->result() as $item) 
				{
				?>
				<tr>
					<td class="center"><?php echo $i;?></td>
					<td><?php echo $item->category;?></td>
					<td>
						<?php echo anchor(site_url('/admin/blog/view/'.$item->id), $item->subject, 'title="View"');?>
						<?php if ($item->comments > 0) { ?>
							<span class="blog-comment">[<?php echo $item->comments;?>]</span>
						<?php }?>
					</td>
					<td><?php echo anchor(site_url('/admin/user/edit/'.$item->userid), $item->name, 'title="Edit User"');?></td>
					<td><?php echo $item->publish_date;?></td>
					<td class="center">
						<?php if ($item->allow == 'Y') { ?>
						<span class="label label-success">Allow</span>
						<?php } else {?>
						<span class="label">Deny</span>
						<?php }?>
					</td>
					<td class="center">
						<a class="btn btn-small btn-primary" href="<?php echo site_url('admin/blog/view/'.$item->id);?>"><i class="icon-list-alt icon-white"></i> View</a>
						<a class="btn btn-small btn-danger" href="#" onclick="javascript:delete_data(<?php echo $item->id;?>);"><i class="icon-trash icon-white"></i> Delete</a>
					</td>
				</tr>
				<?php 
					$i++;
				}
				endif;
				?>
			</tbody>
			</table>
		  	<?php 
			if ($pagination)
			{
				echo $pagination;
			}
		  	?>
		</div>
	</div><!--/span-->

</div><!--/row-->
