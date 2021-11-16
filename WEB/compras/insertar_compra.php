<?php 

require("../../backend/conexion/conexion.php");
$base = Conectar::conexion();

$id=$_GET["ID"];
$total = $_GET["total"];
$nombrePaguina = trim($_GET["nom"]);

$rubro = $_GET["rubro"];

$nombre_producto = $_GET["nproducto"];
$imagen = $_GET["img"];

$sql = "INSERT INTO compras (NOMBRE, RUBRO, TOTAL, IMAGEN) VALUES ('" . $nombre_producto . "','" . $rubro . "','" . $total . "','" . $imagen . "')";
$result = $base->prepare($sql);
$result->execute();

if($nombrePaguina!="compras" && $nombrePaguina!="cambiar_vista") {

    header("Location:../productos/" . $nombrePaguina . ".php");

}else if ($nombrePaguina=="compras"){

    header("Location:../compras.php");

}else if($nombrePaguina=="cambiar_vista") {

    header("Location:../compras/cambiar_vista.php");

}

?>