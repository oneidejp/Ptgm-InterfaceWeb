<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Responsavel extends MY_Controller {

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
		$this->load->model('responsavel_model');
	}  

	public function index($offset=0)
	{
		$link=$this->input->get('link');
		if ($link=='cadastro') {
			$data['responsavel']=$link;
			$this->load->view('responsavel_cadastro',$data);
		}else{
			//paginacao
    		$config = array();
    		$config['base_url']= base_url()."index.php/responsavel/index";
    		$config['total_rows']= $this->db->get('responsavel')->num_rows();
    		$config['per_page']= LIMITE;
    		$config['uri_segment']= 3;    		
    		$this->pagination->initialize($config);
    		$data['paginacao'] = $this->pagination->create_links();    		
			$data['responsavel']= $this->responsavel_model->get_all_responsavel(LIMITE, $offset);
			$this->load->view('responsavel_consulta',$data);				
		}		
	}

	// create responsavel
	function create_responsavel()
	{
		//teste o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			$data=array(
				'codResp'=>$this->input->post('codResp'),
				'desc'=>$this->input->post('desc')
				);
			if($this->responsavel_model->add_responsavel($data)){
				$this->session->set_flashdata('msg',$this->lang->line('msg_insert'));
				redirect('index.php/responsavel?link=cadastro');
			}
		} else {
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_insert'));
			redirect('index.php/responsavel?link=cadastro');
		}
	}

	//delete responsavel
	function apagar_responsavel(){
		//testa o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			if ($this->responsavel_model->delete_responsavel()) {
				$this->session->set_flashdata('msg',$this->lang->line('msg_delete'));
				redirect('index.php/responsavel');
			}else{
				die($this->lang->line('msg_error_delete'));
			}
		}else{
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_delete'));
			redirect('index.php/responsavel');
		}
	}

	//update responsavel
	function editar_responsavel($codResp){
		//testa o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			$data['responsavel']=$this->responsavel_model->get_by_id_responsavel($codResp);
			$this->form_validation->set_rules('desc','desc','trim|required');

			if ($this->form_validation->run()) {
				$_POST['codResp']=$codResp;
				if($this->responsavel_model->update_responsavel($_POST)){
					$this->session->set_flashdata('msg',$this->lang->line('msg_update'));
					redirect('index.php/responsavel?link=cadastro');
				}
			}
			$this->load->view('responsavel_cadastro',$data);
		}else{
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_update'));
			redirect('index.php/responsavel');
		}
	}

}

/* End of file */