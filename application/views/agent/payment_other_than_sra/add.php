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
              <form method="post" enctype="multipart/form-data"  id="assign_vehicle">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Staff Name</label>
                              <select class="form-control" name="staff_name" id="staff_name" required="required">
                              <option value="">Select staff name</option>
                              <?php foreach($agent_data as $agent_data_value){ ?>     
                                  <option value="<?php echo $agent_data_value['agent_id'];?>"><?php echo $agent_data_value['agent_name'];?></option>
                              <?php } ?>
                              </select>
                          </div>
                          <input type="hidden" name="agent_mob_no" id="agent_mob_no">
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Payment Type</label>
                                <select class="select_css" name="select_transaction" id="select_transaction" onchange='account_details(this.value); 
                                    this.blur();' required="required"> 
                                    <option value="">Select Transaction</option>
                                    <option value="CASH">CASH</option>
                                    <option value="UPI">UPI</option>
                                    <option value="QR Code">QR Code</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Net Banking">Net Banking</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Enter Amount</label>
                                <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter amount" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Enter Reason</label>
                                <input type="text" class="form-control" name="reason" id="reason" placeholder="Enter amount" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                            </div>
                        </div>

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
