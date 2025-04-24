<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $page_title; ?></h1>
          </div>
          <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
              <a href="<?php echo $module_url_path; ?>/change_password"><button class="btn btn-primary">Change Password</button></a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12 col-sm-12">
            <!-- jquery validation -->
            
            <?php
                   foreach($arr_data as $info) 
                   { 
                     ?>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo $page_title; ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <tr>
                    <th>Hotel Name</th>
                    <td><?php echo $info['hotel_name']; ?></td>
                    <th>Location</th>
                    <td><?php echo $info['hotel_location']; ?></td>
                    
                 </tr>
                 <tr>
                     <th>Mobile Number</th>
                    <td><?php echo $info['hotel_mobile_number']; ?></td>
                    <th>Email Address</th>
                    <td><?php echo $info['hotel_email_address']; ?></td>
                  </tr>
                  </table>
              </div>
              
        <br>
        <div class="row">


            </div>
            <?php } ?>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  

</body>
</html>
