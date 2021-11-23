<?php

/**
 * make pdf controller
 */
class Make_pdf extends Controller
{
	
	function index($id = '',$user_id = '')
	{
		// code...
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$folder = 'generated_pdfs/';
		if(!file_exists($folder))
		{
			mkdir($folder,0777,true);
		}

 		require_once __DIR__ . '/../models/mpdf/autoload.php';
		
		$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];

		$mpdf = new \Mpdf\Mpdf([
		    
		    'fontdata' => $fontData + [
		        'roboto' => [
		            'R' => 'Roboto-Regular.ttf',
		            'I' => 'Roboto-Italic.ttf',
		        ]

		    ],
		   
		]);

		$html = file_get_contents(ROOT.'/make_test_pdf/'.$id.'/'.$user_id);
		$mpdf->WriteHTML($html);
		
		//get user details
		$user_class = new User();
		$user_row = $user_class->first('user_id',$user_id);

		$file_name = $folder.$user_row->firstname.'_'.$user_row->lastname.'_test_results_'.date("Y-m-d_H_i_s",time()).'.pdf';
		
		$mpdf->Output($file_name);

		if(file_exists($file_name)){

			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file_name)); //Absolute URL
			ob_clean();
			flush();
			readfile($file_name); //Absolute URL
			exit();
		}

  
	}
}
