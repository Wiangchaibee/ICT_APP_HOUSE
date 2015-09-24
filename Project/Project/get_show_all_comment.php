<?php 
	include_once "class/Class_comment_list.php";

	session_start();
	
	
	$_SESSION['com_list']->com_update();
	$_SESSION['com_list']->show_all();
	//echo $_SESSION['com_list']->a($app_id);
	//print_r ($_SESSION['com_list']->a($_SESSION['viewing_app_id']));
	//print_r ($_SESSION['com_list']);
?>