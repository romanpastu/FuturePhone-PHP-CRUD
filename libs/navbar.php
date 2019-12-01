<?php
require_once("Sesion.php");
require_once("constants.php");
$ses = Sesion::getInstance() ;
if ($ses->checkActiveSession() == false){

    
    $ses->redirect("index.php") ;


}


$user = $ses->getUsuario();
$db = new DBConnection(dbConfig());

$nombre = $user->getNomUsu();
$rol = $user->getIdRol();

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>FuturePhone</title>
	<meta charset="utf8" />
	<link rel="stylesheet" type="text/css" href="css/navbar.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.3.1.js" ></script>


</head>
<body>

	<div class="container-flex">		
		<div class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">FuturePhone</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
				</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link"  href="<?= HOSTNAME ?>/index.php">Inicio</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="api/help.php">Api</a>
					</li>

					<?php if($rol == '0') { ?>
					<li class="nav-item">
						<a class="nav-link" href="api/apiKeyGenerator.php">Key</a>
					</li>
					<?php } ?>

					<li class="nav-item">
						<a class="nav-link" href="logout.php">Salir</a>
					</li>
				
				</ul> 

			</div>	<!-- end-collapse -->

			<div class="navbar-text">
				Bienvenido/a, <?= $nombre ?> 
			</div>

		</div>	<!-- end-navbar -->