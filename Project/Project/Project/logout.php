<?php
	session_start();

	header("Refresh:1; url=index.php");

	session_destroy();
	
	Echo "Waiting....";
?>