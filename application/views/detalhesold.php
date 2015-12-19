<?php 
/**
 * Converte segunos em horas, minutos e segundos
 * 
 * @param integer $seconds Number of seconds to parse
 * @return array
 */
function secondsToTime($time){
	$days = floor($time / (60 * 60 * 24));
	$time -= $days * (60 * 60 * 24);

	$hours = floor($time / (60 * 60));
	$time -= $hours * (60 * 60);

	$minutes = floor($time / 60);
	$time -= $minutes * 60;

	$seconds = floor($time);
	$time -= $seconds;

	return array($days, $hours, $minutes, $seconds);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?= $this->lang->line('details'); ?></title>
	<script src="includes/bootstrap/js/jquery.min"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?= base_url('includes/bootstrap/css/bootstrap.css') ?>">
	<link rel="stylesheet" href="<?= base_url('includes/bootstrap/css/bootstrap-responsive.css') ?>">
	<link rel="stylesheet" href="<?= base_url('includes/css/abas.css') ?>">
	<link rel="stylesheet" href="<?= base_url('includes/css/estilo.css') ?>">
	<!-- Latest compiled and minified JavaScript -->
	<script src="<?= base_url('includes/bootstrap/js/bootstrap.min.js') ?>"></script> <!-- import bootstrap js -->
	<script src="<?= base_url('includes/js/jquery-2.1.1.js') ?>"></script> <!-- import jQuery -->
	<script src="<?= base_url('includes/js/highcharts.js') ?>"></script><!-- import Highcharts -->
	<script src="<?= base_url('includes/js/exporting.js') ?>"></script><!-- import Export Highcharts -->
	<script type="text/javascript" src="<?= base_url('includes/js/graficosdetalhes.js') ?>"></script><!-- import gráficos linha e barra -->
	<script type="text/javascript">
	$(document).ready(function() {
		var cont = 0;
		var graficos = [];
		$('input[type="checkbox"]').click(function() {

		var classe = $(this).attr('class'); //pega a classe do checkbox clicado
		var id = $(this).attr('id'); //pega o id do checkbox clicado
		var checkado = ($("#"+id).is(':checked')); //verifica se o checkbox foi clicado true == sim, false == não

		//alert(classe);
		//alert(id);
		//alert(checkado);

		if(classe == "equipamentos"){ // classe == equipamentos coluna visualizar

			alert("equipamentos");

			if(checkado == true){ // se checkado == true mostra a div do equipamento
				var name = $(this).attr('name'); //pega o name do checkbox clicado
				$.ajax({
					url: 'graficos.php',					  
					dataType: 'json',
					scriptCharset: 'UTF-8',
					type: "POST",
					data: { 
						action: 'checkDados',
						idCheckbox: name
					},                  
					success: function( dados ) {
						if(dados){
							var chart = $('#equipamentos'+id).highcharts();
							chart.addSeries({
								name: 'Equipamento '+id,
								data: dados.linha
							});
						}else
						alert("Erro Ajax.");
					}
				});
				$("#equipamento"+id).show();
			}else{ // senão oculta a div do equipamento
				$("#equipamento"+id).hide();
				for(x=1;x<5;x++){
					var chart = $('#equipamentos'+id).highcharts();
					if (chart.series.length) {
						chart.series[x].remove();
					}
				}
			}
		}else{	
			if(checkado == true){ // se checkado == true monta gráfico na área de comparação
			//ajax envia os dados p/ php e no php processa e retornar valores em dados.linha e dados.barra
			if(cont<5){
				graficos[cont] = id;
				$.ajax({
					url: "<?= base_url(); ?>" + "index.php/detalhes/graficos",
					dataType: 'json',
					scriptCharset: 'UTF-8',
					type: "POST",
					data: { 
						action: 'checkDados',
						idCheckbox: id
					},                  
					success: function( dados ) {
						if(dados){
							var chart = $('#barra').highcharts();
							chart.addSeries({
								name: 'Equip '+classe,
								data: dados.barra
							});
							var chart = $('#linha').highcharts();
							chart.addSeries({
								name: 'Equip '+classe,
								data: dados.linha
							});
							cont=++cont;
						}else
						alert("Erro Ajax.");
					}
				}); 
			}else{
				alert("Máximo de 5 Equipamentos Atingido");
			}                       	
			}else{ // senão oculta gráfico do equipamento
				cont=--cont;	
				for(var x=0;x<graficos.length;x++){
					if(graficos[x]==id){
						var chart = $('#barra').highcharts();
						if (chart.series.length) {
							chart.series[x].remove();
						}
						var chart = $('#linha').highcharts();
						if (chart.series.length) {
							chart.series[x].remove();
						}
						graficos.splice(x,1);
					}
				}	
			}
		}
	});			
});
</script>

</head>
<body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12" id="centro">
				<div class="row-fluid menu">
					<? include ("menu.php"); ?>
					<a href="<?= base_url('index.php/login/logout') ?>"> <img id="sair" src="<?= base_url('includes/imagens/deslogar.png') ?>" /></a>
				</div>
				<div id="aba">
					<div class="row-fluid">
						<div class="span12" style="height:320px;">
							<div class="span5">
								<table id="myTable" class="table table-striped table-bordered" style="font-size:8pt;">
									
									<thead>
										<tr>
											<th>Mostra</th>
											<th>Captura</th>
											<th>Tomada</th>
											<th>Equipamento</th>
											<th>Eficaz</th>
											<th>Uso</th>
											<th>Data</th>
											<th>Comparar</th>
										</tr>
									</thead>
									<tbody>									
										<tr>
											<?php if (empty($detalhes)) { 	
												?>
												<td><input type="checkbox" checked="checked"/></td>
												<td>Vazio</td>
												<td>Vazio</td>
												<td>Vazio</td>
												<td>Vazio</td>
												<td>Vazio</td>
												<td>Vazio</td>
												<td><input type="checkbox"/></td>
											</tr>
											<?php 
										}else{ 
											foreach($detalhes as $dados){ ?>
											<tr>
												<td><input type="checkbox" checked="cheked" class="equipamentos" name="<?= $dados->codCaptura;?>" id="<?= $dados->CodEquip;?>" /></td>
												<td><?= $dados->codCaptura; ?></td>
												<td><?= $dados->CodTomada; ?></td>
												<td><?= $dados->CodEquip." - ".$dados->desc; ?></td>
												<td><?= $dados->eficaz; ?></td>
												<td><?php list($days, $hours, $minutes, $seconds) = secondsToTime($dados->TempoUso);echo "{$days}d {$hours}h {$minutes}m {$seconds}s"; ?></td>
												<td><?= date('d/m/Y H:m:s', strtotime($dados->dataAtual)); ?></td>
												<td><input type="checkbox" name="comp" class="<?= $dados->CodEquip;?>" id="<?= $dados->codCaptura;?>" /></td>
											</tr>
											<?php	};
										}?>
									</tbody>
								</table>
							</div>
							<div class="span7">
								<div id="linha" style="width:365px; height:300px;border:1px solid #ccc; float:left;"></div>
								<div id="barra" style="width:365px; height:300px;border:1px solid #ccc; float:left;"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid"><? include ("footer.php"); ?></div>
			</div>
		</div>
	</div>
</body>
</html>