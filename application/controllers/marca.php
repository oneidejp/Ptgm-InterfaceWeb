<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marca extends MY_Controller {

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
		$this->load->model('marca_model');
	}  

    public function index($offset=0)
    {
    	$link=$this->input->get('link');
    	if ($link=='cadastro') {
    		$data['marca']=$link;
    		$this->load->view('marca_cadastro',$data);
    	}else{
    		//paginacao
    		$config = array();
    		$config['base_url']= base_url()."index.php/marca/index";
    		$config['total_rows']= $this->db->get('marca')->num_rows();
    		$config['per_page']= LIMITE;
    		$config['uri_segment']= 3;    		
    		$this->pagination->initialize($config);
    		$data['paginacao'] = $this->pagination->create_links();    		
    		$data['marca']= $this->marca_model->get_all_marca(LIMITE, $offset);
    		
    		$this->load->view('marca_consulta',$data);				
    	}		
    }

 	// create
	function create_marca()
	{
		//teste o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			$data=array(
				'codMarca'=>$this->input->post('codMarca'),
				'desc'=>$this->input->post('desc')
				);
			if($this->marca_model->add_marca($data)){
				$this->session->set_flashdata('msg',$this->lang->line('msg_insert'));
				redirect('index.php/marca?link=cadastro');
			}
		} else {
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_insert'));
			redirect('index.php/marca?link=cadastro');
		}
	}
	//delete
	function apagar_marca(){
		//testa o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			if ($this->marca_model->delete_marca()) {
				$this->session->set_flashdata('msg',$this->lang->line('msg_delete'));
				redirect('index.php/marca');
			}else{
				die($this->lang->line('msg_error_delete'));
			}
		}else{
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_delete'));
			redirect('index.php/marca');
		}
	}
	//update
	function editar_marca($codMarca){
		//testa o nível do usuário
		if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
			$data['marca']=$this->marca_model->get_by_id_marca($codMarca);
			$this->form_validation->set_rules('desc','desc','trim|required');

			if ($this->form_validation->run()) {
				$_POST['codMarca']=$codMarca;
				if($this->marca_model->update_marca($_POST)){
					$this->session->set_flashdata('msg',$this->lang->line('msg_update'));
					redirect('index.php/marca?link=cadastro');
				}
			}
			$this->load->view('marca_cadastro',$data);
		}else{
			$this->session->set_flashdata('msg',$this->lang->line('msg_permission_update'));
			redirect('index.php/marca');
		}
	}

}

/* End of file */