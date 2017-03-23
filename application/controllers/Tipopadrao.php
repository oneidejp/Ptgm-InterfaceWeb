<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tipopadrao extends MY_Controller {

    /**
     * 2015
     * Desenvolvido por: Mateus Perego
     * Email: mateusperego@yahoo.com.br
     * Projeto de conclusão de curso
     * UPF - Ciência da Computação
     * 
     * 2017
     * Alterado por: Leonardo F. Rauber
     * Email: leorauber@hotmail.com - 132789@upf.br
     * Projeto de conclusão de curso
     * UPF - Ciência da Computação
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('tipopadrao_model');
    }

    public function index($offset = 0) {
        $link = $this->input->get('link');
        if ($link == 'cadastro') {
            $data['tipopadrao'] = $link;
            $data['title'] = $this->lang->line('page_title_cadastre_kind_of_standards');
            $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                    "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>";
            $this->load->template('Tipopadrao_cadastro_view', $data);
        } else {
            //paginacao
            $config = array();
            $config['base_url'] = base_url() . "index.php/tipopadrao/index";
            $config['total_rows'] = $this->db->get('tipopadrao')->num_rows();
            $config['per_page'] = LIMITE;
            $config['uri_segment'] = 3;
            $this->pagination->initialize($config);
            $data['paginacao'] = $this->pagination->create_links();
            $data['tipopadrao'] = $this->tipopadrao_model->get_all_tipopadrao(LIMITE, $offset);
            
            $data['title'] = $this->lang->line('page_title_consult_kind_of_standards');
            $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                    "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>" .
                    "<script src=" . base_url() . "includes/js/sorttable.js></script>" .
                    "<script src=" . base_url() . "includes/js/funcoesjs.js></script>";
            $this->load->template('Tipopadrao_consulta_view', $data);
        }
    }

    // create tipo padrao
    function create_tipopadrao() {
        //teste o nível do usuário
        if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
            $data = array(
                'codTipoPadrao' => $this->input->post('codTipoPadrao'),
                'desc' => $this->input->post('desc')
            );
            if ($this->tipopadrao_model->add_tipopadrao($data)) {
                $this->session->set_flashdata('msg', $this->lang->line('msg_insert'));
                redirect('index.php/tipopadrao?link=cadastro');
            }
        } else {
            $this->session->set_flashdata('msg', $this->lang->line('msg_permission_insert'));
            redirect('index.php/tipopadrao?link=cadastro');
        }
    }

    //delete tipo padrao
    function apagar_tipopadrao() {
        //testa o nível do usuário
        if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
            if ($this->tipopadrao_model->delete_tipopadrao()) {
                $this->session->set_flashdata('msg', $this->lang->line('msg_delete'));
                redirect('index.php/tipopadrao');
            } else {
                die($this->lang->line('msg_error_delete'));
            }
        } else {
            $this->session->set_flashdata('msg', $this->lang->line('msg_permission_delete'));
            redirect('index.php/tipopadrao');
        }
    }

    //update tipo padrao
    function editar_tipopadrao($codTipoPadrao) {
        //testa o nível do usuário
        if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
            $data['tipopadrao'] = $this->tipopadrao_model->get_by_id_tipopadrao($codTipoPadrao);
            $this->form_validation->set_rules('desc', 'desc', 'trim|required');

            if ($this->form_validation->run()) {
                $_POST['codTipoPadrao'] = $codTipoPadrao;
                if ($this->tipopadrao_model->update_tipopadrao($_POST)) {
                    $this->session->set_flashdata('msg', $this->lang->line('msg_update'));
                    redirect('index.php/tipopadrao?link=cadastro');
                }
            }
            $data['title'] = $this->lang->line('page_title_cadastre_kind_of_standards');
            $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                    "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>";
            $this->load->template('Tipopadrao_cadastro_view', $data);
        } else {
            $this->session->set_flashdata('msg', $this->lang->line('msg_permission_update'));
            redirect('index.php/tipopadrao');
        }
    }

}

/* End of file */