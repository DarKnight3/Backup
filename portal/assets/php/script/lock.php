<?php
require_once 'extract.php';
if($_POST) 
{
	if($_SESSION['user1']['password']==$_POST['password'])
	{
		$_SESSION['user']=$_SESSION['user1'];
		echo "SUC0000000";
	}
	else
	{
		echo "wrong password please try again";
	}
}
else
{
	echo "ERRU0109 : unkonwn error occured sorry for the inconvinience";

}
?>

