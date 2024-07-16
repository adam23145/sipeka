<script type="text/javascript">

	jQuery(document).ready(function($){
		$('#addmatkul').hide();
		$('#edmatkul').hide();
	});

	$('#btnTambah').on('click', function() {
     	$('#id').val(0); 
     	$('#modalMatkul').modal('show');
     	$('#addmatkul').show();
		$('#edmatkul').hide();
  	});
	
	$('#btnUpload').on('click', function() {
     	$('#modalUpload').modal('show'); 
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

	$("#tableMatkul").DataTable({
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
			url: baseURL + "data_master/data_matkul/list_data",
			type: "POST",
			data: function(d){
				d.token		 	= "<?php echo $this->security->get_csrf_hash(); ?>";
			}
		},
		columns: [{
			"data": "no_urut",
			"searchable" : false
		},
		{
			"data" : "id",
			"searchable" : false
		},
		{
			"data" : "kode_matkul"
		},
		{
			"data" : "nama_matkul"
		},
		{
			"data" : "action",
			"searchable" : false
		}
		],
		columnDefs : [
	        { 'visible': false, 'targets': [1] },
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
		var table = $("#tableMatkul").DataTable();
		table.ajax.reload();
	}

	$('#tableMatkul').on('click', '.btn-edit', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableMatkul').DataTable().row(this).data();
		if(typeof data === 'undefined'){
			data	= $('#tableMatkul').DataTable().row(currentRow).data();			
		}

		id 			= data['id'];
		kode_matkul	= data['kode_matkul'];
		nama_matkul = data['nama_matkul'];

		$('#id').val(id);
		$('#kode_matkul').val(kode_matkul);
		$('#nama_matkul').val(nama_matkul);
		$('#modalMatkul').modal('show');
		$('#addmatkul').hide();
		$('#edmatkul').show();
	});

	$('#modalMatkul').on('hidden.bs.modal', function (){
		$('#form-editMatkul')[0].reset();
	});	
	
	$('#form-editMatkul').submit(function(e){
		e.preventDefault();
		$('#btn-submit').attr('disabled',true);
		$.ajax({
			url: baseURL + 'data_master/data_matkul/save',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON',
			success: function(data){
				reloadTable();
				$('#modalMatkul').modal('hide');
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

	$('#form-uploadMatkul').submit(function(e){
		e.preventDefault();
		$('#btn-upload').attr('disabled',true);
		var data = new FormData( this );
		data.append('token', "<?php echo $this->security->get_csrf_hash(); ?>");
		$.ajax({
			url: baseURL + 'data_master/data_matkul/uploads',
			type: 'POST',
			data: data,
			processData: false,
			contentType: false,
			dataType: 'JSON',
			success: function(data){
				console.log(data);
				reloadTable();
				$('#modalUpload').modal('hide');
				swal({
					type: 'success',
					title: 'Success',
					text: data.feedback,
					timer:500
				});
				$('#btn-upload').attr('disabled', false);
			},
			error: function(data){
				console.log(data);
				sys_err();
				$('#btn-upload').attr('disabled', false);
			}
		});
	});

	$('#tableMatkul').on('click', '.btn-delete', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableMatkul').DataTable().row(this).data();
		if(typeof data === 'undefined'){
			data	= $('#tableMatkul').DataTable().row(currentRow).data();			
		}
		id 					= data['id'];
		kode_matkul 		= data['kode_matkul'];
		nama_matkul			= data['nama_matkul'];

		$('#modal-konfirmasi').modal('show');
		$('#kode_matkul').val(kode_matkul);
		$('#id_matkul').val(id);
	});

	$('#jadi_hapus').on('click', function(){
		var id = $("#id").val();
		var kode_matkul = $("#kode_matkul").val();
		$('#modal-konfirmasi').modal('hide');
		deleteMatkul(id, kode_matkul);
    	return false;
    });

	function deleteMatkul(id, kode_matkul){
		$.ajax({
			url: baseURL + 'data_master/data_matkul/delete',
			type: 'POST',
			data: {
				token: "<?php echo $this->security->get_csrf_hash(); ?>",
				id: id,
				kode_matkul:kode_matkul
			},
			success: function(){
				reloadTable();
				swal({
					type: 'success',
					title: 'Sukses',
					text: kode_matkul + ' berhasil dihapus'
				});
			},
			error: function(){
				sys_err();
			}
		});
	}

	function uploadfile(){
		var file = $("#fileupload")[0].files[0];
		// var file = fileInput.files[0];
		var formData = new FormData();
		formData.append('fileupload', file);
		
		$.ajax({
			method:"POST",
			url: "<?php echo base_url();?>"+'messages/from_file/read_file', 
			data: formData,  
			cache: false,
			dataType:"JSON",
			contentType: false,
			processData: false,   
			success: function(res){
				$("#field_number").html('<option value="0"> -- Select Field -- </option>');
				$("#field_variable").html('<option value="0"> -- Select Field -- </option>');
				// console.log(res[0]);
				$.each(res, function(i, item) {
					$("#field_number").append('<option value="'+i+'"> '+item+' </option>');
					$("#field_variable").append('<option value="'+item+'"> '+item+' </option>');
					$('.select2').select2();
				});
			},
			error: function(xhr, status, error) {
				console.log(xhr.responseText);
			}  
		});
		
		// console.log(formData);
	}

</script>