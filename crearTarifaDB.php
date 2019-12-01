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

$param =[$_POST['nombre'],$_POST['precio'],$_POST['minutos'],$_POST['megas'],$_POST['desc']];
var_dump($param);
$sql = "INSERT into tarifa (NomTar, PrecTar, MinTar, MegTar, Descr) VALUES(?,?,?,?,?)";
$db->runQueryPDO($sql, $param)->fetchAll();



?>

