<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alertas extends MY_Controller {

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
		$this->load->model('alertas_model');
	} 

	public function index(){

		//teste o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '2') {

			$codUsoSala = $this->uri->segment(3);

			$data['codUsoSala'] = $codUsoSala;
			$data['usoSalaDesc'] = $this->alertas_model->get_alerta_desc($codUsoSala);
			$data['alerta'] = $this->alertas_model->get_all_alertas($codUsoSala);

			$this->load->view('alerta',$data);
		} else {
			$this->load->view('permissao');
		}		
	}

	// grava os alertas
	function create_alerta(){

		$codUsoSala = $this->uri->segment(3);

		$comentario = $this->input->post('comentario');
		foreach($_POST["alerta"] as $codCaptura){ 
			$data=array(
				'codCaptura'=>$codCaptura,
				'codUsoSala'=>$codUsoSala,
				'usuario'=>$this->session->userdata('nome'),
				'comentario'=>$comentario
				);
			$this->alertas_model->add_alerta($data);
		}

		redirect('index.php/paineldecontrole/index/');
	}

	// atualiza alertas
	public function atualiza_alerta(){

		$codCaptura = $_POST['Captura']; //pega captura
		$codUsoSala = $_POST['CodUsoSala']; //pega codigo uso sala

		$data['alerta']= $this->alertas_model->get_alerta($codUsoSala, $codCaptura);
		
		echo json_encode($data);
	}

}