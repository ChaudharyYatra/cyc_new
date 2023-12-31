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
              <form method="post" enctype="multipart/form-data" id="add_prospect">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                    <label>Upload prospect PDF</label><br>
                    <input type="file" name="image_name" id="prospect_pdf" accept="application/pdf" required="required">
                    <br><span class="text-danger">Please upload only PDF files.</span>
                    <br><span class="text-danger" id="pdf_format" style="display:none;">You selected wrong format file.</span>
                  </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Upload Rate Chart PDF</label><br>
                        <input type="file" name="rate_chart_pdf" id="rate_chart_pdf" accept="application/pdf" required="required">
                        <br><span class="text-danger">Please upload only PDF files.</span>
                        <br><span class="text-danger" id="pdf_format" style="display:none;">You selected wrong file format.</span>
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
  