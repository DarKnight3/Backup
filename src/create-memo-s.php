<?php
if($_GET)
{
	if($_GET['path'])
	{
		/*online*/
		if(strpos($_SERVER['SERVER_NAME'], "pronerd.co.za"))
		{
			$pyscript = 'main.py '.$_GET['path'].' '.$_GET['memo_id'].' 1';
			$python = '/home/mkdevhub/.local/bin/python3 ';
			$cmd = "$python $pyscript";
			$out = exec("$cmd 2>&1;");
		}
		else
		{
			/*Windows*/ 
			$pyscript = 'C:\\wamp64\\www\\tutorial\\caracal\\marker\\src\\assessment_creator.py '.$_GET['path'].' '.$_GET['memo_id'].' ';
			$python = 'C:\\Users\\Kenneth\\AppData\\Local\\Programs\\Python\\Python36-32\\python.exe';
			$cmd = "$python $pyscript";
			$out = shell_exec("$cmd 2>&1;");
		}

		print("<pre>");
		print($out);
		print("</pre>");
		print("<div style='display:none'><br/>Done</div>");
	}
	else
	{
		echo "error 1: Unable to create memo";
	}
}
else
{
	echo "error 2: No data given " ;
}
?>