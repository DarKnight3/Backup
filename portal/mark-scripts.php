<?php
if($_GET)
{
	if($_GET['path'])
	{
		$pyscript = 'C:\\wamp64\\www\\caracal\\marker\\src\\main.py '.$_GET['path'].' '.$_GET['memo_id'];
		$python = 'C:\\Python36-32\\python.exe';

		print("Marking started <br/>".$pyscript."<br>");
		$cmd = "$python $pyscript";
		$out = exec("$cmd");
		/*while(strpos($out,"finished"))
		{
			print($out);
		}*/
		
		print($out);
		print("<div style='display:none'><br/>Done</div>");
	}
	else
	{
		echo "error 1: Unable to mark";
	}
	// echo "Done marking";
}
else
{
	echo "error 2: Unable to mark " ;
}
?>