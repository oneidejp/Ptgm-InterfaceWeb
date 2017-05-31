<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-12 col-xs-12" id="centro">
            <div id="aba">
                <div class="row-fluid">
                    <div class="col-md-12 col-xs-12">
                        <h2 class="center"><?php
                            foreach ($usoSalaDesc as $dados) {
                                echo $dados->desc;
                            }
                            ?></h2>
                        <form class="form-signin" role="form" method="post" action="<?php echo base_url('index.php/alertas/create_alerta/'.$codUsoSala) ?>">
                            
			    <label for="comment"><?php echo $this->lang->line('comment_alert') . ":"; ?></label>
                            <textarea class="form-control comentario" rows="8" name="comentario" maxlength="400" required></textarea>
                            <br/>
                            <button class="btn  btn-primary" type="submit"><?php echo $this->lang->line('record'); ?></button>									
                            <button type="button" value="fechar" class="btn btn-primary" onclick="window.history.back();"><?php echo $this->lang->line('cancel'); ?></button>		
			    <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('record'); ?></th>
                                        <th><?php echo $this->lang->line('compare'); ?></th>
                                        <th><?php echo $this->lang->line('capture'); ?></th>
                                        <th><?php echo $this->lang->line('equipment'); ?></th>
                                        <th><?php echo $this->lang->line('plug'); ?></th>
                                        <th><?php echo $this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('effective'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php foreach ($alerta as $dados) { ?>
                                        <tr>
                                            <td><input type="checkbox" name="alerta[]" value="<?php echo $dados->codCaptura; ?>" /></td>
                                            <td><a href="<?php echo base_url('index.php/comparar/index/'.$codUsoSala.'/'.$dados->codEquip) ?>" target="_blank" class="btn btn-primary" role="button">Comparar</a></td>
                                            <td><h4><?php echo $dados->codCaptura; ?></h4></td>
                                            <td><h4><?php echo $dados->codEquip . " - " . $dados->desc; ?></h4></td>
                                            <td><h4><?php echo $dados->codTomada; ?></h4></td>
                                            <td><h4><?php echo date('d/m/Y H:m:s', strtotime($dados->dataAtual)); ?></h4></td>	
                                            <td><h4><?php echo $dados->eficaz; ?></h4></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                            						
                        </form>	
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
