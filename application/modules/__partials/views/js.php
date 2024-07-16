   <!-- jQuery -->
<script src="<?php echo base_url();?>public/assets/vendors/js/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url();?>public/assets/vendors/js/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url();?>public/assets/vendors/js/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- SweetAlert2 -->
<!-- <script src="<?php echo base_url();?>public/assets/vendors/js/sweetalert2/sweetalert2.min.js"></script> -->
<!-- Toastr -->
<!-- <script src="<?php echo base_url();?>public/assets/vendors/js/toastr/toastr.min.js"></script> -->
<script src="<?php echo base_url();?>public/assets/vendors/js/moment/moment.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?php echo base_url();?>public/assets/vendors/js/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url();?>public/assets/vendors/js/select2/js/select2.full.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<!-- ================== SWEET ALERT SCRIPTS ==================-->
<script src="<?php echo base_url();?>public/assets/vendors/js/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="<?php echo base_url();?>public/assets/vendors/js/sweetalert2.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>public/assets/vendors/js/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>public/assets/vendors/js/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>public/assets/vendors/js/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>public/assets/vendors/js/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>public/assets/core/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?php echo base_url();?>public/assets/core/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?php echo base_url();?>public/assets/vendors/js/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?php echo base_url();?>public/assets/vendors/js/raphael/raphael.min.js"></script>
<script src="<?php echo base_url();?>public/assets/vendors/js/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?php echo base_url();?>public/assets/vendors/js/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url();?>public/assets/vendors/js/chart.js/Chart.min.js"></script>
<!-- jautocalc -->
<script src="<?php echo base_url();?>public/assets/vendors/js/jautocalc/jautocalc.min.js"></script>

<!-- PAGE SCRIPTS -->
<!-- <script src="<?php echo base_url();?>public/assets/core/js/pages/dashboard2.js"></script> -->
    <!-- END PAGE LEVEL JS-->

<script type="text/javascript">
	// Toast Notification
    // $(window).load(function() {
    //     setTimeout(function() {
    //         Materialize.toast('<span>Hiya! I am a toast.</span>', 1500);
    //     }, 3000);
    //     setTimeout(function() {
    //         Materialize.toast('<span>You can swipe me too!</span>', 3000);
    //     }, 5500);
    //     setTimeout(function() {
    //         Materialize.toast('<span>You have new order.</span><a class="btn-flat yellow-text" href="#">Read<a>', 3000);
    //     }, 18000);
    // });

	var baseURL = '<?php echo base_url();?>';

	function errorTraditional(){
		alert("Ada kesalahan sistem");
	}

	function sys_err(){
		Swal.fire({
			type: 'error',
			title: 'Oops...',
			text: 'Something went wrong!'
		});
	}

	function alert_err(text){
		Swal.fire({
			type: 'error',
			title: 'Oops...',
			text: text
		});
	}

	function swalLoading(){
		Swal({
			title: 'Please wait . . .',
			allowOutsideClick: false,
			onBeforeOpen: () => {
				Swal.showLoading()
			}
		});
	}
</script>