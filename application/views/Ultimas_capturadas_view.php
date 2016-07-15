<div class="container-fluid">
    <div class="row-fluid" id="aba">
        <div class="col-md-5 col-xs-5" style="overflow:auto;">
            <table id="tabelaUltimasCap" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><?php echo $this->lang->line('capture'); ?></th>
                        <th><?php echo $this->lang->line('plug'); ?></th>
                        <th><?php echo $this->lang->line('kinds_of_wave'); ?></th>
                        <th><?php echo $this->lang->line('equipment'); ?></th>
                        <th><?php echo $this->lang->line('events'); ?></th>
                        <th><?php echo $this->lang->line('effective'); ?></th>
                        <th><?php echo $this->lang->line('date'); ?></th>
                        <th><?php echo $this->lang->line('compare'); ?></th>
                    </tr>
                </thead>
                <tbody>									
                    <?php if (empty($uc)) { ?>
                        <tr>
                            <td><?php echo $this->lang->line('empty'); ?></td>
                            <td><?php echo $this->lang->line('empty'); ?></td>
                            <td><?php echo $this->lang->line('empty'); ?></td>
                            <td><?php echo $this->lang->line('empty'); ?></td>
                            <td><?php echo $this->lang->line('empty'); ?></td>
                            <td><?php echo $this->lang->line('empty'); ?></td>
                            <td><?php echo $this->lang->line('empty'); ?></td>
                            <td><input type="checkbox"/></td>
                        </tr>
                        <?php
                    } else {
                        foreach ($uc as $dados) {
                            ?>
                            <tr>
                                <td><?php echo $dados->codCaptura; ?></td>
                                <td><?php echo $dados->codTomada; ?></td>
                                <td><?php echo $dados->codTipoOnda; ?></td>
                                <td><?php echo $dados->codEquip; ?></td>
                                <td><?php echo $dados->codEvento; ?></td>
                                <td><?php echo substr($dados->eficaz, 0, 6); ?></td>
                                <td><?php echo date('d/m/Y H:m:s', strtotime($dados->dataAtual)); ?></td>
                                <?php echo '<td><input type="checkbox" id="' . $dados->codCaptura . '" name="comparar"></td>' ?>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-7 col-xs-7">
            <div id="linha"></div>
            <div id="barra"></div>
        </div>
    </div>	
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="row-fluid">
            <div id="graficoslinha"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var cont = 0;
        var graficos = [];
        $('input[type="checkbox"]').click(function () {
            var id = $(this).attr('id'); //pega o id do checkbox clicado
            var nome = $(this).attr('name'); //pega o nome do checkbox clicado
            // se fone comparar coluna comparar
            if (nome === "comparar") {
                var checkado = ($("#" + id).is(':checked')); //verifica se o checkbox foi clicado true == sim, false == não

                if (checkado === true) { // se checkado == true monta gráfico na área de comparação
                    //ajax envia os dados p/ php e no php processa e retornar valores em dados.linha e dados.barra
                    if (cont < 5) {
                        graficos[cont] = id;
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "index.php/ultimascapturadas/graficos",
                            dataType: 'json',
                            scriptCharset: 'UTF-8',
                            type: "POST",
                            data: {
                                action: 'checkDados',
                                idCheckbox: id
                            },
                            success: function (dados) {
                                if (dados) {
                                    var chart = $('#barra').highcharts();
                                    chart.addSeries({
                                        name: id,
                                        data: dados.barra
                                    });
                                    var chart = $('#linha').highcharts();
                                    chart.addSeries({
                                        data: dados.linha
                                    });
                                    cont = ++cont;
                                } else
                                    alert("Erro Ajax");
                            }
                        });
                    } else {
                        alert("Máximo de 5 Equipamentos Atingido");
                        $("#" + id).attr("checked", false);
                    }
                } else { // senão oculta gráfico do equipamento
                    cont = --cont;
                    for (var x = 0; x < graficos.length; x++) {
                        if (graficos[x] === id) {
                            var chart = $('#barra').highcharts();
                            if (chart.series.length) {
                                chart.series[x].remove();
                            }
                            var chart = $('#linha').highcharts();
                            if (chart.series.length) {
                                chart.series[x].remove();
                            }
                            graficos.splice(x, 1);
                        }
                    }
                }
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#tabelaUltimasCap').dataTable({
            //"aaSorting": [[1, 'desc']],
            //"bSortCellsTop": false,
            //"sDom": '<"top"f>rt<"bottom"ip><"clear">'

        });
    });
</script>