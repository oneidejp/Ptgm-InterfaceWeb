<div class="container" style="margin-bottom: 100px">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="border-top: 5px solid #000090;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menuNavbarCollapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= base_url('index.php') ?>"><?= "Protegemed"; ?></a>
        </div>
        <div class="collapse navbar-collapse" id="menuNavbarCollapse">
            <ul class="nav navbar-nav">
                <li><a href="<?= base_url('index.php/escalas') ?>"><?= "Escalas"; ?></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= base_url() ?>index.php/login/logout"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</div>

<!-- <div class="container-fluid">
    <div class="col-md-12 col-xs-12" style="margin-bottom: 30px;">
        <div class="row-fluid menu">
            <ul class="dropdown">
                <li><a href="#"><?= $this->lang->line('control'); ?></a>
                    <ul class="submenu">
                        <li><a href="<?= base_url('index.php/paineldecontrole') ?>"><?= $this->lang->line('control_panel'); ?></a></li>
                        <li><a href="<?= base_url('index.php/ultimascapturadas') ?>"><?= $this->lang->line('last_captured'); ?></a></li>
                        <li><a href="<?= base_url('index.php/focapturadas') ?>"><?= $this->lang->line('fo_captured'); ?></a></li>
                        <li><a href="<?= base_url('index.php/usodesalas') ?>"><?= $this->lang->line('use_room'); ?></a></li>
                        <li><a href="<?= base_url('index.php/padrao') ?>"><?= $this->lang->line('standard'); ?></a></li>
                        <li><a href="<?= base_url('index.php/configBanco') ?>"><?= $this->lang->line('config_database'); ?></a></li>
                        <li><a href="<?= base_url('index.php/escalas') ?>"><?= "Escalas"; ?></a></li>
                    </ul>
                </li>
                <li> <a href="#"><?= $this->lang->line('insert_menu'); ?></a>
                    <ul class="submenu">
                        <li><a href="#"><?= $this->lang->line('equipments'); ?></a>
                            <ul>
                                <li><a href="<?= base_url('index.php/equipamento') ?>"><?= $this->lang->line('equipment'); ?></a></li>
                                <li><a href="<?= base_url('index.php/tipo') ?>"><?= $this->lang->line('kind'); ?></a></li>
                                <li><a href="<?= base_url('index.php/marca') ?>"><?= $this->lang->line('trademark'); ?></a></li>
                                <li><a href="<?= base_url('index.php/modelo') ?>"><?= $this->lang->line('template'); ?></a></li>
                            </ul>
                        </li>
                        <li><a href="#"><?= $this->lang->line('rooms'); ?></a>
                            <ul>
                                <li><a href="<?= base_url('index.php/sala') ?>"><?= $this->lang->line('room'); ?></a></li>
                                <li><a href="<?= base_url('index.php/tomada') ?>"><?= $this->lang->line('plug'); ?></a></li>
                            </ul>
                        </li>
                        <li><a href="#"><?= $this->lang->line('procedures'); ?></a>
                            <ul>
                                <li><a href="<?= base_url('index.php/procedimento') ?>"><?= $this->lang->line('procedure'); ?></a></li>
                                <li><a href="<?= base_url('index.php/responsavel') ?>"><?= $this->lang->line('responsible'); ?></a></li>
                            </ul>
                        </li>
                        <li><a href="#"><?= $this->lang->line('events'); ?></a>
                            <ul>
                                <li><a href="<?= base_url('index.php/eventos') ?>"><?= $this->lang->line('kinds_of_events'); ?></a></li>
                                <li><a href="<?= base_url('index.php/tipoonda') ?>"><?= $this->lang->line('kinds_of_wave'); ?></a></li>
                            </ul>
                        </li>
                        <li><a href="<?= base_url('index.php/tipopadrao') ?>"><?= $this->lang->line('kinds of standards'); ?></a></li>
                    </ul>
                </li>
                <li><a id="ajuda" href="<?= base_url('index.php/usuario') ?>"><?= $this->lang->line('user'); ?></a></li>
                <li><a id="ajuda" href="<?= base_url('index.php/ajuda') ?>"><?= $this->lang->line('help'); ?></a></li>
            </ul>
            <font class="fontemenu"><h3>Interface Web Protegemed</h3></font>
            <a href="<?= base_url() ?>index.php/login/logout"><img id="sair" src="<?= base_url() ?>includes/imagens/deslogar.png"/></a>
        </div>
    </div>
</div>
-->
