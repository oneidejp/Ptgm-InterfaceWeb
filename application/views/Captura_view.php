<div id="teste">
    <?php
    if (isset($telnet)) {
        echo "<b>Resultado do Comando Telnet: </b>" . $telnet;
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
                    <div class="col-md-2 col-xs-2 form-group" id="divModules">
                        <select class="form-control" id="modulesForm">
                            <option value="choose"><?php echo $this->lang->line('select_module'); ?></option>
                            <?php
                            foreach ($modules as $dados) {
                                echo "\t\t\t\t\t\t<option value={$dados->idModulo} ip={$dados->ip}>";
                                echo $dados->desc;
                                echo "</option>\n";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2 col-xs-2 form-group" id="divCommands">
                        <select class="form-control" id="commandsForm">
                            <option value="choose"><?php echo $this->lang->line('select_command'); ?></option>
                            <option value="capture"><?php echo $this->lang->line('select_command_capture'); ?></option>
                            <option value="limit"><?php echo $this->lang->line('select_limit'); ?></option>
                        </select>
                    </div>
                    <div class="col-md-2 col-xs-2 form-group" id="divEquipment">
                        <select class="form-control" id="equipmentsForm">
                            <option value="choose"><?php echo $this->lang->line('select_equipment'); ?></option>
                        </select>
                    </div>
                    <div class="col-md-2 col-xs-2 form-group" id="divOutlets">
                        <select class="form-control" id="outletsForm">
                            <option value="choose"><?php echo $this->lang->line('select_outlet'); ?></option>
                        </select>
                    </div>
                    <div class="col-md-2 col-xs-2 form-group" id="divChannel">
                        <select class="form-control" id="channelForm">
                            <option value="choose"><?php echo $this->lang->line('select_channel'); ?></option>
                            <option value="p"><?php echo $this->lang->line('phase'); ?></option>
                            <option value="d"><?php echo $this->lang->line('leakage'); ?></option>
                        </select>
                    </div>
                </div>
            </form>
            <div class="col-md-2 col-xs-2" id="divCaptureButton">
                <button class="btn btn-info" id="captureWS"><?php echo $this->lang->line('select_command_capture'); ?></button>
            </div>
            <div class="col-md-2 col-xs-2" id="divLimitButton">
                <button class="btn btn-info" id="limitWS"><?php echo $this->lang->line('button_send'); ?></button>
            </div>
            <div class="col-md-2 col-xs-2 pull-right" id="divOptionsButtons">
                <!--
                <button class="btn btn-success" id="testWS"><?php echo $this->lang->line('test'); ?></button>
                -->
                <button class="btn btn-primary" id="connectWS"><?php echo $this->lang->line('connect'); ?></button>
                <button class="btn btn-danger" id="resetWS"><?php echo $this->lang->line('reset'); ?></button>
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
        //função para simular clique no botão capturar
        //var ws = setInterval(testClickWS,5000);
        //função para simular clique no botão capturar
        //var telnet = setInterval(testClickTelnet,3000);

        //oculta as divs
        $('#divCommands').hide();
        $('#divEquipment').hide();
        $('#divOutlets').hide();
        $('#divChannel').hide();
        $('#divCaptureButton').hide();
        $('#divLimitButton').hide();
        $('#divOptionsButtons').hide();

        //analisa a mudança nos selects
        $("#modulesForm").change(function () {
            showCommands($("#modulesForm").val());
        });
        $("#commandsForm").change(function () {
            showCommandOption($("#commandsForm").val());
        });
        $("#equipmentsForm").change(function () {
            getOutlets($("#equipmentsForm").val(), $("#modulesForm").val());
        });
        $("#outletsForm").change(function () {
            showButton($("#outletsForm").val(), $("#commandsForm").val());
        });
        $("#channelForm").change(function () {
            showCaptureButton($("#channelForm").val());
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
    function testClickWS() {
        $("#mensagemWS").click();
    }
    function testClickTelnet() {
        var moduloRandTelnet = ["192.168.1.101", "192.168.1.102"];
        var channelRandTelnet = ["p", "d"];
        var moduloTelnet = moduloRandTelnet[Math.floor((Math.random() * 2) + 1) - 1];
        var channelTelnet = channelRandTelnet[Math.floor((Math.random() * 2) + 1) - 1];
        var outlet = Math.floor((Math.random() * 3) + 4);
        $.ajax({
            url: "<?php echo base_url(); ?>" + "index.php/captura/testTelnet",
            dataType: 'json',
            scriptCharset: 'UTF-8',
            type: "POST",
            data: {
                Host: moduloTelnet,
                Channel: channelTelnet,
                Outlet: outlet
            },
            success: function (dados) {
                if (dados) {
                    //alert(dados);
                } else {
                    alert("Erro Ajax.");
                }
            }
        });
    }
    function showCommands(command) {
        $('#commandsForm').val("choose");
        $('#divCommands').hide();
        $('#equipmentsForm').val("choose");
        $('#divEquipment').hide();
        $('#outletsForm').val("choose");
        $('#divOutlets').hide();
        $('#channelForm').val("choose");
        $('#divChannel').hide();
        $('#divCaptureButton').hide();
        $('#divLimitButton').hide();
        $('#divOptionsButtons').hide();

        if (command !== "choose") {
            $('#divCommands').show();
            $('#divOptionsButtons').show();
        }
    }
    function showCommandOption(command) {
        $('#equipmentsForm').val("choose");
        $('#divEquipment').hide();
        $('#outletsForm').val("choose");
        $('#divOutlets').hide();
        $('#channelForm').val("choose");
        $('#divChannel').hide();
        $('#divCaptureButton').hide();
        $('#divLimitButton').hide();
        if (command === "capture") {
            getOutlets(command, $("#modulesForm").val());
        }
        if (command === "limit") {
            $('#divEquipment').show();
            var selectEquipmentForm = document.getElementById("equipmentsForm");
            for (var i = selectEquipmentForm.options.length - 1; i > 0; i--)
            {
                selectEquipmentForm.remove(i);
            }
            //ajax para preencher o select dos equipamentos
            $.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/Captura/getEquipments",
                dataType: 'json',
                scriptCharset: 'UTF-8',
                type: "POST",
                success: function (dados) {
                    if (dados) {
                        var select = document.getElementById("equipmentsForm");
                        var selectEquipmentForm;
                        for (var i = 0; i < dados.length; i++) {
                            selectEquipmentForm = document.createElement("option");
                            selectEquipmentForm.value = dados[i].codEquip;
                            selectEquipmentForm.innerHTML = dados[i].desc;
                            select.appendChild(selectEquipmentForm);
                        }
                    } else {
                        alert("Erro Ajax ao criar o selecr dos equipamentos.");
                    }
                }
            });
        }
    }
    function getOutlets(command, module) {
        $('#outletsForm').val("choose");
        $('#divOutlets').hide();
        $('#channelForm').val("choose");
        $('#divChannel').hide();
        $('#divCaptureButton').hide();
        $('#divLimitButton').hide();
        if (command !== "choose") {
            $('#divOutlets').show();
            var selectOutletForm = document.getElementById("outletsForm");
            for (var i = selectOutletForm.options.length - 1; i > 0; i--)
            {
                selectOutletForm.remove(i);
            }
            //ajax para preencher o select das tomadas
            $.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/Captura/getOutlets",
                dataType: 'json',
                scriptCharset: 'UTF-8',
                type: "POST",
                data: {
                    Module: module
                },
                success: function (dados) {
                    if (dados) {
                        var select = document.getElementById("outletsForm");
                        var selectOutletForm;
                        for (var i = 0; i < dados.length; i++) {
                            selectOutletForm = document.createElement("option");
                            selectOutletForm.value = dados[i].codTomada;
                            selectOutletForm.innerHTML = dados[i].desc;
                            select.appendChild(selectOutletForm);
                        }
                    } else {
                        alert("Erro Ajax ao criar o selec das tomadas.");
                    }
                }
            });
        }
    }
    function showButton(outlet, command) {
        $('#channelForm').val("choose");
        $('#divChannel').hide();
        $('#divCaptureButton').hide();
        $('#divLimitButton').hide();
        if (outlet !== "choose") {
            if (command === "capture") {
                $('#divChannel').show();
            }
            if (command === "limit") {
                $('#divLimitButton').show();
            }
        }
    }
    function showCaptureButton(command) {
        $('#divCaptureButton').hide();
        if (command !== "choose") {
            $('#divCaptureButton').show();
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
