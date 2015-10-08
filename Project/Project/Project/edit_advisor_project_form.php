<?php
		include_once "class/Class_user.php";
		include_once "class/Class_database.php";
		include_once "class/Server_config.php";
		include_once "class/Class_app.php";
		include_once "class/Class_app_list.php";
		session_start();
	session_start();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/edit_page.css" />
<script type="text/javascript" src="ajax/edit_ajax.js"></script>
<title>Untitled Document</title>
</head>
<body>
<img src="img/edit_user_advisor.png" style="margin-left:50px; margin-top:50px;" />
	<form id="search_advisor" name="search_advisor"  enctype="multipart/form-data" >
    	<table id="edit_project" style="margin-left:280px; margin-top:50px;">
        	 <td>กรอกระดับชั้นปี <a style="color:#FF0000;">*</a></td>
                   <td>
                                         
                                         <select name="grade_ad" id="grade_ad" onchange="advisor_project();">
                              
                            	<? for($i=2540;$i<=2570;$i++){?>
									<option value="<? echo $i; ?>"><? echo $i; ?></option>
								<?	} ?>
                            </select>
                   </td>
                   
               
        </table>
   </form>
   <div id="show_search_advisor" style="height:500px; background-color:#FFFFFF; width:400px; overflow:auto; margin-left:200px; margin-top:30px;"></div>
  
</body>
</html>