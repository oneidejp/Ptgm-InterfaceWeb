<?php
/**
	* 2015
	* Desenvolvido por: Mateus Perego
	* Email: mateusperego@yahoo.com.br
	* Projeto de conclusão de curso
	* UPF - Ciência da Computação
	*/	

class procedimento_model extends CI_Model{
	//pega todos os registros
	function get_all_procedimento($limite, $offset){
		$this->db->limit($limite,$offset);

		$query = $this->db->get('procedimento');
		return $query->result();
	}
	//create 
	function add_procedimento($options=array()){

		$this->db->insert('procedimento', $options);
		return $this->db->affected_rows();
	}
	//delete 
	function delete_procedimento(){
		$this->db->where('codProced',$this->uri->segment(3));
		$this->db->delete('procedimento');
		return $this->db->affected_rows();
	}
	//update 
	function update_procedimento($options=array()){
		if(isset($options['codProced']))
			$this->db->set('codProced',$options['codProced']);
		if(isset($options['desc']))
			$this->db->set('desc',$options['desc']);
	
		$this->db->where('codProced',$options['codProced']);
		$this->db->update('procedimento');
		return $this->db->affected_rows();
	}
	//get by id
	function get_by_id_procedimento($codProced){
		$this->db->where('codProced',$codProced);
		$query=$this->db->get('procedimento');
		return $query->row(0);
	}

} 

?>