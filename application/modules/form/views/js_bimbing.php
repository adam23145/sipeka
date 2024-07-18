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

	$("#table-logbim").DataTable({
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
		responsive: true,
		// lengthChange: false,
		ajax: {
			url: baseURL + "form/form_bimbingan/log_bimb",
			type: "POST",
			data: function(d){
				d.subcode		= $('#sub_code').val();
				d.token		 	= "<?php echo $this->security->get_csrf_hash(); ?>";
			}
		},
		columns: [{
			"data": "id"
		},
		{
			"data" : "bimbingan_ke"
		},
		{
			"data" : "keterangan_bimbingan"
		},
		{
			"data" : "status_bimb"
		},
		{
			"data" : "lup"
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

		  $( "#tanggal").datepicker({
			    dateFormat: 'yy-mm-dd',
			    changeMonth:true,
			    format: 'yyyy-mm-dd',
			    changeYear:true,
			    todayHighlight: true,
			    autoclose: true,
			    endDate: new Date
			}).on('keypress', function(e){ e.preventDefault(); });
	});

	$('#form-ba').submit(function(e){
		e.preventDefault();
		$("#tanggal").prop('required',true); 
		$("#sub_status").prop('required',true); 
		document.getElementById("sub_status").required;
		document.getElementById("beritaacara").required;

		$('#btn-submit').attr('disabled',true);
		$.ajax({
			url: baseURL + 'form/Form_bimbingan/save',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON',
			success: function(data){
				setTimeout(function(){
					Swal.fire({
						title: 'success',
						text: data.feedback,
						type: 'success',
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'Oke',
						allowOutsideClick: false,
					}).then((result) => {
						window.location.href = baseURL + "bimbingan/bimbingan_list";
					});
				}, 500);
				$('#btn-submit').attr('disabled', false);
			},
			error: function(){
				sys_err();
				$('#btn-submit').attr('disabled', false);
			}
		});
	});

	$("#sub_status").change(function(event) {
		var ds 	= $('#sub_status :selected').val();
		$('#stats').val(ds);
	});

</script>