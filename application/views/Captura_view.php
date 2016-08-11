<div id="teste"><?php
    if (isset($telnet)) {
        //echo "<b>Resultado do Comando Telnet: </b>" . $telnet;
    }
    if (isset($teste)) {
        /* foreach ($teste as $dados) {
          echo "Tomada: ";
          echo $dados->codTomada;
          echo "\nDescrição: ";
          echo $dados->desc;
          }
         * */
        //echo $teste;
    }
    ?>
</div>
<div class="container-fluid">
    <div class="col-md-12 col-xs-12"  style="margin-bottom: 10px;">
        <div class="row" id="borda">
            <form name="captureForm" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-md-2 col-xs-2 form-group">
                        <select class="form-control" id="modulesForm" name="modulesForm">
                            <option value="choose"><?php echo $this->lang->line('select_module'); ?></option>
                            <?php
                            foreach ($modules as $dados) {
                                echo "\t\t\t\t\t\t<option value={$dados->idmodulo} ip={$dados->ip}>";
                                echo $dados->desc;
                                echo "</option>\n";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2 col-xs-2 form-group">
                        <select class="form-control" id="outletsForm" name="outletsForm" style="display:none;">
                            <option value="choose"><?php echo $this->lang->line('select_outlet'); ?></option>
                        </select>
                    </div>
                    <div class="col-md-2 col-xs-2 form-group">
                        <select class="form-control" id="channelForm" name="channelForm" style="display:none;">
                            <option value="choose"><?php echo $this->lang->line('select_channel'); ?></option>
                            <option value="p"><?php echo $this->lang->line('phase'); ?></option>
                            <option value="d"><?php echo $this->lang->line('leakage'); ?></option>
                        </select>
                    </div>
                    <!--<div class="col-md-2 col-xs-2">
                        <button type="submit" name="captureTelnet" class="btn btn-success">Cap Telnet</button>
                    </div>-->
                </div>
            </form>
            <div class="col-md-6 col-xs-6" id="buttons" style="display:none;">
                <button class="btn btn-info" id="mensagemWS">Capturar</button>
                <button class="btn btn-success" id="mensagemWSHelp">Help</button>
                <button class="btn btn-primary" id="conectarWS">ConectarWS</button>
                <button class="btn btn-warning" id="desconectarWS">DesconectarWS</button>
                <button class="btn btn-danger" id="reiniciarMBED">Reiniciar MBED</button>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="col-md-12 col-xs-12" id="borda">
        <div class="row">
            <div class="col-md-5 col-xs-5">
                <table class="table table-striped table-bordered detalhes" id="tabelaCapturas">
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('capture'); ?></th>
                            <th><?php echo $this->lang->line('plug'); ?></th>
                            <th><?php echo $this->lang->line('equipment'); ?></th>
                            <th><?php echo $this->lang->line('effective'); ?></th>
                            <th><?php echo $this->lang->line('use'); ?></th>
                            <th><?php echo $this->lang->line('date'); ?></th>
                            <th><?php echo $this->lang->line('dangerousness'); ?></th>
                            <th><?php echo $this->lang->line('compare'); ?></th>
                        </tr>
                    </thead>
                    <tbody id="tbodyTabelaCapturas">
                        <?php
                        if (empty($capturas)) {
                            ?>
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
                            $ind = 0;
                            foreach ($capturas as $dados) {
                                ?>
                                <tr id="linha<?php echo $dados->codCaptura; ?>">
                                    <td id="<?php echo $dados->codCaptura; ?>-2"><?php echo $dados->codCaptura; ?></td>
                                    <td id="<?php echo $dados->codCaptura; ?>-3"><?php echo $dados->codTomada; ?></td>
                                    <td id="<?php echo $dados->codCaptura; ?>-4"><?php echo $dados->codEquip; ?></a></td>
                                    <td id="<?php echo $dados->codCaptura; ?>-5"><?php echo substr($dados->eficaz, 0, 6); ?></td>
                                    <td id="<?php echo $dados->codCaptura; ?>-6"><?php echo "" ?></td>
                                    <td id="<?php echo $dados->codCaptura; ?>-7"><?php echo date('d/m/Y H:m:s', strtotime($dados->dataAtual)); ?></td>
                                    <td id="<?php echo $dados->codCaptura; ?>-9"><div class="<?php
                                        if ($periculosidade[$ind] === 0) {
                                            echo "green-circle";
                                        } elseif ($periculosidade[$ind] === 1) {
                                            echo "yellow-circle";
                                        } elseif ($periculosidade[$ind] === 2) {
                                            echo "red-circle";
                                        } else {
                                            echo "";
                                        }
                                        ?>"></div></td>
                                    <td id="<?php echo $dados->codCaptura; ?>-8"><input type="checkbox" id="<?php echo $dados->codCaptura; ?>" name="comparar"/></td>
                                </tr>
                                <?php
                                $ind += 1;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-7 col-xs-7">
                <div id="linha"></div>
                <div id="barra"></div>
                <div class="col-md-offset-1 col-md-10 col-xs-10">
                    <table class='table table-striped table-bordered' id="tabelaSimilaridade">
                        <thead>
                            <tr>
                                <th><?php echo $this->lang->line('capture_code'); ?></th>
                                <th colspan="5"><?php echo $this->lang->line('similarity'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="tbodyTabelaSimilaridade"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#modulesForm").change(function () {
            getOutlets($("#modulesForm").val());
        });
        $("#outletsForm").change(function () {
            showChannel($("#outletsForm").val());
        });
        $("#channelForm").change(function () {
            showCaptureOptions($("#channelForm").val());
        });
    });
</script>
<script>
    $(document).ready(function () {
        var cont = 0, checkClicados = 0;
        var graficos = [];
        $('input[type="checkbox"]').click(function () {
            var id = $(this).attr('id'); //pega o id do checkbox clicado, contendo o código de captura
            var nome = $(this).attr('name'); //pega o nome do checkbox clicado, informando se é checkbox do equipamento ou do comparar
            // se fone comparar coluna comparar
            if (nome === "comparar") {
                checkadoID = ($("#" + id).is(":checked")); //verifica se o checkbox foi clicado true == sim, false == não
                if (checkadoID === true) { // se checkado == true monta gráfico na área de comparação
                    ++checkClicados;
                    //ajax envia os dados p/ php e no php processa e retornar valores em dados.linha e dados.barra
                    if (cont < 5) {
                        graficos[cont] = id;
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "index.php/detalhes/graficos",
                            dataType: 'json',
                            scriptCharset: 'UTF-8',
                            type: "POST",
                            data: {
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
                                    alert("Erro Ajax.");
                            }
                        });
                    } else {
                        alert("Máximo de 5 Equipamentos Atingido");
                        $("#" + id).attr("checked", false);
                    }
                } else { // senão oculta gráfico do equipamento
                    --checkClicados;
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
                //para construir a tabela de similaridade
                if (checkadoID === true) {
                    mostraTabelaSimilaridade();
                } else {
                    if (checkClicados === 0) {
                        document.getElementById("tabelaSimilaridade").deleteRow(1);
                        //document.getElementById("tabelaSimilaridade").deleteRow(1);
                    } else {
                        mostraTabelaSimilaridade();
                    }
                }
            }
        });
    });
</script>
<script>
    function showCaptureOptions(channel) {
        if (channel === "choose") {
            document.getElementById("buttons").style.display = "none";
        } else {
            document.getElementById("buttons").style.display = "block";
        }
    }
    function showChannel(outlet) {
        document.getElementById("channelForm")[0].selected = true;
        document.getElementById("buttons").style.display = "none";
        if (outlet === "choose") {
            document.getElementById("channelForm").style.display = "none";
            document.getElementById("buttons").style.display = "none";
        } else {
            document.getElementById("channelForm").style.display = "block";
        }
    }
    function getOutlets(module) {
        var selectTomadasForm = document.getElementById("outletsForm");
        for (var i = selectTomadasForm.options.length - 1; i > 0; i--)
        {
            selectTomadasForm.remove(i);
        }
        document.getElementById("channelForm")[0].selected = true;
        document.getElementById("channelForm").style.display = "none";
        document.getElementById("buttons").style.display = "none";
        if (module === "choose") {
            document.getElementById("outletsForm").style.display = "none";
        } else {
            document.getElementById("outletsForm").style.display = "block";
            //ajax para preencher o select
            $.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/Captura/getOutlets",
                dataType: 'json',
                scriptCharset: 'UTF-8',
                type: "POST",
                data: {
                    Modulo: module
                },
                success: function (dados) {
                    if (dados) {
                        var select = document.getElementById("outletsForm");
                        var selectTomadasForm;
                        for (var i = 0; i < dados.length; i++) {
                            selectTomadasForm = document.createElement("option");
                            selectTomadasForm.value = dados[i].codTomada;
                            //selectTomadasForm.textContent = dados[i].desc;
                            selectTomadasForm.innerHTML = dados[i].desc;
                            select.appendChild(selectTomadasForm);
                        }
                    } else {
                        alert("Erro Ajax.");
                    }
                }
            });
        }
    }
    function mostraTabelaSimilaridade() {
        //pega os checkboxes clicados em um array, a ordenação não é por clique e sim por leitura dos clicados, de cima para baixo
        var checkboxSelecionados = [];
        $('#borda input[name="comparar"]:checked').each(function () {
            checkboxSelecionados.push($(this).attr('id'));
        });
        //envia por post um json contendo os códigos de capturas dos checkboxes
        //recebendo o retorno da tabela preenchida
        $.ajax({
            url: "<?php echo base_url(); ?>" + "index.php/detalhes/tabelaSimilaridade",
            dataType: 'json',
            scriptCharset: 'UTF-8',
            type: "POST",
            data: {
                Check: checkboxSelecionados
            },
            success: function (dados) {
                if (dados) {
                    HTML = dados;
                    //insere na tabela os dados calculados
                    document.getElementById("tbodyTabelaSimilaridade").innerHTML = HTML;
                } else {
                    alert("Erro Ajax.");
                }
            }
        });
    }
</script>
