<?php
session_start();
/** 
 * Ambiente de PRODUÇÃO
 */
	/** Nome a base de dados */
	define('DB_NAME', "adrianon_estoque");

	/** Usuário do banco de dados */
	define('DB_USER', "adrianon_estoque");

	/** Senha do banco de dados */
	define('DB_PASSWORD', "ERcliZUOP1-Q");

	/** nome do host */
	define('DB_HOST', "localhost");

	/** Sistema de banco de dados */
	define('DB_SYSTEM', 'mysql'); //pgsql; mysql;





if (!extension_loaded('pdo')) 
{
    //dl('pdo.so');
	echo "N&atilde;o tem PDO";
} else {
	try {
		$dbh = new PDO(DB_SYSTEM.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}

foreach(PDO::getAvailableDrivers() as $driver) {
	//echo $driver.'<br />';
}
?>