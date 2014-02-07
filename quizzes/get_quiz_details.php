<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= '/include/keys.php';
include_once($path);

class quizDetailer
{
    public $mysqli_index;
    public $mysqli_direc;
    
    public $my_uuid;
    
    public function __construct()
    {
        if (($this->mysqli_index = genLoginSQL()) == null || ($this->mysqli_direc = genQuizSQL()) == null)
        {
            return 107;
        }
    }
    
    public function get_latest_uuid($trimmed)
    {
        $latest_quiz = mysqli_query($this->mysqli_index, "SELECT quiz_uuid FROM o2users.quizzes where quiz_created_date = (select MAX(quiz_created_date) from o2users.quizzes)");
        if ($latest_quiz->num_rows == 0)
        {
            return null;
        }
        else
        {
            $row_date = $latest_quiz->fetch_array(MYSQLI_ASSOC);
            if (!$trimmed)
            {
                return($row_date['quiz_uuid']);
            }
            else
            {
                $uuid_ex = explode("-", $row_date['quiz_uuid']);
                return($uuid_ex[0]);
            }
        }
    }
    
    public function set_quiz_detailer_uuid($uuid)
    {
        $this->my_uuid = $uuid;
    }
    
    public function get_quiz_question_quantity($uuid)
    {
        if (!($quiz_question_quantity = mysqli_query($this->mysqli_direc, "SELECT question_txt FROM ".$uuid)))
        {
            error_log($this->mysqli_direc->error);
        }
        if (mysqli_num_rows($quiz_question_quantity) == 0)
        {
            error_log("Erroneous statement found: SELECT question_txt FROM ".$uuid);
            return null;
        }
        else
        {
            return mysqli_num_rows($quiz_question_quantity);
        }
    }
    
    public function get_quiz_question_txt($q_no)
    {
        if (!($quiz_question_check = mysqli_query($this->mysqli_direc, "SELECT question_txt FROM ".$this->my_uuid." WHERE question_no=".$q_no)))
        {
            error_log($this->mysqli_direc->error);
        }
        else
        {
            $quiz_question = $quiz_question_check->fetch_array(MYSQLI_ASSOC);
            if (!$quiz_question['question_txt'])
            {
                return null;
            }
            else
            {
                return($quiz_question['question_txt']);
            }
        }
    }
    
    public function get_quiz_question_type($uuid, $q_no)
    {
        if (!($quiz_question_check = mysqli_query($this->mysqli_direc, "SELECT question_type FROM ".$uuid." WHERE question_no=".$q_no)))
        {
            error_log($this->mysqli_direc->error);
        }
        else
        {
            $quiz_question = $quiz_question_check->fetch_array(MYSQLI_ASSOC);
            return($quiz_question['question_type']);
        }
    }
    
    private function update_quiz_question_quantity($uuid, $newqqq) //TODO: write this!
    {
        
    }

    public function __destruct() 
    {
        //sort later
    }

}




