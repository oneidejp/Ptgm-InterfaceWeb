<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?= $this->lang->line('alert'); ?></title>	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<? echo base_url('includes/bootstrap/css/bootstrap.css') ?>">
	<link rel="stylesheet" href="<? echo base_url('includes/bootstrap/css/bootstrap-responsive.css') ?>">
	<link rel="stylesheet" href="<? echo base_url('includes/css/abas.css') ?>">
	<link rel="stylesheet" href="<? echo base_url('includes/css/estilo.css') ?>">
	<!-- Latest compiled and minified JavaScript -->
	<script src="<? echo base_url('includes/js/jquery-2.1.1.js') ?>"></script>		
</head>
<body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12" id="centro">
				<div class="row-fluid menu">
					<? include ("menu.php"); ?>
					<a href="<?= base_url('index.php/login/logout') ?>"> <img id="sair" src="<? echo base_url('includes/imagens/deslogar.png') ?>" /></a>
				</div>
				<div id="aba">
					<div class="row-fluid">
						<div class="span12">
							<h2 class="center"><?php foreach ($usoSalaDesc as $dados) {
								echo $dados->desc;
							} ?></h2>
							<form class="form-signin" role="form" method="post" action="<? echo base_url('index.php/alertas/create_alerta/'.$codUsoSala) ?>">
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th><?= $this->lang->line('record'); ?></th>
											<th><?= $this->lang->line('compare'); ?></th>
											<th><?= $this->lang->line('capture'); ?></th>
											<th><?= $this->lang->line('equipment'); ?></th>
											<th><?= $this->lang->line('plug'); ?></th>
											<th><?= $this->lang->line('date'); ?></th>
											<th><?= $this->lang->line('effective'); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php									
										foreach ($alerta as $dados) { 	?>
										<tr>
											<td><input type="checkbox" name="alerta[]" value="<?= $dados->codCaptura;?>" /></td>
											<td><a href="<? echo base_url('index.php/comparar/index/'.$codUsoSala.'/'.$dados->codEquip) ?>" target="_blank" class="btn btn-primary" role="button">Comparar</a></td>
											<td><h4><?= $dados->codCaptura; ?></h4></td>
											<td><h4><?= $dados->codEquip ." - ". $dados->desc; ?></h4></td>
											<td><h4><?= $dados->codTomada;?></h4></td>
											<td><h4><?= date('d/m/Y H:m:s',strtotime($dados->dataAtual)); ?></h4></td>	
											<td><h4><?= $dados->eficaz; ?></h4></td>
										</tr>
										<?php 	
									}
									?>
								</tbody>
							</table>

							<label for="comment"><?= $this->lang->line('comment_alert').":"; ?></label>
							<textarea class="form-control comentario" rows="8" name="comentario" maxlength="400" required></textarea>
							<br/>
							<button class="btn btn-lg btn-primary" type="submit"><?= $this->lang->line('record'); ?></button>									
							<button type="button" value="fechar" class="btn btn-primary" onclick="window.close()"><?= $this->lang->line('cancel'); ?></button>								
						</form>	
					</div>
				</div>
			</div>
			<div class="row-fluid"><? include ("footer.php"); ?></div>
		</div>
	</div>
</div>
</body>
</html>