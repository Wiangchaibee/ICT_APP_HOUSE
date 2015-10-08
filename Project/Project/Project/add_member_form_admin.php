<?php
	include_once "class/Class_user.php";
	session_start();
	
	//echo $_SESSION['user']->job_id;
?><style type="text/css">@import "css/humanity.datepick.css";</style> 
<script type="text/javascript" src="js/jquery.datepick.js"></script>
<script>$(dateInput).datepick({dateFormat: 'dd-mm-yyyy'});</script>
 		  
         <!-- <div class="pic"><img src="img/iconprofile.png" /></div> -->
     <?php if($type== 's'){ ?>  <img src="img/add_student.png" style="margin-top:40px; margin-left:50px;" />  <?php } ?>
      <?php if($type== 'a'){ ?>  <img src="img/add_advisor.png" style="margin-top:40px; margin-left:50px;" />  <?php } ?>
       <?php if($type== 'x'){ ?>  <img src="img/add_admin.png" style="margin-top:40px; margin-left:50px;" />  <?php } ?>
          <div class="form_profile" align="center">
          <form name="form_profile" method="post" id="form_profile">
          <div style="margin-left:-320px; margin-top:50px; font-size:15px;"><a style="color:#FF0000;">*</a> = กรุณากรอกรายละเอียดให้ครบ</div>
                <table width="406" height="405" border="1" class="edit" style="margin-top:30px;">
                  <tr>
                  
                  <td>ชื่อบัญชีผู้ใช้ <a style="color:#FF0000;">*</a></td>
                    <td>
                      <input type="text" name="id" id="id" <?php if($type == 's'){?> value="s_" <?php } ?>  <?php if($type == 'a'){?> value="a_" <?php } ?> <?php if($type == 'x'){?> value="x_" <?php } ?>>
                    </td>
                    <td>รหัส <a style="color:#FF0000;">*</a></td>
                    <td>
                      <input type="password"name="pass" id="pass"  >
                    </td>
                    </tr>
                    <tr>
                    <td>ชื่อ-สกุล <a style="color:#FF0000;">*</a></td>
                    <td>
                      <input type="text" name="name" id="name"  >
                    </td>
                    <td>เพศ</td>
                    <td>
                      <label for="sex"></label>
                      <select name="sex" id="sex">
                        
                        
                        <?php
                          
                            
                                echo "<option value=\"N/A\" selected=\"selected\">N/A</option>";	
                           
                                echo "<option value=\"male\">Male</option>";

                                echo "<option value=\"female\">Female</option>";		
                                
                        ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>วันเกิด</td>
                   <td>
                     <input type="text" name="dateInput" id="dateInput"  />
                     
  
						
                     <td>เบอร์โทรศัพท์ <a style="color:#FF0000;">*</a></td>
                                <td>
                                  <label for="tel"></label>
                                  <input type="text" name="tel" id="tel">
                                </td>
                       
                    	
                            
                  

                  </tr>
                  <tr>
                  
                 		 <td height="10">ที่อยู่</td>
                         <td>
                          <label for="address"></label>
                         <textarea name="address" cols="15" rows="3" ></textarea>
                    	</td>
                        <td>อีเมล <a style="color:#FF0000;">*</a></td>
                    <td>
                      <label for="email"></label>
                      <input type="email" name="email" id="email">
                    </td>
                    
                  </tr>
					 <tr>
                             
                    <?php
                                include_once "class/Class_database.php";
                                include_once "class/server_config.php";
                    
                        switch($type){
                                //Case member
                            case'm':
                                //html code member
                                ?>
                                 <td>อาชีพ</td>
                                 	<td>
                                        <select name="job" id="job">
                                            <?php
                                        
                                        
                                                $db = new database($GLOBALS['config']);
                                        
                                                $res = $db->query("select * from job");
												echo "<option value=\"N/A\" selected=\"selected\">N/A</option>";	
                                        
                                                while($row = mysql_fetch_assoc($res))
                                                    {
                                            
                                                       
                                                            Echo "<option value=\"".$row['j_id']."\">".$row['j_name']."</option>";
                                                    }
                                                                
                                            ?>
                                        </select>
                            <?php					 
                            break;
                            ?>
			 	    </td>      
                            <?php
                                // Case student
                            case's':
                                //html code student
                                ?>
                                    
                                        <td>รหัสชั้นปี <a style="color:#FF0000;">*</a></td>
                                           <td>
                                           
                                                <input type="text" id="grade" name="grade"  />
                                         </td>
                   
                   
                  </tr>
                  <tr>
                    
                           
                                        <td>สาขาวิชา <a style="color:#FF0000;">*</a></td>
                                        <td>
                                        <select name="field" id="field">
                                            <?php
                                
                                
                                                $db = new database($GLOBALS['config']);
                                        
                                                $res = $db->query("select * from field");
                                echo "<option value=\"N/A\" selected=\"selected\">N/A</option>";	
                                        while($row = mysql_fetch_assoc($res))
                                                {
                                    
                                                        
                                                            Echo "<option value=\"".$row['f_id']."\">".$row['f_name']."</option>";
                                                }
                                                        
                                            ?>
                                        </select>
                                        
                                <?php
                            break;
							?>
                                    </td>
                                
                                        <!--grade-->
                               	
                            
                            <?php
                            case'a':
                                //html code advisor
                                ?>
                                   
                                        <td>สาขาวิชา <a style="color:#FF0000;">*</a></td>
                                        <td>
                                        <select name="field" id="field">
                                            <?php
                                
                                
                                                $db = new database($GLOBALS['config']);
                                        
                                                $res = $db->query("select * from field");
                                  echo "<option value=\"N/A\" selected=\"selected\">N/A</option>";	
                                        while($row = mysql_fetch_assoc($res))
                                                {
                                    
                                                        
                                                            Echo "<option value=\"".$row['f_id']."\">".$row['f_name']."</option>";
                                                }
                                                        
                                            ?>
                                        </select>
                                    </td>
                  </tr>
                                <?php
                            break;	

                            case'x':
                                //html code admin
                                ?>
                                
                                <?php
                            break;	
                        }
                    
                    ?>
                  
                </table>
                 <input type="hidden" name="type" value="<?php echo $type; ?>"/>
               <br /><input class="edit" name="edit" type="button" value="แก้ไขข้อมูล" onclick="admin_add_profile_user();" />
                </form></div>

<?php
 //print_r ($_SESSION['user']);
?>

