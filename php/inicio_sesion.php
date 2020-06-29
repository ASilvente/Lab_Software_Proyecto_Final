<?php
    try{
        $correo = htmlentities($_POST['log_correo']);
        $password = htmlentities($_POST['passwd']);
        $cont = 0;
        $cliente = "cliente";
        
        include 'database_connection.php';

        $sql = "SELECT * FROM usuarios WHERE correo =:login";
        $q = $connect->prepare($sql);
        $q->execute(array(":login"=>$correo));
        while($r = $q->fetch(PDO::FETCH_ASSOC)){
            if(password_verify($password, $r['passwd'])){
                $cont++;
            }
        }
        if($cont > 0){
            $sql_2 = "SELECT rol FROM usuarios WHERE correo =:login";
            $q_2 = $connect->prepare($sql_2);
            $q_2->execute(array(":login"=>$correo));
            $r_2 = $q_2->fetch(PDO::FETCH_ASSOC);
            $rol_usuario = $r_2['rol'];
            echo $rol_usuario;
            if ($rol_usuario === "cliente"){
                echo "Hola usuario";
                setcookie("usr_ck", $correo, time()+86400, ';path=/');
                echo $_COOKIE['usr_ck'];
                header("location: ../index.php");
            }elseif ($rol_usuario ==="aerolinea"){
                echo "Hola aerolinea";
                setcookie("aero_ck", $correo, time()+86400, ';path=/');
                echo $_COOKIE['aero_ck'];
                //header("location: ../index.php");
                header("location: ../company.php");
            }else{
                echo "Ninguna de las dos";
            }
        }
    } catch(Exception $e){
        die("Error " . $e->getMessage() );
    }


?>