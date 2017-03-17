<?php

/**
 * 2016
 * Desenvolvido por: Maurício Antonioli Schmitz
 * Projeto de Mestrado em Computação Aplicada - PPGCA/UPF
 */

class Comunicacao_model extends CI_Model {

    //get all outlets
    function get_outlets($id) {
        $this->db->select("codTomada, desc");
        $this->db->from("tomada");
        $this->db->where("codModulo = ", $id);
        $query = $this->db->get();

        return $query->result();
    }

    //get all equipments
    function get_equipments() {
        $this->db->select("codEquip, desc");
        $this->db->from("equipamento");
        $query = $this->db->get();

        return $query->result();
    }

    //get external captures (evento code = 9)
    function get_all_captures() {
        $this->db->select("*");
        $this->db->from("capturaatual");
        //$this->db->where("codEvento = 9");
        $this->db->limit(10);
        $this->db->order_by("codCaptura","desc");
        $query = $this->db->get();

        return $query->result();
    }

    //get external captures (evento code = 9)
    function get_capture($codCap) {
        $this->db->select("*");
        $this->db->from("capturaatual");
        $this->db->where("codCaptura >= ", $codCap);
        $this->db->limit(10);
        $query = $this->db->get();

        return $query->result();
    }

    //get all modules
    function get_all_modules() {
        $this->db->select("*");
        $this->db->from("modulo");
        $this->db->order_by("idModulo","asc");
        $query = $this->db->get();

        return $query->result();
    }

}
