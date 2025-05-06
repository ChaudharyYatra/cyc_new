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
            <?php $this->load->view('tour_manager/layout/agent_alert'); ?>
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
              <form method="post" enctype="multipart/form-data" id="suugestion_edit">
                <div class="card-body">
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tour Manager Name</label>
                                    <input readonly type="text" class="form-control" name="tm_name" id="tm_name" placeholder="Enter Tm name" value="<?php echo $info['supervision_name'];?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Amount To Be Paid</label>
                                    <input readonly type="text" class="form-control" name="amount_to_be_paid" id="amount_to_be_paid" placeholder="Enter Tm name" value="<?php echo $info['more_fund_amt'];?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                  <label>Priority Status</label>
                                  <select class="select_css" name="priority_status" id="priority_status" disabled>
                                      <option value="">Select Priority</option>
                                      <option value="High" <?php if(isset($info['priority_status'])){if("High" == $info['priority_status']) {echo 'selected';}}?>>High</option>
                                      <option value="Medium" <?php if(isset($info['priority_status'])){if("Medium" == $info['priority_status']) {echo 'selected';}}?>>Medium</option>
                                      <option value="Low" <?php if(isset($info['priority_status'])){if("Low" == $info['priority_status']) {echo 'selected';}}?>>Low</option>
                                  </select>
                              </div>
                            </div>  

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reason</label>
                                    <textarea readonly type="text" class="form-control" name="reason" id="reason" placeholder="Enter reason"><?php echo $info['reason'];?></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sanction Paid Amount</label>
                                    <input type="text" class="form-control" name="sanction_paid_amt" id="sanction_paid_amt" placeholder="Enter Sanction Paid Amount" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                            </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit" id="submit_slider">Submit</button>
                    <a href="<?php echo $module_url_path; ?>/index"><button type="button" class="btn btn-danger">Cancel</button></a>
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
 