<!--
* 2017  View
* Desenvolvido por: Leonardo Francisco Rauber
* Email: leorauber@hotmail.com - 132789@upf.br
* Projeto de conclusão de curso
* UPF - Ciência da Computação
-->
<div class="container-fluid">

    <div class="row">
        <div class="col-xs-12" id="centro">
            <div id="aba">
                <div class="row"> <br>
                    <div class="col-xs-12">
                        <div class="col-xs-6" style="overflow:auto; height: 500px;">
                           
			    <div id="divBottons" style="font-size: 20px;">
                                Limit
                                <input type="checkbox" id="checkboxLimit" checked="true" onclick="setlimit()"> 
                                <input type="number" id="limit" value="0" min="0" max="10000" disabled="true">
                                <input type="button" id="buttonSearch" value="Search" onclick="deleteBottons()">
                            </div>
                            <table id="tableDetalhes" class="table table-bordered table-condensed" style="font-size: 10pt; text-align: center; ">
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
                                <tbody id="tbodyTableDetalhes1"></tbody>
                                <tbody id="tbodyTableDetalhes2"></tbody>
                                <tbody id="tbodyTableDetalhes3"></tbody>
                                <tbody id="tbodyTableDetalhes4"></tbody>
                                <tbody id="tbodyTableDetalhes5"></tbody>
                                <tbody id="tbodyTableDetalhes6"></tbody>
                                <tbody id="tbodyTableDetalhes7"></tbody>
                                <tbody id="tbodyTableDetalhes8"></tbody>
                                <tbody id="tbodyTableDetalhes9"></tbody>
                                <tbody id="tbodyTableDetalhes10"></tbody>
                                <tbody id="tbodyTableDetalhes11"></tbody>
                                <tbody id="tbodyTableDetalhes12"></tbody>
                            </table>
                        </div>

                        <div class="col-xs-6">
                            <div id="linha"></div> <!--grafico linha-->
                            <div id="barra"></div> <!--grafico barra-->
                            <div class="col-xs-12">
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
            <div class="row-fluid col-md-12 col-xs-12" id="divMain"> 
                <div id="container1"></div> 
                <div id="container2"></div> 
                <div id="container3"></div> 
                <div id="container4"></div> 
                <div id="container5"></div> 
                <div id="container6"></div> 
                <div id="container7"></div> 
                <div id="container8"></div> 
                <div id="container9"></div> 
                <div id="container10"></div> 
                <div id="container11"></div> 
                <div id="container12"></div> 
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
<script type="text/javascript"> 
    var j = 0;
    var $table = $('#tableDetalhes');
    var graficos = [];
    var baseUrl = getURL();
    var cont = 0, checkClicados = 0, ultimaCaptura = 0, limit = 0;
    window.onload = function () {
        insereDadosNoArray();
    };
    
    //alert("configurar a pesquisa no banco para pegar somente o usosala");
    var vetUltimaCaptura = new Array(101), 
                vetEquip = new Array(101),
             equipMostra = new Array(101);
    //equipMostra = 0 a tabela ta oculta, = 1 ta mostrando
    
    
    function insertRow() {
        var sala = window.location.pathname.split('/')[5]; // pega o cod da sala
        $.ajax({
            type: 'post',
            dataType: 'json', //tipo de retorno
            url: baseUrl + "index.php/detalhes/criarTabela", //arquivo onde serão buscados os dados
            data: {
                Sala: sala,
                UltimaCaptura: ultimaCaptura,
                Limit: limit
            },
            success: function (dados) {
                if (dados) {
                    dados = dados.slice(0).reverse();
                    while (j < dados.length) {
                        insereLinha(dados[j]);
                        if(j === dados.length){
                            for (var i = 1; i < vetUltimaCaptura.length; i++){
                                if(vetUltimaCaptura[i] !== 0 ){
                                    geraGraficoPrimeiraLinha(vetUltimaCaptura[i], i);
                                }
                            }
                        }
                    }

                    if(dados.length > 0) {
                        ultimaCaptura = dados[j-1].codCaptura;
                    }
                    
                    j = 0;
                    limit = 0;
                    window.setTimeout(insertRow, 3000);
                } else {
                    alert("Erro Ajax.");
                }
            }
        });
    } //pega os dados do banco e coloca na tabela a cada 3s
    function insereLinha(dados) {
        
        // creates a <tbody> element
        if (document.getElementById('tbodyTableDetalhes' + dados.CodEquip) === null) {
            var table = document.getElementById("tableDetalhes");
            var tbody = document.createElement("tbody");
            tbody.id = "tbodyTableDetalhes" + dados.CodEquip;
            table.appendChild(tbody);
        }
        var tblBody = document.getElementById("tbodyTableDetalhes" + dados.CodEquip);
        
        // creating all cells
        var cellText;
        
        // creates a table row
        var qntLinhas = $("#tbodyTableDetalhes"+dados.CodEquip+" tr").length + 1; 
        var row = document.createElement("tr");
        row.id = "linha"+ qntLinhas +"Equip" + dados.CodEquip;
        if (dados.codEvento === "1"){
            row.className = "fuga";
        }
        if (dados.codEvento === "4"){
            row.className = "fase";
        }

        var cell = document.createElement('input');
        cell.type = "checkbox";
        cell.name = "equipamentos";
        cell.className = "w" + dados.codCaptura;
        cell.id = "s" + dados.CodEquip + "l" + qntLinhas;
        cell.onclick = criaGraficoEquipamento;
        row.appendChild(cell);

        var cell = document.createElement("td");
        cellText = document.createTextNode(dados.codCaptura);
        var div = document.createElement("div");
        div.id = "divcaptura" + dados.codCaptura;
        div.className = dados.CodEquip;
        div.style = "float: right; margin-right: 10px;";
        var img = document.createElement("img");
        if(equipMostra[dados.CodEquip] === 0 ){
            img.src = baseUrl + "includes/imagens/mais.jpg";
        } else {
            img.src = baseUrl + "includes/imagens/menos.jpg";
        }
        img.name = "mais";
        img.style = "width: 140%;";
        img.id = "imgequip" + dados.CodEquip;
        img.onclick = ocultaLinhas;
        div.appendChild(img);
        cell.appendChild(cellText);
        cell.appendChild(div);
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
        
        //retira a img/div da linha anterior e oculta a linha anterior
        if(tblBody.firstChild !== null){
            var x = tblBody.firstChild.innerHTML.split('div')[2];
            x = x.split('"')[0];
            $("#div" + x).remove();
            if (equipMostra[dados.CodEquip] === 0){
                $("#linha"+(qntLinhas-1)+"Equip"+dados.CodEquip).prop("style", "display:none");
            }
        }
        
        vetUltimaCaptura[dados.CodEquip] = dados.codCaptura;
        vetEquip[dados.CodEquip] = 1;
        tblBody.insertBefore(row, tblBody.firstChild);
        j++;
    }
    function ocultaLinhas(){
        var id = $(this).attr('id'); //pega a classe do checkbox clicado, contendo o código do equipamento
        var equip = id.substring(8, id.length);
        var name = $(this).attr('name');   
        var qntLinhas = $("#tbodyTableDetalhes"+equip +" tr").length;
        
        if (name === "mais"){
            equipMostra[equip] = 1;
            document.getElementById(id).setAttribute("name","menos");
            document.getElementById(id).src = baseUrl + "includes/imagens/menos.jpg";
            
            for (var x = qntLinhas-1; x > 0 ; x--){
                $('#linha'+x+'Equip'+equip).prop("style", "");
            }
        }else {
            
            equipMostra[equip] = 0;
            document.getElementById(id).setAttribute("name","mais");
            document.getElementById(id).src = baseUrl + "includes/imagens/mais.jpg";
            
            for (var x = qntLinhas-1; x > 0 ; x--){
                $('#linha'+x+'Equip'+equip).prop("style", "display: none");
            }
        }
    }
    function geraGraficoPrimeiraLinha(codCaptura, codequip) {
        //percorre os checkbox e desmarca todos e deixa marcado só o que selecionou
        desmarcaCheckboxEquipamentosMarcaUltimo(codequip, codCaptura);
        // ==========================================        
        //verifica se tem a div pra colocar o grafico, se não tiver cria uma div do equip
        // se já tiver apenas pega a referencia da div
        criaDiv(codequip);
        // ==========================================
        //pega os dados do banco e Cria grafico
        criaGrafico(codCaptura, codequip);
        // ==========================================
    }
    function criaGraficoEquipamento() {
        var classeI = $(this).attr('class'); //pega a classe do checkbox clicado, contendo o wcódigo da captura
        var codCaptura = classeI.substring(1, classeI.length); // codCaptura
        var id = $(this).attr('id').split("l"); //pega o id do checkbox clicado, contendo o scódigo de equip
        var codequip = id[0].substring(1, id[0].length); // codEquip
        
        if ($(".w" + codCaptura).prop("checked")) {
            
            //percorre os checkbox e desmarca todos e deixa marcado só o que selecionou
            desmarcaCheckboxEquipamentosMarcaUltimo(codequip, codCaptura);
            // ==========================================
            //verifica se tem a div pra colocar o grafico, se não tiver cria uma div do equip
            // se já tiver apenas pega a referencia da div
            criaDiv(codequip);
            // ==========================================
            //pega os dados do banco e Cria grafico
            criaGrafico(codCaptura, codequip);
            // ==========================================
        } 
        else {
            var chart = $('#container'+codequip).highcharts();
            chart.series[0].remove();
            $('#container'+codequip).empty();
            document.getElementById('container' +codequip).setAttribute("class","");
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
                    url: baseUrl + "index.php/Detalhes/graficos",
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
    function desmarcaCheckboxEquipamentosMarcaUltimo(codequip, codCaptura){
        
        var qntLinhas = $("#tbodyTableDetalhes"+codequip +" tr").length; 
        for (var x = qntLinhas ; x > 0; x--){ 
            $("#s" + codequip+"l"+x).attr("checked", false);
        }
        $(".w" + codCaptura).prop("checked", true);
    }
    function criaDiv(codequip){
        if (document.getElementById('container' + codequip) === null) {
            var divMain = document.getElementById("divMain");
            var div = document.createElement("div");
            div.id = "container" + codequip;
            divMain.appendChild(div);
        }
    }
    function criaGrafico(codCaptura, codequip){
        var $divCont = $('#container' + codequip);
        document.getElementById('container' + codequip).setAttribute("class","codCap"+codCaptura+" col-xs-3 divContainerEquip");
        $.ajax({
            url: baseUrl + "index.php/Detalhes/linha", //requisita novo gráfico
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
                            type: 'line',
                            marginRight: 10
                        },
                        title: {
                            text: 'Equip ' + codequip + " Cap " + codCaptura 
                        },
                        series: [{name: codCaptura,
                                data: dados.linha}]
                    });
                } else
                    alert("Erro Ajax.");
            }
        });
    }
    function deslocaGrafico(cod1, cod2){
        var w = 750, h = 450, url = baseUrl+ "index.php/popup_grafico_deslocada?cod1="+cod1+"&cod2="+cod2, title = "popupGrafico";
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    } //OK
    function deleteBottons(){
        if(!($("#checkboxLimit").prop("checked"))){
            limit = $("#limit").prop("value");
        } 
        if (limit > 10000 || limit < 0){
            alert("Limit Invalid");
            $("#limit").prop("value", 0);
        } else {
            $("div").remove('#divBottons');
            insertRow();
        }
        
    }
    function setlimit(){
        if($("#checkboxLimit").prop("checked")){
            $("#limit").prop("value", "0");
            $("#limit").prop("disabled", true);
        } else {
            $("#limit").prop("disabled", false);
        }
    }
    function insereDadosNoArray(){
        for (var i = 0; i <= 101; i++){
            vetUltimaCaptura[i] = 0;
            vetEquip[i] = 0;
            equipMostra[i] = 0;
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
            url: baseUrl + "index.php/detalhes/tabelaSimilaridade",
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