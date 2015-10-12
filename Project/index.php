<?php
	error_reporting (E_ALL ^ E_NOTICE);
	

		include_once "class/Server_config.php";
		include_once "class/Class_user.php";
		include_once "class/Class_database.php";
		include_once "class/Class_app_list.php";
		include_once "class/Class_app.php";	
		
		
		
	 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	if(empty($_SESSION['user'])){
		 $_SESSION['user'] = new guest("guest","guest");
	}
	//$row = mysql_fetch_assoc($res)
	//$this->list_item[$i] = new app($row);

	$row = 0;
	$_SESSION['app'] = new app($row);

?>



	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" type="text/css" href="reset.css" />
<title>ICT APP HOUSE</title>
<link rel="icon" href="img/ict_tran2.png">


<!-- Bootstrap 3 -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>


<!-- Include jquery tap -->
<link type="text/css" href="javascript/jqueryui/css/ui-lightness/jquery-ui-1.8.20.custom.css" rel="stylesheet" /> 
<script type="text/javascript" src="javascript/jqueryui/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="javascript/jqueryui/js/jquery-ui-1.8.20.custom.min.js"></script>

<!-- Include jquery vote  -->
<link type="text/css" rel="stylesheet" href="javascript/jquery_raty/doc/css/stylesheet.css"/>
<script type="text/javascript" charset="utf-8" src="javascript/jquery_raty/js/jquery.raty.min.js"></script>


<!--Slider-->
<link rel="stylesheet" href="css/global.css">
<script src="js/slides.min.jquery.js"></script>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/main.css" />
<script type="text/javascript" src="ajax/ajax.js"></script>

<title>Untitled Document</title>

</head>

<body>
<div class="container">
	<div class="move_app_index" id="move_up_index"></div>
	<div class="app_page" id="app_page"></div>
	<div class="con_warper">
	<div class="con">
		<div class="row">
			<div class="col-md-5">  
				<br /><div class="img"><img src="img/icon2.png" /></div>
			</div>
			<div class="col-md-7">
			   <div class=""><div class="login_bar " style="line-height:20px"> 
					
						<?php
						if(strcmp($_SESSION['user']->id_type,"guest") == 0)
						{
						?>
							
										
									   <br /><form action="login.php" method="post" name="form1"  id="form1" class="login_bar navbar-form navbar-right">     
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
												<input id="user" type="text" class="form-control" name="user" value="" placeholder="Username" required>                                        
											</div>

											<div class="input-group"  >
												<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
												<input id="password" type="password" class="form-control" name="pass" value="" placeholder="Password" required>                                        
												
											</div>
											<div class="text-right" style="margin-top:10px">
												<button type="submit" class="btn btn-success btn-sm">เข้าสู่ระบบ</button>
												<a href="javascript:get_register();" class="btn btn-default btn-sm" style="color:#000">สมัครสมาชิก</a>
											</div>
										</form>
								   
									 
									<br />
									
										</div>	
										
					   <?php
							} 
								else {		
								//Echo "</pre>";
								//Echo "</pre>";

								 echo "</br> ";
								 echo "<div style=margin-left:420px;>"; 
								 echo "สวัสดีคุณ: ".$_SESSION['user']->id."&nbsp;&nbsp;"; 
								 echo "</div>";
								//Echo "</br>";
							   // Echo "id_type:".$_SESSION['user']->id_type;  
								
						?>
								<div class="Logout">
								
									<form id="form1" name="form1" method="post" action="logout.php">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;									 <input type="submit" name="Logout" id="Logout" value="Logout" style="margin-left:280px;" />
									</form>
								</div>
								
								
								<div class="tap" style="float:right;">
						 <?php
							if($_SESSION['user']->id_type != '' ){
								
						 ?><?php if($_SESSION['user']->id_type == 's' && $_SESSION['user']->group_id == '0' ){ ?>
							<br /><div  style="display:inline-block; color:#669933; cursor:pointer;"><a href="javascript:select_student();"> สร้างกลุ่ม |</a></div> 
							<?php } ?>	<div class="profile"  style="display:inline-block"><a href="edit_page.php">แก้ไขข้อมูล</a></div>
						   <?php 
							}
						   ?>     
								<div class="pm"  style="display:inline-block; cursor:pointer; color:#669933;"> 
								<?php if($_SESSION['user']->id_type != 'x'){ ?> <a href="javascript:get_pm();"> | ส่งข้อความถึงแอดมิน </a> <a href="javascript:load_pm();"> | กล่องข้อความ </a> |<a href="javascript:select_student();"> สร้างกลุ่ม |</a><?php }
							?><?php if($_SESSION['user']->id_type == 'x'){ ?> <a href="javascript:get_pm();"> | ส่งข้อความถึงสมาชิก</a> <a href="javascript:load_pm();"> | กล่องข้อความ </a> <?php } ?></div>
								</div>
								 <?php
							
							if($_SESSION['user']->id_type == 's' && $_SESSION['user']->group_id == 0){	
							//echo "aaa";
					   ?> 
							   
							
								   
										
							<?php
									}
							?>		 
								
			   </div>
		   
                 <?php       
                        
   				 }
                	?>
		</div></div>
		
	</div> 

 					
                    <div class="menu_left" id="menu_left">
                    
                    

                   			<br /><br /><div class = 'search_box' id = 'search_box' align="center">
                            		<form name = 'form_search' id = 'form_search'>
                                    	<input type = 'text' name = 'search_text' id = 'search_text' placeholder="ค้นหา"  />
                                       <!-- <select name="search_type" id="search_type">
                                          <option value="any">		ANY			</option>
                                          <option value="by_name">	By_name		</option>
                                          <option value="by_tag">	By_tag		</option>
                                          <option value="by_detail">By_detail	</option>
                                        </select>-->
                                       <input type = 'button' name = 'search_button' id = 'search_button'  value = 'SEARCH' onclick = 'search();'/>
                                    </form>
                            </div>
                            
                                 
                            <br />
                            
                            <ul class="v_menu">
                            			<li><a href="index.php" >หน้าแรก</a></li> 
                                        <li><a href="index_top_up.php">อัปเดทล่าสุด</a></li>
                                         <li><a href="index_top_download.php">ดาวน์โหลดสูงสุด</a></li> 
                                         <li><a href="index_top_view.php">เยียมชมสูงสุด</a></li> 
                                         
                                 		  <li><a href="#">เรียงตามสาขาวิชา</a>
                                           
                                        <ul>
										
                                            <li><a href="index_cpe.php" style="height:50px;">วิศวกรรมคอมพิวเตอร์</a></li>
                                            <li><a href="index_cs.php" style="height:50px;">วิทยาการคอมพิวเตอร์</a></li> 
                                            <li><a href="index_bc.php" style="height:50px;">คอมพิวเตอร์ธุรกิจ</a></li> 
                                            <li><a href="index_it.php" style="height:50px;">เทคโนโลยีสารสนเทศ</a></li>
                                            <li><a href="index_gis.php" style="height:50px;">ภูมิสารสนเทศศาสตร์</a></li>
                                     
                       					</ul>
                                     
                                        </li>
                                   
                                          
   
								
                                         <li><a href="index_game.php">เกม</a></li>  
                                          <li><a href="index_entertain.php">ความบันเทิง</a></li>
                                         <li><a href="index_edu.php">การศึกษา</a></li>
                                         <li><a href="index_app.php">สังคมและการสื่อสาร</a></li> 
                                         <li><a href="index_music.php">ดนตรีและเสียงเพลง</a></li>
                                          <li><a href="index_tool.php">เครื่องมือ</a></li>
                                          <li><a href="index_etc.php">อื่นๆ</a></li> 
                                   </ul>
                                   
                                  
					  
                                  
                    </div>
                      	       
          <div class="main_content" id="main_content">
          			 <div class="slideline">
             		 <div class="slide">
                    		<div id="container">
								
                                    <div id="example">
                                       <!-- <img src="img/new-ribbon.png" width="112" height="112" alt="New Ribbon" id="ribbon"> -->
                                        <div id="slides">
                                            <div class="slides_container">
                                            
                                                <div class="slide">     
														 	<?php  
														$db = new database ($GLOBALS['config']);
															$res = $db -> query(
																	"SELECT * FROM `project` . `application`
																	WHERE `app_view`  
																	ORDER BY app_view DESC LIMIT 1");
															 $row = mysql_fetch_array($res);
															 $scr = $row['app_scr_1'];	
															 $name = $row['app_name'];	
															 
															 
															 
															 	$res1 = $db -> query(
																	"SELECT * FROM `project` . `application`
																	WHERE `app_vote_avg`  
																	ORDER BY app_vote_avg DESC LIMIT 1");
																 $row1 = mysql_fetch_array($res1);
																 $scr1 = $row1['app_scr_1'];	
																 $name1 = $row1['app_name'];	
																 
																 
																 
																 $res2 = $db -> query(
																	"SELECT * FROM `project` . `application`
																	WHERE `app_time`  
																	ORDER BY app_time DESC LIMIT 1");
																 $row2 = mysql_fetch_array($res2);
																 $scr2 = $row2['app_scr_1'];	
																 $name2 = $row2['app_name'];
															 $db->close();
															?>           
                                                    
                                                   		 <img src="<?php echo  $scr; ?>" width="770" height="310"  alt="Slide 1">
                                                    
                                                    <div class="caption">
                                                        <p>แอปพลิเคชั่นเยี่ยมชมมากที่สุด   ชื่อ : <? echo $name; ?></p>
                                                    </div>
                                                </div>
                                                
                                                <div class="slide">
                                                    
                                                    	<img src="<?php echo  $scr1; ?>" width="770" height="310" alt="Slide 2">
                                                   
                                                    <div class="caption">
                                                        <p>แอปพลิเคชั่นคะแนนโหวตมากที่สุด   ชื่อ : <? echo $name1; ?></p></p>
                                                    </div>
                                                </div>
                                                
                                                <div class="slide">
                                                <img src="img/new-ribbon.png" width="112" height="112" alt="New Ribbon" id="ribbon">
                                                    
                                                    	<img src="<?php echo  $scr2;?>" width="770" height="310" alt="Slide 3">
                                                    
                                                    <div class="caption">
                                                        <p>แอปพลิเคชั่นใหม่   ชื่อ : <?php echo $name2; ?></p></p>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <a href="#" class="prev"><img src="img/arrow-next.png" width="24" height="43" alt="Arrow Prev" style="margin-left:9px;"></a>
                                            <a href="#" class="next"><img src="img/arrow-prev.png" width="24" height="43" alt="Arrow Next" style="margin-left:9px;"></a>
                                        </div>
                                        
                                    </div>

								</div>
						   </div>
			   
						  </div>
						   
						 <div class="show_app" >
						 <table>
							<tr>
								<div class="top_view"><?php 
								
									$db = new database ($GLOBALS['config']);
								 $res = $db -> query(
							   "SELECT * FROM `project` . `application`
								WHERE `app_view`  
								ORDER BY app_view DESC LIMIT 5");
								$_SESSION['search'] = new app_list($res);
								print_r ($_SESSION['search']->get_page_index_top_view());
								
							   ?></div>
							  </tr>
							 </table>
							 <table>
							 <tr>
							   <div class="top_vote"><?php 
							
							$db = new database ($GLOBALS['config']);
								 $res = $db -> query(
							   "SELECT * FROM `project` . `application`
								WHERE `app_vote_avg`  
								ORDER BY app_vote_avg DESC LIMIT 5");
								$_SESSION['search2'] = new app_list($res);
								print_r ($_SESSION['search2']->get_page_index_top_vote());
							   ?></div>
							   </tr></table>
							   <table>
							   <tr>
							   <div class="new"><?php 
							
							$db = new database ($GLOBALS['config']);
								 $res = $db -> query(
							   "SELECT * FROM `project` . `application`
								WHERE `app_time`  
								ORDER BY app_time DESC LIMIT 5");
								$_SESSION['search3'] = new app_list($res);
								print_r ($_SESSION['search3']->get_page_index_new());
							   ?></div>
							  </tr>
						</table> 				
						
				</div>
				</div>
	</div>
    </body>
    </html>
						
                        
                        
                       <!-- <div class="footer">footer</div> -->
  	
 