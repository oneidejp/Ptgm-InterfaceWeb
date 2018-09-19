<?php
/**
	* 2015
	* Desenvolvido por: Mateus Perego
	* Email: mateusperego@yahoo.com.br
	* Projeto de conclusão de curso
	* UPF - Ciência da Computação
	*/	

class modelo_model extends CI_Model{
	//pega todos os registros
	function get_all_modelo($limite, $offset){
		$this->db->limit($limite,$offset);

		$query = $this->db->get('modelo');
		return $query->result();
	}
	function get_all_modelo_cadastro(){

		$query = $this->db->get('modelo');
		return $query->result();
	}
	//create 
	function add_modelo($options=array()){

		$this->db->insert('modelo', $options);
		return $this->db->affected_rows();
	}
	//delete 
	function delete_modelo(){
		$this->db->where('codModelo',$this->uri->segment(3));
		$this->db->delete('modelo');
		return $this->db->affected_rows();
	}
	//update 
	function update_modelo($options=array()){
		if(isset($options['codModelo']))
			$this->db->set('codModelo',$options['codModelo']);
		if(isset($options['desc']))
			$this->db->set('desc',$options['desc']);
	
		$this->db->where('codModelo',$options['codModelo']);
		$this->db->update('modelo');
		return $this->db->affected_rows();
	}
	//get by id
	function get_by_id_modelo($codModelo){
		$this->db->where('codModelo',$codModelo);
		$query=$this->db->get('modelo');
		return $query->row(0);
	}

} 

?>