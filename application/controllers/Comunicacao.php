<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'libraries/Telnet.php');

class Comunicacao extends MY_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('detalhes_model');
        //$this->load->library('similaridade');
    }

    public function conectarTelnet() {
        //$host = $_POST['Host'];
        //$comando = $_POST['Comando'];
        try {
            $t = new Net_Telnet("192.168.103.102");
            $t->prompt("root@protegemed:~$ ");
            $t->connect();


            echo $t->cmd('help');

            $t->disconnect();

            $t->get_data();
            /* $t = new Net_Telnet($host);
              $t->connect();
              $t->prompt("root@protegemed:~$ ");

              $t->cmd('help');

              $t->disconnect();

              $return = $t->get_data(); */
        } catch (Exception $e) {
            //$return = "Exception ('{$e->getMessage()}')\n{$e}\n";
        }



        //$algo = $_POST['Algo']; //pega código de captura dos checkboxes clicados, vindo do ajax
        //echo json_encode($comando);
        //exit();
    }

    public function index() {
        if (isset(filter_input_array(INPUT_POST)['cadastrar'])) {
            try {
                //$t = new Net_Telnet();
                /*$t = new Net_Telnet(array(
                    'host' => '192.168.103.102',
                    'debug' => 'false',
                    'prompt' => 'root@protegemed:~$ ',
                ));*/
                $t = new Net_Telnet(array(
                    'host' => 'localhost',
                    'debug' => 'true',
                    'prompt' => 'Mauricios-MacBook-Pro:~ mauricioschmitz$ ',
                ));
                $t->echomode('none');
                $t->login("mauricioschmitz", "mas");
                //$opa = $t->cmd('listparam');
                if ($t->online()) {
                    //mandou help e recebeu o retorno
                    $data['telnet'] = $t->cmd('help');
                    var_dump($data['telnet']);
                    //$data['buff'] = $t->get_data();
                    //$data['buff'] = $t->read_sthelpream();
                    $data['telnet2'] = $t->cmd('exit');
                    var_dump($data['telnet2']);
                    $data['buff2'] = $t->get_data();
                    //var_dump($t->cmd('exit'));
                }
                //
                //$data['telnet2'] = $t->cmd('listparam');
                //

                $t->disconnect();
            } catch (Exception $e) {
                echo "Caught Exception ('{$e->getMessage()}')\n{$e}\n";
            }
        }
        $data['algo'] = "recebe algo";
        $this->load->template('Comunicacao_view', $data);
    }

}
