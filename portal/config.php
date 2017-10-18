<?php 

    require "assets/php/script/extract.php";
    $file="assets/db/mkdevhub_caracal_db.sql";
    if(file_exists($file))
    {
    	$stmt = file_get_contents($file);
    	// echo $stmt;
    	if($database->execute_multiple($stmt))
    	{
    		echo "<center><h1>Configuration complete</h1></center>";
    		header("Refresh: 20; url=home.php");
    	}
    	else
    	{
    		echo "<center><h1>Configuration failed, unable to execute queries</h1></center>";
    	}
    }
    else if(file_exists("assets/db/mkdevhub_caracal_db.sql"))
    {
        $stmt = file_get_contents("assets/db/mkdevhub_caracal_db.sql");
        // echo $stmt;
        if($database->execute_multiple($stmt))
        {
            echo "<center><h1>Configuration complete</h1></center>";
            header("Refresh: 20; url=home.php");
        }
        else
        {
            echo "<center><h1>Configuration failed, unable to execute queries</h1></center>";
        }
    }
    else
    {
    	echo "<center><h1>Configuration failed, the db file is not available</h1></center>";
    }
    

 ?>