<?php
	error_log("Deleting session...");
	session_start();
	
	unset($_SESSION['username']);
	unset($_SESSION['password']);
	
	if ((isset($_SESSION['adminkey'])))
	{
		unset($_SESSION['adminkey']);
	}
	
	session_destroy();
?>