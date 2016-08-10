<?php

/**
 * 2016
 * Desenvolvido por: Maurício Antonioli Schmitz
 * Projeto de Mestrado em Computação Aplicada - PPGCA/UPF
 */

class Captura_model extends CI_Model {

    //get all outlets
    function get_outlets($id) {
        $this->db->select("codTomada, desc");
        $this->db->from("tomada");
        $this->db->where("modulo = ", $id);
        $query = $this->db->get();

        return $query->result();
    }

    //get external captures (evento code = 9)
    function get_all_captures() {
        $this->db->select("*");
        $this->db->from("capturaatual");
        $this->db->where("codEvento = 9");
        $this->db->order_by("codCaptura","desc");
        $query = $this->db->get();

        return $query->result();
    }

    //get all modules
    function get_all_modules() {
        $this->db->select("*");
        $this->db->from("modulo");
        $this->db->order_by("idmodulo","asc");
        $query = $this->db->get();

        return $query->result();
    }

}
