<?php
/**
	* 2015
	* Desenvolvido por: Mateus Perego
	* Email: mateusperego@yahoo.com.br
	* Projeto de conclusão de curso
	* UPF - Ciência da Computação
	*/	

class eventos_model extends CI_Model{
	//pega todos os registros
	function get_all_eventos($limite, $offset){
		$this->db->limit($limite,$offset);

		$query = $this->db->get('eventos');
		return $query->result();
	}
	//create 
	function add_eventos($options=array()){

		$this->db->insert('eventos', $options);
		return $this->db->affected_rows();

	}
	//delete 
	function delete_eventos(){
		$this->db->where('codEvento',$this->uri->segment(3));
		$this->db->delete('eventos');
		return $this->db->affected_rows();
	}
	//update 
	function update_eventos($options=array()){
		if(isset($options['codEvento']))
			$this->db->set('codEvento',$options['codEvento']);
		if(isset($options['desc']))
			$this->db->set('desc',$options['desc']);
		if(isset($options['formaOnda']))
			$this->db->set('formaOnda',$options['formaOnda']);
	
		$this->db->where('codEvento',$options['codEvento']);
		$this->db->update('eventos');
		return $this->db->affected_rows();
	}
	//get by id
	function get_by_id_eventos($codEvento){
		$this->db->where('codEvento',$codEvento);
		$query=$this->db->get('eventos');
		return $query->row(0);
	}

} 

?>