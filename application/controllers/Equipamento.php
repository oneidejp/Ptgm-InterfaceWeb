<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipamento extends MY_Controller {

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
		$this->load->model('equipamento_model');
	}  

	public function index($offset=0)
	{

		$link=$this->input->get('link');
		if ($link=='cadastro') {
			$data['equipamento']=$link;
			
			$this->load->model('marca_model'); //carrega o model
			$data['marca']=$this->marca_model->get_all_marca_cadastro();
			$this->load->model('modelo_model'); //carrega o model
			$data['modelo']=$this->modelo_model->get_all_modelo_cadastro();
			$this->load->model('tipo_model'); //carrega o model
			$data['tipo']=$this->tipo_model->get_all_tipo_cadastro();
			$this->load->view('equipamento_cadastro',$data);
		}else{

			//paginacao
    		$config = array();
    		$config['base_url']= base_url()."index.php/equipamento/index";
    		$config['total_rows']= $this->db->get('marca')->num_rows();
    		$config['per_page']= LIMITE;
    		$config['uri_segment']= 3;    		
    		$this->pagination->initialize($config);
    		$data['paginacao'] = $this->pagination->create_links();    		
			$data['equipamento']= $this->equipamento_model->get_all_equipamento(LIMITE, $offset);

			$this->load->view('equipamento_consulta',$data);				
		}		
	}

	// create equipamento
	function create_equipamento()
	{
		//teste o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			
			$data=array(
				'codEquip'=>$this->input->post('codEquip'),
				'codMarca'=>$this->input->post('codMarca'),
				'codModelo'=>$this->input->post('codModelo'),
				'codTipo'=>$this->input->post('codTipo'),
				'rfid'=>$this->input->post('rfid'),
				'codPatrimonio'=>$this->input->post('codPatrimonio'),
				'desc'=>$this->input->post('desc'),
				'dataUltimaFalha'=>$this->input->post('dataUltimaFalha'),
				'dataUltimaManutencao'=>$this->input->post('dataUltimaManutencao'),
				'tempoUso'=>$this->input->post('tempoUso')
				);
			if($this->equipamento_model->add_equipamento($data)){
				$this->session->set_flashdata('msg',$this->lang->line('msg_insert'));
				redirect('index.php/equipamento?link=cadastro');
			}
		} else {
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_insert'));
			redirect('index.php/equipamento?link=cadastro');
		}
	}

	//delete equipamento
	function apagar_equipamento(){
		//testa o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			
			if ($this->equipamento_model->delete_equipamento()) {
				$this->session->set_flashdata('msg',$this->lang->line('msg_delete'));
				redirect('index.php/equipamento');
			}else{
				die($this->lang->line('msg_error_delete'));
			}
		}else{
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_delete'));
			redirect('index.php/equipamento');
		}
	}

	//update equipamento
	function editar_equipamento($codEquip){
		//testa o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			
			$data['equipamento']=$this->equipamento_model->get_by_id_equipamento($codEquip);
			$this->form_validation->set_rules('desc','desc','trim|required');

			if ($this->form_validation->run()) {
				$_POST['codEquip']=$codEquip;
				if($this->equipamento_model->update_equipamento($_POST)){
					$this->session->set_flashdata('msg',$this->lang->line('msg_update'));
					redirect('index.php/equipamento?link=cadastro');
				}
			}
			$this->load->model('marca_model'); //carrega o model
			$data['marca']=$this->marca_model->get_all_marca_cadastro();
			$this->load->model('modelo_model'); //carrega o model
			$data['modelo']=$this->modelo_model->get_all_modelo_cadastro();
			$this->load->model('tipo_model'); //carrega o model
			$data['tipo']=$this->tipo_model->get_all_tipo_cadastro();
			$this->load->view('equipamento_cadastro',$data);
		}else{
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_update'));
			redirect('index.php/equipamento');
		}
	}

}

/* End of file */