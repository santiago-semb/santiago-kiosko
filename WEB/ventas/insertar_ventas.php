<?php 

    require("../../backend/conexion/conexion.php");
    $base = Conectar::conexion();

    $nombre = $_GET["nom"];
    $rubro = $_GET["rubro"];
    $total = $_GET["precio"];


    $sql = "INSERT INTO ventas (NOMBRE, RUBRO, TOTAL) VALUES ('" . $nombre . "','" . $rubro . "','" . $total . "')";
    $resultado = $base->prepare($sql);
    $resultado->execute();

    header("Location:../../WEB/ventas/cartel_venta_confirmada.php?precio=$total & nom=$nombre");

?>