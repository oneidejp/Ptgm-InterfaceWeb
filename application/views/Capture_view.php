<div class="container-fluid">
    <div class="row-fluid">
        <form name="captureForm" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <div class="col-md-2 col-xs-2 form-group">
                    <select class="form-control" id="tomadasForm" name="tomadasForm">
                        <?php
                        foreach ($tomadasExistentes as $dados) {
                            echo "\t\t\t\t\t\t<option value={$dados->codTomada}>";
                            echo $dados->desc;
                            echo "</option>\n";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2 col-xs-2">
                    <button type="submit" name="captureTelnet" class="btn btn-success">Capturar Telnet</button>
                </div>
            </div>
        </form>
        <div class="col-md-2 col-xs-2">
            <button class="btn btn-info" id="mensagemWS">Capturar WebSocket</button>
        </div>
        <div class="col-md-6 col-xs-6">
            <button class="btn btn-primary" id="conectarWS">ConectarWS</button>
            <button class="btn btn-warning" id="desconectarWS">DesconectarWS</button>
            <button class="btn btn-danger" id="reiniciarMBED">Reiniciar MBED</button>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-6 col-xs-6">
            <table id="tableCaptures"></table>
        </div>
        <div class="col-md-6 col-xs-6">
            opa
        </div>
    </div>
    <div class="row-fluid">
        <?php /* if (isset($teste)) echo "Teste: {$teste}";
          if (isset($telnet)) echo "Telnet: {$telnet}";
          if (isset($comando)) echo "Comando: {$comando}"; */ ?>
    </div>
</div>

<!-- BootStrapTable -->
<script>
    $.ajax({
        url: "<?php echo base_url(); ?>" + "index.php/capture/getAllCaptures",
        dataType: 'json',
        scriptCharset: 'UTF-8',
        type: "POST",
        success: function (dados) {
            if (dados) {

            }
        }
    });
    $('#tableCaptures').bootstrapTable({
        columns: [{
                field: 'id',
                title: 'Item ID'
            }, {
                field: 'name',
                title: 'Item Name'
            }, {
                field: 'price',
                title: 'Item Price'
            }],
        data: [{
                id: 1,
                name: 'Item 1',
                price: '$1'
            }, {
                id: 2,
                name: 'Item 2',
                price: '$2'
            }]
    });
</script>