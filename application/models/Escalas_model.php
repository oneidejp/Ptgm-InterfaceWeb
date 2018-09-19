<?php

/**
 * 2016
 * Desenvolvido por: Maurício Antonioli Schmitz
 * Projeto de Mestrado em Computação Aplicada - PPGCA/UPF
 */
class escalas_model extends CI_Model {

    function pega_Harmonicas($codCap) {
        $this->db->select("*");
        $this->db->from('harmatual');
        $this->db->where('codCaptura = ', $codCap);
        $query = $this->db->get();

        return $query->result();
    }

    function pega_CapturaAtual($codCap) {
        $this->db->select("*");
        $this->db->from('capturaatual');
        $this->db->where('codCaptura = ', $codCap);
        $query = $this->db->get();

        return $query->result();
    }

}
