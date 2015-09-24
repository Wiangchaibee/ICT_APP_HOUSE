<?php
	include_once "class/Class_database.php";
	include_once "class/Server_config.php";	
	include_once "class/Class_user.php";	
	session_start(); 
	
	
							
   
   //echo $_POST["system"];
   //print_r ($_FILES['app_file']);
	$_SESSION['user']->group($_POST , $_FILES);
	//$clip = $_POST['clip_show'];
		//print_r ($_POST);
								
	
	//update Session
		$id 		= $_SESSION['user']->id;
		$id_type 	= $_SESSION['user']->id_type;
		
		//delete user in session
		unset($_SESSION['user']);
		
		//new obj
		switch($id_type){
			case 'm':$_SESSION['user'] = new member($id);
			break;
			case 's':$_SESSION['user'] = new student($id);
			break;
			case 'a':$_SESSION['user'] = new advisor($id);
			break;
			case 'x':$_SESSION['user'] = new admin($id);
			break;
			}
				 //Echo "Create success";

?>