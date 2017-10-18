<?php
require_once 'extract.php';
if($_POST) 
{
	if(isset($_POST['table']))
	{
		$n=$_POST['table'];
	}
	if(isset($n) && isset($tables[$n]))
	{
		$table=$tables[$n];
		unset($_POST['table']);
	}
	if(isset($_POST["directory"]))
	{
		$dir=$_POST["directory"];
		unset($_POST["directory"]);
	}
	if(isset($_FILES["upload_file"]["name"]) && $_FILES["upload_file"]["name"]!='')
	{
		
		/*custom addition*/
		if(!isset($dir))
		{
			$dir="../../../uploads/_Assesments/".$_POST["assement_id"]."/Scripts";
		}
		
		/*end of custom code*/
		
		if(isset($dir))
		{
			if (!file_exists($dir)) 
			{
				mkdir($dir, 0777, true);
				
			}
			$state=upload_e("upload_file",$dir, true);
			unset($_POST["upload_file"]);
			if(isset($n))
			{
				if($n=="user")
				{
					// echo $dir;
					$_POST['picture']="uploads/_profile_pictures/".$state;
				}
				
			}
		}
		
		if(!isset($state))
		{
			echo "ERRU00312 : Unable to upload <br/>";
		}
	}
	
	
	if(isset($table))
	{
		/*fill in the empty places with an action condition*/
		
		$id_name=$_POST['id_name'];
		unset($_POST['id_name']);
		$condition=array($id_name=>$_POST[$id_name]);
		
		if($table->update($_POST, $condition))
		{
			if(isset($_POST['picture']))
			{
				echo $_POST['picture'];
			}
			echo "SB1223892198NSA";
		}
		else
		{
			echo "ERRU0000 : unkonwn error occured sorry for the inconvinience<Br/>";
		}
	}
	else
	{
		 echo "<div class='hide'>SB1223892198NSA</div>Task successfully uploaded<Br/>";	
	}
	
	
}
else
{
	echo "ERRU0109 : unkonwn error occured sorry for the inconvinience<Br/>";

}
?>

