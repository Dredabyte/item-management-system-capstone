  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-pink elevation-4">
    <!-- Brand Logo -->
    <a href="./" class="brand-link">
      <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Magnaye Ent.</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo validate_image($_settings->userdata('avatar')) ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <div class="text-muted toastrDefaultInfo" style="cursor: pointer;"><?php echo ucwords($_settings->userdata('firstname') . ' - ' . $_settings->userdata('role')) ?></div>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <!-- THIS NAVIGATION SECTION IS INTEDED TO ADMIN -->

          <?php if ($_settings->userdata('type') == 1) : ?>
            <li class="nav-item">
              <!--Dashboard Start-->
              <a href="./" class="nav-link nav-dashboard">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  DASHBOARD
                </p>
              </a>
            </li>
            <!--Dashboard End-->


            <!--Order Lists Start-->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-list-check"></i>
                <p>ORDER LISTS
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <!--Inventory Request -->
                <?php
                function getInventoryRequestCount()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS request_count FROM inventory_request_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['request_count'];
                  } else {

                    return 0;
                  }
                }

                $requestCount = getInventoryRequestCount();
                ?>

                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=inventory_request" class="nav-link nav-inventory_request">
                    <i class="nav-icon fas fa-solid fa-envelope-open-text"></i>
                    <p>
                      Item Request
                      <span class="badge badge-info right"><?php echo $requestCount; ?></span>
                    </p>
                  </a>
                </li>

                <!--Purchase Order -->
                <?php
                function getPurchaseOrderCount()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS purchase_order_count FROM purchase_order_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['purchase_order_count'];
                  } else {

                    return 0;
                  }
                }

                $purchaseCount = getPurchaseOrderCount();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=purchase_order_list" class="nav-link nav-purchase_order_list">
                    <i class="nav-icon fas fa-cart-arrow-down"></i>
                    <p>
                      Purchase Order List
                      <span class="badge badge-info right"><?php echo $purchaseCount; ?></span>
                    </p>
                  </a>
                </li>

                <!--Back Order -->
                <?php
                function getBackOrderCount()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS backorder_count FROM backorder_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['backorder_count'];
                  } else {

                    return 0;
                  }
                }

                $boCount = getBackOrderCount();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=backorder_list" class="nav-link nav-backorder_list">
                    <i class="nav-icon fas fa-clock-rotate-left"></i>
                    <p>
                      Back Order List
                      <span class="badge badge-info right"><?php echo $boCount; ?></span>
                    </p>
                  </a>
                </li>

                <!--Dispense Product -->
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=outgoing_stock/manage_outgoing_stock" class="nav-link nav-dispense">
                    <i class="nav-icon fas fa-share-from-square"></i>
                    <p>
                      Dispense Product
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <!--Order Lists End-->


            <!--Return List Start-->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-exchange-alt"></i>
                <p>RETURN LISTS
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <!--Return List-Supplier -->
                <?php
                function getReturnSupplierCount()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS return_list FROM return_list_supplier";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['return_list'];
                  } else {

                    return 0;
                  }
                }

                $returnCount = getReturnSupplierCount();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=return_list_supplier" class="nav-link nav-return_list_supplier">
                    <i class="nav-icon fas fa-rotate-right"></i>
                    <p>
                      Return List - Suppliers
                      <span class="badge badge-info right"><?php echo $returnCount; ?></span>
                    </p>
                  </a>
                </li>

                <!--Return List-Requester -->
                <!--<li class="nav-item">
                <a href="<-?php echo base_url ?>admin/?page=return_list_requester" class="nav-link nav-return_list_requester">
                  <i class="nav-icon fas fa-rotate-right"></i>
                  <p>
                    Return List - Requesters
                  </p>
                </a>
              </li> -->
              </ul>
            </li>
            <!--Return List End-->


            <!--Transactions  Start-->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-receipt"></i>
                <p>TRANSACTIONS
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!--Incoming Stocks -->
                <?php
                function getIncomingCount()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS incoming FROM incoming_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['incoming'];
                  } else {

                    return 0;
                  }
                }

                $incomingCount = getIncomingCount();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=incoming_stock" class="nav-link nav-incoming_stock">
                    <i class="nav-icon fas fa-right-to-bracket"></i>
                    <p>
                      Incoming Stocks
                      <span class="badge badge-info right"><?php echo $incomingCount; ?></span>
                    </p>
                  </a>
                </li>

                <!--Outgoing Stocks -->
                <?php
                function getOutgoingCount()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS outgoing FROM outgoing_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['outgoing'];
                  } else {

                    return 0;
                  }
                }

                $outgoingCount = getOutgoingCount();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=outgoing_stock" class="nav-link nav-outgoing_stock">
                    <i class="nav-icon fas fa-right-from-bracket"></i>
                    <p>
                      Outgoing Stocks
                      <span class="badge badge-info right"><?php echo $outgoingCount; ?></span>
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <!--Outgoing Stocks End-->

            <!--Item List  Start-->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-box"></i>
                <p>ITEMS
                  <i class="right fas fa-angle-left"></i>
                  <span class="badge bg-white right">New</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!-- Bike Parts -->
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=bike_parts" class="nav-link nav-bike_parts">
                    <i class="nav-icon fas fa-solid fa-bicycle"></i>
                    <p>
                      Bike Parts
                    </p>
                  </a>
                </li>

                <!-- Item Lists -->
                <?php
                function getItemCount()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS item FROM item_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['item'];
                  } else {

                    return 0;
                  }
                }

                $itemCount = getItemCount();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=item_list" class="nav-link nav-item_list">
                    <i class="nav-icon fas fa-boxes"></i>
                    <p>
                      Item Lists
                      <span class="badge badge-info right"><?php echo $itemCount; ?></span>
                    </p>
                  </a>
                </li>

                <!--Stock List -->
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=stock" class="nav-link nav-stock">
                    <i class="nav-icon fas fa-warehouse"></i>
                    <p>
                      Stocks
                    </p>
                  </a>
                </li>

                <!--Low Stock -->
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
                  }
                }
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=low_stock" class="nav-link nav-low_stock">
                    <i class="nav-icon fas fa-exclamation-triangle"></i>
                    <p>
                      Low Stocks
                      <span class="badge badge-danger right"><?php echo $lowStockItemCount; ?></span>
                    </p>
                  </a>
                </li>

                <!--Brand & Category -->
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=brand_category" class="nav-link nav-brand_category">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                      Brand & Category/s
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Item List End-->


            <!--Master List Start-->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users-between-lines"></i>
                <p>MASTER LISTS</p>
                <i class="right fas fa-angle-left"></i>
              </a>
              <ul class="nav nav-treeview">
                <!--Supplier -->
                <?php
                function getSupplierCount()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS supplier FROM supplier_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['supplier'];
                  } else {

                    return 0;
                  }
                }

                $supplierCount = getSupplierCount();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=supplier" class="nav-link nav-supplier">
                    <i class="nav-icon fas fa-address-book"></i>
                    <p>
                      Suppliers
                      <span class="badge badge-info right"><?php echo $supplierCount; ?></span>
                    </p>
                  </a>
                </li>

                <!--Requester -->
                <?php
                function getRequesterCount()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS requester FROM requester_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['requester'];
                  } else {

                    return 0;
                  }
                }

                $requesterCount = getRequesterCount();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=requester" class="nav-link nav-requester">
                    <i class="nav-icon fas fa-address-book"></i>
                    <p>
                      Requesters
                      <span class="badge badge-info right"><?php echo $requesterCount ?></span>
                    </p>
                  </a>
                </li>

                <!--System Users -->
                <?php
                function getUserCount()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS user FROM users WHERE id != 1";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['user'];
                  } else {

                    return 0;
                  }
                }

                $userCount = getUserCount();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=system_user/profile_list" class="nav-link nav-system_user">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      System Users
                      <span class="badge badge-info right"><?php echo $userCount ?></span>
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <!--System Users End-->

            <!--Reports Start-->
            <li class="nav-item">
              <a href="<?php echo base_url ?>admin/?page=report" class="nav-link nav-report">
                <i class="nav-icon fas fa-file-circle-check"></i>
                <p>
                  REPORTS
                </p>
              </a>
            </li>

            <!--Settings Start-->
            <li class="nav-item">
              <a href="<?php echo base_url ?>admin/?page=settings" class="nav-link nav-settings">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                  SETTINGS
                </p>
              </a>
            </li>
          <?php endif; ?>



          <!-- THIS NAVIGATION SECTION IS INTEDED TO STAFF  -->
          <?php if ($_settings->userdata('type') == 2) : ?>
            <li class="nav-item">
              <!--Dashboard Start-->
              <a href="./" class="nav-link nav-dashboard">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  DASHBOARD
                </p>
              </a>
            </li>
            <!--Dashboard End-->

            <!--Item List  Start-->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-box"></i>
                <p>ITEMS
                  <i class="right fas fa-angle-left"></i>
                  <span class="badge bg-white right">New</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!-- Bike Parts -->
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=bike_parts" class="nav-link nav-bike_parts">
                    <i class="nav-icon fas fa-solid fa-bicycle"></i>
                    <p>
                      Bike Parts
                    </p>
                  </a>
                </li>

                <!-- Item Lists -->
                <?php
                function getItemCount2()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS item FROM item_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['item'];
                  } else {

                    return 0;
                  }
                }

                $itemCount = getItemCount2();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=item_list" class="nav-link nav-item_list">
                    <i class="nav-icon fas fa-boxes"></i>
                    <p>
                      Item Lists
                      <span class="badge badge-info right"><?php echo $itemCount; ?></span>
                    </p>
                  </a>
                </li>

                <!--Stock List -->
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=stock" class="nav-link nav-stock">
                    <i class="nav-icon fas fa-warehouse"></i>
                    <p>
                      Stocks
                    </p>
                  </a>
                </li>

                <!--Low Stock -->
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
                  }
                }
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=low_stock" class="nav-link nav-low_stock">
                    <i class="nav-icon fas fa-exclamation-triangle"></i>
                    <p>
                      Low Stocks
                      <span class="badge badge-danger right"><?php echo $lowStockItemCount; ?></span>
                    </p>
                  </a>
                </li>

                <!--Brand & Category -->
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=brand_category" class="nav-link nav-brand_category">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                      Brand & Category/s
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Item List End-->

            <!--Transactions  Start-->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-receipt"></i>
                <p>TRANSACTIONS
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!--Incoming Stocks -->
                <?php
                function getIncomingCount2()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS incoming FROM incoming_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['incoming'];
                  } else {

                    return 0;
                  }
                }

                $incomingCount = getIncomingCount2();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=incoming_stock" class="nav-link nav-incoming_stock">
                    <i class="nav-icon fas fa-right-to-bracket"></i>
                    <p>
                      Incoming Stocks
                      <span class="badge badge-info right"><?php echo $incomingCount; ?></span>
                    </p>
                  </a>
                </li>

                <!--Outgoing Stocks -->
                <?php
                function getOutgoingCount2()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS outgoing FROM outgoing_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['outgoing'];
                  } else {

                    return 0;
                  }
                }

                $outgoingCount = getOutgoingCount2();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=outgoing_stock" class="nav-link nav-outgoing_stock">
                    <i class="nav-icon fas fa-right-from-bracket"></i>
                    <p>
                      Outgoing Stocks
                      <span class="badge badge-info right"><?php echo $outgoingCount; ?></span>
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <!--Outgoing Stocks End-->

            <!--Reports Start-->
            <li class="nav-item">
              <a href="<?php echo base_url ?>admin/?page=report" class="nav-link nav-report">
                <i class="nav-icon fas fa-file-circle-check"></i>
                <p>
                  REPORTS
                </p>
              </a>
            </li>
          <?php endif; ?>



          <!-- THIS NAVIGATION SECTION IS INTEDED TO MANAGER  -->
          <?php if ($_settings->userdata('type') == 3) : ?>
            <li class="nav-item">
              <!--Dashboard Start-->
              <a href="./" class="nav-link nav-dashboard">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  DASHBOARD
                </p>
              </a>
            </li>
            <!--Dashboard End-->


            <!--Order Lists Start-->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-list-check"></i>
                <p>ORDER LISTS
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <!--Inventory Request -->
                <?php
                function getInventoryRequestCount3()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS request_count FROM inventory_request_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['request_count'];
                  } else {

                    return 0;
                  }
                }

                $requestCount = getInventoryRequestCount3();
                ?>

                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=inventory_request" class="nav-link nav-inventory_request">
                    <i class="nav-icon fas fa-solid fa-envelope-open-text"></i>
                    <p>
                      Item Request
                      <span class="badge badge-info right"><?php echo $requestCount; ?></span>
                    </p>
                  </a>
                </li>

                <!--Purchase Order -->
                <?php
                function getPurchaseOrderCount3()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS purchase_order_count FROM purchase_order_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['purchase_order_count'];
                  } else {

                    return 0;
                  }
                }

                $purchaseCount = getPurchaseOrderCount3();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=purchase_order_list" class="nav-link nav-purchase_order_list">
                    <i class="nav-icon fas fa-cart-arrow-down"></i>
                    <p>
                      Purchase Order List
                      <span class="badge badge-info right"><?php echo $purchaseCount; ?></span>
                    </p>
                  </a>
                </li>

                <!--Back Order -->
                <?php
                function getBackOrderCount3()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS backorder_count FROM backorder_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['backorder_count'];
                  } else {

                    return 0;
                  }
                }

                $boCount = getBackOrderCount3();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=backorder_list" class="nav-link nav-backorder_list">
                    <i class="nav-icon fas fa-clock-rotate-left"></i>
                    <p>
                      Back Order List
                      <span class="badge badge-info right"><?php echo $boCount; ?></span>
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <!--Order Lists End-->

            <!--Transactions  Start-->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-receipt"></i>
                <p>TRANSACTIONS
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!--Incoming Stocks -->
                <?php
                function getIncomingCount3()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS incoming FROM incoming_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['incoming'];
                  } else {

                    return 0;
                  }
                }

                $incomingCount = getIncomingCount3();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=incoming_stock" class="nav-link nav-incoming_stock">
                    <i class="nav-icon fas fa-right-to-bracket"></i>
                    <p>
                      Incoming Stocks
                      <span class="badge badge-info right"><?php echo $incomingCount; ?></span>
                    </p>
                  </a>
                </li>

                <!--Outgoing Stocks -->
                <?php
                function getOutgoingCount3()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS outgoing FROM outgoing_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['outgoing'];
                  } else {

                    return 0;
                  }
                }

                $outgoingCount = getOutgoingCount3();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=outgoing_stock" class="nav-link nav-outgoing_stock">
                    <i class="nav-icon fas fa-right-from-bracket"></i>
                    <p>
                      Outgoing Stocks
                      <span class="badge badge-info right"><?php echo $outgoingCount; ?></span>
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <!--Outgoing Stocks End-->

            <!--Item List  Start-->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-box"></i>
                <p>ITEMS
                  <i class="right fas fa-angle-left"></i>
                  <span class="badge bg-white right">New</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!-- Bike Parts -->
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=bike_parts" class="nav-link nav-bike_parts">
                    <i class="nav-icon fas fa-solid fa-bicycle"></i>
                    <p>
                      Bike Parts
                    </p>
                  </a>
                </li>

                <!-- Item Lists -->
                <?php
                function getItemCount3()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS item FROM item_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['item'];
                  } else {

                    return 0;
                  }
                }

                $itemCount = getItemCount3();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=item_list" class="nav-link nav-item_list">
                    <i class="nav-icon fas fa-boxes"></i>
                    <p>
                      Item Lists
                      <span class="badge badge-info right"><?php echo $itemCount; ?></span>
                    </p>
                  </a>
                </li>

                <!--Stock List -->
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=stock" class="nav-link nav-stock">
                    <i class="nav-icon fas fa-warehouse"></i>
                    <p>
                      Stocks
                    </p>
                  </a>
                </li>

                <!--Low Stock -->
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
                  }
                }
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=low_stock" class="nav-link nav-low_stock">
                    <i class="nav-icon fas fa-exclamation-triangle"></i>
                    <p>
                      Low Stocks
                      <span class="badge badge-danger right"><?php echo $lowStockItemCount; ?></span>
                    </p>
                  </a>
                </li>

                <!--Brand & Category -->
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=brand_category" class="nav-link nav-brand_category">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                      Brand & Category/s
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Item List End-->


            <!--Master List Start-->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users-between-lines"></i>
                <p>MASTER LISTS</p>
                <i class="right fas fa-angle-left"></i>
              </a>
              <ul class="nav nav-treeview">
                <!--Supplier -->
                <?php
                function getSupplierCount3()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS supplier FROM supplier_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['supplier'];
                  } else {

                    return 0;
                  }
                }

                $supplierCount = getSupplierCount3();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=supplier" class="nav-link nav-supplier">
                    <i class="nav-icon fas fa-address-book"></i>
                    <p>
                      Suppliers
                      <span class="badge badge-info right"><?php echo $supplierCount; ?></span>
                    </p>
                  </a>
                </li>

                <!--Requester -->
                <?php
                function getRequesterCount3()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS requester FROM requester_list";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['requester'];
                  } else {

                    return 0;
                  }
                }

                $requesterCount = getRequesterCount3();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=requester" class="nav-link nav-requester">
                    <i class="nav-icon fas fa-address-book"></i>
                    <p>
                      Requesters
                      <span class="badge badge-info right"><?php echo $requesterCount ?></span>
                    </p>
                  </a>
                </li>

                <!--System Users -->
                <?php
                function getUserCount3()
                {
                  global $conn;

                  $qry = "SELECT COUNT(*) AS user FROM users WHERE id != 1";
                  $result = $conn->query($qry);

                  if ($result) {
                    $row = $result->fetch_assoc();
                    return $row['user'];
                  } else {

                    return 0;
                  }
                }

                $userCount = getUserCount3();
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url ?>admin/?page=system_user/profile_list" class="nav-link nav-system_user">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      System Users
                      <span class="badge badge-info right"><?php echo $userCount ?></span>
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <!--System Users End-->

            <!--Reports Start-->
            <li class="nav-item">
              <a href="<?php echo base_url ?>admin/?page=report" class="nav-link nav-report">
                <i class="nav-icon fas fa-file-circle-check"></i>
                <p>
                  REPORTS
                </p>
              </a>
            </li>
          <?php endif; ?>

          <!--Reports Ends-->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <script>
    var page;
    $(document).ready(function() {
      page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'dashboard' ?>';
      page = page.split('/')[0]; // Extract the main page before the first '/'

      if ($('.nav-link.nav-' + page).length > 0) {
        $('.nav-link.nav-' + page).addClass('active');
        var parentTreeview = $('.nav-link.nav-' + page).closest('.nav-treeview');
        var parentNav = parentTreeview.siblings('a');

        parentNav.addClass('active');
        parentTreeview.parent().addClass('menu-open');
      }
    });
  </script>