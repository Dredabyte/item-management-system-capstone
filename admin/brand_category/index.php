<!--Title Header-->
<title>Item Management System - Brand & Category Lists</title>
<!--Title Header ends-->

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Brand & Category Lists</h1>
        <p class="mb-0">The Brand and Category lists encompass a compilation of available items linked to specific brands and categories, facilitating seamless categorization for efficient inventory management.</p>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
          <li class="breadcrumb-item active">Brand & Category Lists</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>
              <?php
              echo $conn->query("SELECT * FROM `brand_list` where id != 1 ")->num_rows;
              ?>
            </h3>
            <p>Brand Lists</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>
              <?php
              echo $conn->query("SELECT * FROM `category_list` where id != 1 ")->num_rows;
              ?>
            </h3>
            <p>Category Lists</p>
          </div>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->

  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- Main content -->
<section class="content" id="table_1">
  <div class="container-fluid">
    <!-- /.row -->
    <div class="row">
      <div class="col-6" id="brand">
        <div class="card card-outline card-success">
          <div class="card-header">
            <h3 class="card-title"></h3>
            <div class="card-tools">
              <div class="input-group-append">
                <a href="javascript:void(0)" id="create_new_brand" class="btn btn-block btn-outline-dark">
                  Add
                  <i class="fas fa-plus"></i>
                </a>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table id="" class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Brand Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                $qry = $conn->query("SELECT * from `brand_list`  order by `name` asc ");
                while ($row = $qry->fetch_assoc()) :
                ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td>
                      <?php if ($row['status'] == 1) : ?>
                        <span class="badge badge-success rounded-pill">Active</span>
                      <?php else : ?>
                        <span class="badge badge-danger rounded-pill">Inactive</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <button type="button" class="btn btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        Action
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item edit_data_brand" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item delete_data_brand" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                      </div>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-6" id="category">
        <div class="card card-outline card-warning">
          <div class="card-header">
            <h3 class="card-title"></h3>
            <div class="card-tools">
              <div class="input-group-append">
                <a href="javascript:void(0)" id="create_new_category" class="btn btn-block btn-outline-dark">
                  Add
                  <i class="fas fa-plus"></i>
                </a>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Category Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                $qry = $conn->query("SELECT * from `category_list`  order by `name` asc ");
                while ($row = $qry->fetch_assoc()) :
                ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td>
                      <?php if ($row['status'] == 1) : ?>
                        <span class="badge badge-success rounded-pill">Active</span>
                      <?php else : ?>
                        <span class="badge badge-danger rounded-pill">Inactive</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <button type="button" class="btn btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        Action
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item edit_data_category" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item delete_data_category" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                      </div>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

  $(document).ready(function() {
    //functions for Category List
    $('#create_new_category').click(function() {
      uni_modal("<i class='fa fa-plus'></i> Add New Category", "brand_category/manage_category.php", "mid-large")
    })
    $('.edit_data_category').click(function() {
      uni_modal("<i class='fa fa-edit'></i> Edit Category Details", "brand_category/manage_category.php?id=" + $(this).attr('data-id'), "mid-large")
    })
    $('.delete_data_category').click(function() {
      _conf("Are you sure to delete this Category details permanently?", "delete_category", [$(this).attr('data-id')])
    })

    //functions for Brand List
    $('#create_new_brand').click(function() {
      uni_modal("<i class='fa fa-plus'></i> Add New Brand", "brand_category/manage_brand.php", "mid-large")
    })
    $('.edit_data_brand').click(function() {
      uni_modal("<i class='fa fa-edit'></i> Edit Brand Details", "brand_category/manage_brand.php?id=" + $(this).attr('data-id'), "mid-large")
    })
    $('.delete_data_brand').click(function() {
      _conf("Are you sure to delete this Brand details permanently?", "delete_brand", [$(this).attr('data-id')])
    })

    //$('.table td,.table th').addClass('py-1 px-2 align-middle')
    //$('.table').dataTable();
  })

  function delete_category($id) {
    start_loader();
    $.ajax({
      url: _base_url_ + "classes/Master.php?f=delete_category",
      method: "POST",
      data: {
        id: $id
      },
      dataType: "json",
      error: err => {
        console.log(err)
        alert_toast("An error occured.", 'error');
        end_loader();
      },
      success: function(resp) {
        if (typeof resp == 'object' && resp.status == 'success') {
          location.reload();
        } else {
          alert_toast("An error occured.", 'error');
          end_loader();
        }
      }
    })
  }

  function delete_brand($id) {
    start_loader();
    $.ajax({
      url: _base_url_ + "classes/Master.php?f=delete_brand",
      method: "POST",
      data: {
        id: $id
      },
      dataType: "json",
      error: err => {
        console.log(err)
        alert_toast("An error occured.", 'error');
        end_loader();
      },
      success: function(resp) {
        if (typeof resp == 'object' && resp.status == 'success') {
          location.reload();
        } else {
          alert_toast("An error occured.", 'error');
          end_loader();
        }
      }
    })
  }
</script>