<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Comunicacao extends MY_Controller {

    /**
     * 2016
     * Desenvolvido por: Maurício Antonioli Schmitz
     * Projeto de Mestrado em Computação Aplicada - PPGCA/UPF
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Comunicacao_model');
        $this->load->library('similaridade');
    }

    public function antes($palavra, $string) {
        return substr($string, 0, strpos($string, $palavra));
    }

    public function depois($palavra, $string) {
        if (!is_bool(strpos($string, $palavra))) {
            return substr($string, strpos($string, $palavra) + strlen($palavra));
        }
    }

    //ajax function
    public function getAllCaptures() {

        $id = filter_input_array(INPUT_POST)['idCheckbox']; //pega o id(captura) para gerar os gráficos
        $data['barra'] = $this->graficoBarra($id, $onda = 0);
        $data['linha'] = $this->graficoLinha($id, $onda = 0);

        echo json_encode($data);
    }

    public function getOutlets() {

        $id = filter_input_array(INPUT_POST)['Module']; //pega o id do modulo
        $outlets = $this->Comunicacao_model->get_outlets($id);

        echo json_encode($outlets);
    }

    public function getEquipments() {

        $equipments = $this->Comunicacao_model->get_equipments();

        echo json_encode($equipments);
    }

    public function index() {
        //$data['tomadasExistentes'] = $this->Comunicacao_model->get_tomadas();
        $data['modules'] = $this->Comunicacao_model->get_all_modules();
        if (isset(filter_input_array(INPUT_POST)['captureTelnet'])) {
            $modulo = $this->input->post('modulesForm');
            $outlet = $this->input->post('outletsForm');
            $channel = $this->input->post('channelForm');
            //$data['tomadaSelecionada'] = $tomadasForm[0];
            //$data['comando'] = "capture {$data['tomadaSelecionada']}";
            //$data['comando'] = "capture 4 d";
            $data['host'] = $modulo;
            $data['comando'] = "capture {$outlet} {$channel}";
            //$data['host'] = $this->input->post('host');
            //$data['comando'] = $this->input->post('comando');

            $data['telnet'] = $this->comandoTelnet($data['host'], $data['comando']);
        }

        $data['title'] = $this->lang->line('communication');
        $data['footerHide'] = 'true';
        $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                "\t\t<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>" .
                "\t\t<script src=" . base_url() . "includes/js/highcharts.js></script>" .
                "\t\t<script src=" . base_url() . "includes/js/graficosdetalhes.js></script>" .
                "\t\t<script src=" . base_url() . "includes/js/exporting.js></script>" .
                "\t\t<script src=" . base_url() . "includes/js/webSocket.js></script>\n";
        $this->load->template('Comunicacao_view', $data);
    }

    public function atualizaTable() {
        $limit = filter_input_array(INPUT_POST)['Limit'];
        //Conectando ao banco de dados
        $query = $this->Comunicacao_model->get_all_data($limit);

        echo json_encode($query);
    }
}
