<?php
/*
 * Skander Jabouzi 2009 data_model.php (les requêtes sql)
 * */
class data_model extends Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function data_model()
    {
        // Call the Model constructor
        parent::Model();
        $this->load->library('session');
    }    

    /*
     * Ajouter des données à la base de données
     * */
    function insert_entry($entries)
    {
        $fields = array('annee',
                        'mois',
                        'quinzaine',
                        'id_face',
                        'x',
                        'y',
                        'rue',
                        'sig',
                        'regie',
                        'nb_faces',
                        'id_regie',
                        'support',
                        'format',
                        'type',
                        'grp',
                        'feuille',
                        'campagne',
                        'marque',
                        'annonceur',
                        'famille',
                        'groupe',
                        'variete',
                        'expiree',
                        'tarif',
                        'campagne_brut',
                        '23',
                        '21',
                        'test',
                        'modification');

        foreach($entries as $entry)
        {
            //$index = 0;
            $keys = array_keys($entry);
            $temp = array();
            for($index = 1; $index <= count($fields); $index++)
            {
                if (in_array($index,$keys))
                {
                    $temp[$fields[$index-1]] = $entry[$index];
                }
                else{
                    $temp[$fields[$index-1]] = NULL;
                }                
            }
            $this->db->insert('3b_entries', $temp);
        }        
    }

    /*
     * Retourner les valeurs d'une donné spécifique
     * */
    function get($row)
    {
        $this->db->distinct();
        $this->db->select($row);
        $query = $this->db->get('3b_entries');
        return $query->result();
    }        
    
    /*
     * Retourner les résultats d'une séléction (filtre)
     * */
    function get_results($data)
    {
        $where = "annonceur IN ('" . implode("', '", $data['annonceurs']) . "') OR famille IN ('" . implode("', '",$data['familles']) . "') OR campagne IN ('" . implode("', '",$data['campagnes']) . "')" .
                 "OR marque IN ('" . implode("', '",$data['marques']) . "') OR regie IN ('" . implode("', '",$data['regies']) .  "')" . 
                 "AND annee >= " . $data['year1'] . " AND annee <= " . $data['year2'] . 
                 " AND mois >= " . $data['month1'] . " AND mois <= " . $data['month2'];      
          
        $this->db->select('id_face,format,type');
        $this->db->where($where);
        $query = $this->db->get('3b_entries');
        return $query->result();
    }
    
    /*
     * Vérifier le login
     * */
    function check_login($username,$password)
    {
        $where =  "username = '" . $username . "' AND password = '" . md5($password) . "'";
        $this->db->select('nom,prenom,email,type,active,permissions');
        $this->db->where($where);
        $query = $this->db->get('3b_users');
        return $query->result();
    }
    
    /*
     * Retourner les infos d'un usager
     * */
    function get_data($id)
    {
        $where = "id ='" . $id . "'";
        $this->db->select('id,nom,prenom,email,type,active,permissions,contact,telephone,address');
        $this->db->where($where);
        $query = $this->db->get('3b_users');
        return $query->result();
    }
    
    /*
     * Retourner les infos supplémentaires d'un usager
     * */    
    function get_right_data($id)
    {
        $where = "id ='" . $id . "'";
        $this->db->select('notes,createdAt,modifiedAt');
        $this->db->where($where);
        $query = $this->db->get('3b_users');
        return $query->result();
    }    

    /*
     * Retourner les usagers
     * */    
    function get_names($type)
    {
        $where = "type = '" . $type . "'";
        $this->db->select('id,nom,prenom');
        $this->db->where($where);
        $query = $this->db->get('3b_users');
        return $query->result();
    }    
    
    /*
     * Sauvegarder les changements des données
     * */
    function save_data($data)
    {
        $data['modifiedAt'] = date ("Y-m-d H:i:s");
        $where = "id = '" . $data['id'] . "'";
        $this->db->where($where);
        $this->db->update('3b_users', $data);
    }
    
    /*
     * Sauvegarder les changements des données supplémentaires
     * */
    function save_notes_data($data)
    {
        $data['modifiedAt'] = date ("Y-m-d H:i:s");
        $where = "id = '" . $data['id'] . "'";
        $this->db->where($where);
        $this->db->update('3b_users', $data);
    }
    
    /*
     * Retourner le mot de passe
     * */
    function get_password($nom,$email)
    {
        $where = "nom ='" . $nom . "' AND email = '" . $email . "'";
        $this->db->select('password');
        $this->db->where($where);
        $query = $this->db->get('3b_users');
        return $query->result();
    }
    
    /*
     * Sauvegarder le mot de passe
     * */
    function save_password($nom,$email,$data)
    {
        $data['modifiedAt'] = date ("Y-m-d H:i:s");
        $where = "nom ='" . $nom . "' AND email = '" . $email . "'";
        $this->db->where($where);
        $this->db->update('3b_users', $data);
    }
    
    /*
     * Sauvegarder ou ajouter un usager
     * */
    function save_user($data,$type)
    {
        $data['createdAt'] = date ("Y-m-d H:i:s");
        $data['type'] = $type;
        $this->db->insert('3b_users', $data);
    }

    /*
     * Vérifier l'exitance d'un email
     * */    
    function check_email($email)
    {
        $where = "email ='" . $email . "'";
        $this->db->select('id');
        $this->db->where($where);
        $query = $this->db->get('3b_users');
        return $query->result();
    }
    
    /*
     * Vérifier l'exitance d'un nom
     * */
    function check_nom($nom)
    {
        $where = "nom ='" . $nom . "'";
        $this->db->select('id');
        $this->db->where($where);
        $query = $this->db->get('3b_users');
        return $query->result();
    }
    
    /*
     * Retourner les panneaux filtrés
     * */
    function create_panneaux_list()
    {
        $query = "DROP TABLE IF EXISTS panneaux_list_" . $this->session->userdata['user_key'];
        $this->db->query($query); 
        $query = " CREATE TABLE IF NOT EXISTS panneaux_list_" . $this->session->userdata['user_key'] . " (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `id_face` int(5) DEFAULT NULL,
                `latitude` varchar(30) DEFAULT NULL,
                `longitude` varchar(30) DEFAULT NULL,
                `rue` varchar(300),
                `ville` varchar(300),
                `latitude_ville` varchar(30) DEFAULT NULL,
                `longitude_ville` varchar(30) DEFAULT NULL,
                `format` varchar(20) DEFAULT NULL,
                `type` varchar(20) DEFAULT NULL, 
                `regie` varchar(50) DEFAULT NULL,
                `campagne` varchar(100),
                `marque` varchar(100) DEFAULT NULL,
                `annonceur` varchar(100) DEFAULT NULL,
                `visuel` varchar(100) DEFAULT NULL,
                PRIMARY KEY (`id`)
                )";                
        $this->db->query($query);
        $query = "ALTER TABLE `panneaux_list_" . $this->session->userdata['user_key'] . "` ADD INDEX(id_face)";
        $this->db->query($query);
        $query = "ALTER TABLE `panneaux_list_" . $this->session->userdata['user_key'] . "` ADD INDEX(type)";
        $this->db->query($query);
        $query = "ALTER TABLE `panneaux_list_" . $this->session->userdata['user_key'] . "` ADD INDEX(rue)";
        $this->db->query($query);
        $query = "ALTER TABLE `panneaux_list_" . $this->session->userdata['user_key'] . "` ADD INDEX(ville)";
        $this->db->query($query);
        $query = "ALTER TABLE `panneaux_list_" . $this->session->userdata['user_key'] . "` ADD INDEX(format)";
        $this->db->query($query);
        $query = "ALTER TABLE `panneaux_list_" . $this->session->userdata['user_key'] . "` ADD INDEX(latitude)";
        $this->db->query($query);
        $query = "ALTER TABLE `panneaux_list_" . $this->session->userdata['user_key'] . "` ADD INDEX(longitude)";
        $this->db->query($query);
        $query = "ALTER TABLE `panneaux_list_" . $this->session->userdata['user_key'] . "` ADD INDEX(latitude_ville)";
        $this->db->query($query);
        $query = "ALTER TABLE `panneaux_list_" . $this->session->userdata['user_key'] . "` ADD INDEX(longitude_ville)";
        $this->db->query($query);
        $query = "ALTER TABLE `panneaux_list_" . $this->session->userdata['user_key'] . "` ADD INDEX(regie)";
        $this->db->query($query);
        $query = "ALTER TABLE `panneaux_list_" . $this->session->userdata['user_key'] . "` ADD INDEX(campagne)";
        $this->db->query($query);
        $query = "ALTER TABLE `panneaux_list_" . $this->session->userdata['user_key'] . "` ADD INDEX(marque)";
        $this->db->query($query);
        $query = "ALTER TABLE `panneaux_list_" . $this->session->userdata['user_key'] . "` ADD INDEX(annonceur)";
        $this->db->query($query);
        $query = "ALTER TABLE `panneaux_list_" . $this->session->userdata['user_key'] . "` ADD INDEX(visuel)";
        $this->db->query($query);
    }
    
    /*
     * Retourner les panneaux filtrés
     * */
    function get_panneaux($where)
    {
        $sql = "SELECT id_face, rue, format, type, regie, campagne, marque, annonceur, visuel, latitude, longitude, ville, longitude_ville, latitude_ville  FROM " .
                'filtres_' . $this->session->userdata['user_key'] .", coordonnees_panneaux, coordonnees_villes WHERE
                id_face =  coordonnees_panneaux.id AND id_ville = coordonnees_villes.id AND" . $where;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /*
     * Retourner les panneaux filtrés
     * */
    function set_panneaux($panneaux)
    {
        //var_dump($panneaux);
        $this->db->delete('panneaux_list_' . $this->session->userdata['user_key']);
        for ($i = 0; $i < count($panneaux); $i++)
        {
            foreach ($panneaux[$i] as $panneau)
            {
                $this->db->insert('panneaux_list_' . $this->session->userdata['user_key'], $panneau);
            }
        }
    }
    
    /*
     * Retourner les panneaux filtrés
     * */
    function get_nbre_fixe_panneaux($where)
    {
        $where .= " AND `type` = 'FIXE' ";
        $this->db->select('type');
        $this->db->where($where);
        $this->db->from('filtres_' . $this->session->userdata['user_key']);
        return  $this->db->count_all_results();
    }
    
    /*
     * Retourner les panneaux filtrés
     * */
    function get_nbre_face_panneaux($where)
    {
        $this->db->select('id_face');
        $this->db->where($where);
        $this->db->from('filtres_' . $this->session->userdata['user_key']);
        return  $this->db->count_all_results();
    }
    
    /*
     * Retourner les panneaux filtrés
     * */
    function get_nbre_panneaux($where)
    {        
        $query = $this->db->query("SELECT * FROM " . 'filtres_' . $this->session->userdata['user_key'] . ", coordonnees_panneaux WHERE id_face = coordonnees_panneaux.id AND" . $where . " GROUP BY latitude, longitude ");
        return count($query->result());
    }
    
    /*
     * Retourner les panneaux filtrés
     * */
    function get_grp_panneaux($where)
    {
        $this->db->select_sum('grp');
        //$this->db->distinct();
        $this->db->where($where);
        $query = $this->db->get('filtres_' . $this->session->userdata['user_key']);
        return $query->result();
    }
    
    /*
     * Retourner les panneaux filtrés
     * */
    function get_tarif_panneaux($where)
    {
        $this->db->select_sum('tarif');
        $this->db->where($where);
        $query = $this->db->get('filtres_' . $this->session->userdata['user_key']);
        return $query->result();
    }
    
    /*
     * Retourner les panneaux filtrés
     * */
    function get_total_panneaux($where)
    {
        return $this->db->count_all('filtres_' . $this->session->userdata['user_key']);
    }
    
    /*
     * Créer une vue 
     * */
    function create_view($familles,$dates)
    {
        if (isset($dates['begin']))
        {            
            $where = " WHERE annee in ('" . $dates['year1'] . "','" . $dates['year2'] . "') AND mois in ('" . $dates['month1'] . "','" . $dates['month2'] . "') AND quinzaine in ('" . $dates['begin'] . "','" . $dates['end'] . "')";
        }
        else if(isset($dates['month']))
        {
            $where = " WHERE annee = '" . $dates['year'] . "'  AND mois = '" . $dates['month'] . "'";
        }
        else
        {
            $where = " WHERE annee = '" . $dates['year'] . "'";
        }
        $where .=  " AND famille IN ('" . implode("', '", $familles) . "')";
        $query  = " CREATE TABLE filtres_" . $this->session->userdata['user_key'] . "(
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `id_face` int(5) DEFAULT NULL,
                    `rue` varchar(300) DEFAULT NULL, 
                    `id_ville` int(3) DEFAULT NULL,                
                    `format` varchar(20) DEFAULT NULL,
                    `type` varchar(20) DEFAULT NULL,
                    `grp` varchar(10) DEFAULT NULL,
                    `regie` varchar(50) DEFAULT NULL,
                    `campagne` varchar(100) DEFAULT NULL,
                    `marque` varchar(100) DEFAULT NULL,
                    `annonceur` varchar(100) DEFAULT NULL,
                    `tarif` int(5) DEFAULT NULL,
                    `visuel` varchar(100) DEFAULT NULL,
                     PRIMARY KEY (`id`)    
                    )";      
        $this->db->query($query);       
        $query = " INSERT INTO filtres_" . $this->session->userdata['user_key'] . "(annonceur, regie, marque, campagne, id_face, type, rue, id_ville, format, grp, tarif, visuel) 
                  SELECT annonceur, regie, marque, campagne, id_face, type, adresse, id_ville,format, grp, tarif, visuel";
        $query .= " FROM 3b_entries";
        $query .= $where;
        $this->db->query($query);        
        $query = "ALTER TABLE `filtres_" . $this->session->userdata['user_key'] . "` ADD INDEX(annonceur)";
        $this->db->query($query);
        $query = "ALTER TABLE `filtres_" . $this->session->userdata['user_key'] . "` ADD INDEX (regie)";
        $this->db->query($query);
        $query = "ALTER TABLE `filtres_" . $this->session->userdata['user_key'] . "` ADD INDEX(marque)";
        $this->db->query($query);
        $query = "ALTER TABLE `filtres_" . $this->session->userdata['user_key'] . "` ADD INDEX(campagne)";
        $this->db->query($query);
        $query = "ALTER TABLE `filtres_" . $this->session->userdata['user_key'] . "` ADD INDEX(id_face)";
        $this->db->query($query);
        $query = "ALTER TABLE `filtres_" . $this->session->userdata['user_key'] . "` ADD INDEX(id_ville)";
        $this->db->query($query);
        $query = "ALTER TABLE `filtres_" . $this->session->userdata['user_key'] . "` ADD INDEX(type)";
        $this->db->query($query);
        $query = "ALTER TABLE `filtres_" . $this->session->userdata['user_key'] . "` ADD INDEX(rue)";
        $this->db->query($query);
        $query = "ALTER TABLE `filtres_" . $this->session->userdata['user_key'] . "` ADD INDEX(format)";
        $this->db->query($query);
        $query = "ALTER TABLE `filtres_" . $this->session->userdata['user_key'] . "` ADD INDEX(grp)";
        $this->db->query($query);
        $query = "ALTER TABLE `filtres_" . $this->session->userdata['user_key'] . "` ADD INDEX(tarif)";
        $this->db->query($query);
        $query = "ALTER TABLE `filtres_" . $this->session->userdata['user_key'] . "` ADD INDEX(visuel)";
        $this->db->query($query);
    }
    
    /*
     * Initialiser
     * */
    function init_data($rowName)
    {
        $this->db->distinct();
        $this->db->select($rowName);
        $query = $this->db->get('filtres_' . $this->session->userdata['user_key']);
        return $query->result();
    }
    
    /*
     * Retourner les informations filtrées
     * */
    function get_filtred($rowName,$rowData)
    {
        
        if (count($rowData) > 0)
        {
            $keys = array_keys($rowData);
            $where = $keys[0] . " IN  ('" . implode("', '", $rowData[$keys[0]]) . "')";
            for ($key = 1; $key < count($rowData); $key++)
            {
                $where .= " AND " . $keys[$key] . " IN  ('" . implode("', '", $rowData[$keys[$key]]) . "')";
            }
            $this->db->distinct();
            $this->db->select($rowName);
            $this->db->where($where);
            $query = $this->db->get('filtres_' . $this->session->userdata['user_key']);
            return $query->result();
        }
    }
    
    /*
     * Créer une table panneaux pour sauvegarder la liste des panneaux
     * */
    function create_panneaux()
    {
        $sql = "CREATE TABLE panneaux_" . $this->session->userdata['user_key'] .  " (
                `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                `liste` LONGTEXT NOT NULL
              )";        
        return $this->db->query($sql);
    }
    
    /*
     * Initialiser la table panneaux
     * */
    function init_panneaux()
    {
        $data = array('id' => 1, 'liste' => '---');
        $this->db->insert('panneaux_' . $this->session->userdata['user_key'],$data);
    }
    
    /*
     * Sauvegarder des données dans la table panneaux
     * */
    function save_panneaux($panneaux)
    {
        $where = " WHERE `id` = '1'";
        return $this->db->query("UPDATE panneaux_" . $this->session->userdata['user_key'] . " set liste = " . "'" . $panneaux . "'" . $where);
    }
    
    /*
     * Retourner la liste des panneaux serialisée
     * */
    function get_ser_panneaux()
    {
        $where = "id = 1";
        $this->db->select('liste');
        $this->db->where($where);
        $query = $this->db->get('panneaux_' . $this->session->userdata['user_key']);
        return $query->result();
    }
    
    function get_panneaux_list()
    {  
        $query = $this->db->query("SELECT * FROM " . 'panneaux_list_' . $this->session->userdata['user_key'] . " GROUP BY latitude, longitude ");
        return $query->result();
    }
    
    function get_villes_list()
    {
        $sql = "SELECT ville, latitude_ville, longitude_ville FROM " . 'panneaux_list_' . $this->session->userdata['user_key'] . " GROUP BY latitude_ville, longitude_ville ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /*
     * Deteruire la vue
     * */
    function drop_view()
    {
        return $this->db->query("DROP TABLE IF EXISTS filtres_" . $this->session->userdata['user_key']);
    }

}

?>
