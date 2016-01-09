<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class nome_arquivo_php_sem_extensao extends MY_Controller {
    
	/**
	* 2016
	* Desenvolvido por: Maurício Antonioli Schmitz
	* Projeto de Mestrado em Computação Aplicada - PPGCA/UPF
	*/
    
	public function index()
	{
		$this->load->view('nome_do_arquivo_pasta_view_sem_extensao');
	}
}