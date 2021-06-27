<?php

    require("../backend/conexion/conexion.php");
    $base = Conectar::conexion();

    $id = $_GET["ID"];

    $sql="DELETE FROM compras WHERE ID='$id'";
    $resultado = $base->prepare($sql);
    $resultado->execute();

    header("Location:compras.php");

?>