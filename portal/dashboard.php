<!DOCTYPE html>
<html lang="en">
  <head>
	<?php $dashboard_a="active";?>
	<?php require "assets/php/script/extract.php";?>
	<?php require "assets/php/shared/head.php";?>
	<link rel="stylesheet" href="./assets/css/buttons.css"/>
	<link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative|Cuprum|Megrim|Oswald:500" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
	<style type="text/css">
		.img-try
		{
			width:150px; 
			height:150px;
		}
		.img-try:hover
		{
			width:300px; 
			height:200px;
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
                  <div class="row">
						<!-- TWITTER PANEL -->
						
						<div class="col-md-4 mb">
							<!-- INSTAGRAM PANEL -->
							<div class="instagram-panel pn">
								<i class="fa fa-book fa-4x"></i>
								<p>Number of <br/>active<br/>assesments<br/>
								</p>
								
								<p><?=count($assesments)?></p>
							</div>
						</div><!-- /col-md-4 -->
						
						<div class="col-md-4 mb">
                      		<div class="darkblue-panel pn">
                      			<div class="darkblue-header">
						  			<h5>Latest assesment's marking Status</h5>
                      			</div>
								<?php
								if(isset($assesments))
								{
									$temp=array_pop($assesments);
									array_push($assesments, $temp);
									if($temp['no_papers_marked']!=0)
									{
										$m_status=ceil(($temp['no_papers_marked']/$temp['no_papers_uploaded'])*100);
										if($m_status>=100) $m_status=100;

									}
									else
									{
										$m_status=0;
									}
									$m_papers=$temp['no_papers_marked'];
									$date=$temp['assesment_date'];
								}
								else
								{
									$m_status=10;
									$m_papers=0;
									$date="";
								}
								?>
								<canvas id="serverstatus02" height="120" width="120"></canvas>
								<input type="hidden" id="m_status" value=<?=$m_status?> />
								<script>
									 val1=$("#m_status").val()-0;
									 val2=100-val1;

									var doughnutData = [
											{
												value: val1,
												color:"#68dff0"
											},
											{
												value : val2,
												color : "#444c57"
											}
										];
										var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
								</script>
								<p></p>
								<footer>
									<div class="pull-left">
										<h5><i class="fa fa-hdd-o"></i> <?=$m_papers?> marked</h5>
									</div>
									<div class="pull-right">
										<h5><?=$m_status?>% marked</h5>
									</div>
								</footer>
                      		</div><!-- /darkblue panel -->
						</div><!-- /col-md-4 -->
						
						
						<div class="col-md-4 mb">
							<!-- INSTAGRAM PANEL -->
							<div class="instagram-panel pn">
								<i class="fa fa-book fa-4x"></i>
								<p>Papers Marked<br/>
								</p>
								<?php 
									$total=0;
									if(isset($assesments))
									{
										
										foreach($assesments as $val)
										{
											$total=$total+($val["no_papers_marked"]);
										}
									}
								?>
								<p><?=$total?></p>
							</div>
						</div><!-- /col-md-4 -->
						
						
					</div><!-- /row -->
					<?php if($user['role']=="Admin"):?>
						<br/>
						<br/>
						<br/>
						<br/>
						<div  class="row">
								<div class="col-xs-4">
									<a href="assesments" class="Try">
									
										<center><img class="img-responsive img-try" align="center" src="./assets/img/assesments.png"  title="Manage assesments" /></center>
									</a>
								</div>
								<div class="col-xs-4">
									<a href="manage-memos" class="Try">
										<center><img class="img-responsive img-try" align="center" src="./assets/img/memo.png"  title="Manage memo" /></center>
									</a>

								</div>
								<div class="col-xs-4">
									<a href="underconstruction" class="Try">

										<center><img class="img-responsive img-try" align="center" src="./assets/img/query.png"  title="Queries" /></center>
									</a>
								</div>
							</div>
					<?php endif;?>
					<?php if($user['access_level']==100):?>
							<div  class="row">
								<div class="col-xs-4">
									<a href="#" data-toggle="modal" data-target="#marks-modal" class="Try">
									
										<center><img class="img-responsive" align="center" src="./assets/img/grades.png" style="width:250px; height:250px;" title="Grades" /></center>
									</a>
								</div>
								<div class="col-xs-4">
									<a href="#" data-toggle="modal" data-target="#upload-modal" class="Try">
										<center><img class="img-responsive" align="center" src="./assets/img/arrow-up.png" style="width:250px; height:250px;" title="Upload scripts" /></center>
									</a>

								</div>
								<div class="col-xs-4">
									<a href="#" data-toggle="modal" data-target="#query-modal" class="Try">

										<center><img class="img-responsive" align="center" src="./assets/img/query.png" style="width:250px; height:250px;" title="Query Marks" /></center>
									</a>
								</div>
							</div>
							<!--modals-->

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
			<!--Query marks modal-->
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
								  <td><?=$value['mark']?>%</td>
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
							<form class="form general" method="post" action="assets/php/script/insert.php" id="request_">
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
							</form>
				 		</div>

				  		<div class="modal-footer">
				    		<center><button data-dismiss="modal" type="button" class="btn btn-danger btn-lg btn3d" ><span class="glyphicon glyphicon-off"></span></button></center>
				  		</div>
				  	</div>
				</div>
			</div>


	<?php endif;?>
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  <?php require "assets/php/shared/right_sidebar.php";?>
      
              </div><!--/row -->
          </section>
      </section>
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
  
  
  
  

					</div>	  
	  
	  
  
	<?php require "assets/php/shared/scripts.php";?>
  </body>
</html>
