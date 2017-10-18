<?php

function upload_scripts($file, $dir, $file_name)
{


	$name = pathinfo($_FILES[$file]['name'], PATHINFO_FILENAME);
	$extension = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
	$increment =randomPassword(6).date_time();

	$increment ="_".randomPassword(3);
	$basename = $file_name . $increment .".". $extension;

	$target_dir = "$dir/";
	$target_file = $target_dir .$basename;

    if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) 
	{
		$file=$basename;
		return $file;
    }
    else
    {
    	return null;
    }
}
