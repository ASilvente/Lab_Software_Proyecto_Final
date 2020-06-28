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

    $query = "SELECT vuelo,salida,npas_businnes,npas_optima,npas_economy FROM `compras` WHERE cod_reserva = '".$reserva."'";

    $res_data = $connect->query($query);
    $vuelo = [];
    $salida = [];
    $npas_businnes = [];
    $npas_optima = [];
    $npas_economy = [];
    $count = 0;
    while ($line = $res_data->fetch(PDO::FETCH_ASSOC)) {
        $vuelo[$count] = $line['vuelo'];
        $salida[$count] = $line['salida'];
        $npas_businnes[$count] = $line['npas_businnes'];
        $npas_optima[$count] = $line['npas_optima'];
        $npas_economy[$count] = $line['npas_economy'];
        $count++;
    }
    if ($npas_businnes[0] != 0){
        $connect->exec("UPDATE `vuelos` SET `plazas_business` = `plazas_business` + ".$npas_businnes[0]." WHERE `vuelo` = '".$vuelo[0]."' AND `salida` = '".$salida[0]."'AND `salida` = '".$salida[0]."'") or die(mysql_error());
    } elseif ($npas_optima[0] != 0){
        $connect->exec("UPDATE `vuelos` SET `plazas_optima` = `plazas_optima` + ".$npas_optima[0]." WHERE `vuelo` = '".$vuelo[0]."' AND `salida` = '".$salida[0]."'") or die(mysql_error());
    } elseif ($npas_economy[0] != 0){
        $connect->exec("UPDATE `vuelos` SET `plazas_economy` = `plazas_economy` + ".$npas_economy[0]." WHERE `vuelo` = '".$vuelo[0]."' AND `salida` = '".$salida[0]."'") or die(mysql_error());
    }
    if ($count > 1){
        if ($npas_businnes[1] != 0){
            $connect->exec("UPDATE `vuelos` SET `plazas_business` = `plazas_business` + ".$npas_businnes[1]." WHERE `vuelo` = '".$vuelo[1]."' AND `salida` = '".$salida[1]."'") or die(mysql_error());
        } elseif ($npas_optima[1] != 0){
            $connect->exec("UPDATE `vuelos` SET `plazas_optima` = `plazas_optima` + ".$npas_optima[1]." WHERE `vuelo` = '".$vuelo[1]."' AND `salida` = '".$salida[1]."'") or die(mysql_error());
        } elseif ($npas_economy[1] != 0){
            $connect->exec("UPDATE `vuelos` SET `plazas_economy` = `plazas_economy` + ".$npas_economy[1]." WHERE `vuelo` = '".$vuelo[1]."' AND `salida` = '".$salida[1]."'") or die(mysql_error());
        }
    }

    $connect->query("DELETE FROM `compras` WHERE `cod_reserva` = '".$reserva."'") or die(mysql_error());
} else {
    $connect->query("DELETE FROM `pasajeros` WHERE `cod_reserva` = '".$reserva."' AND `nombre` = '".$nombre."' AND `apellidos` = '".$apellidos."' AND `numero` = '".$dni."'") or die(mysql_error());
    $query = "SELECT vuelo,salida,npas_businnes,npas_optima,npas_economy FROM `compras` WHERE cod_reserva = '".$reserva."'";
    $res_data = $connect->query($query);
    $vuelo = [];
    $salida = [];
    $npas_businnes = [];
    $npas_optima = [];
    $npas_economy = [];
    $count = 0;
    while ($line = $res_data->fetch(PDO::FETCH_ASSOC)) {
        $vuelo[$count] = $line['vuelo'];
        $salida[$count] = $line['salida'];
        $npas_businnes[$count] = $line['npas_businnes'];
        $npas_optima[$count] = $line['npas_optima'];
        $npas_economy[$count] = $line['npas_economy'];
        $count++;
    }
    if ($npas_businnes[0] > 1){
        $connect->exec("UPDATE `compras` SET `npas_businnes` = `npas_businnes` - 1 WHERE `vuelo` = '".$vuelo[0]."' AND `salida` = '".$salida[0]."' AND `cod_reserva` = '".$reserva."'") or die(mysql_error());
        $connect->exec("UPDATE `vuelos` SET `plazas_business` = `plazas_business` + 1 WHERE `vuelo` = '".$vuelo[0]."' AND `salida` = '".$salida[0]."'") or die(mysql_error());
    } elseif ($npas_optima[0] > 1){
        $connect->exec("UPDATE `compras` SET `npas_optima` = `npas_optima` - 1 WHERE `vuelo` = '".$vuelo[0]."' AND `salida` = '".$salida[0]."' AND `cod_reserva` = '".$reserva."'") or die(mysql_error());
        $connect->exec("UPDATE `vuelos` SET `plazas_optima` = `plazas_optima` + 1 WHERE `vuelo` = '".$vuelo[0]."' AND `salida` = '".$salida[0]."'") or die(mysql_error());
    } elseif ($npas_economy[0] > 1){
        $connect->exec("UPDATE `compras` SET `npas_economy` = `npas_economy` - 1 WHERE `vuelo` = '".$vuelo[0]."' AND `salida` = '".$salida[0]."' AND `cod_reserva` = '".$reserva."'") or die(mysql_error());
        $connect->exec("UPDATE `vuelos` SET `plazas_economy` = `plazas_economy` + 1 WHERE `vuelo` = '".$vuelo[0]."' AND `salida` = '".$salida[0]."'") or die(mysql_error());
    } elseif ($npas_businnes[0] == 1){
        $connect->query("DELETE FROM `compras` WHERE `cod_reserva` = '".$reserva."'") or die(mysql_error());
        $connect->exec("UPDATE `vuelos` SET `plazas_business` = `plazas_business` + 1 WHERE `vuelo` = '".$vuelo[0]."' AND `salida` = '".$salida[0]."'") or die(mysql_error());
    } elseif ($npas_optima[0] == 1){
        $connect->query("DELETE FROM `compras` WHERE `cod_reserva` = '".$reserva."'") or die(mysql_error());
        $connect->exec("UPDATE `vuelos` SET `plazas_optima` = `plazas_optima` + 1 WHERE `vuelo` = '".$vuelo[0]."' AND `salida` = '".$salida[0]."'") or die(mysql_error());
    } elseif ($npas_economy[0] == 1){
        $connect->query("DELETE FROM `compras` WHERE `cod_reserva` = '".$reserva."'") or die(mysql_error());
        $connect->exec("UPDATE `vuelos` SET `plazas_economy` = `plazas_economy` + 1 WHERE `vuelo` = '".$vuelo[0]."' AND `salida` = '".$salida[0]."'") or die(mysql_error());
    }
    if ($count > 1){
        if ($npas_businnes[1] > 1){
            $connect->exec("UPDATE `compras` SET `npas_businnes` = `npas_businnes` - 1 WHERE `vuelo` = '".$vuelo[1]."' AND `salida` = '".$salida[1]."'") or die(mysql_error());
            $connect->exec("UPDATE `vuelos` SET `plazas_business` = `plazas_business` + 1 WHERE `vuelo` = '".$vuelo[1]."' AND `salida` = '".$salida[1]."'") or die(mysql_error());
        } elseif ($npas_optima[1] > 1){
            $connect->exec("UPDATE `compras` SET `npas_optima` = `npas_optima` - 1 WHERE `vuelo` = '".$vuelo[1]."' AND `salida` = '".$salida[1]."'") or die(mysql_error());
            $connect->exec("UPDATE `vuelos` SET `plazas_optima` = `plazas_optima` + 1 WHERE `vuelo` = '".$vuelo[1]."' AND `salida` = '".$salida[1]."'") or die(mysql_error());
        } elseif ($npas_economy[1] > 1){
            $connect->exec("UPDATE `compras` SET `npas_economy` = `npas_economy` - 1 WHERE `vuelo` = '".$vuelo[1]."' AND `salida` = '".$salida[1]."'") or die(mysql_error());
            $connect->exec("UPDATE `vuelos` SET `plazas_economy` = `plazas_economy` + 1 WHERE `vuelo` = '".$vuelo[1]."' AND `salida` = '".$salida[1]."'") or die(mysql_error());
        } elseif ($npas_businnes[1] == 1){
            $connect->query("DELETE FROM `compras` WHERE `cod_reserva` = '".$reserva."'") or die(mysql_error());
            $connect->exec("UPDATE `vuelos` SET `plazas_business` = `plazas_business` + 1 WHERE `vuelo` = '".$vuelo[1]."' AND `salida` = '".$salida[1]."'") or die(mysql_error());
        } elseif ($npas_optima[1] == 1){
            $connect->query("DELETE FROM `compras` WHERE `cod_reserva` = '".$reserva."'") or die(mysql_error());
            $connect->exec("UPDATE `vuelos` SET `plazas_optima` = `plazas_optima` + 1 WHERE `vuelo` = '".$vuelo[1]."' AND `salida` = '".$salida[1]."'") or die(mysql_error());
        } elseif ($npas_economy[1] == 1){
            $connect->query("DELETE FROM `compras` WHERE `cod_reserva` = '".$reserva."'") or die(mysql_error());
            $connect->exec("UPDATE `vuelos` SET `plazas_economy` = `plazas_economy` + 1 WHERE `vuelo` = '".$vuelo[1]."' AND `salida` = '".$salida[1]."'") or die(mysql_error());
        }
    }
}
$connect = null;
?>
