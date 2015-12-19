<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= $this->lang->line('login'); ?></title>
  <script src="includes/bootstrap/js/jquery.min"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="<? echo base_url('includes/bootstrap/css/bootstrap.css') ?>">
  <link rel="stylesheet" href="<? echo base_url('includes/bootstrap/css/bootstrap-responsive.css') ?>">
  <link rel="stylesheet" href="<? echo base_url('includes/css/login.css') ?>"><!--estilo do login -->
  <!-- Latest compiled and minified JavaScript -->
  <script src="<? echo base_url('includes/bootstrap/js/bootstrap.min.js') ?>"></script>
</head>
<body>
  <div class="login">   
    <form class="form-signin" role="form" method="post" action="<?= base_url('index.php/login/logar') ?>">
      <h2 class="form-signin-heading"><?= $this->lang->line('login').':'; ?></h2>
      <input type="email" class="form-control" placeholder="<?= $this->lang->line('email_address'); ?>" required autofocus name="usuario"><br/>
      <input type="password" class="form-control" placeholder="<?= $this->lang->line('password'); ?>" required name="senha"><br/>
      <button class="btn btn-lg btn-primary" type="submit"><?= $this->lang->line('start_login'); ?></button>
      <? if (isset($erro)): ?>
      <div class="alert alert-danger" role="alert" style="margin-top: 10px;"><?= $erro; ?></div>
    <? endif; ?>
  </form></div>
</div>
</body>
</html>