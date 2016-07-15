<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $this->lang->line('login'); ?></title>
  <script src="<?= base_url() ?>includes/js/jquery-2.2.0.min.js"></script> <!-- Importar jQuery -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="<?= base_url('includes/bootstrap/css/bootstrap.css') ?>">
  <link rel="stylesheet" href="<?= base_url('includes/bootstrap/css/bootstrap-responsive.css') ?>">
  <link rel="stylesheet" href="<?= base_url('includes/css/login.css') ?>"><!--estilo do login -->
  <!-- Latest compiled and minified JavaScript -->
  <script src="<?= base_url('includes/bootstrap/js/bootstrap.min.js') ?>"></script>
</head>
<body>
  <div class="login">   
    <form class="form-signin" role="form" method="post" action="<?= base_url('index.php/login/logar') ?>">
      <h2 class="form-signin-heading"><?php echo $this->lang->line('login').':'; ?></h2>
      <input type="email" class="form-control" placeholder="<?php echo $this->lang->line('email_address'); ?>" required autofocus name="usuario"><br/>
      <input type="password" class="form-control" placeholder="<?php echo $this->lang->line('password'); ?>" required name="senha"><br/>
      <select name="lang" class="form-control">
		<option value="pt-BR">Portugu&ecirc;s Brasileiro</option>
		<option value="en-US">English</option>
      </select>
      <button class="btn btn-lg btn-primary" type="submit"><?php echo $this->lang->line('start_login'); ?></button>
      <? if (isset($erro)): ?>
      <div class="alert alert-danger" role="alert" style="margin-top: 10px;"><?= $erro; ?></div>
    <? endif; ?>
  </form></div>
	<? if (isset($this->infoDb)) { ?>
		<div class="infoBanco">
			<small>
			Banco atual: <?=$this->infoDb['default']['hostname'].'/'.$this->infoDb['default']['database']?>
			<br />
			<a href="<?= base_url('index.php/ConfigBanco') ?>">Clique aqui para acessar um banco de dados diferente do configurado</a>
			</small>
		</div>
	<? } ?>
</div>
</body>
</html>
