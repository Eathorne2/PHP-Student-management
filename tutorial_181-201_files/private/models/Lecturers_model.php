<?php

/**
 * Lecturers Model
 */
class Lecturers_model extends Model
{
    protected $table = 'class_lecturers';

	protected $allowedColumns = [
        'user_id',
        'school_id',
        'class_id',
        'disabled',
        'date',
    ];

    protected $beforeInsert = [
        'make_school_id',
    ];

    protected $afterSelect = [
        'get_user',
    ];

    public function make_school_id($data)
    {
        if(isset($_SESSION['USER']->school_id)){
            $data['school_id'] = $_SESSION['USER']->school_id;
        }
        return $data;
    }

    public function get_user($data)
    {
        
        $user = new User();
        foreach ($data as $key => $row) {
            // code...
            if(isset($row->user_id)){
                $result = $user->where('user_id',$row->user_id);
                $data[$key]->user = is_array($result) ? $result[0] : false;
            }
        }
       
        return $data;
    }

    

 
}