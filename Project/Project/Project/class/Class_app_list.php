<?php
		include_once "Class_database.php";
		include_once "Server_config.php";
		include_once "Class_app.php";
		include_once "Class_user.php";
		session_start();


	class app_list{
		
		protected $numrow;
		protected $list_item = Array();
		
		
			public function __get($name){
				return $this->$name;
			}
			
		
			public function __construct($res){
				
					$this->num_row = mysql_num_rows($res);
					
					
					$i = 0;
					
					while($row = mysql_fetch_assoc($res)){
						$this->list_item[$i] = new app($row);
						$i++;
						
					}
					
			}
		
		
		public function get_page($page_num){
			
			$start_index = $page_num * $GLOBALS['max_app_per_page'] - $GLOBALS['max_app_per_page'];
			$end_index   = $start_index + $GLOBALS['max_app_per_page'] - 1;
			
			//echo $GLOBALS['max_app_per_page'];
			//echo $end_index;
			?>
						
						<div class = 'app_list_wrapper'>
			<?php
			
			
			
					while($start_index <= ($this->num_row-1)){

					?>
                    
								
                                <div class="app_list_item" onclick ="get_app(<?php echo $start_index; ?>);">
                                
                                
                                		<div class="item_1">

                                              <div style="margin-left:10px; margin-top:5px;"><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="90" height="80"></div>
                                               <div style="margin-top:-80px; margin-left:110px; font-weight:bold;">ชื่อ : <?php echo $this->list_item[$start_index]->app_name;?></div><br />
                                                <div style="margin-top:-10px; margin-left:110px; font-weight:bold;">ชม : <?php echo $this->list_item[$start_index]->app_view;?></div><br />
                                                <div style="margin-top:-10px; margin-left:110px; font-weight:bold;">ชนิด : <?php echo $this->list_item[$start_index]->app_tag;?></div>
                                                <div style="margin-top:5px; margin-left:110px; font-weight:bold;">คะแนน :<div id="star_vote" data-rating="<?php echo $this->list_item[$start_index]->app_vote_avg;?>" style="margin-top:-15px; margin-left:45px; font-weight:bold;"></div> </div>
                                                
                                                
                                                <div></div>
                                             

                                         </div>  
                                         
                                         
                                     	
                                        <? 
										$string = $this->list_item[$start_index]->app_detail;
										 $limit = '800'; 
										 $break=" ";
										 $pad="...";
											if(strlen($string) >= $limit){
														if(false !== ($breakpoint = strpos($string, $break, $limit))) {
															if($breakpoint < strlen($string) - 1) {
															$string = substr($string, 0, $breakpoint) . $pad;?>
																<div class="item_2">เนื้อหา
                                                                	<div style="margin-left:-1px; margin-top:5px; width:auto; overflow-x:auto; overflow-y:auto;">
															 <?  echo $string;
																	?></div>
																</div> <?
															}
														} 
											}else{
																?><div class="item_2">เนื้อหา
                                                                	<div style="margin-left:-1px; margin-top:5px; width:auto; overflow-x:auto; overflow-y:auto;">
															  <? echo $this->list_item[$start_index]->app_detail;?>
																	</div>
																</div> <?
													
											}
										?>
                                        	
												
												
                                   
                                   		<div class="item_3">
                                        <?php if(strcmp($_SESSION['user']->id_type,"guest") != 0) { ?>
                                        	<div style="margin-top:30px; margin-left:100px;" onclick="get_download_file(<? echo $this->list_item[$start_index]->app_id; ?>);"><a href="<? echo $this->list_item[$start_index]->app_path; ?>"><img src="img/download.jpg" /></a></div>
                                            <div style="margin-top:-55px; margin-left:30px;" onclick="get_download_doc(<? echo $this->list_item[$start_index]->app_id; ?>);"><a href="<? echo $this->list_item[$start_index]->app_doc; ?>"><img src="img/download_doc.gif" style="width:50px; height:50px;" /></a></div>
                       					<?php }if(strcmp($_SESSION['user']->id_type,"guest") == 0){ ?>
                                        	<div style="margin-top:30px; margin-left:70px;"><? echo "เข้าสูู่ระบบก่อนจึงจะสามารถดาวน์โหลดได้";?></div>
                                            
                                        
                                        <?php } ?>
                                     	</div>
                                       
                                   
                               
                                </div>
                                
                                
					<?php
							$start_index++;
					}
			
			
			
			?>
						</div>   
			<?php	
		}
		
		
		
		
		
		
		
		
		public function get_page_index($page_num){
			
			$start_index = '0';
			$end_index   = $start_index + $GLOBALS['max_app_per_page_index'] - 1;
			
			//echo $GLOBALS['max_app_per_page_index'];
			//echo $end_index;
			?>
						
						
			<?php
			
			$i ='1';
			
					while($start_index <= ($this->num_row-1)){
								
					?>
							
                            <div class="app_lists">
								<? if($i == '1'){ ?>
                                    <div class="name">
                                            <div class="show_apps" name="show_apps" onclick ="get_app(<?php echo $start_index; ?>);">
                                    
                                                <?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="150" height="100">
                                             	<div class="name1"><?php echo "ชื่อ :"."".  $this->list_item[$start_index]->app_name;?> <br />
                                       			<?php echo "ชม :"."".  $this->list_item[$start_index]->app_view;?>
                                                <div>คะแนน : <div id="score_star2" style="margin-top:-15px; margin-left:50px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div> </div>
                                        		
            
                                            </div>
                                       
                                    </div>
                               <? }else{ ?>
                               		<div class="name">
                                            <div class="show_apps" name="show_apps" onclick ="get_app(<?php echo $start_index; ?>);">
                                    
                                                <?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="150" height="100">
                                             	<div class="name1"><?php echo "ชื่อ :"."".  $this->list_item[$start_index]->app_name;?> <br />
                                       			<?php echo "ชม :"."".  $this->list_item[$start_index]->app_view;?>
                                                <div>คะแนน : <div id="score_star2" style="margin-top:-15px; margin-left:50px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div> </div>
                                        		
            
                                            </div>
                                       
                                    </div>
                               
                               <?  } ?>
                             </div>
                                
                   <?
							$start_index++;$i++;
					}
	
		}
	
		public function get_page_index2($page_num){
			
			$start_index = '0';
			$end_index   = $start_index + $GLOBALS['max_app_per_page_index'] - 1;
			
			
			//echo $GLOBALS['max_app_per_page_index'];
			//echo $end_index;
			?>
						
						
			<?php
			
			$i ='1';
			
					while($start_index <= ($this->num_row-1)){
								
					?>
							
                            <div class="app_lists">
								<? if($i == '1'){ ?>
                                    <div class="name">
                                            <div class="show_apps" name="show_apps" onclick ="get_app2(<?php echo $start_index; ?>);">
                                    
                                                <?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="150" height="100">
                                             	<div class="name1"><?php echo "ชื่อ :"."".  $this->list_item[$start_index]->app_name;?> <br />
                                       			<?php echo "ชม :"."".  $this->list_item[$start_index]->app_view;?>
                                                <div>คะแนน : <div id="score_star2" style="margin-top:-15px; margin-left:50px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div> </div>
                                        		
            
                                            </div>
                                       
                                    </div>
                               <? }else{ ?>
                               		<div class="name">
                                            <div class="show_apps" name="show_apps" onclick ="get_app2(<?php echo $start_index; ?>);">
                                    
                                                <?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="150" height="100">
                                             	<div class="name1"><?php echo "ชื่อ :"."".  $this->list_item[$start_index]->app_name;?> <br />
                                       			<?php echo "ชม :"."".  $this->list_item[$start_index]->app_view;?>
                                                <div>คะแนน : <div id="score_star2" style="margin-top:-15px; margin-left:50px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div> </div>
                                        		
            
                                            </div>
                                       
                                    </div>
                               
                               <?  } ?>
                             </div>
                                
                   <?
							$start_index++;$i++;
					}
	
		}
		
			public function get_page_index3($page_num){
			
			$start_index = '0';
			$end_index   = $start_index + $GLOBALS['max_app_per_page_index'] - 1;
			
			//echo $GLOBALS['max_app_per_page_index'];
			//echo $end_index;
			?>
						
						
			<?php
			
			$i ='1';
			
					while($start_index <= ($this->num_row-1)){
								
					?>
							
                            <div class="app_lists">
								<? if($i == '1'){ ?>
                                    <div class="name">
                                            <div class="show_apps" name="show_apps" onclick ="get_app3(<?php echo $start_index; ?>);">
                                    
                                                <?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="150" height="100">
                                             	<div class="name1"><?php echo "ชื่อ :"."".  $this->list_item[$start_index]->app_name;?> <br />
                                       			<?php echo "ชม :"."".  $this->list_item[$start_index]->app_view;?>
                                                <div>คะแนน : <div id="score_star2" style="margin-top:-15px; margin-left:50px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div> </div>
                                        		
            
                                            </div>
                                       
                                    </div>
                               <? }else{ ?>
                               		<div class="name">
                                            <div class="show_apps" name="show_apps" onclick ="get_app3(<?php echo $start_index; ?>);">
                                    
                                                <?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="150" height="100">
                                             	<div class="name1"><?php echo "ชื่อ :"."".  $this->list_item[$start_index]->app_name;?> <br />
                                       			<?php echo "ชม :"."".  $this->list_item[$start_index]->app_view;?>
                                                <div>คะแนน : <div id="score_star2" style="margin-top:-15px; margin-left:50px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div> </div>
                                        		
            
                                            </div>
                                       
                                    </div>
                               
                               <?  } ?>
                             </div>
                                
                   <?
							$start_index++;$i++;
					}
	
		}
		
		
		public function slids_max_view($page_num){
			$start_index = 0;
			while($start_index <= ($this->num_row-1)){
				
				 ?> <div><img src="<?php echo  $this->list_item[$start_index]->app_scr_1; ?>" width="770" height="310"  alt="Slide 1"><div><?php
				
				
				}
			
		
		}
	
	
	
		public function get_page_index_top_vote(){
			
			$start_index = 0;
			
			$end_index   = $start_index + $GLOBALS['max_app_per_page_index'] - 1;
			
			
			//echo $GLOBALS['max_app_per_page_index'];
			//echo $end_index;
			?>
						
						
			<?php
			
			$i=1;
			
					
						while($start_index <= ($this->num_row-1)){
			 
								    if($i == 1){
								?>
										 <div class="test">
											<div class="l5" onclick ="get_app2(<?php echo $start_index; ?>);" style="cursor:pointer;">
			
															<?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="180" height="180" style="margin-left:10px; margin-top:10px">
											<h2>ชื่อ : <?php echo $this->list_item[$start_index]->app_name;?> <br />
                                            ประเภท : <?php echo $this->list_item[$start_index]->app_tag;?> <br />
                                            ชม : <?php echo $this->list_item[$start_index]->app_view;?>
                                            <div>คะแนน : <div id="score_star2" style="margin-left:60px; margin-top:-15px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div> </div>
											
                                            </div></div>
         
											</h2>
											
								   <?php  } ?>      
								   <?php if($i == 2){
								?>
										 <div class="test">
											<div class="l6" onclick ="get_app2(<?php echo $start_index; ?>);" style="cursor:pointer;">
			
															<?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="180" height="180" style="margin-left:10px; margin-top:10px">
											<h2>ชื่อ : <?php echo $this->list_item[$start_index]->app_name;?> <br />
                                            ประเภท : <?php echo $this->list_item[$start_index]->app_tag;?> <br />
                                            ชม : <?php echo $this->list_item[$start_index]->app_view;?>
                                            <div>คะแนน : <div id="score_star2" style="margin-left:60px; margin-top:-15px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div> </div>
											
                                            </div></div>
         
											</h2>
											
											
								   <?php  } ?> 
								   <?php if($i == 3){
								?>
										 <div class="test">
											<div class="r2" onclick ="get_app2(<?php echo $start_index; ?>);" style="cursor:pointer;">
			
															<?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="380" height="380" style="margin-left:10px; margin-top:10px">
											<h3>ชื่อ : <?php echo $this->list_item[$start_index]->app_name;?> <br />
                                           ประเภท : <?php echo $this->list_item[$start_index]->app_tag;?> <br />
                                            ชม : <?php echo $this->list_item[$start_index]->app_view;?>
                                            <div>คะแนน : <div id="score_star2" style="margin-left:60px; margin-top:-15px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div> </div>
											
                                            </div></div>
         
											</h3>
											
											
								   <?php  } ?>   
								   <?php if($i == 4){
								?>
										 <div class="test">
											<div class="l7" onclick ="get_app2(<?php echo $start_index; ?>);" style="cursor:pointer;">
			
															<?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>"width="180" height="180" style="margin-left:10px; margin-top:10px">
											<h2>ชื่อ : <?php echo $this->list_item[$start_index]->app_name;?> <br />
                                           ประเภท : <?php echo $this->list_item[$start_index]->app_tag;?> <br />
                                            ชม : <?php echo $this->list_item[$start_index]->app_view;?>
                                            <div>คะแนน : <div id="score_star2" style="margin-left:60px; margin-top:-15px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div> </div>
											
                                            </div></div>
         
											</h2>
											
											
								   <?php  } ?>   
								   <?php if($i == 5){
								?>
										 <div class="test">
											<div class="l8" onclick ="get_app2(<?php echo $start_index; ?>);" style="cursor:pointer;">
			
															<?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="180" height="180" style="margin-left:10px; margin-top:10px">
											<h2>ชื่อ : <?php echo $this->list_item[$start_index]->app_name;?> <br />
                                            ประเภท : <?php echo $this->list_item[$start_index]->app_tag;?> <br />
                                            ชม : <?php echo $this->list_item[$start_index]->app_view;?>
                                            <div>คะแนน : <div id="score_star2" style="margin-left:60px; margin-top:-15px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div> </div>
											
                                            </div></div>
         
											</h2>
											
											
								   <?php  } ?>                     
                       
                       
					<?php 
							
					
						/* if($i==5){
							  $i=0;  
							  }	*/
							 $i++;
							 $start_index++;
					}
					
			
		}
		public function get_page_index_top_view(){
			$start_index = 0;
			$end_index   = $start_index + $GLOBALS['max_app_per_page_index'] - 1;
					$i=1;
			?>		
			
					<?php
						while($start_index <= ($this->num_row-1)){

									if($i == 1){
								?>
										 <div class="test">
											<div class="l1" onclick ="get_app(<?php echo $start_index; ?>);" style="cursor:pointer;">

													<?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="180" height="180" style="margin-left:10px; margin-top:10px; opacity:1;">
	
										<h2>ชื่อ : <?php echo $this->list_item[$start_index]->app_name;?> <br />
                                            ประเภท : <?php echo $this->list_item[$start_index]->app_tag;?> <br />
                                            ชม : <?php echo $this->list_item[$start_index]->app_view;?>
                                            <div>คะแนน : <div id="score_star2" style="margin-left:60px; margin-top:-15px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div> </div>
											
                                            </div></div>
         
											</h2>
											
								   <?php  } ?>   
								   
								<?php if($i == 2){
								?>
										 <div class="test">
											<div class="l2" onclick ="get_app(<?php echo $start_index; ?> );" style="cursor:pointer;">
			
															<?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="180" height="180" style="margin-left:10px; margin-top:10px">
										
                                       <h2>ชื่อ : <?php echo $this->list_item[$start_index]->app_name;?> <br />
                                             ประเภท : <?php echo $this->list_item[$start_index]->app_tag;?> <br />
                                            ชม : <?php echo $this->list_item[$start_index]->app_view;?>
                                            <div>คะแนน : <div id="score_star2" style="margin-left:60px; margin-top:-15px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div> </div>
											
                                            </div></div>
         
											</h2>
											
											
								   <?php  } ?>   
								   
											
							   <?php if($i == 3){
								?>
										 <div class="test">
											<div class="r1" onclick ="get_app(<?php echo $start_index; ?>);" style="cursor:pointer;">
			
															<?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="380" height="380" style="margin-left:10px; margin-top:10px">
										
                                        <h3>ชื่อ : <?php echo $this->list_item[$start_index]->app_name;?> <br />
                                           ประเภท : <?php echo $this->list_item[$start_index]->app_tag;?> <br />
                                            ชม : <?php echo $this->list_item[$start_index]->app_view;?>
                                            <div>คะแนน : <div id="score_star2" style="margin-left:60px; margin-top:-15px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div> </div>
											
                                            </div></div>
         
											</h3>
											
											
								   <?php  } ?>   
								   
								  <?php if($i == 4){
								?>
										 <div class="test">
											<div class="l3" onclick ="get_app(<?php echo $start_index; ?>);" style="cursor:pointer;">
			
															<?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="180" height="180" style="margin-left:10px; margin-top:10px">
											<h2>ชื่อ : <?php echo $this->list_item[$start_index]->app_name;?> <br />
                                            ประเภท : <?php echo $this->list_item[$start_index]->app_tag;?> <br />
                                            ชม : <?php echo $this->list_item[$start_index]->app_view;?>
                                            <div>คะแนน : <div id="score_star2" style="margin-left:60px; margin-top:-15px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div> </div>
											
                                            </div></div>
         
											</h2>
											
											
								   <?php  } ?>   
									 
								<?php if($i == 5){
								?>
										 <div class="test">
											<div class="l4" onclick ="get_app(<?php echo $start_index; ?>);" style="cursor:pointer;">
			
															<?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="180" height="180" style="margin-left:10px; margin-top:10px">
											<h2>ชื่อ : <?php echo $this->list_item[$start_index]->app_name;?> <br />
                                             ประเภท : <?php echo $this->list_item[$start_index]->app_tag;?> <br />
                                            ชม : <?php echo $this->list_item[$start_index]->app_view;?>
                                            <div>คะแนน : <div id="score_star2" style="margin-left:60px; margin-top:-15px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div> </div>
											
                                            </div></div>
         
											</h2>
											
											
								   <?php  }  
							/*if($i==5){
							  	$i=0;  
							 }	*/
							 $i++;
							 $start_index++;
					}?> <?php 
                                   
			
			}	
			
			public function get_page_index_new(){
			$start_index = 0;
			$end_index   = $start_index + $GLOBALS['max_app_per_page_index'] - 1;
					$i=1;
			
					
						while($start_index <= ($this->num_row-1)){
								
	
									if($i == 1){
								?>
										 <div class="test">
											<div class="l1" onclick ="get_app3(<?php echo $start_index; ?>);" style="cursor:pointer;">

													<?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="180" height="180" style="margin-left:10px; margin-top:10px; opacity:1;">
	
										 <h2>ชื่อ : <?php echo $this->list_item[$start_index]->app_name;?> <br />
                                           ประเภท : <?php echo $this->list_item[$start_index]->app_tag;?> <br />
                                            ชม : <?php echo $this->list_item[$start_index]->app_view;?>
                                            <div>คะแนน : <div id="score_star2" style="margin-left:60px; margin-top:-15px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div>
											</h2>
                                          </div>
                                        </div>
											
								   <?php  } ?>   
								   
								<?php if($i == 2){
								?>
										 <div class="test">
											<div class="l2" onclick ="get_app3(<?php echo $start_index; ?> );" style="cursor:pointer;">
			
															<?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="180" height="180" style="margin-left:10px; margin-top:10px">
										
                                        <h2>ชื่อ : <?php echo $this->list_item[$start_index]->app_name;?> <br />
                                            ประเภท : <?php echo $this->list_item[$start_index]->app_tag;?> <br />
                                            ชม : <?php echo $this->list_item[$start_index]->app_view;?>
                                            <div>คะแนน : <div id="score_star2" style="margin-left:60px; margin-top:-15px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div>
											</h2>
                                           </div>
                                         </div>
											
											
								   <?php  } ?>   
								   
											
							   <?php if($i == 3){
								?>
										 <div class="test">
											<div class="r1" onclick ="get_app3(<?php echo $start_index; ?>);" style="cursor:pointer;">
			
															<?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="380" height="380" style="margin-left:10px; margin-top:10px">
										
                                        <h3>ชื่อ : <?php echo $this->list_item[$start_index]->app_name;?> <br />
                                             ประเภท : <?php echo $this->list_item[$start_index]->app_tag;?> <br />
                                            ชม : <?php echo $this->list_item[$start_index]->app_view;?>
                                            <div>คะแนน : <div id="score_star2" style="margin-left:60px; margin-top:-15px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div>       
											</h3>
                                            </div>
                                         </div>
											
											
								   <?php  } ?>   
								   
								  <?php if($i == 4){
								?>
										 <div class="test">
											<div class="l3" onclick ="get_app3(<?php echo $start_index; ?>);" style="cursor:pointer;">
			
															<?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="180" height="180" style="margin-left:10px; margin-top:10px">
											<h2>ชื่อ : <?php echo $this->list_item[$start_index]->app_name;?> <br />
                                            ประเภท : <?php echo $this->list_item[$start_index]->app_tag;?> <br />
                                            ชม : <?php echo $this->list_item[$start_index]->app_view;?>
                                            <div style="margin-top:2px;">คะแนน : <div id="score_star2" style="margin-left:60px; margin-top:-16px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div></div>
											</h2>
                                           </div>
                                          </div>
											
											
								   <?php  } ?>   
									 
								<?php if($i == 5){
								?>
										 <div class="test">
											<div class="l4" onclick ="get_app3(<?php echo $start_index; ?>);" style="cursor:pointer;">
			
															<?php ?><img src="<?php echo $this->list_item[$start_index]->app_logo;?>" width="180" height="180" style="margin-left:10px; margin-top:10px">
											<h2 style="margin-top:-80px;">ชื่อ : <?php echo $this->list_item[$start_index]->app_name;?> <br />
                                           ประเภท : <?php echo $this->list_item[$start_index]->app_tag;?> <br />
                                            ชม : <?php echo $this->list_item[$start_index]->app_view;?>
                                           <div style="margin-top:2px;"> คะแนน : <div id="score_star2" style="margin-left:60px; margin-top:-16px;" data-rating="<? echo $this->list_item[$start_index]->app_vote_avg;?>"></div></div>
                                            </h2>
                                            </div>
                                         </div>
											
											
								   <?php  }  
							/*if($i==5){
							  	$i=0;  
							 }*/	
							 $i++;
							 $start_index++;
					}?> <?php 
                                   
			
			}	
			
	}
?>