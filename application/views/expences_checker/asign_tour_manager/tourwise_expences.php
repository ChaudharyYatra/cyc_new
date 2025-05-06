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
                    <th>Add By</th>
                    <th>Expenses date</th>
                    <th>Expenses Type</th>
                    <th>Sub-Expenses Head</th>
                    <th>Status</th>
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
                    <td><?php echo $i; ?> </td>

                    <td><?php echo date("d-m-Y",strtotime($info['expense_date'])) ?></td>

                    <td><?php echo $info['supervision_name']; ?></td>
                    
                    <td>
                    <?php
                          if($info['tour_expenses_type']=='1')
                            { 
                        ?>
                          Single Expenses
                      <?php } else if($info['tour_expenses_type']=='0'){?>
                          Multiple Expences
                      <?php } ?>
                    </td>
                    
                    <td>
                    <?php
                          if($info['expense_category']!='')
                            { 
                        ?>
                          <?php echo $info['expense_category']; ?>
                        <?php } ?>
                    </td>

                    <td>
                    <?php 
                      if($info['exp_checker_approval']=='no' && $info['exp_checker_hold']=='yes')
                        {
                      ?>
                      Hold
                      
                      <?php } else if($info['exp_checker_approval']=='yes'  && $info['exp_checker_hold']=='no'){ ?>
                        Approved
                      <?php } else if($info['exp_checker_approval']=='no'  && $info['exp_checker_hold']=='pending'){ ?>
                        Pending
                      <?php } ?>

                    </td>

                    <td>
                    <?php if(!empty($info['tour_manager_id'])){?>
                    <a href="<?php echo $module_url_path;?>/tourwise_expences_details/<?php $aid=base64_encode($info['package_id']); 
					            echo rtrim($aid, '='); ?>/<?php $aid=base64_encode($info['id']); echo rtrim($aid, '='); ?>/<?php $aid=base64_encode($info['package_date_id']); 
					            echo rtrim($aid, '='); ?>/<?php $aid=base64_encode($info['tour_manager_id']); 
					            echo rtrim($aid, '='); ?>" title="View"><i class="fas fa-eye" aria-hidden="true" style="color:black"; title="View"></i></a>
                    <?php } else if(!empty($info['sub_tour_manager_id'])){ ?>
                      <a href="<?php echo $module_url_path;?>/tourwise_expences_details/<?php $aid=base64_encode($info['package_id']); 
					            echo rtrim($aid, '='); ?>/<?php $aid=base64_encode($info['id']); echo rtrim($aid, '='); ?>/<?php $aid=base64_encode($info['package_date_id']); 
					            echo rtrim($aid, '='); ?>/<?php $aid=base64_encode($info['sub_tour_manager_id']); 
					            echo rtrim($aid, '='); ?>" title="View"><i class="fas fa-eye" aria-hidden="true" style="color:black"; title="View"></i></a>
                    <?php } ?>
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
