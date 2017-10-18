<?php
require_once 'extract.php';
if($_POST) 
{
	$n=$_POST['table'];
	unset($_POST['table']);
	
	/*custom*/
	if($n=="assesment")
	{
		$_POST['assesment_date']=date("Y-m-d");
	}
	if(isset($tables[$n]))
	{
		$table=$tables[$n];
	}
	if($table!=null)
	{
		if($n=="memo")
		{
			$memo=array('total_number_of_questions'=>$_POST['total_number_of_questions'], 'sub_question_count'=>$_POST['sub_question_count'], 'file_path'=>null, 'assesment_id'=>$_POST['assesment_id']);
			if(!$table->exists(array('assesment_id'=>$_POST['assesment_id'])))
			{
				if(isset($_FILES["upload_file"]["name"]) && $_FILES["upload_file"]["name"]!='')
				{
					$assesment=$tables['assesment']->select_where(array('assesment_id'=>$memo["assesment_id"]))[0];
					$dir="../../../../marker/memo/".$assesment["type"];
					$file='upload_file';
					$name = pathinfo($_FILES[$file]['name'], PATHINFO_FILENAME);
					$extension = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
					// $increment =randomPassword(6).date_time();
					if($extension=="pdf" || $extension=="PDF" || $extension=="zip" || $extension=="ZIP")
					{
						if(isset($dir))
						{
							if (!file_exists($dir)) 
							{
								mkdir($dir, 0777, true);
								
							}
							$state=upload_e("upload_file",$dir, true);
							unset($_POST["upload_file"]);

							if($state)
							{
								$file=$assesment["type"].'/'.str_replace($extension, "json", $state);
								$memo=array('total_number_of_questions'=>$_POST['total_number_of_questions'], 'sub_question_count'=>$_POST['sub_question_count'], 'file_path'=>$file, 'assesment_id'=>$_POST['assesment_id']);
								if($table->insert($memo))
								{
									$_POST['path']=$state;
									$memos=$tables['memo']->select();
									$latest=end($memos);
									$tables['assesment']->update(array('memo_id'=>$latest['memo_id']), array('assesment_id'=>$_POST['assesment_id']));
									$_GET['path']='../../../../marker/memo/'.$assesment["type"].'/'.$state;
									$_GET['memo_id']=$latest['memo_id'];
									require_once '../../../../marker/src/create-memo-s.php';
								}
								else
								{
									echo "<div class='alert alert-danger' style='text-align:center'>Unable to add memo please contact your system admin admin to solve the problem</div>";
								}
							}
							else
							{
								echo "<div class='alert alert-danger' style='text-align:center'>Unable to upload memo please contact your system admin admin to solve the problem</div>";
							}
						}
						else
						{
							echo "<div class='alert alert-danger' style='text-align:center'>Directory not set</div>";
						}
					}
					else
					{
						echo '<div class="alert alert-danger"><center>'.'Please upload a pdf or zip file'.'</center></div>';
					}
				}
				else if($table->insert($_POST))
				{
					echo "<div class='alert alert-success' style='text-align:center'><div class='hide'>SUC0000000</div>Memo added successfully</div>";
				}
				else
				{
					echo "<div class='alert alert-danger' style='text-align:center'>Unable to add memo please contact your system admin admin to solve the problem</div>";
				}
			}
			else
			{
				echo "<div class='alert alert-danger' style='text-align:center'>Memo already exists</div>";
			}
		}
		else if($table->insert($_POST))
		{
			if($n=="request")
			{
				echo "<div class='hide'>SUC0000000</div>"."Request made, an email with more details has been sent to you";
			}
			else
			{
				echo "<div class='hide'>SUC0000000</div>".$n." successfully added<br/>Changes may not be visble immediately";	
			}
		}
		else
		{
			echo "ERRU0000 : unkonwn error occured sorry for the inconvinience";
		}
	}
	else
	{
		echo "ERRU0002 : unkonwn error occured sorry for the inconvinience";
	}
}
else
{
	echo "ERRU0109 : unkonwn error occured sorry for the inconvinience";

}
?>

