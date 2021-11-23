<?php

/**
 * Answers Model
 */
class Answers_model extends Model
{
    protected $table = 'answers';

	protected $allowedColumns = [
        'user_id',
        'question_id',
        'date',
        'test_id',
        'answer',
        'answer_mark',
        'answer_comment',
    ];

    protected $beforeInsert = [];

    protected $afterSelect = [];


    public function validate($DATA)
    {
        $this->errors = array();

        if(count($this->errors) == 0)
        {
            return true;
        }

        return false;
    }
 
}