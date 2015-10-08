<?php
	
	include_once "Class_database.php";
	include_once "Server_config.php";
	include_once "Class_app_list.php";
	include_once "Class_app.php";
	
		
	class user 
	{
		protected $id;
		protected $pass;
		protected $name;
		protected $tel;
		protected $email;
		protected $address;
		protected $sex;
		protected $id_type;
		protected $birthday;
		
		public function __get($name){
			return $this->$name;
			
		}
		
		
		
	
		//public function boy()
		//{
			//Echo "boyboyboyboyboyboyboyboyboyboyboy";
			
		//}
		
		
		//user action
		
		
public function edit_pass($post){
	$pass_old= $post['pass_old'];
	$pass_new1 = $post['pass_new1'];
	$pass_new2 = $post['pass_new2'];
		$db = new database($GLOBALS['config']);
		$error = "";
		
		if(strcmp($pass_old,$_SESSION['user']->pass) != 0){
				$error = $error."รหัสผ่านเดิมผิดพลาด";
			}
		
		//Send error  password old
		if($error!=''){
			echo $error;
			die();
		}
		
		
		if($pass_new1 == '' || $pass_new2 == ''){
			$error = $error."กรุณากรอกรหัสผ่าน";
		}
		
		
		//Send error if some of password
		if($error!=''){
			echo $error;
			die();
		}
		
		
		if(strcmp($pass_new1,$pass_new2) != 0){
			$error = $error."รหัสผ่านใหม่ไม่ตรงกัน กรุณาแก้ไข";
			
		}else{
			switch($_SESSION['user']->id_type){
				case 'm':
					$db -> query(
						"UPDATE `member` SET
						`m_pass` = '".$pass_new1."'
						WHERE `m_id` = '".$_SESSION['user']->id."';"
					);
				
				break;
				case 's':
					$db -> query(
						"UPDATE `student` SET
						`s_pass` = '".$pass_new1."'
						WHERE `s_id` = '".$_SESSION['user']->id."';"
					);
				
				break;
				case 'a':
					$db -> query(
						"UPDATE `advisor` SET
						`a_pass` = '".$pass_new1."'
						WHERE `a_id` = '".$_SESSION['user']->id."';"
					);
				
				break;
				case 'x':
					$db -> query(
						"UPDATE `admin` SET
						`x_pass` = '".$pass_new1."'
						WHERE `x_id` = '".$_SESSION['user']->id."';"
					);
				
				break;
			
			}
		echo "แก้ไขเสร็จเรียบร้อย";	 
			
		}
		//Send error if some of password
		if($error!=''){
			echo $error;
			die();
		}
	$db->close();								
}


public function app_download_file($num){
		$db = new database($GLOBALS['config']);
		
		 $db -> query(
			"UPDATE `application` SET
			`app_file_load` = `app_file_load` +1
			WHERE `app_id` = '".$num."';"
		);
		$db->close();
}		
public function app_download_doc($num){
		$db = new database($GLOBALS['config']);
		
		 $db -> query(
			"UPDATE `application` SET
			`app_doc_load` = `app_doc_load` +1
			WHERE `app_id` = '".$num."';"
		);
		$db->close();
}			
		
public function comment($a , $b , $c )
		{
				$db = new database($GLOBALS['config']);
					
					$db->query(
						"INSERT INTO `project`.`comment`(
					`com_id`			,
					`com_text`			,
					`com_u_id`			,
					`com_app_id`		,
					`com_time`			,
					`com_ip`			
					)
				VALUES(	
						'' , '".$a."' , '".$this->id."', '".$b."' , CURRENT_TIMESTAMP ,'".$c."'
			);"	);
			
				////  + comment view
			
					$db -> query(
						"UPDATE `application` SET
						`app_comment` = `app_comment` +1
						WHERE `app_id` = '".$b."';"
					);
			$db->close();
		}
		
public function vote($score)
		{
				$db = new database($GLOBALS['config']);
				$db->query(
					"INSERT INTO `project`.`vote`(
					`v_id`			,
					`v_u_id`		,
					`v_app_id`		,
					`v_score`		
					)
					VALUES(	
							'', '".$_SESSION['user']->id."', '".$_SESSION['viewing_app_id']."', '".$score."'
					);");
				$db->close();	
				
		}		
	
public function pm($post){
		if($post['topic'] == ''){
				echo "กรุณาใส่หัวข้อของข้อความ";
				die();
			}
			if($post['text'] == ''){
				echo "กรุณาใส่เนื้อหาของข้อความ";
				die();
			}
		if($_SESSION['user']->id_type != 'x'){
			$topic = $post['topic'];
			$text = $post['text'];
				$db = new database($GLOBALS['config']);
					
					$db->query(
						"INSERT INTO `project`.`pm`(
					`pm_id`			,
					`pm_topic`			,
					`pm_send_u_id`			,
					`pm_re_u_id`		,
					`pm_text`			
								
					)
				VALUES(	
						'' , '".$topic."' , '".$_SESSION['user']->id."','admin', '".$text."'
			);"	);
		}
		if($_SESSION['user']->id_type == 'x'){
			$db = new database($GLOBALS['config']);
			$re = $post['re'];
			if($post['re'] == ''){
				echo "กรุณาใส่บัญชีผู้ใช้ที่ส่งถึง";
				die();
			}else{
				$data = substr($re,0,2);
					if($data == 's_' || $data == 'a_' || $data == 'x_'){
						switch($data[0]){
							case 's':
									$check=$db->query("select * from student where s_id = '".$re."' ");
													$row = mysql_fetch_array($check);
													//$s_id = $row['s_id'];
													//print_r ($row['s_id']);
													//echo 'aaa';
													//die();
												if($row['s_id'] == '')	{
													echo "ชื่อบัญชีผู้ใช้นี้ไม่มีอยู่ในระบบ";
													die();	
												}
							break;
							case 'a':
									$check=$db->query("select * from advisor where a_id = '".$re."' ");
													$row = mysql_fetch_array($check);
													//$s_id = $row['s_id'];
													//print_r ($row['s_id']);
													
												if($row['a_id'] == '')	{
													echo "ชื่อบัญชีผู้ใช้นี้ไม่มีอยู่ในระบบ";
													die();	
												}
							break;
							case 'x':
									$check=$db->query("select * from admin where x_id = '".$re."' ");
													$row = mysql_fetch_array($check);
													//$s_id = $row['s_id'];
													//print_r ($row['s_id']);
													
												if($row['x_id'] == '')	{
													echo "ชื่อบัญชีผู้ใช้นี้ไม่มีอยู่ในระบบ";
													die();	
												}
							break;
						}
				}else{
						 echo "ชื่อบัญชีผู้ใช้นี้ไม่มีอยู่ในระบบ";
						 die();
					}
								
			}
			$topic = $post['topic'];
			$text = $post['text'];
			
				$db = new database($GLOBALS['config']);
					
					$db->query(
						"INSERT INTO `project`.`pm`(
					`pm_id`			,
					`pm_topic`			,
					`pm_send_u_id`			,
					`pm_re_u_id`		,
					`pm_text`			
							
					)
				VALUES(	
						'' , '".$topic."' ,'admin', '".$re."' , '".$text."'  
			);"	);
		}	
		
		echo "ทำการส่งข้อความเรียบร้อย";
		$db->close();
	}	
		
public function search($a)
		{
				$text = explode(" ",$a['search_text']);
				
				//print_r($text);
				
				$query = "SELECT * from `application` WHERE 1=1";
		
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`app_name` LIKE 	'%".$i."%' OR ".
										"`app_tag` 	   LIKE 	'%".$i."%' OR ".
										"`app_detail`  LIKE 	'%".$i."%'    ".
										")";
									}
								}
							
						
						 
				/*	switch($a['search_type']){	 
						 
						 case 'by_name':
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`app_name_th` LIKE 	'%".$i."%' OR ".
										"`app_name_en` LIKE 	'%".$i."%'    ".
										")";
									}
								}
							
						 break;		
						 
						 
						 
						 case 'by_tag':
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`app_tag` LIKE 	'%".$i."%' OR ".
										")";							
									}
								}
							
						 break;	
						 
						 
						 
						 case 'by_detail':
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`app_detail`  LIKE 	'%".$i."%'   ".
										")";								
									}
								}
							
						 break;			
			}*/
			
					$db = new database ($GLOBALS['config']);
		
					$res = $db->query($query);
					
					// $_SESSION['search'] = new app_list($res);
					
					//print_r ($_SESSION['search']);
					
				
		
					
		}		
		
		
	}
	
		///////////////////GEST///////////////////
	
		class guest extends user{
			
			public function __construct($g_id , $g_id_type) 
				{
				
					$this->id   = $g_id;
					$this->id_type   = $g_id_type;	
				}
			
				public function register($post){
					$db = new database ($GLOBALS['config']);
				 $id=$post['id_register']; 
				 $pass = $post['pass'] ;
				 $confirm_pass =$post['confirm_pass'];
				 $name =$post['name_sur']  ;
			     $tel=$post['tel'] ; 
			     $email =$post['email'] ;
			     $address =$post['address']; 
				 $sex = $post['sex'] ;
				 $job =$post['job'] ;
				 $date =$post['dateInput'];
				 $error ='';
				 
				 //check id
			  if($id == ''){
				  	$error = $error."กรุณากรอกบัญชีชื่อผู้ใช้";
				}else if($id != ''){
						
							 $res = $db -> query(
							"SELECT * FROM `project` . `member`
							WHERE `m_id` = '".$id."' 
							");	  
							$row = mysql_fetch_array($res);
							$m_id=$row["m_id"];
						if(strcmp($id,$m_id) == 0){
							$error = $error."บัญชีชื่อผู้ใช้นี้ไม่สามารถใช้ได้";
						}
				}
				//Send error 
					if($error!=''){
						echo $error;
						die();
					}
					
					
				////check pass
				 if($pass == '' || $confirm_pass == ''){
					 $error = $error."กรุณาใส่รหัสผ่าน";	 
				}else if($pass != '' || $confirm_pass != ''){
						if(strcmp($pass,$confirm_pass) != 0){
							$error = $error."กรุณากรอกรหัสผ่านให้เหมือนกัน";
						}
				}
				//Send error 
					if($error!=''){
						echo $error;
						die();
					}
					
					
				//chack name
					if($name == ''){
						$error = $error."กรุณากรอกชื่อ";
					}
					//Send error 
					if($error!=''){
						echo $error;
						die();
					}
				
				//chack email
					if($email != ''){
						 if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){ 
						 	$error = $error."กรุณาตรวจสอบรูปแบบอีเมลล์";
						 }
					}
					//Send error 
					if($error!=''){
						echo $error;
						die();
					}
				
					//print_r ($post);
					$db = new database($GLOBALS['config']);
					
					$db->query(
						"INSERT INTO `project`.`member`(
					`m_id`			 ,
					`m_pass`		 ,
					`m_name`		 ,
					`m_tel`			 ,
					`m_email`		 ,			
					`m_address` 	 ,	
					`m_sex`			 ,		
					`m_j_id` 		 ,		
					`m_birthday` 				
					)
				VALUES(	
						'".$id."' , '".$pass."' ,'".$name."', '".$tel."' , '".$email."','".$address."','".$sex."','".$job."','".$date."'  
			);"	);
						$db->close();
						echo "สมัครสมาชิกเรียบร้อย";
			
			}
		}
		
		/////////////////////////////////////////////
		
		//class member
	class member extends user
		{
			protected $job_id;
			
			public function __construct($id)
			{
				$db = new database($GLOBALS['config']);
				
				$result = $db->query("select * from member where m_id = "."'".$id."'");
				
				$row = mysql_fetch_assoc($result);
			
				$this->id			= $row['m_id'];
				$this->pass			=$row['m_pass'];
				$this->id_type		= 'm';
				$this->name			= $row['m_name'];
				$this->tel			= $row['m_tel'];
				$this->email		= $row['m_email'];
				$this->address		= $row['m_address'];
				$this->sex			= $row['m_sex'];
				$this->birthday		= $row['m_birthday'];
				
				$this->job_id		= $row['m_j_id'];
				
				$db->close();
			}
			
			public function edit_profile($post){
				
					$db = new database($GLOBALS['config']);
				
				$result = $db->query(
					"UPDATE  `member`SET  
					`m_name` 	=  '".$post['name']."',
					`m_tel` 	=  '".$post['tel']."',
					`m_email`	=  '".$post['email']."',
					`m_address` =  '".$post['address']."',
					`m_birthday` 	=  '".$post['dateInput']."',
					`m_sex` 	=  '".$post['sex']."',
					`m_j_id` 	=  '".$post['job']."'
					
					WHERE CONVERT(  `member`.`m_id` USING utf8 ) =  '".$_SESSION['user']->id."' LIMIT 1 ;"
				);
				$db->close();
				echo "แก้ไขสำเร็จ";
			}
							
		
	}
		
		
		
		//class student
	class student extends user
		{
			protected $grade;
			protected $field;
			protected $group;
			protected $position;
			
			public function __construct($id)
			{
				$db = new database($GLOBALS['config']);
				
				$result = $db->query("select * from student where s_id = "."'".$id."'");
				
				$row = mysql_fetch_assoc($result);
			
				$this->id			= $row['s_id'];
				$this->pass			= $row['s_pass'];
				$this->id_type		= 's';
				$this->name			= $row['s_name'];
				$this->tel			= $row['s_tel'];
				$this->email		= $row['s_email'];
				$this->address		= $row['s_address'];
				$this->sex			= $row['s_sex'];
				$this->birthday		= $row['s_birthday'];
				
				
				$this->grade		= $row['s_grade'];
				$this->group_id		= $row['s_g_id'];
				$this->field		= $row['s_f_id'];
				$this->position		= $row['s_position'];
				
				$db->close();
				
			}
			
public function edit_profile($post){
				//print_r($_POST);
					$db = new database($GLOBALS['config']);
				//print_r ($post);
				
				/*
				echo "UPDATE  `student`SET  
					`s_name` 	=  '".$post['name'].	"',
					`s_tel` 	=  '".$post['tel'].		"',
					`s_email`	=  '".$post['email'].	"',
					`s_address` =  '".$post['address'].	"',
					`s_sex` 	=  '".$post['sex'].		"',
					`s_grade` 	=  ".$post['grade'].	", 
					`s_f_id` 	=  ".$post['field'].	"
					WHERE CONVERT(  `student`.`s_id` USING utf8 ) =  '".$_SESSION['user']->id."' LIMIT 1 ;";
				*/
				
				$result = $db->query(
					"UPDATE  `student`SET  
					`s_name` 	=  '".$post['name'].	"',
					`s_tel` 	=  '".$post['tel'].		"',
					`s_email`	=  '".$post['email'].	"',
					`s_address` =  '".$post['address'].	"',
					`s_sex` 	=  '".$post['sex'].		"',
					`s_birthday` 	=  '".$post['dateInput']."',
					`s_grade` 	=  '".$post['grade'].	"', 
					`s_f_id` 	=  '".$post['field'].	"'
					
					WHERE CONVERT(  `student`.`s_id` USING utf8 ) =  '".$_SESSION['user']->id."' LIMIT 1 ;"
				);
				echo "แก้ไขสำเร็จ";
}			
			
public function group($post , $files){
				$num = $post['num'];
				$student_ = '';
				$i = '1';
				while($i <= $num){
					$student_[$i] = $post['student_'.$i.''];
					$i++;
					}
				$advisor_1 = $post['advisor_1'];
				$advisor_2 = $post['advisor_2'];
				$app_name = $post['app_name'];
				$app_file = $files['app_file'];
				$app_doc = $files['app_doc'];
				$logo_file = $files['logo_file'];
				$scr_file_1 = $files['scr_file_1'];
				$scr_file_2 = $files['scr_file_2'];
				$scr_file_3 = $files['scr_file_3'];
				$clip = $post['clip_show'];
				$detail = $post['de'];
				$type = $post['app_type'];
				$app_tag = $post['app_tag'];
				$group_grade = $post['group_grade'];
				$system = $_POST['system']; 
				$version =$post['version'];
				$time = $post["dateInput"];
				
		
									$db = new database($GLOBALS['config']);
									$error = "";
									
									/******Start Input Data Validation********/
								// student Same 
									for($i=1 ; $i <= $num ; $i++){
											for($o=1 ; $o<=$num ; $o++){
												if($i == $o){
														
												}else{
													if($student_[$i] == $student_[$o])
													 $error = $error.'นิสิตช่องที่ '.$i.  'ซ้ำกับนิสิตช่องที่'.$o." \n";
													 break;
												}
												 break;	
											}
										
									}
									
								 //Send error if some of student
										if($error!=''){
											
											echo $error;
											die();
										}
								
								for($i=1 ; $i <= $num ; $i++){
										//echo $student_[$i];
										if($student_[$i] == ''){
											$error = $error. "กรุณากรอกชื่อผู้บัญชีผู้ใช้งานให้ครบตามช่อง";
										
										}
										//IS Student Read?
										if($student_[$i] != ''){
												$check_stu = $db->query("select * from student where s_id = "."'".$student_[$i]."'");
												$row = mysql_num_rows($check_stu);
												
												if($row != 1){
													$error = $error.'นิสิตช่องที่ '.$i."  ไม่มีอยู่ในฐานข้อมูล \n";
												}
												
										}

												//Send error if some of student
										if($error!=''){
											
											echo $error;
											die();
										}
										
										// IS STUDENT GROUP
										if($student_[$i] != ''){
											$check_stu = $db->query("select * from student where s_id = "."'".$student_[$i]."'");
											$row = mysql_fetch_assoc($check_stu);
											
											if($row['s_g_id']!=0){
												$error = $error.'นิสิตช่องที่ '.$i." มีกลุ่มแล้ว  \n";
											}
										}
										
										//Send error if some student grouped
										if($error!=''){
												echo $error."นิสิตที่ท่านเลือกมีปัญหา โปรดติดต่อสอบถามผู้ดูแลระบบ";	
												die();		
										}
								}
								
									// Name app
									
									if($app_name == ''){
									
											echo "กรุณา กรอก ชื่อแอปพลิเคชั่น";
											die();	
									}
									//check src
								
									if($scr_file_1["error"] != 0 && $scr_file_2["error"] != 0 && $scr_file_3["error"] != 0){
										echo "กรุณาใส่ screen shot อย่างน้อย 1 ช่อง"."\n";
										die();
				
									}
									
									//type_app
									
									if($app_tag == '0'){
										echo "กรุณาเลือกประเภทของ แอปพลิเคชั่นด้วย";
										die();
									}
									
									
									//app detail
									
									if($detail == ''){
										echo "กรุณากรอกข้อมูลเบื้องต้นที่เกี่ยวกับแอปพลิเคชั่นด้วย";
										die();
									}
									
									//group_grade
														
								if($group_grade == '0'){
										echo "กรุณาเลือกรหัสชั้นปีของกลุ่มนิสิต";
										die();
									}
								
								// end group_grade
								
								//group_type
														
								if($type == '0'){
										echo "กรุณาเลือกสาขาของกลุ่มนิสิต";
										die();
									}
								
								// end group_type
								
									//advisor
									if($advisor_1 == ''){
										echo "กรุณาเลือกอาจารย์ที่ปรึกษา";
										die();
										}	
								
								
								//////Up load app
								////// clip
									if($clip == ''){
										echo "กรุณากรอกข้อมูลคลิป";
										die();	
									}
								if($clip != ''){	
										 $str = split("/",$clip);
										 $youtube=$str[3];
										 //$clip_path="<iframe width='360' height='230' src='http://www.youtube.com/embed/".$youtube."'></iframe>";	
										//echo "<iframe width='360' height='230' src='http://www.youtube.com/embed/".$youtube."'></iframe>";							 
									}
								///////end clip
								////////time
								if($time == ''){
										echo "กรุณากรอกวันที่";
										die();
									
									}
								/////////end time
								
								if ($app_file["size"] > $GLOBALS['max_file_size'])
									 $error = $error."ขนาดของไฟล์แอปพลิเคชั่นใหญ่เกินไป \n";
									
								if(!in_array($app_file["type"],$GLOBALS['allow_file_type_app']))
									$error = $error."ชนิดของไฟล์แอปพลิเคชั่นไม่ถูกต้อง \n";
									
								if($app_file["error"] != 0 )
									$error = $error."กรุณาใส่ไฟล์แอปพลิเคชั่น"." \n";
									
									
								//////Up load document
								
								
								if ($app_doc["size"] > $GLOBALS['max_file_size'])
									 $error = $error."ขนาดของไฟล์เอกสารใหญ่เกินไป \n";
									
								if(!in_array($app_doc["type"],$GLOBALS['allow_file_type_app']))
									$error = $error."ชนิดของไฟล์เอกสารไม่ถูกต้อง \n";
									
								if($app_doc["error"] != 0 )
									$error = $error."กรุณาใส่ไฟล์เอกสาร"." \n";	
									
									
									////////Upload logo
								
								if ($logo_file["size"] > $GLOBALS['max_file_logo_size'])
									 $error = $error."ขนาดของรูปภาพสัญลักษณ์ใหญ่เกินไป \n";
									
								if(!in_array($logo_file["type"],$GLOBALS['allow_file_type_pic']))
									$error = $error."ชนิดของูปภาพสัญลักษณ์ไม่ถูกต้อง\n";
									
								if($logo_file["error"] != 0 )
									$error = $error."กรุณาใสู่ปภาพสัญลักษณ์"." \n";
								
										//Upload scr 1
								
								if ($scr_file_1["size"] > $GLOBALS['max_file_logo_size'])
									 $error = $error."ขนาดของรูปภาพประกอบ 1 ใหญ่เกินไป \n";
									
								if(!in_array($scr_file_1["type"],$GLOBALS['allow_file_type_pic']))
									$error = $error."ชนิดของูรูปภาพประกอบ 1 ไม่ถูกต้อง \n";
									
							
									
										//Upload scr 2
								
								if ($scr_file_2["size"] > $GLOBALS['max_file_logo_size'])
									 $error = $error."ขนาดของูรูููปภาพประกอบ 2 ใหญ่เกินไป \n";
									
								if(!in_array($scr_file_2["type"],$GLOBALS['allow_file_type_pic']))
									$error = $error."ชนิดของรูููปภาพประกอบ 2 ไม่ถูกต้อง \n";
									
								
									
									
										//Upload scr 3
								
								if ($scr_file_3["size"] > $GLOBALS['max_file_logo_size'])
									 $error = $error."ขนาดของรูููปภาพประกอบ 3 ใหญ่เกินไป \n";
									
								if(!in_array($scr_file_3["type"],$GLOBALS['allow_file_type_pic']))
									$error = $error."ชนิดของรูููปภาพประกอบ 3 ไม่ถูกต้อง \n";
									
									//Send error if file not valid
									if($error!=''){
										
										echo $error;
										die();
									}
								
										
										//*********************8END INPUT VAKIDATION************************//
										
										

										
										//*******************************************Insert app to db************************************************//	
										
										//$_SESSION['user']->grp($_POST['app_id'] , $_POST['app_name_th'] , $_POST['app_name_en']);
										
										$db->query(
										 
										"INSERT INTO  `project`.`application` (
											`app_id` ,
											`app_name` ,
											`app_tag` ,
											`app_field` ,
											`app_system` ,
											`app_clip` ,
											`app_detail` ,
											`app_time`
											)
											VALUES (
											NULL ,'".$app_name."' , '".$app_tag."' , '".$type."' , '".$system."' , '".$youtube."' , '".$detail."' , '".$time."'
											);");
											
											
											
											
										
										
											//****Collect Last insert id**//
													
												$last_app_id = mysql_insert_id();
												
												//echo $last_app_id;
												//insert version
											$db->query("
												UPDATE  `project`.`application` SET  
												`app_version` = ".$version."
												 WHERE  `application`.`app_id` ='".$last_app_id."' LIMIT 1 ;");
										
											
											
											// ***********Insert group to db**************//
										
										//$_SESSION['user']->grp(NULL  , $last_app_id , $_POST['student_1'] , $_POST['student_2'] , $_POST['student_3'] 
															//	, $_POST['advisor_1'] , $_POST['advisor_2']);	
											
											
											$db->query("
												INSERT INTO  `project`.`group` (
															`g_id` ,
															`g_app_id` ,
															`g_grade` ,
															`g_a_id1` ,
															`g_a_id2` 
															
														)
														VALUES (
																	NULL ,  
																  ".$last_app_id.			" , 
																  '".$group_grade.  "' ,
																  '".$advisor_1.	"' , 
																  '".$advisor_2.	"' 
																  
												);");
									
											
											
											//****Collect Last insert id**//			
											$last_g_id =  mysql_insert_id();
											
											
											
											///---------------------------------------/UP  APP-------------------------------------------
											//$_POST['g_id']
											if(!file_exists("application/app/".$last_g_id."") )
											{
												 //echo "Folder not exist! Create new folder";
												mkdir("application/app/".$last_g_id."");
											}
											
											
											
											
										
											if (file_exists("application/app/".$last_g_id."/" . $app_file["name"]))
											{
												//echo $app_file["name"] . " already exists. ";
											}
											else
											{
												move_uploaded_file(
													$app_file["tmp_name"],
													"application/app/".$last_g_id."/" . $app_file["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											}
											
											
											
												//collet upload file path	
												$path = "application/app/".$last_g_id."/" . $app_file["name"];
											
												//Update last app with new data
										
												$db->query("
												UPDATE  `project`.`application` SET  
												`app_g_id` = ".$last_g_id.",
												`app_path` = '".$path."',
												`app_time` = NOW( )
												 WHERE  `application`.`app_id` ='".$last_app_id."' LIMIT 1 ;");
											 
										//-------------------------------------------------END UP APP---------------------------------------
										
										///---------------------------------------/UP  DOCUMENT-------------------------------------------
											//$_POST['g_id']
											if(!file_exists("application/doc/".$last_g_id."") )
											{
												 //echo "Folder not exist! Create new folder";
												mkdir("application/doc/".$last_g_id."");
											}
											
											
											
											
										
											if (file_exists("application/doc/".$last_g_id."/" . $app_doc["name"]))
											{
												//echo $app_file["name"] . " already exists. ";
											}
											else
											{
												move_uploaded_file(
													$app_doc["tmp_name"],
													"application/doc/".$last_g_id."/" . $app_doc["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											}
											
											
											
												//collet upload file path	
												$path = "application/doc/".$last_g_id."/" . $app_doc["name"];
											
												//Update last app with new data
										
												$db->query("
												UPDATE  `project`.`application` SET  
												`app_g_id` = ".$last_g_id.",
												`app_doc` = '".$path."'
												
												 WHERE  `application`.`app_id` ='".$last_app_id."' LIMIT 1 ;");
											 
										//-------------------------------------------------END UP DOCUMENT---------------------------------------
										
										
										
												
												///-------------------------------UP  LOGO APP---------------------------------
												
										
											//$_POST['g_id']
											if(!file_exists("application/logo/".$last_g_id.""))
											{
												 //echo "Folder not exist! Create new folder";
												mkdir("application/logo/".$last_g_id."");
											}
		
											if (file_exists("application/logo/".$last_g_id."/" . $logo_file["name"]))
											{
												echo $logo_file["name"] . " already exists. ";
											}
											else
											{
												move_uploaded_file(
													$logo_file["tmp_name"],
													"application/logo/".$last_g_id."/" . $logo_file["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											}
											
						
												//collet upload file path	
									
												
												$path = "application/logo/".$last_g_id."/" . $logo_file["name"];
											
												//Update last app with new data
										
												$db->query("
												UPDATE  `project`.`application` SET  
												`app_g_id` = ".$last_g_id.",
												`app_logo` = '".$path."'
												
												 WHERE  `application`.`app_id` ='".$last_app_id."' LIMIT 1 ;");
											 
										///---------------------------------------END UP LOGO----------------------------------------*/
										
										///---------------------------------------/UP  scr1-------------------------------------------
				
				
											//$_POST['g_id']
											if(!file_exists("application/scr/".$last_g_id."") )
											{
												 //echo "Folder not exist! Create new folder";
												mkdir("application/scr/".$last_g_id."");
											}
	
										
												move_uploaded_file(
													$scr_file_1["tmp_name"],
													"application/scr/".$last_g_id."/" . $scr_file_1["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											
											
											
											
												//collet upload file path	
												$path = "application/scr/".$last_g_id."/" . $scr_file_1["name"];
											
												//Update last app with new data
										
										
									
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_g_id` = ".$last_g_id.",
													`app_scr_1` = '".$path."'
													
													 WHERE  `application`.`app_id` ='".$last_app_id."' LIMIT 1 ;");
											 
											
										//-------------------------------------------------END UP scr1---------------------------------------
										
										///---------------------------------------/UP  scr2-------------------------------------------
				
				
											//$_POST['g_id']
											if(!file_exists("application/scr/".$last_g_id."") )
											{
												 //echo "Folder not exist! Create new folder";
												mkdir("application/scr/".$last_g_id."");
											}
											
											
											
											
										

												move_uploaded_file(
													$scr_file_2["tmp_name"],
													"application/scr/".$last_g_id."/" . $scr_file_2["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
										
											
											
												//collet upload file path	
												$path = "application/scr/".$last_g_id."/" . $scr_file_2["name"];
											
												//Update last app with new data
										
										
									
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_g_id` = ".$last_g_id.",
													`app_scr_2` = '".$path."'
													
													 WHERE  `application`.`app_id` ='".$last_app_id."' LIMIT 1 ;");
											 
											
										//-------------------------------------------------END UP scr2---------------------------------------
										
										
										///---------------------------------------/UP  scr3-------------------------------------------
				
				
											//$_POST['g_id']
											if(!file_exists("application/scr/".$last_g_id."") )
											{
												 //echo "Folder not exist! Create new folder";
												mkdir("application/scr/".$last_g_id."");
											}
											
											
										

												move_uploaded_file(
													$scr_file_3["tmp_name"],
													"application/scr/".$last_g_id."/" . $scr_file_3["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											
											
											
											
												//collet upload file path	
												$path = "application/scr/".$last_g_id."/" . $scr_file_3["name"];
											
												//Update last app with new data
										
										
									
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_g_id` = ".$last_g_id.",
													`app_scr_3` = '".$path."'
													
													 WHERE  `application`.`app_id` ='".$last_app_id."' LIMIT 1 ;");
											 
											
										//-------------------------------------------------END UP scr3---------------------------------------
										
											
											
												//Update Student  group?
										for($i=1 ; $i <= $num ; $i++){
												if($student_[$i] != ''){
													$db->query("
													UPDATE  `project`.`student` SET  
													`s_g_id` = ".$last_g_id.",
													`s_position` = ".$i."
													 WHERE  `student`.`s_id` ='".$student_[$i]."' LIMIT 1 ;"); 
												}
											}
												 Echo "สร้างกลุ่มเสร็จเรียบร้อย";				
										

										
										

	}	
	
public function edit_profile_group($post){
			$num = $post['number2'];
				$student_ = '';
				$i = '1';
				while($i <= $num){
					$student_[$i] = $post['student_'.$i.''];
					$i++;
				}
                
                $advisor_1 = $post['advisor_1'];
				 $advisor_2 = $post['advisor_2'];	
                 $group_grade = $post['group_grade'];
                 
									$db = new database($GLOBALS['config']);
									$error = "";
									
									
									
									
									/******Start Input Data Validation********/
									
									//Is student duplicated	
									//if (	
										 // ($student_1 == $student_2 || $student_1 == $student_3)  ||
										 // (($student_2 != ''   ||   $student_3 != '')   &&   ($student_2  ==  $student_3))){
										//	echo "มีความผิดพลาดกับ รหัสนิสิตที่ท่านกรอก กรุณาตรวจสอบให้ดี และกรอกใหม่อีกครั้ง";
											//echo mysql_insert_id();
											//die();
										//}
										
										
										// student Same 
									for($i=1 ; $i <= $num ; $i++){
											for($o=1 ; $o<=$num ; $o++){
												if($i == $o){
														
												}else{
													if($student_[$i] == $student_[$o])
													 $error = $error.'นิสิตช่องที่ '.$i.  'ซ้ำกับนิสิตช่องที่'.$o." \n";
													 break;
												}
												 break;	
											}
										
									}
									 //Send error if some of student
										if($error!=''){
											
											echo $error;
											die();
										}
										
										
									for($i=1 ; $i <= $num ; $i++){
                                            //echo $student_[$i];
                                            if($student_[$i] == ''){
                                                $error = $error. "กรุณากรอกชื่อผู้บัญชีผู้ใช้งานให้ครบตามช่อง";
                                            	
                                            }
                                            //IS Student Read?
                                            if($student_[$i] != ''){
                                                    $check_stu = $db->query("select * from student where s_id = "."'".$student_[$i]."'");
                                                    $row = mysql_num_rows($check_stu);
                                                    
                                                    if($row != 1){
                                                        $error = $error.'นิสิตช่องที่ '.$i."  ไม่มีอยู่ในฐานข้อมูล \n";
                                                    	
													}
											}
										
											
											
								
										// IS STUDENT GROUP
										if($student_[$i] != ''){
											$check_stu = $db->query("select * from student where s_id = "."'".$student_[$i]."'");
											$row = mysql_fetch_assoc($check_stu);
											
											if($row['s_g_id']!=0 && $row['s_g_id']!= $_SESSION['user']->group_id){
												$error = $error.'นิสิตช่องที่ '.$i." มีกลุ่มแล้ว  \n";
											}
										}
									}
									
									  //Send error if some of student
										if($error!=''){
											
											echo $error;
											die();
										}
									
									 //check id student
									
									for($i=1 ; $i <= $num ; $i++){
										
										if($student_[$i] != ''){
											
											$ress = $db -> query(
                                            "SELECT * FROM `project` . `student`
                                            WHERE `s_g_id` = '".$_SESSION['user']->group_id."' AND  `s_position` = '".$i."'
                                            ");	
                                            $rowss = mysql_fetch_array($ress);
											$ss_id = $rowss['s_id'];
											if(strcmp($student_[$i],$ss_id) != 0){
												$db->query("
													UPDATE  `project`.`student` SET  
													`s_g_id` = '0',
													`s_position` = '0'
													 WHERE  `student`.`s_id` ='".$ss_id."' LIMIT 1 ;"); 
												
												
												$db->query("
													UPDATE  `project`.`student` SET  
													`s_g_id` = ".$_SESSION['user']->group_id.",
													`s_position` = ".$i."
													 WHERE  `student`.`s_id` ='".$student_[$i]."' LIMIT 1 ;"); 
												}
										}
									}
									    
                                     //Send error if some of student
										if($error!=''){
											
											echo $error;
											die();
										}
									
					
				///--------------------update group--------------------//////
				
					$db->query("
					UPDATE  `project`.`group` SET 
					`g_a_id1` 	= '".$advisor_1."',
					`g_a_id2` 	= '".$advisor_2."',
					`g_grade` 	= '".$group_grade."'
					 WHERE  `group`.`g_id` ='".$_SESSION['user']->group_id."' LIMIT 1 ;");
				echo "แก้ไขเสร็จเรียบร้อย";
			
					
}
	
public function edit_profile_app($post , $files){
					$app_name=$post['app_name'] ;
					$app_file = $files['app_file']  ;
					 $app_doc = $files['app_doc'] ;
					  $logo = $files['logo_file'] ;
					   $scr_1 = $files['screen_file1'];
						$scr_2 =$files['screen_file2'];
						$scr_3 =$files['screen_file3'];
						$clip =$post['clip_show'];
						$detail =$post['app_detail'];
						$tag = $post['app_tag'];
						$time = $post['time'];
						$version = $post['app_version'];
						$system = $post['app_system'];
						$field = $post['app_field'];
						$time = $post['dateInput'];
					$error = "";
						//echo $detail;
				$db = new database($GLOBALS['config']);
				$last_g_id =  $_SESSION['user']->group_id;
				
					//print_r ($logo);
				////---------------------------------debug name_app-----------------//////////////
						if(($app_name == '')){
							echo "กรุณากรอกชื่อแอปพลิเคชั่น";
							die();
						}
				
				///------------------------------------end debug name_app---------------//////////////
				
				
				
				
				////---------------------------------debug tag_app-----------------//////////////
						if($tag == '0'){
							echo "กรุณาเลือกประเภทของแอปพลิเคชั่น";
							die();
						}
				
				///------------------------------------end debug tag_app---------------//////////////
				
				
				//// field
				 if($field == '0'){
					 		echo "กรุณาเลือกสาขาของแอปพลิเคชั่น";
							die();
					 }
				
				
				
					////---------------------------------debug detail-----------------//////////////
						//if($detail == ''){
							//echo "กรุณากรอกข้อมูล";
							//die();
						//}
				
				///------------------------------------end debug detail_app---------------//////////////
				
				////// clip
									if($clip == ''){
										echo "กรุณากรอกข้อมูลคลิป";
										die();	
									}
								if($clip != ''){	
										 $str = split("/",$clip);
										 $youtube=$str[3];
										 //$clip_path="<iframe width='360' height='230' src='http://www.youtube.com/embed/".$youtube."'></iframe>";	
										//echo "<iframe width='360' height='230' src='http://www.youtube.com/embed/".$youtube."'></iframe>";							 
									}
								///////end clip
								
					//////////// time
						if($time == ''){
								echo "กรุณากรอกวันที่แก้ไข";
								die();
							}
					//////////////end time
			/////----------------------------
	
											if ($app_file["size"] > $GLOBALS['max_file_size'])
											 $error = $error."ขนาดของไฟล์โปรแกรมใหญ่เกินไป \n";
											
											if(!in_array($app_file["type"],$GLOBALS['allow_file_type_app']))
												$error = $error."ชนิดของไฟล์โปรแกรมไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($app_file['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$_SESSION['user']->group_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$app_path=$row["app_path"];
												//echo $path_scr_1;
												
												//---Delete scr 1 in folder
												@unlink ($app_path);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$app_file["tmp_name"],
													"application/app/".$last_g_id."/" . $app_file["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											
											
											
											
												//collet upload file path	
												$path = "application/app/".$last_g_id."/" . $app_file["name"];
											
												//Update last app with new data
										
										
									
									if($app_file['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													
													`app_path` = '".$path."'
													
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
										//echo $scr_file_1;	
									
										//-------------------------------------------------END UPdate app_file---------------------------------------
				
				
				///---------------------------------------update app_doc-------------------------------------------
	
												if ($app_doc["size"] > $GLOBALS['max_file_doc_size'])
											 $error = $error."ขนาดของไฟล์เอกสารใหญ่เกินไป \n";
											
											if(!in_array($app_doc["type"],$GLOBALS['allow_file_doc_type_app']))
												$error = $error."ชนิดของไฟล์เอกสารไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($app_doc['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$_SESSION['user']->group_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$app_path=$row["app_doc"];
												//echo $path_scr_1;
												
												//---Delete scr 1 in folder
												@unlink ($app_path);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$app_doc["tmp_name"],
													"application/doc/".$last_g_id."/" . $app_doc["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											
											
											
											
												//collet upload file path	
												$path = "application/doc/".$last_g_id."/" . $app_doc["name"];
											
												//Update last app with new data
										
										
									
									if($app_doc['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													
													`app_doc` = '".$path."'
													
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
										//echo $scr_file_1;	
									
										//-------------------------------------------------END UPdate app_doc---------------------------------------
				
				///---------------------------------------update logo-------------------------------------------
	
											if ($logo["size"] > $GLOBALS['max_file_logo_size'])
											 $error = $error."ขนาดของรูปภาพสัญลักษณ์ใหญ่เกินไป \n";
											
											if(!in_array($logo["type"],$GLOBALS['allow_file_type_pic']))
												$error = $error."ชนิดของรูปภาพสัญลักษณ์ไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												//echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($logo['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$last_g_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$logo_path=$row["app_logo"];
												//echo $logo;
												
												//---Delete scr 1 in folder
												@unlink($logo_path);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$logo["tmp_name"],
													"application/logo/".$last_g_id."/" . $logo["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											//print_r ($logo);
											
											
											
												//collet upload file path	
												$path = "application/logo/".$last_g_id."/" . $logo["name"];
											
												//Update last app with new data
										
										
									
									if($logo['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_logo` = '".$path."'
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
									
										//-------------------------------------------------END UPdate logo---------------------------------------
										
				
				
									///---------------------------------------update scr_1-------------------------------------------
	
											if ($scr_1["size"] > $GLOBALS['max_file_logo_size'])
											 $error = $error."ขนาดของรูปภาพประกอบ 1 ใหญ่เกินไป \n";
											
											if(!in_array($scr_1["type"],$GLOBALS['allow_file_type_pic']))
												$error = $error."ชนิดของรูปภาพประกอบ 1  ไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												//echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($scr_1['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$last_g_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$path_scr_1=$row["app_scr_1"];
												//echo $logo;
												
												//---Delete scr 1 in folder
												@unlink($path_scr_1);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$scr_1["tmp_name"],
													"application/scr/".$last_g_id."/" . $scr_1["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											//print_r ($logo);
											
											
											
												//collet upload file path	
												$path = "application/scr/".$last_g_id."/" . $scr_1["name"];
											
												//Update last app with new data
										
										
									
									if($scr_1['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_scr_1` = '".$path."'
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
									
										//-------------------------------------------------END UPdate scr_1---------------------------------------
										
				
				
						///---------------------------------------update scr_2-------------------------------------------
	
											if ($scr_2["size"] > $GLOBALS['max_file_logo_size'])
											 $error = $error."ขนาดของรูปภาพประกอบ 2 ใหญ่เกินไป \n";
											
											if(!in_array($scr_2["type"],$GLOBALS['allow_file_type_pic']))
												$error = $error."ชนิดของรูปภาพประกอบ 2 ไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												//echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($scr_2['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$last_g_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$path_scr_2=$row["app_scr_2"];
												//echo $logo;
												
												//---Delete scr 1 in folder
												@unlink($path_scr_2);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$scr_2["tmp_name"],
													"application/scr/".$last_g_id."/" . $scr_2["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											//print_r ($logo);
											
											
											
												//collet upload file path	
												$path = "application/scr/".$last_g_id."/" . $scr_2["name"];
											
												//Update last app with new data
										
										
									
									if($scr_2['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_scr_2` = '".$path."'
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
									
										//-------------------------------------------------END UPdate scr_2---------------------------------------
									
									
									///---------------------------------------update scr_3-------------------------------------------
	
											if ($scr_3["size"] > $GLOBALS['max_file_logo_size'])
											 $error = $error."ขนาดของรูปภาพประกอบ 3 ใหญ่เกินไป \n";
											
											if(!in_array($scr_3["type"],$GLOBALS['allow_file_type_pic']))
												$error = $error."ชนิดของรูปภาพประกอบ 3  ไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												//echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($scr_3['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$last_g_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$path_scr_3=$row["app_scr_3"];
												//echo $logo;
												
												//---Delete scr 1 in folder
												@unlink($path_scr_3);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$scr_3["tmp_name"],
													"application/scr/".$last_g_id."/" . $scr_3["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											//print_r ($logo);
											
											
											
												//collet upload file path	
												$path = "application/scr/".$last_g_id."/" . $scr_3["name"];
											
												//Update last app with new data
										
										
									
									if($scr_3['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_scr_3` = '".$path."'
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
									
										//-------------------------------------------------END UPdate scr_3---------------------------------------
											
										
										
									
				
				
				
				///--------------------update app--------------------//////
				
					$db->query("
					UPDATE  `project`.`application` SET 
					`app_name` 	= '".$app_name."',
					`app_detail` 	= '".$detail."',
					`app_tag` 		= '".$tag."',
					`app_system` 	= '".$system."',
					`app_version` 		= '".$version."',
					`app_field` 		= '".$field."',
					`app_clip` 		= '".$youtube."',
					`app_time` = '".$time."'
					 WHERE  `application`.`app_g_id` ='".$_SESSION['user']->group_id."' LIMIT 1 ;");
				echo "แก้ไขเสร็จเรียบร้อย";
			}

			
}
		
		
		
		
		
		//class advisor
	class advisor extends user	
	{
			protected $field;
			protected $group;
			
			public function __construct($id)
			{
				$db = new database($GLOBALS['config']);
				
				$result = $db->query("select * from advisor where a_id = "."'".$id."'");
				
				$row = mysql_fetch_assoc($result);
			
				$this->id			= $row['a_id'];
				$this->pass			=$row['a_pass'];
				$this->id_type		= 'a';
				$this->name			= $row['a_name'];
				$this->tel			= $row['a_tel'];
				$this->email		= $row['a_email'];
				$this->address		= $row['a_address'];
				$this->sex			= $row['a_sex'];
				$this->birthday		= $row['a_birthday'];
				
				$this->group_id		= $row['a_g_id'];
				$this->field		= $row['a_f_id'];
				
				$db->close();
			}
			
			public function edit_profile($post){
				
					$db = new database($GLOBALS['config']);
	
				
				$result = $db->query(
					"UPDATE  `advisor`SET  
					`a_name` 	=  '".$post['name'].	"',
					`a_tel` 	=  '".$post['tel'].		"',
					`a_email`	=  '".$post['email'].	"',
					`a_address` =  '".$post['address'].	"',
					`a_sex` 	=  '".$post['sex'].		"',
					`a_f_id` 	=  '".$post['field'].	"',
					`a_birthday` 	=  '".$post['dateInput']."'
					WHERE CONVERT(  `advisor`.`a_id` USING utf8 ) =  '".$_SESSION['user']->id."' LIMIT 1 ;"
				);echo "แก้ไขสำเร็จ";
			}
			
			
			
		public function search_advisor($post){
				?><script type="text/javascript" src="ajax/edit_ajax.js"></script> <?php
				//$text = explode(" ",$post);
				//$str=$post;
			$num =$post['grade_ad'];	
			//print_r ($str);
								$db = new database($GLOBALS['config']);
                                 $query ="SELECT * FROM  `group` 
                                WHERE `g_grade` = '".$num."' and
									  `g_a_id1` = '".$_SESSION['user']->id."'
                                ";	
                                
						
								$res = $db->query($query);
						
						
				//echo "<td></td>";
				$a = "";	
				$result = "";
				$result .= "<table class=table_edit_pro_advisor>";
				$result .= "<tr><td>ชื่อ</td><td>แก้ไข</td></tr>";
				while($row = mysql_fetch_array($res)){
							$path=$row["g_id"];
						//echo $path;
							//$db = new database($GLOBALS['config']);
							$db = new database($GLOBALS['config']);
                                 $res2 = $db -> query(
                                "SELECT * FROM `project` . `application`
                                WHERE `app_g_id` = '".$path."'
                                ");
							while($row2 = mysql_fetch_array($res2)){
								
								$a = $row2['app_id'];
								
								//$result .= "<tr><td>".$row2['app_id']."</td>";
								$result .= "<tr><td>".$row2['app_name']."</td>";
								//$result .= "<td> <a href='.php?id=".$row2['app_id']."</td>";
								$result .=  "<td><a href='javascript:load_edit_app_advisor($path);'>แก้ไข</a></td></tr>";						
								 ?>
                                 <link rel="stylesheet" type="text/css" href="css/main.css" />
								 <?php
								//$result .= "<td><br></br>".$row2['app_name_en']."</td></tr>";
							}
					}
				$result.="</table>";
				echo $result;		
				$db->close();
				
				
				
			}		
		
			
	public function edit_profile_app($post,$files,$p){
					$error = "";
						//echo $detail;
				$n = $post['nn'];
				$student_ = '';
				$i = '1';
				while($i <= $n){
					$student_[$i] = $post['student_'.$i.''];
					$i++;
				}
				 $advisor_1 = $post['advisor_1'];
				 $advisor_2 = $post['advisor_2'];	
                 $group_grade = $post['group_grade'];
				$db = new database($GLOBALS['config']);
				$g_id = $post['num'];
				$last_g_id =  $post['num'];
				
					$app_name=$post['app_name'] ;
					$app_file = $files['app_file']  ;
					 $app_doc = $files['app_doc'] ;
					  $logo = $files['logo_file'] ;
					   $scr_1 = $files['screen_file1'];
						$scr_2 =$files['screen_file2'];
						$scr_3 =$files['screen_file3'];
						$clip =$post['clip_show'];
						$detail =$post['app_detail'];
						$tag = $post['app_tag'];
						$time = $post['time'];
						$version = $post['app_version'];
						$system = $post['app_system'];
						$field=$post['app_field'];
						$time=$post['dateInput'];
					
						//echo $detail;
				
				
				
					//print_r ($logo);
				////---------------------------------debug name_app-----------------//////////////
						if(($app_name == '')){
							echo "กรุณากรอกชื่อแอปพลิเคชั่น";
							die();
						}
				
				///------------------------------------end debug name_app---------------//////////////
				
				
				
				
				////---------------------------------debug tag_app-----------------//////////////
						if($tag == '0'){
							echo "กรุณาเลือกประเภทของแอปพลิเคชั่น";
							die();
						}
				
				///------------------------------------end debug tag_app---------------//////////////
				
				
				//// time
				 if($time == ''){
					 		echo "กรุณากรอกวันที่แก้ไข";
							die();
					 }
				
				
				
					////---------------------------------debug detail-----------------//////////////
						if($detail == ''){
							echo "กรุณากรอกข้อมูล";
							die();
						}
				
				///------------------------------------end debug detail_app---------------//////////////
				////// clip
									if($clip == ''){
										echo "กรุณากรอกข้อมูลคลิป";
										die();	
									}
								if($clip != ''){	
										 $str = split("/",$clip);
										 $youtube=$str[3];
										 //$clip_path="<iframe width='360' height='230' src='http://www.youtube.com/embed/".$youtube."'></iframe>";	
										//echo "<iframe width='360' height='230' src='http://www.youtube.com/embed/".$youtube."'></iframe>";							 
									}
								///////end clip
			/////----------------------------
									// student Same 
									for($i=1 ; $i <= $n ; $i++){
											for($o=1 ; $o<=$n ; $o++){
												if($i == $o){
														
												}else{
													if($student_[$i] == $student_[$o])
													 $error = $error.'นิสิตช่องที่ '.$i.  'ซ้ำกับนิสิตช่องที่'.$o." \n";
													 break;
												}
												 break;	
											}
										
									}
									 //Send error if some of student
										if($error!=''){
											
											echo $error;
											die();
										}
										
										
									for($i=1 ; $i <= $n ; $i++){
                                            //echo $student_[$i];
                                            if($student_[$i] == ''){
                                                $error = $error. "กรุณากรอกชื่อผู้บัญชีผู้ใช้งานให้ครบตามช่อง";
                                            	
                                            }
                                            //IS Student Read?
                                            if($student_[$i] != ''){
                                                    $check_stu = $db->query("select * from student where s_id = "."'".$student_[$i]."'");
                                                    $row = mysql_num_rows($check_stu);
                                                    
                                                    if($row != 1){
                                                        $error = $error.'นิสิตช่องที่ '.$i."  ไม่มีอยู่ในฐานข้อมูล \n";
                                                    	
													}
											}
										
											
											
								
										// IS STUDENT GROUP
										if($student_[$i] != ''){
											$check_stu = $db->query("select * from student where s_id = "."'".$student_[$i]."'");
											$row = mysql_fetch_assoc($check_stu);
											
											if($row['s_g_id']!=0 && $row['s_g_id']!= $g_id){
												$error = $error.'นิสิตช่องที่ '.$i." มีกลุ่มแล้ว  \n";
											}
										}
									}
									
									  //Send error if some of student
										if($error!=''){
											
											echo $error;
											die();
										}
									
									 //check id student
									
									for($i=1 ; $i <= $n ; $i++){
										
										if($student_[$i] != ''){
											
											$ress = $db -> query(
                                            "SELECT * FROM `project` . `student`
                                            WHERE `s_g_id` = '".$g_id."' AND  `s_position` = '".$i."'
                                            ");	
                                            $rowss = mysql_fetch_array($ress);
											$ss_id = $rowss['s_id'];
											if(strcmp($student_[$i],$ss_id) != 0){
												$db->query("
													UPDATE  `project`.`student` SET  
													`s_g_id` = '0',
													`s_position` = '0'
													 WHERE  `student`.`s_id` ='".$ss_id."' LIMIT 1 ;"); 
												
												
												$db->query("
													UPDATE  `project`.`student` SET  
													`s_g_id` = ".$g_id.",
													`s_position` = ".$i."
													 WHERE  `student`.`s_id` ='".$student_[$i]."' LIMIT 1 ;"); 
												}
										}
									}
									    
                                     //Send error if some of student
										if($error!=''){
											
											echo $error;
											die();
										}
			
			
								///////////////// update file
											if ($app_file["size"] > $GLOBALS['max_file_size'])
											 $error = $error."ขนาดของไฟล์โปรแกรมใหญ่เกินไป \n";
											
											if(!in_array($app_file["type"],$GLOBALS['allow_file_type_app']))
												$error = $error."ชนิดของไฟล์โปรแกรมไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($app_file['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$last_g_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$app_path=$row["app_path"];
												//echo $path_scr_1;
												
												//---Delete scr 1 in folder
												@unlink ($app_path);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$app_file["tmp_name"],
													"application/app/".$last_g_id."/" . $app_file["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											
											
											
											
												//collet upload file path	
												$path = "application/app/".$last_g_id."/" . $app_file["name"];
											
												//Update last app with new data
										
										
									
									if($app_file['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													
													`app_path` = '".$path."'
													
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
										//echo $scr_file_1;	
									
										//-------------------------------------------------END UPdate app_file---------------------------------------
				
				
				///---------------------------------------update app_doc-------------------------------------------
	
												if ($app_doc["size"] > $GLOBALS['max_file_doc_size'])
											 $error = $error."ขนาดของไฟล์เอกสารใหญ่เกินไป \n";
											
											if(!in_array($app_doc["type"],$GLOBALS['allow_file_doc_type_app']))
												$error = $error."ชนิดของไฟล์เอกสารไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($app_doc['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$last_g_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$app_path=$row["app_doc"];
												//echo $path_scr_1;
												
												//---Delete scr 1 in folder
												@unlink ($app_path);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$app_doc["tmp_name"],
													"application/doc/".$last_g_id."/" . $app_doc["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											
											
											
											
												//collet upload file path	
												$path = "application/doc/".$last_g_id."/" . $app_doc["name"];
											
												//Update last app with new data
										
										
									
									if($app_doc['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													
													`app_doc` = '".$path."'
													
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
										//echo $scr_file_1;	
									
										//-------------------------------------------------END UPdate app_doc---------------------------------------
				
				///---------------------------------------update logo-------------------------------------------
	
											if ($logo["size"] > $GLOBALS['max_file_logo_size'])
											 $error = $error."ขนาดของรูปภาพสัญลักษณ์ใหญ่เกินไป \n";
											
											if(!in_array($logo["type"],$GLOBALS['allow_file_type_pic']))
												$error = $error."ชนิดของรูปภาพสัญลักษณ์ไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												//echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($logo['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$last_g_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$logo_path=$row["app_logo"];
												//echo $logo;
												
												//---Delete scr 1 in folder
												@unlink($logo_path);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$logo["tmp_name"],
													"application/logo/".$last_g_id."/" . $logo["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											//print_r ($logo);
											
											
											
												//collet upload file path	
												$path = "application/logo/".$last_g_id."/" . $logo["name"];
											
												//Update last app with new data
										
										
									
									if($logo['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_logo` = '".$path."'
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
									
										//-------------------------------------------------END UPdate logo---------------------------------------
										
				
				
									///---------------------------------------update scr_1-------------------------------------------
	
											if ($scr_1["size"] > $GLOBALS['max_file_logo_size'])
											 $error = $error."ขนาดของรูปภาพประกอบ 1 ใหญ่เกินไป \n";
											
											if(!in_array($scr_1["type"],$GLOBALS['allow_file_type_pic']))
												$error = $error."ชนิดของรูปภาพประกอบ 1  ไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												//echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($scr_1['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$last_g_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$path_scr_1=$row["app_scr_1"];
												//echo $logo;
												
												//---Delete scr 1 in folder
												@unlink($path_scr_1);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$scr_1["tmp_name"],
													"application/scr/".$last_g_id."/" . $scr_1["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											//print_r ($logo);
											
											
											
												//collet upload file path	
												$path = "application/scr/".$last_g_id."/" . $scr_1["name"];
											
												//Update last app with new data
										
										
									
									if($scr_1['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_scr_1` = '".$path."'
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
									
										//-------------------------------------------------END UPdate scr_1---------------------------------------
										
				
				
						///---------------------------------------update scr_2-------------------------------------------
	
											if ($scr_2["size"] > $GLOBALS['max_file_logo_size'])
											 $error = $error."ขนาดของรูปภาพประกอบ 2 ใหญ่เกินไป \n";
											
											if(!in_array($scr_2["type"],$GLOBALS['allow_file_type_pic']))
												$error = $error."ชนิดของรูปภาพประกอบ 2 ไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												//echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($scr_2['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$last_g_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$path_scr_2=$row["app_scr_2"];
												//echo $logo;
												
												//---Delete scr 1 in folder
												@unlink($path_scr_2);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$scr_2["tmp_name"],
													"application/scr/".$last_g_id."/" . $scr_2["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											//print_r ($logo);
											
											
											
												//collet upload file path	
												$path = "application/scr/".$last_g_id."/" . $scr_2["name"];
											
												//Update last app with new data
										
										
									
									if($scr_2['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_scr_2` = '".$path."'
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
									
										//-------------------------------------------------END UPdate scr_2---------------------------------------
									
									
									///---------------------------------------update scr_3-------------------------------------------
	
											if ($scr_3["size"] > $GLOBALS['max_file_logo_size'])
											 $error = $error."ขนาดของรูปภาพประกอบ 3 ใหญ่เกินไป \n";
											
											if(!in_array($scr_3["type"],$GLOBALS['allow_file_type_pic']))
												$error = $error."ชนิดของรูปภาพประกอบ 3  ไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												//echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($scr_3['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$last_g_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$path_scr_3=$row["app_scr_3"];
												//echo $logo;
												
												//---Delete scr 1 in folder
												@unlink($path_scr_3);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$scr_3["tmp_name"],
													"application/scr/".$last_g_id."/" . $scr_3["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											//print_r ($logo);
											
											
											
												//collet upload file path	
												$path = "application/scr/".$last_g_id."/" . $scr_3["name"];
											
												//Update last app with new data
										
										
									
									if($scr_3['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_scr_3` = '".$path."'
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
									
										//-------------------------------------------------END UPdate scr_3---------------------------------------
											
										
										
									
				
				
				
				///--------------------update app--------------------//////
				$db->query("
					UPDATE  `project`.`group` SET 
					`g_a_id1` 	= '".$advisor_1."',
					`g_a_id2` 	= '".$advisor_2."',
					`g_grade` 	= '".$group_grade."'
					 WHERE  `group`.`g_id` ='".$g_id."' LIMIT 1 ;");
				
					$db->query("
					UPDATE  `project`.`application` SET 
					`app_name` 	= '".$app_name."',
					`app_detail` 	= '".$detail."',
					`app_tag` 		= '".$tag."',
					`app_system` 	= '".$system."',
					`app_version` 		= '".$version."',
					`app_field` 		= '".$field."',
					`app_clip` 		= '".$youtube."',
					`app_time` = '".$time."'
					 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
				echo "แก้ไขเสร็จเรียบร้อย";
			}					
						
		
	}
	
	
	
	
	
	//class admin
	class admin extends user{	
		
			public function __construct($id)
			{
				$db = new database($GLOBALS['config']);
				
				$result = $db->query("select * from admin where x_id = "."'".$id."'");
				
				$row = mysql_fetch_assoc($result);
			
				$this->id			= $row['x_id'];
				$this->pass			=$row['x_pass'];
				$this->id_type		= 'x';
				$this->name			= $row['x_name'];
				$this->tel			= $row['x_tel'];
				$this->email		= $row['x_email'];
				$this->address		= $row['x_address'];
				$this->sex			= $row['x_sex'];
				$this->birthday		= $row['x_birthday'];
				
				$db->close();
			}
			
		public function edit_profile($post){
				
					$db = new database($GLOBALS['config']);
				
				$result = $db->query(
					"UPDATE  `admin`SET  
					`x_name` 	=  '".$post['name'].	"',
					`x_tel` 	=  '".$post['tel'].		"',
					`x_email`	=  '".$post['email'].	"',
					`x_address` =  '".$post['address'].	"',
					`x_sex` 	=  '".$post['sex'].		"',
					`x_birthday` 	=  '".$post['dateInput']."'
					WHERE CONVERT(  `admin`.`x_id` USING utf8 ) =  '".$_SESSION['user']->id."' LIMIT 1 ;"
				);
				echo "แก้ไขสำเร็จ";
				}	
						
		
	public function edit_profile_user($data , $type){
				
				 
				$db = new database($GLOBALS['config']);
				mysql_query("SET NAMES UTF8");
				$text = explode(" ",$data);
				
				//print_r($text);
				switch($type){	 
				
				
						 case 'member':
						 		
						 		$query = "SELECT * from `member` WHERE 1=1";
		
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`m_id` LIKE 	'%".$i."%' OR ".
										"`m_name`  LIKE '%".$i."%'    ".
										")";
									}
								}
								
								$objquery = $db->query($query);
								$mm = mysql_num_rows($objquery);
								
								 if($mm != 0){
										$a = "";	
											$result = "";
											$result .= "<table class=table_edit>";
											$result .= "<tr><td>ชื่อบัญชีผู้ใช้</td><br></br><td>ชื่อ-สกุล</td><td>แก้ไข</td><td>ลบ</td></tr>";
											while($row = mysql_fetch_array($objquery)){
														$path=$row["m_id"];
													//echo $path;
														//$db = new database($GLOBALS['config']);
															$a=$path;
															$b=$type;
															$c="m";
															$d=$c.'/'.$b.'/'.$a;
															
															//$result .= "<tr><td>".$row2['app_id']."</td>";
															$result .= "<tr><td>".$row['m_id']."</td>";
															$result .= "<td>".$row['m_name']."</td>";
															//$result .= "<td> <a href='.php?id=".$row2['app_id']."</td>";
															$result .=  "<td><a href='javascript:load_edit_user_admin(&#039$d&#039);'>แก้ไข</a></td>";
															$result .=  "<td><a href='javascript:load_delete_user_admin(&#039$d&#039);'>ลบ</a></td></tr>"; 
															 ?>
															 <link rel="stylesheet" type="text/css" href="css/main.css" />
															 <?php
															//$result .= "<td><br></br>".$row2['app_name_en']."</td></tr>";
													}
											$result.="</table>";
											echo $result;			 
								 }else{
									
									echo "<div style=margin-left:325px>";
									echo "<div style=margin-top:50px>";
									echo "ไม่มีบุคคลนี้อยู่ในระบบ"; 
									echo "</div>";
									echo "</div>";
								 }
								 
						 break;
						 
						  case 'student':
						 		
						 		$query = "SELECT * from `student` WHERE 1=1";
		
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`s_id` LIKE 	'%".$i."%' OR ".
										"`s_name`  LIKE '%".$i."%'    ".
										")";
									}
								}
								$objquery = $db->query($query);
								$mm = mysql_num_rows($objquery);
								
								 if($mm != 0){
									$a = "";	
									$result = "";
									$result .= "<table class=table_edit>";
									$result .= "<tr><td>ชื่อบัญชีผู้ใช้</td><br></br><td>ชื่อ-สกุล</td><td>แก้ไข</td><td>ลบ</td></tr>";
									while($row = mysql_fetch_array($objquery)){
												$path=$row["s_id"];
											//echo $path;
												//$db = new database($GLOBALS['config']);
													$a=$path;
													$b=$type;
													$c="s";
													$d=$c.'/'.$b.'/'.$a;
													$_SESSION['s'] = $d ;
													//$result .= "<tr><td>".$row2['app_id']."</td>";
													$result .= "<tr><td>".$row['s_id']."</td>";
													$result .= "<td>".$row['s_name']."</td>";
													//$result .= "<td> <a href='.php?id=".$row2['app_id']."</td>";
													$result .=  "<td><a href='javascript:load_edit_user_admin(&#039$d&#039);'>แก้ไข</a></td>";
													$result .=  "<td><a href='javascript:load_delete_user_admin(&#039$d&#039);'>ลบ</a></td></tr>";  
													 ?>
													 <link rel="stylesheet" type="text/css" href="css/main.css" />
													 <?php
													//$result .= "<td><br></br>".$row2['app_name_en']."</td></tr>";
											}
									$result.="</table>";
									echo $result;		
								}else{
									
									echo "<div style=margin-left:325px>";
									echo "<div style=margin-top:50px>";
									echo "ไม่มีบุคคลนี้อยู่ในระบบ"; 
									echo "</div>";
									echo "</div>";
								 }
								
								
						 break;
						  case 'advisor':
						 		
						 		$query = "SELECT * from `advisor` WHERE 1=1 ";
		
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`a_id` LIKE 	'%".$i."%' OR ".
										"`a_name`  LIKE '%".$i."%'    ".
										")";
									}
								}
								$objquery = $db->query($query);
								$mm = mysql_num_rows($objquery);
								
								 if($mm != 0){
									$a = "";	
									$result = "";
									$result .= "<table class=table_edit>";
									$result .= "<tr><td>ชื่อบัญชีผู้ใช้</td><br></br><td>ชื่อ-สกุล</td><td>แก้ไข</td><td>ลบ</td></tr>";
									while($row = mysql_fetch_array($objquery)){
												$path=$row["a_id"];
											//echo $path;
												//$db = new database($GLOBALS['config']);
													$a=$path;
													$b=$type;
													$c="a";
													$d=$c.'/'.$b.'/'.$a;
													//$result .= "<tr><td>".$row2['app_id']."</td>";
													$result .= "<tr><td>".$row['a_id']."</td>";
													$result .= "<td>".$row['a_name']."</td>";
													//$result .= "<td> <a href='.php?id=".$row2['app_id']."</td>";
													$result .=  "<td><a href='javascript:load_edit_user_admin(&#039$d&#039);'>แก้ไข</a></td>"; 
													$result .=  "<td><a href='javascript:load_delete_user_admin(&#039$d&#039);'>ลบ</a></td></tr>"; 
													 ?>
													 <link rel="stylesheet" type="text/css" href="css/main.css" />
													 <?php
													//$result .= "<td><br></br>".$row2['app_name_en']."</td></tr>";
											}
									$result.="</table>";
									echo $result;		
								}else{
									
									echo "<div style=margin-left:325px>";
									echo "<div style=margin-top:50px>";
									echo "ไม่มีบุคคลนี้อยู่ในระบบ"; 
									echo "</div>";
									echo "</div>";
								 }
								
								
								
						 break;
						case 'admin':
						 		
						 		$query = "SELECT * from `admin` WHERE 1=1";
		
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`x_id` LIKE 	'%".$i."%' OR ".
										"`x_name`  LIKE '%".$i."%'    ".
										")";
									}
								}
								$objquery = $db->query($query);
								$mm = mysql_num_rows($objquery);
								
								 if($mm != 0){
								  	$a = "";	
									$result = "";
									$result .= "<table class=table_edit>";
									$result .= "<tr><td>ชื่อบัญชีผู้ใช้</td><br></br><td>ชื่อ-สกุล</td><td>แก้ไข</td><td>ลบ</td></tr>";
									while($row = mysql_fetch_array($objquery)){
												$path=$row["x_id"];
											//echo $path;
												//$db = new database($GLOBALS['config']);
													$a=$path;
													$b=$type;
													$c="a";
													$d=$c.'/'.$b.'/'.$a;
													//$result .= "<tr><td>".$row2['app_id']."</td>";
													$result .= "<tr><td>".$row['x_id']."</td>";
													$result .= "<td>".$row['x_name']."</td>";
													//$result .= "<td> <a href='.php?id=".$row2['app_id']."</td>";
													$result .=  "<td><a href='javascript:load_edit_user_admin(&#039$d&#039);'>แก้ไข</a></td>"; 
													$result .=  "<td><a href='javascript:load_delete_user_admin(&#039$d&#039);'>ลบ</a></td></tr>"; 
													 ?>
													 <link rel="stylesheet" type="text/css" href="css/main.css" />
													 <?php
													//$result .= "<td><br></br>".$row2['app_name_en']."</td></tr>";
											}
									$result.="</table>";
									echo $result;		
								  }else{
									
									echo "<div style=margin-left:325px>";
									echo "<div style=margin-top:50px>";
									echo "ไม่มีบุคคลนี้อยู่ในระบบ"; 
									echo "</div>";
									echo "</div>";
								 }
								
								
								
						 break;
				
				
				}
				
			}		
			
	public function delete_profile_user($data){		
		$s = split("/",$data,3);
		print_r ($s);
				//print_r($text);
				switch($s[1]){	 				
						 case 'member':
						 		if($s[2] != ''){
									$db = new database($GLOBALS['config']);
									$db->query("DELETE FROM  member  WHERE `m_id` = '".$s[2]."'");
									$db->close();	
									echo "ลบ".$s[2]."ออกจากระบบสำเร็จ";
								}
								
								
						 break;
						 
						  case 'student':
						 		
						 		if($s[2] != ''){
									$db = new database($GLOBALS['config']);
									$db->query("DELETE FROM  student  WHERE `s_id` = '".$s[2]."'");
									$db->close();	
									echo "ลบ".$s[2]."ออกจากระบบสำเร็จ";
								}
								
						 break;
						  case 'advisor':
						 		
						 		if($s[2] != ''){
									$db = new database($GLOBALS['config']);
									$db->query("DELETE FROM  advisor  WHERE `a_id` = '".$s[2]."'");
									$db->close();	
									echo "ลบ".$s[2]."ออกจากระบบสำเร็จ";
								}
								
						 break;
						 case 'admin':
						 		
						 		if($s[2] != ''){
									$db = new database($GLOBALS['config']);
									$db->query("DELETE FROM  admin  WHERE `x_id` = '".$s[2]."'");
									$db->close();	
									echo "ลบ".$s[2]."ออกจากระบบสำเร็จ";
								}
								
						 break;
				
				
				
				}
				
			}
			
	public function edit_profile_user_update($post){
				
				$db = new database($GLOBALS['config']);
				$s=split("/",$post['num'],3); 
				
				switch($s[1]){
					case 'member':
							$result = $db->query(
								"UPDATE  `member`SET  
								`m_name` 	=  '".$post['name']."',
								`m_tel` 	=  '".$post['tel']."',
								`m_email`	=  '".$post['email']."',
								`m_address` =  '".$post['address']."',
								`m_birthday` 	=  '".$post['dateInput']."',
								`m_sex` 	=  '".$post['sex']."',
								`m_j_id` 	=  '".$post['job']."'
								
								WHERE CONVERT(  `member`.`m_id` USING utf8 ) =  '".$s[2]."' LIMIT 1 ;"
							);
					break;
					case 'student':
							$result = $db->query(
								"UPDATE  `student`SET  
								`s_name` 	=  '".$post['name'].	"',
								`s_tel` 	=  '".$post['tel'].		"',
								`s_email`	=  '".$post['email'].	"',
								`s_address` =  '".$post['address'].	"',
								`s_sex` 	=  '".$post['sex'].		"',
								`s_birthday` 	=  '".$post['dateInput']."',
								`s_grade` 	=  '".$post['grade'].	"', 
								`s_f_id` 	=  '".$post['field'].	"'
								
								WHERE CONVERT(  `student`.`s_id` USING utf8 ) =  '".$s[2]."' LIMIT 1 ;"
							);
					break;
					case 'advisor':
							$result = $db->query(
								"UPDATE  `advisor`SET  
								`a_name` 	=  '".$post['name'].	"',
								`a_tel` 	=  '".$post['tel'].		"',
								`a_email`	=  '".$post['email'].	"',
								`a_address` =  '".$post['address'].	"',
								`a_sex` 	=  '".$post['sex'].		"',
								`a_f_id` 	=  '".$post['field'].	"',
								`a_birthday` 	=  '".$post['dateInput']."'
								WHERE CONVERT(  `advisor`.`a_id` USING utf8 ) =  '".$s[2]."' LIMIT 1 ;"
							);
				
					break;
					
				}
				echo "แก้ไขเสร็จเรียบร้อย";
				$db->close();
			}		
			
	public function search_admin_project($data){
			
						$db = new database($GLOBALS['config']);
						
						$text = explode(" ",$data);
							$query = "SELECT * from `application` WHERE 1=1 ";
						mysql_query("SET NAMES UTF8");
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`app_name` LIKE 	'%".$i."%' OR ".
										"`app_tag` 	   LIKE 	'%".$i."%' OR ".
										"`app_detail`  LIKE 	'%".$i."%'    ".
										")";
									}
								}
						$res = $db->query($query);
						$mm = mysql_num_rows($res);
								
			if($mm != 0){

				//echo "<td></td>";
				$a = "";	
				$result = "";
				$result .= "<table class= table_edit>";
				$result .= "<tr><td>ชื่อแอปพลิเคชั่น</td><td>แก้ไข</td><td>ลบ</td></tr>";
				while($row = mysql_fetch_array($res)){
							$path=$row["g_app_id"];
						//echo $path;
							//$db = new database($GLOBALS['config']);
								$a = $row['app_id'];
								$b = $row['app_g_id'];
								//$result .= "<tr><td>".$row2['app_id']."</td>";
								$result .= "<tr><td>".$row['app_name']."</td>";
								//$result .= "<td>".$row['app_name_en']."</td>";
								//$result .= "<td> <a href='.php?id=".$row2['app_id']."</td>";
								$result .=  "<td><a href='javascript:load_edit_app_admin($b);'>แก้ไข</a></td>"; 
								$result .= "<td><a href='javascript:load_delete_app_admin($b);'>ลบ</a></td></tr>";
								
								 ?>
                                 <link rel="stylesheet" type="text/css" href="css/main.css" />
								 <?php
								//$result .= "<td><br></br>".$row2['app_name_en']."</td></tr>";
						}
				$result.="</table>";
				echo $result;
				}else{
									
					echo "<div style=margin-left:325px>";
					echo "<div style=margin-top:50px>";
					echo "ไม่มีแอปพลิเคชั่นนี้อยู่ในระบบ"; 
					echo "</div>";
					echo "</div>";
				}		
				$db->close();

			}
					
		
	public function edit_profile_project($post,$files,$p){
				$num = $post['num11'];
				$student_ = '';
				$i = '1';
				while($i <= $num){
					$student_[$i] = $post['student_'.$i.''];
					$i++;
				}
						$group_grade = $post['group_grade'];
						$advisor_1 = $post['advisor_1'];
				 		$advisor_2 = $post['advisor_2'];	
						$last_g_id =  $p;
						$app_name=$post['app_name'] ;
						$app_file = $files['app_file']  ;
					    $app_doc = $files['app_doc'] ;
					    $logo = $files['logo_file'] ;
					    $scr_1 = $files['screen_file1'];
						$scr_2 =$files['screen_file2'];
						$scr_3 =$files['screen_file3'];
						$clip =$post['clip_show'];
						$detail =$post['app_detail'];
						$tag = $post['app_tag'];
						$time = $post['time'];
						$version = $post['app_version'];
						$system = $post['app_system'];
						$field = $post['app_field'];
						$time = $post['dateInput'];
						$error = "";
						//echo $detail;
				$db = new database($GLOBALS['config']);
				
				
					//print_r ($logo);
				////---------------------------------debug name_app-----------------//////////////
						if(($app_name == '')){
							echo "กรุณากรอกชื่อแอปพลิเคชั่น";
							die();
						}
				
				///------------------------------------end debug name_app---------------//////////////
				
				
				
				
				////---------------------------------debug tag_app-----------------//////////////
						if($tag == '0'){
							echo "กรุณาเลือกประเภทของแอปพลิเคชั่น";
							die();
						}
				
				///------------------------------------end debug tag_app---------------//////////////
				
				
				//// time
				 if($time == ''){
					 		echo "กรุณากรอกวันที่แก้ไข";
							die();
					 }
				
				
				
					////--------------------------------debug detail-----------------//////////////
						if($detail == ''){
							echo "กรุณากรอกข้อมูลรายละเอียด";
							die();
						}
				
				///------------------------------------end debug detail_app---------------//////////////
				////// clip
									if($clip == ''){
										echo "กรุณากรอกข้อมูลคลิป";
										die();	
									}
								if($clip != ''){	
										 $str = split("/",$clip);
										 $youtube=$str[3];
									//$youtube  =	" <iframe width='360' height='230' src='http://www.youtube.com/embed/".$you."'></iframe>"  ; 
										 //$clip_path="<iframe width='360' height='230' src='http://www.youtube.com/embed/".$youtube."'></iframe>";	
										//echo "<iframe width='360' height='230' src='http://www.youtube.com/embed/".$youtube."'></iframe>";							 
									}
								///////end clip
			/////----------------------------
			
								// student Same 
									for($i=1 ; $i <= $num ; $i++){
											for($o=1 ; $o<=$num ; $o++){
												if($i == $o){
														
												}else{
													if($student_[$i] == $student_[$o])
													 $error = $error.'นิสิตช่องที่ '.$i.  'ซ้ำกับนิสิตช่องที่'.$o." \n";
													
												}
												 break;	
											}
										
									}
									 //Send error if some of student
										if($error!=''){
											
											echo $error;
											die();
										}
										
										
										
									//IS Student Read?
										
									for($i=1 ; $i <= $num ; $i++){
                                            //echo $student_[$i];
                                            if($student_[$i] == ''){
                                                $error = $error. "กรุณากรอกชื่อผู้บัญชีผู้ใช้งานให้ครบตามช่อง";
                                            	
                                            }
                                            
                                            if($student_[$i] != ''){
                                                    $check_stu = $db->query("select * from student where s_id = "."'".$student_[$i]."'");
                                                    $row = mysql_num_rows($check_stu);
                                                    
                                                    if($row != 1){
                                                        $error = $error.'นิสิตช่องที่ '.$i."  ไม่มีอยู่ในฐานข้อมูล \n";
                                                    	
													}
											}
										
											
											
								
											// IS STUDENT GROUP
											if($student_[$i] != ''){
												$check_stu = $db->query("select * from student where s_id = "."'".$student_[$i]."'");
												$row = mysql_fetch_assoc($check_stu);
												
												if($row['s_g_id']!=0 && $row['s_g_id']!= $last_g_id){
													$error = $error.'นิสิตช่องที่ '.$i." มีกลุ่มแล้ว  \n";
												}
											}
									}
									
									  //Send error if some of student
										if($error!=''){
											
											echo $error;
											die();
										}
										
										
										
									//check id student && update
									
									for($i=1 ; $i <= $num ; $i++){
										
											if($student_[$i] != ''){
												
												$ress = $db -> query(
												"SELECT * FROM `project` . `student`
												WHERE `s_g_id` = '".$last_g_id."' AND  `s_position` = '".$i."'
												");	
												$rowss = mysql_fetch_array($ress);
												$ss_id = $rowss['s_id'];
												if(strcmp($student_[$i],$ss_id) != 0){
													$db->query("
														UPDATE  `project`.`student` SET  
														`s_g_id` = '0',
														`s_position` = '0'
														 WHERE  `student`.`s_id` ='".$ss_id."' LIMIT 1 ;"); 
													
													
													$db->query("
														UPDATE  `project`.`student` SET  
														`s_g_id` = ".$last_g_id.",
														`s_position` = ".$i."
														 WHERE  `student`.`s_id` ='".$student_[$i]."' LIMIT 1 ;"); 
													}
											}
									}
									    
                                     //Send error if some of student
										if($error!=''){
											
											echo $error;
											die();
										}
										
								///--------------------update group--------------------//////
				
									if($error == ''){
									
										$db->query("
										UPDATE  `project`.`group` SET 
										`g_a_id1` 	= '".$advisor_1."',
										`g_a_id2` 	= '".$advisor_2."',
										`g_grade` 	= '".$group_grade."'
										 WHERE  `group`.`g_id` ='".$last_g_id."' LIMIT 1 ;");
									}	
										
	
											if ($app_file["size"] > $GLOBALS['max_file_size'])
											 $error = $error."ขนาดของไฟล์โปรแกรมใหญ่เกินไป \n";
											
											if(!in_array($app_file["type"],$GLOBALS['allow_file_type_app']))
												$error = $error."ชนิดของไฟล์โปรแกรมไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($app_file['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$last_g_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$app_path=$row["app_path"];
												//echo $path_scr_1;
												
												//---Delete scr 1 in folder
												@unlink ($app_path);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$app_file["tmp_name"],
													"application/app/".$last_g_id."/" . $app_file["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											
											
											
											
												//collet upload file path	
												$path = "application/app/".$last_g_id."/" . $app_file["name"];
											
												//Update last app with new data
										
										
									
									if($app_file['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													
													`app_path` = '".$path."'
													
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
										//echo $scr_file_1;	
									
										//-------------------------------------------------END UPdate app_file---------------------------------------
				
				
				///---------------------------------------update app_doc-------------------------------------------
	
												if ($app_doc["size"] > $GLOBALS['max_file_doc_size'])
											 $error = $error."ขนาดของไฟล์เอกสารใหญ่เกินไป \n";
											
											if(!in_array($app_doc["type"],$GLOBALS['allow_file_doc_type_app']))
												$error = $error."ชนิดของไฟล์เอกสารไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($app_doc['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$last_g_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$app_path=$row["app_doc"];
												//echo $path_scr_1;
												
												//---Delete scr 1 in folder
												@unlink ($app_path);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$app_doc["tmp_name"],
													"application/doc/".$last_g_id."/" . $app_doc["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											
											
											
											
												//collet upload file path	
												$path = "application/doc/".$last_g_id."/" . $app_doc["name"];
											
												//Update last app with new data
										
										
									
									if($app_doc['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													
													`app_doc` = '".$path."'
													
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
										//echo $scr_file_1;	
									
										//-------------------------------------------------END UPdate app_doc---------------------------------------
				
				///---------------------------------------update logo-------------------------------------------
	
											if ($logo["size"] > $GLOBALS['max_file_logo_size'])
											 $error = $error."ขนาดของรูปภาพสัญลักษณ์ใหญ่เกินไป \n";
											
											if(!in_array($logo["type"],$GLOBALS['allow_file_type_pic']))
												$error = $error."ชนิดของรูปภาพสัญลักษณ์ไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												//echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($logo['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$last_g_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$logo_path=$row["app_logo"];
												//echo $logo;
												
												//---Delete scr 1 in folder
												@unlink($logo_path);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$logo["tmp_name"],
													"application/logo/".$last_g_id."/" . $logo["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											//print_r ($logo);
											
											
											
												//collet upload file path	
												$path = "application/logo/".$last_g_id."/" . $logo["name"];
											
												//Update last app with new data
										
										
									
									if($logo['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_logo` = '".$path."'
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
									
										//-------------------------------------------------END UPdate logo---------------------------------------
										
				
				
									///---------------------------------------update scr_1-------------------------------------------
	
											if ($scr_1["size"] > $GLOBALS['max_file_logo_size'])
											 $error = $error."ขนาดของรูปภาพประกอบ 1 ใหญ่เกินไป \n";
											
											if(!in_array($scr_1["type"],$GLOBALS['allow_file_type_pic']))
												$error = $error."ชนิดของรูปภาพประกอบ 1  ไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												//echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($scr_1['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$last_g_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$path_scr_1=$row["app_scr_1"];
												//echo $logo;
												
												//---Delete scr 1 in folder
												@unlink($path_scr_1);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$scr_1["tmp_name"],
													"application/scr/".$last_g_id."/" . $scr_1["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											//print_r ($logo);
											
											
											
												//collet upload file path	
												$path = "application/scr/".$last_g_id."/" . $scr_1["name"];
											
												//Update last app with new data
										
										
									
									if($scr_1['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_scr_1` = '".$path."'
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
									
										//-------------------------------------------------END UPdate scr_1---------------------------------------
										
				
				
						///---------------------------------------update scr_2-------------------------------------------
	
											if ($scr_2["size"] > $GLOBALS['max_file_logo_size'])
											 $error = $error."ขนาดของรูปภาพประกอบ 2 ใหญ่เกินไป \n";
											
											if(!in_array($scr_2["type"],$GLOBALS['allow_file_type_pic']))
												$error = $error."ชนิดของรูปภาพประกอบ 2 ไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												//echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($scr_2['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$last_g_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$path_scr_2=$row["app_scr_2"];
												//echo $logo;
												
												//---Delete scr 1 in folder
												@unlink($path_scr_2);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$scr_2["tmp_name"],
													"application/scr/".$last_g_id."/" . $scr_2["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											//print_r ($logo);
											
											
											
												//collet upload file path	
												$path = "application/scr/".$last_g_id."/" . $scr_2["name"];
											
												//Update last app with new data
										
										
									
									if($scr_2['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_scr_2` = '".$path."'
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
									
										//-------------------------------------------------END UPdate scr_2---------------------------------------
									
									
									///---------------------------------------update scr_3-------------------------------------------
	
											if ($scr_3["size"] > $GLOBALS['max_file_logo_size'])
											 $error = $error."ขนาดของรูปภาพประกอบ 3 ใหญ่เกินไป \n";
											
											if(!in_array($scr_3["type"],$GLOBALS['allow_file_type_pic']))
												$error = $error."ชนิดของรูปภาพประกอบ 3  ไม่ถูกต้อง \n";
											
												///// debug error
											if($error!=''){
												
												//echo $error;
												die();
											}
											//if($scr_file_1['error']== 4){echo 'aaaa';} 
											//echo $scr_file_1;
										if($scr_3['error'] == 0){	
											/// Select scr
											$res = $db -> query(
												"SELECT * FROM `project` . `application`
												WHERE 
												`app_g_id` = '".$last_g_id."'
												");	
												
												$row = mysql_fetch_array($res);
												$path_scr_3=$row["app_scr_3"];
												//echo $logo;
												
												//---Delete scr 1 in folder
												@unlink($path_scr_3);
										}
											//$_POST['g_id']
											

												move_uploaded_file(
													$scr_3["tmp_name"],
													"application/scr/".$last_g_id."/" . $scr_3["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											//print_r ($logo);
											
											
											
												//collet upload file path	
												$path = "application/scr/".$last_g_id."/" . $scr_3["name"];
											
												//Update last app with new data
										
										
									
									if($scr_3['error'] == 0){		
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_scr_3` = '".$path."'
													 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
									}
									
										//-------------------------------------------------END UPdate scr_3---------------------------------------
											
										
										
									
				
				
				
				///--------------------update app--------------------//////
				
					$db->query("
					UPDATE  `project`.`application` SET 
					`app_name` 	= '".$app_name."',
					`app_detail` 	= '".$detail."',
					`app_tag` 		= '".$tag."',
					`app_system` 	= '".$system."',
					`app_version` 		= '".$version."',
					`app_field` 		= '".$field."',
					`app_clip` 		= '".$youtube."',
					`app_time` = '".$time."'
					 WHERE  `application`.`app_g_id` ='".$last_g_id."' LIMIT 1 ;");
				echo "แก้ไขเสร็จเรียบร้อย";
			}
		
			
	public function add_user_admin($post){
			$db = new database($GLOBALS['config']);
				
				
				switch($post['type']){
					////////debug  ID
					case 'x':
					if($post['id'] == '' || $post['id'] == 'x_'){
						 echo 'กรุณาหรอกชื่อบัญชีผู้ใช้';
						die();
						}
					if($post['id'] != ''){
							$res = $db -> query(
							"SELECT * FROM `project` . `admin`
							WHERE `x_id` = '".$post['id']."'
							");	
							$row = mysql_fetch_array($res);
							if($row >= '1'){
								echo "ชื่อบัญชีผู้ใช้นี้มีผู้ลงทะเบียนแล้ว กรุณากรอกใหม่";
								die();
								}
						}
					//////////////////
					/////////////debug pass
					
					if($post['pass'] == ''){
						 echo 'กรุณาหรอกรหัสผ่าน';
						die();
						}
					////////////////////
					
						/////////debug email
						
						if($post['email'] != ''){
						 if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $post['email'])){ 
						 	echo "กรุณาตรวจสอบรูปแบบอีเมลล์";
							die();
						 }
						}else{
							echo "กรุณากรอกอีเมลล์";
							die();
							}	
						
						//////////////////
							$result = $result = $db->query(
									"INSERT INTO `project`.`admin`(
									`x_id`			,
									`x_pass`		,
									`x_name`		,
									`x_tel`			,
									`x_email`		,
									`x_address`		,
									`x_sex`			,
									`x_birthday`
									)
									VALUES(	
											'".$post['id']."', '".$post['pass']."', '".$post['name']."', '".$post['tel']."','".$post['email']."','".$post['address']."','".$post['sex']."','".$post['dateInput']."' 
									);");
									
					break;
						////////debug  ID
					case 's':
					if($post['id'] == '' || $post['id'] == 's_'){
						 echo 'กรุณาหรอกชื่อบัญชีผู้ใช้';
						die();
						}
					if($post['id'] != ''){
							$res = $db -> query(
							"SELECT * FROM `project` . `student`
							WHERE `s_id` = '".$post['id']."'
							");	
							$row = mysql_fetch_array($res);
							if($row >= '1'){
								echo "ชื่อบัญชีผู้ใช้นี้มีผู้ลงทะเบียนแล้ว กรุณากรอกใหม่";
								die();
								}
						}
					//////////////////
					/////////////debug pass
					
					if($post['pass'] == ''){
						 echo 'กรุณาหรอกรหัสผ่าน';
						die();
						}
					////////////////////
					/////////////debug field
					if($post['field'] == 'N/A'){
						 echo 'กรุณาเลือกสาขาวิชา';
						die();
						}
					
					///////////////////////
					/////////////debug grade
					if($post['grade'] == ''){
						 echo 'กรุณากรอกปีการศึกษา';
						die();
						}
					
					///////////////////////
					/////////debug email
						
						if($post['email'] != ''){
						 if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $post['email'])){ 
						 	echo "กรุณาตรวจสอบรูปแบบอีเมลล์";
							die();
						 }
						}else{
							echo "กรุณากรอกอีเมลล์";
							die();
							}	
						
						//////////////////
							$result = $db->query(
									"INSERT INTO `project`.`student`(
									`s_id`			,
									`s_pass`		,
									`s_name`		,
									`s_tel`			,
									`s_email`		,
									`s_address`		,
									`s_sex`			,
									`s_grade`		,
									`s_f_id`		,
									`s_birthday`
									)
									VALUES(	
											'".$post['id']."', '".$post['pass']."', '".$post['name']."', '".$post['tel']."','".$post['email']."','".$post['address']."','".$post['sex']."','".$post['grade']."','".$post['field']."','".$post['dateInput']."' 
									);");
									
					break;
					case 'a':
						if($post['id'] == '' || $post['id'] == 'a_'){
						 echo 'กรุณาหรอกชื่อบัญชีผู้ใช้';
						die();
						}
					if($post['id'] != ''){
							$res = $db -> query(
							"SELECT * FROM `project` . `advisor`
							WHERE `a_id` = '".$post['id']."'
							");	
							$row = mysql_fetch_array($res);
							if($row >= '1'){
								echo "ชื่อบัญชีผู้ใช้นี้มีผู้ลงทะเบียนแล้ว กรุณากรอกใหม่";
								die();
								}
						}
					//////////////////
					/////////////debug pass
					
					if($post['pass'] == ''){
						 echo 'กรุณาหรอกรหัสผ่าน';
						die();
						}
					////////////////////
					/////////////debug field
					if($post['field'] == 'N/A'){
						 echo 'กรุณาเลือกสาขาวิชา';
						die();
						}
					
					///////////////////////
					/////////debug email
						
						if($post['email'] != ''){
						 if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $post['email'])){ 
						 	echo "กรุณาตรวจสอบรูปแบบอีเมลล์";
							die();
						 }
						}else{
							echo "กรุณากรอกอีเมลล์";
							die();
							}	
						
						//////////////////
					
							$result = $db->query(
									"INSERT INTO `project`.`advisor`(
									`a_id`			,
									`a_pass`		,
									`a_name`		,
									`a_tel`			,
									`a_email`		,
									`a_address`		,
									`a_sex`			,
									`a_f_id`		,
									`a_birthday`
									)
									VALUES(	
											'".$post['id']."', '".$post['pass']."', '".$post['name']."', '".$post['tel']."','".$post['email']."','".$post['address']."','".$post['sex']."','".$post['field']."','".$post['dateInput']."' 
									);");
									
				
					break;
					
				}
				
				$db->close();
				echo "ลงทะเบียนเสร็จเรียบร้อยเรียบร้อย";
			}
			
	public function add_project($post , $files){
				
				$num = $post['num'];
				$student_ = '';
				$i = '1';
				while($i <= $num){
					$student_[$i] = $post['student_'.$i.''];
					$i++;
					}
				$ii = '1';	
				while($ii <= $num){
					$student_name_[$ii] = $post['student_name_'.$ii.''];
					$ii++;
					}	
				
				$advisor_1 = $post['advisor_1'];
				$advisor_2 = $post['advisor_2'];
				$app_name = $post['app_name'];
				$app_file = $files['app_file'];
				$app_doc = $files['app_doc'];
				$logo_file = $files['logo_file'];
				$scr_file_1 = $files['scr_file_1'];
				$scr_file_2 = $files['scr_file_2'];
				$scr_file_3 = $files['scr_file_3'];
				$clip = $post['clip_show'];
				$detail = $post['de'];
				$app_tag = $post['app_tag'];
				$group_grade = $post['group_grade'];
				$system = $post['app_system']; 
				$version =$post['version'];
				$field =$post['app_field'];
				$time = $post['dateInput'];
				
		
									$db = new database($GLOBALS['config']);
									$error = "";
									/******Start Input Data Validation********/
						
						if($time == ''){
							echo "กรุณาเลือกวันนี้อัพโหลด";
							die();
							}
								// student Same 
									for($i=1 ; $i <= $num ; $i++){
											for($o=1 ; $o<=$num ; $o++){
												if($i == $o){
														
												}else{
													if($student_[$i] == $student_[$o])
													 $error = $error.'นิสิตช่องที่ '.$i.  'ซ้ำกับนิสิตช่องที่'.$o." \n";
													 break;
												}
												 break;	
											}
									if($student_name_[$i] == ''){
											$error = $error. "กรุณากรอก ชื่อ-สกุล ให้ครบตามช่อง";
										}	
									}
									
								 //Send error if some of student
										if($error!=''){
											
											echo $error;
											die();
										}
								
								for($i=1 ; $i <= $num ; $i++){
										//echo $student_[$i];
										if($student_[$i] == ''){
											$error = $error. "กรุณากรอกรหัสประจำตัวให้ครบตามช่อง";
										
										}
										
										//IS Student Read?
										if($student_[$i] != ''){
												$check_stu = $db->query("select * from student where s_id = "."'s_".$student_[$i]."'");
												$row = mysql_num_rows($check_stu);
												
												if($row == 1){
													$error = $error.'รหัสนิสิตช่องที่ '.$i."  ใช้ลงทะเบียนแล้ว \n";
												}
												
										}

												//Send error if some of student
										if($error!=''){
											
											echo $error;
											die();
										}
										
										
										
										//Send error if some student grouped
										if($error!=''){
												echo $error."นิสิตที่ท่านเลือกมีปัญหา โปรดติดต่อสอบถามผู้ดูแลระบบ";	
												die();		
										}
								}
								
							
									// Name app
									
									if($app_name == ''){
									
											echo "กรุณา กรอก ชื่อแอปพลิเคชั่น";
											die();	
									}
									//check src
								
									if($scr_file_1["error"] != 0 && $scr_file_2["error"] != 0 && $scr_file_3["error"] != 0){
										echo "กรุณาใส่ screen shot อย่างน้อย 1 ช่อง"."\n";
										die();
				
									}
									
									//type_app
									
									if($app_tag == '0'){
										echo "กรุณาเลือกประเภทของ แอปพลิเคชั่นด้วย";
										die();
									}
									
									
									//app detail
									
									if($detail == ''){
										echo "กรุณากรอกข้อมูลเบื้องต้นที่เกี่ยวกับแอปพลิเคชั่นด้วย";
										die();
									}
									
									//group_grade
														
								if($group_grade == ''){
										echo "กรุณากรอกรหัสชั้นปีของกลุ่มนิสิต";
										die();
									}
								
								// end group_grade
								
								//group_type
														
								if($type == '0'){
										echo "กรุณาเลือกสาขาของกลุ่มนิสิต";
										die();
									}
								
								// end group_type
								
									//advisor
										
								//////Up load app
								////// clip
									if($clip == ''){
										echo "กรุณากรอกข้อมูลคลิป";
										die();	
									}
								if($clip != ''){	
										 $str = split("/",$clip);
										 $youtube=$str[3];
										 //$clip_path="<iframe width='360' height='230' src='http://www.youtube.com/embed/".$youtube."'></iframe>";	
										//echo "<iframe width='360' height='230' src='http://www.youtube.com/embed/".$youtube."'></iframe>";							 
									}
								///////end clip
								
								//////Up load app
								
								
								if ($app_file["size"] > $GLOBALS['max_file_size'])
									 $error = $error."ขนาดของไฟล์แอปพลิเคชั่นใหญ่เกินไป \n";
									
								if(!in_array($app_file["type"],$GLOBALS['allow_file_type_app']))
									$error = $error."ชนิดของไฟล์แอปพลิเคชั่นไม่ถูกต้อง \n";
									
								if($app_file["error"] != 0 )
									$error = $error."กรุณาใส่ไฟล์แอปพลิเคชั่น"." \n";
									
									
								//////Up load document
								
								
								if ($app_doc["size"] > $GLOBALS['max_file_size'])
									 $error = $error."ขนาดของไฟล์เอกสารใหญ่เกินไป \n";
									
								if(!in_array($app_doc["type"],$GLOBALS['allow_file_type_app']))
									$error = $error."ชนิดของไฟล์เอกสารไม่ถูกต้อง \n";
									
								if($app_doc["error"] != 0 )
									$error = $error."กรุณาใส่ไฟล์เอกสาร"." \n";	
									
									
									////////Upload logo
								
								if ($logo_file["size"] > $GLOBALS['max_file_logo_size'])
									 $error = $error."ขนาดของรูปภาพสัญลักษณ์ใหญ่เกินไป \n";
									
								if(!in_array($logo_file["type"],$GLOBALS['allow_file_type_pic']))
									$error = $error."ชนิดของูปภาพสัญลักษณ์ไม่ถูกต้อง\n";
									
								if($logo_file["error"] != 0 )
									$error = $error."กรุณาใสู่ปภาพสัญลักษณ์"." \n";
								
										//Upload scr 1
								
								if ($scr_file_1["size"] > $GLOBALS['max_file_logo_size'])
									 $error = $error."ขนาดของรูปภาพประกอบ 1 ใหญ่เกินไป \n";
									
								if(!in_array($scr_file_1["type"],$GLOBALS['allow_file_type_pic']))
									$error = $error."ชนิดของูรูปภาพประกอบ 1 ไม่ถูกต้อง \n";
									
							
									
										//Upload scr 2
								
								if ($scr_file_2["size"] > $GLOBALS['max_file_logo_size'])
									 $error = $error."ขนาดของูรูููปภาพประกอบ 2 ใหญ่เกินไป \n";
									
								if(!in_array($scr_file_2["type"],$GLOBALS['allow_file_type_pic']))
									$error = $error."ชนิดของรูููปภาพประกอบ 2 ไม่ถูกต้อง \n";
									
								
									
									
										//Upload scr 3
								
								if ($scr_file_3["size"] > $GLOBALS['max_file_logo_size'])
									 $error = $error."ขนาดของรูููปภาพประกอบ 3 ใหญ่เกินไป \n";
									
								if(!in_array($scr_file_3["type"],$GLOBALS['allow_file_type_pic']))
									$error = $error."ชนิดของรูููปภาพประกอบ 3 ไม่ถูกต้อง \n";
									
									//Send error if file not valid
									if($error!=''){
										
										echo $error;
										die();
									}
								
										
										//*********************8END INPUT VAKIDATION************************//
										
										

										
										//*******************************************Insert app to db************************************************//	
										
										//$_SESSION['user']->grp($_POST['app_id'] , $_POST['app_name_th'] , $_POST['app_name_en']);
										
										$db->query(
										 
										"INSERT INTO  `project`.`application` (
											`app_id` ,
											`app_name` ,
											`app_tag` ,
											`app_field` ,
											`app_time` ,
											`app_system` ,
											`app_clip` ,
											`app_detail`
											)
											VALUES (
											NULL ,'".$app_name."' , '".$app_tag."' , '".$field."' , '".$time."' , '".$system."', '".$youtube."' , '".$detail."'
											);");
											
											
											
											
										
										
											//****Collect Last insert id**//
													
												$last_app_id = mysql_insert_id();
												
												//echo $last_app_id;
												//insert version
											$db->query("
												UPDATE  `project`.`application` SET  
												`app_version` = ".$version."
												 WHERE  `application`.`app_id` ='".$last_app_id."' LIMIT 1 ;");
										
											
											
											// ***********Insert group to db**************//
										
										//$_SESSION['user']->grp(NULL  , $last_app_id , $_POST['student_1'] , $_POST['student_2'] , $_POST['student_3'] 
															//	, $_POST['advisor_1'] , $_POST['advisor_2']);	
											
											
											$db->query("
												INSERT INTO  `project`.`group` (
															`g_id` ,
															`g_app_id` ,
															`g_grade` ,
															`g_a_id1` ,
															`g_a_id2` 
															
														)
														VALUES (
																	NULL ,  
																  ".$last_app_id.			" , 
																  '".$group_grade.  "' ,
																  '".$advisor_1.	"' , 
																  '".$advisor_2.	"' 
																  
												);");
									
											
											
											//****Collect Last insert id**//			
											$last_g_id =  mysql_insert_id();
											
											
											
											///---------------------------------------/UP  APP-------------------------------------------
											//$_POST['g_id']
											if(!file_exists("application/app/".$last_g_id."") )
											{
												 //echo "Folder not exist! Create new folder";
												mkdir("application/app/".$last_g_id."");
											}
											
											
											
											
										
											if (file_exists("application/app/".$last_g_id."/" . $app_file["name"]))
											{
												//echo $app_file["name"] . " already exists. ";
											}
											else
											{
												move_uploaded_file(
													$app_file["tmp_name"],
													"application/app/".$last_g_id."/" . $app_file["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											}
											
											
											
												//collet upload file path	
												$path = "application/app/".$last_g_id."/" . $app_file["name"];
											
												//Update last app with new data
										
												$db->query("
												UPDATE  `project`.`application` SET  
												`app_g_id` = ".$last_g_id.",
												`app_path` = '".$path."',
												`app_time` = NOW( )
												 WHERE  `application`.`app_id` ='".$last_app_id."' LIMIT 1 ;");
											 
										//-------------------------------------------------END UP APP---------------------------------------
										
										///---------------------------------------/UP  DOCUMENT-------------------------------------------
											//$_POST['g_id']
											if(!file_exists("application/doc/".$last_g_id."") )
											{
												 //echo "Folder not exist! Create new folder";
												mkdir("application/doc/".$last_g_id."");
											}
											
											
											
											
										
											if (file_exists("application/doc/".$last_g_id."/" . $app_doc["name"]))
											{
												//echo $app_file["name"] . " already exists. ";
											}
											else
											{
												move_uploaded_file(
													$app_doc["tmp_name"],
													"application/doc/".$last_g_id."/" . $app_doc["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											}
											
											
											
												//collet upload file path	
												$path = "application/doc/".$last_g_id."/" . $app_doc["name"];
											
												//Update last app with new data
										
												$db->query("
												UPDATE  `project`.`application` SET  
												`app_g_id` = ".$last_g_id.",
												`app_doc` = '".$path."'
												
												 WHERE  `application`.`app_id` ='".$last_app_id."' LIMIT 1 ;");
											 
										//-------------------------------------------------END UP DOCUMENT---------------------------------------
										
										
										
												
												///-------------------------------UP  LOGO APP---------------------------------
												
										
											//$_POST['g_id']
											if(!file_exists("application/logo/".$last_g_id.""))
											{
												 //echo "Folder not exist! Create new folder";
												mkdir("application/logo/".$last_g_id."");
											}
		
											if (file_exists("application/logo/".$last_g_id."/" . $logo_file["name"]))
											{
												echo $logo_file["name"] . " already exists. ";
											}
											else
											{
												move_uploaded_file(
													$logo_file["tmp_name"],
													"application/logo/".$last_g_id."/" . $logo_file["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											}
											
						
												//collet upload file path	
									
												
												$path = "application/logo/".$last_g_id."/" . $logo_file["name"];
											
												//Update last app with new data
										
												$db->query("
												UPDATE  `project`.`application` SET  
												`app_g_id` = ".$last_g_id.",
												`app_logo` = '".$path."'
												
												 WHERE  `application`.`app_id` ='".$last_app_id."' LIMIT 1 ;");
											 
										///---------------------------------------END UP LOGO----------------------------------------*/
										
										///---------------------------------------/UP  scr1-------------------------------------------
				
				
											//$_POST['g_id']
											if(!file_exists("application/scr/".$last_g_id."") )
											{
												 //echo "Folder not exist! Create new folder";
												mkdir("application/scr/".$last_g_id."");
											}
	
										
												move_uploaded_file(
													$scr_file_1["tmp_name"],
													"application/scr/".$last_g_id."/" . $scr_file_1["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											
											
											
											
												//collet upload file path	
												$path = "application/scr/".$last_g_id."/" . $scr_file_1["name"];
											
												//Update last app with new data
										
										
									
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_g_id` = ".$last_g_id.",
													`app_scr_1` = '".$path."'
													
													 WHERE  `application`.`app_id` ='".$last_app_id."' LIMIT 1 ;");
											 
											
										//-------------------------------------------------END UP scr1---------------------------------------
										
										///---------------------------------------/UP  scr2-------------------------------------------
				
				
											//$_POST['g_id']
											if(!file_exists("application/scr/".$last_g_id."") )
											{
												 //echo "Folder not exist! Create new folder";
												mkdir("application/scr/".$last_g_id."");
											}
											
											
											
											
										

												move_uploaded_file(
													$scr_file_2["tmp_name"],
													"application/scr/".$last_g_id."/" . $scr_file_2["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
										
											
											
												//collet upload file path	
												$path = "application/scr/".$last_g_id."/" . $scr_file_2["name"];
											
												//Update last app with new data
										
										
									
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_g_id` = ".$last_g_id.",
													`app_scr_2` = '".$path."'
													
													 WHERE  `application`.`app_id` ='".$last_app_id."' LIMIT 1 ;");
											 
											
										//-------------------------------------------------END UP scr2---------------------------------------
										
										
										///---------------------------------------/UP  scr3-------------------------------------------
				
				
											//$_POST['g_id']
											if(!file_exists("application/scr/".$last_g_id."") )
											{
												 //echo "Folder not exist! Create new folder";
												mkdir("application/scr/".$last_g_id."");
											}
											
											
										

												move_uploaded_file(
													$scr_file_3["tmp_name"],
													"application/scr/".$last_g_id."/" . $scr_file_3["name"]);
												//echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
											
											
											
											
												//collet upload file path	
												$path = "application/scr/".$last_g_id."/" . $scr_file_3["name"];
											
												//Update last app with new data
										
										
									
												$db->query("
													UPDATE  `project`.`application` SET  
													`app_g_id` = ".$last_g_id.",
													`app_scr_3` = '".$path."'
													
													 WHERE  `application`.`app_id` ='".$last_app_id."' LIMIT 1 ;");
											 
											
										//-------------------------------------------------END UP scr3---------------------------------------
										
											
											
									
												//insert Student  group
										for($i=1 ; $i <= $num ; $i++){
											$id= "s_".$student_[$i];
											$pass = "1234";
												if($student_[$i] != ''){
													$db->query("
												INSERT INTO  `project`.`student` (
															`s_id` ,
															`s_pass` ,
															`s_name` ,
															`s_g_id` ,
															`s_position` 
															
															
														)
														VALUES (
																  '".$id.	"' ,  
																  '".$pass.	"' , 
																  '".$student_name_[$i].  "' ,
																  '".$last_g_id.	"' , 
																  '".$i.	"' 
																  
												);");
									
												}
										}
												 Echo "สร้างกลุ่มเสร็จเรียบร้อย";			

										
										

	}		
	
	
		
	public function delete_profile_app($a){
			$app_g_id = $a;
				$b='0';
				//echo $a , $app_g_id;
			$db = new database($GLOBALS['config']);
			
					  		 $res = $db -> query(
							"SELECT * FROM `project` . `application`
							WHERE `app_g_id` = '".$app_g_id."'
							");	
							$row = mysql_fetch_array($res);
							$app_id = $row['app_id'];
							$app_name = $row['app_name'];
							$app_logo = $row['app_logo'];
							$app_path = $row['app_path'];
							$app_doc = $row['app_doc'];
								$app_scr_ = '';
								$ii = '1';
								while($ii <= '3'){
									$app_scr_[$ii] = $row['app_scr_'.$ii.''];
									$ii++;
								}
							$db->close();
						 	 		 	 	
										
			if($app_g_id != ''){
				$db = new database($GLOBALS['config']);
				
				
		//// delete folder file app
				if(file_exists("application/app/".$app_g_id."") )
					{	
						 $str = split("/",$app_path);
						 $name=$str[3];
						if($name != ''){
							@unlink($app_path);
							rmdir("application/app/".$app_g_id."");
						}
					}	
		///// end 		delete folder file app
		
		//// delete folder file doc
				if(file_exists("application/doc/".$app_g_id."") )
					{
						$str = split("/",$app_doc);
						 $name=$str[3];
						if($name != ''){
							@unlink($app_doc);
							rmdir("application/doc/".$app_g_id."");
						}
					}	
		///// end 		delete folder file doc
		
		//// delete folder file logo
				if(file_exists("application/logo/".$app_g_id."") )
					{
						$str = split("/",$app_logo);
						 $name=$str[3];
						if($name != ''){
							@unlink($app_logo);
							rmdir("application/logo/".$app_g_id."");
						}
					}	
		///// end 		delete folder file logo
		
		//// delete folder file scr
				if(file_exists("application/scr/".$app_g_id."") )
					{
						for($j=1;$j<=3;$j++){
							$str = split("/",$app_scr_[$j]);
							 $name=$str[3];
							if($name != ''){
								@unlink($app_scr_[$j]);
							}
						}
						rmdir("application/scr/".$app_g_id."");		
					}	
		///// end 		delete folder file scr
				
				$result = $db->query(
					"UPDATE  `student`SET  
					`s_g_id` 	=  '".$b.	"' ,
					`s_position` 	=  '".$b.	"'
					WHERE CONVERT(  `student`.`s_g_id` USING utf8 ) =  '".$app_g_id."' ;"
				
				);
				$db->query("DELETE FROM  `application`  WHERE `app_g_id` = '".$app_g_id."'");
			
				$db->query("DELETE FROM  `group`  WHERE `g_id` = '".$app_g_id."'");
				
				$db->query("DELETE FROM  `comment`  WHERE `com_app_id` = '".$app_id."'");
				
				$db->query("DELETE FROM  `vote` WHERE `v_app_id` = '".$app_id."'");
				$db->close();
				echo "ลบ".$app_name."ออกจากระบบสำเร็จ";
			}else{ echo "ระบบในการลบข้อมลูมีปัญหากรุณาแจ้งผู้ดูแลระบบ"; }
	}
		
	public function get_delete_comment($post){
		$db = new database($GLOBALS['config']);
		$a=$post['data'];
				$text = explode(" ",$a);
				
				//print_r($text);
				
				$query = "SELECT * from `application` WHERE 1=1";
		
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`app_name` LIKE 	'%".$i."%' OR ".
										"`app_tag` 	   LIKE 	'%".$i."%' OR ".
										"`app_detail`  LIKE 	'%".$i."%'    ".
										")";
									}
								}
								$res = $db->query($query);
							$rows = mysql_fetch_row($res);
						
						if($rows == '0'){
							echo "ไม่มีแอปพลิเคชั่นที่เกี่ยวกับข้อมูลนี้";
							die();
						}	
					
						
				//echo "<td></td>";
				$a = "";	
				$result = "<div class=delete_com><img src=img/delete_com.png></div>";
				$result .= "<table class=table_delete_com >";
				$result .= "<tr><td>ชื่อแอปพลิเคชั่น</td><td>ความคิดเห็น</td></tr>";
				while($row = mysql_fetch_array($res)){
							$path=$row["g_app_id"];
						//echo $path;
							//$db = new database($GLOBALS['config']);
								$a = $row['app_id'];
								$b = $row['app_g_id'];
								//$result .= "<tr><td>".$row2['app_id']."</td>";
								$result .= "<tr><td>".$row['app_name']."</td>";
								//$result .= "<td>".$row['app_name_en']."</td>";
								//$result .= "<td> <a href='.php?id=".$row2['app_id']."</td>"; 
								$result .= "<td><a href='javascript:load_delete_comment_admin($a);'>ชมความคิดเห็น</a></td></tr>";
								 ?>
                                 <link rel="stylesheet" type="text/css" href="css/main.css" />
								 <?php
								//$result .= "<td><br></br>".$row2['app_name_en']."</td></tr>";
						}
				$result.="</table>";
				echo $result;		
				$db->close();
								
		}
		
		public function show_delete_comment($id){
			$db = new database($GLOBALS['config']);
			$app_id = $id; 
				//$text = explode(" ",$app_id);
				
				//print_r($text);
				
				  $query = "SELECT * FROM `project` . `comment`
							WHERE `com_app_id` = '".$app_id."'
							";	
							$res = $db->query($query);
							$rows = mysql_fetch_row($res);
						
						if($rows == '0'){
							echo "ไม่มีความคิดเห็น";
							die();
						}		
					
						
				//echo "<td></td>";
				$a = "";	
				$result = "<div class=com_show><img src=img/com_show.png></div>";
				$result .= "<table class=table_show_com>";
				$result .= "<tr><td>ความคิดเห็น</td><td>บัญชีใช้ที่แสงความคิดเห็น</td><td>วัน และเวลา</td><td>ลบ</td></tr>";
				while($row = mysql_fetch_array($res)){
							//$path=$row["g_app_id"];
						//echo $path;
							//$db = new database($GLOBALS['config']);
								$a = $row['com_id'];
								//$b = $row['app_g_id'];
								//$result .= "<tr><td>".$row2['app_id']."</td>";
								$result .= "<tr><td>".$row['com_text']."</td>";
								$result .= "<td>".$row['com_u_id']."</td>";
								$result .= "<td>".$row['com_time']."</td>"; 
								$result .= "<td><a href='javascript:delete_comment_admin($a);'>ลบ</a></td></tr>";
								 ?>
                                 <link rel="stylesheet" type="text/css" href="css/main.css" />
								 <?php
								//$result .= "<td><br></br>".$row2['app_name_en']."</td></tr>";
							
						}
				$result.="</table>";
				echo $result;		
				$db->close();
								
		}
		
	public function delete_comment($id){
			$com_id = $id;
				$b='';
				//echo $a , $app_g_id;
			$db = new database($GLOBALS['config']);
			
					  	
						
		
			if($com_id != ''){
				$db = new database($GLOBALS['config']);
				$db->query("DELETE FROM  `comment`  WHERE `com_id` = '".$com_id."'");
			
				
				$db->close();
				echo "ลบความคิดเห็นออกจากระบบสำเร็จ";
			}else{ echo "ระบบในการลบข้อมลูมีปัญหากรุณาแจ้งผู้ดูแลระบบ"; }
	}	
	
	public function check_pass_member($post){
		$db = new database($GLOBALS['config']);
		$id = $post['id_member']; 
		$num = $post['num2']; 
		$sub_id = substr($id, 0, 2);
		 
		 $text = explode(" ",$id);
				
				//print_r($text);
		switch($sub_id){
			case "s_":	
				$query = "SELECT * from `student` WHERE 1=1";
		
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`s_id`  LIKE 	'%".$i."%'    ".
										")";
									}
								}
								$res = $db->query($query);
								$a = "";	
								$result = "<div class=delete_com><img src=img/delete_com.png></div>";
								$result .= "<table class=table_delete_com >";
								$result .= "<tr><td>ชื่อบัญชีผู้ใช้</td><td>ชื่อ-สกุล</td><td>แก้ไข</td></tr>";
								while($row = mysql_fetch_array($res)){
											//$path=$row["g_app_id"];
										//echo $path;?> <?
											//$db = new database($GLOBALS['config']);
												$a = $row['s_id'];
												$b = $row['s_pass'];
												$c = $a."/".$b."/".$num;
												//$result .= "<tr><td>".$row2['app_id']."</td>";
												$result .= "<tr><td>".$row['s_id']."</td>";
												$result .= "<td>".$row['s_name']."</td>";
												//$result .= "<td> <a href='.php?id=".$row2['app_id']."</td>"; 
												$result .= "<td><a href='javascript:get_table_pass($c);'>แก้ไข</a></td></tr>";
												 ?>
												 <link rel="stylesheet" type="text/css" href="css/main.css" />
												 <?php
												//$result .= "<td><br></br>".$row2['app_name_en']."</td></tr>";
										}
								$result.="</table>";
								echo $result;		
			 break;
			 case "a_":	
				$query = "SELECT * from `advisor` WHERE 1=1";
		
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`a_id`  LIKE 	'%".$i."%'    ".
										")";
									}
								}
								$res = $db->query($query);
								$a = "";	
								$result = "<div class=delete_com><img src=img/delete_com.png></div>";
								$result .= "<table class=table_delete_com >";
								$result .= "<tr><td>ชื่อบัญชีผู้ใช้</td><td>ชื่อ-สกุล</td><td>แก้ไข</td></tr>";
								while($row = mysql_fetch_array($res)){
											//$path=$row["g_app_id"];
										//echo $path;
											//$db = new database($GLOBALS['config']);
												//$a = $row['app_id'];
												//$b = $row['app_g_id'];
												//$result .= "<tr><td>".$row2['app_id']."</td>";
												$result .= "<tr><td>".$row['a_id']."</td>";
												$result .= "<td>".$row['a_name']."</td>";
												//$result .= "<td> <a href='.php?id=".$row2['app_id']."</td>"; 
												$result .= "<td><a href='javascript:load_delete_comment_admin($a);'>แก้ไข</a></td></tr>";
												 ?>
												 <link rel="stylesheet" type="text/css" href="css/main.css" />
												 <?php
												//$result .= "<td><br></br>".$row2['app_name_en']."</td></tr>";
										}
								$result.="</table>";
								echo $result;		
			 break;
			 case "x_":	
				$query = "SELECT * from `admin` WHERE 1=1";
		
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`x_id`  LIKE 	'%".$i."%'    ".
										")";
									}
								}
								$res = $db->query($query);
			 break;
			 default:
						 $query = "SELECT * from `member` WHERE 1=1";
		
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`m_id`  LIKE 	'%".$i."%'    ".
										")";
									}
								}
								$res = $db->query($query);
			 break;
		}
		
			
				$db->close();
		
		
	}
	
	public function update_pass($post){
			$pass_new1 = $post['pass_new1'];
			$pass_new2 = $post['pass_new2'];
			$id = $post['id'];
			$type = $post['type'];
				$db = new database($GLOBALS['config']);
				$error = "";
				
				if($pass_new1 == '' || $pass_new2 == ''){
					$error = $error."กรุณากรอกรหัสผ่าน";
				}
				
				
				//Send error if some of password
				if($error!=''){
					echo $error;
					die();
				}
				
				
				if(strcmp($pass_new1,$pass_new2) != 0){
					$error = $error."รหัสผ่านใหม่ไม่ตรงกัน กรุณาแก้ไข";
					
				}else{
					switch($type){
						case 'member':
							$db -> query(
								"UPDATE `member` SET
								`m_pass` = '".$pass_new1."'
								WHERE `m_id` = '".$id."';"
							);
						
						break;
						case 'student':
							$db -> query(
								"UPDATE `student` SET
								`s_pass` = '".$pass_new1."'
								WHERE `s_id` = '".$id."';"
							);
						
						break;
						case 'aadvisor':
							$db -> query(
								"UPDATE `advisor` SET
								`a_pass` = '".$pass_new1."'
								WHERE `a_id` = '".$id."';"
							);
						
						break;
						case 'admin':
							$db -> query(
								"UPDATE `admin` SET
								`x_pass` = '".$pass_new1."'
								WHERE `x_id` = '".$id."';"
							);
						
						break;
					
					}
				echo "แก้ไขเสร็จเรียบร้อย";	 
					
				}
				//Send error if some of password
				if($error!=''){
					echo $error;
					die();
				}
			$db->close();								
		
		}
	
}	
		
?>