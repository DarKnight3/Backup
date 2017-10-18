<!DOCTYPE html>
<html lang="en">
  <head>
  	<?php require "assets/php/script/extract.php"?>
				
	<?php if(!isset($_SESSION['ema']) ):?>
		<?php header('Location: login');?>				
	<?php endif;?>
	<?php 
	$email=$_SESSION['ema'];
	?>
	
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<title>Activate account</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
	<link rel="icon" href="assets/img/favicon.png">
    <script src="assets/js/chart-master/Chart.js"></script>
	<script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
   
  </head>
  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		    <form class="form-login" method="post" action="assets/php/script/activate.php" id="login">
		        <h2 class="form-login-heading">Activate Account</h2>
		        <div class="login-wrap">
		            <br>
				
		            <input type="email" class="form-control" name="username" placeholder="Email" value="<?=$email?>"><BR/>
		            <input type="password" class="form-control" name="password1" placeholder="Password"><BR/>
		            <input type="password" class="form-control" name="password2" placeholder="Confirm Password"><BR/>
		           
					
		            <button class="btn btn-theme btn-block" type="submit" id="submit-btn"><i class="fa fa-unlock"></i> ACTIVATE</button><br/>
					<div id="error"></div>
		            <hr>
		            
		            
		            <div class="registration">
		                Have an account ?<br/>
		            <a   href="login">Login to account</a>
		            </div>
				
		        </div>
			</form>
		
		       
		
			  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/ajax.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>


  </body>
</html>
