<?php
	include_once "class/Class_user.php";
	session_start();
	
	//echo $_SESSION['user']->job_id;
?>
<link rel="stylesheet" type="text/css" href="css/edit_page.css" />
<script type="text/javascript" src="ajax/edit_ajax.js"></script>
 		  
          <div class="pic"><img src="img/iconprofile.png" /></div>
          <div class="form_profile" align="center">
          <?php  $s=split("/",$x,3); 
		 
		  
		  ?>
          <form name="admin_form_profile" method="post" id="admin_form_profile">
                <table width="406" height="405" border="1" class="edit">
                  <tr>
                    <td>ชื่อ - สกุล</td>
                    <td>
                      <input type="text" name="name" id="name" value= <?php  
						
							$db = new database($GLOBALS['config']);
			
					  		 $res = $db -> query(
							"SELECT * FROM `project` . `".$s[1]."`
							WHERE `".$s[0]."_id` = '".$s[2]."'
							");	
							$row = mysql_fetch_array($res);
							$name=$row["".$s[0]."_name"];
							$db->close();
							
							echo "\"".$name."\"";
							
						?>  >
                    </td>
                    <td>เพศ</td>
                    <td>
                      <label for="sex"></label>
                      <select name="sex" id="sex">
                        <?php  
						
							$db = new database($GLOBALS['config']);
			
					  		 $res = $db -> query(
							"SELECT * FROM `project` . `".$s[1]."`
							WHERE `".$s[0]."_id` = '".$s[2]."'
							");	
							$row = mysql_fetch_array($res);
							$sex=$row["".$s[0]."_sex"];
							$email=$row["".$s[0]."_email"];
							$address=$row["".$s[0]."_address"];
							$birthday=$row["".$s[0]."_birthday"];
							$tel=$row["".$s[0]."_tel"];
							$job=$row["".$s[0]."_j_id"];
							$db->close();
							
							
						?>
                        
                        <?php
                            if($sex == NULL)
                            
                                echo "<option value=\"N/A\" selected=\"selected\">N/A</option>";	
                            
                            else
                                echo "<option value=\"N/A\">N/A</option>";
                                
                                
                                
                            if($sex == "male")
                            
                                echo "<option value=\"male\" selected=\"selected\">Male</option>";	
                            
                            else
                                echo "<option value=\"male\">Male</option>";
                                
                                
                            
                            if($sex == 'female')
                            
                                echo "<option value=\"female\" selected=\"selected\">Female</option>";	
                            
                            else
                                echo "<option value=\"female\">Female</option>";		
                                
                        ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>วันเกิด</td>
                   <td>
                 
                     <input type="text" name="dateInput" id="dateInput"  value= <?php  echo "\"".$birthday."\"";?> />
  
						<script type="text/javascript" src="javascriptjs/jquery-ui-1.7.2.custom/jquery-1.3.2.min.js"></script>  
                        <script type="text/javascript" src="javascriptjs/jquery-ui-1.7.2.custom/jquery-ui-1.7.2.custom.min.js"></script>  
                        <script type="text/javascript/jquery-ui-1.7.2.custom">  
                        $(function(){  
                            var dateBefore=null;  
                            $("#dateInput").datepicker({  
                                dateFormat: 'dd-mm-yy',  
                                showOn: 'button',  
                                buttonImage: 'javascript/jquery-ui-1.7.2.custom/css/smoothness/images/calender.jpg',  
                                buttonImageOnly: true,  
                                dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],   
                                monthNamesShort: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],  
                                changeMonth: true,  
                                changeYear: true ,  
                                beforeShow:function(){  
                                    if($(this).val()!=""){  
                                        var arrayDate=$(this).val().split("-");       
                                        arrayDate[2]=parseInt(arrayDate[2])-543;  
                                        $(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
                                    }  
                                    setTimeout(function(){  
                                        $.each($(".ui-datepicker-year option"),function(j,k){  
                                            var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
                                            $(".ui-datepicker-year option").eq(j).text(textYear);  
                                        });               
                                    },50);  
                          
                                },  
                                onChangeMonthYear: function(){  
                                    setTimeout(function(){  
                                        $.each($(".ui-datepicker-year option"),function(j,k){  
                                            var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
                                            $(".ui-datepicker-year option").eq(j).text(textYear);  
                                        });               
                                    },50);        
                                },  
                                onClose:function(){  
                                    if($(this).val()!="" && $(this).val()==dateBefore){           
                                        var arrayDate=dateBefore.split("-");  
                                        arrayDate[2]=parseInt(arrayDate[2])+543;  
                                        $(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);      
                                    }         
                                },  
                                onSelect: function(dateText, inst){   
                                    dateBefore=$(this).val();  
                                    var arrayDate=dateText.split("-");  
                                    arrayDate[2]=parseInt(arrayDate[2])+543;  
                                    $(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
                                }  
                          
                            });  
                              
                        });  
                        </script>  
                        <td>เบอร์โทรศัพท์</td>
                                <td>
                            
                                  <label for="tel"></label>
                                  <input type="text" name="tel" id="tel" value= <?php echo"\"".$tel."\"";?>>
                                </td>
                       
                    	
                            
                  

                  </tr>
                  <tr>
                  
                 		 <td height="10">ที่อยู่</td>
                         <td>
                          <label for="address"></label>
                         <textarea name="address" cols="15" rows="3" ><?php echo"".$address.""; ?></textarea>
                    	</td>
                        <td>อีเมล</td>
                    <td>
                      <label for="email"></label>
                      <input type="text" name="email" id="email" value= <?php echo"\"".$email."\""; ?>>
                    </td>
                    
                  </tr>
					 <tr>
                             
                    <?php
                                include_once "class/Class_database.php";
                                include_once "class/server_config.php";
                    
                        switch($s[0]){
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
                                            
                                                        if($row['j_id'] == $job)
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
                                    
                                        <td>รหัสชั้นปี</td>
                                           <td>
                                               
                                                    <?php
                                        
										$db = new database($GLOBALS['config']);
			
														 $res = $db -> query(
														"SELECT * FROM `project` . `".$s[1]."`
														WHERE `".$s[0]."_id` = '".$s[2]."'
														");	
														$row = mysql_fetch_array($res);
														$grade=$row["".$s[0]."_grade"];
														$db->close();
													
														
                                                   
                                        
                                                    ?>
                                                    <input type="text" name="grade" id="grade" value="<? echo $grade ?>"  />
                                                
                                         </td>
                   
                   
                  </tr>
                  <tr>
                    
                           
                                        <td>สาขาวิชา</td>
                                        <td>
                                        <select name="field" id="field">
                                            <?php
                                				 $db = new database($GLOBALS['config']);
                               							 $res = $db -> query(
														"SELECT * FROM `project` . `".$s[1]."`
														WHERE `".$s[0]."_id` = '".$s[2]."'
														");	
														$row = mysql_fetch_array($res);
														$field=$row["".$s[0]."_f_id"];
														
                                               
                                        
                                                $res = $db->query("select * from field");
                                				echo "<option value=\"N/A\" selected=\"selected\">N/A</option>";
                                        while($row = mysql_fetch_assoc($res))
                                                {
                                    
                                                        if($row['f_id'] == $field)
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
                                   
                                        <td>สาขาวิชา</td>
                                        <td>
                                        <select name="field" id="field">
                                            <?php
                                
                                
                                               $db = new database($GLOBALS['config']);
                               							 $res = $db -> query(
														"SELECT * FROM `project` . `".$s[1]."`
														WHERE `".$s[0]."_id` = '".$s[2]."'
														");	
														$row = mysql_fetch_array($res);
														$field=$row["".$s[0]."_f_id"];
                                        
                                                $res = $db->query("select * from field");
                                				echo "<option value=\"N/A\" selected=\"selected\">N/A</option>";
                                        while($row = mysql_fetch_assoc($res))
                                                {
                                    
                                                        if($row['f_id'] == $field)
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
                <input type="hidden" name="num" value="<?php echo $x; ?>"/>
               <br /><input class="edit" name="edit" type="button" value="แก้ไขข้อมูล" onclick="admin_edit_profile_user();" />
                </form></div>

<?php
 //print_r ($_SESSION['user']);
?>

