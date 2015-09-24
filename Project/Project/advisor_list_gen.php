<?php
	include "class/Class_database.php";
	include "class/Server_config.php";
			
				
							$db = new database($GLOBALS['config']);
					
							$res = $db->query("select * from advisor where a_f_id =".$_POST['field']);
							
							Echo "<option value=\""."0"."\"selected=\"selected\">"."N/A"."</option>";
					
							while($row = mysql_fetch_assoc($res))
								{
						
										Echo "<option value=\"".$row['a_id']."\">".$row['a_name']."</option>";
									
								}
										
						
?>