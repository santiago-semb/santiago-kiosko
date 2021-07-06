<?php 

require("../../backend/conexion/conexion.php");
$base = Conectar::conexion();

$id=$_GET["ID"];
$total = $_GET["total"];
$nombrePaguina = $_GET["nombre"];
$litros = $_GET["litros"];

if($litros<=3){
    $nombre = $_GET["nombre"] . " " . $litros . " L";
        if($litros==0) {
            $nombre = $_GET["nombre"];
        }
}else{
    $nombre = $_GET["nombre"] . " " . $litros . " ML";
        if($litros==0) {
            $nombre = $_GET["nombre"];
        }
}


$sql = "INSERT INTO compras (NOMBRE, TOTAL) VALUES ('" . $nombre . "','" . $total . "')";
$result = $base->prepare($sql);
$result->execute();

header("Location:../productos/" . $nombrePaguina . ".php");
?>