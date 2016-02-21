<?php 
include 'core/init.php';
protect_page();

if(empty($_POST)===false){

		$required_fields = array('current_password','password','password_again');

		foreach($_POST as $key=>$value){
	
		if(empty($value) && in_array($key, $required_fields) === true){
	
			$errors[]= 'Fields marked * are necessary';
			break 1;
		}	
		}
	
	if(md5($_POST['current_password']) === $user_data['password'] ){
			//current password entered correctly, proceed to check the new passwords
			
			if( trim($_POST['password']) !== trim($_POST['password_again']) ){
			
			$errors[]='Your new passwords do not match';
			
			} else if(strlen($_POST['password']) < 6){
			
			
			$errors[]='Your new password must be at least 6 characters in length';

			
			}
			
			
	} else{
			$errors[]='Current password is entered incorrectly';
	
	
	}
	
}


include 'includes/overall/header.php'; ?>
      <h1>Change password</h1>
	  
	  
	  <?php
	  
	  if(isset($_GET['success']) && empty($_GET['success'])){
			echo 'You\'ve successfully changed the password!';
	  
	  } else{	  
	  if(empty($_POST) === false   && empty($errors) === true) {
			//posted the form and no errors
			change_password($session_user_id, $_POST['password']);
			header('Location: changepassword.php?success');
			
	  }	else if(empty($errors) === false){
			
			//output errors
			echo output_errors($errors);
	  } 
	  
	  ?>
 
 <form action="" method="post">
 
	<ul>
		<li>
		Current password*:<br>
		<input type="password" name="current_password">
		</li>
		<li>
		New password*:<br>
		<input type="password" name="password">
		</li>
		<li>
		Re-enter New password*:<br>
		<input type="password" name="password_again">
		</li>
		<li>
		<input type="submit" value="Change password">
		</li>
	
	
	
	</ul>
 
 
 </form>
 
 
<?php 

}

include 'includes/overall/footer.php'; ?>
