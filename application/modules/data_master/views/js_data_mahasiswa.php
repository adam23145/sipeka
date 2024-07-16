<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#addmhs').hide();
		$('#edmhs').hide();
	});

	$('#btnTambah').on('click', function() {
		$('#id').val(0);
		$('#modalMahasiswa').modal('show');
		$('#addmhs').show();
		$('#edmhs').hide();
	});

	$('#btnUpload').on('click', function() {
		$('#modalUpload').modal('show');
	});

	$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
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

	var table = $("#tableMahasiswa").DataTable({
		initComplete: function() {
			var api = this.api();
			$('#mytable_filter input')
				.off('.DT')
				.on('keyup.DT', function(e) {
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
		ajax: {
			url: baseURL + "data_master/data_mahasiswa/list_data",
			type: "POST",
			data: function(d) {
				d.token = "<?php echo $this->security->get_csrf_hash(); ?>";
				d.status = $('#status-filter').val(); // Send the status filter value to the server
				var searchValue = $('#mytable_filter').val().toUpperCase();
				d.search = {
					value: searchValue
				};
			}
		},
		columns: [{
				"data": "no_urut",
				"searchable": false
			},
			{
				"data": "nim",
				"searchable": false
			},
			{
				"data": "nama"
			},
			{
				"data": "email"
			},
			{
				"data": "fakultas"
			},
			{
				"data": "jurusan"
			},
			{
				"data": "jenis_kelamin",
				"searchable": false
			},
			{
				"data": "tahun_masuk",
				"searchable": false
			},
			{
				"data": "status"
			},
			{
				"data": "action",
				"searchable": false
			}
		],
		columnDefs: [
			//hide the second & fourth column
			// { 'visible': false, 'targets': [1] },
			// { 'visible': false, 'targets': [2] },
			// { 'visible': false, 'targets': [5] }
		],
		rowCallback: function(row, data, iDisplayIndex) {
			var info = this.fnPagingInfo();
			var page = info.iPage;
			var length = info.iLength;
			var index = page * length + (iDisplayIndex + 1);
			$('td:eq(0)', row).html(index);
		},
	});
	$('#status-filter').on('change', function() {
		table.ajax.reload(); // Reload the table data based on the selected status
	});
	// Handle keyup event for search input
	$('#mytable_filter').on('keyup', function() {
		table.search(this.value).draw();
	});

	function reloadTable() {
		var table = $("#tableMahasiswa").DataTable();
		table.ajax.reload();
	}

	$('#tableMahasiswa').on('click', '.btn-edit', function() {
		currentRow = $(this).closest('tr');
		data = $('#tableMahasiswa').DataTable().row(this).data();
		if (typeof data === 'undefined') {
			data = $('#tableMahasiswa').DataTable().row(currentRow).data();
		}

		nim = data['nim'];
		nama = data['nama'];
		email = data['email'];
		fakultas = data['fakultas'];
		jurusan = data['jurusan'];
		jenis_kelamin = data['jenis_kelamin'];
		tahun_masuk = data['tahun_masuk'];
		status = data['status'];

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
		$('#addmhs').hide();
		$('#edmhs').show();
	});

	$('#modalMahasiswa').on('hidden.bs.modal', function() {
		$('#form-editMahasiswa')[0].reset();
	});

	$('#form-editMahasiswa').submit(function(e) {
		e.preventDefault();
		$('#btn-submit').attr('disabled', true);
		$.ajax({
			url: baseURL + 'data_master/data_mahasiswa/save',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON',
			success: function(data) {
				reloadTable();
				$('#modalMahasiswa').modal('hide');
				swal({
					type: 'success',
					title: 'Success',
					text: data.feedback,
					timer: 500
				});
				$('#btn-submit').attr('disabled', false);
			},
			error: function() {
				sys_err();
				$('#btn-submit').attr('disabled', false);
			}
		});
	});

	$('#form-uploadMahasiswa').submit(function(e) {
		e.preventDefault();
		$('#btn-upload').attr('disabled', true);
		var data = new FormData(this);
		data.append('token', "<?php echo $this->security->get_csrf_hash(); ?>");
		$.ajax({
			url: baseURL + 'data_master/data_mahasiswa/uploads',
			type: 'POST',
			data: data,
			processData: false,
			contentType: false,
			dataType: 'JSON',
			success: function(data) {
				console.log(data);
				reloadTable();
				$('#modalUpload').modal('hide');
				swal({
					type: 'success',
					title: 'Success',
					text: data.feedback,
					timer: 500
				});
				$('#btn-upload').attr('disabled', false);
			},
			error: function(data) {
				console.log(data);
				sys_err();
				$('#btn-upload').attr('disabled', false);
			}
		});
	});

	$('#tableMahasiswa').on('click', '.btn-delete', function() {
		currentRow = $(this).closest('tr');
		data = $('#tableMahasiswa').DataTable().row(this).data();
		if (typeof data === 'undefined') {
			data = $('#tableMahasiswa').DataTable().row(currentRow).data();
		}
		var id = data['nim'];
		var mahasiswa = data['nama'];

		$('#modal-konfirmasi').modal('show');
		$('#mahasiswa').val(mahasiswa);
		$('#id_mhs').val(id);

	});

	$('#jadi_hapus').on('click', function() {
		var id = $("#id_mhs").val();
		var mahasiswa = $("#mahasiswa").val();
		$('#modal-konfirmasi').modal('hide');
		deleteMahasiswa(id, mahasiswa);
		return false;
	});

	function deleteMahasiswa(id, mahasiswa) {
		$.ajax({
			url: baseURL + 'data_master/data_mahasiswa/delete',
			type: 'POST',
			data: {
				token: "<?php echo $this->security->get_csrf_hash(); ?>",
				id: id
			},
			success: function() {
				reloadTable();
				swal({
					type: 'success',
					title: 'Sukses',
					text: mahasiswa + ' berhasil dihapus.',
					timer: 2000,
					showConfirmButton: false
				});
			},
			error: function() {
				sys_err();
			}
		});
	}
</script>