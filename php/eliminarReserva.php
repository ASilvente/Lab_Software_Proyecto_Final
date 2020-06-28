<?php
try {
    $connect = new PDO("mysql:host=localhost;dbname=lab_software", "root", "");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo 'Connected to Database';
  } catch (PDOException $e) {
    echo $e->getMessage();
 }

$data = json_decode(file_get_contents("php://input"));

$reserva = $data->reserva;
$nombre = $data->nombre;
$apellidos = $data->apellidos;
$dni = $data->dni;

if (empty($nombre)){
    $connect->query("DELETE FROM `pasajeros` WHERE `cod_reserva` = '".$reserva."'") or die(mysql_error());
    $connect->query("DELETE FROM `compras` WHERE `cod_reserva` = '".$reserva."'") or die(mysql_error());
} else {
    $connect->query("DELETE FROM `pasajeros` WHERE `cod_reserva` = '".$reserva."' AND `nombre` = '".$nombre."' AND `apellidos` = '".$apellidos."' AND `numero` = '".$dni."'") or die(mysql_error());
    //$query = $connect->fecth();
    //$connect->query("DELETE FROM `compras` WHERE `cod_reserva` = ".$reserva.")") or die(mysql_error());
}

$connect = null;
?>
