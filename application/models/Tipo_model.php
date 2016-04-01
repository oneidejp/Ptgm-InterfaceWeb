<?php
/**
	* 2015
	* Desenvolvido por: Mateus Perego
	* Email: mateusperego@yahoo.com.br
	* Projeto de conclusão de curso
	* UPF - Ciência da Computação
	*/	

class tipo_model extends CI_Model{
	//pega todos os registros
	function get_all_tipo($limite, $offset){
		$this->db->limit($limite,$offset);

		$query = $this->db->get('tipo');
		return $query->result();
	}
	function get_all_tipo_cadastro(){

		$query = $this->db->get('tipo');
		return $query->result();
	}
	//create 
	function add_tipo($options=array()){

		$this->db->insert('tipo', $options);
		return $this->db->affected_rows();
	}
	//delete 
	function delete_tipo(){
		$this->db->where('codTipo',$this->uri->segment(3));
		$this->db->delete('tipo');
		return $this->db->affected_rows();
	}
	//update 
	function update_tipo($options=array()){
		if(isset($options['codTipo']))
			$this->db->set('codTipo',$options['codTipo']);
		if(isset($options['desc']))
			$this->db->set('desc',$options['desc']);
	
		$this->db->where('codTipo',$options['codTipo']);
		$this->db->update('tipo');
		return $this->db->affected_rows();
	}
	//get by id
	function get_by_id_tipo($codTipo){
		$this->db->where('codTipo',$codTipo);
		$query=$this->db->get('tipo');
		return $query->row(0);
	}

} 

?>