<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-12 col-xs-12" id="borda">
            <ul class="abas">
                <li id="consulta" style="background-color: #A9A9A9;"><a href="<?php echo base_url('index.php/eventos') ?>" ><?php echo $this->lang->line('consult'); ?></a></li>
                <li id="cadastro"><a href="<?php echo base_url('index.php/eventos?link=cadastro') ?>" ><?php echo $this->lang->line('cadastre'); ?></a></li>
            </ul>
            <div class="row-fluid">
                <div class="col-md-12 col-xs-12" id="formcentro">
                    <table id="myTable" class="table table-striped table-bordered sortable">
                        <caption><h2><?php echo $this->lang->line('table_title_events'); ?></h2></caption>
                        <thead>
                            <tr>
                                <th  class="col1">
                                    <img id="mostrar1" src="<?php echo base_url('includes/imagens/lupa.png') ?>" />
                                    <?php echo $this->lang->line('actions'); ?>
                                    <img id="filtro1" src="<?php echo base_url('includes/imagens/filter.png') ?>" /><br/>
                                    <input type="text" id="txtColuna1" class="input-search" alt="sortable"/>
                                    <button id="fechar1" ><?php echo $this->lang->line('close'); ?></button>
                                </th>
                                <th  class="col2">
                                    <img id="mostrar2" src="<?php echo base_url('includes/imagens/lupa.png') ?>" />
                                    <?php echo $this->lang->line('code'); ?>
                                    <img id="filtro2" src="<?php echo base_url('includes/imagens/filter.png') ?>" /><br/>
                                    <input type="text" id="txtColuna2" class="2">
                                    <button id="fechar2" ><?php echo $this->lang->line('close'); ?></button>
                                </th>
                                <th  class="col3">
                                    <img id="mostrar3" src="<?php echo base_url('includes/imagens/lupa.png') ?>" />
                                    <?php echo $this->lang->line('description'); ?>
                                    <img id="filtro3" src="<?php echo base_url('includes/imagens/filter.png') ?>" /><br/>
                                    <input type="text" id="txtColuna3" class="3">
                                    <button id="fechar3" ><?php echo $this->lang->line('close'); ?></button>
                                </th>
                                <th  class="col4">
                                    <img id="mostrar4" src="<?php echo base_url('includes/imagens/lupa.png') ?>" />
                                    <?php echo $this->lang->line('form_wave'); ?>
                                    <img id="filtro4" src="<?php echo base_url('includes/imagens/filter.png') ?>" /><br/>
                                    <input type="text" id="txtColuna4" class="4">
                                    <button id="fechar4" ><?php echo $this->lang->line('close'); ?></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($eventos as $dados) {
                                ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo base_url('') ?>index.php/eventos/apagar_eventos/<?php echo $dados->codEvento; ?>" onClick="return confirm('<?php echo $this->lang->line('msg_confirm_delete') . " " . $this->lang->line('kind_of_event') . " " . $this->lang->line('code') . ": " . $dados->codEvento; ?> ?')">
                                            <img src="<?php echo base_url('includes/imagens/delete.png') ?>"></a>
                                        <a href="<?php echo base_url('') ?>index.php/eventos/editar_eventos/<?php echo $dados->codEvento; ?>">
                                            <img src="<?php echo base_url('includes/imagens/edit.png') ?>"></a>
                                    </td>
                                    <td><a href="<?php echo base_url('') ?>index.php/eventos/editar_eventos/<?php echo $dados->codEvento; ?>"><?php echo $dados->codEvento; ?></a></td>
                                    <td><a href="<?php echo base_url('') ?>index.php/eventos/editar_eventos/<?php echo $dados->codEvento; ?>"><?php echo $dados->desc; ?></a></td>
                                    <td><a href="<?php echo base_url('') ?>index.php/eventos/editar_eventos/<?php echo $dados->codEvento; ?>"><?php echo $dados->formaOnda ?>  - <?php
                                            if ($dados->formaOnda == 0) {
                                                echo "Não";
                                            } else {
                                                echo "Sim";
                                            }
                                            ?></a></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                    <?php
                    echo!empty($paginacao) ? $paginacao : '';
                    if ($this->session->flashdata('msg')) {
                        echo $this->session->flashdata('msg');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>