<?php
try {
    $connect = new PDO("mysql:host=localhost;dbname=lab_software", "root", "");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo 'Connected to Database';
  } catch (PDOException $e) {
    echo $e->getMessage();
 }
$permitted_chars = '0123456789';
 
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}
 
$numero = generate_string($permitted_chars, 6);

$data = json_decode(file_get_contents("php://input"));

$nombre = $data->nombre;
$apellidos = $data->apellidos;

$connect->query("INSERT INTO `pasajeros` (`cod_reserva`,`nombre`, `apellidos`) VALUES ('".$numero."','".$nombre."','".$apellidos."')") or die(mysql_error());
$connect = null;
?>
