<!DOCTYPE html>
<html lang="en">
  <head>
  <?php 
  $title="Memorandums";
  $marking_a="active";
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
                  <div class="row mt">
				  <div class="col-md-12">
				    <a class="btn btn-primary" data-toggle="modal" style="width:100%" href="#add_memo">Add new memo</a>
					</div><br/>
					<br/>
					<br/>
                  <div class="col-md-12">
                      <div class="content-panel">
					
                          <table class="table table-striped table-advance table-hover">
	                  	  	  <h3 style="text-align:center"> Memorandums</h3>
	                  	  	  <hr>
							  <?php if(isset($memos)):?>
                              <thead>
                              <tr>
								<th> Assesment</th>

                                 <th> Total number of questions</th>
                                   <th> </th>
                                 
                              </tr>
                              </thead>
                              <tbody>
							  
							  <?php foreach($memos as $value):?>
                              <tr>
                                  
								  <?php
								  
									$ass=$assesmentT->select_where(array("assesment_id"=>$value["assesment_id"]));
									$namea="No name";
									if(isset($ass))
									{
										if(count($ass)>0)
										{
											$namea=$ass[0]['name'];
										}
									}
								  ?>
                                  <td class="hidden-phone"><?=$namea?></td>
                                  <td><?=$value['total_number_of_questions']?></td>
								  <?php if($_SESSION['caracal_user']['role']=="Admin"):?>
                                  <td>
                                      <a  class="btn btn-primary btn-xs" href="memo?memo_id=<?=$value['memo_id']?>&assesment_id=<?=$value['assesment_id']?>"><i class="fa fa-book" title="add questions"></i></a>
                                      <a data-toggle="modal" href="#edit_memo_<?=$value['assesment_id']?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil" title="edit memo"></i></a>
                                      <a  class="btn btn-danger btn-xs delete-btn page-refresh" href="assets/php/script/delete.php?memo_id=<?=$value['memo_id']?>&table=memo" ><i class="fa fa-trash-o " title="delete memo"></i></a>
                                  </td>
								  <?php endif;?>
                              </tr>
							<div aria-hidden="true" aria-labelledby="edit_memo_<?=$value['assesment_id']?>" role="dialog" tabindex="-1" id="edit_memo_<?=$value['assesment_id']?>" class="modal fade">
								  <div class="modal-dialog">
									  <div class="modal-content">
										  <div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											  <h4 class="modal-title">Edit memo</h4>
										  </div>
										  <form method="post"  class="general" id="edit_memo_form_<?=$value['assesment_id']?>" action="assets/php/script/update.php">
										  <div class="modal-body">
												<!--<p style="text-align:center">Assesment date</p>
											  <input type="date" name="assesment_date"  class="form-control placeholder-no-fix"><br/>-->
											  
											  <p>Select assesment</p>
											  <select type="text" name="assesment_id"  class="form-control placeholder-no-fix">
												<?php foreach($assesments as $value):?>
													<option value="<?=$value['assesment_id']?>"><?=$value['name']?></option>
												<?php endforeach;?>
											  </select>
											  <br/>
											  <input type="hidden" name="memo_id" value="<?=$value['memo_id']?>"/>
											  <input type="hidden" name="id_name" value="memo_id"/>
											  <input type="hidden" name="table" value="memo"/>
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
                                 <h4 style="text-align:center">No memos <a data-toggle="modal" href="#add_memo">click here</a> to add a new memo</h4>
								 <?php else:?>
								  <h4 style="text-align:center">No memos added </h4>
								 <?php endif;?>
								</tr>
							  <?php endif;?>

                          </table>
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->
			  <br/>
			  <br/>
			  <br/>
			 
			  <br/>
			  <br/>
			  <br/>
			 <div aria-hidden="true" aria-labelledby="add_memo" role="dialog" tabindex="-1" id="add_memo" class="modal  modal-close-refresh fade">
				  <div class="modal-dialog">
					  <div class="modal-content">
						  <div class="modal-header">
							  <button type="button" class="close page-refresh" data-dismiss="modal" aria-hidden="true">&times;</button>
							  <h4 class="modal-title">Add memo</h4>
						  </div>
						  <form method="post"  class="files" id="new_memo" action="assets/php/script/insert-memo.php"  enctype="multipart/form-data">
						  <div class="modal-body">
								<!--<p style="text-align:center">Assesment date</p>
							  <input type="date" name="assesment_date"  class="form-control placeholder-no-fix"><br/>-->
							  <p>Select assesment</p>
							  <select type="text" name="assesment_id"  class="form-control placeholder-no-fix">
								<?php foreach($assesments as $value):?>
									<option value="<?=$value['assesment_id']?>"><?=$value['name']?></option>
								<?php endforeach;?>
							  </select>
							  <br/>
							  <p>Uploading a memo is optional</p>
							  <input type="file" name="upload_file" placeholder="Memo"  class="form-control placeholder-no-fix"><br/>
							  <input id="total_number_of_questions" placeholder="Total number of questions" type="number"  name="total_number_of_questions" class="form-control placeholder-no-fix"/>
							  <br/>

							  <input type="hidden" id="sub_question_count" name="sub_question_count" value=" "/>
							  <div id="sub_questions" style="margin-left: 10px">
							  	
							  </div>
							  <input type="hidden" name="table" value="memo"/>
						  </div>
						  <div class="modal-footer">
							  <button data-dismiss="modal" class="btn btn-default page-refresh" type="button">Cancel</button>
							  <button id="new_memo_btn" class="btn btn-theme submit-btn disabled" type="submit">Submit</button><br/>
							  
						  </div>
						  <div class="alert" style="text-align: center"></div>
						  </form>
					  </div>
				  </div>
			</div>

                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  <!--Modals-->
				
                  <?php require "assets/php/shared/right_sidebar.php";?>
      
              </div><! --/row -->
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
