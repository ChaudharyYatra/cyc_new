<style>
  .mealplan_css{
            border: 1px solid red !important;
        }
</style>
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
              <a href="<?php echo $module_url_path; ?>/index"><button class="btn btn-primary">Back</button></a>
              
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
          <div class="col-md-12">
            <!-- jquery validation -->
            <?php $this->load->view('admin/layout/admin_alert'); ?>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo $page_title; ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data" id="add_QR_code">
                <div class="card-body">
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Enter Full Name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                        </div>
                    </div>
                      
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Role Name</label>
                            <select class="form-control" name="role_name" id="role_name" onchange='role_name_div(this.value);'>
                            <option value="">Select Role Name</option>
                            <option value="Other">Other</option>
                            <?php foreach($role_type_data as $role_type_data_value){ ?> 
                                <option value="<?php echo $role_type_data_value['id'];?>"><?php echo $role_type_data_value['role_name'];?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6" id="other_role_name" style='display:none;'>
                        <div class="form-group">
                        <label>Other role type</label>
                        <input type="text" class="form-control mealplan_css" name="other_role" id="other_role" placeholder="Enter role name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                    </div>

                    <!-- <div class="col-md-6">
                        <div class="form-group">
                        <label>Upload QR Image</label><br>
                        <input type="file" name="image_name" id="image_name_gallery" required="required" accept="image/*">
                        <br><span class="text-danger">Please select only JPG,PNG,JPEG format files.</span><br>
                        </div>
                    </div>  -->

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Enter Mobile Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>UPI ID</label>
                            <input type="text" class="form-control" name="upi_id" id="upi_id" placeholder="Enter UPI ID" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Upload QR Image</label><br>
                          <input type="file" name="image_name" id="image_nam" required="required">
                          <br><span class="text-danger">Please select only JPG,PNG,JPEG format files.</span>
                        </div>
                    </div>
                    
              </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit" value="submit" id="submit_slider">Submit</button>
					<a href="<?php echo $module_url_path; ?>/index"><button type="button" class="btn btn-danger" >Cancel</button></a>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
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
