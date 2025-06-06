<style>
  .card_title {
    /* display: inline-block; */
    width: 50px;
    white-space: nowrap;
    overflow: hidden !important;
    text-overflow: ellipsis;
}
.view_btn{
  color:white;
  text-decoration:none;
}
.view_btn:hover{
  color:white;
  text-decoration:none;
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
              <!-- <a href="<?php //echo $module_url_path; ?>/add"><button class="btn btn-primary">Add</button></a> -->
              
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
              <?php $this->load->view('tour_manager/layout/agent_alert'); ?>
            <div class="card">
              <!--<div class="card-header">-->
              <!--  <h3 class="card-title">Add Slider Content</h3>-->
              <!--</div>-->
              <!-- /.card-header -->
              <div class="card-body">
                  <?php  
                  if(count($arr_data) > 0 ) 
                   {
                       ?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SN</th>
                    <th>Package Type</th>
                    <th>Tour No / Name</th>
                    <th>Request Amount For More Fund</th>
                    <th>Priority Status</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Receiving Money Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php  
                  
                   $i=1; 
                   foreach($arr_data as $info) 
                   { 
                     ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $info['package_type'] ?></td>
                    <td><?php echo $info['tour_number'] ?> - <?php echo $info['tour_title'] ?></td>
                    <td><?php echo $info['more_fund_amt'] ?></td>
                    <td><?php echo $info['priority_status'] ?></td>
                    <td><?php echo $info['reason'] ?></td>
                    <td><?php echo $info['request_status'] ?></td>

                    <td>
                    <?php if($info['Agent_send'] =='yes' && $info['request_status'] !='Received'){?>
                    <button type="button" class="btn btn-primary btn-sm" class="dropdown-item"><a href="<?php echo $module_url_path;?>/Received_money_approval/<?php $aid=base64_encode($info['id']); 
					          echo rtrim($aid, '='); ?>" class="view_btn">View</a></button> 
                    <?php } else if($info['request_status'] =='Received'){ ?>
                    <button type="button" class="btn btn-primary btn-sm" class="dropdown-item"><a href="<?php echo $module_url_path;?>/view/<?php $aid=base64_encode($info['id']); 
					          echo rtrim($aid, '='); ?>" class="view_btn">View</a></button> 
                    <?php } else{ ?>
                    <button disabled type="button" class="btn btn-primary btn-sm" class="dropdown-item"><a href="<?php echo $module_url_path;?>/Received_money_approval/<?php $aid=base64_encode($info['id']); 
					          echo rtrim($aid, '='); ?>" class="view_btn">View</a></button> 
                    <?php } ?>
                    </td>

                    <td>
                    <!-- <a href="<?php //echo $module_url_path;?>/details/<?php //$aid=base64_encode($info['id']); 
					            //echo rtrim($aid, '='); ?>" title="View"><i class="fas fa-eye" aria-hidden="true" style="color:black";></i></a> &nbsp;/&nbsp; -->
                    <a href="<?php echo $module_url_path;?>/edit/<?php $aid=base64_encode($info['id']); 
					            echo rtrim($aid, '='); ?>" title="Update"><i class="fas fa-edit" aria-hidden="true" style="color:blue";></i></a> &nbsp;/&nbsp;
                    <a href="<?php echo $module_url_path;?>/delete/<?php $aid=base64_encode($info['id']); 
					            echo rtrim($aid, '='); ?>" onclick="return confirm('Are You Sure You Want To Delete This Record?')"><i class="fa fa-trash" aria-hidden="true" style="color:red";></i></a>
                  </td>
                  </tr>
                  <?php $i++; } ?>
                  </tbody>
                  
                </table>
                 <?php } else
                {echo '<div class="alert alert-danger alert-dismissable">
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
  

</body>
</html>
