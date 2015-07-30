<?php
/**
	* 2015
	* Desenvolvido por: Mateus Perego
	* Email: mateusperego@yahoo.com.br
	* Projeto de conclusão de curso
	* UPF - Ciência da Computação
	*/	

class responsavel_model extends CI_Model{
	//pega todos os registros
	function get_all_responsavel($limite, $offset){
		$this->db->limit($limite,$offset);

		$query = $this->db->get('responsavel');
		return $query->result();
	}
	//create 
	function add_responsavel($options=array()){

		$this->db->insert('responsavel', $options);
		return $this->db->affected_rows();
	}
	//delete 
	function delete_responsavel(){
		$this->db->where('codResp',$this->uri->segment(3));
		$this->db->delete('responsavel');
		return $this->db->affected_rows();
	}
	//update 
	function update_responsavel($options=array()){
		if(isset($options['codResp']))
			$this->db->set('codResp',$options['codResp']);
		if(isset($options['desc']))
			$this->db->set('desc',$options['desc']);
	
		$this->db->where('codResp',$options['codResp']);
		$this->db->update('responsavel');
		return $this->db->affected_rows();
	}
	//get by id
	function get_by_id_responsavel($codResp){
		$this->db->where('codResp',$codResp);
		$query=$this->db->get('responsavel');
		return $query->row(0);
	}

} 

?>