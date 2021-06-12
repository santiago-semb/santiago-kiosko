<?php 

    require("../../backend/conexion/conexion.php");
    $base = Conectar::conexion();

    $nombre= $_POST["nombre_producto"];

    $query = "DELETE FROM productoslogo WHERE NOMBRE='$nombre'"; 
    $resultado=$base->prepare($query);
    $resultado->execute();

    header("Location:../../WEB/productos.php");

?>