<?php
require_once('../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
	$qry = $conn->query("SELECT * from `item_list` where id = '{$_GET['id']}' ");
	if ($qry->num_rows > 0) {
		foreach ($qry->fetch_assoc() as $k => $v) {
			$$k = $v;
		}
	}
}
?>
<div class="container-fluid">
	<form action="" id="item-form">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="form-group">
			<label for="" class="control-label">Item Image</label>
			<div class="custom-file">
				<input type="file" class="custom-file-input rounded-circle" id="customFile" name="image" onchange="displayImg(this,$(this))">
				<label class="custom-file-label" for="customFile">Choose file</label>
			</div>
		</div>
		<div class="form-group d-flex justify-content-center">
			<img src="<?php echo validate_image(isset($image) ? $image : '') ?>" alt="Item Image" id="item_img" class="img-fluid img-thumbnail">
		</div>
		<div class="form-group">
			<label for="name" class="control-label">Item Name</label>
			<input type="text" name="name" id="name" class="form-control rounded-0" value="<?php echo isset($name) ? $name : ''; ?>">
		</div>
		<div class="form-group">
			<label for="description" class="control-label">Description</label>
			<textarea name="description" id="description" cols="30" rows="2" class="form-control form no-resize"><?php echo isset($description) ? $description : ''; ?></textarea>
		</div>
		<div class="form-group">
			<label for="brand_id" class="control-label">Brand</label>
			<select name="brand_id" id="brand_id" class="custom-select">
				<option <?php echo !isset($brand_id) ? 'selected' : '' ?> disabled></option>
				<?php
				$brand = $conn->query("SELECT * FROM `brand_list` where status = 1 order by `name` asc");
				while ($row = $brand->fetch_assoc()) :
				?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($brand_id) && $brand_id == $row['id'] ? "selected" : "" ?>><?php echo $row['name'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="category_id" class="control-label">Category</label>
			<select name="category_id" id="category_id" class="custom-select">
				<option <?php echo !isset($category_id) ? 'selected' : '' ?> disabled></option>
				<?php
				$category = $conn->query("SELECT * FROM `category_list` where status = 1 order by `name` asc");
				while ($row = $category->fetch_assoc()) :
				?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($category_id) && $category_id == $row['id'] ? "selected" : "" ?>><?php echo $row['name'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="cost" class="control-label">Cost</label>
			<input type="number" name="cost" id="cost" step="any" min="0" class="form-control rounded-0 text-end" value="<?php echo isset($cost) ? $cost : ''; ?>">
		</div>
		<div class="form-group">
			<label for="supplier_id" class="control-label">Supplier Name</label>
			<select name="supplier_id" id="supplier_id" class="custom-select">
				<option <?php echo !isset($supplier_id) ? 'selected' : '' ?> disabled></option>
				<?php
				$supplier = $conn->query("SELECT * FROM `supplier_list` where status = 1 order by `name` asc");
				while ($row = $supplier->fetch_assoc()) :
				?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($supplier_id) && $supplier_id == $row['id'] ? "selected" : "" ?>><?php echo $row['name'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="status" class="control-label">Status</label>
			<select name="status" id="status" class="custom-select selevt">
				<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
				<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
			</select>
		</div>
	</form>
</div>
<script>
	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#item_img').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
	$(document).ready(function() {
		//$('.select2').select2({placeholder:"Please Select here",width:"relative"})
		//$('.select3').select3({placeholder:"Please Select here",width:"relative"})
		//$('.select4').select4({placeholder:"Please Select here",width:"relative"})
		$('#item-form').submit(function(e) {
			e.preventDefault();
			var _this = $(this)
			$('.err-msg').remove();
			start_loader();
			$.ajax({
				url: _base_url_ + "classes/Master.php?f=save_item",
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				dataType: 'json',
				error: err => {
					console.log(err)
					alert_toast("An error occured", 'error');
					end_loader();
				},
				success: function(resp) {
					if (typeof resp == 'object' && resp.status == 'success') {
						location.reload();
					} else if (resp.status == 'failed' && !!resp.msg) {
						var el = $('<div>')
						el.addClass("alert alert-danger err-msg").text(resp.msg)
						_this.prepend(el)
						el.show('slow')
						end_loader()
					} else {
						alert_toast("An error occured", 'error');
						end_loader();
						console.log(resp)
					}
				}
			})
		})
	})
</script>