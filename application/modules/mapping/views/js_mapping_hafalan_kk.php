<script type="text/javascript">

	$('#btnTambah').on('click', function() {
     	$('#modalMappingHafalan').modal('show'); 
		$('#id').val(0); 
  	});
	
	$('#btnUpload').on('click', function() {
     	$('#modalUploadMapping').modal('show'); 
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

		$('#card-mapping-kk').hide();
		$('#card-loading').fadeIn();

		var table = $("#tableMappingHafalan").DataTable();
		table.ajax.reload(function(){
			$('#card-loading').hide();
			$('#card-mapping-kk').fadeIn();
		});
	});

	$("#tableMappingHafalan").DataTable({
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
			url: baseURL + "mapping/mapping_hafalan_kk/list_data",
			type: "POST",
			data: function(d){
				d.jurusan 		= $('#jurusan').val();
				d.angkatan 		= $('#angkatan').val();
				d.token		 	= "<?php echo $this->security->get_csrf_hash(); ?>";
			}
		},
		columns: [{
			"data": "no_urut"
		},
		{
			"data" : "id"
		},
		{
			"data" : "kiraatul_kutub"
		},
		{
			"data" : "nim"
		},
		{
			"data" : "mhs"
		},
		{
			"data" : "major_name"
		},
		{
			"data" : "tahun_angkatan"
		},
		{
			"data" : "nama_kk"
		},
		{
			"data" : "tema"
		},
		{
			"data" : "nip"
		},
		{
			"data" : "dosen"
		},
		{
			"data" : "action"
		}
		],
		columnDefs : [
	        //hide the second & fourth column
	        { 'visible': false, 'targets': [1] },
	        { 'visible': false, 'targets': [2] },
	        // { 'visible': false, 'targets': [3] },
	        // { 'visible': false, 'targets': [4] }
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
		var table = $("#tableMappingHafalan").DataTable();
		table.ajax.reload();
	}

	$('#tableMappingHafalan').on('click', '.btn-edit', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableMappingHafalan').DataTable().row(this).data();
		if(typeof data === 'undefined'){
			data	= $('#tableMappingHafalan').DataTable().row(currentRow).data();			
		}
		id 					= data['id'];
		nim 				= data['nim'];
		kiraatul_kutub 				= data['kiraatul_kutub'];
		nip 				= data['nip'];

		$('#id').val(id);
		$('#nim').val(nim);
		$('#kiraatul_kutub').val(kiraatul_kutub);
		$('#nip').val(nip);
		$('#modalMappingHafalan').modal('show');
	});

	$('#modalMappingHafalan').on('hidden.bs.modal', function (){
		$('#form-editMappingHafalan')[0].reset();
	});	
	
	$('#form-editMappingHafalan').submit(function(e){
		e.preventDefault();
		$('#btn-submit').attr('disabled',true);
		$.ajax({
			url: baseURL + 'mapping/mapping_hafalan_kk/save',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON',
			success: function(data){
				reloadTable();
				$('#modalMappingHafalan').modal('hide');
				swal({
					type: 'success',
					title: 'Success',
					text: data.feedback,
					timer:500
				});
				$('#btn-submit').attr('disabled', false);
			},
			error: function(data){
				sys_err();
				$('#btn-submit').attr('disabled', false);
			}
		});
	});

	$('#form-uploadMappingHafalan').submit(function(e){
		e.preventDefault();
		$('#btn-upload').attr('disabled',true);
		$.ajax({
			url: baseURL + 'mapping/mapping_hafalan_kk/uploads',
			type: 'POST',
			data: new FormData( this ),
			processData: false,
			contentType: false,
			dataType: 'JSON',
			success: function(data){
				// console.log(data);
				reloadTable();
				$('#modalMappingHafalan').modal('hide');
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

	$('#tableMappingHafalan').on('click', '.btn-delete', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableMappingHafalan').DataTable().row(this).data();
		if(typeof data === 'undefined'){
			data	= $('#tableMappingHafalan').DataTable().row(currentRow).data();			
		}
		id 					= data['id'];
		mhs 				= data['mhs'];

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
		      deleteMappingHafalan(id,mhs);
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

	function deleteMappingHafalan(id,mhs){
		$.ajax({
			url: baseURL + 'mapping/mapping_hafalan_kk/delete',
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
					text: mhs + ' berhasil dihapus'
				});
			},
			error: function(){
				sys_err();
			}
		});
	}

</script>