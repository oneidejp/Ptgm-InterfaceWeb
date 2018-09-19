<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-xs-10 col-xs-offset-1" id="centro">
            <ul class="abas">
                <li id="consulta"><a href="<?php echo base_url('index.php/eventos') ?>"><?php echo $this->lang->line('consult'); ?></a></li>
                <li id="cadastro" style="background-color: #A9A9A9;"><a href="<?php echo base_url('index.php/eventos?link=cadastro') ?>" ><?php echo $this->lang->line('cadastre'); ?></a></li>
            </ul>
            <div id="aba1">
                <div class="row-fluid">
                    <div class="col-xs-4 col-xs-offset-4" id="formcentro">
                        <?php if ($eventos == 'cadastro') { ?>
                            <form class="form-signin" role="form" method="post" action="<?php echo base_url('index.php/eventos/create_eventos') ?>">
                                <fieldset>
                                    <legend><?php echo $this->lang->line('page_title_cadastre_events'); ?></legend>
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('code') . ":"; ?></h4>
                                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('code'); ?>" readonly="readonly" autofocus name="codEvento">
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('description') . ":"; ?></h4>
                                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('description'); ?>" required autofocus name="desc">
                                    
                                    <br>
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('form_wave') . ":"; ?></h4>
                                    <p>   
                                        <input type="radio" name="formaOnda" id="optionsRadios1" value="1" required>
                                        <?php echo $this->lang->line('yes'); ?>
                                        <input type="radio" name="formaOnda" id="optionsRadios2" value="0" required>
                                        <?php echo $this->lang->line('no'); ?>
                                    </p> 
                                    <br>
                                        
                                    <button class="btn btn-primary" type="submit"><?php echo $this->lang->line('insert'); ?></button>
                                    <button class="btn btn-primary" type="reset"><?php echo $this->lang->line('clean_up'); ?></button>
                                </fieldset>
                            </form>	
                            <?php
                            if ($this->session->flashdata('msg')) {
                                echo $this->session->flashdata('msg');
                            }
                        } else {
                            ?>
                            <form class="form-signin" role="form" method="post" action="<?php echo base_url('index.php/eventos/editar_eventos/' . $eventos->codEvento) ?>">
                                <fieldset>
                                    <legend><?php echo $this->lang->line('form_alter_title_events'); ?></legend>
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('code') . ":"; ?></h4>
                                    <input type="text" class="form-control" readonly="readonly" autofocus name="codEvento"  value="<?php echo $eventos->codEvento; ?>">
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('description') . ":"; ?></h4>
                                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('description'); ?>" required autofocus name="desc" value="<?php echo $eventos->desc; ?>">
                                    
                                    <br>
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('form_wave') . ":"; ?></h4>
                                    <p>   
                                        <input type="radio" name="formaOnda" id="optionsRadios1" <?php
                                        if ($eventos->formaOnda == "1") {
                                            echo(' checked ');
                                        }
                                        ?> value="1" >
                                        <?php echo $this->lang->line('yes'); ?>
                                    
                                    
                                        <input type="radio" name="formaOnda" id="optionsRadios2" <?php
                                        if ($eventos->formaOnda == "0") {
                                            echo(' checked ');
                                        }
                                        ?> value="0">
                                        <?php echo $this->lang->line('no'); ?>
                                    </p><br>
                                    
                                    <button class="btn  btn-primary" type="submit"><?php echo $this->lang->line('alter'); ?></button>
                                    <button class="btn  btn-primary" type="submit" formaction="<?php echo base_url('index.php/eventos'); ?>"><?php echo $this->lang->line('cancel'); ?></button>
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