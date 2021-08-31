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
 			
			$query = "select * from $mytable where user_id = :user_id && disabled = 0";
			$data['stud_classes'] = $class->query($query,['user_id'=>$id]);

			$data['student_classes'] = array();
			if($data['stud_classes']){
				foreach ($data['stud_classes'] as $key => $arow) {
					// code...
					$data['student_classes'][] = $class->first('class_id',$arow->class_id);
				}
			}
			
		}

		$data['row'] = $row;
		$data['crumbs'] = $crumbs;

		if(Auth::access('reception') || Auth::i_own_content($row)){
			$this->view('profile',$data);
		}else{
			$this->view('access-denied');
		}
	}
}
