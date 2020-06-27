<div class="container" style="height: 100vh">

    <?php
        include 'php/header.php';
    ?>            
    <div class="row h-100" ">
        <div class="col-sm-12 my-auto mx-auto">
            <!-- The Modal -->
            <div class="modal" id="myModal2" >
                <div class="modal-dialog">
                    <div class="modal-content" >
                        <!-- Modal Header -->
                        <div class="modal-header" >
                            <h4 class="modal-title">¿Ya tienes cuenta?</h4>                            
                        </div>
                
                        <!-- Modal body -->
                        <div class="modal-body" >
                            <form class="container" name="registro" action="php/inicio_sesion.php"  onsubmit="return validateForm()" method="post" required enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for = "rol">Email:</label>     
                                    </div>
                                    <div class="form-group col-md-6">                                       
                                        <input type="text" name="log_correo" id="log_correo" autocomplete="off" required>
                                    </div> 
                                </div>                            
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for = "passwd">Contraseña: </label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="password" name="passwd" id="passwd" autocomplete="off" required>
                                    </div>  
                                </div>                                 
                                <div class="row" style="margin: auto;">
                                    <div class="form-group col-md-6"></div>
                                    <div class="form-group col-md-6">
                                        <input type="submit" name="iniciar_sesion" class="btn btn-primary" value="Iniciar sesión">
                                    </div>                                    
                                </div>                            
                            </form>   
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer" >
                            <div class="col-md-3" style="width: max-content;">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>                            
                        </div>                
                    </div>
                </div>
            </div>
            <!-- The Modal -->
            <div class="modal" id="myModal" >
                <div class="modal-dialog">
                    <div class="modal-content" >
                        <!-- Modal Header -->
                        <div class="modal-header" >
                            <h4 class="modal-title">Nuevo usuario:</h4>                            
                        </div>
                
                        <!-- Modal body -->
                        <div class="modal-body" >
                            <form class="container" name="registro" action="php/registrar_usuario.php"  onsubmit="return validateForm()" method="post" required enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Tipo de usuario: </label>     
                                    </div>
                                    <div class="form-group col-md-6">                                       
                                        <input class="form-check-input" type="radio" name="rol" id="rol" value="cliente" ng-model="showCliente" ng-value="true" checked>
                                        <label class="form-check-label">Cliente</label>
                                    </div> 
                                    <div class="form-group col-md-6"></div>
                                    <div class="form-group col-md-6">
                                        <input class="form-check-input" type="radio" name="rol" id="rol" value="aerolinea" ng-model="showCliente" ng-value="false">
                                        <label class="form-check-label">Aerolínea</label>  
                                    </div>                                                                        					                                                                                                                 
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for = "correo">Email: </label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" name="correo" id="correo" autocomplete="off" required>
                                    </div>                        
                                </div>  
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for = "contra">Contraseña: </label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="password" name="contra" id="contra" autocomplete="off" required>
                                    </div>  
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for = "nombre">Nombre: </label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" name="nombre" id="nombre" autocomplete="off" required>
                                    </div>  
                                </div>
                                <div class="row" ng-show="showCliente">
                                    <div class="col-md-6">
                                        <label for = "apellidos">Apellidos: </label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" name="apellidos" id="apellidos" autocomplete="off" >
                                    </div>  
                                </div>  
                                <div class="row" style="margin: auto;">
                                    <div class="form-group col-md-6"></div>
                                    <div class="form-group col-md-6">
                                        <input type="submit" name="enviando" class="btn btn-primary" value="Enviar">
                                    </div>                                    
                                </div>
                                
                        
                            </form>   
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer" >
                            <div class="col-md-3" style="width: max-content;">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>                            
                        </div>                
                    </div>
                </div>
            </div>
            <!-- MODAL CANCELAR RESERVA -->
            <div class="modal fade" id="cancelarReserva" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" style="color: dodgerblue"><i class="fas fa-receipt mr-1"></i> Cancelar reserva</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" ng-click="">&times;</span>
                            </button>
                        </div>
                        <form name="userForm" ng-submit="submitFormReserva()">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4 form-inline">
                                        <input class="form-check-input" type="radio"  ng-model="showInputDataUser" ng-value="true" checked>
                                        <label class="form-check-label">Mi billete</label>
                                    </div>
                                    <div class="col-md-5 form-inline">
                                        <input class="form-check-input" type="radio"  ng-model="showInputDataUser" ng-value="false" checked>
                                        <label class="form-check-label">Todos los billetes</label>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-12 mt-2 form-inline">
                                        <label class="form-check-label"><i class="far fa-file-alt mr-1"></i> Código de reserva: </label>
                                        <input class="form-control ml-1" type="number" maxlength="6" style="-moz-appearance: textfield;" required>
                                    </div>
                                    <div class="col-md-6 mt-3" ng-show="showInputDataUser">
                                        <label class="form-check-label"><i class="fas fa-receipt"></i> Nombre: </label>
                                        <input class="form-control ml-1" type="text" required>
                                    </div>
                                    <div class="col-md-6 mt-3" ng-show="showInputDataUser">
                                        <label class="form-check-label"><i class="fas fa-receipt"></i> Apellidos: </label>
                                        <input class="form-control ml-1" type="text" required>
                                    </div>
                                    <!--<div class="col-md-12 mt-3 justify-content-center" ng-show="showInputDataUser">
                                        <label class="form-check-label"><i class="fas fa-receipt"></i> DNI (sin letra): </label>
                                        <input class="form-control ml-1" type="text" required>
                                    </div>-->
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" ng-click="">Close</button>
                                <button type="submit" class="btn btn-success"><i class="fas fa-plane-slash"></i> Registrar pasajeros</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <h1 class="ml6 text-center">
                <span class="text-wrapper">
                    <span class="letters" style="color: white">Airlines</span>
                </span>
            </h1>
            <div class="card mx-auto" style="width: max-content; background-color: rgba(255, 255, 255, 0.75);">
                <div class="card-body">
                    <form novalidate name="f">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label><i class="fas fa-plane-departure"></i> Origen: </label>
                                <select class="form-control" ng-model="searchOrigin" >
                                    <option ng-repeat="item in data | orderBy:'origen'| unique: 'origen'" value="{{item.origen | utf8_decode}}" >{{item.origen | utf8_decode}}</option>
                                    <option value="{{}}" selected disabled hidden>¿Desde dónde vamos?</option>
                                </select> 
                            </div>
                            <div class="form-group col-md-6">
                                <label><i class="fas fa-plane-arrival"></i> Destino: </label>
                                <select class="form-control"  ng-model="searchDestiny">
                                    <option ng-repeat="item in data | orderBy:'destino' | unique: 'destino'" value="{{item.destino | utf8_decode}}" ng-model="searchDestiny">{{item.destino | utf8_decode}}</option>
                                    <option value="{{}}" selected disabled hidden>¿A dónde vamos?</option>
                                </select> 
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-6 form-inline">
                                <div class="form-check col-md-7">
                                    <input class="form-check-input" type="radio" ng-model="showVuelta" ng-value="true" checked>
                                    <label class="form-check-label">Ida y vuelta</label>
                                </div>
                                <div class="form-check col-md-5">
                                    <input class="form-check-input" type="radio" ng-change="fechaCheckOut = ''" ng-model="showVuelta" ng-value="false">
                                    <label class="form-check-label">Sólo ida</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-inline mb-3">
                                    <label class="" for=""><i class="far fa-calendar-alt mr-1"></i> Ida: </label>
                                    <div class="ml-auto">
                                        <input class="form-control" type="date" name="checkIn" ng-model="fechaCheckIn" placeholder="yyyy-MM-dd" max="{{fechaCheckOut | date: 'yyyy-MM-dd'}}">
                                    </div>
                                </div>
                                <div class="form-inline" ng-show="showVuelta">
                                    <label class="" for=""><i class="fas fa-calendar-alt mr-1"></i> Vuelta: </label>
                                    <div class="ml-auto" >
                                        <input class="form-control" type="date" name="checkOut" id="fCheckOut" ng-model="fechaCheckOut" placeholder="yyyy-MM-dd" min="{{fechaCheckIn | date: 'yyyy-MM-dd'}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="" class=""><i class="fas fa-users"></i> Número de pasajeros: </label>
                                <input class="form-control" type="number" name="n_billetes" min="0" ng-model="ng_billetes" placeholder="0">
                            </div>
                        </div>
                        <div ng-if="((searchDestiny != undefined) && (searchOrigin != undefined) && (ng_billetes > 0)) && (( showVuelta == false) && (fechaCheckIn != undefined) || (( showVuelta == true) && ((fechaCheckIn != undefined) && (fechaCheckOut != undefined))))">
                            <button type="button" class="btn btn-primary mx-auto d-block mt-3">
                                <a style="color: white; text-decoration: none;" ng-href="#!/prueba/{{searchOrigin}}/{{searchDestiny}}/{{ng_billetes}}/{{ fechaCheckIn | date: 'yyyy-MM-ddT' }}/{{ fechaCheckOut | date: 'yyyy-MM-ddT' }}"  ng-click="seleccionIDA(item.vuelo)"><i class="fas fa-search"></i> Buscar </a>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

