<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?= $this->lang->line('page_title_cadastre_equipment'); ?></title>
	<script src="includes/bootstrap/js/jquery.min"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<? echo base_url('includes/css/jquery-ui_calendar.css') ?>" /><!--estilo do calendário-->
	<link rel="stylesheet" href="<? echo base_url('includes/bootstrap/css/bootstrap.css') ?>">
	<link rel="stylesheet" href="<? echo base_url('includes/bootstrap/css/bootstrap-responsive.css') ?>">
	<link rel="stylesheet" href="<? echo base_url('includes/css/abas.css') ?>">
	<link rel="stylesheet" href="<? echo base_url('includes/css/estilo.css') ?>">
	<script src="<? echo base_url('includes/js/jquery-1.8.2_calendar.js') ?>"></script><!-- import jquery pra funcionar o calendário-->
	<script src="<? echo base_url('includes/js/jquery-ui_calendar.js') ?>"></script><!-- import jquery ui para funcionar o calendário -->
	<script src="<? echo base_url('includes/js/calendario.js') ?>"></script><!-- função do calendário -->
	<!-- Latest compiled and minified JavaScript -->
	<script src="<? echo base_url('includes/bootstrap/js/bootstrap.min.js') ?>"></script>	
</head>
<body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span1" id="esquerda"></div>
			<div class="span10" id="centro">
				<div class="row-fluid menu">
					<? include ("menu.php"); ?>
					<a href="<?= base_url('index.php/login/logout') ?>"><img id="sair" src="<? echo base_url('includes/imagens/deslogar.png') ?>" /></a>
				</div>
				<ul class="abas">
					<li id="consulta"><a href="<?= base_url('index.php/equipamento') ?>"><?= $this->lang->line('consult'); ?></a></li>
					<li id="cadastro" style="background-color: #A9A9A9;"><a href="<?= base_url('index.php/equipamento?link=cadastro') ?>" ><?= $this->lang->line('cadastre'); ?></a></li>
				</ul>
				<div id="aba">
					<div class="row-fluid">
						<div class="span4" id="formesquerda"></div>
						<div class="span5" id="formcentro">
							<?php 
							if ($equipamento=='cadastro') { ?>
							<form class="form-signin" role="form" method="post" action="<?= base_url('index.php/equipamento/create_equipamento') ?>">
								<fieldset>
									<legend><?= $this->lang->line('page_title_cadastre_equipment'); ?></legend>
									<h4 class="form-signin-heading"><?= $this->lang->line('code').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?= $this->lang->line('code'); ?>" readonly="readonly" autofocus name="codEquip">
									<h4 class="form-signin-heading"><?= $this->lang->line('description').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?= $this->lang->line('description'); ?>" required autofocus name="desc">
									<h4 class="form-signin-heading"><?= $this->lang->line('trademark').":"; ?></h4>
									<select name="codMarca">
										<?php
										foreach ($marca as $dados){ ?>	
										<option value="<?= $dados->codMarca; ?>"><?= $dados->desc; ?></option>
										<?php }; ?>
									</select>
									<a href="<?= base_url('index.php/marca?link=cadastro'); ?>" class="btn" target="_blank"><?= $this->lang->line('new_trademark'); ?></a>
									<h4 class="form-signin-heading"><?= $this->lang->line('template').":"; ?></h4>
									<select name="codModelo">
										<?php
										foreach ($modelo as $dados){ ?>	
										<option value="<?= $dados->codModelo; ?>"><?= $dados->desc; ?></option>
										<?php }; ?>
									</select>
									<a href="<?= base_url('index.php/modelo?link=cadastro'); ?>" class="btn" target="_blank"><?= $this->lang->line('new_template'); ?></a>
									<h4 class="form-signin-heading"><?= $this->lang->line('kind').":"; ?></h4>
									<select name="codTipo">
										<?php
										foreach ($tipo as $dados){ ?>	
										<option value="<?= $dados->codTipo; ?>"><?= $dados->desc; ?></option>
										<?php }; ?>
									</select>
									<a href="<?= base_url('index.php/tipo?link=cadastro'); ?>" class="btn" target="_blank"><?= $this->lang->line('new_kind'); ?></a>
									<h4 class="form-signin-heading"><?= $this->lang->line('rfid').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?= $this->lang->line('rfid'); ?>" required autofocus name="rfid">
									<h4 class="form-signin-heading"><?= $this->lang->line('cod_heritage').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?= $this->lang->line('cod_heritage'); ?>" required autofocus name="codPatrimonio"><br/>
									<h4 class="form-signin-heading"><?= $this->lang->line('date_last_failure').":"; ?></h4>
									<input type="text" class="data" placeholder="<?= $this->lang->line('date_last_failure'); ?>" required autofocus name="dataUltimaFalha"><br/>
									<h4 class="form-signin-heading"><?= $this->lang->line('date_last_maintenance').":"; ?></h4>
									<input type="text" class="data" placeholder="<?= $this->lang->line('date_last_maintenance'); ?>" required autofocus name="dataUltimaManutencao"><br/>
									<h4 class="form-signin-heading"><?= $this->lang->line('usage_time').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?= $this->lang->line('usage_time'); ?>" required autofocus name="tempoUso"><br/>
									<button class="btn btn-lg btn-primary" type="submit"><?= $this->lang->line('insert'); ?></button>
									<button class="btn btn-lg btn-primary" type="reset"><?= $this->lang->line('clean_up'); ?></button>
								</fieldset>
							</form>	
							<?php
							if($this->session->flashdata('msg'))?>
							<?= $this->session->flashdata('msg');
						}else{ ?>
						<form class="form-signin" role="form" method="post" action="<?= base_url('index.php/equipamento/editar_equipamento/'.$equipamento->codEquip) ?>">
							<fieldset>
									<legend><?= $this->lang->line('page_title_cadastre_equipment'); ?></legend>
									<h4 class="form-signin-heading"><?= $this->lang->line('code').":"; ?></h4>
									<input type="text" class="form-control" readonly="readonly" autofocus name="codEquip" value="<?= $equipamento->codEquip;?>">
									<h4 class="form-signin-heading"><?= $this->lang->line('description').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?= $this->lang->line('description'); ?>" required autofocus name="desc" value="<?= $equipamento->desc;?>">

									<h4 class="form-signin-heading" target="_blank"><?= $this->lang->line('trademark').":"; ?></h4>
									<select name="codMarca">
										<?php
										foreach ($marca as $dados){ ?>	
										<option value="<?= $dados->codMarca; ?>"<?php if($equipamento->codMarca==$dados->codMarca){echo ' selected';} ?>><?= $dados->desc; ?></option>
										<?php }; ?>
									</select>
									<a href="<?= base_url('index.php/marca?link=cadastro'); ?>" class="btn" target="_blank"><?= $this->lang->line('new_trademark'); ?></a>
									<h4 class="form-signin-heading"><?= $this->lang->line('template').":"; ?></h4>
									<select name="codModelo">
										<?php
										foreach ($modelo as $dados){ ?>	
										<option value="<?= $dados->codModelo; ?>"<?php if($equipamento->codModelo==$dados->codModelo){echo ' selected';} ?>><?= $dados->desc; ?></option>
										<?php }; ?>
									</select>
									<a href="<?= base_url('index.php/modelo?link=cadastro'); ?>" class="btn" target="_blank"><?= $this->lang->line('new_template'); ?></a>
									<h4 class="form-signin-heading"><?= $this->lang->line('kind').":"; ?></h4>
									<select name="codTipo">
										<?php
										foreach ($tipo as $dados){ ?>	
										<option value="<?= $dados->codTipo; ?>"<?php if($equipamento->codTipo==$dados->codTipo){echo ' selected';} ?>><?= $dados->desc; ?></option>
										<?php }; ?>
									</select>
									<a href="<?= base_url('index.php/tipo?link=cadastro'); ?>" class="btn" target="_blank"><?= $this->lang->line('new_kind'); ?></a>
									<h4 class="form-signin-heading"><?= $this->lang->line('rfid').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?= $this->lang->line('rfid'); ?>" required autofocus name="rfid" value="<?= $equipamento->rfid;?>">
									<h4 class="form-signin-heading"><?= $this->lang->line('cod_heritage').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?= $this->lang->line('cod_heritage'); ?>" required autofocus name="codPatrimonio" value="<?= $equipamento->codPatrimonio;?>"><br/>
									<h4 class="form-signin-heading"><?= $this->lang->line('date_last_failure').":"; ?></h4>
									<input type="text" class="data" placeholder="<?= $this->lang->line('date_last_failure'); ?>" required autofocus name="dataUltimaFalha" value="<?= $equipamento->dataUltimaFalha;?>"><br/>
									<h4 class="form-signin-heading"><?= $this->lang->line('date_last_maintenance').":"; ?></h4>
									<input type="text" class="data" placeholder="<?= $this->lang->line('date_last_maintenance'); ?>" required autofocus name="dataUltimaManutencao" value="<?= $equipamento->dataUltimaManutencao;?>"><br/>
									<h4 class="form-signin-heading"><?= $this->lang->line('usage_time').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?= $this->lang->line('usage_time'); ?>" required autofocus name="tempoUso" value="<?= $equipamento->tempoUso;?>"><br/>
									<button class="btn btn-lg btn-primary" type="submit"><?= $this->lang->line('alter'); ?></button>
									<button class="btn btn-lg btn-primary" type="submit" formaction="<?= base_url('index.php/equipamento'); ?>"><?= $this->lang->line('cancel'); ?></button>
								</fieldset>
						</form>	
						<?php
						if($this->session->flashdata('msg'))?>
						<?= $this->session->flashdata('msg');
					}
					?>
				</div>
				<div class="span3" id="formesquerda"></div>
			</div>
		</div>
		<div class="row-fluid"><? include ("footer.php"); ?></div>
	</div>
	<div class="span1" id="direita"></div>
</div>
</div>
</body>
</html>