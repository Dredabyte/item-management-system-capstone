  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
        <img src="dist\img\Magnaye-Logo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Magnaye Ent.</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <span class="avatar avatar-online"> 
        <div class="image">
          <img src="dist\img\pic-1.jpg" class="img-circle elevation-2" alt="User Image">
        </div> 
      </span>
        <div class="info">
          <div class="text-muted toastrDefaultInfo">Aeldred John - Admin</div>
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
          <li class="nav-item">
            <!--Dashboard Start-->
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!--Dashboard End-->

          <!--Inventory & Stocks Start-->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Inventory & Stocks
              </p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="total_item_lists.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Total Item Lists</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="brand_category_lists.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brand & Category Lists</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="low_stocks.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Low Stocks</p>
                </a>
              </li>
            </ul>            
          </li>
          <!--Inventory & Stocks Ends-->
          
          <!--Transactions Start-->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th-list"></i>
              <p>Transactions</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="transactions_incoming_stocks.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Incoming Stocks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="transactions_outgoing_stocks.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Outgoing Stocks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="transactions_backorders_stocks.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Back Orders</p>
                </a>
              </li>
            </ul>
          </li>
          <!--Transaction Ends-->
          
          <!--Return Lists Start-->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-exchange-alt"></i>
              <p>Return Lists</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="returnslist_requesters.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Requesters</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="returnlists_suppliers.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Suppliers</p>
                </a>
              </li>
            </ul>
          </li>
          <!--Returns Lists Ends-->

          <!--Master Lists Start-->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>Master Lists</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="masterlists_suppliers.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Suppliers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="masterlists_requesters.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Requesters</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="masterlists_system_users.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Systems Users</p>
                </a>
              </li>
            </ul>
          </li>
          <!--Master Lists Ends-->

          <!--Reports Start-->
          <li class="nav-item">
            <a href="reports.php" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Reports
              </p>
            </a>
          </li>
          <!--Reports Ends-->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>