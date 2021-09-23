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

 			$test = new Tests_model();
 			$mytable = "test_students";
 			if(Auth::getRank() == "lecturer"){
 				$mytable = "test_lecturers";
 			}
 			
			$query = "select * from $mytable where user_id = :user_id && disabled = 0";
 			$arr['user_id'] = Auth::getUser_id();

			if(isset($_GET['find']))
	 		{
	 			$find = '%' . $_GET['find'] . '%';
	 			$query = "select tests.test, {$mytable}.* from $mytable join tests on tests.test_id = {$mytable}.test_id where {$mytable}.user_id = :user_id && {$mytable}.disabled = 0 && tests.test like :find ";
	 			$arr['find'] = $find;
	 		}

			$arr['stud_tests'] = $test->query($query,$arr);

			$data = array();
			if($arr['stud_tests']){
				foreach ($arr['stud_tests'] as $key => $arow) {
					// code...
					$data[] = $test->first('test_id',$arow->test_id);
				}
			}
 
 		}

		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Tests','tests'];

		$this->view('tests',[
			'crumbs'=>$crumbs,
			'rows'=>$data
		]);
	}

	public function add()
	{
		// code...
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$errors = array();
		if(count($_POST) > 0)
 		{

			$tests = new Tests_model();
			if($tests->validate($_POST))
 			{
 				
 				$_POST['date'] = date("Y-m-d H:i:s");

 				$tests->insert($_POST);
 				$this->redirect('tests');
 			}else
 			{
 				//errors
 				$errors = $tests->errors;
 			}
 		}

 		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Tests','tests'];
		$crumbs[] = ['Add','tests/add'];

		$this->view('tests.add',[
			'errors'=>$errors,
			'crumbs'=>$crumbs,
			
		]);
	}

	public function edit($id = null)
	{
		// code...
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$tests = new Tests_model();

		$errors = array();
		if(count($_POST) > 0 && Auth::access('lecturer') && Auth::i_own_content($row))
 		{

			if($tests->validate($_POST))
 			{
 				
 				$tests->update($id,$_POST);
 				$this->redirect('tests');
 			}else
 			{
 				//errors
 				$errors = $tests->errors;
 			}
 		}

 		$row = $tests->where('id',$id);

 		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Tests','tests'];
		$crumbs[] = ['Edit','tests/edit'];

		if(Auth::access('lecturer') && Auth::i_own_content($row)){

			$this->view('tests.edit',[
				'row'=>$row,
				'errors'=>$errors,
				'crumbs'=>$crumbs,
			]);
		}else{
			$this->view('access-denied');
		}
	}

	public function delete($id = null)
	{
		// code...
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

 
		$tests = new Tests_model();

		$errors = array();

		if(count($_POST) > 0 && Auth::access('lecturer') && Auth::i_own_content($row))
 		{
 
 			$tests->delete($id);
 			$this->redirect('tests');
 		 
 		}

 		$row = $tests->where('id',$id);

 		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Tests','tests'];
		$crumbs[] = ['Delete','tests/delete'];

		if(Auth::access('lecturer') && Auth::i_own_content($row)){

			$this->view('tests.delete',[
				'row'=>$row,
	 			'crumbs'=>$crumbs,
			]);
		}else{
			$this->view('access-denied');
		}
	}
	
}
