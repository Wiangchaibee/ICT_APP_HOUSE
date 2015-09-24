<?php
		include_once "class/Class_user.php";
		include_once "class/Class_database.php";
		include_once "class/Server_config.php";
		include_once "class/Class_app.php";
		include_once "class/Class_app_list.php";
		session_start();
	session_start();
	
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
	<form id="search_admin_project_com" name="search_admin_project_com" >
    	<table id="edit_admin_project" style="margin-left:230px; margin-top:50px;">
        	 <td>กรอกข้อมูลของแอปพลิเคชั่น <a style="color:#FF0000;">*</a></td>
                   <td>
                   			<input type="text" name="data" id="data" />
                                        
                   </td>
                   
               
        </table>
         <div class="button">
                <input type="button" value="ตกลง" onclick="admin_comment();"/>
                <input type="reset" value="ยกเลิก" />
            </div>
   </form>
  <div id="show_search_admin" style="height:500px; background-color:#FFFFFF; width:800px; overflow:auto;></div>
</body>
</html>