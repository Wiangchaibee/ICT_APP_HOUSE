<?php
	include_once "class/Class_database.php";
	include_once "class/Server_config.php";
	include_once "class/Class_user.php";
	session_start();
	 //print_r ($_SESSION['user']);	
	
?>

<script type="text/javascript" src="javascript/jqueryui/js/jquery-1.7.2.min.js"></script>
 <link rel="stylesheet" type="text/css" href="css/edit_profilegroup.css" />
<script type="text/javascript" src="ajax/edit_ajax.js"></script>
<div class="pic"><img src="img/iconeditgroup.png" /></div>
<form id="edit_profile_group_studen" name="edit_profile_group_studen" method="post" enctype="multipart/form-data" >
<div style="margin-left:170px; margin-top:50px; font-size:15px;"><a style="color:#FF0000;">*</a> = กรุณากรอกรายละเอียดให้ครบ</div>
 			<?php 
			 		$db = new database($GLOBALS['config']);
			
					  		 $res = $db -> query(
							"SELECT COUNT(s_g_id) AS aa FROM `student`
							WHERE `s_g_id` = '".$_SESSION['user']->group_id."'
							");	
							$row = mysql_fetch_row($res);
							$db->close();
							
							$db = new database($GLOBALS['config']);
                            
							 $re = $db -> query(
							"SELECT * FROM `project` . `group`
							WHERE `g_id` = '".$_SESSION['user']->group_id."'
							");	
							$rows = mysql_fetch_array($re);	
							 $id_advisor_1=$rows["g_a_id1"];
							  $id_advisor_2=$rows["g_a_id2"];
							  $g_grade=$rows["g_grade"];
							$db->close();		
							
						
		 ?>
  <table class="edit_group" width="649" border="1" style="margin-top:40px;">
  
  			<?php for($i=1;$i<=$row[0];$i++){ ?>
					<tr> 
                        <td width="116">สมาชิกกลุ่มคนที่<? echo $i; ?> <a style="color:#FF0000;">*</a></td>
                        <td width="401"> <input type="text" name="student_<? echo $i; ?>" id="student_<? echo $i; ?>"   value= "<?php 
                             
                                            $db = new database($GLOBALS['config']);
                            
                                             $r = $db -> query(
                                            "SELECT * FROM `project` . `student`
                                            WHERE `s_g_id` = '".$_SESSION['user']->group_id."' AND  `s_position` = '".$i."'
                                            ");	
                                            $ro = mysql_fetch_array($r);
                                            $id=$ro["s_id"];
											$name=$ro["s_name"];
                                            $db->close();
                                        //echo $res;echo $row;
										echo $id;
                                        
                                        
                         ?>" /></td>
                        <td width="110" id="name_<? echo $i; ?>" > <?php 
                        
                                            echo $name;
                        ?>  </td>
                      </tr>
                    	
                                
			<?	$number = $row[0];} ?>
      <tr>
        <td>สาขาวิชาของอาจารย์ที่ปรึกษาคนที่1 <a style="color:#FF0000;">*</a></td>
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
       <td> อาจารย์ที่ปรึกษาคนที่1 <a style="color:#FF0000;">*</a></td><td><select name="advisor_1" id="advisor_1"><?php
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
       <td> อาจารย์ที่ปรึกษาคนที่2 </td><td><select name="advisor_2" id="advisor_2">
        <?php
			if( $id_advisor_2 != '')
        	Echo "<option value=\"". $id_advisor_2."\"selected=\"selected\">". $a_name2."</option>";
			?>
        </select></td>
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
	
			<div class="button">
                <br /><br /><input type="button" value="ตกลง" onclick="edit_profile_group_student();"/>
                <input type="reset" value="ยกเลิก" />
            </div>
            <input type="hidden" name="number2" id="number2" value="<?php echo $number; ?>"/>
</form>
</body>
</html>