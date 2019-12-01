<?php
require_once("../libs/DBConnection.php");
require_once("../libs/Sesion.php");

$ses = Sesion::getInstance() ;

if (!$ses->checkActiveSession()){   
    $ses->redirect("index.php") ;

}else{
    $user = $ses->getUsuario();
	if($user->getIdRol() != '0'){
		$ses->redirect("index.php");
	}
}

$db = new DBConnection(dbConfig());

$nombre = $user->getNomUsu();
$dni = $user->getDNIUsu();

$api_key = md5($nombre."**".time());
echo "Debajo esta tu clave api, guardala";
echo "<br>";
echo $api_key;

$param = [$api_key, $dni];
$sql = "UPDATE usuario SET apiKey = ? where DNIUsu = ?";
$db->runQueryPDO($sql, $param)->fetchAll();



?>