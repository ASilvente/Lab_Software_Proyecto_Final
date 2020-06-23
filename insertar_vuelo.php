<?php
try {
    $connect = new PDO("mysql:host=localhost;dbname=lab_software", "root", "");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo 'Connected to Database';
  } catch (PDOException $e) {
    echo $e->getMessage();
 }



$data = json_decode(file_get_contents("php://input"));

$origen = $data->origen;
$destino = $data->destino;
$salida = $data->salida;
$llegada= $data->llegada;
$plazas_business = $data->plazas_business;
$plazas_optima = $data->plazas_optima; 
$plazas_economy = $data->plazas_economy;
$precio_business = $data->precio_business;
$precio_optima = $data->precio_optima; 
$precio_economy = $data->precio_economy;


 
$connect->query("INSERT INTO `vuelos` (`vuelo`,`origen`, `destino`, `salida`,`llegada`,`plazas_business`,`plazas_optima`,`plazas_economy`,`precio_business`,`precio_optima`,`precio_economy`) VALUES ('IB-0000','".$origen."','".$destino."','".$salida."','".$llegada."'   ,'".$plazas_business."','".$plazas_optima."','".$plazas_economy."','".$precio_business."','".$precio_optima."','".$precio_economy."')") or die(mysql_error());
$connect = null;
?>
