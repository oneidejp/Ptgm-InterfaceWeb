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

class equipamento_model extends CI_Model{
	//pega todos os registros
	function get_all_equipamento($limite, $offset){
		$this->db->limit($limite,$offset);
		
		$this->db->select('equip.codEquip, marca.desc as marca, modelo.desc as modelo, equip.codPatrimonio, tipo.desc as tipo, equip.dataUltimaFalha, equip.dataUltimaManutencao, equip.desc, equip.rfid, equip.tempoUso, equip.codTomada, equip.limiteFase, equip.limiteFuga, equip.limiteStandByFase, equip.limiteStandByFuga');
		$this->db->from ('equipamento equip,marca, modelo, tipo');
		$this->db->where('equip.codMarca = marca.codMarca');
		$this->db->where('equip.codModelo = modelo.codModelo');
		$this->db->where('equip.codtipo = tipo.codTipo');
		$this->db->order_by('equip.codEquip');
		$query = $this->db->get();
		return $query->result();
	}

	//create 
	function add_equipamento($options=array()){

		$this->db->insert('equipamento', $options);
		return $this->db->affected_rows();
	}
	//delete 
	function delete_equipamento(){
		$this->db->where('codEquip',$this->uri->segment(3));
		$this->db->delete('equipamento');
		return $this->db->affected_rows();
	}
	//update 
	function update_equipamento($options=array()){
		if(isset($options['codEquip'])){
                    $this->db->set('codEquip',$options['codEquip']);
                }
		if(isset($options['codMarca'])){
                    $this->db->set('codMarca',$options['codMarca']);
                }
		if(isset($options['codModelo'])){
                    $this->db->set('codModelo',$options['codModelo']);
                }
		if(isset($options['codTipo'])){
                    $this->db->set('codTipo',$options['codTipo']);
                }
		if(isset($options['rfid'])){
                    $this->db->set('rfid',$options['rfid']);
                }
		if(isset($options['codPatrimonio'])){
                    $this->db->set('codPatrimonio',$options['codPatrimonio']);
                }
		if(isset($options['desc'])){
                    $this->db->set('desc',$options['desc']);
                }
		if(isset($options['dataUltimaFalha'])){
                    $this->db->set('dataUltimaFalha',$options['dataUltimaFalha']);
                }
		if(isset($options['dataUltimaManutencao'])){
                    $this->db->set('dataUltimaManutencao',$options['dataUltimaManutencao']);
                }
                if(isset($options['tempoUso'])){
                    $this->db->set('tempoUso',$options['tempoUso']);
                }
                if(isset($options['codTomada'])){
                    $this->db->set('codTomada',$options['codTomada']);
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
		$this->db->where('codEquip',$options['codEquip']);
		$this->db->update('equipamento');
		return $this->db->affected_rows();
	}
	//get by id
	function get_by_id_equipamento($codEquip){
		$this->db->where('codEquip',$codEquip);
		$query=$this->db->get('equipamento');
		return $query->row(0);
	}

} 

?>