<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Modulo extends MY_Controller {

    /**
     * 2017
     * Alterado por: Leonardo F. Rauber
     * Email: leorauber@hotmail.com - 132789@upf.br
     * Projeto de conclusão de curso
     * UPF - Ciência da Computação
     */
    
    public function __construct() {
        parent::__construct();
        $this->load->model('modulo_model');
    }

    public function index($offset = 0) {
        $link = $this->input->get('link');
        if ($link == 'cadastro') {
            $data['modulo'] = $link;
            $data['title'] = $this->lang->line('page_title_cadastre_module');
//            $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
//                    "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>";
            
            $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                    "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>" .
                    "<link rel='stylesheet' href=" . base_url() . "includes/css/jquery-ui_calendar.css>" .
                    "<script src=" . base_url() . "includes/js/jquery-1.8.2_calendar.js></script>" .
                    "<script src=" . base_url() . "includes/js/jquery-ui_calendar.js></script>" .
                    "<script src=" . base_url() . "includes/js/calendario.js></script>" .
                    "<script src=" . base_url() . "includes/js/exporting.js></script>";
            
            $this->load->template('Modulo_cadastro_view', $data);
        } else {
            //paginacao
            $config = array();
            $config['base_url'] = base_url() . "index.php/modulo/index";
            $config['total_rows'] = $this->db->get('modulo')->num_rows();
            $config['per_page'] = LIMITE;
            $config['uri_segment'] = 3;
            $this->pagination->initialize($config);
            $data['paginacao'] = $this->pagination->create_links();
            $data['modulo'] = $this->modulo_model->get_all_modulo(LIMITE, $offset);
            $data['title'] = $this->lang->line('page_title_consult_module');
            $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                    "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>" .
                    "<script src=".base_url()."includes/js/sorttable.js></script>" .
                    "<script src=".base_url()."includes/js/funcoesjs.js></script>";
            $this->load->template('Modulo_consulta_view', $data);
        }
    }

    // create
    function create_modulo() {
        //teste o nível do usuário
        if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
            $data = array(
                'idModulo' => $this->input->post('idModulo'),
                'ip' => $this->input->post('ip'),
                'idWebSocket' => $this->input->post('idWebSocket'),
                'ultimoLiga' => $this->input->post('ultimoLiga'),
                'desc' => $this->input->post('desc')
            );
            if ($this->modulo_model->add_modulo($data)) {
                $this->session->set_flashdata('msg', $this->lang->line('msg_insert'));
                redirect('index.php/modulo?link=cadastro');
            }
        } else {
            $this->session->set_flashdata('msg', $this->lang->line('msg_permission_insert'));
            redirect('index.php/modulo?link=cadastro');
        }
    }

    //delete
    function apagar_modulo() {
        //testa o nível do usuário
        if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
            if ($this->modulo_model->delete_modulo()) {
                $this->session->set_flashdata('msg', $this->lang->line('msg_delete'));
                redirect('index.php/modulo');
            } else {
                die($this->lang->line('msg_error_delete'));
            }
        } else {
            $this->session->set_flashdata('msg', $this->lang->line('msg_permission_delete'));
            redirect('index.php/modulo');
        }
    }

    //update
    function editar_modulo($idModulo) {
        //testa o nível do usuário
        if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
            $data['modulo'] = $this->modulo_model->get_by_id_modulo($idModulo);
            $this->form_validation->set_rules('desc', 'desc', 'trim|required');

            if ($this->form_validation->run()) {
                $_POST['idModulo'] = $idModulo;
                if ($this->modulo_model->update_modulo($_POST)) {
                    $this->session->set_flashdata('msg', $this->lang->line('msg_update'));
                    redirect('index.php/modulo?link=cadastro');
                }
            }
            
            $data['title'] = $this->lang->line('page_title_cadastre_module');
            
            $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                    "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>" .
                    "<link rel='stylesheet' href=" . base_url() . "includes/css/jquery-ui_calendar.css>" .
                    "<script src=" . base_url() . "includes/js/jquery-1.8.2_calendar.js></script>" .
                    "<script src=" . base_url() . "includes/js/jquery-ui_calendar.js></script>" .
                    "<script src=" . base_url() . "includes/js/calendario.js></script>" .
                    "<script src=" . base_url() . "includes/js/exporting.js></script>";
            
            $this->load->template('Modulo_cadastro_view', $data);
        } else {
            $this->session->set_flashdata('msg', $this->lang->line('msg_permission_update'));
            redirect('index.php/modulo');
        }
    }

}

/* End of file */