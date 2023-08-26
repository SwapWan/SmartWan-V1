<?php
	try {
	$pdo = new PDO('mysql:host=;dbname=','','',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
	} catch (Exception $e) {
		echo "Erro Conexão.php";
	}
?>