<?php 
	include_once('Config.php');
	$dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName, Config::$dbUser, Config::$dbPassword);
	$result = $dbobject->query(" select * from `cities` where `city_name`='jaipur'");
	echo $result->rowCount();
	$dbobject = null;
?>