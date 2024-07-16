<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.jqueryui.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

<script type="text/javascript">

	$('#form-search-report').on('submit', function(e) {
		
		e.preventDefault();

		$('#card-table-skripsi').hide();

		var table = $("#tableSkripsi").DataTable();
		table.ajax.reload(function(){
			$('#card-table-skripsi').fadeIn();
		});
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


	var table = $("#tableSkripsi").DataTable({
		initComplete: function () {
			var api = this.api();
			$('#mytable_filter input')
			.off('.DT')
			.on('keyup.DT', function (e) {
				if (e.keyCode == 13) {
					api.search(this.value).draw();
				}
			});
			table.buttons().container()
			.appendTo('#disini');
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
		ajax: {
			url: baseURL + "data_master/data_skripsi/list_data",
			type: "POST",
			data: function(d){
				d.date1 		= $('#datepicker').val();
				d.token		= "<?php echo $this->security->get_csrf_hash(); ?>";
			}
		},
		columns: [{
			"data": "no_urut",
			"searchable" : false
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
			"data" : "submission_status"
		},
		{
			"data" : "dosbing"
		},
		{
			"data" : "nama"
		}
		],
		lengthChange: false,
		buttons: [
		{
			extend: 'excelHtml5',
			messageTop: function(){
				return 'List Skripsi';
			},
			exportOptions: {
				columns: [0,1,2,3,4,5,6,7]
			}
		}
		],
		rowCallback: function (row, data, iDisplayIndex) {
			var info = this.fnPagingInfo();
			var page = info.iPage;
			var length = info.iLength;
			var index = page * length + (iDisplayIndex + 1);
			$('td:eq(0)', row).html(index);
		},

	});

	$(document).ready(function(){

		$("#datepicker").datepicker({
		    format: "yyyy",
		    viewMode: "years", 
		    minViewMode: "years",
		    autoclose: true,
		}).on('keypress', function(e){ e.preventDefault(); });
	});

	

</script>