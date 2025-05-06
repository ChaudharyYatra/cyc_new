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
              <form method="post" enctype="multipart/form-data"  id="add_corefeature">
                <div class="card-body">
                    <div class="row">
                    <?php foreach($arr_data as $info){ ?> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Staff Name</label>
                                <select class="form-control" name="staff_name" id="staff_name" required="required">
                                <option value="">Select staff name</option>
                                <?php foreach($agent_data as $agent_data_value){ ?>     
                                    <!-- <option value="<?php //echo $agent_data_value['id'];?>"><?php //echo $agent_data_value['agent_name'];?></option> -->
                                    <option value="<?php echo $agent_data_value['agent_id'];?>" <?php if(isset($info['staff_name'])){if($agent_data_value['agent_id'] == $info['staff_name']) {echo 'selected';}}?> ><?php echo $agent_data_value['agent_name'];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Payment Type</label>
                                <select class="select_css" name="select_transaction" id="select_transaction" onchange='account_details(this.value); 
                                    this.blur();' required="required">
                                    <option value="">Select Transaction</option>
                                    <option value="CASH" <?php if(!empty($info['select_transaction'])){if("CASH" == $info['select_transaction']) {echo 'selected';}}?>>CASH</option>
                                    <option value="UPI" <?php if(!empty($info['select_transaction'])){if("UPI" == $info['select_transaction']) {echo 'selected';}}?>>UPI</option>
                                    <option value="QR Code" <?php if(!empty($info['select_transaction'])){if("QR Code" == $info['select_transaction']) {echo 'selected';}}?>>QR Code</option>
                                    <option value="Cheque" <?php if(!empty($info['select_transaction'])){if("Cheque" == $info['select_transaction']) {echo 'selected';}}?>>Cheque</option>
                                    <option value="Net Banking" <?php if(!empty($info['select_transaction'])){if("Net Banking" == $info['select_transaction']) {echo 'selected';}}?>>Net Banking</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Enter Amount</label>
                                <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $info['amount'];?>" placeholder="Enter amount" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Enter Reason</label>
                                <input type="text" class="form-control" name="reason" id="reason" value="<?php echo $info['reason'];?>" placeholder="Enter amount" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                            </div>
                        </div>

                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Tour Details</label>
                                <select class="form-control" name="tour_number" id="tour_number">
                                <option value="">Select tour title</option>
                                <?php //foreach($packages_data as $packages_data_value){ ?> 
                                    <option value="<?php //echo $packages_data_value['id'];?>" <?php //if(isset($info['package_id'])){if($packages_data_value['id'] == $info['package_id']) {echo 'selected';}}?> ><?php //echo $packages_data_value['tour_number'];?> - <?php //echo $packages_data_value['tour_title'];?></option>
                                <?php //} ?>
                                </select>
                            </div>
                        </div> -->
                      <?php } ?>
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button> <a href="<?php echo $module_url_path; ?>/index"><button type="button" class="btn btn-danger" >Cancel</button></a>
                </div>
					
              </form>
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
  

</body>
</html>
