<?php 
	include_once "Class_database.php";
	include_once "Server_config.php";


	class pm{
		
			private $id;
			private $topic;
			private $send_u_id;
			private $receive_u_id;
			private $text;
			private $time;
			
			public function __get($name){
					return $this->$name;
			}
				
			
			
			public function __construct($row){
				$this->id				= $row['pm_id'];
				$this->topic			= $row['pm_topic'];
				$this->send_u_id		=$row['pm_send_u_id'];
				$this->receive_u_id		=$row['pm_re_u_id'];
				$this->text				=$row['pm_text'];
				$this->time				=$row['pm_time'];	
				
				
			}
			
			
			
			
			public function __toString(){
				return "
				<table>
					
                    	<div style=padding:5px; class=\"send_u_id\">ผู้ส่ง 			 ".$this->send_u_id." <a href=\"javascript:get_re_pm($this->id);\">ตอบกลับ</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:get_delete_pm($this->id);\">ลบ</a> </div>
						<div style=padding:5px; class=\"topic\">หัวเรื่อง 			 ".$this->topic." </div>
                		<div style=padding:5px; class=\"pm_text\">เนื้อเรื่อง				 ".$this->text." </div>
                    	<div style=padding:5px; class=\"time\">เวลา				 ".$this->time." </div>
						<hr style=color:#000000  />
               </table>";  
						
				
			
			}
				
	}
?>