<?php

/**
	* 2015
	* Desenvolvido por: Mateus Perego
	* Email: mateusperego@yahoo.com.br
	* Projeto de conclusão de curso
	* UPF - Ciência da Computação
	*/	

class detalhes_model extends CI_Model{
	//pega todos os registros das salas em uso
	function get_all_detalhes($sala){
		$this->db->select("cap.codCaptura, cap.CodTomada, cap.CodEquip, equip.desc, cap.eficaz, equip.tempoUso, cap.dataAtual");
		$this->db->from ('capturaatual cap, usosalacaptura uso, equipamento equip');
		$this->db->where('cap.codCaptura = uso.codCaptura');
		$this->db->where('uso.codusosala = ', $sala);
		$this->db->where('equip.codEquip = cap.codEquip');
		$this->db->order_by('codEquip, dataAtual');
		$query = $this->db->get();

		return $query->result();
	}

	//get by id
	function get_by_id_usosala($codUsoSala){
		$this->db->where('codUsoSala',$codUsoSala);
		$query=$this->db->get('usosala');
		return $query->row(0);
	}

	//get Código de captura
	function get_cod_captura($codCaptura){
		$this->db->select("valormedio, gain, offset");
		$this->db->from ('capturaatual');
		$this->db->where('codCaptura = ', $codCaptura);
		$query = $this->db->get();

		return $query->result();
	}

	//get harmonica
	function get_harmonica($codCaptura){
		$this->db->select("*");
		$this->db->from ('harmatual');
		$this->db->where('codCaptura = ', $codCaptura);
		$query = $this->db->get();

		return $query->result();
	}

	//get harmonica padrão
	function get_harmonica_padrao($codCaptura){
		$this->db->select("*");
		$this->db->from ('harmpadrao');
		$this->db->where('codCaptura = ', $codCaptura);
		$query = $this->db->get();

		return $query->result();
	}

	function get_equip($sala,$CodEquip){
		$this->db->select("cap.codCaptura");
		$this->db->from ('capturaatual cap, usosalacaptura uso, equipamento equip');
		$this->db->where('cap.codCaptura = uso.codCaptura');
		$this->db->where('uso.codusosala = ', $sala);
		$this->db->where('equip.codEquip = cap.codEquip');
		$this->db->where('equip.codEquip = ', $CodEquip);
		$this->db->order_by('dataAtual');
		$query = $this->db->get();

		return $query->result();
	}
        
        //função para pegar os códigos de captura para calcular a periculosidade por similaridade
        //realizar uma consulta da dataAtual com os registros da mesma tabela, procurando uma registro no mesmo segundo
        //função ainda não implementada
        function get_periculosidade_similaridade($sala, $ultimo = null){
            $this->db->select("cap.codCaptura");
            $query = $this->db->get();

            return $query->result();
        }
        
        //busca o código de captura do último alerta
        function get_ultimo_alerta (){
            $this->db->select("codCaptura");
            $this->db->from("alerta");
            $this->db->order_by("codCaptura", "desc");
            $this->db->limit(1);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0){
                return $query->row();
            }else{
                return null;
            }
            //para pegar o valor: $variavel->codCaptura
        }
}