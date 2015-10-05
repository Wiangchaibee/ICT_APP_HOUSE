<?php
		include_once "class/Class_user.php";
		include_once "class/Class_database.php";
		include_once "class/Server_config.php";
		include_once "class/Class_app.php";
		include_once "class/Class_app_list.php";
		include_once "class/Class_pm.php";
		include_once "class/Class_pm_list.php";
	
	$_SESSION['pm_list'] = new pm_list();
?> 
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/edit_page.css" />
<script type="text/javascript" src="ajax/edit_ajax.js"></script>
<title>Untitled Document</title>
</head>
<body>
<img src="img/box_comment.png" style="margin-left:50px; margin-top:50px;" />
	<div name="pm_show1" id="pm_show1" style="margin-left:250px; margin-top:100px; background-color:#CCC; border:1px solid #000; width:300px;">
    	<hr />
    </div>
    
</body>
</html>