<style>
  .blink{
    color:red;
  }

  .add_product{
    border:1px solid gray;
  }
  .accordion-button{
    border: 1px solid gray !important;
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
              <?php $iid = $package_id; // Replace this with your actual data
                $aid = base64_encode($package_id);
                $aid = str_replace('=', '', $aid);
                $aid; 

                $td_iid = $package_date_id; 
                $td_aid = base64_encode($package_date_id);
                $td_aid = str_replace('=', '', $td_aid);
                $td_aid; 

                $tm_id = $tm_or_subtm_id; 
                $tm_id = base64_encode($tm_or_subtm_id);
                $tm_id = str_replace('=', '', $tm_id);
                $tm_id; 
                
              ?>
              <a href="<?php echo $module_url_path; ?>/all_expenses/<?php echo $aid; ?>/<?php echo $td_aid; ?>/<?php echo $tm_id; ?>"><button class="btn btn-primary">Back</button></a>
              
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
          <div class="col-md-12 col-sm-12">
            <!-- jquery validation -->
            <?php $this->load->view('admin/layout/admin_alert'); ?>
            <div class="card card-primary">
            <?php
                   foreach($tour_expenses_all as $tour_expenses_all_info) 
                   { 
                    // print_r($tour_expenses_all_info); die;
                     ?>
            
              <div class="card-header">
                <h3 class="card-title"><?php echo $page_title; ?></h3>
              </div>
              <!-- <div class="mt-2">
                <marquee><h3 class="card-title blink">Advance Payment Done From Accountant -  </h3>  <h5 class="blink"><?php //echo $tour_expenses_all_info['advance_amt']; ?></h5></marquee>
              </div> -->
              <!-- /.card-header -->
              <!-- form start -->
              
              <div class="card-body">
                <table id="" class="table table-bordered table-hover">
                    <tr>
                    <th>Tour No / Name</th>
                    <td><?php echo $tour_expenses_all_info['tour_number']; ?> - <?php echo $tour_expenses_all_info['tour_title']; ?></td>

                    <th>Tour Date</th>
                    <?php if($tour_expenses_all_info['journey_date']!=''){?>
                    <td><?php echo date("d-m-Y",strtotime($tour_expenses_all_info['journey_date'])); ?></td>
                    <?php } else{ ?>
                      <td> --- </td>
                      <?php } ?>
                   </tr>
                
                    <tr>
                      <?php
                            if($tour_expenses_all_info['expense_category_id']!='')
                              { 
                          ?>
                            <th>Sub-Expenses Head</th>
                            <td><?php echo $tour_expenses_all_info['exp_cat']; ?></td>
                      <?php } else{?>
                            
                      <?php } ?>

                      <?php
                            if($tour_expenses_all_info['tour_expenses_type']=='1')
                              { 
                          ?>
                      <th>Unit</th>
                      <td><?php echo $tour_expenses_all_info['measuring_unit']; ?></td>
                      <?php } else{?>
                            
                            <?php } ?>
                   </tr>

                   <?php
                      if($tour_expenses_all_info['tour_expenses_type']=='1')
                        { 
                    ?>
                   <tr>
                   <th>Quantity</th>
                   <td><?php echo $tour_expenses_all_info['quantity']; ?></td>

                   <th>Per Unit Rate</th>
                   <td><?php echo $tour_expenses_all_info['per_unit_rate']; ?></td>
                   </tr>
                   <?php } else{?>
                            
                            <?php } ?>
                   <tr>
                    <th>Place</th>
                    <td><?php echo $tour_expenses_all_info['expense_place']; ?></td>

                    <th>Expenses date</th>
                    <td><?php echo $tour_expenses_all_info['expense_date']; ?></td>
                   </tr>

                   <tr>
                   <th>Bill Number</th>
                    <td><?php echo $tour_expenses_all_info['bill_number']; ?></td>

                    <th>Total Pax</th>
                    <td><?php echo $tour_expenses_all_info['total_pax']; ?></td>
                   </tr>

                   <tr>
                   <th>Bill Date</th>
                    <td><?php echo $tour_expenses_all_info['bill_date']; ?></td>

                    <th>Bill Amount</th>
                    <td><?php echo $tour_expenses_all_info['expense_amt']; ?></td>
                  </tr>

                  <tr>
                    <th>Expence Details(optional)</th>
                    <td><?php echo $tour_expenses_all_info['tour_expenses_remark']; ?></td>

                    <?php if(!empty($tour_expenses_all_info['update_remark']) && $tour_expenses_all_info['update_remark']=='yes'){?>
                    <th>Sub Tour Manager Remark</th>
                    <td><?php echo $tour_expenses_all_info['update_remark']; ?></td>
                    <?php } ?>
                  </tr>
                  
                    <tr>
                    <th>Upload Attatchment</th>
                    <td>
                    <?php foreach($tour_expenses_image_all as $tour_expenses_image_all_info){ ?>
                      <?php if(!empty($tour_expenses_image_all_info['image_name'])){ ?>
                          <img src="<?php echo base_url(); ?>uploads/tour_expenses/<?php echo $tour_expenses_image_all_info['image_name']; ?>" width="10%">
                          <input type="hidden" name="old_img_name" id="old_img_name" value="<?php echo $tour_expenses_image_all_info['image_name']; ?>">
                        <?php } ?>

                        <?php if(!empty($tour_expenses_image_all_info['image_name'])){ ?>
                            <a class="btn-link pull-right text-center" download="" target="_blank" href="<?php echo base_url(); ?>uploads/tour_expenses/<?php echo $tour_expenses_image_all_info['image_name']; ?>">Download</a>
                            <input type="hidden" name="old_img_name" id="old_img_name" value="<?php if(!empty($tour_expenses_image_all_info['image_name'])){echo $tour_expenses_image_all_info['image_name'];}?>">
                        <?php } ?>
                        <?php } ?>
                    </td>

                    <!-- <th>Upload Attatchment</th>
                    <td>
                      <?php //if(!empty($tour_expenses_all_info['image_name_2'])){ ?>
                          <img src="<?php //echo base_url(); ?>uploads/tour_expenses/<?php //echo $tour_expenses_all_info['image_name_2']; ?>" width="20%">
                          <input type="hidden" name="old_new_name" id="old_new_name" value="<?php //echo $tour_expenses_all_info['image_name_2']; ?>">
                        <?php //} ?>

                        <?php //if(!empty($tour_expenses_all_info['image_name_2'])){ ?>
                            <a class="btn-link pull-right text-center" download="" target="_blank" href="<?php //echo base_url(); ?>uploads/tour_expenses/<?php //echo $tour_expenses_all_info['image_name_2']; ?>">Download</a>
                            <input type="hidden" name="old_new_name" id="old_new_name" value="<?php //if(!empty($tour_expenses_all_info['image_name_2'])){echo $tour_expenses_all_info['image_name_2'];}?>">
                        <?php //} ?>
                    </td> -->
                  </tr>
                </table>
              </div>
              <?php $expences_id = $tour_expenses_all_info['t_expences_id']; ?>

              <input type="hidden" readonly class="form-control" name="expense_id" id="expense_id" value="<?php echo $tour_expenses_all_info['t_expences_id']; ?>" required>

              <input type="hidden" readonly class="form-control" name="package_id" id="package_id" value="<?php echo $aid ?>" required>
              <input type="hidden" readonly class="form-control" name="package_date_id" id="package_date_id" value="<?php echo $td_aid ?>" required>
              <input type="hidden" readonly class="form-control" name="tour_manager_id" id="tour_manager_id" value="<?php echo $tm_id ?>" required>
              
              <?php if($tour_expenses_all_info['tour_expenses_type']=='0'){?>
              <div class="card-body">
                <div class="accordion accordion-flush" id="accordion">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <b>Show Added Product Details</b>
                      </button>
                    </h2>
                    <table class="table table-bordered table-bordered collapse hide" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion">
                      <thead>
                        <tr>
                          <th>Sr.No</th>
                          <!-- <th>Expense Head</th> -->
                          <th>Sub-Expenses Head</th>
                          <th>Product Name</th>
                          <th>Unit</th>
                          <th>Quantity</th>
                          <th>Total Amt.</th>
                          <th>Per Unit Rate</th>
                        </tr>
                      </thead>  
                      
                      <tbody>
                      <?php  
                      $i=1; 
                      foreach($add_more_tour_expenses_all as $add_more_tour_expenses_all_value) 
                      { 
                        ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <!-- <td><?php //echo $add_more_tour_expenses_all_value['expense_type_name'] ?></td> -->
                          <td>
                            <?php if($add_more_tour_expenses_all_value['other_name'] != ''){?>
                              <?php echo $add_more_tour_expenses_all_value['expense_category'] ?> - <?php echo $add_more_tour_expenses_all_value['other_name'] ?>
                            <?php } else{ ?>
                              <?php echo $add_more_tour_expenses_all_value['expense_category'] ?>
                            <?php } ?>
                          </td>
                          <td><?php echo $add_more_tour_expenses_all_value['expense_category'] ?></td>
                          <td><?php echo $add_more_tour_expenses_all_value['measuring_unit'] ?></td>
                          <td><?php echo $add_more_tour_expenses_all_value['quantity'] ?></td>
                          <td><?php echo $add_more_tour_expenses_all_value['rate'] ?></td>
                          <td><?php echo $add_more_tour_expenses_all_value['per_unit_rate'] ?></td>
                        </tr>
                        <?php $i++; } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <?php } ?>

              <!-- Add Approve and Hold buttons -->
              <div class="text-center mt-4">

<?php 
if($tour_expenses_all_info['tour_manager_id']=='')
{
  if($tour_expenses_all_info['approval']=='no' && $tour_expenses_all_info['hold']=='yes')
    {
  ?>
  <button type="button" attr_approve="<?php echo $tour_expenses_all_info['t_expences_id'] ?>" class="btn btn-primary approve" name="submit" value="submit">Approve</button>
  
  <?php } else if($tour_expenses_all_info['approval']=='yes'  && $tour_expenses_all_info['hold']=='no'){ ?>
    <button type="button" disabled class="btn btn-success" name="submit" value="submit">Approved</button>
  <?php } ?>

  <?php 
    if($tour_expenses_all_info['approval']=='yes'  && $tour_expenses_all_info['hold']=='no')
    { ?>
    
  <?php } else if($tour_expenses_all_info['approval']=='no'  && $tour_expenses_all_info['hold']=='yes'){ ?>
    <button class="btn btn-warning" id="holdButton">Hold</button>
    <?php } else if($tour_expenses_all_info['approval']=='no' && $tour_expenses_all_info['hold']=='pending'){?>
  
      <button type="button" attr_approve="<?php echo $tour_expenses_all_info['t_expences_id'] ?>" class="btn btn-primary approve" name="submit" value="submit">Approve</button>
      <button class="btn btn-warning" id="holdButton">Hold</button>
  <?php } ?>

    
</div>

<br>
<div class="row">
  <div class="col-md-3 col-sm-3">
  </div>
  <div class="col-md-6 col-sm-6">
    <?php 
      if($tour_expenses_all_info['hold_reason']!='') 
      { ?>
        <label for="holdReason">Hold Reason:</label>
        <textarea disabled class="form-control" id="hold_reason" name="hold_reason" placeholder="Enter Hold Reason" required="required"><?php echo $tour_expenses_all_info['hold_reason'] ?></textarea>
    <?php } ?>
  </div>
  <div class="col-md-3 col-sm-3">

  </div>
</div>

<div class="row">
  <div class="col-md-3 col-sm-3">
  </div>
  <div class="col-md-6 col-sm-6">
    <?php 
      if($tour_expenses_all_info['hold_reason']!='' && $tour_expenses_all_info['hold']=='yes') 
      { ?>
        <label for="">Sub Tour Manager Remark:</label>
        <textarea disabled class="form-control" id="subtm_hold_reason" name="subtm_hold_reason" placeholder="Enter Hold Reason" required="required"><?php echo $tour_expenses_all_info['update_remark'] ?></textarea>
    <?php } ?>
  </div>
  <div class="col-md-3 col-sm-3">

  </div>
</div>
<?php } ?>

<div class="row">

  <div class="col-md-3 col-sm-3">

  </div>
  <div class="col-md-6 col-sm-6">

    <!-- Hidden textbox and submit button initially -->
    <div id="holdSection" style="display: none;" class="mt-4">
      <form id="holdForm">
          <div class="form-group">
              <label for="holdReason">Hold Reason:</label>
              <textarea class="form-control" id="hold_reason" name="hold_reason" placeholder="Enter Hold Reason" required="required"></textarea>

          </div>
          <!-- <button type="submit" class="btn btn-primary hold" name="submit">Submit Hold</button> -->

          <button type="button" attr_hold="<?php echo $tour_expenses_all_info['t_expences_id'] ?>" class="btn btn-primary hold" name="submit" value="submit">Submit Hold</button>
      </form>
      
    </div>
  </div>
  <div class="col-md-3 col-sm-3">

  </div>

</div>
            <br>
        <div class="row">

            </div>
            <?php } ?>
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
