<!--Title Header-->
  <title>Item Management System - Profile</title>
<!--Title Header ends-->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php 
    $user = $conn->query("SELECT * FROM users where id ='".$_settings->userdata('id')."'");
      foreach($user->fetch_array() as $k =>$v){
        $meta[$k] = $v;
      }
    ?>

    <?php if($_settings->chk_flashdata('success')): ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
      </script>
    <?php endif;?>
    <!-- Main content -->
    <section class="content ">
          <div class="container-fluid">
            <div class="card card-outline card-pink">
              <div class="card-body">
                <div class="container-fluid">
                  <div id="msg"></div>

                  <!--form-->
                    <form action="" id="manage-user">	
                      <input type="hidden" name="id" value="<?php echo $_settings->userdata('id') ?>">
                      <div class="form-group">
                        <label for="name">First Name</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo isset($meta['firstname']) ? $meta['firstname']: '' ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Middle Name</label>
                        <input type="text" name="middlename" id="middlename" class="form-control" value="<?php echo isset($meta['middlename']) ? $meta['middlename']: '' ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Last Name</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo isset($meta['lastname']) ? $meta['lastname']: '' ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo isset($meta['email']) ? $meta['email']: '' ?>" required  autocomplete="off">
                      </div>
                      <div class="form-group">
                        <label for="password">Password<small><i class="text-danger"> &nbsp;&nbsp;&nbsp;(We <b>RECOMMEND</b> you to change your password every month.)</i></small></label>
                        <input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
                        <small class="text-info"><i>Leave this blank if you don't want to change the password.</i></small>
                      </div>
                      <div class="form-group">
                        <label for="" class="control-label">Avatar</label>
                        <div class="custom-file">
                                <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                              </div>
                      </div>
                      <div class="form-group d-flex justify-content-center">
                        <img src="<?php echo validate_image(isset($meta['avatar']) ? $meta['avatar'] :'') ?>" alt="Profile" id="cimg" class="img-fluid img-thumbnail">
                      </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary" form="manage-user">Update</button>
                      </div>
                    </form>
                  <!--form-->
                  
                 </div>
              </div>
            </div>
          <style> img#cimg{ height: 15vh; width: 15vh; object-fit: cover; border-radius: 100% 100%; } </style>          
        </div>
        <!-- /.card -->        
      </section>    
    <!--/main content-->

  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage-user').submit(function(e){
		e.preventDefault();
var _this = $(this)
		start_loader()
		$.ajax({
			url:_base_url_+'classes/Users.php?f=save',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp ==1){
					location.reload()
				}else{
					$('#msg').html('<div class="alert alert-danger"><i class="icon fas fa-ban"></i>Email is already used.</div>')
					end_loader()
				}
			}
		})
	})

</script>