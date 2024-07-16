<script type="text/javascript">
	function loadDocument(){
		var userid 	 	= $('#userid').val();
		var token		= "<?php echo $this->security->get_csrf_hash(); ?>";
		var baseURL 	= "<?php echo base_url().'dokumen/list_dokumen/get_dokumen';?>";
		var baseRoot 	= "<?php echo base_url();?>";
		$.ajax({    
			type: "POST",  
			url: baseURL,
			data: {
				token:token,userid:userid
			},
			dataType: "JSON",  
			success: function(data){
				if (data.length>0) {
					var tabcontent = "";
					var i;
					for (i = 0; i < data.length; ++i) {
						var fileID 		= data[i].id;
						var dokumen 	= data[i].dokumen;
						var filedok 	= data[i].file_dok;
						var filepath	= data[i].filepath;
						var nim			= data[i].nim;
						var judul		= data[i].title;

						if(filepath=='none'){
							filepath = 'document/files/';
						}

						var link 		= baseRoot + filepath + filedok;

						tabcontent += '<div  class="col-12 col-sm-4 col-md-3 d-flex align-items-stretch"><div class="card"><div class="card-header text-muted border-bottom-0">'+dokumen+'</div><div class="card-body pt-0"><center><div class="col-4"><img src="'+baseRoot+'public/assets/core/images/icon-dokumen-png.png" alt="" class="img-circle img-fluid "></div></center></div><div class="card-footer"><div class="text-right"><form id="document-list" method="POST"><input required type="text" readonly hidden name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>"><input type="text" hidden id="fid" value="'+fileID+'" readonly="true"><input hidden type="text" id="fnim" value="'+nim+'" readonly="true"><input hidden type="text" id="fjudul" value="'+judul+'" readonly="true"><input  type="text" id="fdokumen" value="'+dokumen[i]+'" readonly="true"><button id="btn-submit" type="submit" class="btn btn-sm bg-teal"><i class="fas fa-download "></i></button></form></div></div></div></div>';

						// tabcontent += '<div  class="col-12 col-sm-4 col-md-3 d-flex align-items-stretch"><div class="card"><div class="card-header text-muted border-bottom-0">'+dokumen+'</div><div class="card-body pt-0"><center><div class="col-4"><img src="'+baseRoot+'public/assets/core/images/icon-dokumen-png.png" alt="" class="img-circle img-fluid "></div></center></div><div class="card-footer"><div class="text-right"><a href="'+link+'" class="btn btn-sm bg-teal"><i class="fas fa-download "></i></a></div></div></div></div>';
					}
					$('#document-list').html(tabcontent);
					$('#document-room').fadeIn();
				} else {
					console.log("No attach...");
				}
			},
			error: function(){

			}
		});
	}

	$('#document-list').submit(function(e){
		e.preventDefault();
		$('#btn-submit').attr('disabled',true);
		var fid 	= $('#fid').val();
		var fnim 	= $('#fnim').val();
		var fjudul 	= $('#fjudul').val();
		var fdokumen 	= $('#fdokumen').val();
		alert(fdokumen);
		return;

		$.ajax({
			url: baseURL + 'form/form_detail/get_pdf',
			type: 'POST',
			data: {token: "<?php echo $this->security->get_csrf_hash(); ?>",fid:fid,fnim:fnim,fjudul:fjudul},
			dataType: 'JSON',
			success: function(data){
				var aba = btoa(data.submission_code);
				if(dokumen=="Cetak form kesediaan menjadi dosen pembimbing"){
					window.location.replace("<?php echo base_url().'data_pdf/Pdf001?subcd='?>"+aba);
				}else if(dokumen=="Berita Acara Siap Diujikan Sempro"){
					window.location.replace("<?php echo base_url().'data_pdf/Pdf002?subcd='?>"+aba);
				}
				
				$('#btn-submit').attr('disabled', false);
			},
			error: function(){
				sys_err();
				$('#btn-submit').attr('disabled', false);
			}
		});
	});

	jQuery(document).ready(function($) {
		loadDocument();
	});

</script>