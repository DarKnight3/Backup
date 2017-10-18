</html>
	<head>
	
	
	
	<?php require "assets/php/script/extract.php";?>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<style>
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #a09b9b;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
  text-align: center;
}

body {
    color: #797979;
    background: #f2f2f2;
    font-family: 'Ruda', sans-serif;
    padding: 0px !important;
    margin: 0px !important;
    font-size: 13px;
}
.content-panel {
    background: #ffffff;
    box-shadow: 0px 3px 2px #aab2bd;
    padding-top: 15px;
    padding-bottom: 5px;
}
hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #797979;
}
	</style>
	</head>
	<body>
		
		<div>
			<section style="color:#797979" id="main-content">
				<section class="wrapper">
				 <div class="row mt">
							  <div class="col-md-12">
								  <div class="content-panel" >
									<h2 style="text-align:center"> Access Past Papers</h2>
								</div>
							</div>
				</div>
				<br/>
				  <div class="row">
					  <div  class="col-lg-9 main-chart">
						 
						 
							
						  <div class="row mt">
							  <div class="col-md-12">
								  
									 <div class="content-panel" >
									<a   href="assets/pdf/answer_sheet_template.pdf"  class="btn btn-success" download style="width:100%">Download Answer Sheet</a>
									</div>
							</div>
						</div>
						 <br/>
						   <div class="row mt">
						   
						   
							  <div class="col-md-12">
								  <div class="content-panel" >
									  <table class="table table-striped table-advance table-hover " >
										  <h3 style="text-align:center"> Questions By Topics</h3>
										  <hr/>
										  
										  
						<thead>
							<tr>
								<th> Topic </th>
								<th >View</th>																																
								
							</tr>
						</thead>
						<tbody>
					
					
							<?php

								error_reporting(E_ALL);

								
								$tutorials = "SELECT * FROM Tutorials ";
								$connectQuery = mysqli_query($db,$tutorials);

							?>
						
							
							<?php
									while($activerow = mysqli_fetch_assoc($connectQuery) ){
										
										$pdfIcon = "assets/img/pdflogo.png";
										$questionbook =$activerow["quizbook_path"];
										$Topic = $activerow["Titile"];					
										$creater = $activerow["posted_By"];
										$date = $activerow["Date"];
										
										
										echo"
					
												 <tr>
													
													
													
													<td> $Topic</td>	
													<td>
													<a data-toggle='modal' href='#acess_question' class='btn btn-primary'  >View Question Paper</a>
													
														<div aria-hidden='true' aria-labelledby='acess_question' role='dialog' tabindex='-1' id='acess_question' class='modal fade'>
														  <div class='modal-dialog'>
															  <div class='modal-content'>
																  <div class='modal-header'>
																	  <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
																	  <h4 class='modal-title'>View the Questions</h4>
																  </div>
																  
																  <div class='modal-body'>
																		<object data='$questionbook' type='application/pdf' width='100%' height='80%'>
																			<p><a href='$questionbook'></a></p>
																		</object>
														
																  </div>
																 
																  
															  </div>
														  </div>
													</div>
													
													</td>													
													
												  </tr>";
									}
							?>
						</tbody>
					 </table>
								  </div>
							  </div>
							
							   
						
							 
						  </div>
						   
					  </div>
					  
					  
					  <div  class="col-lg-3 main-chart">						 													
						  <div class="row mt">
							  <div class="col-md-12">								  
									 <div class="content-panel" >
												<div class="khanframe">
												<div class="khanlogo">
													<a href="https://www.khanacademy.org" target="_blank">
														<img class="wp-image-152304 size-full aligncenter" title="Khanacademy Organic Chemistry" src="http://olivershouse.co.za/wp-content/uploads/2014/05/YOx4ejCxaVDbHUABB91kTg-smaller_logo.png" alt="KhanAcademy" width="200" height="30">
													</a>
												</div>
												<p>&nbsp;</p>
												<p style="text-align: left;"><a href="http://www.khanacademy.org">KHANACADEMY</a>&nbsp;is a well known non profit educational website. KHANACADEMY has numerous excellent video tutorials on a wide range of subjects which can help you with your studies. Below are a few quick-links to some the subjects you might be taking.</p>
												<br/>
												<center>
												<div class="btn btn-success btn-block">
													<a href="https://www.khanacademy.org/math/algebra" target="_blank">Linear Algebra</a>
												</div>
												<br/>
												
											
												<div class="btn btn-success btn-block">
													<a href="https://www.khanacademy.org/math/calculus-home" target="_blank">Calculus</a>
												</div>
												
												<br/>
												<div class="btn btn-success btn-block">
													<a href="https://www.khanacademy.org/math/trigonometry" target="_blank">Trigonometry</a>
												</div>
												<br/>
												</center>
								
												
									 </div>
							   </div>
						  </div>
					  </div>
					  
					</div>
					</div>
				
				  <div class="row">
					 <div  class="col-lg-9 main-chart">
						 
						 
						   <div class="row mt">
								  <div class="col-md-12">
										  <div class="content-panel" >
												<div  class="row">
										
												<div class="col-xs-12">
													<a href="#" data-toggle="modal" data-target="#upload-modal" class="Try">
														<center><img class="img-responsive" align="center" src="./assets/img/arrow-up.png" style="width:150px; height:150px;" title="Upload scripts" /></center>
													</a>

												</div>
										
												</div>
									      </div>
									</div>
								</div>
							<br/>
					</div>
					</div>
				
				</section>
			</section>
		</div>
		

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
							if($date1>=$date2)
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

			<div class="modal-footer">
			<button data-dismiss="modal" type="button" class="btn btn-danger btn-lg btn3d" style="position:relative; left:0%;"><span class="glyphicon glyphicon-off"></span></button>
			</div>
			</div>
			</div>
			</div>
			
			
			
	</body>
</html>




<!--

<div class="khanframe">
<div class="khanlogo"><a href="https://www.khanacademy.org" target="_blank"><img class="wp-image-152304 size-full aligncenter" title="Khanacademy Organic Chemistry" src="http://olivershouse.co.za/wp-content/uploads/2014/05/YOx4ejCxaVDbHUABB91kTg-smaller_logo.png" alt="KhanAcademy" width="200" height="30"></a></div>
<p>&nbsp;</p>
<p style="text-align: left;"><a href="http://www.khanacademy.org">KHANACADEMY</a>&nbsp;is a well known non profit educational website. KHANACADEMY has numerous excellent video tutorials on a wide range of subjects which can help you with your studies. Below are a few quick-links to some the subjects you might be taking.</p>
<p class="khanbtn"><a href="https://www.khanacademy.org/math/algebra" onclick="__gaTracker('send', 'event', 'outbound-article', 'https://www.khanacademy.org/math/algebra', 'Algebra');" title="Algebra" target="_blank">Algebra</a></p>
<p class="khanbtn"><a href="https://www.khanacademy.org/math/geometry" onclick="__gaTracker('send', 'event', 'outbound-article', 'https://www.khanacademy.org/math/geometry', 'Geometry');" title="Geometry" target="_blank">Geometry</a></p>
<p class="khanbtn"><a href="https://www.khanacademy.org/math/trigonometry" onclick="__gaTracker('send', 'event', 'outbound-article', 'https://www.khanacademy.org/math/trigonometry', 'Trigonometry');" title="Trigonometry" target="_blank">Trigonometry</a></p>
<p class="khanbtn"><a href="https://www.khanacademy.org/science/chemistry" onclick="__gaTracker('send', 'event', 'outbound-article', 'https://www.khanacademy.org/science/chemistry', 'Chemistry');" title="Chemistry" target="_blank">Chemistry</a></p>
<p class="khanbtn"><a href="https://www.khanacademy.org/science/organic-chemistry" onclick="__gaTracker('send', 'event', 'outbound-article', 'https://www.khanacademy.org/science/organic-chemistry', 'Organic Chemistry');" title="Organic Chemistry" target="_blank">Organic Chemistry</a></p>
<p class="khanbtn"><a href="https://www.khanacademy.org/science/physics" onclick="__gaTracker('send', 'event', 'outbound-article', 'https://www.khanacademy.org/science/physics', 'Physics');" title="Physics" target="_blank">Physics</a></p>
<p class="khanbtn"><a href="https://www.khanacademy.org/science/biology" onclick="__gaTracker('send', 'event', 'outbound-article', 'https://www.khanacademy.org/science/biology', 'Biology');" title="Biology" target="_blank">Biology</a></p>
</div>
-->