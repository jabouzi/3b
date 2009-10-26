<?php

class Upload extends Controller {
	
	function Upload()
	{
		parent::Controller();
		$this->load->helper(array('form', 'url'));
		$this->load->model('data_model');
	}
	
	function index()
	{	
	
		$this->load->view('upload_view', array('error' => ' ' ));
	
	}

	function do_upload()
	{
		$config['upload_path'] = './upload/';
		$config['allowed_types'] = 'php|txt|xls|xml';
		$config['max_size']	= '1000000';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			//$this->load->view('header');		
			$this->load->view('upload_view', $error);
			//$this->load->view('footer');
		}	
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$this->load->library('Excel/spreadsheet_Excel_Reader');
			//require_once 'Excel/reader.php';

			// ExcelFile($filename, $encoding);
			$excel = new Spreadsheet_Excel_Reader();

			// Set output Encoding.
			$excel->setOutputEncoding('CP1251');
			
			//lecture du fichier excel
			//chmod('./upload/' . $data['upload_data']['file_name'], 0777);
			$excel->read('./upload/' . $data['upload_data']['file_name']);
				
			//$liste = array($excel->sheets[0]['numRows'],2);
			$array = $excel->sheets[0]['cells'];
			$temp = array_shift($array);
			//var_dump($array);
			
			$this->data_model->insert_entry($array);	
	
			$this->load->view('upload_success', $data);

		}
	}	
}
?>
