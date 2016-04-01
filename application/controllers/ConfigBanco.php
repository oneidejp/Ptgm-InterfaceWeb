<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class configBanco extends MY_Controller {

    /**
     * 2016
     * Desenvolvido por: Maurício Antonioli Schmitz
     * Projeto de Mestrado em Computação Aplicada - PPGCA/UPF
     */
    public function index() {
        //$parametros = array();
        $data['title'] = 'config_database';
        $this->load->template('configBanco', $data);
        //$this->load->view('configBanco');
    }

}
