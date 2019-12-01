<?php

require_once "libs/Sesion.php";

//se instancia la sesion

$ses = Sesion::getInstance();

//comprobamos si hay sesion activa
if ($ses->checkActiveSession()) {
    $user = $ses->getUsuario();
    if ($user->getIdRol() == '2') {
        $ses->redirect("principalUsuario.php");
    } else if ($user->getIdRol() == '0') {
        $ses->redirect("principalAdmin.php");
    } else if ($user->getIdRol() == '1') {
        $ses->redirect("principalComercial.php");
    }
    //$ses->redirect("main.php");
}

//comprobamos si $_POST ha recibido info

if (!empty($_POST)):
    $dni = $_POST["dni"];
    $pass = $_POST["pass"];

    //intentamos loguearnos
    $ok = $ses->login($dni, $pass);

    //si se realiza el login redirigimos a main
    if ($ok) {
        $user = $ses->getUsuario();

        if ($user->getIdRol() == '2') {
            $ses->redirect("principalUsuario.php");
        } else if ($user->getIdRol() == '0') {
        $ses->redirect("principalAdmin.php");
    } else if ($user->getIdRol() == '1') {
        $ses->redirect("principalComercial.php");
    }

}

endif;

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>FuturePhone</title>
	<meta charset="utf8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="logos\favicon.png"/>
	<link rel="stylesheet" type="text/css" href="css/index.css" />
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

		<!-- formulario de login -->
		<form method="post" style="margin-top:-5vw;">

			<!-- email -->
			<div class="row mt-5 form-group">
				<div class="col-md-12">
					<input class="form-control w-25 mx-auto" type="text"
						   name="dni" placeholder="DNI" required />
				</div>
			</div>

			<!-- contraseña -->
			<div class="row form-group">
				<div class="col-md-12">
					<input class="form-control w-25 mx-auto" type="password"
						   name="pass" placeholder="contraseña" required />
				</div>
			</div>

            <?php
if ((isset($ok)) && (!$ok)):
?>
            <div class="row justify-content-md-center">
			
			
				<div class="col-md-8 text-center">
					<div class="alert alert-danger w-50" role="alert">
					  Usuario o contraseña incorrectas.
					</div>
				</div>
			
			</div>
			<?php
endif;
?>

            <!-- botón LOGIN -->
			<div class="row form-group">
				<div class="col-md-12 text-center">
					<button class="btn btn-danger w-25" type="submit">Entrar</button>
				</div>
			</div>


<div class="row">


	<div class="col-md-4">

		<div class="col-md-12 text-center">
			<a href="api/help.php" class="btn btn-link">Api</a>
		</div>


	</div >
	<div class="col-md-4">

			<div class="col-md-12 text-center">
				<a href="registro.php" class="btn btn-link">Registrar</a>
			</div>

	</div>

	<div class="col-md-4">

			<div class="col-md-12 text-center">
				<a href="listadoTarifas.php" class="btn btn-link">Tarifas</a>
			</div>

	</div >
</div>
        </div> <!-- container -->

</body>
</html>