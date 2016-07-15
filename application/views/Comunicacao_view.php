<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-2 col-xs-2" id="centro">
            <button class="btn btn-success" id="conectar" onclick="conectar()">Conectar</button>
            <button class="btn btn-primary" id="desconectar" onclick="desconectar()">Desconectar</button>
            <div id="exibeHtml">Telnet1: <?php
                if (isset($telnet)) {
                    echo $telnet;
                }
                ?></div><br>
            <div id="buff">Buffer: <?php
                if (isset($buff)) {
                    echo $buff;
                } else {
                    echo "Buffer vazio!!\n";
                }
                ?></div><br>
            <div id="exibeRetorno">Telnet2: <?php
                if (isset($telnet2)) {
                    echo $telnet2;
                }
                ?></div>
            <div id="buff2">Buffer2: <?php
                if (isset($buff2)) {
                    echo $buff2;
                } else {
                    echo "Buffer2 vazio!!\n";
                }
                ?></div><br>
            <form name="registros" method="post" enctype="multipart/form-data">
                <button type="submit" name="cadastrar" class="btn btn-success">Enviar dados!</button>
                <button type="submit" name="cancelar" class="btn btn-primary">Cancelar!</button>
            </form>
        </div>
    </div>
</div>
<script>
    function conectar() {
        $('#exibeHtml').html('Conectou');
        $.ajax({
            async: false,
            url: "<?php echo base_url(); ?>" + "index.php/comunicacao/conectarTelnet",
            dataType: 'json',
            scriptCharset: 'UTF-8',
            type: "POST",
            data: {
                Host: "192.168.103.102",
                Comando: "help"
            },
            success: function (dados) {
                if (dados) {
                    $('#exibeRetorno').html(dados);
                } else {
                    alert("Erro Ajax.");
                }
            }
        });
    }
    function desconectar() {
        $('#exibeHtml').html('Desconectou');
        $.ajax({
            async: false,
            url: "<?php echo base_url(); ?>" + "index.php/comunicacao/desconectarTelnet",
            dataType: 'json',
            scriptCharset: 'UTF-8',
            type: "POST",
            data: {
                Algo: "alguma informacao"
            },
            success: function (dados) {
                if (dados) {
                    $('#exibeRetorno').html(dados);
                } else {
                    alert("Erro Ajax.");
                }
            }
        });
    }
</script>
