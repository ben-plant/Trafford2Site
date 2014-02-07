<?php

    $uuid = $_GET['uuid'];

    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= '/include/keys.php';
    include_once($path);

	if (($mysqli = genLoginSQL()) == null)
    {
        return 107;
    }
    
    $quiz_retrieved = mysqli_query($mysqli, "SELECT * FROM quizzes WHERE quiz_uuid=".$uuid.""); //fix this ugly bit of shit
    $latest_quiz = mysqli_query($mysqli, "SELECT MAX(quiz_created_date) FROM quizzes");
    
    if ($quiz_retrieved->num_rows == 0)
    {
        $json_response = constructJSONArray(101); //quiz not found
        exit(json_encode($json_response));
    }
    if ($latest_quiz->num_rows == 0)
    {
        $json_response = constructJSONArray(101); //quiz not found
        echo json_encode($json_response);
    }
    else
    {
        $row_date = $latest_quiz->fetch_array(MYSQLI_ASSOC);
        $row_quiz = $quiz_retrieved->fetch_array(MYSQLI_ASSOC);

        if (strcmp($row_quiz["quiz_created_date"], $row_date["MAX(quiz_created_date)"]) == 0)
        {
            $json_response = constructJSONArray(200);
            echo json_encode($json_response);
        }
        else
        {
            $json_response = constructJSONArray(105);
            echo json_encode($json_response);
        }
    }
    
    function constructJSONArray($response)
	{
		$json_array = array();
		
		$json_array['quiz_response'][] = array (
					'response'    => $response
				);		
				
		return $json_array;
	}

