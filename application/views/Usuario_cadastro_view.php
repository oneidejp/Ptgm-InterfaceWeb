<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-xs-10 col-xs-offset-1" id="centro">
            <ul class="abas">
                <li id="consulta"><a href="<?php echo base_url('index.php/usuario') ?>"><?php echo $this->lang->line('consult'); ?></a></li>
                <li id="cadastro" style="background-color: #A9A9A9;"><a href="<?php echo base_url('index.php/usuario?link=cadastro') ?>" ><?php echo $this->lang->line('cadastre'); ?></a></li>
            </ul>
            <div id="aba1">
                <div class="row-fluid">
                    <div class="col-xs-4 col-xs-offset-4" id="formcentro">
                        <?php
                        if ($this->session->userdata('nivel') == '1') {
                            if ($usuario == 'cadastro') {
                                ?>
                                <form class="form-signin" role="form" method="post" action="<?php echo base_url('index.php/usuario/create_usuario') ?>">
                                    <fieldset>
                                        <legend><?php echo $this->lang->line('page_title_cadastre_user'); ?></legend>
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('code') . ":"; ?></h4>
                                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('code'); ?>" readonly="readonly" autofocus name="id">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('name') . ":"; ?></h4>
                                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('name'); ?>" required autofocus name="nome">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('email') . ":"; ?></h4>
                                        <input type="email" class="form-control" placeholder="<?php echo $this->lang->line('email'); ?>" autofocus name="email">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('password') . ":"; ?></h4>
                                        <input type="password" class="form-control" placeholder="<?php echo $this->lang->line('password'); ?>" required autofocus name="senha">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('level') . ":"; ?></h4>
                                        <select name="nivel">
                                            <option value="1"><?php echo $this->lang->line('administrador'); ?></option>
                                            <option value="2"><?php echo $this->lang->line('supervisor'); ?></option>
                                            <option value="3"><?php echo $this->lang->line('operator'); ?></option>
                                            <option value="4"><?php echo $this->lang->line('viewer'); ?></option>
                                        </select>
                                        <br/><br/>
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
                                <form class="form-signin" role="form" method="post" action="<?php echo base_url('index.php/usuario/editar_usuario/' . $usuario->id) ?>">
                                    <fieldset>
                                        <legend><?php echo $this->lang->line('form_alter_title_user'); ?></legend>
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('code') . ":"; ?></h4>
                                        <input type="text" class="form-control" readonly="readonly" autofocus name="id" value="<?php echo $usuario->id; ?>">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('name') . ":"; ?></h4>
                                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('name'); ?>" required autofocus name="nome" value="<?php echo $usuario->nome; ?>">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('email') . ":"; ?></h4>
                                        <input type="email" class="form-control" placeholder="<?php echo $this->lang->line('email'); ?>" autofocus name="email" value="<?php echo $usuario->email; ?>">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('password') . ":"; ?></h4>
                                        <input type="password" class="form-control" placeholder="<?php echo $this->lang->line('password'); ?>" required autofocus name="senha" value="<?php echo $usuario->senha; ?>">
                                        <h4 class="form-signin-heading"><?php echo $this->lang->line('level') . ":"; ?></h4>
                                        <select name="nivel">
                                            <option value="1" <?php
                                            if ($usuario->nivel == '1') {
                                                echo ' selected';
                                            }
                                            ?>><?php echo $this->lang->line('administrador'); ?></option>
                                            <option value="2" <?php
                                            if ($usuario->nivel == '2') {
                                                echo ' selected';
                                            }
                                            ?>><?php echo $this->lang->line('supervisor'); ?></option>
                                            <option value="3" <?php
                                            if ($usuario->nivel == '3') {
                                                echo ' selected';
                                            }
                                            ?>><?php echo $this->lang->line('operator'); ?></option>
                                            <option value="4" <?php
                                            if ($usuario->nivel == '4') {
                                                echo ' selected';
                                            }
                                            ?>><?php echo $this->lang->line('viewer'); ?></option>
                                        </select>
                                        <br/>
                                        <button class="btn  btn-primary" type="submit"><?php echo $this->lang->line('alter'); ?></button>
                                        <button class="btn  btn-primary" type="submit" formaction="<?php echo base_url('index.php/usuario'); ?>"><?php echo $this->lang->line('cancel'); ?></button>
                                    </fieldset>
                                </form>	
                                <?php
                                if ($this->session->flashdata('msg')) {
                                    echo $this->session->flashdata('msg');
                                }
                            }
                        } else {
                            ?>
                            <form class="form-signin" role="form" method="post" action="<?php echo base_url('index.php/usuario/editar_senha/' . $this->session->userdata('id')) ?>">
                                <fieldset>
                                    <legend><?php echo $this->lang->line('form_alter_title_password'); ?></legend>
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('current_password') . ":"; ?></h4>
                                    <input type="password" class="form-control" placeholder="<?php echo $this->lang->line('current_password'); ?>" required autofocus name="senhaatual">
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('new_password') . ":"; ?></h4>
                                    <input type="password" class="form-control" placeholder="<?php echo $this->lang->line('new_password'); ?>" required autofocus name="novasenha">
                                    <h4 class="form-signin-heading"><?php echo $this->lang->line('confirm_new_password') . ":"; ?></h4>
                                    <input type="password" class="form-control" placeholder="<?php echo $this->lang->line('confirm_new_password'); ?>" required autofocus name="confirmnovasenha">
                                    <br/>
                                    <button class="btn  btn-primary" type="submit"><?php echo $this->lang->line('alter'); ?></button>
                                    <button class="btn  btn-primary" type="submit" formaction="<?php echo base_url('index.php/usuario'); ?>"><?php echo $this->lang->line('cancel'); ?></button>
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