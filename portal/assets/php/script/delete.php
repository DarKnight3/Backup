<?php
require_once 'extract.php';
if($_GET) 
{
	$n=$_GET['table'];
	unset($_GET['table']);
	if(isset($tables[$n]))
	{
		$table=$tables[$n];
	}
	
	if($table!=null)
	{
		/*fill in the empty places with an action condition*/
		
		if($table->delete($_GET))
		{
			echo "<div class='hide'>SUC0000000</div>"+$n+" successfully deleted";	
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

