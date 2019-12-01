<?php

 require_once("libs/Sesion.php");
 require_once("libs/DBConnection.php");
$db = new DBConnection(dbConfig());
$ses = Sesion::getInstance();

if (!$ses->checkActiveSession()){
    $ses->redirect("index.php") ;
}else {
    $user = $ses->getUsuario();
    if ($user->getIdRol() == '0') {
        $ses->redirect("index.php");
    }
}

 $user = $ses->getUsuario();
 $dni = $user->getDNIUsu();
 $rol = $user->getIdRol();

//caso de que sea usuario
 if($rol = '2'){
     
    $param1 = [$dni, $_POST['tlf']];
    $sql = "SELECT * FROM gastos where DNIUsu = ? and TfnGas = ?";
    
    //Este sql solo esta realizando el update si el numero pertenece al usuario de la sesion
   
    if($db->runQueryPDO($sql,$param1)->fetchAll()){
       $param = [$_POST["idTarifa"], $_POST['tlf']];
       $sql2 = "UPDATE gastos SET idTar = ?, MinGas = '0', MegGas = '0' WHERE TfnGas = ?;";
       $db->runQueryPDO($sql2, $param)->fetchAll();
    }
 }

//caso de que sea comercial y pueda cambiar cualquier cosa
if($rol = '1'){
    //var_dump($_POST);
    $param = [$_POST["idTarifa"], $_POST['tlf']];
    $sql2 = "UPDATE gastos SET idTar = ?, MinGas = '0', MegGas = '0' WHERE TfnGas = ?;";
    $db->runQueryPDO($sql2, $param)->fetchAll();
}




    
?>