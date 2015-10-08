<?php
	include_once "class/Class_database.php";
	include_once "class/Server_config.php";
	include_once "class/Class_user.php";
	session_start();
	 //print_r ($_SESSION['user']);	
?>

<script type="text/javascript" src="javascript/jqueryui/js/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/greate_group.css" />
<script type="text/javascript" src="ajax/ajax.js"></script>
<style type="text/css">@import "css/humanity.datepick.css";</style> 
<script type="text/javascript" src="js/jquery.datepick.js"></script>
<script>$(dateInput).datepick({dateFormat: 'dd-mm-yyyy'});</script>
<div class="pic"><img src="img/icongroup.png" /></div>
<form id="form_create_admin" name="form_create_admin" method="post" enctype="multipart/form-data" >
<div style="margin-left:100px; margin-top:50px; font-size:15px;"><a style="color:#FF0000;">*</a> = กรุณากรอกรายละเอียดให้ครบ</div>
  <table class="form_create_group1" width="649" border="1" style="margin-left:75px; margin-top:20px; border-color:transparent;">
			<?php 
                $n = $_POST['num'];
                if($n == '' || $n == '0'){
                        echo "กรุณาใส่จำนวนสมาชิกในกลุ่มให้ถูกต้อง";
                     die();
                    }
                $i = '1';
                while($i <= $n){ if($i == '1'){ ?>	
                    <tr>
                        <td width="116">รหัสประจำตัวสมาชิกกลุ่มคนที่ <?php echo $i; ?> <a style="color:#FF0000;">*</a></td>
                        <td width="401" name="aa1" id="aa1"> <input type="text" name="student_<?php echo $i; ?>" id="student_<?php echo $i; ?>" /></td>
                        <td width="110">ชื่อ-สกุล  <a style="color:#FF0000;">*</a> <input type="text" name="student_name_<?php echo $i; ?>" id="student_name_<?php echo $i; ?>" /></td>
                      </tr>
                <?php }else{ ?>
                    <tr>
                        <td width="116">รหัสประจำตัวสมาชิกกลุ่มคนที่ <?php echo $i; ?> <a style="color:#FF0000;">*</a></td>
                        <td width="401"> <input type="text" name="student_<?php echo $i; ?>" id="student_<?php echo $i; ?>" /></td>
                        <td width="110">ชื่อ-สกุล <a style="color:#FF0000;">*</a> <input type="text" name="student_name_<?php echo $i; ?>" id="student_name_<?php echo $i; ?>" /></td>
                      </tr>
            <?php   }$i++; } ?>
      <tr>
        <td>สาขาวิชาของอาจารย์ที่ปรึกษาคนที่1 <a style="color:#FF0000;">*</a></td>
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
                        
        </select></td></tr>
        <tr>
        <td>อาจารย์ที่ปรึกษาคนที่1 <a style="color:#FF0000;">*</a></td><td><select name="advisor_1" id="advisor_1">
        </select></td>
      </tr>
      <tr>
        <td>สาขาวิชาของอาจารย์ที่ปรึกษาคนที่2</td>
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
        </select></td></tr>
        <tr>
       <td> อาจารย์ที่ปรึกษาคนที่2 <a style="color:#FF0000;">*</a></td><td><select name="advisor_2" id="advisor_2">
        </select></td>
      </tr>
      
      
      <tr>
        <td>ชื่อแอปพลิเคชั่น <a style="color:#FF0000;">*</a></td>
        <td colspan=2><input type="text" name="app_name" id="app_name"/></td>
      </tr>

     <tr>
        <td>ไฟล์แอปลิเคชั่น <a style="color:#FF0000;">*</a></td>
        <td colspan=2><input type="file" name="app_file" id="app_file" /></td>
      </tr>
      <tr>
        <td>ไฟล์เอกสารที่เกี่ยวกับแอปลิเคชั่น <a style="color:#FF0000;">*</a></td>
        <td colspan=2><input type="file" name="app_doc" id="app_doc" /></td>
      </tr>
    
      <tr>
        <td>รูปภาพสัญลักษณ์ <a style="color:#FF0000;">*</a></td>
        <td colspan=2><input type="file" name="logo_file" id="logo_file" /></td>
      </tr>
      
       <tr>
        <td>รูปภาพประกอบ : 1 <a style="color:#FF0000;">*</a></td>
        <td colspan=2><input type="file" name="scr_file_1" id="scr_file_1" /></td>
      </tr>
    
    	<tr>
        <td>รูปภาพประกอบ : 2</td>
        <td colspan=2><input type="file" name="scr_file_2" id="scr_file_2" /></td>
      </tr>
      
      <tr>
        <td>รูปภาพประกอบ : 3</td>
        <td colspan=2><input type="file" name="scr_file_3" id="scr_file_3" /></td>
      </tr>
      
        <tr>
        	<td>คลิปวิดีโอ </td>
            <td colspan="2"><input type="text" name="clip_show" id="clip_show" /></td>
        </tr>
        <tr>
        	<td>รายละเอียด <a style="color:#FF0000;">*</a></td>  
            <td colspan="2"> <textarea type="text" id="de" name="de" rows="3" cols="35" ></textarea></td>
        </tr>
        <tr>
        	<td>รุ่นที่ปรับปรุง</td>
            <td colspan="2"><input type="text" name="version" id="version" /></td>
        
        </tr>
        <tr>
     	<td>วันที่อัพโหลด<a style="color:#FF0000;">*</a></td>
                   <td>
                     <input type="text" name="dateInput" id="dateInput"  />
  
	
                    </td> 
    </tr>
        <tr>
        	<td>ระบบที่รองรับ <a style="color:#FF0000;">*</a></td>
            <td colspan="2">
            <select name="app_system" id="app_system">
                	<?php Echo "<option value=\""."0"."\"selected=\"selected\">"."N/A"."</option>"; ?>
                    <option value="window">Window</option>;
                    <option value="android">Android</option>;
                    <option value="ios">ios</option>;
                    <option value="linux">Linux</option>;
        		</select>
                <!--<input type="checkbox" name="system[]" value="window" >Window
                <input type="checkbox" name="system[]" value="android">Android
                <input type="checkbox" name="system[]" value="ios">Ios<br />
                <input type="checkbox" name="system[]" value="linux">Linux  
                <input type="checkbox" name="system[]" value="N/A" checked="checked">   N/A  -->
            </td>
        </tr>
        <tr>
        	<td>สาขา <a style="color:#FF0000;">*</a></td>
            <td colspan="2">
            	<select name="app_field" id="app_field">
                	<?php
				
				
							$db = new database($GLOBALS['config']);
					
							$res = $db->query("select * from field");
							
							Echo "<option value=\""."0"."\"selected=\"selected\">"."N/A"."</option>";
					
							while($row = mysql_fetch_assoc($res))
								{
						
										Echo "<option value=\"".$row['f_id']."\">".$row['f_name']."</option>";
									
								}
										
						?>
        		</select>
            </td>
        </tr>
        
         <tr>
        	<td>ประเภท <a style="color:#FF0000;">*</a></td>
            <td colspan="2">
            	<select name="app_tag" id="app_tag">
                	<?php Echo "<option value=\""."0"."\"selected=\"selected\">"."N/A"."</option>"; ?>
                    <option value="เกม">เกม</option>;
                    <option value="ความบันเทิง">ความบันเทิง</option>;
                    <option value="การศึกษา">การศึกษา</option>;
                    <option value="สังคมและการสื่อสาร">สังคม และสื่อสาร</option>;
                    <option value="ดนตรีและเสียงเพลง">ดนตรี และเสียงเพลง</option>;
                    <option value="เครื่องมือ">เครื่องมือ</option>;
                    <option value="อื่นๆ">อื่นๆ</option>;
        		</select>
            </td>
        </tr>
        <tr>
        	<td>กลุ่มของนิสิตรหัสชั้นปี <a style="color:#FF0000;">*</a></td>
                <td colspan="2">
                            
                             <select name="group_grade" id="group_grade">
                            
                            	<? for($i=2540;$i<=2570;$i++){?>
									<option value="<? echo $i; ?>"><? echo $i; ?></option>
								<?	} ?>
                            </select>
                </td>
        </tr>
        
  </table>
 	 <input type="hidden" name="num" value="<?php echo $n; ?>"/>
    <div class="button"><input name="create_group" type="button" value="สร้างกลุ่ม" onclick="create_g_admin();" />
    <input type="reset" value="ยกเลิก" /></div>
</form>