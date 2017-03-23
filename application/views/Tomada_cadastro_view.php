<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-xs-10 col-xs-offset-1" id="centro">
            <ul class="abas">
                <li id="consulta"><a href="<?php echo base_url('index.php/tomada') ?>"><?php echo $this->lang->line('consult'); ?></a></li>
                <li id="cadastro" style="background-color: #A9A9A9;"><a href="<?php echo base_url('index.php/tomada?link=cadastro') ?>" ><?php echo $this->lang->line('cadastre'); ?></a></li>
            </ul>
            <div id="aba1">
                <div class="row-fluid">
                    <div class="col-xs-4 col-xs-offset-4" id="formcentro">
                        <?php if ($tomada == 'cadastro') { ?>
                            <form class="form-signin" role="form" method="post" action="<?php echo base_url('index.php/tomada/create_tomada') ?>">
                                <fieldset>
                                    <legend><?php echo $this->lang->line('page_title_cadastre_plug'); ?></legend>
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('code') . ":"; ?></h4>
                                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('code'); ?>" readonly="readonly" autofocus name="codTomada">
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('description') . ":"; ?></h4>
                                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('description'); ?>" required autofocus name="desc">
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('room') . ":"; ?></h4>
                                    <select name="codSala">
                                        <?php foreach ($sala as $dados) { ?>	
                                            <option value="<?php echo $dados->codSala; ?>"><?php echo $dados->desc; ?></option>
                                        <?php }; ?>
                                    </select>
                                    <a href="<?php echo base_url('index.php/sala?link=cadastro'); ?>" class="btn" target="_blank"><?php echo $this->lang->line('new_room'); ?></a>
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('table_of_contents') . ":"; ?></h4>
                                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('table_of_contents'); ?>" required autofocus name="indice">
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('module') . ":"; ?></h4>
                                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('module'); ?>" required autofocus name="codModulo">
                                    <h4 class="form-signin-heading">LimitFase:</h4>
                                    <input type="text" class="form-control" placeholder="LimitFase" required autofocus name="limiteFase">
                                    <h4 class="form-signin-heading">LimitFuga:</h4>
                                    <input type="text" class="form-control" placeholder="LimitFuga" required autofocus name="limiteFuga">
                                    <h4 class="form-signin-heading">LimitStandByFase:</h4>
                                    <input type="text" class="form-control" placeholder="LimitStandByFase" required autofocus name="limiteStandByFase">
                                    <h4 class="form-signin-heading">LimitStandByFuga:</h4>
                                    <input type="text" class="form-control" placeholder="LimitStandByFuga" required autofocus name="limiteStandByFuga"><br/><br/>
                                    
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
                            <form class="form-signin" role="form" method="post" action="<?php echo base_url('index.php/tomada/editar_tomada/' . $tomada->codTomada) ?>">
                                <fieldset>
                                    <legend><?php echo $this->lang->line('form_alter_title_plug'); ?></legend>
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('code') . ":"; ?></h4>
                                    <input type="text" class="form-control" readonly="readonly" autofocus name="codTomada"  value="<?php echo $tomada->codTomada; ?>">
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('description') . ":"; ?></h4>
                                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('description'); ?>" required autofocus name="desc" value="<?php echo $tomada->desc; ?>">
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('room') . ":"; ?></h4>
                                    <select name="codSala">
                                        <?php foreach ($sala as $dados) { ?>	
                                            <option value="<?php echo $dados->codSala; ?>" <?php
                                            if ($tomada->codSala == $dados->codSala) {
                                                echo ' selected';
                                            }
                                            ?> ><?php echo $dados->desc; ?></option>
    <?php } ?>
                                    </select>
                                    <a href="<?php echo base_url('index.php/sala?link=cadastro'); ?>" class="btn" target="_blank"><?php echo $this->lang->line('new_room'); ?></a>
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('table_of_contents') . ":"; ?></h4>
                                    <input type="text" class="form-control" placeholder="Índice" required autofocus name="indice" value="<?php echo $tomada->indice; ?>">
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('module') . ":"; ?></h4>
                                    <input type="text" class="form-control" placeholder="Módulo" required autofocus name="codModulo" value="<?php echo $tomada->codModulo; ?>">
                                    
                                    <h4 class="form-signin-heading">LimitFase:</h4>
                                    <input type="text" class="form-control" placeholder="LimitFase" required autofocus name="limiteFase" value="<?php echo $tomada->limiteFase; ?>">
                                    <h4 class="form-signin-heading">LimitFuga:</h4>
                                    <input type="text" class="form-control" placeholder="LimitFuga" required autofocus name="limiteFuga" value="<?php echo $tomada->limiteFuga; ?>">
                                    <h4 class="form-signin-heading">LimitStandByFase:</h4>
                                    <input type="text" class="form-control" placeholder="LimitStandByFase" required autofocus name="limiteStandByFase" value="<?php echo $tomada->limiteStandByFase; ?>">
                                    <h4 class="form-signin-heading">LimitStandByFuga:</h4>
                                    <input type="text" class="form-control" placeholder="LimitStandByFuga" required autofocus name="limiteStandByFuga" value="<?php echo $tomada->limiteStandByFuga; ?>"><br/><br/>
                                    
                                    <button class="btn  btn-primary" type="submit"><?php echo $this->lang->line('alter'); ?></button>
                                    <button class="btn  btn-primary" type="submit" formaction="<?php echo base_url('index.php/tomada'); ?>"><?php echo $this->lang->line('cancel'); ?></button>
                                </fieldset>
                            </form>	
                            <?php
                            if ($this->session->flashdata('msg')) {
                                echo $this->session->flashdata('msg');
                            }
                        }
                        ?>
                    </div>
                    <div class="col-md-4 col-xs-4" id="formesquerda"></div>
                </div>
            </div>
        </div>
        <div class="col-md-1 col-xs-1" id="direita"></div>
    </div>
</div>