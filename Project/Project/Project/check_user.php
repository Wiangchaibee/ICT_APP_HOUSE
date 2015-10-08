<? 
include "class/Class_database.php";
include "class/Server_config.php";
$db = new database($GLOBALS['config']);
if($n == '1'){ echo $_POST['id_register'];
		$res = $db->query("select * from member where m_id ="."'".$_POST['id_register']."'");
		$r= mysql_num_rows($res);
	
		if($r >= '1'){
			echo "ชื่อบัญชีนี้มีผู้ใช้แล้ว";	
		}
		else{
			echo "สามารถใช้ชื่อบัญชีนี้ได้";
		}	
	
	
}




?>