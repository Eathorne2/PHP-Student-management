<?php

/**
 * to-mark controller
 */
class To_mark extends Controller
{
	
	function index()
	{
		// code...
		if(!Auth::access('lecturer'))
		{
			$this->redirect('access-denied');
		}

		$test = new Tests_model();

		$school_id = Auth::getSchool_id();

		if(Auth::access('admin')){

			$query = "select * from tests where school_id = :school_id order by id desc";
			$arr['school_id'] = $school_id;

			if(isset($_GET['find']))
	 		{
	 			$find = '%' . $_GET['find'] . '%';
	 			$query = "select * from tests where school_id = :school_id && (test like :find) order by id desc";
	 			$arr['find'] = $find;
	 		}

			$data = $test->query($query,$arr);
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

			$arr['stud_classes'] = $test->query($query,$arr);

			//read all tests from the selectd classes
			$data = array();
			if($arr['stud_classes']){
				foreach ($arr['stud_classes'] as $key => $arow) {
					// code...
 					$query = "select * from tests where class_id = :class_id";
 					$a = $test->query($query,['class_id'=>$arow->class_id]);
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
					$a = $test->query($query,['test_id'=>$arow->test_id]);

					if(is_array($a)){
						$test_details = $test->first('test_id',$a[0]->test_id);
						$a[0]->test_details = $test_details;

						$to_mark = array_merge($to_mark,$a);
					} 					
			}
		}

		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['To Mark','to_mark'];

		$this->view('to-mark',[
			'crumbs'=>$crumbs,
			'test_rows'=>$to_mark
		]);
		
	}
}
