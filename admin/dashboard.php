<!--Title Header-->
<title>Item Management System - Dashboard</title>
<!--Title Header ends-->

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
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
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>
              <?php
              $totalIn = 0;
              $totalOut = 0;
              $resultIn = $conn->query("SELECT SUM(quantity) as total FROM stock_list WHERE type = 1");

              if ($resultIn && $resultIn->num_rows > 0) {
                $totalIn = $resultIn->fetch_assoc()['total'];
              }
              $resultOut = $conn->query("SELECT SUM(quantity) as total FROM stock_list WHERE type = 2");

              if ($resultOut && $resultOut->num_rows > 0) {
                $totalOut = $resultOut->fetch_assoc()['total'];
              }
              $remainingAvailable = $totalIn - $totalOut;
              ?>
              <?php echo number_format($remainingAvailable) ?>
            </h3>
            <p>Total Stocks</p>
          </div>
          <div class="icon">
            <i class="fas fa-light fa-box"></i>
          </div>
          <?php if ($_settings->userdata('type') == 1) : ?>
            <a href="<?php echo base_url ?>admin/?page=stock" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          <?php endif; ?>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>
              <?php
              echo $conn->query("SELECT * FROM `incoming_list` where id != 1 ")->num_rows;
              ?>
            </h3>
            <p>Incoming Stocks</p>
          </div>
          <div class="icon">
            <i class="fas fa-right-to-bracket"></i>
          </div>
          <?php if ($_settings->userdata('type') == 1) : ?>
            <a href="<?php echo base_url ?>admin/?page=incoming_stock" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          <?php endif; ?>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>
              <?php
              echo $conn->query("SELECT * FROM `outgoing_list` where id != 1 ")->num_rows;
              ?>
            </h3>
            <p>Outgoing Stocks</p>
          </div>
          <div class="icon">
            <i class="fas fa-right-from-bracket"></i>
          </div>
          <?php if ($_settings->userdata('type') == 1) : ?>
            <a href="<?php echo base_url ?>admin/?page=outgoing_stock" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          <?php endif; ?>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
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
            <p>Low Stocks</p>
          </div>
          <div class="icon">
            <i class="fas fa-exclamation-triangle"></i>
          </div>
          <?php if ($_settings->userdata('type') == 1) : ?>
            <a href="<?php echo base_url ?>admin/?page=low_stock" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          <?php endif; ?>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-teal">
          <div class="inner">
            <h3>
              <?php
              echo $conn->query("SELECT * FROM `backorder_list` where id != 1 ")->num_rows;
              ?>
            </h3>
            <p>Back Orders</p>
          </div>
          <div class="icon">
            <i class="fas fa-clock-rotate-left"></i>
          </div>
          <?php if ($_settings->userdata('type') == 1) : ?>
            <a href="<?php echo base_url ?>admin/?page=backorder_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          <?php endif; ?>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-purple">
          <div class="inner">
            <h3>
              <?php
              echo $conn->query("SELECT * FROM `inventory_request_list` where id != 1 ")->num_rows;
              ?>
            </h3>
            <p>Inventory Request</p>
          </div>
          <div class="icon">
            <i class="fas fa-solid fa-envelope-open-text"></i>
          </div>
          <?php if ($_settings->userdata('type') == 1) : ?>
            <a href="<?php echo base_url ?>admin/?page=inventory_request" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          <?php endif; ?>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-orange">
          <div class="inner">
            <h3>
              <?php
              echo $conn->query("SELECT * FROM `return_list_supplier` where id != 1 ")->num_rows;
              ?>
            </h3>
            <p>Return List - Supplier</p>
          </div>
          <div class="icon">
            <i class="fas fa-rotate-right"></i>
          </div>
          <?php if ($_settings->userdata('type') == 1) : ?>
            <a href="<?php echo base_url ?>admin/?page=return_list_supplier" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          <?php endif; ?>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-pink">
          <div class="inner">
            <h3>
              <?php
              echo $conn->query("SELECT * FROM `users` where id != 1 ")->num_rows;
              ?>
            </h3>
            <p>System Users</p>
          </div>
          <div class="icon">
            <i class="fas fa-users"></i>
          </div>
          <?php if ($_settings->userdata('type') == 1) : ?>
            <a href="<?php echo base_url ?>admin/?page=system_user/profile_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          <?php endif; ?>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->

    <!-- GRAPH START -->
    <div class="row">
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- BAR CHART -->
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="far fa-chart-bar"></i>
                    Incoming Order Items
                  </h3>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>

            <?php
            require_once '../config.php';

            $sql = "SELECT
        il.name AS item_name,
        i.item_id,
        SUM(CASE WHEN i.type = 1 THEN i.quantity ELSE -i.quantity END) AS remaining_quantity
      FROM stock_list i
      INNER JOIN item_list il ON i.item_id = il.id
      GROUP BY il.name, i.item_id;";

            $getData = $conn->query($sql);

            $combinedData = array();

            if ($getData->num_rows > 0) {
              while ($row = $getData->fetch_assoc()) {
                $combinedData[] = array(
                  'item_name' => $row['item_name'],
                  'remaining_quantity' => $row['remaining_quantity'],
                );
              }
            }
            ?>


            <script>
              $(function() {
                var barChartCanvas = $('#barChart').get(0).getContext('2d');
                var combinedData = <?php echo json_encode($combinedData); ?>;

                var itemNames = combinedData.map(function(item) {
                  return item.item_name;
                });

                var quantities = combinedData.map(function(item) {
                  return item.remaining_quantity;
                });

                var barChartData = {
                  labels: itemNames,
                  datasets: [{
                    label: 'Item Quantity',
                    backgroundColor: 'rgba(0, 71, 112,0.9)',
                    borderColor: 'rgba(0, 71, 112,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(0, 71, 112,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(0, 71, 112,1)',
                    data: quantities
                  }]
                };

                var barChartOptions = {
                  responsive: true,
                  maintainAspectRatio: false,
                  datasetFill: false
                };

                new Chart(barChartCanvas, {
                  type: 'bar',
                  data: barChartData,
                  options: barChartOptions
                });
              });
            </script>
            <!-- /BAR CHART -->


            <!-- BAR CHART for outgoing -->
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="far fa-chart-bar"></i>
                    Outgoing Order Items
                  </h3>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="barChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>

            <?php
            require_once '../config.php';

            $sql = "SELECT i.item_id, i.quantity, il.name AS item_name
            FROM stock_list i
            INNER JOIN item_list il ON i.item_id = il.id
            WHERE i.type = 2;";

            $getData = $conn->query($sql);

            $combinedData = array();

            if ($getData->num_rows > 0) {
              while ($row = $getData->fetch_assoc()) {
                $combinedData[] = array(
                  'item_name' => $row['item_name'],
                  'quantity' => $row['quantity'],
                );
              }
            }
            ?>

            <script>
              $(function() {
                var barChartCanvas = $('#barChart2').get(0).getContext('2d');
                var combinedData = <?php echo json_encode($combinedData); ?>;

                var itemNames = combinedData.map(function(item) {
                  return item.item_name;
                });

                var quantities = combinedData.map(function(item) {
                  return item.quantity;
                });

                var barChartData = {
                  labels: itemNames,
                  datasets: [{
                    label: 'Item Quantity',
                    backgroundColor: 'rgba(0, 71, 112,0.9)',
                    borderColor: 'rgba(0, 71, 112,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(0, 71, 112,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(0, 71, 112,1)',
                    data: quantities
                  }]
                };

                var barChartOptions = {
                  responsive: true,
                  maintainAspectRatio: false,
                  datasetFill: false
                };

                new Chart(barChartCanvas, {
                  type: 'bar',
                  data: barChartData,
                  options: barChartOptions
                });
              });
            </script>
            <!-- /BAR CHART outgoing -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
    </div>
    <!-- /BAR CHART ENDS -->

    <!-- DONUT CHART -->
    <!-- <div class="row">
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Low Stocks Items
                  </h3>
                </div>
                <div class="card-body">
                  <canvas id="donutChart" style="min-height: 475px; height: 475px; max-height: 475px; max-width: 100%; display: flex; justify-content: center; align-items: center;"></canvas>
                </div>
                <-- /.card-body -->
              <!-- </div> -->
              <!-- /.card --/>
            </div>
          </div> -->

          <!-- </?php
          require_once '../config.php';

          $sql = "SELECT sl.item_id, sl.quantity, il.name 
              FROM stock_list sl 
              INNER JOIN item_list il ON sl.item_id = il.id
              WHERE sl.quantity < 200";

          $getData = $conn->query($sql);

          $itemNames = array();
          $quantities = array();

          if ($getData->num_rows > 0) {
            while ($row = $getData->fetch_assoc()) {
              $itemNames[] = $row['name'];
              $quantities[] = (int)$row['quantity'];
            }
          }
          ?> -->

          <!-- <script>
            $(function() {
              var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
              var itemNames = </?php echo json_encode($itemNames); ?>;
              var quantities = </?php echo json_encode($quantities); ?>;

              // Generate random background colors
              var randomColors = [];
              for (var i = 0; i < itemNames.length; i++) {
                randomColors.push(getRandomColor());
              }

              var donutData = {
                labels: itemNames,
                datasets: [{
                  data: quantities,
                  backgroundColor: randomColors,
                }]
              };

              var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
              };

              new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
              });

              // Function to generate random colors
              function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                  color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
              }
            });
          </script> -->
          <!-- DONUT CHART -->
        <!-- </div>
      </section>
    </div> -->

    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-6 connectedSortable">
        <!-- TABLE: LATEST SALE -->
        <div class="card card-outline card-info shadow">
          <div class="card-header border-transparent">
            <h3 class="card-title">Latest Sale Items</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Sales ID</th>
                    <th>Requester</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $qry = $conn->query("SELECT o.sales_code, r.name AS requester_name
                  FROM outgoing_list o
                  INNER JOIN requester_list r ON o.requester_id = r.id");

                  while ($row = $qry->fetch_assoc()) :
                  ?>
                    <tr>
                      <td><?php echo $row['sales_code']; ?></td>
                      <td><?php echo $row['requester_name']; ?></td>
                      <td><span class="badge badge-success">Shipped</span></td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>

            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <?php if ($_settings->userdata('type') == 1) : ?>
              <a href="<?php echo base_url ?>admin/?page=outgoing_stock/manage_outgoing_stock" class="btn btn-sm btn-info float-left">Place New Order</a>
            <?php endif; ?>
            <a href="<?php echo base_url ?>admin/?page=outgoing_stock" class="btn btn-sm btn-secondary float-right">View All Sales</a>
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-6 connectedSortable">
        <!-- TABLE: LATEST SALE -->
        <div class="card card-outline card-success shadow">
          <div class="card-header border-transparent">
            <h3 class="card-title">Latest Ordered Items</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Purchase Order ID</th>
                    <th>Supplier</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $qry = $conn->query("SELECT o.po_code, s.name AS supplier_name, o.status
                      FROM purchase_order_list o
                      INNER JOIN supplier_list s ON o.supplier_id = s.id");

                  while ($row = $qry->fetch_assoc()) :
                  ?>
                    <tr>
                      <td><?php echo $row['po_code']; ?></td>
                      <td><?php echo $row['supplier_name']; ?></td>
                      <td>
                        <?php
                        $status = $row['status'];
                        $statusText = '';
                        $badgeClass = '';

                        if ($status == 1) {
                          $statusText = 'Partially Received';
                          $badgeClass = 'badge badge-warning';
                        } elseif ($status == 2) {
                          $statusText = 'Received';
                          $badgeClass = 'badge badge-success';
                        } elseif ($status == 0) {
                          $statusText = 'Pending';
                          $badgeClass = 'badge badge-info';
                        }

                        echo '<span class="' . $badgeClass . '">' . $statusText . '</span>';
                        ?>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <?php if ($_settings->userdata('type') == 1) : ?>
              <a href="<?php echo base_url ?>admin/?page=purchase_order_list/manage_purchase_order_list" class="btn btn-sm btn-info float-left">Place New Order</a>
            <?php endif; ?>
            <a href="<?php echo base_url ?>admin/?page=purchase_order_list" class="btn btn-sm btn-secondary float-right">View All Sales</a>
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
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