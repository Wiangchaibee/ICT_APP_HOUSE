<?php
	include_once "class/Class_user.php";
	include_once "class/Class_database.php";
	include_once "class/Server_config.php";
	
	session_start(); 
	$_SESSION['user']->comment($_POST['comment'] , $_SESSION['viewing_app_id'] , $_SERVER['REMOTE_ADDR']);
	
	
	
	//print_r($_SERVER['REMOTE_ADDR']);
	/*print_r ($_POST['comment']);
	print_r ($_SESSION['user']->id);
	print_r ($_SESSION['viewing_app_id']);
	print_r ($_SERVER['REMOTE_ADDR']);*/
	
	
	//print_r ($GLOBALS['config']);
	

	/*$db = new database($GLOBALS['config']);
				
				$db->query(
					"INSERT INTO `project`.`comment`(
				`com_id`			,
				`com_text`			,
				`com_u_id`			,
				`com_app_id`		,
				`com_time`			,
				`com_ip`			
				)
			VALUES(	
					'' , '".$_POST['comment']."' , '".$_SESSION['user']->id."', '".$_SESSION['viewing_app_id']."' , CURRENT_TIMESTAMP,'".$_SERVER['REMOTE_ADDR']."'
		);"	);
		*/			
					
					
//echo mysql_error();
	
?>