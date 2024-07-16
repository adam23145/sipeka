<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.jqueryui.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

<script type="text/javascript">

	$('#btnTambah').on('click', function() {
     	$('#modalKK').modal('show'); 
		$('#id').val(0); 
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

	$('#form-search-report').on('submit', function(e) {
		
		e.preventDefault();

		$('#card-table-KK').hide();
		$('#card-loading').fadeIn();

		var table = $("#tableKK").DataTable();
		table.ajax.reload(function(){
			$('#card-loading').hide();
			$('#card-table-KK').fadeIn();
		});
	});

	var table = $("#tableKK").DataTable({
		initComplete: function () {
			var api = this.api();
			$('#mytable_filter input')
			.off('.DT')
			.on('keyup.DT', function (e) {
				if (e.keyCode == 13) {
					api.search(this.value).draw();
				}
			});
			table.buttons().container()
			.appendTo('#disini');
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
			url: baseURL + "data_hafalan/data_kk/list_data",
			type: "POST",
			data: function(d){
				d.jurusan 		= $('#jurusan').val();
				d.token		 	= "<?php echo $this->security->get_csrf_hash(); ?>";
			}
		},
		columns: [{
			"data": "no_urut",
			"searchable" : false
		},
		{
			"data" : "id_prodi",
			"searchable" : false
		},
		{
			"data" : "id",
			"searchable" : false
		},
		{
			"data" : "major_name",
			"searchable" : false
		},
		{
			"data" : "kiraotul_kutub"
		},
		{
			"data" : "tema"
		},
		{
			"data" : "id_status",
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
		buttons: [
			{
				extend: 'excelHtml5',
				messageTop: function(){
					return 'Daftar Ayat'
				},
				exportOptions: {
					columns: [2,3,4,5]
				}
			}
		],
		columnDefs : [
	        //hide the second & fourth column
	        { 'visible': false, 'targets': [1] },
	        { 'visible': false, 'targets': [6] },
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
		var table = $("#tableKK").DataTable();
		table.ajax.reload();
	}

	$('#tableKK').on('click', '.btn-edit', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableKK').DataTable().row(this).data();
		if(typeof data === 'undefined'){
			data	= $('#tableKK').DataTable().row(currentRow).data();			
		}
		id 					= data['id'];
		kk					= data['kiraotul_kutub'];
		tema 				= data['tema'];
		prodi 				= data['id_prodi'];
		// tahun_angkatan		= data['tahun_angkatan'];
		status 				= data['id_status'];

		$('#id').val(id);
		$('#kk').val(kk);
		$('#tema').val(tema);
		$('#prodi').val(prodi);
		// $('#tahun_angkatan').val(tahun_angkatan);
		$('#status').val(status);
		$('#modalKK').modal('show');
	});

	$('#modalKK').on('hidden.bs.modal', function (){
		$('#form-editKK')[0].reset();
	});	
	
	$('#form-editKK').submit(function(e){
		e.preventDefault();
		$('#btn-submit').attr('disabled',true);
		$.ajax({
			url: baseURL + 'data_hafalan/data_kk/save',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON',
			success: function(data){
				reloadTable();
				$('#modalKK').modal('hide');
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

	$('#form-uploadKK').submit(function(e){
		e.preventDefault();
		$('#btn-upload').attr('disabled',true);
		$.ajax({
			url: baseURL + 'data_hafalan/data_kk/uploads',
			type: 'POST',
			data: new FormData( this ),
			processData: false,
			contentType: false,
			dataType: 'JSON',
			success: function(data){
				// console.log(data);
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
			error: function(){
				sys_err();
				$('#btn-upload').attr('disabled', false);
			}
		});
	});

	$('#tableKK').on('click', '.btn-delete', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableKK').DataTable().row(this).data();
		if(typeof data === 'undefined'){
			data	= $('#tableKK').DataTable().row(currentRow).data();			
		}
		id 					= data['id'];
		kk 					= data['kiraotul_kutub'];

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
		      deleteKK(id, kk);
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

	function deleteKK(id, kk){
		$.ajax({
			url: baseURL + 'data_hafalan/data_kk/delete',
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
					text: kk + ' berhasil dihapus'
				});
			},
			error: function(){
				sys_err();
			}
		});
	}

</script>