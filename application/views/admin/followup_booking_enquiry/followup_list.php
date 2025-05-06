<style>
  .table-color{
    background:#00899f80;
  }

  .table-color-agent{
    background:#6c757d57;
    color:#000 !important;
  }
  
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $page_title; ?></h1>
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
          <div class="col-12">
            <div class="card-body">
                  <?php  
                    foreach($arr_data_booking_enquiry as $info) 
                        { 
                          ?>
                  <table id="example2" class="table table-bordered table-hover table-color-agent">
                    <tr>
                      <th>Agent Name</th>
                      <td><?php echo $info['agent_name']; ?></td>

                      <th>Region Name</th>
                      <td><?php echo $info['department']; ?></td>

                      <th>Centre Name</th>
                      <td><?php echo $info['booking_center']; ?></td>
                    </tr>
                  </table>
                  <?php } ?>
            </div>

            <div class="card-body">
                <?php  
                  foreach($arr_data_booking_enquiry as $info) 
                      { 
                        ?>
                <table id="example2" class="table table-bordered table-hover table-color" style="width:50%;">
                  <tr>
                    <!--<th>Customer Name</th>-->
                    <td><?php echo $info['first_name']; ?> <?php echo $info['last_name']; ?></td>

                    <!--<th>Mobile No.</th>-->
                    <td><?php echo $info['mobile_number']; ?></td>

                    <!--<th></th>-->
                    <td><b>Enquiry Date :</b> <?php echo date('d-m-Y', strtotime($info['c_date'])); ?></td>
                  </tr>
                </table>
                <?php } ?>
            </div>

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
                    <th>Follow Up Date</th>
                    <th>Follow Up Time</th>
                    <th>Next Follow Up Date</th>
                    <th>Reason</th>
                    <th>Follow Up Comment</th>
                    <th>Action</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php  
                  
                   $i=1; 
                   foreach($arr_data as $info) 
                   { 
                       $enq_id=$info['id'];
                     ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $info['follow_up_date'] ?></td>
<!-- // ----------------- This is Live Code ----------------------------------- -->
<!-- <td><?php //if($i < 5)
                          //   {
                          //   echo $info['follow_up_time'];
                          //     }else
                          // {
                          //   echo "No Record";
                          // }
                    ?></td>
                    <td><?php //if($i < 5)
                          //   {
                          //   echo date('d-m-Y', strtotime($info['next_followup_date']));
                          //     }else
                          // {
                          //   echo "No Record";
                          // }
                    ?></td>
					 <td><?php //echo $info['create_followup_reason'] ?></td>
                    <td><?php //echo $info['follow_up_comment'] ?></td>
					  <td>
                        <?php 
                        // if($info['is_followup_status']=='no')
                        //   {
                        // ?>
                        // <?php
                        //     if($count >= 5)
                        //     {
                        // ?>
                        // <h5 style="color:red;">Not Interested</h5>
                        // <?php        
                        //     }else{
                        ?>
                        
						<button class="btn btn-danger btn-sm btn_follow_form<?php //echo $i;?>"  data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $i;?>" attr-test="no" attr-count="<?php echo $i;?>">Next Followup</button>
                        <?php //} ?>
                        <?php //} else { ?>
                        <button class="btn btn-success btn-sm btn_follow_form disabled" attr-test="no">Followup Done</button>
                        <?php //} ?>
                        
                        <?php 
                        // if($info['is_followup_status']=='no' && $count <= 4)
                        //   {
                        ?>
                        <button type="button" class="btn btn-primary btn-sm btn_follow" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#booking">Booking</button>
                        <?php //} ?>
                    </td>
                   
                  </tr> -->
                  
<!-- // ----------------- This is Live Code ----------------------------------- -->
<!-- // ----------------- This is Local Code ----------------------------------- -->
<td><?php echo $info['follow_up_time'] ?></td>
                    <td><?php echo $info['next_followup_date'] ?></td>
                    <td><?php echo $info['create_followup_reason'] ?></td>
                    <td><?php echo $info['follow_up_comment'] ?></td>
                    <td>
                      <button type="button" class="btn btn-primary" name="remark" id="remark" data-toggle="modal" data-target="#exampleModal2_<?php echo $enq_id; ?>">
                          Edit
                      </button>
                    </td>
                  </tr>
                  
                  
                  <div class="modal fade" id="exampleModal2_<?php echo $enq_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Next followup form</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        
                    <form method="post" action="<?php echo $module_url_path;?>/domestic_followup">
                    <div class="col-md-12">
                            <div class="row">
                              <div class="col-md-6 mb-2">
                                <label class="col-form-label">Next followup Date:</label> 
                                <input type="date" class="form-control" name="next_followup_date" id="next_followup_date" min="<?php echo date("Y-m-d"); ?>" value="<?php if(isset($info['next_followup_date'])){ echo $info['next_followup_date'];}?>" required>
                                <input type="hidden" name="enquiry_id" id="enquiry_id" value="<?php if(isset($info['id'])){ echo $info['id'];}?>">
                              </div>
                              <div class="col-md-6 mb-2">
                                <label class="col-form-label">Next Follow Up Time:</label>
                                <input type="time" class="form-control" name="follow_up_time" id="follow_up_time" value="<?php if(isset($info['follow_up_time'])){ echo $info['follow_up_time'];}?>" required>
                              </div>
                              <div class="col-md-12 mb-2">
                                <label>Select Reason</label>
                                  <div class="input-group">
                                      <select class="form-control niceSelect" name="followup_reason" id="followup_reason" onfocus='this.size=4;' onblur='this.size=1;' 
                                          onchange='this.size=1; this.blur();' required="required">
                                          <option value="">Select reason</option>

                                          <?php foreach($followup_reason_data as $followup_reason){ ?> 
                                            <option value="<?php echo $followup_reason['id']; ?>" <?php if(isset($info['followup_reason'])){if($followup_reason['id'] == $info['followup_reason']) {echo 'selected';}}?> ><?php echo $followup_reason['create_followup_reason']; ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <label class="col-form-label">Follow Remark:</label>
                                <textarea class="form-control" name="follow_up_comment" id="follow_up_comment" required><?php echo $info['follow_up_comment']; ?></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <a onclick="return confirm('Are You Sure You Want To submit This Follow Up Record?')" href="<?php echo $module_url_path;?>/booking_enquiry/<?php echo $info['id']; ?>"><button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button></a>
                          </div>
                        </form>
                    </div>
                </div>
                </div>
<!-- // ----------------- This is Local Code ----------------------------------- -->
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
