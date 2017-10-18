<?php
if($_GET)
{
	if($_GET['path'])
	{
		/*online*/

		// $pyscript = 'main.py '.$_GET['path'].' '.$_GET['memo_id'].' 1';
		// $python = '/home/mkdevhub/.local/bin/python3 ';

		/*Windows*/ 
		
		$pyscript = 'C:\\wamp64\\www\\caracal\\marker\\src\\main.py '.$_GET['path'].' '.$_GET['memo_id'].' 1';
		$python = 'C:\\Users\\Kenneth\\AppData\\Local\\Programs\\Python\\Python36-32\\python.exe';

		$cmd = "$python $pyscript";
		$out = shell_exec("$cmd 2>&1;");

		print("<pre>");
		print($out);
		print("</pre>");
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