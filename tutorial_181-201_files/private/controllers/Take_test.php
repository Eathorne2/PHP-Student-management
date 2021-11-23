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
		$db = new database();

		//if something was posted
		if(count($_POST) > 0)
		{
			//save answers to database
			$arr1['user_id'] = Auth::getUser_id();
			$arr1['test_id'] = $id;

			$check = $db->query("select id from answered_tests where user_id = :user_id && test_id = :test_id limit 1",$arr1);
			
			if(!$check){

				$arr1['date'] = date("Y-m-d H:i:s");

				$query = "insert into answered_tests (user_id,test_id,date) values (:user_id,:test_id,:date)";
				$db->query($query,$arr1);
			}

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

			$page_number = "&page=1";
			if(!empty($_GET['page']))
			{
				$page_number = "&page=".$_GET['page'];
			}
			$this->redirect('take_test/'.$id.$page_number);
		}

		$limit = 3;
		$pager = new Pager($limit);
		$offset = $pager->offset;

		$results = false;
		$quest = new Questions_model();
		$questions = $quest->where('test_id',$id,'asc',$limit,$offset);
		$all_questions = $quest->query('select * from test_questions where test_id = :test_id',['test_id'=>$id]);
		
		$total_questions = is_array($all_questions) ? count($all_questions) : 0;

		//if its a test submit
		if(isset($_GET['submit'])){

			$query = "update answered_tests set submitted = 1,submitted_date = :sub_date where test_id = :test_id && user_id = :user_id limit 1";
			$tests->query($query,[
				'test_id'=>$id,
				'user_id'=>Auth::getUser_id(),
				'sub_date'=>date("Y-m-d H:i:s"),
			]);
		}

		$data['answered_test_row'] 	= $tests->get_answered_test($id,Auth::getUser_id());

		$data['submitted'] = false;
		if(isset($data['answered_test_row']->submitted) && $data['answered_test_row']->submitted == 1)
		{
			$data['submitted'] = true;
		}

		//get student information
		$user = new User();
		$data['student_row'] = $user->first('user_id',Auth::getUser_id());

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

		$this->view('take-test',$data);
	}



}
