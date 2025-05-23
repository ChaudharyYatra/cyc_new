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
              <!-- <a href="<?php //echo $module_url_path; ?>/agent_index"><button class="btn btn-primary">back</button></a> -->
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
                    <th>Tour No / Tour Name </th>
                    <th>Tour Date</th>
                    <th>Agent Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php  
                   $i=1; 
                   foreach($arr_data as $info) 
                   { 
                    if($info['tour_expenses_bill']== '0'){
                     ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $info['tour_number'] ?> - <?php echo $info['tour_title'] ?></td>
                        <td><?php echo $info['journey_date'] ?></td>
                        <td><?php echo $info['supervision_name'] ?></td>
                        <td>
                        <a href="<?php echo $module_url_path;?>/details/<?php echo $info['package_id']; ?>/<?php echo $info['package_date_id']; ?>" ><button type="button" class="btn btn-primary">View Pending Payment Details</button></a>
                        </td>
                    </tr>
                    <?php $i++; } }?>
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

 
  
  