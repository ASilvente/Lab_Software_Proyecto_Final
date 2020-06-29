<?php
try {
    $connect = new PDO("mysql:host=localhost;dbname=lab_software", "root", "");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo 'Connected to Database';
  } catch (PDOException $e) {
    echo $e->getMessage();
 }

 $usuario = $_COOKIE ['aero_ck'];
 include 'database_connection.php';
 $sql = "SELECT id FROM aerolineas WHERE correo =:login"; 
 $q = $connect->prepare($sql);
 $q->execute(array(":login"=>$usuario));
 $r = $q->fetch(PDO::FETCH_ASSOC);
 $id = $r['id'];
 $rand_1 = rand(0,9);
 $rand_2 = rand(0,9);
 $rand_3 = rand(0,9);
 $rand_4 = rand(0,9);
 echo $id;
 echo "-";
 echo $rand_1;
 echo $rand_2;
 echo $rand_3;
 echo $rand_4;
 $random_id = $id."-".$rand_1.$rand_2.$rand_3.$rand_4;


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


 
$connect->query("INSERT INTO `vuelos` (`vuelo`,`origen`, `destino`, `salida`,`llegada`,`plazas_business`,`plazas_optima`,`plazas_economy`,`precio_business`,`precio_optima`,`precio_economy`) VALUES ('".$random_id."','".$origen."','".$destino."','".$salida."','".$llegada."'   ,'".$plazas_business."','".$plazas_optima."','".$plazas_economy."','".$precio_business."','".$precio_optima."','".$precio_economy."')") or die(mysql_error());
$connect = null;
?>
