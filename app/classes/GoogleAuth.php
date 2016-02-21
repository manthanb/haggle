<?php
	
	class GoogleAuth{
		
		protected $client;
		
		public function _construct (Google_Client $googleClient = null){
			
			$this->client = $googleClient;
			
			if($this->client)
			{
				echo 'ds';
				
				$this->client->setClientId('907956457416-v3n48s3kero3br8g3pn7t8atna3guebp.apps.googleusercontent.com');
				$this->client->setClientSecret('NTjiciN3uaC68ITtp1UYr3wI');
				$this->client->setRedirectUri('http://localhost/lr/index1.php');
				$this->client->setScopes('email');
				
				
				}
			
			}
		
		}
	
