<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'libraries/Telnet.php');

class Captura extends MY_Controller {

    /**
     * 2016
     * Desenvolvido por: Maurício Antonioli Schmitz
     * Projeto de Mestrado em Computação Aplicada - PPGCA/UPF
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Captura_model');
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

        $id = filter_input_array(INPUT_POST)['Modulo']; //pega o id do modulo
        $outlets = $this->Captura_model->get_outlets($id);

        echo json_encode($outlets);
    }

    public function comandoTelnet($host, $comando) {
        try {

            $t = new Net_Telnet(array(
                'host' => $host
            ));
            $t->echomode("none");
            $t->connect();
            if ($t->online()) {
                $resultado = $t->cmd($comando);
                $resultado = $t->cmd("exit");
                $t->disconnect();
            }

            return $this->antes("root@protegemed:~$", $resultado);
            //return true;
        } catch (Exception $e) {
            return "Caught Exception ('{$e->getMessage()}')\n{$e}\n";
        }
    }

    public function testTelnet() {
        //$host = filter_input_array(INPUT_POST)['Host']; //pega o host enviado pelo ajax
        $host = "192.168.1.101";
        $channel = filter_input_array(INPUT_POST)['Channel']; //pega o channel enviado pelo ajax
        $outlet = filter_input_array(INPUT_POST)['Outlet']; //pega o channel enviado pelo ajax
        $comando = "capture {$outlet} {$channel}";
        try {
            $t = new Net_Telnet(array(
                'host' => $host
            ));
            $t->echomode("none");
            $t->connect();
            if ($t->online()) {
                $resultado = $t->cmd($comando);
                $resultado = $t->cmd("exit");
                $t->disconnect();
            }

            echo json_encode($this->antes("root@protegemed:~$", $resultado));
            //echo json_encode("Funfou");
        } catch (Exception $e) {
            return "Caught Exception ('{$e->getMessage()}')\n{$e}\n";
        }
    }

    public function index() {
        //$data['tomadasExistentes'] = $this->Captura_model->get_tomadas();
        $data['modules'] = $this->Captura_model->get_all_modules();
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

        $data['capturas'] = $this->Captura_model->get_all_captures();
        $i = 0;
        //$anterior = 0;
        foreach ($data['capturas'] as $dados) {
            //periculosidade recebe 0, informando que não existe perigo por padrão
            //se receber 1 ou 2 nos testes abaixo vai retornar aquele valor, informando perigo
            $periculosidade = 0;

            //periculosidade corrente
            if ($dados->eficaz >= 0.1 && $dados->eficaz < 0.5) {
                //atenção
                $periculosidade = 1;
            } elseif ($dados->eficaz >= 0.5) {
                //perigo
                $periculosidade = 2;
            }

            //informa os segundos entre dois campos da tabela
            //$inicio = strtotime($dados->dataAtual);
            //$diff = $inicio - $anterior;
            //$anterior = strtotime($dados->dataAtual);


            if ($periculosidade == 0) {
                $data["periculosidade"][$i] = 0;
            } elseif ($periculosidade == 1) {
                $data["periculosidade"][$i] = 1;
            } elseif ($periculosidade == 2) {
                $data["periculosidade"][$i] = 2;
            }
            $i++;
        }

        $data['title'] = $this->lang->line('capture');
        $data['footerHide'] = 'true';
        $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                "\t\t<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>" .
                "\t\t<script src=" . base_url() . "includes/js/highcharts.js></script>" .
                "\t\t<script src=" . base_url() . "includes/js/graficosdetalhes.js></script>" .
                "\t\t<script src=" . base_url() . "includes/js/exporting.js></script>" .
                "\t\t<script src=" . base_url() . "includes/js/webSocket.js></script>\n";
        $this->load->template('Captura_view', $data);
    }

}
