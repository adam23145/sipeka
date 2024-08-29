<script type="text/javascript">

	jQuery(document).ready(function($){
		$('#addprodi').hide();
		$('#edprodi').hide();
	});

	$('#btnTambah').on('click', function() {
     	$('#modalProdi').modal('show'); 
     	$('#addprodi').show();
		$('#edprodi').hide();
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

	$("#tableProdi").DataTable({
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
			url: baseURL + "data_master/data_prodi/list_data",
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
			"data" : "major_code"
		},
		{
			"data" : "major_name"
		},
		{
			"data" : "status"
		},
		{
			"data" : "nip"
		},
		{
			"data" : "nama"
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
		var table = $("#tableProdi").DataTable();
		table.ajax.reload();
	}

	$('#tableProdi').on('click', '.btn-edit', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableProdi').DataTable().row(currentRow).data();
		id 					= data['id'];
		major_code			= data['major_code'];
		major_name			= data['major_name'];
		nip					= data['nip'];
		nama				= data['nama'];
		status 				= data['status'];

		$('#id').val(id);
		$('#major_code').val(major_code);
		$('#major_name').val(major_name);
		$('#nip').val(nip);
		$('#nama').val(nama);
		$('#status').val(status);
		$('#modalProdi').modal('show');
		$('#addprodi').hide();
		$('#edprodi').show();
	});

	$('#modalProdi').on('hidden.bs.modal', function (){
		$('#form-editProdi')[0].reset();
	});	
	
	$('#form-editProdi').submit(function(e){
		e.preventDefault();
		$('#btn-submit').attr('disabled',true);
		$.ajax({
			url: baseURL + 'data_master/data_prodi/save',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON',
			success: function(data){
				reloadTable();
				$('#modalProdi').modal('hide');
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

	$('#form-uploadProdi').submit(function(e){
		e.preventDefault();
		$('#btn-upload').attr('disabled',true);
		var data = new FormData( this );
		data.append('token', "<?php echo $this->security->get_csrf_hash(); ?>");
		$.ajax({
			url: baseURL + 'data_master/data_prodi/uploads',
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

	$('#tableProdi').on('click', '.btn-delete', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableProdi').DataTable().row(currentRow).data();
		id 					= data['id'];
		major_name			= data['major_name'];

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
		//       deleteProdi(id, major_name);
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
		$('#major_name').val(major_name);
		$('#id_prodi').val(id);
	});

	$('#jadi_hapus').on('click', function(){
		var id = $("#id_prodi").val();
		var prodi = $("#major_name").val();
		$('#modal-konfirmasi').modal('hide');
		deleteProdi(id, prodi);
    	return false;
    });

	function deleteProdi(id, prodi){
		$.ajax({
			url: baseURL + 'data_master/data_prodi/delete',
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
					text: prodi + ' berhasil dihapus'
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