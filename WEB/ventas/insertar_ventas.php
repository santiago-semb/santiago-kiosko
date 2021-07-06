<?php 

    require("../../backend/conexion/conexion.php");
    $base = Conectar::conexion();

    $nombre = $_GET["nom"];
    $total = $_GET["precio"];

    $sql = "INSERT INTO ventas (NOMBRE, TOTAL) VALUES ('$nombre','$total')";
    $resultado = $base->prepare($sql);
    $resultado->execute();

    header("Location:../../WEB/ventas/cartel_venta_confirmada.php?precio=$total & nom=$nombre");
?>