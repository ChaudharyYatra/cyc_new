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
              <a href="<?php echo $module_url_path; ?>/index/<?php echo $pid; ?>/<?php echo $pd_id; ?>"><button class="btn btn-primary">List</button></a>
              
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
                   foreach($arr_data as $info) 
                   { 
                     ?>
              <form method="post" enctype="multipart/form-data" id="edit_hotel_type">
              <div class="card-body">
                  <div class="container">
                    <div class="row"> 
                        <div class="col-md-6">
                            <div class="form-group remove_color">
                                <label>Select Staff</label>
                                <select class="select_css" name="select_staff" id="select_staff" required>
                                <option value="">Select staff</option>
                                    <?php foreach($assign_staff_data as $assign_staff_data_info){ ?>   
                                        <option value="<?php echo $assign_staff_data_info['sup_id'];?>" <?php if(isset($info['select_staff'])){if($assign_staff_data_info['sup_id'] == $info['select_staff']) {echo 'selected';}}?> ><?php echo $assign_staff_data_info['supervision_name'];?></option>
                                        <?php } ?>  
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $info['amount'] ?>" placeholder="Enter amount" required oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>
                    </div> 
                    <br>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
					        <a href="<?php echo $module_url_path; ?>/index/<?php echo $pid; ?>/<?php echo $pd_id; ?>"><button type="button" class="btn btn-danger" >Cancel</button></a>
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
 
