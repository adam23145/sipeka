<script type="text/javascript">

	jQuery(document).ready(function($){
		$('#addlogin').hide();
		$('#edlogin').hide();
	});

	$('#btnUpload').on('click', function() {
     	$('#modalUpload').modal('show'); 
  	});


	$('#btnTambah').on('click', function() {
     	$('#modalLogin').modal('show');
     	$('#addlogin').show();
     	$('#edlogin').hide(); 
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

	$("#tableLogin").DataTable({
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
			url: baseURL + "data_master/data_login/data_login",
			type: "POST",
			data: function(d){
				d.token		 	= "<?php echo $this->security->get_csrf_hash(); ?>";
				d.search = {
					value: d.search.value.toUpperCase() // Convert search value to lowercase
				};
			}
		},
		columns: [{
			"data": "id",
			"searchable" : false
		},
		{
			"data" : "userid"
		},
		{
			"data" : "username"
		},
		{
			"data" : "email",
			"searchable" : false
		},
		{
			"data" : "userlevel"
		},
		{
			"data" : "images",
			"searchable" : false
		},
		{
			"data" : "status",
			"searchable" : false
		},
		{
			"data" : "action",
			"searchable" : false
		}
		],
		// columnDefs : [
	 //        //hide the second & fourth column
	 //        { 'visible': false, 'targets': [8] }
	 //    ],
		rowCallback: function (row, data, iDisplayIndex) {
			var info = this.fnPagingInfo();
			var page = info.iPage;
			var length = info.iLength;
			var index = page * length + (iDisplayIndex + 1);
			$('td:eq(0)', row).html(index);
		},
	});

	function reloadTable(){
		var table = $("#tableLogin").DataTable();
		table.ajax.reload();
	}

	$('#tableLogin').on('click', '.btn-edit', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableLogin').DataTable().row(currentRow).data();
		id 					= data['id'];
		userid 				= data['userid'];
		full_name 			= data['username'];
		email 				= data['email'];
		level 				= data['userlevel'];
		image 				= data['images'];
		status 				= data['status'];

		$('#id').val(id);
		$('#userid').val(userid);
		$('#full_name').val(full_name);
		$('#email').val(email);
		$('#level').val(level);
		$('#image').val(image);
		$('#status').val(status);
		$('#modalLogin').modal('show');
		$('#addlogin').hide();
     	$('#edlogin').show();
	});

	$('#modalLogin').on('hidden.bs.modal', function (){
		$('#form-editLogin')[0].reset();
	});	
	
	$('#form-editLogin').submit(function(e){
		e.preventDefault();
		$('#btn-submit').attr('disabled',true);
		$.ajax({
			url: baseURL + 'data_master/data_login/save',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON',
			success: function(data){
				reloadTable();
				$('#modalLogin').modal('hide');
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

	$('#form-uploadLogin').submit(function(e){
		e.preventDefault();
		$('#btn-upload').attr('disabled',true);
		var data = new FormData( this );
		data.append('token', "<?php echo $this->security->get_csrf_hash(); ?>");
		$.ajax({
			url: baseURL + 'data_master/data_login/uploads',
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




	$('#tableLogin').on('click', '.btn-delete', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableLogin').DataTable().row(currentRow).data();
		id 					= data['id'];
		userid 				= data['userid'];

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
		//       deleteLogin(id, userid);
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
		$('#userid').val(userid);
		$('#id_lgn').val(id);
	});

	$('#jadi_hapus').on('click', function(){
		var id = $("#id_lgn").val();
		var userid = $("#userid").val();
		$('#modal-konfirmasi').modal('hide');
		deleteLogin(id, userid);
    	return false;
    });
    
	function deleteLogin(id, userid){
		$.ajax({
			url: baseURL + 'data_master/data_login/delete',
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
					text: userid + ' berhasil dihapus'
				});
			},
			error: function(){
				sys_err();
			}
		});
	}

</script>