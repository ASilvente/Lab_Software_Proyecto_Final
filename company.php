
<html ng-app="trabajo" lang="en">

<head>
    <meta charset="UTF-8">





<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link href="css/all.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">

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

        Hola empresa llamada X bienvenida al menu de atencion al cliente, haga click en consultar vuelos o haga click en el boton de introducir nuevos vuelos
        gracias por su tiempo

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
                                        <input class="form-control" type="number" min="0" placeholder="0" ng-model="plazas_business">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="" class=""><i class="fas fa-users"></i> Plazas Economy: </label>
                                        <input class="form-control" type="number" min="0" placeholder="0" ng-model="plazas_economy">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="" class=""><i class="fas fa-users"></i> Plazas Optima: </label>
                                        <input class="form-control" type="number" min="0" placeholder="0" ng-model="plazas_optima">
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="" class=""><i class="fas fa-euro-sign"></i> Precio Business: </label>
                                        <input class="form-control" type="number" min="0" placeholder="0" max="20" ng-model="precio_business">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="" class=""><i class="fas fa-euro-sign"></i> Precio Economy: </label>
                                        <input class="form-control" type="number" min="0" placeholder="0" max="60" ng-model="precio_economy">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="" class=""><i class="fas fa-euro-sign"></i> Precio Optima: </label>
                                        <input class="form-control" type="number" min="0" placeholder="0" max="80" ng-model="precio_optima">
                                    </div>
                                </div>
                                <div ng-if="((plazas_business > 0) && (plazas_economy > 0) && (plazas_optima > 0) && (fechaCheckIn != undefined) && (fechaCheckOut != undefined) && (searchOrigin !=undefined) && (searchDestiny != undefined) && (searchOrigin !== searchDestiny) )">
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
                <table class="table table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th ng-click="setOrderIDA('vuelo')"> Vuelo de ida</th>
                            <th ng-click="setOrderIDA('origen')"> Origen</th>
                            <th ng-click="setOrderIDA('destino')"> Destino </th>
                            <th ng-click="setOrderIDA('salida')"> Salida</th>
                            <th ng-click="setOrderIDA('llegada')"> Llegada</th>
                            <th ng-click="setOrderIDA('precio_business')"> Bussiness</th>
                            <th ng-click="setOrderIDA('precio_optima')"> Optima </th>
                            <th ng-click="setOrderIDA('precio_economy')"> Economy </th>
                            <th ng-click="setOrderIDA('precio_economy')">OFER/VEND/DISP Bussiness </th>
                            <th ng-click="setOrderIDA('precio_economy')">OFER/VEND/DISP Optima </th>
                            <th ng-click="setOrderIDA('precio_economy')">OFER/VEND/DISP Economy</th>
                        </tr>
                    </thead>

                    <tbody>
                    <tbody>
                        <tr ng-repeat="item in data|  startFrom : (pageSize*currentPage)  |limitTo: (pageSize) |filter:{'vuelo': 'IB'} | orderBy:selectedOrderIDA:reverse">
                            <td> {{ item.vuelo}}</td>
                            <td> {{ item.origen | utf8_decode }}</td>
                            <td> {{ item.destino | utf8_decode }} </td>
                            <td class="text-center"> {{ item.salida | date: "HH:mm" }} </td>
                            <td class="text-center"> {{ item.llegada  | date: "HH:mm"   }} </td>
                            <td class="text-center"> {{ item.precio_business }}</td>
                            <td class="text-center"> {{ item.precio_optima }} </td>
                            <td class="text-center"> {{ item.precio_economy }} </td>
                            <td ng-repeat="items in comprar |filter:{'vuelo': item.vuelo}" style="text-align: center">{{ item.plazas_business }} /{{ items.npas_businnes }} / {{item.plazas_business - items.npas_businnes}} </td>
                            <td ng-repeat="items in comprar |filter:{'vuelo': item.vuelo}" style="text-align: center">{{ item.plazas_optima }} /{{ items.npas_optima }} / {{item.plazas_optima - items.npas_optima}} </td>
                            <td ng-repeat="items in comprar |filter:{'vuelo': item.vuelo}" style="text-align: center">{{ item.plazas_economy }} /{{ items.npas_economy }} / {{item.plazas_economy - items.npas_economy}} </td>
                            
                            
                            
                        </tr> 
                    </tbody>
                    
                    <tfoot>

                        <td colspan="6">
                            <div class="pagination pull-right">
                                <ul>
                                    <li ng-class="{disabled: currentPage == 0}">
                                        <a href ng-click="prevPage()">« Prev</a>
                                    </li>
                                    <li>
                                        <a href ng-click="nextPage()">Next »</a>
                                    </li>
                                </ul>
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
                <span class="letters" style="color: white">Aairlines</span>
            </span>
        </h1>
        <div class="card mt-5 mb-5 mx-auto" style="width: max-content; background-color: rgba(255, 255, 255, 0.75);">
            <div class="card-body">
                <table class="table table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th ng-click="setOrderIDA('vuelo')"> Vuelo de ida</th>
                            <th ng-click="setOrderIDA('origen')"> Origen</th>
                            <th ng-click="setOrderIDA('destino')"> Destino </th>
                            <th ng-click="setOrderIDA('salida')"> Salida</th>
                            <th ng-click="setOrderIDA('llegada')"> Llegada</th>
                            <th ng-click="setOrderIDA('precio_business')"> Bussiness</th>
                            <th ng-click="setOrderIDA('precio_optima')"> Optima </th>
                            <th ng-click="setOrderIDA('precio_economy')"> Economy </th>
                        </tr>
                    </thead>

                    <tbody>
                    <tbody>
                        <tr ng-repeat="item in data|  startFrom : (pageSize*currentPage)  |limitTo: (pageSize) |filter:{'vuelo': 'IB'} | orderBy:selectedOrderIDA:reverse">
                            <td> {{ item.vuelo}}</td>
                            <td> {{ item.origen | utf8_decode }}</td>
                            <td> {{ item.destino | utf8_decode }} </td>
                            <td class="text-center"> {{ item.salida | date: "HH:mm" }} </td>
                            <td class="text-center"> {{ item.llegada  | date: "HH:mm"   }} </td>
                            <td class="text-center"> {{ item.precio_business }}</td>
                            <td class="text-center"> {{ item.precio_optima }} </td>
                            <td class="text-center"> {{ item.precio_economy }} </td>
                        </tr>
                    </tbody>

                    <tfoot>
                        <td colspan="6">
                            <div class="pagination pull-right">
                                <ul>
                                    <li ng-class="{disabled: currentPage == 0}">
                                        <a href ng-click="prevPage()">« Prev</a>
                                    </li>
                                    <li>
                                        <a href ng-click="nextPage()">Next »</a>
                                    </li>
                                </ul>
                            </div>
                        </td>

                    </tfoot>
                </table>
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

