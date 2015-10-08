<?php
	include_once "class/Class_user.php";
	include_once "class/Class_database.php";
	include_once "class/Server_config.php";
	session_start();
	if(empty($_SESSION['user'])){
		$_SESSION['user'] = new gest('gest','gest');
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/create_g.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="ajax/ajax.js"></script>
<title>สร้างกลุ่ม</title>
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

                    <div class="main_content"><div class="pic"><img src="image/icon6.png" /></div>
                    <form id="form_create_group" name="form_create_group" method="post" enctype="multipart/form-data" >
                              <table width="649" border="1" class="create">
                              <tr>
                                <td><table width="649" border="1" class="create_1">
                                  <tr>
                                    <td width="116">Student_1</td>
                                    <td width="401"> <input type="text" name="student_1" id="student_1"  disabled='true' value= 
                                    "<?php echo $_SESSION['user']->id; ?>" /></td>
                                    
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
                                  
                                  
                                  <tr>
                                    <td>APP NAME TH</td>
                                    <td colspan=2><input type="text" name="app_name_th" id="app_name_th" /></td>
                                  </tr>
                                  
                                     <tr>
                                    <td>APP NAME EN</td>
                                    <td colspan=2><input type="text" name="app_name_en" id="app_name_en" /></td>
                                  </tr>
                                  
                                  
                                  <tr>
                                    <td>APP UPLOAD</td>
                                    <td colspan=2><input type="file" name="app_file" id="app_file" /></td>
                                  </tr>
                                     
                                
                                  <tr>
                                    <td>LOGO UPLOAD</td>
                                    <td colspan=2><input type="file" name="logo_file" id="logo_file" /></td>
                                  </tr>
                                
                              </table>
                                <input name="create_group" class="create_group" type="button" value="create group" onclick="create_g();" />
                            </form></div>

                    
            
				<?php
							if($_SESSION['user']->id_type == 's'  &&  $_SESSION['user']->group_id != 0 ){	
							//echo "aaa";
                ?> 
                    	<div ><span class="group();">Edit_profile_group</span>   <span class="menu_group2">Edit_profile_app</span></div>
                  
                 <?php
                       	 }
                 ?>   
                  
                    	
            
 </div>
 </div>
      
</body>
</html>