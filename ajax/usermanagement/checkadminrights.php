<?php
	session_start();

	$path = $_SERVER['DOCUMENT_ROOT'];
    $path .= '/include/keys.php';
    include($path);

	if (($mysqli = genLoginSQL()) == null)
    {
        return 107;
    }
	
	$username = htmlspecialchars($_POST['username']);

	if ((isset($_SESSION['adminkey'])) && ($username == $_SESSION['username']))
	{
		$json_response = constructJSONArray(200);
		echo json_encode($json_response);
	}
	else
	{
		$json_response = constructJSONArray(101);
		echo json_encode($json_response);
	}
	
	function constructJSONArray($response)
	{
		$json_array = array();
		
		$json_array['login_response'][] = array (
					'response'    => $response,
				);		
				
		return $json_array;
	}
	
//
?>

