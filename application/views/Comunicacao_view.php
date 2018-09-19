<div id="teste">
    <?php
      //div para testes
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
                <span class="glyphicon glyphicon-refresh" style="margin-left: 20px; font-size: 20px;" onclick="atualizaTable()"></span>
            </div>
            <div class="col-md-2 col-xs-2" id="divLimitButton">
                <button class="btn btn-info" id="limitWS"><?php echo $this->lang->line('button_send'); ?></button>
            </div>
            <div class="col-md-2 col-xs-2 pull-right" id="divOptionsButtons">

                <!-- <button class="btn btn-success" id="testWS"><?php echo $this->lang->line('test'); ?></button> -->

                <button class="btn btn-primary" id="connectWS"><?php echo $this->lang->line('connect'); ?></button>
                <button class="btn btn-danger" id="resetWS"><?php echo $this->lang->line('reset'); ?></button>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="col-md-12 col-xs-12" id="borda">
        <div class="row">
            <div class="col-md-6 col-xs-6" style="overflow:auto; height: 500px;">
		    <table id="tableComunicacao" class="table table-bordered table-condensed" style="font-size: 12pt; text-align: center; ">
		        <thead>
		            <tr>
		                <th>
		                <div class="dropdown">
		                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		                      <?php echo $this->lang->line('capture'); ?> 
		                      <span class="caret"></span>
		                    </button>
		                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		                        <li onclick="setLimit(10)">10</li>
		                        <li onclick="setLimit(20)">20</li>
		                        <li onclick="setLimit(50)">50</li>
		                    </ul>
		                </div>
		                </th>
		                <th><?php echo $this->lang->line('plug'); ?></th>
		                <th><?php echo $this->lang->line('equipment'); ?></th>
		                <th><?php echo $this->lang->line('effective'); ?></th>
		                <th><?php echo $this->lang->line('date'); ?></th>
		                <th><?php echo $this->lang->line('dangerousness'); ?></th>
		                <th><?php echo $this->lang->line('compare'); ?></th>
		            </tr>
		        </thead>
	        	<tbody id="tbodyComunicacao"></tbody>
		    </table>
            </div>
            <div class="col-md-6 col-xs-6">
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
<script> //pega a baseURL
    function getURL() {
        var baseUrl = location.origin + "/" + window.location.pathname.split('/')[1] + "/";
        return baseUrl;
    }
</script>
<script>
//    var date="21/01/2015";
//    var newdate = date.split("/").reverse().join("-");
    var j = 0, checkClicados = 0, limite = 10;
    var baseUrl = getURL();
    var graficos = [];
    var $table = $('#tableComunicacao');
    window.onload = function () {
        atualizaTable();
    };
    function atualizaTable() {
        $("#tbodyComunicacao").empty();
	if(graficos.length > 0){
            cleanScreen();
        }
        $.ajax({
            type: 'post',
            dataType: 'json', //tipo de retorno
            url: baseUrl + "index.php/Comunicacao/atualizaTable", //arquivo onde serão buscados os dados
            data : { 
                Limit: limite 
            },
            success: function (dados) {
                if (dados) {
                    for(j = 0 ; j < dados.length; j++) {
                        insereLinha(dados[j]);
                    }
                } else { alert("Erro Ajax."); }
            }
        });
    }
    function setLimit(n){
        
        limite = n;
        atualizaTable();
    }
    $("#captureWS").click(function(){
        window.setTimeout(atualizaTable, 500);
    });
    
    function insereLinha(dados) {
        // creates a <tbody> element
        var tblBody = document.getElementById("tbodyComunicacao");
        
        // creating all cells
        var cellText;
        // creates a table row
        var row = document.createElement("tr");
        row.id = "linha" + dados.codCaptura;
        
        if (dados.codEvento === "1"){
            row.className = "fuga";
        }
        if (dados.codEvento === "4"){
            row.className = "fase";
        }
	if (dados.codEvento === "9"){
            row.className = "cExtFase";
        }
	if (dados.codEvento === "10"){
            row.className = "cExtFuga";
        }

        var cell = document.createElement("td");
        cellText = document.createTextNode(dados.codCaptura);
        cell.appendChild(cellText);
        row.appendChild(cell);

        var cell = document.createElement("td");
        cellText = document.createTextNode(dados.codTomada);
        cell.appendChild(cellText);
        row.appendChild(cell);

        var cell = document.createElement("td");
        cellText = document.createTextNode(dados.codEquip);
        cell.appendChild(cellText);
        row.appendChild(cell);

        var cell = document.createElement("td");
        cellText = document.createTextNode(dados.eficaz);
        cell.appendChild(cellText);
        row.appendChild(cell);

        var cell = document.createElement("td");
        cellText = document.createTextNode(dados.dataAtual);
        cell.appendChild(cellText);
        row.appendChild(cell);
        
        var cell = document.createElement("td");
	 if (dados.codEvento === "1" || dados.codEvento === "10"){
        	cell.id = "periculosidade" + dados.codCaptura;
        	var div = document.createElement("div");
        	periculosidade(dados, div);
        	cell.appendChild(div);
	 }
        row.appendChild(cell);

        var cell = document.createElement('input');
        cell.type = "checkbox";
        cell.name = "comparar";
        cell.className = dados.CodEquip;
        cell.id = dados.codCaptura;
        cell.onclick = criaGraficoBarraLinha;
        row.appendChild(cell);
        
        tblBody.appendChild(row, tblBody.firstChild);
    }
    
    function criaGraficoBarraLinha() {
        var id = $(this).attr('id'); //pega o id do checkbox clicado, contendo o código de captura
        var checkadoID = document.getElementById(id).checked; //verifica se o checkbox foi clicado true == sim, false == não

        if (checkadoID === true) { // se checkado == true monta gráfico na área de comparação
            //ajax envia os dados p/ php e no php processa e retornar valores em dados.linha e dados.
            if (checkClicados < 5) {
                graficos[checkClicados] = id;
                $.ajax({
                    url: baseUrl + "index.php/Ultimascapturadas/graficos",
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
                                name: id,
                                data: dados.linha
                            });
                        } else
                            alert("Erro Ajax.");
                    }
                });
                checkClicados++;
            } else {
                alert("Máximo de 5 Equipamentos Atingido");
                $("#" + id).attr("checked", false);
            }
        } else { // senão oculta gráfico do equipamento

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
            --checkClicados;
        }
        //para construir a tabela de similaridade
        if (checkadoID === true) {
            mostraTabelaSimilaridade();
        } else {
            if (checkClicados === 0) {
                document.getElementById("tabelaSimilaridade").deleteRow(1);
            } else {
                mostraTabelaSimilaridade();
            }
        }
    } //OK
    function cleanScreen(){
        if (graficos.length >= 2) document.getElementById("tabelaSimilaridade").deleteRow(1);
        for (var x = checkClicados-1; x >= 0; x--) { 
            var chart = $('#barra').highcharts();
                chart.series[x].remove();
            var chart = $('#linha').highcharts();
                chart.series[x].remove();
            graficos.splice(x, 1);
            document.getElementById("tabelaSimilaridade").deleteRow(x+1);
        }
        checkClicados = 0;
    }
    function deslocaGrafico(cod1, cod2){
        var w = 750, h = 450, url = baseUrl+ "index.php/popup_grafico_deslocada?cod1="+cod1+"&cod2="+cod2, title = "popupGrafico";
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    } //OK
    function periculosidade(dados, div) {
        div.className = "green-circle";
        if (dados.eficaz >= 0.1 && dados.eficaz < 0.5) {
            //atenção
            div.className = "yellow-circle";
        } else if (dados.eficaz >= 0.5) {
            //perigo
            div.className = "red-circle";
        }
    } //OK
</script>
<script>
    
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
                url: "<?php echo base_url(); ?>" + "index.php/Comunicacao/getEquipments",
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
                url: "<?php echo base_url(); ?>" + "index.php/Comunicacao/getOutlets",
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
