<?php 
	
	include_once "class/Class_user.php";
	include_once "class/Class_app_list.php";
	include_once "class/Class_app.php";
	session_start();
	
	//print_r();
	
	$_SESSION['user']->vote($_POST['score']);
	$_SESSION['search']->list_item[$_SESSION['item_index']]->app_vote($_POST['score']);
	
	echo "ให้คะแนนเรียบร้อย";
	
	/*echo "UPDATE `application` SET
						`app_vote_avg` = (`app_vote_avg` * `app_vote_count` + ".$_POST['score'].") / (`app_vote_count` + 1),
						`app_vote_count` = `app_vote_count` + 1
						WHERE `app_id` = '".$_SESSION['viewing_app_id']."';";*/
	

?>