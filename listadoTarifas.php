<?php
require_once "libs/DBConnection.php";
require_once "libs/Sesion.php";
require_once "ImageUpload/config.php";
require_once "ImageUpload/imgupload.class.php";
require_once("constants.php");

$img = new ImageUpload;

$db = new DBConnection(dbConfig());

$sql = "Select * FROM tarifa";
$tarifas = $db->runQueryPDO($sql)->fetchAll();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>FuturePhone</title>
        <link rel="shortcut icon" type="image/png" href="logos\favicon.png"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </head>
    <body style="background-color: #6F2424;">

<!-- logotipo -->
    <div  class="container ">
			<div class="col-sd-12 mx-auto ">
				<img class="logo mx-auto d-block" src="logos\logo_transparent_cut.png" alt="FuturePhone" style="width:50vw; height:15vw;" />
			</div>
		</div>
    <?php for ($i = 0; $i < count($tarifas); $i++) {
    $nomTar = $tarifas[$i]['NomTar'];
    $precTar = $tarifas[$i]['PrecTar'];
    $minTar = $tarifas[$i]['MinTar'];
    $megTar = $tarifas[$i]['MegTar'];
    $descTar = $tarifas[$i]['Descr'];
    $idImg = $tarifas[$i]['idImg'];
    ?>
    <div class="container">
    <div class="row">
        <div class="col col-md-3">
            <div class="card h-100">
                <img style="width:12vw; height:12vw; margin: 0 auto" src="<?= HOSTNAME ?>/imagenes/logo_movistar.jpg"/>
                <p class="card-text font-weight-bold" style="text-align:center "><?=$nomTar?></p>
            </div>
        </div>
        <div class="col col-md-9">
            <div class="card">
                <p class="card-body "><span class="font-weight-bold">Descripción:</span> <?=$descTar?><p>

            </div>
            <div class="card">
                <div class="col col-md-3 font-weight-bold"> <p>Specs:</p></div>
                <div class="col col-md-3 "> Precio: <?=$precTar?></div>
                <div class="col col-md-3 "> Minutos:  <?=$minTar?></div>
                <div class="col col-md-3 "> Megas:  <?=$megTar?></div>
            </div>
        </div>
    </div>
    </div>
    <br>
    <?php }?>


    </body>
</html>