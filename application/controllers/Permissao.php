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

	public function __construct()
	{
		parent::__construct();
	} 

	public function index(){

		$this->load->view('permissao');

	}

}