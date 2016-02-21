<?php


include 'core/init.php';
logged_in_redirect();

if(empty($_POST)===false){

	$username=$_POST['username'];
	
	$password=$_POST['password'];
	

	if(empty($username) || empty($password) ){
	
		$errors[]='Need to enter a username and password';
	
	}else if(user_exists($username)===false){
	
		$errors[]='Have you registered??';
	
	} else if (user_active($username)===false){
	
			$errors[]='You haven\'t activated your account yet!';

	} else{
	
		if(strlen($password) > 32)
		{
		$errors[]='Password is too long';
		}
		//log in the user
		$login=login($username,$password);
		
		if($login===false){
			$errors[]='The username/password combination is incorrect';
		
		
		}else
		{
			$_SESSION['user_id']=$login;
			header('Location: index.php');
			exit();
			
		// set the user session
		// redirect the user to Home
		
		}	
	}
	}else
	{
	$errors[]='No data received' ;
	}
	include 'includes/overall/header.php';
	
	
	if(empty($errors)===false){
	?> 
<H2>We did our best to log you in but,...</H2> <?php
	
	 echo output_errors($errors);
	
	}
	include 'includes/overall/footer.php';
?> 
