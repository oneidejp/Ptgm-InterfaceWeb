<?php

/**
	* 2015
	* Desenvolvido por: Mateus Perego
	* Email: mateusperego@yahoo.com.br
	* Projeto de conclusão de curso
	* UPF - Ciência da Computação
	*/	

class alertas_model extends CI_Model{

	//get alertas
	function get_all_alertas($codUsoSala){
		$this->db->select("cap.codCaptura, cap.codEquip, equip.desc, cap.codTomada, cap.dataAtual, cap.eficaz"); //uso sala uso.codusosala
		$this->db->from ('capturaatual cap, usosalacaptura uso, equipamento equip');
		$this->db->where('cap.codCaptura NOT IN (SELECT a.codCaptura FROM alerta a)');
		$this->db->where('uso.codUsoSala = ', $codUsoSala);
		$this->db->where('uso.codCaptura = cap.codCaptura');
		$this->db->where('codEvento = 1');
		$this->db->where('cap.codEquip = equip.codEquip');
		$query = $this->db->get();

		return $query->result();
	}

	//get alerta descrição
	function get_alerta_desc($codUsoSala){
		$this->db->select("salacirurgia.desc"); 
		$this->db->from ('salacirurgia');
		$this->db->where('codSala = ', $codUsoSala);
		$query = $this->db->get();

		return $query->result();
	}

	// pega alertas daquele codusosala apenas
	function get_alerta($codUsoSala, $codCaptura){
		$this->db->select("cap.codCaptura, cap.codEquip, cap.codTomada, cap.dataAtual, cap.eficaz");
		$this->db->from ('capturaatual cap, usosalacaptura uso');
		$this->db->where('cap.codCaptura NOT IN (SELECT a.codCaptura FROM alerta a)');
		$this->db->where('uso.codUsoSala = ', $codUsoSala);
		$this->db->where('uso.codCaptura = cap.codCaptura');
		$this->db->where('uso.codCaptura = ', $codCaptura);
		$this->db->where('codEvento = 1');
		$query = $this->db->get();

		return $query->result();
	}

	// grava alertas
	function add_alerta($options=array()){
		$this->db->insert('alerta', $options);
		return $this->db->affected_rows();

	}
	
}