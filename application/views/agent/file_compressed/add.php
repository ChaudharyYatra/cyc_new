<style>
  .hide {
    display: none;
    }
  .search_btn{
    margin-top: 20px;
    }

        .container {
            width: 80%;
            max-width: 1200px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }

        #drop-area {
            border: 2px dashed #007bff;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 2px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin: 20px auto;
            display: block;
            width: 200px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .thumbnail {
            width: 80%;
            height: 70%;
            object-fit: cover;
        }

        .thumbnail-card {
            position: relative;
            width: 150px;
            height: 200px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            display: inline-block;
            cursor: grab;
            margin: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .thumbnail-card:hover {
            transform: scale(1.05);
        }
</style>

<script src="https://cdn.jsdelivr.net/npm/pdf-lib@1.15.0/dist/pdf-lib.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>
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
              <!--<a href="<?php //echo $module_url_path; ?>/index"><button class="btn btn-primary">Back</button></a>-->
              
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
              
                <div class="card-body">
                  <div class="row">
                </div>
                    <!-- <div class="col-md-6">
                    </div> -->

                    <!--  firstly payment fields -->
                    <div>
                    <form method="post" action="<?php echo base_url(); ?>agent/file_compressed/add" enctype="multipart/form-data">
                    <div class="container">
                        <h1>Compress PDF</h1>
                        <div id="drop-area">
                            <p>Click to select a file</p>
                            <input type="file" name="image_name" id="image_name" accept="application/pdf" style="display: none;">
                        </div>
                        <div id="fileDetails"></div>
                        <a href="<?php echo $module_url_path; ?>/add"><button id="compress" class="button">Compress PDF</button></a>
                        <a id="downloadLink" style="display: none;"></a>
                    </div>
                    </div>
                    <!--  firstly payment fields -->

                    <!--  Partially payment fields --> 
                    
                      <!--  Partially payment fields -->

                      <!--  Add On Services fields -->
                      
                    <!--  Add On Services fields -->

                      <!-- <div class="col-md-6">
                        <div class="form-group">
                          <label>Tour Type</label> <br>
                            <input type="radio" id="main_tour" name="tour_type" value="1" onclick="main();"/>
                                <label for="Yes" id="main_tour">Main Tour</label> &nbsp;&nbsp;
                            <input type="radio" id="sub_tour" name="tour_type" value="0" onclick="sub();"/>
                                <label for="No" id="sub_tour">Sub Tour</label> <br>
                        </div>
                      </div> -->
              </div>
                <!-- /.card-body -->
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
  

  <script>
        let selectedFile = null;

        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('image_name');
        const compressButton = document.getElementById('compress');
        const downloadLink = document.getElementById('downloadLink');
        const fileDetails = document.getElementById('fileDetails');

        dropArea.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', (e) => handleFile(e.target.files[0]));

        function handleFile(file) {
            if (file) {
                selectedFile = file;
                fileDetails.textContent = `Selected file: ${file.name} (${(file.size / 1024).toFixed(2)} KB)`;
            } else {
                fileDetails.textContent = 'No file selected.';
            }
        }

        async function compressPDF() {
            if (!selectedFile) {
                alert('Please select a PDF file to compress.');
                return;
            }

            compressButton.textContent = 'Compressing...';

            const pdfBytes = await selectedFile.arrayBuffer();
            const pdf = await PDFLib.PDFDocument.load(pdfBytes);

            // Use compression options
            const compressOptions = {
                objects: true,
                streams: true,
                info: true
            };
            const compressedPdfBytes = await pdf.save({
                compress: compressOptions
            });

            downloadLink.href = URL.createObjectURL(new Blob([compressedPdfBytes], {
                type: 'application/pdf'
            }));
            downloadLink.download = `compressed_${selectedFile.name}`;
            downloadLink.click();

            compressButton.textContent = 'Compress PDF';
        }

        compressButton.addEventListener('click', compressPDF);
    </script>
  





