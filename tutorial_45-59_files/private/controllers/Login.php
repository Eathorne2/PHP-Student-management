<?php

/**
 * login controller
 */
class Login extends Controller
{
	
	function index()
	{
		// code...
		$errors = array();

		if(count($_POST) > 0)
 		{

 			$user = new User();
 			if($row = $user->where('email',$_POST['email']))
 			{
 				$row = $row[0];
 				if(password_verify($_POST['password'], $row->password))
 				{
 					Auth::authenticate($row);
 					$this->redirect('/home');	
 				}
  			
 			}
  			
  			$errors['email'] = "Wrong email or password";

 		}

		$this->view('login',[
			'errors'=>$errors,
		]);
	}
}
