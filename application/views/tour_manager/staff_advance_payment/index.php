<style>
    .itinerary_css{
        text-decoration:none !important;
    }
</style>
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
            <a href="<?php echo $module_url_path; ?>/add/<?php echo $pid; ?>/<?php echo $pd_id; ?>"><button class="btn btn-primary">Add</button>
            </a>
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
              <?php $this->load->view('agent/layout/agent_alert'); ?>
            <div class="card">
             
              <!-- /.card-header -->
              <div class="card-body">
                  <?php  //if(count($arr_data) > 0 ) 
              //{ ?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SN</th>
                    <th>Staff Name</th>
                    <th>Amount</th>
                    <th>Is Active?</th>
                    <th>Action</th>
                    <!-- <th>Advance Payment Done From Accountant</th> -->
                  </tr>
                  </thead>
                  <tbody>
                  <?php  
                  
                   $i=1; 
                   foreach($staff_advance_payment_data as $staff_advance_payment_data_info) 
                   { 
                     ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $staff_advance_payment_data_info['supervision_name'] ?></td>
                    <td><?php echo $staff_advance_payment_data_info['amount'] ?></td>
                    <td>
                        <?php 
                        if($staff_advance_payment_data_info['is_active']=='yes')
                          {
                        ?>
                        <a href="<?php echo $module_url_path ?>/active_inactive/<?php echo $staff_advance_payment_data_info['id'].'/'.$staff_advance_payment_data_info['is_active']; ?>/<?php echo $pid; ?>/<?php echo $pd_id; ?>"><button class="btn btn-success btn-sm">YES</button></a>
                        <?php } else { ?>
                        <a href="<?php echo $module_url_path ?>/active_inactive/<?php echo $staff_advance_payment_data_info['id'].'/'.$staff_advance_payment_data_info['is_active']; ?>/<?php echo $pid; ?>/<?php echo $pd_id; ?>"><button class="btn btn-danger btn-sm">NO</button> </a>
                        <?php } ?>
                    </td>
                    <td>
                      <a href="<?php echo $module_url_path;?>/edit/<?php echo $staff_advance_payment_data_info['id']; ?>/<?php echo $pid; ?>/<?php echo $pd_id; ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true" style="color:blue";></i></a> &nbsp;/&nbsp;
                      <a onclick="return confirm('Are You Sure You Want To Delete This Record?')" href="<?php echo $module_url_path;?>/delete/<?php echo $staff_advance_payment_data_info['id']; ?>/<?php echo $pid; ?>/<?php echo $pd_id; ?>" title="Delete"><i class="fa fa-trash" aria-hidden="true" style="color:red";></i></a>
                    </td>
                  </tr>
                  <?php $i++; } ?>
                  </tbody>
                </table>
                 <?php //} else
            //     { echo '<div class="alert alert-danger alert-dismissable">
            //     <i class="fa fa-ban"></i>
            //     <b>Alert!</b>
            //     Sorry No records available
            //   </div>' ; } ?>
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
