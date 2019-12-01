<?php
require_once("libs/Sesion.php");
require_once("libs/DBConnection.php");
$db = new DBConnection(dbConfig());
$ses = Sesion::getInstance();

if (!$ses->checkActiveSession()){

    
    $ses->redirect("index.php") ;


}

$param = [$_POST["rol"], $_POST['dni']];
$sql = "UPDATE usuario SET IdRol = ? WHERE DNIUsu = ?;";
$db->runQueryPDO($sql, $param)->fetchAll();


?>