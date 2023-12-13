<style>
    .cash_payment_div{
        border: 1px solid black;
        padding: 20px;
    }
    .card-image{
        height: 300px;
    }
    .button_css{
        margin-left:10px;
    } 
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1><?php //echo $module_title; ?></h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <a href="<?php //echo $module_url_path; ?>/index"><button class="btn btn-primary">List</button></a> -->
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
            <div class="col-md-1"></div>
            <div class="col-md-10">
            <!-- jquery validation -->
            <?php $this->load->view('agent/layout/agent_alert'); ?>
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                    <img src="<?php echo base_url(); ?>uploads/do_not_delete/Packages.png" class="card-img-top card-image" alt="...">
                    <div class="card-body">
                        <h2 class="mt-2">Booking Confirmed! 🎉✈️</h2>
                        <h5 class="mt-4">Your booking is confirmed. We will send your credentials to the provided mobile number and email address.</h5>
                    </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
            </div>

            <?php
                    foreach($agent_booking_enquiry_data as $agent_booking_enquiry_data_info) 
                    { 
                        $enquiry_id =  $agent_booking_enquiry_data_info['id'];
                    ?>
                        <input type="hidden" class="form-control" name="domestic_enquiry_id" id="domestic_enquiry_id" value="<?php echo $agent_booking_enquiry_data_info['id']; ?>">
                    <?php } ?>
            <div class="d-flex justify-content-center">
                <a href="<?php echo $module_booking_payment_details; ?>/index/<?php echo $enquiry_id; ?>"><button type="button" class="btn btn-primary mb-3 button_css" name="confirm_submit" id="confirm_submit">Procced for Receipt</button></a>
            </div>
        </div>
        <div class="col-md-1"></div>

          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>





