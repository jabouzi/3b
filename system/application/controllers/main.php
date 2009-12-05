<?

/**
 * Skander Jabouzi 2009 main.php
 */
 

class Main extends Controller{
    
    function Main()
    {
        parent::Controller();
        $this->load->helper(array('form', 'url'));
        $this->load->model('data_model');
        $this->load->library('session');
    }    
    
    /**
     * Page d'acceuil de l'application où on affiche la selection des dates
     */
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
                $this->data_model->drop_view();
                $init = array('init' => 1);
                $this->session->unset_userdata($init);
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
                $this->load->view('cal_right');    
                $this->load->view('footer');
            }
        }
        else
        {
             redirect('login/index');
        }
    }
    
    /**
     * Page d'affichage des données
     */
    function main_data()
    {            
        
        if (isset($this->session->userdata['nom']))
        {
            ini_set('memory_limit','300M');
            ini_set('max_execution_time','36000');
            $afficher = array('afficher' => 1);
            $this->session->unset_userdata($afficher);
            $post_data['data'] = $_POST;
            $this->session->unset_userdata($post_data);
            if (isset($_POST['flag'])) $this->session->set_userdata($_POST);
            $familles = unserialize($this->session->userdata['permissions']);
            $dates = $this->format_dates();   
            if (!isset($this->session->userdata['init']))
            {
                $this->data_model->create_view($familles,$dates);  
                $init = array('init' => 1);
                $this->session->set_userdata($init);
                $this->session->set_userdata($dates);
            }  

            $data['annonceur'] = $this->format_data($this->data_model->init_data('annonceur'),'annonceur');
            $data['campagne'] = $this->format_data($this->data_model->init_data('campagne'),'campagne');
            $data['marque'] = $this->format_data($this->data_model->init_data('marque'),'marque');
            $data['regie'] = $this->format_data($this->data_model->init_data('regie'),'regie');
            $data['rue'] = $this->format_data($this->data_model->init_data('rue'),'rue');
            $data['format'] = $this->format_data($this->data_model->init_data('format'),'format');
           
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
    
    /**
     * Afficher le tableaux croisé
     */
    function afficher()
    {
        if (isset($this->session->userdata['nom']))
        {            
            if (!isset($this->session->userdata['afficher']))
            {                
                $afficher = array('afficher' => 1);
                $this->session->set_userdata($afficher);
                $post_data['data'] = $_POST;
                $this->session->set_userdata($post_data);
            }  

            if (!empty($_POST))
            {
                
                $post_data['data'] = $_POST;
                $this->session->set_userdata($post_data);
                $data['data'] = $_POST;     
                // var_dump($data['data']);           
                $keys = array('annonceur','campagne','format','marque','regie','rue');
                for ($type = 0; $type < count($keys); $type++)
                {
                    if ($_POST['o_'.$keys[$type]] != "") $data['keys'][$_POST['o_'.$keys[$type]] - 1] = $keys[$type];
                }                
                //var_dump($data['keys']);    
                $selected['0'] = 'selected';
                $selected['1'] = 'notselected';
                $selected['2'] = 'notselected';
                $selected['3'] = 'notselected';
                $selected['4'] = 'notselected';
                $js[] = "js/result.js";
                $data_header['javascript'] = $js;
                $data_menu['selected'] = $selected;
                $data['panneaux'] = $this->get_panneaux_count($data['data'],$data['keys']);              
                $panneaux['panneaux'] = serialize($data['panneaux']);      
                $this->data_model->save_panneaux($panneaux['panneaux']);
                $checked['0'] = 'checked=ckecked';
                $checked['1'] = '';
                $checked['2'] = '';
                $checked['3'] = '';
                $data_result['checked'] = $checked;
                $this->load->view('header',$data_header);    
                $this->load->view('menu_content',$data_menu);
                $this->load->view('result_menu',$data_result);        
                $this->load->view('result_'.count($data['keys']),$data);
                //$this->load->view('test',$data);
                
            }
            else{
                $selected['0'] = 'selected';
                $selected['1'] = 'notselected';
                $selected['2'] = 'notselected';
                $selected['3'] = 'notselected';
                $selected['4'] = 'notselected';
                $checked['0'] = 'checked=ckecked';
                $checked['1'] = '';
                $checked['2'] = '';
                $checked['3'] = '';
                $data_result['checked'] = $checked;
                $js[] = "js/result.js";
                $data_header['javascript'] = $js;
                $data_menu['selected'] = $selected;
                $this->load->view('header',$data_header);    
                $this->load->view('menu_content',$data_menu);    
                $this->load->view('result_menu',$data_result);    
                $res = $this->load->view('result_cached');
            }
        }
        else
        {
             redirect('login/index');
        }
    }
    
    /**
     * Afficher la page des graphes
     */
    function afficher_graphes()
    {
        if (isset($this->session->userdata['nom']))
        {
            $keys = array_keys($this->session->userdata['data']);
            if (isset($_POST['x'])) $data['selected']['x'] = $_POST['x'];
            else $data['selected']['x'] = $keys[0];
            if (isset($_POST['y'])) $data['selected']['y'] = $_POST['y'];
            else $data['selected']['y'] = 'nbre';             
            
            $count = $this->get_count_type($data['selected']['x'],$data['selected']['y']);
            $this->generate_images($data['selected']['x'],$data['selected']['y'],$count);
            $data['images'][] = $data['selected']['x'].$this->session->userdata['user_key']."_".$data['selected']['y']."1.png";
            $data['images'][] = $data['selected']['x'].$this->session->userdata['user_key']."_".$data['selected']['y']."2.png";
            if (isset($_POST['x'])) $data['selected']['x'] = $_POST['x'];
            else $data['selected']['x'] = 'annonceur';
            if (isset($_POST['x'])) $data['selected']['y'] = $_POST['y'];
            else $data['selected']['y'] = 'nbr';
            
            $selected['0'] = 'selected';
            $selected['1'] = 'notselected';
            $selected['2'] = 'notselected';
            $selected['3'] = 'notselected';
            $selected['4'] = 'notselected';
            $js[] = "js/result.js";
            $data_header['javascript'] = $js;
            $data_menu['selected'] = $selected;
            $checked['0'] = '';
            $checked['1'] = 'checked=ckecked';
            $checked['2'] = '';
            $checked['3'] = '';
            $data_result['checked'] = $checked;       
            $this->load->view('header',$data_header);    
            $this->load->view('menu_content',$data_menu);    
            $this->load->view('result_menu',$data_result);   
            $this->load->view('graphes',$data);  
        } 
        else
        {
             redirect('login/index');
        }
    }
    
    function afficher_carte()
    {
        $res = $this->data_model->get_panneaux_list();
        //var_dump($res);
        if (isset($this->session->userdata['nom']))
        {
            $data = array();
            $selected['0'] = 'selected';
            $selected['1'] = 'notselected';
            $selected['2'] = 'notselected';
            $selected['3'] = 'notselected';
            $selected['4'] = 'notselected';
            $js[] = "js/result.js";
            $data_header['javascript'] = $js;
            $data_menu['selected'] = $selected;
            $checked['0'] = '';
            $checked['1'] = '';
            $checked['2'] = '';
            $checked['3'] = 'checked=ckecked';
            $data_result['checked'] = $checked;   
            $data['panneaux'] = $res;
            $this->load->view('header',$data_header);
            $this->load->view('menu_content',$data_menu);
            $this->load->view('result_menu',$data_result);
            $this->load->view('carte',$data);  
        } 
        else
        {
            redirect('login/index');
        }
    }
    
    /**
     * Retourner le nombre des panneaux
     */
    function get_count_type($type1,$type2)
    {
        $this->load->library('tree'); 
        $res = $this->data_model->get_ser_panneaux();
        $panneaux = unserialize($res[0]->liste); 
        if ('nbre' == $type2) 
        {
            $depth = -1;
        }
        else 
        {
            $depth = 0;
        }
        
        $data = array();      
        if (1 == $this->session->userdata['data']['o_'.$type1])
        {
            for($i = 0; $i < count($panneaux); $i++)  
            {
                if ($panneaux[$i] != NULL){
                    $panneaux[$i]->getNodesByDepth($panneaux[$i]->getDepth()+$depth,$panneaux[$i]->getRoot());
                    $total = 0;
                    foreach($panneaux[$i]->getChildsByDepth() as $child)
                    {
                        $total += $child->getData();
                    }
                    $data[$panneaux[$i]->getRoot()->getData()] += $total;
                }
            }
        }
        else
        {
            foreach($this->session->userdata['data'][$type1] as $filtre)                     
            {
                //var_dump($filtre);
                for($i = 0; $i < count($panneaux); $i++)       
                {
                    $total = 0;                    
                    $panneaux[$i]->findChild($type1,$this->skip_caracters3($filtre),$panneaux[$i]->getRoot());
                    if ($panneaux[$i]->getChildFound())
                    {
                        $panneaux[$i]->getNodesByDepth($panneaux[$i]->getDepth()+$depth,$panneaux[$i]->getChildFound());
                        $total = 0;
                        foreach($panneaux[$i]->getChildsByDepth() as $child)
                        {
                            $total += $child->getData();
                        }
                        $data[$filtre] += $total;
                    }
                    
                }                
            }                      
        }
        return $data;    
    }
    
    function  afficher_pdf()
    {
        $selected['0'] = 'selected';
        $selected['1'] = 'notselected';
        $selected['2'] = 'notselected';
        $selected['3'] = 'notselected';
        $selected['4'] = 'notselected';
        $js[] = "js/result.js";
        $data_header['javascript'] = $js;
        $data_menu['selected'] = $selected;
        $checked['0'] = '';
        $checked['1'] = '';
        $checked['2'] = 'checked=ckecked';
        $checked['3'] = '';
        $data_result['checked'] = $checked;
        $this->load->view('header',$data_header);    
        $this->load->view('menu_content',$data_menu);    
        $this->load->view('result_menu',$data_result);    
        $this->load->view('pdf');
    }
    
    function rapport()
    {
        $this->load->plugin('tcpdf'); 
        
        // create new PDF document
        $pdf = TCPDF(); 

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('3B');
        $pdf->SetTitle('Rapport');
        $pdf->SetSubject('Rapport');
        $pdf->SetKeywords('Rapport');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        //set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        //set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        //set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 

        //set some language-dependent strings
        //$pdf->setLanguageArray($l); 
        
        if ($this->session->userdata['in'] != '') $res .= '<b>Dates</b> : ' . $this->session->userdata['in'] . ' &aacute; ' . $this->session->userdata['in'];
        else if ($this->session->userdata['month'] != '') $res .= '<b>Dates</b> : ' . $this->session->userdata['month'] . '/ ' . $this->session->userdata['year'];
        else $res .= '<b>Dates</b> : ' . $this->session->userdata['year'];
        $res .= '<br>';
        
        $keys = array('annonceur','campagne','format','marque','regie','rue');
        for ($type = 0; $type < count($keys); $type++)
        {
            if ($this->session->userdata['data']['o_'.$keys[$type]] != "") $data['keys'][$this->session->userdata['data']['o_'.$keys[$type]] - 1] = $keys[$type];               
            
        }          

        for ($index = 0; $index < count($data['keys']); $index++)
        {
            $res .= '<br><b>' . $data['keys'][$index] . '(s) : </b><br><br>';
            for ($indice = 0; $indice < count($this->session->userdata['data'][$data['keys'][$index]]); $indice++)
            {
                $res .= $this->session->userdata['data'][$data['keys'][$index]][$indice] . '<br>';
            }
            
        }                
        
        $pdf->SetFont('dejavusans', '', 10);


        $pdf->AddPage();                 

        $resumeTitle = '<br><h1>R&eacute;sum&eacute; de la s&eacute;l&eacute;ction : </h1>' . $res;
        // output the HTML content
        $pdf->writeHTML($resumeTitle, true, 0, true, 0);

        // reset pointer to the last page
        $pdf->lastPage();

        /*===================================*/

        // set font
        $pdf->SetFont('dejavusans', '', 10);

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        // Print a table

        // add a page
        $pdf->AddPage();

        // create some HTML content
        $htmlcontent = '<br><h1>Tableau crois&eacute; : </h1><br><br>'.file_get_contents('./system/application/views/result_cached.php','FILE_TEXT');
        // output the HTML content
        $pdf->writeHTML($htmlcontent, true, 0, true, 0);

        // reset pointer to the last page
        $pdf->lastPage();
        
        
        /*==================================*/    
        $count1 = $this->get_count_type('nbre');
        $count2 = $this->get_count_type('grp');
        
        for ($index = 0; $index < count($data['keys']); $index++)
        { 
            $this->generate_images($data['keys'][$index],'nbre',$count1);
            $this->generate_images($data['keys'][$index],'grp',$count2); 
        }
       
        $imageContent = '';        
        
        // Image example
        for ($index = 0; $index < count($data['keys']); $index++)
        {
            $pdf->AddPage();
            $image = $data['keys'][$index].$this->session->userdata['user_key']."_nbre1.png";
            $imageContent = '<br><h4>'. $data['keys'][$index].'/panneaux(1) : </h4><br><img src="./public/generated/'.$image.'" width="500" height="200" border="0"/><br>';
            $image = $data['keys'][$index].$this->session->userdata['user_key']."_nbre2.png";
            $imageContent .='<h4>'. $data['keys'][$index].'/panneaux(2) : </h4><br><img src="./public/generated/'.$image.'" width="500" height="200" border="0"/><br>';
            $pdf->writeHTML($imageContent, true, 0, true, 0);
            $pdf->lastPage();
            $pdf->AddPage();
            $image = $data['keys'][$index].$this->session->userdata['user_key']."_grp1.png";
            $imageContent ='<br><h4>'. $data['keys'][$index].'/grp(1) : </h4><br><img src="./public/generated/'.$image.'" width="500" height="200" border="0"/><br>';
            $image = $data['keys'][$index].$this->session->userdata['user_key']."_grp2.png";
            $imageContent .='<h4>'. $data['keys'][$index].'/grp(2) : </h4><br><img src="./public/generated/'.$image.'" width="500" height="200" border="0"/><br>';
            $pdf->writeHTML($imageContent, true, 0, true, 0);
            $pdf->lastPage();            
        }       
 

// ---------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('rapport.pdf', 'I');       

    }
    
    function generate_images($x,$y,$count)
    {
        $file = $_SERVER['DOCUMENT_ROOT']."/public/generated/".$x.$this->session->userdata['user_key']."_".$y."1.png";
        //if (!file_exists($file))
        //{                    
            $this->load->library('pChart/pchart');
            $this->load->library('pChart/pdata'); 
                    
            $keys = array_keys($count);
            // Dataset definition   
            $DataSet = new pData;  
            for ($i = 0; $i < count($keys); $i++)
            {
                $DataSet->AddPoint(array($count[$keys[$i]]),"Serie".$i);    
            }
                $DataSet->AddAllSeries();  
                $DataSet->SetAbsciseLabelSerie();  
            for ($i = 0; $i < count($keys); $i++)
            {
                //var_dump($keys[$i] . ' - ' . "Serie".$i);
                $DataSet->SetSerieName($keys[$i],"Serie".$i);    
            }
            #  $DataSet->SetYAxisUnit("°C");  
            #  $DataSet->SetXAxisUnit("h");  
                
            // Bar Chart
            
            // Initialise the graph
            $Test = new Pchart(800,230);
            $Test->setFontProperties($_SERVER['DOCUMENT_ROOT']."/system/application/libraries/Fonts/tahoma.ttf",8);
            $Test->setGraphArea(50,30,680,200);
            $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
            $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);
            $Test->drawGraphArea(255,255,255,TRUE);
            $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2,TRUE);   
            $Test->drawGrid(4,TRUE,230,230,230,50);
             
            // Draw the 0 line
            $Test->setFontProperties($_SERVER['DOCUMENT_ROOT']."/system/application/libraries/Fonts/tahoma.ttf",6);
            $Test->drawTreshold(0,143,55,72,TRUE,TRUE);
            
            // Draw the bar graph
            $Test->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE);
            
            // Finish the graph
            $Test->setFontProperties($_SERVER['DOCUMENT_ROOT']."/system/application/libraries/Fonts/tahoma.ttf",8);
            $Test->drawLegend(600,5,$DataSet->GetDataDescription(),255,255,255);
            $Test->setFontProperties("Fonts/tahoma.ttf",10);
            $Test->drawTitle(50,22,"Example 12",50,50,50,585);
            $Test->Render($_SERVER['DOCUMENT_ROOT']."/public/generated/".$x.$this->session->userdata['user_key']."_".$y."1.png");
            //$Test->Stroke($_SERVER['DOCUMENT_ROOT']."/public/generated/example12.png");
            
            // Pie Chart
            
            // Dataset definition 
            $DataSet = new Pdata;
            $DataSet->AddPoint(array(123),"Serie1");
            $DataSet->AddPoint(array_keys($count),"Serie2");
            $DataSet->AddAllSeries();
            $DataSet->SetAbsciseLabelSerie("Serie2");
            
            // Initialise the graph
            $Test = new Pchart(510,200);
            $Test->drawFilledRoundedRectangle(7,7,373,193,5,240,240,240);
            $Test->drawRoundedRectangle(5,5,375,195,5,230,230,230);
            
            // Draw the pie chart
            $Test->setFontProperties($_SERVER['DOCUMENT_ROOT']."/system/application/libraries/Fonts/tahoma.ttf",8);
            $Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),150,90,110,PIE_PERCENTAGE,TRUE,50,20,5);
            $Test->drawPieLegend(310,5,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
            
            $Test->Render($_SERVER['DOCUMENT_ROOT']."/public/generated/".$x.$this->session->userdata['user_key']."_".$y."2.png");
        //} */
    }
    
    function get_panneaux_count($data,$keys)
    {  
        $count = count($keys);
        if (1 == $count)
        {
            $result = $this->get_panneaux_count_1($data,$keys);
        }            
        else if (2 == $count)
        {
            $result = $this->get_panneaux_count_2($data,$keys);
        }
        else if (3 == $count)
        {
            $result = $this->get_panneaux_count_3($data,$keys);
        }
        else if (4 == $count)
        {
            $result = $this->get_panneaux_count_4($data,$keys);
        }  
        else if (5 == $count)
        {
            $result = $this->get_panneaux_count_5($data,$keys);
        }          
        else if (6 == $count)
        {
            $result = $this->get_panneaux_count_6($data,$keys);
        }
        return $result;
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
    
    function skip_caracters($arr)
    {
        $temp = array();
        foreach($arr as $elem)
        {
            $temp[] = str_replace("'", "''", $elem);
            $temp[] = str_replace("*plus", "+", $elem);
        }
        return $temp;
    }
    
    function skip_caracters2($str)
    {
        $temp1 = str_replace("'", "''", $str);
        $temp2 = str_replace("*plus", "+", $temp1);
        return $temp2;
    }
    
    function skip_caracters3($str)
    {
        $temp1 = str_replace("'", "`", $str);
        $temp2 = str_replace("*plus", "+", $temp1);
        return $temp2;
    }
    
    function skip_caracter($text)
    {
        $temp1 = str_replace("'", "''", $str);
        $temp2 = str_replace("*plus", "+", $temp1);
        return $temp2;
    }
    
    function filter($rowName)
    {
        if (isset($this->session->userdata['nom']))
        {
            $types = array('annonceur','campagne','marque','regie','rue','format');
            $data = array();
            $nbre[] =  $this->input->post('nbannonceur');
            $nbre[] =  $this->input->post('nbcampagne');
            $nbre[] =  $this->input->post('nbmarque');
            $nbre[] =  $this->input->post('nbregie');
            $nbre[] =  $this->input->post('nbrue');
            $nbre[] =  $this->input->post('nbformat');
          
            for ($type = 0; $type < count($types); $type++)
            {
                for ($nb = 0; $nb < $nbre[$type]; $nb++)
                {                    
                    $data[$types[$type]][] = $this->skip_caracters2($this->input->post($types[$type].$nb));  
                }                       
            }           

            $result = $this->data_model->get_filtred($rowName,$data);
            $return = $rowName;
            if (!empty($result))
            {
                foreach($result as $res)
                {
                    $return .= '@'.$res->$rowName;
                }    
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
            $data['annonceur'] = $this->format_data($this->data_model->init_data('annonceur'),'annonceur');
            $data['campagne'] = $this->format_data($this->data_model->init_data('campagne'),'campagne');
            $data['marque'] = $this->format_data($this->data_model->init_data('marque'),'marque');
            $data['regie'] = $this->format_data($this->data_model->init_data('regie'),'regie');
            $data['rue'] = $this->format_data($this->data_model->init_data('rue'),'rue');
            $data['format'] = $this->format_data($this->data_model->init_data('format'),'format');
                    
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
            $dates['year1'] = date('Y',strtotime($this->session->userdata['in']));
            $dates['year2'] = date('Y',strtotime($this->session->userdata['out']));
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
    
function get_panneaux_count_1($data,$keys)
{
    $this->load->library('tree'); 
    $result = array();
    for($i = 0; $i < count($data[$keys[0]]); $i++)
    {
        $where = "`" . $keys[0] . "` = '" . $this->skip_caracters2($data[$keys[0]][$i]) . "'";
        $res = $this->data_model->get_panneaux($where);
        $sum = 0;
        for ($l =0; $l < count($res); $l++)
        {
            $sum += $res[$l]->grp;
        }
        $count = count($res);
        if ($count > 0)
        {  
            $tree = new Tree();
            $tree->addRoot($keys[0],$this->skip_caracters3($data[$keys[0]][$i]));
            $index1 = $tree->insertRootChild('nbre',$count);
            $tree->insertChild('grp',$sum,$tree->getRoot()->getChildAt($index1)); 
            $result[] = $tree;
        }
    }
    return $result;
}


function get_panneaux_count_2($data,$keys)
{
    $this->load->library('tree'); 
    $result = array();
    $tempRoot = '';
    for($i = 0; $i < count($data[$keys[0]]); $i++)
    {
        if ($data[$keys[0]][$i] != $rootTemp)
        {
            $tree = new Tree();
            $tree->addRoot($keys[0],$this->skip_caracters3($data[$keys[0]][$i]));
            $tempRoot = $data[$keys[0]][$i];
        }
        for($j = 0; $j < count($data[$keys[1]]); $j++)
        {
            $where = "`" . $keys[0] . "` = '" . $this->skip_caracters2($data[$keys[0]][$i]) . "' AND `" . $keys[1] . "` = '" . $this->skip_caracters2($data[$keys[1]][$j]) . "'";
            $res = $this->data_model->get_panneaux($where);    
            $sum = 0;
            for ($z =0; $z < count($res); $z++)
            {
                $sum += $res[$z]->grp;
            }
            $count = count($res);
            if ($count > 0)
            {
                $index1 = $tree->insertRootChild($keys[1],$this->skip_caracters3($data[$keys[1]][$j]));
                $index2 = $tree->insertChild('nbre',$count,$tree->getRoot()->getChildAt($index1));                        
                $tree->insertChild('grp',$sum,$tree->getRoot()->getChildAt($index1)->getChildAt($index2));  
            }
        }
        $result[] = $tree;
    }
    return $result;
}


function get_panneaux_count_3($data,$keys)
{
    $this->load->library('tree'); 
    $result = array();
    $tempRoot = '';
    for($i = 0; $i < count($data[$keys[0]]); $i++)
    {
        if ($data[$keys[0]][$i] != $rootTemp)
        {
            $tree = new Tree();
            $tree->addRoot($keys[0],$this->skip_caracters3($data[$keys[0]][$i]));
            $tempRoot = $data[$keys[0]][$i];
        }
        for($j = 0; $j < count($data[$keys[1]]); $j++)
        {
            for($k = 0; $k < count($data[$keys[2]]); $k++)
            {
                $str = $data[$keys[0]][$i] . ' - ' . $data[$keys[1]][$j] . ' - ' . $data[$keys[2]][$k];
                $where = "`" . $keys[0] . "` = '" . $this->skip_caracters2($data[$keys[0]][$i]) . "' AND `" . $keys[1] . "` = '" . $this->skip_caracters2($data[$keys[1]][$j]) . "' AND `" . $keys[2] . "` = '" .  $this->skip_caracters2($data[$keys[2]][$k]) . "'";
                $res = $this->data_model->get_panneaux($where);   
                $sum = 0;
                for ($z =0; $z < count($res); $z++)
                {
                    $sum += $res[$z]->grp;
                }
                $count = count($res);
                if ($count > 0) 
                {                            
                    $index1 = $tree->insertRootChild($keys[1],$this->skip_caracters3($data[$keys[1]][$j]));
                    $index2 = $tree->insertChild($keys[2],$this->skip_caracters3($data[$keys[2]][$k]),$tree->getRoot()->getChildAt($index1));                        
                    $index3 = $tree->insertChild('nbre',$count,$tree->getRoot()->getChildAt($index1)->getChildAt($index2));                        
                    $tree->insertChild('grp',$sum,$tree->getRoot()->getChildAt($index1)->getChildAt($index2)->getChildAt($index3));    
                }                        
            }                   
        }
        $result[] = $tree;
    }
    return $result;
}



function get_panneaux_count_4($data,$keys)
{
    $this->load->library('tree'); 
    //require_once(BASEPATH.'application/libraries/Tree.php');
    $result = array();
    $tempRoot = '';
    for($i = 0; $i < count($data[$keys[0]]); $i++)
    {
        if ($data[$keys[0]][$i] != $rootTemp)
        {
            $tree = new Tree();
            $tree->addRoot($keys[0],$this->skip_caracters3($data[$keys[0]][$i]));
            $tempRoot = $data[$keys[0]][$i];
        }
        for($j = 0; $j < count($data[$keys[1]]); $j++)
        {
            for($k = 0; $k < count($data[$keys[2]]); $k++)
            {
                for($l = 0; $l < count($data[$keys[3]]); $l++)
                {
                    $where = "`" . $keys[0] . "` = '" . $this->skip_caracters2($data[$keys[0]][$i]) . "' AND `" . $keys[1] . "` = '" . $this->skip_caracters2($data[$keys[1]][$j]) . "' AND `" . $keys[2] . "` = '" .  $this->skip_caracters2($data[$keys[2]][$k]) . "' AND `" . $keys[3] . "` = '" . $this->skip_caracters2($data[$keys[3]][$l]) . "'";
                    $res = $this->data_model->get_panneaux($where); 
                    $sum = 0;
                    for ($z =0; $z < count($res); $z++)
                    {
                        $sum += $res[$z]->grp;
                    }
                    $count = count($res);
                    if ($count > 0) 
                    {                                 
                        $index1 = $tree->insertRootChild($keys[1],$this->skip_caracters3($data[$keys[1]][$j]));
                        $index2 = $tree->insertChild($keys[2],$this->skip_caracters3($data[$keys[2]][$k]),$tree->getRoot()->getChildAt($index1));
                        $index3 = $tree->insertChild($keys[3],$this->skip_caracters3($data[$keys[3]][$l]),$tree->getRoot()->getChildAt($index1)->getChildAt($index2));
                        $index4 = $tree->insertChild('nbre',$count,$tree->getRoot()->getChildAt($index1)->getChildAt($index2)->getChildAt($index3));                        
                        $tree->insertChild('grp',$sum,$tree->getRoot()->getChildAt($index1)->getChildAt($index2)->getChildAt($index3)->getChildAt($index4));    
                    }                                            
                }
            }                    
        }
        $result[] = $tree;
    }
    return $result;
}



function get_panneaux_count_5($data,$keys)
{
    $this->load->library('tree'); 
    $result = array();
    $tempRoot = '';
    for($i = 0; $i < count($data[$keys[0]]); $i++)
    {
        if ($data[$keys[0]][$i] != $rootTemp)
        {
            $tree = new Tree();
            $tree->addRoot($keys[0],$this->skip_caracters3($data[$keys[0]][$i]));
            $tempRoot = $data[$keys[0]][$i];
        }
        for($j = 0; $j < count($data[$keys[1]]); $j++)
        {
            for($k = 0; $k < count($data[$keys[2]]); $k++)
            {
                for($l = 0; $l < count($data[$keys[3]]); $l++)
                {
                    for($m = 0; $m < count($data[$keys[4]]); $m++)
                    {
                        $where = "`" . $keys[0] . "` = '" . $this->skip_caracters2($data[$keys[0]][$i]) . "' AND `" . $keys[1] . "` = '" . $this->skip_caracters2($data[$keys[1]][$j]) . "' AND `" . $keys[2] . "` = '" .  $this->skip_caracters2($data[$keys[2]][$k]) . "' AND `" . $keys[3] . "` = '" . $this->skip_caracters2($data[$keys[3]][$l]) . "' AND `" . $keys[4] . "` = '" . $this->skip_caracters2($data[$keys[4]][$m]) . "'";
                        $res = $this->data_model->get_panneaux($where); 
                        $sum = 0;
                        for ($z =0; $z < count($res); $z++)
                        {
                            $sum += $res[$z]->grp;
                        }
                        $count = count($res);
                        if ($count > 0) 
                        {                                 
                            $index1 = $tree->insertRootChild($keys[1],$this->skip_caracters3($data[$keys[1]][$j]));
                            $index2 = $tree->insertChild($keys[2],$this->skip_caracters3($data[$keys[2]][$k]),$tree->getRoot()->getChildAt($index1));
                            $index3 = $tree->insertChild($keys[3],$this->skip_caracters3($data[$keys[3]][$l]),$tree->getRoot()->getChildAt($index1)->getChildAt($index2));
                            $index4 = $tree->insertChild($keys[4],$this->skip_caracters3($data[$keys[4]][$m]),$tree->getRoot()->getChildAt($index1)->getChildAt($index2)->getChildAt($index3));
                            $index5 = $tree->insertChild('nbre',$count,$tree->getRoot()->getChildAt($index1)->getChildAt($index2)->getChildAt($index3)->getChildAt($index4));                        
                            $tree->insertChild('grp',$sum,$tree->getRoot()->getChildAt($index1)->getChildAt($index2)->getChildAt($index3)->getChildAt($index4)->getChildAt($index5));    
                        }                          
                    }                                        
                }
            }            
        }
        $result[] = $tree;
    }
    return $result;
}



function get_panneaux_count_6($data,$keys)
{
    $this->load->library('tree'); 
    $result = array();
    $tempRoot = '';
    for($i = 0; $i < count($data[$keys[0]]); $i++)
    {
        if ($data[$keys[0]][$i] != $rootTemp)
        {
            $tree = new Tree();
            $tree->addRoot($keys[0],$this->skip_caracters3($data[$keys[0]][$i]));
            $tempRoot = $data[$keys[0]][$i];
        }
        for($j = 0; $j < count($data[$keys[1]]); $j++)
        {
            for($k = 0; $k < count($data[$keys[2]]); $k++)
            {
                for($l = 0; $l < count($data[$keys[3]]); $l++)
                {
                    for($m = 0; $m < count($data[$keys[4]]); $m++)
                    {
                        for($n = 0; $n < count($data[$keys[5]]); $n++)
                        {
                            $where = "`" . $keys[0] . "` = '" . $this->skip_caracters3($data[$keys[0]][$i]) . "' AND `" . $keys[1] . "` = '" . $this->skip_caracters2($data[$keys[1]][$j]) . "' AND `" . $keys[2] . "` = '" .  $this->skip_caracters2($data[$keys[2]][$k]) . "' AND `" . $keys[3] . "` = '" . $this->skip_caracters2($data[$keys[3]][$l]) .  "' AND `" . $keys[4] . "` = '" . $this->skip_caracters2($data[$keys[4]][$m]) . "' AND `" . $keys[5] . "` = '" . $this->skip_caracters2($data[$keys[5]][$n]) . "'";
                            $res = $this->data_model->get_panneaux($where); 
                            $sum = 0;
                            for ($z =0; $z < count($res); $z++)
                            {
                                $sum += $res[$z]->grp;
                            }
                            $count = count($res);
                            if ($count > 0) 
                            {                                 
                                $index1 = $tree->insertRootChild($keys[1],$this->skip_caracters3($data[$keys[1]][$j]));
                                $index2 = $tree->insertChild($keys[2],$this->skip_caracters3($data[$keys[2]][$k]),$tree->getRoot()->getChildAt($index1));
                                $index3 = $tree->insertChild($keys[3],$this->skip_caracters3($data[$keys[3]][$l]),$tree->getRoot()->getChildAt($index1)->getChildAt($index2));
                                $index4 = $tree->insertChild($keys[4],$this->skip_caracters3($data[$keys[4]][$m]),$tree->getRoot()->getChildAt($index1)->getChildAt($index2)->getChildAt($index3));
                                $index5 = $tree->insertChild($keys[5],$this->skip_caracters3($data[$keys[5]][$n]),$tree->getRoot()->getChildAt($index1)->getChildAt($index2)->getChildAt($index3)->getChildAt($index4));
                                $index6 = $tree->insertChild('nbre',$count,$tree->getRoot()->getChildAt($index1)->getChildAt($index2)->getChildAt($index3)->getChildAt($index4)->getChildAt($index5));                        
                                $tree->insertChild('grp',$sum,$tree->getRoot()->getChildAt($index1)->getChildAt($index2)->getChildAt($index3)->getChildAt($index4)->getChildAt($index5)->getChildAt($index6));    
                            }  
                        }
                    }                                        
                }
            }
        }
        $result[] = $tree;
    }
    return $result;
}

}

?>
