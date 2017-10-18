<!DOCTYPE html>
<html lang="en">
  <head>
  <?php 
  $title="Create memo";
  $marking_a="active";
  ?>
  <?php require "assets/php/script/extract.php";?>
	<?php require "assets/php/shared/head.php";?>
  </head>
	<?php if(!isset($_GET['memo_id'])):?>
		<?php header("location:manage-memo");?>
	<?php endif;?>
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

              <div class="row" style="background-color:white">
                  <div class="col-lg-9 main-chart" >
					

					<div class="row">
					<form  action="assets/php/script/memo.php" method="post" id="memo_file">
						<input name="memo_id" type="hidden" value="<?=$_GET['memo_id']?>"/>
						<input name="assesment_id" type="hidden" value="<?=$_GET['assesment_id']?>"/>
						<div id="paper" style="margin:10px">
							
						</div>
						<div class="footer">
							<button class="btn btn-primary pull-right btn-round submit-btn" id="done">Done</button>
							<br/>
							<br/>
							<br/>
							<div class="alert"></div>
						</div>
					<form>
					</div>
					
					<button class="btn btn-primary pull-right btn-round" id="add_question">Add question</button>
					<button class="btn btn-primary pull-right btn-round" id="add_sub_question">Add sub question</button>
					<button class="btn btn-primary pull-right btn-round" id="add_step">Add step</button>
					<hr/>
				  
				  
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
