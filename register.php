<?php 
	include 'core/init.php';
	logged_in_redirect();
	include 'includes/overall/header.php';
	if(empty($_POST)===false){
		
		$required_fields = array('username','password','password_again','first_name','email');
		
		foreach($_POST as $key=>$value){
			
			if(empty($value) && in_array($key, $required_fields) === true){
				
				$errors[]= 'Fields marked * are necessary';
				break 1;
			}
			
		}
		
		if(empty($errors) === true){
			
			if(user_exists($_POST['username'])===true){
				$errors[] = 'Sorry the username \''.$_POST['username'].'\' is already taken';
			}
			if(preg_match("/\\s/", $_POST['username']) == true){
				$errors[] = 'Your username cannot contain spaces';
			}
			if(strlen($_POST['password']) < 6){
				$errors[] = 'The password needs to be at least 6 characters';
			}
			if($_POST['password'] !== $_POST['password_again']){
				$errors[] = 'The passwords entered do not match';
			}
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
				$errors[] = 'A valid email address is required';
			}
			if(email_exists($_POST['email']) === true){
				$errors[] = 'Sorry the email address \''.$_POST['email'].'\' is already in use';
			}
			
		}
		
	}
	
	// print_r($errors);   debug stuff
?>
<h1>Register</h1>

<?php
	
	
	if(isset($_GET['success']) && empty($_GET['success'])){
		echo 'You\'ve successfully registered! Please check your email account to activate your account!';
		
		} else{	 
		if (empty($_POST) === false && empty($errors) === true){
			//registered user blah blah
			
			$register_data = array(
			'username' 			=> $_POST['username'],
			'password' 			=> $_POST['password'],
			'first_name' 		=> $_POST['first_name'],
			'last_name'			=> $_POST['last_name'],
			'email' 			=> $_POST['email'],
			'email_code'		=> md5($_POST['username']+microtime())
			
			);
			
			register_user($register_data);
			
			//redirect
			header('Location: register.php?success');
			// exit
			
			
			exit();
			
			
			} else if (empty($errors)=== false){
			echo output_errors($errors);
			
		}
		
		
	
	
	?>
	
	<form action="" method="post">
	
	<ul>
	<li>
	Username* :<br>
	<input type="text" name="username">
	</li>
	<li>
	Password*:<br> 
	<input type="password" name="password">
	</li>
	<li>
	Password Again*:<br> 
	<input type="password" name="password_again">
	</li>
	<li>
	First Name* :<br>
	<input type="text" name="first_name">
	</li>
	<li>
	Last Name :<br>
	<input type="text" name="last_name">
	</li>
	<li>
	Email* :<br>
	<input type="text" name="email">
	</li>
	<li>
	<input type="submit" value="Register">
	</li>
	</ul>
	
	
	</form>
	
	
	
	<?php 
	}
	include 'includes/overall/footer.php'; ?>
		