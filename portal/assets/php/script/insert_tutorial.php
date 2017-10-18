

<?php

	require_once 'database.php';
	error_reporting(E_ALL);
	
	
	
	
	
	
	
	//Ad details
	$activeUser = $_SESSION['caracal_user']['lastname'];
	$creationdate = date("Y/m/d");
	$Type = $_POST["type"];
	$title = $_POST["name"];
	$postedBy = $activeUser;
	$quizbookPath = " ";
	$sciptPath = " ";
	$memoID = 0;
	
	
	
	
	$tutorialQuary = "INSERT INTO tutorials (Date,Titile,Type,script_path,quizbook_path,posted_By,memo_id) VALUES('$creationdate','$title','$Type','$sciptPath','$quizbookPath','$postedBy','$memoID')";

	$tutorialCreated = mysqli_query($db,$tutorialQuary) == TRUE;	
	
	
		if($tutorialCreated == true){
			echo "<div class='hide'>SUC0000000</div>  successfully added<br/>Changes may not be visble immediately";
			
		}
		
		else
		{
			//echo mysqli_error($db);
			
		}
	
	
?>