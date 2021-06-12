<?php 

    require("../conexion/conexion.php");
    $base = Conectar::conexion();

    $id = $_GET["ID"];

    $base->query("DELETE FROM producto_individual_cocacola WHERE ID='$id'");
    header("Location:../../WEB/productos/coca-cola.php");

?>
