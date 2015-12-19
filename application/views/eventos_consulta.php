<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?= $this->lang->line('page_title_consult_events'); ?></title>
	<script src="includes/bootstrap/js/jquery.min"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<? echo base_url('includes/bootstrap/css/bootstrap.css') ?>">
	<link rel="stylesheet" href="<? echo base_url('includes/bootstrap/css/bootstrap-responsive.css') ?>">
	<link rel="stylesheet" href="<? echo base_url('includes/css/abas.css') ?>">
	<link rel="stylesheet" href="<? echo base_url('includes/css/estilo.css') ?>">
	<!-- Latest compiled and minified JavaScript -->
	<script src="<? echo base_url('includes/bootstrap/js/bootstrap.min.js') ?>"></script>	
	<script src="<? echo base_url('includes/js/jquery-2.1.1.js') ?>"></script><!-- import jquery -->
	<script src="<? echo base_url('includes/js/sorttable.js') ?>"></script><!-- import ordenação colunas tabela -->
	<script src="<? echo base_url('includes/js/funcoesjs.js') ?>"></script><!-- import funções js -->
</head>
<body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12" id="centro">
				<div class="row-fluid menu">
					<? include ("menu.php"); ?>
					<a href="<?= base_url('index.php/login/logout') ?>"> <img id="sair" src="<? echo base_url('includes/imagens/deslogar.png') ?>" /></a>
				</div>
				<ul class="abas">
					<li id="consulta" style="background-color: #A9A9A9;"><a href="<?= base_url('index.php/eventos') ?>" ><?= $this->lang->line('consult'); ?></a></li>
					<li id="cadastro"><a href="<?= base_url('index.php/eventos?link=cadastro') ?>" ><?= $this->lang->line('cadastre'); ?></a></li>
				</ul>
				<div id="aba">
					<div class="row-fluid">
						<div class="span12" id="formcentro">
							<table id="myTable" class="table table-striped table-bordered sortable">
								<caption><h2><?= $this->lang->line('table_title_events'); ?></h2></caption>
								<thead>
									<tr>
										<th  class="col1">
											<img id="mostrar1" src="<? echo base_url('includes/imagens/lupa.png') ?>" />
											<?= $this->lang->line('actions'); ?>
											<img id="filtro1" src="<? echo base_url('includes/imagens/filter.png') ?>" /><br/>
											<input type="text" id="txtColuna1" class="input-search" alt="sortable"/>
											<button id="fechar1" ><?= $this->lang->line('close'); ?></button>
										</th>
										<th  class="col2">
											<img id="mostrar2" src="<? echo base_url('includes/imagens/lupa.png') ?>" />
											<?= $this->lang->line('code'); ?>
											<img id="filtro2" src="<? echo base_url('includes/imagens/filter.png') ?>" /><br/>
											<input type="text" id="txtColuna2" class="2">
											<button id="fechar2" ><?= $this->lang->line('close'); ?></button>
										</th>
										<th  class="col3">
											<img id="mostrar3" src="<? echo base_url('includes/imagens/lupa.png') ?>" />
											<?= $this->lang->line('description'); ?>
											<img id="filtro3" src="<? echo base_url('includes/imagens/filter.png') ?>" /><br/>
											<input type="text" id="txtColuna3" class="3">
											<button id="fechar3" ><?= $this->lang->line('close'); ?></button>
										</th>
										<th  class="col4">
											<img id="mostrar4" src="<? echo base_url('includes/imagens/lupa.png') ?>" />
											<?= $this->lang->line('form_wave'); ?>
											<img id="filtro4" src="<? echo base_url('includes/imagens/filter.png') ?>" /><br/>
											<input type="text" id="txtColuna4" class="4">
											<button id="fechar4" ><?= $this->lang->line('close'); ?></button>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									foreach ($eventos as $dados) {
										?>
										<tr>
											<td>
												<a href="<? echo base_url('')?>index.php/eventos/apagar_eventos/<?= $dados->codEvento; ?>" onClick="return confirm('<?= $this->lang->line('msg_confirm_delete')." ".$this->lang->line('kind_of_event')." ".$this->lang->line('code').": ".$dados->codEvento; ?> ?')">
													<img src="<? echo base_url('includes/imagens/delete.png') ?>"></a>
													<a href="<? echo base_url('')?>index.php/eventos/editar_eventos/<?= $dados->codEvento; ?>">
														<img src="<? echo base_url('includes/imagens/edit.png') ?>"></a>
													</td>
													<td><a href="<? echo base_url('')?>index.php/eventos/editar_eventos/<?= $dados->codEvento; ?>"><?= $dados->codEvento; ?></a></td>
													<td><a href="<? echo base_url('')?>index.php/eventos/editar_eventos/<?= $dados->codEvento; ?>"><?= $dados->desc; ?></a></td>
													<td><a href="<? echo base_url('')?>index.php/eventos/editar_eventos/<?= $dados->codEvento; ?>"><?= $dados->formaOnda?>  - <?php if($dados->formaOnda==0){echo "Não";}else{echo "Sim";} ?></a></td>
												</tr>
												<?php		};
												?>
											</tbody>
										</table>
										<?= !empty($paginacao) ? $paginacao : '';
										if($this->session->flashdata('msg'))?>
										<?= $this->session->flashdata('msg');
										?>
									</div>
								</div>
							</div>
							<div class="row-fluid"><? include ("footer.php"); ?></div>
						</div>
					</div>
				</div>
			</body>
			</html>