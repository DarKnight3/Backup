<?php
require_once 'extract.php';
require_once 'functions.php';

if($_POST) 
{
	$is_zip=true;
	$num_f=0;
	$memo_id=null;
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

			if($extension=="zip" || $extension=="ZIP" || $extension=="pdf" || $extension=="PDF")
			{
					
				$temp=$tables['assesment']->select_where(array("assesment_id"=>$_POST['assesment_id']));
				if(isset($temp) && isset($temp[0]))
				{
					$dir="../../../../marker/answer_scripts/unprocessed/".$temp[0]['type'];
					$memo_id=$temp[0]['memo_id'];
					if (!file_exists($dir)) 
					{
						mkdir($dir, 0777, true);
						
					}
					$state=upload_scripts("upload_file",$dir, $temp[0]['type'].'_'.$temp[0]['assesment_id'].'_student_'.$_POST['student_id'].'_'.date("y_m_d"));
					unset($_POST["upload_file"]);
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
		$_GET=array();

		$path=$temp[0]['type'].'/'.$state;
		$_GET['path']=$path;
		$_GET['memo_id']=$memo_id;

		?>
			<div id='memo_id_' style="display: none;"><?=$memo_id?></div>
			<div id='path_' style="display: none;"><?=$path?></div>
			<div style="display: none;">ADJHSABD893284239</div>
			<!-- <div class="alert alert-success"><center>Done uploading file</center></div> -->
			<center><a class="btn btn-success btn-lg  mark-btn"  href="../marker/src/mark-scripts.php?path=<?=$path?>&memo_id=<?=$memo_id?>">Mark upload</a></center>
		<?php
		// require_once "../marker/src/mark-scripts.php";
		
	}
	else
	{
		if($is_zip==false)
		{
			//echo "<div class='hide'>SB1223892198NSA12</div>Task successfully uploaded<br/>";	
			echo '<div class="alert alert-danger"><center>'.'Please upload a pdf or a zip file with pictures inside of the questions '.'</center></div>';
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

