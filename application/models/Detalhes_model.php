<?php
//Model
//* 2017
//* Desenvolvido por: Leonardo Francisco Rauber
//* Email: leorauber@hotmail.com - 132789@upf.br
//* Projeto de conclusão de curso
//* UPF - Ciência da Computação	

class detalhes_model extends CI_Model{
	//pega todos os registros das salas em uso
	function get_all_detalhes($sala, $ultimaCap){
                $this->db->select("cap.codCaptura, cap.CodTomada, cap.CodEquip, cap.codEvento, equip.desc, cap.eficaz, equip.tempoUso, cap.dataAtual");
                $this->db->from ('capturaatual cap, usosalacaptura uso, equipamento equip');
                $this->db->where('cap.codCaptura = uso.codCaptura');
                $this->db->where('cap.codCaptura > ', $ultimaCap);
                $this->db->where('uso.codusosala = ', $sala);
                $this->db->where('equip.codEquip = cap.codEquip');
                $this->db->where('(cap.codEvento = 1 OR cap.codEvento = 4)');
                $this->db->order_by('codCaptura, dataAtual');
//                $this->db->limit(100);
                $query = $this->db->get();

                return $query->result();
	}
        
        function get_all_data_table($sala){               
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
		$this->db->order_by('cap.codCaptura desc');
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