<?php
	include_once "class/Class_user.php";
	include_once "class/Class_database.php";
	include_once "class/Server_config.php";
	
	session_start(); 
	//print_r($_SERVER['REMOTE_ADDR']);
	/*print_r ($_POST['comment']);
	print_r ($_SESSION['user']->id);
	print_r ($_SESSION['viewing_app_id']);
	print_r ($_SERVER['REMOTE_ADDR']);*/
	
	
	//print_r ($GLOBALS['config']);
	//echo $_POST['topic'] , $_POST['text'];
	$_SESSION['user']->pm($_POST);
	//$data = substr($_POST['re'],0,1);
	//print_r ($data);
					
					
					
//echo mysql_error();
	
?>