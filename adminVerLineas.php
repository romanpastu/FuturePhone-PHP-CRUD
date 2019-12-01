
<?php
 require_once("libs/Sesion.php");
 require_once("libs/DBConnection.php");
$db = new DBConnection(dbConfig());
$ses = Sesion::getInstance();
if (!$ses->checkActiveSession()){

    
   $ses->redirect("index.php") ;


}

$user = $ses->getUsuario();


$param = [$_POST["dni"]];
$sql = "Select idGas, MinGas, MegGas, IdTar, DNIUsu, TfnGas FROM GASTOS where DNIUsu = ?";
$gastos = $db->runQueryPDO($sql, $param)->fetchAll();
//Se ejecutara si no tiene ninguna linea contrada
if(!$gastos){
   echo "<tr>
   <td align='center' style='color:rgb(0,153,0)'>Este usuario no tiene ninguna linea contratada</td>
   </tr>";
}else{ //se ejecutara si tiene lineas contratadas
   for($i = 0; $i<count($gastos); $i++){
      $tfnGas = $gastos[$i]['TfnGas'];
      $minGas = $gastos[$i]['MinGas'];
      $megGas = $gastos[$i]['MegGas'];
      $idTar = $gastos[$i]['IdTar'];
      
      $sql2 = "Select NomTar, MinTar, MegTar, idTar FROM TARIFA WHERE idTar = ?";
          $param2 = [$idTar];
          $tarifa = $db->runQueryPDO($sql2, $param2)->fetchAll();
      
          $minTar = $tarifa[0]['MinTar'];
          $megTar = $tarifa[0]['MegTar'];
          $nomTar = $tarifa[0]['NomTar'];
         
         echo "<tr>
         <td align='center' style='width: 50%; color:rgb(0,153,0)'>Número</td>
         <td align='center' style='color:rgb(0,153,0)'>$tfnGas</td>
      </tr>
      <tr>
         <td align='center' >Minutos Gastados</td>
         <td align='center' >$minGas / $minTar</td>
      </tr>
      <tr>
         <td align='center'  >Megas Gastados</td>
         <td align='center'  >$megGas/  $megTar</td>
      </tr>
      <tr>
         <td align='center' >Tarifa</td>
         <td align='center'  >$nomTar</td>
      </tr>";
      
      }
}





?>