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
                    <!-- <th>Arrange Id</th> -->
                    <th>Agent ID / Name</th>
                    <th>Region Name</th>
                    <th>City Name</th>
                    <th>Enquiry Count</th>
                    <!-- <th>Booking Centre</th> -->
                    
                    <th>Agent Mobile Number 1</th>
                    <!-- <th>Password</th> -->
                    <!-- <th>Agent Mobile Number 2</th> -->
                    <th>Is Active?</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php  
                  
                   $i=1; 
                   foreach($arr_data as $info) 
                   { 
                    // print_r($arr_data); die;
                      $region_id=$info['aid'];
                      
                      $query=$this->db->query("select count(*) as ccount from booking_enquiry JOIN 
                      agent ON agent.id=booking_enquiry.agent_id where agent.id=$region_id AND booking_process='no'");
                      $enquiry=$query->row();
                      $domestic_total=$enquiry->ccount;
                      // print_r($domestic_total); die;
                      
                      $inter_query=$this->db->query("select count(*) as inter_count from international_booking_enquiry JOIN 
                      agent ON agent.id=international_booking_enquiry.agent_id where agent.id=$region_id AND booking_process='no'");
                      $inter_enquiry=$inter_query->row();
                      $inter_total=$inter_enquiry->inter_count;
                      // print_r($inter_total); die;

                      $all_enquiry=$domestic_total+$inter_total;
                     ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <!-- <td><?php //echo $info['arrange_id'] ?></td> -->
                    <td><b><?php echo $info['id'] ?></b> - <?php echo $info['agent_name'] ?></td>
                    <td><?php echo $info['department'] ?></td>
                    <td><?php echo $info['city'] ?></td>
                    <td><a href="<?php echo $module_agentwise_enquiry;?>/index/<?php echo $info['aid'];?>" title="View"><button class="btn btn-success btn-sm"><?php echo $all_enquiry ?></button></a></td>
                    <!-- <td><?php //echo $info['booking_center'] ?></td> -->
                    <td><?php echo $info['mobile_number1'] ?></td>
                    <!-- <td><?php //echo $info['password'] ?></td> -->
                    <!-- <td><?php //echo $info['mobile_number2'] ?></td> -->
                    <td>
                        <?php 
                        if($info['is_active']=='yes')
                          {
                        ?>
                        <button class="btn btn-success btn-sm" disabled>YES</button>
                        <?php } else { ?>
                        <button class="btn btn-danger btn-sm" disabled>NO</button>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="<?php echo $module_url_path;?>/details/<?php $aid=base64_encode($info['id']); 
                        echo rtrim($aid, '='); ?>" title="View"><i class="fas fa-eye" aria-hidden="true" style="color:black";></i></a>
                       
                    </td>
                  </tr>
                  
                  <?php $i++; } ?>
                  
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
  

</body>
</html>
