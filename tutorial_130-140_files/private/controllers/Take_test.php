<?php

/**
 * take test controller
 */
class Take_test extends Controller
{
	
	public function index($id = '')
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
		$query = "select question_id,answer from answers where user_id = :user_id && test_id = :test_id ";
		$saved_answers = $answers->query($query,[
			'user_id' => Auth::getUser_id(),
			'test_id' => $id,
		]);

		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['tests','tests'];

		if($row){
			$crumbs[] = [$row->test,''];

			if(!$row->disabled){

				$query = "update tests set editable = 0 where id = :id limit 1";
				$tests->query($query,['id'=>$row->id]);
			}

		}

		$page_tab = 'view';

		//if something was posted
		if(count($_POST) > 0)
		{
			//save answers to database

			foreach ($_POST as $key => $value) {
				// code...
				if(is_numeric($key)){

					//save
					$arr['user_id'] = Auth::getUser_id();
			        $arr['question_id'] = $key;
			        $arr['date'] = date("Y-m-d H:i:s");
			        $arr['test_id'] = $id;
			        $arr['answer'] = trim($value);
					
					//check if answer already exists
					$query = "select id from answers where user_id = :user_id && test_id = :test_id && question_id = :question_id limit 1";
					$check = $answers->query($query,[
						'user_id' => $arr['user_id'],
						'test_id' => $arr['test_id'],
						'question_id' => $arr['question_id'],
					]);

					if(!$check)
					{
						$answers->insert($arr);

					}else
					{
						$answer_id = $check[0]->id;

						unset($arr['user_id']);
				        unset($arr['question_id']);
				        unset($arr['date']);
				        unset($arr['test_id']);

						$answers->update($answer_id,$arr);
					}
				}
			}

			$this->redirect('take_test/'.$id);
		}

		$limit = 10;
 		$pager = new Pager($limit);
 		$offset = $pager->offset;

		$results = false;
		$quest = new Questions_model();
		$questions = $quest->where('test_id',$id,'asc');
		
		$total_questions = is_array($questions) ? count($questions) : 0;

		$data['row'] 		= $row;
 		$data['crumbs'] 	= $crumbs;
		$data['page_tab'] 	= $page_tab;
		$data['questions'] 	= $questions;
		$data['total_questions'] 	= $total_questions;
		$data['results'] 	= $results;
		$data['errors'] 	= $errors;
		$data['pager'] 		= $pager;
		$data['saved_answers'] 		= $saved_answers;


		$this->view('take-test',$data);
	}


	public function get_answer($saved_answers,$id)
	{

		if(!empty($saved_answers)){

			foreach ($saved_answers as $row) {
				// code...
				if($id == $row->question_id)
				{
					return $row->answer;
				}
			}
		}

		return '';
	}

	public function get_answer_percentage($questions,$saved_answers)
	{

		$total_answer_count = 0;
		if(!empty($questions))
		{
			foreach ($questions as $quest) {
				// code...
				$answer = $this->get_answer($saved_answers,$quest->id);
				if(trim($answer) != ""){
					$total_answer_count++;
				}
			}
		}

		if($total_answer_count > 0)
		{
			$total_questions = count($questions);

			return ($total_answer_count / $total_questions) * 100;
		}

		return 0;
	}

}
