<script type="text/javascript">

	$('form').jAutoCalc({
		keyEventsFire:true
	});

	$('.btn-video').on('click', function() {
		link = $('#link_dosen').val();
		window.open(link,'_blank');
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

	$("#tableTransHafalan").DataTable({
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
		responsive: true,
		// lengthChange: false,
		ajax: {
			url: baseURL + "hafalan/hafalan_hadist/list_data",
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
			"data" : "id",
			"searchable" : false
		},
		{
			"data" : "mapping_hadist",
			"searchable" : false
		},
		{
			"data" : "tema",
			"searchable" : false
		},
		{
			"data" : "hadist",
			"searchable" : false
		},
		{
			"data" : "link",
			"searchable" : false
		},
		{
			"data" : "menghafal",
			"searchable" : false
		},
		{
			"data" : "memahami",
			"searchable" : false
		},
		{
			"data" : "nilai",
			"searchable" : false
		},
		{
			"data" : "status_lulus",
			"searchable" : false
		},
		{
			"data" : "dosen",
			"searchable" : false
		},
		{
			"data" : "tgl_upload",
			"searchable" : false
		},
		{
			"data" : "tgl_nilai",
			"searchable" : false
		},
		{
			"data" : "keterangan",
			"searchable" : false
		},
		{
			"data" : "action",
			"searchable" : false
		}
		],
		columnDefs : [
	        //hide the second & fourth column
	        { 'visible': false, 'targets': [3] },
	        { 'visible': false, 'targets': [4] },
	        { 'visible': false, 'targets': [5] },
	    ],
		rowCallback: function (row, data, iDisplayIndex) {
			var info = this.fnPagingInfo();
			var page = info.iPage;
			var length = info.iLength;
			var index = page * length + (iDisplayIndex + 1);
			$('td:eq(0)', row).html(index);
			if("<?php echo $level;?>" == "mahasiswa"){
				if(data["link"] === null){
					$(row).css('background-color', '#FFC300');
				}
			}
			if("<?php echo $level;?>" == "Dosen"){
				if(data["link"] !== null && data["nilai"] === null){
					$(row).css('background-color', '#FFC300');
				}
			}
		},
	});

	function reloadTable(){
		var table = $("#tableTransHafalan").DataTable();
		table.ajax.reload();
	}

	$('#tableTransHafalan').on('click', '.btn-edit', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableTransHafalan').DataTable().row(this).data();
		// console.log(data);
		if(typeof data === 'undefined'){
			data	= $('#tableTransHafalan').DataTable().row(currentRow).data();			
		}
		id 					= data['id'];
		mapping_hadist		= data['mapping_hadist'];
		hadist 				= data['hadist'];
		tema 				= data['tema'];
		link 				= data['link'];

		$('#id').val(id);
		$('#mapping_hadist').val(mapping_hadist);
		$('#hadist').html(hadist);
		$('#tema').html("Tema - "+tema);
		$('#link').val(link);
		$('#modalInput').modal('show');
	});
	
	$('#tableTransHafalan').on('click', '.btn-nilai', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableTransHafalan').DataTable().row(this).data();
		// console.log(data);
		if(typeof data === 'undefined'){
			data	= $('#tableTransHafalan').DataTable().row(currentRow).data();			
		}
		id 					= data['id'];
		mapping_hadist		= data['mapping_hadist'];
		hadist 				= data['hadist'];
		tema 				= data['tema'];
		link 				= data['link'];
		menghafal			= data['menghafal'];
		memahami			= data['memahami'];
		nilai 				= data['nilai'];
		status_lulus		= data['id_lulus'];
		ket 				= data['keterangan'];

		$('#idForDosen').val(id);
		$('#mapping_hadist').val(mapping_hadist);
		$('#hadistForDosen').html(hadist);
		$('#temaForDosen').html("Tema - "+tema);
		$('#link_dosen').val(link);
		$('#menghafal').val(menghafal);
		$('#memahami').val(memahami);
		$('#nilai').val(nilai);
		$('#status_lulus').val(status_lulus);
		$('#ket').val(ket);
		$('#modalNilai').modal('show');
	});

	$('#modalInput').on('hidden.bs.modal', function (){
		$('#form-inputLink')[0].reset();
	});	
	
	$('#modalNilai').on('hidden.bs.modal', function (){
		$('#form-inputNilai')[0].reset();
	});	
	
	$('#form-inputLink').submit(function(e){
		e.preventDefault();
		$('#btn-submit').attr('disabled',true);
		$.ajax({
			url: baseURL + 'hafalan/hafalan_hadist/save',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON',
			success: function(data){
				reloadTable();
				$('#modalInput').modal('hide');
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
	
	$('#form-inputNilai').submit(function(e){
		e.preventDefault();
		$('#btn-submitnilai').attr('disabled',true);
		var data = $(this).serializeArray();
		data.push({name: 'token', value: "<?php echo $this->security->get_csrf_hash(); ?>"});
		
		$.ajax({
			url: baseURL + 'hafalan/hafalan_hadist/save_nilai',
			type: 'POST',
			data: data,
			dataType: 'JSON',
			success: function(data){
				reloadTable();
				$('#modalNilai').modal('hide');
				swal({
					type: 'success',
					title: 'Success',
					text: data.feedback,
					timer:500
				});
				$('#btn-submitnilai').attr('disabled', false);
			},
			error: function(data){
				sys_err();
				$('#btn-submitnilai').attr('disabled', false);
			}
		});
	});

	$('#tableTransHafalan').on('click', '.btn-preview', function(){
		currentRow 			= $(this).closest('tr');
		data 				= $('#tableTransHafalan').DataTable().row(this).data();
		if(data['link'] === null){
			window.location.reload();
		}else{
			link = data['link'];
			window.open(link,'_blank');
		}
	});

</script>