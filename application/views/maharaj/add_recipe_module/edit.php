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
                    <?php
                        foreach($recipe_data as $recipe_data_info) 
                        { 
                    ?>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Select Recipe Name</label>
                                <select class="select_css" name="recipe_name" id="recipe_name" required="required">
                                <option value="">Select Recipe Name</option>
                                    <?php
                                        foreach($recipe_name as $recipe_name_info) 
                                        { 
                                    ?>
                                    <option value="<?php echo $recipe_name_info['id'];?>" <?php if(isset($recipe_data_info['recipe_name'])){if($recipe_name_info['id'] == $recipe_data_info['recipe_name']) {echo 'selected';}}?>><?php echo $recipe_name_info['receipe'];?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" class="form-control" name="recipe_data_id" id="recipe_data_id" placeholder="Enter packs no" value="<?php echo $recipe_data_info['id'];?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Enter Packs No.</label>
                                <input type="text" class="form-control" name="packs_no" id="packs_no" placeholder="Enter packs no" value="<?php echo $recipe_data_info['packs_no'];?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required" onkeyup="calculateTotalWeight()">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Enter Per Plate Quantity</label>
                                <input type="text" class="form-control" name="per_plate_quantity" id="per_plate_quantity" value="<?php echo $recipe_data_info['per_plate_qty'];?>" placeholder="Enter per plate quantity" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required" onkeyup="calculateTotalWeight()">
                            </div>
                        </div>
                    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Total Weight</label>
                                <input readonly type="text" class="form-control" name="total_weight" id="total_weight" value="<?php echo $recipe_data_info['total_weight'];?>" placeholder="Enter total weight" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <hr>
                    <h3 class="text-center">Add Ingredients</h3>
                    <div class="row mb-2 float-right">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success" name="edit_add_more_ingredients" id="edit_add_more_ingredients">Add More Ingredients</button>
                        </div>
                    </div>
                    <table class="table table-bordered" id="hotel_room_table">
                        <colgroup>
                            <col span="1" style="width: 30%;">
                            <col span="1" style="width: 30%;">
                            <col span="1" style="width: 10%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="hotel_room_rate">Select Ingredients</th>
                                <th class="hotel_room_rate">Quantity</th>
                                <th class="hotel_room_rate">Action</th>
                            </tr>
                        </thead>
                        <tbody id="ingredients_row">
                            <?php
                            foreach($ingredients as $ingredients_data_info_one) 
                            { 
                            ?>
                            <tr>
                                <td class="hotel_room_rate">
                                    <select class="form-control" style="width: 100%;" name="ingredients_name[]" id="ingredients_name" required="required">
                                    <option value="">Select Ingredients</option>
                                          <?php
                                            foreach($ingredients_data as $ingredients_data_info) 
                                            { 
                                          ?>
                                            <option value="<?php echo $ingredients_data_info['id'];?>" <?php if(isset($ingredients_data_info_one['ingredients_name'])){if($ingredients_data_info['id'] == $ingredients_data_info_one['ingredients_name']) {echo 'selected';}}?>><?php echo $ingredients_data_info['ingredients'];?></option>
                                            <?php } ?>
                                    </select>
                                    <input type="hidden" class="form-control" name="ingredient_id[]" id="ingredient_id" placeholder="Enter Ingredients Quantity" value="<?php echo $ingredients_data_info_one['id'];?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                                </td>
                                <td class="hotel_room_rate">
                                    <input type="text" class="form-control" name="ingredient_quantity[]" id="ingredient_quantity" placeholder="Enter Ingredients Quantity" value="<?php echo $ingredients_data_info_one['ingredients_quantity'];?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                                </td>
                                
                                <td class="hotel_room_rate">
                                    <button type="button" class="btn btn-danger btn_remove" disabled>X</button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <hr>
                    <h3 class="text-center">Add Kitchen Equipment's</h3>
                    <div class="row mb-2 float-right">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success" name="edit_add_more_equipment" id="edit_add_more_equipment">Add More Equipment</button>
                        </div>
                    </div>
                    <table class="table table-bordered" id="hotel_room_table">
                        <colgroup>
                            <col span="1" style="width: 30%;">
                            <col span="1" style="width: 30%;">
                            <col span="1" style="width: 30%;">
                            <col span="1" style="width: 10%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="hotel_room_rate">Select Equipment Name</th>
                                <th class="hotel_room_rate">Quantity</th>
                                <th class="hotel_room_rate">Weight</th>
                                <th class="hotel_room_rate">Action</th>
                            </tr>
                        </thead>
                        <tbody id="Equipment_row">
                            <?php
                            foreach($kitchen_equipment as $kitchen_equipment_one) 
                            { 
                            ?>
                            <tr>
                                <td class="hotel_room_rate">
                                    <select class="form-control" style="width: 100%;" name="Equipment_name[]" id="Equipment_name" required="required">
                                    <option value="">Select Equipment</option>
                                          <?php
                                            foreach($kitchen_equipment_data as $kitchen_equipment_data_info) 
                                            { 
                                          ?>
                                            <option value="<?php echo $kitchen_equipment_data_info['id'];?>" <?php if(isset($kitchen_equipment_one['equipment_name'])){if($kitchen_equipment_data_info['id'] == $kitchen_equipment_one['equipment_name']) {echo 'selected';}}?>><?php echo $kitchen_equipment_data_info['kitchen_equipment_name'];?></option>
                                            <?php } ?>
                                    </select>
                                    <input type="hidden" class="form-control" name="equipment_id[]" id="equipment_id" placeholder="Enter equipment quantity" value="<?php echo $kitchen_equipment_one['id'];?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                                </td>
                                <td class="hotel_room_rate">
                                    <input type="text" class="form-control" name="equipment_quantity[]" id="equipment_quantity" placeholder="Enter equipment quantity" value="<?php echo $kitchen_equipment_one['equipment_quantity'];?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                                </td>
                                <td class="hotel_room_rate">
                                    <select class="form-control" style="width: 100%;" name="equipment_weight[]" id="equipment_weight" required="required">
                                    <option value="">Select Weight</option>
                                          <?php
                                            foreach($measuring_unit_data as $measuring_unit_data_info) 
                                            { 
                                          ?>
                                            <option value="<?php echo $measuring_unit_data_info['id'];?>"><?php echo $measuring_unit_data_info['unit_type'];?></option>
                                            <option value="<?php echo $measuring_unit_data_info['id'];?>" <?php if(isset($kitchen_equipment_one['equipment_weight'])){if($measuring_unit_data_info['id'] == $kitchen_equipment_one['equipment_weight']) {echo 'selected';}}?>><?php echo $measuring_unit_data_info['unit_type'];?></option>
                                            <?php } ?>
                                    </select>
                                </td>
                                <td class="hotel_room_rate">
                                    <button type="button" class="btn btn-danger btn_remove" disabled>X</button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>


                    <hr>
                    <h3 class="text-center">Add Recipe</h3>
                    <div class="row mb-2 float-right">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success" name="edit_add_more_recipe" id="edit_add_more_recipe">Add More Recipe</button>
                        </div>
                    </div>
                    <table class="table table-bordered" id="hotel_room_table">
                        <colgroup>
                            <col span="1" style="width: 10%;">
                            <col span="1" style="width: 50%;">
                            <col span="1" style="width: 10%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 10%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="hotel_room_rate">Step</th>
                                <th class="hotel_room_rate">Enter Recipe</th>
                                <th class="hotel_room_rate">Quantity</th>
                                <th class="hotel_room_rate">Enter Require Time in Minutes</th>
                                <th class="hotel_room_rate">Action</th>
                            </tr>
                        </thead>
                        <tbody id="recipe_row">
                            <?php
                            foreach($recipe_process_data as $recipe_process_data_info) 
                            { 
                            ?>
                            <tr>
                                <td class="hotel_room_rate">
                                <input type="text" class="form-control" name="recipe_steps[]" id="recipe_steps" value="<?php echo $recipe_process_data_info['recipe_step'];?>" placeholder="Enter recipe steps" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                                <input type="hidden" class="form-control" name="recipe_id[]" id="recipe_id" value="<?php echo $recipe_process_data_info['id'];?>" placeholder="Enter recipe steps" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                                </td>
                                <td class="hotel_room_rate">
                                    <input type="text" class="form-control" name="enter_recipe[]" id="enter_recipe" value="<?php echo $recipe_process_data_info['enter_recipe'];?>" placeholder="Enter recipe" required="required">
                                </td>
                                <td class="hotel_room_rate">
                                    <input type="text" class="form-control" name="recipe_quantity[]" id="recipe_quantity" value="<?php echo $recipe_process_data_info['recipe_quantity'];?>" placeholder="Enter recipe quantity" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                                </td>
                                <td class="hotel_room_rate">
                                    <input type="text" class="form-control" name="recipe_require_time[]" id="recipe_require_time" value="<?php echo $recipe_process_data_info['require_time'];?>" placeholder="Enter recipe require time" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                                </td>
                                <td class="hotel_room_rate">
                                    <button type="button" class="btn btn-danger btn_remove" disabled>X</button>
                                </td>
                            </tr>
                            <?php } ?>
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
  

