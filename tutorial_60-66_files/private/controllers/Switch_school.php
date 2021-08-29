<?php

/**
 * change school controller
 */
class Switch_school extends Controller
{
	
	function index($id = '')
	{
		// code...
		Auth::switch_school($id);
 		$this->redirect('schools');
 
	}
}
