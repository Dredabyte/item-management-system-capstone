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
          <div class="text-muted toastrDefaultInfo"><?php echo ucwords($_settings->userdata('firstname'). ' - '.$_settings->userdata('role')) ?></div>
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
                <p>ORDER LISTS</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
            <!--Inventory Request -->
            <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=inventory_request" class="nav-link nav-inventory_request">
                  <i class="nav-icon fas fa-solid fa-envelope-open-text"></i>
                  <p>
                    Inventory Request
                  </p>
                </a>
              </li>

             <!--Purchase Order -->
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=purchase_order_list" class="nav-link nav-purchase_order_list">
                  <i class="nav-icon fas fa-cart-arrow-down"></i>
                  <p>
                    Purchase Order List
                  </p>
                </a>
              </li>
              
              <!--Back Order -->
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=backorder_list" class="nav-link nav-backorder_list">
                  <i class="nav-icon fas fa-clock-rotate-left"></i>
                  <p>
                    Back Order List
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
                <p>RETURN LISTS</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
            <!--Return List-Supplier -->
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=return_list_supplier" class="nav-link nav-return_list_supplier">
                  <i class="nav-icon fas fa-rotate-right"></i>
                  <p>
                    Return List - Suppliers
                  </p>
                </a>
              </li>   
              
              <!--Return List-Requester -->
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=return_list_requester" class="nav-link nav-return_list_requester">
                  <i class="nav-icon fas fa-rotate-right"></i>
                  <p>
                    Return List - Requesters
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <!--Return List End-->          


          <!--Transactions  Start-->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
                <p>TRANSACTIONS</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview"> 
             <!--Incoming Stocks --> 
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=incoming_stock" class="nav-link nav-incoming_stock">
                  <i class="nav-icon fas fa-right-to-bracket"></i>
                  <p>
                    Incoming Stocks
                  </p>
                </a>
              </li>

              <!--Outgoing Stocks -->
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=outgoing_stock" class="nav-link nav-outgoing_stock">
                  <i class="nav-icon fas fa-right-from-bracket"></i>
                  <p>
                    Outgoing Stocks
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <!--Outgoing Stocks End-->

          <?php if($_settings->userdata('type') == 1): ?>
          <!--Item List  Start-->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
                <p>ITEMS</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">  
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=item_list" class="nav-link nav-item_list">
                  <i class="nav-icon fas fa-boxes"></i>
                  <p>
                    Item Lists
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
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=low_stock" class="nav-link nav-low_stock">
                  <i class="nav-icon fas fa-exclamation-triangle"></i>
                  <p>
                    Low Stocks
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
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=supplier" class="nav-link nav-supplier">
                  <i class="nav-icon fas fa-address-book"></i>
                  <p>
                    Suppliers
                  </p>
                </a>
              </li>

              <!--Requester -->
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=requester" class="nav-link nav-requester">
                  <i class="nav-icon fas fa-address-book"></i>
                  <p>
                    Requesters
                  </p>
                </a>
              </li>

              <!--System Users -->
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=system_user/profile_list" class="nav-link nav-system_user_profile_list">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    System Users
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
          <!--Reports Ends-->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


<script>
    var page;
    $(document).ready(function(){
        page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'dashboard' ?>';
        page = page.replace(/\//gi,'_');

        if($('.nav-link.nav-'+page).length > 0){
            $('.nav-link.nav-'+page).addClass('active');
            var parentTreeview = $('.nav-link.nav-'+page).closest('.nav-treeview');
            var parentNav = parentTreeview.siblings('a');

            parentNav.addClass('active');
            parentTreeview.parent().addClass('menu-open');
        }
    });
</script>
