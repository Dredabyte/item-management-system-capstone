  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="./" class="nav-link">Item Management System</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->

      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->

      <!--USER profile-->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle dropdown-icon" data-toggle="dropdown">
            <img src="<?php echo validate_image($_settings->userdata('avatar')) ?>" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline"><?php echo ucwords($_settings->userdata('firstname').' '.$_settings->userdata('middlename').' '.$_settings->userdata('lastname')) ?></span>
        </a>
      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-info">
            <img src="<?php echo validate_image($_settings->userdata('avatar')) ?>" class="img-circle elevation-2" alt="User Image">
            <p>
            <?php echo ucwords($_settings->userdata('firstname'). ' - '.$_settings->userdata('role')) ?>
            </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
            <a href="<?php echo base_url ?>admin/?page=system_user" class="btn btn-default btn-flat">Profile</a>
            <a href="<?php echo base_url.'/classes/Login.php?f=logout' ?>" class="btn btn-default btn-flat float-right">Sign out</a>
            </li>
      </ul>
      </li>
    </ul>
  </nav>
  <!-- /.navbar --