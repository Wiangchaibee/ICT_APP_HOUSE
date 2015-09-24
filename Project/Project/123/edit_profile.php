<?php
	include_once "class/Class_user.php";
	session_start();
	if(empty($_SESSION['user'])){
		$_SESSION['user'] = new gest('gest','gest');
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/edit_profile.css" />
<script type="text/javascript" src="ajax/ajax.js"></script>
<title>แก้ไขข้อมูลส่วนตัว</title>
</head>

<body>
<div class="app_page" id="app_page"></div>
<div class="con_warper">
<div class="con">

   <div class="logo"><div class="login_bar"> 
  		
       
        
  	
			<?php
            if($_SESSION['user']->id_type == 'gest')
            {
            ?>
                
                            
                           <br /><form action="login.php" method="post" name="form1"  id="form1" class="login_bar">                                     
                                <label for="user">user</label>
                                <input type="text" name="user" id="user" />
                                <label for="pass">pass</label>
                                <input type="text" name="pass" id="pass" />
                                <select name="id_type">
                                  <option value="m">Member</option>
                                  <option value="s">Student</option>
                                  <option value="a">Advisor</option>
                                  <option value="x">Admin</option>
                                </select>
                              <input type="submit" name="button" id="button" value="Submit" />
                            </form>
                       
                          <?
                         	Echo "id_type:".$_SESSION['user']->id_type;
                          ?>
						
           					</div>	
                            
		   <?php
                } 
                    else {		
                    Echo "</pre>";
                 
                    Echo "</pre>";
                    Echo "</br>";
                    Echo "id:".$_SESSION['user']->id;
                    Echo "</br>";
                    Echo "id_type:".$_SESSION['user']->id_type;
                
					
            
            ?>
            
                    
                    <div class="Logout">
                    
                        <form id="form1" name="form1" method="post" action="logout.php">
                            <input type="submit" name="Logout" id="Logout" value="Logout" />
                        </form>
                    </div> <div class="profile" onclick="load_profile();">Profile</div>
                		<div class="pm" onclick="load_pm();"> PM To ADMIN </div></div>
                        
		   <?php
		  		
                if($_SESSION['user']->id_type == 's' && $_SESSION['user']->group_id == 0){	
                //echo "aaa";
           ?> 
                   <div onclick="group();">Create group</div> 	
                
          	           
                            
                <?php
                        }
						 
                        }
                ?>
                      
                    <br /><div class="img"><img src="image/icon4.png" /></div></div> 

 					<div class="menu_left" id="menu_left">
                            <br /><div align="center"><a href="index.php">หน้าแรก</a></div>
                    </div>
 
            
				<?php
							if($_SESSION['user']->id_type == 's'  &&  $_SESSION['user']->group_id != 0 ){	
							//echo "aaa";
                ?> 
                    	<div ><span class="group();">Edit_profile_group</span>   <span class="menu_group2">Edit_profile_app</span></div>
                  
                 <?php
                       	 }
                 ?>   
                
                  <div class="main_content">
                   <div class="pic"><img src="image/icon5.png" /></div>
                  <div class="form_profile" align="center"><form name="form_profile" method="post" id="form_profile">
                        <table width="406" height="405" border="1" class="edit">
                          <tr>
                            <td width="94" height="43" align="center">name</td>
                            <td width="296">
                              <label for="name"></label>
                              <input type="text" name="name" id="name" value= <?php  echo "\"".$_SESSION['user']->name."\"";?> >
                            </td>
                          </tr>
                          <tr>
                            <td height="44" align="center">Tel</td>
                            <td>
                              <label for="tel"></label>
                              <input type="text" name="tel" id="tel" value= <?php echo"\"".$_SESSION['user']->tel."\"";?>>
                            </td>
                          </tr>
                          <tr>
                            <td height="43" align="center">email</td>
                            <td>
                              <label for="email"></label>
                              <input type="text" name="email" id="email" value= <?php echo"\"".$_SESSION['user']->email."\""; ?>>
                            </td>
                          </tr>
                          <tr>
                            <td height="78" align="center">address</td>
                            <td>
                              <label for="address"></label>
                              <textarea name="" cols="20" rows="3" <?php echo"\"".$_SESSION['user']->address."\""; ?>></textarea>
                            </td>
                          </tr>
                          <tr>
                            <td height="71" align="center">sex</td>
                            <td>
                              <label for="sex"></label>
                              <select name="sex" id="sex">
                                
                                
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
                            </td>
                          </tr>
                          
                          
                            <?php
                                        include_once "class/Class_database.php";
                                        include_once "class/server_config.php";
                            
                                switch($_SESSION['user']->id_type){
                                        //Case member
                                    case'm':
                                        //html code member
                                        ?>
                                       <tr>
                                        <td height="26" align="center">job</td>
                                         <td>
                                        <select name="job" id="job">
                                            <?php
                                        
                                        
                                                $db = new database($GLOBALS['config']);
                                        
                                                $res = $db->query("select * from job");
                                        
                                                while($row = mysql_fetch_assoc($res))
                                                    {
                                            
                                                        if($row['j_id'] == $_SESSION['user']->job_id)
                                                            Echo "<option value=\"".$row['j_id']."\"selected=\"selected\">".$row['j_name']."</option>";
                                                        else
                                                            Echo "<option value=\"".$row['j_id']."\">".$row['j_name']."</option>";
                                                    }
                                                                
                                            ?>
                                        </select>
                                        </td>
                                      </tr>
                                        <?php					 
                                    break;
                                    
                                        // Case student
                                    case's':
                                        //html code student
                                        ?>
                                            <tr>
                                                <td height="26" align="center">field</td>
                                                <td>
                                                <select name="field" id="field">
                                                    <?php
                                        
                                        
                                                        $db = new database($GLOBALS['config']);
                                                
                                                        $res = $db->query("select * from field");
                                        
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
                                                <!--grade-->
                                       
                                        <tr>
                                                <td height="26" align="center">grade</td>
                                                <td>
                                                <select name="grade" id="grade">
                                                    <?php
                                        
                                                        
                                                        for($i=0;$i<$GLOBALS['max_garde'];$i++){
                                                                if($i == $_SESSION['user']->grade)
                                                                    Echo "<option value=\"".$i."\"selected=\"selected\">".$i."</option>";
                                                                else
                                                                    Echo "<option value=\"".$i."\">".$i."</option>";
                                                            }
                                        
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <?php
                                    break;	
                                    
                                    
                                    case'a':
                                        //html code advisor
                                        ?>
                                            <tr>
                                                <td height="26" align="center">field</td>
                                                <td>
                                                <select name="field" id="field">
                                                    <?php
                                        
                                        
                                                        $db = new database($GLOBALS['config']);
                                                
                                                        $res = $db->query("select * from field");
                                        
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
                       <br /> 
                       <input name="edit" type="button" value="edit profile" onclick="edit_profile();" />
                        </form></div>
                         
                        <?php
                         //print_r ($_SESSION['user']);
                        ?>
</div>
                    	
            <div class="footer">footer</div>
 </div>
 </div>
      
 
</body>
</html>