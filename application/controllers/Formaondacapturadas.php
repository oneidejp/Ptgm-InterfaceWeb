<?php
//* 2016 Controller
//* Desenvolvido por: Leonardo Francisco Rauber
//* Email: leorauber@hotmail.com - 132789@upf.br
//* Projeto de conclusão de curso
//* UPF - Ciência da Computação

defined('BASEPATH') OR exit('No direct script access allowed');

class Formaondacapturadas extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('formaondacapturadas_model');
        $this->load->library('similaridade');
    }
    
    public function index() {
        $data['title'] = $this->lang->line('fo_captured');
        $data['footerHide'] = 'true';
        $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>" .
                "<link rel='stylesheet' href=" . base_url() . "includes/bootstrapTable/bootstrap-table.min.css>" . 
                "<link rel='stylesheet' href=" . base_url() . "includes/css/estilosLeo.css>" . 
                "<link rel='stylesheet' href=" . base_url() . "includes/dataTables/jquery.dataTables.min.css>" .
                "<link rel='stylesheet' href=" . base_url() . "includes/js/jquery-ui-1.11.4.custom/jquery-ui.min.css>" . 
                "<link rel='stylesheet' href=" . base_url() . "includes/Timepicker/jquery-ui-timepicker-addon.css>" . 
                "<script src=" . base_url() . "includes/js/jquery.min.js></script>" .
                "<script src=" . base_url() . "includes/js/jquery-ui-1.11.4.custom/jquery-ui.min.js></script>" .
                "<script src=" . base_url() . "includes/Timepicker/jquery-ui-timepicker-addon.js></script>" .
                "<script src=" . base_url() . "includes/bootstrapTable/bootstrap-table.min.js></script>" .
                "<script src=" . base_url() . "includes/bootstrapTable/bootstrap-table.min.js></script>" .
                "<script src=" . base_url() . "includes/dataTables/jquery.dataTables.min.js></script>" .
                "<script src=" . base_url() . "includes/js/highcharts.js></script>" .
                "<script src=" . base_url() . "includes/js/graficosdetalhes.js></script>" .
                "<script src=" . base_url() . "includes/js/exporting.js></script>";
        $this->load->template('Formaondacapturadas_view', $data);
    }

    public function graficos() {

        $id = filter_input_array(INPUT_POST)['idCheckbox']; //pega o id(captura) para gerar os gráficos

        $data['barra'] = $this->graficoBarra($id, $onda = 0);
        $data['linha'] = $this->graficoLinha($id, $onda = 0);

        echo json_encode($data);
    }
    
    public function linha() {

        $captura = filter_input_array(INPUT_POST)['Captura']; //pega codCaptura vindo do ajax
        $data['linha'] = $this->graficoLinha($captura, $onda = 0);

        echo json_encode($data);
    }
    
    public function barra() {

        $captura = filter_input_array(INPUT_POST)['Captura']; //pega codCaptura vindo do ajax
        $data['barra'] = $this->graficoBarra($captura, $onda = 0);

        echo json_encode($data);
    }
    
    /**
     * Converte segundos em horas, minutos e segundos
     *
     * @param integer $time Number of seconds to parse
     * @return array
     */
    function secondsToTime($time) {
        $days = floor($time / (60 * 60 * 24));
        $time -= $days * (60 * 60 * 24);

        $hours = floor($time / (60 * 60));
        $time -= $hours * (60 * 60);

        $minutes = floor($time / 60);
        $time -= $minutes * 60;

        $seconds = floor($time);
        $time -= $seconds;

        return array($days, $hours, $minutes, $seconds);
    }

    //função calcula gráfico linha normal e padrão
    public function graficoLinha($codCaptura, $onda) {
        $i = 0;
//        if ($onda == 0) {
//            
            $dados2 = $this->formaondacapturadas_model->get_cod_captura($codCaptura);
            $dados3 = $this->formaondacapturadas_model->get_harmonica($codCaptura);
            
                  $ganho = $dados2[0]->gain;
                    $valormedio = $dados2[0]->valormedio;
            /*
            foreach ($dados2 as $dados21):
                    $ganho = $dados21->gain;
                    $valormedio = $dados21->valormedio;
            endforeach;
/*          
                    $ret = $dados2->get->row();    
                    $ganho = $ret->gain;
                    $valormedio = $ret->valormedio;
                //    $deslocamento = $dados21->offset;
  */              
            
            
            foreach ($dados3 as $dados31):
                $cos[$i] = $dados31->cos;
                $sen[$i] = $dados31->sen;
                $i = $i + 1;
            endforeach;

            
            
            $tempo[0] = 0;
            for ($j = 0; $j < PONTOSONDA; $j++) {
                $ponto[$j] = $valormedio;
                for ($i = 0; $i < HARMONICAS; $i++)
                    $ponto[$j] = $ponto[$j] + $sen[$i] * sin(2 * M_PI * ($i + 1) * FREQBASE * $tempo[$j]) + $cos[$i] * cos(2 * M_PI * ($i + 1) * FREQBASE * $tempo[$j]);
//$ponto[$j] =  (($ponto[$j] * (2.0)) / 256.0);
//$ponto[$j] = ($ponto[$j] - $deslocamento ) / $ganho;
                $ponto[$j] = $ponto[$j] / $ganho;
                $tempo[$j + 1] = ($tempo[$j] + (1.0 / (60 * 256)));
                $pontos[$j][0] = ($tempo[$j] * 100000);
                $pontos[$j][1] = $ponto[$j];
            }
//        } else {
//            
//            $dados3 = $this->ultimascapturadas_model->get_harmonica_padrao($codCaptura);
//            foreach ($dados3 as $dados3):
//                $cos[$i] = $dados3->cos;
//                $sen[$i] = $dados3->sen;
//                $i = $i + 1;
//            endforeach;
//            $dados2 = $this->ultimascapturadas_model->get_cod_captura($codCaptura);
//            foreach ($dados2 as $dados2):
//                $ganho = $dados2->gain;
//                $valormedio = $dados2->valormedio;
//                $deslocamento = $dados2->offset;
//            endforeach;
//            $tempo[0] = 0;
//            for ($j = 0; $j < PONTOSONDA; $j++) {
//                $ponto[$j] = (float) $valormedio / 2;
//                for ($i = 0; $i < HARMONICAS; $i++)
//                    $ponto[$j] = $ponto[$j] + $sen[$i] * cos(2 * M_PI * ($i + 1) * FREQBASE * $tempo[$j]) + $cos[$i] * sin(-2 * M_PI * ($i + 1) * FREQBASE * $tempo[$j]);
//                $ponto[$j] = (int) (($ponto[$j] * (2.0)) / 256.0);
//                $ponto[$j] = ($ponto[$j] - $deslocamento ) / $ganho;
//                $tempo[$j + 1] = ($tempo[$j] + (float) (1.0 / (60 * 256)));
//                $pontos[$j][0] = (int) ($tempo[$j] * 100000);
//                $pontos[$j][1] = $ponto[$j];
//            }
//        }
        return($pontos);
    }
    
    public function deslocaOnda(){
        // AS DUAS ONDAS SELECIONADAS
        $cod1 = filter_input_array(INPUT_POST)['Cod1']; 
        $cod2 = filter_input_array(INPUT_POST)['Cod2']; 
        $onda1 = $this->similaridade->calcula256Pontos($cod1);
        $onda2 = $this->similaridade->calcula256Pontos($cod2);
        $deslocamento = $this->similaridade->spearmanDeslocamento($onda1, $onda2);
        // PEGA A ONDA
        $linha2 = $this->graficoLinha($cod2, $onda = 0);
        $ondaDeslocada = $linha2;
        
        $tamanho = 256;
        $l = 0;
        // DESLOCANDO O VETOR
        for($d = $deslocamento; $d < $tamanho; $d++){
            $ondaDeslocada[$l][1] = $linha2[$d][1];
            $l++;
        }
        for($d = 0; $d < $deslocamento; $d++){
            $ondaDeslocada[$l][1] = $linha2[$d][1];
            $l++;
        }
//        echo json_encode($deslocamento);
        //echo json_encode($linha2);
        echo json_encode($ondaDeslocada);
    }

    //função calcula gráfico de barras
    public function graficoBarra($codCaptura, $onda) {
        $i = 0;
        if ($onda == 0) {
            $dados2 = $this->formaondacapturadas_model->get_cod_captura($codCaptura);
            foreach ($dados2 as $dados2):
                $ganho = $dados2->gain;
                $valormedio = $dados2->valormedio;
                $deslocamento = $dados2->offset;
            endforeach;
            $dados3 = $this->formaondacapturadas_model->get_harmonica($codCaptura);
            foreach ($dados3 as $dados3):
                $cos[$i] = $dados3->cos;
                $sen[$i] = $dados3->sen;
                $i = $i + 1;
            endforeach;

            /* valor da primeira barra (corrente continua, identificada por "DC" valores da tabela capturaatual */
            $f = abs($valormedio / $ganho);
            $barras[0] = $f;
            $barra[0] = $barras[0];

//valor das 12 proximas barras identificar por (i+1) * FREQBASE
            for ($i = 0; $i < HARMONICAS; $i++) {
                $f = (float) sqrt($sen[$i] * $sen[$i] + $cos[$i] * $cos[$i]);
                $f = $f / $ganho;
                $barras[$i + 1] = $f; //valor do F
                $barra[$i + 1] = $barras[$i + 1];
            }
        } else {
            $dados2 = $this->formaondacapturadas_model->get_cod_captura($codCaptura);
            foreach ($dados2 as $dados2):
                $ganho = $dados2->gain;
                $valormedio = $dados2->valormedio;
                $deslocamento = $dados2->offset;
            endforeach;
            $dados3 = $this->formaondacapturadas_model->get_harmonica_padrao($codCaptura);
            foreach ($dados3 as $dados3):
                $cos[$i] = $dados3->cos;
                $sen[$i] = $dados3->sen;
                $i = $i + 1;
            endforeach;

            /* valor da primeira barra (corrente continua, identificada por "DC" valores da tabela capturaatual */
            $f = abs(($valormedio / PONTOSONDA - $deslocamento) / $ganho);
            $barras[0] = $f;
            $barra[0] = $barras[0];

//valor das 12 proximas barras identificar por (i+1) * FREQBASE
            for ($i = 0; $i < HARMONICAS; $i++) {
                $f = (float) sqrt($sen[$i] * $sen[$i] + $cos[$i] * $cos[$i]) / 128;
                $f = $f / $ganho;
                $barras[$i + 1] = $f; //valor do F
                $barra[$i + 1] = $barras[$i + 1];
            }
        }
        return($barra);
    }

    public function tabelaSimilaridade() {
        $checkBoxes = filter_input_array(INPUT_POST)['Check'];  //pega código de captura dos checkboxes clicados, vindo do ajax
        $cont = count($checkBoxes);

//se foi clicado apenas um checkbox
        if ($cont <= 1) {
            $html = "<tr><td>{$checkBoxes[0]}</td><td>1</td></tr>";
        } else {
//transformar vetor em matriz
            $tabela = array();
            $tabela[0][0] = "-";
            for ($i = 0; $i < $cont; $i++) {
                $tabela[$i + 1][0] = $checkBoxes[$i];
                $tabela[0][$i + 1] = $checkBoxes[$i];
            }

//calcula a similaridade e preenche a tabela
            for ($i = 0; $i < $cont; $i++) {
                $onda1 = $this->similaridade->calcula256Pontos($tabela[$i + 1][0]);
                for ($j = 0; $j < $cont; $j++) {
                    if ($i === $j) {
                        $tabela[$i + 1][$j + 1] = "1";
                    } else {
                        $onda2 = $this->similaridade->calcula256Pontos($tabela[0][$j + 1]);
                        $recebeSpearman = $this->similaridade->spearman($onda1, $onda2);
                        $tabela[$i + 1][$j + 1] = $recebeSpearman[0];
                    }
                }
            }

//cria o html da tabela
            $html = "";
            for ($i = 0; $i < $cont + 1; $i++) {
                $html .= "<tr>";
                for ($j = 0; $j < $cont + 1; $j++) {
                    if($j!=0 && $i!=0 && $tabela[$i][$j] != 1){
                        $html .= "<td onclick=deslocaGrafico({$tabela[$i][0]},{$tabela[0][$j]})>{$tabela[$i][$j]}</td>";
                    } else {
                        $html .= "<td>{$tabela[$i][$j]}</td>";
                    }
                }
                $html .= "</tr>";
            }
        }
//envia para view a tabela completa
        echo json_encode($html);
    }
    
    public function getDataTable() {
        $equipment = filter_input_array(INPUT_POST)['Equipment'];
        $fase = filter_input_array(INPUT_POST)['Fase'];
        $fuga = filter_input_array(INPUT_POST)['Fuga'];
        $datestart = filter_input_array(INPUT_POST)['Datestart'];
        $dateend = filter_input_array(INPUT_POST)['Dateend'];
        $limit = filter_input_array(INPUT_POST)['Limit'];
        //Conectando ao banco de dados
        $query = $this->formaondacapturadas_model->get_all_data($equipment, $fase, $fuga, $datestart, $dateend, $limit);

        echo json_encode($query);
    }
    
}
