<?php

/**
	* 2015
	* Desenvolvido por: Mateus Perego
	* Email: mateusperego@yahoo.com.br
	* Projeto de conclusão de curso
	* UPF - Ciência da Computação
	*/	

class comparar_model extends CI_Model{
	//get equipamentos para a página de comparação
	function get_all_equipamento($equipamento){
		$this->db->select("equip.desc as equipamento, equip.rfid, equip.tempoUso, equip.codModelo, modelo.desc as modelo, equip.codMarca,marca.desc as marca");
		$this->db->from ('equipamento equip, marca, modelo');
		$this->db->where('equip.codEquip ', $equipamento);
		$this->db->where('equip.codModelo = modelo.codModelo');
		$this->db->where('equip.codMarca = marca.codMarca');
		$query = $this->db->get();

		return $query->result();
	}

 	//get fase
	function get_all_fase($codUsoSala, $equipamento){
		$this->db->select("cap.codCaptura, cap.valorMedio, cap.eficaz, cap.codTomada, cap.dataAtual");
		$this->db->from ('capturaatual cap, usosalacaptura uso');
		$this->db->where('codTipoonda = 1');
		$this->db->where('uso.codusosala =', $codUsoSala);
		$this->db->where('uso.codcaptura = cap.codcaptura');
		$this->db->where('cap.codequip  = ', $equipamento);
		$this->db->order_by('dataAtual');
		$query = $this->db->get();

		return $query->result();
	}

	//get capturas fase
	function get_capturas_fase($codUsoSala, $equipamento){
		$this->db->select("cap.codCaptura");
		$this->db->from ('capturaatual cap, usosalacaptura uso');
		$this->db->where('codTipoonda = 1');
		$this->db->where('uso.codusosala =', $codUsoSala);
		$this->db->where('uso.codcaptura = cap.codcaptura');
		$this->db->where('cap.codequip  = ', $equipamento);
		$this->db->order_by('dataAtual');
		$query = $this->db->get();

		return $query->result();
	}

	// get capturas fuga
	function get_capturas_fuga($codUsoSala, $equipamento){
		$this->db->select("cap.codCaptura");
		$this->db->from ('capturaatual cap, usosalacaptura uso');
		$this->db->where('codTipoonda = 2');
		$this->db->where('uso.codusosala =', $codUsoSala);
		$this->db->where('uso.codcaptura = cap.codcaptura');
		$this->db->where('cap.codequip  = ', $equipamento);
		$this->db->order_by('dataAtual');
		$query = $this->db->get();

		return $query->result();
	}

 	//get fuga
	function get_all_fuga($codUsoSala, $equipamento){
		$this->db->select("cap.codCaptura, cap.valorMedio, cap.eficaz, cap.codTomada, cap.dataAtual");
		$this->db->from ('capturaatual cap, usosalacaptura uso');
		$this->db->where('codTipoonda = 2');
		$this->db->where('uso.codusosala =', $codUsoSala);
		$this->db->where('uso.codcaptura = cap.codcaptura');
		$this->db->where('cap.codequip  = ', $equipamento);
		$this->db->order_by('dataAtual');
		$query = $this->db->get();

		return $query->result();
	}

	//get fase padrao
	function get_all_fase_padrao($equipamento){
		$this->db->select("cap.codondapadrao, cap.valorMedio, cap.eficaz, cap.codTomada, cap.datapadrao");
		$this->db->from ('ondapadrao cap');
		$this->db->where('codTipoonda = 1');
		$this->db->where('cap.codequip  = ', $equipamento);
		$this->db->order_by('datapadrao');
		$query = $this->db->get();

		return $query->result();
	}

	//get fuga padrao
	function get_all_fuga_padrao($equipamento){
		$this->db->select("cap.codondapadrao, cap.valorMedio, cap.eficaz, cap.codTomada, cap.datapadrao");
		$this->db->from ('ondapadrao cap');
		$this->db->where('codTipoonda = 2');
		$this->db->where('cap.codequip  = ', $equipamento);
		$this->db->order_by('datapadrao');
		$query = $this->db->get();

		return $query->result();
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
} 

?>