<?php

    $correo_usuario = htmlentities(addslashes($_POST["correo"]));
	$pass = htmlentities(addslashes($_POST["contra"]));
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
	$tipo_usuario = $_POST["rol"];
	$pass_cifrado=password_hash($pass, PASSWORD_DEFAULT);

    try{
        include 'database_connection.php';
        //Primero comprobamos que no haya ningún otro usuario con ese correo, en caso de que lo haya no deja registrarse
        $sql = "SELECT correo FROM usuarios WHERE correo = :user";
		$resultado = $connect->prepare($sql);
		$resultado->execute(array(":user"=>$correo_usuario));
		if ($resultado->rowCount() > 0){
			echo "Baia baia hubo caquita";
		} else {
            $sql_2="INSERT INTO usuarios (correo, passwd, nombre, apellidos, rol) 
			VALUES (:usu, :pass, :nombre, :apellidos, :rol)";
            $resultado=$connect->prepare($sql_2);
            $resultado->execute(array(":usu"=>$correo_usuario, ":pass"=>$pass_cifrado, ":nombre"=>$nombre, ":apellidos"=>$apellidos, ":rol"=>$tipo_usuario));		
            echo "Baia baia lo conseguiste";
        }

    } catch(EXception $e){
        die ("Error" . $e -> getMessage() . $e -> getLine());
    } finally{
        $connect = null;
        header("location: ../index.html");
    }




?>