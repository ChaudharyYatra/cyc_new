<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hotel | Chaudhary Yatra</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
 <img src="<?php echo base_url(); ?>uploads/do_not_delete/logo.png" alt="Chaudhary Yatra" style="width:40%;"></img>
<div class="login-box">
       <?php  if($this->session->flashdata('error_message1')!=''){ ?>
  <div class="alert alert-danger  alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true" id="sess_clo">&times;</button>
<h5><i class="icon fas fa-check"></i> Alert!</h5>
<?php echo $this->session->flashdata('error_message1'); ?>
</div>
  <?php
  }
  ?>
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h4><b>Hotel Login</b></h4>
    </div>
    <div class="card-body">

      <form method="post" onsubmit="return validateloginForms()">
          <div class="row">
              <div class="col-md-12 pb-3">
                  <div class="input-group">
          <input type="text" class="form-control" placeholder="Email Address" name="hotel_email_address" id="hotel_email_address">
          <div class="input-group-append">
            
          </div>
           
        </div>
        <span class="text-danger float-left" id="emaillogin_error" style="display:none;"></span>
              </div>
              
          </div>
          <div class="row">
              <div class="col-md-12 pb-3">
                 <div class="input-group">
          <input type="password" class="form-control" placeholder="Password" name="hotel_password" id="hotel_password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span toggle="#password-field" class="fas fa-fw fa-eye field_icon toggle-password"></span>
            </div>
          </div>
        </div> 
         <span class="text-danger float-left" id="passlogin_error" style="display:none"></span>
              </div>
             
          </div>
        
       

        
        
        <div class="row">
          <div class="col-8">
            <!-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> -->
          </div>
        </div>
     

      <div class="social-auth-links text-center mt-2 mb-3">
      <button type="submit" class="btn btn-block btn-primary" name="submit" value="submit">Sign In</button>
      </div>
      </form>
      <!-- /.social-auth-links -->

      <!--<p class="mb-1">-->
      <!--  <a href="forgot-password.html">I forgot my password</a>-->
      <!--</p>-->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/admin/dist/js/adminlte.min.js"></script>
</body>
</html>

<script>
  function validateloginForms() 
{

  $("#emaillogin_error").hide();
  $("#passlogin_error").hide();
  
  var submiform='';
  
 var hotel_email_address = $('#hotel_email_address').val();
  if (hotel_email_address == '' || hotel_email_address ==null) 
  {
    $('#emaillogin_error').text('Please enter email address.');
    $('#emaillogin_error').show();
    submiform=false;
  }
  else
  {
      var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(hotel_email_address)) 
        {
           $('#emaillogin_error').text('Please enter valid email address.');
            $('#emaillogin_error').show();
            submiform=false;
        }
        else if(hotel_email_address)
        {
          var email_split = hotel_email_address.split('@');
          var count = (email_split[1].match(/\./g) || []).length;
          if(count > 2)
          {
              $('#emaillogin_error').text('Please enter valid email address.');
              $('#emaillogin_error').show();
              submiform=false;
          }
        }
  }
  
  var hotel_password = $('#hotel_password').val();
  if(hotel_password == '' || hotel_password ==null) 
  {
    $('#passlogin_error').text('Please enter password.');
    $('#passlogin_error').show();
    submiform=false;
  }

  if(submiform==='')
  {
      return true;
  }
  else
  {
     return false; 
  }
  
  
}
setTimeout(function(){ $('.alert-dismissible').hide(); }, 3000);
</script>

<script>
$("body").on('click', '.toggle-password', function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $("#hotel_password");
  if (input.attr("type") === "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }

});
</script>