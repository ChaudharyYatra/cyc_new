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
               <?php
                   foreach($arr_data as $info) 
                   { 
                     ?>
              <form method="post" enctype="multipart/form-data" id="edit_agent">
                <div class="card-body">
                 <div class="row">
					 <div class="col-md-6">
                              <div class="form-group">
                                <label>Arrange Id</label>
                                <input type="text" class="form-control" name="arrange_id" id="arrange_id" value="<?php echo $info['arrange_id']; ?>" placeholder="Enter Arrange Id" required="required">
                              </div>
                      </div>
					 <div class="col-md-6">
                              <div class="form-group">
                                <label>City Name</label>
                                <input type="text" class="form-control" name="city" id="city" placeholder="Enter City Name" value="<?php echo $info['city']; ?>" required="required">
                              </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label>Department</label>
                            <select class="form-control" style="width: 100%;" name="department" id="department" required="required">
                                <option value="">Select Department</option>
                                <?php
                                   foreach($department_data as $department_info) 
                                   { 
                                ?>
                                   <option value="<?php echo $department_info['id']; ?>" <?php if($department_info['id']==$info['department']) { echo "selected"; } ?>><?php echo $department_info['department']; ?></option>
                               <?php } ?>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-6">
                              <div class="form-group">
                                <label>Booking Centre</label>
                                <input type="text" class="form-control" name="booking_center" id="booking_center" placeholder="Enter Booking Centre Name" required="required" value="<?php echo $info['booking_center']; ?>" required>
                              </div>
                      </div>
                      <div class="col-md-6">
                              <div class="form-group">
                                <label>Agent Name</label>
                                <input type="text" class="form-control" name="agent_name" id="agent_name" placeholder="Enter Agent Name" required="required" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $info['agent_name']; ?>" required>
                              </div>
                      </div>
                      <div class="col-md-6">
                              <div class="form-group">
                                <label>Agency Name</label>
                                <input type="text" class="form-control" name="agency_name" id="agency_name" placeholder="Enter Agent Name"  oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $info['fld_agency_name']; ?>" >
                              </div>
                      </div>
                      <div class="col-md-6">
                              <div class="form-group">
                                <label>Mobile Number 1</label>
                                <input type="text" class="form-control" name="mobile_number1" id="mobile_number1" placeholder="Enter 10 Digits Mobile Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required" value="<?php echo $info['mobile_number1']; ?>">
                              </div>
                        </div>
                       <div class="col-md-6">
                              <div class="form-group">
                                <label>Mobile Number 2</label>
                                <input type="text" class="form-control" name="mobile_number2" id="mobile_number2" placeholder="Enter 10 Digits Mobile Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required" value="<?php echo $info['mobile_number2']; ?>">
                              </div>
                        </div>
                        <div class="col-md-6">
                              <div class="form-group">
                                <label>Agent Mobile Number 3</label>
                                <input type="text" class="form-control" name="mobile_number3" id="mobile_number3" placeholder="Enter 10 Digits Mobile Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $info['fld_mobile_number3']; ?>" >
                              </div>
                        </div>
                        <div class="col-md-6">
                              <div class="form-group">
                                <label>Agent Landline Number</label>
                                <input type="text" class="form-control" name="landline_number" id="landline_number" placeholder="Enter 10 Digits Landline Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $info['fld_landline_number']; ?>" >
                              </div>
                        </div>
                        <div class="col-md-6">
                              <div class="form-group">
                                <label>Office Address</label>
                                <textarea class="form-control" name="office_address" id="office_address" placeholder="Enter Office Address"><?php echo $info['fld_office_address']; ?></textarea>
                              </div>
                      </div>
                        <!-- <div class="col-md-6">
                            <label>Logo photo</label>
                              <div class="form-group">
                                <input type="file" name="logo_photo" id="logo_photo" placeholder="Logo Photo" >
                              </div>
                        </div> -->
                        <div class="col-md-6">
                              <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" name="email" id="email_edit" placeholder="Enter Email Address" value="<?php echo $info['email']; ?>" required>
                                <span id="email_result"></span>
                              </div>
                      </div>
                      <div class="col-md-6">
                              <div class="form-group">
                                <label>Registration Date</label>
                                <input type="date" class="form-control" name="registration_date" id="registration_date" placeholder="Select Date" value="<?php echo $info['fld_registration_date']; ?>" >
                              </div>
                      </div>
                      <div class="col-md-6">
                              <div class="form-group">
                                <label>GST Number</label>
                                <input type="text" class="form-control" name="GST_number" id="GST_number" placeholder="Enter GST Number" value="<?php echo $info['fld_GST_number']; ?>" >
                              </div>
                      </div>
                      <div class="col-md-6">
                              <div class="form-group">
                                <label>PAN Number</label>
                                <input type="text" class="form-control" name="pan_number" id="pan_number" placeholder="Enter PAN Number" value="<?php echo $info['fld_pan_number']; ?>" >
                              </div>
                      </div>
                      <div class="col-md-6">
                            <label>Password</label>
                              <div class="form-group input-group">
                                
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" value="<?php echo $info['password']; ?>" required>
                                <div class="input-group-append">
                                  <div class="input-group-text">
                                    <span toggle="#password-field" class="fas fa-fw fa-eye field_icon toggle-password"></span>
                                  </div>
                                </div> 
                              </div>
                      </div>
                      <div class="col-md-6">
                            <label>Confirm Password</label>
                              <div class="form-group input-group">
                                
                                <input type="password" class="form-control" name="confirm_pass" id="confirm_pass" placeholder="Enter Confirm Password" value="<?php echo $info['password']; ?>" required>
                                <div class="input-group-append">
                                  <div class="input-group-text">
                                    <span toggle="#password-field" class="fas fa-fw fa-eye field_icon toggle-password2"></span>
                                  </div>
                                </div> 
                              </div>
                      </div>
                        
              </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit" value="submit" id="btn_agent">Submit</button>
					<a href="<?php echo $module_url_path; ?>/index"><button type="button" class="btn btn-danger" >Cancel</button></a>
                </div>
                </div>
              </form>
              <?php } ?>
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


  <script>
  
  var password = document.getElementById("pass_login"), 
  confirm_password = document.getElementById("confirm_pass");

  function validatePassword(){
    if(password.value != confirm_pass.value) {
      confirm_pass.setCustomValidity("New password & confirm pasword Don't Match");
    } else {
      confirm_pass.setCustomValidity('');
    }
  }

  password.onchange = validatePassword;
  confirm_pass.onkeyup = validatePassword;

</script>

<!-- Eye Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
$("body").on('click', '.toggle-password', function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $("#pass_login");
  if (input.attr("type") === "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }

});
</script>

<script>
$("body").on('click', '.toggle-password2', function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $("#confirm_pass");
  if (input.attr("type") === "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }

});
</script>
  
