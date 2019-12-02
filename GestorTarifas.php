<?php
require_once("libs/DBConnection.php");
require_once("constants.php");
require_once("libs/Sesion.php");



$ses = Sesion::getInstance() ;

if (!$ses->checkActiveSession()){

    
    $ses->redirect("index.php") ;


}else{
    $user = $ses->getUsuario();
	if($user->getIdRol() != '0'){
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

<!-- Borrar las tarifas !-->
<div class="card" style="width: 25rem; margin: 0 auto; margin-top: 10%; margin-top:1vw">
      <div class="card-body " >
      <legend>Elige la tarifa a borrar</legend>
            <form  class="form-horizontal" name="delete" method="POST" >
            <select id="idTarDel" name="idTarDel" class="form-control col-md-10">
                            <?php
                         $sql = "Select * FROM tarifa";
                         $tarifas = $db->runQueryPDO($sql)->fetchAll();
                         
                         for($i = 0 ; $i <count($tarifas); $i++){
                             $idTarDel = $tarifas[$i]["idTar"];
                             $nomTar = $tarifas[$i]["NomTar"];
                            ?>                                      
                                <option value=<?= (int)$idTarDel ?>><?= $nomTar ?></option>                           
                            <?php
                             }
                            ?>
                    </select>

            <div class="form-group">
             <label class="col-md-4 control-label" for="borrar"></label>
            
            <button style="margin-top:1vw" id="borrar" name="borrar" class="btn btn-danger">Borrar tarifa</button>
            
            </div>

            <script type="text/javascript">
            
        $(document).ready(function(){
                            $("#borrar").click(function(){
                           
                                $.ajax({
                                    type: 'POST',
                                    url: 'borrarTarifaDB.php',
                                    data: {
                                        idTarDel: $("#idTarDel").val(),
                                    },
                                    success: function(data) {
                                      //alert(data);
                                    }
                                });
                    });
                    });
        </script>               
            </form>
            </div>
            </div>




    <div class="card" style="width: 25rem; margin: 0 auto; margin-top: 10%; margin-top:1vw">
      <div class="card-body " >
<!-- Crear la tarifa con sus detalles !-->
        <form class="form-horizontal" method="post">
        <fieldset>

        <!-- Form Name -->
        <legend>Crear Tarifa</legend>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="nombre">Nombre</label>  
          <div class="col-md-10">
          <input id="nombre" name="nombre" type="text" placeholder="Nombre de la tarifa" class="form-control input-md" required="">
          </div>

          <label class="col-md-4 control-label" for="precio">Precio</label>  
          <div class="col-md-10">
          <input id="precio" name="precio" type="text" placeholder="Precio de la tarifa" class="form-control input-md" required="">
          </div>

          <label class="col-md-4 control-label" for="minutos">Minutos</label>  
          <div class="col-md-10">
          <input id="minutos" name="minutos" type="text" placeholder="Minutos de la tarifa" class="form-control input-md" required="">
          </div>

          <label class="col-md-4 control-label" for="megas">Megas</label>  
          <div class="col-md-10">
          <input id="megas" name="megas" type="text" placeholder="Megas de la tarifa" class="form-control input-md" required="">
          </div>

          <label class="col-md-4 control-label" for="descripcion">Descripcion</label> 
          <div class="col-md-10"> 
          <textarea id="descripcion" name="descripcion" class="form-control" id="descripcion" rows="3"></textarea>
          </div>
          

        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="crear"></label>
          
            <button style="margin-top:1vw" id="crear" name="crear" class="btn btn-danger">Crear tarifa</button>
          
        </div>

        <script type="text/javascript">
            
        $(document).ready(function(){
                            $("#crear").click(function(){
                            
                                $.ajax({
                                    type: 'POST',
                                    url: 'crearTarifaDB.php',
                                    data: {
                                        nombre: $("#nombre").val(),
                                        precio: $("#precio").val(),
                                        minutos: $("#minutos").val(),
                                        megas: $("#megas").val(),
                                        desc: $("#descripcion").val()
                                    },
                                    success: function(data) {
                                      //alert(data);
                                    }
                                });
                    });
                    });
        </script>


            
        </fieldset>
       
        </div>
       </div>
       </div> 
        </form>

        <br>
        <br>
        <!-- Subir imagenes para las tarifas !-->


<!--
        <div class="card" style="width: 25rem; margin: 0 auto; margin-top: 10%; margin-top:1vw">
        <div class="card-body " >

            <form name="upload" action="../FuturePhone-PHP-CRUD/ImageUpload/upload.php" method="POST" enctype="multipart/form-data">
                <legend>Elige la portada de la tarifa</legend>
                <div class="col-md-10"> 
                <input id="upload" type="file" name="image[]" multiple >
                <div class="col-md-10"> 


                <select id="idTar" name="idTar" class="form-control col-md-10" style="margin-top:1vw;">
                            CODESTART /*
                         $sql = "Select * FROM tarifa";
                         $tarifas = $db->runQueryPDO($sql)->fetchAll();
                         
                         for($i = 0 ; $i <count($tarifas); $i++){
                             $idTar = $tarifas[$i]["idTar"];
                             $nomTar = $tarifas[$i]["NomTar"]; */
                            CODEEND                                     
                                <option value= CODESTART/* (int)$idTar CODEEND>CODESTART $nomTar */ CODEEND</option>                           
                            CODESTART
                            /* } */
                            CODEEND
                    </select>
                    <label class="col-md-4"></label>         

                <input  type="submit" name="upload" value="Subir imágen" class="btn btn-danger" style="margin-top:1vw">
                </label>
            </form>
            </div>
            </div>
-->
   

    </body>
</html>
