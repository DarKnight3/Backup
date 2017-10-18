<?php
function mark($path, $memo, $student=1)
{
	if(strpos($_SERVER['SERVER_NAME'], "pronerd.co.za"))
	{
		/*online*/

		$pyscript = 'main.py '.$path.' '.$memo.' '.$student;
		$python = '/home/mkdevhub/.local/bin/python3 ';
		$cmd = "$python $pyscript";
		$out = exec("$cmd 2>&1;");
	}
	else
	{
		/*Windows*/ 
	
		$pyscript = 'C:\\wamp64\\www\\tutorial\\caracal\\marker\\src\\main.py '.$path.' '.$memo.' '.$student;
		$python = 'C:\\Users\\Kenneth\\AppData\\Local\\Programs\\Python\\Python36-32\\python.exe';
		$cmd = "$python $pyscript";
		$out = shell_exec("$cmd 2>&1;");
	}
	return $out;

}

function zip_($directory, $filename)
{
		// Get real path for our folder
	$rootPath = realpath($directory);

	// Initialize archive object
	$zip = new ZipArchive();
	$zip->open($filename, ZipArchive::CREATE | ZipArchive::OVERWRITE);

	// Create recursive directory iterator
	/** @var SplFileInfo[] $files */
	$files = new RecursiveIteratorIterator(
	    new RecursiveDirectoryIterator($rootPath),
	    RecursiveIteratorIterator::LEAVES_ONLY
	);

	foreach ($files as $name => $file)
	{
	    // Skip directories (they would be added automatically)
	    if (!$file->isDir())
	    {
	        // Get real and relative path for current file
	        $filePath = $file->getRealPath();
	        $relativePath = substr($filePath, strlen($rootPath) + 1);

	        // Add current file to archive
	        $zip->addFile($filePath, $relativePath);
	    }
	}

	// Zip archive will be created only after closing object
	$zip->close();
}
function head()
{
	return '<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>Results</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>

	<div class="container">';

}
function foot()
{
	return '
	</div>

	</body>
	</html>';
}
function view_result($result, $table=false)
{
	$return="";
	$status="Marked";
	if($table):
		$download='<td><a target="_blank" href="'.$result['download'].'" class="btn btn-primary">Download script</a></td>';
		if(!$result['marked'])
		{
			$download='<td><a target="_blank" disabled class="btn btn-primary">Download script</a></td>';
			$status="Unable to mark";
		}

		return '<tr>
			<td>'.$result['script_name'].'</td>
			<td>'.$result['mark_obtained'].'%</td>
			<td>'.$status.'</td>
			'.$download.'
		</tr>';
	elseif(isset($result['marked']) && $result['marked']):
		return "<center>
			<div class='result'>
				<p  class='label-marks' style='font-size:20pt'>Mark obtained</p>
				<div class='label-marks'>".$result['mark_obtained']."%</div>
				<br/>
				<a target='_blank' href=\"".$result['download']."\" class='btn btn-primary'>Download script</a>
				<br/><br/>
			</div>
		</center>";
	else :
		return "<center>
			<div class='result'>
			<div class='alert alert-warning' style='text-align:center'><h4>One of the following errors occured</h4><ul><li>- I might have been unable to read your handwriting</li><li>- The paper might have not been scanned correctly</li><li>- The answering format may have not followed</li><li>- Your connection to the internet might be too slow for me to mark</li><li>".$result['message']."</li></ul></div>
			</div>
		</center>";;
	endif;
}
function process_result($json, $actual_name="")
{
	$result = json_decode(($json));
	if($result)
	{
		return array("marked"=>true, "script_name"=>$actual_name, "mark_obtained"=>$result->{'mark'}, "download"=>$result->{'download'},"message"=>"Done");
	}
	else 
	{
		return array("marked"=>false, "script_name"=>$actual_name, "mark_obtained"=>0, "download"=>"#", "message"=>$json);
	}

}
if($_GET)
{
	if(isset($_GET['path']) && isset($_GET['memo_id']))
	{
		$failed=false;
		$reason="";
		$student = 1;
		$path = $_GET['path'];
		$memo = $_GET['memo_id'];

		if(isset($_GET['student_id']))
		{
			$student=$_GET['student_id'];
		}
		$results=array();
		$scripts=array();
		$file = "../answer_scripts/unprocessed/".$_GET['path'];
		$info = new SplFileInfo($file);
		$numFiles = 0;
		$res=false;
		$dir=str_replace(".".$info->getExtension(), "", $file);
		$memo_dir = str_replace(".".$info->getExtension(), "","../marked_scripts/".$_GET['path']);
		if(strtolower($info->getExtension())=="zip")
		{

			$zip = new ZipArchive;
			if ($zip->open($file) === TRUE) 
			{
				if (!file_exists($memo_dir)) 
				{
				    mkdir($memo_dir, 0777, true);
				}
				$numFiles = $zip->numFiles;
				$dirpy=str_replace(".".$info->getExtension(), "", $_GET['path']);
			    $zip->extractTo($dir);
			    for($i = 0; $i < $zip->numFiles; $i++) 
			    {   
			       	
			        $path_parts = pathinfo($dir . $zip->getNameIndex($i));
			        $actual_name = $zip->getNameIndex($i);
			        $tmp = $dirpy ."/". $actual_name;
			        if(!isset($path_parts['extension']))
			        {
			        	$failed=true;
			        	$reason="The zip file uploaded contains folders and other incorrect files";
			        	break;
			        }
			        else if(strtolower($path_parts['extension']) === 'jpg')
			        {
			        	$json=mark($_GET['path'], $memo, $student);
			        	array_push($results, process_result($json,$actual_name));
			        	break;
			        }
			        else if(strtolower($path_parts['extension']) === 'pdf')
			        {
			        	$json=mark($tmp, $memo, $student);
			        	array_push($results, process_result($json,$actual_name));
			        }
			    } 

			    $zip->close();
			   	$res=true;
			} 
			else 
			{
			    echo 'failed';
			}
		}
		else if(strtolower($info->getExtension())=="pdf")
		{
			$json = mark($_GET['path'], $_GET['memo_id'], $student );

			array_push($results, process_result($json, $_GET['path']));
		}

	

		if($failed)
		{
			echo "<center><div class='alert alert-danger'>$reason</div></center>";
		}
		else if(count($results)==1)
		{			
			print(view_result($results[0]));
		}
		else if(count($results)>1)
		{
			
			$directory = str_replace(".".$info->getExtension(), "","../marked_scripts/".$_GET['path']);
			$filename = "../../portal/docs/file.zip";
			zip_($directory, $filename);
			$html="";
			$html.=head();
			$html.='

			<div class="row">
			<div class="col-md-12">
			<center>
			<h1>Results</h1>
			</center>
			<table class="table table-hover">
				<thead>
					<th>Script</th>
					<th>Mark</th>
					<th>Status</th>
					<th>Download</th>
				</thead>
				<tbody>';
			$html.="";
			foreach ($results as $key => $value) 
			{
				
				$html.=view_result($value, true);
				
			}
			
			$html.='	</tbody>
			</table></div></div>';
			$html.=foot();
			$dir="../../portal/";
			if(!file_exists($dir))
			{
				mkdir($dir, 777, true);
			}
			$file=$dir."results.html";
			$myfile = fopen($file, "w") or die("Unable to open file!");
			fwrite($myfile, $html);
			fclose($myfile);
			?>


			<center>
				<div class='result'>
					<p  class='label-marks' style='font-size:20pt'>Finished marking</p>
					<div class="row">
						<div class="col-md-6">
							<a target='_blank' href="results.html" class='btn btn-primary pull-right' style="width:300px">Please click here to see the results</a>
						</div>
						<div class="col-md-6">
							<a target='_blank' href="docs/file.zip" class='btn btn-primary pull-left' download style="width:300px">Download scripts</a>
						</div>
					
					<br/><br/>
				</div>
			</center>

			<?php
			
		}
		?>

		<script type="text/javascript">
		 if (!("Notification" in window)) {
		    alert("This browser does not support desktop notification");
		  }

		  // Let's check whether notification permissions have already been granted
		  else if (Notification.permission === "granted") {
		    // If it's okay let's create a notification
		    var notification = new Notification("Marking complete");
		  }

		  // Otherwise, we need to ask the user for permission
		  else if (Notification.permission !== "denied") {
		    Notification.requestPermission(function (permission) {
		      // If the user accepts, let's create a notification
		      if (permission === "granted") {
		        var notification = new Notification("Marking complete");
		      }
		    });
		  }
		</script>

		<?php
		
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