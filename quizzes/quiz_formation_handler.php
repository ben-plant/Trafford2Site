<?php

session_start();

	$title = $_POST['title'];

    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= '/include/keys.php';
    include_once($path);

	if (($mysqli = genLoginSQL()) == null)
    {
        return 107;
    }

	if (!($stmt = $mysqli->prepare("INSERT INTO quizzes(quiz_title) VALUES (?)")))
	{
		$json_response = constructJSONArray(107);
		echo json_encode($json_response);
	}
	$stmt->bind_param('s', $title);
	
	if (!($stmt->execute()))
    {
        error_log($stmt->error);
        $json_response = constructJSONArray(107);
		echo json_encode($json_response);
    }
    else
    {
        $latestquiz = mysqli_query($mysqli, "SELECT quiz_uuid, quiz_created_date FROM o2users.quizzes ORDER BY quiz_created_date DESC");
        if ($latestquiz->num_rows == 0)
        {
            $json_response = constructJSONArray(107);
            echo json_encode($json_response);
        }
        else
        {
            $row = $latestquiz->fetch_array(MYSQLI_ASSOC);
            $json_response = constructJSONArray(200, $row["quiz_uuid"]);
            echo json_encode($json_response);
        }

    }
	$stmt->close();

    function constructJSONArray($response, $uuid)
	{
		$json_array = array();
		
		$json_array['quiz_response'][] = array (
					'response'    => $response,
                    'uuid'        => $uuid,
				);		
				
		return $json_array;
	}