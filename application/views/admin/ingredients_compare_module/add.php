<style>
  .select2-selection__rendered{
    height: 50px;
    overflow-y: scroll !important;
  }

  .table .hotel_room_rate{
    padding: 0.50rem !important;
  }

    #sector_table{
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

    .for_row_set .select_css{
        color: black !important;
    }

    .hidden {
            display: none;
        }
  .select2-container .select2-selection--single {
      display:none !important;
    }


    /* The container */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: white;
  border: 1px solid black;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
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
              <a href="<?php echo $module_url_path; ?>/index"><button class="btn btn-primary">List</button></a>
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
            <?php $this->load->view('maharaj/layout/agent_alert'); ?>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo $page_title; ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <form method="post" enctype="multipart/form-data" id="add_citywise_place_master">
                <div class="card-body">
                    <h3 class="text-center">Same Ingredients List</h3>
                    <div class="row mb-2 float-right">
                    </div>
                    <table id="example1"class="table table-bordered table-striped" id="hotel_room_table">
                        <colgroup>
                            <col span="1" style="width: 10%;">
                            <col span="1" style="width: 30%;">
                            <col span="1" style="width: 30%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 10%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="hotel_room_rate">Sr No.</th>
                                <th class="hotel_room_rate">Ingredients Name</th>
                                <th class="hotel_room_rate">Quantity</th>
                                <th class="hotel_room_rate">Weight</th>
                                <th class="hotel_room_rate">Action</th>
                            </tr>
                        </thead>
                        <tbody id="ingredients_row">
                        <?php  
                            $i=1; 
                            foreach($same_ingredient_name as $same_ingredient_name_info) 
                            { 
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td>
                                    <?php echo $same_ingredient_name_info['ingredients'] ?>
                                    <input type="hidden" name="same_id[]"  value="<?php echo $same_ingredient_name_info['id'] ?>">
                                    <input type="hidden" name="ingredients_name[]"  value="<?php echo $same_ingredient_name_info['ingredients_name'] ?>">
                                </td>
                                <td><?php echo $same_ingredient_name_info['ingredients_quantity'] ?></td>
                                <td><?php echo $same_ingredient_name_info['unit_type'] ?></td>
                                
                                <td class="hotel_room_rate">
                                <label class="container">
                                    <input name="same_ingredient_approved_disapproved[]" disabled type="checkbox" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                    <hr>
                    <h3 class="text-center">Different Ingredients List</h3>
                    <table id="example1"class="table table-bordered table-striped" id="hotel_room_table">
                        <colgroup>
                            <col span="1" style="width: 10%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 10%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="hotel_room_rate">Sr No.</th>
                                <th class="hotel_room_rate">Add By</th>
                                <th class="hotel_room_rate">Ingredients Name</th>
                                <th class="hotel_room_rate">Quantity</th>
                                <th class="hotel_room_rate">Weight</th>
                                <th class="hotel_room_rate">Action</th>
                            </tr>
                        </thead>
                        <tbody id="ingredients_row">
                        <?php  
                            $i=1; 
                            foreach($different_ingredient_name as $different_ingredient_name_info) 
                            { 
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td>
                                    <?php echo $different_ingredient_name_info['supervision_name'] ?>
                                    <input type="hidden" name="different_id[]"  value="<?php echo $different_ingredient_name_info['id'] ?>">
                                </td>
                                <td><?php echo $different_ingredient_name_info['ingredients'] ?></td>
                                <td><?php echo $different_ingredient_name_info['ingredients_quantity'] ?></td>
                                <td><?php echo $different_ingredient_name_info['unit_type'] ?></td>
                                
                                <td class="hotel_room_rate">
                                <label class="container">
                                  <input type="hidden" name="diff_ingredient_approved_disapproved[<?php echo $different_ingredient_name_info['id']; ?>]" value="0">
                                  <input name="diff_ingredient_approved_disapproved[<?php echo $different_ingredient_name_info['id']; ?>]" type="checkbox" value="1" 
                                  <?php if($different_ingredient_name_info['ingredients_status'] == 1) { echo 'checked'; } ?> class="checkbox_css">
                                    <!-- <input name="diff_ingredient_approved_disapproved[]" type="checkbox" <?php //if($different_ingredient_name_info['ingredients_status'] == 1) { echo 'checked'; } ?> class="checkbox_css"> -->
                                    <span class="checkmark"></span>
                                </label>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>

                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
				          <a href="<?php echo $module_url_path; ?>/index"><button type="button" class="btn btn-danger" >Cancel</button></a>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  

