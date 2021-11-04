<?php


/**
 * classes controller
 */
class Classes extends Controller
{
	
	public function index()
	{
		// code...
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$classes = new Classes_model();

		$school_id = Auth::getSchool_id();

		if(Auth::access('admin')){

			$query = "select * from classes where school_id = :school_id order by id desc";
			$arr['school_id'] = $school_id;

			if(isset($_GET['find']))
	 		{
	 			$find = '%' . $_GET['find'] . '%';
	 			$query = "select * from classes where school_id = :school_id && (class like :find) order by id desc";
	 			$arr['find'] = $find;
	 		}

			$data = $classes->query($query,$arr);
 		}else{

 			$class = new Classes_model();
 			$mytable = "class_students";
 			if(Auth::getRank() == "lecturer"){
 				$mytable = "class_lecturers";
 			}
 			
			$query = "select * from $mytable where user_id = :user_id && disabled = 0";
 			$arr['user_id'] = Auth::getUser_id();

			if(isset($_GET['find']))
	 		{
	 			$find = '%' . $_GET['find'] . '%';
	 			$query = "select classes.class, {$mytable}.* from $mytable join classes on classes.class_id = {$mytable}.class_id where {$mytable}.user_id = :user_id && {$mytable}.disabled = 0 && classes.class like :find ";
	 			$arr['find'] = $find;
	 		}

			$arr['stud_classes'] = $class->query($query,$arr);

			//get class ids from classes that dont already have members
			$classes_i_own = $class->where('user_id',Auth::getUser_id());
			if($classes_i_own && $arr['stud_classes'])
			{
				 $arr['stud_classes'] = array_merge($classes_i_own, $arr['stud_classes']);
			}

			$data = array();
			if($arr['stud_classes']){

				$all_classes = array_column($arr['stud_classes'], 'class_id');
				$all_classes = array_unique($all_classes);

				foreach ($all_classes as $class_id) {
					// code...
					$data[] = $class->first('class_id',$class_id);
				}
			}
 
 		}

		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Classes','classes'];

		$this->view('classes',[
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

			$classes = new Classes_model();
			if($classes->validate($_POST))
 			{
 				
 				$_POST['date'] = date("Y-m-d H:i:s");

 				$classes->insert($_POST);
 				$this->redirect('classes');
 			}else
 			{
 				//errors
 				$errors = $classes->errors;
 			}
 		}

 		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Classes','classes'];
		$crumbs[] = ['Add','classes/add'];

		$this->view('classes.add',[
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

		$classes = new Classes_model();

		$errors = array();
		if(count($_POST) > 0 && Auth::access('lecturer') && Auth::i_own_content($row))
 		{

			if($classes->validate($_POST))
 			{
 				
 				$classes->update($id,$_POST);
 				$this->redirect('classes');
 			}else
 			{
 				//errors
 				$errors = $classes->errors;
 			}
 		}

 		$row = $classes->where('id',$id);

 		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Classes','classes'];
		$crumbs[] = ['Edit','classes/edit'];

		if(Auth::access('lecturer') && Auth::i_own_content($row)){

			$this->view('classes.edit',[
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

 
		$classes = new Classes_model();

		$errors = array();

		if(count($_POST) > 0 && Auth::access('lecturer') && Auth::i_own_content($row))
 		{
 
 			$classes->delete($id);
 			$this->redirect('classes');
 		 
 		}

 		$row = $classes->where('id',$id);

 		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Classes','classes'];
		$crumbs[] = ['Delete','classes/delete'];

		if(Auth::access('lecturer') && Auth::i_own_content($row)){

			$this->view('classes.delete',[
				'row'=>$row,
	 			'crumbs'=>$crumbs,
			]);
		}else{
			$this->view('access-denied');
		}
	}
	
}
