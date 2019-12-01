<?php
require_once "libs/Sesion.php";

$ses = Sesion::getInstance() ;
$ses->close() ;
$ses->redirect("index.php") ;
?>