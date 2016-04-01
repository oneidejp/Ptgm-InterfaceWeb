<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tomada extends MY_Controller {

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
		$this->load->model('tomada_model');
	}  

	public function index($offset=0)
	{
		$link=$this->input->get('link');
		if ($link=='cadastro') {
			$data['tomada']=$link;
			$this->load->model('sala_model'); //carrega o model
			$data['sala']=$this->sala_model->get_all_sala_cadastro();
			$this->load->view('tomada_cadastro',$data);
		}else{
			//paginacao
    		$config = array();
    		$config['base_url']= base_url()."index.php/tomada/index";
    		$config['total_rows']= $this->db->get('tomada')->num_rows();
    		$config['per_page']= LIMITE;
    		$config['uri_segment']= 3;    		
    		$this->pagination->initialize($config);
    		$data['paginacao'] = $this->pagination->create_links();    		    	
			$data['tomada']= $this->tomada_model->get_all_tomada(LIMITE, $offset);	

			$this->load->view('tomada_consulta',$data);				
		}		
	}

	// create tomada
	function create_tomada()
	{
		//teste o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			$data=array(
				'codTomada'=>$this->input->post('codTomada'),
				'codSala'=>$this->input->post('codSala'),
				'indice'=>$this->input->post('indice'),
				'modulo'=>$this->input->post('modulo'),
				'desc'=>$this->input->post('desc')
				);
			if($this->tomada_model->add_tomada($data)){
				$this->session->set_flashdata('msg',$this->lang->line('msg_insert'));
				redirect('index.php/tomada?link=cadastro');
			}
		} else {
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_insert'));
			redirect('index.php/tomada?link=cadastro');
		}
	}

	//delete tomada
	function apagar_tomada(){
		//testa o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			if ($this->tomada_model->delete_tomada()) {
				$this->session->set_flashdata('msg',$this->lang->line('msg_delete'));
				redirect('index.php/tomada');
			}else{
				die($this->lang->line('msg_error_delete'));
			}
		}else{
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_delete'));
			redirect('index.php/tomada');
		}
	}

	//update tomada
	function editar_tomada($codTomada){
		//testa o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			$data['tomada']=$this->tomada_model->get_by_id_tomada($codTomada);
			$this->form_validation->set_rules('desc','desc','trim|required');
			if ($this->form_validation->run()) {
				$_POST['codTomada']=$codTomada;
				if($this->tomada_model->update_tomada($_POST)){
					$this->session->set_flashdata('msg',$this->lang->line('msg_update'));
					redirect('index.php/tomada?link=cadastro');
				}
			}
			$this->load->model('sala_model'); //carrega o model
			$data['sala']=$this->sala_model->get_all_sala_cadastro();
			$this->load->view('tomada_cadastro',$data);
		}else{
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_update'));
			redirect('index.php/tomada');
		}
	}

}

/* End of file */