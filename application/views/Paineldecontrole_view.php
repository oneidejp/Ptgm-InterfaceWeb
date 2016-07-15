<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-12 col-xs-12" id="centro">
            <div id="aba">
                <?php
                $cont = 0;
                foreach ($usosala as $dados) {

                    echo '<form class="paineldecontrole">';
                    echo '<fieldset>'
                    ?>
                    <legend class="sala" id="descricao<?php echo $cont; ?>"><?php echo $dados->desc; ?></legend>
                    <?php echo $this->lang->line('in_operation'); ?>:<br>
                    <span id="<?php echo $cont; ?>"><?php echo $horas[$cont]; ?></span><br>
                    <a href="<?php echo base_url('index.php/detalhes/index/' . $dados->codUsoSala) ?>" style="margin-top: 5px;" target="_blanck" class="btn btn-primary"><?php echo $this->lang->line('details'); ?></a>
                    <div id="alerta<?php echo $dados->codUsoSala ?>">
                        <div class="normal"><h3 class="alerta"><?php echo $this->lang->line('normal'); ?></h3></div>
                    </div>
                    </fieldset>
                    </form>
                    <?php
                    $cont++;
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    var atualizacao = "<?php echo TEMPOATUALIZA; ?>";
    var descricao = [];
    var codUsoSala = [];
    var horas = moment();
    var x = 0;

<?php
$contador = 0;
foreach ($usosala as $dados) {
    ?>
        descricao[x] = "<?php echo $dados->desc; ?>";
        codUsoSala[x] = "<?php echo $dados->codUsoSala; ?>";
        horas[x] = moment("2015-01-01 <?php echo $horas[$contador]; ?>");
        x++;
    <?php
    $contador++;
}
?>

    var tamanho = codUsoSala.length;
    var tempo = setInterval(getcodusosala, atualizacao);

    function getcodusosala() {
        $.ajax({
            url: "<?php echo base_url(); ?>" + "index.php/paineldecontrole/ajax",
            dataType: 'json',
            scriptCharset: 'UTF-8',
            type: "POST",
            success: function (dados) {
                /*if (dados.usosala.length === 0) {
                 $("#aba").html('');
                 descricao = [];
                 codUsoSala = [];
                 horas = [];
                 tamanho = codUsoSala.length;
                 } else {
                 if (dados.usosala.length !== codUsoSala.length) {
                 $("#aba").html('');
                 descricao = [];
                 codUsoSala = [];
                 horas = [];
                 $.ajax({
                 url: "<?php echo base_url(); ?>" + "index.php/paineldecontrole/getbyid",
                 dataType: 'json',
                 scriptCharset: 'UTF-8',
                 type: "POST",
                 success: function (dados) {
                 for (var j = 0; j < dados.horas.length; j++) {
                 $("#aba").append('<form class="paineldecontrole"><fieldset><legend class="sala" id="descricao' + j + '">' + dados.desc[j] + '</legend><?php echo $this->lang->line("in_operation"); ?>:<br><span id=' + j + '>' + dados.horas[j] + '</span><br><a href="<?php echo base_url("index.php/detalhes/index/' + dados.codUsoSala[j] + '") ?>" target="_blanck" class="btn btn-primary"><?php echo $this->lang->line("details"); ?></a><br/><div id="alerta' + dados.codUsoSala[j] + '"><div class="normal"><h3 class="alerta"><?php echo $this->lang->line("normal"); ?></h3></div></div></fieldset></form>');
                 descricao[j] = dados.desc[j];
                 codUsoSala[j] = dados.codUsoSala[j];
                 horas[j] = moment("2015-01-01 " + dados.horas[j]);
                 }
                 tamanho = codUsoSala.length;
                 }
                 });
                 } else {
                 for (var i = 0; i < dados.usosala.length; i++) {
                 if (codUsoSala[i] !== dados.usosala[i].codUsoSala) {
                 $("#aba").html('<form class="paineldecontrole"><fieldset><legend class="sala" id="descricao' + j + '">' + dados.desc[j] + '</legend><?php echo $this->lang->line("in_operation"); ?>:<br><span id=' + j + '>' + dados.horas[j] + '</span><br><a href="<?php echo base_url("index.php/detalhes/index/' + dados.codUsoSala[j] + '") ?>" target="_blanck" class="btn btn-primary"><?php echo $this->lang->line("details"); ?></a><br/><div id="alerta' + dados.codUsoSala[j] + '"><div class="normal"><h3 class="alerta"><?php echo $this->lang->line("normal"); ?></h3></div></div></fieldset></form>');
                 descricao = [];
                 codUsoSala = [];
                 horas = [];
                 $.ajax({
                 url: "<?php echo base_url(); ?>" + "index.php/paineldecontrole/getbyid",
                 dataType: 'json',
                 scriptCharset: 'UTF-8',
                 type: "POST",
                 success: function (dados) {
                 for (var j = 0; j < dados.horas.length; j++) {
                 $("#aba").append('');
                 descricao[j] = dados.desc[j];
                 codUsoSala[j] = dados.codUsoSala[j];
                 horas[j] = moment("2015-01-01 " + dados.horas[j]);
                 }
                 tamanho = codUsoSala.length;
                 }
                 });
                 }
                 }
                 }
                 }*/
            }
        });

        $.ajax({
            url: "<?php echo base_url(); ?>" + "index.php/paineldecontrole/alertas",
            dataType: 'json',
            scriptCharset: 'UTF-8',
            type: "POST",
            success: function (dados) {
                for (var l = 0; l < dados.alerta.length; l++) {
                    $("#alerta" + dados.alerta[l].codUsoSala).html("<a href='<?php echo base_url('index.php/alertas/index/" + dados.alerta[l].codUsoSala + "') ?>' '><div class='error'><h3 class='alerta btn btn-danger'><?php echo $this->lang->line('alert'); ?></h3></div></a>");
                }

            }
        });
    }

    var tempo = window.setInterval(carrega, 1000);
    function carrega() {
        for (var i = 0; i < tamanho; i++) {
            horas[i] = horas[i].add(1, 'second');
            $("#" + i).html(horas[i].format('HH:mm:ss'));
        }
    }
</script>

<script>
    $(document).ready(function () {
        var recebe = "";
<?php
foreach ($alerta as $dados) {
    ?>
            recebe = "<?php echo $dados->codUsoSala; ?>";
            $("#alerta" + recebe).html("<a href='<?php echo base_url('index.php/alertas/index/' . $dados->codUsoSala) ?>' '><div class='error'><h3 class='alerta btn btn-danger'><?php echo $this->lang->line('alert'); ?></h3></div></a>");
<?php } ?>
    });

</script>
