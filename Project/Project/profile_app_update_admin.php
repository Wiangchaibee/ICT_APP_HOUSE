<?php

		include_once "class/Class_user.php";
		include_once "class/Class_database.php";
		include_once "class/Server_config.php";
		session_start();
	
		
		//update profile
		//print_r ($_FILES);
		//echo $_POST['tag'];
		//if($_FILES['screen_file1']['error'] == 4){echo 'aaa';}
			
			//echo $_POST["num"];
			/*$db = new database($GLOBALS['config']);
				 $res = $db -> query(
                                "SELECT * FROM `project` . `application`
                                WHERE `app_id` = '".$_POST["num"]."' 	  
                                ");	
								while($row = mysql_fetch_array($res)){
									$p=$row["app_g_id"];
								}
							*/	//echo $_POST['app_name_th'] , $_POST['app_name_en'] , $_FILES['app_file'] , $_FILES['logo_file'] ,  $_FILES['screen_file1'],$_FILES['screen_file2'],$_FILES['screen_file3'],$_POST['clip_show'],$_POST['detail'],$_POST['app_tag'],$_POST['time'],$p;
			$p=$_POST['num'];
			//echo $p;
			$_SESSION['user']->edit_profile_project($_POST,$_FILES,$p);
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
		
		
		//Echo "Updating";


?>
