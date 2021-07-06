<?php 

    require("../../backend/conexion/conexion.php");
    $base = Conectar::conexion();

    $names = $_GET["nom"];

    $query = "DELETE FROM compras";
    $resultado = $base->prepare($query);
    $resultado->execute();

    header("Location:../compras.php");

?>