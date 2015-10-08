<?php

		include_once "class/Class_user.php";
		include_once "class/Class_database.php";
		include_once "class/Server_config.php";
		session_start();
	
		
		//update profile
		//print_r ($_FILES);
		//echo $_POST['tag'];
		//if($_FILES['screen_file1']['error'] == 4){echo 'aaa';}
	 	//echo $_POST['num'];
		$_SESSION['user']->check_pass_member($_POST);
		//$sub_id = substr($_POST['id_member'],0,2);
		//print_r ($_POST);
		//if($sub_id == 's_') echo "aaaa";
		//if($sub_id != 's_') echo "bbb";
		//echo $sub_id;
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
