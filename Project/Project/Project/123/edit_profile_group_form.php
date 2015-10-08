<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/edit_profilegroup.css" />
<script type="text/javascript" src="ajax/ajax.js"></script>
<title>Untitled Document</title>
</head>

<body>
<form id="edit_profilegroup" name="edit_profilegroup" method="post" enctype="multipart/form-data" >
  <table width="649" border="1">
  <tr>
    <td><table width="649" border="1">
      <tr>
        <td width="116">Student_1</td>
        <td width="401"> <input type="text" name="student_1" id="student_1"  disabled='true' value= "<?php echo $_SESSION['user']->id; ?>" /></td>
        <td width="110" id="name_1" > <?php echo $_SESSION['user']->name; ?>  </td>
      </tr>
      <tr>
        <td>Student_2</td>
        <td><input type="text" name="student_2" id="student_2"  /></td>
        <td id="name_2" >&nbsp;</td>
      </tr>
      <tr>
        <td>Student_3</td>
        <td><input type="text" name="student_3" id="student_3"  /></td>
        <td id="name_3" >&nbsp;</td>
      </tr>
      <tr>
        <td>Advisor_1</td>
        <td><select name="field_1" id="field_1" >
         			 <?php
				
				
							$db = new database($GLOBALS['config']);
					
							$res = $db->query("select * from field");
							
							Echo "<option value=\""."0"."\"selected=\"selected\">"."N/A"."</option>";
					
							while($row = mysql_fetch_assoc($res))
								{
						
										Echo "<option value=\"".$row['f_id']."\">".$row['f_name']."</option>";
									
								}
										
						?>
                        
        </select></td>
        <td><select name="advisor_1" id="advisor_1">
        </select></td>
      </tr>
      <tr>
        <td>Advisor_2</td>
        <td><select name="field_2" id="field_2" >
        	
          				<?php
				
				
							$db = new database($GLOBALS['config']);
					
							$res = $db->query("select * from field");
							
							Echo "<option value=\""."0"."\"selected=\"selected\">"."N/A"."</option>";
					
							while($row = mysql_fetch_assoc($res))
								{
						
										Echo "<option value=\"".$row['f_id']."\">".$row['f_name']."</option>";
									
								}
										
						?>
        </select></td>
        <td><select name="advisor_2" id="advisor_2">
        </select></td>
      </tr>
  </table>
    <input name="submit" type="submit" value="แก้ไข" onclick="" />
    <input name="reset" type="reset" value="ยกเลิก" />
</form>
</body>
</html>