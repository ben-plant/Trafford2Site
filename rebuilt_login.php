<?php
	require_once 'include/json.php';
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= '/include/keys.php';
    include_once($path);

	session_start();
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);
	$success = "Y";
	$failure = "N";
    	
	if ($username == null || $password == null)
	{
		header("location:login.php");
	}

    if (($mysqli = genLoginSQL()) === null)
    {
        $json_response = constructJSONArray(107, $username, null);
		echo json_encode($json_response); //another mysql error that needs better handling
    }
	
	if (!($queryresult = mysqli_query($mysqli, 'SELECT * FROM users WHERE username="'.$username.'" and password="'.$password.'"')))
	{
		$json_response = constructJSONArray(107, $username, null);
		echo json_encode($json_response); //another mysql error that needs better handling
	}
	
	if (($queryresult->num_rows) != 1)
	{
		$stmt = $mysqli->prepare("INSERT INTO login_attempts(user_id, success) VALUES (?, ?)");
		$stmt->bind_param("ss", $username, $failure);
		$stmt->execute();
		
		$json_response = constructJSONArray(403, $username, null);
		echo json_encode($json_response);
	}
	else
	{
		$user_result = mysqli_fetch_array($queryresult, MYSQLI_ASSOC);
		if ($user_result["is_authorised"] != 1)
		{
			$json_response = constructJSONArray(101, $username, null);
			echo json_encode($json_response);
		}
		
		$stmt = $mysqli->prepare("INSERT INTO login_attempts(user_id, success) VALUES (?, ?)");
		$stmt->bind_param("ss", $username, $success);
		$stmt->execute();
				
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password; //should this be being stored?
		
		if ($user_result["admin_rights"] != 0)
		{
			$_SESSION['adminkey'] = $user_result["admin_auth_key"];
		}
		
		$json_response = constructJSONArray(200, $username);		
		echo json_encode($json_response);
	}
?>