<!--Title Header-->
<title>Item Management System - Item Request List</title>
<!--Title Header ends-->

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Item Request Lists</h1>
        <p class="mb-0">The item request list was submitted to the procurement department to replenish essential supplies for the upcoming project. It meticulously detailed the specific items, quantities, and delivery deadlines to ensure a smooth and efficient restocking process.</p>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
          <li class="breadcrumb-item active">Item Request List</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content" id="items">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-outline card-purple">
          <div class="card-header">
            <h3 class="card-title"></h3>
            <div class="card-tools">
              <?php if ($_settings->userdata('type') == 1) : ?>
                <div class="input-group-append">
                  <a href="<?php echo base_url ?>admin/?page=inventory_request/manage_inventory_request" class="btn btn-block btn-outline-dark">
                    Create Request
                    <i class="fas fa-plus"></i>
                  </a>
                </div>
            </div>
          <?php endif; ?>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Date Created</th>
                  <th>Inventory Request Code</th>
                  <th>Prepared By</th>
                  <th>Item/s</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                $qry = $conn->query("SELECT i.*, u.firstname as users FROM `inventory_request_list` i inner join users u on i.users_id = u.id order by i.`date_created` desc");
                while ($row = $qry->fetch_assoc()) :
                  $row['items'] = count(explode(',', $row['ir_stock_ids']));
                ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo date('F j, Y | g:i A', strtotime($row['date_created'])) ?></td>
                    <td><?php echo $row['ir_code'] ?></td>
                    <td><?php echo $row['users'] ?></td>
                    <td><?php echo number_format($row['items']) ?></td>
                    <td>₱ <?php echo number_format($row['amount'], 2) ?></td>
                    <td>
                      <?php if ($row['status'] == 0) : ?>
                        <span class="badge badge-primary rounded-pill">Pending</span>
                      <?php elseif ($row['status'] == 1) : ?>
                        <span class="badge badge-success rounded-pill">Approved</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        Action
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="<?php echo base_url . 'admin?page=inventory_request/view_inventory_request&id=' . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url . 'admin?page=inventory_request/manage_inventory_request&id=' . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
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
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Page specific script -->
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  $(document).ready(function() {
    $('.delete_data').click(function() {
      _conf("Are you sure to delete this Inventory Request permanently?", "delete_ir", [$(this).attr('data-id')])
    })
    //$('.table td,.table th').addClass('py-1 px-2 align-middle')
    //$('.table').dataTable();
  })

  function delete_ir($id) {
    start_loader();
    $.ajax({
      url: _base_url_ + "classes/Master.php?f=delete_ir",
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