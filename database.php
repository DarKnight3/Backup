<?php

	require 'pronerd-3.0.0.php';
	$databaseName="mkdevhub_caracal_db";
	$password="6~5Ke.7*oH}I!";
	$user="mkdevhub_caracal_user";
	$host="localhost";
	$database=new database($host,$user,$password,$databaseName);
	$database->set($host,$user,$password,$databaseName);
	$db=$database->connect();
	
?>