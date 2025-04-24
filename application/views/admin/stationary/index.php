
<style>
	.parent_table tr table
	     {
    display:none;
  
} 

.parent_table .sub-level
	     {
    display:none;
  
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
              <a href="<?php echo $module_url_path; ?>/add"><button class="btn btn-primary">Add</button></a>
              
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
                <table id="example1" class="table table-bordered table-striped parent_table">
                  <thead>
                  <tr>
                    <th>SN </th>
                    <th>Stationary Name</th>
                    <th>Financial Year</th>
                    <!-- <th>Series</th> -->
					<th>Total Quantity</th>
                    <th>Series Item</th>
                    <th>Is Active?</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php  
                  
                   $i=1; 
                   foreach($arr_data as $info) 
                   { 
					   $stationary_id=$info['id'];

                    $query=$this->db->query("SELECT * FROM stationary_order_details WHERE stationary_order_details.stationary_name=$stationary_id");
                    $data_array=$query->result_array();

                    $order_qty=count($data_array);
                     ?>
                  <tr class="header-level" data-bs-toggle="collapse" data-bs-target="#r1">
                    <td><?php echo $i; if($info['series_yes_no']=='Yes')
                          {?> 
                          <i class="fa fa-angle-down"></i>
                          <?php } ?></td>
                    <td><?php echo $info['stationary_name'] ?></td>
                    <td><?php echo $info['year'] ?></td>
                    <!-- <td><?php //echo $info['from_series'] ?> - <?php //echo $info['to_series'] ?></td> -->
                    <td><?php echo $info['stationary_quantity'] ?></td>
                    <td><?php echo $info['series_yes_no'];?></td>
                    <td>
                        <?php 
                        if($info['is_active']=='yes')
                          {
                        ?>
                        <a href="<?php echo $module_url_path ?>/active_inactive/<?php $aid=base64_encode($info['id']); 
							echo rtrim($aid, '=').'/'.$info['is_active']; ?>"><button class="btn btn-success btn-sm">YES</button></a>
                        <?php } else { ?>
                        <a href="<?php echo $module_url_path ?>/active_inactive/<?php $aid=base64_encode($info['id']); 
							echo rtrim($aid, '=').'/'.$info['is_active']; ?>"><button class="btn btn-danger btn-sm">NO</button> </a>
                        <?php } ?>
                    </td>
                    <td>
                      <?php if($order_qty<=0){ ?>
                          <a onclick="return confirm('Are You Sure You Want To Delete This Record?')" href="<?php echo $module_url_path;?>/delete/<?php $aid=base64_encode($info['id']); 
					   echo rtrim($aid, '='); ?>" title="Delete"><i class="fa fa-trash" aria-hidden="true" style="color:red";></i></a>&nbsp;/&nbsp;
						 <?php } ?>
             <a href="<?php echo $module_url_path;?>/add_stock/<?php $aid=base64_encode($info['id']); 
					   echo rtrim($aid, '='); ?>" title="Add Stock"> <i class="fa fa-plus" aria-hidden="true" style="color:green";></i></a>
                          
                    </td>
                  </tr>
<?php if($info['series_yes_no']=='Yes'){ ?>
  <tr class="sub-level">
    <td colspan="7">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>SN</th>
            <th>Stationary Name</th>
            <th>Lot No</th>
            <th>From Series</th>
			<th>To Series</th>
            <th>Book No</th>
            <th>Total Book</th>              
          </tr>
        </thead>
        <tbody>
          <?php 
         $stationary_id=$info['id'];
          $query=$this->db->query("select * from stationary_details where stationary_details.stationary_id=$stationary_id GROUP BY stationary_details.id");
						  
          $data_array=$query->result_array();
          $j=1;
          foreach($data_array as $stdetails){
			  $stat_id=$stdetails['stationary_id'];
			  $query=$this->db->query("select * from stationary where stationary.id=$stat_id");
			  $stationary_name_data=$query->result_array();
			  foreach($stationary_name_data as $statname){
				  $stationary_name=$statname['stationary_name'];
			  }
			 
          ?>

          <tr>
            <td><?php echo $j;?></td>
            <td><?php echo $stationary_name;?></td>
            <td><?php echo $stdetails['lot_no']+1;?></td>
            <td><?php echo $stdetails['from_series'];?></td>
			<td><?php echo $stdetails['to_series'];?></td>
            <td><?php echo $stdetails['book_no'];?></td>
            <td><?php echo $stdetails['total_book'];?></td>                
          </tr>
          <?php 
          $j++;
        } ?>
        </tbody>                  
      </table>
    </td>  
  </tr>
<?php } ?>


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
