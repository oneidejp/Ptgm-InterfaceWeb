<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php if (isset($title)) echo $this->lang->line($title); else echo "Protegemed"?></title>
        
        <!-- Arquivos JavaScript -->
        <script src="<?= base_url() ?>includes/js/jquery-2.2.0.min.js"></script> <!-- Importar jQuery -->
        <script src="<?= base_url() ?>includes/bootstrap-3.3.6/js/bootstrap.min.js"></script> <!-- Importar bootstrap.js -->
        
        <!-- Arquivos CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>includes/bootstrap-3.3.6/css/bootstrap.css">
        <link rel="stylesheet" href="<?= base_url() ?>includes/css/abas.css">
        <link rel="stylesheet" href="<?= base_url() ?>includes/css/estilo.css">
        <link rel="stylesheet" href="<?= base_url() ?>includes/css/menu.css"> <!--estilo do menu -->
        
        
        
    </head>
    <body>
        <?php include_once 'menu.php'; ?>