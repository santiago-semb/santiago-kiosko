<?php 

    require("../conexion/conexion.php");
    $base = Conectar::conexion();

    $id = $_GET["ID"];
    $proovedor = $_GET["prov"];
    $nombre = $_GET["nom"];

    $tabla= 'producto_individual_' . $nombre;

    $base->query("DELETE FROM $tabla WHERE ID='$id'");
    header("Location:'../../../../WEB/productos/" . $nombre . ".php");


?>