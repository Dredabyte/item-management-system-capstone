<!--Title Header-->
<title>Item Management System - Stocks</title>
</head>
<!--Title Header ends-->

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Stocks</h1>
        <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus velit praesentium minima, harum maiores asperiores deleniti veniam rerum maxime temporibus voluptas. Quas velit est voluptatum necessitatibus? Eos voluptate quaerat asperiores.</p>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
          <li class="breadcrumb-item active">Stocks</li>
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
      <div class="col-lg-4">
        <!-- small box -->
        <div class="small-box bg-cyan">
          <div class="inner">
            <h3>
              <?php
              $totalQuantity = 0;

              $qry = $conn->query("SELECT * FROM `stock_list` where id != 1");
              while ($row = $qry->fetch_assoc()) {
                $totalQuantity += $row['quantity'];
              }

              $formattedTotal = number_format($totalQuantity);

              echo $formattedTotal;
              ?>

            </h3>
            <p>Total Stocks</p>
          </div>
          <div class="icon">
            <i class="fas fa-warehouse"></i>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->

  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-outline card-cyan">
          <div class="card-header">
            <h3 class="card-title"> Total Stocks</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Item Name</th>
                  <th>Supplier Name</th>
                  <th>Description</th>
                  <th>Available Stocks</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                $qry = $conn->query("SELECT i.*,s.name as supplier FROM `item_list` i inner join supplier_list s on i.supplier_id = s.id order by `name` desc");
                while ($row = $qry->fetch_assoc()) :
                  $in = $conn->query("SELECT SUM(quantity) as total FROM stock_list where item_id = '{$row['id']}' and type = 1")->fetch_array()['total'];
                  $out = $conn->query("SELECT SUM(quantity) as total FROM stock_list where item_id = '{$row['id']}' and type = 2")->fetch_array()['total'];
                  $row['available'] = $in - $out;
                ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['supplier'] ?></td>
                    <td><?php echo $row['description'] ?></td>
                    <td><?php echo number_format($row['available']) ?></td>
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
      _conf("Are you sure to delete this Incoming Orders permanently?", "delete_incoming", [$(this).attr('data-id')])
    })
    $('.view_details').click(function() {
      uni_modal("Incoming Order Details", "incoming_stock/view_incoming_stock.php?id=" + $(this).attr('data-id'), 'mid-large')
    })
    //$('.table td,.table th').addClass('py-1 px-2 align-middle')
    //$('.table').dataTable();
  })

  function delete_incoming($id) {
    start_loader();
    $.ajax({
      url: _base_url_ + "classes/Master.php?f=delete_incoming",
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