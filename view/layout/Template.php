<?php
/**
 * Template
 *
 * Website Template content
 * @package
 * @name Template
 * @author Name<mail>
 * @version 0.1
 */
//namespace Template;

//use a\a\a;

class Template
{
	public function header($name)
	{
		switch($name)
		{
			case 'quemsomos';
			case 'contato';
			case 'remontagem';
			case 'midia';
			case 'links';
				return '
				<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
				<link rel="stylesheet" href="css/main.css" media="all" />
				';
			break;

			case 'varas';
			case 'cabos';
				return '
				<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
				<link rel="stylesheet" href="css/main.css" media="all" />
				<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
				';
			break;
			
			case 'videos';
				return '
				<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
				<link rel="stylesheet" href="css/main.css" media="all" />
				<link rel="stylesheet" href="css/easy.css" type="text/css" media="screen" />
				<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
				<script type="text/javascript" src="js/easy.js"></script>
				<script type="text/javascript" src="js/main.js"></script>
				';
			break;
			
			case 'home';
				return '
				<link rel="stylesheet" href="css/main.css" media="all" />
				<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
				<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
				';
			break;
			
			default;
				return '
				<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
				<link rel="stylesheet" href="css/main.css" media="all" />
				<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
				';
			break;
		}
	}
	
	public function headerLogo()
	{
		return '<img src="images/layout/logo.png" alt="" name="Insert_logo" id="Insert_logo" style="background: #FFFFFF; display:block;" />';
	}

	public function menuTop()
	{
		return '
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td background="images/layout/bg_menu.png" height="30" align="right">
					<ul class="menu1">
						<li><a href="/"><b>INICIO</b></a></li>
						<li><a href="quemsomos"><b>QUEM SOMOS</b></a></li>
						<li><a href="contato"><b>CONTATO</b></a></li>
						<li><a href="http://www.custombymarco.com.br/loja1/"><b>LOJA VIRTUAL</b></a></li>
					</ul>
				</td>
			</tr>
		</table>
		';
	}

	public function menuMiddle()
	{
		return '
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td background="images/layout/bg_menu_pb.png" height="30" align="right">
					<ul class="menu1">
						<li><a href="varas.php"><b>VARAS</b></a></li>
						<li><a href="cabos.php"><b>CABOS</b></a></li>
						<li><a href="remontagem"><b>REMONTAGEM</b></a></li>
						<li><a href="videos"><b>VIDEOS</b></a></li>
						<li><a href="links"><b>LINKS</b></a></li>
						<li><a href="http://blog.custombymarco.com/"><b>BLOG</b></a></li>
					</ul>
				</td>
			</tr>
		</table>
		';
	}
	
	public function slideMenu($value)
	{
		if ($value == "on") {
			return '
			<div id="gallery">
				<div class="wrap">
					<div id="slide-holder">
						<div id="slide-runner">
						<a href=""><img id="slide-img-1" src="images/photos/nature-photo.png" class="slide" alt="" /></a>
						<a href=""><img id="slide-img-2" src="images/photos/nature-photo1.png" class="slide" alt="" /></a>
						<a href=""><img id="slide-img-3" src="images/photos/nature-photo2.png" class="slide" alt="" /></a>
						<a href=""><img id="slide-img-4" src="images/photos/nature-photo3.png" class="slide" alt="" /></a>
						<a href=""><img id="slide-img-5" src="images/photos/nature-photo4.png" class="slide" alt="" /></a>
						<a href=""><img id="slide-img-6" src="images/photos/nature-photo5.png" class="slide" alt="" /></a>
						<a href=""><img id="slide-img-7" src="images/photos/nature-photo6.png" class="slide" alt="" /></a>
						<a href=""><img id="slide-img-8" src="images/photos/nature-photo7.png" class="slide" alt="" /></a>
							<div id="slide-controls">
							<p id="slide-client" class="text"><strong>post: </strong><span></span></p>
							<p id="slide-desc" class="text"></p>
							<p id="slide-nav"></p>
							</div>
						</div>
					
					<!--content featured gallery here -->
					</div>
					<script type="text/javascript">
						if(!window.slider) var slider={};
						slider.data=[
						{"id":"slide-img-1","client":"varas","desc":"variedades alem da sua imaginação"},
						{"id":"slide-img-2","client":"varas","desc":"variedade de cabos"},
						{"id":"slide-img-3","client":"varas","desc":"trançados em linhas"},
						{"id":"slide-img-4","client":"pesca","desc":"pesca em rios e mares"},
						{"id":"slide-img-5","client":"passadores","desc":"passadores e acabamento"},
						{"id":"slide-img-6","client":"varas","desc":"personalização com seu nome"},
						{"id":"slide-img-7","client":"varas","desc":"trabalhos exoticos com penas e couro de cobra"},
						{"id":"slide-img-8","client":"varas","desc":"acabamento em metais"}];
					</script>
				</div>
			</div>
			';
		}
	}
	
	public function slide()
	{
		return '
			<!--
			<a href="#" class="show"><img src="images/layout/flowing-rock.jpg" alt="Flowing Rock" width="960" height="360" title="" alt="" rel=""/></a>
			-->
			<a href="#"><img src="images/photos/grass-blades.jpg" alt="Grass Blades" width="960" height="360" title="" alt="" rel=""/></a>
			<a href="#"><img src="images/photos/ladybug.jpg" alt="Ladybug" width="960" height="360" title="" alt="" rel=""/></a>
			<a href="#"><img src="images/photos/lightning.jpg" alt="Lightning" width="960" height="360" title="" alt="" rel=""/></a>
			<a href="#"><img src="images/photos/lotus.jpg" alt="Lotus" width="960" height="360" title="" alt="" rel=""/></a>
			<a href="#"><img src="images/photos/mojave.jpg" alt="Mojave" width="960" height="360" title="" alt="" rel=""/></a>
			<a href="#"><img src="images/photos/pier.jpg" alt="Pier" width="960" height="360" title="" alt="" rel=""/></a>
			<a href="#"><img src="images/photos/sea-mist.jpg" alt="Sea Mist" width="960" height="360" title="" alt="" rel="<h3>Sea Mist</h3>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."/></a>
			<a href="#"><img src="images/photos/stones.jpg" alt="Stone" width="960" height="360" title="" alt="" rel="<h3>Stone</h3>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur."/></a>
		';
	}
	
	public function appFacebook($value)
	{
		if ($value == "on") {
			return '
			<iframe src="http://www.facebook.com/plugins/likebox.php?href=https://www.facebook.com/CustomByMarco.br&amp;width=300&amp;colorscheme=light&amp;show_faces=true&amp;stream=false&amp;header=false&amp;height=300"
			scrolling="no"
			frameborder="0"
			style="border:none; overflow:hidden; width:300px; height:300px;
			background-color:#FFFFFF;"
			allowTransparency="true">
			</iframe>
			';
		}
	}
	
	public function sideBanner()
	{
		//if ($value == "on") {
			return '
			<a href="http://www.custombymarco.com.br/loja1/">
				<img src="images/banners/sideBanner.jpg" alt="" width="300" height="300" title="" alt="" rel=""/>
			</a>
			<br /><br />
			';
		//}
	}
	
	public function sideBar()
	{
		return '
		<ul class="nav">
			<li><a href="#">Link um</a></li>
			<li><a href="#">Link dois</a></li>
			<li><a href="#">Link três</a></li>
			<li><a href="#">Link quatro</a></li>
		</ul>
		<p> Os links acima demonstram uma estrutura básica de navegação usando uma lista não ordenada com estilo CSS. Use isso como um ponto de partida e modifique as propriedades para produzir sua aparência exclusiva. Se precisar de submenus, crie os seus próprios usando um menu Spry, um menu widget do Exchange da Adobe ou uma variedade de outras soluções de javascript ou CSS.</p>
		<p>Caso prefira a navegação ao longo da parte superior, simplesmente mova o ul.nav para o topo da página e crie o estilo novamente.</p>
		';
	}
	
	public function footer()
	{
		return '2013';
	}
}