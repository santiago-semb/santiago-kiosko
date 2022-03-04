<?php

require("../backend/conexion/conexion.php");
    $base = Conectar::conexion();


   for($i=1;$i<=8;$i++){

        $contador = $i;
        $valueName;

    //nombre
        switch($contador) {
            case $contador:
                $valueName = "nombre$contador";
            break;    
        }
        $sqlName;
        switch($valueName) {
            case "nombre$contador":
                $sqlName = $_POST["nombre$contador"];
            break;
            
        }

    //precio 
        switch($contador) {
            case $contador:
                $valueName = "precio$contador";
            break;    
        }
        $sqlPrice;
        switch($valueName) {
            case "precio$contador":
                $sqlPrice = $_POST["precio$contador"];
            break;
            
        }
    //rubro

        switch($contador) {
            case $contador:
                $valueName = "rubro$contador";
            break;    
        }
        $sqlName;
        switch($valueName) {
            case "rubro$contador":
                $sqlRubro = $_POST["rubro$contador"];
            break;
            
        }

        if(!$sqlName == null || !$sqlName == ""){
        
        $sql = "INSERT INTO ventas (NOMBRE, RUBRO, TOTAL) VALUES ('" . $sqlName . "','" . $sqlRubro . "','" . $sqlPrice . "')";
        $k = $base->prepare($sql);
        $k->execute();

        }

        $contador++;
        

    }

        $sqlDeleteCompras = "DELETE FROM compras";
        $resSqlDeleteCompras = $base->prepare($sqlDeleteCompras);
        $resSqlDeleteCompras->execute();

    header("Location:compras.php");

?>