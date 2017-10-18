<?php
if($_GET)
{
	if($_GET['path'])
	{
		$pyscript = 'C:\\wamp64\\www\\caracal\\marker\\src\\db_connector.py '.$_GET['db_username'].' '.$_GET['db_password'].' '.$_GET['db_ip_address'].' '.$_GET['db_name'].' '.$_GET['school_name'];
		$python = 'C:\\Users\\Kenneth\\AppData\\Local\\Programs\\Python\\Python36-32\\python.exe';

		$cmd = "$python $pyscript";
		$out = exec("$cmd");
	
		print($out);
		print("<div style='display:none'><br/>Done</div>");
	}
	else
	{
		echo "error 1: Unable to mark";
	}
}
else
{
	echo "error 2: Unable to mark " ;
}
?>