<?php
		include_once "class/Class_user.php";
		include_once "class/Class_database.php";
		include_once "class/Server_config.php";
		include_once "class/Class_app.php";
		include_once "class/Class_app_list.php";
		session_start();

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/greate_group.css" />
<script type="text/javascript" src="ajax/ajax.js"></script>
<div class="pic"><img src="img/icongroup.png" /></div>
<title>Untitled Document</title>
</head>
<body>
<table id="selest_student_group" style="margin-left:230px; margin-top:50px;">
        	 <td>กรอกจำนวนสมาชิกกลุ่ม <a style="color:#FF0000;">*</a></td>
                   <td>
      <? if($_SESSION['user']->id_type != 'x' ){ ?> 
	  			<form name="add_student" id="add_student"  enctype="multipart/form-data">
                        <input type="text" name="num" id="num" />
                         </td>     
                    </table>
           				 <div class="button" style="margin-left:350px;">
                            <input type="button" value="ตกลง" onclick="group();"/>
                            <input type="reset" value="ยกเลิก" />
                        </div>
        </form>
	  
	  <? } ?>
		<? if($_SESSION['user']->id_type == 'x' ){ ?> 
	  			<form name="add_student" id="add_student"  enctype="multipart/form-data">
                        <input type="text" name="num" id="num" />
                         </td>     
                    </table>
           				 <div class="button" style="margin-left:350px;">
                            <input type="button" value="ตกลง" onclick="load_add_group_profile();"/>
                            <input type="reset" value="ยกเลิก" />
                        </div>
        </form>
	  
	  <? } ?>
  <div id="show_search_admin" ></div>
</body>
</html>