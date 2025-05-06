<style>
  .mealplan_css{
            border: 1px solid red !important;
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
              <a href="<?php echo $module_url_path; ?>/index"><button class="btn btn-primary">Back</button></a>
              
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
            <?php $this->load->view('tour_manager/layout/agent_alert'); ?>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo $page_title; ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
                  foreach($arr_data as $info) 
                  { 
                     ?>
              <form method="post" enctype="multipart/form-data" id="suugestion_edit">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tour Manager Name</label>
                                <input readonly type="text" class="form-control" name="tm_name" id="tm_name" placeholder="Enter Tm name" value="<?php echo $info['tour_manager_supervision_name'];?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sanction Amount from TOM</label>
                                <input readonly type="text" class="form-control" name="saction_amount_from_tom" id="saction_amount_from_tom" placeholder="Enter Tm name" value="<?php echo $info['tom_approval_amt'];?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tour Operation Manager Name</label>
                                <input readonly type="text" class="form-control" name="tom_name" id="tom_name" placeholder="Enter Tm name" value="<?php echo $info['tom_supervision_name'];?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Priority Status</label>
                              <select class="select_css" name="priority_status" id="priority_status" disabled>
                                  <option value="">Select Priority</option>
                                  <option value="High" <?php if(isset($info['priority_status'])){if("High" == $info['priority_status']) {echo 'selected';}}?>>High</option>
                                  <option value="Medium" <?php if(isset($info['priority_status'])){if("Medium" == $info['priority_status']) {echo 'selected';}}?>>Medium</option>
                                  <option value="Low" <?php if(isset($info['priority_status'])){if("Low" == $info['priority_status']) {echo 'selected';}}?>>Low</option>
                              </select>
                          </div>
                        </div>  

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Reason</label>
                                <textarea readonly type="text" class="form-control" name="reason" id="reason" placeholder="Enter reason"><?php echo $info['reason'];?></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Agent Paid Amount</label>
                                <input type="text" class="form-control" name="staff_paid_amt" id="staff_paid_amt" placeholder="Enter Agent Paid Amount" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Image</label><br>
                            <input type="file" name="image_name" id="image_name" required="required" accept="image/*">
                            <br><span class="text-danger">Please select only JPG,PNG,JPEG format files.</span><br>
                          </div>
                        </div>   

                        <!-- <div class="col-md-6">
                          <div class="form-group">
                          <label>Transaction Mode</label><br>
                          <select class="select_css" data-placeholder="Select amount receiving mode" style="width: 100%;" name="select_transaction" id="select_transaction" onchange='account_details(this.value); 
                                    this.blur();' required="required">
                                    <option value="">Select amount receiving mode</option>
                                    <?php
                                    //$title = explode(',',$agent_data['amount_receiving_mode']);
                                    // print_r($title); die;
                                    ?>
                                    <?php //if(in_array('CASH', $title)){?>
                                    <option value="CASH">CASH</option>
                                    <?php //} 
                                    //if(in_array('UPI', $title)){ ?>
                                    <option value="UPI">UPI</option>
                                    <?php //} 
                                    //if(in_array('QR Code', $title)){?>
                                    <option value="QR Code">QR Code</option>
                                    <?php //}
                                      //if(in_array('Cheque', $title)){?>
                                    <option value="Cheque">Cheque</option>
                                    <?php //} 
                                    //if(in_array('Net Banking', $title)){?>  
                                    <option value="Net Banking">Net Banking</option>
                                    <?php //} 
                                    //if(in_array('Demand Draft', $title)){?>  
                                    <option value="Demand Draft">Demand Draft</option> 
                                    <?php //} ?>   
                                </select>
                          </div>
                        </div> -->

                        <?php if(isset($booking_payment_details['select_transaction']) && $booking_payment_details['select_transaction']=='Net Banking'){?>
                                <div class="" id="net_banking_tr">
                                <div class="row cash_payment_div">
                                        <div class="col-md-6 mt-2">
                                            <h6 class="text-center">Payment Type</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                        <!-- &nbsp;&nbsp;<input type="radio" name="gender" id="male" value="Male">&nbsp;&nbsp;Male
                                        &nbsp;&nbsp;<input type="radio" name="gender" id="female" value="Female">&nbsp;&nbsp;Female -->

                                        <input type="radio" name="netbanking_payment_type" id="netbanking_payment_type_neft" onchange="netpayment_validate()" value="NEFT"  <?php if(!empty($booking_payment_details['netbanking_payment_type'])){if("NEFT" == $booking_payment_details['netbanking_payment_type']) {echo 'checked';}}?>>&nbsp;&nbsp;NEFT
                                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="netbanking_payment_type" id="netbanking_payment_type_rtgs" onchange="netpayment_validate()" value="RTGS" <?php if(!empty($booking_payment_details['netbanking_payment_type'])){if("RTGS" == $booking_payment_details['netbanking_payment_type']) {echo 'checked';}}?>>&nbsp;&nbsp;RTGS
                                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="netbanking_payment_type" id="netbanking_payment_type_imps" onchange="netpayment_validate()" value="IMPS"  <?php if(!empty($booking_payment_details['netbanking_payment_type'])){if("IMPS" == $booking_payment_details['netbanking_payment_type']) {echo 'checked';}}?>>&nbsp;&nbsp;IMPS
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <h6 class="text-center">Account Number</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="text" class="form-control" name="net_banking_acc_no" id="net_banking_acc_no" onkeyup="netbank_accno_validate()" placeholder="Enter Account No" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['net_banking_acc_no'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <h6 class="text-center">Account Holder Name</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="text" class="form-control" name="net_acc_holder_nm" id="net_acc_holder_nm" onkeyup="netbank_accno_holder_nm_validate()" placeholder="Enter Account Holder Name" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['net_banking_acc_holder_nm'];}?>" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <h6 class="text-center">Bank Name</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="text" class="form-control" name="netbanking_bank_name" id="netbanking_bank_name" onkeyup="netbank_bank_nm_validate()" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['netbanking_bank_name'];}?>" placeholder="Enter Bank Name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <h6 class="text-center">Customer Branch Name</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="text" class="form-control" name="net_banking_branch_name" id="net_banking_branch_name" onkeyup="netbank_branch_nm_validate()" placeholder="Enter Branch Name" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['net_banking_branch_name'];}?>" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <h6 class="text-center">UTR / Transaction No.</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="text" class="form-control" name="net_banking_utr_no" id="net_banking_utr_no" onkeyup="netbank_utr_no_validate()" placeholder="Enter UTR No" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['net_banking'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <h6 class="text-center">Transaction Date</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="date" class="form-control" max="<?php echo date("Y-m-d");?>" name="netbanking_date" id="netbanking_date" onchange="netbank_date_validate()" placeholder="" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['netbanking_date'];}?>">
                                        </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <?php } else { ?>
                                <div class="" id="net_banking_tr" style='display:none;'>
                                <div class="row cash_payment_div">
                                        <center><h4 class="mb-4">Amount Receiver Details</h4></center>
                                        <div class="col-md-6 mt-2">
                                            <h6 class="text-center">Payment Type</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                        <!-- &nbsp;&nbsp;<input type="radio" name="gender" id="male" value="Male">&nbsp;&nbsp;Male
                                        &nbsp;&nbsp;<input type="radio" name="gender" id="female" value="Female">&nbsp;&nbsp;Female -->

                                        <input type="radio" name="netbanking_payment_type" id="netbanking_payment_type_neft" onchange="sra_first_netpayment_validate()" value="NEFT">&nbsp;&nbsp;NEFT
                                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="netbanking_payment_type" id="netbanking_payment_type_rtgs" onchange="sra_first_netpayment_validate()" value="RTGS">&nbsp;&nbsp;RTGS
                                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="netbanking_payment_type" id="netbanking_payment_type_imps" onchange="sra_first_netpayment_validate()" value="IMPS">&nbsp;&nbsp;IMPS
                                        </div>


                                        <div class="col-md-6 mt-1">
                                        <h6 class="text-center">Net Banking Holder Name</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="select_css"  attr_netholder_type="sra" name="net_acc_holder_nm" id="net_acc_holder_nm" required="required" onchange="sra_first_netbank_holder_validate()">
                                            <!-- onchange='upi_QR_details(this.value); this.blur();' -->
                                                <option value="">Select Net Banking Holder Name</option>
                                                <!-- value="<?php //echo $upi_qr_master_id;?>" -->
                                                <option class="self_upi" attr_self="self" value="self">Self</option>
                                                <?php
                                                    foreach($upi_qr_data as $upi_qr_data_value) 
                                                    { 
                                                ?>
                                                    <option class="self_upi" attr_other="other" value="<?php echo $upi_qr_data_value['id'];?>"><?php echo $upi_qr_data_value['full_name'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mt-2">
                                        <h6 class="text-center">Account Number</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <select class="select_css" attr_bank_acc_no="sra" name="net_banking_acc_no" id="net_banking_acc_no" required="required" onchange="sra_first_netbank_accno_validate()">
                                            <!-- onchange='upi_QR_details(this.value); this.blur();' -->
                                                <option value="">Select Account Number</option>
                                                
                                                <?php
                                                    //foreach($upi_qr__add_more_data as $upi_qr__add_more_data_value) 
                                                    //{ 
                                                ?>
                                                    <option class="self_upi" attr_other="other" attr_qr_master_id="<?php //echo $upi_qr__add_more_data_value['qr_code_master_id'];?>" value="<?php //echo $upi_qr__add_more_data_value['id'];?>"><?php //echo $upi_qr__add_more_data_value['account_number'];?></option>
                                                <?php //} ?>
                                            </select>

                                            <input type="hidden" readonly class="form-control" name="net_banking_company_acc_yes_no" id="net_banking_company_acc_yes_no">
                                        </div>

                                        <!-- <div class="col-md-6 mt-2">
                                            <h6 class="text-center">Account Number</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="text" class="form-control" name="net_banking_acc_no" id="net_banking_acc_no" onkeyup="netbank_accno_validate()" placeholder="Enter Account No" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div> -->

                                        <!-- <div class="col-md-6 mt-2">
                                            <h6 class="text-center">Account Holder Name</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="text" readonly class="form-control" name="net_acc_holder_nm" id="net_acc_holder_nm" placeholder="Enter Account Holder Name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div> -->

                                        <div class="col-md-6 mt-2">
                                            <h6 class="text-center">Bank Name</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="text" readonly class="form-control" name="netbanking_bank_name" id="netbanking_bank_name" placeholder="Enter Bank Name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <h6 class="text-center">Customer Branch Name</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="text" autocomplete="off" class="form-control" name="net_banking_branch_name" id="net_banking_branch_name" onkeyup="sra_first_netbank_branch_nm_validate()" placeholder="Enter Branch Name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <h6 class="text-center">UTR / Transaction No.</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="text" autocomplete="off" class="form-control" name="net_banking_utr_no" id="net_banking_utr_no" onkeyup="sra_first_netbank_utr_no_validate()" placeholder="Enter UTR No" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                            <input type="hidden" class="form-control" name="net_bank_utr_no_status" id="net_bank_utr_no_status" value="No">
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <h6 class="text-center">Transaction Date</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="date" class="form-control" name="netbanking_date" id="netbanking_date" max="<?php echo date("Y-m-d");?>" onchange="sra_first_netbank_date_validate()" placeholder="">
                                        </div>

                                        <div class="col-md-6 mt-2" id="net_banking_reason" style='display:none;'>
                                            <h6 class="text-center">reason</h6>
                                        </div>
                                        <div class="col-md-6 mt-2" id="net_banking_input" style='display:none;'>
                                            <input type="text" autocomplete="off" class="form-control" name="net_banking_reason_1" id="net_banking_reason_1" onkeyup="sra_first_booking_net_banking_reason_validate()" placeholder="Enter Reason" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <?php } ?>
                            

                            <?php if(isset($booking_payment_details['select_transaction']) &&$booking_payment_details['select_transaction'] == 'UPI'){?>
                                <div class="" id="upi_no_div">
                                <div class="row cash_payment_div">
                                    <div class="col-md-5 mt-1">
                                        <h6 class="text-center float-right">UPI ID Holder Name</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="select_css" attr_holder_type="sra"  name="select_upi_no" id="select_upi_no" required="required" onchange="transaction_upi_validate()">
                                        <!-- onchange='upi_QR_details(this.value); this.blur();' -->
                                            <option value="">Select UPI ID Holder Name</option>
                                            <option class="self_upi" attr_self="self" value="Self">Self</option>
                                            <?php
                                                foreach($upi_qr_data as $upi_qr_data_value) 
                                                { 
                                            ?>
                                                <option class="self_upi" attr_other="other" value="<?php echo $upi_qr_data_value['id'];?>" <?php if(!empty($booking_payment_details['UPI_holder_name'])){if($upi_qr_data_value['id'] == $booking_payment_details['UPI_holder_name']) {echo 'selected';}}?>><?php echo $upi_qr_data_value['full_name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- <div id="upi_no_reason_div" style='display:none;'> -->
                                        <div class="col-md-5 mt-2">
                                            <h6 class="text-center float-right">Payment Type</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <select class="select_css" name="upi_payment_type" id="upi_payment_type" onchange="payment_type_validate()">
                                                <option value="">Select Transaction</option>
                                                <option value="Google Pay" <?php if(!empty($booking_payment_details['upi_payment_type'])){if("Google Pay" == $booking_payment_details['upi_payment_type']) {echo 'selected';}}?>>Google Pay</option>
                                                <option value="BHIM App" <?php if(!empty($booking_payment_details['upi_payment_type'])){if("BHIM App" == $booking_payment_details['upi_payment_type']) {echo 'selected';}}?>>BHIM App</option>
                                                <option value="PhonePe" <?php if(!empty($booking_payment_details['upi_payment_type'])){if("PhonePe" == $booking_payment_details['upi_payment_type']) {echo 'selected';}}?>>PhonePe</option>
                                                <option value="Paytm" <?php if(!empty($booking_payment_details['upi_payment_type'])){if("Paytm" == $booking_payment_details['upi_payment_type']) {echo 'selected';}}?>>Paytm</option>
                                                <option value="SBI pay" <?php if(!empty($booking_payment_details['upi_payment_type'])){if("SBI pay" == $booking_payment_details['upi_payment_type']) {echo 'selected';}}?>>SBI pay</option>
                                                <option value="Bank of Baroda UPI" <?php if(!empty($booking_payment_details['upi_payment_type'])){if("Bank of Baroda UPI" == $booking_payment_details['upi_payment_type']) {echo 'selected';}}?>>Bank of Baroda UPI</option>
                                            </select>
                                        </div>

                                        <div class="col-md-5 mt-2">
                                            <h6 class="text-center float-right">UPI ID Number</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="text" readonly class="form-control" name="self_upi_no" id="self_upi_no" placeholder="Enter Self UPI ID" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['upi_no'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>

                                        <div class="col-md-5 mt-2">
                                            <h6 class="text-center float-right">UTR / Transaction No.</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                        <input type="text" class="form-control" name="upi_no" id="upi_no" onkeyup="utr_no_validate()" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['UPI_transaction_no'];}?>" placeholder="Enter Transaction Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>

                                        <div class="col-md-5 mt-2">
                                            <h6 class="text-center float-right">reason</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="text" class="form-control" name="reason" id="reason" onkeyup="reason_validate()" placeholder="Enter Reason" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['UPI_reason'];}?>" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <?php } else{ ?>
                            <div class="" id="upi_no_div" style='display:none;'>
                                <div class="row cash_payment_div">
                                    <center><h4 class="mb-4">Amount Receiver Details</h4></center>
                                    <div class="col-md-5 mt-1">
                                        <h6 class="text-center float-right">UPI ID Holder Name</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="select_css"  attr_holder_type="sra" name="select_upi_no" id="select_upi_no" required="required" onchange="sra_first_transaction_upi_validate()">
                                        <!-- onchange='upi_QR_details(this.value); this.blur();' -->
                                            <option value="">Select UPI ID Holder Name</option>
                                            <!-- value="<?php //echo $upi_qr_master_id;?>" -->
                                            <option class="self_upi" attr_self="self" value="self">Self</option>
                                            <?php
                                                foreach($upi_qr_data as $upi_qr_data_value) 
                                                { 
                                            ?>
                                                <option class="self_upi" attr_other="other" value="<?php echo $upi_qr_data_value['id'];?>"><?php echo $upi_qr_data_value['full_name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- <div id="upi_no_reason_div" style='display:none;'> -->
                                        <div class="col-md-5 mt-2">
                                            <h6 class="text-center float-right">Payment Type</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <select class="select_css sra_payment_type" attr_payment_type="sra" name="upi_payment_type" id="upi_payment_type" onchange="sra_first_payment_type_validate()">
                                                <option value="">Select Transaction</option>
                                                <!-- Dynamic options will be added here using JavaScript -->
                                            </select>
                                            <input type="hidden" readonly class="form-control" name="company_acc_yes_no" id="company_acc_yes_no">
                                        </div>

                                        <div class="col-md-5 mt-2">
                                        <h6 class="text-center float-right">Customer Payment Type</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <select class="select_css"  attr_customer_payment_type="sra" name="upi_customer_payment_type" id="upi_customer_payment_type" required="required" onchange="sra_first_customer_payment_type_upi_validate()">
                                                <option value="">Select Customer Payment Type</option>
                                                <?php
                                                    foreach($upi_apps_name as $upi_apps_name_value) 
                                                    { 
                                                ?>
                                                    <option value="<?php echo $upi_apps_name_value['id'];?>"><?php echo $upi_apps_name_value['payment_app_name'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-md-5 mt-2">
                                            <h6 class="text-center float-right">UPI ID Number</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="text" readonly class="form-control" name="self_upi_no" id="self_upi_no" placeholder="Enter Self UPI ID" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>

                                        <div class="col-md-5 mt-2">
                                            <h6 class="text-center float-right">Transaction Date</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="date" class="form-control" onchange="sra_first_transaction_date_upi_validate()" max="<?php echo date("Y-m-d");?>" name="upi_transaction_date" id="upi_transaction_date" max="<?php echo date("Y-m-d");?>" placeholder="Transaction Date"> 
                                        </div>

                                        <div class="col-md-5 mt-2">
                                            <h6 class="text-center float-right">UTR / Transaction No.</h6>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <input type="text" autocomplete="off" class="form-control" name="upi_no" id="upi_no" onkeyup="sra_first_utr_no_validate()" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                            <input type="hidden" class="form-control" name="utr_no_status" id="utr_no_status" value="No">
                                        </div>

                                        <div class="col-md-5 mt-2" id="upi_reason" style='display:none;'>
                                            <h6 class="text-center float-right">reason</h6>
                                        </div>
                                        <div class="col-md-6 mt-2" id="upi_reason_input" style='display:none;'>
                                            <input type="text" autocomplete="off" class="form-control" name="reason" id="reason" onkeyup="sra_first_booking_upi_reason_validate()" placeholder="Enter Reason" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <?php } ?>


                            <?php if(isset($booking_payment_details['select_transaction']) && $booking_payment_details['select_transaction'] == 'QR Code'){?>
                            <div class="" id="rq_div">
                                <div class="row cash_payment_div">
                                    <div class="col-md-6 mt-1">
                                        <h6 class="text-center">UPI ID Holder Name</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="select_css" name="select_qr_upi_no" id="select_qr_upi_no" required="required" onchange="qr_hoder_name_validate()">
                                        <!-- onchange='upi_QR_details(this.value); this.blur();' -->
                                            <option value="">Select UPI ID Holder Name</option>
                                            <option value="Self">Self</option>
                                            <?php
                                                foreach($upi_qr_data as $upi_qr_data_value) 
                                                { 
                                            ?>
                                                <option value="<?php echo $upi_qr_data_value['id'];?>" <?php if(!empty($booking_payment_details['QR_holder_name'])){if($upi_qr_data_value['id'] == $booking_payment_details['QR_holder_name']) {echo 'selected';}}?>><?php echo $upi_qr_data_value['full_name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <h6 class="text-center">Mobile Number</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <input type="text" class="form-control" name="qr_mobile_number" id="qr_mobile_number" onkeyup="qr_mobile_no_validate()" placeholder="Enter Mobile Number" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['QR_mobile_number'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <h6 class="text-center">Payment Type</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <select class="select_css" name="qr_payment_type" id="qr_payment_type" onchange="qr_payment_type_validate()">
                                            <option value="">Select Transaction</option>
                                            <option value="Google Pay" <?php if(!empty($booking_payment_details['QR_payment_type'])){if("Google Pay" == $booking_payment_details['QR_payment_type']) {echo 'selected';}}?>>Google Pay</option>
                                            <option value="BHIM App" <?php if(!empty($booking_payment_details['QR_payment_type'])){if("BHIM App" == $booking_payment_details['QR_payment_type']) {echo 'selected';}}?>>BHIM App</option>
                                            <option value="PhonePe" <?php if(!empty($booking_payment_details['QR_payment_type'])){if("PhonePe" == $booking_payment_details['QR_payment_type']) {echo 'selected';}}?>>PhonePe</option>
                                            <option value="Paytm" <?php if(!empty($booking_payment_details['QR_payment_type'])){if("Paytm" == $booking_payment_details['QR_payment_type']) {echo 'selected';}}?>>Paytm</option>
                                            <option value="SBI pay" <?php if(!empty($booking_payment_details['QR_payment_type'])){if("SBI pay" == $booking_payment_details['QR_payment_type']) {echo 'selected';}}?>>SBI pay</option>
                                            <option value="Bank of Baroda UPI" <?php if(!empty($booking_payment_details['QR_payment_type'])){if("Bank of Baroda UPI" == $booking_payment_details['QR_payment_type']) {echo 'selected';}}?>>Bank of Baroda UPI</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <h6 class="text-center">UTR / Transaction No.</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <input type="text" class="form-control" name="qr_upi_no" id="qr_upi_no" onkeyup="qr_utr_no_validate()" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['QR_transaction_no'];}?>" placeholder="Enter Transaction Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                    </div>


                                    <div class="col-md-6 mt-2">
                                        <h6 class="text-center">QR code Image</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div name="qr_mode_code_image" id="qr_mode_code_image">

                                        <?php if(!empty($qr_image_details['qr_code_image'])){ ?>
                                        <img src="<?php echo base_url(); ?>uploads/QR_code_image/<?php echo $qr_image_details['qr_code_image']; ?>" width="80%">
                                        <input type="hidden" name="old_img_name" id="old_img_name" value="<?php echo $qr_image_details['qr_code_image']; ?>">
                                        <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } else { ?>
                            <div class="" id="rq_div" style='display:none;'>
                                <div class="row cash_payment_div">
                                    <center><h4 class="mb-4">Amount Receiver Details</h4></center>
                                    <div class="col-md-6 mt-1">
                                        <h6 class="text-center">QR Holder Name</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="select_css" attr_qr_holder_type="sra" name="select_qr_upi_no" id="select_qr_upi_no" required="required" onchange="sra_first_qr_hoder_name_validate()">
                                        <!-- onchange='upi_QR_details(this.value); this.blur();' -->
                                            <option value="">Select UPI ID Holder Name</option>
                                            <option value="self" attr_self="self">Self</option>
                                            <?php
                                                foreach($upi_qr_data as $upi_qr_data_value) 
                                                { 
                                            ?>
                                                <option attr_other="other" value="<?php echo $upi_qr_data_value['id'];?>"><?php echo $upi_qr_data_value['full_name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    
                                    <div class="col-md-6 mt-2">
                                        <h6 class="text-center">QR Code App Name</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <select class="select_css" attr_qr_payment_type="sra" name="qr_payment_type" id="qr_payment_type" onchange="sra_first_qr_payment_type_validate()">
                                            <option value="">Select Transaction</option>

                                        </select>
                                        <input type="hidden" readonly class="form-control" name="qr_company_acc_yes_no" id="qr_company_acc_yes_no">
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <h6 class="text-center">Mobile Number</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <input readonly type="text" class="form-control" name="qr_mobile_number" id="qr_mobile_number" onkeyup="qr_mobile_no_validate()" placeholder="Enter Mobile Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <h6 class="text-center">Transaction Date</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <input type="date" class="form-control" onchange="sra_first_qr_transaction_date_validate()" max="<?php echo date("Y-m-d");?>" name="qr_transaction_date" id="qr_transaction_date" max="<?php echo date("Y-m-d");?>" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['upi_transaction_date'];}?>" placeholder="Transaction Date"> 
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <h6 class="text-center">UTR / Transaction No.</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <input type="text" autocomplete="off" class="form-control" name="qr_upi_no" id="qr_upi_no" onkeyup="sra_first_qr_utr_no_validate()" placeholder="Enter Transaction Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        <input type="hidden" class="form-control" name="QR_utr_no_status" id="QR_utr_no_status" value="No">
                                    </div>

                                    <div class="col-md-6 mt-2" id="qr_reason" style='display:none;'>
                                            <h6 class="text-center">reason</h6>
                                    </div>
                                    <div class="col-md-6 mt-2" id="qr_reason_input" style='display:none;'>
                                        <input type="text" autocomplete="off" class="form-control" name="qr_reason_1" id="qr_reason_1" onkeyup="sra_first_booking_qr_reason_validate()" placeholder="Enter Reason" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <h6 class="text-center">QR code Image</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div name="qr_mode_code_image" id="qr_mode_code_image"></div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>


                            <?php if(isset($booking_payment_details['select_transaction']) && $booking_payment_details['select_transaction'] == 'Cheque'){?>
                            <div class="" id="cheque_tr">
                                <div class="row cash_payment_div">
                                    <div class="col-md-6 mt-1">
                                        <h6 class="text-center">Cheque Number</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="cheque" id="cheque" onkeyup="cheque_no_validate()" placeholder="Enter Cheque Number" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['cheque'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <h6 class="text-center">Bank Name</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <input type="text" class="form-control" name="bank_name" id="bank_name" onkeyup="cheque_banknm_validate()" placeholder="Enter Bank Name" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['bank_name'];}?>" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <h6 class="text-center">Drawn On Date</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <input type="date" class="form-control" name="drawn_on_date" id="drawn_on_date" onchange="cheque_date_validate()" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['drawn_on_date'];}?>" placeholder="Select Date">
                                    </div>
                                </div>
                            </div>
                            <?php } else{ ?>
                            <div class="" id="cheque_tr" style='display:none;'>
                                <div class="row cash_payment_div">
                                <center><h4 class="mb-4">Amount Receiver Details</h4></center>

                                    <div class="col-md-6 mt-1">
                                        <h6 class="text-center">Name On Cheque</h6>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <select class="select_css"  attr_cheque_name="sra" name="name_on_cheque" id="name_on_cheque" required="required" onchange="sra_first_cheque_name_validate()">
                                        <!-- onchange='upi_QR_details(this.value); this.blur();' -->
                                            <option value="">Select Name On Cheque</option>
                                            <option value="self" attr_self="self">Self</option>
                                            <?php
                                                foreach($upi_qr_data as $upi_qr_data_value) 
                                                { 
                                            ?>
                                                <option class="self_upi" value="<?php echo $upi_qr_data_value['id'];?>"><?php echo $upi_qr_data_value['full_name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- <div class="col-md-6 mt-2">
                                        <h6 class="text-center">Bank Name</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <select class="select_css" name="cheque_bank_name" id="cheque_bank_name" onchange="sra_first_cheque_bank_name_validate()">
                                            <option value="">Select Transaction</option>

                                        </select>
                                    </div> -->
                                    <input type="hidden" readonly class="form-control" name="cheque_company_acc_yes_no" id="cheque_company_acc_yes_no" value="">

                                    <div class="col-md-6 mt-2">
                                        <h6 class="text-center">Cheque Of Bank</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <input type="text" autocomplete="off" class="form-control" name="bank_name" id="bank_name" onkeyup="sra_first_cheque_banknm_validate()" placeholder="Enter Bank Name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <h6 class="text-center">Cheque Number</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <input type="text" autocomplete="off" class="form-control" name="cheque" id="cheque" onkeyup="sra_first_cheque_no_validate()" placeholder="Enter Cheque Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <h6 class="text-center">Drawn On Date</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <input type="date" class="form-control" name="drawn_on_date" id="drawn_on_date" onchange="sra_first_cheque_date_validate()" placeholder="Select Date">
                                    </div>

                                    <div class="col-md-6 mt-2" id="cheque_reason" style='display:none;'>
                                            <h6 class="text-center">reason</h6>
                                    </div>
                                    <div class="col-md-6 mt-2" id="cheque_reason_input" style='display:none;'>
                                        <input type="text" class="form-control" name="cheque_reason_1" id="cheque_reason_1" onkeyup="sra_first_booking_cheque_reason_validate()" placeholder="Enter Reason" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                            <div class="" id="Demand_draft_tr" style='display:none;'>
                                <div class="row cash_payment_div">
                                <center><h4 class="mb-4">Demand Draft Details</h4></center>
                                    <div class="col-md-6 mt-1">
                                        <h6 class="text-center">Demand Draft Name</h6>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <select class="select_css"  attr_cheque_name="sra" name="demand_draft_name" id="demand_draft_name" required="required" onchange="sra_demand_draft_name_validate()">
                                        <!-- onchange='upi_QR_details(this.value); this.blur();' -->
                                            <option value="">Select Demand Draft Name</option>
                                            <option value="self" attr_self="self">Self</option>
                                            <?php
                                                foreach($upi_qr_data as $upi_qr_data_value) 
                                                { 
                                            ?>
                                                <option class="self_upi" value="<?php echo $upi_qr_data_value['id'];?>"><?php echo $upi_qr_data_value['full_name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- <div class="col-md-6 mt-2">
                                        <h6 class="text-center">Bank Name</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <select class="select_css" name="cheque_bank_name" id="cheque_bank_name" onchange="sra_first_cheque_bank_name_validate()">
                                            <option value="">Select Transaction</option>

                                        </select>
                                    </div> -->
                                    <div class="col-md-6 mt-2">
                                        <h6 class="text-center">Demand Draft Bank</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <input type="text" autocomplete="off" class="form-control" name="demand_draft_bank_name" id="demand_draft_bank_name" onkeyup="sra_demand_draft_bank_name_validate()" placeholder="Enter Bank Name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <h6 class="text-center">Demand Draft Number</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <input type="text" autocomplete="off" class="form-control" name="demand_draft_number" id="demand_draft_number" onkeyup="sra_demand_draft_number_validate()" placeholder="Enter Draft Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <h6 class="text-center">Demand Draft Date</h6>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <input type="date" class="form-control" name="demand_draft_date" id="demand_draft_date" onchange="sra_demand_draft_date_validate()" placeholder="Select Date">
                                    </div>

                                    <div class="col-md-6 mt-2" id="demand_reason" style='display:none;'>
                                            <h6 class="text-center">Demand Draft reason</h6>
                                    </div>
                                    <div class="col-md-6 mt-2" id="demand_reason_input" style='display:none;'>
                                        <input type="text" class="form-control" name="demand_draft_reason" id="demand_draft_reason" onkeyup="sra_demand_draft_reason_validate()" placeholder="Enter Reason" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-3">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <?php if(isset($booking_payment_details['select_transaction']) && $booking_payment_details['select_transaction'] == 'CASH'){?>
                            <div class="row" id="cash_tr">
                            <div class="col-md-6">
                                <div class="row cash_payment_div">
                                        <div class="col-md-12">
                                            <h6 class="text-center">Payment From customer</h6>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <h6 class="text-center">Particulars</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-center">Rupees</h6>
                                        </div>
                                    
                                        <!-- <div class="col-md-2">
                                            <label id="amt_cash">2000 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control data_amt" attr-amt="2000" name="cash_2000" id="cash_2000" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_2000" id="total_cash_2000" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div> -->

                                        <div class="col-md-2">
                                        <label>500 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control data_amt_first" attr-amt="500" name="cash_500" id="cash_500" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['cash_500'];}?>" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_500" id="total_cash_500" placeholder="Enter Rupees" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['total_cash_500'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>200 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control data_amt_first" attr-amt="200" name="cash_200" id="cash_200" placeholder="Enter Particulars" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['cash_200'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_200" id="total_cash_200" placeholder="Enter Rupees" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['total_cash_200'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>100 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control data_amt_first" attr-amt="100" name="cash_100" id="cash_100" placeholder="Enter Particulars" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['cash_100'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_100" id="total_cash_100" placeholder="Enter Rupees" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['total_cash_100'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>50 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control data_amt_first" attr-amt="50" name="cash_50" id="cash_50" placeholder="Enter Particulars" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['cash_50'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_50" id="total_cash_50" placeholder="Enter Rupees" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['total_cash_50'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>20 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control data_amt_first" attr-amt="20" name="cash_20" id="cash_20" placeholder="Enter Particulars" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['cash_20'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_20" id="total_cash_20" placeholder="Enter Rupees" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['total_cash_20'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>10 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control data_amt_first" attr-amt="10" name="cash_10" id="cash_10" placeholder="Enter Particulars" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['cash_10'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_10" id="total_cash_10" placeholder="Enter Rupees" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['total_cash_10'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>5 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control data_amt_first" attr-amt="5" name="cash_5" id="cash_5" placeholder="Enter Particulars" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['cash_5'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_5" id="total_cash_5" placeholder="Enter Rupees" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['total_cash_5'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>2 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control data_amt_first" attr-amt="2" name="cash_2" id="cash_2" placeholder="Enter Particulars" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['cash_2'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_2" id="total_cash_2" placeholder="Enter Rupees" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['total_cash_2'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>1 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control data_amt_first" attr-amt="1" name="cash_1" id="cash_1" placeholder="Enter Particulars" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['cash_1'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_1" id="total_cash_1" placeholder="Enter Rupees" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['total_cash_1'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label> </label>
                                        </div>
                                        <div class="col-md-4 mt-3 text-center">
                                            <h5>Total</h5>
                                        </div>
                                        <div class="col-md-1 mt-3">
                                            =
                                        </div>
                                        <div class="col-md-5 mt-2">
                                            <input readonly type="text" class="form-control" name="total_cash_amt" id="total_cash_amt" placeholder="Total Cash" value="<?php if(!empty($booking_payment_details)){ echo $booking_payment_details['total_cash_amt'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="row cash_payment_div">
                                        <div class="col-md-12">
                                            <h6 class="text-center">Return to customer</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-center">Particulars</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-center">Rupees</h6>
                                        </div>

                                        <div class="col-md-2">
                                        <label>500 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control return_data_amt_first" return-attr-amt="500" name="return_cash_500" id="return_cash_500" placeholder="Enter Particulars" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_cash_500'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_500" id="return_total_cash_500" placeholder="Enter Rupees" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_total_cash_500'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>200 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control return_data_amt_first" return-attr-amt="200" name="return_cash_200" id="return_cash_200" placeholder="Enter Particulars" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_cash_200'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_200" id="return_total_cash_200" placeholder="Enter Rupees" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_total_cash_200'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>100 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control return_data_amt_first" return-attr-amt="100" name="return_cash_100" id="return_cash_100" placeholder="Enter Particulars" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_cash_100'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_100" id="return_total_cash_100" placeholder="Enter Rupees" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_total_cash_100'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>50 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control return_data_amt_first" return-attr-amt="50" name="return_cash_50" id="return_cash_50" placeholder="Enter Particulars" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_cash_50'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_50" id="return_total_cash_50" placeholder="Enter Rupees" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_total_cash_50'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>20 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control return_data_amt_first" return-attr-amt="20" name="return_cash_20" id="return_cash_20" placeholder="Enter Particulars" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_cash_20'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_20" id="return_total_cash_20" placeholder="Enter Rupees" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_total_cash_20'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>10 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control return_data_amt_first" return-attr-amt="10" name="return_cash_10" id="return_cash_10" placeholder="Enter Particulars" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_cash_10'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_10" id="return_total_cash_10" placeholder="Enter Rupees" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_total_cash_10'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>5 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control return_data_amt_first" return-attr-amt="5" name="return_cash_5" id="return_cash_5" placeholder="Enter Particulars" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_cash_5'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_5" id="return_total_cash_5" placeholder="Enter Rupees" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_total_cash_5'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>2 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control return_data_amt_first" return-attr-amt="2" name="return_cash_2" id="return_cash_2" placeholder="Enter Particulars" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_cash_2'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_2" id="return_total_cash_2" placeholder="Enter Rupees" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_total_cash_2'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>1 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control return_data_amt_first" return-attr-amt="1" name="return_cash_1" id="return_cash_1" placeholder="Enter Particulars" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_cash_1'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_1" id="return_total_cash_1" placeholder="Enter Rupees" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_total_cash_1'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label> </label>
                                        </div>
                                        <div class="col-md-4 mt-3 text-center">
                                            <h5>Total</h5>
                                        </div>
                                        <div class="col-md-1 mt-3">
                                            =
                                        </div>
                                        <div class="col-md-5 mt-2">
                                            <input readonly type="text" class="form-control" name="return_total_cash_amt" id="return_total_cash_amt" placeholder="Total Cash" value="<?php if(!empty($return_customer_booking_payment_details)){ echo $return_customer_booking_payment_details['return_total_cash_amt'];}?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>
                                </div>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="row" id="cash_tr" style='display:none;'>
                            <div class="col-md-6">
                                <div class="row cash_payment_div">
                                        <div class="col-md-12">
                                            <h6 class="text-center">Payment From customer</h6>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <h6 class="text-center">Particulars</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-center">Rupees</h6>
                                        </div>
                                    
                                        <!-- <div class="col-md-2">
                                            <label id="amt_cash">2000 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control data_amt" attr-amt="2000" name="cash_2000" id="cash_2000" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_2000" id="total_cash_2000" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div> -->

                                        <div class="col-md-2">
                                        <label>500 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control data_amt_first" attr-amt="500" name="cash_500" id="cash_500" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_500" id="total_cash_500" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>200 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control data_amt_first" attr-amt="200" name="cash_200" id="cash_200" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_200" id="total_cash_200" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>100 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control data_amt_first" attr-amt="100" name="cash_100" id="cash_100" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_100" id="total_cash_100" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>50 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control data_amt_first" attr-amt="50" name="cash_50" id="cash_50" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_50" id="total_cash_50" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>20 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control data_amt_first" attr-amt="20" name="cash_20" id="cash_20" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_20" id="total_cash_20" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>10 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control data_amt_first" attr-amt="10" name="cash_10" id="cash_10" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_10" id="total_cash_10" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>5 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control data_amt_first" attr-amt="5" name="cash_5" id="cash_5" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_5" id="total_cash_5" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>2 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control data_amt_first" attr-amt="2" name="cash_2" id="cash_2" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_2" id="total_cash_2" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>1 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control data_amt_first" attr-amt="1" name="cash_1" id="cash_1" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="total_cash_1" id="total_cash_1" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label> </label>
                                        </div>
                                        <div class="col-md-4 mt-3 text-center">
                                            <h5>Total</h5>
                                        </div>
                                        <div class="col-md-1 mt-3">
                                            =
                                        </div>
                                        <div class="col-md-5 mt-2">
                                            <input readonly type="text" class="form-control" name="total_cash_amt" id="total_cash_amt" placeholder="Total Cash" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                            <input readonly type="hidden" class="form-control" name="total_of_two" id="total_of_two" placeholder="" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="row cash_payment_div">
                                        <div class="col-md-12">
                                            <h6 class="text-center">Return to customer</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-center">Particulars</h6> 
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-center">Rupees</h6>
                                        </div>

                                        <div class="col-md-2">
                                        <label>500 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control return_data_amt_first" return-attr-amt="500" name="return_cash_500" id="return_cash_500" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_500" id="return_total_cash_500" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>200 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control return_data_amt_first" return-attr-amt="200" name="return_cash_200" id="return_cash_200" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_200" id="return_total_cash_200" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>100 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control return_data_amt_first" return-attr-amt="100" name="return_cash_100" id="return_cash_100" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_100" id="return_total_cash_100" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>50 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control return_data_amt_first" return-attr-amt="50" name="return_cash_50" id="return_cash_50" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_50" id="return_total_cash_50" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>20 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control return_data_amt_first" return-attr-amt="20" name="return_cash_20" id="return_cash_20" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_20" id="return_total_cash_20" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>10 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control return_data_amt_first" return-attr-amt="10" name="return_cash_10" id="return_cash_10" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_10" id="return_total_cash_10" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>5 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control return_data_amt_first" return-attr-amt="5" name="return_cash_5" id="return_cash_5" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_5" id="return_total_cash_5" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>2 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control return_data_amt_first" return-attr-amt="2" name="return_cash_2" id="return_cash_2" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_2" id="return_total_cash_2" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label>1 x </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" autocomplete="off" class="form-control return_data_amt_first" return-attr-amt="1" name="return_cash_1" id="return_cash_1" placeholder="Enter Particulars" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                                        </div>
                                        <div class="col-md-1">
                                            =
                                        </div>
                                        <div class="col-md-5">
                                            <input readonly type="text" class="form-control" name="return_total_cash_1" id="return_total_cash_1" placeholder="Enter Rupees" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>

                                        <div class="col-md-2">
                                        <label> </label>
                                        </div>
                                        <div class="col-md-4 mt-3 text-center">
                                            <h5>Total</h5>
                                        </div>
                                        <div class="col-md-1 mt-3">
                                            =
                                        </div>
                                        <div class="col-md-5 mt-2">
                                            <input readonly type="text" class="form-control" name="return_total_cash_amt" id="return_total_cash_amt" placeholder="Total Cash" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" > 
                                        </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        
                        <?php 
                        if(!empty($extra_services_details_value)){?>
                            <div class="" id="extra_services_div" style='display:none;'>
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-8 mt-1 cash_payment_div">
                                    <table id="" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Extra Services Name</th>
                                            <th>Extra Services Amount</th>
                                            <th>Customer sending Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php  
                                        foreach($extra_services_details_value as $extra_services_details_value_info) 
                                        { 
                                            ?>
                                        <tr>
                                            <td><?php echo $extra_services_details_value_info['extra_services'] ?></td>
                                            <td><?php echo $extra_services_details_value_info['services_amt'] ?></td>
                                            <td><input type="text" name="customer_sending_amt" id="customer_sending_amt" placeholder="Enter sending amount" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table> 
                                    </div> 
                                    <div class="col-md-2">
                                    </div>
                                </div>
                            </div>
                            <?php  } ?>
                            <!-- <div id="extra_services_div_msg" style='display:block;'>
                            <div class="row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6 mt-1 cash_payment_div">
                                    <h6 style="color:red; text-align:center">Extra services not added</h6>
                                </div>
                                <div class="col-md-3">
                                </div>
                            </div>
                            </div> -->

                        <div class="row">
                            <div class="col-md-12">
                              <p id="send_receiver_msg" style="display:none;"></p>
                            </div>
                        </div>
                    </div>
                </div>
                      </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit" id="submit_slider">Submit</button>
                    <a href="<?php echo $module_url_path; ?>/index"><button type="button" class="btn btn-danger">Cancel</button></a>
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
 