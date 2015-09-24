<?php 
	include_once "Class_database.php";
	include_once "Server_config.php";


	class comment{
		
			private $id;
			private $app_id;
			private $u_id;
			private $u_vote;
			private $text;
			private $time;
			private $ip;
			
			public function __get($name){
					return $this->$name;
			}
			
			
			
			public function get_user_vote(){
				
				$db = new database($GLOBALS['config']);	
						
				$res = $db -> query(
					"SELECT * FROM `project` . `vote`
					WHERE 
				   `v_app_id` = '".$this->app_id."' AND `v_u_id` = '".$this->u_id."'
					ORDER BY v_time DESC LIMIT 1
					");	
				
				$row = mysql_fetch_assoc($res);
				
				
				if($row)
					$this->u_vote = $row['v_score'];
				else
					$this->u_vote = 0;
					
					$db->close();
				
			}
					
			
			
			public function __construct($row){
				$this->id		= $row['com_id'];
				$this->app_id	=$row['com_app_id'];
				$this->u_id		=$row['com_u_id'];
				$this->text		=$row['com_text'];
				$this->time		=$row['com_time'];	
				$this->ip		=$row['com_ip'];
				$this->get_user_vote();
			}
			
			
			
			
			public function __toString(){
				return "<li>
                    <div class=\"user\"> ผู้ใช้								".$this->u_id."</div>
                    <div class=\"voted\" id = \"voted\" score= '".$this->u_vote."' >        </div>
                	<div class=\"com_text\">								".$this->text." </div>
                    <div class=\"time\"> 									".$this->time." </div>
                    </li>";  
				
			
			}	
				
	}
?>