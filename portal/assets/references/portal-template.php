<!DOCTYPE html>
<html lang="en">
  <head>
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
