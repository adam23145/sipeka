<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('__partials/head') ?>
  </head>
  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
      <!-- Navbar -->
       <?php $this->load->view('__partials/header') ?>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      	<?php $this->load->view('__partials/sidebar-left') ?>
      <!-- End Main Sidebar Container-->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <!-- <h1 class="m-0 text-dark">Dashboard v2</h1> -->
              </div>
              <div class="col-sm-6">
                <?php echo $this->breadcrumb->show() ?>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <?php $this->load->view($thisContent) ?>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      <!-- <?php $this->load->view('__partials/footer') ?> -->
      <!--END Main Footer-->
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <?php $this->load->view('__partials/js') ?>
    <?php $this->load->view($thisJs) ?>
  </body>
</html>
