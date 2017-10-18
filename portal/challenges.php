<!DOCTYPE html>
<head>
	<?php $title="Challenges | CAM";?>
	<?php require_once "assets/php/script/extract.php";?>
	<?php require_once absolute_filename('website-head.php', $shared_f);?>
	<style type="text/css">
		.img-practice
		{
			width:70%;
			height:198px;
			padding:10px;

		}
		.practice-box
		{
			width:90%;
			height:300px;
			/*border:solid 2px #1a8cff;*/
			margin: 10px auto;
			/*border-right: solid 1px  #1a8cff;*/
			
		}

		a.btn-practice
		{
			width: 101%;
			margin-left:-2px;
			background-color: #1a8cff;
			border-color: #1a8cff;
			border-radius: 0;
			display: none;
		}
		li {
  display: list-item;
  list-style-position: inside;
}
	</style>
</head>
<body>
	<div class="theme-layout">
		<?php require_once absolute_filename('website-header.php', $shared_f);?>

		<section>
			<div class="block" >
				<div class="container">

					<div class="row">
						<div class="col-md-2">
							<?php require_once absolute_filename('website-leader-board.php', $shared_f);?>
						</div>
						<div class="col-md-10">
							<h1 class="normal-text wow flipInX" data-wow-duration="3000ms" style="text-align: center; font-size: 60pt; margin-top:-40px">Challenges</h1>
							<h3 class="normal-text wow flipInX" data-wow-duration="3000ms" style="text-align: center; font-size: 30pt; ">Select level</h3>
							<div class="row">
								<div class="col-md-4" style="margin-top: 50px">
									<div class="practice-box  wow wobble" data-wow-duration="1900ms">
										<a data-toggle="modal" data-target="#easy-challenge" href="javascript::;" class="wow fadeIn"  data-wow-delay="2000ms"><img src="<?=$virtual_root?>/assets/img/1.png" class="img img-responsive img-practice wow wobble"/></a>
										<a data-toggle="modal" data-target="#easy-challenge" href="javascript::;" class="btn btn-primary btn-practice wow fadeIn"  data-wow-delay="2000ms">GO</a>
									</div>
								</div>
								<div class="col-md-4" style="margin-top: 50px">
									<div class="practice-box  wow flipInY" data-wow-duration="1900ms">
											<a data-toggle="modal" data-target="#medium-challenge" href="javascript::;" class=" wow fadeIn" data-wow-delay="2000ms"><img  src="<?=$virtual_root?>/assets/img/2.png" class="img img-responsive img-practice  wow flipInY"/></a>
										<a data-toggle="modal" data-target="#medium-challenge" href="javascript::;" class="btn btn-primary btn-practice wow fadeIn" data-wow-delay="2000ms">GO</a>
									</div>
								</div>
								<div class="col-md-4" style="margin-top: 50px">
									<div class="practice-box  wow wobble" data-wow-duration="1900ms">
										<a data-toggle="modal" data-target="#hard-challenge" href="javascript::;" class=" wow fadeIn" data-wow-delay="2000ms"><img  src="<?=$virtual_root?>/assets/img/3.png" class="img img-responsive img-practice  wow wobble"/></a>
										<a data-toggle="modal" data-target="#hard-challenge" href="javascript::;" class="btn btn-primary btn-practice wow fadeIn" data-wow-delay="2000ms">GO</a>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</body>
<div class="modal fade" id="easy-challenge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Easy Challenge</h4>
			</div>
		  	<div class="modal-body">
		  	<div class="row">
		  		<div class="col-md-12"><p class="label-black" style="font-size: 15pt">Please answer the question below, scan the answer and upload the pdf to the given upload slot, Good luck.</p><img src="assets/img/intergral.png" style="width:100%" class="img img-responsive" id="question_" />
		  			<form action="assets/php/script/mark_student.php" class="file" id="mark-scripts" enctype="multipart/form-data" method="post">					        
						<div class="form-group">
				
						  <input type="file" name="upload_file"  class="form-control placeholder-no-fix"><br/>
						  <input type="hidden" name="student_id" value="85422">
						  <input type="hidden" name="assesment_id" value="90">
						 </div><br/>
						 <div class="form-group">
							<center><button style="position:relative; left:0%;" type="submit" class="btn btn-success btn-lg btn3d submit-btn " ><span class="glyphicon glyphicon-ok"></span> Submit</button></center>
						</div>
						<div class="form-group">
							<div class="alert"></div>
						</div>
						<hr/>

							
						<div class="row" id="myProgress" style="display:none">
							<div class="col-md-12">
							 <center> <div class="loader"  ></div><br/><p class="label-marks" style="font-size:20pt; color:blue">Please wait while I mark your script</p></center>

							</div>
						</div>
							
						<br/>
						<div id="mark-results" ></div>
						
						
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
<div class="modal fade" id="medium-challenge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Medium Challenge</h4>
			</div>
		  	<div class="modal-body">
		  	<div class="row">
		  		<div class="col-md-12"><p class="label-black" style="font-size: 15pt">Please answer the question below, scan the answer and upload the pdf to the given upload slot, Good luck.</p><img src="assets/img/intergral.png" style="width:100%" class="img img-responsive" id="question_" />
		  			<form action="assets/php/script/mark_student.php" class="file" id="mark-scripts" enctype="multipart/form-data" method="post">					        
						<div class="form-group">
				
						  <input type="file" name="upload_file"  class="form-control placeholder-no-fix"><br/>
						  <input type="hidden" name="student_id" value="85422">
						  <input type="hidden" name="assesment_id" value="90">
						 </div><br/>
						 <div class="form-group">
							<center><button style="position:relative; left:0%;" type="submit" class="btn btn-success btn-lg btn3d submit-btn " ><span class="glyphicon glyphicon-ok"></span> Submit</button></center>
						</div>
						<div class="form-group">
							<div class="alert"></div>
						</div>
						<hr/>

							
						<div class="row" id="myProgress" style="display:none">
							<div class="col-md-12">
							 <center> <div class="loader"  ></div><br/><p class="label-marks" style="font-size:20pt; color:blue">Please wait while I mark your script</p></center>

							</div>
						</div>
							
						<br/>
						<div id="mark-results" ></div>
						
						
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
<div class="modal fade" id="hard-challenge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Hard Challenge</h4>
			</div>
		  	<div class="modal-body">
		  	<div class="row">
		  		<div class="col-md-12"><p class="label-black" style="font-size: 15pt">Please answer the question below, scan the answer and upload the pdf to the given upload slot, Good luck.</p><img src="assets/img/intergral.png" style="width:100%" class="img img-responsive" id="question_" />
		  			<form action="assets/php/script/mark_student.php" class="file" id="mark-scripts" enctype="multipart/form-data" method="post">					        
						<div class="form-group">
				
						  <input type="file" name="upload_file"  class="form-control placeholder-no-fix"><br/>
						  <input type="hidden" name="student_id" value="85422">
						  <input type="hidden" name="assesment_id" value="90">
						 </div><br/>
						 <div class="form-group">
							<center><button style="position:relative; left:0%;" type="submit" class="btn btn-success btn-lg btn3d submit-btn " ><span class="glyphicon glyphicon-ok"></span> Submit</button></center>
						</div>
						<div class="form-group">
							<div class="alert"></div>
						</div>
						<hr/>

							
						<div class="row" id="myProgress" style="display:none">
							<div class="col-md-12">
							 <center> <div class="loader"  ></div><br/><p class="label-marks" style="font-size:20pt; color:blue">Please wait while I mark your script</p></center>

							</div>
						</div>
							
						<br/>
						<div id="mark-results" ></div>
						
						
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
<?php require_once absolute_filename('website-modals.php', $shared_f);?>
</html>

