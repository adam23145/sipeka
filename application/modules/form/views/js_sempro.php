<script type="text/javascript">
	$('#form-submtitle').submit(function(event){
		event.preventDefault();
		fileInput 	= document.getElementById('file_ba');
		filePath 	= fileInput.value;
		allowedExtensions = /(\.doc|docx|ppt|pptx|pdf)$/i;
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
			url: baseURL + "form/form_sempro/save",
			method: "POST",
			data: new FormData(this),
			contentType: false,
			processData: false,
			async:false,
			success: function(data){
				// console.log(data);
				setTimeout(function(){
					Swal.close();
					swal({
						type: 'success',
						title: 'Sukses',
						text: 'Berhasil upload proposal & berita acara seminar',
						allowOutsideClick: false,
					}).then((result) => {
						// location.reload();
						window.location.href = baseURL + "history/bimbingan_skripsi";
					});
				}, 1000);
			},
			error: function(){
				Swal.close();
				swal("Opss!", "Gagal upload file", "error");
			}

		});
	});


	$(document).ready(function(){
			ceksempro();

		  $( "#tanggal").datepicker({
			    // maxDate: '0-15y',
			    // minDate: '0-30y',
			    dateFormat: 'yy-mm-dd',
			    // defaultDate: '0 -18y',
			    changeMonth:true,
			    format: 'yyyy-mm-dd',
			    changeYear:true,
			    todayHighlight: true,
			    autoclose: true,
			    endDate: new Date
			}).on('keypress', function(e){ e.preventDefault(); });

		  $('.select2').select2();
		  bsCustomFileInput.init();
	});

	function ceksempro(){
		$.ajax({
			url: baseURL + 'form/form_sempro/get_count_sempro',
			dataType: "JSON",
			success: function(data){
				if(data.countsemp==0){
					setTimeout(function(){
						Swal.close();
						swal({
							type: 'error',
							title: 'Alert',
							text: 'Anda belum melakukan pengajuan judul seminar proposal!!',
							allowOutsideClick: false,
						}).then((result) => {
							window.location.href = baseURL + "form/form_judul";
						});
					}, 1000);
				}else{
					$.ajax({
						url: baseURL + 'form/form_sempro/get_sempro',
						dataType: "JSON",
						success: function(data){
							if(data.submission_status!=='Seminar Proposal'){
								setTimeout(function(){
									Swal.close();
									swal({
										type: 'error',
										title: 'Alert',
										text: 'Anda tidak dapat menginput data seminar proposal sampai dosen approve bimbingan seminar anda!!',
										allowOutsideClick: false,
									}).then((result) => {
										window.location.href = baseURL + "history/historis";
									});
								}, 1000);
							}else{
								
							}
						},
						error: function(){
							// sys_err();
							swal("Opss!", "data tidak terload sempurna", "error");
						}
					});
				}
			},
			error: function(){
				// sys_err();
				swal("Opss!", "data tidak terload sempurna", "error");
			}
		});
	}


	$("#penguji").on("select2:select select2:unselect", function (e) {

    //this returns all the selected item
    var items= $('#penguji option:selected').toArray().map(item => item.value).join();

    $('#dsnpenguji').val(items);

	})
</script>