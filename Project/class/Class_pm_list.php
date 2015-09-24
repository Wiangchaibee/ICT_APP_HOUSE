<?php 
	include_once "Class_database.php";
	include_once "Server_config.php";
	include_once "Class_pm.php";
	include_once "Class_user.php";
	session_start();

	class pm_list{
			
			private $pm_count;
			private $pm_list = Array();
			
			public function __get($name){
					return $this->$name;
			}
				
			public function __construct(){
				$admin = "admin";
					
				if($_SESSION['user']->id_type == 'x'){
					$db = new database($GLOBALS['config']);
						$res = $db -> query(
					"SELECT * FROM  `pm`
					WHERE `pm_re_u_id` ='".$admin."'
					ORDER BY `pm_time`  DESC
					");	
				}
				else{
					$db = new database($GLOBALS['config']);
						$res = $db -> query(
					"SELECT * FROM  `pm`
					WHERE `pm_re_u_id` = '".$_SESSION['user']->id."'
					ORDER BY `pm_time`  DESC
					");	
				}
					
				if($res)
					$this->pm_count = mysql_num_rows($res);
				else
					$this->pm_count = 0 ;	
					
					
					if($this->pm_count>0){
						$i = 0;
							while($row = mysql_fetch_assoc($res)){
								$this->pm_list[$i] = new pm($row);
								$i++;
								}
								
					};
		
			}	
			
			
				public function pm_update(){
					$admin = "admin";
					$db = new database($GLOBALS['config']);
					if($_SESSION['user']->id_type == 'x'){
							$res = $db -> query(
								"SELECT * FROM `project` . `pm`
								WHERE `pm_re_u_id` = '".$admin."'
								ORDER BY `pm_time`  DESC
								");	
								
										if($res)
										$this->pm_count = mysql_num_rows($res);
										else
										$this->pm_count = 0 ;	
										
										
										if($this->pm_count>0){
											$i = 0;
												while($row = mysql_fetch_assoc($res)){
													$this->pm_list[$i] = new pm($row);
													$i++;
										}
											
							};		
					}else{
						$res = $db -> query(
								"SELECT * FROM `project` . `pm`
								WHERE `pm_re_u_id` = '".$_SESSION['user']->id."'
								ORDER BY `pm_time`  DESC
								");	
								
										if($res)
										$this->pm_count = mysql_num_rows($res);
										else
										$this->pm_count = 0 ;	
										
										
										if($this->pm_count>0){
											$i = 0;
												while($row = mysql_fetch_assoc($res)){
													$this->pm_list[$i] = new pm($row);
													$i++;
										}
											
							};
					}			
			}	
			
			public function show_all(){
					for($i=0 ; $i<= $this->pm_count ; $i++){
						echo  $this->pm_list[$i];
					}
					
						
					
			}
			
	public function delete_pm($id){
		$pm_id = $id;
				$db = new database($GLOBALS['config']);
			if($pm_id != ''){
				$db = new database($GLOBALS['config']);
				$db->query("DELETE FROM  `pm`  WHERE `pm_id` = '".$pm_id."'");
				$db->close();
				echo "ลบข้อความออกจากระบบสำเร็จ";
			}else{ echo "ระบบในการลบข้อความูมีปัญหากรุณาแจ้งผู้ดูแลระบบ"; }
				
	}

					
}
	
?>