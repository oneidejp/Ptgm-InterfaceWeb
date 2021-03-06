<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-12 col-xs-12" id="centro">
            <div id="aba">
                <div class="row-fluid">
                    <div class="col-md-12 col-xs-12">
<?php foreach ($equipamento as $equip) { ?>
                            <h3 class="center"><?php echo $equip->equipamento; ?></h3>
                            <br/>
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <td><h4><?php echo $equip->codModelo . " - ";
    echo $equip->modelo;
    ?></h4></td>
                                    <td><h4><?php echo $equip->codMarca . " - ";
    echo $equip->marca;
    ?></h4></td>
                                    <td><h4><?php echo "Rfid: " . $equip->rfid; ?></h4></td>
                                    <td><h4><?php echo $tempodeuso; ?></h4></td>
                                </tr>
                            </table>
<?php }
?>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="col-md-6 col-xs-6">
                    <h3 class="center"><?php echo $this->lang->line('phase'); ?></h3>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo $this->lang->line('compare'); ?></th>
                                <th><?php echo $this->lang->line('capture'); ?></th>
                                <th><?php echo $this->lang->line('valor_medio'); ?></th>
                                <th><?php echo $this->lang->line('effective'); ?></th>
                                <th><?php echo $this->lang->line('plug'); ?></th>
                                <th><?php echo $this->lang->line('date'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
<?php if (empty($fase)) {
    ?>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                </tr>
                                <?php
                            } else {
                                $anterior = 0;
                                foreach ($fase as $dados) {
                                    if ($anterior == $dados->codTomada) {
                                        ?>
                                        <tr id="fase<?php echo $dados->codCaptura; ?>">
                                            <td id="<?php echo $dados->codCaptura; ?>-1"><input type="checkbox" id="<?php echo $dados->codTomada; ?>" class="<?php echo $dados->codCaptura; ?>" name="fase"  /></td>
                                            <td id="<?php echo $dados->codCaptura; ?>-2"><?php echo $dados->codCaptura; ?></td>
                                            <td id="<?php echo $dados->codCaptura; ?>-3"><?php echo $dados->valorMedio; ?></td>
                                            <td id="<?php echo $dados->codCaptura; ?>-4"><?php echo $dados->eficaz; ?></td>
                                            <td id="<?php echo $dados->codCaptura; ?>-5"><?php echo $dados->codTomada; ?></td>
                                            <td id="<?php echo $dados->codCaptura; ?>-6"><?php echo $dados->dataAtual; ?></td>
                                        </tr>
                                    <script type="text/javascript">
                                        $("#fase<?php echo $dados->codCaptura; ?>").hide();
                                        $("#<?php echo $capanterior; ?>-2").html("<img id='fase' class='<?php echo $dados->codTomada; ?>' name='maisfase' src='<?php echo base_url('includes/imagens/mais.jpg') ?>'> <?php echo $capanterior; ?>");
                                    </script>
        <?php } else {
            ?>
                                    <tr id="fase<?php echo $dados->codCaptura; ?>">
                                        <td id="<?php echo $dados->codCaptura; ?>-1"><input type="checkbox" checked="cheked" id="<?php echo $dados->codTomada; ?>" class="<?php echo $dados->codCaptura; ?>" name="fase"  /></td>
                                        <td id="<?php echo $dados->codCaptura; ?>-2"><?php echo $dados->codCaptura; ?></td>
                                        <td id="<?php echo $dados->codCaptura; ?>-3"><?php echo $dados->valorMedio; ?></td>
                                        <td id="<?php echo $dados->codCaptura; ?>-4"><?php echo $dados->eficaz; ?></td>
                                        <td id="<?php echo $dados->codCaptura; ?>-5"><?php echo $dados->codTomada; ?></td>
                                        <td id="<?php echo $dados->codCaptura; ?>-6"><?php echo $dados->dataAtual; ?></td>
                                    </tr>
                                    <?php
                                    $anterior = $dados->codTomada;
                                    $capanterior = $dados->codCaptura;
                                }
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo $this->lang->line('cod_onda_padrao'); ?></th>
                                <th><?php echo $this->lang->line('valor_medio'); ?></th>
                                <th><?php echo $this->lang->line('effective'); ?></th>
                                <th><?php echo $this->lang->line('plug'); ?></th>
                                <th><?php echo $this->lang->line('date'); ?></th>
                                <th><?php echo $this->lang->line('standard'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
<?php if (empty($fasepadrao)) {
    ?>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><input type="checkbox"/></td>
                                </tr>
                                <?php
                            } else {
                                foreach ($fasepadrao as $dados) {
                                    ?>
                                    <tr>
                                        <td><?php echo $dados->codondapadrao; ?></td>
                                        <td><?php echo $dados->valorMedio; ?></td>
                                        <td><?php echo $dados->eficaz; ?></td>
                                        <td><?php echo $dados->codTomada; ?></td>
                                        <td><?php echo $dados->datapadrao; ?></td>
                                        <td><input type="checkbox" checked="cheked" id="<?php echo $dados->codTomada; ?>" class="<?php echo $dados->codondapadrao; ?>" name="fase" /></td>
                                    </tr>
    <?php
    }
}
?>
                        </tbody>
                    </table>
                    <div class="col-md-12 col-xs-12">
                        <div id="faselinha"></div>
                    </div>
                    <div class="col-md-12 col-xs-12">
                        <div id="fasebarra"></div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <h3 class="center"><?php echo $this->lang->line('leakage'); ?></h3>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo $this->lang->line('compare'); ?></th>
                                <th><?php echo $this->lang->line('capture'); ?></th>
                                <th><?php echo $this->lang->line('valor_medio'); ?></th>
                                <th><?php echo $this->lang->line('effective'); ?></th>
                                <th><?php echo $this->lang->line('plug'); ?></th>
                                <th><?php echo $this->lang->line('date'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
<?php if (empty($fuga)) {
    ?>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                </tr>
                                <?php
                            } else {
                                $anterior = 0;
                                foreach ($fuga as $dados) {
                                    if ($anterior == $dados->codTomada) {
                                        ?>
                                        <tr id="fuga<?php echo $dados->codCaptura; ?>">
                                            <td id="<?php echo $dados->codCaptura; ?>-1"><input type="checkbox" id="<?php echo $dados->codTomada; ?>" class="<?php echo $dados->codCaptura; ?>" name="fuga"  /></td>
                                            <td id="<?php echo $dados->codCaptura; ?>-2"><?php echo $dados->codCaptura; ?></td>
                                            <td id="<?php echo $dados->codCaptura; ?>-3"><?php echo $dados->valorMedio; ?></td>
                                            <td id="<?php echo $dados->codCaptura; ?>-4"><?php echo $dados->eficaz; ?></td>
                                            <td id="<?php echo $dados->codCaptura; ?>-5"><?php echo $dados->codTomada; ?></td>
                                            <td id="<?php echo $dados->codCaptura; ?>-6"><?php echo $dados->dataAtual; ?></td>
                                        </tr>
                                    <script type="text/javascript">
                                        $("#fuga<?php echo $dados->codCaptura; ?>").hide();
                                        $("#<?php echo $capanterior; ?>-2").html("<img id='fuga' class='<?php echo $dados->codTomada; ?>' name='maisfuga' src='<?php echo base_url('includes/imagens/mais.jpg') ?>'> <?php echo $capanterior; ?>");
                                    </script>
        <?php } else {
            ?>
                                    <tr id="fuga<?php echo $dados->codCaptura; ?>">
                                        <td id="<?php echo $dados->codCaptura; ?>-1"><input type="checkbox" checked="cheked" id="<?php echo $dados->codTomada; ?>" class="<?php echo $dados->codCaptura; ?>" name="fuga"  /></td>
                                        <td id="<?php echo $dados->codCaptura; ?>-2"><?php echo $dados->codCaptura; ?></td>
                                        <td id="<?php echo $dados->codCaptura; ?>-3"><?php echo $dados->valorMedio; ?></td>
                                        <td id="<?php echo $dados->codCaptura; ?>-4"><?php echo $dados->eficaz; ?></td>
                                        <td id="<?php echo $dados->codCaptura; ?>-5"><?php echo $dados->codTomada; ?></td>
                                        <td id="<?php echo $dados->codCaptura; ?>-6"><?php echo $dados->dataAtual; ?></td>
                                    </tr>
                                    <?php
                                    $anterior = $dados->codTomada;
                                    $capanterior = $dados->codCaptura;
                                }
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo $this->lang->line('cod_onda_padrao'); ?></th>
                                <th><?php echo $this->lang->line('valor_medio'); ?></th>
                                <th><?php echo $this->lang->line('effective'); ?></th>
                                <th><?php echo $this->lang->line('plug'); ?></th>
                                <th><?php echo $this->lang->line('date'); ?></th>
                                <th><?php echo $this->lang->line('standard'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
<?php if (empty($fugapadrao)) {
    ?>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><?php echo $this->lang->line('empty'); ?></td>
                                    <td><input type="checkbox"/></td>
                                </tr>
    <?php
} else {
    foreach ($fugapadrao as $dados) {
        ?>
                                    <tr>
                                        <td><?php echo $dados->codondapadrao; ?></td>
                                        <td><?php echo $dados->valorMedio; ?></td>
                                        <td><?php echo $dados->eficaz; ?></td>
                                        <td><?php echo $dados->codTomada; ?></td>
                                        <td><?php echo $dados->datapadrao; ?></td>
                                        <td><input type="checkbox" checked="cheked" id="<?php echo $dados->codTomada; ?>" class="<?php echo $dados->codondapadrao; ?>" name="fuga"  /></td>
                                    </tr>
    <?php
    }
}
?>
                        </tbody>
                    </table>
                    <div class="col-md-12 col-xs-12">
                        <div id="fugalinha"></div>
                    </div>
                    <div class="col-md-12 col-xs-12">
                        <div id="fugabarra"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        var graficofase = [];
        var graficofuga = [];
        var captura = 0;
        var contfase = 0;
        var contfuga = 0;
        var old = 1;

<?php
//cria gráifcos fase/fuga fasepadrão/fugapadrão
foreach ($fase as $dados) {
    ?>
            captura = "<?php echo $dados->codCaptura; ?>";
            if (old === 1) {
                $.ajax({
                    url: "<?php echo base_url(); ?>" + "index.php/comparar/graficos",
                    dataType: 'json',
                    scriptCharset: 'UTF-8',
                    type: "POST",
                    data: {
                        action: 'checkDados',
                        Captura: captura
                    },
                    success: function (dados) {
                        if (dados) {
                            var chart = $('#fasebarra').highcharts();
                            chart.addSeries({
                                name: "<?php echo $dados->codCaptura; ?>",
                                data: dados.barra
                            });
                            var chart = $('#faselinha').highcharts();
                            chart.addSeries({
                                data: dados.linha
                            });
                        } else
                            alert("Erro Ajax.");
                    }
                });
                graficofase[contfase] = captura;
                contfase = contfase + 1;
                old = 0;
            }
<?php } ?>
        old = 1;
<?php foreach ($fuga as $dados) { ?>
            captura = "<?php echo $dados->codCaptura; ?>";
            if (old === 1) {
                $.ajax({
                    url: "<?php echo base_url(); ?>" + "index.php/comparar/graficos",
                    dataType: 'json',
                    scriptCharset: 'UTF-8',
                    type: "POST",
                    data: {
                        action: 'checkDados',
                        Captura: captura
                    },
                    success: function (dados) {
                        if (dados) {
                            var chart = $('#fugabarra').highcharts();
                            chart.addSeries({
                                name: "<?php echo $dados->codCaptura; ?>",
                                data: dados.barra
                            });
                            var chart = $('#fugalinha').highcharts();
                            chart.addSeries({
                                data: dados.linha
                            });
                        } else
                            alert("Erro Ajax.");
                    }
                });
                graficofuga[contfuga] = captura;
                contfuga = contfuga + 1;
                old = 0;
            }
<?php } ?>
<?php foreach ($fasepadrao as $dados) { ?>
            captura = "<?php echo $dados->codondapadrao; ?>";
            $.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/comparar/graficos",
                dataType: 'json',
                scriptCharset: 'UTF-8',
                type: "POST",
                data: {
                    action: 'checkDados',
                    Captura: captura
                },
                success: function (dados) {
                    if (dados) {
                        var chart = $('#fugabarra').highcharts();
                        chart.addSeries({
                            name: "<?php echo $dados->codondapadrao; ?>",
                            data: dados.barra
                        });
                        var chart = $('#fugalinha').highcharts();
                        chart.addSeries({
                            data: dados.linha
                        });
                    } else
                        alert("Erro Ajax.");
                }
            });
            graficofase[contfase] = captura;
            contfase = contfase + 1;
<?php } ?>
<?php foreach ($fugapadrao as $dados) { ?>
            captura = "<?php echo $dados->codondapadrao; ?>";
            $.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/comparar/graficos",
                dataType: 'json',
                scriptCharset: 'UTF-8',
                type: "POST",
                data: {
                    action: 'checkDados',
                    Captura: captura
                },
                success: function (dados) {
                    if (dados) {
                        var chart = $('#fugabarra').highcharts();
                        chart.addSeries({
                            name: "<?php echo $dados->codondapadrao; ?>",
                            data: dados.barra
                        });
                        var chart = $('#fugalinha').highcharts();
                        chart.addSeries({
                            data: dados.linha
                        });
                    } else
                        alert("Erro Ajax.");
                }
            });
            graficofuga[contfuga] = captura;
            contfuga = contfuga + 1;
<?php } ?>

        // quando um checkbox é clicado
        $('input[type="checkbox"]').click(function () {
            var classe = $(this).attr('class'); //pega a classe do checkbox clicado
            var id = $(this).attr('id'); //pega o id do checkbox clicado
            var nome = $(this).attr('name'); //pega o nome do checkbox clicado
            var checkado = ($("." + classe).is(':checked')); //verifica se o checkbox foi clicado true == sim, false == não
            //if fase true cria gráfico, senão remove o gráfico
            if (nome === "fase") {
                if (checkado === true) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>" + "index.php/comparar/graficos",
                        dataType: 'json',
                        scriptCharset: 'UTF-8',
                        type: "POST",
                        data: {
                            action: 'checkDados',
                            Captura: classe
                        },
                        success: function (dados) {
                            if (dados) {
                                var chart = $('#fasebarra').highcharts();
                                chart.addSeries({
                                    name: classe,
                                    data: dados.barra
                                });
                                var chart = $('#faselinha').highcharts();
                                chart.addSeries({
                                    data: dados.linha
                                });
                            } else
                                alert("Erro Ajax.");
                        }
                    });
                    graficofase[contfase] = classe;
                    contfase = contfase + 1;
                } else {
                    for (var x = 0; x < graficofase.length; x++) {
                        if (graficofase[x] === classe) {
                            var chart = $('#fasebarra').highcharts();
                            if (chart.series.length) {
                                chart.series[x].remove();
                            }
                            var chart = $('#faselinha').highcharts();
                            if (chart.series.length) {
                                chart.series[x].remove();
                            }
                            graficofase.splice(x, 1);
                        }
                    }
                    contfase = --contfase;
                }
            } else {
                if (checkado === true) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>" + "index.php/comparar/graficos",
                        dataType: 'json',
                        scriptCharset: 'UTF-8',
                        type: "POST",
                        data: {
                            action: 'checkDados',
                            Captura: classe
                        },
                        success: function (dados) {
                            if (dados) {
                                var chart = $('#fugabarra').highcharts();
                                chart.addSeries({
                                    name: classe,
                                    data: dados.barra
                                });
                                var chart = $('#fugalinha').highcharts();
                                chart.addSeries({
                                    data: dados.linha
                                });
                            } else
                                alert("Erro Ajax.");
                        }
                    });
                    graficofuga[contfuga] = classe;
                    contfuga = contfuga + 1;
                } else {
                    for (var x = 0; x < graficofuga.length; x++) {
                        if (graficofuga[x] === classe) {
                            var chart = $('#fugabarra').highcharts();
                            if (chart.series.length) {
                                chart.series[x].remove();
                            }
                            var chart = $('#fugalinha').highcharts();
                            if (chart.series.length) {
                                chart.series[x].remove();
                            }
                            graficofuga.splice(x, 1);
                        }
                    }
                    contfuga = --contfuga;

                }
            }
        });
    });
</script>
<script type="text/javascript">
    //quando clica na imagem de mais
    $(document).ready(function () {
        $("img").click(function () {

            var id = $(this).attr('id');
            var classe = $(this).attr('class');
            var nome = $(this).attr('name');
            var sala = "<?php echo $codUsoSala; ?>";

            if (id === "fase") {
                if (nome === "maisfase") {
                    $(this).attr('src', '<?php echo base_url("includes/imagens/menos.jpg") ?>');
                    $(this).attr('name', 'menosfase');
                } else {
                    $(this).attr('src', '<?php echo base_url("includes/imagens/mais.jpg") ?>');
                    $(this).attr('name', 'maisfase');
                }

                $.ajax({
                    url: "<?php echo base_url(); ?>" + "index.php/comparar/atualiza_fase",
                    dataType: 'json',
                    scriptCharset: 'UTF-8',
                    type: "POST",
                    data: {
                        CodEquip: classe,
                        Sala: sala
                    },
                    success: function (dados) {
                        if (dados) {
                            for (var i = 1; i < dados.captura.length; i++) {
                                $("#fase" + dados.captura[i].codCaptura + "").toggle("slow");
                            }
                        } else
                            alert("Erro Ajax.");
                    }
                });

            } else {
                if (nome === "maisfuga") {
                    $(this).attr('src', '<?php echo base_url("includes/imagens/menos.jpg") ?>');
                    $(this).attr('name', 'menosfuga');
                } else {
                    $(this).attr('src', '<?php echo base_url("includes/imagens/mais.jpg") ?>');
                    $(this).attr('name', 'maisfuga');
                }

                $.ajax({
                    url: "<?php echo base_url(); ?>" + "index.php/comparar/atualiza_fuga",
                    dataType: 'json',
                    scriptCharset: 'UTF-8',
                    type: "POST",
                    data: {
                        CodEquip: classe,
                        Sala: sala
                    },
                    success: function (dados) {
                        if (dados) {
                            for (var i = 1; i < dados.captura.length; i++) {
                                $("#fuga" + dados.captura[i].codCaptura + "").toggle("slow");
                            }
                        } else
                            alert("Erro Ajax.");
                    }
                });
            }
        });
    });
</script>
