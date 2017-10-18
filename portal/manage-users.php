<!DOCTYPE html>
<html lang="en">
  <head>
  <?php 
  $title="Manage users";
  $user_a="active";
  ?>
  <?php require "assets/php/script/extract.php";?>
	<?php require "assets/php/shared/head.php";?>
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
				<?php if($_SESSION['caracal_user']['role']=="Admin"):?>
					<a class="btn btn-primary" style="width:100%" data-toggle="modal" href="#add_user" >Add new user</a>
				<?php endif;?>
					<!--Modal-->
					<div aria-hidden="true" aria-labelledby="add_user" role="dialog" tabindex="-1" id="add_user" class="modal fade">
						  <div class="modal-dialog">
							  <div class="modal-content">
								  <div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									  <h4 class="modal-title">Add new user</h4>
								  </div>
								  <form action="assets/php/script/insert.php" class="general" id="add_user_form">
								  <div class="modal-body">
									
									  <input type="text" name="firstname" placeholder="Name" autocomplete="off" class="form-control placeholder-no-fix"><br/>
									  <input type="text" name="lastname" placeholder="Surname" autocomplete="off" class="form-control placeholder-no-fix"><br/>
									  <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix"><br/>
									  <select type="text" name="role" class="form-control placeholder-no-fix" >
										<option value="Admin">Admin</option>
										<option value="Teacher">Teacher</option>
										<option value="Teacher">Student</option>
									  </select><br/>
									  <p>Date of Birth</p>
									  <input type="date" name="date_of_birth" placeholder="Date of Birth" autocomplete="off" class="form-control placeholder-no-fix"><br/>
									<input type="hidden" name="table" value="user"/><br/>
								  </div>
								  <div class="modal-footer">
									  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
									  <button class="btn btn-theme submit-btn" type="submit">Submit</button>
									  <div class="alert"></div>
								  </div>
								  </form>
							  </div>
						  </div>
					</div>
          
				  </div>
					 <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
	                  	  	  <h3 style="text-align:center"> Authorised users</h3>
	                  	  	  <hr>
							  <?php if(isset($users)):?>
                              <thead>
                              <tr>
                                  <th> Name</th>
                                  <th >Surname</th>
                                  <th >Role</th>
                                  <th >Email</th>
                                
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
							  
							  <?php foreach($users as $value):?>
                              <tr>
                                  <td><?=$value['firstname']?></td>
                                  <td ><?=$value['lastname']?></td>
                                  <td><?=$value['role']?></td>
                                  <td><?=$value['email']?></td>
                                  <?php if($_SESSION['caracal_user']['role']=="Admin" ):?>
								  <?php if($_SESSION['caracal_user']['user_id']!=$value['user_id']):?>
									<?php if($value['user_id']!=0):?>
                                  <td>
                                      <button data-toggle="modal" href="#edit_user_<?=$value['user_id']?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil" title="edit user"></i></button>
										<a  class="btn btn-danger btn-xs delete-btn" href="assets/php/script/delete?user_id=<?=$value['user_id']?>&table=user" ><i class="fa fa-trash-o " title="delete user"></i></a>                                  </td>
									</td>
									<?php else:?>
									<td></td>
									<?php endif;?>
									<?php else:?>
									<td></td>
									<?php endif;?>
									<?php endif;?>
							  </tr>
								<div aria-hidden="true" aria-labelledby="edit_assesment" role="dialog" tabindex="-1" id="edit_user_<?=$value['user_id']?>" class="modal fade">
									  <div class="modal-dialog">
										  <div class="modal-content">
											  <div class="modal-header">
												  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												  <h4 class="modal-title">Edit user</h4>
											  </div>
											  <form method="post"  class="general" id="edit_user_form_<?=$value['user_id']?>" action="assets/php/script/update.php">
											  <div class="modal-body">
													<!--<p style="text-align:center">Assesment date</p>
												  <input type="date" name="assesment_date"  class="form-control placeholder-no-fix"><br/>-->
												  
												  <input type="text" name="firstname" placeholder="Name" class="form-control placeholder-no-fix" value="<?=$value['firstname']?>"><br/>
												  <input type="text" name="lastname" placeholder="Surname" class="form-control placeholder-no-fix" value="<?=$value['lastname']?>"><br/>
												  <input type="email" name="email" placeholder="Email" class="form-control placeholder-no-fix" value="<?=$value['email']?>"><br/>
												  <select type="text" name="role" placeholder="Role" class="form-control placeholder-no-fix" >
													<?php if($value['role']=="Admin"):?>
														<option value="Admin">Admin</option>
														<option value="Teacher">Teacher</option>
													<?php else:?>
													<option value="Teacher">Teacher</option>
													<option value="Admin">Admin</option>
														
													<?php endif?>
												  </select>
												  <br/>
												  <p>Date of birth</p>
												  <input type="date" name="date_of_birth" placeholder="Name" class="form-control placeholder-no-fix" value="<?=$value['date_of_birth']?>"><br/>
												  <input type="hidden" name="user_id" value="<?=$value['user_id']?>"/><br/>
												  <input type="hidden" name="id_name" value="user_id"/><br/>
												  <input type="hidden" name="table" value="user"/><br/>
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
							  <?php endforeach;?>
							  </tbody>
							  <?php else:?>
								<tr>
                                 <h4 style="text-align:center">No users added <a href="add-user">click here</a> to add a new user</h4>
								</tr>
							  <?php endif;?>

                          </table>
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->
			  <br/>
			  <br/>
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
	<?php require "assets/php/shared/scripts.php";?>
  </body>
</html>
