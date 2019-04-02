<div>
	<ul class="breadcrumb">
		<li><?php echo anchor(site_url('/admin'), 'Main');?> <span class="divider">/</span></li>
		<li><?php echo anchor(site_url('/admin/blog/category'), 'Blog');?></li>
	</ul>
</div>
<script type="text/javascript">
$(document).ready(function(e) {
	$('.btn-addnew').click(function(e){
		e.preventDefault();
		$('#category-modal').find('#title').text('Add new category');
		$('#category-modal').modal('show');
		$('#category-modal').find('#modalform').validate({
			rules: {
				c_name: { required: true }
			},
			messages: {
				c_name: { required: "" }
			},
			submitHandler: function() {
				$.post("<?php echo site_url('admin/blog/category_add');?>", {name:$('#c_name').val(), desc:$('#c_desc').val()}, function(result){
					if (result == 'ok') {
						$('#c_name').val('');
						$('#c_desc').val('');
						location.reload();
					} else {
						alert(result);
					}
				});
				return false;
	        }
		});
	});
	$('.btn-edit').click(function(e){
		e.preventDefault();
		var cid = $(this).attr('data-id');
		$('#c_name').val($(this).parent().parent().find('#name').text());
		$('#c_desc').val($(this).parent().parent().find('#desc').text());
		$('#category-modal').find('#title').text('Edit category');
		$('#category-modal').modal('show');
		$('#category-modal').find('#modalform').validate({
			rules: {
				c_name: { required: true }
			},
			messages: {
				c_name: { required: "" }
			},
			submitHandler: function() {
				$.post("<?php echo site_url('admin/blog/category_edit');?>", {cid:cid, name:$('#c_name').val(), desc:$('#c_desc').val()}, function(result){
					if (result == 'ok') {
						$('#c_name').val('');
						$('#c_desc').val('');
						location.reload();
					} else {
						alert(result);
					}
				});
				return false;
	        }
		});
	});
	$('.btn-delete').click(function(){
		if (confirm('Do you want to delete this category?'))
		{
			$.post("<?php echo site_url('admin/blog/category_delete');?>", {cid:$(this).attr('data-id')}, function(result){
				if (result == 'ok') {
					location.reload();
				} else {
					alert(result);
				}
			});
		}
	});
});
</script>
<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> Blog Category</h2>
			<div class="box-icon">
				<span class="btn btn-round btn-addnew btn-success"><i class="icon-plus icon-white"></i> Add New</span>
			</div>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable">
			<thead>
			<tr>
			  <th class="center">No</th>
			  <th>Category</th>
			  <th>Description</th>
			  <th class="center">Actions</th>
			</tr>
			</thead>   
			<tbody>
				<?php 
				if ($contents) :
				$i = 1;
				foreach ($contents as $item) 
				{
				?>
				<tr>
					<td class="center"><?php echo $i;?></td>
					<td><span id="name"><?php echo $item->category;?></span></td>
					<td><span id="desc"><?php echo $item->description;?></span></td>
					<td class="center" nowrap>
						<a class="btn btn-small btn-primary btn-edit" data-id="<?php echo $item->id;?>"><i class="icon-edit icon-white"></i> Edit</a>
						<a class="btn btn-small btn-danger btn-delete" data-id="<?php echo $item->id;?>"><i class="icon-trash icon-white"></i> Delete</a>
					</td>
				</tr>
				<?php 
					$i++;
				}
				endif;
				?>
			</tbody>
			</table>
		</div>
	</div><!--/span-->
</div><!--/row-->

<div class="modal hide fade" id="category-modal">
<form id="modalform">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h3 id="title"></h3>
	</div>
	<div class="modal-body">
		<div><input class="inputSmall span12" type="text" name="c_name" id="c_name" placeholder="Input category name"/></div>
		<div><textarea class="inputSmall span12" id="c_desc" name="c_desc" rows="5" placeholder="Input category description"></textarea></div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary"> Save </button>
		<button class="btn" data-dismiss="modal">Cancel</button>
	</div>
</form>
</div>
