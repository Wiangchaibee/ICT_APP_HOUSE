<?php
	include_once "class/Server_config.php";
	include_once "class/Class_user.php";
	include_once "class/Class_app.php";	
	include_once "class/Class_database.php";
	include_once "class/Class_app_list.php";
	error_reporting (E_ALL ^ E_NOTICE);
	 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	if(empty($_SESSION['user'])){
		 $_SESSION['user'] = new guest("guest","guest");
	}
	//$row = mysql_fetch_assoc($res)
						//$this->list_item[$i] = new app($row);
					
	$_SESSION['app'] = new app($row);
?>


	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" type="text/css" href="reset.css" />

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
<div class="move_app_index" id="move_up_index"></div>
<div class="app_page" id="app_page"></div>
<div class="con_warper">
<div class="con">


   <div class="logo"><div class="login_bar"> 
  		
       
        
  	
			<?php
            if(strcmp($_SESSION['user']->id_type,"guest") == 0)
            {
            ?>
                
                            
                           <br /><form action="login.php" method="post" name="form1"  id="form1" class="login_bar">                                     
                                <label for="user" >user</label>
                                <input type="text" name="user" id="user" style="border-radius:6px;" />
                                <label for="pass">pass</label>
                                <input type="password"  name="pass" id="pass" style="border-radius:6px;" />
                               	 <!--<select name="id_type">
                                  <option value="m">Member</option>
                                  <option value="s">Student</option>
                                  <option value="a">Advisor</option>
                                  <option value="x">Admin</option>
                                </select>-->
                              <input type="submit" name="button" id="button" value="Login" />
                            </form>
                       
                         
						<br /><a href="javascript:get_register();" style="margin-left:380px; color:#663366; text-decoration:underline; cursor:pointer;">สมัครสมาชิก</a>
						
           					</div>	
                            
		   <?php
                } 
                    else {		
                    //Echo "</pre>";
                    //Echo "</pre>";
                     Echo "</br>";
                     Echo "<div style=margin-left:250px;>"; 
					 Echo "สวัสดีคุณ: ".$_SESSION['user']->id; 
					 Echo "</div>";
                    //Echo "</br>";
                   // Echo "id_type:".$_SESSION['user']->id_type;  
					
            ?>
                    <div class="Logout">
                    
                        <form id="form1" name="form1" method="post" action="logout.php">
                            <input type="submit" name="Logout" id="Logout" value="Logout" style="margin-left:280px;" />
                        </form>
                    </div>
                    
                    
                    <div style="float:right">
             <?php
			 	if($_SESSION['user']->id_type != '' ){
			 ?>
            <?php if($_SESSION['user']->id_type == 's' && $_SESSION['user']->group_id == '0'){ ?>
             	<br /><div  style="display:inline-block; color:#669933; cursor:pointer;"><a href="javascript:select_student();"> สร้างกลุ่ม |</a></div> 
             	<?php } ?><div class="profile"  style="display:inline-block"><a href="edit_page.php">แก้ไขข้อมูล</a></div>
               <?php 
			   	}
			   ?>     
                	<div class="pm"  style="display:inline-block; cursor:pointer; color:#669933;"> 
					<?php if($_SESSION['user']->id_type != 'x'){ ?> <a href="javascript:get_pm();"> | ส่งข้อความถึงแอดมิน </a> <a href="javascript:load_pm();"> | กล่องข้อความ </a><?php }
				?><?php if($_SESSION['user']->id_type == 'x'){ ?> <a href="javascript:get_pm();"> | ส่งข้อความถึงสมาชิก </a> <a href="javascript:load_pm();"> | กล่องข้อความ </a> <?php } ?></div>
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
                        
                         
                       
                
		  
                      
                    <br /><div class="img"><img src="img/icon2.png" /></div></div> 

 					
                    <div class="menu_left" id="menu_left">
                    
                    

                   			<br /><br /><div class = 'search_box' id = 'search_box' align="center">
                            		<form name = 'form_search' id = 'form_search'>
                                    	<input type = 'text' name = 'search_text' id = 'search_text'  />
                                       <!-- <select name="search_type" id="search_type">
                                          <option value="any">		ANY			</option>
                                          <option value="by_name">	By_name		</option>
                                          <option value="by_tag">	By_tag		</option>
                                          <option value="by_detail">By_detail	</option>
                                        </select>-->
                                       <input type = 'button' name = 'search_button' id = 'search_button'  value = 'SEARCH' onclick = 'search();'/>
                                    </form>
                            </div>
                            
                            
                           
                          <br /><ul class="v_menu">
                            			<li><a href="index.php">หน้าแรก</a></li> 
                                        <li><a href="index_top_up.php">อัปเดทล่าสุด</a></li>
                                         <li><a href="index_top_download.php">ดาวน์โหลดสูงสุด</a></li> 
                                         <li><a href="index_top_view.php">เยียมชมสูงสุด</a></li> 
                                         
                                 		  <li><a href="#">เรียงตามสาขาวิชา</a>
                                           
                                        <ul>
										
                                            <li><a href="index_cpe.php" style="z-index:50;">วิศวกรรมคอมพิวเตอร์</a></li>
                                            <li><a href="index_cs.php">วิทยาการคอมพิวเตอร์</a></li> 
                                            <li><a href="index_bc.php">คอมพิวเตอร์ธุรกิจ</a></li> 
                                            <li><a href="index_it.php">เทคโนโลยีสารสนเทศ</a></li>
                                            <li><a href="index_gis.php">ภูมิสารสนเทศศาสตร์</a></li>
                                     
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
          
      
                
                
                <table id="top">
                <tr>
                    <td id="top1"><img src="img/top_vote.png" /></td>
                </tr>
                <tr>
            
                       <td id="top2"> <?php
                                $db = new database ($GLOBALS['config']);
                             $res = $db -> query(
                            "SELECT * FROM `project` . `application`
                            WHERE `app_field` = '3' 
                            ORDER BY app_vote_avg DESC
                            ");	
    
                                        $_SESSION['search2'] = new app_list($res);
                                        print_r ($_SESSION['search2']->get_page_index2(1));
                                        $db->close();
                            ?></td>
                </tr>
                </table>
                
                
              
    	</div>
    </div>
    </div>
    </body>
    </html>
						
                        
                        
                       <!-- <div class="footer">footer</div> -->
  	
 