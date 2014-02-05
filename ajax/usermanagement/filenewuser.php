<?php
	$username		    = $_POST['username'];
	$password1		    = $_POST['password1'];
	$password2		    = $_POST['password2'];
	$formatted_forename = $_POST['forename'];
	$formatted_surname  = $_POST['surname'];

	if ($password1 != $password2) //this is not ideal!
	{
		exit('105');
	}
	
	include '/include/keys.php';

	if (($mysqli = genVideoSQL()) == null)
    {
        return 107;
    }
	
	if (!($stmt = $mysqli->prepare("INSERT INTO users(username, password, formatted_forename, formatted_surname) VALUES (?, ?, ?, ?)")))
	{
		exit('107');
	}
	$stmt->bind_param('ssss', $username, $password1, $formatted_forename, $formatted_surname);
	
	$stmt->execute();
    error_log($stmt->error);
    
	$stmt->close();	
	exit('200');
?>