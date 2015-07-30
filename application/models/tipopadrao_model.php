<?php
/**
	* 2015
	* Desenvolvido por: Mateus Perego
	* Email: mateusperego@yahoo.com.br
	* Projeto de conclusão de curso
	* UPF - Ciência da Computação
	*/	

class tipopadrao_model extends CI_Model{
	//pega todos os registros
	function get_all_tipopadrao($limite, $offset){
		$this->db->limit($limite,$offset);

		$query = $this->db->get('tipopadrao');
		return $query->result();
	}
	//create 
	function add_tipopadrao($options=array()){

		$this->db->insert('tipopadrao', $options);
		return $this->db->affected_rows();
	}
	//delete 
	function delete_tipopadrao(){
		$this->db->where('codTipoPadrao',$this->uri->segment(3));
		$this->db->delete('tipopadrao');
		return $this->db->affected_rows();
	}
	//update 
	function update_tipopadrao($options=array()){
		if(isset($options['codTipoPadrao']))
			$this->db->set('codTipoPadrao',$options['codTipoPadrao']);
		if(isset($options['desc']))
			$this->db->set('desc',$options['desc']);
	
		$this->db->where('codTipoPadrao',$options['codTipoPadrao']);
		$this->db->update('tipopadrao');
		return $this->db->affected_rows();
	}
	//get by id
	function get_by_id_tipopadrao($codTipoPadrao){
		$this->db->where('codTipoPadrao',$codTipoPadrao);
		$query=$this->db->get('tipopadrao');
		return $query->row(0);
	}

} 

?>