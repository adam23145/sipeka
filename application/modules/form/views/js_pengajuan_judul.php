<script type="text/javascript">
	$('#form-submtitle').submit(function(e){
		e.preventDefault();
		$('#btn-submit').attr('disabled',true);
		$('#btn-submit').hide();
		$.ajax({
			url: baseURL + 'form/form_judul/save',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON',
			success: function(data){
				setTimeout(function(){
					Swal.fire({
						title: 'success',
						text: data.feedback,
						type: 'success',
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'Oke',
						allowOutsideClick: false,
					}).then((result) => {
						window.location.href = baseURL + "history/historis";
					});
				}, 500);
				// $('#btn-submit').attr('disabled', false);
			},
			error: function(){
				sys_err();
				$('#btn-submit').attr('disabled', false);
			}
		});
	});
	$(document).ready(function(){
		cekjudul();
	});

	function cekjudul(){
		$.ajax({
			url: baseURL + 'form/form_judul/get_judul',
			dataType: "JSON",
			success: function(data){
				if(data.jml>0){
					setTimeout(function(){
						Swal.close();
						swal({
							type: 'error',
							title: 'Alert',
							text: 'Anda tidak dapat melakukan pengajuan judul baru',
							allowOutsideClick: false,
						}).then((result) => {
							window.location.href = baseURL + "history/historis";
						});
					}, 300);
				}
			},
			error: function(){
				// sys_err();
				swal("Opss!", "data tidak terload sempurna", "error");
			}
		});
	}
</script>