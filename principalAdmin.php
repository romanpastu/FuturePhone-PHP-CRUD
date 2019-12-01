<?php
require_once("libs/DBConnection.php");

require_once("libs/Sesion.php");
require_once("libs/navbar.php") ;




if ($ses->checkActiveSession() == false){

    
    $ses->redirect("index.php") ;


}else{
    $user = $ses->getUsuario();
	if($user->getIdRol() != '0'){
		$ses->redirect("index.php");
	}
}

    $db = new DBConnection(dbConfig());

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
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        

<script type="text/javascript">

$(document).ready(function(){
                $( ".ver" ).click( function(event){

                    event.preventDefault();
                    event.target.dataset.state = 1 - event.target.dataset.state;
                    var pulsado = $(this).data("dnipass"); 

                    $.ajax({
                        type: 'POST',
                        url: 'adminVerLineas.php',
                        data: {
                            dni:pulsado
                        },
                        success: (data) => {
                            switch( parseInt( event.target.dataset.state ) ){
                                case 1:
                                    $(this).closest('.form-group').next('.userInfo').append( data ); 
                                break;
                                case 0:
                                    $(this).closest('.form-group').next('.userInfo').text('');
                                break;
                            }

                        }
                    });
                });
            })
</script>


    </head>
    <body  style="background-color: #6F2424">
        
        
        <div class="text-center">
        <br>
            <h3 style="color:white">Bienvenido al panel de administración de Futurephone</h3>
            <h3 style="color:white">Desde aquí puedes visualizar y modificar los datos de nuestros clientes</h3>
            <br>
            <div style="padding-bottom: 2%;">
                <button class="btn btn-danger" onclick="location.href='cambiarRol.php'">Cambiar Rol</button>
                <button class="btn btn-danger" onclick="location.href='gestorTarifas.php'">Gestor Tarifas</button>
            </div>
        </div>
            <?php
        $sql = "SELECT * FROM usuario WHERE IdRol != '0'";
        $usuarios = $db->runQueryPDO($sql)->fetchAll();
        //var_dump($usuarios);

        for($i = 0 ; $i < count($usuarios); $i++){
            $nombre = $usuarios[$i]["NomUsu"];
            $apellido = $usuarios[$i]["ApeUsu"];
            $email = $usuarios[$i]["EmaUsu"];
            $dni = $usuarios[$i]["DNIUsu"];

            $rol = $usuarios[$i]["IdRol"];
            $rol = $db->runQueryPDO("SELECT NomRol FROM roles where idRol = ?", [$rol])->fetchAll();
            $rol = $rol[0]["NomRol"];
            
            ?>   
               
                    <div class="text-center">
                        <table style="background-color: white; " class="table table-bordered">
                            <tr>
                                <td style="width: 50%">Nombre</td>
                                <td style="width: 50%"><?= $nombre?></td>
                            </tr>
                            <tr>
                                <td>Apellido</td>
                                <td><?= $apellido?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?= $email?></td>
                            </tr>
                            <tr>
                                <td>DNI</td>
                                <td><?= $dni?></td>
                            </tr>
                            <tr>
                                <td>Rol</td>
                                <td><?= $rol?></td>
                            </tr>
                            <?php if($usuarios[$i]["IdRol"] == '2'){ ?>
                                    <tr>
                                        <td align="center" colspan="2" >
                                        <!-- -->
                                                <!-- Button -->
                                                <div class="form-group">
                                                  <label class="col-md-4 control-label" for="ver"></label>
                                                  <div class="col-md-4">
                                                    <button data-state="0" data-dnipass="<?= $dni?>" class="ver btn btn-danger" name="ver">Ver líneas</button>
                                                  </div>
                                                </div>   
                                            <table id ="<?= $i?>" class="table userInfo" data-formpost="<?= $dni?>" ></table> 
                                        
                                        
                                    </tr>
                                    
                                <?php } ?>
                                
                            
                                
                        </table>
                    </div>
                </div>
          <?php } ?> 
            
    </body>
</html>