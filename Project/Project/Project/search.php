<?php
	include_once "class/Class_user.php";
	include_once "class/Class_app_list.php";
	
	session_start();
	$_SESSION['user']->search($_GET);
				
		
				
				//search rusult in $_SESSION['search']
				
		print_r ($_SESSION['search']->get_page(1));
	
		//print_r($_GET);
		
		/*$text = explode(" ",$_GET['search_text']);
		
		//print_r($text);
		
		$query = "SELECT * from `application` WHERE 1=1";
		
		
			switch($_GET['search_type']){
				
						 case 'any':
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`app_name_th` LIKE 	'%".$i."%' OR ".
										"`app_name_en` LIKE 	'%".$i."%' OR ".
										"`app_tag` 	   LIKE 	'%".$i."%' OR ".
										"`app_detail`  LIKE 	'%".$i."%'    ".
										")";
									}
								}
							
						 break;
						 
						 
						 
						 case 'by_name':
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`app_name_th` LIKE 	'%".$i."%' OR ".
										"`app_name_en` LIKE 	'%".$i."%'    ".
										")";
									}
								}
							
						 break;		
						 
						 
						 
						 case 'by_tag':
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`app_tag` LIKE 	'%".$i."%' OR ".
										")";							
									}
								}
							
						 break;	
						 
						 
						 
						 case 'by_detail':
							 	foreach($text as $i){
									if(!empty($i)){
										$query .= " AND (".
										"`app_detail`  LIKE 	'%".$i."%'   ".
										")";								
									}
								}
							
						 break;			
			}
		
		//echo $query;
		//print_r ($GLOBALS['config']);
		
		$db = new database ($GLOBALS['config']);
		
		$res = $db->query($query);
		
		$_SESSION['search'] = new app_list($res);
		
		//print_r ($_SESSION['search']);
		
		print_r ($_SESSION['search']->get_page(1));
		
		
		
		
		
		*/
		
?>