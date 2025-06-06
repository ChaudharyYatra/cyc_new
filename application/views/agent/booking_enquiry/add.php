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
            <?php $this->load->view('agent/layout/agent_alert'); ?>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo $page_title; ?></h3>
              </div>
              <!-- /.card-header -->

            <?php if(empty($agent_booking_enquiry_data)){ ?>
              <!-- form start -->
              <form method="post" enctype="multipart/form-data" id="add_bookingenquiry">
                <div class="card-body">
                  <div class="row">
					            <div class="col-md-6">
                        <div class="form-group">
                          <label>Title</label><br>
                          <select class="select_css" name="mrandmrs" id="mrandmrs">
                            <option value="">select Title</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>First name</label>
                          <input type="text" class="form-control" style="text-transform: capitalize;" name="first_name" id="first_name" value="<?php if(!empty($visitor_data)){ echo $visitor_data['first_name'];} ?>" placeholder="Enter First Name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Last name</label>
                          <input type="text" class="form-control" style="text-transform: capitalize;" name="last_name" id="last_name" value="<?php if(!empty($visitor_data)){ echo $visitor_data['last_name'];} ?>" placeholder="Enter Last Name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                      </div>
                      <div class="col-md-6">
                              <div class="form-group">
                                <label>Mobile number</label>
                                <input type="text" class="form-control" name="mobile_number" id="mobile_number" value="<?php if(!empty($visitor_data)){ echo $visitor_data['mobile_number'];} ?>" placeholder="Enter Mobile Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10" minlength="10">
                              </div>
                      </div>
					            <div class="col-md-6">
                              <div class="form-group">
                                <label>Whatsapp Mobile number</label>
                                <input type="text" class="form-control" name="wp_mobile_number" id="wp_mobile_number" placeholder="Enter Whatsapp Mobile Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10" minlength="10">
                              </div>
                      </div>
                      <div class="col-md-6">
                              <div class="form-group">
                                <label>Email address</label>
                                <input type="email" class="form-control" name="email_address" id="email_address" value="<?php if(!empty($visitor_data)){ echo $visitor_data['email'];} ?>" placeholder="Enter Email Address" pattern="^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$">
                              </div>
                      </div>
                      <div class="col-md-6">
                              <div class="form-group">
                                <label>Gender </label> <br>
                                &nbsp;&nbsp;<input type="radio" name="gender" id="male" value="Male">&nbsp;&nbsp;Male
                                &nbsp;&nbsp;<input type="radio" name="gender" id="female" value="Female">&nbsp;&nbsp;Female <br>
                              </div>
                      </div>
                      <!-- <div class="col-md-6">
                              <div class="form-group">
                                <label>Tour number</label>
                                <input type="text" class="form-control" name="tour_number" id="tour_number" placeholder="Enter Tour Number">
                              </div>
                      </div> -->
					 
					                  <div class="col-md-6">
                              <div class="form-group">
                                <label>Media source</label>
                                  <select class="select_css" name="media_source_name" id="media_source_name" >
                                      <option value="">Select media source</option>
                                      <?php
                                        foreach($media_source_data as $media_source_info){ 
                                      ?>
                                        <option value="<?php echo $media_source_info['id']; ?>"><?php echo $media_source_info['media_source_name']; ?></option>
                                      <?php } ?>
                                  </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tour Number-Name</label>
                                    <select class="select2" multiple="multiple" data-placeholder="Select tour" style="width: 100%;" name="tour_number[]" id="tour_number">
                                        <option value="">Select Tour</option>
                                        <?php foreach($packages_data as $packages_data_value) { ?>
                                            <option value="<?php echo $packages_data_value['id'];?>"><?php echo $packages_data_value['tour_number'];?> -  <?php echo $packages_data_value['tour_title'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
					 
                            <div class="col-md-6" id="other_tour_name_div" style='display:none;'>
                                    <div class="form-group">
                                      <label>Enquiry destination name</label>
                                      <input type="text" class="form-control" name="other_tour_name" id="other_tour_name" placeholder="Enter destination name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Enter Seat Count</label>
                                <input type="text" class="form-control" name="enq_seat_count" id="enq_seat_count" value="<?php if(!empty($visitor_data)){ echo $visitor_data['total_seat'];} ?>" placeholder="Enter seat count" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                              </div>
                            </div>
                            <!-- <div class="col-md-6 mb-2">
                              <label class="col-form-label">Followup Date:</label> 
                              <input type="date" class="form-control" name="followup_date" id="followup_date" min="<?php //echo date("Y-m-d"); ?>" >
                            </div> -->
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Occupation Name</label>
                                  <select class="select_css" name="occupation_name" id="occupation_name">
                                      <option value="">Select occupation name</option>
                                      <?php
                                        foreach($occupation_master_data as $occupation_master_info){ 
                                      ?>
                                        <option value="<?php echo $occupation_master_info['id']; ?>"> <?php echo $occupation_master_info['occupation_name']; ?></option>
                                      <?php } ?>
                                  </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Zone Name</label>
                                  <select class="select_css" name="zone_name" id="zone_name">
                                      <option value="">Select zone name</option>
                                      <?php
                                        foreach($zone_master_data as $zone_master_info){ 
                                      ?>
                                        <option value="<?php echo $zone_master_info['id']; ?>"> <?php echo $zone_master_info['zone_name']; ?></option>
                                      <?php } ?>
                                  </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                            <label>Customer Address -</label>
                              <div class="form-group">
                                <label>Flat No./ Banglow No.</label>
                                <input type="text" class="form-control" name="flat_no" id="flat_no" placeholder="Enter Flat No">
                              </div>
                            </div>

                            <div class="col-md-6 mt-2">
                            <label></label>
                              <div class="form-group">
                                <label>Building / House Name</label>
                                <input type="text" class="form-control" name="house_name" id="house_name" placeholder="Enter house name">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Street Name</label>
                                <input type="text" class="form-control" name="street_name" id="street_name" placeholder="Enter street name">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Landmark</label>
                                <input type="text" class="form-control" name="landmark" id="landmark" placeholder="Enter landmark name">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Area</label>
                                <input type="text" class="form-control" name="area" id="area" placeholder="Enter area name">
                              </div>
                            </div>
                      
              </div>
                <!-- /.card-body -->
                
                <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-striped">
                            <tr>
                                <th>Master's Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>Tour Number-Name</td>
                                
                                <td>"Tour Number - Name: Navigate here to include new tour above the 'Tour Number - Name' option."</td>
                                <td>
                                Contact to admin
                                </td>
                            </tr>
                            <tr>
                                <td>Media source</td>
                                
                                <td>"To add new media sources, navigate to the "Media Source Master" under the "Admin Booking Masters" section."</td>
                                <td>
                                Contact to admin
                                </td>
                            </tr>
                        </table>
                    </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-success" name="booknow_submit" value="Submit & Seat Checker">Submit & Seat Checker</button>
                  <button type="submit" class="btn btn-primary" name="submit" value="submit">Save & Close</button>
                   
                  <a href="<?php echo $module_url_path; ?>/index"><button type="button" class="btn btn-danger" >Cancel</button></a>
                </div>
              </form>

              <?php }else if(!empty($agent_booking_enquiry_data)){ ?>


                <!-- form start -->
              <form method="post" enctype="multipart/form-data" id="add_bookingenquiry">
                <div class="card-body">
                  <div class="row">
					            <div class="col-md-6">
                        <div class="form-group">
                          <label>Title</label><br>
                          <select class="select_css" name="mrandmrs" id="mrandmrs">
                            <option value="">select Title</option>
                            <option value="Mr" <?php if(!empty($agent_booking_enquiry_data)){  if($agent_booking_enquiry_data['MrandMrs']=='Mr'){echo 'selected';}} ?>>Mr</option>
                            <option value="Mrs" <?php if(!empty($agent_booking_enquiry_data)){  if($agent_booking_enquiry_data['MrandMrs']=='Mrs'){echo 'selected';}} ?>>Mrs</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>First name</label>
                          <input type="text" class="form-control" name="first_name" id="first_name" value="<?php if(!empty($agent_booking_enquiry_data)){ echo $agent_booking_enquiry_data['first_name'];} ?>" placeholder="Enter First Name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Last name</label>
                          <input type="text" class="form-control" name="last_name" id="last_name" value="<?php if(!empty($agent_booking_enquiry_data)){ echo $agent_booking_enquiry_data['last_name'];} ?>" placeholder="Enter Last Name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                      </div>
                      <div class="col-md-6">
                              <div class="form-group">
                                <label>Mobile number</label>
                                <input type="text" class="form-control" name="mobile_number" id="mobile_number" value="<?php if(!empty($agent_booking_enquiry_data)){ echo $agent_booking_enquiry_data['mobile_number'];} ?>" placeholder="Enter Mobile Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                              </div>
                      </div>
					            <div class="col-md-6">
                              <div class="form-group">
                                <label>Whatsapp Mobile number</label>
                                <input type="text" class="form-control" name="wp_mobile_number" id="wp_mobile_number" value="<?php if(!empty($agent_booking_enquiry_data)){ echo $agent_booking_enquiry_data['wp_mobile_number'];} ?>" placeholder="Enter Whatsapp Mobile Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                              </div>
                      </div>
                      <div class="col-md-6">
                              <div class="form-group">
                                <label>Email address</label>
                                <input type="email" class="form-control" name="email_address" id="email_address" value="<?php if(!empty($agent_booking_enquiry_data)){ echo $agent_booking_enquiry_data['email'];} ?>" placeholder="Enter Email Address" pattern="^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$">
                              </div>
                      </div>
                      <div class="col-md-6">
                              <div class="form-group">
                                <label>Gender </label> <br>
                                &nbsp;&nbsp;<input type="radio" name="gender" id="gender" <?php if(!empty($agent_booking_enquiry_data)){  if($agent_booking_enquiry_data['gender']=='Male'){echo 'checked';}} ?> value="Male">&nbsp;&nbsp;Male
                                &nbsp;&nbsp;<input type="radio" name="gender" id="gender" <?php if(!empty($agent_booking_enquiry_data)){  if($agent_booking_enquiry_data['gender']=='Female'){echo 'checked';}} ?> value="Female">&nbsp;&nbsp;Female <br>
                              </div>
                      </div>
                      <!-- <div class="col-md-6">
                              <div class="form-group">
                                <label>Tour number</label>
                                <input type="text" class="form-control" name="tour_number" id="tour_number" placeholder="Enter Tour Number">
                              </div>
                      </div> -->
					 
					                  <div class="col-md-6">
                              <div class="form-group">
                                <label>Media source</label>
                                  <select class="select_css" name="media_source_name" id="media_source_name">
                                      <option value="">Select media source</option>
                                      <?php
                                        foreach($media_source_data as $media_source_info){ 
                                      ?>
                                        <option value="<?php echo $media_source_info['id']; ?>" <?php if(!empty($agent_booking_enquiry_data)){  if($agent_booking_enquiry_data['media_source_name']== $media_source_info['id']){echo 'selected';}} ?>>
                                        <?php echo $media_source_info['media_source_name']; ?></option>
                                      <?php } ?>
                                  </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Tour Number-Name</label>
                                <select class="select2" multiple="multiple" data-placeholder="Select tour" style="width: 100%;" name="tour_number[]" id="tour_number" required="required">
                                    <option value="">Select Tour</option>
                                    <?php
                                      foreach($packages_data as $packages_data_value) 
                                      { 
                                        $title = $temparray=explode(',',$agent_booking_enquiry_data['package_id']);
                                        $c=count($title);
                                    ?>
                                      <option value="<?php echo $packages_data_value['id'];?>" <?php if(in_array($packages_data_value['id'], $title)){echo 'selected';} ?>>
                                      <?php echo $packages_data_value['tour_number'];?> -  <?php echo $packages_data_value['tour_title'];?></option>
                                  <?php } ?>
                                  </select>
                              </div>
                            </div>
					 
                            <div class="col-md-6" id="other_tour_name_div" style='display:none;'>
                              <div class="form-group">
                                <label>Enquiry destination name</label>
                                <input type="text" class="form-control" name="other_tour_name" value="<?php if(!empty($agent_booking_enquiry_data)){ echo $agent_booking_enquiry_data['other_tour_name'];} ?>" id="other_tour_name" placeholder="Enter destination name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Enter Seat Count</label>
                                <input type="text" class="form-control" name="enq_seat_count" value="<?php if(!empty($agent_booking_enquiry_data)){ echo $agent_booking_enquiry_data['seat_count'];} ?>" id="enq_seat_count" placeholder="Enter seat count" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Occupation Name</label>
                                  <select class="select_css" name="occupation_name" id="occupation_name">
                                      <option value="">Select occupation name</option>
                                      <?php
                                        foreach($occupation_master_data as $occupation_master_info){ 
                                      ?>
                                        <option value="<?php echo $occupation_master_info['id']; ?>" <?php if(!empty($agent_booking_enquiry_data)){  if($agent_booking_enquiry_data['occupation_name']== $occupation_master_info['id']){echo 'selected';}} ?>> <?php echo $occupation_master_info['occupation_name']; ?></option>
                                      <?php } ?>
                                  </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Zone Name</label>
                                  <select class="select_css" name="zone_name" id="zone_name">
                                      <option value="">Select zone name</option>
                                      <?php
                                        foreach($zone_master_data as $zone_master_info){ 
                                      ?>
                                        <option value="<?php echo $zone_master_info['id']; ?>" <?php if(!empty($agent_booking_enquiry_data)){  if($agent_booking_enquiry_data['zone_name']== $zone_master_info['id']){echo 'selected';}} ?>> <?php echo $zone_master_info['zone_name']; ?></option>
                                      <?php } ?>
                                  </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                            <label>Customer Address -</label>
                              <div class="form-group">
                                <label>Flat No./ Banglow No.</label>
                                <input type="text" class="form-control" name="flat_no" id="flat_no" placeholder="Enter Flat No" value="<?php if(!empty($agent_booking_enquiry_data)){ echo $agent_booking_enquiry_data['flat_no'];} ?>">
                              </div>
                            </div>

                            <div class="col-md-6 mt-2">
                            <label></label>
                              <div class="form-group">
                                <label>Building / House Name</label>
                                <input type="text" class="form-control" name="house_name" id="house_name" placeholder="Enter house name" value="<?php if(!empty($agent_booking_enquiry_data)){ echo $agent_booking_enquiry_data['house_name'];} ?>">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Street Name</label>
                                <input type="text" class="form-control" name="street_name" id="street_name" placeholder="Enter street name" value="<?php if(!empty($agent_booking_enquiry_data)){ echo $agent_booking_enquiry_data['street_name'];} ?>">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Landmark</label>
                                <input type="text" class="form-control" name="landmark" id="landmark" placeholder="Enter landmark name" value="<?php if(!empty($agent_booking_enquiry_data)){ echo $agent_booking_enquiry_data['landmark'];} ?>">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Area</label>
                                <input type="text" class="form-control" name="area" id="area" placeholder="Enter area name" value="<?php if(!empty($agent_booking_enquiry_data)){ echo $agent_booking_enquiry_data['area'];} ?>">
                              </div>
                            </div>
                          </div>
                <!-- /.card-body -->
                
                
                
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-success" name="booknow_submit" value="Submit & Seat Checker">Submit & Seat Checker</button> 
                  <button type="submit" class="btn btn-primary" name="submit" value="submit">Save & Close</button>
                  
                  <a href="<?php echo $module_url_path; ?>/index"><button type="button" class="btn btn-danger" >Cancel</button></a>
                </div>
              </form>


               <?php } ?> 
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
  

</body>
</html>
