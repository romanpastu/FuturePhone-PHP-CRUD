<?php

require_once("libs/Sesion.php");
 require_once("libs/DBConnection.php");
$db = new DBConnection(dbConfig());
$ses = Sesion::getInstance();

if (!$ses->checkActiveSession()){
    $ses->redirect("index.php") ;
}else {
    $user = $ses->getUsuario();
    if ($user->getIdRol() != '0') {
        $ses->redirect("index.php");
    }
}


//var_dump($_POST['idTarDel']);

$param =[$_POST['idTarDel']];
$sql = "DELETE from tarifa where idTar = ?";
$db->runQueryPDO($sql, $param)->fetchAll();


?>