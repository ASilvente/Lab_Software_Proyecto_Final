<?php
try {
    $connect = new PDO("mysql:host=localhost;dbname=lab_software", "root", "");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo 'Connected to Database';
  } catch (PDOException $e) {
    echo $e->getMessage();
 }



$data = json_decode(file_get_contents("php://input"));

$vuelo = $data->vuelo;
$origen = $data->origen;

$destino = $data->destino;
$fecha = $data->fecha;

$plazas_business = $data->plazas_business;
$plazas_optima = $data->plazas_optima; 
$plazas_economy = $data->plazas_economy;

$precio_business = $data->precio_business;
$precio_optima = $data->precio_optima; 
$precio_economy = $data->precio_economy;



$connect->query("UPDATE vuelos SET plazas_business='$plazas_business' ,plazas_optima='$plazas_optima' ,plazas_economy='$plazas_economy' , precio_business='$precio_business' , precio_optima='$precio_optima' , precio_economy='$precio_economy' where vuelo='$vuelo' AND origen='$origen' AND destino='$destino' and salida='$fecha' ")or die(mysql_error());

$connect = null;
?>
