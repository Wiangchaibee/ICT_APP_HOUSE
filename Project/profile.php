<?php
	include_once "class/Class_user.php";
	 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	
	//echo $_SESSION['user']->job_id;
?>
<form name="form_profile" method="post" id="form_profile" >
<table width="200" border="1">
  <tr>
    <td>ชื่อ</td>
    <td>
      <label for="name"></label>
      <input type="text" name="name" id="name" value= <?php  echo "\"".$_SESSION['user']->name."\"";?> >
    </td>
    <tr><td>ชื่อเล่น</td>
    <td><input type="text" name="nickname" value= <?php  echo "\"".$_SESSION['user']->nickname."\"";?> /></td>
  </tr>
  <tr>
    <td>โทรศัพท์(มือถือ)</td>
    <td>
      <label for="tel"></label>
      <input type="text" name="tel" id="tel" value= <?php echo"\"".$_SESSION['user']->tel."\"";?>>
    </td>
  </tr>
  <tr>
    <td>อีเมล</td>
    <td>
      <label for="email"></label>
      <input type="text" name="email" id="email" value= <?php echo"\"".$_SESSION['user']->email."\""; ?>>
    </td>
  </tr>
  <td>สถาบันการศึกษา</td>
    <td>
      <label for="education"></label>
      <input type="text" name="education" id="education" value= <?php echo"\"".$_SESSION['user']->education."\""; ?>>
    </td>
  </tr>
  <tr>
    <td>ที่อยู่</td>
    <td>
      <label for="address"></label>
      <input type="text" name="address" id="address"value= <?php echo"\"".$_SESSION['user']->address."\""; ?> >
    </td>
  </tr>
  <tr>
    <td>เพศ</td>
    <td>
      <label for="sex"></label>
      <select name="sex" id="sex">
      	
        
        <?php
			if($_SESSION['user']->sex == NULL)
			
				echo "<option value=\"N/A\" selected=\"selected\">N/A</option>";	
			
			else
				echo "<option value=\"N/A\">N/A</option>";
				
				
				
			if($_SESSION['user']->sex == "male")
			
				echo "<option value=\"male\" selected=\"selected\">Male</option>";	
			
			else
				echo "<option value=\"male\">Male</option>";
				
				
			
			if($_SESSION['user']->sex == 'female')
			
				echo "<option value=\"female\" selected=\"selected\">Female</option>";	
			
			else
				echo "<option value=\"female\">Female</option>";		
				
		?>
      </select>
    </td>
  </tr>
  
  
  	<?php
				include_once "class/Class_database.php";
				include_once "class/server_config.php";
				 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	
		switch($_SESSION['user']->id_type){
				//Case member
			case'm':
				//html code member
				?>
               <tr>
    			<td height="26">job</td>
   				 <td>
      			<select name="job" id="job">
        			<?php
				
				
						$db = new database($GLOBALS['config']);
				
						$res = $db->query("select * from job");
				
						while($row = mysql_fetch_assoc($res))
							{
					
								if($row['j_id'] == $_SESSION['user']->job_id)
									Echo "<option value=\"".$row['j_id']."\"selected=\"selected\">".$row['j_name']."</option>";
								else
									Echo "<option value=\"".$row['j_id']."\">".$row['j_name']."</option>";
							}
										
					?>
				</select>
				</td>
			  </tr>
				<?php					 
			break;
			
				// Case student
			case's':
				//html code student
				?>
  					<tr>
    					<td height="26">field</td>
   				 		<td>
      					<select name="field" id="field">
        					<?php
				
				
								$db = new database($GLOBALS['config']);
						
								$res = $db->query("select * from field");
				
						while($row = mysql_fetch_assoc($res))
								{
					
										if($row['f_id'] == $_SESSION['user']->field)
											Echo "<option value=\"".$row['f_id']."\"selected=\"selected\">".$row['f_name']."</option>";
										else
											Echo "<option value=\"".$row['f_id']."\">".$row['f_name']."</option>";
								}
										
							?>
						</select>
					</td>
			  	</tr>
                		<!--grade-->
               
                <tr>
    					<td height="26">grade</td>
   				 		<td>
      					<select name="grade" id="grade">
        					<?php
				
								
								for($i=0;$i<$GLOBALS['max_garde'];$i++){
										if($i == $_SESSION['user']->grade)
											Echo "<option value=\"".$i."\"selected=\"selected\">".$i."</option>";
										else
											Echo "<option value=\"".$i."\">".$i."</option>";
									}
				
							?>
						</select>
					</td>
			  	</tr>
				<?php
			break;	
			
			
			case'a':
				//html code advisor
				?>
                	<tr>
    					<td height="26">field</td>
   				 		<td>
      					<select name="field" id="field">
        					<?php
				
				
								$db = new database($GLOBALS['config']);
						
								$res = $db->query("select * from field");
				
						while($row = mysql_fetch_assoc($res))
								{
					
										if($row['f_id'] == $_SESSION['user']->field)
											Echo "<option value=\"".$row['f_id']."\"selected=\"selected\">".$row['f_name']."</option>";
										else
											Echo "<option value=\"".$row['f_id']."\">".$row['f_name']."</option>";
								}
										
							?>
						</select>
					</td>
			  	</tr>
				<?php
			break;	
			
			
			case'x':
				//html code admin
				?>
                
				<?php
			break;	
		}
	
  	?>
  
</table>
<input name="edit" type="button" value="edit" onclick="edit_profile();" />
</form>
 
<?php
 //print_r ($_SESSION['user']);
?>

