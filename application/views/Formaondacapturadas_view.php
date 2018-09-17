<!--
* 2016  View
* Desenvolvido por: Leonardo Francisco Rauber
* Email: leorauber@hotmail.com - 132789@upf.br
* Projeto de conclusão de curso
* UPF - Ciência da Computação
-->
<div class="container-fluid" >

    <div class="row">
        <div class="col-md-12 col-xs-12" id="centro">
            <div id="abaFO">
                <div class="row">   <!-- incluir botoes-->
                    <div class="col-xs-12"> 
                        <p style="font-size: 14pt; text-align: center;"> <!-- incluir botoes-->
                            <?php echo $this->lang->line('equipments'); ?>
                            <input id="allequips" type="checkbox" checked="true" onclick="allEquips()">
                            <input id="equipment" type="text" disabled="false">&emsp;&emsp;
                            
                            <?php echo $this->lang->line('phase'); ?> 
                            <input id="fase" type="checkbox" checked="true">
                            
                            <?php echo $this->lang->line('leakage'); ?>
                            <input id="fuga" type="checkbox" checked="true">&emsp;&emsp;
                            
                            <input id="writedate" type="checkbox" checked="true" onclick="writeDate()">
                            <?php echo $this->lang->line('datestart'); ?>
                            <input type="text" id="calendariostart" disabled="false" onblur>
                            
                            <?php echo $this->lang->line('dateend'); ?>
                            <input type="text" id="calendarioend" disabled="false">&emsp;&emsp;
                            
                            Limit
                            <input id="limitcheckbox" type="checkbox" checked="true" onclick="limitSet()">
                            <input type="text" id="limit" value="100" min="0" max="10000" style="width: 70px;" disabled="true">&emsp;&emsp;
                            
                            <input type="button" id="buttonSearch" value="Search" onclick="getData()">
				<img id="loader" class="hidden" src="../includes/imagens/ajax-loader.gif">
                        </p>
                    </div>
                    <div class="col-md-10 col-xs-offset-1" style="overflow:auto; height:610px; margin-top: 10px;">
                        <table id="tableFormaonda" class="table table-bordered " style="font-size: 13pt; text-align: center; ">
                            <thead>
                                <tr>
                                    <th ><?php echo $this->lang->line('capture'); ?></th>
                                    <th ><?php echo $this->lang->line('room'); ?></th>
                                    <th ><?php echo $this->lang->line('plug'); ?></th>
                                    <th ><?php echo $this->lang->line('equipment'); ?></th>
                                    <th ><?php echo $this->lang->line('use'); ?></th>
                                    <th ><?php echo $this->lang->line('effective'); ?> </th>
                                    <th ><?php echo $this->lang->line('dangerousness'); ?></th>
                                    <th  class="col-xs-2"><?php echo $this->lang->line('date'); ?></th>
                                    <th ><?php echo $this->lang->line('compare'); ?></th>
                                </tr>
                            </thead>
                            <tbody id="tbodyFormaonda"></tbody>
                        </table>
                    </div>

                    <div class="col-md-12 col-xs-12" style="margin-top: 30px; height:200px;">
                        <div class="col-xs-7">
                            <div id="linha"></div> <!--grafico linha-->
                            <div id="barra"></div> <!--grafico barra-->
                        </div>
                        <div class="col-xs-5">
                            <div class="col-xs-12">
                                <table class='table table-striped table-bordered' id="tabelaSimilaridade">
                                    <thead>
                                        <tr>
                                            <th class="col-xs-3"><?php echo $this->lang->line('capture_code'); ?></th>
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
   //remoção das classes odd e even que o bootstrap coloca automaticamente
    $.extend($.fn.dataTable.ext.classes, {
        sStripeEven: '', sStripeOdd: ''
      });
    document.body.style = "padding-bottom: 10px; padding-top: 70px;";
    var j = 0, cont = 0, checkClicados = 0, lock = 0, atualizando = 0;
    var qntLines = 0;
    var graphColorVet = ["#f15c80","#8085e9","#f7a35c","#90ed7d","#434348","#7cb5ec"];
    var table = $('#tableFormaonda').DataTable( {
        "order": [[ 0, "desc" ]]
    } ); //========================
    var graficos = [];
    var baseUrl = getURL();
    var tcheckboxSelecionados = [];
    
    function getData() {
        table.clear();
        var dateend, datestart, equipamento, fase, fuga, limit;
        j = 0;
        if(graficos.length > 0){
            cleanScreen();
        }
        
        if($("#allequips").prop("checked")) equipamento = 0;
        else                                equipamento = $("#equipment").val();
        if($("#fase").prop("checked"))      fase = 4;
        else                                fase = 0;
        if($("#fuga").prop("checked"))      fuga = 1;
        else                                fuga = 0;
        if($("#writedate").prop('checked')) {
            datestart = "0";
            dateend = "0";
        }
        else {
            if ($("#calendariostart").val() === ""){
                datestart = 1;
            } else {
                datestart = $("#calendariostart").val();
            }
            if($("#calendarioend").val() === ""){ 
                dateend = 1;
            }
            else{
                dateend = $("#calendarioend").val();
            }
        }
        
	
		limit = $("#limit").val();
		if (limit < 0 || limit > 10000){
			alert("Value limit invalid " + limit);
			limit = $("#limit").val(0);
		}
			
		if(limit > 0){
		$("#loader").removeClass("hidden");
			$.ajax({
				type: 'post',
				dataType: 'json', //tipo de retorno
				url: baseUrl + "index.php/Formaondacapturadas/getDataTable", //arquivo onde serão buscados os dados
				data: {
					Fase: fase,
					Fuga: fuga,
					Equipment: equipamento,
					Datestart: datestart,
					Dateend: dateend,
					Limit: limit
				},
				success: function (dados) {
					//console.log(dados);
					if (dados) {
						while (j < dados.length) {
							var evento;
							var cod = dados[j].codCaptura;
							var checkbox = "<input name='comparar' id="+cod+" type='checkbox' onclick='criaGraficoBarraLinha("+cod+")'>";
							var peri = '';
							if (dados[j].codEvento === "1" || dados[j].codEvento === "10"){
								var classper = periculosidade(dados[j].periculosidade_corrente);
								peri = "<button data-toggle='tooltip' data-placement='top' title='corrente' id=periculosidade_corrente class="+classper+"></button>";
								classper = periculosidade(dados[j].periculosidade_frequencia);
								peri += "<button data-toggle='tooltip' data-placement='top' title='frequência' id=periculosidade_frequencia class="+classper+"></button>";
								classper = periculosidade(dados[j].periculosidade_similaridade);
								peri += "<button  data-toggle='tooltip' data-placement='top' title='similaridade' id=periculosidade_similaridade class="+classper+"></button>";
							} else {
								peri = " "; 
							}
							table.row.add([
								cod,
								dados[j].codUsoSala,
								dados[j].CodTomada,
								dados[j].CodEquip,
								dados[j].valorMedio,
								dados[j].eficaz,
								peri,
								dados[j].dataAtual,
								checkbox
							]).draw(false);
							
							if(dados[j].codEvento === "1") evento = "fuga";
							if(dados[j].codEvento === "4") evento = "fase";
							if(dados[j].codEvento === "9") evento = "cExtFase";
							if(dados[j].codEvento === "10") evento = "cExtFuga";
							$('#tableFormaonda tbody tr:last').addClass( evento );
							j++;
						}
						$("#loader").addClass("hidden");
					} else {
						alert("Erro Ajax.");
					}
				}
			});
        } else {
           table.clear().draw();
        }
    }

    function limitSet(){
        if($("#limitcheckbox").prop("checked")) {
            $("#limit").prop("disabled", "true");
			$("#limit").val(0);
        } else {
            $("#limit").prop("disabled", "");
			$("#limit").val(0);
        }
    }
    
    //funcao para chamar a tela com o grafico deslocado
    function deslocaGrafico(cod1, cod2){
        var w = 750, h = 450, url = "popup_grafico_deslocada?cod1="+cod1+"&cod2="+cod2, title = "popupGrafico";
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    }
    function periculosidade(value) {
        var classdiv;
        classdiv = "green-circle";
        /*if (dados.eficaz >= 0.1 && dados.eficaz < 0.5) {
            //atenção
            classdiv = "yellow-circle";
        } else if (dados.eficaz >= 0.5) {
            //perigo
            classdiv = "red-circle";
        }*/
        if (value == 2) {
            //atenção
            classdiv = "yellow-circle";
        } else if (value == 3) {
            //perigo
            classdiv = "red-circle";
        }

        return classdiv;
    } //OK
    function criaGraficoBarraLinha(id) {
        var checkadoID = document.getElementById(id).checked; //verifica se o checkbox foi clicado true == sim, false == não

        if (checkadoID === true) { // se checkado == true monta gráfico na área de comparação
            //ajax envia os dados p/ php e no php processa e retornar valores em dados.linha e dados.
            if (checkClicados < 5) {
                graficos[checkClicados] = id;
                $.ajax({
                    url: baseUrl + "index.php/Formaondacapturadas/graficos",
                    dataType: 'json',
                    scriptCharset: 'UTF-8',
                    type: "POST",
                    data: {
                        idCheckbox: id
                    },
                    success: function (dados) {
                        if (dados) {
                            var chart = $('#barra').highcharts();
//                            var colors = Highcharts.getOptions().colors;
//                            chart.color = colors[0];
                            
                            
                            chart.addSeries({
                                name: id,
                                data: dados.barra,
                                color: graphColorVet[graphColorVet.length-1]
                            });
                            var chart = $('#linha').highcharts();
                            
                            chart.addSeries({
                                name: id,
                                data: dados.linha,
                                color: graphColorVet[graphColorVet.length-1]
                            });
                            graphColorVet.pop();
                        } else
                            alert("Erro Ajax.");
                    }
                });
                checkClicados++;
            } else {
                alert("Máximo de 5 Equipamentos Atingido");
                $("#" + id).attr("checked", false);
            }

        }
        else { // senão oculta gráfico do equipamento

            for (var x = 0; x < graficos.length; x++) {
                if (graficos[x] === id) {
                    var chart = $('#barra').highcharts();
                    if (chart.series.length) {
                        graphColorVet.push(chart.series[x].color);
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
        //foi usado uma array global para corrigir o problema de comparação com itens de outras paginas.
        if (checkadoID === true) {
            tcheckboxSelecionados.push(id);
            tcheckboxSelecionados.sort(function(a, b){return b-a}); 
            mostraTabelaSimilaridade();
        } else {
            var index =  tcheckboxSelecionados.indexOf(id);
            if (checkClicados === 0) {
                document.getElementById("tabelaSimilaridade").deleteRow(1);
                if(index >=0){
                    tcheckboxSelecionados.splice(index,1);
                }
            } else {
                if(index >=0){
                    tcheckboxSelecionados.splice(index,1);
                }
                mostraTabelaSimilaridade();
            }
        }
    } //OK
    $(document).ready(function() {
        $('#calendariostart').datetimepicker({
            timeFormat: 'HH:mm:ss', 
            dateFormat: "yy-mm-dd"
        });
        $('#calendarioend').datetimepicker({
            timeFormat: 'HH:mm:ss', 
            dateFormat: "yy-mm-dd"
        });
        
//         $('#paginate_button').click(function({
//            table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
//            var data = this.data();
//               console.log(data);
//            } );
//             
//         }));
        
        $('a.paginate_button ').click(function(){alert("opas")});
    });
    function cleanScreen(){
        if (graficos.length >= 2) document.getElementById("tabelaSimilaridade").deleteRow(1);
        for (var x = checkClicados-1; x >= 0; x--) { 
            var chart = $('#barra').highcharts();
                chart.series[x].remove();
            var chart = $('#linha').highcharts();
                chart.series[x].remove();
                chart.colorCounter = 0;
            graficos.splice(x, 1);
            if(document.getElementById("tabelaSimilaridade").rows[x+1] !== undefined)
                document.getElementById("tabelaSimilaridade").deleteRow(x+1);
            
        }
        checkClicados = 0;
    }
    function writeDate() {
        if ($("#writedate").prop("checked")){
            $("#calendariostart").prop("disabled", "true");
            $("#calendarioend").prop("disabled", "true");
            document.getElementById("calendariostart").value = "";
            document.getElementById("calendarioend").value = "";
        }else {
            $("#calendariostart").prop("disabled", "");
            $("#calendarioend").prop("disabled", "");
        }
    }
    function allEquips() {
        if ($("#allequips").prop("checked")){
            $("#equipment").prop("disabled", "true");
        }else {
            $("#equipment").prop("disabled", "");
        }
    }
</script>   
<script>
    function mostraTabelaSimilaridade() {

        var baseUrl = getURL();
        //pega os checkboxes clicados em um array, a ordenação não é por clique e sim por leitura dos clicados, de cima para baixo
//        var checkboxSelecionados = [];
//        $('#abaFO input[name="comparar"]:checked').each(function () {
//            checkboxSelecionados.push($(this).attr('id'));
//        });
        
        //envia por post um json contendo os códigos de capturas dos checkboxes
        //recebendo o retorno da tabela preenchida
        $.ajax({
            url: baseUrl + "index.php/Formaondacapturadas/tabelaSimilaridade",
            dataType: 'json',
            scriptCharset: 'UTF-8',
            type: "POST",
            data: {
                Check: tcheckboxSelecionados
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
