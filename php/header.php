<?php
    echo '<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top"">
            <a class="navbar-brand" href="index.php"><i class="fas fa-paper-plane" style="color: dodgerblue"></i></a>
                <ul class="navbar-nav ml-auto">';
    if(isset($_COOKIE['usr_ck'])){
        echo    '<div>
                    '//<P>Iniciado sesión como '. $_COOKIE['usr_ck'].'</p>
                    .'<li class="nav-item">
                        <button type="button" class="btn btn-primary" >
                            <a id="cerrar_sesion" style ="decoration-text:none;" href="php/bye.php"><b>Cerrar sesión</b></a>                       
                        </button>
                    </li>
                </div>';
    }elseif(isset($_COOKIE['aero_ck'])){
        echo    '<div>
                    '//<P>Iniciado sesión como '. $_COOKIE['aero_ck'].'</p>
                    .'<li class="nav-item">
                        <button type="button" class="btn btn-primary" >
                            <a id="cerrar_sesion" style ="decoration-text:none;" href="php/bye.php"><b>Cerrar sesión</b></a>                       
                        </button>
                    </li>
                </div>';
    }
    else//(!isset($_COOKIE['usr_ck']) && !isset($_COOKIE['aero_ck'])){
        echo    '<div>
                    <li class="nav-item mr-3">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal2" >
                            <!--<a href="company.html"></a>-->
                            <b >Iniciar sesión</b>
                        </button>
                    </li>                                                                        
                </div>
                <div>
                    <li class="nav-item mr-3">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal" >
                            <b >Regístrate</b>                       
                        </button>
                    </li>
                </div>
                <div>
                    <li class="nav-item">
                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#cancelarReserva" >
                            <b >Cancelar reserva</b>                       
                        </button>
                    </li>
                </div>';
    echo    '</ul>
        </nav>'
    
?> 