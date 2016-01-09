
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->lang->line('page_title_consult_user'); ?></title>
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
					<li id="consulta" style="background-color: #A9A9A9;"><a href="<?php echo base_url('index.php/usuario') ?>" ><?php echo $this->lang->line('consult'); ?></a></li>
					<li id="cadastro"><a href="<?php echo base_url('index.php/usuario?link=cadastro') ?>" ><?php echo $this->lang->line('cadastre'); ?></a></li>
				</ul>
				<div id="aba">
					<div class="row-fluid">
						<div class="span12" id="formcentro">
							<?php if ($this->session->userdata('nivel')=='1') { ?>
							<table id="myTable" class="table table-striped table-bordered sortable">
								<caption><h2><?php echo $this->lang->line('table_title_user'); ?></h2></caption>
								<thead>
									<tr>
										<th  class="col1">
											<img id="mostrar1" src="<? echo base_url('includes/imagens/lupa.png') ?>" />
											<?php echo $this->lang->line('actions'); ?>
											<img id="filtro1" src="<? echo base_url('includes/imagens/filter.png') ?>" /><br/>
											<input type="text" id="txtColuna1" class="input-search" alt="sortable"/>
											<button id="fechar1" ><?php echo $this->lang->line('close'); ?></button>
										</th>
										<th  class="col2">
											<img id="mostrar2" src="<? echo base_url('includes/imagens/lupa.png') ?>" />
											<?php echo $this->lang->line('code'); ?>
											<img id="filtro2" src="<? echo base_url('includes/imagens/filter.png') ?>" /><br/>
											<input type="text" id="txtColuna2" class="2">
											<button id="fechar2" ><?php echo $this->lang->line('close'); ?></button>
										</th>
										<th  class="col3">
											<img id="mostrar3" src="<? echo base_url('includes/imagens/lupa.png') ?>" />
											<?php echo $this->lang->line('name'); ?>
											<img id="filtro3" src="<? echo base_url('includes/imagens/filter.png') ?>" /><br/>
											<input type="text" id="txtColuna3" class="3">
											<button id="fechar3" ><?php echo $this->lang->line('close'); ?></button>
										</th>
										<th  class="col4">
											<img id="mostrar4" src="<? echo base_url('includes/imagens/lupa.png') ?>" />
											<?php echo $this->lang->line('email'); ?>
											<img id="filtro4" src="<? echo base_url('includes/imagens/filter.png') ?>" /><br/>
											<input type="text" id="txtColuna4" class="4">
											<button id="fechar4" ><?php echo $this->lang->line('close'); ?></button>
										</th>
										<th  class="col5">
											<img id="mostrar5" src="<? echo base_url('includes/imagens/lupa.png') ?>" />
											<?php echo $this->lang->line('level'); ?>
											<img id="filtro5" src="<? echo base_url('includes/imagens/filter.png') ?>" /><br/>
											<input type="text" id="txtColuna5" class="5">
											<button id="fechar5" ><?php echo $this->lang->line('close'); ?></button>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									foreach ($usuario as $dados) {
										?>
										<tr>
											<td>
												<a href="<? echo base_url('')?>index.php/usuario/apagar_usuario/<?php echo $dados->id; ?>" onClick="return confirm('<?php echo $this->lang->line('msg_confirm_delete')." ".$this->lang->line('user')." ".$this->lang->line('code').": ".$dados->id; ?>?')">
													<img src="<? echo base_url('includes/imagens/delete.png') ?>"></a>
													<a href="<? echo base_url('')?>index.php/usuario/editar_usuario/<?php echo $dados->id; ?>">
														<img src="<? echo base_url('includes/imagens/edit.png') ?>"></a>
													</td>
													<td><a href="<? echo base_url('')?>index.php/usuario/editar_usuario/<?php echo $dados->id; ?>"><?php echo $dados->id; ?></a></td>
													<td><a href="<? echo base_url('')?>index.php/usuario/editar_usuario/<?php echo $dados->id; ?>"><?php echo $dados->nome; ?></a></td>
													<td><a href="<? echo base_url('')?>index.php/usuario/editar_usuario/<?php echo $dados->id; ?>"><?php echo $dados->email; ?></a></td>
													<td><a href="<? echo base_url('')?>index.php/usuario/editar_usuario/<?php echo $dados->id; ?>"><?php switch ($dados->nivel) {case 1:echo "Administrador";break;case 2:echo "Supervisor";break;case 3:echo "Operador";break;case 4:echo "Visualizador";break;}; ?></a></td>
												</tr>
												<?php		};
												?>
											</tbody>
										</table>
										<?php
										if($this->session->flashdata('msg'))?>
										<?php echo $this->session->flashdata('msg');
										?>	
										<?php	}else{
											?><h3 class="center"><?php echo $this->lang->line('msg_permission_user'); ?></h3><?php
										} ?>
									</div>
								</div>
							</div>
							<div class="row-fluid"><? include ("footer.php"); ?></div>
						</div>
					</div>
				</div>
			</body>
			</html>