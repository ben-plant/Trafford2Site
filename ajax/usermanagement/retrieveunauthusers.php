<?php
	include '/include/keys.php';

	if (($mysqli = genVideoSQL()) == null)
    {
        return 107;
    }
	
	$resultset = mysqli_query($mysqli, "SELECT * FROM users WHERE is_authorised = 0");
	
	$json_array = array();
	
	while ($userrow = mysqli_fetch_array($resultset))
	{
        $json_array['returned_users_req_auth'][] = array (
                'username' 	  => $userrow['username'],
                'forename' 	  => $userrow['formatted_forename'],
                'surname' 	  => $userrow['formatted_surname'],
            );
	}
	echo json_encode($json_array);

?>