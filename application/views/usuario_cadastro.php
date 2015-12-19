<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?= $this->lang->line('page_title_cadastre_user'); ?></title>
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
					<li id="consulta"><a href="<?= base_url('index.php/usuario') ?>"><?= $this->lang->line('consult'); ?></a></li>
					<li id="cadastro" style="background-color: #A9A9A9;"><a href="<?= base_url('index.php/usuario?link=cadastro') ?>" ><?= $this->lang->line('cadastre'); ?></a></li>
				</ul>
				<div id="aba">
					<div class="row-fluid">
						<div class="span4" id="formesquerda"></div>
						<div class="span4" id="formcentro">
							<?php if ($this->session->userdata('nivel')=='1') {
								if ($usuario=='cadastro') { ?>
								<form class="form-signin" role="form" method="post" action="<?= base_url('index.php/usuario/create_usuario') ?>">
									<fieldset>
										<legend><?= $this->lang->line('page_title_cadastre_user'); ?></legend>
										<h4 class="form-signin-heading"><?= $this->lang->line('code').":"; ?></h4>
										<input type="text" class="form-control" placeholder="<?= $this->lang->line('code'); ?>" readonly="readonly" autofocus name="id">
										<h4 class="form-signin-heading"><?= $this->lang->line('name').":"; ?></h4>
										<input type="text" class="form-control" placeholder="<?= $this->lang->line('name'); ?>" required autofocus name="nome">
										<h4 class="form-signin-heading"><?= $this->lang->line('email').":"; ?></h4>
										<input type="email" class="form-control" placeholder="<?= $this->lang->line('email'); ?>" autofocus name="email">
										<h4 class="form-signin-heading"><?= $this->lang->line('password').":"; ?></h4>
										<input type="password" class="form-control" placeholder="<?= $this->lang->line('password'); ?>" required autofocus name="senha">
										<h4 class="form-signin-heading"><?= $this->lang->line('level').":"; ?></h4>
										<select name="nivel">
											<option value="1"><?= $this->lang->line('administrador'); ?></option>
											<option value="2"><?= $this->lang->line('supervisor'); ?></option>
											<option value="3"><?= $this->lang->line('operator'); ?></option>
											<option value="4"><?= $this->lang->line('viewer'); ?></option>
										</select>
										<br/>
										<button class="btn btn-lg btn-primary" type="submit"><?= $this->lang->line('insert'); ?></button>
										<button class="btn btn-lg btn-primary" type="reset"><?= $this->lang->line('clean_up'); ?></button>
									</fieldset>
								</form>	
								<?php
								if($this->session->flashdata('msg'))?>
								<?= $this->session->flashdata('msg');
							}else{ ?>
							<form class="form-signin" role="form" method="post" action="<?= base_url('index.php/usuario/editar_usuario/'.$usuario->id) ?>">
								<fieldset>
									<legend><?= $this->lang->line('form_alter_title_user'); ?></legend>
									<h4 class="form-signin-heading"><?= $this->lang->line('code').":"; ?></h4>
									<input type="text" class="form-control" readonly="readonly" autofocus name="id" value="<?= $usuario->id; ?>">
									<h4 class="form-signin-heading"><?= $this->lang->line('name').":"; ?></h4>
									<input type="text" class="form-control" placeholder="<?= $this->lang->line('name'); ?>" required autofocus name="nome" value="<?= $usuario->nome; ?>">
									<h4 class="form-signin-heading"><?= $this->lang->line('email').":"; ?></h4>
									<input type="email" class="form-control" placeholder="<?= $this->lang->line('email'); ?>" autofocus name="email" value="<?= $usuario->email; ?>">
									<h4 class="form-signin-heading"><?= $this->lang->line('password').":"; ?></h4>
									<input type="password" class="form-control" placeholder="<?= $this->lang->line('password'); ?>" required autofocus name="senha" value="<?= $usuario->senha; ?>">
									<h4 class="form-signin-heading"><?= $this->lang->line('level').":"; ?></h4>
									<select name="nivel">
										<option value="1" <?php if($usuario->nivel=='1'){echo ' selected';} ?>><?= $this->lang->line('administrador'); ?></option>
										<option value="2" <?php if($usuario->nivel=='2'){echo ' selected';} ?>><?= $this->lang->line('supervisor'); ?></option>
										<option value="3" <?php if($usuario->nivel=='3'){echo ' selected';} ?>><?= $this->lang->line('operator'); ?></option>
										<option value="4" <?php if($usuario->nivel=='4'){echo ' selected';} ?>><?= $this->lang->line('viewer'); ?></option>
									</select>
									<br/>
									<button class="btn btn-lg btn-primary" type="submit"><?= $this->lang->line('alter'); ?></button>
									<button class="btn btn-lg btn-primary" type="submit" formaction="<?= base_url('index.php/usuario'); ?>"><?= $this->lang->line('cancel'); ?></button>
								</fieldset>
							</form>	
							<?php
							if($this->session->flashdata('msg'))?>
							<?= $this->session->flashdata('msg');
						}
						?>	
						<?php 	} else { ?>
							<form class="form-signin" role="form" method="post" action="<?= base_url('index.php/usuario/editar_senha/'.$this->session->userdata('id')) ?>">
								<fieldset>
									<legend><?= $this->lang->line('form_alter_title_password'); ?></legend>
									<h4 class="form-signin-heading"><?= $this->lang->line('current_password').":"; ?></h4>
									<input type="password" class="form-control" placeholder="<?= $this->lang->line('current_password'); ?>" required autofocus name="senhaatual">
									<h4 class="form-signin-heading"><?= $this->lang->line('new_password').":"; ?></h4>
									<input type="password" class="form-control" placeholder="<?= $this->lang->line('new_password'); ?>" required autofocus name="novasenha">
									<h4 class="form-signin-heading"><?= $this->lang->line('confirm_new_password').":"; ?></h4>
									<input type="password" class="form-control" placeholder="<?= $this->lang->line('confirm_new_password'); ?>" required autofocus name="confirmnovasenha">
									<br/>
									<button class="btn btn-lg btn-primary" type="submit"><?= $this->lang->line('alter'); ?></button>
									<button class="btn btn-lg btn-primary" type="submit" formaction="<?= base_url('index.php/usuario'); ?>"><?= $this->lang->line('cancel'); ?></button>
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