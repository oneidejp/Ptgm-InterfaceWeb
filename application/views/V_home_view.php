<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-1 col-xs-1" id="esquerda"></div>
        <div class="col-md-10 col-xs-10" id="centro">
            <div id="aba">
                <h1 class="text-center">
                    <?php
                    echo $this->lang->line('page_title_v_home') . " ";
                    echo $this->session->userdata('nome') . " ";
                    echo $this->lang->line('logged');
                    ?>
                </h1>
            </div>
        </div>
        <div class="col-md-1 col-xs-1" id="direita"></div>
    </div>
</div>