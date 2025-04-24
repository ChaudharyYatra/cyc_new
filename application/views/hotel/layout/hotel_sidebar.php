<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>hotel/dashboard" class="brand-link">

      <img src="<?php echo base_url(); ?>uploads/do_not_delete/logo.png" alt="Chaudhary Yatra" style="width:100%;"></img>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        </div>
        <div class="info">
          <center><a href="#" class="d-block"><?php echo $hotel_sess_name; ?></a></center>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>hotel/dashboard/index" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard</p>
                </a>
          </li>
          <li class="nav-item">
                <a href="<?php echo base_url(); ?>hotel/hotel_details/index" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hotel</p>
                </a>
          </li>
          
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>hotel/profile/index" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
               Profile
              </p>
            </a>
          </li>
               
           <li class="nav-item">
            <a href="<?php echo base_url(); ?>hotel/login/logout" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Logout</p>
            </a>
           </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>