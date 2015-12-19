<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?= base_url('includes/css/menu.css') ?>"><!--estilo do menu -->
    </head>
    <body>
        <ul class="dropdown">
            <li><a href="#"><?= $this->lang->line('control'); ?></a>
                <ul class="submenu">
                    <li><a href="<?= base_url('index.php/paineldecontrole') ?>"><?= $this->lang->line('control_panel'); ?></a></li>
                    <li><a href="<?= base_url('index.php/ultimascapturadas') ?>"><?= $this->lang->line('last_captured'); ?></a></li>
                    <li><a href="<?= base_url('index.php/focapturadas') ?>"><?= $this->lang->line('fo_captured'); ?></a></li>
                    <li><a href="<?= base_url('index.php/usodesalas') ?>"><?= $this->lang->line('use_room'); ?></a></li>
                    <li><a href="<?= base_url('index.php/padrao') ?>"><?= $this->lang->line('standard'); ?></a></li>
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
            <li><a id="usuario" href="<?= base_url('index.php/usuario') ?>"><?= $this->lang->line('user'); ?></a></li>
            <li><a id="banco" href="<?= base_url('index.php/usuario') ?>"><?= $this->lang->line('user'); ?></a></li>
            <li><a id="ajuda" href="<?= base_url('index.php/ajuda') ?>"><?= $this->lang->line('help'); ?></a></li>
        </ul>
        <font class="fontemenu"><h3>Interface Web Protegemed</h3></font>
    </body>
</html>