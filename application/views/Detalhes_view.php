<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-xs-12" id="centro">
            <div id="aba">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="col-md-5 col-xs-5" style="overflow:auto;">
                            <table class="table table-striped table-bordered detalhes" id="tabelaDados">
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
                                <tbody id="tbodyTabelaDados">
                                    <?php if (empty($detalhes)) {
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" checked="checked"/></td>
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
                                        $anterior = 0;
                                        $ind = 0;
                                        foreach ($detalhes as $dados) {
                                            if ($anterior == $dados->CodEquip) {
                                                ?>
                                                <tr id="linha<?php echo $dados->codCaptura; ?>">
                                                    <td id="<?php echo $dados->codCaptura; ?>-1"><input type="checkbox" id="s<?php echo $dados->CodEquip; ?>" class="<?php echo $dados->codCaptura; ?>" name="equipamentos"  /></td>
                                                    <td id="<?php echo $dados->codCaptura; ?>-2"><?php echo $dados->codCaptura; ?></td>
                                                    <td id="<?php echo $dados->codCaptura; ?>-3"><?php echo $dados->CodTomada; ?></td>
                                                    <td id="<?php echo $dados->codCaptura; ?>-4"><a href="<?php echo base_url('index.php/comparar/index/' . $codUsoSala . '/' . $dados->CodEquip) ?>" target="_blank"><?php echo $dados->CodEquip . " - " . $dados->desc; ?></a></td>
                                                    <td id="<?php echo $dados->codCaptura; ?>-5"><?php echo substr($dados->eficaz, 0, 6); ?></td>
                                                    <td id="<?php echo $dados->codCaptura; ?>-6"><?php echo $tempoUso[$ind]; ?></td>
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
                                                    <td id="<?php echo $dados->codCaptura; ?>-8"><input type="checkbox"  id="<?php echo $dados->codCaptura; ?>" class="<?php echo $dados->CodEquip; ?>"  name="comparar" /></td>
                                                </tr>
                                            <script>
                                                $("#linha<?php echo $dados->codCaptura; ?>").hide();
                                                $("#<?php echo $capanterior; ?>-2").html("<img id='' class='<?php echo $dados->CodEquip; ?>' name='mais' src='<?php echo base_url('includes/imagens/mais.jpg') ?>'> <?php echo $capanterior; ?>");
                                            </script>
                                            <?php
                                        } else {
                                            ?>
                                            <tr id="linha<?php echo $dados->codCaptura; ?>">
                                                <td id="<?php echo $dados->codCaptura; ?>-1"><input type="checkbox" checked="checked" id="s<?php echo $dados->CodEquip; ?>" class="<?php echo $dados->codCaptura; ?>" name="equipamentos" /></td>
                                                <td id="<?php echo $dados->codCaptura; ?>-2"><?php echo $dados->codCaptura; ?></td>
                                                <td id="<?php echo $dados->codCaptura; ?>-3"><?php echo $dados->CodTomada; ?></td>
                                                <td id="<?php echo $dados->codCaptura; ?>-4"><a href="<?php echo base_url('index.php/comparar/index/' . $codUsoSala . '/' . $dados->CodEquip) ?>" target="_blank"><?php echo $dados->CodEquip . " - " . $dados->desc; ?></a></td>
                                                <td id="<?php echo $dados->codCaptura; ?>-5"><?php echo substr($dados->eficaz, 0, 6); ?></td>
                                                <td id="<?php echo $dados->codCaptura; ?>-6"><?php echo $tempoUso[$ind]; ?></td>
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
                                                <td id="<?php echo $dados->codCaptura; ?>-8"><input type="checkbox" id="<?php echo $dados->codCaptura; ?>" class="<?php echo $dados->CodEquip; ?>" name="comparar"  /></td>
                                            </tr>
                                            <?php
                                            $anterior = $dados->CodEquip;
                                            $capanterior = $dados->codCaptura;
                                        }
                                        $ind = $ind + 1;
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-7 col-xs-7">
                            <div id="linha"></div>
                            <div id="barra"></div>
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

            <!-- div para testes
            <div id="divTeste" style="margin-top: 100px; margin-bottom: 100px; text-align: center; font-size: 40px;"><?php
            if (isset($teste)) {
                echo $teste;
            }
            ?></div>-->
            <div class="row-fluid">
                <div class="col-md-12 col-xs-12" id="graficoslinha"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //insereTabela();
        var cont = 0, checkClicados = 0;
        ;
        var graficos = [];
        $('input[type="checkbox"]').click(function () {
            var classe = $(this).attr('class'); //pega a classe do checkbox clicado, contendo o código do equipamento
            var id = $(this).attr('id'); //pega o id do checkbox clicado, contendo o código de captura
            var nome = $(this).attr('name'); //pega o nome do checkbox clicado, informando se é checkbox do equipamento ou do comparar
            var sala = "<?php echo $codUsoSala; ?>"; // pega o cod da sala em uso

            if (nome === "equipamentos") { // classe == equipamentos coluna visualizar
                var codequip = id.substring(1, id.length);
                $.ajax({
                    url: "<?php echo base_url(); ?>" + "index.php/detalhes/mostra_equip",
                    dataType: 'json',
                    scriptCharset: 'UTF-8',
                    type: "POST",
                    data: {
                        CodEquip: codequip,
                        Sala: sala
                    },
                    success: function (dados) {
                        if (dados) {
                            for (var i = 0; i < dados.captura.length; i++) {
                                if (dados.captura[i].codCaptura !== classe) {
                                    $("." + dados.captura[i].codCaptura).attr("checked", false);
                                }
                            }
                        } else {
                            alert("Erro Ajax.");
                        }
                    }
                });
                var chart = $('#equipamento' + id).highcharts();
                if (chart.series.length) {
                    chart.series[0].remove();
                }
                $.ajax({
                    url: "<?php echo base_url(); ?>" + "index.php/detalhes/linha", //requisita novo gráfico
                    dataType: 'json',
                    scriptCharset: 'UTF-8',
                    type: "POST",
                    data: {
                        Captura: classe
                    },
                    success: function (dados) {
                        if (dados) {
                            var chart = $('#equipamento' + id).highcharts();
                            chart.addSeries({
                                name: classe,
                                data: dados.linha,
                                color: '#7cb5ec'
                            });

                        } else
                            alert("Erro Ajax.");
                    }
                });
                checkadoClasse = ($("." + classe).is(':checked')); //verifica se o checkbox foi clicado true == sim, false == não
                if (checkadoClasse === true) { // se checkado == true mostra a div do equipamento
                    $("#equipamento" + id).show();
                } else { // senão oculta a div do equipamento
                    $("#equipamento" + id).hide();
                }
                ;
            }
            ;
            // se fone comparar coluna comparar
            if (nome === "comparar") {
                checkadoID = ($("#" + id).is(':checked')); //verifica se o checkbox foi clicado true == sim, false == não
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
                    ;
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
    function mostraTabelaSimilaridade() {
        //pega os checkboxes clicados em um array, a ordenação não é por clique e sim por leitura dos clicados, de cima para baixo
        var checkboxSelecionados = [];
        $('#aba input[name="comparar"]:checked').each(function () {
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
<script type="text/javascript">
    $(document).ready(function () {
<?php
$cont = 0;
$old = -1;
foreach ($detalhes as $dados) {
    if ($old != $dados->CodEquip) {
        ?>
                $("#graficoslinha").append("<div id='equipamentos<?php echo $dados->CodEquip; ?>' style='width:32.5%; height:280px;float:left; margin:5px auto auto 5px;'></div>");
                $(function () {
                    $('#equipamentos' +<?php echo $dados->CodEquip; ?>).highcharts({
                        chart: {
                            type: 'spline',
                            spacingBottom: -5,
                            spacingLeft: -5
                        },
                        title: {
                            text: ''
                        },
                        credits: {
                            enabled: false
                        },
                        xAxis: {
                            title: {
                                text: 'Tempo/100 (ms)'
                            },
                            labels: {
                                rotation: -45,
                                style: {
                                    fontSize: '8px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                            },
                            tickPositions: [0, 104, 201, 305, 403, 501, 605, 703, 800, 904, 1002, 1100, 1204, 1302, 1406, 1503, 1601]
                        },
                        yAxis: {
                            title: {
                                text: 'Corrente (mA)'
                            }
                        }
                    });
                });

                $.ajax({
                    url: "<?php echo base_url(); ?>" + "index.php/detalhes/linha",
                    dataType: 'json',
                    scriptCharset: 'UTF-8',
                    type: "POST",
                    data: {
                        Captura: <?php echo $dados->codCaptura; ?>
                    },
                    success: function (dados) {
                        if (dados) {
                            var chart = $('#equipamentos' +<?php echo $dados->CodEquip; ?>).highcharts();
                            chart.addSeries({
                                name: "<?php echo $dados->codCaptura ?>",
                                data: dados.linha
                            });

                        } else
                            alert("Erro Ajax.");
                    }
                });
        <?php
        $cont = $cont + 1;
        $old = $dados->CodEquip;
    }
}
?>
    });
</script>
<script type="text/javascript">
    //controla as linhas expande ou oculta, mostra imagem de mais ou menos
    $(document).ready(function () {
        $("img").click(function () {

            var classe = $(this).attr('class');
            var sala = "<?php echo $codUsoSala; ?>";
            var nome = $(this).attr('name');

            if (nome === "mais") {
                $(this).attr('src', '<?php echo base_url("includes/imagens/menos.jpg") ?>');
                $(this).attr('name', 'menos');
            } else {
                $(this).attr('src', '<?php echo base_url("includes/imagens/mais.jpg") ?>');
                $(this).attr('name', 'mais');
            }

            $.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/detalhes/mostra_equip",
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
                            $("#linha" + dados.captura[i].codCaptura + "").toggle("slow");
                        }
                    } else
                        alert("Erro Ajax.");
                }
            });
        });
    });
</script>
