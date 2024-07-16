<script type="text/javascript">
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

	$("#table-submission").DataTable({
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
		searching: false,
		ordering: true,
		info: true,
		autoWidth: false,
		responsive: false,

		ajax: {
			url: baseURL + "list/list_pengajuan/data_submission",
			type: "POST",
			data: function(d){
				d.data_sub 		= $('#data_sub').val();
				d.token		 	= "<?php echo $this->security->get_csrf_hash(); ?>";
			}
		},
		columns: [{
			"data": "id"
		},
		{
			"data" : "submission_code"
		},
		{
			"data" : "nim"
		},
		{
			"data" : "student_name"
		},
		{
			"data" : "jurusan"
		},
		{
			"data" : "title"
		},
		{
			"data" : "createddate"
		},
		{
			"data" : "action"
		},
		{
			"data" : "rms_maslh"
		},
		{
			"data" : "urgensi"
		},
		{
			"data" : "code_status"
		}
		],
		columnDefs : [
	        { 'visible': false, 'targets': [9,8,10] }
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
		var table = $("#table-submission").DataTable();
		table.ajax.reload();
	}

	$('#table-submission').on('click', '.btn-edit', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#table-submission').DataTable().row(currentRow).data();
		id 					= data['id'];
		submission_code 	= data['submission_code'];
		title 				= data['title'];
		rms_maslh 			= data['rms_maslh'];
		code_status 		= data['code_status'];
		// alert(code_status);

		if(code_status=='New'){
			var url = baseURL+'list/form_response/edit/'+submission_code;
		}else{
			var url = baseURL+'form/form_response/edit/'+submission_code;			
		}

		window.location.href=url;

		
	});

	// $('#form-submission').submit(function(e){
	// 	e.preventDefault();
	// 	$('#btn-submit').attr('disabled',true);
	// 	$.ajax({
	// 		url: baseURL + 'history/historis/save',
	// 		type: 'POST',
	// 		data: $(this).serialize(),
	// 		dataType: 'JSON',
	// 		success: function(data){
	// 			reloadTable();
	// 			$('#modalhistory').modal('hide');
	// 			swal({
	// 				type: 'success',
	// 				title: 'Success',
	// 				text: data.feedback,
	// 				timer:500
	// 			});
	// 			$('#btn-submit').attr('disabled', false);
	// 		},
	// 		error: function(){
	// 			sys_err();
	// 			$('#btn-submit').attr('disabled', false);
	// 		}
	// 	});
	// });

</script>