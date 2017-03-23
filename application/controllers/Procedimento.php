<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Procedimento extends MY_Controller {

    /**
     * 2015
     * Desenvolvido por: Mateus Perego
     * Email: mateusperego@yahoo.com.br
     * Projeto de conclusão de curso
     * UPF - Ciência da Computação
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('procedimento_model');
    }

    public function index($offset = 0) {
        $link = $this->input->get('link');
        if ($link == 'cadastro') {
            $data['procedimento'] = $link;
            $data['title'] = $this->lang->line('page_title_cadastre_procedure');
            $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                    "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>";
            $this->load->template('Procedimento_cadastro_view', $data);
        } else {
            //paginacao
            $config = array();
            $config['base_url'] = base_url() . "index.php/procedimento/index";
            $config['total_rows'] = $this->db->get('procedimento')->num_rows();
            $config['per_page'] = LIMITE;
            $config['uri_segment'] = 3;
            $this->pagination->initialize($config);
            $data['paginacao'] = $this->pagination->create_links();
            $data['procedimento'] = $this->procedimento_model->get_all_procedimento(LIMITE, $offset);
            $data['title'] = $this->lang->line('page_title_consult_procedure');
            $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                    "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>" .
                    "<script src=" . base_url() . "includes/js/sorttable.js></script>" .
                    "<script src=" . base_url() . "includes/js/funcoesjs.js></script>";
            $this->load->template('Procedimento_consulta_view', $data);
        }
    }

    // create procedimento
    function create_procedimento() {
        //teste o nível do usuário
        if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
            $data = array(
                'codProced' => $this->input->post('codProced'),
                'desc' => $this->input->post('desc')
            );
            if ($this->procedimento_model->add_procedimento($data)) {
                $this->session->set_flashdata('msg', $this->lang->line('msg_insert'));
                redirect('index.php/procedimento?link=cadastro');
            }
        } else {
            $this->session->set_flashdata('msg', $this->lang->line('msg_permission_insert'));
            redirect('index.php/procedimento?link=cadastro');
        }
    }

    //delete procedimento
    function apagar_procedimento() {
        //testa o nível do usuário
        if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {

            if ($this->procedimento_model->delete_procedimento()) {
                $this->session->set_flashdata('msg', $this->lang->line('msg_delete'));
                redirect('index.php/procedimento');
            } else {
                die($this->lang->line('msg_error_delete'));
            }
        } else {
            $this->session->set_flashdata('msg', $this->lang->line('msg_permission_delete'));
            redirect('index.php/procedimento');
        }
    }

    //update procedimento
    function editar_procedimento($codProced) {
        //testa o nível do usuário
        if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
            $data['procedimento'] = $this->procedimento_model->get_by_id_procedimento($codProced);
            $this->form_validation->set_rules('desc', 'desc', 'trim|required');

            if ($this->form_validation->run()) {
                $_POST['codProced'] = $codProced;
                if ($this->procedimento_model->update_procedimento($_POST)) {
                    $this->session->set_flashdata('msg', $this->lang->line('msg_update'));
                    redirect('index.php/procedimento?link=cadastro');
                }
            }
            $data['title'] = $this->lang->line('page_title_cadastre_procedure');
            $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                    "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>";
            $this->load->template('Procedimento_cadastro_view', $data);
        } else {
            $this->session->set_flashdata('msg', $this->lang->line('msg_permission_update'));
            redirect('index.php/procedimento');
        }
    }

}

/* End of file */