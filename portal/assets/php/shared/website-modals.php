<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Login To Your Account</h4>
		</div>
	  	<div class="modal-body">
				<form class="form-login" method="post" action="assets/php/script/login.php" id="login_">
		        <div class="login-wrap">
		            <input type="text" class="form-control" name="username" placeholder="Username"  autofocus>
		            <br><br>
								<br>
		            <input type="password" class="form-control" name="password" placeholder="Password">
								
								<br>
								<br>
								<br>

								
								<label class="custom-control custom-checkbox" style="margin-left:-10px; margin-top: 20px">
										<input type="checkbox" class="custom-control-input" style="display:none;">
										<span class="custom-control-indicator"></span> Remember my details
								</label>

		             <button type="submit" id="submit-btn" class="btn btn-success btn-lg btn3d" style="position:relative; right:0%; top:57%; margin-right: 0px"><span class="glyphicon glyphicon-ok"></span> Sign In</button><br/>
						<hr/>
		            	<div id="error"></div>
		            				            
		            	<div class="row">
			            <div class=" col-md-6 col-sm-6" style="text-align: center; margin-left:-30px">
			                Don't have an account yet?<br/>
			            <!-- <a  data-toggle="modal" href="login#activation">Request Access</a> -->
			            </div>

			            <br/>
			            <br/>
			            <br/>
			        </div>
		        </div>
				</form>
	 		</div>

	  		<div class="modal-footer">
	    		<button data-dismiss="modal" type="button" class="btn btn-danger btn-lg " ><span class="glyphicon glyphicon-off"></span></button>
	  		</div>
	  	</div>
	</div>
</div>
