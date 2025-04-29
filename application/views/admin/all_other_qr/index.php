<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $module_title; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <a href="<?php //echo $module_url_path; ?>/add"><button class="btn btn-primary">Add</button></a> -->
              
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
                    <th>Name</th>
                    <th>Bank Name</th>
                    <th>Account No.</th>
                    <th>UPI ID</th>
                    <th>Payment Type</th>
                    <th>QR Image</th>
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
                    <td><?php echo $info['bank_name'] ?></td>
                    <td><?php echo $info['account_number'] ?></td>
                    <td><?php echo $info['upi_id'] ?></td>
                    <td><?php echo $info['payment_app_name'] ?></td>
                    <td>
                    <button type="button" class="btn btn-primary" name="remark" id="remark" data-toggle="modal" data-target="#exampleModal2_<?php echo $i; ?>">
                        View
                    </button>
                    </td>
                </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal2_<?php echo $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Remark</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        
                    <form method="post" action="<?php echo $module_url_path;?>/add_remark">
                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-md-12">
                                <input type="hidden" name="suggestion_id" id="suggestion_id" value="<?php if(isset($info['id'])){ echo $info['id'];}?>">
                                <img src="<?php echo base_url(); ?>uploads/QR_code_image/<?php echo $info['qr_code_image']; ?>" width="100%;" height="60%;" alt="Slider Image">
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                            <!-- <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button> -->
                            <!-- <a onclick="return confirm('Are You Sure You Want To submit This Follow Up Record?')" href="<?php //echo $module_url_path;?>/index/<?php //echo $info['id']; ?>"><button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button></a> -->
                          </div>
                        </form>
                    </div>
                </div>
                </div>
                  
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
