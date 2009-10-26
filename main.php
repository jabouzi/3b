<?php

/**
 * todo commentaires partout
 */
 

class Main extends Controller{
	
	function Main()
	{
		parent::Controller();
		$this->load->helper(array('form', 'url'));
		$this->load->model('data_model');
		$this->load->library('session');
	}	
    
    function index()
    {
        if (isset($this->session->userdata['nom']))
		{
            if('IE' == $this->detect_browser())
            {
                $message['message'] = 'Cette application n\'est pas encore optimis&eacute;e pour Internet Explorer.<br />Vous pouvez utiliser Firefox ou Safari.';
                $this->load->view('confirm.php',$message);	
            }
            else
            {
                $css[] = "yui/build/calendar/assets/calendar.css";
                $css[] = "css/yui.css";
                $js[] = "yui/build/yahoo-dom-event/yahoo-dom-event.js";
                $js[] = "yui/build/calendar/calendar-min.js";
                $js[] = "js/test.js";	
                $data_header['javascript'] = $js;
                $data_header['stylesheet'] = $css;
                $selected['0'] = 'selected';
                $selected['1'] = 'notselected';
                $selected['2'] = 'notselected';
                $selected['3'] = 'notselected';
                $selected['4'] = 'notselected';
                $data_menu['selected'] = $selected;
                $this->load->view('header',$data_header);	
                $this->load->view('menu_content',$data_menu);	
                $this->load->view('cal');	
                $this->load->view('footer');
            }
        }
		else
		{
			 redirect('login/index');
		}
    }
	
	function main_data()
	{		
		if (isset($this->session->userdata['nom']))
		{
            if (isset($_POST['flag'])) $this->session->set_userdata($_POST);
            $familles = unserialize($this->session->userdata['permissions']);
            $dates = $this->format_dates();           
			$data['annonceur'] = $this->format_data($this->data_model->get_filtred('annonceur',$familles,'famille',$dates),'annonceur');
			$data['compagne'] = $this->format_data($this->data_model->get_filtred('compagne',$familles,'famille',$dates),'compagne');
			$data['marque'] = $this->format_data($this->data_model->get_filtred('marque',$familles,'famille',$dates),'marque');
			$data['regie'] = $this->format_data($this->data_model->get_filtred('regie',$familles,'famille',$dates),'regie');

            $js[] = "yui/build/yahoo-dom-event/yahoo-dom-event.js";
			$js[] = "yui/build/connection/connection-min.js";
			$js[] = "js/main.js";
            $selected['0'] = 'selected';
            $selected['1'] = 'notselected';
            $selected['2'] = 'notselected';
            $selected['3'] = 'notselected';
            $selected['4'] = 'notselected';
            $data_menu['selected'] = $selected;
			$data_header['javascript'] = $js;
			$this->load->view('header',$data_header);	
			$this->load->view('menu_content',$data_menu);	
			$this->load->view('content',$data);
			$this->load->view('right');		
			$this->load->view('footer');
		}
		else
		{
			 redirect('login/index');
		}
	}
    
    function afficher()
    {
        
        $data = $_POST;
        $keys = array_keys($_POST);
        
        //var_dump($data);
        //var_dump($keys);
        
        $count = count($keys);
        $result = array();
        
        if (1 == $count){
            for($i = 0; $i < count($data[$keys[0]]); $i++)
            {
                $str = $data[$keys[0]][$i];
                $where = "`" . $keys[0] . "` = '" . $this->skip_caracters2($data[$keys[0]][$i]) . "'";
                //echo $where . '<br />';
                $res = $this->data_model->get_panneaux($where);
                //var_dump($str); 
                //var_dump(count($res));
                //var_dump($res);
                $result[] = array(
                                $keys[0] => $data[$keys[0]][$i],                                    
                                'nbre panneaux' => count($res),
                                'panneaux' => $res
                            );
            }
        }            
        else if (2 == $count)
        {
            for($i = 0; $i < count($data[$keys[0]]); $i++)
            {
                for($j = 0; $j < count($data[$keys[1]]); $j++)
                {
                    $str = $data[$keys[0]][$i] . ' - ' . $data[$keys[1]][$j];
                    $where = "`" . $keys[0] . "` = '" . $this->skip_caracters2($data[$keys[0]][$i]) . "' AND `" . $keys[1] . "` = '" . $this->skip_caracters2($data[$keys[1]][$j]) . "'";
                    //echo $where . '<br />';
                    $res = $this->data_model->get_panneaux($where);
                    //var_dump($str); 
                    //var_dump(count($res));
                    //var_dump($res);
                    $result[] = array(
                                    $keys[0] => $data[$keys[0]][$i],
                                    $keys[1] => $data[$keys[1]][$j],                                      
                                    'nbre panneaux' => count($res),
                                    'panneaux' => $res
                                );
                }
            }
        }
        else if (3 == $count)
        {
            for($i = 0; $i < count($data[$keys[0]]); $i++)
            {
                for($j = 0; $j < count($data[$keys[1]]); $j++)
                {
                    for($k = 0; $k < count($data[$keys[2]]); $k++)
                    {
                        $str = $data[$keys[0]][$i] . ' - ' . $data[$keys[1]][$j] . ' - ' . $data[$keys[2]][$k];
                        $where = "`" . $keys[0] . "` = '" . $this->skip_caracters2($data[$keys[0]][$i]) . "' AND `" . $keys[1] . "` = '" . $this->skip_caracters2($data[$keys[1]][$j]) . "' AND `" . $keys[2] . "` = '" .  $this->skip_caracters2($data[$keys[2]][$k]) . "'";
                        //echo $where . '<br />';
                        $res = $this->data_model->get_panneaux($where);
                        //var_dump($str); 
                        //var_dump(count($re));
                        //var_dump($res);
                        $result[] = array(
                                        $keys[0] => $data[$keys[0]][$i],
                                        $keys[1] => $data[$keys[1]][$j],
                                        $keys[2] => $data[$keys[2]][$k],                                        
                                        'nbre panneaux' => count($res),
                                        'panneaux' => $res
                                    );
                    }
                }
            }
        }
        else if (4 == $count)
        {
            for($i = 0; $i < count($data[$keys[0]]); $i++)
            {
                for($j = 0; $j < count($data[$keys[1]]); $j++)
                {
                    for($k = 0; $k < count($data[$keys[2]]); $k++)
                    {
                        for($l = 0; $l < count($data[$keys[2]]); $l++)
                        {
                            $str = $data[$keys[0]][$i] . ' - ' .  $data[$keys[1]][$j] . ' - ' .  $data[$keys[2]][$k] . ' - ' . $data[$keys[3]][$l];
                            $where = "`" . $keys[0] . "` = '" . $this->skip_caracters2($data[$keys[0]][$i]) . "' AND `" . $keys[1] . "` = '" . $this->skip_caracters2($data[$keys[1]][$j]) . "' AND `" . $keys[2] . "` = '" .  $this->skip_caracters2($data[$keys[2]][$k]) . "' AND `" . $keys[3] . "` = '" . $this->skip_caracters2($data[$keys[3]][$l]) . "'";
                            //echo $where . '<br />';
                            $res = $this->data_model->get_panneaux($where); 
                            //var_dump($str);                         
                            //var_dump(count($res));
                            //var_dump($res);
                            $result[] = array(
                                            $keys[0] => $data[$keys[0]][$i],
                                            $keys[1] => $data[$keys[1]][$j],
                                            $keys[2] => $data[$keys[2]][$k],
                                            $keys[3] => $data[$keys[3]][$l],
                                            'nbre panneaux' => count($res),
                                            'panneaux' => $res
                                        );
                                            
                        }
                    }
                }
            }
        }        
        $selected['0'] = 'selected';
        $selected['1'] = 'notselected';
        $selected['2'] = 'notselected';
        $selected['3'] = 'notselected';
        $selected['4'] = 'notselected';
        $data_menu['selected'] = $selected;
        $data['result'] = $result;
        $this->load->view('header');	
        $this->load->view('menu_content',$data_menu);	
        $this->load->view('result',$data);
        //foreach
    }
	
	function format_data($result,$type)
	{
		$res = array();
		for($index = 0; $index < count($result); $index++)
		{
			$res[$index] = $result[$index]->$type;
		}
		return $res;
	}
	
	function skip_caracters($tab)
	{
		$temp = array();
		foreach($tab as $elem)
		{
			$temp[] = str_replace("'", "''", $elem);
		}
		return $temp;
	}
    
    function skip_caracters2($str)
	{
        $temp = str_replace("'", "''", $str);
		return $temp;
	}
	
	function skip_caracter($text)
	{
		$temp = str_replace("'", "''", $text);
		return $temp;
	}
	
	function filter($row,$text)
	{
		if (isset($this->session->userdata['nom']))
		{
			$total = $this->input->post('total');
			for ($i = 1; $i <= $total; $i++)
			{
				$rows[] = $this->skip_caracter($this->input->post($i));
			} 
            $dates = $this->format_dates();
			$result = $this->data_model->get_filtred($row,$rows,$text,$dates);
			$return = $row;
			foreach($result as $res)
			{
				$return .= '@'.$res->$row;
			}		
			print $return;		
		}
		else
	  	{
			redirect('login/index');
	  	}
	}
	
	function refresh()
	{
		if (isset($this->session->userdata['nom']))
		{
			$familles = unserialize($this->session->userdata['permissions']);
            $dates = $this->format_dates();
          	$data['annonceur'] = $this->format_data($this->data_model->get_filtred('annonceur',$familles,'famille',$dates),'annonceur');
			$data['compagne'] = $this->format_data($this->data_model->get_filtred('compagne',$familles,'famille',$dates),'compagne');
			$data['marque'] = $this->format_data($this->data_model->get_filtred('marque',$familles,'famille',$dates),'marque');
			$data['regie'] = $this->format_data($this->data_model->get_filtred('regie',$familles,'famille',$dates),'regie');
		
			echo $this->load->view('content',$data,true);            
		}
		else
		{
			redirect('login/index');
		}
	}	
    
    function format_dates()
    {
        if (!empty($this->session->userdata['in']))
        {
            $dates['year'] = date('Y',strtotime($this->session->userdata['in']));
            $dates['month1'] = date('m',strtotime($this->session->userdata['in']));
            $dates['month2'] = date('m',strtotime($this->session->userdata['out']));
            $begin = date('d',strtotime($this->session->userdata['in']));
            $end = date('d',strtotime($this->session->userdata['out']));
            if ($begin < 15)
                $dates['begin'] = 1;
            else $dates['begin'] = 2;
            if ($end < 15)
                $dates['end'] = 1;
            else $dates['end'] = 2;
             
        }
        else if (!empty($this->session->userdata['month']))
        {
            $dates['year'] = $this->session->userdata['year'];
            $dates['month'] = $this->session->userdata['month'];
        }
        else  
        {
            $dates['year'] = $this->session->userdata['year'];
        }
        return $dates;
    }
    
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
