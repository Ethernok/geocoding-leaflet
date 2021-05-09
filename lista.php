<?php
include './conexion.php';
$db = new db();
$id_cliente = $_POST["id"];
$pedido = $_POST["pedido"];
$direccion = $_POST["direccion"];
 echo json_encode($db->nuevoPedido($id_cliente, $pedido, $direccion));
?>