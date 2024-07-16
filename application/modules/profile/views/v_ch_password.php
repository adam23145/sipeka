<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-primary card-outline">
				<div class="card-header">
	                <h3 class="card-title">Change Password</h3>
	            </div>
	            <div class="card-body">
					<form class="form-horizontal" id="form-passwd" method="POST" class="needs-validation">
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
						<input type="hidden" name="userid" id="userid" value="<?php echo $this->session->userdata['logged_in']['userid']; ?>">
		              <div class="form-group row">
		                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
		                <div class="col-sm-9">
		                  <input type="text" class="form-control" id="inputName" name="inputName" readonly="true">
		                </div>
		              </div>
		              <div class="form-group row">
		                <label for="inputpass1" class="col-sm-2 col-form-label">Password</label>
		                <div class="col-sm-8">
		                  <input type="password" class="form-control" id="inputpass1" name="inputpass1" placeholder="Input Password">
		                </div>
		                <div class="col-sm-2">
		                  	<div  class="custom-control custom-checkbox checkbox-primary m-b-20">
	                            <input type="checkbox" class="custom-control-input" id="customCheck">
	                            <label class="custom-control-label" onclick="myFunction()" for="customCheck">Show</label>
	                        </div>
		                </div>
		              </div>
		              <div class="form-group row">
		                <label for="inputpass2" class="col-sm-2 col-form-label">Repeat Password</label>
		                <div class="col-sm-8">
		                  <input type="password" class="form-control" id="inputpass2" name="inputpass2" placeholder="Repeat Password">
		                </div>
		                <div class="col-sm-2">
		                  	<div  class="custom-control custom-checkbox checkbox-primary m-b-20">
                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                <label class="custom-control-label" onclick="myFunction2()" for="customCheck2">Show</label>
                            </div>
		                </div>
		              </div>
		              <div class="form-group row">
		                <div class="offset-sm-2 col-sm-10">
		                  <button type="submit" class="btn btn-danger">Submit</button>
		                </div>
		              </div>
		            </form>
		        </div>
	        </div>
		</div>
	</div>
</div>