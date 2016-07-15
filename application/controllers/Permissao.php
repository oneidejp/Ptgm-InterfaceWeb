<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Permissao extends MY_Controller {

    /**
     * 2015
     * Desenvolvido por: Mateus Perego
     * Email: mateusperego@yahoo.com.br
     * Projeto de conclusão de curso
     * UPF - Ciência da Computação
     */
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        //$data['title'] = "";
        $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>" .
                "<script src=" . base_url() . "includes/js/sorttable.js></script>" .
                "<script src=" . base_url() . "includes/js/funcoesjs.js></script>";
        $this->load->template('Permissao_view', $data);
    }

}
