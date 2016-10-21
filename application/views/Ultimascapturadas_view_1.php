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
                            <input id="atualiza" onclick="fuga()" type="checkbox" checked="true">&emsp;
                            Visualização
                            &emsp;
                            FFT
                            <input id="fft" onclick="mostraFFT()" type="checkbox" >
                            
                        </p> 
                        <div class="col-md-5" style="overflow:auto; height:300px;">
                            <table id="tableUltimascapturas" class="table table-bordered table-condensed table-striped" style="font-size: 10pt; text-align: center; ">
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
            <div class="row-fluid col-md-12 col-xs-12" id="divMainlinha"> 
                
            </div>
            <div class="row-fluid col-md-12 col-xs-12" id="divMainbarra"> 
                
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
<script type="text/javascript"> //pega os dados do banco e coloca na tabela a cada 3s
    var j = 0, cont = 0, checkClicados = 0, lock = 0, limitGraf = 4, contGraf = 1, atualizando = 0;
    var $table = $('#tableUltimascapturas');
    var graficos = [];
    var baseUrl = getURL();
    window.onload = function () {
        atualizaTable();
    };

    function atualizaTable() {
        $.ajax({
            type: 'post',
            dataType: 'json', //tipo de retorno
            url: baseUrl + "index.php/Ultimascapturadas/atualizaTable", //arquivo onde serão buscados os dados
            success: function (dados) {
                if (dados) {
                    while (j < dados.length) {
                        insereLinha(dados[j]);
                        if (lock === 1){
                            alert("jashkbsjk"+ j);
                            $(".w" + dados[j].codCaptura).prop("checked", true);
                            $(".w" + dados[j-limitGraf].codCaptura).prop("checked", false);
                            geraGraficoPrimeiraLinha(dados[j]);
                            if($("#fft").prop("checked")) insereFFT(dados[j].codCaptura);
                        }
                        j++;
                    }
                    if(lock === 0) {
                        geraGraficoInit(dados);
                        lock = 1;
                    }
                    if(atualizando === 0){
                        window.setTimeout(atualizaTable, 1000);
                    }
                    
                } else {
                    alert("Erro Ajax.");
                }
            }
        });
    }
    
    function geraGraficoInit(dados){
        for(var i = limitGraf; i > 0; i--){
            $(".w" + dados[j-i].codCaptura).prop("checked", true);
            geraGraficoPrimeiraLinha(dados[j-i]);
        }
    }
    
    function mostraFFT(){
        var checkFFT = $("#fft").prop("checked");
        if(checkFFT){
            atualizando = 1;
            window.setTimeout(iniciaFFT, 1000);
            if(!($('#atualiza').prop("checked"))){
                controleAtualizar();
            }
            atualizando = 0;
        } else {
            $('#divMainbarra').empty();
        }
    }
    
    function iniciaFFT() {
        $.ajax({
            url: baseUrl + "index.php/Ultimascapturadas/todasCapturas", //requisita novo gráfico
            dataType: 'json',
            scriptCharset: 'UTF-8',
            type: "POST",
            success: function (dados) {
                if (dados) {
                    for(var i = limitGraf; i >= 1; i--){
                        insereFFT(dados[j-i].codCaptura);
                    }
                } else
                    alert("Erro Ajax.");
            }
        });
    }
    
    function insereFFT(codCaptura){
        var divMain = document.getElementById("divMainbarra");
        var div = document.createElement("div");
        div.id = "container" + codCaptura;
        var divbarra = document.createElement("div");
        divbarra.id = "divbarra" + codCaptura;
        divbarra.className = "col-md-3";
        divbarra.style = "height : 350px";
        div.appendChild(divbarra);
        divMain.insertBefore(div, divMain.firstChild);
        
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
                            marginRight: 10
                        },
                        title: {
                            text: 'Cap ' + codCaptura
                        },
                        series: [{data: dados.barra}]
                    });
                } else
                    alert("Erro Ajax.");
            }
        });
    }
    
    function geraGraficoPrimeiraLinha(dados) {
        var classe = dados.codCaptura;
        
        var divMain = document.getElementById("divMainlinha");
        var div = document.createElement("div");
        div.id = "container" + classe;
        var divlinha = document.createElement("div");
        divlinha.id = "divlinha" + classe;
        divlinha.className = "col-md-3";
        divlinha.style = "height : 350px";
        div.appendChild(divlinha);
        divMain.insertBefore(div, divMain.firstChild);
        
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
                            type: 'line',
                            marginRight: 10
                        },
                        title: {
                            text: 'Cap ' + classe
                        },
                        series: [{data: dados.linha}]
                    });
                } else
                    alert("Erro Ajax.");
            }
        });

        if(contGraf === limitGraf)
            divMain.lastChild.remove();
        else contGraf++;
    }

    function criaGraficoEquipamento() {
        var classeI = $(this).attr('class'); //pega a classe do checkbox clicado, contendo o codigo da captura
        var classe = classeI.substring(1, classeI.length);
        var check = $(".w" + classe).prop("checked");

        if (check) {
            if (document.getElementById('container' + classe) === null) {
                var divMain = document.getElementById("divMainlinha");
                var div = document.createElement("div");
                div.id = "container" + classe;
                var divlinha = document.createElement("div");
                divlinha.id = "divlinha" + classe;
                divlinha.className = "col-md-3";
                divlinha.style = "height : 350px";
                div.appendChild(divlinha);
                divMain.appendChild(div);
            }
            if(document.getElementById('divlinha'+classe) === null){
                var div = document.getElementById('container'+classe);
                var divlinha = document.createElement("div");
                divlinha.id = "divlinha" + classe;
                divlinha.className = "col-md-3";
                divlinha.style = "height : 350px";
                div.appendChild(divlinha);
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
                                type: 'line',
                                marginRight: 10
                            },
                            title: {
                                text: 'Cap ' + classe
                            },
                            series: [{data: dados.linha}]
                        });
                    } else
                        alert("Erro Ajax.");
                }
            });
            if($("#fft").prop("checked")) insereFFT(classe);
        } 
        else {
            $('#container'+classe).remove();
        }
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
    
    function controleAtualizar(){
        if($("#atualiza").prop("checked")){
            atualizando = 0;
            lock = 0;
            $.ajax({        //desmarca todos checkbox
            url: baseUrl + "index.php/Ultimascapturadas/todasCapturas", //requisita novo gráfico
            dataType: 'json',
            scriptCharset: 'UTF-8',
            type: "POST",
            success: function (dados) {
                if (dados) {
                    for(var i = dados.length; i >= 1; i--){
                        $(".w" + dados[i-1].codCaptura).prop("checked",false);
                    }
                } else
                    alert("Erro Ajax.");
                }
            });
            window.setTimeout(atualizaTable, 1000);
        } else {
            atualizando = 1;
        }
    }
    
    function insereLinha(dados) {
        
        // creates a <tbody> element
        var tblBody = document.getElementById("tbodyUltimasCapturas");
        
        // creating all cells
        var cellText;
        // creates a table row
        var row = document.createElement("tr");
        row.id = "linha" + dados.codCaptura;

        var cell = document.createElement('input');
        cell.type = "checkbox";
        cell.name = "equipamentos";
        cell.className = "w" + dados.codCaptura;
//        cell.checked = "false";
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