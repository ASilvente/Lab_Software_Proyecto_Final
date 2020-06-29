<?php

    $correo_usuario = htmlentities(addslashes($_POST["correo"]));
	$pass = htmlentities(addslashes($_POST["contra"]));
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $tipo_usuario = $_POST["rol"];
    //echo $tipo_usuario;
    if ($tipo_usuario=="true"){
        $tipo_usuario="cliente";
    }else{
        $tipo_usuario="aerolinea";
    }
	$pass_cifrado=password_hash($pass, PASSWORD_DEFAULT);

    try{
        include 'database_connection.php';
        //Primero comprobamos que no haya ningún otro usuario con ese correo, en caso de que lo haya no deja registrarse
        $sql = "SELECT correo FROM usuarios WHERE correo = :user";
		$resultado = $connect->prepare($sql);
		$resultado->execute(array(":user"=>$correo_usuario));
		if ($resultado->rowCount() > 0){
			echo "Ya hay un usuario registrado con ese correo";
		} else {
            $sql_2="INSERT INTO usuarios (correo, passwd, nombre, apellidos, rol) 
			VALUES (:usu, :pass, :nombre, :apellidos, :rol_usuario)";
            $resultado=$connect->prepare($sql_2);
            $resultado->execute(array(":usu"=>$correo_usuario, ":pass"=>$pass_cifrado, ":nombre"=>$nombre, ":apellidos"=>$apellidos, ":rol_usuario"=>$tipo_usuario));	
            echo $tipo_usuario;	            
        }

    } catch(EXception $e){
        die ("Error" . $e -> getMessage() . $e -> getLine());
    } finally{
        $connect = null;
        header("location: ../index.php");
    }




?>