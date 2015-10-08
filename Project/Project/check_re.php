<?php 
	include_once "class/Class_user.php";
	include_once "class/Class_database.php";
	include_once "class/Server_config.php";
	
	 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	
	$_SESSION['user']->register($_POST);
	//echo $_POST['id'];
	
	/*if($id=='1'){
		 $db = new database($GLOBALS['config']);                             
         $res = $db->query("select * from member where m_id = '".$id."' ");
		 $row = mysql_fetch_array($res);
		 if($row['m_id'] == '')	{
			echo "ชื่อบัญชีผู้ใช้นี้สามารถใช้งานได้";	
		}
		if($row['m_id'] != '')	{
			echo "ชื่อบัญชีผู้ใช้นี้ไม่สามารถใช้งานได้";	
		}
	}*/
	
	//print_r ($_POST);
	
?>