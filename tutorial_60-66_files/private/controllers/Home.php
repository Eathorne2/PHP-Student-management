<?php

/**
 * home controller
 */
class Home extends Controller
{
	
	function index()
	{
		// code...
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		
		$this->view('home');
	}
}
