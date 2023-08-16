<!--Title Header-->
<title>Item Management System - Return Lists - Requesters</title>
</head>
<!--Title Header ends-->

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Return Lists - Requesters</h1>
        <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus velit praesentium minima, harum maiores asperiores deleniti veniam rerum maxime temporibus voluptas. Quas velit est voluptatum necessitatibus? Eos voluptate quaerat asperiores.</p>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
          <li class="breadcrumb-item active">Return Lists - Requesters</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card card-outline card-teal">
          <div class="card-header">
            <h3 class="card-title">Return Lists - Requesters</h3>
            <div class="card-tools">
              <div class="input-group-append">
                <a href="<?php echo base_url ?>admin/?page=return_list_requester/manage_return_list_requester" class="btn btn-block btn-outline-dark"></span>
                  Create New
                  <i class="fas fa-plus"></i>
                </a>
              </div>
            </div>
          </div>
          <!-- ./card-header -->
          <div class="card-body">
            <table id="example1" class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Date Created</th>
                  <th>Return Code</th>
                  <th>Requester</th>
                  <th>Item/s</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 1;
                $qry = $conn->query("SELECT r.*, s.name as requester FROM `return_list_requester` r inner join requester_list s on r.requester_id = s.id order by r.`date_created` desc");
                while ($row = $qry->fetch_assoc()) :
                  $row['items'] = count(explode(',', $row['stock_ids']));
                ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo date('F j, Y | g:i A', strtotime($row['date_created'])) ?></td>
                    <td><?php echo $row['return_code'] ?></td>
                    <td><?php echo $row['requester'] ?></td>
                    <td><?php echo number_format($row['items']) ?></td>
                    <td>
                      <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        Action
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="<?php echo base_url . 'admin?page=return_list_requester/view_return_list_requester&id=' . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url . 'admin?page=return_list_requester/manage_return_list_requester&id=' . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
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
      _conf("Are you sure to delete this Return - Requester Record permanently?", "delete_return_requester", [$(this).attr('data-id')])
    })
    //$('.table td,.table th').addClass('py-1 px-2 align-middle')
    //$('.table').dataTable();
  })

  function delete_return_requester($id) {
    start_loader();
    $.ajax({
      url: _base_url_ + "classes/Master.php?f=delete_return_requester",
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