<?php


/**
 * tests controller
 */
class Tests extends Controller
{
	
	public function index()
	{
		// code...
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$tests = new Tests_model();

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

			$data = $tests->query($query,$arr);
 		}else{

 			$disabled = "disabled = 0 &&";
 			$mytable = "class_students";
 			if(Auth::getRank() == "lecturer"){
 				$mytable = "class_lecturers";
 				$disabled = "";
 			}
 			
			$query = "select * from $mytable where user_id = :user_id && disabled = 0 order by id desc";
 			$arr['user_id'] = Auth::getUser_id();

			$arr['stud_classes'] = $tests->query($query,$arr);

			$data = array();
			$arr2 = array();
			if($arr['stud_classes']){
				foreach ($arr['stud_classes'] as $key => $arow) {
					// code...
 					$query = "select * from tests where $disabled class_id = :class_id";
 					$arr2['class_id'] = $arow->class_id;

					if(isset($_GET['find']))
			 		{
			 			$find = '%' . $_GET['find'] . '%';
			 			$query = "select * from tests where $disabled class_id = :class_id && test like :find ";
			 			$arr2['find'] = $find;
			 		}

 					$a = $tests->query($query,$arr2);
 					if(is_array($a)){
 						$data = array_merge($data,$a);
 					} 					
				}
			}
 
 		}

		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Tests','tests'];

		$this->view('tests',[
			'crumbs'=>$crumbs,
			'test_rows'=>$data
		]);
	}

	 
	
}
