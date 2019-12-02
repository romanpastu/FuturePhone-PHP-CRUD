<?php
require_once("../libs/DBConnection.php");
require_once("../libs/settings.config.php");




//http://localhost:8012/futurephone29nov/futurephone/api/api.php?action=get_tarifa&nombre=tarifa3
function get_tarifa_by_nombre($nombre)
{
  $db = new DBConnection(dbConfig());
  $params = [$nombre];
  $sql = "Select NomTar, PrecTar, MinTar, MegTar FROM tarifa where NomTar = ?";
  
  $info_tarifa = $db->runQueryPDO($sql,$params)->fetchAll(PDO::FETCH_OBJ);
  return $info_tarifa;

}

//http://localhost:8012/futurephone29nov/futurephone/api/api.php?action=get_tarifa_list
function get_tarifa_list()
{
   $db = new DBConnection(dbConfig());
   $sql = "Select NomTar from tarifa";
   $tarifa_list = $db->runQueryPDO($sql)->fetchAll(PDO::FETCH_OBJ);

  return $tarifa_list;
}

//http://localhost:8012/futurephone29nov/futurephone/api/api.php?action=delete_tarifa&nombre=tarifa3
function delete_tarifa($nombre)
{
    $db = new DBConnection(dbConfig());
    $params = [$nombre];
    $sql = "DELETE from tarifa where NomTar = ?";
    $db->runQueryPDO($sql,$params)->fetchAll();

}

$possible_url = array("delete_tarifa" /*http://localhost:8012/futurephone29nov/futurephone/api/api.php?action=delete_tarifa&key=525a492688d204decb29c7d48ca6873a&dni=12345678A&nombre=tarifa2*/ ,
                      "get_tarifa_list" /*http://localhost:8012/futurephone29nov/futurephone/api/api.php?action=get_tarifa_list*/ , 
                      "get_tarifa" /*http://localhost:8012/futurephone29nov/futurephone/api/api.php?action=get_tarifa&nombre=tarifa3*/);

$value = "Ha ocurrido un error";

if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url))
{
  switch ($_GET["action"])
    {
    //http://localhost:8012/futurephone29nov/futurephone/api/api.php?action=get_tarifa_list
    //no precisa argumento
      case "get_tarifa_list":
        $value = get_tarifa_list();
        break;
    //http://localhost:8012/futurephone29nov/futurephone/api/api.php?action=get_tarifa&nombre=tarifa3
    //precisa del argumento nombretarifa
      case "get_tarifa":
        if (isset($_GET["nombre"])){
          $value = get_tarifa_by_nombre($_GET["nombre"]);
        }
        else{
            $value = "Argumentos no encontrados";
        }
          
        break;
    //http://localhost:8012/futurephone29nov/futurephone/api/api.php?action=delete_tarifa&key=525a492688d204decb29c7d48ca6873a&dni=12345678A&nombre=tarifa2
    //precisa del argumento api_key , dni , nombretarifa
        case "delete_tarifa":
        if(isset($_GET["key"])){
            $db = new DBConnection(dbConfig());
            if($db->runQueryPDO("SELECT * from usuario where apiKey = ? and DNIUsu = ?",[$_GET["key"],$_GET["dni"]])->fetchAll()){
                if (isset($_GET["nombre"])){
                    delete_tarifa($_GET["nombre"]); 
                    $value = "deleted";
                }
                else{
                    $value="Argumentos de nombre no encontrado";
                } 
            }else{
                $value="La key no existe";
            }   
        }else{
            $value="La key de acceso no se ha introducido";
        }
            
        break; 
    }
}

exit(json_encode($value));

?>