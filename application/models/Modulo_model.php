<?php
/**
    * 2017
    * Alterado por: Leonardo F. Rauber
    * Email: leorauber@hotmail.com - 132789@upf.br
    * Projeto de conclusão de curso
    * UPF - Ciência da Computação
*/	

class modulo_model extends CI_Model{
	//pega todos os registros
	function get_all_modulo($limite, $offset){
		$this->db->limit($limite,$offset);

		$query = $this->db->get('modulo');
		return $query->result();
	}

	function get_all_modulo_cadastro(){
		$query = $this->db->get('modulo');
		return $query->result();
	}
	//create 
	function add_modulo($options=array()){

		$this->db->insert('modulo', $options);
		return $this->db->affected_rows();
	}
	//delete 
	function delete_modulo(){
		$this->db->where('idModulo',$this->uri->segment(3));
		$this->db->delete('modulo');
		return $this->db->affected_rows();
	}
	//update 
	function update_modulo($options=array()){
		if(isset($options['idModulo']))
			$this->db->set('idModulo',$options['idModulo']);
		if(isset($options['ip']))
			$this->db->set('ip',$options['ip']);
		if(isset($options['idWebSocket']))
			$this->db->set('idWebSocket',$options['idWebSocket']);
		if(isset($options['ultimoLiga']))
			$this->db->set('ultimoLiga',$options['ultimoLiga']);
		if(isset($options['desc']))
			$this->db->set('desc',$options['desc']);
	
		$this->db->where('idModulo',$options['idModulo']);
		$this->db->update('modulo');
		return $this->db->affected_rows();
	}
	//get by id
	function get_by_id_modulo($idModulo){
		$this->db->where('idModulo',$idModulo);
		$query=$this->db->get('modulo');
		return $query->row(0);
	}

} 

?>