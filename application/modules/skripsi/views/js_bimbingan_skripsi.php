<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.jqueryui.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

<script type="text/javascript">

	$("#jurusan").change(function(event) {
		var ds 	= $('#jurusan :selected').val();
		$('#jrsn').val(ds);
	});

	$(document).ready(function(){

		  $( "#datepicker").datepicker({
			    dateFormat: 'yy-mm-dd',
			    changeMonth:true,
			    format: 'yyyy-mm-dd',
			    changeYear:true,
			    todayHighlight: true,
			    autoclose: true,
			    endDate: new Date
			}).on('keypress', function(e){ e.preventDefault(); });

		  $( "#datepicker2").datepicker({
			    dateFormat: 'yy-mm-dd',
			    changeMonth:true,
			    format: 'yyyy-mm-dd',
			    changeYear:true,
			    todayHighlight: true,
			    autoclose: true,
			    endDate: new Date
			}).on('keypress', function(e){ e.preventDefault(); });
	});


	$('#form-search-report').on('submit', function(e) {
		
		e.preventDefault();

		$('#card-table-skripsi').hide();

		var table = $("#table-skripsi").DataTable();
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


	var table = $("#table-skripsi").DataTable({
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
		searching: false,
		ajax: {
			url: baseURL + "skripsi/histori_bimbingan_skripsi/data_detail",
			type: "POST",
			data: function(d){
				d.date1 		= $('#datepicker').val();
				d.date2 		= $('#datepicker2').val();
				d.jrsn 			= $('#jrsn').val();
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
			"data" : "student_name"
		},
		{
			"data" : "jurusan"
		},
		{
			"data" : "title"
		},
		{
			"data" : "url_judulbimbingan"
		},
		{
			"data" : "awalbimbingan"
		},
		{
			"data" : "terakhirbimbingan"
		},
		{
			"data" : "dosbing"
		},
		{
			"data" : "namados"
		},
		{
			"data" : "keterangan_bimbingan"
		},
		{
			"data" : "status_bimb"
		}
		],
		lengthChange: true,
		lengthMenu: [[10, 50, 100, 1000], [10, 50, 100, 1000]],
		buttons: [
		{
			extend: 'excelHtml5',
			messageTop: function(){
				return 'Daftar Judul :'+ $('#datepicker').val() + ' to ' + $('#datepicker2').val()
			},
			exportOptions: {
				columns: [0,1,2,3,4,5,6,7,8,9,10,11]
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

</script>