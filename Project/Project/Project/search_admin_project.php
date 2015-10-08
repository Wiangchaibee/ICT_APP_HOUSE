<?php 

		include_once "class/Class_user.php";
		include_once "class/Class_database.php";
		include_once "class/Server_config.php";
		session_start();

		//echo $_POST['data_project'];
		if($_POST['data_project'] == ''){
		 	echo "กรุณากรอกข้อมูล";	
		}
		else{
			//echo "aaa";
			$_SESSION['user']->search_admin_project($_POST['data_project']);
		}
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