<?php
require_once 'extract.php';
if($_POST) 
{
/*	initialise the table for users
*/	
	$table=$tables['user'];
	if($table!=null)
	{
		// check if the user exist and if it is active
		if($table->exists(array("email"=>$_POST['username'], "active"=>0)))
		{
			echo "The account you are trying to access is currently not active";
		}
		else if($table->exists(array("email"=>$_POST['username'])))
		{
			if($table->exists(array("password"=>$_POST['password'], "email"=>$_POST['username'])))
			{
				$temp=$table->select_where(array("password"=>$_POST['password'], "email"=>$_POST['username']))[0];
				if($temp['role']=='Student' || $temp['role']=='student')
				{
					$_SESSION['caracal_student']=$temp;
					$_SESSION['caracal_student']['details']=$tables['student']->select_where(array("user_id"=>$temp['user_id']))[0];
					echo "<br/>SUC0000001";
					
					
				}
				else 
				{
					$_SESSION['caracal_user']=$temp;
					echo "<br/>SUC0000000";
				}
				
				
				
			}
			else
			{
				echo "incorrect password, please try again";
			}
		}
		else
		{
		
			echo "unable to login, the user with the email ".$_POST['username']." does not exist";
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

