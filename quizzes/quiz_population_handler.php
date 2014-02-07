<?php

    require_once 'get_quiz_details.php';
    $quizMaster = new quizDetailer();

    //eval performance and exch for switch/case if necc
    switch ($_POST['request'])
    {
        case 'newest':
            //$quizMaster->set_quiz_detailer_uuid($quizMaster->get_latest_uuid(true));
                $new_uuid = $quizMaster->get_latest_uuid(true);
                $response = constructJSONArray(200, $new_uuid, $quizMaster->get_quiz_question_quantity($new_uuid));
                echo json_encode($response);           
            break;
        default:
                echo 101;
            break;
    }
    if ($_POST['q_text'] != null)
    {
        echo $quizMaster->get_quiz_question_txt($_POST['q_text']);
    }

	function constructJSONArray($response, $uuid, $question_quantity)
	{
		$json_array = array();
		
		$json_array['quiz_response'][] = array (
					'response'    => $response,
					'uuid'  	  => $uuid,
                    'q_quantity'  => $question_quantity,
				);		
		return $json_array;
	}
    
?>








