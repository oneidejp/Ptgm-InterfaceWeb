<?php
/**
	* 2015
	* Desenvolvido por: Mateus Perego
	* Email: mateusperego@yahoo.com.br
	* Projeto de conclusão de curso
	* UPF - Ciência da Computação
	*/	

class sala_model extends CI_Model{
	//pega todos os registros
	function get_all_sala($limite, $offset){
		$this->db->limit($limite,$offset);

		$query = $this->db->get('salacirurgia');
		return $query->result();
	}
	function get_all_sala_cadastro(){

		$query = $this->db->get('salacirurgia');
		return $query->result();
	}
	//create 
	function add_sala($options=array()){

		$this->db->insert('salacirurgia', $options);
		return $this->db->affected_rows();
	}
	//delete 
	function delete_sala(){
		$this->db->where('codSala',$this->uri->segment(3));
		$this->db->delete('salacirurgia');
		return $this->db->affected_rows();
	}
	//update 
	function update_sala($options=array()){
		if(isset($options['codSala']))
			$this->db->set('codSala',$options['codSala']);
		if(isset($options['desc']))
			$this->db->set('desc',$options['desc']);
	
		$this->db->where('codSala',$options['codSala']);
		$this->db->update('salacirurgia');
		return $this->db->affected_rows();
	}
	//get by id
	function get_by_id_sala($codSala){
		$this->db->where('codSala',$codSala);
		$query=$this->db->get('salacirurgia');
		return $query->row(0);
	}

} 

?>