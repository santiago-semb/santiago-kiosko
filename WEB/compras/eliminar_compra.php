<?php

    require("../../backend/conexion/conexion.php");
    $base = Conectar::conexion();

    $id = $_GET["ID"];
    $url = $_GET["url"];

    $sql="DELETE FROM compras WHERE ID='$id'";
    $resultado = $base->prepare($sql);
    $resultado->execute();

    if($url=="compras") {
        header("Location:../../WEB/" . $url . ".php");
    }
    if($url=="cambiar_vista"){
        header("Location:../../WEB/compras/" . $url . ".php");
    }

?>