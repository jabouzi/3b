<?php

class Admin extends Controller{
	
	function Admin()
	{
		parent::Controller();
		$this->load->helper(array('form', 'url'));
        $this->load->model('data_model');
        $this->load->library('session');
        $this->load->library('form_validation');       
        $this->config->set_item('language', 'french'); 
	}
	
	function index()
	{	
        if (isset($this->session->userdata['nom']))
		{
            
            $permissions = unserialize($this->session->userdata['permissions']);
            $data['permissions'] = $permissions;
            $css[] = "css/form.css";
            $selected['0'] = 'notselected';
            $selected['1'] = 'notselected';
            $selected['2'] = 'notselected';
            $selected['3'] = 'selected';
            $selected['4'] = 'notselected';
            $data['stylesheet'] = $css;
            $data_['selected'] = $selected;
            $this->load->view('header_admin',$data);	
            $this->load->view('menu_admin',$data_);	
            $this->load->view('change_password');
        }
        else
		{
			redirect('login/index');
		}
	}
	
	function manage_clients()
	{	
        if (isset($this->session->userdata['nom']))
		{
            $permissions = unserialize($this->session->userdata['permissions']);
            $data['permissions'] = $permissions;
            $clients = $this->data_model->get_names(2);
            $data['clients'] = $clients;
            $js[] = "yui/build/yahoo-dom-event/yahoo-dom-event.js";
			$js[] = "yui/build/connection/connection-min.js";
            $js[] = "js/admin.js";
			$data['javascript'] = $js;
            $selected['0'] = 'selected';
            $selected['1'] = 'notselected';
            $selected['2'] = 'notselected';
            $selected['3'] = 'notselected';
            $selected['4'] = 'notselected';
            $data['selected'] = $selected;
            $this->load->view('header_admin',$data);
            $this->load->view('menu_admin');	
            $this->load->view('manage_clients');
            $this->load->view('right_admin');
        }
        else
		{
			redirect('login/index');
		}
	}
	
	function manage_users()
	{	
        if (isset($this->session->userdata['nom']))
		{
            $permissions = unserialize($this->session->userdata['permissions']);
            $data['permissions'] = $permissions;
            $users = $this->data_model->get_names(3);             
            $data['users'] = $users;
            $js[] = "yui/build/yahoo-dom-event/yahoo-dom-event.js";
			$js[] = "yui/build/connection/connection-min.js";
            $js[] = "js/admin.js";         
            $selected['0'] = 'notselected';
            $selected['1'] = 'selected';
            $selected['2'] = 'notselected';
            $selected['3'] = 'notselected';
            $selected['4'] = 'notselected';
            $data['javascript'] = $js;
            $data['selected'] = $selected;
            $this->load->view('header_admin',$data);	
            $this->load->view('menu_admin');	
            $this->load->view('manage_users');
            $this->load->view('right_admin');	
        }
        else
		{
			redirect('login/index');
		}
	}
	
	function upload_file()
	{	
        if (isset($this->session->userdata['nom']))
		{
            ini_set('memory_limit','300M');
            ini_set('max_execution_time','36000');
            $config['upload_path'] = './upload/';
		    $config['allowed_types'] = 'php|txt|xls|xml';
		    $config['max_size']	= '0';		
		    $this->load->library('upload', $config);
	
		    if ( ! $this->upload->do_upload())
		    {
			    $error = array('error' => $this->upload->display_errors());
                $permissions = unserialize($this->session->userdata['permissions']);
                $data['permissions'] = $permissions;
                $css[] = "css/form.css";
                $js[] = "js/admin.js";       
                $data['javascript'] = $js;
                $selected['0'] = 'notselected';
                $selected['1'] = 'notselected';
                $selected['2'] = 'notselected';
                $selected['3'] = 'selected';
                $selected['4'] = 'notselected';
                $data['stylesheet'] = $css;
                $data['selected'] = $selected;
                $this->load->view('header_admin',$data);	
                $this->load->view('menu_admin');	
			    $this->load->view('upload_view', $error);
		    }	
		    else
		    {
			    $data = array('upload_data' => $this->upload->data());
			    $this->load->library('Excel/spreadsheet_Excel_Reader');
			    $excel = new Spreadsheet_Excel_Reader();

			// Set output Encoding.
			    $excel->setOutputEncoding('CP1251');
			
			//lecture du fichier excel
			    $excel->read('./upload/' . $data['upload_data']['file_name']);				

			    $array = $excel->sheets[0]['cells'];
			    $temp = array_shift($array);
			    var_dump($array);
			    //$this->data_model->insert_entry($array);
                
			    $this->load->view('header_admin');	
                $selected['0'] = 'notselected';
                $selected['1'] = 'notselected';
                $selected['2'] = 'notselected';
                $selected['3'] = 'selected';
                $selected['4'] = 'notselected';
                $data['selected'] = $selected;	
			    $this->load->view('upload_success', $data);
		    }
            //$this->load->view('footer');
        }
        else
		{
			redirect('login/index');
		}
	}
    
    function change_password()
	{	
        if (isset($this->session->userdata['nom']))
		{          
            $permissions = unserialize($this->session->userdata['permissions']);
            $data['permissions'] = $permissions;
            $this->form_validation->set_rules('password1', 'mot de passe', 'callback_password_check');
            $this->form_validation->set_rules('password2', 'nouveau mot de passe', 'required|matches[password3]|min_length[6]');
            $this->form_validation->set_rules('password3', 'nouveau mot de passe (2e)', 'required');
            $css[] = "css/form.css";
            $selected['0'] = 'notselected';
            $selected['1'] = 'notselected';
            $selected['2'] = 'notselected';
            $selected['3'] = 'notselected';
            $selected['4'] = 'selected';
            $data['stylesheet'] = $css;
            $data['selected'] = $selected;              
            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('header_admin',$data);	
                $this->load->view('menu_admin');
                $this->load->view('change_password');
            }
            else
            {
                $message['message'] = "Votre mot de passe a &eacute;t&eacute; chang&eacute; avec succ&egrave;s";
                $arr = array(                        
                        'password' => md5($this->input->post('password2'))                   
                    );   
                $res = $this->data_model->save_password($this->session->userdata['nom'],$this->session->userdata['email'],$arr);
                $this->load->view('header_admin',$data);	
                $this->load->view('menu_admin');
                $this->load->view('confirm',$message);
            }
            //$this->load->view('footer');
        }
        else
		{
			redirect('login/index');
		}
	}
    
    function add_user()
	{	
        if (isset($this->session->userdata['nom']))
		{
            $permissions = unserialize($this->session->userdata['permissions']);
            $data['permissions'] = $permissions;
            $this->form_validation->set_rules('nom', 'nom', 'required');
            $this->form_validation->set_rules('prenom', 'pr&eacute;nom', 'required');
            $this->form_validation->set_rules('username', 'nom d\'utilisateur', 'required|min_length[5]');
            $this->form_validation->set_rules('email', 'email', 'callback_email_check');
            $this->form_validation->set_rules('password1', 'mot de passe', 'required|matches[password2]|min_length[6]');
            $this->form_validation->set_rules('password2', 'mot de passe (2e)', 'required');
            $css[] = "css/form.css";
            $selected['0'] = 'notselected';
            $selected['1'] = 'notselected';
            $selected['2'] = 'selected';
            $selected['3'] = 'notselected';
            $selected['4'] = 'notselected';
            $data['stylesheet'] = $css;
            $data['selected'] = $selected;            
            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('header_admin',$data);	
                $this->load->view('menu_admin');
                $this->load->view('add_user');
            }
            else
            {
                $message['message'] = "L'usager a &eacute;t&eacute; ajout&eacute; avec succ&egrave;s";
                $arr = array(               
                        'nom' =>  $this->input->post('nom'),
                        'prenom' =>  $this->input->post('prenom'),   
                        'email' =>  $this->input->post('email'), 
                        'username' =>  $this->input->post('username'),                           
                        'active' =>  $this->input->post('active'),   
                        'permissions' =>  serialize($this->input->post('permissions')),   
                        'password' => md5($this->input->post('password1'))                   
                    );   
                $res = $this->data_model->save_user($arr,3);
                $this->load->view('header_admin',$data);	
                $this->load->view('menu_admin');
                $this->load->view('confirm',$message);
            }
            //$this->load->view('footer');
        }
        else
		{
			redirect('login/index');
		}
	}
    
    function get_data($id,$type)
    {
        $permissions = array();
        $datas = $this->data_model->get_data($id);
        if (2 == $type)
        {
            $familles = $this->data_model->get('famille'); 
        }
        else
        {
            $familles = array('0','1','2','3');
        }
        $permissions = unserialize($datas[0]->permissions);
        if (!$permissions) 
        {
            $permissions = array();
        }
        $data['data'] = $datas;
        $data['permissions'] = $permissions;           
        $data['familles']= $familles;
        if (2 == $type)
        {
            echo $this->load->view('client_data',$data,true);   
        }
        else{
            echo $this->load->view('user_data',$data,true); 
        }     
    }
    
    function get_right_data($id)
    {
        $clients = $this->data_model->get_right_data($id);
        $data['data'] = $clients;
        echo $this->load->view('right_data',$data,true);        
    }    
    
    function get_familles()
    {
        $familles = $this->data_model->get('famille');
        $res = '';
        foreach($familles as $famille)
        {
            $res .= '#'.$famille->famille;
        }       
        echo $res;     
    }
    
    function change_data($type)
    {
        $perms = explode('#',$this->input->post('permissions'));
        unset($perms[count($perms)-1]);	
        if ($this->input->post('active') == 'true') $active = 1;
        else $active = 0;
        if (2 == $type)
        {
            $arr = array(
                    'id' => $this->input->post('id'),
                    'nom' => $this->input->post('nom'),
                    'email' => $this->input->post('email'),
                    'contact' => $this->input->post('contact'),
                    'telephone' => $this->input->post('tel'),
                    'address' => $this->input->post('address'),
                    'active' => $active,
                    'permissions' => serialize($perms)
                   );  
        }
        else
        {
            $arr = array(
                    'id' => $this->input->post('id'),
                    'nom' => $this->input->post('nom'),
                    'email' => $this->input->post('email'),
                    'prenom' => $this->input->post('prenom'),                    
                    'active' => $active,
                    'permissions' => serialize($perms)
                   ); 
        }
        
        $res = $this->data_model->save_data($arr);
        print $res;
    }
    
    function change_notes_data()
    {	
        $arr = array(
                'id' => $this->input->post('id'),
                'nom' => $this->input->post('nom'),
                'notes' => $this->input->post('notes'),                
               );        
        
        $res = $this->data_model->save_notes_data($arr);
        print $res;
    }
    
    function password_check($str)
	{
        $pass = $this->data_model->get_password($this->session->userdata['nom'],$this->session->userdata['email']);
		if (md5($str) != $pass[0]->password)
		{
			$this->form_validation->set_message('password_check', 'Le %s entr&eacute; n\'est pas valide.');
			return FALSE;
		}
        else if ($str == '')
        {
            $this->form_validation->set_message('password_check', 'Le champ %s est obligatoire. Veuillez le compl&eacute;ter.');
			return FALSE;
        }
		else
		{
			return TRUE;
		}
	}
    
    function email_check($str)
    {
        $email = $this->data_model->check_email($str);
        if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $str))
        {
            $this->form_validation->set_message('email_check', 'L\'%s est invalide.');
			return FALSE;
        }
		else if (!empty($email))
		{
			$this->form_validation->set_message('email_check', 'L\'%s existe d&eacute;j&agrave;.');
			return FALSE;
		}
        else if ($str == '')
        {
            $this->form_validation->set_message('email_check', 'Le champ %s est obligatoire. Veuillez le compl&eacute;ter.');
			return FALSE;
        }
		else
		{
			return TRUE;
		}
    }
    
    function generatePassword($length=9, $strength=0) 
    {
        $vowels = 'aeuy';
        $consonants = 'bdghjmnpqrstvz';
        if ($strength & 1) {
            $consonants .= 'BDGHJLMNPQRSTVWXZ';
        }
        if ($strength & 2) {
            $vowels .= "AEUY";
        }
        if ($strength & 4) {
            $consonants .= '23456789';
        }
        if ($strength & 8) {
            $consonants .= '@#$%';
        }
     
        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $password;
    }

	
}

?>
