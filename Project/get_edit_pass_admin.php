<?php
		include_once "class/Class_user.php";
		include_once "class/Server_config.php";
		include_once "class/Class_database.php";
		session_start();

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/greate_group.css" />
<script type="text/javascript" src="ajax/edit_ajax.js"></script>
<div class="pic"><img src="img/chang_pass.png" /></div>
<title>Untitled Document</title>
</head>
<body>
		<? if($_SESSION['user']->id_type == 'x' ){ ?> 
	  			<form name="add_pass_member1" id="add_pass_member1"  enctype="multipart/form-data">
                <table  style="margin-left:230px; margin-top:50px;">
                	<tr>
                    	<td>ชื่อบัญชีผูใช้ </td>
                		<td>
                        <input type="text" name="id_member" id="id_member" />
                         </td>  
                   </tr>    
                 </table>
                 <input type="hidden" id="num2" name="num2" value="<? echo $num; ?>"  />
           				 <div class="button" style="margin-left:350px;">
                            <input type="button" value="ตกลง" onclick="get_pass_admin();"/>
                            <input type="reset" value="ยกเลิก" />
                        </div>
        </form>
	  
	  <? } ?>
  <div id="show_search_admin" ></div>
</body>
</html>