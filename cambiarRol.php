
<?php
require_once "libs/DBConnection.php";
require_once("constants.php");
require_once "libs/Sesion.php";

$ses = Sesion::getInstance();

if (!$ses->checkActiveSession()) {

    $ses->redirect("index.php");

} else {
    $user = $ses->getUsuario();
    if ($user->getIdRol() != '0') {
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

    <div class="card" style="width: 25rem; margin: 0 auto; margin-top: 10%; margin-top:1vw">
      <div class="card-body " >
        <form class="form-horizontal" method="post">
        <fieldset>

        <!-- Form Name -->
        <legend>Cambiar rol</legend>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="dni">DNI</label>
          <div class="col-md-10">
          <select id="dni" name="dni" class="form-control">
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

        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="rol">Rol</label>
          <div class="col-md-10">
            <select id="rol" name="rol" class="form-control">
              <option value="2">Usuario Normal</option>
              <option value="0">Administrador</option>
              <option value="1">Comercial</option>
            </select>
          </div>
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
                                    url: 'cambiarRolDB.php',
                                    data: {
                                        rol: $("#rol").val(),
                                        dni: $("#dni").val()
                                    },
                                    success: function(data) {
                                      aler(data);
                                    }
                                });
                    });
                    });
        </script>



        </fieldset>
        </form>
</div></div>
<div class="form-group text-center" style="margin-top:1vw">
  <div>
  <a href= "<?= HOSTNAME ?>/index.php"> <button  id="volver" name="volver" class="btn btn-danger">Volver</button></a>
  </div>
</div>
    </body>
</html>