<?php
//* 2016 Controller
//* Desenvolvido por: Leonardo Francisco Rauber
//* Email: leorauber@hotmail.com - 132789@upf.br
//* Projeto de conclusão de curso
//* UPF - Ciência da Computação

defined('BASEPATH') OR exit('No direct script access allowed');

class Popup_grafico_deslocada extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('formaondacapturadas_model');
        $this->load->library('similaridade');
    }
    
    public function index() {
        $data['title'] = "PopUp";
        $data['menuHide'] = 'true';
        $data['footerHide'] = 'true';
        $data['headerOption'] = "<link rel='stylesheet' href=" . base_url() . "includes/css/estilo.css>" .
                "<link rel='stylesheet' href=" . base_url() . "includes/css/abas.css>" .
                "<link rel='stylesheet' href=" . base_url() . "includes/bootstrapTable/bootstrap-table.min.css>" . 
                "<link rel='stylesheet' href=" . base_url() . "includes/css/estilosLeo.css>" . 
                "<link rel='stylesheet' href=" . base_url() . "includes/js/jquery-ui-1.11.4.custom/jquery-ui.min.css>" . 
                "<script src=" . base_url() . "includes/js/jquery.min.js></script>" .
                "<script src=" . base_url() . "includes/js/jquery-ui-1.11.4.custom/jquery-ui.min.js></script>" .
                "<script src=" . base_url() . "includes/bootstrapTable/bootstrap-table.min.js></script>" .
                "<script src=" . base_url() . "includes/bootstrapTable/bootstrap-table.min.js></script>" .
                "<script src=" . base_url() . "includes/js/highcharts.js></script>" .
                "<script src=" . base_url() . "includes/js/graficosdetalhes.js></script>" .
                "<script src=" . base_url() . "includes/js/exporting.js></script>";
        $this->load->template('Popup_grafico_deslocada_view', $data);
    }

    //função calcula gráfico linha normal e padrão
    public function graficoLinha($codCaptura, $onda) {
        $i = 0;
            $dados2 = $this->formaondacapturadas_model->get_cod_captura($codCaptura);
            $dados3 = $this->formaondacapturadas_model->get_harmonica($codCaptura);
            $ganho = $dados2[0]->gain;
            $valormedio = $dados2[0]->valormedio;
      
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
                $ponto[$j] = $ponto[$j] / $ganho;
                $tempo[$j + 1] = ($tempo[$j] + (1.0 / (60 * 256)));
                $pontos[$j][0] = ($tempo[$j] * 100000);
                $pontos[$j][1] = $ponto[$j];
            }
        return($pontos);
    }
    
    public function deslocaOnda(){
        // AS DUAS ONDAS SELECIONADAS
        $cod1 = filter_input_array(INPUT_POST)['Cod1']; 
        $cod2 = filter_input_array(INPUT_POST)['Cod2']; 
        $onda1 = $this->similaridade->calcula256Pontos($cod1);
        $onda2 = $this->similaridade->calcula256Pontos($cod2);
        $deslocamento = $this->similaridade->spearmanDeslocamento($onda1, $onda2);
        //echo $deslocamento;
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
        
        $deslocada['linha1'] = $this->graficoLinha($cod1, $onda = 0);
        $deslocada['linha2'] = $ondaDeslocada;
        
        echo json_encode($deslocada);
    }

    
}
