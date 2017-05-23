<?php
include_once("config/config.php");

if ($_SERVER['SERVER_NAME'] == "localhost") {
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
} else {
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
}

require 'view/layout/Content.php';
$url = empty($_GET['url']) ? "" : $_GET['url'];

$conteudo = \view\layout\Content::friedlyUrl($url);

date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="../../assets/ico/favicon.png">

		<title><?php echo $conteudo['title']; ?></title>

		<!-- Bootstrap core CSS -->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<!-- Bootstrap theme -->
		<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="bootstrap/css/theme.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="bootstrap/js/html5shiv.js"></script>
		  <script src="bootstrap/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>

	<!-- Fixed navbar -->
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo str_replace($url, "", $_SERVER['REQUEST_URI']); ?>">Controle de estoque</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="<?php echo str_replace($url, "", $_SERVER['REQUEST_URI']); ?>">Inicio</a></li>
					<li><a href="clientes">Clientes</a></li>
					<li><a href="produtos">Produtos</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Pedido<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li class="dropdown-header">Inicio</li>
							<li><a href="pedidoNovo">Novo Pedido</a></li>
							<li><a href="pedidos">Pedidos Realizados</a></li>
						</ul>
					</li>
					<li class="active"><a href="logout">Sair</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>

    <div class="container theme-showcase">
	<br /><br /><br /><br />
      <!-- Main jumbotron for a primary marketing message or call to action -->

	  <?php include_once($conteudo['page']); ?>

    </div> <!-- /container -->
    <!-- Footer
	================================================== -->
	<footer class="bs-docs-footer" role="contentinfo">
		<div class="container">
			
				<p>Currently v1.0</p>

			</ul>
		</div>
	</footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/holder.js"></script>
		<!-- Inclusão do Jquery -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" ></script>
		<!-- Inclusão do Jquery Validate -->
		<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.6/jquery.validate.js" ></script>
		
		<!-- Validação do forumlário -->
		<script type="text/javascript">
			$(document).ready(function(){
				$('#meu_form').validate({
					rules:{ 
						nome:{ 
							required: true,
							minlength: 3
						},
						email: {
							required: true,
							email: true
						},
						senha: {
							required: true
						},
						conf_senha:{
							required: true,
							equalTo: "#senha"
						},
						termos: "required"
					},
					messages:{
						nome:{ 
							required: "O campo nome é obrigatorio.",
							minlength: "O campo nome deve conter no mínimo 3 caracteres."
						},
						email: {
							required: "O campo email é obrigatorio.",
							email: "O campo email deve conter um email válido."
						},
						senha: {
							required: "O campo senha é obrigatorio.",
							
						},
						conf_senha:{
							required: "O campo confirmação de senha é obrigatorio.",
							equalTo: "O campo confirmação de senha deve ser identico ao campo senha."
						},
						termos: "Para se cadastrar você deve aceitar os termos de uso."
					}
					
				});
			});
		</script>
  </body>
</html>
