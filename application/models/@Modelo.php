<?php

        /**
	* 2016
	* Desenvolvido por: Maurício Antonioli Schmitz
	* Projeto de Mestrado em Computação Aplicada - PPGCA/UPF
	*/

class nome_arquivo_php_sem_extensao extends CI_Model{
    //get all outlets
    function name() {
        $this->db->select("*");
        $this->db->from("table");
        $query = $this->db->get();

        return $query->result();
    }
    
}