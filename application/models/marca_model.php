<?php
/**
	* 2015
	* Desenvolvido por: Mateus Perego
	* Email: mateusperego@yahoo.com.br
	* Projeto de conclusão de curso
	* UPF - Ciência da Computação
	*/	

class marca_model extends CI_Model{
	//pega todos os registros
	function get_all_marca($limite, $offset){
		$this->db->limit($limite,$offset);

		$query = $this->db->get('marca');
		return $query->result();
	}

	function get_all_marca_cadastro(){
		$query = $this->db->get('marca');
		return $query->result();
	}
	//create 
	function add_marca($options=array()){

		$this->db->insert('marca', $options);
		return $this->db->affected_rows();
	}
	//delete 
	function delete_marca(){
		$this->db->where('codMarca',$this->uri->segment(3));
		$this->db->delete('marca');
		return $this->db->affected_rows();
	}
	//update 
	function update_marca($options=array()){
		if(isset($options['codMarca']))
			$this->db->set('codMarca',$options['codMarca']);
		if(isset($options['desc']))
			$this->db->set('desc',$options['desc']);
	
		$this->db->where('codMarca',$options['codMarca']);
		$this->db->update('marca');
		return $this->db->affected_rows();
	}
	//get by id
	function get_by_id_marca($codMarca){
		$this->db->where('codMarca',$codMarca);
		$query=$this->db->get('marca');
		return $query->row(0);
	}

} 

?>