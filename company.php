
<html ng-app="trabajo" lang="en">

<head>
    <meta charset="UTF-8">





<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link href="css/all.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
<link href="css/boton.css" rel="stylesheet">

    <title>Vuelos</title>
</head>

<body ng-controller="ctrol" style="background-image: url('images/plane.jpg');  background-size: cover;">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/all.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular-route.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script src="controller2.js"></script>
<script src="js/anime.js"></script>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top" style="margin-bottom:30px;">
        <a class="navbar-brand" href="#">Logo</a>
        <ul class="navbar-nav ml-auto">            
            <?php
                include 'php/header.php';
            ?>                        
        </ul>
    </nav>
    <div style="display:flex;align-items: center;justify-content: center; padding-top:100px;">
        <button ng-click="showNew=1">Introducir nuevos vuelos</button>
        <button ng-click="showNew=2">Consultar vuelos</button>
        <button ng-click="showNew=3">Actualizar vuelos</button>
    </div>
    <div ng-show="showNew==undefined" style="text-align: center;margin: auto;">

        Hola, bienvenido al menu de atencion al cliente, haga click en consultar vuelos o haga click en el boton de introducir nuevos vuelos
        gracias por su tiempo así como,si lo desea, tambien puede actualizar los datos de un vuelo

    </div>
<div ng-show="showNew==1">
        <div class="container" style="height: 40vh">
            <div class="row h-100">
                <div class="col-sm-12 my-auto mx-auto">
                    <h1 class="ml6 text-center">
                        <span class="text-wrapper">
                            <span class="letters" style="color: white">Airlines</span>
                        </span>
                    </h1>
                    <div class="card mx-auto" style="width: max-content; background-color: rgba(255, 255, 255, 0.75);">
                        <div class="card-body">
                            <form novalidate name="f" ng-submit="submitFormCompany()">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label><i class="fas fa-plane-departure"></i> Origen: </label>
                                        <select class="form-control" ng-model="searchOrigin">
                                            <option ng-repeat="item in data | orderBy:'origen'| unique: 'origen'" value="{{item.origen}}">{{item.origen | utf8_decode}}</option>
                                            <option value="{{}}" selected disabled hidden>¿Desde dónde vamos?</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><i class="fas fa-plane-arrival"></i> Destino: </label>
                                        <select class="form-control" ng-model="searchDestiny">
                                            <option ng-repeat="item in data | orderBy:'destino' | unique: 'destino'" value="{{item.destino}}" ng-model="searchDestiny">{{item.destino | utf8_decode}}</option>
                                            <option value="{{}}" selected disabled hidden>¿A dónde vamos?</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-inline mb-6">
                                            <label class="" for=""><i class="far fa-calendar-alt mr-1"></i> Salida: </label>
                                            <div class="ml-auto">
                                                <input class="form-control" type="datetime-local" name="checkIn" ng-model="fechaCheckIn" placeholder="{{fechaCheckIn | date: 'yyyy-MM-ddTHH:mm:ss'}}" max="{{fechaCheckOut | date: 'yyyy-MM-ddTHH:mm:ss'}}">
                                            </div>
                                        </div>
                                        <div class="form-inline mb-6">
                                            <label class="" for=""><i class="fas fa-calendar-alt mr-1"></i> Llegada: </label>
                                            <div class="ml-auto">
                                                <input class="form-control" type="datetime-local" name="checkOut" id="fCheckOut" ng-model="fechaCheckOut" placeholder="{{fechaCheckOut | date: 'yyyy-MM-ddTHH:mm:ss'}}" min="{{fechaCheckIn | date: 'yyyy-MM-ddTHH:mm:ss'}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="" class=""><i class="fas fa-users"></i> Plazas Business: </label>
                                        <input class="form-control" type="number" min="0" placeholder="0" max="20" ng-model="plazas_business">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="" class=""><i class="fas fa-users"></i> Plazas Economy: </label>
                                        <input class="form-control" type="number" min="0" placeholder="0" max="60" ng-model="plazas_economy">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="" class=""><i class="fas fa-users"></i> Plazas Optima: </label>
                                        <input class="form-control" type="number" min="0" placeholder="0" max="80" ng-model="plazas_optima">
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="" class=""><i class="fas fa-euro-sign"></i> Precio Business: </label>
                                        <input class="form-control" type="number" min="0" placeholder="0" ng-model="precio_business">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="" class=""><i class="fas fa-euro-sign"></i> Precio Economy: </label>
                                        <input class="form-control" type="number" min="0" placeholder="0" ng-model="precio_economy">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="" class=""><i class="fas fa-euro-sign"></i> Precio Optima: </label>
                                        <input class="form-control" type="number" min="0" placeholder="0" ng-model="precio_optima">
                                    </div>
                                </div>
                                <div ng-if="((plazas_business <= 20) && (plazas_economy <=60 ) && (plazas_optima <= 80) &&(plazas_business > 0) && (plazas_economy > 0) && (plazas_optima > 0) && (precio_business > 0 ) && (precio_economy > 0) && (precio_optima > 0) && (fechaCheckIn != undefined) && (fechaCheckOut != undefined) && (searchOrigin !=undefined) && (searchDestiny != undefined) && (searchOrigin !== searchDestiny) )">
                                    <button type="submit" class="btn btn-primary mx-auto d-block mt-3">Insertar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div ng-show="showNew==2">
        <h1 class="ml6 text-center">
            <span class="text-wrapper">
                <span class="letters" style="color: white">Airlines</span>
            </span>
        </h1>
        <div class="card mt-5 mb-5 mx-auto" style="width: max-content; background-color: rgba(255, 255, 255, 0.75);">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label><i class="fas fa-plane-departure"></i> ID vuelo: </label>
                        <select class="form-control" ng-model="IDvuelo">
                            <option ng-repeat="item in data | unique: 'vuelo' | orderBy:'vuelo'" value="{{item.vuelo}}">{{item.vuelo}}</option>
                            <option value="{{}}" selected disabled hidden>Indique la ID del vuelo</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label><i class="fas fa-plane-departure"></i> Origen: </label>
                        <select class="form-control" ng-model="RutaVueloOrigen" ng-disabled="IDvuelo == undefined">
                            <option ng-repeat="item in data|filter: {'vuelo' : IDvuelo } | unique: 'origen' | orderBy:'origen' " value="{{item.origen}}"> {{item.origen| utf8_decode}}</option>
                            <option value="{{}}" selected disabled hidden>Indique el origen</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label><i class="fas fa-plane-departure"></i> Destino: </label>
                        <select class="form-control" ng-model="RutaVueloDestino" ng-disabled="RutaVueloOrigen == undefined">
                            <option ng-repeat="item in data|filter: {'vuelo' : IDvuelo }| filter: {'origen' : RutaVueloOrigen } | unique: 'destino' | orderBy:'destino' " value="{{item.destino}}">{{item.destino| utf8_decode}} </option>
                            <option value="{{}}" selected disabled hidden>Indique el destino</option>
                        </select>
                    </div>
                </div>

                <table class="table table-striped table-condensed table-hover" ng-hide="RutaVueloDestino == undefined">
                    <thead>
                        <tr>
                            <th ng-click="setOrderConsulta('vuelo')">Vuelo de ida</th>
                            <th ng-click="setOrderConsulta('origen')"> Origen</th>
                            <th ng-click="setOrderConsulta('destino')"> Destino </th>
                            <th ng-click="setOrderConsulta('salida')"> Salida</th>
                            <th ng-click="setOrderConsulta('llegada')"> Llegada</th>
                            <th ng-click="setOrderConsulta('precio_business')"> Bussiness</th>
                            <th ng-click="setOrderConsulta('precio_optima')"> Optima </th>
                            <th ng-click="setOrderConsulta('precio_economy')"> Economy </th>
                            <th> Clase </th>
                            <th>Ofertadas </th>
                            <th>Vendidas</th>
                            <th>Disponibles</th>
                        </tr>
                    </thead>

                    <tbody>
                    <tbody>
                        <tr ng-repeat="item in data |filter:{'vuelo' : IDvuelo }| filter: {'origen' : RutaVueloOrigen }|filter: {'destino' : RutaVueloDestino } |  startFrom : (pageSize*currentPage)  |limitTo: (pageSize)  | orderBy:selectedOrderIDA:reverse">
                            <td> {{ item.vuelo}}</td>
                            <td> {{ item.origen | utf8_decode }}</td>
                            <td> {{ item.destino | utf8_decode }} </td>
                            <td class="text-center"> {{ item.salida | date: "dd/MM HH:mm" }} </td>
                            <td class="text-center"> {{ item.llegada  | date: "dd/MM HH:mm"   }} </td>
                            <td class="text-center"> {{ item.precio_business }}</td>
                            <td class="text-center"> {{ item.precio_optima }} </td>
                            <td class="text-center"> {{ item.precio_economy }} </td>
                            <td> <select class="form-control" ng-model="Clase">
                                    <option value="Business">Business</option>
                                    <option value="Optima">Optima </option>
                                    <option value="Economy">Economy</option>
                                    <option value="{{}}" selected disabled hidden>Introduce la clase</option>
                                </select>
                            </td>





                            <!------------------- si no hay vuelos registrados  --------------->
                            <td ng-if="(vuelos.length == 0)">
                                <span ng-hide="Clase != 'Business'">{{item.plazas_business}}</span>
                                <span ng-hide="Clase != 'Optima'">{{item.plazas_optima}}</span>
                                <span ng-hide="Clase != 'Economy'">{{item.plazas_economy}}</span>
                            </td>

                            <td ng-if="vuelos.length != 0" ng-repeat="items in  vuelos = (comprar |filter: {'vuelo' : IDvuelo }|filter: {'fecha_vuelo' : item.salida })">
                                <div ng-show="Clase == 'Business'">
                                    <div ng-if="item.salida == items.salida">
                                        <span>{{ billetera(item.plazas_business) + billetera(items.npas_businnes)}} </span>
                                    </div>
                                </div>
                                <div ng-show="Clase == 'Optima'">
                                    <div ng-if="item.salida == items.salida">
                                        <span>{{ billetera(item.plazas_optima) + billetera(items.npas_optima)}} </span>
                                    </div>
                                </div>
                                <div ng-show="Clase == 'Economy'">
                                    <div ng-if="item.salida == items.salida">
                                        <span>{{ billetera(item.plazas_economy) + billetera(items.npas_economy)}} </span>
                                    </div>
                                </div>
                            </td>

                            <!------------------- si no hay vuelos registrados  --------------->
                            <td ng-if="vuelos.length == 0">
                                <span ng-hide="Clase != 'Business'">0</span>
                                <span ng-hide="Clase != 'Optima'">0</span>
                                <span ng-hide="Clase != 'Economy'">0</span>
                            </td>


                            <td ng-if="vuelos.length != 0" ng-repeat="items in  vuelos = (comprar |filter: {'vuelo' : IDvuelo }|filter: {'fecha_vuelo' : item.salida })">
                                <div ng-show="Clase == 'Business'">
                                    <div ng-if="item.salida == items.salida">
                                        <span>{{ billetera(items.npas_businnes)}} </span>
                                    </div>
                                </div>
                                <div ng-show="Clase == 'Optima'">
                                    <div ng-if="item.salida == items.salida">
                                        <span>{{ billetera(items.npas_optima)}} </span>
                                    </div>
                                </div>
                                <div ng-show="Clase == 'Economy'">
                                    <div ng-if="item.salida == items.salida">
                                        <span>{{ billetera(items.npas_economy)}} </span>
                                    </div>
                                </div>
                            </td>

                            <!------------------- si no hay vuelos registrados  --------------->
                            <td ng-if="(vuelos.length == 0)">
                                <span ng-hide="Clase != 'Business'">{{item.plazas_business}}</span>
                                <span ng-hide="Clase != 'Optima'">{{item.plazas_optima}}</span>
                                <span ng-hide="Clase != 'Economy'">{{item.plazas_economy}}</span>
                            </td>


                            <td ng-if="vuelos.length != 0" ng-repeat="items in  vuelos = (comprar |filter: {'vuelo' : IDvuelo }|filter: {'fecha_vuelo' : item.salida })">
                                <div ng-show="Clase == 'Business'">
                                    <div ng-if="item.salida == items.salida">
                                        <span>{{ billetera(item.plazas_business)}} </span>
                                    </div>
                                </div>
                                <div ng-show="Clase == 'Optima'">
                                    <div ng-if="item.salida == items.salida">
                                        <span>{{ billetera(item.plazas_optima)}} </span>
                                    </div>
                                </div>
                                <div ng-show="Clase == 'Economy'">
                                    <div ng-if="item.salida == items.salida">
                                        <span>{{ billetera(item.plazas_economy)}} </span>
                                    </div>
                                </div>
                            </td>



                        </tr>
                    </tbody>

                    <tfoot>

                        <td colspan="6">
                            <div class="pagination pull-right">
                                    <li ng-class="{disabled: currentPage == 0}">
                                        <a href ng-click="prevPage()" class="botonAtras">« Prev</a>
                                    </li>
                                    <li>
                                        <a href ng-click="nextPage()" class="botonSiguiente">Next »</a></li>
                                    </div>
                        </td>

                    </tfoot>
                </table>


            </div>

        </div>
    </div>
    <div ng-show="showNew==3">
      <h1 class="ml6 text-center">
            <span class="text-wrapper">
                <span class="letters" style="color: white">Airlines</span>
            </span>
        </h1>
        <div class="card mt-5 mb-5 mx-auto" style="width: 90%; background-color: rgba(255, 255, 255, 0.75);">
            <div class="card-body">
                <form novalidate name="f" ng-submit="UpdateFormCompany()">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label><i class="fas fa-plane-departure"></i> ID vuelo: </label>
                            <select class="form-control" ng-model="IDvuelo">
                                <option ng-repeat="item in data | unique: 'vuelo' | orderBy:'vuelo'" value="{{item.vuelo}}">{{item.vuelo}}</option>
                                <option value="{{}}" selected disabled hidden>Indique la ID del vuelo</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label><i class="fas fa-plane-departure"></i> Origen: </label>
                            <select class="form-control" ng-model="RutaVueloOrigen" ng-disabled="IDvuelo == undefined">
                                <option ng-repeat="item in data|filter: {'vuelo' : IDvuelo } | unique: 'origen' | orderBy:'origen' " value="{{item.origen}}"> {{item.origen| utf8_decode}}</option>
                                <option value="{{}}" selected disabled hidden>Indique el origen</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label><i class="fas fa-plane-departure"></i> Destino: </label>
                            <select class="form-control" ng-model="RutaVueloDestino" ng-disabled="RutaVueloOrigen == undefined">
                                <option ng-repeat="item in data|filter: {'vuelo' : IDvuelo }| filter: {'origen' : RutaVueloOrigen } | unique: 'destino' | orderBy:'destino' " value="{{item.destino}}">{{item.destino| utf8_decode}} </option>
                                <option value="{{}}" selected disabled hidden>Indique el destino</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12" ng-hide="RutaVueloDestino == undefined">
                            <label><i class="fas fa-plane-departure"></i> Horario: </label>
                            <select class="form-control" ng-model="RutaFecha">
                                <option ng-repeat="item in data|filter: {'vuelo' : IDvuelo }| filter: {'origen' : RutaVueloOrigen } | filter: {'destino' : RutaVueloDestino }  " value="{{item.salida}}"> Salida prevista {{item.salida | date: 'dd/MM/yyyy HH:mm' }} - Llegada prevista {{item.llegada| date: 'dd/MM/yyyy HH:mm'}} </option>
                                <option value="{{}}" selected disabled hidden>Indique el el horario </option>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4 form-group" ng-hide="RutaFecha == undefined">
                            <label for="" class=""><i class="fas fa-users"></i> Plazas Business: </label>
                            <input class="form-control" type="number" min="0" placeholder="{{item.plazas_business}}" value="{{item.plazas_business}}" ng-model="plazas_business">
                        </div>
                        <div class="col-md-4 form-group" ng-hide="RutaFecha == undefined">
                            <label for="" class=""><i class="fas fa-users"></i> Plazas Economy: </label>
                            <input class="form-control" type="number" min="0" placeholder="{{item.plazas_economy}}" value="{{item.plazas_economy}}" ng-model="plazas_economy">
                        </div>
                        <div class="col-md-4 form-group" ng-hide="RutaFecha == undefined">
                            <label for="" class=""><i class="fas fa-users"></i> Plazas Optima: </label>
                            <input class="form-control" type="number" min="0" placeholder="{{item.plazas_optima}}" value="{{item.plazas_optima}}" ng-model="plazas_optima">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group" ng-hide="RutaFecha == undefined">
                            <label for="" class=""><i class="fas fa-euro-sign"></i> Precio Business: </label>
                            <input class="form-control" type="number" min="0" placeholder="{{item.precio_business}}" value="{{item.precio_business}}" ng-model="precio_business">
                        </div>
                        <div class="col-md-4 form-group" ng-hide="RutaFecha == undefined">
                            <label for="" class=""><i class="fas fa-euro-sign"></i> Precio Economy: </label>
                            <input class="form-control" type="number" min="0" placeholder="{{item.precio_economy}}" value="{{item.precio_economy}}" ng-model="precio_economy">
                        </div>
                        <div class="col-md-4 form-group" ng-hide="RutaFecha == undefined">
                            <label for="" class=""><i class="fas fa-euro-sign"></i> Precio Optima: </label>
                            <input class="form-control" type="number" min="0" placeholder="{{item.precio_optima}}" value="{{item.precio_optima}}" ng-model="precio_optima">
                        </div>

                    </div>

                    <div ng-if="((IDvuelo != undefined) && (RutaVueloOrigen != undefined) && (RutaVueloDestino != undefined) && (RutaFecha != undefined) && (plazas_business > 0) && (plazas_economy > 0) && (plazas_optima > 0) && (precio_business > 0) && (precio_economy > 0) && (precio_optima > 0))">
                        <button type="submit" class="btn btn-primary mx-auto d-block mt-3" style=" margin: 0 auto; display: inline-block;">Actualizar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular-route.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="controller2.js"></script>
    <script src="js/anime.js"></script>
</body>

</html>

