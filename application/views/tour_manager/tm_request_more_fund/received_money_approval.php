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
              $i=1; 
                  foreach($arr_data as $info) 
                  { 
                     ?>
              <form method="post" enctype="multipart/form-data" id="suugestion_edit">
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Agent Name</label>
                              <input readonly type="text" class="form-control" name="tm_name" id="tm_name" placeholder="Enter Tm name" value="<?php echo $info['tour_manager_supervision_name'];?>">
                          </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Tour Operation Manager Name</label>
                              <input readonly type="text" class="form-control" name="tom_name" id="tom_name" placeholder="Enter Tm name" value="<?php echo $info['tom_supervision_name'];?>">
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
                                <label>Payment status </label> <br>
                                &nbsp;&nbsp;<input type="radio" name="payment_status" id="male" value="Received">&nbsp;&nbsp;Received
                                &nbsp;&nbsp;<input type="radio" name="payment_status" id="female" value="Not Received">&nbsp;&nbsp;Not Received <br>
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
                              <label>Agent Paid Amount</label>
                              <input readonly type="text" class="form-control" name="staff_paid_amt" id="staff_paid_amt" value="<?php echo $info['agent_name'];?>" placeholder="Enter Agent Paid Amount" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Uploaded Image</label><br>
                              <?php if(!empty($info['staff_sending_fund_photo'])){ ?>
                                      <img src="<?php echo base_url(); ?>uploads/agent_giving_tm_extra_fund/<?php echo $info['staff_sending_fund_photo']; ?>" width="70%">
                                      <input type="hidden" name="old_img_name" id="old_img_name" value="<?php echo $info['staff_sending_fund_photo']; ?>">
                                      <?php } ?>
                          </div>
                      </div> 
                      <div class="col-md-2 mt-5">
                          <a data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $i; ?>" data-bs-whatever="Form"><button type="button" class="btn btn-primary btn-sm" class="dropdown-item">View Photo</button> </a>
                      </div>  
                      
                      
                    </div>

                    
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit" id="submit_slider">Submit</button>
                    <a href="<?php echo $module_url_path; ?>/index"><button type="button" class="btn btn-danger">Cancel</button></a>
                </div>
              </form>

              <div class="modal fade" id="exampleModal<?php echo $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">View Photo</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="<?php echo $module_url_path;?>/add" enctype="multipart/form-data">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-6 mb-2" hidden>
                                  <label class="col-form-label">tm_request_more_fund_id</label> 
                                  <input type="text" class="form-control" name="tm_request_fund_id" id="tm_request_fund_id" value="<?php echo $info['id']; ?>">
                                </div>
                                <div class="col-md-12 mb-2">
                                <img src="<?php echo base_url(); ?>uploads/agent_giving_tm_extra_fund/<?php echo $info['staff_sending_fund_photo']; ?>" width="100%">
                                </div>
                              </div>
                            </div>

                            </div>
                            <!-- <div class="modal-footer"> -->
                              <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                              <!-- <a onclick="return confirm('Are You Sure You Want To send ?')" href="<?php //echo $module_url_path;?>/index/"><button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button></a> -->
                            <!-- </div> -->
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php $i++; } ?>
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
 