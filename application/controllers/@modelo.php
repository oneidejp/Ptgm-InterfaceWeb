<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class nome_arquivo_php_sem_extensao extends MY_Controller {

	/**
	* 2016
	* Desenvolvido por: Maurício Antonioli Schmitz
	* Projeto de Mestrado em Computação Aplicada - PPGCA/UPF
	*/

        public function __construct()
	{
		parent::__construct();
		$this->load->model('nome_do_arquivo_pasta_model_sem_extensao');
	}

	public function index()
	{
            //title for page
            $data['title'] = 'título';
            //if want to hide footer, send footerHide = true
            $data['footerHide'] = 'true';
            //if want to insert another file in the header
            $data['headerOption'] = 
                "<link rel='stylesheet' href=".base_url()."includes/path/file.css>" .
                "<script src=".base_url()."includes/path/file.js></script>";
            //$this->load->view('nome_do_arquivo_pasta_view_sem_extensao');
            $this->load->template('nome_do_arquivo_pasta_view_sem_extensao', $data);
	}
}
