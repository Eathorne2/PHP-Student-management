<?php

/**
 * home controller
 */
class Profile extends Controller
{
	
	function index($id = '')
	{
		// code...
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$user = new User();
		$id = trim($id == '') ? Auth::getUser_id() : $id;

		$row = $user->first('user_id',$id);

		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['profile','profile'];
		if($row){
			$crumbs[] = [$row->firstname,'profile'];
		}

		//get more info depending on tab
		$data['page_tab'] = isset($_GET['tab']) ? $_GET['tab'] : 'info';

		if($data['page_tab'] == 'classes' && $row)
		{
			$class = new Classes_model();
 			$mytable = "class_students";
 			if($row->rank == "lecturer"){
 				$mytable = "class_lecturers";
 			}
 			
			$query = "select * from $mytable where user_id = :user_id && disabled = 0 && year(date) = :school_year";
			$arr['user_id'] = $id;
			$arr['school_year'] = !empty($_SESSION['SCHOOL_YEAR']->year) ? $_SESSION['SCHOOL_YEAR']->year : date("Y",time());
			
			$data['stud_classes'] = $class->query($query,$arr);

			$data['student_classes'] = array();
			if($data['stud_classes']){
				foreach ($data['stud_classes'] as $key => $arow) {
					// code...
					$data['student_classes'][] = $class->first('class_id',$arow->class_id);
				}
			}
			
		}else

		if($data['page_tab'] == 'tests' && $row)
		{
			if($row->rank != 'student'){

				$class = new Classes_model();

				$disabled = "disabled = 0 &&";
	 			$mytable = "class_students";
	 			if($row->rank == "lecturer"){
	 				$mytable = "class_lecturers";
	 				$disabled = "";
	 			}
	 			
   				$tests = new Tests_model();

	 			$query = "select * from tests where $disabled class_id in (select class_id from $mytable where user_id = :user_id && disabled = 0) && year(date) = :school_year order by id desc";
	 			$arr['user_id'] = Auth::getUser_id();
	 			$arr['school_year'] = !empty($_SESSION['SCHOOL_YEAR']->year) ? $_SESSION['SCHOOL_YEAR']->year : date("Y",time());

	 			if(isset($_GET['find']))
		 		{
		 			$find = '%' . $_GET['find'] . '%';
		 			$query = "select * from tests where $disabled class_id in (select class_id from $mytable where user_id = :user_id && disabled = 0) && test like :find && year(date) = :school_year order by id desc";
		 			$arr['find'] = $find;
		 		}

	 			$data['test_rows'] = $tests->query($query,$arr);


			}else{

				//get all submitted tests
				$marked = array();
				$tests = new Tests_model();

				$query = "select * from answered_tests where user_id = :user_id && submitted = 1 && marked = 1";
				$answered_tests = $tests->query($query,['user_id'=>$id]);

				if(is_array($answered_tests)){
					
					foreach ($answered_tests as $key => $value) {
					
						$test_details = $tests->first('test_id',$answered_tests[$key]->test_id);
						$answered_tests[$key]->test_details = $test_details;

					}

				} 					
			 
				$data['test_rows'] = $answered_tests;
			}
		}

		$data['row'] = $row;
		$data['crumbs'] = $crumbs;
		$data['unsubmitted']= get_unsubmitted_test_rows();

		if(Auth::access('reception') || Auth::i_own_content($row)){
			$this->view('profile',$data);
		}else{
			$this->view('access-denied');
		}
	}

	function edit($id = '')
	{
		// code...
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		$errors = array();

		$user = new User();
		$id = trim($id == '') ? Auth::getUser_id() : $id;
  
		if(count($_POST) > 0 && Auth::access('reception'))
		{

			//something was posted

			//check if passwords exist
			if(trim($_POST['password']) == "")
			{
				unset($_POST['password']);
				unset($_POST['password2']);
			}

			if($user->validate($_POST,$id))
 			{
 				//check for files
 				if($myimage = upload_image($_FILES))
 				{
 					$_POST['image'] = $myimage;
 				}

 				if($_POST['rank'] == 'super_admin' && $_SESSION['USER']->rank != 'super_admin')
				{
					$_POST['rank'] = 'admin';
				}

				$myrow = $user->first('user_id',$id);
				if(is_object($myrow)){
					$user->update($myrow->id,$_POST);
				}
 
 				$redirect = 'profile/edit/'.$id;
 				$this->redirect($redirect);
 			}else
 			{
 				//errors
 				$errors = $user->errors;
 			}
		}

		$row = $user->first('user_id',$id);

		$data['row'] = $row;
		$data['errors'] = $errors;

		if(Auth::access('reception') || Auth::i_own_content($row)){
			$this->view('profile-edit',$data);
		}else{
			$this->view('access-denied');
		}

	}
}
