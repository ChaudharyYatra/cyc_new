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
              <?php
                   foreach($money_transfer_agent_to_agent as $info)    
                   { 
                     ?>
              <form method="post" enctype="multipart/form-data" id="edit_district">
                <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Money Given</label>
                            <select class="form-control" style="width: 100%;" name="money_given_agent_nm" id="money_given_agent_nm" required="required">
                                <option value="">Select Agent Name</option>
                                <?php
                                   foreach($agent_name_data as $agent_name_info) 
                                   { 
                                ?>
                                   <option value="<?php echo $agent_name_info['id']; ?>" <?php if($agent_name_info['id']==$info['money_given_agent_nm']) { echo "selected"; } ?>><?php echo $agent_name_info['agent_name']; ?></option>
                               <?php } ?>
                              </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                          <div class="form-group">
                            <label>Money Receiver</label>
                            <select class="form-control" style="width: 100%;" name="money_receiver_agent_name" id="money_receiver_agent_name" required="required">
                                <option value="">Select Agent Name</option>
                                <?php
                                   foreach($agent_name_data as $agent_name_info) 
                                   { 
                                ?>
                                   <option value="<?php echo $agent_name_info['id']; ?>" <?php if($agent_name_info['id']==$info['money_receiver_agent_nm']) { echo "selected"; } ?>><?php echo $agent_name_info['agent_name']; ?></option>
                               <?php } ?>
                              </select>
                          </div>
                        </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
					<a href="<?php echo $module_url_path; ?>/index"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button></a>
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
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  

</body>
</html>
