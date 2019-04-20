<div>
	<ul class="breadcrumb">
		<li><?php echo anchor(site_url('/admin/user'), 'User');?> <span class="divider">/</span></li>
		<li><?php echo anchor(site_url('/admin/user/index'), 'List');?></li>
	</ul>
</div>
<script type="text/javascript">
function delete_data(id) {
	if (!confirm('Do you want to delete the user?'))
		return;
	$.post("<?php echo site_url('admin/user/delete');?>", {userid:id}, function(result){
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
			<h2><i class="icon-user"></i> Users management</h2>
			<span class="desc">Total: <?php echo $total_num;?></span>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable">
			<thead>
			<tr>
			  <th class="center">No</th>
			  <th>Name</th>
			  <th>Email</th>
			  <th>Company name</th>
			  <th>Reg Date</th>
			  <th class="center">Allow / Deny</th>
			  <th class="center">Actions</th>
			</tr>
			</thead>   
			<tbody>
				<?php 
				if ($contents) :
				$i = $start_no + 1;
				foreach ($contents->result() as $user_data) 
				{
				?>
				<tr>
					<td class="center"><?php echo $i;?></td>
					<td><?php echo $user_data->name;?>
						<?php if ($user_data->level == USER_ADMIN_LEVEL) { ?>
						<span class="label label-important">Admin</span>
						<?php }?>
					</td>
					<td><?php echo $user_data->email;?></td>
					<td><?php echo $user_data->company;?></td>
					<td><?php echo $user_data->reg_date;?></td>
					<td class="center">
						<?php if ($user_data->allow == 'Y') { ?>
						<span class="label label-success">Allow</span>
						<?php } else {?>
						<span class="label">Deny</span>
						<?php }?>
					</td>
					<td class="center">
						<a class="btn btn-small btn-primary" href="<?php echo site_url('admin/user/edit/'.$user_data->id);?>"><i class="icon-edit icon-white"></i> Edit</a>
						<a class="btn btn-small btn-danger" href="#" onclick="javascript:delete_data(<?php echo $user_data->id;?>);"><i class="icon-trash icon-white"></i> Delete</a>
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
