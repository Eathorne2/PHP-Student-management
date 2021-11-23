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

			$query = "select * from tests where school_id = :school_id && year(date) = :school_year order by id desc";
			$arr['school_id'] = $school_id;
			$arr['school_year'] = !empty($_SESSION['SCHOOL_YEAR']->year) ? $_SESSION['SCHOOL_YEAR']->year : date("Y",time());

			if(isset($_GET['find']))
	 		{
	 			$find = '%' . $_GET['find'] . '%';
	 			$query = "select * from tests where school_id = :school_id && (test like :find) && year(date) = :school_year order by id desc";
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
 			
 			$query = "select * from tests where $disabled class_id in (select class_id from $mytable where user_id = :user_id && disabled = 0) && year(date) = :school_year order by id desc";
 			$arr['user_id'] = Auth::getUser_id();
 			$arr['school_year'] = !empty($_SESSION['SCHOOL_YEAR']->year) ? $_SESSION['SCHOOL_YEAR']->year : date("Y",time());

 			if(isset($_GET['find']))
	 		{
	 			$find = '%' . $_GET['find'] . '%';
	 			$query = "select * from tests where $disabled class_id in (select class_id from $mytable where user_id = :user_id && disabled = 0) && test like :find && year(date) = :school_year order by id desc";
	 			$arr['find'] = $find;
	 		}

 			$data = $tests->query($query,$arr);
 
 		}

		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Tests','tests'];

		$this->view('tests',[
			'crumbs'=>$crumbs,
			'test_rows'=>$data,
			'unsubmitted'=>get_unsubmitted_test_rows(),
		]);
	}

	 
	
}
