<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php if (isset($title)){ echo $title;} else{ echo "Protegemed";}?></title>
        
        <!-- Arquivos JavaScript -->
        <script src="<?php echo base_url() ?>includes/js/jquery.min.js"></script> <!-- Importar jQuery -->
        <script src="<?php echo base_url() ?>includes/bootstrap/js/bootstrap.min.js"></script> <!-- Importar bootstrap.js -->
        
        <!-- Arquivos CSS -->
        <link rel="stylesheet" href="<?php echo base_url() ?>includes/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>includes/css/estilosMauricio.css">
        <?php if(isset($headerOption)){ echo $headerOption; }?>
    </head>
    <body style="padding-bottom: 100px; padding-top: 70px;">
        <?php include_once('menu.php'); ?>