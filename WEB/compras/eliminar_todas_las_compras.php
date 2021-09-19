<?php 

    require("../../backend/conexion/conexion.php");
    $base = Conectar::conexion();

    $names = $_GET["nom"];
    $url = $_GET["url"];

    $query = "DELETE FROM compras";
    $resultado = $base->prepare($query);
    $resultado->execute();

    if($url=="compras") {
        header("Location:../../WEB/" . $url . ".php");
    }
    if($url=="cambiar_vista"){
        header("Location:../../WEB/compras/" . $url . ".php");
    }


?>