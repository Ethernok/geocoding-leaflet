<?php
include './conexion.php';
$db = new db();
$clientes = $db->getListaClientes();
$pedidos = $db->getListaPedidos();
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <script src="./js/jquery-3.2.1.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="./css/styles.css" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
    <script src="https://unpkg.com/esri-leaflet@2.0.8"></script>
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.4/dist/esri-leaflet-geocoder.css" />
    <script src="https://unpkg.com/esri-leaflet-geocoder@2.2.4"></script>
    
</head>

<body class="bg-dark">
    <div id="Izq" class="container">
        <div>
            <form class="form-horizontal" id="formu">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header">
                        <h2>Datos del cliente</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="well well-sm">

                                    <fieldset>
                                        <div class="form-group">
                                            <div class="col input-group-prepend">
                                                <div class="col input-group-text">
                                                    <span class="text-center"><i class="fa fa-address-card"></i></span>
                                                </div>
                                                <select id="lista-id" class="form-select-sm form-control  mr-5">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                </select>
                                                <div class="col input-group-text">
                                                    <span class="text-center"><i class="fa fa-user"></i></span>
                                                </div>
                                                <input id="nombre" name="nombre" type="text" placeholder="Nombre y Apellidos" class="form-control">


                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col input-group-prepend">

                                                <div class="col input-group-text">
                                                    <span class="text-center"><i class="fa fa-phone"></i></span>
                                                </div>
                                                <input id="telefono" name="telefono" type="tel" placeholder="Telefono de Contacto" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <div class="col input-group-prepend">
                                                <div class="col input-group-text">
                                                    <span class="text-center"><i class="fa fa-at"></i></span>
                                                </div>
                                                <input id="pedido" name="pedido" type="text" placeholder="Pedido" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <div class="col input-group-prepend">
                                                <div class="col input-group-text">
                                                    <span class="text-center"><i class="fa fa-map-marked"></i></span>
                                                </div>
                                                <input id="direccion" name="direccion" type="text" placeholder="Dirección" class="form-control">
                                                <button type="button" id="buscar" class="btn btn-primary btn-sm">O</button>

                                            </div>
                                        </div>
                                        <div class="form-group" id="b">
                    <div class="text-center">
                        <button id="nuevo-pedido" class="btn btn-primary btn-lg">Enviar</button>
                    </div>
                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                
                </fieldset>
            </form>
            <div class="card text-white bg-secondary ">
                    <center>
                        <div class="card-header">
                            <h5>Mapa</h5>
                        </div>
                        <div class="card-body">
                        <div id="map"></div>
                        </div>
                       
                    </center>

                </div>

        </div>
    </div>
    
    <div id="Der" class="text-white">
        <div class="card-header text-center">
            <h5>Pedidos</h5>
        </div>
        <div id="tabla-pedidos" class="card-body d-flex justify-content-center ">
            <table class="table">
                <thead class="text-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ID Cliente</th>
                        <th scope="col">Pedido</th>
                        <th scope="col">Dirección</th>
                    </tr>
                </thead>
                <tbody id="datos-tabla" class="text-light">
                    <?php
                    foreach ($pedidos as $pedido) {
                    ?>
                        <tr id="<?php echo $pedido->id; ?>">
                            <th scope="row"><?php echo $pedido->id; ?></th>
                            <td><?php echo $pedido->id_cliente; ?></td>
                            <td><?php echo $pedido->producto; ?></td>
                            <td><?php echo $pedido->direccion; ?></td>
                        </tr>
                    <?php
                }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
    </div>
    <script src="./js/app.js"></script>
    <script src="./js/ajax.js"></script>
</body>

</html>