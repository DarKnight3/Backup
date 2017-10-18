<?php
	require_once 'extract.php';
	if($_POST) 
	{
		$id=$_POST['memo_id'];
		$assesment_id=$_POST['assesment_id'];
		unset($_POST['memo_id']);
		unset($_POST['assesment_id']);
		
		$as=$assesmentT->select_where(array("assesment_id"=>$assesment_id))[0];
		$count=0;
		$no_q=0;
		$control=false;
		$control1=false;
		$control2=false;
		$control3=false;
		$question=array();
		foreach($_POST as $key=>$val)
		{
			if (strpos($key, 'main') !== false)
			{
				$no_q++;
			}
		}
	
		$myfile = fopen("../../../uploads/".$as['name'].".json", "w") or die("Unable to open file!");
		$txt='
			{
				"memo_id"       : "'.$id.'",
				"num_questions" : '.$no_q.',
				"confidence_level" : 98.8,
				"answers" : [
		
		';
		foreach($_POST as $key=> $val)
		{
			if(strpos($key, 'main') !== false)
			{
				if($control==false)
				{
					$txt=$txt.' {
									"num_sub_questions" : 0,
									"sub_questions" : [
									
							  ';
					$control=true;
				}
				else
				{
					$txt=$txt.'
					]
					},
							  ';
					$control=false;
				}
			}
			else if(strpos($key, 'sub') !== false)
			{
				if($control1==false)
				{
					$txt=$txt.'
							"q_id" : "q_1.1",
                            "no" : 4,
                            "steps" : [
                                       
							  ';
					$control1=true;
				}
				else
				{
					$txt=$txt.'
					]
					},
							  ';
					$control1=false;
				}	
			}
			else if(strpos($key, 'step') !== false)
			{
				$txt=$txt.'
						 {
							  "step"  : "'.$_POST[$key].'",
							  "score" : 1
						 },   
						  ';
			
			}
		}
		$txt=$txt."                  
				]
		}
		";
		$txt=$txt."                  
				]
		}
		";
		
		
		
		fwrite($myfile, $txt);
		
		fclose($myfile);
		echo "Done";
	}
	else
	{
		echo "ERRU0109 : unkonwn error occured sorry for the inconvinience";

	}
?>

