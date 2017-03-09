<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Similaridade {
    public function calcula256Pontos($codCap) {
        $CI =& get_instance();
        $CI->load->model('escalas_model');
        $capAtual = $CI->escalas_model->pega_CapturaAtual($codCap);
        foreach ($capAtual as $cap) {
            $valorMedio = $cap->valorMedio;
            $ganho = $cap->gain;
        }

        $harmonicas = $CI->escalas_model->pega_Harmonicas($codCap);

        $i = 0;
        foreach ($harmonicas as $harm) {
            $sen[$i] = $harm->sen;
            $cos[$i] = $harm->cos;
            $i++;
        }

        $tempo = 0;
        for ($i = 0; $i < PONTOSONDA; $i++) {
            $resultado[$i] = $valorMedio / 2;
            for ($j = 0; $j < HARMONICAS; $j++) {
                $resultado[$i] += ($sen[$j] * sin(2 * M_PI * (($j + 1) * FREQBASE) * $tempo));
                $resultado[$i] += ($cos[$j] * cos(2 * M_PI * (($j + 1) * FREQBASE) * $tempo));
            }
            $tempo += (1 / (FREQBASE * PONTOSONDA));
            $resultado[$i] = (($resultado[$i] * 2) / 256);
            $resultado[$i] /= $ganho;
        }
        return $resultado;
    }

    public function calcula12Pontos($codCap) {
        $CI =& get_instance();
        $CI->load->model('escalas_model');
        $capAtual = $CI->escalas_model->pega_CapturaAtual($codCap);
        foreach ($capAtual as $cap) {
            $ganho = $cap->gain;
        }

        $harmonicas = $CI->escalas_model->pega_Harmonicas($codCap);

        $i = 0;
        foreach ($harmonicas as $harm) {
            $sen[$i] = $harm->sen;
            $cos[$i] = $harm->cos;
            $i++;
        }

        for ($i = 0; $i < HARMONICAS; $i++) {
            $resultado[$i] = sqrt($sen[$i] * $sen[$i] + $cos[$i] * $cos[$i]);
            $resultado[$i] /= 128;
            $resultado[$i] /= $ganho;
        }

        return $resultado;
    }

    public function spearman($pontos1, $pontos2) {
        $maxspearman[0] = 0;
        $primeirospear = 0;

        if (sizeof($pontos1) <= sizeof($pontos2)) {
            $tamanho = sizeof($pontos1);
        } else {
            $tamanho = sizeof($pontos2);
        }

        //obtém a média dos valores
        $media1 = 0;
        $media2 = 0;
        for ($i = 0; $i < $tamanho; $i++) {
            $media1 += $pontos1[$i];
            $media2 += $pontos2[$i];
        }
        $media1 /= $tamanho;
        $media2 /= $tamanho;

        //for para deslocar onda
        for ($j = 0; $j < $tamanho; $j++) {
            $spearman = 0.0;
            $spearmanaux1 = 0.0;
            $spearmanaux2 = 0.0;
            //for para percorrer onda
            for ($i = 0; $i < $tamanho; $i++) {
                $soma1 = $pontos1[$i] - $media1;
                if (($i + $j) < $tamanho) {
                    $soma2 = $pontos2[$i + $j] - $media2;
                } else {
                    $soma2 = $pontos2[$i + $j - $tamanho] - $media2;
                }
                $spearman += $soma1 * $soma2;
                $spearmanaux1 += $soma1 * $soma1;
                $spearmanaux2 += $soma2 * $soma2;
            }

            $spearmanaux1 *= $spearmanaux2;
            $spearmanaux1 = sqrt($spearmanaux1);
            $spearman /= $spearmanaux1;

            //teste melhor spearman
            $soma1 = abs($spearman);
            $soma2 = abs($maxspearman[0]);
            if ($soma1 > $soma2) {
                //armazena melhor spearman deslocando a onda
                $maxspearman[0] = number_format($spearman, 4, '.', '');
                //armazena deslocamento
                $maxspearman[1] = $j;
                //armazena spearman sem deslocar onda
                if ($primeirospear == 0) {
                    $maxspearman[2] = $spearman;
                    $primeirospear = 1;
                }
            }
            //se achar uma correlação negativa e positiva igual, armazena a positiva
            else {
                if ($soma1 == $soma2) {
                    if ($spearman > $maxspearman[0]) {
                        //armazena melhor pearson deslocando a onda
                        $maxspearman[0] = number_format($spearman, 4, '.', '');
                        //armazena deslocamento
                        $maxspearman[1] = $j;
                    }
                }
            }
        }
        return $maxspearman;
    }

    public function spearmanDeslocamento($pontos1, $pontos2) {
        $maxspearman[0] = 0;
        $primeirospear = 0;
//compara se os dois são iguais
        if (sizeof($pontos1) <= sizeof($pontos2)) {
            $tamanho = sizeof($pontos1);
        } else {
            $tamanho = sizeof($pontos2);
        }

        //obtém a média dos valores
        $media1 = 0;
        $media2 = 0;
        for ($i = 0; $i < $tamanho; $i++) {
            $media1 += $pontos1[$i];
            $media2 += $pontos2[$i];
        }
        $media1 /= $tamanho;
        $media2 /= $tamanho;

        //for para deslocar onda
        for ($j = 0; $j < $tamanho; $j++) {
            $spearman = 0.0;
            $spearmanaux1 = 0.0;
            $spearmanaux2 = 0.0;
            //for para percorrer onda
            for ($i = 0; $i < $tamanho; $i++) {
                $soma1 = $pontos1[$i] - $media1;
                if (($i + $j) < $tamanho) {
                    $soma2 = $pontos2[$i + $j] - $media2;
                } else {
                    $soma2 = $pontos2[$i + $j - $tamanho] - $media2;
                }
                $spearman += $soma1 * $soma2;
                $spearmanaux1 += $soma1 * $soma1;
                $spearmanaux2 += $soma2 * $soma2;
            }

            $spearmanaux1 *= $spearmanaux2;
            $spearmanaux1 = sqrt($spearmanaux1);
            $spearman /= $spearmanaux1;

            //System.out.println("\nSpearman Posição " + j + " : " + spearman);
            //teste melhor spearman
            $soma1 = abs($spearman);
            $soma2 = abs($maxspearman[0]);
            if ($soma1 > $soma2) {
                //armazena melhor spearman deslocando a onda
                $maxspearman[0] = number_format($spearman, 4, '.', '');
                //armazena deslocamento
                $maxspearman[1] = $j;
                //armazena spearman sem deslocar onda
                
            }
            //se achar uma correlação negativa e positiva igual, armazena a positiva
            else {
                if ($soma1 == $soma2) {
                    if ($spearman > $maxspearman[0]) {
                        //System.out.println("Entrou Spearman Igual: ");
                        //armazena melhor pearson deslocando a onda
                        $maxspearman[0] = number_format($spearman, 4, '.', '');
                        //armazena deslocamento
                        $maxspearman[1] = $j;
                    }
                }
            }
        }
        
        return $maxspearman[1];
    }
}
