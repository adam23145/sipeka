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

	$("#table-bimbingan").DataTable({
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
			url: baseURL + "skripsi/bimbingan/get_new_bimbingan",
			type: "POST",
			data: function(d){
				d.token		 	= "<?php echo $this->security->get_csrf_hash(); ?>";
			}
		},
		columns: [{
			"data": "id"
		},
		{
			"data" : "student_name"
		},
		{
			"data" : "nim"
		},
		{
			"data" : "tgl_sempro"
		},
		{
			"data" : "url_judulbimbingan"
		},
		{
			"data" : "submission_status"
		},
		{
			"data" : "action"
		},
		{
			"data" : "submission_code"
		},
		{
			"data" : "title"
		},
		{
			"data" : "dosbing"
		}
		],
		columnDefs : [
	        { 'visible': false, 'targets': [7,8,9] }
	    ],
		rowCallback: function (row, data, iDisplayIndex) {
			var info 	= this.fnPagingInfo();
			var page 	= info.iPage;
			var length 	= info.iLength;
			var index 	= page * length + (iDisplayIndex + 1);
			$('td:eq(0)', row).html(index);
		},
	});

	function reloadTable(){
		var table = $("#table-bimbingan").DataTable();
		table.ajax.reload();
	}

	$('#table-bimbingan').on('click', '.btn-proses', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#table-bimbingan').DataTable().row(currentRow).data();
		id 					= data['id'];
		student_name 		= data['student_name'];
		nim 				= data['nim'];
		submission_code		= data['submission_code'];
		title				= data['title'];
		dosbing				= data['dosbing'];
		var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
    		csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

		$.ajax({
			url: baseURL + 'skripsi/bimbingan/insert',
			type: 'POST',
			data: {submission_code:submission_code, nim:nim, title:title, dosbing:dosbing, id:id, [csrfName]: csrfHash},
			dataType: 'JSON',
			success: function(data){
				reloadTable();
				swal({
					type: 'success',
					title: 'Success',
					text: data.feedback,
					timer:500
				});
			},
			error: function(){
				sys_err();
			}
		});
	});

	// function insertbimbingan(student_name, nim, submission_code, title, dosbing){
	// 	// csRF 				= "<?php echo $this->security->get_csrf_hash(); ?>";
	// 	$.ajax({
	// 		url: baseURL + 'skripsi/bimbingan/insert',
	// 		type: 'POST',
	// 		data: {submission_code:submission_code, nim:nim, title:title, dosbing:dosbing, csRF:"{{ csrf_token() }}"  },
	// 		dataType: 'JSON',
	// 		success: function(data){
	// 			reloadTable();
	// 			swal({
	// 				type: 'success',
	// 				title: 'Success',
	// 				text: data.feedback,
	// 				timer:500
	// 			});
	// 		},
	// 		error: function(){
	// 			sys_err();
	// 		}
	// 	});
	// }

</script>