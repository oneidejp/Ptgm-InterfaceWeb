<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo extends MY_Controller {

    /**
     * 2015
     * Desenvolvido por: Mateus Perego
     * Email: mateusperego@yahoo.com.br
     * Projeto de conclusão de curso
     * UPF - Ciência da Computação
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('tipo_model');
    }

    public function index($offset = 0) {
        $link = $this->input->get('link');
        if ($link == 'cadastro') {
            $data['tipo'] = $link;
            $data['title'] = $this->lang->line('page_title_cadastre_kind');
            $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                    "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>";
            $this->load->template('Tipo_cadastro_view', $data);
        } else {
            //paginacao
            $config = array();
            $config['base_url'] = base_url() . "index.php/tipo/index";
            $config['total_rows'] = $this->db->get('tipo')->num_rows();
            $config['per_page'] = LIMITE;
            $config['uri_segment'] = 3;
            $this->pagination->initialize($config);
            $data['paginacao'] = $this->pagination->create_links();
            $data['tipo'] = $this->tipo_model->get_all_tipo(LIMITE, $offset);

            $data['title'] = $this->lang->line('page_title_consult_kind');
            $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                    "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>" .
                    "<script src=" . base_url() . "includes/js/sorttable.js></script>" .
                    "<script src=" . base_url() . "includes/js/funcoesjs.js></script>";
            $this->load->template('Tipo_consulta_view', $data);
        }
    }

    // create tipo
    function create_tipo() {
        //teste o nível do usuário
        if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
            $data = array(
                'codTipo' => $this->input->post('codTipo'),
                'desc' => $this->input->post('desc')
            );
            if ($this->tipo_model->add_tipo($data)) {
                $this->session->set_flashdata('msg', $this->lang->line('msg_insert'));
                redirect('index.php/tipo?link=cadastro');
            }
        } else {
            $this->session->set_flashdata('msg', $this->lang->line('msg_permission_insert'));
            redirect('index.php/tipo?link=cadastro');
        }
    }

    //delete tipo
    function apagar_tipo() {
        //testa o nível do usuário
        if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
            if ($this->tipo_model->delete_tipo()) {
                $this->session->set_flashdata('msg', $this->lang->line('msg_delete'));
                redirect('index.php/tipo');
            } else {
                die($this->lang->line('msg_error_delete'));
            }
        } else {
            $this->session->set_flashdata('msg', $this->lang->line('msg_permission_delete'));
            redirect('index.php/tipo');
        }
    }

    //update tipo
    function editar_tipo($codTipo) {
        //testa o nível do usuário
        if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
            $data['tipo'] = $this->tipo_model->get_by_id_tipo($codTipo);
            $this->form_validation->set_rules('desc', 'desc', 'trim|required');

            if ($this->form_validation->run()) {
                $_POST['codTipo'] = $codTipo;
                if ($this->tipo_model->update_tipo($_POST)) {
                    $this->session->set_flashdata('msg', $this->lang->line('msg_update'));
                    redirect('index.php/tipo?link=cadastro');
                }
            }
            $this->load->view('tipo_cadastro', $data);
        } else {
            $this->session->set_flashdata('msg', $this->lang->line('msg_permission_update'));
            redirect('index.php/tipo');
        }
    }

}

/* End of file */