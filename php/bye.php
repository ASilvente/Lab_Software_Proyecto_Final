<?php

    //DESTRUCCIÓN DE LA COOKIE ASOCIADA AL USUARIO PARA QUE RECUERDE LA CONTRASEÑA

        setcookie("usr_ck", 1, time()-1, ";path=/");

        setcookie("aero_ck", 1, time()-1, ";path=/");
        header("location: ../index.php");
    
    //VUELTA A LA PÁGINA DE LOGIN
?>