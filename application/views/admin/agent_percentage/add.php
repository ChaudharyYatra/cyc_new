
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
<!-- // ----------------- This is Live Code ----------------------------------- -->
              <form method="post" enctype="multipart/form-data" id="add_agentpercentage">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>From Amount</label>
                        <input type="text" class="form-control" name="from_amt" id="from_amt" placeholder="Enter From Amount" oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                      </div>
                    </div> 
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>To Amount</label>
                        <input type="text" class="form-control" name="to_amt" id="to_amt" placeholder="Enter To Amount" oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                      </div>
                    </div> 
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>From Date</label>
                        <input type="date" class="form-control" name="from_date" id="from_date" placeholder="Enter From Date" required="required">
                        <span class="error"><?php echo form_error('from_date'); ?></span>
                      </div>
                    </div> 
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>To Date</label>
                        <input type="date" class="form-control" name="to_date" id="to_date" placeholder="Enter To Date" required="required">
                        <span class="error"><?php echo form_error('to_date'); ?></span>
                      </div>
                    </div>   
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Agent Percentage</label>
                        <input type="text" class="form-control" name="agent_percentage" id="agent_percentage" placeholder="Enter Agent Percentage" oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
					        <a href="<?php echo $module_url_path; ?>/index"><button type="button" class="btn btn-danger" >Cancel</button></a>
                </div>
              </form>
<!-- // ----------------- This is Live Code ----------------------------------- -->
<!-- // ----------------- This is Local Code ----------------------------------- -->
<!-- Enter Address<input type="any" name="add" id="address" >
               <button onclick="getAddress()" value="" name="button">Get Map</button>
              
				  <br>
  <br>
Your Lat Lon  <br>
 Latitude<input type="text"  id="latNew">
 <br>
 Logitude<input type="text" id="lonNew">

<div id="map"> </div> -->
				
<!-- // ----------------- This is Local Code ----------------------------------- -->
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
