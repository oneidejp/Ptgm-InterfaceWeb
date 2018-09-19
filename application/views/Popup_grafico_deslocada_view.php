<!--
* 2017  View
* Desenvolvido por: Leonardo Francisco Rauber
* Email: leorauber@hotmail.com - 132789@upf.br
* Projeto de conclusão de curso
* UPF - Ciência da Computação
-->

<input type="button" id="closeWindow" value="Close" onclick="window.close()" style="float:right;">
        <div class="col-md-12 col-xs-12" style="height:300px;">
            <div class="col-xs-12">
                <div id="linha" style="width:99%;"></div> <!--grafico linha-->
            </div>
        </div>

<script> //pega a baseURL
    function getURL() {
        var baseUrl = location.origin + "/" + window.location.pathname.split('/')[1] + "/";
        return baseUrl;
    }
</script>
<script type="text/javascript"> //pega os dados do banco e coloca na tabela a cada 1s

    var query = window.location.search.substring(1);
    var vars = query.split("&");
    var cod1 = vars[0].split("=")[1];
    var cod2 = vars[1].split("=")[1];
    
    var baseUrl = getURL();
    $.ajax({
        url: baseUrl + "index.php/popup_grafico_deslocada/deslocaOnda",
        dataType: 'json',
        scriptCharset: 'UTF-8',
        type: "POST",
        data: {
            Cod1: cod1,
            Cod2: cod2
        },
        success: function (dados) {
            if (dados) { 
//console.log(dados);
                var chart = $('#linha').highcharts();
                chart.addSeries({
                    name: cod1,
                    data: dados.linha1
                });
                chart.addSeries({
                    name: cod2,
                    data: dados.linha2
                });

            } else
                alert("Erro Ajax.");
        }
    });
    
</script>   