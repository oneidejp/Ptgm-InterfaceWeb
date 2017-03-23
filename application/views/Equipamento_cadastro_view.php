<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-xs-10 col-xs-offset-1" id="centro">
            <ul class="abas">
                <li id="consulta"><a href="<?php echo base_url('index.php/equipamento') ?>"><?php echo $this->lang->line('consult'); ?></a></li>
                <li id="cadastro" style="background-color: #A9A9A9;"><a href="<?php echo base_url('index.php/equipamento?link=cadastro') ?>" ><?php echo $this->lang->line('cadastre'); ?></a></li>
            </ul>
            <div id="aba1">
                <div class="row-fluid">
                    <div class="col-xs-4 col-xs-offset-4" id="formcentro">
                        <?php if ($equipamento == 'cadastro') { ?>
                            <form class="form-signin" role="form" method="post" action="<?php echo base_url('index.php/equipamento/create_equipamento') ?>">
                                <fieldset>
                                    <legend><?php echo $this->lang->line('page_title_cadastre_equipment'); ?></legend>
                                    <div class="col-xs-12">
                                        <div class="col-xs-6">
                                            <h4 class="form-signin-heading"><?php echo $this->lang->line('code') . ":"; ?></h4>
                                            <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('code'); ?>" readonly="readonly" autofocus name="codEquip">
                                            <h4 class="form-signin-heading"><?php echo $this->lang->line('trademark') . ":"; ?></h4>
                                            <select name="codMarca">
                                                <?php foreach ($marca as $dados) { ?>	
                                                    <option value="<?php echo $dados->codMarca; ?>"><?php echo $dados->desc; ?></option>
                                                <?php } ?>
                                            </select>
                                            <a href="<?php echo base_url('index.php/marca?link=cadastro'); ?>" class="btn" target="_blank"><?php echo $this->lang->line('new_trademark'); ?></a>
                                            <h4 class="form-signin-heading"><?php echo $this->lang->line('template') . ":"; ?></h4>
                                            <select name="codModelo">
                                                <?php foreach ($modelo as $dados) { ?>	
                                                    <option value="<?php echo $dados->codModelo; ?>"><?php echo $dados->desc; ?></option>
                                                <?php } ?>
                                            </select>
                                            <a href="<?php echo base_url('index.php/modelo?link=cadastro'); ?>" class="btn" target="_blank"><?php echo $this->lang->line('new_template'); ?></a>

                                        </div>
                                        <div class="col-xs-6">
                                            <h4 class="form-signin-heading"><?php echo $this->lang->line('description') . ":"; ?></h4>
                                            <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('description'); ?>" required autofocus name="desc">
                                            <h4 class="form-signin-heading"><?php echo $this->lang->line('kind') . ":"; ?></h4>
                                            <select name="codTipo">
                                                <?php foreach ($tipo as $dados) { ?>	
                                                    <option value="<?php echo $dados->codTipo; ?>"><?php echo $dados->desc; ?></option>
                                                <?php } ?>
                                            </select><br>
                                            <a href="<?php echo base_url('index.php/tipo?link=cadastro'); ?>" class="btn" target="_blank"><?php echo $this->lang->line('new_kind'); ?></a>

                                        </div>
                                    </div>
                                                                        <br>
                                    <div class="col-xs-6">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('rfid') . ":"; ?></h4>
                                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('rfid'); ?>" required autofocus name="rfid">
                                        <h4 class="form-signin-heading">LimitFase:</h4>
                                        <input type="text" class="form-control" placeholder="LimitFase" required autofocus name="limiteFase">
                                        <h4 class="form-signin-heading">LimitStandByFase:</h4>
                                        <input type="text" class="form-control" placeholder="LimitStandByFase" required autofocus name="limiteStandByFase">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('cod_heritage') . ":"; ?></h4>
                                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('cod_heritage'); ?>" required autofocus name="codPatrimonio">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('date_last_failure') . ":"; ?></h4>
                                        <input type="text" class="data" placeholder="<?php echo $this->lang->line('date_last_failure'); ?>" required autofocus name="dataUltimaFalha">
                                    
                                    </div>
                                    <div class="col-xs-6">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('plug') . ":"; ?></h4>
                                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('plug'); ?>" required autofocus name="codTomada">                                    
                                        <h4 class="form-signin-heading">LimitFuga:</h4>
                                        <input type="text" class="form-control" placeholder="LimitFuga" required autofocus name="limiteFuga">
                                        <h4 class="form-signin-heading">LimitStandByFuga:</h4>
                                        <input type="text" class="form-control" placeholder="LimitStandByFuga" required autofocus name="limiteStandByFase">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('usage_time') . ":"; ?></h4>
                                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('usage_time'); ?>" required autofocus name="tempoUso">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('date_last_maintenance') . ":"; ?></h4>
                                        <input type="text" class="data" placeholder="<?php echo $this->lang->line('date_last_maintenance'); ?>" required autofocus name="dataUltimaManutencao">
                                    
                                    </div>
                                    
                                    
                                    <div class="col-xs-12" style="text-align: center; margin-top: 20px;">
                                        <button class="btn  btn-primary" type="submit"><?php echo $this->lang->line('insert'); ?></button>
                                        <button class="btn  btn-primary" type="reset"><?php echo $this->lang->line('clean_up'); ?></button>
                                    </div>
                                    
                                </fieldset>
                            </form>	
                            <?php
                            if ($this->session->flashdata('msg')) {
                                echo $this->session->flashdata('msg');
                            }
                        } else {
                            ?>
                            <form class="form-signin" role="form" method="post" action="<?php echo base_url('index.php/equipamento/editar_equipamento/' . $equipamento->codEquip) ?>">
                                <fieldset>
                                    <legend><?php echo $this->lang->line('page_title_cadastre_equipment'); ?></legend>
                                    
                                    <div class="col-xs-12">
                                        <div class="col-xs-6">
                                            <h4 class="form-signin-heading"><?php echo $this->lang->line('code') . ":"; ?></h4>
                                            <input type="text" class="form-control" readonly="readonly" autofocus name="codEquip" value="<?php echo $equipamento->codEquip; ?>">
                                            <h4 class="form-signin-heading" target="_blank"><?php echo $this->lang->line('trademark') . ":"; ?></h4>
                                            <select name="codMarca">
                                                <?php foreach ($marca as $dados) { ?>	
                                                    <option value="<?php echo $dados->codMarca; ?>"<?php
                                                    if ($equipamento->codMarca == $dados->codMarca) {
                                                        echo ' selected';
                                                    }
                                                    ?>><?php echo $dados->desc; ?></option>
                                                        <?php } ?>
                                            </select>
                                            <a href="<?php echo base_url('index.php/marca?link=cadastro'); ?>" class="btn" target="_blank"><?php echo $this->lang->line('new_trademark'); ?></a>
                                            <h4 class="form-signin-heading"><?php echo $this->lang->line('template') . ":"; ?></h4>
                                            <select name="codModelo">
                                                <?php foreach ($modelo as $dados) { ?>	
                                                    <option value="<?php echo $dados->codModelo; ?>"<?php
                                                    if ($equipamento->codModelo == $dados->codModelo) {
                                                        echo ' selected';
                                                    }
                                                    ?>><?php echo $dados->desc; ?></option>
                                                        <?php } ?>
                                            </select>
                                            <a href="<?php echo base_url('index.php/modelo?link=cadastro'); ?>" class="btn" target="_blank"><?php echo $this->lang->line('new_template'); ?></a>
                                        </div>
                                        <div class="col-xs-6">
                                            <h4 class="form-signin-heading"><?php echo $this->lang->line('description') . ":"; ?></h4>
                                            <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('description'); ?>" required autofocus name="desc" value="<?php echo $equipamento->desc; ?>">
                                            <h4 class="form-signin-heading"><?php echo $this->lang->line('kind') . ":"; ?></h4>
                                            <select name="codTipo">
                                                <?php foreach ($tipo as $dados) { ?>	
                                                    <option value="<?php echo $dados->codTipo; ?>"<?php
                                                    if ($equipamento->codTipo == $dados->codTipo) {
                                                        echo ' selected';
                                                    }
                                                    ?>><?php echo $dados->desc; ?></option>
                                                        <?php } ?>
                                            </select><br>
                                            <a href="<?php echo base_url('index.php/tipo?link=cadastro'); ?>" class="btn" target="_blank"><?php echo $this->lang->line('new_kind'); ?></a>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-6">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('rfid') . ":"; ?></h4>
                                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('rfid'); ?>" required autofocus name="rfid" value="<?php echo $equipamento->rfid; ?>">
                                        <h4 class="form-signin-heading">LimitFase:</h4>
                                        <input type="text" class="form-control" placeholder="LimitFase" required autofocus name="limiteFase" value="<?php echo $equipamento->limiteFase; ?>">
                                        <h4 class="form-signin-heading">LimitStandByFase:</h4>
                                        <input type="text" class="form-control" placeholder="LimitStandByFase" required autofocus name="limiteStandByFase" value="<?php echo $equipamento->limiteStandByFase; ?>">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('cod_heritage') . ":"; ?></h4>
                                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('cod_heritage'); ?>" required autofocus name="codPatrimonio" value="<?php echo $equipamento->codPatrimonio; ?>">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('date_last_failure') . ":"; ?></h4>
                                        <input type="text" class="data" placeholder="<?php echo $this->lang->line('date_last_failure'); ?>" required autofocus name="dataUltimaFalha" value="<?php echo $equipamento->dataUltimaFalha; ?>">
                                        
                                    </div>
                                    
                                    <div class="col-xs-6">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('plug') . ":"; ?></h4>
                                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('plug'); ?>" required autofocus name="codTomada" value="<?php echo $equipamento->codTomada; ?>">
                                        <h4 class="form-signin-heading">LimitFuga:</h4>
                                        <input type="text" class="form-control" placeholder="LimitFuga" required autofocus name="limiteFuga" value="<?php echo $equipamento->limiteFuga; ?>">
                                        <h4 class="form-signin-heading">LimitStandByFuga:</h4>
                                        <input type="text" class="form-control" placeholder="LimitStandByFuga" required autofocus name="limiteStandByFuga" value="<?php echo $equipamento->limiteStandByFuga; ?>">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('usage_time') . ":"; ?></h4>
                                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('usage_time'); ?>" required autofocus name="tempoUso" value="<?php echo $equipamento->tempoUso; ?>">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('date_last_maintenance') . ":"; ?></h4>
                                        <input type="text" class="data" placeholder="<?php echo $this->lang->line('date_last_maintenance'); ?>" required autofocus name="dataUltimaManutencao" value="<?php echo $equipamento->dataUltimaManutencao; ?>">
                                          
                                    </div>
                                    
                                    <div class="col-xs-12" style="text-align: center; margin-top: 20px;">
                                        <button class="btn  btn-primary" type="submit"><?php echo $this->lang->line('alter'); ?></button>
                                        <button class="btn  btn-primary" type="submit" formaction="<?php echo base_url('index.php/equipamento'); ?>"><?php echo $this->lang->line('cancel'); ?></button>
                                    </div>
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