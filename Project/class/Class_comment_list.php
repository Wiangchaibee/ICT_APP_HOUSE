<?php 
	include_once "Class_database.php";
	include_once "Server_config.php";
	include_once "Class_comment.php";


	class comment_list{
			
			private $comment_count;
			private $comment_list = Array();
			private $app_id;
			
			public function __get($name){
					return $this->$name;
			}
				
				
			public function __construct($app_id){
				
					$this->app_id = $app_id;
				
					$db = new database($GLOBALS['config']);
					
					$res = $db -> query(
					"SELECT * FROM `project` . `comment`
					WHERE `com_app_id` = '".$this->app_id."'
					ORDER BY `com_id`  DESC
					");	
					
				if($res)
					$this->comment_count = mysql_num_rows($res);
				else
					$this->comment_count = 0 ;	
					
					
					if($this->comment_count>0){
						$i = 0;
							while($row = mysql_fetch_assoc($res)){
								$this->comment_list[$i] = new comment($row);
								$i++;
								}
								
					};
				
			}	
			
			
			
			public function com_update(){
				
					$db = new database($GLOBALS['config']);
					
					$res = $db -> query(
					"SELECT * FROM `project` . `comment`
					WHERE `com_app_id` = '".$this->app_id."'
					ORDER BY `com_id`  DESC
					");	
					
						if($res)
							$this->comment_count = mysql_num_rows($res);
						else
							$this->comment_count = 0 ;	
							
							
							if($this->comment_count>0){
								$i = 0;
									while($row = mysql_fetch_assoc($res)){
										$this->comment_list[$i] = new comment($row);
										$i++;
										}
										
							};
						
			}	
			
			
			
			
			
			public function show(){
				for($i=0 ; $i<$GLOBALS['comment_show'] && $i < $this->comment_count ; $i++){
						echo  $this->comment_list[$i];
					}
				if($this->comment_count > $GLOBALS['comment_show']){
					?>
                    	<li>
                        	<div class="load_more"><a href="javascript:get_all_comment();">ชมความคิดเห็นทั้งหมด</a></div>
                        </li>
                    <?php
				}		
			}
			
			public function show_all(){
					for($i=0 ; $i< $this->comment_count ; $i++){
						echo  $this->comment_list[$i];
					}
					
					//print_r ($this->comment_list[$i]);	
					
			}
				
			
			
					
	}
?>