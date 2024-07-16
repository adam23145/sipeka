<script type="text/javascript">

	jQuery(document).ready(function($){
		$('#addprodi').hide();
		$('#edprodi').hide();
	});

	$('#btnTambah').on('click', function() {
     	$('#modalProdi').modal('show'); 
     	$('#addprodi').show();
		$('#edprodi').hide();
  	});
	
	$('#btnUpload').on('click', function() {
     	$('#modalUpload').modal('show'); 
  	});

	$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
		return {
			"iStart": oSettings._iDisplayStart,
			"iEnd": oSettings.fnDisplayEnd(),
			"iLength": oSettings._iDisplayLength,
			"iTotal": oSettings.fnRecordsTotal(),
			"iFilteredTotal": oSettings.fnRecordsDisplay(),
			"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
			"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
		};
	};

	$("#tableSempro").DataTable({
		initComplete: function () {
			var api = this.api();
			$('#mytable_filter input')
			.off('.DT')
			.on('keyup.DT', function (e) {
				if (e.keyCode == 13) {
					api.search(this.value).draw();
				}
			});
		},
		oLanguage: {
			sProcessing: "loading..."
		},
		processing: true,
		serverSide: true,
		paging: true,
		lengthChange: false,
		searching: true,
		ordering: true,
		info: true,
		autoWidth: false,
		responsive: false,
		// lengthChange: false,
		ajax: {
			url: baseURL + "data_master/data_update_skripsi/list_data",
			type: "POST",
			data: function(d){
				d.token		 	= "<?php echo $this->security->get_csrf_hash(); ?>";
				d.res_prodi		= $('#res_prodi').val();
			}
		},
		columns: [{
			"data": "no_urut",
			"searchable" : false
		},
		{
			"data" : "submission_code"
		},
		{
			"data" : "nim",
			"searchable" : false
		},
		{
			"data" : "student_name"
		},
		{
			"data" : "title"
		},
		{
			"data" : "url_judulbimbingan"
		},
		{
			"data" : "status_bimb"
		},
		{
			"data" : "dosbing",
			"searchable" : false
		},
		{
			"data" : "nama"
		},
		{
			"data" : "action",
			"searchable" : false
		},
		{
			"data" : "id",
			"searchable" : false
		},
		{
			"data" : "submission_status",
			"searchable" : false
		},
		{
			"data" : "loker",
			"searchable" : false
		}
		],
		columnDefs : [
	        { 'visible': false, 'targets': [10,11,12] },
	    ],
		rowCallback: function (row, data, iDisplayIndex) {
			var info = this.fnPagingInfo();
			var page = info.iPage;
			var length = info.iLength;
			var index = page * length + (iDisplayIndex + 1);
			$('td:eq(0)', row).html(index);
		},
	});

	function reloadTable(){
		var table = $("#tableSempro").DataTable();
		table.ajax.reload();
	}

	$('#tableSempro').on('click', '.btn-edit', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableSempro').DataTable().row(currentRow).data();
		id 					= data['id'];
		submission_code		= data['submission_code'];
		nim					= data['nim'];
		student_name		= data['student_name'];
		jdlskrip 			= data['title'];
		nama 				= data['nama'];
		status_bimb 		= data['status_bimb'];
		submission_status 	= data['submission_status'];
		loker 				= data['loker'];

		$('#id').val(id);
		$('#submission_code').val(submission_code);
		$('#nim').val(nim);
		$('#student_name').val(student_name);
		$('#jdlskrip').val(jdlskrip);
		$('#namapembimbing').val(nama);
		$('#status_bimb').val(status_bimb);
		$('#loker').val(loker);
		$('#submission_status').val(submission_status);
		$('#modalProdi').modal('show');
		$('#addprodi').hide();
		$('#edprodi').show();
	});

	$('#modalProdi').on('hidden.bs.modal', function (){
		$('#form-editProdi')[0].reset();
	});	
	
	$('#form-editProdi').submit(function(e){
		e.preventDefault();
		$('#btn-submit').attr('disabled',true);
		$.ajax({
			url: baseURL + 'data_master/data_update_skripsi/save',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON',
			success: function(data){
				reloadTable();
				$('#modalProdi').modal('hide');
				swal({
					type: 'success',
					title: 'Success',
					text: data.feedback,
					timer:500
				});
				$('#btn-submit').attr('disabled', false);
			},
			error: function(){
				sys_err();
				$('#btn-submit').attr('disabled', false);
			}
		});
	});

	$("#pembimbingbaru").change(function(event) {
		var ds 	= $('#pembimbingbaru :selected').val();
		$('#pembimbbar').val(ds);
	});
	
	$("#pembimbingbaru").change(function(event) {
		var sd 	= $('#pembimbingbaru :selected').text();
		$('#nampembimbbar').val(sd);
	});

</script>