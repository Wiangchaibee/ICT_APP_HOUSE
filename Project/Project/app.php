<?php 
include_once "class/Class_app_list.php";
include_once "class/Class_comment_list.php";
include_once "class/Class_login.php";
include_once "class/Server_config.php";
include_once "class/Class_user.php";
include_once "class/Class_app.php";	
include_once "class/Class_database.php";
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	 error_reporting(E_ALL & ~E_NOTICE); 


?><head>
      
    
        <style type="text/css" media="screen">
            .slides_container {
                width:480px;
                height:350px;
				margin-top:50px;
				margin-left:100px;

            }    
			
        </style>
    
        
        <script src="slides.js"></script>
        <script src="slides.min.jquery"></script>
        <script>
           
		$(function(){
      $("#slides").slides({
        preload: true,
        preloadImage: 'img/loading.gif',
        play: 2000,
        pause: 500,
        hoverPause: true
      });
    });
	$('div#star_vote2').each(function(){	
				$(this).raty({
						readOnly : true,
						 half  : true,
					  score: function() {
						return $(this).attr('data-rating');
					  }
					});
				});
	
        </script>

 
    
    </head>

<?php 
 //print_r ($_POST['index']);
// print_r ($_SESSION['search']->list_item[$_POST['index']]);
 
$_SESSION['search']->list_item[$_POST['index']]->app_view();
$_SESSION['viewing_app_id'] = $_SESSION['search']->list_item[$_POST['index']]->app_id;
$_SESSION['item_index'] = $_POST['index'];
$_SESSION['com_list'] = new comment_list($_SESSION['viewing_app_id']);
$_SESSION['detail'] = $_SESSION['search']->list_item[$_POST['index']]->app_detail;
$_SESSION['logo'] = $_SESSION['search']->list_item[$_POST['index']]->app_logo;
$_SESSION['scr_1'] = $_SESSION['search']->list_item[$_POST['index']]->app_scr_1 ;
$_SESSION['scr_2'] = $_SESSION['search']->list_item[$_POST['index']]->app_scr_2 ;		 
$_SESSION['scr_3'] = $_SESSION['search']->list_item[$_POST['index']]->app_scr_3 ;
$_SESSION['app_name'] = $_SESSION['search']->list_item[$_POST['index']]->app_name ;
$_SESSION['app_system'] = $_SESSION['search']->list_item[$_POST['index']]->app_system ;
$_SESSION['app_version'] = $_SESSION['search']->list_item[$_POST['index']]->app_version ;
$_SESSION['app_doc_load'] = $_SESSION['search']->list_item[$_POST['index']]->app_doc_load ;
$_SESSION['app_file_load'] = $_SESSION['search']->list_item[$_POST['index']]->app_file_load ;
$_SESSION['app_view'] = $_SESSION['search']->list_item[$_POST['index']]->app_view ;
$_SESSION['app_file'] = $_SESSION['search']->list_item[$_POST['index']]->app_path ;
$_SESSION['app_doc'] = $_SESSION['search']->list_item[$_POST['index']]->app_doc;
$_SESSION['app_clip'] = $_SESSION['search']->list_item[$_POST['index']]->app_clip ;
$_SESSION['app_field'] = $_SESSION['search']->list_item[$_POST['index']]->app_field ;
$_SESSION['app_tag'] = $_SESSION['search']->list_item[$_POST['index']]->app_tag ;
$_SESSION['app_vote_avg'] = $_SESSION['search']->list_item[$_POST['index']]->app_vote_avg ;


//print_r ($_SESSION['viewing_app_id']);


//print_r ($GLOBALS['viewing_app_id']);
//print_r ($_SESSION['search']->list_item[$_POST['index']]->app_id);
?>



<table class="app" id="app">
<tr>
<td class="app_bg"></td>
<td class="app_bg"></td>
<td class="app_bg"></td>
</tr>

<tr>
<td class="app_bg"></td>
<td class="app_content">

    <div id="tabs">
       <ul>
            <li><a href="#overview_tab">Overview</a></li>
            <li><a href="#review_tab">Review</a></li>
        </ul> 
        
        <div id="overview_tab">
            <table id="overview_tab">

            	<tr>
                	<td id="o_t_left">
                    	<div id="over1">
                        	<div id="icon"><img src="<?php echo $_SESSION['logo']; ?>" width="80" height="80"></div>
                            <div id="tag" style="margin-left:-270px; margin-top:2px;">คะแนน :</div><div id="star_vote2" style="margin-top:2px; margin-left:2px;" data-rating="<? echo $_SESSION['app_vote_avg']; ?>" id="tag" ></div>
                            <div id="name_th"> ชื่อ : <?php echo $_SESSION['app_name'];?> (<?php echo $_SESSION['app_version'];?>)</div>
                            <div id="namescore">เยี่ยมชม : </div><div id="app_view"><?php echo $_SESSION['app_view'];?></div>
                            <div id="tag" style="margin-left:-102px;"> ประเภท :</div><div id="app_tag" style="margin-top:-18px; margin-left:40px;"><?php echo $_SESSION['app_tag'];?></div>
                           
							<div style="margin-left:-75px;">ระบบที่รองรับ : <div style="margin-top:-18px; margin-left:130px;"><?php echo $_SESSION['app_system'];?></div></div>
                            
							<div>ดาวน์โหลดไฟล์เอกสาร: <?php echo $_SESSION['app_doc_load'];?> ครั้ง</div>
                            <div style="margin-left:8px;">ดาวน์โหลดไฟลฺ์โปรแกรม: <?php echo $_SESSION['app_file_load'];?> ครั้ง</div>
							<?php  if(strcmp($_SESSION['user']->id_type,"guest") != 0){ ?>
                            <div id="download1"  style="margin-left:315px; margin-top:-28px; width:30px;" onclick="get_download_file(<?php echo $_SESSION['viewing_app_id']; ?>);"><a href="<? echo $_SESSION['app_file']; ?>" ><img src="img/download.jpg" style="width:30px; height:30px;"  /></a></div>
                            <div id="download"  style="margin-left:280px; margin-top:-32px; width:30px;"  onclick="get_download_doc(<?php echo $_SESSION['viewing_app_id']; ?>);"><a href="<? echo $_SESSION['app_doc']; ?>"><img src="img/download_doc.gif" style="width:30px; height:30px;"   /></a></div>
                            <?php }
							else{ ?>
							<div id="please_login" style="margin-left:280px; margin-top:-120px;"><img src="img/login.png" style="width:50px; height:60px;" /></div>
							<?php	}
							 ?>
                            
                        </div>
                        <div id="author">
                        <div id="author2" style="font-weight:bold; font-size:14px; color:#000000; ">คณะผู้จัดทำ</div>
                        	<?php 
					
								$db = new database($GLOBALS['config']);
								
									 $rows = $db -> query(
										"SELECT * FROM `project` . `group`
										WHERE `g_app_id` = '".$_SESSION['viewing_app_id']."' 
										");	
										$rowss = mysql_fetch_array($rows);
										$g_id=$rowss["g_id"];
			
									 $res = $db -> query(
									"SELECT COUNT(s_g_id) AS aa FROM `student`
									WHERE `s_g_id` = '".$g_id."'
									");	
									$row = mysql_fetch_row($res);
									
							for($i=1;$i<=$row[0];$i++){
								$db = new database($GLOBALS['config']);
                                             $r = $db -> query(
                                            "SELECT * FROM `project` . `student`
                                            WHERE `s_g_id` = '".$g_id."' AND  `s_position` = '".$i."'
                                            ");	
                                            $ro = mysql_fetch_array($r);
                                            $email=$ro["s_email"];
											$name=$ro["s_name"];
                                            $db->close();
                                        //echo $res;echo $row;
									?><table>
                                    	<tr>
                                        	<td>
                                             <?php echo "ชื่อ-สกุล : ".$name; ?>
                                            </td>
                                           
                                        </tr>
                                        
                                      </table>  
                                       <table> 
                                    	<tr>
                                            <td>
                                              <?php echo "อีเมลล์ : ".$email; ?>
                                             </td>
                                         </tr>
                                    
                                    
                                    </table> <?php
										
										
							}
					
                   			?>
                        </div>
                        <div id="clip">
                       			 <iframe width='370' height='235' src='http://www.youtube.com/embed/<?php echo $_SESSION['app_clip']; ?>'></iframe>
  							
                        </div>
                    </td>
                    <td id="o_t_right">
                    	<div id="detail" style="margin-top:-8px;">
                        	<div id="detail2" style="font-weight:bold; font-size:14px; color:#000000;">รายละเอียดเกี่ยวกับแอปพลิเคชั่น</div>
                            	<div id="detail3"><?php echo $_SESSION['detail'];  ?></div>
                        </div>
                        	
                            	<div id="slides" style="position:absolute;top:205px;left:405px;z-index:100; width:0px;">
                                <div class="slides_container">
                                                
                                                    <img src="<?php echo $_SESSION['scr_1']; ?>" width="470" height="330" style="border-radius:6px;">
                                                 
                                                   <img src="<?php echo  $_SESSION['scr_2']; ?>" width="470" height="330" style="border-radius:6px;">
                                                   
                                                   <img src="<?php echo  $_SESSION['scr_3']; ?>" width="470" height="330" style="border-radius:6px;">
               
                                </div>
                                 <a href="#" class="prev"><img src="img/arrow-next.png" width="24" height="43" alt="Arrow Prev" style="margin-left:125px; margin-top:70px;"></a>
                                 <a href="#" class="next"><img src="img/arrow-prev.png" width="24" height="43" alt="Arrow Next" style="margin-left:-208px; margin-top:70px;"></a>
           				    </div>
                        	
                       
                    </td>
                </tr>
            </table>
  
        </div>
        
        <div id="review_tab">
            	<table id="review_table">
            	
                <tr>
                	
           		<td id="r_t_left">
								<?php  if(strcmp($_SESSION['user']->id_type,"guest") == 0){ ?>
                                
                                <div style="margin-top:20px;"><img src="img/nocomment.jpg" style="border-radius:6px; width:250px;" /></div>
                                		
										
                                 <?php }else{ ?>
							
									  <div id="v1"><br /><br /><div id="vote" ></div>Vote:<div id="vote_text" ></div></div> 
									
									
									
                               
                               <div style="font-weight:bold;"><?php }?></div>
                </td>
              		
                <td id="r_t_right">
                		
                       <div style="margin-left:5px; margin-top:4px; color:#660066; font-weight:bold;"><?php 	?></div><br />
                	
						<?php
							//Echo "id_type:".$_SESSION['user']->id; 
                          if(strcmp($_SESSION['user']->id_type,"guest") == 0){		 echo "กรุณาเข้าสู่ระบบก่อนจึงจะสามารถแสดงความคิดเห็นได้";
                         ?>               
                           
                           		
						 <?php
						   }else{
                         ?>                	 
                             <div id="comment">
                                 		<div id="comment_warper">
                                            <u class="comment_text">
                                                <li>
                                                    <div class="comment_box">
                                                        <textarea type="text" id="textbox_com" placeholder="write a comment"></textarea>
                                                        <div class="button_com_warper">
                                                            <input type="button" value="COMMENT" id="button_com" onclick="comment();"/>
                                                        </div> 
                                                    </div>
                                                </li>   
                                            </u>
                         				</div>               	
                         <?php
						 	}
							
						 ?>  
                                
                                    
                                    
                                    <u class="comment_show">  
                                    	<!--<div onclick="get_all_comment();"> TEST </div> -->
                                		
                                    </u>
                 
                        </div>
                </td>
                </tr>
            </table>
        </div> 

</td>
<td class="app_bg"></td>
</tr>
<tr>
<td class="app_bg"></td>
<td class="app_bg"></td>
<td class="app_bg"></td>
</tr>



