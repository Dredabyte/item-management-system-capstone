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
          <a href="<?php echo base_url ?>admin/?page=stock" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
          <a href="<?php echo base_url ?>admin/?page=incoming_stock" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
          <a href="<?php echo base_url ?>admin/?page=outgoing_stock" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>
              <?php
              echo $conn->query("SELECT * FROM `low_stock` where id != 1 ")->num_rows;
              ?>
            </h3>
            <p>Low Stocks</p>
          </div>
          <div class="icon">
            <i class="fas fa-exclamation-triangle"></i>
          </div>
          <a href="<?php echo base_url ?>admin/?page=low_stock" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->

    <?php if ($_settings->userdata('type') == 1) : ?>
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
            <a href="<?php echo base_url ?>admin/?page=backorder_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
            <a href="<?php echo base_url ?>admin/?page=inventory_request" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
            <a href="<?php echo base_url ?>admin/?page=return_list_supplier" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
            <a href="<?php echo base_url ?>admin/?page=system_user/profile_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    <?php endif; ?>

    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-7 connectedSortable">
        <!-- TABLE: LATEST SALE -->
        <div class="card card-info shadow">
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
                    <th>Item</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><a href="../pages/examples/invoice.html">OR9842</a></td>
                    <td>Call of Duty IV</td>
                    <td><span class="badge badge-success">Shipped</span></td>
                  </tr>
                  <tr>
                    <td><a href="../pages/examples/invoice.html">OR1848</a></td>
                    <td>Samsung Smart TV</td>
                    <td><span class="badge badge-warning">Pending</span></td>
                  </tr>
                  <tr>
                    <td><a href="../pages/examples/invoice.html">OR7429</a></td>
                    <td>iPhone 6 Plus</td>
                    <td><span class="badge badge-danger">Delivered</span></td>
                  </tr>
                  <tr>
                    <td><a href="../pages/examples/invoice.html">OR7429</a></td>
                    <td>Samsung Smart TV</td>
                    <td><span class="badge badge-info">Processing</span></td>
                  </tr>
                  <tr>
                    <td><a href="../pages/examples/invoice.html">OR1848</a></td>
                    <td>Samsung Smart TV</td>
                    <td><span class="badge badge-warning">Pending</span></td>
                  </tr>
                  <tr>
                    <td><a href="../pages/examples/invoice.html">OR7429</a></td>
                    <td>iPhone 6 Plus</td>
                    <td><span class="badge badge-danger">Delivered</span></td>
                  </tr>
                  <tr>
                    <td><a href="../pages/examples/invoice.html">OR9842</a></td>
                    <td>Call of Duty IV</td>
                    <td><span class="badge badge-success">Shipped</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
            <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-5 connectedSortable">
        <!-- PRODUCT LIST -->
        <div class="card card-success shadow">
          <div class="card-header">
            <h3 class="card-title">Recently Added Items</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <ul class="products-list product-list-in-card pl-2 pr-2">
              <li class="item">
                <div class="product-img">
                  <img src="../dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">Samsung TV
                    <span class="badge badge-warning float-right">$1800</span></a>
                  <span class="product-description">
                    Samsung 32" 1080p 60Hz LED Smart HDTV.
                  </span>
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-img">
                  <img src="../dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">Bicycle
                    <span class="badge badge-info float-right">$700</span></a>
                  <span class="product-description">
                    26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                  </span>
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-img">
                  <img src="../dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">
                    Xbox One <span class="badge badge-danger float-right">
                      $350
                    </span>
                  </a>
                  <span class="product-description">
                    Xbox One Console Bundle with Halo Master Chief Collection.
                  </span>
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-img">
                  <img src="../dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">PlayStation 4
                    <span class="badge badge-success float-right">$399</span></a>
                  <span class="product-description">
                    PlayStation 4 500GB Console (PS4)
                  </span>
                </div>
              </li>
              <!-- /.item -->
            </ul>
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-center">
            <a href="javascript:void(0)" class="uppercase">View All Products</a>
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