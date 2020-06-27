<?php
try {
    $connect = new PDO("mysql:host=localhost;dbname=lab_software", "root", "");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo 'Connected to Database';
  } catch (PDOException $e) {
    echo $e->getMessage();
 }
/*$permitted_chars = '0123456789';
 
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}
 
$numero = generate_string($permitted_chars, 6);*/

$data = json_decode(file_get_contents("php://input"));

$personas = count($data)-1;
$numero = $data[$personas]->numero;

for ($i = 0; $i < $personas; $i++){
    $nombre = $data[$i]->nombre;
    $apellidos = $data[$i]->apellidos;
    $dni = $data[$i]->dni;
    $connect->query("INSERT INTO `pasajeros` (`cod_reserva`, `numero`, `nombre`, `apellidos`) VALUES ('".$numero."','".$dni."','".$nombre."','".$apellidos."')") or die(mysql_error());
}

$vuelo_ida = $data[$personas]->vuelo_ida;
$vuelo_vuelta = $data[$personas]->vuelo_vuelta;
$salida_ida = $data[$personas]->salida_ida;
$salida_vuelta = $data[$personas]->salida_vuelta;
$tipoBilleteIda = $data[$personas]->tipoBilleteIda;
$tipoBilleteVuelta = $data[$personas]->tipoBilleteVuelta;

$bussinessIda = 0;
$optimaIda = 0;
$economyIda = 0;
switch ($tipoBilleteIda) {
    case 'Business':
        $bussinessIda = $personas;
        break;
    case 'Optima':
        $optimaIda = $personas;
        break;
    case 'Economy':
        $economyIda = $personas;
        break;
}

if($vuelo_vuelta == ""){
    $connect->query("INSERT INTO `compras` (`cod_reserva`, `fecha_compra`, `fecha_vuelo`, `vuelo`, `salida`, `npas_businnes`, `npas_optima`, `npas_economy`) VALUES ('".$numero."', NOW(), '".$salida_ida."', '".$vuelo_ida."', '".$salida_ida."', '".$bussinessIda."', '".$optimaIda."', '".$economyIda."');") or die(mysql_error());
    $connect->exec("UPDATE `vuelos` SET `plazas_business` = `plazas_business` - ".$bussinessIda.", `plazas_optima` = `plazas_optima` - ".$optimaIda.", `plazas_economy` = plazas_economy - ".$economyIda." WHERE `vuelo` = '".$vuelo_ida."' AND `salida` = '".$salida_ida."'") or die(mysql_error());
} else {
    $bussinessVuelta = 0;
    $optimaVuelta = 0;
    $economyVuelta = 0;
    switch ($tipoBilleteVuelta) {
        case 'Business':
            $bussinessVuelta = $personas;
            break;
        case 'Optima':
            $optimaVuelta = $personas;
            break;
        case 'Economy':
            $economyVuelta = $personas;
            break;
    }
    $connect->query("INSERT INTO `compras` (`cod_reserva`, `fecha_compra`, `fecha_vuelo`, `vuelo`, `salida`, `npas_businnes`, `npas_optima`, `npas_economy`) VALUES ('".$numero."', NOW(), '".$salida_ida."', '".$vuelo_ida."', '".$salida_ida."', '".$bussinessIda."', '".$optimaIda."', '".$economyIda."');") or die(mysql_error());
    $connect->query("INSERT INTO `compras` (`cod_reserva`, `fecha_compra`, `fecha_vuelo`, `vuelo`, `salida`, `npas_businnes`, `npas_optima`, `npas_economy`) VALUES ('".$numero."', NOW(), '".$salida_vuelta."', '".$vuelo_vuelta."', '".$salida_vuelta."', '".$bussinessVuelta."', '".$optimaVuelta."', '".$economyVuelta."');") or die(mysql_error());
    $connect->exec("UPDATE `vuelos` SET `plazas_business` = `plazas_business` - ".$bussinessIda.", `plazas_optima` = `plazas_optima` - ".$optimaIda.", `plazas_economy` = plazas_economy - ".$economyIda." WHERE `vuelo` = '".$vuelo_ida."' AND `salida` = '".$salida_ida."'") or die(mysql_error());
    $connect->exec("UPDATE `vuelos` SET `plazas_business` = `plazas_business` - ".$bussinessVuelta.", `plazas_optima` = `plazas_optima` - ".$optimaVuelta.", `plazas_economy` = plazas_economy - ".$economyVuelta." WHERE `vuelo` = '".$vuelo_vuelta."' AND `salida` = '".$salida_vuelta."'") or die(mysql_error());
}

$connect = null;
?>
