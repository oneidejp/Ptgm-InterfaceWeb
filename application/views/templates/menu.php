<?php
if (isset($menuHide) && $menuHide == "true") {

} else {
?>
<nav class="navbar navbar-default" style="border-top: 4px solid #000090;">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url('index.php') ?>"><?php echo $this->lang->line('web_interface'); ?></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line('control'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('index.php/paineldecontrole') ?>"><?php echo $this->lang->line('control_panel'); ?></a></li>
                        <li><a href="<?php echo base_url('index.php/ultimascapturadas') ?>"><?php echo $this->lang->line('last_captured'); ?></a></li>
                        <li><a href="<?php echo base_url('index.php/focapturadas') ?>"><?php echo $this->lang->line('fo_captured'); ?></a></li>
                        <li><a href="<?php echo base_url('index.php/usodesalas') ?>"><?php echo $this->lang->line('use_room'); ?></a></li>
                        <li><a href="<?php echo base_url('index.php/padrao') ?>"><?php echo $this->lang->line('standard'); ?></a></li>
                        <li><a href="<?php echo base_url('index.php/configBanco') ?>"><?php echo $this->lang->line('config_database'); ?></a></li>
                        <li><a href="<?php echo base_url('index.php/escalas') ?>"><?php echo "Escalas"; ?></a></li>
                        <li><a href="<?php echo base_url('index.php/Comunicacao') ?>"><?php echo "Comunicação" ?></a></li>
                        <li><a href="<?php echo base_url('index.php/Captura') ?>"><?php echo $this->lang->line('capture'); ?></a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('insert_menu'); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('equipments'); ?></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('index.php/equipamento') ?>"><?php echo $this->lang->line('equipment'); ?></a></li>
                                <li><a href="<?php echo base_url('index.php/tipo') ?>"><?php echo $this->lang->line('kind'); ?></a></li>
                                <li><a href="<?php echo base_url('index.php/marca') ?>"><?php echo $this->lang->line('trademark'); ?></a></li>
                                <li><a href="<?php echo base_url('index.php/modelo') ?>"><?php echo $this->lang->line('template'); ?></a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('rooms'); ?></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('index.php/sala') ?>"><?php echo $this->lang->line('room'); ?></a></li>
                                <li><a href="<?php echo base_url('index.php/tomada') ?>"><?php echo $this->lang->line('plug'); ?></a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('procedures'); ?></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('index.php/procedimento') ?>"><?php echo $this->lang->line('procedure'); ?></a></li>
                                <li><a href="<?php echo base_url('index.php/responsavel') ?>"><?php echo $this->lang->line('responsible'); ?></a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('events'); ?></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('index.php/eventos') ?>"><?php echo $this->lang->line('kinds_of_events'); ?></a></li>
                                <li><a href="<?php echo base_url('index.php/tipoonda') ?>"><?php echo $this->lang->line('kinds_of_wave'); ?></a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url('index.php/tipopadrao') ?>"><?php echo $this->lang->line('kinds of standards'); ?></a></li>
                    </ul>
                </li>
                <li><a id="ajuda" href="<?php echo base_url('index.php/usuario') ?>"><?php echo $this->lang->line('user'); ?></a></li>
                <li><a id="ajuda" href="<?php echo base_url('index.php/ajuda') ?>"><?php echo $this->lang->line('help'); ?></a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url() ?>index.php/ConfigBanco"><span class="glyphicon glyphicon-cog"></span> <?php echo $this->lang->line('options'); ?></a></li>
                <li><a href="<?php echo base_url() ?>index.php/login/logout"><span class="glyphicon glyphicon-log-out"></span> <?php echo $this->lang->line('exit'); ?></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<?php
}
