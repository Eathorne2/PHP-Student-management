<?php

/**
 * Questions Model
 */
class Questions_model extends Model
{
    protected $table = 'test_questions';

	protected $allowedColumns = [
        'question',
        'comment',
        'date',
        'test_id',
        'question_type',
        'correct_answer',
        'choices',
        'image',
    ];

    protected $beforeInsert = [
        'make_user_id',
    ];

    protected $afterSelect = [
        'get_user',
    ];


    public function validate($DATA)
    {
        $this->errors = array();

        //check for question name
        if(empty($DATA['question']))
        {
            $this->errors['question'] = "Please add a valid question";
        }

        //check for multiple choice answers
        $num = 0;
        $letters = ['A','B','C','D','F','G','H','I','J'];
        foreach ($DATA as $key => $value) {
            // code...
            if(strstr($key, 'choice')){
                if(empty($value))
                {
                    $this->errors['choice'.$num] = "Please add a valid answer in choice ".$letters[$num];
                }
                $num++;
            }
        }

        if(isset($DATA['correct_answer'])){

            if(empty($DATA['correct_answer']))
            {
                $this->errors['correct_answer'] = "Please add a valid answer";
            }
        }
 
        if(count($this->errors) == 0)
        {
            return true;
        }

        return false;
    }

    public function make_user_id($data)
    {
        if(isset($_SESSION['USER']->user_id)){
            $data['user_id'] = $_SESSION['USER']->user_id;
        }
        return $data;
    }

    public function get_user($data)
    {
        
        $user = new User();
        if(isset($data[0]->user_id)){
            foreach ($data as $key => $row) {
                // code...
                $result = $user->where('user_id',$row->user_id);
                $data[$key]->user = is_array($result) ? $result[0] : false;
            }
        }
       
        return $data;
    }

    

 
}