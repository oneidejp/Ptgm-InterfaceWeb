<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?= $this->lang->line('page_title_cadastre_plug'); ?></title>
	<script src="includes/bootstrap/js/jquery.min"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<? echo base_url('includes/bootstrap/css/bootstrap.css') ?>">
	<link rel="stylesheet" href="<? echo base_url('includes/bootstrap/css/bootstrap-responsive.css') ?>">
	<link rel="stylesheet" href="<? echo base_url('includes/css/abas.css') ?>">
	<link rel="stylesheet" href="<? echo base_url('includes/css/estilo.css') ?>">
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
					<li id="consulta"><a href="<?= base_url('index.php/tomada') ?>"><?= $this->lang->line('consult'); ?></a></li>
					<li id="cadastro" style="background-color: #A9A9A9;"><a href="<?= base_url('index.php/tomada?link=cadastro') ?>" ><?= $this->lang->line('cadastre'); ?></a></li>
				</ul>
				<div id="aba">
					<div class="row-fluid">
						<div class="span4" id="formesquerda"></div>
						<div class="span4" id="formcentro">
							<?php 
							if ($tomada=='cadastro') { ?>
							<form class="form-signin" role="form" method="post" action="<?= base_url('index.php/tomada/create_tomada') ?>">
								<fieldset>
									<legend><?= $this->lang->line('page_title_cadastre_plug'); ?></legend>
									<h4 class="form-signin-heading"><?= $this->lang->line('code').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?= $this->lang->line('code'); ?>" readonly="readonly" autofocus name="codTomada">
									<h4 class="form-signin-heading"><?= $this->lang->line('description').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?= $this->lang->line('description'); ?>" required autofocus name="desc">
									<h4 class="form-signin-heading"><?= $this->lang->line('room').":"; ?></h4>
									<select name="codSala">
										<?php
										foreach ($sala as $dados){ ?>	
										<option value="<?= $dados->codSala; ?>"><?= $dados->desc; ?></option>
										<?php }; ?>
									</select>
									<a href="<?= base_url('index.php/sala?link=cadastro'); ?>" class="btn" target="_blank"><?= $this->lang->line('new_room'); ?></a>
									<h4 class="form-signin-heading"><?= $this->lang->line('table_of_contents').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?= $this->lang->line('table_of_contents'); ?>" required autofocus name="indice">
									<h4 class="form-signin-heading"><?= $this->lang->line('module').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?= $this->lang->line('module'); ?>" required autofocus name="modulo"><br/>
									<button class="btn btn-lg btn-primary" type="submit"><?= $this->lang->line('insert'); ?></button>
									<button class="btn btn-lg btn-primary" type="reset"><?= $this->lang->line('clean_up'); ?></button>
								</fieldset>
							</form>	
							<?php
							if($this->session->flashdata('msg'))?>
							<?= $this->session->flashdata('msg');
						}else{ ?>
						<form class="form-signin" role="form" method="post" action="<?= base_url('index.php/tomada/editar_tomada/'.$tomada->codTomada) ?>">
							<fieldset>
								<legend><?= $this->lang->line('form_alter_title_plug'); ?></legend>
								<h4 class="form-signin-heading"><?= $this->lang->line('code').":"; ?></h4>
								<input type="text" class="form-control" readonly="readonly" autofocus name="codTomada"  value="<?= $tomada->codTomada; ?>">
								<h4 class="form-signin-heading"><?= $this->lang->line('description').":"; ?></h4>
								<input type="text" class="form-control" placeholder="<?= $this->lang->line('description'); ?>" required autofocus name="desc" value="<?= $tomada->desc; ?>">
								<h4 class="form-signin-heading"><?= $this->lang->line('room').":"; ?></h4>
								<select name="codSala">
									<?php
									foreach ($sala as $dados){ ?>	
									<option value="<?= $dados->codSala; ?>" <?php if($tomada->codSala==$dados->codSala){echo ' selected';} ?> ><?= $dados->desc; ?></option>
									<?php }; ?>
								</select>
								<a href="<?= base_url('index.php/sala?link=cadastro'); ?>" class="btn" target="_blank"><?= $this->lang->line('new_room'); ?></a>
								<h4 class="form-signin-heading"><?= $this->lang->line('table_of_contents').":"; ?></h4>
								<input type="text" class="form-control" placeholder="Índice" required autofocus name="indice" value="<?= $tomada->indice; ?>">
								<h4 class="form-signin-heading"><?= $this->lang->line('module').":"; ?></h4>
								<input type="text" class="form-control" placeholder="Módulo" required autofocus name="modulo" value="<?= $tomada->modulo; ?>"><br/>
								<button class="btn btn-lg btn-primary" type="submit"><?= $this->lang->line('alter'); ?></button>
								<button class="btn btn-lg btn-primary" type="submit" formaction="<?= base_url('index.php/tomada'); ?>"><?= $this->lang->line('cancel'); ?></button>
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