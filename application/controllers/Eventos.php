<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos extends MY_Controller {

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
        $this->load->model('eventos_model');
    }

    public function index($offset = 0) {
        $link = $this->input->get('link');
        if ($link == 'cadastro') {
            $data['eventos'] = $link;
            $data['title'] = $this->lang->line('page_title_cadastre_events');
            $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                    "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>";
            $this->load->template('Eventos_cadastro_view', $data);
        } else {
            //paginacao
            $config = array();
            $config['base_url'] = base_url() . "index.php/eventos/index";
            $config['total_rows'] = $this->db->get('eventos')->num_rows();
            $config['per_page'] = LIMITE;
            $config['uri_segment'] = 3;
            $this->pagination->initialize($config);
            $data['paginacao'] = $this->pagination->create_links();
            $data['eventos'] = $this->eventos_model->get_all_eventos(LIMITE, $offset);
            $data['title'] = $this->lang->line('page_title_consult_events');
            $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                    "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>" .
                    "<script src=" . base_url() . "includes/js/sorttable.js></script>" .
                    "<script src=" . base_url() . "includes/js/funcoesjs.js></script>";
            $this->load->template('Eventos_consulta_view', $data);
        }
    }

    // create eventos
    function create_eventos() {
        //teste o nível do usuário
        if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
            $data = array(
                'codEvento' => $this->input->post('codEvento'),
                'desc' => $this->input->post('desc'),
                'formaOnda' => $this->input->post('formaOnda')
            );
            if ($this->eventos_model->add_eventos($data)) {
                $this->session->set_flashdata('msg', $this->lang->line('msg_insert'));
                redirect('index.php/eventos?link=cadastro');
            }
        } else {
            $this->session->set_flashdata('msg', $this->lang->line('msg_permission_insert'));
            redirect('index.php/eventos?link=cadastro');
        }
    }

    //delete eventos
    function apagar_eventos() {
        //testa o nível do usuário
        if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
            if ($this->eventos_model->delete_eventos()) {
                $this->session->set_flashdata('msg', $this->lang->line('msg_delete'));
                redirect('index.php/eventos');
            } else {
                die($this->lang->line('msg_error_delete'));
            }
        } else {
            $this->session->set_flashdata('msg', $this->lang->line('msg_permission_delete'));
            redirect('index.php/eventos');
        }
    }

    //update eventos
    function editar_eventos($codEvento) {
        //testa o nível do usuário
        if ($this->session->userdata('nivel') == '1' || $this->session->userdata('nivel') == '3') {
            $data['eventos'] = $this->eventos_model->get_by_id_eventos($codEvento);
            $this->form_validation->set_rules('desc', 'desc', 'trim|required');

            if ($this->form_validation->run()) {
                $_POST['codEvento'] = $codEvento;
                if ($this->eventos_model->update_eventos($_POST)) {
                    $this->session->set_flashdata('msg', $this->lang->line('msg_update'));
                    redirect('index.php/eventos?link=cadastro');
                }
            }
            $data['title'] = $this->lang->line('page_title_cadastre_events');
            $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                    "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>";
            $this->load->template('Eventos_cadastro_view', $data);
        } else {
            $this->session->set_flashdata('msg', $this->lang->line('msg_permission_update'));
            redirect('index.php/eventos');
        }
    }

}

/* End of file */