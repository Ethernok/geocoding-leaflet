<?php
include './conexion.php';
$db = new db();

$cliente = $_POST["cliente"];
// No se si funciona
 echo json_encode($db->getCliente($cliente));
?>