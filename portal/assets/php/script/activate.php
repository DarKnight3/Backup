<?php
require_once 'extract.php';
if($_POST) 
{
	$table=$tables['user'];
	
	if($table!=null && !isset($_POST['password1']))
	{
		if($table->exists(array("email"=>$_POST['email2'])))
		{
			$usr=$table->select_where(array("email"=>$_POST['email2']));
			
			if($usr[0]['active']==1)
			{
				echo "Sorry ".$usr[0]['firstname']." your account is already active";
			}
			else
			{
				echo "SUC0000000";
				$_SESSION['ema']=$_POST['email2'];
			}
			
		}
		else
		{
		
			echo "The user with the email ".$_POST['email2']." does not exist";
		}
	}
	else if($table!=null && isset($_POST['password1']))
	{
		if($table->exists(array("email"=>$_POST['username'])))
		{
			if($_POST['password1']==$_POST['password2'])
			{
				if($table->update(array("password"=>$_POST['password1'], "active"=>1), array("email"=>$_POST['username'])))
				{
					unset($_SESSION['ema']);
					$_SESSION['user']=$table->select_where(array("email"=>$_POST['username'],"password"=>$_POST['password1']))[0];
					echo "SUC0000000";
				}
				else
				{
					echo "Unable to add the changes to the database";
				}
			}
			else
			{
				echo "Passwords do not match";
			}
			
		}
		else
		{
		
			echo "The user with the email ".$_POST['username']." does not exist";
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

