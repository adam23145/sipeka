<script type="text/javascript">

	$('#btnTambah').on('click', function() {
     	$('#id').val(0); 
     	$('#modalMahasiswa').modal('show'); 
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

	$("#tableMahasiswa").DataTable({
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
			url: baseURL + "data_master/data_mahasiswa/list_data",
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
			"data" : "nim",
			"searchable" : false
		},
		{
			"data" : "nama"
		},
		{
			"data" : "email"
		},
		{
			"data" : "fakultas"
		},
		{
			"data" : "jurusan"
		},
		{
			"data" : "jenis_kelamin",
			"searchable" : false
		},
		{
			"data" : "tahun_masuk",
			"searchable" : false
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
	        // { 'visible': false, 'targets': [1] },
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
		var table = $("#tableMahasiswa").DataTable();
		table.ajax.reload();
	}

	$('#tableMahasiswa').on('click', '.btn-edit', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableMahasiswa').DataTable().row(this).data();
		if(typeof data === 'undefined'){
			data	= $('#tableMahasiswa').DataTable().row(currentRow).data();			
		}

		nim 					= data['nim'];
		nama 					= data['nama'];
		email					= data['email'];
		fakultas 				= data['fakultas'];
		jurusan 				= data['jurusan'];
		jenis_kelamin			= data['jenis_kelamin'];
		tahun_masuk				= data['tahun_masuk'];
		status					= data['status'];

		$('#id').val(nim);
		$('#nim').val(nim);
		$('#nama').val(nama);
		$('#email').val(email);
		$('#fakultas').val(fakultas);
		$('#jurusan').val(jurusan);
		$('#jenis_kelamin').val(jenis_kelamin);
		$('#tahun_masuk').val(tahun_masuk);
		$('#status').val(status);
		$('#modalMahasiswa').modal('show');
	});

	$('#modalMahasiswa').on('hidden.bs.modal', function (){
		$('#form-editMahasiswa')[0].reset();
	});	
	
	$('#form-editMahasiswa').submit(function(e){
		e.preventDefault();
		$('#btn-submit').attr('disabled',true);
		$.ajax({
			url: baseURL + 'data_master/data_mahasiswa/save',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON',
			success: function(data){
				reloadTable();
				$('#modalMahasiswa').modal('hide');
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

	$('#form-uploadMahasiswa').submit(function(e){
		e.preventDefault();
		$('#btn-upload').attr('disabled',true);
		var data = new FormData( this );
		data.append('token', "<?php echo $this->security->get_csrf_hash(); ?>");
		$.ajax({
			url: baseURL + 'data_master/data_mahasiswa/uploads',
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

	$('#tableMahasiswa').on('click', '.btn-delete', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableMahasiswa').DataTable().row(this).data();
		if(typeof data === 'undefined'){
			data	= $('#tableMahasiswa').DataTable().row(currentRow).data();			
		}
		id 					= data['nim'];
		mahasiswa			= data['nama'];

		swal({
	      title: 'Are you sure?',
	      text: "You won't be able to revert this!",
	      type: 'warning',
	      showCancelButton: true,
	      confirmButtonColor: '#0CC27E',
	      cancelButtonColor: '#FF586B',
	      confirmButtonText: 'Yes, delete it!',
	      cancelButtonText: 'No, cancel!',
	      confirmButtonClass: 'btn btn-success btn-raised mr-5',
	      cancelButtonClass: 'btn btn-danger btn-raised',
	      buttonsStyling: false
	    }).then(function () {
		      deleteMahasiswa(id, mahasiswa);
		    }, function (dismiss) {
		      // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
		      if (dismiss === 'cancel') {
		        swal(
		          'Cancelled',
		          'Your login member file is safe :)',
		          'error'
		        )
		      }
		    })
	});

	function deleteMahasiswa(id, mahasiswa){
		$.ajax({
			url: baseURL + 'data_master/data_mahasiswa/delete',
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
					text: mahasiswa + ' berhasil dihapus'
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