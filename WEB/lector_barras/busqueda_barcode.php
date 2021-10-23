<?php 

    require("../../backend/conexion/conexion.php");
    $base = Conectar::conexion();

    $barcode = $_POST["barcode"];
    $name = $_POST["nom"];
    $nombre_tabla = "producto_individual_" . $name;

    $sql = "SELECT * FROM $nombre_tabla"

?>