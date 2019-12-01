<?php


echo "Ejemplos de uso de la api:";
echo "<br>";
echo "<br>";
echo "Eliminar una tarifa (Solo para administradores)";
echo "<br>";
echo "/api/api.php?action=delete_tarifa&key=[tu_key_api]&dni=[tu_dni]&nombre=[nombre_de_la_tarifa_a_eliminar]";
echo "<br>";
echo "<br>";
echo "Consultar todas las tarifas";
echo "<br>";
echo "/api/api.php?action=get_tarifa_list";
echo "<br>";
echo "<br>";
echo "Consultar datos de una tarifa en concreto sabiendo su nombre";
echo "<br>";
echo "/api/api.php?action=get_tarifa&nombre=[nombre_de_la_tarifa_a_consultar]"
?>