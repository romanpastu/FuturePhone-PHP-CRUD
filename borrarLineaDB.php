<?php

require_once("libs/Sesion.php");
 require_once("libs/DBConnection.php");
$db = new DBConnection(dbConfig());
$ses = Sesion::getInstance();

if (!$ses->checkActiveSession()){
    $ses->redirect("index.php") ;
}else {
    $user = $ses->getUsuario();
    if ($user->getIdRol() != '1') {
        $ses->redirect("index.php");
    }
}


//var_dump($_POST['idLineaDel']);

$param =[$_POST['idGasDel']];
$sql = "DELETE from gastos where idGas = ?";
$db->runQueryPDO($sql, $param)->fetchAll();


?>