<?php

		include_once "class/Class_user.php";
		include_once "class/Class_database.php";
		include_once "class/Server_config.php";
		session_start();
	
		
		//update profile
		//print_r ($_POST);
		
		
		$_SESSION['user']->edit_profile($_POST);
		
		
		
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
		
		
		//Echo "Updating";


?>