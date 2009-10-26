<?php

class Test extends Controller {
	
	function index()
	{
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
		$this->form_validation->set_rules('username', 'Username', 'callback_username_check');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
					
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('test');
		}
		else
		{
			$this->load->view('ok');
		}
	}
	
	function username_check($str)
	{
		if ($str == 'test')
		{
			$this->form_validation->set_message('username_check', 'The %s field can not be the word "test"');
			return FALSE;
		}
        else if ($str == '')
        {
            $this->form_validation->set_message('username_check', 'The %s field can not be empty');
			return FALSE;
        }
		else
		{
			return TRUE;
		}
	}
	
}
?>
