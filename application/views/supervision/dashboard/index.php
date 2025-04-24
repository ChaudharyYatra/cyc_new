<style>
  .underline{
    text-decoration: none;
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
            if($arr_data['request_code_number'] >0 ){

          ?> 
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a class="underline" href="<?php echo base_url(); ?>supervision/supervision_request/index">
            <div class="small-box bg-info">
              <div class="inner">
              <h3><?php echo  $arr_data['request_code_number']; ?></h3>
              <p>Request for code</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
            </a>
          </div>
        <?php } ?>


        <?php 
            if($arr_data['request_code_completed'] >0 ){

          ?> 
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a class="underline" href="<?php echo base_url(); ?>supervision/supervision_request_completed/index">
            <div class="small-box bg-success">
              <div class="inner">
              <h3><?php echo  $arr_data['request_code_completed']; ?></h3>
              <p>Request for code Completed</p>
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
