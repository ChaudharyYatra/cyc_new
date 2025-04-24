<style>
  .underline{
    text-decoration: none !important;
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
        </div>
      </div><!-- /.container-fluid -->
    </section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
      <div class="row">
          
        <?php 
            if($arr_data['booking_enquiry_count'] >0 ){

          ?> 
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a class="underline" href="<?php echo base_url(); ?>agent_inspector/booking_enquiry/index">
            <div class="small-box bg-info">
              <div class="inner">
              <h3><?php echo  $arr_data['booking_enquiry_count']; ?></h3>
              <p>Domestic - New Enquiries</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
            </a>
          </div>
        <?php } ?>

        <?php 
            if($arr_data['booking_enquiry_follow_up_count'] >0 ){

          ?> 
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a class="underline" href="<?php echo base_url(); ?>agent_inspector/followup_booking_enquiry/index">
            <div class="small-box bg-success">
              <div class="inner">
              <h3><?php echo  $arr_data['booking_enquiry_follow_up_count']; ?></h3>
              <p>Domestic Enquiry Followup</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
            </a>
          </div>
        <?php } ?>

        <?php 
            if($arr_data['not_interested_count'] >0 ){

          ?> 
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a class="underline" href="<?php echo base_url(); ?>agent_inspector/not_interested/index">
            <div class="small-box bg-warning">
              <div class="inner">
              <h3><?php echo  $arr_data['not_interested_count']; ?></h3>
              <p>Domestic - Not Interested</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
            </a>
          </div>
        <?php } ?>

        <?php 
            if($arr_data['international_booking_enquiry_count'] >0 ){

          ?> 
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a class="underline" href="<?php echo base_url(); ?>agent_inspector/international_booking_enquiry/index">
            <div class="small-box bg-info">
              <div class="inner">
              <h3><?php echo  $arr_data['international_booking_enquiry_count']; ?></h3>
              <p>International - New</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
            </a>
          </div>
        <?php } ?>

        <?php 
            if($arr_data['international_booking_enquiry_followup_count'] >0 ){

          ?> 
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a class="underline" href="<?php echo base_url(); ?>agent_inspector/international_followup_booking_enquiry/index">
            <div class="small-box bg-success">
              <div class="inner">
              <h3><?php echo  $arr_data['international_booking_enquiry_followup_count']; ?></h3>
              <p>International - Followup</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
            </a>
          </div>
        <?php } ?>

        <?php 
            if($arr_data['international_not_interested_count'] >0 ){

          ?> 
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a class="underline" href="<?php echo base_url(); ?>agent_inspector/not_interested_international/index">
            <div class="small-box bg-warning">
              <div class="inner">
              <h3><?php echo  $arr_data['international_not_interested_count']; ?></h3>
              <p>International - Not Interested</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
            </a>
          </div>
        <?php } ?>

        <?php 
            //if($arr_data['stationary_request_details'] >0 ){

          ?> 
          <!-- <div class="col-lg-3 col-6">
            <a class="underline" href="<?php //echo base_url(); ?>agent_inspector/stationary_request_details/index">
            <div class="small-box bg-info">
              <div class="inner">
              <h3><?php //echo  $arr_data['stationary_request_details']; ?></h3>
              <p>Stationary Requested Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
            </a>
          </div> -->
        <?php //} ?>

        <?php 
            //if($arr_data['stationary_not_received_details'] >0 ){

          ?> 
          <!-- <div class="col-lg-3 col-6">
            <a class="underline" href="<?php //echo base_url(); ?>agent_inspector/stationary_not_received_details/index">
            <div class="small-box bg-warning">
              <div class="inner">
              <h3><?php //echo  $arr_data['stationary_not_received_details']; ?></h3>
              <p>Stationary Inprocess Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
            </a>
          </div> -->
        <?php //} ?>

        <?php 
            //if($arr_data['stationary_details'] >0 ){

          ?> 
          <!-- <div class="col-lg-3 col-6">
            <a class="underline" href="<?php //echo base_url(); ?>agent_inspector/stationary_details/index">
            <div class="small-box bg-success">
              <div class="inner">
              <h3><?php //echo  $arr_data['stationary_details']; ?></h3>
              <p>Stationary Completed Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
            </a>
          </div> -->
        <?php //} ?>

        <?php 
            if($arr_data['total_agent_count'] >0 ){

          ?> 
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a class="underline" href="<?php echo base_url(); ?>agent_inspector/agent/index">
            <div class="small-box bg-danger">
              <div class="inner">
              <h3><?php echo  $arr_data['total_agent_count']; ?></h3>
              <p>Total Agents</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
            </a>
          </div>
        <?php } ?>
          

        </div>
        <!-- /.row -->
    </div>
</section>
