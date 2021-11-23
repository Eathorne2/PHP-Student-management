<?php

/**
 * marked single tests view controller
 */
class Marked_single extends Controller
{
	
public function index($id = '',$user_id = '')
	{
		// code...
		$errors = array();
		if(!Auth::access('student'))
		{
			$this->redirect('access_denied');
		}

		$tests = new Tests_model();
		$row = $tests->first('test_id',$id);
		
		$answers = new Answers_model();
		$query = "select question_id,answer,answer_mark from answers where user_id = :user_id && test_id = :test_id ";
		$saved_answers = $answers->query($query,[
			'user_id' => $user_id,
			'test_id' => $id,
		]);

		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['tests','tests'];

		if($row){
			$crumbs[] = [$row->test,''];
 
		}

		$page_tab = 'view';
		$db = new database();

 
		$limit = 3;
		$pager = new Pager($limit);
		$offset = $pager->offset;

		$results = false;
		$quest = new Questions_model();
		$questions = $quest->where('test_id',$id,'asc',$limit,$offset);
		$all_questions = $quest->query('select * from test_questions where test_id = :test_id',['test_id'=>$id]);
		
		$total_questions = is_array($all_questions) ? count($all_questions) : 0;

	 
		$data['answered_test_row'] 	= $tests->get_answered_test($id,$user_id);

		//set submitted variable
		$data['submitted'] = false;
		if(isset($data['answered_test_row']->submitted) && $data['answered_test_row']->submitted == 1)
		{
			$data['submitted'] = true;
		}

		//set marked variable
		$data['marked'] = false;
		if(isset($data['answered_test_row']->marked) && $data['answered_test_row']->marked == 1)
		{
			$data['marked'] = true;
		}

		

		//get student information
		if($data['answered_test_row']){
			
			$user = new User();
			$data['student_row'] = $user->first('user_id',$data['answered_test_row']->user_id);
		}

		$data['row'] 		= $row;
 		$data['crumbs'] 	= $crumbs;
		$data['page_tab'] 	= $page_tab;
		$data['questions'] 	= $questions;
		$data['total_questions'] 	= $total_questions;
		$data['all_questions'] 	= $all_questions;
		$data['results'] 	= $results;
		$data['errors'] 	= $errors;
		$data['pager'] 		= $pager;
		$data['saved_answers'] 		= $saved_answers;
		$data['user_id'] 		= $user_id;

		$this->view('marked-single',$data);
	}
}
