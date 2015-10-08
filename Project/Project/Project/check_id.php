<?php 
	include_once "class/Class_database.php";
	include_once "class/Server_config.php";

		$id = $_POST['id'];
		
		//echo $id;
		//$db = new database($GLOBALS['config']);
		
		
		
		
		
		
		
		
		
		
		if($id != ''){
			
			
			
				/*if($id.length < 5){
					?><span style = "color.#cc0000">ควรมีอย่างน้อย 4 ตัวอักษร!!!</span>	 <?php
				}else if($id.length > 5){
					?> <span style = "color.#cc0000">ไม่ควรเกิน 9 ตัวอักษร!!!</span>	<?php
				}else{*/
					
						 	$db = new database($GLOBALS['config']);
				
							$result = $db->query("select * from `project` . `member` where m_id = "."'".$id."'");
				
							$row = mysql_num_rows($result);
							
							if($row == 1)
								echo('<span style="color:#cc0000">User ซ้ำ กรุณากรอกใหม่</span>');
		
							else if($row == ''){
										$db = new database($GLOBALS['config']);
							
										$result = $db->query("select * from `project` . `student` where s_id = "."'".$id."'");
							
										$row = mysql_num_rows($result);
										
										if($row == 1)
										echo('<span style="color:#cc0000">User ซ้ำ กรุณากรอกใหม่</span>');
					
										else if($row == ''){
												
													$db = new database($GLOBALS['config']);
							
													$result = $db->query("select * from `project` . `advisor` where a_id = "."'".$id."'");
										
													$row = mysql_num_rows($result);
													
													if($row == 1)
													echo('<span style="color:#cc0000">User ซ้ำ กรุณากรอกใหม่</span>');
								
													else if($row == ''){
														
																		$db = new database($GLOBALS['config']);
									
																		$result = $db->query("select * from `project` . `admin` where x_id = "."'".$id."'");
															
																		$row = mysql_num_rows($result);
																		
																		if($row == 1)
																		echo('<span style="color:#cc0000">User ซ้ำ กรุณากรอกใหม่</span>');
													
																		else if($row == '')
																		echo('<span style="color:#cc0000">User นี้ สมารถใช้งานได้</span>');
																		
																		else if($row > 1)
																		echo('<span style="color:#cc0000">NOT FOUND!!!</span>');
																				
													}
													
													else if($row > 1)
													echo('<span style="color:#cc0000">NOT FOUND!!!</span>');
															
										}
										else if($row > 1)
										echo('<span style="color:#cc0000">NOT FOUND!!!</span>');
							
							}
								
								
							else if($row > 1)
							echo('<span style="color:#cc0000">NOT FOUND!!!</span>');	
				//}
				

				
				
		}
		
						
			
?>