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
              <a href="<?php echo $module_url_path; ?>/add"><button class="btn btn-primary">Add</button></a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <?php $this->load->view('admin/layout/admin_alert'); ?>
            <div class="card">
             
              <!-- /.card-header -->
              <div class="card-body">
                  <?php  if(count($arr_data) > 0 ) 
              { ?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SN</th>
                    <th>Full Name</th>
                    <th>Role Name</th>
                    <th>Other Role Name</th>
                    <th>Bank Name</th>
                    <th>Account Number</th>
                    <th>UPI App Name</th>
                    <th>UPI Id</th>
                    <th>Is Active?</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php  
                  
                   $i=1; 
                   foreach($arr_data as $info) 
                   { 
                     ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $info['full_name'] ?></td>
                    <?php if($info['Role_name']=='Other'){?>
                    <td><?php echo $info['Role_name'] ?></td>
                    <?php } else{?>
                    <td><?php echo $info['role_name'] ?></td>
                    <?php } ?>

                    <?php if($info['Role_name']=='Other'){?>
                    <td><?php echo $info['other_role_name'] ?></td>
                    <?php } else{?>
                    <td>--</td>
                    <?php } ?>
                    <td><?php echo $info['bank_name'] ?></td>
                    <td><?php echo $info['account_number'] ?></td>
                    <td><?php echo $info['payment_app_name'] ?></td>
                    <td><?php echo $info['upi_id'] ?></td>
                    <!-- <td>
                      <img src="<?php //echo base_url(); ?>uploads/QR_code_image/<?php //echo $info['qr_code_image']; ?>" width="90px;" height="60px;" alt="Image"><br>
                      <a class="btn-link pull-right text-center" download="" target="_blank" href="<?php //echo base_url(); ?>uploads/QR_code_image/<?php //echo $info['qr_code_image']; ?>">Download</a>
                    </td> -->
                    <td>
                        <?php 
                        if($info['qr_code_is_active']=='yes')
                          {
                        ?>
                        <a href="<?php echo $module_url_path ?>/active_inactive/<?php $aid=base64_encode($info['qr_add_more_id']); 
							            echo rtrim($aid, '=').'/'.$info['qr_code_is_active']; ?>"><button class="btn btn-success btn-sm">YES</button></a>
                        <?php } else { ?>
                        <a href="<?php echo $module_url_path ?>/active_inactive/<?php $aid=base64_encode($info['qr_add_more_id']); 
							            echo rtrim($aid, '=').'/'.$info['qr_code_is_active']; ?>"><button class="btn btn-danger btn-sm">NO</button> </a>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="<?php echo $module_url_path;?>/edit/<?php $aid=base64_encode($info['qr_add_more_id']); 
                          echo rtrim($aid, '='); ?>/<?php $did=base64_encode($info['id']); 
                          echo rtrim($did, '='); ?>" title="Update"><i class="fas fa-edit" aria-hidden="true" style="color:blue";></i></a> &nbsp;/&nbsp;
                        <a onclick="return confirm('Are You Sure You Want To Delete This Record?')" href="<?php echo $module_url_path;?>/delete/<?php $aid=base64_encode($info['qr_add_more_id']); 
                          echo rtrim($aid, '='); ?>" title="Delete"><i class="fa fa-trash" aria-hidden="true" style="color:red";></i></a>
                    </td>
                  </tr>
                  
                  <?php $i++; } ?>
                  
                  </tbody>
                  
                </table>
                <?php } else
                { echo '<div class="alert alert-danger alert-dismissable">
                <i class="fa fa-ban"></i>
                <b>Alert!</b>
                Sorry No records available
              </div>' ; } ?>
               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  

</body>
</html>
