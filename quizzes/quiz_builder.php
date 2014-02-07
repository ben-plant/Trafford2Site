<?php

    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= '/include/keys.php';
    include_once($path);

    //handles the quiz directory within o2_users

    if (($quizlibrarian = genLoginSQL()) == null || ($quiztablehandler = genQuizSQL()) == null)
    {
        return 101;
    }
    
    $quizUUID = $_POST['qUUID'];
    $UUIDarray = explode("-", $quizUUID);
    
    if (!($stmt = $quiztablehandler->prepare("INSERT INTO ".$UUIDarray[0]." (question_txt, question_type) VALUES (?, ?)")))
	{
        error_log($stmt->error);
		$json_response = constructJSONArray(107);
		echo json_encode($json_response);
	}
    else
    {
        $stmt->bind_param('ss', $_POST['qText'], $_POST['qType']);
    }

	if (!($stmt->execute()))
    {
        error_log($stmt->error);
        $json_response = constructJSONArray(107);
		echo json_encode($json_response);
    }
    else
    {
        $json_response = constructJSONArray(200);
		echo json_encode($json_response);
    }

    function constructJSONArray($response)
	{
		$json_array = array();
		
		$json_array['quiz_response'][] = array (
					'response'    => $response
				);		
				
		return $json_array;
	}