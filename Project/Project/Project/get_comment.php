<?php 
	include_once "class/Class_comment_list.php";

	session_start();
	
	$_SESSION['com_list']->com_update();
	$_SESSION['com_list']->show();
?>