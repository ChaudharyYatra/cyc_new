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
              <form method="post" enctype="multipart/form-data" id="add_state">
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                            <div class="form-group">
                              <label>Select Country</label>
                              <select class="form-control" style="width: 100%;" name="country_id" id="country_id" required="required">
                                  <option value="">Select Country Name</option>
                                  <?php
                                    foreach($country_name_data as $country_name_info) 
                                    { 
                                  ?>
                                    <option value="<?php echo $country_name_info['id']; ?>"><?php echo $country_name_info['country_name']; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control" name="state_name" id="state_name" placeholder="Enter State Name">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                            <div class="form-group">
                              <label>State Permit Rate</label>
                              <input type="text" class="form-control" name="state_permit_rate" id="state_permit_rate" placeholder="Enter State Permit rate">
                            </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label>All India Permit Rate</label>
                            <input type="text" class="form-control" name="all_india_permit_rate" id="all_india_permit_rate" placeholder="Enter All India Permit Rate">
                        </div>
                      </div>
                    </div>

                    <div class="row" id="main_row_tax_type">
                      <!-- <div class="col-md-6">
                        <div class="form-group">
                          <label>Select Tax Type</label>
                          <select class="form-control" style="width: 100%;" name="tax_type[]" id="tax_type" required="required">
                            <option value="">Select Tax Type</option>
                            <option value="Daily">Daily</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Monthly">Monthly</option>
                            <option value="Yearly">Yearly</option>
                          </select>
                        </div>
                      </div> -->

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Daily Tax Rate</label><br>
                          <input type="text" class="form-control" name="daily_tax_rate" id="daily_tax_rate" placeholder="Enter Daily Tax Rate">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Weekly Daily Tax Rate</label><br>
                          <input type="text" class="form-control" name="weekly_tax_rate" id="weekly_tax_rate" placeholder="Enter Weekly Tax Rate">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Monthly Tax Rate</label><br>
                          <input type="text" class="form-control" name="monthly_tax_rate" id="monthly_tax_rate" placeholder="Enter Monthly Tax Rate">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Yearly Tax Rate</label><br>
                          <input type="text" class="form-control" name="yearly_tax_rate" id="yearly_tax_rate" placeholder="Enter Yearly Tax Rate">
                        </div>
                      </div>

                      <!-- <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label></label>
                            <button type="button" class="btn btn-primary" name="submit" value="add_more_tax" name="add_more_tax" id="add_more_tax">Add More</button>
                        </div>
                      </div> -->

                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
				  <a href="<?php echo $module_url_path; ?>/index"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button></a>
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
