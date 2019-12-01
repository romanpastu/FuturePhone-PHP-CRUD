<?php
require_once("libs/DBConnection.php");
require_once("constants.php");
require_once("libs/Sesion.php");
$ses = Sesion::getInstance() ;
if (!$ses->checkActiveSession()){
    $ses->redirect("index.php") ;
}else {
  $user = $ses->getUsuario();
  if ($user->getIdRol() != '2') {
      $ses->redirect("index.php");
  }
}

$db = new DBConnection(dbConfig());

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>FuturePhone</title>
        <link rel="shortcut icon" type="image/png" href="logos\favicon.png"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

        <script>

        </script>
    </head>
    <body style="background-color: #6F2424;">
        
            <div class="card" style="width: 25rem; margin: 0 auto; margin-top: 10%;">
                <div class="card-body " >
                    <form method="post">
                    <fieldset>

                    <!-- Form Name -->
                    <legend>Nueva Línea</legend>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="tlf">Teléfono</label>  
                      <div class="col-md-10">
                      <input id="tlf" name="tlf" type="text" placeholder="Here" class="form-control input-md" required="">

                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="min">Minutos Consumidos</label>  
                      <div class="col-md-10">
                      <input id="min" name="min" type="number" placeholder="Here" class="form-control input-md" required="">

                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="mb">Megas Consumidos</label>  
                      <div class="col-md-10">
                      <input id="mb" name="mb" type="number" placeholder="Here" class="form-control input-md" required="">

                      </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="tarifa">Tarifa</label>
                      <div class="col-md-10">
                        <select id="tarifa" name="tarifa" class="form-control">
                            <?php
                         $sql = "Select * FROM tarifa";
                         $tarifas = $db->runQueryPDO($sql)->fetchAll();
                         
                         for($i = 0 ; $i <count($tarifas); $i++){
                             $idTar = $tarifas[$i]["idTar"];
                             $nomTar = $tarifas[$i]["NomTar"];
                            ?>                                      
                                <option value=<?= (int)$idTar ?>><?= $nomTar ?></option>                           
                            <?php
                             }
                            ?>
                        </select>
                      </div>
                    </div>
                    
                    <!-- Button -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="enviar"></label>
                      <div class="col-md-4">
                        <button  id="enviar" name="enviar" class="btn btn-danger">Enviar</button>
                      </div>
                    </div>

                    <p></p>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#enviar").click(function(){
                                
                                $.ajax({
                                    type: 'POST',
                                    url: 'addLineaDb.php',
                                    data: {
                                        tlf: $("#tlf").val(),
                                        min: $("#min").val(),
                                        mb: $("#mb").val(),
                                        idTarifa: $("#tarifa").val()
                                    },
                                    success: function(data) {
                                        //alert(data);
                                        //$("p").text("Has insertado los datos");

                                    }
                                });
                    });
                    });
</script>


                    <!-- -->
                            
                    </fieldset>
                    </form>
                   
                </div>
            </div>
            <br> 
            <div class="form-group text-center">
                    <div >
                  <a href= "<?= HOSTNAME ?>/index.php"> <button id="volver" name="volver" class="btn btn-danger">Volver</button></a>
                </div>
            </div>

   
    </body>
</html>