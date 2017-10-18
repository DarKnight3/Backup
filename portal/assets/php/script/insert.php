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
	if(isset($table))
	{
		if($table->insert($_POST))
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

