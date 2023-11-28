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
              <form method="post" enctype="multipart/form-data" id="add_vehicle_details">
                <div class="card-body">
                 <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Bus Type</label><br>
                          <select class="select_css" name="vehicle_bus_type" id="vehicle_bus_type">
                            <option value="">Select Bus Type</option>
                            <?php
                                   foreach($bus_type as $bus_type_info) 
                                   { 
                                ?>
                            <option value="<?php echo $bus_type_info['id']; ?>"><?php echo $bus_type_info['bus_type']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label>Vehicle Type</label>
                            <select class="select_css" name="vehicle_type" id="vehicle_type" required="required">
                                <option value="">Select Vehicle Type</option>
                                <?php
                                   foreach($vehicle_type as $vehicle_type_info) 
                                   { 
                                ?>
                                   <option value="<?php echo $vehicle_type_info['id']; ?>"><?php echo $vehicle_type_info['vehicle_type_name']; ?></option>
                               <?php } ?>
                              </select>
                          </div>
                      </div>
                      
                      <div class="col-md-6">
                              <div class="form-group">
                                <label>Seat Capacity</label>
                                <input type="text" class="form-control" name="seat_capacity" id="seat_capacity" placeholder="Enter Seat Capacity" required="required" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                              </div>
                      </div>
                      
                        
                      <div class="col-md-6">
                              <div class="form-group">
                                <label>Air Conditioners</label><br>
                                &nbsp;&nbsp;<input type="radio" name="air_conditionar" id="air_conditionar" value="AC">&nbsp;&nbsp;AC
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="air_conditionar" id="air_conditionar" value="Non-AC">&nbsp;&nbsp;Non-AC <br>
                              </div>
                      </div>
                       
              </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit" value="submit" id="submit_slider">Submit</button>
					        <a href="<?php echo $module_url_path; ?>/index"><button type="button" class="btn btn-danger">Cancel</button></a>
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
