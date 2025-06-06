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
              <form method="post" enctype="multipart/form-data" id="edit_supervision">
                <div class="card-body">
                  <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Select Type <span class="req_field">*</span></label>
                          <select class="select_css" name="role_type" id="role_type">
                              <option value="">Select role type</option>
                                <?php
                                  foreach($role_type as $role_type_info) 
                                  { 
                                ?>
                                <option value="<?php echo $role_type_info['id'];?>" <?php if(isset($info['role_type'])){if($role_type_info['id'] == $info['role_type']) {echo 'selected';}}?>><?php echo $role_type_info['role_name'];?></option>
                                <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                              <div class="form-group">
                                <label>supervisor Name <span class="req_field">*</span></label>
                                <input type="text" class="form-control" name="supervision_name" id="supervision_name" placeholder="Enter Agent Name" required="required" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $info['supervision_name']; ?>" required>
                              </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nick Name <span class="req_field">*</span></label>
                          <input type="text" class="form-control" name="supervision_nick_name" id="supervision_nick_name" placeholder="Enter Supervision Nick Name"  value="<?php echo $info['supervision_nick_name']; ?>" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                        </div>
                      </div>
                      <div class="col-md-6">
                              <div class="form-group">
                                <label>Mobile Number 1 <span class="req_field">*</span></label>
                                <input type="text" class="form-control" name="mobile_number1" id="mobile_number1" placeholder="Enter 10 Digits Mobile Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required" value="<?php echo $info['mobile_number1']; ?>">
                              </div>
                        </div>
                       <div class="col-md-6">
                              <div class="form-group">
                                <label>Mobile Number 2 (Optional)</label>
                                <input type="text" class="form-control" name="mobile_number2" id="mobile_number2" placeholder="Enter 10 Digits Mobile Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $info['mobile_number2']; ?>">
                              </div>
                        </div>
                        <div class="col-md-6">
                              <div class="form-group">
                                <label>Email Address <span class="req_field">*</span></label>
                                <input type="email" class="form-control" name="email" id="email_edit" placeholder="Enter Email Address" value="<?php echo $info['email']; ?>" required>
                                <span id="email_result"></span>
                              </div>
                      </div>
                      <div class="col-md-6">
                            <label>Password <span class="req_field">*</span></label>
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
                            <label>Confirm Password <span class="req_field">*</span></label>
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
  var input = $("#password");
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
  
