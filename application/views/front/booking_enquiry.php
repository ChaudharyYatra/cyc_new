    
    <style>
        /* .btn-process{
  font-size: 2rem;
  font-family: 'Montserrat', sans-serif;
  background-color: #256EFF;
  box-shadow:0px 15px 27px 2px rgba(37,110,255,0.28);
  border:none;
  outline:none;
  display: flex;
  align-items:center;
  justify-content: center;
  gap: 0.5rem;
  padding: 1rem 3rem;
  border-radius:1rem;
  color:#fff;
  cursor:pointer;
} */
.btn-ring{
  display: none;
}
.btn-ring:after {
  content: "";
  display: block;
  width: 25px;
  height: 25px;
  margin: 8px;
  border-radius: 50%;
  border: 3px solid #fff;
  border-color: #fff transparent #fff transparent;
  animation: ring 1.2s linear infinite;
}
@keyframes ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
    </style>
    
    <!-- BreadCrumb Starts -->  
    <section class="breadcrumb-main pb-20 pt-14" style="background-image: url(<?php echo base_url(); ?>uploads/do_not_delete/Booking.png);">
        <div class="section-shape section-shape1 top-inherit bottom-0" style="background-image: url(images/shape8.png);"></div>
        <div class="breadcrumb-outer">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <h1 class="mb-3"><?php echo $page_title; ?></h1>
                    <nav aria-label="breadcrumb" class="d-block">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>home">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="dot-overlay"></div>
    </section>
    <!-- BreadCrumb Ends --> 

    <!-- top Destination starts -->
    <section class="trending pt-6 pb-0 bg-lgrey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-6">
                    <div class="payment-book">
                        <div class="booking-box">
                            <div class="customer-information mb-4">
                                <form class="mb-2" method="post" onsubmit="return validateEnquiryForms()">
                                    <h5>Fill your information</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <input type="text" placeholder="First Name" name="first_name" id="first_name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                                <span class="text-danger float-left" id="first_name_error" style="display:none"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <input type="text" placeholder="Last Name" name="last_name" id="last_name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                                <span class="text-danger float-left" id="last_name_error" style="display:none"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <input type="text" placeholder="Email Address" name="email" id="email">
                                                <span class="text-danger float-left" id="email_error" style="display:none"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <input type="text" placeholder="Mobile Number" name="mobile_number" id="mobile_number" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9 ]/g, '').replace(/(\..*)\./g, '$1');">
                                                <span class="text-danger float-left" id="mobile_number_error" style="display:none"></span>
                                            </div>
                                        </div>
										<div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <input type="text" placeholder="WhatsApp Mobile Number" name="wp_mobile_number" id="wp_mobile_number" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9 ]/g, '').replace(/(\..*)\./g, '$1');">
                                                <span class="text-danger float-left" id="wp_mobile_number_error" style="display:none"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group mb-2">
                                                <div class="input-box">
                                                    <select class="niceSelect" name="gender" id="gender">
                                                        <option value="">Select Gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </div>
                                                <span class="text-danger float-left" id="gender_error" style="display:none"></span>

                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group mb-2">
                                                <div class="input-box">
                                                    <select class="niceSelect" name="media_source_name" id="media_source_name">
                                                        <option value="">Media Source</option>
                                                        <?php foreach($media_source as $media_source_info){ ?> 
                                                            <option value="<?php echo $media_source_info['id'];?>"><?php echo $media_source_info['media_source_name'];?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <span class="text-danger float-left" id="media_source_name_error" style="display:none"></span>
                                            </div>
                                        </div>
                                      <div class="col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <div class="input-box">
                                                    <select class="niceSelect" name="department_id" id="department_id">
                                                        <option value="">Select Region</option>
                                                        <?php foreach($department_data as $department){ ?> 
                                                            <option value="<?php echo $department['id'];?>"><?php echo $department['department'];?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <span class="text-danger float-left" id="department_id_error" style="display:none"></span>

                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <div class="input-box">
                                                    <select class="niceSelect" name="agent_id" id="agent_id">
                                                        <option value="">Select Booking Centre</option>
                                                    </select>
                                                </div>
                                                <span class="text-danger float-left" id="agent_id_error" style="display:none"></span>
                                            </div>
                                        </div> 
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="niceSelect" name="occupation_name" id="occupation_name">
                                                    <option value="">Select occupation name</option>
                                                    <?php
                                                        foreach($occupation_master_data as $occupation_master_info){ 
                                                    ?>
                                                        <option value="<?php echo $occupation_master_info['id']; ?>" <?php if(!empty($agent_booking_enquiry_data)){  if($agent_booking_enquiry_data['occupation_name']== $occupation_master_info['id']){echo 'selected';}} ?>> <?php echo $occupation_master_info['occupation_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <span class="text-danger float-left" id="occupation_id_error" style="display:none"></span>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="niceSelect" name="zone_name" id="zone_name">
                                                    <option value="">Select zone name</option>
                                                    <?php
                                                        foreach($zone_master_data as $zone_master_info){ 
                                                    ?>
                                                        <option value="<?php echo $zone_master_info['id']; ?>" <?php if(!empty($agent_booking_enquiry_data)){  if($agent_booking_enquiry_data['zone_name']== $zone_master_info['id']){echo 'selected';}} ?>> <?php echo $zone_master_info['zone_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <span class="text-danger float-left" id="zone_id_error" style="display:none"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="flat_no" id="flat_no" placeholder="Enter Flat No" value="<?php if(!empty($agent_booking_enquiry_data)){ echo $agent_booking_enquiry_data['flat_no'];} ?>">
                                            </div>
                                            <span class="text-danger float-left" id="flatno_id_error" style="display:none"></span>
                                        </div>

                                        <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="house_name" id="house_name" placeholder="Enter house name" value="<?php if(!empty($agent_booking_enquiry_data)){ echo $agent_booking_enquiry_data['house_name'];} ?>">
                                        </div>
                                        <span class="text-danger float-left" id="housename_id_error" style="display:none"></span>
                                        </div>

                                        <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="street_name" id="street_name" placeholder="Enter street name" value="<?php if(!empty($agent_booking_enquiry_data)){ echo $agent_booking_enquiry_data['street_name'];} ?>">
                                        </div>
                                        <span class="text-danger float-left" id="streetname_id_error" style="display:none"></span>
                                        </div>

                                        <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="landmark" id="landmark" placeholder="Enter landmark name" value="<?php if(!empty($agent_booking_enquiry_data)){ echo $agent_booking_enquiry_data['landmark'];} ?>">
                                        </div>
                                        <span class="text-danger float-left" id="landmark_id_error" style="display:none"></span>
                                        </div>

                                        <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="area" id="area" placeholder="Enter area name" value="<?php if(!empty($agent_booking_enquiry_data)){ echo $agent_booking_enquiry_data['area'];} ?>">
                                        </div>
                                        <span class="text-danger float-left" id="area_id_error" style="display:none"></span>
                                        </div>
                                    </div>
                                
                           
                                    <div class="booking-terms border-t pt-3 mt-3">
                                    <!-- <form class="d-lg-flex align-items-center"> -->
                                        <div class="form-group mb-2 w-75">
                                            <!--<input type="checkbox"> By continuing, you agree to the <a href="#">Terms and Conditions.</a>-->
                                        </div>
                                        <!-- <a href="#" class="nir-btn float-lg-end w-25" name="submit">CONFIRM BOOKING</a> -->
                                        <!-- <input type="submit" class="nir-btn float-lg-end w-25" id="submit" value="submit" name="submit"> -->
                                      
                                            <button type="submit" class="btn-process btn nir-btn float-lg-end w-25" name="submit" value="submit" id="btn_agent">Submit  <span class="btn-ring"></span></button>
                                        
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <script>
          $('.btn-process').on('click', function() {
                $(".btn-ring").show();
                $(".btn-process").prop('disabled',true); 
                $(".btn-process").val('disabled');
                setTimeout(function() {
                $(".btn-ring").hide();
                $(".btn-process").prop('disabled',false);
            }, 3000);
            });
    </script>


    <!-- top Destination ends -->
