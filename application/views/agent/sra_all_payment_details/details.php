<style>
    a {
    text-decoration: none !important;
    }
    .cash_payment_div{
        border: 1px solid red;
        padding: 10px;
    }

    .extrax_services_div{
        border: solid 1px #00000030;
        margin: 15px;
        padding: 10px;
    }

    .hide {
    display: none;
    }
    
    #least_count{
        font-weight:400;
        color:red;
    }
    #booking_least_count{
        font-weight:400;
        color:red;
    }

    #qr_code_image img{
        width:40%;
        height:40%;
    }
    #qr_mode_code_image img{
        width:100%;
        height:100%;
    }
    .enq_id{
        color:white;
    }
    .reason_css{
        background-color:rgba(0,0,0,.05) !important;
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
            <?php $this->load->view('agent/layout/agent_alert'); ?>

            <form method="post" enctype="multipart/form-data" id="final_booking_preview">

            <div class="card card-primary">
              <div class="card-header">
              <?php foreach($traveller_booking_info_header as $traveller_booking_info_value) 
                   {  ?>
                    <div class="row">
                    <div class="col-md-2">
                            <label>Tour No -</label>
                        </div>  
                        <div class="col-md-5">
                            <div><?php echo $traveller_booking_info_value['package_tour_number']; ?></div>
                        </div>
                        <div class="col-md-2">
                            <label>Customer Name -</label>
                        </div>
                        <div class="col-md-3">
                            <div><?php echo $traveller_booking_info_value['customer_name']; ?></div>
                        </div>
                        <div class="col-md-2">  
                            <label>Tour Date -</label>
                        </div>
                        <div class="col-md-5">  
                            <div><?php echo date('d-m-Y', strtotime($traveller_booking_info_value['journey_date'])); ?></div>
                        </div>
                        <div class="col-md-2">
                            <label>Mobile No -</label>
                        </div>
                        <div class="col-md-3">
                            <div><?php echo $traveller_booking_info_value['mobile_number']; ?></div>
                        </div>
                        <!-- <div class="col-md-2">
                          <label> Total Amount -</label>
                        </div>
                        <div class="col-md-3">
                          <div><?php //echo $traveller_booking_info_value['total_sra_amt']; ?></div>
                        </div> -->
                        <!-- <div class="col-md-2"></div> -->
                        <div class="col-md-2">
                            <label> Total Seat -</label>
                        </div>
                        <div class="col-md-5">
                            <div><?php echo $traveller_booking_info_value['total_seat']; ?></div>
                        </div>
                        
                        <div class="col-md-2">
                            <label> SRA NO -</label>
                        </div>
                        <div class="col-md-3">
                            <div><?php echo $traveller_booking_info_value['sra_no']; ?></div>
                        </div>

                        <input type="hidden" class="form-control" name="sra_no" id="sra_no" value="<?php echo $traveller_booking_info_value['sra_no']; ?>">
                        <input type="hidden" class="form-control" name="package_date_id" id="package_date_id" value="<?php echo $traveller_booking_info_value['tour_date']; ?>">
                        <input type="hidden" class="form-control" name="sra_payment_id" id="sra_payment_id" value="<?php echo $traveller_booking_info_value['id']; ?>">
                        <input type="hidden" class="form-control" name="package_id" id="package_id" value="<?php echo $traveller_booking_info_value['tour_number']; ?>">
                        <!-- <input type="hidden" class="form-control" name="booking_ref_no" id="booking_ref_no" value=""> -->
                    </div>
              </div>
                <?php } ?>
                <input type="hidden" class="form-control" name="booking_payment_details_id" id="booking_payment_details_id" value="<?php if(isset($booking_payment_details)){echo $booking_payment_details['id'];} ?> ">
                <input type="hidden" class="form-control" name="return_customer_booking_payment_id" id="return_customer_booking_payment_id" value="<?php if(isset($return_customer_booking_payment_details)){echo $return_customer_booking_payment_details['id'];} ?>">
                <div class="card-body">
                    <label style="color:blue;">SRA Payment Transaction Details :-</label>
                    <label>SRA Total Amount :- <?php echo $sra_total_amount;?></label>
                    
                    <?php  if(count($booking_payment_details_all) > 0 ) 
                    { ?>
                    <table id="" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                        <th>SN</th>
                        <th>Payment Date</th>
                        <th>Paid Amount</th>
                        <th>Pending Amount</th>
                        <th>Transaction Type</th>
                        <th>UPI No/Acc No</th>
                        <th>Payment Type</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  
                        $i=1; 
                        foreach($booking_payment_details_all as $info) 
                         //print_r($info);
                        { 
                          $enq_id=$info['id'];
                        ?>
                        <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo date("d-m-Y",strtotime($info['created_at'])) ?></td>
                        <td><?php echo $info['booking_amt'] ?></td>
                        <td><?php echo $info['pending_amt'] ?></td>
                        
                        <td>
                        <?php if($info['select_transaction']== 'CASH' || $info['select_transaction']== 'UPI' || $info['select_transaction']== 'QR Code' || $info['select_transaction']== 'Cheque' || $info['select_transaction']== 'Net Banking' || $info['select_transaction']== 'Demand Draft'){
                                echo $info['select_transaction']; ?> 
                        <?php }else{
                                echo $info['payment_now_later'] ?>
                        <?php } ?>
                        </td>
                        
                        <td>
                            <?php if($info['select_transaction'] == 'UPI'){
                            echo $info['UPI_transaction_no'];
                            ?>
                            <?php }else if($info['select_transaction'] == 'QR Code'){
                            echo $info['QR_transaction_no'];
                            ?>
                            <?php } else if($info['select_transaction'] == 'Cheque'){
                            echo $info['cheque'];    
                            ?>
                            <?php } else if($info['select_transaction'] == 'Net Banking'){
                            echo $info['account_number'];
                            ?>
                            <?php } else if($info['select_transaction'] == 'Demand Draft'){
                            echo $info['demand_draft_number'];
                            ?>
                            <?php }else{
                            echo '-';
                            ?>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if($info['payment_type']== 'Advance' || $info['payment_type']== 'Part' || $info['payment_type']== 'Full'){
                                echo $info['payment_type']; ?>
                            <?php } else{ 
                                echo $info['payment_reason']; ?>
                            <?php } ?>
                        </td>
                        <?php if($info['select_transaction'] =='UPI' OR $info['select_transaction'] =='Net Banking' OR $info['select_transaction'] =='QR Code' OR $info['select_transaction'] =='Cheque' OR $info['select_transaction'] =='Demand Draft'){?>
                        <td>
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $enq_id;?>" class="enq_id" data-bs-whatever="Form" data-enq-id="<?php echo $enq_id;?>"><button type="button" class="btn btn-primary btn-sm btn_follow take_followup_btn" class="dropdown-item">View</button> </a>
                        </td>
                        <?php } ?>
                        </tr>

                        <div class="modal fade" id="exampleModal<?php echo $enq_id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> Transaction Information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form method="post">
                                  <div class="col-md-12">
                                  <center><h5 class=""> Transaction Type : <?php echo $info['select_transaction']; ?></h5></center>
                                    <div class="row mt-3">
                                      <div class="col-md-6 mb-2">
                                        <?php if($info['select_transaction'] =='UPI'){?>
                                          <label class="col-form-label">UPI ID Holder Name:</label> 
                                          <label class="col-form-label">UPI Code App Name:</label> 
                                          <label class="col-form-label">UPI ID Number:</label> 
                                          <label class="col-form-label">Transaction Date:</label> 
                                          <label class="col-form-label">UTR / Transaction No.:</label><Br> 
                                          <?php if($info['UPI_reason']!=''){?>
                                            <label class="col-form-label">Reason:</label> 
                                          <?php } ?>
                                        <?php } else if($info['select_transaction'] =='Net Banking'){?>
                                          <label class="col-form-label">Account Holder Name:</label> 
                                          <label class="col-form-label">Payment Type:</label> 
                                          <label class="col-form-label">Account Number:</label> 
                                          <label class="col-form-label">Bank Name:</label> 
                                          <label class="col-form-label">Customer Branch Name.:</label> 
                                          <label class="col-form-label">UTR / Transaction No.:</label> 
                                          <label class="col-form-label">Transaction Date:</label><Br> 
                                          <?php if($info['net_banking_reason']!=''){?>
                                            <label class="col-form-label">Reason:</label>
                                          <?php } ?>
                                        <?php }else if($info['select_transaction'] =='QR Code'){?>
                                          <label class="col-form-label">QR Holder Name:</label> 
                                          <label class="col-form-label">QR Code App Name:</label> 
                                          <label class="col-form-label">Mobile Number:</label> 
                                          <label class="col-form-label">Transaction Date:</label> 
                                          <label class="col-form-label">UTR / Transaction No.:</label><Br> 
                                          <?php if($info['QR_reason']!=''){?>
                                            <label class="col-form-label">Reason:</label> 
                                          <?php } ?>
                                        <?php }else if($info['select_transaction'] =='Cheque'){ ?>
                                          <label class="col-form-label">Name On Cheque:</label> 
                                          <label class="col-form-label">Cheque Of Bank:</label> 
                                          <label class="col-form-label">Cheque Number:</label> 
                                          <label class="col-form-label">Drawn On Date:</label><Br> 
                                          <?php if($info['cheque_reason']!=''){?>
                                            <label class="col-form-label">Reason:</label> 
                                          <?php } ?>
                                        <?php } else if($info['select_transaction'] =='Demand Draft'){?>
                                          <label class="col-form-label">Demand Draft Name:</label> 
                                          <label class="col-form-label">Demand Draft Bank:</label> 
                                          <label class="col-form-label">Demand Draft Number:</label> 
                                          <label class="col-form-label">Demand Draft Date:</label><Br> 
                                          <?php if($info['demand_draft_reason']!=''){?>
                                            <label class="col-form-label">Reason:</label> 
                                          <?php } ?>
                                          <?php }?>

                                        <input type="hidden" name="sra_booking_id" id="sra_booking_id" value="<?php if(isset($info['id'])){ echo $info['id'];}?>">
                                      </div>
                                      <div class="col-md-6 mb-2">
                                      <?php if($info['select_transaction'] =='UPI'){?>
                                        <?php if($info['UPI_holder_name']== 'self'){?>
                                        <h6 class="mt-2"><?php echo $info['agent_name']; ?></h6>
                                        <?php } else if($info['UPI_holder_name']!= 'self'){ ?>
                                          <h6 class="mt-2"><?php echo $info['full_name']; ?></h6>
                                        <?php }?>

                                        <h6 class="mt-4"><?php echo $info['payment_app_name']; ?></h6>
                                        <h6 class="mt-3"><?php echo $info['UPI_transaction_no']; ?></h6>
                                        <h6 class="mt-3"><?php echo date("d-m-Y",strtotime($info['upi_transaction_date'])); ?></h6>
                                        <h6 class="mt-3"><?php echo $info['upi_no']; ?></h6>
                                        <?php if($info['UPI_reason']!=''){?>
                                          <h6 class="mt-3"><?php echo $info['UPI_reason']; ?></h6>
                                        <?php } ?>
                                      <?php } else if($info['select_transaction'] =='Net Banking'){?>
                                        <?php if($info['net_banking_acc_holder_nm']== 'self'){?>
                                        <h6 class="mt-2"><?php echo $info['agent_name']; ?></h6>
                                        <?php } else if($info['net_banking_acc_holder_nm']!= 'self'){ ?>
                                          <h6 class="mt-2"><?php echo $info['full_name']; ?></h6>
                                        <?php }?>
                                        
                                        <h6 class="mt-4"><?php echo $info['netbanking_payment_type']; ?></h6>
                                        <h6 class="mt-3"><?php echo $info['account_number']; ?></h6>
                                        <h6 class="mt-3"><?php echo $info['netbanking_bank_name']; ?></h6>
                                        <h6 class="mt-3"><?php echo $info['net_banking_branch_name']; ?></h6>
                                        <h6 class="mt-3"><?php echo $info['net_banking']; ?></h6>
                                        <h6 class="mt-3"><?php echo date("d-m-Y",strtotime($info['netbanking_date'])); ?></h6>
                                        <?php if($info['net_banking_reason']!=''){?>
                                          <h6 class="mt-3"><?php echo $info['net_banking_reason']; ?></h6>
                                        <?php } ?>
                                      <?php } else if($info['select_transaction'] =='QR Code'){ ?>
                                        <?php if($info['QR_holder_name']== 'Self'){?>
                                        <h6 class="mt-2"><?php echo $info['agent_name']; ?></h6>
                                        <?php } else if($info['QR_holder_name']!= 'Self'){ ?>
                                          <h6 class="mt-2"><?php echo $info['full_name']; ?></h6>
                                        <?php }?>

                                        <h6 class="mt-4"><?php echo $info['payment_app_name']; ?></h6>
                                        <h6 class="mt-3"><?php echo $info['QR_mobile_number']; ?></h6>
                                        <h6 class="mt-3"><?php echo date("d-m-Y",strtotime($info['qr_transaction_date'])); ?></h6>
                                        <h6 class="mt-3"><?php echo $info['QR_transaction_no']; ?></h6>
                                        <?php if($info['QR_reason']!=''){?>
                                          <h6 class="mt-3"><?php echo $info['QR_reason']; ?></h6>
                                        <?php } ?>
                                      <?php } else if($info['select_transaction'] =='Cheque'){?>
                                        <?php if($info['name_on_cheque']== 'self'){?>
                                        <h6 class="mt-2"><?php echo $info['agent_name']; ?></h6>
                                        <?php } else if($info['name_on_cheque']!= 'self'){ ?>
                                          <h6 class="mt-2"><?php echo $info['full_name']; ?></h6>
                                        <?php }?>

                                        <h6 class="mt-2"><?php echo $info['full_name']; ?></h6>
                                        <h6 class="mt-4"><?php echo $info['payment_app_name']; ?></h6>
                                        <h6 class="mt-3"><?php echo $info['bank_name']; ?></h6>
                                        <h6 class="mt-3"><?php echo $info['cheque']; ?></h6>
                                        <h6 class="mt-3"><?php echo date("d-m-Y",strtotime($info['drawn_on_date'])); ?></h6>
                                        <?php if($info['cheque_reason']!=''){?>
                                          <h6 class="mt-3"><?php echo $info['cheque_reason']; ?></h6>
                                        <?php } ?>
                                      <?php } else if($info['select_transaction'] =='Demand Draft'){?>
                                        <?php if($info['demand_draft_name']== 'self'){?>
                                        <h6 class="mt-2"><?php echo $info['agent_name']; ?></h6>
                                        <?php } else if($info['demand_draft_name']!= 'self'){ ?>
                                          <h6 class="mt-2"><?php echo $info['full_name']; ?></h6>
                                        <?php }?>

                                        <h6 class="mt-4"><?php echo $info['demand_draft_bank_name']; ?></h6>
                                        <h6 class="mt-3"><?php echo $info['demand_draft_number']; ?></h6>
                                        <h6 class="mt-3"><?php echo date("d-m-Y",strtotime($info['demand_draft_date'])); ?></h6>
                                        <?php if($info['demand_draft_reason']!=''){?>
                                          <h6 class="mt-3"><?php echo $info['demand_draft_reason']; ?></h6>
                                        <?php } ?>
                                        <?php }?>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php $i++; } ?>
                        </tbody>
                    </table>
                    <?php } ?>
                </div>


                <div class="card-body">
                    <?php  if(count($extra_services_booking_payment_details_all) > 0 ) 
                    { ?>
                    <label style="color:blue;">Extra Services Payment Transaction Details :-</label>
                    <label>Extra Services Total Amount :- <?php echo $extra_services_total_amount;?></label>
                    <table id="" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                        <th>SN</th>
                        <th>Payment Date</th>
                        <th>Extra Services Name</th>
                        <th>Paid Amount</th>
                        <th>Pending Amount</th>
                        <th>Transaction Type</th>
                        <th>UPI No/Acc No</th>
                        <th>Payment Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  
                        
                        $i=1; 
                        foreach($extra_services_booking_payment_details_all as $info) 
                        // print_r($info);
                        { 

                          $particular_extra_services_pending_amt = $info['services_amt'] - $info['customer_sending_amt'];
                        ?>
                        <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo date("d-m-Y",strtotime($info['created_at'])) ?></td>
                        <td><?php echo $info['service_name'] ?> - <?php echo $info['services_amt'] ?></td>
                        <td><?php echo $info['customer_sending_amt'] ?></td>
                        <td><?php echo $info['perticular_pending_amt'] ?></td>
                        
                        <td>
                        <?php if($info['select_transaction']== 'CASH' || $info['select_transaction']== 'UPI' || $info['select_transaction']== 'QR Code' || $info['select_transaction']== 'Cheque' || $info['select_transaction']== 'Net Banking' || $info['select_transaction']== 'Demand Draft'){
                                echo $info['select_transaction']; ?> 
                        <?php }else{
                                echo $info['payment_now_later'] ?>
                        <?php } ?>
                        </td>
                        
                        <td>
                            <?php if($info['select_transaction'] == 'UPI'){
                            echo $info['UPI_transaction_no'];
                            ?>
                            <?php }else if($info['select_transaction'] == 'QR Code'){
                            echo $info['QR_transaction_no'];
                            ?>
                            <?php } else if($info['select_transaction'] == 'Cheque'){
                            echo $info['cheque'];    
                            ?>
                            <?php } else if($info['select_transaction'] == 'Net Banking'){
                            echo $info['account_number'];
                            ?>
                            <?php } else if($info['select_transaction'] == 'Demand Draft'){
                            echo $info['demand_draft_number'];
                            ?>
                            <?php }else{
                            echo '-';
                            ?>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if($info['payment_type']== 'Advance' || $info['payment_type']== 'Part' || $info['payment_type']== 'Full'){
                                echo $info['payment_type']; ?>
                            <?php } else{ 
                                echo $info['payment_reason']; ?>
                            <?php } ?>
                        </td>
                        </tr>
                        <?php $i++; } ?>
                        </tbody>
                    </table>
                    <?php } ?>
                </div>

                <!-- <div class="card-footer">
                <a href="<?php //echo $module_url_booking_process; ?>/index"><button type="button" class="btn btn-danger" >Cancel</button></a>
                </div> -->
              <!-- /.card-header -->
              <!-- form start -->
                
            
            <!-- /.card -->

                                            

                <!-- <div class="card-footer"> -->
                    <!-- <button type="submit" class="btn btn-primary" name="submit" value="submit">Save & Close</button> -->
                    
                    <!-- <a onclick="return confirm('Are You Sure You Want Save This Record?')"><button type="submit" class="btn btn-warning" name="submit_back_preview" value="submit_back_preview" id="submit_back_preview">Back</button></a> -->
                    <!-- <a onclick="return confirm('Are You Sure You Want Save This Record?')" href="<?php //echo $module_url_path_back; ?>/add_bus/<?php //echo $enquiry_id; ?>"><button type="button" class="btn btn-warning" name="submit_back_preview" value="submit_back_preview" id="submit_back_preview">Back</button></a> -->
                    <!-- <a href="<?php //echo $module_url_path_back; ?>/add_bus/<?php //echo $enquiry_id; ?>/1"><button type="button" class="btn btn-warning" name="back_btn">Back</button></a> -->
                <!-- </div> -->
            </div>
            </form>
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
  

<!-- Modal -->
<div class="modal fade" id="exampleModal_send" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form method="post" action="<?php echo $module_url_path;?>/edit" enctype="multipart/form-data">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SRS form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12 mb-2">
                    <div class="form-group">
                    <label>Upload SRS Image / PDF</label><br>
                    <?php foreach($traveller_booking_info as $traveller_booking_info_value) 
                    { ?>
                    <input type="hidden" class="form-control" name="enquiry_id" id="enquiry_id" value="<?php echo $traveller_booking_info_value['domestic_enquiry_id']?>">
                    <?php } ?>
                    <input type="file" name="image_name" id="image_nam">
                    <br><span class="text-danger">Please select only JPG,PNG,JPEG,PDF format files.</span>
                    <br>
                    <span class="text-danger" id="img_size" style="display:none;">Image Size Should Be Less Than 2 MB.</span>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label class="col-form-label">Comment:</label>
                  <textarea class="form-control" name="srs_remark" id="srs_remark"></textarea>
                  
                </div>
              </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary d-flex justify-content-center" id="submit" name="submit" value="send">Send</button>
            </div> -->
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary d-flex justify-content-center" id="submit_doc" name="submit_doc" value="send">Send</button>
      </div>
    </div>

    </form>
  </div>
</div>

<script>
    function show1(){
    document.getElementById('extra_services_div1').style.display = 'none';
    document.getElementById('extra_services_div2').style.display ='none';
    }
    function show2(){
    document.getElementById('extra_services_div1').style.display = 'block';
    document.getElementById('extra_services_div2').style.display = 'block';
    }
</script>

<script>
  var exampleModal = document.getElementById('exampleModal')
  exampleModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = exampleModal.querySelector('.modal-title')
    var modalBodyInput = exampleModal.querySelector('.modal-body input')

    modalTitle.textContent = 'Transaction Information ' + recipient
    modalBodyInput.value = recipient
})
</script>
