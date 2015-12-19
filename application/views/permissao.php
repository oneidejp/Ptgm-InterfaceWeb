<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title></title>
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
        <div id="aba">
          <h1 class="text-center"><?= $this->lang->line('msg_permission_user'); ?></h1>
        </div>
        <div class="row-fluid"><? include ("footer.php"); ?></div>
      </div>
      <div class="span1" id="direita"></div>
    </div>
  </div>
</body>
</html>