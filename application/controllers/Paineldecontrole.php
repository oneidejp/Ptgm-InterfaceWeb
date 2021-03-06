<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Paineldecontrole extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('paineldecontrole_model');
    }

    public function index() {

        $data['usosala'] = $this->paineldecontrole_model->get_all_usosala();
        //calcula tempo sala em funcionamento
        foreach ($data['usosala'] as $dados) {
            date_default_timezone_set('America/Sao_Paulo');
            $hora = new DateTime($dados->horaInicio); // recebe a hora e data inicial
            $inicio = $hora->format('d/m/Y H:i:s'); //converte hora e data inicial
            $fim = date('d/m/Y H:i:s'); // recebe hora e data atual
            $inicio = DateTime::createFromFormat('d/m/Y H:i:s', $inicio); // formata a data de inicio
            $fim = DateTime::createFromFormat('d/m/Y H:i:s', $fim); // formata a data fim			
            $intervalo = $inicio->diff($fim); // Calcula a diferença entre as duas datas
            $data['horas'][] = $intervalo->format('%H:%I:%S');
        }

        $data['alerta'] = $this->paineldecontrole_model->get_all_alertas();

        $data['title'] = $this->lang->line('page_title_control_panel');
        $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>" .
                "<script src=" . base_url() . "includes/js/moment.js></script>";
        $this->load->template('Paineldecontrole_view', $data);
    }

    //consulta e retorna os codusosala ativos
    public function ajax() {
        $data['usosala'] = $this->paineldecontrole_model->get_all_usosala();
        echo json_encode($data);
    }

    //consulta e retorna os alertas existentes
    public function alertas() {
        $data['alerta'] = $this->paineldecontrole_model->get_all_alertas();
        echo json_encode($data);
    }

    //consulta e retorna os dados dos codusosala ativos, caso houve alereaçã nas salas ativas
    public function getbyid() {

        $data['sala'] = $this->paineldecontrole_model->get_all_usosala();

        foreach ($data['sala'] as $dados) {
            date_default_timezone_set('America/Sao_Paulo');
            $hora = new DateTime($dados->hora); // recebe a hora e data inicial
            $inicio = $hora->format('d/m/Y H:i:s'); //converte hora e data inicial
            $fim = date('d/m/Y H:i:s'); // recebe hora e data atual
            $inicio = DateTime::createFromFormat('d/m/Y H:i:s', $inicio); // formata a data de inicio
            $fim = DateTime::createFromFormat('d/m/Y H:i:s', $fim); // formata a data fim			
            $intervalo = $inicio->diff($fim); // Calcula a diferença entre as duas datas
            $sala['horas'][] = $intervalo->format('%H:%I:%S');
            $sala['desc'][] = $dados->desc;
            $sala['codUsoSala'][] = $dados->codUsoSala;
        }

        echo json_encode($sala);
    }

}
