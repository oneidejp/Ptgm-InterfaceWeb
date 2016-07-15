<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-1 col-xs-1" id="esquerda"></div>
        <div class="col-md-10 col-xs-10" id="centro">
            <ul class="abas">
                <li id="consulta"><a href="<?php echo base_url('index.php/modelo') ?>" ><?php echo $this->lang->line('consult'); ?></a></li>
                <li id="cadastro" style="background-color: #A9A9A9;"><a href="<?php echo base_url('index.php/modelo?link=cadastro') ?>" ><?php echo $this->lang->line('cadastre'); ?></a></li>
            </ul>
            <div id="aba">
                <div class="row-fluid">
                    <div class="col-md-4 col-xs-4" id="formesquerda"></div>
                    <div class="col-md-4 col-xs-4" id="formcentro">
                        <?php if ($modelo == 'cadastro') { ?>
                            <form class="form-signin" role="form" method="post" action="<?php echo base_url('index.php/modelo/create_modelo') ?>">
                                <fieldset>
                                    <legend><?php echo $this->lang->line('page_title_cadastre_template'); ?></legend>
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('code') . ":"; ?></h4>
                                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('code'); ?>" readonly="readonly" autofocus name="codMarca">
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('description') . ":"; ?></h4>
                                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('description'); ?>" required autofocus name="desc"><br/>
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
                            <form class="form-signin" role="form" method="post" action="<?php echo base_url('index.php/modelo/editar_modelo/' . $modelo->codModelo) ?>">
                                <fieldset>
                                    <legend><?php echo $this->lang->line('form_alter_title_template'); ?></legend>
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('code') . ":"; ?></h4>
                                    <input type="text" class="form-control" readonly="readonly" autofocus name="codModelo"  value="<?php echo $modelo->codModelo; ?>">
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('description') . ":"; ?></h4>
                                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('description'); ?>" required autofocus name="desc" value="<?php echo $modelo->desc; ?>"><br/>
                                    <button class="btn  btn-primary" type="submit"><?php echo $this->lang->line('alter'); ?></button>
                                    <button class="btn  btn-primary" type="submit" formaction="<?php echo base_url('index.php/modelo'); ?>"><?php echo $this->lang->line('cancel'); ?></button>
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