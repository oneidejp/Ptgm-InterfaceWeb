<div class="container">
    <div class="row">
        <!--<div class="col-md-12 col-xs-12" style="margin-bottom: 100px;">
            <center><h1 class="text-info">Página de teste para escalas de periculosidade!!!</h1></center> 
        </div>-->
        <div class="col-md-3 col-xs-0"></div>
        <div class="col-md-3 col-xs-6">
            <form class="form-signin" role="form" name="formCalcularEscalas" method="post">
                <div class="form-group">
                    <label for="onda1">Informe Onda 1</label>
                    <input type="number" class="form-control" name="onda1" placeholder="Onda 1" value="6222035">
                </div>
                <div class="form-group">
                    <label for="onda2">Informe Onda 2</label>
                    <input type="number" class="form-control" name="onda2" placeholder="Onda 2" value="6222041">
                </div>
                <center><button type="submit" class="btn btn-primary" name="btnCalcularEscalas">Calcular</button></center>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-xs-12" style="margin-bottom: 100px;">
            <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código Onda</th>
                    <th>Similaridade</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 0; 
                if(isset($pontos)){ 
                    foreach ($pontos as $dados) {
                        echo '<tr>';
                        echo '<td>';
                        echo $i++;
                        echo '</td>';
                        echo '<td>';
                        echo $onda1;
                        echo '</td>';
                        echo '<td>';
                        echo $dados;
                        echo '</td>';
                        echo '</tr>';
                    }
                }
                ?>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</div>