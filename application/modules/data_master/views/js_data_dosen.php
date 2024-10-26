<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#adddsn').hide();
		$('#eddsn').hide();
	});

	$('#btnTambah').on('click', function() {
     	$('#modalDosen').modal('show');
     	$('#adddsn').show();
     	$('#eddsn').hide();
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

	$("#tableDosen").DataTable({
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
			url: baseURL + "data_master/data_dosen/list_data",
			type: "POST",
			data: function(d){
				d.token		 	= "<?php echo $this->security->get_csrf_hash(); ?>";
				d.status = $('#status-filter').val();
				d.search = {
					value: d.search.value 
				};
				// console.log('Search value sent to server:', d.search.value);
			}
		},
		columns: [{
			"data": "id",
			"searchable" : false
		},
		{
			"data" : "kode_dosen",
			"searchable" : false
		},
		{
			"data" : "nip"
		},
		{
			"data" : "nama"
		},
		{
			"data" : "email"
		},
		{
			"data" : "jenis_kelamin"
		},
		{
			"data" : "jabatan"
		},
		{
			"data" : "program_study"
		},
		{
			"data" : "status"
		},
		{
			"data" : "action",
			"searchable" : false
		}
		],
		columnDefs : [
	        //hide the second & fourth column
	        { 'visible': false, 'targets': [1] },
	        // { 'visible': false, 'targets': [2] },
	        // { 'visible': false, 'targets': [5] }
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
		var table = $("#tableDosen").DataTable();
		table.ajax.reload();
	}

	$('#tableDosen').on('click', '.btn-edit', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableDosen').DataTable().row(this).data();
		if(typeof data === 'undefined'){
			data	= $('#tableDosen').DataTable().row(currentRow).data();			
		}
		id 					= data['id'];
		nip 				= data['nip'];
		nama 				= data['nama'];
		email 				= data['email'];
		jenis_kelamin		= data['jenis_kelamin'];
		jabatan				= data['jabatan'];
		program_study		= data['program_study'];
		status 				= data['status'];
		$('#eddsn').show();
		$('#adddsn').hide();

		$('#id').val(id);
		$('#nip').val(nip);
		$('#nama').val(nama);
		$('#email').val(email);
		$('#jenis_kelamin').val(jenis_kelamin);
		$('#jabatan').val(jabatan);
		$('#program_study').val(program_study);
		$('#status').val(status);
		$('#modalDosen').modal('show');
	});

	$('#modalDosen').on('hidden.bs.modal', function (){
		$('#form-editDosen')[0].reset();
	});	
	
	$('#form-editDosen').submit(function(e){
		e.preventDefault();
		$('#btn-submit').attr('disabled',true);
		$.ajax({
			url: baseURL + 'data_master/data_dosen/save',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON',
			success: function(data){
				reloadTable();
				$('#modalDosen').modal('hide');
				swal({
					type: 'success',
					title: 'Success',
					text: data.feedback,
					timer:5000
				});
				$('#btn-submit').attr('disabled', false);
			},
			error: function(){
				sys_err();
				$('#btn-submit').attr('disabled', false);
			}
		});
	});

	$('#form-uploadDosen').submit(function(e){
		e.preventDefault();
		$('#btn-upload').attr('disabled',true);
		var data = new FormData( this );
		data.append('token', "<?php echo $this->security->get_csrf_hash(); ?>");
		$.ajax({
			url: baseURL + 'data_master/data_dosen/uploads',
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

	$('#tableDosen').on('click', '.btn-delete', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableDosen').DataTable().row(currentRow).data();
		id					= data['id'];
		dosen 				= data['nama'];

		// swal({
	 //      title: 'Are you sure?',
	 //      text: "You won't be able to revert this!",
	 //      type: 'warning',
	 //      showCancelButton: true,
	 //      confirmButtonColor: '#0CC27E',
	 //      cancelButtonColor: '#FF586B',
	 //      confirmButtonText: 'Yes, delete it!',
	 //      cancelButtonText: 'No, cancel!',
	 //      confirmButtonClass: 'btn btn-success btn-raised mr-5',
	 //      cancelButtonClass: 'btn btn-danger btn-raised',
	 //      buttonsStyling: false
	 //    }).then(function () {
		//       deleteDosen(id, dosen);
		//     }, function (dismiss) {
		//       // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
		//       if (dismiss === 'cancel') {
		//         swal(
		//           'Cancelled',
		//           'Your login member file is safe :)',
		//           'error'
		//         )
		//       }
		//     })
		$('#modal-konfirmasi').modal('show');
		$('#dosen').val(dosen);
		$('#id_dsn').val(id);
	});

	$('#jadi_hapus').on('click', function(){
		var id = $("#id_dsn").val();
		var dosen = $("#dosen").val();
		$('#modal-konfirmasi').modal('hide');
		deleteDosen(id, dosen);
    	return false;
    });

	function deleteDosen(id, dosen){
		$.ajax({
			url: baseURL + 'data_master/data_dosen/delete',
			type: 'POST',
			data: {
				token: "<?php echo $this->security->get_csrf_hash(); ?>",
				id: id
			},
			success: function(){
				reloadTable();
				swal({
					type: 'success',
					title: 'Sukses',
					text: dosen + ' berhasil dihapus'
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