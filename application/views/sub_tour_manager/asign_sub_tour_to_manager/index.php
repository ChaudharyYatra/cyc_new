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
                    <th>Package Type</th>
                    <th>Tour Title</th>
                    <th>Journey Date</th>
                    <th>Tour Status</th>
                    <!-- <th>Is Active?</th> -->
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php  
                  
                   $i=1; 
                   foreach($arr_data as $info) 
                   { 
                    // print_r($info); die;
                     ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <?php if($info['package_type']!="Special Limited Offer"){
                      ?>
                    <td><?php echo $info['package_type'] ?></td>
                    <?php }else{
                      ?>
                      <td>Special Limited Offer</td>
                    <?php } ?>
					
                    <td><?php echo $info['tour_number'] ?> - <?php echo $info['tour_title'] ?></td>
                    <?php if($info['journey_date']!=''){?>
                    <td><?php echo date("d-m-Y",strtotime($info['journey_date'])); ?></td>
                    <?php } else {?>
                      <td> --- </td>
                      <?php }?>

                    <?php 
                    $today= date('Y-m-d');
                    if($info['journey_date'] > $today) {?>
                      <td> Upcoming Tour </td>
                    <?php } else if($info['journey_date'] == $today){
                      ?>
                    <td> Running Tour </td>
                    <?php 
                     } else{
                    ?>
                    <td> Done Tour </td>
                     <?php } ?>
                    
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-default">Action</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a href="<?php echo $module_url_path;?>/iternary_details/<?php $aid=base64_encode($info['id']); 
					                  echo rtrim($aid, '='); ?>/<?php $did=base64_encode($info['did']); 
					                  echo rtrim($did, '='); ?>" class="itinerary_css"><button class="dropdown-item">Itinerary Details</button>
                          </a>

                          <a href="<?php echo $module_url_path_instruction;?>/index/<?php $aid=base64_encode($info['package_id']); 
					                  echo rtrim($aid, '='); ?>/<?php $did=base64_encode($info['did']); 
					                  echo rtrim($did, '='); ?>" class="itinerary_css"><button class="dropdown-item">Show Instruction</button>
                          </a>

                          <a href="<?php echo $module_url_tour_photos;?>/add/<?php $aid=base64_encode($info['package_id']); 
					                  echo rtrim($aid, '='); ?>/<?php $did=base64_encode($info['did']); 
					                  echo rtrim($did, '='); ?>" class="itinerary_css"><button class="dropdown-item">Add Tour Photos</button>
                          </a>

                          <a href="<?php echo $module_satff_advance_payment;?>/index/<?php $aid=base64_encode($info['package_id']); 
					                  echo rtrim($aid, '='); ?>/<?php $did=base64_encode($info['did']); 
					                  echo rtrim($did, '='); ?>" class="itinerary_css"><button class="dropdown-item">Staff Advance Payment</button>
                          </a>

                          <a href="<?php echo $module_url_path_request_more_fund;?>/add/<?php $aid=base64_encode($info['package_id']); 
					                  echo rtrim($aid, '='); ?>/<?php $did=base64_encode($info['did']); 
					                  echo rtrim($did, '='); ?>" class="itinerary_css"><button class="dropdown-item">Request for More fund</button>
                          </a>

                          <a href="<?php echo $module_url_path_tour_expenses;?>/add/<?php $aid=base64_encode($info['package_id']); 
					                  echo rtrim($aid, '='); ?>/<?php $did=base64_encode($info['did']); 
					                  echo rtrim($did, '='); ?>" class="itinerary_css"><button class="dropdown-item">Daily Tour Expenses</button>
                          </a>

                          <a href="<?php echo $module_url_path_customer_feedback;?>/index/<?php $aid=base64_encode($info['package_id']); 
					                  echo rtrim($aid, '='); ?>/<?php $did=base64_encode($info['did']); 
					                  echo rtrim($did, '='); ?>" class="itinerary_css"><button class="dropdown-item">Feedback From Customer</button>
                          </a>

                          <a href="<?php echo $module_url_path_request_replace_bus;?>/add/<?php $aid=base64_encode($info['package_id']); 
					                  echo rtrim($aid, '='); ?>/<?php $did=base64_encode($info['did']); 
					                  echo rtrim($did, '='); ?>" class="itinerary_css"><button class="dropdown-item">Request Replace Bus</button>
                          </a>
                        </div>
                      </div>
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
