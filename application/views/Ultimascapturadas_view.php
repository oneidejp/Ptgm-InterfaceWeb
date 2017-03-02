<!--
* 2016  View
* Desenvolvido por: Leonardo Francisco Rauber
* Email: leorauber@hotmail.com - 132789@upf.br
* Projeto de conclusão de curso
* UPF - Ciência da Computação
-->

<br>
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12 col-xs-12" id="centro">
            <div id="aba">
                <div class="row">   <!-- incluir botoes-->
                    <div class="col-md-12 col-xs-12"> 
                        <p style="font-size: 14pt;">
                            <?php echo $this->lang->line('update'); ?>
                            <input id="atualiza" onclick="controleAtualizar()" type="checkbox" checked="true"> &emsp;
                            FASE 
                            <input id="fase" onclick="fase()" type="checkbox" checked="true">&emsp;
                            FUGA
                            <input id="fuga" onclick="fuga()" type="checkbox" checked="true">&emsp;
                            Visualização
                            <input id="visualization" oninput="visualization()" type="number" value="4" style="width:70px;">&emsp;
                            FFT
                            <input id="fft" onclick="mostraFFT()" type="checkbox" >
                            
                        </p> 
<<<<<<< Updated upstream
                        <div class="col-md-5" style="overflow:auto; height:300px;">
                            <table id="tableUltimascapturas" class="table table-bordered table-condensed table-striped" style="font-size: 10pt; text-align: center; ">
=======
                        <div class="col-md-5" style="overflow:auto; height:310px;">
                            <table id="tableUltimascapturas" class="table table-bordered table-condensed" style="font-size: 12pt; text-align: center; ">
>>>>>>> Stashed changes
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('show'); ?></th>
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
                                <tbody id="tbodyUltimasCapturas"></tbody>
                            </table>
                        </div>

                        <div class="col-md-7 col-xs-7">
                            <div id="linha"></div> <!--grafico linha-->
                            <div id="barra"></div> <!--grafico barra-->
                            <div class="col-md-offset-1 col-md-10 col-xs-12">
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
            <div class="row-fluid col-md-12 col-xs-12" id="divMain" style="overflow:auto; height:700px;"> 
                
            </div>
        </div>
    </div>
</div>
<script> //pega a baseURL
    function getURL() {
        var baseUrl = location.origin + "/" + window.location.pathname.split('/')[1] + "/";
        return baseUrl;
    }
</script>
<script type="text/javascript"> //pega os dados do banco e coloca na tabela a cada 1s
    var j = 0, cont = 0, checkClicados = 0, lock = 0, atualizando = 0;
    var firstCap = 0, lastCapture, ultimoCodCaptura, qntLines = 0, limitGraf = 4, contGraf = 1;
    var $table = $('#tableUltimascapturas');
    var graficos = [];
    var baseUrl = getURL();
    window.onload = function () {
        ultimaCaptura();
    };

    function atualizaTable() {
        $.ajax({
            type: 'post',
            dataType: 'json', //tipo de retorno
            url: baseUrl + "index.php/Ultimascapturadas/atualizaTable", //arquivo onde serão buscados os dados
            data: {
                Captura: ultimoCodCaptura
            },
            success: function (dados) {
                if (dados) {
                    dados = dados.slice(0).reverse();
                    j = 0;
                    if (lock === 1 ){
                        var i = 0;
                        while(true){
                            if (lastCapture !== dados[i].codCaptura) j++;
                            else {
                                j++;
                                break;   
                            }
                            i++;
                        }// alert(lastCapture + " valor lastCapture antes");
                    }// alert(j + " valor do j " + dados.length + " tamanho do dados");
                    while (j < dados.length) {
                        if (lock === 1){
                            insereLinha(dados[j]);
                            $(".w" + dados[j].codCaptura).prop("checked", true);
                            $(".w" + dados[j-limitGraf].codCaptura).prop("checked", false);
                            geraGraficoPrimeiraLinha(dados[j].codCaptura, 0);
                        }else {
                            insereLinha(dados[j]);
                        }
                        j++;
                        lastCapture = dados[j-1].codCaptura;
                    }// alert(lastCapture + " valor lastCapture depois");
                    if(lock === 0) {
                        geraGraficoInit();
                        lock = 1;
                    }
                    if(dados.length > 11){
                        ultimoCodCaptura = dados[j-11].codCaptura;
                    }
                    if(atualizando === 0){
                        window.setTimeout(atualizaTable, 1000);
                    }
                } 
                else {
                    alert("Erro Ajax.");
                }
            }
        });
    }

    function geraGraficoInit(){
        for(var i = limitGraf-1; i >= 0; i--){
//            if ($(".linha"+(qntLines-i)).prop("style") === "display: none") alert("aaaa");
            $("#checkboxequip" + (qntLines - i)).prop("checked", true);
            var captura = $("#checkboxequip" + (qntLines - i)).attr("class");
            var cap = captura.substring(1 , captura.length);
            geraGraficoPrimeiraLinha(cap, 0);
        }
    }
   
    function geraGraficoPrimeiraLinha(codCaptura, f) {
        var classe = codCaptura;
        
        if (f === 0){
            var divMain = document.getElementById("divMain");
            var div = document.createElement("div");
            div.id = "container" + classe;
            div.className = "col-md-3";
            var divlinha = document.createElement("div");
            divlinha.id = "divlinha" + classe;
            divlinha.className = "divlinha";
            divlinha.style = "height : 350px";
            div.appendChild(divlinha);
            divMain.insertBefore(div, divMain.firstChild);
        }   
        if (f === 1){
            var divMain = document.getElementById("divMain");
            var div = document.createElement("div");
            div.id = "container" + classe;
            div.className = "col-md-3";
            var divlinha = document.createElement("div");
            divlinha.id = "divlinha" + classe;
            divlinha.className = "divlinha";
            divlinha.style = "height : 350px";
            div.appendChild(divlinha);
            divMain.appendChild(div);
        }
        
        var $divCont = $('#divlinha' + classe);
        $.ajax({
            url: baseUrl + "index.php/Ultimascapturadas/linha", //requisita novo gráfico
            dataType: 'json',
            scriptCharset: 'UTF-8',
            type: "POST",
            data: {
                Captura: classe
            },
            success: function (dados) {
                if (dados) {
                    $divCont.highcharts({                    
                        chart: {
                            type: 'spline',
                            spacingBottom: 0,
                        },
                        legend: {
                            enabled: false
                        },
                        title: {
                            text: 'Cap ' + classe
                        },
                                credits: {
                            enabled: false
                        },
                        xAxis: {
                            title:{
                                text: 'Tempo/100 (ms)'
                            },
                            labels: {
                                rotation: -45,
                                style: {
                                    fontSize: '8px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                            },
                            tickPositions: [0,104,201, 305, 403,501,605,703,800,904,1002,1100,1204,1302,1406,1503,1601]
                        },
                        yAxis: {
                            title: {
                                text: 'Corrente (mA)'
                            },
                        },
                        series: [{data: dados.linha}]
                    });
                } else
                    alert("Erro Ajax.");
            }
        });
        
        if($("#fft").prop("checked")) 
            insereFFT(classe);
        if (f === 0){
            if(contGraf === limitGraf) {
                $(divMain.lastChild).remove();
            }    
            else contGraf++;
        }
        
    }

    function criaGraficoEquipamento() {
        var classeI = $(this).attr('class'); //pega a classe do checkbox clicado, contendo o codigo da captura
        var classe = classeI.substring(1, classeI.length);
        var check = $(".w" + classe).prop("checked");

        if (check) {
            geraGraficoPrimeiraLinha(classe, 1);
        } 
        else {
            $('#container'+classe).remove();
        }
    }
    
    function controleAtualizar(){
        if($("#atualiza").prop("checked")){
            atualizando = 0;
            lock = 0;
            for(var i = qntLines; i >= 0; i--){
                $('#checkboxequip'+i).prop("disabled",true);
                $('#checkboxequip'+i).prop("checked", false);
            }
            $("#divMain").empty();
            contGraf = 0;
            atualizaTable();
        } else {
            for(var i = qntLines; i >= 0; i--){
                $('#checkboxequip'+i).prop("disabled",false);
            }
            atualizando = 1;
        }
    }
    
    function insereLinha(dados) {
        qntLines++;//acrescenta uma linha
        // creates a <tbody> element
        var tblBody = document.getElementById("tbodyUltimasCapturas");
        
        // creating all cells
        var cellText;
        // creates a table row
        var row = document.createElement("tr");
        row.id = "linha" + dados.codCaptura;
        row.className = "linha"+qntLines;
        
        if (dados.codEvento === "1"){
            row.className = "fuga";
        }
        if (dados.codEvento === "4"){
            row.className = "fase";
        }
//        if(dados.tipoOnda === 1){ row.className = "fuga"; } else { row.className = "fase"; }

        var cell = document.createElement('input');
        cell.type = "checkbox";
        cell.className = "w" + dados.codCaptura;
        cell.disabled = "true";
//        cell.id = "checkboxequip"+qntLines;
        cell.id = "checkboxequip"+qntLines;
        cell.onclick = criaGraficoEquipamento;
        row.appendChild(cell);

        var cell = document.createElement("td");
        cellText = document.createTextNode(dados.codCaptura);
        cell.appendChild(cellText);
        row.appendChild(cell);

        var cell = document.createElement("td");
        cellText = document.createTextNode(dados.CodTomada);
        cell.appendChild(cellText);
        row.appendChild(cell);

        var cell = document.createElement("td");
        cellText = document.createTextNode(dados.CodEquip);
        cell.appendChild(cellText);
        row.appendChild(cell);

        var cell = document.createElement("td");
        cellText = document.createTextNode(dados.eficaz);
        cell.appendChild(cellText);
        row.appendChild(cell);

        var cell = document.createElement("td");
        cellText = document.createTextNode(dados.tempoUso);
        cell.appendChild(cellText);
        row.appendChild(cell);

        var cell = document.createElement("td");
        cellText = document.createTextNode(dados.dataAtual);
        cell.appendChild(cellText);
        row.appendChild(cell);
        
        var cell = document.createElement("td");
        cell.id = "periculosidade" + dados.codCaptura;
        var div = document.createElement("div");
        periculosidade(dados, div);
        cell.appendChild(div);
        row.appendChild(cell);

        var cell = document.createElement('input');
        cell.type = "checkbox";
        cell.name = "comparar";
        cell.className = dados.CodEquip;
        cell.id = dados.codCaptura;
        cell.onclick = criaGraficoBarraLinha;
        row.appendChild(cell);
        
        tblBody.insertBefore(row, tblBody.firstChild);
    }
    
    function ultimaCaptura() {
        $.ajax({
            type: 'post',
            dataType: 'json', //tipo de retorno
            url: baseUrl + "index.php/Ultimascapturadas/ultimaCaptura", //arquivo onde serão buscados os dados
            success: function (dados) {
                if (dados) {
                    if(dados[0].codCaptura < 100){
                        ultimoCodCaptura = 0;
                    } else {if (dados[0].codCaptura < 200){
                                ultimoCodCaptura = dados[0].codCaptura/2;
                            } else {
                                ultimoCodCaptura = dados[0].codCaptura-100;
                            }
                    }   
                    alert("Captura inicial para a pesquisa no Banco " + ultimoCodCaptura);
                    firstCap = ultimoCodCaptura;
                    atualizaTable();
                } else {
                    alert("Erro Ajax.");
                }
            }
        });
    }

    function mostraFFT(){
        var checkFFT = $("#fft").prop("checked");
        if(checkFFT){
            atualizando = 1;
            window.setTimeout(iniciaFFT, 1000);
            if(!($('#atualiza').prop("checked"))){
                window.setTimeout(controleAtualizar, 2000);
            }
            atualizando = 0;
        } else {
            $('.divbarra').remove();
        }
    }
    
    function iniciaFFT() {
        for(var i = lastCapture; i >= firstCap; i--){
            if($(".w"+i).prop("checked"))
                insereFFT(i);
        }
    }
    
    function insereFFT(codCaptura){
        var div = document.getElementById("container"+codCaptura);
        var divbarra = document.createElement("div");
        divbarra.id = "divbarra" + codCaptura;
        divbarra.name = "divbarra";
        divbarra.className = "divbarra";
        divbarra.style = "height : 350px";
        div.appendChild(divbarra);
        
        var $divCont = $('#divbarra' + codCaptura);

        $.ajax({
            url: baseUrl + "index.php/Ultimascapturadas/barra", //requisita novo gráfico
            dataType: 'json',
            scriptCharset: 'UTF-8',
            type: "POST",
            data: {
                Captura: codCaptura
            },
            success: function (dados) {
                if (dados) {
                    $divCont.highcharts({
                        chart: {
                            type: 'column',
                            spacingBottom: 0,
                        },
                        title: {
                            text: 'Cap ' + codCaptura
                        },
                        credits: {
                            enabled: false
                        },
                        xAxis: {
                            categories: ['DC', '60', '120', '180', '240', '300', '360', '420', '480', '540', '600', '660', '720'],
                            title: {
                                text: 'Frequencias (Hz)'
                            },
                            labels: {
                                rotation: -45,
                                style: {
                                    fontSize: '8px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                            }
                        },
                        yAxis: {
                            title: {
                                text: 'Módulo Normalizado (mA)'
                            }
                        },
                        tooltip: {
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{data: dados.barra}]
                    });
                } else
                    alert("Erro Ajax.");
            }
        });
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
       
    function visualization(){
        var valor = document.getElementById("visualization").value;
        if (valor >= 2 && valor <= 8){
            limitGraf = document.getElementById("visualization").value;
            atualizando = 1;
                for(var i = qntLines; i >= 0; i--){
                    $('#checkboxequip'+i).prop("checked", false);
                }
            $("#divMain").empty();
            contGraf = 0;
            geraGraficoInit();
            atualizando = 0;
        } else{
            alert("Permitido valores entre 2 e 8");
            document.getElementById("visualization").value = limitGraf;
        }//alert(limitGraf);
    }
     
    function fase(){
//        alert("implementar graficos embaixo apenas de fase");
        if ($("#fase").prop("checked")){
            $(".fase").prop("style", "background-color: #DDFFDD;");
        }else {
            if ($("#fuga").prop("checked")){
                $(".fase").prop("style", "display: none;");
            } else {
                alert("Deve deixar 1 selecionado.");
                $("#fase").prop("checked", true);
            }
            
        }
    }
    
    function fuga(){
//        alert("implementar graficos embaixo apenas de fuga");
        if ($("#fuga").prop("checked")){
            $(".fuga").prop("style", "background-color: #FFDDDD;");
        }else {
            if ($("#fase").prop("checked")){
                $(".fuga").prop("style", "display: none;");
            } else {
                alert("Deve deixar 1 selecionado.");
                $("#fuga").prop("checked", true);
            }
        }
    }
    
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
    function mostraTabelaSimilaridade() {

        var baseUrl = getURL();
        //pega os checkboxes clicados em um array, a ordenação não é por clique e sim por leitura dos clicados, de cima para baixo
        var checkboxSelecionados = [];
        $('#aba input[name="comparar"]:checked').each(function () {
            checkboxSelecionados.push($(this).attr('id'));
        });
        //envia por post um json contendo os códigos de capturas dos checkboxes
        //recebendo o retorno da tabela preenchida
        $.ajax({
            url: baseUrl + "index.php/Ultimascapturadas/tabelaSimilaridade",
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

    function insereTabela() {
        //função para inserir novas capturas na tabela
        var tabela = document.getElementById("tbodyTabelaDados");
        var indice = 0;
        for (var i = 1; i < tabela.rows.length; i++) {
            if (tabela.rows[i].cells[3].innerText === "2 - Equipamento na tomada 2") {
                indice = i + 1;
                break;
            }
        }
        //insere <tr>
        var row = tabela.insertRow(indice);
        //insere <td>
        var celula = row.insertCell(0);
        //comteúdo do <td>
        celula.innerHTML = "Inserido";
        //document.getElementById("divTeste").innerHTML = indice;

    }
</script>