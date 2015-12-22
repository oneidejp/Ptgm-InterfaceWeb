<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= $this->lang->line('compare'); ?></title>
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
		
		var graficofase = [];
		var graficofuga = [];
		var captura = 0;
		var contfase = 0;
		var contfuga = 0;
		var old = 1;
		
		<?php //cria gráifcos fase/fuga fasepadrão/fugapadrão
		foreach ($fase as $dados) { ?>			
			captura = "<?= $dados->codCaptura; ?>";
			if(old==1){
				$.ajax({
					url: "<?= base_url(); ?>" + "index.php/comparar/graficos",
					dataType: 'json',
					scriptCharset: 'UTF-8',
					type: "POST",
					data: { 
						action: 'checkDados',
						Captura: captura
					},                  
					success: function( dados ) {
						if(dados){
							var chart = $('#fasebarra').highcharts();
							chart.addSeries({
								name: "<?= $dados->codCaptura; ?>",
								data: dados.barra
							});
							var chart = $('#faselinha').highcharts();
							chart.addSeries({
								data: dados.linha
							});
						}else
						alert("Erro Ajax.");
					}
				}); 
				graficofase[contfase] = captura;
				contfase = contfase+1;
				old=0;
			}
			<?php }; ?>
			old =1;
			<?php 
			foreach ($fuga as $dados) { ?>			
				captura = "<?= $dados->codCaptura; ?>";
				if(old==1){
					$.ajax({
						url: "<?= base_url(); ?>" + "index.php/comparar/graficos",
						dataType: 'json',
						scriptCharset: 'UTF-8',
						type: "POST",
						data: { 
							action: 'checkDados',
							Captura: captura
						},                  
						success: function( dados ) {
							if(dados){
								var chart = $('#fugabarra').highcharts();
								chart.addSeries({
									name: "<?= $dados->codCaptura; ?>",
									data: dados.barra
								});
								var chart = $('#fugalinha').highcharts();
								chart.addSeries({
									data: dados.linha
								});
							}else
							alert("Erro Ajax.");
						}
					}); 
					graficofuga[contfuga] = captura;
					contfuga = contfuga+1;
					old=0;
				}
				<?php }; ?>
				<?php 
				foreach ($fasepadrao as $dados) { ?>			
					captura = "<?= $dados->codondapadrao; ?>";
					$.ajax({
						url: "<?= base_url(); ?>" + "index.php/comparar/graficos",
						dataType: 'json',
						scriptCharset: 'UTF-8',
						type: "POST",
						data: { 
							action: 'checkDados',
							Captura: captura
						},                  
						success: function( dados ) {
							if(dados){
								var chart = $('#fugabarra').highcharts();
								chart.addSeries({
									name: "<?= $dados->codondapadrao; ?>",
									data: dados.barra
								});
								var chart = $('#fugalinha').highcharts();
								chart.addSeries({
									data: dados.linha
								});
							}else
							alert("Erro Ajax.");
						}
					}); 
					graficofase[contfase] = captura;
					contfase = contfase+1;
					<?php }; ?>
					<?php 
					foreach ($fugapadrao as $dados) { ?>			
						captura = "<?= $dados->codondapadrao; ?>";
						$.ajax({
							url: "<?= base_url(); ?>" + "index.php/comparar/graficos",
							dataType: 'json',
							scriptCharset: 'UTF-8',
							type: "POST",
							data: { 
								action: 'checkDados',
								Captura: captura
							},                  
							success: function( dados ) {
								if(dados){
									var chart = $('#fugabarra').highcharts();
									chart.addSeries({
										name: "<?= $dados->codondapadrao; ?>",
										data: dados.barra
									});
									var chart = $('#fugalinha').highcharts();
									chart.addSeries({
										data: dados.linha
									});
								}else
								alert("Erro Ajax.");
							}
						}); 
						graficofuga[contfuga] = captura;
						contfuga = contfuga+1;
						<?php }; ?>

	// quando um checkbox é clicado
	$('input[type="checkbox"]').click(function() { 
		var classe = $(this).attr('class'); //pega a classe do checkbox clicado
		var id = $(this).attr('id'); //pega o id do checkbox clicado
		var nome = $(this).attr('name'); //pega o nome do checkbox clicado
		var checkado = ($("."+classe).is(':checked')); //verifica se o checkbox foi clicado true == sim, false == não
			//if fase true cria gráfico, senão remove o gráfico
			if(nome == "fase"){
				if(checkado == true){
					$.ajax({
						url: "<?= base_url(); ?>" + "index.php/comparar/graficos",
						dataType: 'json',
						scriptCharset: 'UTF-8',
						type: "POST",
						data: { 
							action: 'checkDados',
							Captura: classe
						},                  
						success: function( dados ) {
							if(dados){
								var chart = $('#fasebarra').highcharts();
								chart.addSeries({
									name: classe,
									data: dados.barra
								});
								var chart = $('#faselinha').highcharts();
								chart.addSeries({
									data: dados.linha
								});
							}else
							alert("Erro Ajax.");
						}
					}); 
					graficofase[contfase] = classe;
					contfase = contfase+1;	
				}else{
					for(var x=0;x<graficofase.length;x++){
						if(graficofase[x]==classe){
							var chart = $('#fasebarra').highcharts();
							if (chart.series.length) {
								chart.series[x].remove();
							}
							var chart = $('#faselinha').highcharts();
							if (chart.series.length) {
								chart.series[x].remove();
							}
							graficofase.splice(x,1);
						}
					}
					contfase=--contfase;
				}
			}else{
				if(checkado == true){
					$.ajax({
						url: "<?= base_url(); ?>" + "index.php/comparar/graficos",
						dataType: 'json',
						scriptCharset: 'UTF-8',
						type: "POST",
						data: { 
							action: 'checkDados',
							Captura: classe
						},                  
						success: function( dados ) {
							if(dados){
								var chart = $('#fugabarra').highcharts();
								chart.addSeries({
									name: classe,
									data: dados.barra
								});
								var chart = $('#fugalinha').highcharts();
								chart.addSeries({
									data: dados.linha
								});
							}else
							alert("Erro Ajax.");
						}
					}); 
					graficofuga[contfuga] = classe;
					contfuga = contfuga+1;	
				}else{
					for(var x=0;x<graficofuga.length;x++){
						if(graficofuga[x]==classe){
							var chart = $('#fugabarra').highcharts();
							if (chart.series.length) {
								chart.series[x].remove();
							}
							var chart = $('#fugalinha').highcharts();
							if (chart.series.length) {
								chart.series[x].remove();
							}
							graficofuga.splice(x,1);
						}
					}
					contfuga=--contfuga;
					
				}
			}
		});
	});  
</script>
<script type="text/javascript">
	//quando clica na imagem de mais
	$( document ).ready(function() { 
		$("img").click(function(){

			var id = $(this).attr('id');
			var classe = $(this).attr('class');
			var nome = $(this).attr('name');
			var sala = "<?= $codUsoSala; ?>";

			if(id=="fase"){
				if(nome=="maisfase"){
					$(this).attr('src','<?= base_url("includes/imagens/menos.jpg") ?>');
					$(this).attr('name','menosfase');
				}else{
					$(this).attr('src','<?= base_url("includes/imagens/mais.jpg") ?>');
					$(this).attr('name','maisfase');
				}

				$.ajax({
					url: "<?= base_url(); ?>" + "index.php/comparar/atualiza_fase",
					dataType: 'json',
					scriptCharset: 'UTF-8',
					type: "POST",
					data: { 
						CodEquip: classe,
						Sala: sala
					},                  
					success: function( dados ) {
						if(dados){				
							for(var i=1;i<dados.captura.length;i++){
								$("#fase"+dados.captura[i].codCaptura+"").toggle("slow");        	
							}			
						}else
						alert("Erro Ajax.");
					}
				});

			}else{
				if(nome=="maisfuga"){
					$(this).attr('src','<?= base_url("includes/imagens/menos.jpg") ?>');
					$(this).attr('name','menosfuga');
				}else{
					$(this).attr('src','<?= base_url("includes/imagens/mais.jpg") ?>');
					$(this).attr('name','maisfuga');
				}

				$.ajax({
					url: "<?= base_url(); ?>" + "index.php/comparar/atualiza_fuga",
					dataType: 'json',
					scriptCharset: 'UTF-8',
					type: "POST",
					data: { 
						CodEquip: classe,
						Sala: sala
					},                  
					success: function( dados ) {
						if(dados){				
							for(var i=1;i<dados.captura.length;i++){
								$("#fuga"+dados.captura[i].codCaptura+"").toggle("slow");        	
							}			
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
							<?php foreach($equipamento as $equip){ ?>
							<h3 class="center"><?= $equip->equipamento; ?></h3>
							<br/>
							<table class="table table-striped table-bordered">
								<tr>
									<td><h4><?= $equip->codModelo." - "; echo $equip->modelo; ?></h4></td>
									<td><h4><?= $equip->codMarca." - "; echo $equip->marca; ?></h4></td>
									<td><h4><?= "Rfid: ".$equip->rfid; ?></h4></td>
									<td><h4><?= $tempodeuso;?></h4></td>
								</tr>
							</table>
							<?php      		
						}?>
					</div>	
				</div>
			</div>	
			<div class="row-fluid">
				<div class="span6">
					<h3 class="center"><?= $this->lang->line('phase'); ?></h3>
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th><?= $this->lang->line('compare'); ?></th>
								<th><?= $this->lang->line('capture'); ?></th>
								<th><?= $this->lang->line('valor_medio'); ?></th>
								<th><?= $this->lang->line('effective'); ?></th>
								<th><?= $this->lang->line('plug'); ?></th>
								<th><?= $this->lang->line('date'); ?></th>
							</tr>
						</thead>
						<tbody>									
							<tr>
								<?php if (empty($fase)) { 	
									?>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
								</tr>
								<?php 
							}else{ 
								$anterior = 0;
								foreach($fase as $dados){ 
									if($anterior == $dados->codTomada){	?>
									<tr id="fase<?= $dados->codCaptura;?>">
										<td id="<?= $dados->codCaptura;?>-1"><input type="checkbox" id="<?= $dados->codTomada;?>" class="<?= $dados->codCaptura;?>" name="fase"  /></td>
										<td id="<?= $dados->codCaptura;?>-2"><?= $dados->codCaptura; ?></td>
										<td id="<?= $dados->codCaptura;?>-3"><?= $dados->valorMedio; ?></td>
										<td id="<?= $dados->codCaptura;?>-4"><?= $dados->eficaz; ?></td>
										<td id="<?= $dados->codCaptura;?>-5"><?= $dados->codTomada; ?></td>
										<td id="<?= $dados->codCaptura;?>-6"><?= $dados->dataAtual; ?></td>
									</tr>
									<script type="text/javascript">
									$("#fase<?= $dados->codCaptura;?>").hide();
									$("#<?= $capanterior;?>-2").html("<img id='fase' class='<?= $dados->codTomada;?>' name='maisfase' src='<?= base_url('includes/imagens/mais.jpg') ?>'> <?= $capanterior; ?>");
									</script>
									<?php }else{ 
										?>
										<tr id="fase<?= $dados->codCaptura;?>">
											<td id="<?= $dados->codCaptura;?>-1"><input type="checkbox" checked="cheked" id="<?= $dados->codTomada;?>" class="<?= $dados->codCaptura;?>" name="fase"  /></td>
											<td id="<?= $dados->codCaptura;?>-2"><?= $dados->codCaptura; ?></td>
											<td id="<?= $dados->codCaptura;?>-3"><?= $dados->valorMedio; ?></td>
											<td id="<?= $dados->codCaptura;?>-4"><?= $dados->eficaz; ?></td>
											<td id="<?= $dados->codCaptura;?>-5"><?= $dados->codTomada; ?></td>
											<td id="<?= $dados->codCaptura;?>-6"><?= $dados->dataAtual; ?></td>
										</tr>
										<?php $anterior = $dados->codTomada;
										$capanterior = $dados->codCaptura;
									}
								}							
							}?>
						</tbody>
					</table>
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th><?= $this->lang->line('cod_onda_padrao'); ?></th>
								<th><?= $this->lang->line('valor_medio'); ?></th>
								<th><?= $this->lang->line('effective'); ?></th>
								<th><?= $this->lang->line('plug'); ?></th>
								<th><?= $this->lang->line('date'); ?></th>
								<th><?= $this->lang->line('standard'); ?></th>
							</tr>
						</thead>
						<tbody>									
							<tr>
								<?php if (empty($fasepadrao)) { 	
									?>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><input type="checkbox"/></td>
								</tr>
								<?php 
							}else{ 								
								foreach($fasepadrao as $dados){ ?>
								<tr>
									<td><?= $dados->codondapadrao; ?></td>
									<td><?= $dados->valorMedio; ?></td>
									<td><?= $dados->eficaz; ?></td>
									<td><?= $dados->codTomada; ?></td>
									<td><?= $dados->datapadrao; ?></td>
									<td><input type="checkbox" checked="cheked" id="<?= $dados->codTomada;?>" class="<?= $dados->codondapadrao;?>" name="fase" /></td>
								</tr>
								<?php }							
							}?>
						</tbody>
					</table>
					<div class="span12">
						<div id="faselinha"></div>
					</div>
					<div class="span12"> 
						<div id="fasebarra"></div>
					</div>
				</div>
				<div class="span6">
					<h3 class="center"><?= $this->lang->line('flight'); ?></h3>
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th><?= $this->lang->line('compare'); ?></th>
								<th><?= $this->lang->line('capture'); ?></th>
								<th><?= $this->lang->line('valor_medio'); ?></th>
								<th><?= $this->lang->line('effective'); ?></th>
								<th><?= $this->lang->line('plug'); ?></th>
								<th><?= $this->lang->line('date'); ?></th>
							</tr>
						</thead>
						<tbody>									
							<tr>
								<?php if (empty($fuga)) { 	
									?>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
								</tr>
								<?php 
							}else{ 
								$anterior = 0;
								foreach($fuga as $dados){ 
									if($anterior == $dados->codTomada){	?>
									<tr id="fuga<?= $dados->codCaptura;?>">
										<td id="<?= $dados->codCaptura;?>-1"><input type="checkbox" id="<?= $dados->codTomada;?>" class="<?= $dados->codCaptura;?>" name="fuga"  /></td>
										<td id="<?= $dados->codCaptura;?>-2"><?= $dados->codCaptura; ?></td>
										<td id="<?= $dados->codCaptura;?>-3"><?= $dados->valorMedio; ?></td>
										<td id="<?= $dados->codCaptura;?>-4"><?= $dados->eficaz; ?></td>
										<td id="<?= $dados->codCaptura;?>-5"><?= $dados->codTomada; ?></td>
										<td id="<?= $dados->codCaptura;?>-6"><?= $dados->dataAtual; ?></td>
									</tr>
									<script type="text/javascript">
									$("#fuga<?= $dados->codCaptura;?>").hide();
									$("#<?= $capanterior;?>-2").html("<img id='fuga' class='<?= $dados->codTomada;?>' name='maisfuga' src='<?= base_url('includes/imagens/mais.jpg') ?>'> <?= $capanterior; ?>");
									</script>
									<?php }else{ 
										?>
										<tr id="fuga<?= $dados->codCaptura;?>">
											<td id="<?= $dados->codCaptura;?>-1"><input type="checkbox" checked="cheked" id="<?= $dados->codTomada;?>" class="<?= $dados->codCaptura;?>" name="fuga"  /></td>
											<td id="<?= $dados->codCaptura;?>-2"><?= $dados->codCaptura; ?></td>
											<td id="<?= $dados->codCaptura;?>-3"><?= $dados->valorMedio; ?></td>
											<td id="<?= $dados->codCaptura;?>-4"><?= $dados->eficaz; ?></td>
											<td id="<?= $dados->codCaptura;?>-5"><?= $dados->codTomada; ?></td>
											<td id="<?= $dados->codCaptura;?>-6"><?= $dados->dataAtual; ?></td>
										</tr>
										<?php $anterior = $dados->codTomada;
										$capanterior = $dados->codCaptura;
									}
								}							
							}?>
						</tbody>
					</table>
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th><?= $this->lang->line('cod_onda_padrao'); ?></th>
								<th><?= $this->lang->line('valor_medio'); ?></th>
								<th><?= $this->lang->line('effective'); ?></th>
								<th><?= $this->lang->line('plug'); ?></th>
								<th><?= $this->lang->line('date'); ?></th>
								<th><?= $this->lang->line('standard'); ?></th>
							</tr>
						</thead>
						<tbody>									
							<tr>
								<?php if (empty($fugapadrao)) { 	
									?>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><?= $this->lang->line('empty'); ?></td>
									<td><input type="checkbox"/></td>
								</tr>
								<?php 
							}else{ 
								foreach($fugapadrao as $dados){ ?>
								<tr>
									<td><?= $dados->codondapadrao; ?></td>
									<td><?= $dados->valorMedio; ?></td>
									<td><?= $dados->eficaz; ?></td>
									<td><?= $dados->codTomada; ?></td>
									<td><?= $dados->datapadrao; ?></td>
									<td><input type="checkbox" checked="cheked" id="<?= $dados->codTomada;?>" class="<?= $dados->codondapadrao;?>" name="fuga"  /></td>
								</tr>
								<?php }							
							}?>
						</tbody>
					</table>
					<div class="span12">
						<div id="fugalinha"></div>
					</div>
					<div class="span12"> 
						<div id="fugabarra"></div>
					</div>

				</div>
			</div>
			<div class="row-fluid"><? include ("footer.php"); ?></div>
		</div>
	</div>
</div>
</body>
</html>