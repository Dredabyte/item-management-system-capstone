<!--Title Header-->
<title>Item Management System - Purchase Order Lists</title>
</head>
<!--Title Header ends-->

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Purchase Order Lists</h1>
        <p class="mb-0">In this section, you will find the purchase order list, a comprehensive compilation of purchase records. It encompasses crucial details such as item descriptions, quantities, mutually agreed-upon prices, and supplier information, ensuring accuracy and accountability.</p>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
          <li class="breadcrumb-item active">Purchase Order Lists</li>
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
        <div class="card card-outline card-navy">
          <div class="card-header">
            <h3 class="card-title">Purchase Orders</h3>
            <div class="card-tools">
              <div class="input-group-append">
                <a href="<?php echo base_url ?>admin/?page=purchase_order_list/manage_purchase_order_list" class="btn btn-block btn-outline-dark">
                  Add Orders
                  <i class="fas fa-plus"></i>
                </a>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Date Created</th>
                  <th>Purchase Order Code</th>
                  <th>Supplier Name</th>
                  <th>Item/s</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                $qry = $conn->query("SELECT p.*, s.name as supplier FROM `purchase_order_list` p inner join supplier_list s on p.supplier_id = s.id order by p.`date_created` desc");
                while ($row = $qry->fetch_assoc()) :
                  $row['items'] = $conn->query("SELECT count(item_id) as `items` FROM `po_items` where po_id = '{$row['id']}' ")->fetch_assoc()['items'];
                ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo date('F j, Y | g:i A', strtotime($row['date_created'])) ?></td>
                    <td><?php echo $row['po_code'] ?></td>
                    <td><?php echo $row['supplier'] ?></td>
                    <td><?php echo number_format($row['items']) ?></td>
                    <td>
                      <?php if ($row['status'] == 0) : ?>
                        <span class="badge badge-primary rounded-pill">Pending</span>
                      <?php elseif ($row['status'] == 1) : ?>
                        <span class="badge badge-warning rounded-pill">Partially received</span>
                      <?php elseif ($row['status'] == 2) : ?>
                        <span class="badge badge-success rounded-pill">Received</span>
                      <?php else : ?>
                        <span class="badge badge-danger rounded-pill">N/A</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        Action
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <?php if ($row['status'] == 0) : ?>
                          <a class="dropdown-item" href="<?php echo base_url . 'admin?page=incoming_stock/manage_incoming_stock&po_id=' . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-boxes text-dark"></span> Receive</a>
                          <div class="dropdown-divider"></div>
                        <?php endif; ?>
                        <a class="dropdown-item" href="<?php echo base_url . 'admin?page=purchase_order_list/view_purchase_order_list&id=' . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url . 'admin?page=purchase_order_list/manage_purchase_order_list&id=' . $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
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
  $(document).ready(function() {
    $('.delete_data').click(function() {
      _conf("Are you sure to delete this Purchase Order permanently?", "delete_po", [$(this).attr('data-id')])
    })
    $('.view_details').click(function() {
      uni_modal("Payment Details", "transaction/view_payment.php?id=" + $(this).attr('data-id'), 'mid-large')
    })
    //$('.table td,.table th').addClass('py-1 px-2 align-middle')
    //$('.table').dataTable();
  })

  function delete_po($id) {
    start_loader();
    $.ajax({
      url: _base_url_ + "classes/Master.php?f=delete_po",
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
</script>