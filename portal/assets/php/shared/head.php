	<?php
		require_once 'assets/php/script/extract.php';
		if(isset($_SESSION['caracal_student']))
		{
			$_SESSION['caracal_user']=$tables['user']->select_where(array("user_id"=>$_SESSION['caracal_student']['user_id']))[0];
		}
		else if(isset($_SESSION['caracal_user']))
		{
			$_SESSION['caracal_user']=$tables['user']->select_where(array("user_id"=>$_SESSION['caracal_user']['user_id']))[0];
		}
		else if(!isset($_SESSION['caracal_user']) && !isset($_SESSION['caracal_student']))
		{
			header("location:login");
		}

		if($_SESSION['caracal_user']['picture']==null)
		{
			$_SESSION['caracal_user']['picture']="assets/img/ui-sam.jpg";
		}
	?>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<?php if(!isset($title)):?>
    <title>Caracal Marking system - <?=$_SESSION['caracal_user']['firstname']?> <?=$_SESSION['caracal_user']['lastname']?></title>
	<?php else :?>
	<title><?=$title?> 
	<?php if(isset($_SESSION['caracal_user']['firstname'])&& isset($_SESSION['caracal_user']['lastname'])):?>
		- <?=$_SESSION['caracal_user']['firstname']?> <?=$_SESSION['caracal_user']['lastname']?>
	<?php endif;?>
	</title>	
	<?php endif;?>
	<?php $user=$_SESSION['caracal_user']?>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/css/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/_style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative|Cuprum|Megrim|Oswald:500" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
	<link rel="icon" type="image/png" href="./assets/img/icon.png" />
    <script src="assets/js/chart-master/Chart.js"></script>
	<script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->