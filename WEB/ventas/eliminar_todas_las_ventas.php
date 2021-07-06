<?php 

    require("../../backend/conexion/conexion.php");
    $base = Conectar::conexion();

    $query = "DELETE FROM ventas";
    $resultado = $base->prepare($query);
    $resultado->execute();

    header("Location:../ventas.php");

?>