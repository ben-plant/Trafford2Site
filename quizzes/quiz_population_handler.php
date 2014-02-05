<?php

require_once 'get_quiz_details.php';
$quizMaster = new quizDetailer();

//eval performance and exch for switch/case if necc
switch ($_POST['request'])
{
    case 'uuid':
        $quizMaster->set_quiz_detailer_uuid($quizMaster->get_latest_uuid(true));
        echo $quizMaster->get_latest_uuid(true);
        break;
    case 'q_no':
        echo $quizMaster->get_quiz_question_quantity();
        break;
    default:
        echo 101;
        break;
}
if ($_POST['q_text'] != null)
{
    echo $quizMaster->get_quiz_question_txt($_POST['q_text']);
}








