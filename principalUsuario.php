<?php

require_once("libs/DBConnection.php");

require_once("libs/Sesion.php");
require_once("libs/navbar.php") ;




if (!$ses->checkActiveSession()){

    
    $ses->redirect("index.php") ;


}else{
    $user = $ses->getUsuario();
	if($user->getIdRol() != '2'){
		$ses->redirect("index.php");
	}
}
    
    //var_dump($user);

    $db = new DBConnection(dbConfig());

    $email = $user->getEmaUsu(); 
    $dni = $user->getDNIUsu();
    $nombre = $user->getNomUsu();


?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>FuturePhone</title>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="shortcut icon" type="image/png" href="logos\favicon.png"/>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </head>
    <body style="background-color: #6F2424">
<div class="text-center">
            
            <br>
        </div>
        <div class="text-center">
            <button class="btn btn-danger" onclick="window.location.href='addLinea.php'"> Añadir una linea nueva</button>
            <button class="btn btn-danger" onclick="location.href='changeTarifa.php'">Cambiar de tarifa</button>
        </div>
        <br>

<?php
//Obtenemos la tabla gastos perteneciente al usuario
$param = [$dni];
$sql = "Select idGas, MinGas, MegGas, IdTar, DNIUsu, TfnGas FROM GASTOS where DNIUsu = ?";
$gastos = $db->runQueryPDO($sql, $param)->fetchAll();

echo "<br>";


if(count($gastos)>0){
    echo "<h3 style='text-align:center; color:white;'>Estas son tus líneas contratadas:</h3>";
}else{
    echo "<h3 style='text-align:center'>Actualmente no tienes lineas contratadas, contrata una!</h3>";
}

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

?>


<table style="background-color: white" class="table  table-bordered">
                        <tr>
                            <td align="center" style="width: 50%">Número</td>
                            <td align="center" style="width: 50%"><?= $tfnGas?></td>
                        </tr>
                        <tr>
                            <td align="center" >Minutos Gastados</td>
                            <td align="center"><?= $minGas?> / <?= $minTar?></td>
                        </tr>
                        <tr>
                            <td align="center">Megas Gastados</td>
                            <td align="center"><?= $megGas?> / <?= $megTar?></td>
                        </tr>
                        <tr>
                            <td align="center">Tarifa</td>
                            <td align="center"><?= $nomTar?></td>
                        </tr>
                        

                    </table>

                    <?php

                } 
                
                ?>
                    <br>

                   
        </body>
        </html>