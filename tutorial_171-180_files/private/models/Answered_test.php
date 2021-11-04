<?php

/**
 * Answered test model
 */
class Answered_test extends Model
{
    protected $table = 'answered_tests';

	protected $allowedColumns = [];

    protected $beforeInsert = [];

    protected $afterSelect = [
        'get_user',
    ];


 
    public function get_user($data)
    {
        
        $user = new User();
        foreach ($data as $key => $row) {
            // code...
            $result = $user->where('user_id',$row->user_id);
            $data[$key]->user = is_array($result) ? $result[0] : false;
        }
       
        return $data;
    }

 
 
}