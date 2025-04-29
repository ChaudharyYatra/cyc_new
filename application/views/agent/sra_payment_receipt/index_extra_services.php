<head>
<!-- <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script> -->
  <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script> -->
<!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
</head>
<style>
  .box-color{
    background-color:#ffb6c14d;
  }
  .h-color{
    color:#e50000e8;
    text-align:center;
  }
  .receipt{
    background-color: white;
    color:#e50000e8;
    letter-spacing: 3px;
    border-radius:5px;
    font-weight: bold;
  }
  .amt-css{
    background-color: white;
    border-radius:5px;
  }
  .rupees{
    color:#e50000e8;
    padding: 5px;
    margin-right:30px;
  }
  /* .box-info{
    background-color:white;
    margin-left: 10px; 
    margin-right:10px !important;
    width: 98%;
  } */
  .section-css{
    padding:20px;
    margin-left: 25px;
    /* margin:10px; */
  }
  .rupees_css{
    margin-top: 17%;
  }
  .border{
    border: 2px solid #e50000e8 !important;
    border-radius: 5px;
    width: 100%;
    margin-top:50px !important;
    margin-bottom: 50px !important;
  }
  .input_css{
    height:30px;
  }
  /* #invoice {
            background-color: #f2f2f2;
            /* padding: 20px; */
            /* border: 1px solid #ccc; */
            /* margin: 20px; */
        /* } */
.form{
    width: 100%;
}

.table-custom th, .table-custom td {
    border: 1px solid darksalmon; /* Border thickness and color */
}
</style>

<style>
    @media print {
        .h-color{
            color:green !important;
        }
    }
</style>

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
              <!-- <a href="<?php //echo $module_url_path; ?>/add"><button class="btn btn-primary">Add</button></a> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div id="invoicee">
    <section class="section-css">
        <div class="container form" id="invoice">
            <div class="row border box-color">
                <div class="col-md-12">
                    <div class="mt-4">
                        <h5 class="h-color">CHOUDHARY YATRA COMPANY PVT.LTD.</h5>
                        <p class="text-center"><b>Reg No.</b> 17-88888888  <b>Corp.Office :</b>Tirupatil Apt. Nandini Nadi Road, Nr. Gaikwad Sabhagruh, Bhabha Nagar, Nashik Mo.7588 48 48 48</p>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-1">
                        <h6 class="ml-4">Branch:</h6>
                    </div>
                    <div class="col-md-4">
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo $extra_details_payment_receipt['agent_name']; ?>">
                    </div>
                    <div class="col-md-4">
                        <h3 class="receipt text-center"><b> Credit Voucher </b></h3>
                    </div>
                    <div class="col-md-1">
                    <h6>Date:</h6>
                    </div>
                      <div class="col-md-2">
                      <?php if($extra_details_payment_receipt['select_transaction'] == 'CASH'){?>
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo date("d/m/Y",strtotime($extra_details_payment_receipt['created_at'])); ?>">
                      <?php } else if($extra_details_payment_receipt['select_transaction'] == 'UPI'){ ?>
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo date("d/m/Y",strtotime($extra_details_payment_receipt['upi_transaction_date'])); ?>">
                      <?php } else if($extra_details_payment_receipt['select_transaction'] == 'QR Code'){ ?>
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo date("d/m/Y",strtotime($extra_details_payment_receipt['qr_transaction_date'])); ?>">
                      <?php } else if($extra_details_payment_receipt['select_transaction'] == 'Cheque'){ ?>
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo date("d/m/Y",strtotime($extra_details_payment_receipt['drawn_on_date'])); ?>">
                      <?php } else if($extra_details_payment_receipt['select_transaction'] == 'Net Banking'){ ?>
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo date("d/m/Y",strtotime($extra_details_payment_receipt['netbanking_date'])); ?>">
                      <?php } else if($extra_details_payment_receipt['select_transaction'] == 'Demand Draft'){ ?>
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo date("d/m/Y",strtotime($extra_details_payment_receipt['demand_draft_date'])); ?>">
                      <?php } ?>
                      </div>
                    <hr>
                </div>
                
                <table id="" class="table table-bordered table-custom">
                  <tr>
                    <th>Credit To.:</th>
                    <td>
                    <?php if($extra_details_payment_receipt['select_transaction'] == 'UPI'){ ?>
                      <?php if($extra_details_payment_receipt['UPI_holder_name'] == 'self'){ ?>
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo $extra_details_payment_receipt['agent_name']; ?>">
                      <?php }else if($extra_details_payment_receipt['UPI_holder_name'] != 'self'){ ?>
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo $extra_details_payment_receipt['full_name']; ?>">
                    <?php } ?>
                    <?php } else if($extra_details_payment_receipt['select_transaction'] == 'QR Code'){ ?>
                      <?php if($extra_details_payment_receipt['QR_holder_name'] == 'Self'){ ?>
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo $extra_details_payment_receipt['agent_name']; ?>">
                      <?php }else if($extra_details_payment_receipt['QR_holder_name'] != 'Self'){ ?>
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo $extra_details_payment_receipt['full_name']; ?>">
                    <?php } ?>
                    <?php } else if($extra_details_payment_receipt['select_transaction'] == 'Cheque'){ ?>
                      <?php if($extra_details_payment_receipt['name_on_cheque'] == 'self'){ ?>
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo $extra_details_payment_receipt['agent_name']; ?>">
                      <?php }else if($extra_details_payment_receipt['name_on_cheque'] != 'self'){ ?>
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo $extra_details_payment_receipt['full_name']; ?>">
                    <?php } ?>
                    <?php } else if($extra_details_payment_receipt['select_transaction'] == 'Net Banking'){ ?>
                      <?php if($extra_details_payment_receipt['net_banking_acc_holder_nm'] == 'self'){ ?>
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo $extra_details_payment_receipt['agent_name']; ?>">
                      <?php }else if($extra_details_payment_receipt['net_banking_acc_holder_nm'] != 'self'){ ?>
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo $extra_details_payment_receipt['full_name']; ?>">
                    <?php } ?>
                    <?php } else if($extra_details_payment_receipt['select_transaction'] == 'Demand Draft'){ ?>
                      <?php if($extra_details_payment_receipt['demand_draft_name'] == 'self'){ ?>
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo $extra_details_payment_receipt['agent_name']; ?>">
                      <?php }else if($extra_details_payment_receipt['demand_draft_name'] != 'self'){ ?>
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo $extra_details_payment_receipt['full_name']; ?>">
                    <?php } ?>
                    <?php } else if($extra_details_payment_receipt['select_transaction'] == 'CASH'){ ?>
                      <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo $extra_details_payment_receipt['agent_name']; ?>">
                    <?php } ?>
                    </td>
                    <th>Code No.:</th>
                    <td>
                        <input type="text" readonly class="form-control input_css" name="enq_seat_count" id="enq_seat_count" value="<?php echo $extra_details_payment_receipt['extra_services_count']; ?>">
                    </td>
                  </tr>
                  <tr>
                  <th>Sr No.:</th>
                  <th colspan="2">Extra Services Name.:</th>
                  <th>Amount Rs.:</th>
                  </tr>
                  <?php
                    $i=1;
                    foreach($extra_name_amount_payment_receipt as $extra_name_amount_payment_receipt_value) 
                    { 
                  ?>
                  <tr>
                  <td><?php echo $i;?></td>
                  <td colspan="2"><?php echo $extra_name_amount_payment_receipt_value['service_name'];?></td>
                  <td><?php echo $extra_name_amount_payment_receipt_value['customer_sending_amt'];?></td>
                  </tr>
                  <?php $i++;} ?>

                  <tr>
                  <th></th>
                  <th colspan="2">Total Amount</th>
                  <td><?php echo $total_customer_sending_amt;?> </td> 
                  </tr>

                  <tr>
                  <th>Rs.</th>
                  <th colspan="3" style='text-transform:capitalize'><?php echo $pay; ?>only</th>
                  </tr>
                  
                </table>
                
                <div class="row">
                    <div class="col-md-6 mt-5 mb-2 text-center">
                        <h6>Depositors Signature & Name</h6>
                    </div>
                    <div class="col-md-6 mt-5 mb-2 text-center">
                        <h6>Receivers Signature & Name</h6>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h5>Verified By </h5>
                    </div>
                    <div class="col-md-8">
                        <h6><?php echo $extra_details_payment_receipt['agent_name']; ?></h6>
                    </div>
                    <div class="col-md-1">
                        <h5>Director</h5>
                    </div>
                </div>
            </div>
            <!-- <?php //} ?> -->
        </div>
        <div class="card-footer">
        <!-- <input type="button" id="create_pdf" value="Generate PDF">  -->
        <button class="btn btn-primary" id="download"> download pdf</button>
        <?php //if($payment_receipt['pending_amt'] == '0'){?> 
            <a href="<?php echo $sra_payment_record;?>/index"><button type="submit" class="btn btn-success float-right" name="submit" value="submit">Final Submit</button> 
        <?php //} ?>
        <?php //}else{ ?>
            <!-- <a href="<?php //echo $sra_payment_record;?>/index"><button type="submit" class="btn btn-success float-right" name="submit" value="submit">Final Submit</button>  -->
        <?php //} ?>
            <!-- <button class="btn btn-success" onclick="generatePDF()">Generate Invoice</button> -->
        </div>
    </section>
    </div>
    <!-- /.content -->
  </div>

  <!-- <script>
    function generatePDF() {
        const element = document.getElementById('invoice');
        html2pdf()
            .from(element)
            .save();

    }
</script> -->

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>  
<script>
$(document).ready(function () {  
    var form = $('.form'),  

    cache_width = form.width(),  
    a4 = [595.28, 842.89]; // for a4 size paper width and height  

    $('#create_pdf').on('click', function () {  
        $('body').scrollTop(0);  
        createPDF();  
    });  
    
    function createPDF() {  
        getCanvas().then(function (canvas) {  
            var  
             img = canvas.toDataURL("image/png"),  
             doc = new jsPDF({  
                orientation: 'landscape',
                 unit: 'px',  
                 format: 'a4'  
             });  
            doc.addImage(img, 'JPEG', 20, 20);  
            doc.save('Choudhary Yatra Payment Receipt.pdf');  
            form.width(cache_width);  
        });  
    }  
      
    function getCanvas() {  
        form.width((a4[0] * 1.33333)).css('max-width', 'none');  

        return html2canvas(form, {  
            imageTimeout: 2000,  
            removeContainer: true  
        });  
    }
});
</script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

<script>
    window.onload = function () {
    document.getElementById("download")
        .addEventListener("click", () => {
            const invoice = this.document.getElementById("invoice");
            console.log(invoice);
            console.log(window);
            var opt = {
                margin: 1,
                filename: 'myfile.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 1 },
                jsPDF: { unit: 'cm', format: 'a4', orientation: 'landscape' }
            };
            html2pdf().from(invoice).set(opt).save();
        })
}
</script>

</body>
</html>
