<?php
/**
	* 2015
	* Desenvolvido por: Mateus Perego
	* Email: mateusperego@yahoo.com.br
	* Projeto de conclusão de curso
	* UPF - Ciência da Computação
	*/	

class usuario_model extends CI_Model{
	//pega todos os registros
	function get_all_usuario(){

		$query = $this->db->get('login');
		return $query->result();
	}
	//create 
	function add_usuario($options=array()){

		$this->db->insert('login', $options);
		return $this->db->affected_rows();
	}
	//delete 
	function delete_usuario(){
		$this->db->where('id',$this->uri->segment(3));
		$this->db->delete('login');
		return $this->db->affected_rows();
	}
	//update usuário
	function update_usuario($options=array()){
		if(isset($options['id']))
			$this->db->set('id',$options['id']);
		if(isset($options['nome']))
			$this->db->set('nome',$options['nome']);
		if(isset($options['email']))
			$this->db->set('email',$options['email']);
		if(isset($options['senha']))
			$this->db->set('senha',$options['senha']);
		if(isset($options['nivel']))
			$this->db->set('nivel',$options['nivel']);

		$this->db->where('id',$options['id']);
		$this->db->update('login');
		return $this->db->affected_rows();
	}
	//update password
	function update_senha($options=array()){
		$this->db->set('senha', $options['novasenha']);
		$this->db->where('id',$options['id']);
		$this->db->update('login');
		return $this->db->affected_rows();
	}

	//get by id
	function get_by_id_usuario($id){
		$this->db->where('id',$id);
		$query=$this->db->get('login');
		return $query->row(0);
	}
} 
?>