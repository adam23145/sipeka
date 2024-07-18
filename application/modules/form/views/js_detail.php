<script type="text/javascript">
	$('#form-editTitle').submit(function(e){
		e.preventDefault();
		$('#btn-submit').attr('disabled',true);
		$.ajax({
			url: baseURL + 'form/form_detail/save',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON',
			success: function(data){
				swal({
					type: 'success',
					title: 'Success',
					text: data.feedback,
					timer:500
				});
				$('#btn-submit').attr('disabled', false);
				var url = baseURL+'history/historis';
				window.location.href=url;
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
		ajax: {
			url: baseURL + "form/form_detail/data_status",
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
			"data" : "urgensi"
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

	

	function loadDocument(){
		var userid 	 	= $('#nim').val();
		var token		= "<?php echo $this->security->get_csrf_hash(); ?>";
		var baseURL 	= "<?php echo base_url().'form/form_detail/get_dokumen';?>";
		var baseRoot 	= "<?php echo base_url();?>";
		$.ajax({    
			type: "POST",  
			url: baseURL,
			data: {
				token:token,userid:userid
			},
			dataType: "JSON",  
			success: function(data){
				if (data.length>0) {
					var tabcontent = "";
					var i;
					for (i = 0; i < data.length; ++i) {
						var fileID 		= data[0].id;
						var dokumen 	= data[0].dokumen;
						var filedok 	= data[0].file_dok;
						var filepath	= data[0].filepath;
						var nim			= data[0].nim;
						var judul		= data[0].title;

						if(filepath=='none'){
							filepath = 'document/files/';
						}

						var link 		= baseRoot + filepath + filedok;

						tabcontent += '<form id="document-list" method="POST"><input required type="text" readonly hidden name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>"><input type="text" hidden id="fid" value="'+fileID+'" readonly="true"><input hidden type="text" id="fnim" value="'+nim+'" readonly="true"><input hidden type="text" id="fjudul" value="'+judul+'" readonly="true"><button id="btn-submit" type="submit" class="btn btn-info btn-block">'+dokumen+'</button></form>';
						// tabcontent += '<div id="document-list"><a class="btn btn-info btn-block" href="'+link+'">'+dokumen+'</a></div>';
					}
					$('#document-list').html(tabcontent);
					$('#document-room').fadeIn();
				} else {
					console.log("No attach...");
				}
			},
			error: function(){

			}
		});
	}

	$('#document-list').submit(function(e){
		e.preventDefault();
		$('#btn-submit').attr('disabled',true);
		var fid 	= $('#fid').val();
		var fnim 	= $('#fnim').val();
		var fjudul 	= $('#fjudul').val();

		$.ajax({
			url: baseURL + 'form/form_detail/get_pdf',
			type: 'POST',
			data: {token: "<?php echo $this->security->get_csrf_hash(); ?>",fid:fid,fnim:fnim,fjudul:fjudul},
			dataType: 'JSON',
			success: function(data){
				var aba = btoa(data.submission_code);
					window.location.replace("<?php echo base_url()?>data_pdf/pdf001?subcd="+aba);
			},
			error: function(){
				sys_err();
				$('#btn-submit').attr('disabled', false);
			}
		});
	});

	jQuery(document).ready(function($) {
		loadDocument();
		var lepel = $('#lepel').val();
		var loker = $('#loker').val();
		var sbst  = $('#sub_status').val();


		if(lepel !== loker || sbst === 'Ditolak' ){
			$('#judul').attr('disabled', true);
			$('#rumusah_masalah').attr('disabled', true);
			$('#urgensi').attr('disabled', true);
			$('#btn-submit').attr('disabled', true);
		}
	});

	function myFunction() {
	  $('#modalURL').modal('show');
	}

	$('#form-tambahURL').submit(function(e){
		e.preventDefault();
		$('#btn-submit').attr('disabled',true);
		$.ajax({
			url: baseURL + 'form/form_detail/save_url',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON',
			success: function(data){
				swal({
					type: 'success',
					title: 'Success',
					text: data.feedback,
					timer:500
				});
				$('#btn-submit').attr('disabled', false);
				var url = baseURL+'history/historis';
				window.location.href=url;
			},
			error: function(){
				sys_err();
				$('#btn-submit').attr('disabled', false);
			}
		});
	});

</script>