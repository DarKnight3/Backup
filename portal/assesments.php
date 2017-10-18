<!DOCTYPE html>
<html lang="en">
  <head>
  <?php 
  $title="Assesments";
  $marking_a="active";
  ?>
  <?php require "assets/php/script/extract.php";?>
	<?php require "assets/php/shared/head.php";?>
	<link rel="stylesheet" href="./assets/css/buttons.css"/>
	<link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative|Cuprum|Megrim|Oswald:500" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
<style>
/* Center the loader */
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
</style>

  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
	<?php require "assets/php/shared/header.php";?>	
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
    <?php require "assets/php/shared/sidebar.php";?>	
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-9 main-chart">
                  <div class="row mt">

                  <div class="col-md-12">
                      <div class="content-panel" >
                          <table class="table table-striped table-advance table-hover " >
	                  	  	  <h3 style="text-align:center"> Marking assesments</h3>
	                  	  	  <hr>
							  <?php if(isset($assesments)):?>
							  	<?php
							  	$assesments=array_reverse($assesments);

							  	?>
                              <thead>
                              <tr>
                                  <th><i class="fa fa-bullhorn"></i> Name</th>
                                  <th><i class="fa fa-bullhorn"></i> Type</th>
                                  <th class="hidden-phone"><i class="fa fa-question-circle"></i> Papers Uploaded</th>
                                  <th><i class="fa fa-bookmark"></i> Papers Marked</th>
                                  <th><i class=" fa fa-status"></i> Status</th>
                                  <th><i class=" fa fa-date"></i> Assesment Initiation date</th>
								  <?php if($_SESSION['caracal_user']['role']=="Admin"):?>
									<th></th>
								  <?php endif;?>
                              </tr>
                              </thead>
                              <tbody>
							  
							  <?php foreach($assesments as $value):?>
                              <tr>
                              	<?php
	                              	if($value['no_papers_uploaded']>0){ 
	                              	$m_status=ceil(($value['no_papers_marked']/$value['no_papers_uploaded'])*100) ;
	                              }
	                              else
	                              {
	                              	$m_status=0;
	                              }
                              	if($m_status>=100) $m_status=100;
                              	?>
                                  <td><?=$value['name']?></td>
                                  <td><?=$value['type']?></td>
                                  <td class="hidden-phone"><?=$value['no_papers_uploaded']?></td>
                                  <td><?=$value['no_papers_marked']?></td>
                                  <td><span class="label label-info label-mini"><?=$m_status;?>%</span></td>
								  <td><?=$value['assesment_date']?></td>
								  <td>
								  <?php if($value['scripts_available']==1 && $value['memo_id']!=null):?>
                                      <a href="../marker/src/mark-scripts.php?path=<?=$value['scripts_path'];?>&memo_id=<?=$value['memo_id']?>" class="btn btn-primary btn-xs mark-btn" style="background-color:#42f448; border:none"><i class="fa fa-check" title="Start marking"> Mark</i></a>
                                    <?php else:?>
                                    	<a  class="btn btn-primary btn-xs mark-btn disabled" style="background-color:#42f448; border:none"><i class="fa fa-check" title="Start marking"> Mark</i></a>
                                    <?php endif;?>
								  <?php if($_SESSION['caracal_user']['role']=="Admin"):?>
                                                                  	
                                      <a data-toggle="modal" href="#edit_assesment_<?=$value['assesment_id']?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil" title="edit assesment"></i></a>
                                      <a  class="btn btn-danger btn-xs delete-btn" href="assets/php/script/delete.php?assesment_id=<?=$value['assesment_id']?>&table=assesment" ><i class="fa fa-trash-o " title="delete assesment"></i></a>                            
								  <?php endif;?>
								  </td>
                              </tr>
							<div aria-hidden="true" aria-labelledby="edit_assesment_<?=$value['assesment_id']?>" role="dialog" tabindex="-1" id="edit_assesment_<?=$value['assesment_id']?>" class="modal fade">
								  <div class="modal-dialog">
									  <div class="modal-content">
										  <div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											  <h4 class="modal-title">Edit assesment</h4>
										  </div>
										  <form method="post"  class="general" id="ass_form_<?=$value['assesment_id']?>" action="assets/php/script/update.php">
										  <div class="modal-body">
												<!--<p style="text-align:center">Assesment date</p>
											  <input type="date" name="assesment_date"  class="form-control placeholder-no-fix"><br/>-->
											  <p>Name</p>
											  <input type="text" name="name" placeholder="Name" value="<?=$value['name']?>" class="form-control placeholder-no-fix"><br/>
											  <p>Papers to be uploaded</p>
											  <input type="text" name="no_papers_uploaded" placeholder="Name" value="<?=$value['no_papers_uploaded']?>" class="form-control placeholder-no-fix"><br/>
											  <select class="form-control placeholder-no-fix" name="type">
											  	<option value="assignment">Assignment</option>
											  	<option value="exam">Exam</option>
											  	<option value="test">Test</option>
											  </select><br/>
											  <input type="hidden" name="assesment_id" value="<?=$value['assesment_id']?>"/>
											  <input type="hidden" name="id_name" value="assesment_id"/>
											  <input type="hidden" name="table" value="assesment"/>
										  </div>
										  <div class="modal-footer">
											  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
											  <button class="btn btn-theme submit-btn" type="submit">Submit</button><br/>
											  
										  </div>
										  <div class="alert"></div>
										  </form>
									  </div>
								  </div>
							</div>

							  <?php endforeach;?>
							  </tbody>
							  <?php else:?>
								<tr>
								<?php if($_SESSION['caracal_user']['role']=="Admin"):?>
                                 <h4 style="text-align:center">No assessments added <a data-toggle="modal" href="#add_assesment">click here</a> to add a new assesment</h4>
								 <?php else:?>
								  <h4 style="text-align:center">No assessments added </h4>
								 <?php endif;?>
								</tr>
							  <?php endif;?>

                          </table>
                          
                      </div><!-- /content-panel -->
                      
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->
			  <?php if($_SESSION['caracal_user']['access_level']==1000):?>
			  <div class="row mt">
				 <div class="col-md-12">
                      <div class="content-panel" >
                          <table class="table table-striped table-advance table-hover " >
						  
	                  	  	  <h3 style="text-align:center"> Manage Tutorials</h3>
						  <thead>
							<tr>
								
															
								<th> Asessment Type </th>
								<th> Assement Name</th>
								<th> Date Created </th>
								<th> Posted By </th>
								
								

							</tr>
						</thead>
						<tbody>
					
					
							<?php

								error_reporting(E_ALL);
								//require_once "connectionFile.php";
								
								$tutorials = "SELECT * FROM Tutorials ";
								$connectQuery = mysqli_query($db,$tutorials);

							?>
						
							
							<?php
									while($activerow = mysqli_fetch_assoc($connectQuery) ){
										$answerbook= "answerbook";
										$questionbook =$activerow["quizbook_path"];
										$Type = $activerow["Type"];					
										$creater = $activerow["posted_By"];
										$date = $activerow["Date"];
										$name = $activerow["Titile"];
										
										//$currentID = $activerow['PostId'];
										//<td class='image-holder'><img id='propatyPicture' width='204' height='136' src='$filePath/$fileName' class='img-rounded' alt='properties'/><td>											
										//<td ><a href='property-detail.php' title='$currentID' class=' abc btn btn-primary'>get marked</a></td>
										echo"
					
												 <tr>
													
													<td> $Type</td>
													<td>$name </td>														
													<td>$date </td>	
													<td>$creater </td>	
													
													
													
									";
									}
							?>
						</tbody>
						</table>
						  
						</div>
				  </div>
			  </div>
			   <?php endif;?>
			  <div >
			   <br/>
				  <div class="row">
		  			<div class="col-md-12" >
						<div class="row" id="myProgress" style="display:none">
							<div class="col-md-12">
							 	<center> <div class="loader"  ></div><br/><p class="label-marks" style="font-size:20pt; color:blue">Please wait while I mark the script</p></center>

							</div>
						</div>
					</div>
				  </div>
				 <br/>
                           <div id="mark-results" ></div>
                   <br/>
			  </div>
			  <br/>
				  <div class="row">
					  <?php if($_SESSION['caracal_user']['access_level']>=200):?>
						<div class="col-md-6">
							<a  data-toggle="modal" href="#add_assesment" class="btn btn-primary" style="width:100%">Create assesment</a>
						</div>
						<div class="col-md-6">
							<a data-toggle="modal" href="#upload_papers" class="btn btn-primary" style="width:100%">Upload scripts</a>
						</div>
							<?php if($_SESSION['caracal_user']['access_level']>=500):?>
								<div class="col-md-6">
									<a data-toggle="modal" href="#create_tutorial" class="btn btn-primary" style="width:100%">create a tutorial</a>
								</div>
								<div class="col-md-6">
									<a data-toggle="modal" href="#upload_tutorials" class="btn btn-primary" style="width:100%">Upload past paper</a>
									</div>
							<?php endif;?>
						<?php else:?>
							
							<div class="col-md-12">
							<a data-toggle="modal" href="#upload_papers" class="btn btn-primary" style="width:100%">Upload script</a>
							</div>
						<?php endif;?>
				  </div>
			  
			  <br/>
			  <br/>
			  <br/>
			 

                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  <!--Modals-->
					<div aria-hidden="true" aria-labelledby="add_assesment" role="dialog" tabindex="-1" id="add_assesment" class="modal modal-close-refresh fade">
						  <div class="modal-dialog">
							  <div class="modal-content">
								  <div class="modal-header">
									  <button type="button" class="close page-refresh" data-dismiss="modal" aria-hidden="true">&times;</button>
									  <h4 class="modal-title">Add new assesment</h4>
								  </div>
								  <form method="post"  class="general" id="add_assesment_form" action="assets/php/script/insert.php">
								  <div class="modal-body">
										<!--<p style="text-align:center">Assesment date</p>
									  <input type="date" name="assesment_date"  class="form-control placeholder-no-fix"><br/>-->
									  <input type="text" name="name" placeholder="Name" class="form-control placeholder-no-fix"/><br/>
									  <input type="text" name="no_papers_uploaded" placeholder="Number of papers to be marked" class="form-control placeholder-no-fix"/><br/>
									  <p style="text-align: center">Submission start date</p>
									  <input type="date" name="assesment_start_date" placeholder="Start date" class="form-control placeholder-no-fix"><br/>
									  <p style="text-align: center">Due date</p>
									  <input type="date" name="assesment_end_date" placeholder="End date" class="form-control placeholder-no-fix"><br/>
									  <input type="int" name="attempts" placeholder="Attempts allowed" class="form-control placeholder-no-fix"><br/>
									  <select class="form-control placeholder-no-fix" name="type">
									  	<option value="assignment">Assignment</option>
									  	<option value="exam">Exam</option>
									  	<option value="test">Test</option>
									  </select>
									  <input type="hidden" name="creator_id" value="<?=$_SESSION['caracal_user']['user_id']?>"/><br/>
									  <input type="hidden" name="table" value="assesment"/><br/>
								  </div>
								  <div class="modal-footer">
									  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
									  <button class="btn btn-theme submit-btn" type="submit">Submit</button><br/>
									  <div class="alert"></div>
								  </div>
								  </form>
							  </div>
						  </div>
					</div>
					
					<div aria-hidden="true" aria-labelledby="upload_papers" role="dialog" tabindex="-1" id="upload_papers" class="modal modal-close-refresh fade">
						  <div class="modal-dialog">
							  <div class="modal-content">
								  <div class="modal-header">
									  <button type="button" class="close page-refresh" data-dismiss="modal" aria-hidden="true">&times;</button>
									  <h4 class="modal-title">Upload script</h4>
								  </div>
								  <form action="assets/php/script/upload_files.php" class="file" id="upload_papers_form" enctype="multipart/form-data" method="post">
								  <div class="modal-body">
									
									<p>Select Assesment
									  <select type="text" name="assesment_id" class="form-control placeholder-no-fix">
										<?php if(isset($assesments)):?>
										<?php foreach($assesments as $value):?>
											<option value="<?=$value['assesment_id']?>. <?=$value['name']?>"><?=$value['name']?></option>
										<?php endforeach;?>
										<?php endif;?>
										
									  </select>
									  <br/>

									  <!-- <input type="file" name="student_id" placeholder="Student no"  class="form-control placeholder-no-fix"><br/> -->
									  <input type="file" name="upload_file" placeholder="Number of Papers"  class="form-control placeholder-no-fix"><br/>
								
								  </div>
								  <div class="modal-footer">
									  <button data-dismiss="modal" class="btn btn-default" type="button">Done</button>
									  <button class="btn btn-theme submit-btn" type="submit">Submit</button><br/>
									  <div class="alert"></div>
								  </div>
								  	</form>
							  </div>
						  </div>
					</div>
					
					
					<div aria-hidden="true" aria-labelledby="upload_tutorials" role="dialog" tabindex="-1" id="upload_tutorials" class="modal modal-close-refresh fade">
						  <div class="modal-dialog">
							  <div class="modal-content">
								  <div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									  <h4 class="modal-title">Upload past paper</h4>
								  </div>
								  <form action="assets/php/script/upload_pastpaper.php" class="file" id="upload_tutorials_form" enctype="multipart/form-data" method="post">
								  <div class="modal-body">
									
									<p>Select  Tutorial
									  <select type="text" name="tutorial_id" class="form-control placeholder-no-fix">
										<?php if(isset($tutorial)):?>
										<?php foreach($tutorial as $value):?>
											<option value="<?=$value['tutorial_id']?>"><?=$value['Titile']?></option>
										<?php endforeach;?>
										<?php endif;?>
										
									  </select>
									  <br/>
									  <input type="file" name="paper" placeholder="Past Paper"  class="form-control placeholder-no-fix"/><br/>
								
								  </div>
								  <div class="modal-footer">
									  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
									  <button class="btn btn-theme submit-btn" type="submit">Submit</button><br/>
									  <div class="alert"></div>
								  </div>
								  	</form>
							  </div>
						  </div>
					</div>
					
					
					<div aria-hidden="true" aria-labelledby="create_tutorial" role="dialog" tabindex="-1" id="create_tutorial" class="modal modal-close-refresh fade">
						  <div class="modal-dialog">
							  <div class="modal-content">
								  <div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									  <h4 class="modal-title">Add new tutorial</h4>
								  </div>
								  <form method="post"  class="general" id="create_tutorial_form" action="assets/php/script/insert_tutorial.php">
									  <div class="modal-body">
											
										 <select class="form-control placeholder-no-fix" name="type">											
											<option value="tutorial">tutorial</option>
											<option value="past_paper">past paper</option>
										  </select>	<br/>								 																	 
										  <input type="text" name="name" placeholder="Name" class="form-control placeholder-no-fix"><br/>										  									
										  <input type="hidden" name="table" value="assesment"/><br/>
									  </div>
									  <div class="modal-footer">
										  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
										  <button class="btn btn-theme submit-btn" type="submit">Submit</button><br/>
										  <div class="alert"></div>
									  </div>
								  </form>
							  </div>
						  </div>
					</div>
					
                  <?php require "assets/php/shared/right_sidebar.php";?>
      
              </div><!--/row -->
          </section>
      </section>
	  
	  	    <!--Model to generate reports-->

<div aria-hidden="true" aria-labelledby="generate_Report" role="dialog" tabindex="-1" id="generate_Report" class="modal fade">
<div class="modal-dialog">
  <div class="modal-content">
	  <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		  <h4 class="modal-title">generate Assesment Report</h4>
	  </div>
	  <form method="post"  class="general" id="generate_Report_form" action="assets/php/script/reports.php">
	  <div class="modal-body">
			
		 <!-- <input type="text" name="name" placeholder="Name" class="form-control placeholder-no-fix"><br/>
		  <p style="text-align: center">Submission start date</p>
		  <input type="date" name="assesment_start_date" placeholder="Start date" class="form-control placeholder-no-fix"><br/>
		  <p style="text-align: center">Due date</p>
		  <input type="date" name="assesment_end_date" placeholder="End date" class="form-control placeholder-no-fix"><br/>
		  <input type="int" name="attempts" placeholder="Attempts allowed" class="form-control placeholder-no-fix"><br/>-->
		  <select class="form-control placeholder-no-fix" name="type">
			<option value="assignment">Assignment</option>
			<option value="exam">Exam</option>
			<option value="test">Test</option>
		  </select>
		  <input type="hidden" name="table" value="assesment"/><br/>
	  </div>
	  <div class="modal-footer">
		  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		  <button class="btn btn-theme submit-btn" type="submit">Submit</button><br/>
		  <div class="alert"></div>
	  </div>
	  </form>
  </div>
</div>
	  

	  
	  
	  
	  
	  
      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2017 Caracal
              <a href="home" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>
	<?php require "assets/php/shared/scripts.php";?>
  </body>
</html>
