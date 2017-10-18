<?php
require_once 'extract.php';
require_once 'functions.php';

if($_POST) 
{
	$is_zip=true;
	$num_f=0;

	if(isset($_POST['table']))
	{
		$n=$_POST['table'];
	}
	if(isset($n) && isset($tables[$n]))
	{
		$table=$tables[$n];
		unset($_POST['table']);
	}
	if(isset($_FILES["upload_file"]["name"]) && $_FILES["upload_file"]["name"]!='')
	{
		
		if(isset($_POST["directory"]))
		{
			$dir=$_POST["directory"];
			unset($_POST["directory"]);
		}
		
		/*custom addition*/
		if(isset($_POST['assesment_id']))
		{
			$file="upload_file";
			$name = pathinfo($_FILES[$file]['name'], PATHINFO_FILENAME);
			$extension = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
			$increment =randomPassword(6).date_time();

			if($extension=="pdf" || $extension=="PDF" || $extension=="zip" || $extension=="ZIP")
			{
					
				$temp=$tables['assesment']->select_where(array("assesment_id"=>$_POST['assesment_id']));
				if(isset($temp) && isset($temp[0]))
				{
					$dir="../../../../marker/answer_scripts/unprocessed/".$temp[0]['type'];
					if (!file_exists($dir)) 
					{
						mkdir($dir, 0777, true);
						
					}
					$state=upload_scripts("upload_file",$dir, $temp[0]['type'].'_scripts_'.date("y_m_d"));
					unset($_POST["upload_file"]);
					
					if($extension=="zip")
					{
						$zip=new ZipArchive();
						$zip->open($dir."/".$state);
						$num_f=$zip->numFiles;
					}
					$tables['assesment']->update(array( "scripts_available"=>1,  "scripts_path"=>$temp[0]['type']."/".$state),array("assesment_id"=>$temp[0]['assesment_id']));
					unset($dir);
				}
			}
			else
			{
				$is_zip=false;
			}
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
		}
		
		
	}
	
	if(isset($state))
	{
		if(isset($table))
		{
			/*fill in the empty places with an action condition*/
			
			if($table->insert($_POST))
			{
				echo '<div class="alert alert-success"><center>'."<div class='hide'>SB1223892198NSA</div>Task successfully added".'</center></div>';	
			}
			else
			{
				echo '<div class="alert alert-danger"><center>'."ERRU0000 : unkonwn error occured sorry for the inconvinience".'</center></div>';
			}
		}
		else
		{
			 echo '<div class="alert alert-success"><center>'."<div class='hide'>SB1223892198NSA</div>Task successfully uploaded ".'</center></div>';	
		}
	}
	else
	{
		if($is_zip==false)
		{
			//echo "<div class='hide'>SB1223892198NSA12</div>Task successfully uploaded<br/>";	
			echo '<div class="alert alert-danger"><center>'.'Please upload a pdf or zip file'.'</center></div>';
		}
		else
		{
			echo '<div class="alert alert-danger"><center>'."ERRU00312 : Unable to upload ".'</center></div>';
		}
	}
}
else
{
	echo '<div class="alert alert-danger"><center>'."ERRU0109 : unkonwn error occured sorry for the inconvinience".'</center></div>';

}

?>

