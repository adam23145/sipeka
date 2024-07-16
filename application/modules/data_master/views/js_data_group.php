<script type="text/javascript">

	$('#btnTambah').on('click', function() {
     	$('#modalGroup').modal('show'); 
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

	$("#tableGroup").DataTable({
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
			url: baseURL + "data_master/data_group/data_group",
			type: "POST",
			data: function(d){
				d.token		 	= "<?php echo $this->security->get_csrf_hash(); ?>";
			}
		},
		columns: [{
			"data": "id"
		},
		{
			"data" : "group"
		},
		{
			"data" : "site"
		},
		{
			"data" : "status"
		},
		{
			"data" : "upd"
		},
		{
			"data" : "lup"
		},
		{
			"data" : "action"
		}
		],
		rowCallback: function (row, data, iDisplayIndex) {
			var info 	= this.fnPagingInfo();
			var page 	= info.iPage;
			var length 	= info.iLength;
			var index 	= page * length + (iDisplayIndex + 1);
			$('td:eq(0)', row).html(index);
		},
	});

	function reloadTable(){
		var table = $("#tableGroup").DataTable();
		table.ajax.reload();
	}

	$('#tableGroup').on('click', '.btn-edit', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableGroup').DataTable().row(currentRow).data();
		id 					= data['id'];
		group 				= data['group'];
		site 				= data['site'];
		status 				= data['status'];

		$('#id').val(id);
		$('#grp_name').val(group);
		$('#site').val(site);
		$('#status').val(status);
		$('#modalGroup').modal('show');
	});

	$('#modalGroup').on('hidden.bs.modal', function (){
		$('#form-editGroup')[0].reset();
	});	
	
	$('#form-editGroup').submit(function(e){
		e.preventDefault();
		$('#btn-submit').attr('disabled',true);
		$.ajax({
			url: baseURL + 'data_master/data_group/save',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON',
			success: function(data){
				reloadTable();
				$('#modalGroup').modal('hide');
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




	$('#tableGroup').on('click', '.btn-delete', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableGroup').DataTable().row(currentRow).data();
		id 					= data['id'];
		group 				= data['group'];

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
		      deleteLogin(id, group);
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