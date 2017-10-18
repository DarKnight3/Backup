<!DOCTYPE html>
<html>
	<head>
		<?php isset($virtual_root)?:$virtual_root=".";?>
		<?php require "assets/php/script/extract.php";?>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>Caracal Mathematics Auto-Gradrading System</title>

		<link rel="stylesheet" href="./assets/css/bootstrap-3.3.4-dist/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="./assets/css/_style.css"/>
		<link rel="stylesheet" href="./assets/css/buttons.css"/>
		<link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative|Cuprum|Megrim|Oswald:500" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
		<link rel="icon" type="image/png" href="./assets/img/icon.png" />
		<link rel="stylesheet" type="text/css" href="<?=$virtual_root;?>/assets/css/animate.css">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

		<script src="./assets/js/jquery-2.1.3.min.js"></script>
		<script src="./assets/js/ajax.js"></script>
		<script src="./assets/js/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
		<script src="<?=$virtual_root;?>/assets/js/jquery-2.1.3.min.js"></script>
		<script src="<?=$virtual_root;?>/assets/js/ajax.js"></script>
		<script src="<?=$virtual_root;?>/assets/js/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
		<script src="<?=$virtual_root;?>/assets/js/jquery-3.1.0.min.js" type="text/javascript"></script>
		<script src="<?=$virtual_root;?>/assets/js/wow.min.js"></script>
		<script>
			new WOW().init();
		</script>

	</head>

	<body>
<div id="mycarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#mycarousel" data-slide-to="0" class="active"></li>
      <li data-target="#mycarousel" data-slide-to="1"></li>
      <!-- <li data-target="#mycarousel" data-slide-to="2"></li> -->
      
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox" >
      <div class="item" >
          <img src="assets/img/math_blur.jpg" data-color="lightblue" alt="First Image">
	          <div class="carousel-caption">
	             <div class="container">
			        <div class="row">
			        	
			          <div class="intro-box">
			              <div class="intro" style="text-align: center">
			                  <h1 class="title"><span style="color:#1a8cff; font-size:100px;" class="wow wobble" data-wow-duration="3000ms">C</span>ARACAL <span style="color:#1a8cff; font-size:100px;">M</span>ATHS <span style="color:#1a8cff; font-size:100px;">A</span>UTO-<span style="color:#1a8cff; font-size:100px;">G</span>RADER</h1>
			                  <p id="slogan">An OCR Grading System For Mathematics Papers</p>
			                  <p class="writing" style="font-size:16pt">click on the arrow to see more info</p><br>

			                   <button data-toggle="modal" data-target="#demo-modal"  class="guest-btn center-btn btn btn-magick btn-lg btn3d" ><span class="glyphicon glyphicon-gift"></span>  Try me</button>
			              </div>
			          </div><br/>
			      </center>
			        </div>
				</div>
			</div>
      </div>
      <div class="item">
          <img src="assets/img/math_blur-2.png" data-color="firebrick" alt="Second Image">
          <div class="carousel-caption">
          		<center><h1 style="margin-top: -60px; font-size:40pt; text-align: center">How it works</h1></center>
          <div class="intro-box">
			              <div class="intro">
			                

			           			              </div>
			          </div><br/>
			
				
				


          </div>
      </div>
      
      
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#mycarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#mycarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <!--Test modal-->
  <div class="modal fade" id="test-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Select Test</h4>
					</div>
				  	<div class="modal-body">
							<p id="TryLabel">PICK A TEST!<p>
							<div  class="row">
								<div class="col-xs-4">
								  <a href="#" class="Try">
								    <img class="img-responsive"  src="assets/img/algebra.png" /><br/>
								  </a>
								</div>
								<div class="col-xs-4">
								  <a href="#" class="Try">
								    <img class="img-responsive" align="center" src="./assets/img/series.png" /><br/>
								  </a>
								</div>
								<div class="col-xs-4">
								  <a href="#" class="Trys">
								    <img class="img-responsive" align="center" src="./assets/img/calculus.png" s/><br/>
								  </a>
								</div>
							</div>
				 		</div>

				  		<div class="modal-footer">
				    		<button data-dismiss="modal" type="button" class="btn btn-danger btn-lg btn3d" style="position:relative; left:0%;"><span class="glyphicon glyphicon-off"></span></button>
				  		</div>
				  	</div>
				</div>
			</div>
		</div>
	<!--Login modal-->
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
					            <br>
					            <input type="password" class="form-control" name="password" placeholder="Password">
											<br>

											
											<label class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" style="display:none;">
													<span class="custom-control-indicator"></span> Remember my details
											</label>

					            <button type="submit" id="submit-btn" class="btn btn-success btn-lg btn3d" style="position:relative; right:0%; top:57%; margin-right: 0px"><span class="glyphicon glyphicon-ok"></span> Sign In</button><br/>
									<hr/>
					            	<div id="error"></div>
					            <div class="row registration">
						            <div class="registration col-md-6 col-sm-6">
						                Don't have an access yet?<br/>
						            <a  data-toggle="modal" href="login#activation">Request Access</a>
						            </div>

						            
						        </div>
					        </div>
							</form>
				 		</div>

				  		<div class="modal-footer">
				    		<button data-dismiss="modal" type="button" class="btn btn-danger btn-lg btn3d" style="position:relative; left:0%;"><span class="glyphicon glyphicon-off"></span></button>
				  		</div>
				  	</div>
				</div>
			</div>
		</div>

		<!-- Request access modal-->
		<div class="modal fade" id="request-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Request access</h4>
					</div>
				  	<div class="modal-body">
							<form class="form-login general" method="post" action="assets/php/script/insert.php" id="request_">
					        <div class="login-wrap">
					            <input type="text" class="form-control" name="db_name" placeholder="Database name"  autofocus>
					            <br>
					            <input type="text" class="form-control" name="db_username" placeholder="database username"  autofocus>
					            <br>
					            <input type="password" class="form-control" name="db_password" placeholder="database password"  autofocus>
					            <br>
					            <input type="text" class="form-control" name="db_ip_address" placeholder="ip address"  autofocus><br/>
					            <input type="text" class="form-control" name="school_name" placeholder="school name"  autofocus>
					            <br>
					            
							
					            <button type="submit" class="btn btn-success btn-lg btn3d submit-btn" style="position:relative; right:0%; top:57%; margin-right: 0px"><span class="glyphicon glyphicon-ok"></span> Submit</button><br/>
									<hr/>
					            	<div class="alert"></div>
					            <div class="row registration">
						            <div class="registration col-md-6 col-sm-6">
						                Already have an account?<br/>
						            <a  data-toggle="modal" href="#login-modal">Login</a>
						            </div>

						            
						        </div>
					        </div>
							</form>
				 		</div>

				  		<div class="modal-footer">
				    		<button data-dismiss="modal" type="button" class="btn btn-danger btn-lg btn3d" style="position:relative; left:0%;"><span class="glyphicon glyphicon-off"></span></button>
				  		</div>
				  	</div>
				</div>
			</div>
		</div>
		<!--Request access end-->
		<?php if(isset($_SESSION['caracal_student'])):?>
					<!-- Query marks modal-->
		<div class="modal fade" id="query-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Query marks</h4>
					</div>
				  	<div class="modal-body">
				  			<?php
				            	$temp_id=$_SESSION['caracal_student']['details']['student_id'];
				            	$temp=$tables['mark_sheet']->select_where(array('student_id'=>$temp_id));
				            	$assesments_=array();
				            	if(isset($temp))
				            	{
				            		foreach ($temp as $key => $value) 
				            		{
				            			$temp_=$tables['assesment']->select_where(array('assesment_id'=>$value['assesment_id']));
				            			if(isset($temp_[0]))
				            			{
				            				array_push($assesments_, $temp_[0]);
				            			}
				            			unset($temp_);
				            		}
				            	}

					            ?>
							<form class="form-login general" method="post" action="assets/php/script/insert.php" id="request_">
					        <div class="login-wrap">
					           	<p class="label-black">Select Assesment</p>
								  <select type="text" name="assesment_id" class="form-control placeholder-no-fix">
									<?php if(isset($assesments_)):?>
									<?php foreach($assesments_ as $value):?>
										<option value="<?=$value['assesment_id']?>"><?=$value['name']?></option>
									<?php endforeach;?>
									<?php endif;?>
									
								  </select>
					            <br>
					            <textarea rows="6" type="text" class="form-control" name="message" placeholder="Write your message here ..."  autofocus></textarea>
					            <br>
					            <input type="hidden" name="user_id" value="<?=$_SESSION['caracal_student']['user_id']?>">
							
								<input type="hidden" name="table" value="query"/>
					            <button type="submit" class="btn btn-success btn-lg btn3d submit-btn" style="position:relative; right:0%; top:57%; margin-right: 0px"><span class="glyphicon glyphicon-ok"></span> Submit</button><br/>
									<hr/>
					            	<div class="alert"></div>
					        </div>
							</form>
				 		</div>

				  		<div class="modal-footer">
				    		<button data-dismiss="modal" type="button" class="btn btn-danger btn-lg btn3d" style="position:relative; left:0%;"><span class="glyphicon glyphicon-off"></span></button>
				  		</div>
				  	</div>
				</div>
			</div>
		</div>
		<!--Query marks end-->
					<!--  marks modal-->
		<div class="modal fade" id="marks-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Grades</h4>
					</div>
				  	<div class="modal-body">
				  			<?php
							$temp_id=$_SESSION['caracal_student']['details']['student_id'];
							$temp=$tables['mark_sheet']->select_where(array('student_id'=>$temp_id));
							$assesments_=array();
							if(isset($temp))
							{
								foreach ($temp as $key => $value) 
								{
									$temp_=$tables['assesment']->select_where(array('assesment_id'=>$value['assesment_id']));
									if(isset($temp_[0]))
									{	
										$temp_[0]['submissions']=$value['submissions'];
										$temp_[0]['date_marked']=$value['date_marked'];
										$temp_[0]['mark']=$value['mark'];

										array_push($assesments_, $temp_[0]);
									}
									unset($temp_);
								}
							}

						    ?>
							<table class="table table-striped table-advance table-hover">
							  	  <h3 style="text-align:center"> Assesments</h3>
							  	  <hr>
							  <?php if(isset($assesments_)):?>
							  <thead>
							  <tr>
							      <th><i class="fa fa-bullhorn"></i> Name</th>
							      <th><i class="fa fa-bullhorn"></i> Type</th>
							      <th class="hidden-phone"><i class="fa fa-question-circle"></i> Date marked</th>
							      <th><i class="fa fa-bookmark"></i>Submissions</th>
							      <th><i class=" fa fa-status"></i> Mark</th>
							      <th><i class=" fa fa-date"></i> Due date</th>
								
							  </tr>
							  </thead>
							  <tbody>
							  
							  <?php foreach($assesments_ as $value):?>
							  <tr>
							      <td><?=$value['name']?></td>
							      <td><?=$value['type']?></td>
							      <td class="hidden-phone"><?=$value['date_marked']?></td>
							      <td><span class="label label-info label-mini"><?=$value['submissions']?></span></td>
								  <td><?=$value['mark']?></td>
								  <td><?=$value['assesment_end_date']?></td>
								
							  </tr>

							  <?php endforeach;?>
							  </tbody>
							<?php endif;?>
							</table>
				 		</div>

				  		<div class="modal-footer">
				    		<button data-dismiss="modal" type="button" class="btn btn-danger btn-lg btn3d" style="position:relative; left:0%;"><span class="glyphicon glyphicon-off"></span></button>
				  		</div>
				  	</div>
				</div>
			</div>
		</div>
		<!-- marks end-->
		<!-- upload script modal-->
		<div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Upload script</h4>
					</div>
				  	<div class="modal-body">
							<form action="assets/php/script/mark_student.php" class="file" id="mark-scripts" enctype="multipart/form-data" method="post">					        
							<div class="login-wrap">
					            <?php
					            	$temp_id=$_SESSION['caracal_student']['details']['student_id'];
					            	$temp=$tables['mark_sheet']->select_where(array('student_id'=>$temp_id));
					            	$assesments_=array();
					            	if(isset($temp))
					            	{
					            		foreach ($temp as $key => $value) 
					            		{
					            			$temp_=$tables['assesment']->select_where(array('assesment_id'=>$value['assesment_id']));
					            			if(isset($temp_[0]))
					            			{
					            				
					            				$date1=strtotime($temp_[0]['assesment_end_date']);
												$date2=strtotime(date('Y-m-d'));
    											if($date1>$date2)
    											{
    												$temp_[0]['_submissions']=$value['submissions'];
					            					array_push($assesments_, $temp_[0]);
    											}
					            			}
					            			unset($temp_);
					            		}
					            	}

					            ?>
								<p class="label-black">Select Assesment</p>
								  <select type="text" name="assesment_id" class="form-control placeholder-no-fix">
									<?php if(isset($assesments_)):?>
									<?php foreach($assesments_ as $value):?>
										<option value="<?=$value['assesment_id']?>"><?=$value['attempts']-$value['_submissions']?> Attempts left : <?=$value['name']?></option>
									<?php endforeach;?>
									<?php endif;?>
									
								  </select>
								  <br/>
								  <input type="file" name="upload_file"  class="form-control placeholder-no-fix"><br/>
								  <input type="hidden" name="student_id" value="<?=$_SESSION['caracal_student']['details']['student_id']?>">
								
					            <button type="submit" class="btn btn-success btn-lg btn3d submit-btn " style="position:relative; right:0%; top:57%; margin-right: 0px"><span class="glyphicon glyphicon-ok"></span> Submit</button>
					            <div class="alert"></div>
								<hr/>
				            	
					          	<div id="all-load" style="display: none">
									
									<div class="row">
										<div class="col-md-12">
											<div id="myProgress">
											<div id="myBar">0%</div>
										</div>
										</div>
									</div>
									<br/>
									<div id="mark-results" ></div>
								</div>
					        </div>
							</form>
				 		</div>

				  		<div class="modal-footer">
				    		<button data-dismiss="modal" type="button" class="btn btn-danger btn-lg btn3d" style="position:relative; left:0%;"><span class="glyphicon glyphicon-off"></span></button>
				  		</div>
				  	</div>
				</div>
			</div>
		</div>
		<!--upload script modal end-->

		
		<?php endif;?>
		<!-- demo question modal-->
		<div class="modal fade" id="demo-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Demo Question</h4>
					</div>
				  	<div class="modal-body">
				  	<div class="row">
				  		<div class="col-md-12"><p class="label-black" style="font-size: 15pt">Please answer the question below, scan the answer and upload the pdf to the given upload slot, Good luck.</p><img src="assets/img/intergral.png" class="img img-responsive" id="question_" />
				  			<form action="assets/php/script/mark_student.php" class="file" id="mark-scripts" enctype="multipart/form-data" method="post">					        
								<div class="login-wrap">
						
								  <input type="file" name="upload_file"  class="form-control placeholder-no-fix"><br/>
								  <input type="hidden" name="student_id" value="85422">
								  <input type="hidden" name="assesment_id" value="90">

								<center><button style="position:relative; left:0%;" type="submit" class="btn btn-success btn-lg btn3d submit-btn " ><span class="glyphicon glyphicon-ok"></span> Submit</button></center>
								<div class="alert"></div>
								<hr/>

									
										<div class="row" id="myProgress" style="display:none">
										<div class="col-md-12">
										 <center> <div class="loader"  ></div><br/><p class="label-marks" style="font-size:20pt; color:blue">Please wait while I mark your script</p></center>

										</div>
										</div>
									
									<br/>
									<div id="mark-results" ></div>
								
								</div>
								</form>
				  		</div>
				  	</div>
			 		</div>

			  		<div class="modal-footer">
			    		<button data-dismiss="modal" type="button" class="btn btn-danger btn-lg btn3d" style="position:relative; left:0%;"><span class="glyphicon glyphicon-off"></span></button>
			  		</div>
				  	</div>
				</div>
			</div>
		</div>
		<!-- demo question modal end-->
		<nav class="navbar navbar-fixed-top navbar-transparent">
			<div class="container-fluid">
				<div class="navbar-header">
					<a style="font-family: 'Dancing Script', sans-serif; font-size:40px; color:white;" class="navbar-brand" href="home">Cam</a>
				</div>
				<div id="menu">
					<ul class="nav navbar-nav navbar-right">
						<li><a  href="tutorial" style="font-size:20px"><span class="glyphicon glyphicon-pencil"></span>  TUTORIALS </a></li>
					<?php if(!isset($_SESSION['caracal_user']['firstname']) ):?>
						<li><a href="#" data-toggle="modal" data-target="#login-modal" style="font-size:20px; border-right:none;"><span class="glyphicon glyphicon-log-in"></span> LOGIN</a></li>
					<?php elseif( isset($_SESSION['caracal_user']['firstname'])):?>
						<li><a href="dashboard"  style="font-size:20px; border-right:none;"><span class="glyphicon glyphicon-user" style="margin-right: 5px"></span> <?=$_SESSION['caracal_user']['firstname']?> <?=$_SESSION['caracal_user']['lastname']?></a></li>
						<li><a href="assets/php/shared/logout.php" style="font-size:20px"><span class="glyphicon glyphicon-lock"></span> LOGOUT</a></li>
					<?php elseif(isset($_SESSION['caracal_student'])):?>
						<li><a href="dashboard" data-toggle="modal" data-target="#profile-modal" style="font-size:20px; border-right:none;"><span class="glyphicon glyphicon-user" style="margin-right: 5px"></span> <?=$_SESSION['caracal_student']['firstname']?> <?=$_SESSION['caracal_student']['lastname']?></a></li>
						<li><a href="assets/php/shared/logout.php" style="font-size:20px"><span class="glyphicon glyphicon-lock"></span> LOGOUT</a></li>
					<?php endif;?>
					<?php if(!isset($_SESSION['caracal_student']['firstname']) && !isset($_SESSION['caracal_user']['firstname'])):?>
						<li><a  data-toggle="modal" href="#request-modal" style="font-size:20px"><span class="glyphicon glyphicon-lock"></span> REQUEST ACCESS</a></li>
					<?php endif;?>
						<li><a  href="how-to" style="font-size:20px; margin-top:2px"><span class="glyphicon glyphicon-info-sign"></span></a></li>
					</ul>
				</div>
			</div>
		</nav>



	</body>

    <script src="assets/js/index.js"></script>
</html>
