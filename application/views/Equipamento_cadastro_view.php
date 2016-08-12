<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-10 col-xs-10 col-md-offset-1" id="centro">
            <ul class="abas">
                <li id="consulta"><a href="<?php echo base_url('index.php/equipamento') ?>"><?php echo $this->lang->line('consult'); ?></a></li>
                <li id="cadastro" style="background-color: #A9A9A9;"><a href="<?php echo base_url('index.php/equipamento?link=cadastro') ?>" ><?php echo $this->lang->line('cadastre'); ?></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-12 col-xs-12">
            <div class="col-md-5 col-xs-5 col-md-offset-2" id="borda">
                <?php if ($equipamento == 'cadastro') { ?>
                    <form class="form-signin" role="form" method="post" action="<?php echo base_url('index.php/equipamento/create_equipamento') ?>">
                        <fieldset>
                            <legend><?php echo $this->lang->line('page_title_cadastre_equipment'); ?></legend>
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('code') . ":"; ?></h4>
                            <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('code'); ?>" readonly="readonly" autofocus name="codEquip">
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('description') . ":"; ?></h4>
                            <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('description'); ?>" required autofocus name="desc">
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('trademark') . ":"; ?></h4>
                            <div class="col-md-4">
                            <select class="form-control" name="codMarca">
                                <?php foreach ($marca as $dados) { ?>	
                                    <option value="<?php echo $dados->codMarca; ?>"><?php echo $dados->desc; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <a href="<?php echo base_url('index.php/marca?link=cadastro'); ?>" class="btn" target="_blank"><?php echo $this->lang->line('new_trademark'); ?></a>
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('template') . ":"; ?></h4>
                            <select name="codModelo">
                                <?php foreach ($modelo as $dados) { ?>	
                                    <option value="<?php echo $dados->codModelo; ?>"><?php echo $dados->desc; ?></option>
                                <?php } ?>
                            </select>
                            <a href="<?php echo base_url('index.php/modelo?link=cadastro'); ?>" class="btn" target="_blank"><?php echo $this->lang->line('new_template'); ?></a>
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('kind') . ":"; ?></h4>
                            <select name="codTipo">
                                <?php foreach ($tipo as $dados) { ?>	
                                    <option value="<?php echo $dados->codTipo; ?>"><?php echo $dados->desc; ?></option>
                                <?php } ?>
                            </select>
                            <a href="<?php echo base_url('index.php/tipo?link=cadastro'); ?>" class="btn" target="_blank"><?php echo $this->lang->line('new_kind'); ?></a>
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('rfid') . ":"; ?></h4>
                            <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('rfid'); ?>" required autofocus name="rfid">
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('cod_heritage') . ":"; ?></h4>
                            <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('cod_heritage'); ?>" required autofocus name="codPatrimonio"><br/>
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('date_last_failure') . ":"; ?></h4>
                            <input type="text" class="data" placeholder="<?php echo $this->lang->line('date_last_failure'); ?>" required autofocus name="dataUltimaFalha"><br/>
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('date_last_maintenance') . ":"; ?></h4>
                            <input type="text" class="data" placeholder="<?php echo $this->lang->line('date_last_maintenance'); ?>" required autofocus name="dataUltimaManutencao"><br/>
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('usage_time') . ":"; ?></h4>
                            <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('usage_time'); ?>" required autofocus name="tempoUso"><br/>
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
                    <form class="form-signin" role="form" method="post" action="<?php echo base_url('index.php/equipamento/editar_equipamento/' . $equipamento->codEquip) ?>">
                        <fieldset>
                            <legend><?php echo $this->lang->line('page_title_cadastre_equipment'); ?></legend>
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('code') . ":"; ?></h4>
                            <input type="text" class="form-control" readonly="readonly" autofocus name="codEquip" value="<?php echo $equipamento->codEquip; ?>">
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('description') . ":"; ?></h4>
                            <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('description'); ?>" required autofocus name="desc" value="<?php echo $equipamento->desc; ?>">

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
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('kind') . ":"; ?></h4>
                            <select name="codTipo">
                                <?php foreach ($tipo as $dados) { ?>	
                                    <option value="<?php echo $dados->codTipo; ?>"<?php
                                    if ($equipamento->codTipo == $dados->codTipo) {
                                        echo ' selected';
                                    }
                                    ?>><?php echo $dados->desc; ?></option>
                                        <?php } ?>
                            </select>
                            <a href="<?php echo base_url('index.php/tipo?link=cadastro'); ?>" class="btn" target="_blank"><?php echo $this->lang->line('new_kind'); ?></a>
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('rfid') . ":"; ?></h4>
                            <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('rfid'); ?>" required autofocus name="rfid" value="<?php echo $equipamento->rfid; ?>">
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('cod_heritage') . ":"; ?></h4>
                            <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('cod_heritage'); ?>" required autofocus name="codPatrimonio" value="<?php echo $equipamento->codPatrimonio; ?>"><br/>
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('date_last_failure') . ":"; ?></h4>
                            <input type="text" class="data" placeholder="<?php echo $this->lang->line('date_last_failure'); ?>" required autofocus name="dataUltimaFalha" value="<?php echo $equipamento->dataUltimaFalha; ?>"><br/>
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('date_last_maintenance') . ":"; ?></h4>
                            <input type="text" class="data" placeholder="<?php echo $this->lang->line('date_last_maintenance'); ?>" required autofocus name="dataUltimaManutencao" value="<?php echo $equipamento->dataUltimaManutencao; ?>"><br/>
                            <h4 class="form-signin-heading"><?php echo $this->lang->line('usage_time') . ":"; ?></h4>
                            <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('usage_time'); ?>" required autofocus name="tempoUso" value="<?php echo $equipamento->tempoUso; ?>"><br/>
                            <button class="btn  btn-primary" type="submit"><?php echo $this->lang->line('alter'); ?></button>
                            <button class="btn  btn-primary" type="submit" formaction="<?php echo base_url('index.php/equipamento'); ?>"><?php echo $this->lang->line('cancel'); ?></button>
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
