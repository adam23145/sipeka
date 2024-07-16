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
			url: baseURL + "history/form_detail_sempro/data_status",
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
			"data" : "tgl_bimbingan"
		},
		{
			"data" : "status_bimb"
		},
		{
			"data" : "keterangan_bimbingan"
		},
		{
			"data" : "upd"
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
		var baseURL 	= "<?php echo base_url().'history/form_detail_sempro/get_dokumen';?>";
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
						var fileID 		= data[i].id;
						var dokumen 	= data[i].dokumen;
						var filedok 	= data[i].file_dok;
						var filepath	= data[i].filepath;

						if(filepath=='none'){
							filepath = 'document/files/';
						}

						var link 		= baseRoot + filepath + filedok;

						tabcontent += '<div id="document-list"><a class="btn btn-info btn-block" href="'+link+'">'+dokumen+'</a></div>';
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

	jQuery(document).ready(function($) {
		loadDocument();
		var lepel = $('#lepel').val();
		var loker = $('#loker').val();
		// alert(lepel)
		if(lepel!==loker){
			$('#judul').attr('disabled', true);
			$('#rumusah_masalah').attr('disabled', true);
			$('#urgensi').attr('disabled', true);
			$('#btn-submit').attr('disabled', true);
		}
	});

</script>