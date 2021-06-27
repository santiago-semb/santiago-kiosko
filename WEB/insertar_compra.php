<?php 

require("../backend/conexion/conexion.php");
$base = Conectar::conexion();

$id=$_GET["ID"];
$total = $_GET["total"];
$nombrePaguina = $_GET["nombre"];
$litros = $_GET["litros"];

if($litros<=3){
    $nombre = $_GET["nombre"] . " " . $litros . " L";
}else{
    $nombre = $_GET["nombre"] . " " . $litros . " ML";
}


$sql = "INSERT INTO compras (NOMBRE, TOTAL) VALUES ('" . $nombre . "','" . $total . "')";
$result = $base->prepare($sql);
$result->execute();

header("Location:../WEB/productos/" . $nombrePaguina . ".php");
?>