<?php
	function constructJSONArray($response, $username)
	{
		$json_array = array();
		
		$json_array['login_response'][] = array (
					'response'    => $response,
					'username' 	  => $username,
				);		
		return $json_array;
	}
?>