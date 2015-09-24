<?php
	include_once "class/Class_user.php";
	session_start();
	
?>


	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<script type="text/javascript" src="javascript/jqueryui/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="javascript/jqueryui/js/jquery-ui-1.8.20.custom.min.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/edit_page.css" />
<script type="text/javascript" src="ajax/edit_ajax.js"></script>
 
<link rel="stylesheet" type="text/css" href="javascript/jquery-ui-1.7.2.custom/css/smoothness/jquery-ui-1.7.2.custom.css">  
</head>
<title>Untitled Document</title>
</head>

<body>
<div class="app_page" id="app_page"></div>
<div class="con_warper">
<div class="con">

   <div class="logo"><div class="login_bar"> 
  		
         
		   <?php
                
                    if($_SESSION['user']->id_type) {		
                    //Echo "</pre>";
                    //Echo "</pre>";
                    //Echo "</br>";
                    Echo "สวัสดีคุณ : ".$_SESSION['user']->id;
                    //Echo "</br>";
                   // Echo "id_type:".$_SESSION['user']->id_type;   
            ?>
            
                    
                    <div class="Logout" align="center">
                    
                        <form id="form1" name="form1" method="post" action="logout.php">
                            <input type="submit" name="Logout" id="Logout" value="Logout" />
                        </form>
                    </div>
                    
                
                  
                  
		  		
           	 
                    
   </div>
                 <?php      
                        
   				 }
                	?>
                        
                         
                       
                
		  
                      
                    <br /><div class="img"><img src="img/icon2.png" /></div></div> 

 					<div class="menu_left" id="menu_left">

                          <br /><br /><br /><div style="margin-left:20px; height:18px; width:150px; background-color:#FF6; border-radius:6px; border:1px solid #660066;"><a href="index.php" style=" font-size:12px; margin-left:50px; text-decoration:none">หน้าแรก</a></div>
                         <br /><br /><br /><div style="margin-left:20px; height:18px; width:150px; background-color:#FF6; border-radius:6px; border:1px solid #660066;"><a href="edit_page.php" style=" font-size:12px; margin-left:50px; text-decoration:none">ข้อมูลโดยรวม</a></div>
                          <br /><div style="margin-left:20px; height:18px; width:150px; background-color:#FF6; border-radius:6px; border:1px solid #660066;"><a href="javascript:load_edit_profile();" style="font-size:12px; color:#663399; margin-left:30px; text-decoration:none;">แก้ไขข้อมูลส่วนตัว</a></div>
                           <br /><div style="margin-left:20px; height:18px; width:150px; background-color:#FF6; border-radius:6px; border:1px solid #660066;"><a href="javascript:get_pass(1);"  style="font-size:12px; color:#663399; margin-left:40px; text-decoration:none;">เปลี่ยนรหัสผ่าน</a></div>
                            
                           <?php if($_SESSION['user']->id_type == 's'  &&  $_SESSION['user']->group_id != 0 ){ ?>
                           <br /><div style="margin-left:20px; height:18px; width:150px; background-color:#FF6; border-radius:6px; border:1px solid #660066;"><a href="javascript:load_edit_group_profile();" style="font-size:12px; color:#663399; margin-left:35px; text-decoration:none;">แก้ไขข้อมูลกลุ่ม</a></div> 
                            <br />  <div style="margin-left:20px; height:18px; width:150px; background-color:#FF6; border-radius:6px; border:1px solid #660066;"><a href="javascript:load_edit_app();"  style="font-size:12px; color:#663399; margin-left:20px; text-decoration:none;">แก้ไขข้อมูลแอปลิเคชั่น</a></div>
							 <?php } ?>
                             <?php if($_SESSION['user']->id_type == 'a'){ ?>
                             
                             <br /><div style="margin-left:20px; height:18px; width:150px; background-color:#FF6; border-radius:6px; border:1px solid #660066;"><a href="javascript:get_edit_advisor_project();"  style="font-size:12px; color:#663399; margin-left:10px; text-decoration:none;">แก้ไขข้อมูลนิสิตในที่ปรึกษา</a></div> 
                             <?php } ?>
                            <?php if($_SESSION['user']->id_type == 'x'){ ?>
                           <!-- <br /><div style="margin-left:20px; height:18px; width:150px; background-color:#FF6; border-radius:6px; border:1px solid #660066;"><a href="javascript:get_edit_pass(2);"  style="font-size:12px; color:#663399; margin-left:20px; text-decoration:none;">เปลี่ยนรหัสผ่านของสมาชิก</a></div> -->
                            <br /><div style="margin-left:20px; height:18px; width:150px; background-color:#FF6; border-radius:6px; border:1px solid #660066;"><a href="javascript:get_edit_admin_user();"  style="font-size:12px; color:#663399; margin-left:20px; text-decoration:none;">แก้ไข ลบ ข้อมูลสมาชิก</a></div> 
                            <br /><div style="margin-left:20px; height:18px; width:150px; background-color:#FF6; border-radius:6px; border:1px solid #660066;"><a href="javascript:get_edit_admin_project();"  style="font-size:12px; color:#663399; margin-left:5px; text-decoration:none">แก้ไข ลบ ข้อมูลแอปพลิเคชั่น</a></div> 
                            
                            
                            
                            <br /><br /><div style="margin-left:20px; height:18px; width:150px; background-color:#FF6; border-radius:6px; border:1px solid #660066;"><a href="javascript:select_student();"  style="font-size:12px; color:#663399; margin-left:35px; text-decoration:none">เพิ่มแอปพลิเคชั่น</a></div> 
                             <br /><div style="margin-left:20px; height:18px; width:150px; background-color:#FF6; border-radius:6px; border:1px solid #660066;"><a href="javascript:get_add_admin_member('s');"  style="font-size:12px; color:#663399; margin-left:38px; text-decoration:none;">เพิ่มสมาชิกนิสิต</a></div>
                              <br /><div style="margin-left:20px; height:18px; width:150px; background-color:#FF6; border-radius:6px; border:1px solid #660066;"><a href="javascript:get_add_admin_member('a');"  style="font-size:12px; color:#663399; margin-left:8px; text-decoration:none;">เพิ่มสมาชิกอาจารย์ที่ปรึกษา</a></div> 
                            <?php } if($_SESSION['user']->id_type == 'x' && $_SESSION['user']->id == $GLOBALS['head_admin']){?>
                            
                            <br /><div style="margin-left:20px; height:18px; width:150px; background-color:#FF6; border-radius:6px; border:1px solid #660066;"><a href="javascript:get_add_admin_member('x');"  style="font-size:12px; color:#663399; margin-left:40px; text-decoration:none;">เพิ่มผู้ดูแลระบบ</a></div>
                            <br /><div style="margin-left:20px; height:18px; width:150px; background-color:#FF6; border-radius:6px; border:1px solid #660066;"><a href="javascript:get_delete_admin_comment();"  style="font-size:12px; color:#663399; margin-left:40px; text-decoration:none;">ลบความคิดเห็น</a></div> 
                            <?php } ?>
                           
                            
                    </div>
                    
                   
                    <div class="main_content" id="main_content">
                    <img src="img/edit_page.png" style="margin-left:280px; margin-top:50px;" />
                    	<?php if($_SESSION['user']->id_type == 'm'){ ?>
                        	<table id="edit_page">	
                            	<tr>
                                	<td style="font-weight:bold;">ชื่อ-สกุล</td>
                                    <td><?php echo $_SESSION['user']->name; ?></td>
                        		</tr>
                                <tr>
                                	<td style="font-weight:bold;">อีเมลล์</td>
                                    <td><?php echo $_SESSION['user']->email; ?></td>
                        		</tr>
                                <tr>
                                	<td style="font-weight:bold;">ที่อยู่</td>
                                    <td><?php echo $_SESSION['user']->address; ?></td>
                        		</tr>
                                <tr>
                                	<td style="font-weight:bold;">เบอร์โทร์</td>
                                    <td><?php echo $_SESSION['user']->tel; ?></td>
                        		</tr>
                                <tr>
                                	<td style="font-weight:bold;">เพศ</td>
                                    <td><?php echo $_SESSION['user']->sex; ?></td>
                        		</tr>
                        	</table>
                        <?php }else if($_SESSION['user']->id_type == 's'){ ?>
                    		<table id="edit_page">	
                            	<tr>
                                	<td style="font-weight:bold;">ชื่อ-สกุล</td>
                                    <td><?php echo $_SESSION['user']->name; ?></td>
                        		</tr>
                                <tr>
                                	<td style="font-weight:bold;">อีเมลล์</td>
                                    <td><?php echo $_SESSION['user']->email; ?></td>
                        		</tr>
                                <tr>
                                	<td style="font-weight:bold;">ที่อยู่</td>
                                    <td><?php echo $_SESSION['user']->address; ?></td>
                        		</tr>
                                <tr>
                                	<td style="font-weight:bold;">เบอร์โทร์</td>
                                    <td><?php echo $_SESSION['user']->tel; ?></td>
                        		</tr>
                                <tr>
                                	<td style="font-weight:bold;">เพศ</td>
                                    <td><?php echo $_SESSION['user']->sex; ?></td>
                        		</tr>
                        	</table>
				
                             
 						<?php }else if($_SESSION['user']->id_type == 'a'){ 
								$db = new database($GLOBALS['config']);
							
							$re = $db->query(
							"SELECT * FROM `project` . `group`
							WHERE `g_grade`  
							ORDER BY g_grade DESC LIMIT 1
							");
							$ro = mysql_fetch_assoc($re);
							$a = $ro['g_grade'];
							
							$re2 = $db->query(
							"SELECT * FROM `project` . `group`
							WHERE `g_grade`  
							ORDER BY g_grade ASC LIMIT 1
							");
							$ro2 = mysql_fetch_assoc($re2);
							$a2 = $ro2['g_grade'];
						?>

                        		<table id="edit_page">	
                            	<tr>
                                	<td style="font-weight:bold;">ชื่อ-สกุล</td>
                                    <td><?php echo $_SESSION['user']->name; ?></td>
                        		</tr>
                                <tr>
                                	<td style="font-weight:bold;">อีเมลล์</td>
                                    <td><?php echo $_SESSION['user']->email; ?></td>
                        		</tr>
                                <tr>
                                	<td style="font-weight:bold;">ที่อยู่</td>
                                    <td><?php echo $_SESSION['user']->address; ?></td>
                        		</tr>
                                <tr>
                                	<td style="font-weight:bold;">เบอร์โทร์</td>
                                    <td><?php echo $_SESSION['user']->tel; ?></td>
                        		</tr>
                                <tr>
                                	<td style="font-weight:bold;">เพศ</td>
                                    <td><?php echo $_SESSION['user']->sex; ?></td>
                        		</tr>
                                <tr>
                                	<td colspan="2" style="font-weight:bold;">จำนวนโปรเจคภายใต้การดูแลของแต่ละปีการศึกษา</td>
                                    
                                </tr>
                                <?php for($i=$a2; $i <= $a ; $i++){
									$re3 = $db->query("select * FROM `project` . `group`
										WHERE `g_grade` = '".$i."'  AND `g_a_id1` = '".$_SESSION['user']->id."'
									 ");
									$ro3 = mysql_num_rows($re3);
									if($ro3 != '0'){ ?>	
                                	 <tr>
                                	<td style="font-weight:bold;">ปี<?php echo $i; ?></td>
                                    <td style="font-weight:bold;"><?php echo $ro3; ?> กลุ่ม</td>
                        		</tr>
                                <?php } } ?>
                        	</table>
                        	
                        
                        <?php }else if($_SESSION['user']->id_type == 'x'){ 
						
							$db = new database($GLOBALS['config']);
							
							$res = $db->query("select * from member ");
							 $row = mysql_num_rows($res);
							   
							$res2 = $db->query("select * from student");
							 $row2 = mysql_num_rows($res2);
							 
							 $res3 = $db->query("select * from advisor");
							 $row3 = mysql_num_rows($res3);
							 
							 $res4 = $db->query("select * from admin");
							 $row4 = mysql_num_rows($res4);
							 
							  $res5 = $db->query("select * from application");
							 $row5 = mysql_num_rows($res5);
							 
							  
							$db->close();
						?> 
                        	<table id="edit_page">	
                            	<tr>
                                	<td style="font-weight:bold;">ชื่อ</td>
                                    <td><?php echo $_SESSION['user']->name; ?></td>
                        		</tr>
                                <tr>
                                	<td style="font-weight:bold;">อีเมลล์</td>
                                    <td><?php echo $_SESSION['user']->email; ?></td>
                        		</tr>
                                <tr>
                                	<td style="font-weight:bold;">ที่อยู่</td>
                                    <td><?php echo $_SESSION['user']->address; ?></td>
                        		</tr>
                                <tr>
                                	<td style="font-weight:bold;">เบอร์โทร์</td>
                                    <td><?php echo $_SESSION['user']->tel; ?></td>
                        		</tr>
                                <tr>
                                	<td style="font-weight:bold;">เพศ</td>
                                    <td><?php echo $_SESSION['user']->sex; ?></td>
                        		</tr>
                                <tr>
                                	<td style="font-weight:bold;">จำนวนสมาชิกบุคคลทั่วไป</td>
                                    <td><?php echo $row; ?> คน</td>
                        		</tr>
                                  <tr>
                                	<td style="font-weight:bold;">จำนวนสมาชิกนิสิต</td>
                                    <td><?php echo $row2; ?> คน</td>
                        		</tr>
                                  <tr>
                                	<td style="font-weight:bold;">จำนวนสมาชิกอาจารย์</td>
                                    <td><?php echo $row3; ?> คน</td>
                        		</tr>
                                  <tr>
                                	<td style="font-weight:bold;">จำนวนสมาชิกผู้ดูแลระบบ</td>
                                    <td><?php echo $row4; ?> คน</td>
                        		</tr>
                                 <tr>
                                	<td style="font-weight:bold;">จำนวนแอปพลิเคชั่น</td>
                                    <td><?php echo $row5; ?> โปรแกรม</td>
                        		</tr>
                               
                        	</table>
                        
                        
                        <?php } ?>
                   </div>
 </div>
</body>
</html>