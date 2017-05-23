<?php
/**
 * Content
 *
 * Website content
 * @package 
 * @name Content
 * @author Adriano K. Nakamura <adriano.k.nakamura@gmail.com>
 * @version 0.1
 */
namespace view\layout;

class Content
{
	public static function friedlyUrl($urlAdress)
	{
		$keyCode = '/(http|www|ftp|.dat|.txt|.gif|wget)/';

		if (preg_match($keyCode, $urlAdress)) {
			echo "Erro na URL!";
		//Se a variável passada estiver dentro das normas, executa o else abaixo
		} else {
			if( !empty($urlAdress) ) {
				$url = explode( "/" , $urlAdress);
				if( empty($url[count($url)-1]) ) {
					unset($url[count($url)-1]);
				}
			} else {
				$url[0] = "";
			}
		}

		switch( $url[0] ){
			case 'home':
				$pageParam = array(
					'name'  => "home",
					'title'  => "Inicio",
					'page'   => "view/content/home.php"
				);
				return $pageParam;
				break;
			case 'clientes':
				$pageParam = array(
					'name'  => "clientes",
					'title'  => "Clientes",
					'page'   => "view/content/clientes.php"
				);
				return $pageParam;
				break;
			case 'produtos':
				$pageParam = array(
					'name'  => "produtos",
					'title'  => "Produtos",
					'page'   => "view/content/produtos.php"
				);
				return $pageParam;
				break;
			case 'pedidos':
				$pageParam = array(
					'name'  => "pedidos",
					'title'  => "Pedidos",
					'page'   => "view/content/pedidos.php"
				);
				return $pageParam;
				break;
			case 'pedidoNovo':
				$pageParam = array(
					'name'  => "pedidoNovo",
					'title'  => "Novos Pedidos - Passo-1",
					'page'   => "view/content/pedidoNovo.php"
				);
				return $pageParam;
				break;
			case 'pedidoNovo2':
				$pageParam = array(
					'name'  => "pedidoNovo2",
					'title'  => "Novos Pedidos - Passo-2",
					'page'   => "view/content/pedidoNovo2.php"
				);
				return $pageParam;
				break;


			// Paginas iniciais
			case 'inicio':
				 $pageParam = array(
				 	'name'  => "inicio",
					'title'  => "Inicio",
					'page'   => "view/content/home.php"
				 );
				return $pageParam;
			break;
			case '':
				 $pageParam = array(
				 	'name'  => "home",
					'title'  => "Inicio",
					'page'   => "view/content/home.php"
				 );
				return $pageParam;
			break;
			default:
				$pageParam = array(
					'name'  => "home",
					'title'  => "Inicio",
					'page'   => "view/content/home.php"
				);
				return $pageParam;
			break;
		}
	}	
}