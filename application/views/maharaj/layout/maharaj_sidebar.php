<style>
  .tourmanager{
    text-decoration:none;
  }
  .desig_css{
    color:white;
  }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>agent/dashboard" class="brand-link">

      <img src="<?php echo base_url(); ?>uploads/do_not_delete/logo.png" alt="Chaudhary Yatra" style="width:100%;"></img>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        </div>
        <div class="info">
          <center><a href="#" class="d-block tourmanager"><?php echo $supervision_sess_name; ?></a></center>
          <center><h6 class="desig_css">[ Maharaj ]</h6></center>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
              <a href="<?php echo base_url(); ?>maharaj/dashboard/index" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard</p>
              </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url(); ?>maharaj/add_recipe_module/index" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Add Recipe Module</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url(); ?>maharaj/Recipe_details/index" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Recipe Details</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url(); ?>maharaj/profile/index" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
               Profile
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>maharaj/change_password/change_password" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
              Change password
              </p>
            </a>
          </li>
               
           <li class="nav-item">
            <a href="<?php echo base_url(); ?>supervision/login/logout" class="nav-link">
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