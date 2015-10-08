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
	<?php   if($_SESSION['user']->id_type != 'x'){ ?>
    <img src="img/send_admin.png" style="margin-left:50px; margin-top:50px;" />
    
	<form id="pm_box" name="pm_box" >
    	<table style="margin-left:250px; margin-top:100px; font-size:15px;">
        <tr>
        	 <td>หัวข้อ</td>
                   <td>
                   			<input type="text" name="topic" id="topic" style="width:200px;"/>
                                        
                   </td>
            </tr>
            <tr>       
        
         
         	<td valign="top">ข้อความ</td>
            <td>
            		<textarea id="text" name="text" style="width:200px; height:100px;"></textarea>
            		
            </td>
          </tr>     
        </table>
         <div class="button">
                <input type="button" value="ตกลง" onclick="send_pm();"/>
                <input type="reset" value="ยกเลิก" />
            </div>
   </form>
  <?php } ?> 
  <?php   if($_SESSION['user']->id_type == 'x'){ ?>
  <img src="img/send_user.png" style="margin-left:50px; margin-top:50px;" />
	<form id="pm_box" name="pm_box" >
    	<table style="margin-left:250px; margin-top:100px; font-size:15px;">
        <tr>
        	 <td>หัวข้อ</td>
                   <td>
                   			<input type="text" name="topic" id="topic" style="width:200px;" />
                                        
                   </td>
            </tr>
            <tr>       
        
         
         	<td>ส่งถึงคุณ</td>
            <td>
            		<input id="re" name="re" style="width:203px;"   />
            		
            </td>
          </tr> 
            <tr>       
        
         
         	<td valign="top">ข้อความ</td>
            <td>
            		<textarea id="text" name="text" style="width:200px; height:100px;"></textarea>
            		
            </td>
          </tr>     
        </table>
         <div class="button">
                <input type="button" value="ตกลง" onclick="send_pm();"/>
                <input type="reset" value="ยกเลิก" />
            </div>
   </form>
  <?php } ?>
</body>
</html>

 
