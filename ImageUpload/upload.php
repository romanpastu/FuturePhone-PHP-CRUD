<?php
require_once "config.php";
require_once "imgupload.class.php";
require_once("../libs/DBConnection.php");
require_once("../constants.php");


$db = new DBConnection(array(
	'driver' => 'mysql',
	'host' => 'localhost',
	'dbname' => 'futurephone',
	'username' => 'root',
    'password' => ''));

$img = new ImageUpload;

$result = $img->uploadImages($_FILES['image']);

if(!empty($result->error)){
	foreach($result->error as $errMsg){
		echo $errMsg;
	}
}

if(!empty($result->ids)){
    foreach($result->ids as $id){
        //echo "https://your_website.com/image.php?id=". $id;
        $params = [$id,$_POST["idTar"]];
        $sql = "UPDATE tarifa SET idImg = ? where idTar = ?";
        $tarifas = $db->runQueryPDO($sql,$params)->fetchAll();

        header("Location: http://localhost/proyectoDwes/FuturePhone-PHP-CRUD/index.php");

        // $ref=  HOSTNAME."/index.php";
        // echo "<script>window.location = ".$ref.";</script>";  
        // exit;

        die();
    }


}
?>