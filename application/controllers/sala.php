<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sala extends MY_Controller {

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
		$this->load->model('sala_model');
	}  

	public function index($offset=0)
	{
		$link=$this->input->get('link');
		if ($link=='cadastro') {
			$data['sala']=$link;
			$this->load->view('sala_cadastro',$data);
		}else{
			//paginacao
    		$config = array();
    		$config['base_url']= base_url()."index.php/sala/index";
    		$config['total_rows']= $this->db->get('salacirurgia')->num_rows();
    		$config['per_page']= LIMITE;
    		$config['uri_segment']= 3;    		
    		$this->pagination->initialize($config);
    		$data['paginacao'] = $this->pagination->create_links();    		
    		$data['sala']= $this->sala_model->get_all_sala(LIMITE, $offset);

			$this->load->view('sala_consulta',$data);				
		}		
	}

	// create sala
	function create_sala()
	{
		//teste o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			$data=array(
				'codSala'=>$this->input->post('codSala'),
				'desc'=>$this->input->post('desc')
				);
			if($this->sala_model->add_sala($data)){
				$this->session->set_flashdata('msg',$this->lang->line('msg_insert'));
				redirect('index.php/sala?link=cadastro');
			}
		} else {
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_insert'));
			redirect('index.php/sala?link=cadastro');
		}
	}

	//delete sala
	function apagar_sala(){
		//testa o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			if ($this->sala_model->delete_sala()) {
				$this->session->set_flashdata('msg',$this->lang->line('msg_delete'));
				redirect('index.php/sala');
			}else{
				die($this->lang->line('msg_error_delete'));
			}
		}else{
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_delete'));
			redirect('index.php/sala');
		}
	}

	//update sala
	function editar_sala($codSala){
		//testa o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			$data['sala']=$this->sala_model->get_by_id_sala($codSala);
			$this->form_validation->set_rules('desc','desc','trim|required');

			if ($this->form_validation->run()) {
				$_POST['codSala']=$codSala;
				if($this->sala_model->update_sala($_POST)){
					$this->session->set_flashdata('msg',$this->lang->line('msg_update'));
					redirect('index.php/sala?link=cadastro');
				}
			}
			$this->load->view('sala_cadastro',$data);
		}else{
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_update'));
			redirect('index.php/sala');
		}
	}

}

/* End of file */