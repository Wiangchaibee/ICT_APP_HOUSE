<?php
include_once "class/Class_database.php";
include_once "class/server_config.php";
include_once "class/Class_user.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">@import "css/humanity.datepick.css";</style> 
<script type="text/javascript" src="js/jquery.datepick.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="ajax/ajax.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/register.css" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="javascript/jquery-ui-1.7.2.custom/css/smoothness/jquery-ui-1.7.2.custom.css">  
<script>
$(dateInput).datepick({dateFormat: 'dd-mm-yyyy'});

</script>
</head>

<body>
<div class="pic"><img src="img/iconregister.png" /></div>
<div id="register" name="register">
<form id="form_re" name="form_re" >
	<div style="margin-left:130px; margin-top:30px; font-size:12px;"><a style="color:#FF0000;">*</a> = กรุณากรอกรายละเอียดให้ครบ</div>
  <table width="250" border="1" class="register">
    <tr>
      <td>ชื่อสมาชิก <a style="color:#FF0000;">*</a></td>
      <td><label for="id"></label>
      <input type="text" name="id_register" id="id_register" size="20"/></td>
   	  <td><div id="user11" name="user11"></div></td>	
    </tr>
    <tr>
      <td>รหัสผ่าน <a style="color:#FF0000;">*</a></td>
      <td><label for="pass"></label>
      <input type="password" name="pass" id="pass" size="20"  /></td>
    </tr>
 
    <tr>
      <td>ยืนยันรหัสผ่าน <a style="color:#FF0000;">*</a></td>
      <td><label for="pass"></label>
      <input type="password" name="confirm_pass" id="confirm_pass" size="20" /></td>
    </tr>
    <tr>
      <td>ชื่อ - นามสกุล <a style="color:#FF0000;">*</a></td>
      <td><label for="name3"></label>
      <input type="text" name="name_sur" id="name_sur" </td>
    </tr>
    <tr>
     	<td>วันเกิด</td>
                   <td>
                     <input type="text" name="dateInput" id="dateInput"  />
  
	
                    </td> 
    </tr>
      <td>เบอร์โทรศัพท์</td>
      <td><label for="tel"></label>
      <input type="text" name="tel" id="tel" /></td>
    </tr>
    <tr>
      <td id="email">อีเมล <a style="color:#FF0000;">*</a></td>
      <td><label for="email"></label>
      <input type="email" name="email" id="email" /></td>
    </tr>
    <tr>
      <td>ที่อยู่</td>
      <td><label for="address"></label>
      <input type="text" name="address" id="address" /></td>
    </tr>
    <tr>
      <td>เพศ</td>
      <td>
      <select name="sex" id="sex">
        <?php
			if($_SESSION['user']->sex == NULL)
			
				echo "<option value=\"N/A\" selected=\"selected\">N/A</option>";	
			
			else
				echo "<option value=\"N/A\">N/A</option>";
				
				
				
			if($_SESSION['user']->sex == "ชาย")
			
				echo "<option value=\"male\" selected=\"selected\">ชาย</option>";	
			
			else
				echo "<option value=\"male\">ชาย</option>";
				
				
			
			if($_SESSION['user']->sex == 'หญิง')
			
				echo "<option value=\"female\" selected=\"selected\">หญิง</option>";	
			
			else
				echo "<option value=\"female\">หญิง</option>";		
				
		?>
      </select></td>
    </tr>
    <tr>
      <td>อาชีพ</td>
      <td>
      <select name="job" id="job">
        <?php
				
				
						$db = new database($GLOBALS['config']);
				
						$res = $db->query("select * from job");
				echo "<option value=\"N/A\" selected=\"selected\">N/A</option>";	
						while($row = mysql_fetch_assoc($res))
							{
					
								if($row['j_id'] == $_SESSION['user']->job_id)
									Echo "<option value=\"".$row['j_id']."\"selected=\"selected\">".$row['j_name']."</option>";
								else
									Echo "<option value=\"".$row['j_id']."\">".$row['j_name']."</option>";
							}
						$db->close();
										
					?>
      </select>
      </td>
    </tr> 
    </table>

 	<div class="button"><input type="button" name="submit" id="submit" value="สมัครสมาชิก" onclick="register();"/>
  	
    
    <input type="reset" name="clear" id="clear" value="ยกเลิก" /></div>
</form>
</div>
</body>
</html>