<?php
	function email($to, $subject, $body){
		
		require_once "Mail.php";
		
		$from = '<psblesson@gmail.com>';
		
		
		$headers = array(
		'From' => $from,
		'To' => $to,
		'Subject' => $subject
		);
		
		$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'psblesson@gmail.com',
        'password' => ''
		));
		
		$mail = $smtp->send($to, $headers, $body);
		
		if (PEAR::isError($mail)) {
			echo('<p>' . $mail->getMessage() . '</p>');
			} else {
			echo('<p>Message successfully sent!</p>');
		}
		
		
	}
	
	
	function logged_in_redirect(){
		
		if(logged_in() === true){
			
			header('Location: index.php');
			exit();
		}
		
	}
	
	
	
	
	function protect_page(){
		if(logged_in() === false){
			
			header('Location: protected.php');
			exit();
		}
		
	}
	
	
	function array_sanitize(&$item){
		
		$item = mysql_real_escape_string($item);
		
	}
	
	function sanitize($data) {
		
		return mysql_real_escape_string($data);
		
	}
	
	
	function output_errors($errors) {
		
		$output = array();
		
		foreach($errors as $error) {
			
			$output[] = '<li>'. $error . '</li>';
		}
		return '<ul>' . implode ('', $output) . '</ul>';
	}
?>