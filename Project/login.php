<?php
	session_start();
	include_once "class\Class_login.php";
	include_once "class\Class_user.php";
	
	
	 header("Refresh:1;url=index.php");
	//Debug POST
	//print_r($_POST);
	//print_r($_SESSION['user']);
		$temp = new login($_POST['user'],($_POST['pass']));	
		//var_dump($temp);
		
		if($temp->is_valid())
			{
				//Echo "</br>";
				//Echo "ID FOUND</br>";
				
				$user;
				$str = $_POST['user'];
				
				$str = substr($str,0,2);
					//$('input[user^="s_"]').change(function() {
					//alert ($(this).val());
					//var num = $(this).attr('user')[10];
				if($str == 's_' || $str == 'a_' || $str == 'x_'){			
									switch($str)
									{									
												case 's_':
													//Debug stdent
													//Echo "This is student";
													$user = new student($_POST['user']);
													$_SESSION['user'] = $user;
												break;
												
												case 'a_':
													//Debug advisor
													//Echo "This is advisor";
													$user = new advisor($_POST['user']);
													$_SESSION['user'] = $user;
												break;
												
												case 'x_':
													//Debug admin
													//Echo "This is admin";
													$user = new admin($_POST['user']);
													$_SESSION['user'] = $user;
												break;
									}							
				}else{
						$user = new member($_POST['user']);
							
					
					}
					session_register('user');
				
			
				
				//Echo "<pre>";
				//print_r ($_SESSION);
				//Echo "<pre>";
		}
		
	else 
	{
			echo("Login Error");	
	}
?>