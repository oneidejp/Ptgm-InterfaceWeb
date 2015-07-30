<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comparar extends MY_Controller {

	/**
	* 2015
	* Desenvolvido por: Mateus Perego
	* Email: mateusperego@yahoo.com.br
	* Projeto de conclusão de curso
	* UPF - Ciência da Computação
	*/	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('comparar_model');
		$this->load->model('detalhes_model');
	}  

	public function index($codUsoSala){
		$codUsoSala = $this->uri->segment(3);
		$equipamento = $this->uri->segment(4);

		$data['equipamento']= $this->comparar_model->get_all_equipamento($equipamento);

		foreach ($data['equipamento'] as $dados) {
			list($days, $hours, $minutes, $seconds) = $this->secondsToTime($dados->tempoUso);
			$data['tempodeuso'] =  "{$days}d {$hours}h {$minutes}m {$seconds}s";
		}

		$data['codUsoSala']=$codUsoSala;
		
		$data['fase']= $this->comparar_model->get_all_fase($equipamento, $codUsoSala);
		$data['fuga']= $this->comparar_model->get_all_fuga($equipamento, $codUsoSala);

		$data['fasepadrao']= $this->comparar_model->get_all_fase_padrao($equipamento);
		$data['fugapadrao']= $this->comparar_model->get_all_fuga_padrao($equipamento);

		$this->load->view('comparar',$data);				
	}

	public function atualiza_fase(){
		$CodEquip = $_POST['CodEquip']; //id station selecionado, agora $id tem valor do java script no exemplo	
		$sala = $_POST['Sala']; //id station selecionado, agora $id tem valor do java script no exemplo	

		$data['captura']= $this->comparar_model->get_capturas_fase($sala,$CodEquip);

		echo json_encode($data);
	}

	public function atualiza_fuga(){
		$CodEquip = $_POST['CodEquip']; //id station selecionado, agora $id tem valor do java script no exemplo	
		$sala = $_POST['Sala']; //id station selecionado, agora $id tem valor do java script no exemplo	

		$data['captura']= $this->comparar_model->get_capturas_fuga($sala,$CodEquip);

		echo json_encode($data);
	}

	public function graficos(){

		$captura = $_POST['Captura']; //id station selecionado, agora $id tem valor do java script no exemplo	

		$data['barra'] = $this->graficoBarra($captura,$onda=0);
		$data['linha'] = $this->graficoLinha($captura,$onda=0);

		echo json_encode($data);
	}

	/**
 	* Converte segunos em horas, minutos e segundos
 	* 
 	* @param integer $seconds Number of seconds to parse
 	* @return array
 	*/
	function secondsToTime($time){
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
	public function graficoLinha($codCaptura, $onda){
		$i = 0;	
		if($onda==0){
			$dados2 = $this->detalhes_model->get_cod_captura($codCaptura);
			foreach($dados2 as $dados2):
				$ganho = $dados2->gain;
			$valormedio = $dados2->valormedio;
			$deslocamento = $dados2->offset;
			endforeach;
			$dados3 = $this->detalhes_model->get_harmonica($codCaptura);
			foreach($dados3 as $dados3):
				$cos[$i] = $dados3->cos;
				$sen[$i] = $dados3->sen;
				$i = $i + 1;
			endforeach;
			$tempo[0]=0;
			for ($j=0; $j< PONTOSONDA; $j++){
				$ponto[$j]= (float)$valormedio/2;
				for($i=0;$i<HARMONICAS;$i++)
					$ponto[$j]= $ponto[$j] + $sen[$i] * sin(2 *M_PI*($i+1)*FREQBASE*$tempo[$j]) + $cos[$i] * cos(-2*M_PI*($i+1)*FREQBASE*$tempo[$j]);  	
				$ponto[$j] = (int) (($ponto[$j] * (2.0)) / 256.0);
				$ponto[$j] = ($ponto[$j] - $deslocamento ) / $ganho;
				$tempo[$j+1] = ($tempo[$j] + (float) (1.0 / (60 * 256)));
				$pontos[$j][0] = (int) ($tempo[$j]*100000);
				$pontos[$j][1] = $ponto[$j];
			}		
		}else{
			$dados2 = $this->detalhes_model->get_cod_captura($codCaptura);
			foreach($dados2 as $dados2):
				$ganho = $dados2->gain;
			$valormedio = $dados2->valormedio;
			$deslocamento = $dados2->offset;
			endforeach;
			$dados3 = $this->detalhess_model->get_harmonica_padrao($codCaptura);
			foreach($dados3 as $dados3):
				$cos[$i] = $dados3->cos;
			$sen[$i] = $dados3->sen;
			$i = $i + 1;
			endforeach;
			$tempo[0]=0;
			for ($j=0; $j< PONTOSONDA; $j++){
				$ponto[$j]= (float)$valormedio/2;
				for($i=0;$i<HARMONICAS;$i++)
					$ponto[$j]= $ponto[$j] + $sen[$i] * cos(2 *M_PI*($i+1)*FREQBASE*$tempo[$j]) + $cos[$i] * sin(-2*M_PI*($i+1)*FREQBASE*$tempo[$j]);  	
				$ponto[$j] = (int) (($ponto[$j] * (2.0)) / 256.0);
				$ponto[$j] = ($ponto[$j] - $deslocamento ) / $ganho;
				$tempo[$j+1] = ($tempo[$j] + (float) (1.0 / (60 * 256)));
				$pontos[$j][0] = (int) ($tempo[$j]*100000);
				$pontos[$j][1] = $ponto[$j];
			}
		}
		return($pontos);
	}

	public function graficoBarra($codCaptura,$onda){
		$i=0;
		if($onda==0){
			$dados2 = $this->detalhes_model->get_cod_captura($codCaptura);
			foreach($dados2 as $dados2):
				$ganho = $dados2->gain;
			$valormedio = $dados2->valormedio;
			$deslocamento = $dados2->offset;
			endforeach;
			$dados3 = $this->detalhes_model->get_harmonica($codCaptura);
			foreach($dados3 as $dados3):
				$cos[$i] = $dados3->cos;
			$sen[$i] = $dados3->sen;
			$i = $i + 1;
			endforeach;

			/* valor da primeira barra (corrente continua, identificada por "DC" valores da tabela capturaatual */
				$f= abs( ($valormedio / PONTOSONDA - $deslocamento) / $ganho );
				$barras[0]=$f;
				$barra[0] = $barras[0];

	    	//valor das 12 proximas barras identificar por (i+1) * FREQBASE
				for ($i = 0; $i < HARMONICAS; $i++) {
					$f = (float) sqrt( $sen[$i] * $sen[$i] + $cos[$i] * $cos[$i])  / 128  ;  
					$f = $f / $ganho;  
	    		$barras[$i+1]=$f;//valor do F
	    		$barra[$i+1] = $barras[$i+1];
	    	}
	    }else{
	    	$dados2 = $this->detalhes_model->get_cod_captura($codCaptura);
	    	foreach($dados2 as $dados2):
	    		$ganho = $dados2->gain;
	    	$valormedio = $dados2->valormedio;
	    	$deslocamento = $dados2->offset;
	    	endforeach;
	    	$dados3 = $this->detalhes_model->get_harmonica_padrao($codCaptura);
	    	foreach($dados3 as $dados3):
	    		$cos[$i] = $dados3->cos;
	    	$sen[$i] = $dados3->sen;
	    	$i = $i + 1;
	    	endforeach;

	    	/* valor da primeira barra (corrente continua, identificada por "DC" valores da tabela capturaatual */
	    		$f= abs( ($valormedio / PONTOSONDA - $deslocamento) / $ganho );
	    		$barras[0]=$f;
	    		$barra[0] = $barras[0];

	    	//valor das 12 proximas barras identificar por (i+1) * FREQBASE
	    		for ($i = 0; $i < HARMONICAS; $i++) {
	    			$f = (float) sqrt( $sen[$i] * $sen[$i] + $cos[$i] * $cos[$i])  / 128  ;  
	    			$f = $f / $ganho;  
	    		$barras[$i+1]=$f;//valor do F
	    		$barra[$i+1] = $barras[$i+1];
	    	}
	    }
	    return($barra);
	}}