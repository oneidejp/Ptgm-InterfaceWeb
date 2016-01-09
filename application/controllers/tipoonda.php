<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipoonda extends MY_Controller {

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
		$this->load->model('tipoonda_model');
	}  

	public function index($offset=0)
	{
		$link=$this->input->get('link');
		if ($link=='cadastro') {
			$data['tipoonda']=$link;
			$this->load->view('tipoonda_cadastro',$data);
		}else{
			//paginacao
    		$config = array();
    		$config['base_url']= base_url()."index.php/tipoonda/index";
    		$config['total_rows']= $this->db->get('tipoonda')->num_rows();
    		$config['per_page']= LIMITE;
    		$config['uri_segment']= 3;    		
    		$this->pagination->initialize($config);
    		$data['paginacao'] = $this->pagination->create_links();    		
			$data['tipoonda']= $this->tipoonda_model->get_all_tipoonda(LIMITE, $offset);
			$this->load->view('tipoonda_consulta',$data);				
		}		
	}

	// create tiponda
	function create_tipoonda()
	{
		//teste o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			$data=array(
				'codTipoOnda'=>$this->input->post('codTipoOnda'),
				'desc'=>$this->input->post('desc')
				);
			if($this->tipoonda_model->add_tipoonda($data)){
				$this->session->set_flashdata('msg',$this->lang->line('msg_insert'));
				redirect('index.php/tipoonda?link=cadastro');
			}
		} else {
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_insert'));
			redirect('index.php/tipoonda?link=cadastro');
		}
	}

	//delete tipoonda
	function apagar_tipoonda(){
		//testa o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			if ($this->tipoonda_model->delete_tipoonda()) {
				$this->session->set_flashdata('msg',$this->lang->line('msg_delete'));
				redirect('index.php/tipoonda');
			}else{
				die($this->lang->line('msg_error_delete'));
			}
		}else{
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_delete'));
			redirect('index.php/tipoonda');
		}
	}

	//update tipoonda
	function editar_tipoonda($codTipoOnda){
		//testa o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			$data['tipoonda']=$this->tipoonda_model->get_by_id_tipoonda($codTipoOnda);
			$this->form_validation->set_rules('desc','desc','trim|required');

			if ($this->form_validation->run()) {
				$_POST['codTipoOnda']=$codTipoOnda;
				if($this->tipoonda_model->update_tipoonda($_POST)){
					$this->session->set_flashdata('msg',$this->lang->line('msg_update'));
					redirect('index.php/tipoonda?link=cadastro');
				}
			}
			$this->load->view('tipoonda_cadastro',$data);
		}else{
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_update'));
			redirect('index.php/tipoonda');
		}
	}

}

/* End of file */