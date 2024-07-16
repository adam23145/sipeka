<script type="text/javascript">
	$(document).ready(function () {
	  bsCustomFileInput.init();

	});

	$('#form-profil').submit(function(e) {
		e.preventDefault();
			Swal.fire({
	            title 	: 'Apakah anda yakin?',
	            text 	: "Akan Merubah Data Profil",
	            type 	: 'warning',
	            showCancelButton: true,
	            confirmButtonColor: '#3085d6',
	            cancelButtonColor: '#d33',
	            confirmButtonText: 'Update',
	            cancelButtonText: 'Cancel'
	          }).then((result) => { 
	            if (result.value) {
	                 $.ajax({
	                     url 	: baseURL + "profile/update",
	                     type 	:"post",
	                     data 	: new FormData(this),
	                     processData:false,
	                     contentType:false,
	                     cache:false,
	                     async:false,
	                      success: function(data){
				           swal({
								type: 'success',
								title: 'Success',
								text: data.feedback,
								timer:800
							});
				            location.reload();
								
	                   },
	                   failure:function(d){
	                          alert("Error")
	                          alert(d)
	                   }
	                 });
	              }
	          })
	});

	$('#form-upload-foto').submit(function(event){
		event.preventDefault();
		fileInput 	= document.getElementById('pas_foto');
		filePath 	= fileInput.value;
		allowedExtensions = /(\.jpg|jpeg)$/i;
		if(!allowedExtensions.exec(filePath)){
			swal({
				type: 'warning',
				title: 'Perhatian',
				text: 'Pastikan Anda memilih file sesuai ketentuan',
			});
			return;
		}
		swalLoading();
		$.ajax({
			url: baseURL + "profile/profile/unggah_foto",
			method: "POST",
			data: new FormData(this),
			contentType: false,
			processData: false,
			success: function(){
				setTimeout(function(){
					Swal.close();
					swal({
						type: 'success',
						title: 'Sukses',
						text: 'Foto berhasil diunggah',
						allowOutsideClick: false,
					}).then((result) => {
						$('#modal-upload-foto').modal('hide');
						location.reload();
					});
				}, 1000);
			},
			error: function(){
				Swal.close();
				swal("Opss!", "Gagal upload foto", "error");
			}

		});
	});
</script>