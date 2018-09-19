<?php
/**
	* 2015
	* Desenvolvido por: Mateus Perego
	* Email: mateusperego@yahoo.com.br
	* Projeto de conclusão de curso
	* UPF - Ciência da Computação
        *  
        * 2017
        * Alterado por: Leonardo F. Rauber
        * Email: leorauber@hotmail.com - 132789@upf.br
        * Projeto de conclusão de curso
        * UPF - Ciência da Computação
	*/	

class tomada_model extends CI_Model{
	//pega todos os registros
	function get_all_tomada($limite, $offset){
		$this->db->limit($limite,$offset);

		$this->db->select('tomada.codTomada, tomada.desc, tomada.indice, tomada.codModulo, tomada.limiteFase, tomada.limiteFuga, tomada.limiteStandByFase, tomada.limiteStandByFuga, salacirurgia.desc as sala');
		$this->db->from ('tomada,salacirurgia');
		$this->db->where('tomada.codSala = salacirurgia.codSala');
		$this->db->order_by('tomada.codTomada');
		$query = $this->db->get();
		return $query->result();
	}
	
	//create 
	function add_tomada($options=array()){

		$this->db->insert('tomada', $options);
		return $this->db->affected_rows();
	}
	//delete 
	function delete_tomada(){
		$this->db->where('codTomada',$this->uri->segment(3));
		$this->db->delete('tomada');
		return $this->db->affected_rows();
	}
	//update 
	function update_tomada($options=array()){
		if(isset($options['codTomada'])){
                    $this->db->set('codTomada',$options['codTomada']);
                }
		if(isset($options['codSala'])){
                    $this->db->set('codSala',$options['codSala']);
                }
		if(isset($options['indice'])){
                    $this->db->set('indice',$options['indice']);
                }
		if(isset($options['codModulo'])){
                    $this->db->set('codModulo',$options['codModulo']);
                }
                if(isset($options['limiteFase'])){
                    $this->db->set('limiteFase',$options['limiteFase']);
                }
                if(isset($options['limiteFuga'])){
                    $this->db->set('limiteFuga',$options['limiteFuga']);
                }
                if(isset($options['limiteStandByFase'])){
                    $this->db->set('limiteStandByFase',$options['limiteStandByFase']);
                }
                if(isset($options['limiteStandByFuga'])){
                    $this->db->set('limiteStandByFuga',$options['limiteStandByFuga']);
                }
		if(isset($options['desc'])){
                    $this->db->set('desc',$options['desc']);
                }

		$this->db->where('codTomada',$options['codTomada']);
		$this->db->update('tomada');
		return $this->db->affected_rows();
	}
	//get by id
	function get_by_id_tomada($codTomada){
		$this->db->where('codTomada',$codTomada);
		$query=$this->db->get('tomada');
		return $query->row(0);
	}

} 

?>