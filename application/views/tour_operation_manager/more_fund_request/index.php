<style>
  .card_title {
    /* display: inline-block; */
    width: 50px;
    white-space: nowrap;
    overflow: hidden !important;
    text-overflow: ellipsis;
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
                    <th>Request Amount For More Fund From TM</th>
                    <th>Request Amount Status From TOM</th>
                    <!-- <th>Priority Status</th>
                    <th>Reason</th> -->
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
                    <td><?php echo $info['request_status'] ?></td>
                    <!-- <td><a data-bs-toggle="modal" data-bs-target="#exampleModal<?php //echo $i; ?>" data-bs-whatever="Form"><button type="button" class="btn btn-primary btn-sm" class="dropdown-item">Approval Amt</button> </a></td> -->
                    <!-- <td><?php //echo $info['priority_status'] ?></td>
                    <td><?php //echo $info['reason'] ?></td> -->
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-default">Action</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <?php if($info['TOM_send']=='yes'){ ?>
                        <div class="dropdown-menu" role="menu">
                          <a href="<?php echo $module_url_path;?>/view_give_money_approval/<?php echo $info['id'];?>" class=""><button class="dropdown-item" >View</button></a>
                        </div>
                        <?php }else{ ?> 
                        <div class="dropdown-menu" role="menu">
                          <a href="<?php echo $module_url_path;?>/add_give_money_approval/<?php echo $info['id'];?>" class=""><button class="dropdown-item" >Give Money Approval</button></a>
                        </div>
                        <?php } ?>
                      </div>
                    </td>

                  </tr>

                  <div class="modal fade" id="exampleModal<?php echo $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Approval Amount Details</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="<?php echo $module_url_path;?>/add" enctype="multipart/form-data">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-6 mb-2" hidden>
                                  <label class="col-form-label">tm_request_more_fund_id</label> 
                                  <input type="text" class="form-control" name="tm_request_fund_id" id="tm_request_fund_id" value="<?php echo $info['id']; ?>">
                                </div>
                                <?php if($info['tom_approval_amt']==''){?>
                                <div class="col-md-12 mb-2">
                                  <label class="col-form-label">Approval Amount:</label> 
                                  <input type="text" class="form-control" name="approval_amt" id="approval_amt" required>
                                </div>
                                  <?php }else{ ?>
                                <div class="col-md-12 mb-2">
                                  <label class="col-form-label">Approval Amount:</label> 
                                  <input type="text" readonly class="form-control" name="approval_amt" id="approval_amt" required value="<?php echo $info['tom_approval_amt']; ?>">
                                </div>
                                <?php } ?>
                              </div>
                            </div>

                            </div>
                            <div class="modal-footer">
                              <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                              <a onclick="return confirm('Are You Sure You Want To send ?')" href="<?php echo $module_url_path;?>/index/"><button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button></a>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
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
