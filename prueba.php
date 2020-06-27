<div style="background-color:green">
    <?php
        include 'php/header.php';
    ?> 
</div>
<div style="margin-top: 100px;">
    <div class="card mx-auto mt-5" style="width: max-content; background-color: rgba(255, 255, 255, 0.75);">

    <div class="card-header bg-primary">
        <div class="row">
            <h4 class="my-auto mx-auto" style="color: white"><i class="fas fa-edit"></i> Datos de su reserva</h4>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <table class="table mb-0 bg-white">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th></th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Fecha</th>
                        <th>Pasajeros</th>
                        <th ng-if="(precioIDA > 0) && (ida == true)" ng-model="Presupuesto">Precio/Persona</th>
                        <th ng-if="(precioIDA > 0) && (ida == true)" ng-model="Presupuesto">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="CiudadIntermedia == '' ">
                        <th>Viaje de ida</th>
                        <td>{{ origen | uppercase}}</td>
                        <td>{{ destino |uppercase  }}</td>
                        <td>{{ fcheckIn}}</td>
                        <td class="text-center">{{ nBilletes}}</td>
                        <td class="text-center" ng-if="(precioIDA > 0) && (ida == true)" ng-model="Presupuesto">{{precioIDA}}€</td>
                        <td class="text-center" ng-if="(precioIDA > 0) && (ida == true)" ng-model="Presupuesto">{{precioIDA * nBilletes}}€</td>
                    </tr>                     
                    <tr ng-show="CiudadIntermedia != '' ">
                        <th>Origen -> Escala</th>
                        <td>{{ origen | uppercase}}</td>
                        <td>{{ CiudadIntermedia |uppercase  }}</td>
                        <td>{{ fcheckIn}}</td>
                        <td class="text-center">{{ nBilletes}}</td>
                        <td class="text-center" ng-if="(precioIDA > 0) && (ida == true)" ng-model="Presupuesto">{{precioIDA}}€</td>
                        <td class="text-center" ng-if="(precioIDA > 0) && (ida == true)" ng-model="Presupuesto">{{precioIDA * nBilletes}}€</td>
                    </tr>                    
                    <tr ng-show="CiudadIntermedia != '' ">
                        <th>Escala -> Destino</th>
                        <td>{{ CiudadIntermedia | uppercase}}</td>
                        <td>{{ destino |uppercase  }}</td>
                        <td>{{ fcheckIn}}</td>
                        <td class="text-center">{{ nBilletes}}</td>
                        <td class="text-center" ng-if="(precioDestinoIDA > 0) && (DestinoIDA == true)" ng-model="Presupuesto">{{precioDestinoIDA}}€</td>
                        <td class="text-center" ng-if="(precioDestinoIDA > 0) && (DestinoIDA == true)" ng-model="Presupuesto">{{precioDestinoIDA * nBilletes}}€</td>
                    </tr>
                    <tr ng-show="fcheckOut">
                        <th> Viaje de vuelta</th>
                        <td>{{ destino | uppercase }}</td>
                        <td>{{ origen | uppercase }}</td>
                        <td>{{ fcheckOut }}</td>
                        <td class="text-center">{{ nBilletes }}</td>
                        <td class="text-center" ng-if="(precioIDA > 0) && (ida == true)" ng-model="Presupuesto"><span ng-if="(precioVUELTA > 0) && (vuelta == true)" ng-model="Presupuesto">{{precioVUELTA}}€</span></td>
                        <td class="text-center" ng-if="(precioIDA > 0) && (ida == true)" ng-model="Presupuesto"><span ng-if="(precioVUELTA > 0) && (vuelta == true)" ng-model="Presupuesto">{{precioVUELTA * nBilletes}}€</span></td>
                    </tr>
                    <tr ng-if="(precioIDA > 0) && (precioVUELTA > 0) && (vuelta == true)">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <th class="text-right">Total:</th>
                        <th class="text-center">{{ precioIDA * nBilletes  + precioVUELTA * nBilletes}}€</th>
                    </tr>
                    <tr ng-if="(precioIDA > 0) && (vuelta == false) && CiudadIntermedia == '' " ng-hide="fcheckOut">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <th class="text-right">Total:</th>
                        <th class="text-center">{{ precioIDA * nBilletes }}€</th>
                    </tr>
                    <tr ng-if="(precioIDA > 0) && (vuelta == false) && CiudadIntermedia != '' " ng-hide="fcheckOut">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <th class="text-right">Total:</th>
                        <th class="text-center">{{ precioIDA * nBilletes  + precioDestinoIDA *nBilletes }} €</th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row form-inline d-flex justify-content-center mt-3">
            <label class="mr-1">¿Desea cambiar el número de pasajeros?</label>

            <input class="form-control" style="width: 20%;" type="number" name="n_billetes" min="1" value="{{nBilletes}}" ng-model="nBilletes" id="nBilletes" >
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-danger float-right" type="button" ng-click=""><a style="color: white; text-decoration: none;" href="index.php"><i class="fas fa-undo"></i> Volver</a></button>

        <button ng-if="(precioIDA > 0) && (precioVUELTA > 0) && (vuelta == true)" class="btn btn-success float-right mr-3" type="button" ng-click="" data-toggle="modal" data-target="#modalRegistroPasajeros">
                <i class="far fa-calendar-check"></i> Reservar</a>
        </button>

        <button ng-if="(precioIDA > 0) && (vuelta == false)" ng-hide="fcheckOut" class="btn btn-success float-right mr-3" type="button" ng-click="" data-toggle="modal" data-target="#modalRegistroPasajeros">
            <i class="far fa-calendar-check"></i> Reservar</a>
        </button>
    </div>
</div>
<div ng-switch on="((data | filter:origen).length) && ((data | filter:destino).length) && ((data | filter:fcheckIn).length) && ((data | filter:fcheckOut).length)">

    <div class="alert alert-danger ng-empty mx-auto text-center mt-3" style="width: 70%" role="alert" ng-switch-when="0">
        Ups, parece que no hay vuelos programados para las fechas seleccionadas.
    </div>
    <div ng-switch-default>

        <div data-ng-repeat="item in existenBilletes = (data | filter: {'origen' : (origen | utf8_encode) } | filter: {'destino' : (destino | utf8_encode)} | filter: {'salida' : fcheckIn}) ">

        </div>
        <div class="alert alert-danger mx-auto text-center mt-3" style="width: 70%" role="alert" ng-if="existenBilletes.length == 0">

Ups, parece que no hay vuelos con origen {{origen}} y destino {{destino }} para las fechas seleccionadas pero afortunadamente para ti tenemos una ruta alternativa


<table>
    <tr>
        <td>
            <input class="form-control" style="" type="text" placeholder="{{item.origen}}" ng-model="origen" value="{{item.origen}}" disabled>

        </td>
    </tr>
    <tr>
        <td class = "text-left">
            <div ng-repeat="item in data| filter: {'origen' : (origen | utf8_encode)} | filter: {'salida' : fcheckIn} | orderBy:'destino'| unique: 'destino'" value="{{item.destino| utf8_decode}}">
                <div ng-repeat="items in data| filter: {'origen' : (item.destino | utf8_encode)}| filter: {'destino' : (destino | utf8_encode)}  |   filter: {'salida' : fcheckIn} | orderBy:'origen'| unique: 'origen'" value="{{items.origen| utf8_decode}}">
                    <div ng-show="({{item.destino | removeSpaces}} === {{items.origen | removeSpaces}})" ng-model="searchIntermediate">
                    <input class="form-check-input" type="checkbox" ng-click="seleccionIntermedioIDA(items.origen)" ng-disabled="(deshabilitarIntermedioIDA() != items.origen && estadoDeshabilitarIntermedioIDA)" >    {{items.origen}}                    </div>
                </div>
            </div>
        </td>

    </tr>
    <tr>
        <td>
            <input class="form-control" style="" type="text" placeholder="{{item.destino}}" ng-model="destino" value="{{item.destino}}" disabled>
        </td>
    </tr>

</table>



<div class="card mt-5 mb-5 mx-auto" style="width: max-content; background-color: rgba(255, 255, 255, 0.75);" ng-show="CiudadIntermedia != '' ">
    <div class="card-body">
        <table class="table table-striped bg-white" ng-model="tablaIDA">
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
            <tr ng-repeat="item in data | filter: {'origen' : (origen | utf8_encode)} | filter: {'destino' : (CiudadIntermedia | utf8_encode)} | filter: {'salida' : fcheckIn} | orderBy:selectedOrderIDA:reverse">
                <td> {{ item.vuelo}}</td>
                <td> {{ item.origen | utf8_decode }}</td>
                <td> {{ item.destino | utf8_decode }} </td>
                <td class="text-center"> {{ item.salida | date: "HH:mm" }} </td>
                <td class="text-center"> {{ item.llegada  | date: "HH:mm"   }} </td>
                <td class="text-center"> {{ item.precio_business }}</td>
                <td class="text-center"> {{ item.precio_optima }} </td>
                <td class="text-center"> {{ item.precio_economy }} </td>
                <td><input class="form-check-input" type="checkbox" ng-click="seleccionIDA(item.vuelo)" ng-disabled="(deshabilitarIDA() != item.vuelo && estadoDeshabilitarIDA)" ng-model="BuscarIDA">
                </td>
                <td style="padding-top: 5px; padding-bottom: 0px;" ng-if="BuscarIDA">
                    <div ng-if="((billetera(nBilletes)<=item.plazas_business)  || (billetera(nBilletes)<=item.plazas_optima)  || (billetera(nBilletes)<=item.plazas_economy))">
                        <select class="form-control" ng-model="PrecioIDA" ng-change="EstablecerPrecioIDA(PrecioIDA)">
                            <option value="{{ item.precio_business }}" ng-if="(billetera(nBilletes)<=item.plazas_business)">Bussiness ({{item.plazas_business}})</option>
                            <option value="{{item.precio_optima}}" ng-if="(billetera(nBilletes)<=item.plazas_optima)">Optima ({{item.plazas_optima}})</option>
                            <option value="{{item.precio_economy}}" ng-if="(billetera(nBilletes)<=item.plazas_economy)">Economy ({{item.plazas_economy}})</option>
                            <option value="{{}}" selected disabled hidden>Introduce la clase</option>
                        </select>
                    </div>
                    <div ng-if="((billetera(nBilletes)>item.plazas_business)  && (billetera(nBilletes)>item.plazas_optima)  && (billetera(nBilletes)>item.plazas_economy))">
                        <input type="text" disabled="disabled" placeholder="No hay plazas" style="text-align: center" ng-value="EstablecerPrecioIDA(0)" />
                    </div>
                </td>
            </tr>
            <tr ng-repeat="item in data | filter: {'origen' : (CiudadIntermedia | utf8_encode)} | filter: {'destino' : (destino | utf8_encode)} | filter: {'salida' : fcheckIn} | orderBy:selectedOrderDestinoIDA:reverse">
                <td> {{ item.vuelo}}</td>
                <td> {{ item.origen | utf8_decode }}</td>
                <td> {{ item.destino | utf8_decode }} </td>
                <td class="text-center"> {{ item.salida | date: "HH:mm" }} </td>
                <td class="text-center"> {{ item.llegada  | date: "HH:mm"   }} </td>
                <td class="text-center"> {{ item.precio_business }}</td>
                <td class="text-center"> {{ item.precio_optima }} </td>
                <td class="text-center"> {{ item.precio_economy }} </td>
                <td><input class="form-check-input" type="checkbox" ng-click="seleccionDestinoIDA(item.vuelo)" ng-disabled="(deshabilitarDestinoIDA() != item.vuelo && estadoDeshabilitarDestinoIDA)" ng-model="BuscarDestinoIDA">
                </td>
                <td style="padding-top: 5px; padding-bottom: 0px;" ng-if="BuscarDestinoIDA">
                    <div ng-if="((billetera(nBilletes)<=item.plazas_business)  || (billetera(nBilletes)<=item.plazas_optima)  || (billetera(nBilletes)<=item.plazas_economy))">
                        <select class="form-control" ng-model="PrecioDestinoIDA" ng-change="EstablecerPrecioDestinoIDA(PrecioDestinoIDA)">
                            <option value="{{ item.precio_business }}" ng-if="(billetera(nBilletes)<=item.plazas_business)">Bussiness ({{item.plazas_business}})</option>
                            <option value="{{item.precio_optima}}" ng-if="(billetera(nBilletes)<=item.plazas_optima)">Optima ({{item.plazas_optima}})</option>
                            <option value="{{item.precio_economy}}" ng-if="(billetera(nBilletes)<=item.plazas_economy)">Economy ({{item.plazas_economy}})</option>
                            <option value="{{}}" selected disabled hidden>Introduce la clase</option>
                        </select>
                    </div>
                    <div ng-if="((billetera(nBilletes)>item.plazas_business)  && (billetera(nBilletes)>item.plazas_optima)  && (billetera(nBilletes)>item.plazas_economy))">
                        <input type="text" disabled="disabled" placeholder="No hay plazas" style="text-align: center" ng-value="EstablecerPrecioDestinoIDA(0)" />
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>



</div>
</div>

<!-- MODAL REGISTRAR PASAJEROS -->
<div class="modal fade" id="modalRegistroPasajeros" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: dodgerblue"><i class="fas fa-user-edit"></i> Pasajeros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" ng-click="">&times;</span>
                </button>
            </div>
            <form name="userForm" ng-submit="submitForm()">
            <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">DNI (sin letra)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="x in [].constructor(nBilletes) track by $index">
                            <td class="align-middle" scope="col">{{$index+1}}</td>
                            <!--<tr>
                                <td class="align-middle" scope="col"></td>-->
                            <td scope="col"><input type="text" class="form-control" required id="nombre_{{$index}}"></td>
                            <td scope="col"><input type="text" class="form-control" required id="apellidos_{{$index}}"></td>
                            <td scope="col"><input type="number" class="form-control" required id="dni_{{$index}}" style="-moz-appearance: textfield;"></td>
                        </tr>
                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" ng-click="">Close</button>
                <button type="submit" class="btn btn-success"><i class="fas fa-user-plus"></i> Registrar pasajeros</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>