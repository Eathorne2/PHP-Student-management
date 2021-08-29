<?php

/**
 * login controller
 */
class Signup extends Controller
{
	
	function index()
	{
		// code...
 		$mode = isset($_GET['mode']) ? $_GET['mode'] : '';
		$errors = array();
 		if(count($_POST) > 0)
 		{

 			$user = new User();

 			if($user->validate($_POST))
 			{
 				
 				$_POST['date'] = date("Y-m-d H:i:s");

 				$user->insert($_POST);
 				$redirect = $mode == 'students' ? 'students':'users';
 				$this->redirect($redirect);
 			}else
 			{
 				//errors
 				$errors = $user->errors;
 			}
 		}

		$this->view('signup',[
			'errors'=>$errors,
			'mode'=>$mode,
		]);
	}
}
