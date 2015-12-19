<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?= $this->lang->line('page_title_cadastre_events'); ?></title>
	<script src="includes/bootstrap/js/jquery.min"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?= base_url('includes/bootstrap/css/bootstrap.css') ?>">
	<link rel="stylesheet" href="<?= base_url('includes/bootstrap/css/bootstrap-responsive.css') ?>">
	<link rel="stylesheet" href="<?= base_url('includes/css/abas.css') ?>">
	<link rel="stylesheet" href="<?= base_url('includes/css/estilo.css') ?>">
	<!-- Latest compiled and minified JavaScript -->
	<script src="<?= base_url('includes/bootstrap/js/bootstrap.min.js') ?>"></script>	
</head>
<body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span1" id="esquerda"></div>
			<div class="span10" id="centro">
				<div class="row-fluid menu">
					<? include ("menu.php"); ?>
					<a href="<?= base_url('index.php/login/logout') ?>"><img id="sair" src="<?= base_url('includes/imagens/deslogar.png') ?>" /></a>
				</div>
				<ul class="abas">
					<li id="consulta"><a href="<?= base_url('index.php/eventos') ?>"><?= $this->lang->line('consult'); ?></a></li>
					<li id="cadastro" style="background-color: #A9A9A9;"><a href="<?= base_url('index.php/eventos?link=cadastro') ?>" ><?= $this->lang->line('cadastre'); ?></a></li>
				</ul>
				<div id="aba">
					<div class="row-fluid">
						<div class="span4" id="formesquerda"></div>
						<div class="span4" id="formcentro">
						<?php 
						if ($eventos=='cadastro') { ?>
							<form class="form-signin" role="form" method="post" action="<?= base_url('index.php/eventos/create_eventos') ?>">
								<fieldset>
									<legend><?= $this->lang->line('page_title_cadastre_events'); ?></legend>
									<h4 class="form-signin-heading"><?= $this->lang->line('code').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?= $this->lang->line('code'); ?>" readonly="readonly" autofocus name="codEvento">
									<h4 class="form-signin-heading"><?= $this->lang->line('description').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?= $this->lang->line('description'); ?>" required autofocus name="desc">
									<h4 class="form-signin-heading"><?= $this->lang->line('form_wave').":"; ?></h4>
									<label class="radio">
										<input type="radio" name="formaOnda" id="optionsRadios1" value="1" required>
										<h4><?= $this->lang->line('yes'); ?></h4>
									</label>
									<label class="radio">
										<input type="radio" name="formaOnda" id="optionsRadios2" value="0" required>
										<h4><?= $this->lang->line('no'); ?></h4>
									</label>
									<button class="btn btn-lg btn-primary" type="submit"><?= $this->lang->line('insert'); ?></button>
									<button class="btn btn-lg btn-primary" type="reset"><?= $this->lang->line('clean_up'); ?></button>
								</fieldset>
							</form>	
							<?php
							if($this->session->flashdata('msg'))?>
							<?= $this->session->flashdata('msg');
						}else{ ?>
							<form class="form-signin" role="form" method="post" action="<?= base_url('index.php/eventos/editar_eventos/'.$eventos->codEvento) ?>">
								<fieldset>
									<legend><?= $this->lang->line('form_alter_title_events'); ?></legend>
									<h4 class="form-signin-heading"><?= $this->lang->line('code').":"; ?></h4>
									<input type="text" class="form-control" readonly="readonly" autofocus name="codEvento"  value="<?= $eventos->codEvento; ?>">
									<h4 class="form-signin-heading"><?= $this->lang->line('description').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?= $this->lang->line('description'); ?>" required autofocus name="desc" value="<?= $eventos->desc; ?>">
									<h4 class="form-signin-heading"><?= $this->lang->line('form_wave').":"; ?></h4>
									<label class="radio">
										<input type="radio" name="formaOnda" id="optionsRadios1" <?php if($eventos->formaOnda == "1"){ echo(' checked '); } ?> value="1" >
										<h4><?= $this->lang->line('yes'); ?></h4>
									</label>
									<label class="radio">
										<input type="radio" name="formaOnda" id="optionsRadios2" <?php if($eventos->formaOnda == "0"){ echo(' checked '); } ?> value="0">
										<h4><?= $this->lang->line('no'); ?></h4>
									</label>
									<button class="btn btn-lg btn-primary" type="submit"><?= $this->lang->line('alter'); ?></button>
									<button class="btn btn-lg btn-primary" type="submit" formaction="<?= base_url('index.php/eventos'); ?>"><?= $this->lang->line('cancel'); ?></button>
								</fieldset>
							</form>	
							<?php
							if($this->session->flashdata('msg'))?>
							<?= $this->session->flashdata('msg');
						}
						?>
						</div>
						<div class="span4" id="formesquerda"></div>
					</div>
				</div>
				<div class="row-fluid"><? include ("footer.php"); ?></div>
			</div>
			<div class="span1" id="direita"></div>
		</div>
	</div>
</body>
</html>