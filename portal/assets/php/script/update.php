<?php
require_once 'extract.php';
if($_POST) 
{
	$n=$_POST['table'];
	unset($_POST['table']);
	if(isset($tables[$n]))
	{
		$table=$tables[$n];
	}
	$id_name=$_POST['id_name'];
	unset($_POST['id_name']);
	
	if($table!=null)
	{
		/*fill in the empty places with an action condition*/
		$condition=array($id_name=>$_POST[$id_name]);
		
		if($table->update($_POST,$condition))
		{
			echo "<div class='hide'>SUC0000000</div>".$n." successfully edited";	
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

