<?php 

require("../../backend/conexion/conexion.php");
$base = Conectar::conexion();

$id=$_GET["ID"];
$total = $_GET["total"];
$nombrePaguina = trim($_GET["nom"]);



$nombre_producto = $_GET["nproducto"];

$sql = "INSERT INTO compras (NOMBRE, TOTAL) VALUES ('" . $nombre_producto . "','" . $total . "')";
$result = $base->prepare($sql);
$result->execute();

header("Location:../productos/" . $nombrePaguina . ".php");
?>