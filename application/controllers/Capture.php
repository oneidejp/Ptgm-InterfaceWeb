<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'libraries/Telnet.php');

class Capture extends MY_Controller {

    /**
     * 2016
     * Desenvolvido por: Maurício Antonioli Schmitz
     * Projeto de Mestrado em Computação Aplicada - PPGCA/UPF
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Capture_model');
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

        $id = $_POST['idCheckbox']; //pega o id(captura) para gerar os gráficos
        $data['barra'] = $this->graficoBarra($id, $onda = 0);
        $data['linha'] = $this->graficoLinha($id, $onda = 0);

        echo json_encode($data);
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

            //return $this->antes("root@protegemed:~$", $resultado);
            return true;
        } catch (Exception $e) {
            return "Caught Exception ('{$e->getMessage()}')\n{$e}\n";
        }
    }

    public function index() {
        $data['tomadasExistentes'] = $this->Capture_model->get_tomadas();
        if (isset(filter_input_array(INPUT_POST)['captureTelnet'])) {
            if ($this->input->post('tomadasForm')) {
                $tomadasForm = $this->input->post('tomadasForm');
                $data['tomadaSelecionada'] = $tomadasForm[0];
                $data['comando'] = "capture {$data['tomadaSelecionada']}";
            }
            $data['host'] = "192.168.103.102";
            //$data['host'] = $this->input->post('host');
            //$data['comando'] = $this->input->post('comando');

            $data['telnet'] = $this->comandoTelnet($data['host'], $data['comando']);
        }

        $data['capturas'] = $this->Capture_model->get_all_captures();
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
        $data['headerOption'] = 
                "<link rel=\"stylesheet\" href=" . base_url() . "includes/bootstrapTable/bootstrap-table.min.css>\n" .
                "\t\t<script src=" . base_url() . "includes/js/webSocket.js></script>\n" .
                "\t\t<script src=" . base_url() . "includes/bootstrapTable/bootstrap-table.min.js></script>\n" .
                "\t\t<script src=" . base_url() . "includes/bootstrapTable/bootstrap-table-pt-BR.js></script>\n" .
                "\t\t<script src=" . base_url() . "includes/bootstrapTable/bootstrap-table-en-US.js></script>\n";
        //$this->load->view('Capture_view', $data);
        $this->load->template('Capture_view', $data);
    }

}
