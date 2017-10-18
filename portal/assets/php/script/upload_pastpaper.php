
<?php

	
	require_once 'database.php';
	error_reporting(E_ALL);
	
	
	
	$tutorial_ID = $_POST["tutorial_id"];
	
	 $name = $tutorial_ID.".pdf";
	
	$filetmp = $_FILES["paper"]["tmp_name"];
	$filename = $_FILES["paper"]["name"];
	$filetype = $_FILES["paper"]["type"];


	$path = "../../../marker/past_papers/";
	move_uploaded_file($filetmp,$path.$name);
	$pathtodb="marker/past_papers/";
	$forDatabase = $pathtodb.$name;
	
	$Query = "UPDATE tutorials SET quizbook_path='$forDatabase' WHERE tutorial_id='$tutorial_ID'";

	$inserted = mysqli_query($db,$Query) == TRUE;	
	
	
	if($inserted == true){
			echo "<div class='alert'>SUC0000000</div>  successfully added<br/>Changes may not be visble immediately";
			
		}
		
		else
		{
			echo mysqli_error($db);
			
		}
	
	
?>

