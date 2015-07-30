<?php
/**
	* 2015
	* Desenvolvido por: Mateus Perego
	* Email: mateusperego@yahoo.com.br
	* Projeto de conclusão de curso
	* UPF - Ciência da Computação
	*/	

class tipoonda_model extends CI_Model{
	//pega todos os registros
	function get_all_tipoonda($limite, $offset){
		$this->db->limit($limite,$offset);		

		$query = $this->db->get('tipoonda');
		return $query->result();
	}
	//create 
	function add_tipoonda($options=array()){

		$this->db->insert('tipoonda', $options);
		return $this->db->affected_rows();
	}
	//delete 
	function delete_tipoonda(){
		$this->db->where('codTipoOnda',$this->uri->segment(3));
		$this->db->delete('tipoonda');
		return $this->db->affected_rows();
	}
	//update 
	function update_tipoonda($options=array()){
		if(isset($options['codTipoOnda']))
			$this->db->set('codTipoOnda',$options['codTipoOnda']);
		if(isset($options['desc']))
			$this->db->set('desc',$options['desc']);
	
		$this->db->where('codTipoOnda',$options['codTipoOnda']);
		$this->db->update('tipoonda');
		return $this->db->affected_rows();
	}
	//get by id
	function get_by_id_tipoonda($codTipoOnda){
		$this->db->where('codTipoOnda',$codTipoOnda);
		$query=$this->db->get('tipoonda');
		return $query->row(0);
	}

} 

?>