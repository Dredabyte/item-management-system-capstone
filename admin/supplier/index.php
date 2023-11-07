<!--Title Header-->
<title>Item Management System - Suppliers</title>
<!--Title Header ends-->

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Master Lists - Suppliers</h1>
        <p class="mb-0">The Master Lists for Suppliers provide a comprehensive compilation including names, addresses, contact details, and availability status, if applicable. This consolidated information streamlines supplier management and enhances procurement efficiency.</p>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
          <li class="breadcrumb-item active">Suppliers</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!--style for avatar-->
<!--style>
    .img-avatar{
        width:45px;
        height:45px;
        object-fit:cover;
        object-position:center center;
        border-radius:100%;
    }
  </style -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card card-outline card-pink">
          <div class="card-header">
            <h3 class="card-title"></h3>
            <div class="card-tools">
              <div class="input-group-append">
                <a href="javascript:void(0)" id="create_new" class="btn btn-block btn-outline-dark">
                  Create New
                  <i class="fas fa-plus"></i>
                </a>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0" style="height: 300px;">
            <table class="table table-hover text-nowrap">

              <thead>
                <tr>
                  <th>ID</th>
                  <th>Date Added</th>
                  <th>Supplier Name</th>
                  <th>Address</th>
                  <th>Contact Details</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                $qry = $conn->query ("SELECT * from `supplier_list`  order by `name` asc ");
                while ($row = $qry->fetch_assoc()) :
                ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo date('F j, Y | g:i A', strtotime($row['date_created'])) ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['address'] ?></td>
                    <td><?php echo $row['contact'] ?></td>
                    <td class="text-center">
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
                        <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
  </div>
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
  $(document).ready(function() {
    $('.delete_data').click(function() {
      _conf("Are you sure to delete this Supplier permanently?", "delete_supplier", [$(this).attr('data-id')])
    })
    $('#create_new').click(function() {
      uni_modal("<i class='fa fa-plus'></i> Add New Supplier", "supplier/manage_supplier.php", "mid-large")
    })
    $('.edit_data').click(function() {
      uni_modal("<i class='fa fa-edit'></i> Edit Supplier Details", "supplier/manage_supplier.php?id=" + $(this).attr('data-id'), "mid-large")
    })
    $('.view_data').click(function() {
      uni_modal("<i class='fas fa-address-book'></i> Supplier Details", "supplier/view_supplier.php?id=" + $(this).attr('data-id'), "")
    })
    //$('.table td,.table th').addClass('py-1 px-2 align-middle')
    //$('.table').dataTable();
  })

  function delete_supplier($id) {
    start_loader();
    $.ajax({
      url: _base_url_ + "classes/Master.php?f=delete_supplier",
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