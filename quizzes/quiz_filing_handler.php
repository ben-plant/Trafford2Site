<?php

session_start();

	$uuid = $_POST['uuid'];
    $uuid_explode = explode("-", $uuid);

    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= '/include/keys.php';
    include_once($path);

	if (($mysqli = genQuizSQL()) == null)
    {
        return 107;
    }

	if (!($stmt = $mysqli->prepare("CREATE TABLE ".$uuid_explode[0]." (question_no INT AUTO_INCREMENT, question_txt VARCHAR(1000), question_type VARCHAR(20), 
PRIMARY KEY (question_no))")))
	{
        error_log($mysqli->error);
		$json_response = constructJSONArray($mysqli->error);
		echo json_encode($json_response);
	}
	else if (!($stmt->execute()))
    {
        error_log($stmt->error);
        $json_response = constructJSONArray(103);
		echo json_encode($json_response);
    }
    else
    {
        $json_response = constructJSONArray(200, $uuid);
        echo json_encode($json_response);
    }
	
    function constructJSONArray($response, $uuid)
	{
		$json_array = array();
		
		$json_array['quiz_response'][] = array (
					'response'    => $response,
                    'uuid'        => $uuid
				);		
				
		return $json_array;
	}

