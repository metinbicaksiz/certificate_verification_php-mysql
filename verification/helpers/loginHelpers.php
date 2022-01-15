	

<?php

require 'dbHelpers.php';

	// check if user with username and password exists
	function checkUser($username,$password)
	{
		
		$query = dbConnect()->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
		
		 $query->bindParam(':username', $username);

		$query->bindParam(':password', md5($password));		

		$query->bindParam(':password', $password);		

		
		$query->execute();
		
		$row = $query->fetch();
		
		return count($row)>1;
		
	}
	
	// fetch user information by username
	function fetchUser($username)
	{
		$query = dbConnect()->prepare("SELECT * FROM users WHERE username=:username");
		
        	$query->bindParam(':username', $username);	
		
		$query->execute();
		
        	if($row = $query->fetch())
		{
			return array(
				'username' => $row['username'],
				'email' => $row['email'],
				'city' => $row['city']
			);
		}
		else
		{
			return null;
		}
	}
	


?>
