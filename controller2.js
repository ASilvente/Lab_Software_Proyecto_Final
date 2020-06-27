'use strict';

angular.module("trabajo", ['ngRoute'])
    .controller("ctrol", function ($scope, $http, $filter) {
        var contadorIDA = 0;
        $scope.elementoIDA = {};
        $scope.elementoSalida = {};
        $scope.elementoSalidaV = {};
        $scope.deshabilitarIDA = false;

        var contadorIntermedioIDA = 0;
        $scope.elementoIntermedioIDA = {};
        $scope.deshabilitarIntermedioIDA = false;
        
        var contadorDestinoIDA = 0;
        $scope.elementoDestinoIDA = {};
        $scope.deshabilitarDestinoIDA = false;

        var contadorVUELTA = 0;
        $scope.elementoVUELTA = {};
        $scope.nombre = null;
        $scope.apellidos = null;

        $scope.dni = null;
        $scope.nameForm = null;

        var pasajeros = [];

        $scope.tipoBilleteIda = '';
        $scope.tipoBilleteVuelta = '';

        $scope.deshabilitarVUELTA = false;
        $scope.init = function () {
            $scope.data = [];
            $scope.comprar = [];
            $scope.error = "";
            $scope.selectedOrderIDA = 'vuelo';
            $scope.selectedOrderIntermedioIDA = 'vuelo';
            $scope.selectedOrderDestinoIDA = 'vuelo';

            $scope.selectedOrderVUELTA = 'vuelo';
            $scope.values = "origen";
            $scope.precioIDA = 0;
            $scope.precioIntermedioIDA = 0;
            $scope.precioDestinoIDA = 0;

            $scope.precioVUELTA = 0;

            $scope.vuelta = false;

            $scope.ida = false;
            $scope.CiudadIntermedia = '';
            $scope.Intermedioida = false;
            $scope.DestinoIDA = false;

            $scope.showVuelta = true;
            $scope.showCliente = true;

            $scope.pageSize = 50;
            $scope.currentPage = 0;
        };
        $http.get("php/fetch_data.php").then(function (response) {

            $scope.data = response.data; //para php

        });



        //paginacion
        $scope.prevPage = function () {
            if ($scope.currentPage > 0) {
                $scope.currentPage--;
            }
        };

        $scope.nextPage = function () {
            if (parseInt($scope.currentPage) < parseInt($scope.pageSize) - 1) {
                $scope.currentPage++;
            }
        };


        $scope.submitForm = function () {
            var billetes = document.getElementById('nBilletes').value;
            for (var i = 0; i < billetes; i++){
                pasajeros.push({'nombre': document.getElementById('nombre_'+i).value,
                    'apellidos': document.getElementById('apellidos_'+i).value,
                    'dni': document.getElementById('dni_'+i).value});
            }
            var elementoVUELTA =  $scope.elementoVUELTA;
            var elementoSalidaV =  $scope.elementoSalidaV;
            var tipoBilleteVuelta = $scope.tipoBilleteVuelta;
            if(angular.equals($scope.elementoVUELTA, {})){
                elementoVUELTA = "";
                elementoSalidaV = "";
                tipoBilleteVuelta = "";
            }

            pasajeros.push({'vuelo_ida': $scope.elementoIDA,
            'vuelo_vuelta': elementoVUELTA,
            'salida_ida': $scope.elementoSalida,
            'salida_vuelta': elementoSalidaV,
            'tipoBilleteIda': $scope.tipoBilleteIda,
            'tipoBilleteVuelta': tipoBilleteVuelta});

            console.log(pasajeros);
            $http.post(
                    "php/subir.php", pasajeros
                )
                .then(function (respuesta) {
                    console.log(respuesta);
                    $scope.nombre = null;
                    $scope.apellidos = null;
                    $scope.dni = null;
                    window.location = ('index.php');
                });
        };

        $scope.submitFormCompany = function () {
            $http.post(
                    "insertar_vuelo.php", {

                        'origen': $scope.searchOrigin,
                        'destino': $scope.searchDestiny,
                        'salida': $scope.fechaCheckIn,
                        'llegada': $scope.fechaCheckOut,
                        'plazas_business': $scope.plazas_business,
                        'plazas_optima': $scope.plazas_optima,
                        'plazas_economy': $scope.plazas_economy,
                        'precio_business': $scope.precio_business,
                        'precio_optima': $scope.precio_optima,
                        'precio_economy': $scope.precio_economy,
                    }
                )
                .then(function (respuesta) {

                    console.log(respuesta);
                    $scope.origen = null;
                    $scope.destino = null;
                    $scope.salida = null;
                    $scope.llegada = null;
                    $scope.plazas_business = null;
                    $scope.plazas_optima = null;
                    $scope.plazas_economy = null;
                    $scope.precio_business = null;
                    $scope.precio_optima = null;
                    $scope.precio_economy = null;
                    window.location = ('company.html');
                });
        };

        $scope.UpdateFormCompany = function () {
            $http.post(
                    "actualizar_vuelo.php", {

                        'vuelo': $scope.IDvuelo,
                        'origen': $scope.RutaVueloOrigen,
                        'destino': $scope.RutaVueloDestino,
                        'fecha': $scope.RutaFecha,
                        'plazas_business': $scope.plazas_business,
                        'plazas_optima': $scope.plazas_optima,
                        'plazas_economy': $scope.plazas_economy,
                        'precio_business': $scope.precio_business,
                        'precio_optima': $scope.precio_optima,
                        'precio_economy': $scope.precio_economy,
                    }
                )
                .then(function (respuesta) {

                    console.log(respuesta);
                    $scope.vuelo = null;
                    $scope.origen = null;
                    $scope.destino = null;
                    $scope.fecha = null;
                    $scope.plazas_business = null;
                    $scope.plazas_optima = null;
                    $scope.plazas_economy = null;
                    $scope.precio_business = null;
                    $scope.precio_optima = null;
                    $scope.precio_economy = null;
                });
        };

        /*  Seleccionar orden de la tabla */
        $scope.setOrderIDA = function (x) {
            $scope.selectedOrderIDA = x;

        };
        $scope.setOrderIntermedioIDA = function (x) {
            $scope.selectedOrderIntermedioIDA = x;

        };
        $scope.setOrderDestinoIDA = function (x) {
            $scope.selectedOrderIntermedioIDA = x;

        };
        $scope.setOrderVUELTA = function (x) {
            $scope.selectedOrderVUELTA = x;

        };

        /*  Selecciona elemento de la checkbox (el identificador del vuelo) y lo almacena o lo borra*/
        /*  Tambien activa o desactiva el poder mostrar el precio */

        $scope.seleccionIDA = function (posicion, salida) {
            contadorIDA++;
            $scope.ida = false;
            if (contadorIDA % 2 != 0) {
                $scope.elementoIDA = posicion;
                $scope.elementoSalida = salida;
                //console.log($scope.elementoSalida);
                $scope.estadoDeshabilitarIDA = true;
                $scope.ida = true;

            } else {
                contadorIDA = 0;
                $scope.elementoIDA = {};
                $scope.elementoSalida = {};
                $scope.estadoDeshabilitarIDA = false;
                $scope.ida = false;
                $scope.precioIDA = 0;
            }
        };

        $scope.seleccionIntermedioIDA = function (posicion) {
            contadorIntermedioIDA++;
            $scope.IntermedioIDA = false;
            if (contadorIntermedioIDA % 2 != 0) {
                $scope.elementoIntermedioIDA = posicion;
                $scope.estadoDeshabilitarIntermedioIDA = true;
                $scope.IntermedioIDA = true;
                console.log(posicion);
                $scope.CiudadIntermedia = posicion;

            } else {
                contadorIDA = 0;
                $scope.elementoIntermedioIDA = {};
                $scope.estadoDeshabilitarIntermedioIDA = false;
                $scope.Intermedioida = false;
                $scope.precioIntermedioIDA = 0;
                $scope.CiudadIntermedia = '';

            }
        };

        $scope.seleccionDestinoIDA = function (posicion) {
            contadorDestinoIDA++;
            $scope.DestinoIDA = false;
            if (contadorDestinoIDA % 2 != 0) {
                $scope.elementoDestinoIDA = posicion;
                $scope.estadoDeshabilitarDestinoIDA = true;
                $scope.DestinoIDA = true;

            } else {
                contadorDestinoIDA = 0;
                $scope.elementoDestinoIDA = {};
                $scope.estadoDeshabilitarDestinoIDA = false;
                $scope.Destinoida = false;
                $scope.precioDestinoIDA = 0;
            }
        };

        $scope.billetera = function (value) {
            return parseInt(value);
        }

        $scope.seleccionVUELTA = function (posicion, salida) {
            contadorVUELTA++;
            if (contadorVUELTA % 2 != 0) {
                $scope.elementoVUELTA = posicion;
                $scope.elementoSalidaV = salida;
                $scope.estadoDeshabilitarVUELTA = true;
                $scope.vuelta = true;
            } else {
                contadorVUELTA = 0;
                $scope.elementoVUELTA = {};
                $scope.elementoSalidaV = {};
                $scope.estadoDeshabilitarVUELTA = false;
                $scope.vuelta = false;
                $scope.precioVUELTA = 0;
            }
        };

        /*  Retorna el valor almacenado en el elemento (el identificador del vuelo), si no coincide con el identificador de vuelo nuevo el checkbox quedara deshabilitado */
        $scope.deshabilitarIDA = function () {
            return $scope.elementoIDA;
        };

        $scope.deshabilitarIntermedioIDA = function () {
            return $scope.elementoIntermedioIDA;
        };

        $scope.deshabilitarDestinoIDA = function () {
            return $scope.elementoDestinoIDA;
        };

        $scope.deshabilitarVUELTA = function () {
            return $scope.elementoVUELTA;
        };

        /*  Actualiza el precio del billete */


        $scope.EstablecerPrecioIDA = function (x) {
            $scope.precioIDA = x;
        };
        $scope.EstablecerPrecioIntermedioIDA = function (x) {
            $scope.precioIntermedioIDA = x;
        };
        $scope.EstablecerPrecioDestinoIDA = function (x) {
            console.log(x);
            $scope.precioDestinoIDA = x;
        };
        $scope.EstablecerPrecioVUELTA = function (x) {
            $scope.precioVUELTA = x;
        };

        /*  Al reservar un vuelo elimina el valor del elemento (el identificador de vuelo) para que si se decide posteriormente realizar otra reserva no aparezcan los checkbox deshabilitados */

        $scope.limpiar = function () {
            if ($scope.elementoIDA.length != undefined) {
                $scope.seleccionIDA($scope.elementoIDA);
            }
            if ($scope.elementoIntermedioIDA.length != undefined) {
                $scope.seleccionIntermedioIDA($scope.elementoIntermedioIDA);
            }
            if ($scope.elementoVUELTA.length != undefined) {
                $scope.seleccionVUELTA($scope.elementoVUELTA);
            }

        };

        $scope.setTipoIda = function (tipo) {
            $scope.tipoBilleteIda = tipo;
        };

        $scope.setTipoVuelta = function (tipo) {
            $scope.tipoBilleteVuelta = tipo;
        };

        $scope.init();

    })
    //indica desde que valor tiene que empezar a contar, se usa para la paginacion de la pagina company.html
    .filter('startFrom', function () {
        return function (input, start) {
            if (input) {
                start = +start; //parse to int
                var appended = input.slice(0, start);
                var initialArray = input.slice(start);
                var finalArray = initialArray.concat(appended);
                return finalArray;
            }
            return [];
        };
    })

    .filter('removeSpaces', [function () {
        return function (string) {
            if (!angular.isString(string)) {
                return string;
            }
            return string.replace(/[\s]/g, '');
        };
    }])
    /*  Filtra los nombres de Origen y Destino de tal manera que no se envien duplicados */

    .filter('unique', function () {
        return function (collection, keyname) {
            var output = [],
                keys = [];

            angular.forEach(collection, function (item) {
                var key = item[keyname];
                if (keys.indexOf(key) === -1) {
                    keys.push(key);
                    output.push(item);
                }
            });
            return output;
        };
    })
    /*  Analiza letra a letra la cadena de texto y muestra caracteres especiales  */

    .filter('utf8_decode', function ($sce) {
        return function (strData) {
            var tmpArr = [];
            var i = 0;
            var c1 = 0;
            var seqlen = 0;
            var anterior = 0;
            strData += '';

            while (i < strData.length) {
                c1 = strData.charCodeAt(i) & 0xFF;
                seqlen = 0;
                if ((c1 == 63 && anterior == 73)) {
                    c1 = 0xC1;
                    seqlen = 1;

                } else if ((c1 == 63 && anterior == 79)) {
                    c1 = 0xD1;
                    seqlen = 1;

                } else if ((c1 == 63 && anterior == 85)) {
                    c1 = 0xD1;
                    seqlen = 1;

                } else if (c1 <= 0xBF) {
                    c1 = (c1 & 0x7F);
                    seqlen = 1;
                    anterior = c1;

                } else if (c1 <= 0xDF) {
                    c1 = (c1 & 0x1F);
                    seqlen = 2;
                } else if (c1 <= 0xFF) {
                    c1 = 0xBF;
                    seqlen = 3;
                } else {
                    c1 = (c1 & 0xFD);
                    seqlen = 4;
                }

                if (seqlen == 4) {
                    c1 -= 0x10000;
                    tmpArr.push(String.fromCharCode(0xD800 | ((c1 >> 10) & 0x3FF)));
                    tmpArr.push(String.fromCharCode(0xDC00 | (c1 & 0x3FF)));
                } else {
                    tmpArr.push(String.fromCharCode(c1));
                }
                i += seqlen;
            }
            return tmpArr.join('');
        };
    })
    /*  Mismo codigo pero codifica los caracteres, utilizado para las consultas a la bbdd */

    .filter('utf8_encode', function ($sce) {
        return function (strData) {
            var tmpArr = [];
            var i = 0;
            var c1 = 0;
            var seqlen = 0;
            var anterior = 0;
            strData += '';
            while (i < strData.length) {
                c1 = strData.charCodeAt(i) & 0xFF;
                seqlen = 0;
                if ((c1 == 0xC1 && anterior == 73)) {
                    c1 = 63;
                    seqlen = 1;

                } else if ((c1 == 0xD1 && anterior == 79)) {
                    c1 = 63;
                    seqlen = 1;

                } else if ((c1 == 209 && anterior == 85)) {
                    c1 = 63;
                    seqlen = 1;

                } else if (c1 <= 0xBF) {
                    c1 = (c1 & 0x7F);
                    seqlen = 1;
                    anterior = c1;

                } else if (c1 <= 0xDF) {
                    c1 = (c1 & 0x1F);
                    seqlen = 2;
                } else if (c1 <= 0xFF) {
                    c1 = 0xBF;
                    seqlen = 3;
                } else {
                    c1 = (c1 & 0xFD);
                    seqlen = 4;
                }

                if (seqlen == 4) {
                    c1 -= 0x10000;
                    tmpArr.push(String.fromCharCode(0xD800 | ((c1 >> 10) & 0x3FF)));
                    tmpArr.push(String.fromCharCode(0xDC00 | (c1 & 0x3FF)));
                } else {
                    tmpArr.push(String.fromCharCode(c1));
                }
                i += seqlen;
            }
            return tmpArr.join('');
        };
    })
    .config(function ($routeProvider) {
        $routeProvider.
        when('/', {
            controller: 'ctrol',
            templateUrl: 'main.php'
        }).
        when('/prueba/:origen/:destino/:nBilletes/:fcheckIn', {
            controller: 'CountDownCtrl',
            templateUrl: 'prueba.php'
        }).
        when('/prueba/:origen/:destino/:nBilletes/:fcheckIn/:fcheckOut', {
            controller: 'CountDownCtrlb',
            templateUrl: 'prueba.php'
        }).
        otherwise({
            redirectTo: '/'
        });
    })
    .controller('MainCtrl', function ($scope) {


    })
    .controller('CountDownCtrl', function ($scope, $routeParams, $timeout) {
        $scope.origen = $routeParams.origen;
        $scope.destino = $routeParams.destino;
        $scope.fcheckIn = $routeParams.fcheckIn;
        $scope.nBilletes = $routeParams.nBilletes;

    })
    .controller('CountDownCtrlb', function ($scope, $routeParams, $timeout) {
        $scope.origen = $routeParams.origen;
        $scope.destino = $routeParams.destino;
        $scope.fcheckIn = $routeParams.fcheckIn;
        $scope.fcheckOut = $routeParams.fcheckOut;
        $scope.nBilletes = $routeParams.nBilletes;

    });

