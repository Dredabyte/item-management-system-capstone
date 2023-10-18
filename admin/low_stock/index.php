<!--Title Header-->
<title>Item Management System - Low Stocks</title>
</head>
<!--Title Header ends-->

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Low Stocks</h1>
        <p class="mb-0">"Low Stock" indicates a minimal quantity of goods available, prompting the need for replenishment to ensure seamless operations and meet demand. This status serves as a trigger for timely restocking actions.</p>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
          <li class="breadcrumb-item active">Low Stocks</li>
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
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>
              <?php
              $lowStockThreshold = 200;
              $query = "SELECT i.*, s.name AS supplier,
            (COALESCE((SELECT SUM(quantity) FROM stock_list WHERE item_id = i.id AND type = 1), 0) 
            - COALESCE((SELECT SUM(quantity) FROM stock_list WHERE item_id = i.id AND type = 2), 0)) AS available_stock
            FROM item_list i
            INNER JOIN supplier_list s ON i.supplier_id = s.id
            ORDER BY i.name DESC";

              $result = $conn->query($query);

              if ($result) {
                $lowStockItemCount = 0;
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $item_id = $row['id'];
                    $available_stock = $row['available_stock'];

                    if ($available_stock < $lowStockThreshold) {
                      $lowStockItemCount++;
                    }
                  }
                  echo $lowStockItemCount;
                }
              }
              ?>
            </h3>
            <p>Low Stocks List</p>
          </div>
          <div class="icon">
            <i class="fas fa-exclamation-triangle"></i>
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
        <div class="card card-outline card-danger">
          <div class="card-header">
            <h3 class="card-title"></h3>
            <div class="card-tools">
              <div class="input-group-append">
              </div>
            </div>
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
                  <th>Stock Remaining</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $lowStockThreshold = 200;
                $query = "SELECT i.*, s.name AS supplier,
                (COALESCE((SELECT SUM(quantity) FROM stock_list WHERE item_id = i.id AND type = 1), 0) 
                - COALESCE((SELECT SUM(quantity) FROM stock_list WHERE item_id = i.id AND type = 2), 0)) AS available_stock
                FROM item_list i
                INNER JOIN supplier_list s ON i.supplier_id = s.id
                ORDER BY i.name DESC";
                $result = $conn->query($query);
                if ($result) {
                  if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                      $available_stock = $row['available_stock'];

                      if ($available_stock < $lowStockThreshold) {
                        echo "<tr>";
                        echo "<td>$i</td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['supplier']}</td>";
                        echo "<td>{$row['description']}</td>";
                        echo "<td>$available_stock</td>";
                        echo "</tr>";
                        $i++;
                      }
                    }
                  } else {
                    echo "<tr><td colspan='5'>No low stock items found</td></tr>";
                  }
                } else {
                  echo "<tr><td colspan='5'>Error executing query: " . $conn->error . "</td></tr>";
                }
                ?>
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

  /*$(document).ready(function() {
    $('.delete_data').click(function() {
      _conf("Are you sure to delete this Incoming Orders permanently?", "delete_incoming", [$(this).attr('data-id')])
    })
    $('.view_details').click(function() {
      uni_modal("Incoming Order Details", "incoming_stock/view_incoming_stock.php?id=" + $(this).attr('data-id'), 'mid-large')
    })
    //$('.table td,.table th').addClass('py-1 px-2 align-middle')
    //$('.table').dataTable();
  }) */
</script>