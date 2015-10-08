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
<link rel="stylesheet" type="text/css" href="css/edit_page.css" />
<script type="text/javascript" src="ajax/edit_ajax.js"></script>
<title>Untitled Document</title>
</head>
<body>
<img src="img/edit_user_admin.png" style="margin-left:50px; margin-top:50px;" />
	<form id="search_admin_user" name="search_admin_user"  enctype="multipart/form-data" >
    	<table id="edit_admin_user" style="margin-left:180px; margin-top:50px;">
        	 <td>กรอกข้อมูลของสมาชิก <a style="color:#FF0000;">*</a></td>
                   <td>
                   			<input type="text" name="data_user" id="data_user" />
                                        <select name="type_user" id="type_user">
                                        Echo "<option value='0'>N/A</option>";
                                            <option value="member">สมาชิกทั่วไป</option>
                                            <option value="student">นิสิต</option>
                                            <option value="advisor">อาจารย์ที่ปรึกษา</option>
                                            <?php if($_SESSION['user']->id == 'x_01'){ ?>
												<option value="admin">ผู้ดูแลระบบ</option>
										<?php 	}  ?>
                                        </select>
                   </td>
                   
               
        </table>
         <div class="button">
                <input type="button" value="ตกลง" onclick="admin_user();"/>
                <input type="reset" value="ยกเลิก" />
            </div>
   </form>
 <div id="show_search_admin" style="height:500px; background-color:#FFFFFF; width:800px; overflow:auto;"></div>
</body>
</html>