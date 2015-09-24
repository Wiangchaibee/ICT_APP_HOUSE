<?php
	session_start();
	
	include_once "class/Class_login.php";
	include_once "class/Class_user.php";
	
	header("Refresh:2;url=app.php");
	
	//Debug POST
	//print_r($_POST);
	
	$temp = new login($_POST['user'],($_POST['pass']),($_POST['id_type']));
	
	if($temp->is_valid())
		{
			//Echo "</br>";
			//Echo "ID FOUND</br>";
			
			$user;
			
			switch($_POST['id_type'])
			{
						case 's':
							//Debug stdent
							//Echo "This is student";
							$user = new student($_POST['user']);
						break;
						
						case 'a':
							//Debug advisor
							//Echo "This is advisor";
							$user = new advisor($_POST['user']);
						break;
						
						case 'x':
							//Debug admin
							//Echo "This is admin";
							$user = new admin($_POST['user']);
						break;
						
						case 'm':
							//Debug member
							//Echo "This is member";
							$user = new member($_POST['user']);
						break;
			}
			
			session_register('user');
			
			//Echo "<pre>";
			//print_r ($_SESSION);
			//Echo "<pre>";
		}
		
		
	else
	{
			Echo("Login Error");	
	}
?>