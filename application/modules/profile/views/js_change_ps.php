<script type="text/javascript">
	$(document).ready(function(){
		get_profile();
		$('#inputpass1').keyup(function (){
			    var $el = $(this); // the text element
			    var text = $el.val();
			    text = text.split(/\'/g).join("");//remove occurances
			    text = text.split(/\"/g).join("");//remove occurances
			    $el.val(text);//set it back on the element
			});
	});

	function myFunction() {
		var x = document.getElementById("inputpass1");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}

	function myFunction2() {
		var x = document.getElementById("inputpass2");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}

	function get_profile(){
		$.ajax({
			url: baseURL + 'profile/ch_passwd/get_profil',
			dataType: "JSON",
			success: function(data){
				document.getElementById('inputName').value	= data.nama_kary;
			},
			error: function(){
				// sys_err();
				swal("Opss!", "data profil tidak terload sempurna", "error");
			}
		});
	}

	$('#form-passwd').submit(function(e) {
		e.preventDefault();
		var inputpass1 = document.getElementById("inputpass1").value;
		var inputpass2 = document.getElementById("inputpass2").value;

		if(inputpass1==inputpass2){
			Swal.fire({
	            title 	: 'Apakah anda yakin?',
	            text 	: "Password akan diupdate",
	            type 	: 'warning',
	            showCancelButton: true,
	            confirmButtonColor: '#3085d6',
	            cancelButtonColor: '#d33',
	            confirmButtonText: 'Update',
	            cancelButtonText: 'Cancel'
	          }).then((result) => {
	            if (result.value) {
	                 $.ajax({
	                     url 	: baseURL + "profile/ch_passwd/update_pass",
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
								timer:500
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
		}else{
			swal("Opss!", "password berbeda, silahkan ulangi masukan password yang anda inginkan", "error");
		}
	});
</script>