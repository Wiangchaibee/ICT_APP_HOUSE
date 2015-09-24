<?php
	include_once "class/Class_user.php";
	session_start();
	
	//echo $_SESSION['user']->job_id;
?><style type="text/css">@import "css/humanity.datepick.css";</style> 
<script type="text/javascript" src="js/jquery.datepick.js"></script>
<script>$(dateInput).datepick({dateFormat: 'dd-mm-yyyy'});</script>
 		  
          <div class="pic"><img src="img/iconprofile.png" /></div>
          <div class="form_profile" align="center">
          <form name="form_profile" method="post" id="form_profile">
          <div style="margin-left:-300px; margin-top:60px; font-size:15px;"><a style="color:#FF0000;">*</a> = กรุณากรอกรายละเอียดให้ครบ</div>
                <table width="406" height="405" border="1" class="edit" style="margin-top:20px;">
                  <tr>
                    <td>ชื่อ - สกุล <a style="color:#FF0000;">*</a></td>
                    <td>
                      <input type="text" name="name" id="name" value= <?php  echo "\"".$_SESSION['user']->name."\"";?> >
                    </td>
                    <td>เพศ</td>
                    <td>
                      <label for="sex"></label>
                      <select name="sex" id="sex">
                        
                        
                        <?php
                            if($_SESSION['user']->sex == NULL)
                            
                                echo "<option value=\"N/A\" selected=\"selected\">N/A</option>";	
                            
                            else
                                echo "<option value=\"N/A\">N/A</option>";
                                
                                
                                
                            if($_SESSION['user']->sex == "male")
                            
                                echo "<option value=\"male\" selected=\"selected\">ชาย</option>";	
                            
                            else
                                echo "<option value=\"male\">ชาย</option>";
                                
                                
                            
                            if($_SESSION['user']->sex == 'female')
                            
                                echo "<option value=\"female\" selected=\"selected\">หญิง</option>";	
                            
                            else
                                echo "<option value=\"female\">หญิง</option>";		
                                
                        ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>วันเกิด</td>
                   <td>
                     <input type="text" name="dateInput" id="dateInput"  />
  
	
                    
                        <td>เบอร์โทรศัพท์</td>
                                <td>
                                  <label for="tel"></label>
                                  <input type="text" name="tel" id="tel" value= <?php echo"\"".$_SESSION['user']->tel."\"";?>>
                                </td>
                       
                    	
                            
                  

                  </tr>
                  <tr>
                  
                 		 <td height="10">ที่อยู่</td>
                         <td>
                          <label for="address"></label>
                         <textarea name="address" cols="15" rows="3" ><?php echo $_SESSION['user']->address ?></textarea>
                    	</td>
                        <td>อีเมล <a style="color:#FF0000;">*</a></td>
                    <td>
                      <label for="email"></label>
                      <input type="text" name="email" id="email" value= <?php echo"\"".$_SESSION['user']->email."\""; ?>>
                    </td>
                    
                  </tr>
					 <tr>
                             
                    <?php
                                include_once "class/Class_database.php";
                                include_once "class/server_config.php";
                    
                        switch($_SESSION['user']->id_type){
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
                                            
                                                        if($row['j_id'] == $_SESSION['user']->job_id)
                                                            Echo "<option value=\"".$row['j_id']."\"selected=\"selected\">".$row['j_name']."</option>";
                                                        else
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
                                                <select name="grade" id="grade">
                                                    <?php
                                        
                                                         echo "<option value=\"N/A\" selected=\"selected\">N/A</option>";	
                                                        for($i=2540;$i<=2570;$i++){
                                                                if($i == $_SESSION['user']->grade)
                                                                    Echo "<option value=\"".$i."\"selected=\"selected\">".$i."</option>";
                                                                else
                                                                    Echo "<option value=\"".$i."\">".$i."</option>";
                                                            }
                                        
                                                    ?>
                                                </select>
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
                                    
                                                        if($row['f_id'] == $_SESSION['user']->field)
                                                            Echo "<option value=\"".$row['f_id']."\"selected=\"selected\">".$row['f_name']."</option>";
                                                        else
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
                                    
                                                        if($row['f_id'] == $_SESSION['user']->field)
                                                            Echo "<option value=\"".$row['f_id']."\"selected=\"selected\">".$row['f_name']."</option>";
                                                        else
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
               <br /><input class="edit" name="edit" type="button" value="แก้ไขข้อมูล" onclick="edit_profile();" />
                </form></div>

<?php
 //print_r ($_SESSION['user']);
?>

