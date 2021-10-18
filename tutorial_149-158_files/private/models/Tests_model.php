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
            $result = $user->where('user_id',$row->user_id);
            $data[$key]->user = is_array($result) ? $result[0] : false;
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


        if(Auth::access('admin')){

            $query = "select * from tests where school_id = :school_id order by id desc";
            $arr['school_id'] = $school_id;

            if(isset($_GET['find']))
            {
                $find = '%' . $_GET['find'] . '%';
                $query = "select * from tests where school_id = :school_id && (test like :find) order by id desc";
                $arr['find'] = $find;
            }

            $data = $this->query($query,$arr);
        }else{

            $mytable = "class_lecturers";
         
            $query = "select * from $mytable where user_id = :user_id && disabled = 0";
            $arr['user_id'] = Auth::getUser_id();

            if(isset($_GET['find']))
            {
                $find = '%' . $_GET['find'] . '%';
                $query = "select tests.test, {$mytable}.* from $mytable join tests on tests.test_id = {$mytable}.test_id where {$mytable}.user_id = :user_id && {$mytable}.disabled = 0 && tests.test like :find ";
                $arr['find'] = $find;
            }

            $arr['stud_classes'] = $this->query($query,$arr);

            //read all tests from the selectd classes
            $data = array();
            if($arr['stud_classes']){
                foreach ($arr['stud_classes'] as $key => $arow) {
                    // code...
                    $query = "select * from tests where class_id = :class_id";
                    $a = $this->query($query,['class_id'=>$arow->class_id]);
                    if(is_array($a)){
                        $data = array_merge($data,$a);
                    }                   
                }
            }

            
 
        }

        //get all submitted tests
        $to_mark = array();
        if(count($data) > 0){
            foreach ($data as $key => $arow) {
                // code...
                    $query = "select * from answered_tests where test_id = :test_id && submitted = 1 && marked = 0 limit 1";
                    $a = $this->query($query,['test_id'=>$arow->test_id]);

                    if(is_array($a)){
                        $test_details = $this->first('test_id',$a[0]->test_id);
                        $a[0]->test_details = $test_details;

                        $to_mark = array_merge($to_mark,$a);
                    }                   
            }
        }

        return count($to_mark);
    }

 
}