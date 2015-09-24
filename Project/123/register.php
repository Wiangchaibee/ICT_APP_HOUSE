<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/register.css" />
<script type="text/javascript" src="ajax/ajax.js"></script>
<title>สมัครสมาชิก</title>
</head>

<body>
<div class="re1"><div id="text" align="center"><img src="image/icon3.png" /></div><div class="register" align="center"><form id="register" action="" method="get">
<table>
    <tr>
        <td>USER ID*</td>
        <td><input name="user" type="text" /></td>
        <td>คำเตือน</td>
    </tr>
    <tr>
        <td>PASSWORD*</td>
        <td><input name="pass" type="text" /></td>
        <td>ยืนยัน PASSWORD อีกครั้ง</td>
        <td><input name="pass" type="text" /></td>
        <td>picture</td>
    </tr>
    <tr>
        <td>ชื่อ-สกุล</td>
        <td><input name="name" type="text" /></td>
        <td>เพศ</td>
            <td><select name="sex" id="sex">
            
            
            <?php
                if($_SESSION['user']->sex == NULL)
                
                    echo "<option value=\"N/A\" selected=\"selected\">N/A</option>";	
                
                else
                    echo "<option value=\"N/A\">N/A</option>";
                    
                    
                    
                if($_SESSION['user']->sex == "male")
                
                    echo "<option value=\"male\" selected=\"selected\">Male</option>";	
                
                else
                    echo "<option value=\"male\">Male</option>";
                    
                    
                
                if($_SESSION['user']->sex == 'female')
                
                    echo "<option value=\"female\" selected=\"selected\">Female</option>";	
                
                else
                    echo "<option value=\"female\">Female</option>";		
                    
            ?>
          </select>
        <td>
   
    </tr>
       <tr>
        <td>เบอร์โทรศัพท์</td>
        <td><input name="tel" type="text" /></td>
         <td>อาชีพ</td>   
    </tr>
    <tr>
        <td>อีเมล</td>
        <td><input name="email" type="text" /></td>   
    </tr>
    <tr>
        <td>ที่อยู่</td>
        <td><textarea name="address" cols="25" rows="2"></textarea></td>   
    </tr>
</table>

		<br /><br /><br /><div class="action" align="center"><input name="submit" value="สมัคร" type="submit" /><input name="reset" value="ยกเลิก" type="reset" />
    </div></div></div>
</form>
<br /><br /><div align="center"><img src="image/icon.png" />
</body>
</html>
