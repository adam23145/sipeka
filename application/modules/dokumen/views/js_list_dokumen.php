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

	$("#table-dokumen").DataTable({
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
			url: baseURL + "dokumen/list_dokumen/data_submission",
			type: "POST",
			data: function(d){
				d.token		 	= "<?php echo $this->security->get_csrf_hash(); ?>";
			}
		},
		columns: [{
			"data": "id"
		},
		{
			"data" : "title"
		},
		{
			"data" : "dokumen"
		},
		{
			"data" : "lup"
		},
		{
			"data" : "action"
		},
		{
			"data" : "submission_code"
		},
		{
			"data" : "nim"
		},
		{
			"data" : "file_dok"
		},
		{
			"data" : "filepath"
		}
		],
		columnDefs : [
	        { 'visible': false, 'targets': [5,6,7,8] }
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
		var table = $("#table-dokumen").DataTable();
		table.ajax.reload();
	}

	$('#table-dokumen').on('click', '.btn-view', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#table-dokumen').DataTable().row(currentRow).data();
		fid 				= data['id'];
		dokumen 			= data['dokumen'];
		submission_code 	= data['submission_code'];
		fnim 				= data['nim'];
		fjudul 				= data['title'];
		file_dok 			= data['file_dok'];
		filepath 			= data['filepath'];

		// alert(dokumen);
		

		if(dokumen==='Cetak form kesediaan menjadi dosen pembimbing'){
			control			= 'data_pdf/pdf001?subcd=';
		}else if(dokumen==='Berita Acara Siap Diujikan Sempro'){
			control			=  'data_pdf/pdf002?subcd=';
		}else if(dokumen==='Surat Kelayakan Sempro'){
			control			=  'data_pdf/pdf005?subcd=';
		}else if(dokumen==='Berita Acara Bimbingan Skripsi'){
			control			=  'data_pdf/pdf003?subcd=';
		}else if(dokumen==='Form Siap Diujikan Sidang'){
			control			=  'data_pdf/pdf004?subcd=';
		}else if(dokumen==='File Berita Acara Sempro' || dokumen==='File Seminar Proposal'|| dokumen==='File Seminar Proposal '|| dokumen===' File Seminar Proposal '|| dokumen===' File Seminar Proposal'){
			window.location.replace("<?php echo base_url()?>"+filepath+file_dok);
		}
		
		
		$.ajax({
			url: baseURL + 'form/form_detail/get_pdf',
			type: 'POST',
			data: {token: "<?php echo $this->security->get_csrf_hash(); ?>",fid:fid,fnim:fnim,fjudul:fjudul},
			dataType: "JSON",
			success: function (data) {
				// if(data.totaljour==0){
				// 	alert('data tidak ditemukan');
				// }else if(data.totaljour>0){
					var aba = btoa(data.submission_code);
					window.location.replace("<?php echo base_url()?>"+control+aba, '_blank');
				// }
			}
		});

	});

	$('#form-skripsi').submit(function(e){
		e.preventDefault();
		$('#btn-submit').attr('disabled',true);
		$.ajax({
			url: baseURL + 'history/historis/save',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON',
			success: function(data){
				reloadTable();
				$('#modalhistory').modal('hide');
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

</script>