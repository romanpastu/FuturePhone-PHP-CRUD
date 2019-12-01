<?php

include 'libs/settings.config.php'; 
require_once("libs/DBConnection.php");
require_once("constants.php");
    if(!empty($_POST)){
        // echo "<pre>".print_r($_POST,true)."</pre>" ;

        //Se capturan los datos del formulario;
        $ema = $_POST["email"];
        $dni = $_POST["dni"];
        $nom = $_POST["nombre"] ;
        $ape = $_POST["apellidos"] ;
        $pas = $_POST["pass"] ;
        $conf = $_POST["conf"] ;
        $tlf = $_POST["tlf"] ;
        $rol = 2; //rol default de cliente
        // comprobar que las contraseñas son iguales
        if ($pas==$conf){
            $db = new DBConnection(dbConfig());
			//echo "$ema , $dni , $nom , $ape, $pas, $tlf, $rol";
			$api = NULL;

			
			$db->runQueryPDO('INSERT INTO usuario VALUES (?, md5(?), ?, ? ,? ,? ,?, ?)', [$dni,$pas,$nom,$ape,$ema,$tlf,$rol, $api]);

        }else{
            $error = "Las contraseñas no coinciden";
        }
	}
	

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Futurephone</title>
	<meta charset="utf8" />
	<link rel="shortcut icon" type="image/png" href="logos\favicon.png"/>
	<link rel="stylesheet" type="text/css" href="css/registro.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>
<body style="background-color: #6F2424">

	<div class="container">

		<!-- logotipo -->
		<div class="row">
			<div class="col-sd-12 mx-auto">
			<img class="logo" src="logos\logo_transparent_cut.png" alt="FuturePhone" style="width:50vw; height:15vw;" />
			</div>
		</div>

		<!-- nota -->
		<div class="row">
			<div class="col-sd-12 mx-auto mb-5">
				<h4 style="color:white">Registro de Usuarios</h4>
			</div>
		</div>

		
		<?php
			if (isset($error)):
				echo "<div class=\"alert alert-danger w-50 mx-auto\">" ;
				echo $error ;
				echo "</div>" ;
			endif ;
		?>

		<!-- formulario de registro -->
		<form method="post">
			
			<!-- email -->
			<div class="row form-group">
				<div class="col-md-4 mx-auto">
					<label class="col-form-label" for="email" style="color:white">Email:</label>
					<input class="form-control" type="email" name="email" 
						   placeholder="email@futurephone.com" required />
				</div>
			</div>

			<!-- DNI -->
			<div class="row form-group">
				<div class="col-md-4 mx-auto">
					<label class="col-form-label" for="dni" style="color:white">DNI:</label>
					<input class="form-control" type="text" name="dni" required />
				</div>
			</div>

                <!-- Nombre -->
			<div class="row form-group">
				<div class="col-md-4 mx-auto">
					<label class="col-form-label" for="nombre" style="color:white">Nombre:</label>
					<input class="form-control" type="text" name="nombre" required />
				</div>
			</div>


			<!-- apellidos -->
			<div class="row form-group">
				<div class="col-md-4 mx-auto">
					<label class="col-form-label" for="apellidos" style="color:white">Apellidos:</label>
					<input class="form-control" type="text" name="apellidos" required />
				</div>
			</div>

            <!-- Numero de contacto -->
			<div class="row form-group">
				<div class="col-md-4 mx-auto">
					<label class="col-form-label" for="tlf" style="color:white">Telefono de contacto:</label>
					<input class="form-control" type="number" name="tlf" required />
				</div>
			</div>

			<!-- contraseña -->
			<div class="row form-group">
				<div class="col-md-4 mx-auto">
					<label class="col-form-label" for="pass" style="color:white">Contraseña:</label>
					<input class="form-control" type="password" name="pass" 
						   required />
				</div>
			</div>

			<!-- confirmación contraseña -->
			<div class="row form-group">
				<div class="col-md-4 mx-auto">
					<label class="col-form-label" for="conf" style="color:white">Confirmación contraseña:</label>
					<input class="form-control" type="password" name="conf" 
						   required />
				</div>
			</div>

			

			<!-- registro -->
			<div class="row form-group">
				<div class="col-md-4 mx-auto">
					<button class="btn btn-primary w-100" type="submit">Registrar</button>
				</div>
			</div>
		</form>

		<!-- volver atrás -->
		<div class="row">
			<div class="col-md-4 mx-auto text-center">
				<a  href= "<?= HOSTNAME ?>/index.php" class="btn btn-link">volver atrás</a>
			</div>
		</div>

	</div> <!-- container -->

	<br/>

</body>
</html>