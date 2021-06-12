<?php
require("../backend/conexion/conexion.php");
$base=Conectar::conexion();

$usuario=$_POST["usuario"];
$password=$_POST["contra"];
$ciudad=$_POST["elegir-ciudad"];


try {  

    $consulta="INSERT INTO registros (USUARIO, CLAVE, CIUDAD) VALUES (:usuario, :pasword, :ciudad)";
    $resultado=$base->prepare($consulta);
    $resultado->execute(array(":usuario"=>$usuario, ":pasword"=>$password, ":ciudad"=>$ciudad));

    if($resultado) {
        echo "registro insertado";
        header("location:../web/index.html");
    }else{
        echo "Error al crear la cuenta.";
    }

    $resultado->closeCursor();
}catch(Exception $e) {
    echo "Linea del error: " . $e->getLine() . "<br>";
    echo "Error: " . $e->getMessage();
}


?>