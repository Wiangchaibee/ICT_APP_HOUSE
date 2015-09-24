<?php
	if ($_FILES["file"]["size"] < 500000)
	{
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
		else
		{
			echo "Upload: " . $_FILES["file"]["name"] . "<br />";
			echo "Type: " . $_FILES["file"]["type"] . "<br />";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
			
			
			//$_POST['g_id']
			if(!file_exists("./".$_POST['name'].""))
			{
				echo "Folder not exist! Create new folder";
				mkdir("./".$_POST['name']."");
			}
			
			if (file_exists("".$_POST['name']."/" . $_FILES["file"]["name"]))
			{
				echo $_FILES["file"]["name"] . " already exists. ";
			}
			else
			{
				move_uploaded_file(
					$_FILES["file"]["tmp_name"],
					"".$_POST['name']."/" . $_FILES["file"]["name"]);
				echo "Stored in: " . "".$_POST['name']."/" . $_FILES["file"]["name"];
			}
		}
	}
	else
	{
		echo "Invalid file";
	}
?> 