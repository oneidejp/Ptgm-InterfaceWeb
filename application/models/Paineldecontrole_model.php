<?php

class paineldecontrole_model extends CI_Model {

    //pega todos os registros das salas em uso
    function get_all_usosala() {
        $this->db->select('usosala.codUsoSala, salacirurgia.desc, usosala.horaInicio, usosala.horaFinal');
        $this->db->from('usosala, salacirurgia');
        $this->db->where('usosala.codUsoSala = salacirurgia.codSala');
        $this->db->where('usosala.ativa = 1');
        $this->db->order_by('usosala.codUsoSala');
        $query = $this->db->get();

        return $query->result();
    }

    /*function get_all_usosala(){
      //$this->db->select("DATE_FORMAT(horaInicio,('%H:%i:%S')) as hora, salacirurgia.desc, codUsoSala");
      $this->db->select("horaInicio as hora,salacirurgia.desc, codUsoSala");
      $this->db->from ('usosala,salacirurgia');
      $this->db->where('usosala.codUsoSala = salacirurgia.codSala');
      $this->db->where('ativa = 1');
      $this->db->order_by('codUsoSala');
      $query = $this->db->get();

      return $query->result();
      }*/

    // get todos codusosala
    function get_all_codusosala() {
        $this->db->select('*');
        $this->db->from('usosala');
        //$this->db->where('ativa = 1');
        //$this->db->order_by('codUsoSala');
        $query = $this->db->get();

        return $query->result();
    }

    //get todos os dados do codUsoSala
    function get_by_id_usosala($codUsoSala) {
        $this->db->select("horaInicio as hora, salacirurgia.desc, codUsoSala");
        $this->db->from('usosala,salacirurgia');
        $this->db->where('usosala.codUsoSala = salacirurgia.codSala');
        $this->db->where('ativa = 1');
        $this->db->where('codUsoSala', $codUsoSala);
        $query = $this->db->get();

        return $query->row(0);
    }

    //get all alertas
    function get_all_alertas() {
        $this->db->select('usoCap.codUsoSala');
        $this->db->from('capturaatual cap, usosalacaptura usoCap, usosala');
        $this->db->where('usoCap.codCaptura = cap.codCaptura');
        $this->db->where('usosala.codUsoSala = usoCap.codUsoSala');
        $this->db->where('usosala.ativa = 1');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    /**function get_all_alertas() {
        $this->db->select("uso.codUsoSala");
        $this->db->from('capturaatual cap, usosalacaptura uso, usosala');
        $this->db->where('cap.codCaptura NOT IN (SELECT a.codCaptura FROM alerta a)');
        $this->db->where('uso.codUsoSala = uso.codUsoSala');
        $this->db->where('uso.codCaptura = cap.codCaptura');
        $this->db->where('usosala.codUsoSala = uso.codUsoSala');
        $this->db->where('usosala.ativa = 1');
        $this->db->where('codEvento = 1');
        $query = $this->db->get();

        return $query->result();
    }*/

}