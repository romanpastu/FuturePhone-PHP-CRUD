<?php
require_once "libs/DBConnection.php";
require_once("constants.php");
require_once "libs/Sesion.php";

$ses = Sesion::getInstance();

if (!$ses->checkActiveSession()) {

    $ses->redirect("index.php");

} else {
    $user = $ses->getUsuario();
    if ($user->getIdRol() != '1') {
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

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="shortcut icon" type="image/png" href="logos\favicon.png"/>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    </head>
<body style="background-color: #6F2424;">
<div class="form-group text-center">
  <div>
  <a href= "<?= HOSTNAME ?>/index.php"> <button  id="volver" name="volver" class="btn btn-danger">Volver</button></a>
  </div>
</div>


<div class="card" style="width: 25rem; margin: 0 auto; margin-top: 10%; margin-top:1vw">
      <div class="card-body " >
<!-- Borrar lineas !-->
<legend>Borrar lineas</legend>
<form  class="form-horizontal" name="delete" method="POST" >
            <select id="idGasDel" name="idGasDel" class="form-control col-md-10">
                            <?php
$sql = "Select * FROM gastos";
$gastos = $db->runQueryPDO($sql)->fetchAll();

for ($i = 0; $i < count($gastos); $i++) {
    $idGasDel = $gastos[$i]["idGas"];
    $tfnGas = $gastos[$i]["TfnGas"];
    ?>
                                <option value=<?=(int) $idGasDel?>><?=$tfnGas?></option>
                            <?php
}
?>
                    </select>

            <div class="form-group">
             <label class="col-md-4 control-label" for="borrar"></label>

            <button id="borrar" name="borrar" class="btn btn-danger" style="margin-top:1vw">Borrar linea</button>

            </div>

            <script type="text/javascript">

        $(document).ready(function(){
                            $("#borrar").click(function(){

                                $.ajax({
                                    type: 'POST',
                                    url: 'borrarLineaDB.php',
                                    data: {
                                        idGasDel: $("#idGasDel").val(),
                                    },
                                    success: function(data) {
                                      //alert(data);
                                    }
                                });
                    });
                    });
        </script>
            </form>
</div></div>

<div class="card" style="width: 25rem; margin: 0 auto; margin-top: 10%; margin-top:0">
      <div class="card-body " >
<!--cambiar la tarifa de la linea-->
<form class="form-horizontal" method="post">
        <fieldset>
        <!-- Form Name -->
        <legend>Seleccione su nueva tarifa</legend>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="num1">Número</label>
          <select id="num1" name="num1" class="form-control col-md-10">
                            <?php
$sql = "Select * FROM gastos";
$gastos = $db->runQueryPDO($sql)->fetchAll();

for ($i = 0; $i < count($gastos); $i++) {
    $idGas = $gastos[$i]["idGas"];
    $tfnGas = $gastos[$i]["TfnGas"];
    ?>
                                <option value=<?=$tfnGas?>><?=$tfnGas?></option>
                            <?php
}
?>
                    </select>
        </div>

        <!-- Select Basic -->
        <div    class="form-group">
          <label class="col-md-4 control-label" for="tarifa">Tarifa</label>

            <select id="opcion1" name="opcion1" class="form-control col-md-10">
            <?php
$sql = "Select * FROM tarifa";
$tarifas = $db->runQueryPDO($sql)->fetchAll();

for ($i = 0; $i < count($tarifas); $i++) {
    $idTar = $tarifas[$i]["idTar"];
    $nomTar = $tarifas[$i]["NomTar"];
    ?>
                                <option value=<?=$idTar?>><?=$nomTar?></option>
                            <?php
}
?>
            </select>

        </div>

        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="cambiar"></label>

            <button id="cambiar" name="cambiar" class="btn btn-danger">Cambiar</button>

        </div>



        <script type="text/javascript">

        $(document).ready(function(){
                            $("#cambiar").click(function(){

                                $.ajax({
                                    type: 'POST',
                                    url: 'changeTarifaDB.php',
                                    data: {
                                        tlf: $("#num1").val(),
                                        idTarifa: $("#opcion1").val()
                                    },
                                    success: function(data) {
                                        //alert(data);


                                    }
                                });
                    });
                    });
        </script>



        </fieldset>
        </form>
</div></div>

<!-- añadir linea-->
<div class="card" style="width: 25rem; margin: 0 auto; margin-top:0;">
                <div class="card-body">
                    <form method="post">
                    <fieldset>

                    <!-- Form Name -->
                    <legend>Nueva Línea</legend>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="dni">DNI</label>
                      <div class="col-md-10">
                      <select id="dni" name="dni" class="form-control col-md-12">
                      <?php
                            $sql = "Select * FROM usuario";
                            $usuarios = $db->runQueryPDO($sql)->fetchAll();

                            for ($i = 0; $i < count($usuarios); $i++) {
                            $dni = $usuarios[$i]["DNIUsu"];
                      ?>
                                <option value=<?=$dni?>><?=$dni?></option>
                            <?php
                                  }
                                    ?>
                    </select>

                      </div>
                    </div>

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

for ($i = 0; $i < count($tarifas); $i++) {
    $idTar = $tarifas[$i]["idTar"];
    $nomTar = $tarifas[$i]["NomTar"];
    ?>
                                <option value=<?=(int) $idTar?>><?=$nomTar?></option>
                            <?php
}
?>
                        </select>
                      </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="enviar"></label>

                        <button  id="enviar" name="enviar" class="btn btn-danger">Crear</button>

                    </div>


                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#enviar").click(function(){

                                $.ajax({
                                    type: 'POST',
                                    url: 'addLineaDb.php',
                                    data: {
                                        dni: $("#dni").val(),
                                        tlf: $("#tlf").val(),
                                        min: $("#min").val(),
                                        mb: $("#mb").val(),
                                        idTarifa: $("#tarifa").val()
                                    },
                                    success: function(data) {
                                        //alert(data);
                                    }
                                });
                    });
                    });
</script>
</div>
</div>


<br>








  </body>
  </html>