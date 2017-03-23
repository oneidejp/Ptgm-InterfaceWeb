<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-xs-10 col-xs-offset-1" id="centro">
            <ul class="abas">
                <li id="consulta"><a href="<?php echo base_url('index.php/modulo') ?>" ><?php echo $this->lang->line('consult'); ?></a></li>
                <li id="cadastro" style="background-color: #A9A9A9;"><a href="<?php echo base_url('index.php/modulo?link=cadastro') ?>" ><?php echo $this->lang->line('cadastre'); ?></a></li>
            </ul>
            <div id="aba1">
                <div class="row-fluid">
                    <div class="col-xs-4 col-xs-offset-4" id="formcentro">
                        <?php if ($modulo == 'cadastro') { ?>
                            <form class="form-signin" role="form" method="post" action="<?php echo base_url('index.php/modulo/create_modulo') ?>">
                                <fieldset>
                                    <legend><?php echo $this->lang->line('page_title_cadastre_module'); ?></legend>
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('code') . ":"; ?></h4>
                                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('code'); ?>" readonly="readonly" autofocus name="idModulo">
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('description') . ":"; ?></h4>
                                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('description'); ?>" required autofocus name="desc">
                                    
                                    
                                    <h4 class="form-signin-heading">IP: </h4>
                                    <input type="text" class="form-control" placeholder="IP" required autofocus name="ip">
                                    <h4 class="form-signin-heading">IdWebSocket:</h4>
                                    <input type="text" class="form-control" placeholder="IdWebSocket" required autofocus name="idWebSocket">
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('last_on') . ":"; ?></h4>
                                    <input type="text" class="data" placeholder="<?php echo $this->lang->line('last_on'); ?>" required autofocus name="ultimoLiga"><br><br>
                                    
                                    
                                    <button class="btn  btn-primary" type="submit"><?php echo $this->lang->line('insert'); ?></button>
                                    <button class="btn  btn-primary" type="reset"><?php echo $this->lang->line('clean_up'); ?></button>
                                </fieldset>
                            </form>	
                            <?php
                            if ($this->session->flashdata('msg')) {
                                echo $this->session->flashdata('msg');
                            }
                        } else {
                            ?>
                            <form class="form-signin" role="form" method="post" action="<?php echo base_url('index.php/modulo/editar_modulo/' . $modulo->idModulo) ?>">
                                <fieldset>
                                    <legend><?php echo $this->lang->line('form_alter_title_module'); ?></legend>
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('code') . ":"; ?></h4>
                                    <input type="text" class="form-control" readonly="readonly" autofocus name="idModulo"  value="<?php echo $modulo->idModulo; ?>">
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('description') . ":"; ?></h4>
                                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('description'); ?>" required autofocus name="desc" value="<?php echo $modulo->desc; ?>">
                                    
                                    <h4 class="form-signin-heading">IP:</h4>
                                    <input type="text" class="form-control" placeholder="IP" required autofocus name="ip" value="<?php echo $modulo->ip; ?>">
                                    <h4 class="form-signin-heading">IdWebSocket:</h4>
                                    <input type="text" class="form-control" placeholder="IdWebSocket" required autofocus name="idWebSocket" value="<?php echo $modulo->idWebSocket; ?>">
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('last_on') . ":"; ?></h4>
                                    <input type="text" class="data" placeholder="<?php echo $this->lang->line('last_on'); ?>" required autofocus name="ultimoLiga" value="<?php echo $modulo->ultimoLiga; ?>"><br><br>
                                    
                                    
                                    
                                    <button class="btn  btn-primary" type="submit"><?php echo $this->lang->line('alter'); ?></button>
                                    <button class="btn  btn-primary" type="submit" formaction="<?php echo base_url('index.php/modulo'); ?>"><?php echo $this->lang->line('cancel'); ?></button>
                                </fieldset>
                            </form>	
                            <?php
                            if ($this->session->flashdata('msg')) {
                                echo $this->session->flashdata('msg');
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>