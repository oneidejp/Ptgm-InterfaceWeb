<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class escalas extends MY_Controller {

    /**
     * 2016
     * Desenvolvido por: Maurício Antonioli Schmitz
     * Projeto de Mestrado em Computação Aplicada - PPGCA/UPF
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('escalas_model');
        $this->load->library('similaridade');
    }

    public function index() {
        if ($this->input->post("onda1")) {
            $data['onda1'] = $this->input->post('onda1');
            $data['onda2'] = $this->input->post('onda2');
            
            $pontos1 = $this->similaridade->calcula256Pontos($data['onda1']);
            $pontos2 = $this->similaridade->calcula256Pontos($data['onda2']);

            $data['pontos'] = $this->similaridade->spearman($pontos1, $pontos2);
        
        } else {
            //alguma forma de tratar erros
        }

        

        //$data['pontos'] = $this->calcula12Pontos('6222035');
        $data['title'] = 'Escalas';
        $this->load->template('escalas', $data);
    }

}
