<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->lang->line('page_title_cadastre_kind_of_standards'); ?></title>
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
					<a href="<?= base_url('index.php/login/logout') ?>"> <img id="sair" src="<? echo base_url('includes/imagens/deslogar.png') ?>" /></a>
				</div>
				<ul class="abas">
					<li id="consulta"><a href="<?php echo base_url('index.php/tipopadrao') ?>" ><?php echo $this->lang->line('consult'); ?></a></li>
					<li id="cadastro" style="background-color: #A9A9A9;"><a href="<?php echo base_url('index.php/tipopadrao?link=cadastro') ?>" ><?php echo $this->lang->line('cadastre'); ?></a></li>
				</ul>
				<div id="aba">
					<div class="row-fluid">
						<div class="span4" id="formesquerda"></div>
						<div class="span4" id="formcentro">
						<?php 
						if ($tipopadrao=='cadastro') { ?>
							<form class="form-signin" role="form" method="post" action="<?= base_url('index.php/tipopadrao/create_tipopadrao') ?>">
								<fieldset>
									<legend><?php echo $this->lang->line('page_title_cadastre_kind_of_standards'); ?></legend>
									<h4 class="form-signin-heading"><?php echo $this->lang->line('code').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?php echo $this->lang->line('code'); ?>" readonly="readonly" autofocus name="codTipoPadrao">
									<h4 class="form-signin-heading"><?php echo $this->lang->line('description').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?php echo $this->lang->line('description'); ?>" required autofocus name="desc"><br/>
									<button class="btn btn-lg btn-primary" type="submit"><?php echo $this->lang->line('insert'); ?></button>
									<button class="btn btn-lg btn-primary" type="reset"><?php echo $this->lang->line('clean_up'); ?></button>
								</fieldset>
							</form>	
							<?php
							if($this->session->flashdata('msg'))?>
							<?php echo $this->session->flashdata('msg');
						}else{ ?>
							<form class="form-signin" role="form" method="post" action="<?= base_url('index.php/tipopadrao/editar_tipopadrao/'.$tipopadrao->codTipoPadrao) ?>">
								<fieldset>
									<legend><?php echo $this->lang->line('form_alter_title_kind_of_standards'); ?></legend>
									<h4 class="form-signin-heading"><?php echo $this->lang->line('code').":"; ?></h4>
									<input type="text" class="form-control" readonly="readonly" autofocus name="codTipoPadrao"  value="<?php echo $tipopadrao->codTipoPadrao; ?>">
									<h4 class="form-signin-heading"><?php echo $this->lang->line('description').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?php echo $this->lang->line('description'); ?>" required autofocus name="desc" value="<?php echo $tipopadrao->desc; ?>"><br/>
									<button class="btn btn-lg btn-primary" type="submit"><?php echo $this->lang->line('alter'); ?></button>
									<button class="btn btn-lg btn-primary" type="submit" formaction="<?php echo base_url('index.php/tipopadrao'); ?>"><?php echo $this->lang->line('cancel'); ?></button>
								</fieldset>
							</form>	
							<?php
							if($this->session->flashdata('msg'))?>
							<?php echo $this->session->flashdata('msg');
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