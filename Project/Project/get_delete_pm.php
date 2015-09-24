<?php 
	include_once "class/Class_pm_list.php";

	session_start();
	//echo $id;
	//$_SESSION['pm_list']->pm_update();
	//$_SESSION['pm_list']->show_all();
	$_SESSION['pm_list']->delete_pm($id);
?>