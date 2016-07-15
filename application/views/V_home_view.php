<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= $this->lang->line('page_title_v_home'); ?></title>
  <script src="<?= base_url() ?>includes/js/jquery-2.2.0.min.js"></script> <!-- Importar jQuery -->
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
          <?php include ("menu.php"); ?>
          <a href="<?= base_url('index.php/login/logout') ?>"> <img id="sair" src="<? echo base_url('includes/imagens/deslogar.png') ?>" /></a>
        </div>
        <div id="aba">
          <h1 class="text-center"><?php echo $this->lang->line('page_title_v_home')." "; echo $this->session->userdata('nome')." "; ?><?php echo $this->lang->line('logged'); ?></h1>
        </div>
        <div class="row-fluid"><? include ("footer.php"); ?></div>
      </div>
      <div class="span1" id="direita"></div>
    </div>
  </div>
</body>
</html>