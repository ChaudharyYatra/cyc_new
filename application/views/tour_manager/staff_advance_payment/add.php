
<!-- jQuery UI CSS -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

<style>
    .card-bg{
        background-color: #F6F6F6;
    }
    img{
        width:25% !important;
        height:25% !important;
    }

    table{
        table-layout: fixed;
        display: block;
        overflow: auto;
    }
    .for_row_set .row_set{
        width:135px;

    }
    .for_row_set .row_set1{
        width:70px;

    }
    .mealplan_css{
            border: 1px solid red !important;
        }

    .cash_payment_div{
        border: 1px solid red;
        padding: 10px;
        margin-top:10px;
        margin-bottom:40px;
    }
    .add_more_css{
        margin-top:30px;
    }

    .remove_color .form-control{
        color: black !important;
    }
    .remove_color .select_css{
        color: black !important;
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
              <a href="<?php echo $module_url_path; ?>/index/<?php echo $aid; ?>/<?php echo $did; ?>"><button class="btn btn-primary">List</button></a>
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
            <?php $this->load->view('agent/layout/agent_alert'); ?>
            <div class="card card-primary">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" id="add_tour_expenses">   
                    <div class="row">
                        <!---======================== this tour title and tour date in select field and apply dependancy on tour title wise tour date ====================== -->
                        
                        <!---======================== this tour title and tour date in select field and apply dependancy on tour title wise tour date ====================== -->
                        <?php foreach($packages_data as $packages_data_info){ ?> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tour No / Name</label>
                                <input readonly type="text" class="form-control" name="tour_number_1" id="tour_number_1" value="<?php if(!empty($packages_data_info)){ echo $packages_data_info['tour_number'];} ?> - <?php if(!empty($packages_data_info)){ echo $packages_data_info['tour_title'];} ?>">
                                <input type="hidden" class="form-control" name="tour_number" id="tour_number" value="<?php echo $packages_data_info['id'];?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tour date</label>
                                <input readonly type="text" class="form-control" name="tour_date_1" id="tour_date_1" value="<?php if(!empty($packages_data_info)){ echo $packages_data_info['journey_date'];} ?>">
                                <input type="hidden" class="form-control" name="tour_date" id="tour_date" value="<?php echo $packages_data_info['pd_id'];?>">
                            </div>
                        </div>
                        <?php } ?>

                        <div class="col-md-6">
                            <div class="form-group remove_color">
                                <label>Select Staff</label>
                                <select class="select_css" name="select_staff" id="select_staff" required>
                                <option value="">Select staff</option>
                                    <?php foreach($assign_staff_data as $assign_staff_data_info){ ?>   
                                        <option value="<?php echo $assign_staff_data_info['sup_id'];?>"><?php echo $assign_staff_data_info['supervision_name'];?></option>
                                    <?php } ?>  
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter amount" required oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Save & Close</button>
                        <a href="<?php echo $module_url_path; ?>/index"><button type="button" class="btn btn-danger" >Cancel</button></a>
                    </div>
                </form>
                
                </div>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>



        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
<!-- tour expenses in that single and multiple click script-->
<script>
    function sub(){
    document.getElementById('sub_main_tour_div1').style.display = 'block';
    // document.getElementById('expenses_head_div').style.display = 'none';
    document.getElementById('sub_expenses_head_div').style.display = 'none';
    document.getElementById('single_measuring_unit_div').style.display = 'none';
    document.getElementById('single_quantity_div').style.display = 'none';
    document.getElementById('single_per_unit_rate_div').style.display = 'none';

    }
    function main(){
    document.getElementById('sub_main_tour_div1').style.display = 'none';
    // document.getElementById('expenses_head_div').style.display = 'block';
    document.getElementById('sub_expenses_head_div').style.display = 'block';
    document.getElementById('single_measuring_unit_div').style.display = 'block';
    document.getElementById('single_quantity_div').style.display = 'block';
    document.getElementById('single_per_unit_rate_div').style.display = 'block';
    document.getElementById('expense_type').value = "";
    document.getElementById('expense_category').value = "";
    }

    function main_yes(){
    document.getElementById('vendor_details_div').style.display = 'none';
    }
    function sub_no(){
    document.getElementById('vendor_details_div').style.display = 'block';
    }
</script>
<!-- tour expenses in that single and multiple click script-->

