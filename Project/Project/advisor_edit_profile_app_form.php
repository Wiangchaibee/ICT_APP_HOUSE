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
<style type="text/css">@import "css/humanity.datepick.css";</style> 
<script type="text/javascript" src="js/jquery.datepick.js"></script>
<script>$(dateInput).datepick({dateFormat: 'dd-mm-yyyy'});</script>
<body>
<?php  
$db = new database($GLOBALS['config']);
			
 $res = $db -> query(
"SELECT * FROM `project` . `application`
WHERE `app_g_id` = '".$i."'
");	
$row = mysql_fetch_array($res);
$g = $i;
$name_app=$row["app_name"];
$app_clip=$row["app_clip"];
$app_tag=$row["app_tag"];
$app_path=$row["app_path"];
$app_doc=$row["app_doc"];
$app_logo=$row["app_logo"];
$app_datail=$row["app_detail"];
$app_system=$row["app_system"];
$app_version=$row['app_version'];
$app_scr_1=$row['app_scr_1'];
$app_scr_2=$row['app_scr_2'];
$app_scr_3=$row['app_scr_3'];
$app_field=$row['app_filed'];
$time=$row['app_time'];
$db->close();
					$db = new database($GLOBALS['config']);
			
					  		 $res2 = $db -> query(
							"SELECT COUNT(s_g_id) AS aa FROM `student`
							WHERE `s_g_id` = '".$i."'
							");	
							$row2 = mysql_fetch_row($res2);
							$db->close();
							
							$db = new database($GLOBALS['config']);
                            
							 $re = $db -> query(
							"SELECT * FROM `project` . `group`
							WHERE `g_id` = '".$i."'
							");	
							$rows = mysql_fetch_array($re);	
							 $id_advisor_1=$rows["g_a_id1"];
							  $id_advisor_2=$rows["g_a_id2"];
							  $g_grade=$rows["g_grade"];
							$db->close();		
							$nn =$row2[0];
?>
<div class="pic"><img src="img/iconapp.png" /></div>
<form id="edit_app_group" name="edit_app_group"  enctype="multipart/form-data" action="profile_app_update.php" method="post" >
	<table class="editer">
      <?php for($o=1;$o<=$row2[0];$o++){ ?>
					<tr> 
                        <td width="116">สมาชิกกลุ่มคนที่<? echo $o; ?> <a style="color:#FF0000;">*</a></td>
                        <td width="401"> <input type="text" name="student_<? echo $o; ?>" id="student_<? echo $o; ?>"   value= "<?php 
                             
                                            $db = new database($GLOBALS['config']);
                            
                                             $r = $db -> query(
                                            "SELECT * FROM `project` . `student`
                                            WHERE `s_g_id` = '".$i."' AND `s_position` = '".$o."'
                                            ");	
                                            $ro = mysql_fetch_array($r);
                                            $id=$ro["s_id"];
											$name=$ro["s_name"];
                                            $db->close();
                                        //echo $res;echo $row;
										echo $id;
                                        
                                        
                         ?>" />
                        <h width="110" id="name_<? echo $o; ?>" > <?php echo $name;
                        ?>  </h></td>
                      </tr>
                    	
                                
			<?	} ?>
      
    	 <tr>
        <td>สาขาวิชาของอาจารย์ที่ปรึกษาคนที่1  <a style="color:#FF0000;">*</a></td>
        <td><select name="field_1" id="field_1" >
         			 <?php
					$db = new database($GLOBALS['config']);
                            
							 $res1 = $db -> query(
							"SELECT * FROM `project` . `advisor`
							WHERE `a_id` = '".$id_advisor_1."'
							");	
							$row1 = mysql_fetch_array($res1);	
								$a_f_id1=$row1["a_f_id"];
								$a_name1=$row1["a_name"];
							$db->close();
							
						$db = new database($GLOBALS['config']);
                            
							 $res1_1 = $db -> query(
							"SELECT * FROM `project` . `field`
							WHERE `f_id` = '".$a_f_id1."'
							");	
							$row1_1 = mysql_fetch_array($res1_1);	
								$f_name_1=$row1_1["f_name"];
							$db->close();
							
								
							$db = new database($GLOBALS['config']);
					
							$res = $db->query("select * from field");
							
						
								Echo "<option value=\"".$a_f_id1."\"selected=\"selected\">".$f_name_1."</option>";
							
					
							while($row = mysql_fetch_assoc($res))
								{
						
										Echo "<option value=\"".$row['f_id']."\">".$row['f_name']."</option>";
									
								}
										
						?>
                        
        </select></td></tr>
        <tr>
        <td>อาจารย์ที่ปรึกษาคนที่1  <a style="color:#FF0000;">*</a></td><td><select name="advisor_1" id="advisor_1"><?php
			if( $id_advisor_1 != '')
        	Echo "<option value=\"". $id_advisor_1."\"selected=\"selected\">". $a_name1."</option>";
			?>
        </select></td>
      </tr>
      <tr>
        <td>สาขาวิชาของอาจารย์ที่ปรึกษาคนที่2</td>
        <td><select name="field_2" id="field_2" >
        	
          				<?php
				$db = new database($GLOBALS['config']);
                            
							 $res1 = $db -> query(
							"SELECT * FROM `project` . `advisor`
							WHERE `a_id` = '".$id_advisor_2."'
							");	
							$row1 = mysql_fetch_array($res1);	
								$a_f_id2=$row1["a_f_id"];
								$a_name2=$row1["a_name"];
							$db->close();
							
						$db = new database($GLOBALS['config']);
                            
							 $res1_1 = $db -> query(
							"SELECT * FROM `project` . `field`
							WHERE `f_id` = '".$a_f_id2."'
							");	
							$row1_1 = mysql_fetch_array($res1_1);	
								$f_name_2=$row1_1["f_name"];
							$db->close();
						
				
				
							$db = new database($GLOBALS['config']);
					
							$res = $db->query("select * from field");
							
								Echo "<option value=\"".$a_f_id2."\"selected=\"selected\">".$f_name_2."</option>";
							
							while($row = mysql_fetch_assoc($res))
								{
						
										Echo "<option value=\"".$row['f_id']."\">".$row['f_name']."</option>";
									
								}
										
						?>
        </select></td></tr>
        <tr>
      <td>  อาจารย์ที่ปรึกษาคนที่2 </td><td><select name="advisor_2" id="advisor_2">
        <?php
			if( $id_advisor_2 != '')
        	Echo "<option value=\"". $id_advisor_2."\"selected=\"selected\">". $a_name2."</option>";
			?>
        </select></td>
      </tr>
        <tr>
            <td>ชื่อแอปพลิเคชั่น <a style="color:#FF0000;">*</a></td>
            <td colspan=2><input type="text" name="app_name" id="app_name" value= 
						<?php  
						
							echo $name_app;
							
						?> 
                        />
         </tr>
         
                                          
        
        
        
        <tr>
            <td>ไฟล์โปรแกรม <a style="color:#FF0000;">*</a></td>
            <td colspan=2><input type="file" name="app_file" id="app_file" />
            		<?php   $p=explode("/",$app_path,4); 
						
							echo $p[3];
							
					?>
            </td>
       <tr>
       <tr>
        <td>ไฟล์เอกสารที่เกี่ยวกับแอปลิเคชั่น <a style="color:#FF0000;">*</a></td>
        <td colspan=2><input type="file" name="app_doc" id="app_doc" /><?php  
						
							$d=explode("/",$app_doc,4); 
						
							echo $d[3];
							
					?></td>
      
                                            
        <tr>
            <td>รูปภาพสัญลักษณ์ <a style="color:#FF0000;">*</a></td>
            <td colspan=2><input type="file" name="logo_file" id="logo_file" />
            					<img src="<?php 
                                
                               echo $app_logo; ?>" width="30" height="30">
        </tr>
        
        
        
        <tr>
        	<td>รูปภาพประกอบ : 1 <a style="color:#FF0000;">*</a></td>
            <td colspan="2"><input type="file" name="screen_file1" id="screen_file1" /><img src="<?php 
                                
                               echo $app_scr_1; ?>" width="30" height="30"></td>
        </tr>
        
        
        <tr>
        	<td>รูปภาพประกอบ : 2</td>
            <td colspan="2"><input type="file" name="screen_file2" id="screen_file2" /><img src="<?php 
                                
                               echo $app_scr_2; ?>" width="30" height="30"></td>
        </tr>
        
        
        <tr>
        	<td>รูปภาพประกอบ: 3</td>
            <td colspan="2"><input type="file" name="screen_file3" id="screen_file3" /><img src="<?php 
                                
                               echo $app_scr_3; ?>" width="30" height="30"></td>
            </td>
        </tr>
        <tr>
            <td>ประเภท <a style="color:#FF0000;">*</a></td>
           		 <td colspan="2">
                    <select name="app_tag" id="app_tag">
                        <?php
                              
										Echo "<option value=\""."0"."\"selected=\"selected\">"."N/A"."</option>";
                                        if($app_tag == 'game'){
											 Echo "<option value=\"".game."\"selected=\"selected\">".เกม."</option>";
										?> 
                                        <option value="ความบันเทิง">ความบันเทิง</option>;
                                        <option value="การศึกษา">การศึกษา</option>;
                                        <option value="สังคมและการสื่อสาร">สังคม และสื่อสาร</option>;
                                        <option value="ดนตรีและเสียงเพลง">ดนตรี และเสียงเพลง</option>;
                                        <option value="เครื่องมือ">เครื่องมือ</option>;
                                        <option value="อื่นๆ">อื่นๆ</option>; <?php
										}if($app_tag == 'entertain'){                
                                             Echo "<option value=\"".entertain."\"selected=\"selected\">".ความบันเทิง."</option>";
											 	?> <option value="เกม">เกม</option>;
                                        <option value="การศึกษา">การศึกษา</option>;
                                        <option value="สังคมและการสื่อสาร">สังคม และสื่อสาร</option>;
                                        <option value="ดนตรีและเสียงเพลง">ดนตรี และเสียงเพลง</option>;
                                        <option value="เครื่องมือ">เครื่องมือ</option>;
                                        <option value="อื่นๆ">อื่นๆ</option>; <?php
										}if($app_tag == 'edu'){              
                                             Echo "<option value=\"".edu."\"selected=\"selected\">".การศึกษา."</option>";	 
											 ?>  <option value="เกม">เกม</option>;
                                            <option value="ความบันเทิง">ความบันเทิง</option>;
                                            <option value="สังคมและการสื่อสาร">สังคม และสื่อสาร</option>;
                                            <option value="ดนตรีและเสียงเพลง">ดนตรี และเสียงเพลง</option>;
                                            <option value="เครื่องมือ">เครื่องมือ</option>;
                                            <option value="อื่นๆ">อื่นๆ</option>;<?php
									 	}if($app_tag == 'app'){
											 Echo "<option value=\"".app."\"selected=\"selected\">".สังคม."".และสื่อสาร."</option>";
											  ?>   <option value="เกม">เกม</option>;
                                        <option value="ความบันเทิง">ความบันเทิง</option>;
                                        <option value="การศึกษา">การศึกษา</option>;
                                        <option value="ดนตรีและเสียงเพลง">ดนตรี และเสียงเพลง</option>;
                                        <option value="เครื่องมือ">เครื่องมือ</option>;
                                        <option value="อื่นๆ">อื่นๆ</option>; <?php
										}if($app_tag == 'music'){               
                                             Echo "<option value=\"".music."\"selected=\"selected\">".ดนตรี."".และเสียงเพลง."</option>";	
											   ?>   <option value="เกม">เกม</option>;
                                        <option value="ความบันเทิง">ความบันเทิง</option>;
                                        <option value="การศึกษา">การศึกษา</option>;
                                        <option value="สังคมและการสื่อสาร">สังคม และสื่อสาร</option>;
                                        <option value="เครื่องมือ">เครื่องมือ</option>;
                                        <option value="อื่นๆ">อื่นๆ</option>; <?php	 
										}if($app_tag == 'tool'){                
                                             Echo "<option value=\"".tool."\"selected=\"selected\">".เครื่องมือ."</option>";
											 	?>   <option value="เกม">เกม</option>;
                                        <option value="ความบันเทิง">ความบันเทิง</option>;
                                        <option value="การศึกษา">การศึกษา</option>;
                                        <option value="สังคมและการสื่อสาร">สังคม และสื่อสาร</option>;
                                        <option value="ดนตรีและเสียงเพลง">ดนตรี และเสียงเพลง</option>;
                                        <option value="อื่นๆ">อื่นๆ</option>;
										 <?php
										}if($app_tag == 'etc'){                
                                             Echo "<option value=\"".etc."\"selected=\"selected\">".อื่นๆ."</option>";	
											 	?>  <option value="เกม">เกม</option>;
                                        <option value="ความบันเทิง">ความบันเทิง</option>;
                                        <option value="การศึกษา">การศึกษา</option>;
                                        <option value="สังคมและการสื่อสาร">สังคม และสื่อสาร</option>;
                                        <option value="ดนตรีและเสียงเพลง">ดนตรี และเสียงเพลง</option>;
                                        <option value="เครื่องมือ">เครื่องมือ</option>;
										 <?php 	 	 
										}
										
										
                           ?>
                    </select>
           		 </td>
        <tr>
         <tr>
        	<td>สาขา <a style="color:#FF0000;">*</a></td>
            <td colspan="2">
            	<select name="app_field" id="app_field">
                	<?php
		
							Echo "<option value=\""."0"."\"selected=\"selected\">"."N/A"."</option>";
							if($app_field == '1'){
								Echo "<option value=\""."1"."\"selected=\"selected\">"."วิทยาการคอมพิวเตอร์"."</option>";
							?> <option value="2">วิศวกรรมคอมพิวเตอร์</option>;
								<option value="3">เทคโนโลยีสารสนเทศ</option>;
								<option value="4">คอมพิวเตอร์ธุระกิจ</option>;
								<option value="5">ภูมิสารสนเทศศาสตร์</option>;
					<?php } ?>
					<?php if($app_field == '2'){
								Echo "<option value=\""."2"."\"selected=\"selected\">"."วิศวกรรมคอมพิวเตอร์"."</option>";
							?> <option value="1">วิทยาการคอมพิวเตอร์</option>;
								<option value="3">เทคโนโลยีสารสนเทศ</option>;
								<option value="4">คอมพิวเตอร์ธุระกิจ</option>;
								<option value="5">ภูมิสารสนเทศศาสตร์</option>;
					<?php } ?>	
                    <?php if($app_field == '3'){
								Echo "<option value=\""."3"."\"selected=\"selected\">"."เทคโนโลยีสารสนเทศ"."</option>";
							?> <option value="1">วิทยาการคอมพิวเตอร์</option>;
								<option value="2">วิศวกรรมคอมพิวเตอร์</option>;
								<option value="4">คอมพิวเตอร์ธุระกิจ</option>;
								<option value="5">ภูมิสารสนเทศศาสตร์</option>;
					<?php } ?>
                    <?php if($app_field == '4'){
								Echo "<option value=\""."4"."\"selected=\"selected\">"."คอมพิวเตอร์ธุระกิจ"."</option>";
							?> <option value="1">วิทยาการคอมพิวเตอร์</option>;
								<option value="2">วิศวกรรมคอมพิวเตอร์</option>;
								<option value="3">เทคโนโลยีสารสนเทศ</option>;
								<option value="5">ภูมิสารสนเทศศาสตร์</option>;
					<?php } ?>	
                    <?php if($app_field == '5'){
								Echo "<option value=\""."5"."\"selected=\"selected\">"."ภูมิสารสนเทศศาสตร์"."</option>";
							?> <option value="1">วิทยาการคอมพิวเตอร์</option>;
								<option value="2">วิศวกรรมคอมพิวเตอร์</option>;
								<option value="3">เทคโนโลยีสารสนเทศ</option>;
								<option value="4">คอมพิวเตอร์ธุระกิจ</option>;
					<?php } ?>			
						
        		</select>
            </td>
        </tr>
        </tr>
        	<td>ระบบที่รองรับ <a style="color:#FF0000;">*</a></td>
            <td colspan="2">
				<select name="app_system" id="app_system">
                <?php if($app_system == 'window'){
					Echo "<option value=\""."window"."\"selected=\"selected\">"."Window"."</option>";?> 
					<option value="android">Android</option>;
                    <option value="ios">ios</option>;
                    <option value="linux">Linux</option>;
				<?php } ?>
                <?php if($app_system == 'android'){
					Echo "<option value=\""."android"."\"selected=\"selected\">"."Android"."</option>";?> 
					<option value="window">Window</option>;
                    <option value="ios">ios</option>;
                    <option value="linux">Linux</option>;
				<?php } ?>
                  <?php if($app_system == 'ios'){
					Echo "<option value=\""."ios"."\"selected=\"selected\">"."ios"."</option>";?> 
					<option value="window">Window</option>;
                    <option value="android">Android</option>;
                    <option value="linux">Linux</option>;
				<?php } ?>
                 <?php if($app_system == 'linux'){
					Echo "<option value=\""."linux"."\"selected=\"selected\">"."Linux"."</option>";?> 
					<option value="window">Window</option>;
                    <option value="android">Android</option>;
                    <option value="ios">ios</option>;
				<?php } ?>
                <?php if($app_system == '' || $app_system == '0'){
					Echo "<option value=\""."N/A"."\"selected=\"selected\">"."N/A"."</option>";?> 
					<option value="window">Window</option>;
                    <option value="android">Android</option>;
                    <option value="ios">ios</option>;
                    <option value="linux">Linux</option>;
				<?php } ?>
        		</select>
            </td>
        </tr>
        
        <tr>
               <td>คลิป</td>
            	<td colspan="2"><textarea type="text" name="clip_show" id="clip_show" rows="2" cols="25"><?php echo $app_clip;?></textarea>
                 </td>
            </td>
        </tr>
        
        
        <tr>
        	<td>รายละเอียด <a style="color:#FF0000;">*</a></td>
            <td colspan="2"> <textarea type="text" id="app_detail" name="app_detail" rows="5" cols="35" ><?php echo $app_datail; ?></textarea></td>
        </tr>
         <tr>
            </td>
            <td>รุ่นที่ปรับปรุง</td>
            <td colspan="2"><input type="text" name="app_version" id="app_version" value="<? echo $app_version;?>"/></td>
            
        </tr>
        <tr>
     	<td>วันที่อัพโหลดแก้ไข<a style="color:#FF0000;">*</a></td>
                   <td>
                     <input type="text" name="dateInput" id="dateInput" value="<? echo $time; ?>"/>
  
	
                    </td> 
   		 </tr>
         <tr>
        	<td>กลุ่มของนิสิตรหัสชั้นปี <a style="color:#FF0000;">*</a></td>
                <td colspan="2">
                				
              				  <select name="group_grade" id="group_grade">
                              	<? Echo "<option value=\"". $g_grade."\"selected=\"selected\">". $g_grade."</option>"; ?>
                            	<? for($i=2540;$i<=2570;$i++){?>
									<option value="<? echo $i; ?>"><? echo $i; ?></option>
								<?	} ?>
                            </select>
                </td>
        </tr>
	</table>
    
              <input type="hidden" name="num" value="<?php echo $g; ?>"/>
              <input type="hidden" name="nn" value="<?php echo $nn; ?>"/>
            <div class="button">
                <input type="button" value="ตกลง" onclick="edit_profile_app_advisor();"/>
                <input type="reset" value="ยกเลิก" />
            </div>
    
</form>
</body>
</html>