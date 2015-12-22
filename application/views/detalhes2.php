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
<html>
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
			if(checkado == true){ // se checkado == true mostra a div do equipamento
				$("#equipamento"+id).show();
			}else{ // senão oculta a div do equipamento
				$("#equipamento"+id).hide();
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
								name: id,
								data: dados.barra
							});
							var chart = $('#linha').highcharts();
							chart.addSeries({
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


<script type="text/javascript">
$(document).ready(function(){	
	<?php $cont=0;$old=-1;
	foreach ($detalhes as $dados) { 
		if($old != $dados->CodEquip){
			?>
			$("#graficoslinha").append("<div id='equipamentos<?= $dados->CodEquip; ?>' style='width:32.5%; height:280px;float:left; margin:5px auto auto 5px;'></div>")

			$(function () {
				$('#equipamentos'+<?= $dados->CodEquip; ?>).highcharts({
					chart: {
						type: 'spline',
						spacingBottom: -5,
						spacingLeft: -5,					
					},
					title: {
						text: ''
					},
					credits: {
						enabled: false
					},
					xAxis: {
						title:{
							text: 'Tempo/100 (ms)'
						},
						labels: {
							rotation: -45,
							style: {
								fontSize: '8px',
								fontFamily: 'Verdana, sans-serif'
							}
						},
						tickPositions: [0,104,201, 305, 403,501,605,703,800,904,1002,1100,1204,1302,1406,1503,1601]
					},
					yAxis: {
						title: {
							text: 'Corrente (mA)'
						}
					}
				});
			});

			$.ajax({
				url: "<?= base_url(); ?>" + "index.php/detalhes/linha",
				dataType: 'json',
				scriptCharset: 'UTF-8',
				type: "POST",
				data: { 
					Captura: <?= $dados->codCaptura; ?>
				},                  
				success: function( dados ) {
					if(dados){						
						var chart = $('#equipamentos'+<?= $dados->CodEquip; ?>).highcharts();
						chart.addSeries({
							name: "<?= $dados->codCaptura ?>",
							data: dados.linha
						});
						
					}else
					alert("Erro Ajax.");
				}
			}); 

			<?php $cont=$cont+1;
			$old = $dados->CodEquip;
		}
	}; ?>
});
</script>

<script type="text/javascript">

    $( document ).ready(function() {
    	$("select").change(function(i) {

    		var captura =  $("select option:selected").text();
    		var sala ="<?= $codUsoSala;?>";

    		var checkado = ($("."+sala).is(':checked')); //verifica se o checkbox foi clicado true == sim, false == não

    		alert(checkado);
    		alert(sala);

    		if (checkado == true) {
    			alert("Desmarcar o checkbox da coluna Comparar");
    		}else{
    			$.ajax({
				url: "<?= base_url(); ?>" + "index.php/detalhes/atualiza_captura",
				dataType: 'json',
				scriptCharset: 'UTF-8',
				type: "POST",
				data: { 
					Captura: captura,
					Sala: sala
				},                  
				success: function( dados ) {
					if(dados){				
						var chart = $('#equipamentos'+sala).highcharts();
						if (chart.series.length) {
							chart.series[0].remove();
						}		

						$.ajax({
							url: "<?= base_url(); ?>" + "index.php/detalhes/linha",					  
							dataType: 'json',
							scriptCharset: 'UTF-8',
							type: "POST",
							data: { 
								Captura: captura
							},                       
							success: function( dados ) {
								if(dados){
									var chart = $('#equipamentos'+sala).highcharts();
									chart.addSeries({
										name: captura,
										data: dados.linha,
										color: '#7cb5ec'
									});
								}else
								alert("Erro Ajax.");
							}
						});
						 $("#"+captura+"-3").html(dados.tomada);
						 $("#"+captura+"-4").html("<a href='<?= base_url('index.php/comparar/index/'.$codUsoSala.'/'.$dados->CodEquip) ?>' target='_blank'>"+dados.equipamento+" - "+dados.descricao+"</a>");
						 $("#"+captura+"-5").html(dados.eficaz);
						 $("#"+captura+"-6").html(dados.tempouso);
						 $("#"+captura+"-7").html(dados.data);
						 $("#"+captura+"-8 input").attr('id', captura);
					}else
					alert("Erro Ajax.");
				}
			}); 
    			
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
						<div class="span12">
							<div class="span5" style="overflow:auto;">
								<table class="table table-striped table-bordered" style="font-size:8pt;">
									<thead>
										<tr>
											<th><?= $this->lang->line('show'); ?></th>
											<th><?= $this->lang->line('capture'); ?></th>
											<th><?= $this->lang->line('plug'); ?></th>
											<th><?= $this->lang->line('equipment'); ?></th>
											<th><?= $this->lang->line('effective'); ?></th>
											<th><?= $this->lang->line('use'); ?></th>
											<th><?= $this->lang->line('date'); ?></th>
											<th><?= $this->lang->line('compare'); ?></th>
										</tr>
									</thead>
									<tbody>									
										<tr>
											<?php if (empty($detalhes)) { 	
												?>
												<td><input type="checkbox" checked="checked"/></td>
												<td><?= $this->lang->line('empty'); ?></td>
												<td><?= $this->lang->line('empty'); ?></td>
												<td><?= $this->lang->line('empty'); ?></td>
												<td><?= $this->lang->line('empty'); ?></td>
												<td><?= $this->lang->line('empty'); ?></td>
												<td><?= $this->lang->line('empty'); ?></td>
												<td><input type="checkbox"/></td>
											</tr>
											<?php 
										}else{ 
											$anterior = 0;
											$option = 0;
											foreach($detalhes as $dados){
												if($anterior == $dados->CodEquip){
													$option = $option+1;
													?>
													<script type="text/javascript">
													var capanterior = "<?= $capanterior; ?>";
													<?php if($option == 1){
														 ?>
														var valorDaDiv = $("#"+capanterior+"-2").text();    
														$("#"+capanterior+"-2").html('<select id="select'+capanterior+'" style="width:auto;"><option>'+valorDaDiv+'</option></select>'); 
													<?php }  ?>
													$("#select"+capanterior+"").append('<option><?= $dados->codCaptura;?></option>');
													</script>
													<?php
												}else{
													$option = 0;
													?>
												<tr>
													<td id="<?= $dados->codCaptura;?>-1"><input type="checkbox" checked="cheked" class="equipamentos" name="<?= $dados->codCaptura;?>" id="s<?= $dados->CodEquip;?>" /></td>
													<td id="<?= $dados->codCaptura;?>-2"><?= $dados->codCaptura; ?></td>
													<td id="<?= $dados->codCaptura;?>-3"><?= $dados->CodTomada; ?></td>
													<td id="<?= $dados->codCaptura;?>-4"><a href="<?= base_url('index.php/comparar/index/'.$codUsoSala.'/'.$dados->CodEquip) ?>" target="_blank"><?= $dados->CodEquip." - ".$dados->desc; ?></a></td>
													<td id="<?= $dados->codCaptura;?>-5"><?= substr($dados->eficaz,0,6); ?></td>
													<td id="<?= $dados->codCaptura;?>-6"><?php list($days, $hours, $minutes, $seconds) = secondsToTime($dados->TempoUso);echo "{$days}D {$hours}H {$minutes}m {$seconds}s"; ?></td>
													<td id="<?= $dados->codCaptura;?>-7"><?= date('d/m/Y H:m:s', strtotime($dados->dataAtual)); ?></td>
													<td id="<?= $dados->codCaptura;?>-8"><input type="checkbox" name="comp" class="<?= $dados->CodEquip;?>" id="<?= $dados->codCaptura;?>" /></td>
												</tr>
												<?php $anterior = $dados->CodEquip;
													  $capanterior = $dados->codCaptura;
											}	
										};
									}?>
								</tbody>
							</table>
						</div>
						<div class="span7">
							<div id="linha" style="width:48.5%; height:300px;border:1px solid #ccc; float:left;"></div>
							<div id="barra" style="width:48.5%; height:300px;border:1px solid #ccc; float:left;"></div>
						</div>
					</div>	
				</div>
			</div>	
			<div class="row-fluid">
				<div class="span12" id="graficoslinha" style="min-height:310px;border:1px solid #000; padding-bottom: 5px;"></div>
			</div>
			<div class="row-fluid"><? include ("footer.php"); ?></div>
		</div>
	</div>
</div>
</body>
</html>