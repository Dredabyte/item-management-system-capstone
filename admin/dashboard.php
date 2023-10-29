<!--Title Header-->
<title>Item Management System - Dashboard</title>
</head>
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

    <!-- graph start -->
    <div class="row">
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <!-- DONUT CHART -->
              <div class="card card-yellow">
                <div class="card-header">
                  <h3 class="card-title">Donut Chart</h3>
                </div>
                <div class="card-body">
                  <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col (LEFT) -->
            <div class="col-md-6">
              <!-- BAR CHART -->
              <div class="card card-orange">
                <div class="card-header">
                  <h3 class="card-title">Bar Chart</h3>
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
            <!-- /.col (RIGHT) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
    </div>
    <!-- /graph ends -->

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

    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-6">
        <!-- <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script> -->

        <!-- <style>
          .highcharts-figure,
          .highcharts-data-table table {
            min-width: 320px;
            max-width: 660px;
            margin: 1em auto;
            border: 3px solid;
            border-radius: 3px;
          }

          .highcharts-data-table table {
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
          }

          .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
          }

          .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
          }

          .highcharts-data-table td,
          .highcharts-data-table th,
          .highcharts-data-table caption {
            padding: 0.5em;
          }

          .highcharts-data-table thead tr,
          .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
          }

          .highcharts-data-table tr:hover {
            background: #f1f7ff;
          }
        </style> -->

        <!-- <figure class="highcharts-figure">
          <div id="container"></div>
        </figure> -->

        <!-- <-?php
        require_once '../config.php';

        $sql = "SELECT sl.item_id, sl.quantity, il.name 
        FROM stock_list sl 
        INNER JOIN item_list il ON sl.item_id = il.id";

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
          Highcharts.chart('container', {
            chart: {
              type: 'bar'
            },
            title: {
              text: 'Quantity of Items by Item Name'
            },
            xAxis: {
              categories: <-?php echo json_encode($itemNames); ?>,
              title: {
                text: 'Item Name'
              }
            },
            yAxis: {
              title: {
                text: 'Quantity'
              }
            },
            series: [{
              name: 'Quantity',
              data: <-?php echo json_encode($quantities); ?>
            }]
          });
        </script> -->
      </section>

      <!-- Right col -->
      <section class="col-lg-6">
        <!-- <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script> -->

        <!-- <style>
          .highcharts-figure,
          .highcharts-data-table table {
            min-width: 320px;
            max-width: 660px;
            margin: 1em auto;
            border: 3px solid;
            border-radius: 3px;
          }

          .highcharts-data-table table {
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
          }

          .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
          }

          .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
          }

          .highcharts-data-table td,
          .highcharts-data-table th,
          .highcharts-data-table caption {
            padding: 0.5em;
          }

          .highcharts-data-table thead tr,
          .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
          }

          .highcharts-data-table tr:hover {
            background: #f1f7ff;
          }
        </style> -->

        <!-- <figure class="highcharts-figure">
          <div id="container2"></div>
        </figure> -->

        <!-- <-?php
        require_once '../config.php';

        $sql = "SELECT sl.item_id, il.name, sl.quantity 
        FROM stock_list sl
        INNER JOIN item_list il ON sl.item_id = il.id
        WHERE sl.quantity < 200";
        $getData = $conn->query($sql);

        $data = array();

        if ($getData->num_rows > 0) {
          while ($row = $getData->fetch_assoc()) {
            $data[] = array(
              'name' => $row['name'],
              'y' => (int)$row['quantity']
            );
          }
        }
        ?> -->

        <!-- <script>
          Highcharts.chart('container2', {
            chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
            },
            title: {
              text: 'Low Stock Items',
              align: 'left'
            },
            tooltip: {
              pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            accessibility: {
              point: {
                valueSuffix: '%'
              }
            },
            plotOptions: {
              pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                  enabled: false
                },
                showInLegend: true
              }
            },
            series: [{
              name: 'Quantity',
              colorByPoint: true,
              data: <-?php echo json_encode($data); ?>
            }]
          });
        </script> -->

      </section>
    </div>

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