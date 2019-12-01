<?php 
  
  require_once("libs/Sesion.php");
  require_once("libs/DBConnection.php");

  $ses = Sesion::getInstance() ;
  $db = new DBConnection(dbConfig());
  
  if (!$ses->checkActiveSession()){

    
    $ses->redirect("index.php") ;


 }else {
  $user = $ses->getUsuario();
   if ($user->getIdRol() == '0') {
       $ses->redirect("index.php");
   }
 }
 
  $user = $ses->getUsuario();
  if($user->getIdRol() == '1' ){
    $dni = $_POST["dni"];
  }else if($user->getIdRol() == '2'){
    $dni = $user->getDNIUsu();
  }
  
  
 




  $param = [$dni, $_POST["idTarifa"] ,$_POST["tlf"],$_POST["min"], $_POST["mb"]];
  $sql = "INSERT INTO gastos (DNIUsu, IdTar, TfnGas, MinGas, MegGas) VALUES ( ?, ?, ?, ?, ?)";
  $db->runQueryPDO($sql, $param)->fetchAll();



 ?>