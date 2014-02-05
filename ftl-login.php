<?php
	$host="localhost";
	$username="sec_user_check";
	$password="GS7q8PFHBLaHKZk";
	$db_name="o2users";
	
	$tbl_name="users";
	$tbl_attempts="login_attempts";
	$attempt_date=date('Y-m-d H:i:s');
	
	$success = "Y";
	$failure = "N";
		
	session_start();

	mysql_connect("$host", "$username", "$password") or die(mysql_error);
	mysql_select_db("$db_name");
	
	$myusername=mysql_real_escape_string($_POST['username']);
	$mypassword=$_POST['password'];
	
	$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
	$result=mysql_query($sql);
	
	$count=mysql_num_rows($result);
	
	if ($count == 1 && isset($_POST['username']) && isset($_POST['password']))
	{
		$sql_success = "INSERT INTO $tbl_attempts (user_id, timestamp, success) VALUES ('$myusername','$attempt_date','$success')";
		mysql_query($sql_success) or die(mysql_error());
		$_SESSION['username'] = '$myusername';
		$_SESSION['password'] = '$mypassword';
		echo '200';
	}
	else
	{
		$sql_failure = "INSERT INTO $tbl_attempts (user_id, password, timestamp, success) VALUES ('$myusername','$mypassword','$attempt_date','$failure')";
		mysql_query($sql_failure) or die(mysql_error());
		$_POST['problem'] = "login";
		header("location:login.php");
	}
?>
