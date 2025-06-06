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
                  <?php  if(count($same_recipe_name) > 0 ) 
              { ?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SN</th>
                    <th>Recipe Name</th>
                    <!-- <th>Packs No</th>
                    <th>Per Plate Qty</th>
                    <th>Total Weight</th> -->
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php  
                   $i=1; 
                   foreach($same_recipe_name as $same_recipe_name_info) 
                   { 
                    // print_r($same_recipe_name_info); die;
                     ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $same_recipe_name_info['receipe'] ?></td>
                        <!-- <td><?php //echo $same_recipe_name_info['packs_no'] ?></td>
                        <td><?php //echo $same_recipe_name_info['per_plate_qty'] ?></td>
                        <td><?php //echo $same_recipe_name_info['total_weight'] ?></td> -->
                        <td>
                        <a href="<?php echo $module_url_path;?>/add/<?php echo $same_recipe_name_info['recipe_name']; ?>/<?php echo $same_recipe_name_info['id']; ?>" ><button type="button" class="btn btn-primary">View Recipe Details</button></a>
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

 
  
  