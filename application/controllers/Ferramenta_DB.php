<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ferramenta_DB extends MY_Controller {

/**
    * 2017
    * Alterado por: Leonardo F. Rauber
    * Email: leorauber@hotmail.com - 132789@upf.br
    * Projeto de conclusão de curso
    * UPF - Ciência da Computação
 */
    public function __construct() {
        parent::__construct();
        $this->load->model('Ferramenta_DB_model');
    }

    public function index() {
        $data['title'] = $this->lang->line('Ferramenta_DB');
        $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>";
        $this->load->template('Ferramenta_DB_view', $data);
    }
    
    public function backupDB() {
        $this->Ferramenta_DB_model->backupDB();
    }
    
    public function restoreDB() {
//        $backup = filter_input_array(INPUT_POST)['Backup'];
        $this->Ferramenta_DB_model->restoreDB();
    }
}

/* End of file */