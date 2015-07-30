<?php
/**
	* 2015
	* Desenvolvido por: Mateus Perego
	* Email: mateusperego@yahoo.com.br
	* Projeto de conclusão de curso
	* UPF - Ciência da Computação
	*/	

class login_model extends CI_Model{
	
	function get_all_login(){

		$query = $this->db->get('login');
		return $query->result();
	}	


	function get_by_id_login($id){
		$this->db->where('id',$id);
		$query=$this->db->get('login');
		return $query->row(0);
	}

	function get_login($email, $senha){
		$this->db->where('email',$email);
		$this->db->where('senha',$senha);
		$query=$this->db->get('login');
		return $query->row(0);
	}

} 

?>