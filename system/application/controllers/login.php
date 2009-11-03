<?php
/* Skander Jabouzi 2009 login.php : gérer les login*/
class Login extends Controller{
	
	function Login()
	{
		parent::Controller();
		$this->load->helper(array('form', 'url'));
		$this->load->model('data_model');
		$this->load->library('session');
        $this->load->library('form_validation');       
        $this->config->set_item('language', 'french'); 
	}
	
    /*
     * page d'acceuil du login
     * */
	function index()
	{	        
        if('IE' == $this->detect_browser())
        {   // si on detecte ie on affiche ce message         
            $message['message'] = 'Cette application n\'est pas encore optimis&eacute;e pour Internet Explorer.<br />Vous pouvez utiliser Firefox ou Safari.';
            $this->load->view('confirm.php',$message);	
        }
        else
        {   // sinon on affiche le login
            $this->form_validation->set_rules('username', 'nom d\'usager', 'required');
            $this->form_validation->set_rules('password', 'mot de passe', 'required');

            $css[] = "css/form.css";
            $js[] = "yui/build/yahoo-dom-event/yahoo-dom-event.js";
            $js[] = "yui/build/connection/connection-min.js";
            $js[] = "js/login.js";	
            $data['javascript'] = $js;
            $data['stylesheet'] = $css;
            $login = $this->check_login($this->input->post('username'),$this->input->post('password'));
            if ($this->form_validation->run() == FALSE)
            {
                //$this->load->view('header',$data);
                $this->load->view('login');
            }            
            else if(count($login) == 0) // compte admin
            {
                $data['message'] = "Le nom d'usager et/ou le mot de passe n'est valide.";
                //$this->load->view('header',$data);
                $this->load->view('login',$data);
            }
            else if($login[0]->active == 0)
            {
                $data['message'] = "Votre compte n'est pas actif. Contacter 3B.";
                //$this->load->view('header',$data);
                $this->load->view('login',$data);
            }
            else if($login[0]->type == 1) // compte employé
            {
                $unique_id['user_key'] = md5(mktime());
                $this->session->set_userdata($unique_id);
                $permissions = array(0,1,2,3);
                $data['permissions'] = $permissions;
                $selected['0'] = 'notselected';
                $selected['1'] = 'notselected';
                $selected['2'] = 'notselected';
                $selected['3'] = 'notselected';
                $selected['4'] = 'selected';
                $data_['selected'] = $selected; 
                $this->load->view('header_admin',$data);
                $this->load->view('menu_admin',$data_);
                $this->load->view('change_password');
            }
            else if($login[0]->type == 2) // compte client
            {
                $unique_id['user_key'] = md5(mktime());
                $this->session->set_userdata($unique_id);
                $this->data_model->create_panneaux();
                $this->data_model->init_panneaux();
                redirect('main/index');
            }
            else if($login[0]->type == 3)
            {
                //$this->session->sess_create();
                $unique_id['user_key'] = md5(mktime());
                $this->session->set_userdata($unique_id);
                $permissions = unserialize($login[0]->permissions);                
                $data['permissions'] = $permissions;
                $selected['0'] = 'notselected';
                $selected['1'] = 'notselected';
                $selected['2'] = 'notselected';
                $selected['3'] = 'notselected';
                $selected['4'] = 'selected';
                $data['selected'] = $selected; 
                $this->load->view('header_admin',$data);
                $this->load->view('menu_admin');
                $this->load->view('change_password');
            }
            
        }
       
	}
    
    /*
     * Enregistrer un usager
     * */
	function register()
	{	
        $this->form_validation->set_rules('nom', 'nom', 'callback_nom_check');
        $this->form_validation->set_rules('username', 'nom d\'utilisateur', 'callback_username_check');
        $this->form_validation->set_rules('email', 'email', 'callback_email_check');
        $this->form_validation->set_rules('password1', 'mot de passe', 'required|matches[password2]|min_length[6]');
        $this->form_validation->set_rules('password2', 'mot de passe (2e)', 'required');
        $this->form_validation->set_rules('telephone', 'numero de t&eacute;l&eacute;phone', 'callback_telephone_check');
        $this->form_validation->set_rules('contact', 'contacte', 'required');
        $this->form_validation->set_rules('address', 'adresse', 'required');
		$css[] = "css/form.css";
		$data['stylesheet'] = $css;
		if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('header',$data);	
            $this->load->view('register');
        }
        else
        {
            $message['message'] = "Votre compte a &eacute;t&eacute; ajout&eacute; avec succ&egrave;s.<br />Vous allez &ecirc;tre contact&eacute bient&ocirc;t.";
            $arr = array(               
                    'nom' =>  $this->input->post('nom'),   
                    'email' =>  $this->input->post('email'), 
                    'username' =>  $this->input->post('username'), 
                    'contact' =>  $this->input->post('contact'), 
                    'telephone' =>  $this->input->post('telephone'), 
                    'address' =>  $this->input->post('address'), 
                    'password' => md5($this->input->post('password1'))                   
            );   
            $res = $this->data_model->save_user($arr,2);
            $this->load->view('header',$data);
            $this->load->view('confirm',$message);
        }
		//$this->load->view('footer');
	}
	
    /*
     * Changer un mot de passe
     * */
	function change_password()
	{	
		$css[] = "css/form.css";
		$data['stylesheet'] = $css;
        $selected['0'] = 'notselected';
        $selected['1'] = 'notselected';
        $selected['2'] = 'notselected';
        $selected['3'] = 'notselected';
        $selected['4'] = 'notselected';
        $data_menu['selected'] = $selected;
		$this->load->view('header',$data);	
        $this->load->view('menu_content',$data_menu);	
		$this->load->view('change_password');
		//$this->load->view('footer');
	}
	
    /*
     * Mot de passe oublié
     * */
	function forget_password()
	{	
		$css[] = "css/form.css";
		$data['stylesheet'] = $css;
		$this->load->view('header',$data);	
		$this->load->view('forget_password');
		//$this->load->view('footer');
	}
	
    /*
     * Vérifier le login
     * */
	function check_login($username,$password)
	{	
		$result = $this->data_model->check_login($username,$password);
		$return = "";
		if (count($result) > 0){
			$this->session->set_userdata($result[0]);					
			return $result;
		}
		else
        {
            return array();
        }
	}
	
	function logout()
	{
		$this->session->sess_destroy();
        $this->data_model->drop_view();
		redirect('login/index');
	}
    
    /*
     * Vérifier la validité d'un email
     * */
    function email_check($str)
    {
        $email = $this->data_model->check_email($str);
        if ($str == '')
        {
            $this->form_validation->set_message('email_check', 'Le champ %s est obligatoire. Veuillez le compl&eacute;ter.');
			return FALSE;
        }        
		else if (!empty($email))
		{
			$this->form_validation->set_message('email_check', 'L\'%s existe d&eacute;j&agrave;.');
			return FALSE;
		}
        else if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $str))
        {
            $this->form_validation->set_message('email_check', 'L\'%s est invalide.');
			return FALSE;
        }
		else
		{
			return TRUE;
		}
    }
    
    /*
     * Vérifier la validité du nom d'usager
     * */
    function nom_check($str)
    {
        $nom = $this->data_model->check_nom($str);
        if ($str == '')
        {
            $this->form_validation->set_message('nom_check', 'Le champ %s est obligatoire. Veuillez le compl&eacute;ter.');
			return FALSE;
        }
        else if (!empty($nom))
		{
			$this->form_validation->set_message('nom_check', 'Le %s existe d&eacute;j&agrave;.');
			return FALSE;
		}        
		else
		{
			return TRUE;
		}
    }
    
    /*
     * Vérifier la validité du téléphone
     * */
	function telephone_check($str)
    {
        if ($str == '')
        {
            $this->form_validation->set_message('telephone_check', 'Le champ %s est obligatoire. Veuillez le compl&eacute;ter.');
			return FALSE;
        }        	
        else if (!ereg("^[0-9]{8}$", $str))
        {
            $this->form_validation->set_message('telephone_check', 'L\'%s est invalide.');
			return FALSE;
        }	
		else
		{
			return TRUE;
		}
    }
    
    /*
     * Détécter le navigateur internet
     * */
    function detect_browser()
    {
        if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Gecko') )
        {
            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape') )
            {
                $browser = 'Netscape';
            }
                else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') )
            {
                $browser = 'Firefox';
            }
            else
            {
             $browser = 'Mozilla';
            }
        }
        else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') )
        {
           if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') )
           {
             $browser = 'Opera';
           }
           else
           {
             $browser = 'IE';
           }
        }
        else
        {
           $browser = 'Others';
        }

    return $browser;
    }
}

?>
