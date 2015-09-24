<?php
	include "class/Class_database.php";
	include "class/Server_config.php";
					
					
	//print_r ($_POST);				
					
							$db = new database($GLOBALS['config']);
					
							$res = $db->query("select * from student where s_id ="."'".$_POST['id']."'");
							
						
						//alert ($_POST);
						
					if($res == NULL){
						Echo "NOT FOUND";	
					}
					else{
								
					if($row = mysql_fetch_assoc($res))
						if($row['s_g_id'] != '0'){
							echo "ชื่อ : ".$row['s_name']."    "."กลุ่ม : ".'มีกลุ่ม';
						}
						else{
							echo "ชื่อ : ".$row['s_name']."    "."กลุ่ม : ".'ไม่มีกลุ่ม';	
						}
					else
						echo "invalid";
						
					}
						
							
				
					
				
?>