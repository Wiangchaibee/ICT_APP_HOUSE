<?php
	include_once "Class_database.php";
	include_once "Server_config.php";
	
	
	
	class login
	{
		private $u_id;
		private $result;
		private $valid;
		
			
		public function __construct($user,$pass){
			//echo $user,$pass,$id_type;
			
			
			
				$this->u_id = $user;
				$str=$_POST['user'];
				$str=substr($str,0,2);
				
				//Echo "Call Database";
				 //Call Database
				$db = new database($GLOBALS['config']);
				//Echo "End call";
				
				//Echo $id_type;
		if($str == 's_' || $str == 'a_' || $str == 'x_'){	
				switch($str)
					{
						
						
						case 's_':
							//Echo "This is student";
							//Echo student table
							//Echo "select * from student where s_id ="."'".$user."'"." AND s_pass ="."'".$pass."'";
						 	$this->result = $db->query("select * from student where s_id ="."'".$user."'"." AND s_pass ="."'".$pass."'");
						break;
						
						
						
						case 'a_':
							//Echo "This is advisor";
							//Echo advisor table
							//Echo "select * from advisor where a_id ="."'".$user."'"." AND a_pass ="."'".$pass."'";
						 	$this->result = $db->query("select * from advisor where a_id ="."'".$user."'"." AND a_pass ="."'".$pass."'");
						break;
						
						
						
						case 'x_':
							//Echo "This is admin";
							//echo "admin table";
							//echo  (mysql_num_rows(mysql_query ("select * from admin where x_id ="."'".$user."'"." AND x_pass ="."'".$pass."'")));die();
							
						 	$this->result = $db->query("select * from admin where x_id ='".$user."' AND x_pass ='".$pass."' ") or die (mysql_error());
							//var_dump($this->result);
					
						break;			
					}			
		}else{
				$this->result = $db->query("select * from member where m_id ="."'".$user."'"." AND m_pass ="."'".$pass."'");
			}
		
					
					
					//print_r ($this->result);
					//echo mysql_num_rows($this->result);die();
					if(mysql_num_rows($this->result) == 1)
				
							$this->valid = true;						
					else
						
							$this->valid = false;
							
					$this -> log();
						
			}
			public function is_valid()
				{
					
					
						return  $this->valid;
					
				}
				
				
				
			private function log(){
				
				$a;
				
				if($this->valid)
					$a= 'success';
				
				else
					$a = 'failed';
				
				$db = new database($GLOBALS['config']);
				
				$db ->query("
				INSERT INTO `project` . `login_log`(
				`l_log_id`,	
				`l_u_id`,
				`l_time`,
				`l_result`,
				`l_ip`
				)VALUES(
					'','".$this->u_id."', CURRENT_TIMESTAMP ,'".$a."' , '".$_SERVER['REMOTE_ADDR']."'
				)
				");
				
				
				}
	}
?>