<?php
	require "database.php";
	$userT=new table("user",$database);
	$studentT=new table("student",$database);
	$assesmentT=new table("assesment",$database);
	$notificationT=new table("notification",$database);
	$student_assesmentT=new table("student_assesment",$database);
	$memoT=new table("memo",$database);
	$TutorialT =new table("tutorials", $database);
	
	$users=array();
	$students=array();
	$notifications=array();
	$student_asesments=array();
	$assesments=array();
	$memos=array();
	$tutorial=array();
	
	$tutorial=$TutorialT->select_all_rows();	
	$users=$userT->select_all_rows();
	$students=$studentT->select_all_rows();
	$notifications=$notificationT->select_all_rows();
	$student_assesments=$student_assesmentT->select_all_rows();
	$assesments=$assesmentT->select_all_rows();
	$memos=$memoT->select_all_rows();
	
	$tables['user']=$userT;
	$tables['student']=$studentT;
	$tables['notification']=$notificationT;
	$tables['assesment']=$assesmentT;
	$tables['student_assesment']=$student_assesmentT;
	$tables['memo']=$memoT;
	$tables['tutorials']=$TutorialT;
	$tables['request']=new table("request",$database);
	$tables['mark_sheet']=new table("mark_sheet",$database);
	$tables['query']=new table("query",$database);

	/*Define all the important variables*/
	$virtual_root="/caracal/portal";
	$shared_f="assets/php/shared";
	$scripts_f="assets/php/scripts";

?>