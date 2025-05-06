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
            <?php $this->load->view('admin/layout/admin_alert'); ?>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo $page_title; ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <form method="post" enctype="multipart/form-data" id="add_citywise_place_master">
                <div class="card-body">
                  
                  <div class="row"> 

                  <div class="col-md-3">
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Select District</label>
                        <select class="select_css" name="select_district" id="select_district" required="required">
                        <option value="">Select District</option>
                              <?php
                                foreach($district_table as $district_table_info) 
                                { 
                              ?>
                          <option value="<?php echo $district_table_info['id'];?>"><?php echo $district_table_info['district'];?></option>
                              <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Select City</label>
                        <select class="select_css" name="select_city" id="select_city" required="required">
                        <option value="">Select City</option>
                        </select>
                      </div>
                    </div>
                    
                    <div class="col-md-3">
                    </div>

                  </div>

                  <hr>

                  <h3 class="text-center">Room Rate's</h3>

                    <table class="table table-bordered" id="hotel_room_table">
                        <colgroup>
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 20%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="hotel_room_rate">Select Type</th>
                                <th class="hotel_room_rate">Room Type</th>
                                <th class="hotel_room_rate">Room Rate</th>
                                <th class="hotel_room_rate">Total Person</th>
                                <th class="hotel_room_rate">Extra Bed Charges</th>
                                <th class="hotel_room_rate">Action</th>
                            </tr>
                        </thead>
                        <tbody id="hotel_room_body">
                            <tr>
                                <td class="hotel_room_rate">
                                    <select class="form-control" style="width: 100%;" name="select_type[]" id="select_type" required="required">
                                    <option value="">Select type</option>
                                          <?php
                                            foreach($hotel_type as $hotel_type_info) 
                                            { 
                                          ?>
                                            <option value="<?php echo $hotel_type_info['id'];?>"><?php echo $hotel_type_info['hotel_type_name'];?></option>
                                          <?php } ?>
                                    </select>
                                </td>
                                <td class="hotel_room_rate">
                                    <select class="form-control" style="width: 100%;" name="room_select[]" id="room_select" required="required">
                                        <option value="">Select Room Type</option>
                                          <?php
                                            foreach($room_type as $room_type_info) 
                                            { 
                                          ?>
                                            <option value="<?php echo $room_type_info['id'];?>"><?php echo $room_type_info['room_name'];?></option>
                                          <?php } ?>
                                    </select>
                                </td>
                                <td class="hotel_room_rate">
                                    <input type="text" class="form-control" name="room_rate[]" id="room_rate" placeholder="Enter room rate" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                                </td>
                                <td class="hotel_room_rate">
                                    <input type="text" class="form-control" name="room_total_person[]" id="room_total_person" placeholder="Enter total person" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                                </td>
                                <td class="hotel_room_rate">
                                    <input type="text" class="form-control" name="extra_bed_charges[]" id="extra_bed_charges" placeholder="Enter extra Bed Charges" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                                </td>
                                <td class="hotel_room_rate">
                                    <button type="button" class="btn btn-danger btn_remove" disabled>X</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row mt-4">
                        <div class="col-md-3">
                            <button type="button" class="btn btn-success" name="add_more_room_details" id="add_more_room_details">Add More Room</button>
                        </div>
                    </div>

                  <hr>

                  <div class="container" style="border: 1px solid #959595;padding: 1rem;">
                    <div class="row" id="add_more_sector_row">

                      <div class="col-md-10">
                        <div class="row" style="border: 1px solid #e7b9b9;padding: 1rem;" id="add_more_internal_sector_rows">

                          <div class="col-md-4">
                            <label>Select Sector</label>
                            <select class="form-control" style="width: 100%;" name="select_type_sector[]" id="select_type_sector" required="required">
                              <option value="">Select type</option>
                                <?php
                                  foreach($sector as $sector_info) 
                                  { 
                                ?>
                                  <option value="<?php echo $sector_info['id'];?>"><?php echo $sector_info['sector'];?></option>
                                <?php } ?>
                            </select>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Enter Organization Name</label>
                              <input type="text" class="form-control" name="organization[]" id="organization" placeholder="Organization Name" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');" required="required">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Select Designation</label>
                              <select class="form-control" style="width: 100%;" name="select_designation[]" id="select_designation" required="required">
                                <option value="">Select Designation</option>
                                  <?php
                                    foreach($hotel_type as $hotel_type_info) 
                                    { 
                                  ?>
                                    <option value="<?php echo $hotel_type_info['id'];?>"><?php echo $hotel_type_info['hotel_type_name'];?></option>
                                  <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Enter Person Name</label>
                              <input type="text" class="form-control" name="person_name[]" id="person_name" placeholder="Person Name" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');" required="required">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Enter Contact Number</label>
                              <input type="text" class="form-control" name="mobile_number[]" id="mobile_number" placeholder="Mobile Number" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Enter Email</label>
                              <input type="email" class="form-control" name="email[]" id="email" placeholder="Email-id" required="required">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Enter Address</label>
                              <textarea class="form-control" name="address" id="address" placeholder="Address" required="required"></textarea>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Enter Website URL</label>
                              <input type="text" class="form-control" name="website_url[]" id="website_url" placeholder="Website URL" required="required">
                            </div>
                          </div>
                       
                        </div>
                      </div>
                      <div class="col-md-2">
                        <button type="button" class="btn btn-success" name="add_more_sector" id="add_more_sector">Add More Sector</button>
                      </div>
                    </div>
                  </div>


                  <hr>

                  <div class="row" id="main_row"> 
                    <div class="row mb-4 add_row" style="border: 1px solid #959595;padding: 1rem;">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Visiting Place Name</label>
                        <input type="text" class="form-control" name="Place_name[]" id="Place_name" placeholder="Enter Name" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');" required="required">
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Opening Time</label>
                        <input type="time" class="form-control" name="opening_time[]" id="opening_time" placeholder="Enter opening time" required="required">
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Closing Time</label>
                        <input type="time" class="form-control" name="closing_time[]" id="closing_time" placeholder="Enter closing time" required="required">
                      </div>
                    </div>
                      
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Open Days</label>
                        <select class="select2" multiple="multiple" data-placeholder="Select Days" style="width: 100%;" name="open_days1[]" id="open_days1" required="required">
                            <option value="">Select </option>
                            <option value="1">Sunday</option>
                            <option value="2">Monday</option>
                            <option value="3">Tuesday</option>
                            <option value="4">Wednesday</option>
                            <option value="5">Thursday</option>
                            <option value="6">Friday</option>
                            <option value="7">Saturday</option>
                            <option value="8">All</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Required Time will it take to see this place</label>
                        <input type="text" class="form-control" name="req_time[]" id="req_time" placeholder="Enter time" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
                        <span class="text-danger">Only Enter in Minutes</span><br>
                      </div>
                    </div>

                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Allowed Vehicle Types</label>
                        <select class="select3" multiple="multiple" data-placeholder="Select Vehicle Types" style="width: 100%;" name="allow_vehicle_types1[]" id="allow_vehicle_types1" required="required">
                            <option value="">Select types</option>
                            <?php
                              foreach($vehicle_type as $vehicle_type_info) 
                              { 
                            ?>
                              <option class="xyz" value="<?php echo $vehicle_type_info['id']; ?>"><?php echo $vehicle_type_info['vehicle_type_name']; ?></option>
                              <?php } ?>
                              <option value="8">All</option>
                          </select>
                      </div>
                    </div>
                    
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Nearest Railway Station Name</label>
                        <select class="select_css" name="railway_station_name[]" id="railway_station_name" required="required">
                        <option value="">Select Railway Station Name</option>
                              <?php
                                foreach($city_table as $city_table_info) 
                                { 
                              ?>
                          <option value="<?php echo $city_table_info['id'];?>"><?php echo $city_table_info['city_name'];?></option>
                              <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Nearest Airport Name</label>
                        <select class="select_css" name="airport_name[]" id="airport_name" required="required">
                        <option value="">Select Airport Name</option>
                              <?php
                                foreach($city_table as $city_table_info) 
                                { 
                              ?>
                          <option value="<?php echo $city_table_info['id'];?>"><?php echo $city_table_info['city_name'];?></option>
                              <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Upload Image</label><br>
                        <input type="file" name="image_name1" id="image_name" required="required">
                        <br><span class="text-danger">Please select only JPG,PNG,JPEG format files.</span>
                      </div>
                    </div>

                    <div class="container">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Place Description</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                              <textarea class="form-control" name="place_description_english[]" id="place_description_english" placeholder="Enter Description in English"></textarea>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <textarea class="form-control" name="place_description_marathi[]" id="place_description_marathi" placeholder="Enter Description in Marathi"></textarea>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <textarea class="form-control" name="place_description_hindi[]" id="place_description_hindi" placeholder="Enter Description in Hindi"></textarea>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>YouTube Link</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="text" class="form-control" name="youtube_link[]" id="youtube_link" placeholder="Enter YouTube Link">
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Google Map Link</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input type="text" class="form-control" name="google_map_link[]" id="google_map_link" placeholder="Enter Google Map Link">
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="container" style="border: 1px solid #e7b9b9;padding: 1rem;">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-3 mb-4">
                              <label>Is Use In Tour Creation</label>
                            </div>
                            <div class="col-md-2 mb-4">
                              <input type="radio" id="in_tour_creation_yes_1" name="in_tour_creation_no_one1" value="Yes" > &nbsp;
                              <label>Yes</label>  &nbsp; &nbsp; 
                              <input type="radio" id="in_tour_creation_yes_1" name="in_tour_creation_no_one1" value="No" > &nbsp;
                              <label>No</label><br>
                            </div>
                            <div class="col-md-2 mb-4">
                              <label>Is Entery Ticket</label>
                            </div>
                            <div class="col-md-2 mb-4">
                              <input type="radio" id="Yes" name="ticket_yes_no1" value="Yes" class="ticket_cls" onclick="toggleInput('ticket_yes_no1', 'ticket_cost')"> &nbsp;
                              <label>Yes</label>  &nbsp; &nbsp; 
                              <input type="radio" id="No" name="ticket_yes_no1" value="No" class="ticket_cls" onclick="toggleInput('ticket_yes_no1', 'ticket_cost')"> &nbsp;
                              <label>No</label><br>
                            </div>
                            <div class="col-md-3 mb-4">
                              <input type="text" class="form-control" name="ticket_cost[]" id="ticket_cost" placeholder="Enter Ticket Cost" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>

                            <div class="col-md-3 mb-4">
                              <label>Is Use In Tour Creation</label>
                            </div>
                            <div class="col-md-2 mb-4">
                              <input type="radio" id="in_tour_creation_yes_1" name="in_tour_creation_no_two1" value="Yes" > &nbsp;
                              <label>Yes</label>  &nbsp; &nbsp; 
                              <input type="radio" id="in_tour_creation_no_1" name="in_tour_creation_no_two1" value="No" > &nbsp;
                              <label>No</label><br>
                            </div>
                            <div class="col-md-2 mb-4">
                              <label>Is It Municipal Tax</label>
                            </div>
                            <div class="col-md-2 mb-4">
                              <input type="radio" id="Manicipal_Yes" name="municipal_tax_yes_no1" value="Yes" class="municipal_cls" onclick="toggleInput('municipal_tax_yes_no1', 'municipal_amt')"> &nbsp;
                              <label>Yes</label>  &nbsp; &nbsp; 
                              <input type="radio" id="Manicipal_No" name="municipal_tax_yes_no1" value="No" class="municipal_cls" onclick="toggleInput('municipal_tax_yes_no1', 'municipal_amt')"> &nbsp;
                              <label>No</label><br>
                            </div>
                            <div class="col-md-3 mb-4">
                            <input type="text" class="form-control if_municipal_yes_no" name="municipal_amt[]" id="municipal_amt" placeholder="Enter Municipal Tax Amount" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required" />
                            </div>

                            <div class="col-md-3 mb-4">
                              <label>Is Use In Tour Creation</label>
                            </div>
                            <div class="col-md-2 mb-4">
                              <input type="radio" id="in_tour_creation_yes_2" name="in_tour_creation_no_three1" value="Yes" > &nbsp;
                              <label>Yes</label>  &nbsp; &nbsp; 
                              <input type="radio" id="in_tour_creation_no_2" name="in_tour_creation_no_three1" value="No" > &nbsp;
                              <label>No</label><br>
                            </div>
                            <div class="col-md-2 mb-4">
                              <label>Is It Parking Cost</label>
                            </div>
                            <div class="col-md-2 mb-4">
                              <input type="radio" id="parking_cost_Yes" name="parking_cost_yes_no1" value="Yes" class="parking_cls" onclick="toggleInput('parking_cost_yes_no1', 'parking_cost')"> &nbsp;
                              <label>Yes</label>  &nbsp; &nbsp; 
                              <input type="radio" id="parking_cost_No" name="parking_cost_yes_no1" value="No" class="parking_cls" onclick="toggleInput('parking_cost_yes_no1', 'parking_cost')"> &nbsp;
                              <label>No</label><br>
                            </div>
                            <div class="col-md-3 mb-4">
                              <input type="text" class="form-control if_packing_yes_no" name="parking_cost[]" id="parking_cost" placeholder="Enter Parking Cost" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required" />
                            </div>

                            <div class="col-md-3 mb-4">
                              <label>Is Use In Tour Creation</label>
                            </div>
                            <div class="col-md-2 mb-4">
                              <input type="radio" id="in_tour_creation_yes_3" name="in_tour_creation_no_four1" value="Yes" > &nbsp;
                              <label>Yes</label>  &nbsp; &nbsp; 
                              <input type="radio" id="in_tour_creation_no_3" name="in_tour_creation_no_four1" value="No" > &nbsp;
                              <label>No</label><br>
                            </div>
                            <div class="col-md-2 mb-4">
                              <label>Is It Darshan Pass Cost</label>
                            </div>
                            <div class="col-md-2 mb-4">
                              <input type="radio" id="darshan_pass_cost_Yes" name="darshan_pass_cost_yes_no1" value="Yes" onclick="toggleInput('darshan_pass_cost_yes_no1', 'darshan_pass_cost')"> &nbsp;
                              <label>Yes</label>  &nbsp; &nbsp; 
                              <input type="radio" id="darshan_pass_cost_No" name="darshan_pass_cost_yes_no1" value="No" onclick="toggleInput('darshan_pass_cost_yes_no1', 'darshan_pass_cost')"> &nbsp;
                              <label>No</label><br>
                            </div>
                            <div class="col-md-3 mb-4">
                              <input type="text" class="form-control if_darshan_pass_yes_no" name="darshan_pass_cost[]" id="darshan_pass_cost" placeholder="Enter Darshan Pass Cost" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required" />
                            </div>
                            <div class="col-md-3 mb-4">
                              <label>Ticket Booking Link</label>
                            </div>
                            <div class="col-md-4 mb-4">
                              <input type="text" class="form-control" name="ticket_booking_link[]" id="ticket_booking_link" placeholder="Enter Ticket Booking Link">
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="container mt-4" style="border: 1px solid #e7b9b9;padding: 1rem;">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-3 mb-4">
                              
                            </div>
                            <div class="col-md-3 mb-4">
                              <label>Is Use In Tour Creation</label>
                            </div>
                            <div class="col-md-3 mb-4">
                              <input type="radio" id="in_tour_creation_yes_4" name="in_tour_creation_no5" value="Yes" > &nbsp;
                              <label>Yes</label>  &nbsp; &nbsp; 
                              <input type="radio" id="in_tour_creation_no_4" name="in_tour_creation_no5" value="No" > &nbsp;
                              <label>No</label><br>
                            </div>
                            <div class="col-md-3 mb-4">
                              
                            </div>

                            <div class="col-md-4 mb-4">
                              
                            </div>
                            <div class="col-md-4 mb-4">
                              <h5><b>Other Vehicle Details</b></h5>
                            </div>
                            <div class="col-md-4 mb-4">
                              
                            </div>

                            <div class="container" >
                              <div class="row" style="margin-left: 5%;" id="other_vehicle_details">
                                <div class="col-md-2 mb-4">
                                  
                                </div>
                                <div class="col-md-3 mb-4">
                                  <select class="select_css" name="other_vehicle[]" id="other_vehicle" required="required">
                                  <option value="">Select Vehicle Types</option>
                                    <?php
                                      foreach($vehicle_type as $vehicle_type_info) 
                                      { 
                                    ?>
                                      <option value="<?php echo $vehicle_type_info['id']; ?>"><?php echo $vehicle_type_info['vehicle_type_name']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                                <div class="col-md-2 mb-4">
                                  <input type="text" class="form-control" name="max_amt[]" id="max_amt" placeholder="Enter Max Amount" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required" />
                                </div>
                                <div class="col-md-2 mb-4">
                                  <button type="button" class="btn btn-success" name="add_more_vehicle_details" id="add_more_vehicle_details">Add More Vehicle</button>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>

                    
                    <!-- <button type="button" class="btn btn-success" name="save_particular" value="save_particular" id="save_particular">Save</button> -->
                    </div>
                  </div>

                  <table id="example1" class="table table-bordered table-striped">
                    <tr>
                      <th>Master's Name</th>
                      <th>Description</th>
                      <th>Action</th>
                    </tr>
                    <tr>
                      <td>District Master</td>
                      <td>"District Master: Navigate here to include new districts above the 'Select District' option."</td>
                      <td>
                      <a href="<?php echo base_url(); ?>admin/district/index"><button type="button" class="btn btn-success" >Add</button></a>
                      </td>
                    </tr>
                    <tr>
                      <td>City Master</td>
                      <td>"City Master: Navigate here to include new citys above the 'Select City' option."</td>
                      <td>
                      <a href="<?php echo base_url(); ?>admin/city_master/index"><button type="button" class="btn btn-success" >Add</button></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Hotel Type Master</td>
                      <td>"Hotel Type Master: Navigate here to include new hotel type master above the 'Select Type' option."</td>
                      <td>
                      <a href="<?php echo base_url(); ?>admin/hotel_type/index" ><button type="button" class="btn btn-success" >Add</button></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Room Master</td>
                      <td>"Room Master: Navigate here to include room citys above the 'Room Type' option."</td>
                      <td>
                      <a href="<?php echo base_url(); ?>admin/room_type/index" ><button type="button" class="btn btn-success" >Add</button></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Vehicle Types</td>
                      <td>"Vehicle Types Master: Navigate here to include vehicle types citys above the 'Allowed Vehicle Types' option."</td>
                      <td>
                      <a href="<?php echo base_url(); ?>admin/vehicle_type/index" ><button type="button" class="btn btn-success" >Add</button></a>
                      </td>
                    </tr>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" class="btn btn-success" name="add_more" value="add_more_place" id="add_more_place">Add More Place</button>
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
  

