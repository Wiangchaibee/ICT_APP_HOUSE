<?php

		include_once "Class_database.php";
		include_once "Server_config.php";
		include_once "Class_user.php";
		
	
		
	class app{
		
		protected $app_id;
		protected $app_g_id;
		protected $app_logo;
		protected $app_path;
		protected $app_doc;
		protected $app_scr_1;
		protected $app_scr_2;
		protected $app_scr_3;
		protected $app_detail;
		protected $app_system;
		protected $app_name;
		protected $app_time;
		protected $app_vote_avg;
		protected $app_vote_count;
		protected $app_load_file;
		protected $app_load_doc;
		protected $app_view;
		protected $app_clip;
		protected $app_tag;
		protected $app_version;
		protected $app_field;
	
		
		
			public function __get($name)
				{
					return $this->$name;
				}
				
		
			public function __construct($row){
				
					//$db = new database($GLOBALS['confic']);
					
					//$db -> query("SELECT * from 'app' where 'app_id' = '".$id."';");
				
					//$row = mysql_fetch_assoc($res);
					
					$this->app_id		 	= $row['app_id'];
					$this->app_g_id 	 	= $row['app_g_id'];
					$this->app_logo 	 	= $row['app_logo'];
					$this->app_path		 	= $row['app_path'];
					$this->app_doc	 		= $row['app_doc'];
					$this->app_scr_1 	 	= $row['app_scr_1'];
					$this->app_scr_2	 	= $row['app_scr_2'];
					$this->app_scr_3	 	= $row['app_scr_3'];
					$this->app_detail	 	= $row['app_detail'];
					$this->app_system 	 	= $row['app_system'];
					$this->app_name 	 	= $row['app_name'];
					$this->app_time 		= $row['app_time'];
					$this->app_vote_avg 	= $row['app_vote_avg'];
					$this->app_vote_count 	= $row['app_vote_count'];
					$this->app_file_load	= $row['app_file_load'];
					$this->app_doc_load		= $row['app_doc_load'];
					$this->app_view 		= $row['app_view'];
					$this->app_clip		    = $row['app_clip'];
					$this->app_tag 			= $row['app_tag'];
					$this->app_version 		= $row['app_version'];
					$this->app_field 		= $row['app_field'];
					
				
				
			}
			
			
			
			
		
				
			public function app_view(){
					$db = new database($GLOBALS['config']);
					
					$db -> query(
						"UPDATE `application` SET
						`app_view` = `app_view` +1
						WHERE `app_id` = '".$this->app_id."';"
					);
					$db->close();
			}
				
				
				
			public function app_vote($score){
					$db = new database($GLOBALS['config']);
					
					$db -> query(
						"UPDATE `application` SET
						`app_vote_avg` = (`app_vote_avg` * `app_vote_count` + ".$score.") / (`app_vote_count` + 1),
						`app_vote_count` = `app_vote_count` + 1
						WHERE `app_id` = '".$_SESSION['viewing_app_id']."';"
					);
					$db->close();
			}
			
			public function check_vote(){
					$db = new database($GLOBALS['config']);
					
					 $res = $db -> query(
							"SELECT * FROM `project` . `vote`
							WHERE `v_u_id` = '".$_SESSION['user']->id."'
							");	
							$score=$res["v_score"];
					$db->close();
			}
			
			
			
			
		
		public function max_view_slide(){
				$db = new database($GLOBALS['config']);
			
					   $res = $db -> query(
							"SELECT * FROM `project` . `application`
							WHERE `app_view` 
							ORDER BY `app_view`  ASC
							");	
						
						while($row = mysql_fetch_array($res)){
							$path_max=$row["app_scr_1"];
							
						}
						
						
					$db->close();	
				echo $path_max;
			}
			
			
			
		
			
		public function name_max_view_slide(){
				$db = new database($GLOBALS['config']);
			
					   $res = $db -> query(
							"SELECT * FROM `project` . `application`
							WHERE `app_view` 
							ORDER BY `app_view`  ASC
							");	
						
						while($row = mysql_fetch_array($res)){
							$app_name_en=$row["app_name_th"];
						}
						
					$db->close();	
				echo $app_name_en;
		}
			
			
		public function top_vote_slide(){
				$db = new database($GLOBALS['config']);
			
					   $res = $db -> query(
							"SELECT * FROM `project` . `application`
							WHERE `app_vote_count` 
							ORDER BY `app_vote_count`  ASC
							");	
						
						while($row = mysql_fetch_array($res)){
							$path_vote_count=$row["app_scr_1"];
						}
					$db->close();	
				echo $path_vote_count;												
			}	
			
		public function new_app_slide(){
			$db = new database($GLOBALS['config']);
		
				   $res = $db -> query(
						"SELECT * FROM `project` . `application`
						WHERE `app_time` 
						ORDER BY `app_time`  ASC
						");	
					
					while($row = mysql_fetch_array($res)){
						$path_new_app=$row["app_scr_1"];
					}
				$db->close();	
			echo $path_new_app;												
		}	
	}
?>