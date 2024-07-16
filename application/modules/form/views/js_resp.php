<script type="text/javascript">
	$('#form-response').submit(function(e){
		e.preventDefault();
		$('#btn-submit').attr('disabled',true);
		$.ajax({
			url: baseURL + 'form/form_response/save',
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
						window.location.href = baseURL + "list/list_pengajuan/list_data/";
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

	$("#table-submstatus").DataTable({
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
			url: baseURL + "form/form_response/data_status",
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
			"data" : "submission_status"
		},
		{
			"data" : "loker"
		},
		{
			"data" : "keterangan_upd"
		},
		{
			"data" : "upd_by"
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

	jQuery(document).ready(function($) {
		var lepel = $('#lepel').val();
		var loker = $('#loker').val();
		if(lepel!==loker){
			$('#judul').attr('disabled', true);
			$('#rumusah_masalah').attr('disabled', true);
			$('#urgensi').attr('disabled', true);
			$('#btn-submit').attr('disabled', true);
		}

		$('#pilih_dsn').hide();
		$('#pilih_step').hide();
		$('#next_loker').hide();
	});

	$("#sub_status").change(function(event) {
		var v_status 	= $('#sub_status :selected').text();
		var v_lepel 	= $('#lepel').val();
		
		if(v_status!=='Terima'){
			$('#pilih_dsn').hide();
			$('#pilih_step').show();
			$('#next_loker').hide();

		}else if(v_status=='' || v_status=='-- Pilih Status --'){
			$('#pilih_dsn').hide();
			$('#pilih_step').hide();
			$('#next_loker').hide();
		}else{
			if(v_lepel==='Sekjur'){
				
				$('#pilih_dsn').hide();
				$('#pilih_step').hide();
				$('#next_loker').show();
				document.getElementById("loker_grp").value = "Kajur";
			}else if(v_lepel==='Kajur'){
				$('#pilih_dsn').hide();
				$('#pilih_step').hide();
				$('#next_loker').show();
				document.getElementById("loker_grp").value = "Dosen";
			}else{
				$('#pilih_dsn').show();
				$('#pilih_step').hide();
				$('#next_loker').show();
				document.getElementById("loker_grp").value = "Sekjur";
			}
			
		}

		$('#stats').val(v_status);
	});

	$("#kd_dosen").change(function(event) {
		var ds 	= $('#kd_dosen :selected').val();
		$('#dsen').val(ds);
	});

	$("#aksi_stat").change(function(event) {
		var dw 	= $('#aksi_stat :selected').val();
		$('#akstats').val(dw);
	});

</script>