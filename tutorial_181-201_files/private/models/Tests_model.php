<?php

/**
 * Tests Model
 */
class Tests_model extends Model
{
    protected $table = 'tests';

	protected $allowedColumns = [
        'test',
        'date',
        'class_id',
        'description',
        'disabled',
    ];

    protected $beforeInsert = [
        'make_school_id',
        'make_test_id',
        'make_user_id',
    ];

    protected $afterSelect = [
        'get_user',
        'get_class',
    ];


    public function validate($DATA)
    {
        $this->errors = array();

        //check for test name
        if(empty($DATA['test']) || !preg_match('/^[a-z A-Z0-9]+$/', $DATA['test']))
        {
            $this->errors['test'] = "Only letters & numbers allowed in test name";
        }
 
        if(count($this->errors) == 0)
        {
            return true;
        }

        return false;
    }

    public function make_school_id($data)
    {
        if(isset($_SESSION['USER']->school_id)){
            $data['school_id'] = $_SESSION['USER']->school_id;
        }
        return $data;
    }

    public function make_user_id($data)
    {
        if(isset($_SESSION['USER']->user_id)){
            $data['user_id'] = $_SESSION['USER']->user_id;
        }
        return $data;
    }

    public function make_test_id($data)
    {
        
        $data['test_id'] = random_string(60);
        return $data;
    }

    public function get_user($data)
    {
        
        $user = new User();
        foreach ($data as $key => $row) {
            // code...
            if(!empty($row->user_id)){
                $result = $user->where('user_id',$row->user_id);
                $data[$key]->user = is_array($result) ? $result[0] : false;
            }
        }
       
        return $data;
    }

    public function get_class($data)
    {
        
        $class = new Classes_model();
        foreach ($data as $key => $row) {
            // code...
            if(!empty($row->class_id)){

                $result = $class->where('class_id',$row->class_id);
                $data[$key]->class = is_array($result) ? $result[0] : false;
            }
        
        }
       
        return $data;
    }


    public function get_answered_test($test_id,$user_id)
    {

        $db = new Database();
        $arr = ['test_id'=>$test_id,'user_id'=>$user_id];

        $res = $db->query("select * from answered_tests where test_id = :test_id && user_id = :user_id limit 1",$arr);
    
        if(is_array($res))
        {
            return $res[0];
        }
        return false;
    }


    public function get_to_mark_count()
    {

        $test = new Tests_model();
        if(Auth::access('admin')){

            $query = "select * from answered_tests where test_id in (select test_id from tests where school_id = :school_id) && submitted = 1 && marked = 0 && year(date) = :school_year";
            $arr['school_id'] = Auth::getSchool_id();
            $arr['school_year'] = !empty($_SESSION['SCHOOL_YEAR']->year) ? $_SESSION['SCHOOL_YEAR']->year : date("Y",time());

            $to_mark = $test->query($query,$arr);
        }else{

            $mytable = "class_lecturers";
            $arr['user_id'] = Auth::getUser_id();
            $arr['school_year'] = !empty($_SESSION['SCHOOL_YEAR']->year) ? $_SESSION['SCHOOL_YEAR']->year : date("Y",time());

            $query = "select * from answered_tests where test_id in (select test_id from tests where class_id in (SELECT class_id FROM `class_lecturers` WHERE user_id = :user_id)) && submitted = 1 && marked = 0 && year(date) = :school_year";
            $to_mark = $test->query($query,$arr);
      
        }
 
        if($to_mark){
            return count($to_mark);
        }

        return 0;
    }

 
}