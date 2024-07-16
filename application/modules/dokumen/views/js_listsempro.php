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

	$("#table-sempro").DataTable({
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
		// lengthChange: false,

		ajax: {
			url: baseURL + "dokumen/list_sempro/data_sempro",
			type: "POST",
			data: function(d){
				d.token		 	= "<?php echo $this->security->get_csrf_hash(); ?>";
			}
		},
		columns: [{
			"data": "id"
		},
		{
			"data" : "nim"
		},
		{
			"data" : "title"
		},
		{
			"data" : "penguji"
		},
		{
			"data" : "tgl_sempro"
		},
		{
			"data" : "file_basempro"
		},
		{
			"data" : "file_proposal"
		}
		],
		// columnDefs : [
	 //        { 'visible': false, 'targets': [8] }
	 //    ],
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

		var url = baseURL+'form/form_detail/edit/'+submission_code;

		window.location.href=url;
	});

</script>