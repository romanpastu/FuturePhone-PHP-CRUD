<?php
//solo accesible por cliente y comercial, cliente solo capaz de cambiar las suyas, y comercial todas.
//Me falta por hacer que el select de lineas muestre o todas o las del cliente en funcion del usuario
require_once("libs/DBConnection.php");
require_once("constants.php");
require_once("libs/Sesion.php");
$ses = Sesion::getInstance() ;
if (!$ses->checkActiveSession()){
    $ses->redirect("index.php") ;
}

  $user = $ses->getUsuario();
 if($user->getIdRol() != '2'){
   $ses->redirect("index.php");
 }


$db = new DBConnection(dbConfig());

$user = $ses->getUsuario();
$dni = $user->getDNIUsu();



//Test query

$param1 = ["12345678B","555555555"];
$sql = "SELECT * FROM gastos where DNIUsu = ? and TfnGas = ?";
$sqlres = $db->runQueryPDO($sql,$param1)->fetchAll();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Futurephone</title>
        <link rel="shortcut icon" type="image/png" href="logos\favicon.png"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    </head>
    <body style="background-color: #6F2424;">
    <div class="card" style="width: 25rem; margin: 0 auto; margin-top: 10%;">
      <div class="card-body " >
        <form class="form-horizontal" method="post">
        <fieldset>
        <!-- Form Name -->
        <legend>Seleccione su nueva tarifa</legend>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="num1">Número</label>  
          <select id="num1" name="num1" class="form-control col-md-10">
                            <?php
                         $sql = "Select * FROM gastos where DNIUsu = ?";
                         $gastos = $db->runQueryPDO($sql,[$user->getDNIUsu()])->fetchAll();
                         
                         for($i = 0 ; $i <count($gastos); $i++){
                             $idGas = $gastos[$i]["idGas"];
                             $tfnGas = $gastos[$i]["TfnGas"];
                            ?>                                      
                                <option value=<?= $tfnGas  ?>><?= $tfnGas ?></option>                           
                            <?php
                             }
                            ?>
                    </select>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="tarifa">Tarifa</label>
          
            <select id="opcion" name="opcion" class="form-control col-md-10">
            <?php
                         $sql = "Select * FROM tarifa";
                         $tarifas = $db->runQueryPDO($sql)->fetchAll();
                         
                         for($i = 0 ; $i <count($tarifas); $i++){
                             $idTar = $tarifas[$i]["idTar"];
                             $nomTar = $tarifas[$i]["NomTar"];
                             echo $idTar;
                             echo $nomTar;
                            ?>                                      
                                <option value=<?= (int)$idTar ?>><?= $nomTar ?></option>
                            <?php
                             }
                            ?>
            </select>
          
        </div>

        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="cambiar"></label>
          <div class="col-md-4">
            <button id="cambiar" name="cambiar" class="btn btn-danger">Cambiar</button>
          </div>
        </div>


        <p></p>
        <script type="text/javascript">
            
        $(document).ready(function(){
                            $("#cambiar").click(function(){
                                
                                $.ajax({
                                    type: 'POST',
                                    url: 'changeTarifaDB.php',
                                    data: {
                                        tlf: $("#num1").val(),
                                        idTarifa: $("#opcion").val()
                                    },
                                    success: function(data) {
                                        //alert(data);
                                        //$("p").text("Has insertado los datos");

                                    }
                                });
                    });
                    });
        </script>



        </fieldset>
        </form>
    </div>
    </div>
    <br> 
            <div class="form-group text-center">
                    <div >
                    <a href= "<?= HOSTNAME ?>/index.php"> <button  id="volver" name="volver" class="btn btn-danger">Volver</button></a>
                </div>
            </div>
        
    </body>
</html>