<?php

/**
 * single class controller
 */
class Single_class extends Controller
{
	
	function index($id = '')
	{
		// code...
		// code...
		$errors = array();
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$classes = new Classes_model();
		$row = $classes->first('class_id',$id);


		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['classes','classes'];

		if($row){
			$crumbs[] = [$row->class,''];
		}

		$page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturers';
		$lect = new Lecturers_model();

		$results = false;
		if(($page_tab == 'lecturer-add' || $page_tab == 'lecturer-remove') && count($_POST) > 0)
		{

			if(isset($_POST['search'])){

				if(trim($_POST['name']) != ""){

					//find lecturer
					$user = new User();
					$name = "%".trim($_POST['name'])."%";
					$query = "select * from users where (firstname like :fname || lastname like :lname) && rank = 'lecturer' limit 10";
					$results = $user->query($query,['fname'=>$name,'lname'=>$name,]);
				}else{
					$errors[] = "please type a name to find";
				}
			
			}else
			if(isset($_POST['selected'])){

				//add lecturer
				$query = "select id from class_lecturers where user_id = :user_id && class_id = :class_id && disabled = 0 limit 1";
				
				if($page_tab == 'lecturer-add'){

					if(!$lect->query($query,[
						'user_id' => $_POST['selected'],
						'class_id' => $id,
					])){

						$arr = array();
		 				$arr['user_id'] 	= $_POST['selected'];
		 				$arr['class_id'] 	= $id;
						$arr['disabled'] 	= 0;
						$arr['date'] 		= date("Y-m-d H:i:s");

						$lect->insert($arr);

						$this->redirect('single_class/'.$id.'?tab=lecturers');

					}else{
						$errors[] = "that lecturer already belongs to this class";
					}
				}else
				if($page_tab == 'lecturer-remove'){

					if($row = $lect->query($query,[
						'user_id' => $_POST['selected'],
						'class_id' => $id,
					])){

						$arr = array();
 						$arr['disabled'] 	= 1;
 
						$lect->update($row[0]->id,$arr);

						$this->redirect('single_class/'.$id.'?tab=lecturers');

					}else{
						$errors[] = "that lecturer was not found in this class";
					}
				}

			}

		}else 
		if($page_tab == 'lecturers'){
			
			//display lecturers
			$query = "select * from class_lecturers where class_id = :class_id && disabled = 0";
			$lecturers = $lect->query($query,['class_id'=>$id]);

			$data['lecturers'] 		= $lecturers;
		}

		$data['row'] 		= $row;
 		$data['crumbs'] 	= $crumbs;
		$data['page_tab'] 	= $page_tab;
		$data['results'] 	= $results;
		$data['errors'] 	= $errors;

		$this->view('single-class',$data);
	}
}
