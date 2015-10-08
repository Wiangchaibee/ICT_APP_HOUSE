<?php
		include_once "class/Class_user.php";
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

	<?  $num2 = split("/", $num, 3); 
		if($num == '1' ){ ?> 
        	<form name="edit_pass_nemmber" id="edit_pass_member"  >
                    <table  style="margin-left:230px; margin-top:50px;">
                        <tr>
                         <td>รหัสผ่านเก่า</td>
                               <td>
                                    
                                   <input type="password" name="pass_old" id="pass_old" />
                                 </td>   
                         </tr>
                         <tr><td>รหัสผ่านใหม่</td>
                               <td>
                                    
                                    <input type="password" name="pass_new1" id="pass_new1" />
                                 </td>       
                         </tr>
                         <tr><td>รหัสผ่านใหม่ อีกรอบ</td>
                               <td>
                                    
                                    <input type="password" name="pass_new2" id="pass_new2" />
                                 </td>      
                      	</tr>      
                               
                     </table>
           				 <div class="button" style="margin-left:350px;">
                            <input type="button" value="ตกลง" onclick="update_pass();"/>
                            <input type="reset" value="ยกเลิก" />
                        </div>
       		 </form>
	  
	  <? }?>
  <div id="show_search_admin" ></div>
</body>
</html>