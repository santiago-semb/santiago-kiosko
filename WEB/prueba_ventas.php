<?php

require("../backend/conexion/conexion.php");
    $base = Conectar::conexion();
<<<<<<< HEAD
//$_post   
=======

>>>>>>> 67d42383c8020311d2003e2d119fa085abf40064
    $name1 = $_POST["nombre1"];
    $name2 = $_POST["nombre2"];
    $name3 = $_POST["nombre3"];
    $name4 = $_POST["nombre4"];
    $name5 = $_POST["nombre5"];
    $name6 = $_POST["nombre6"];
    $name7 = $_POST["nombre7"];
    $name8 = $_POST["nombre8"];

    $price1 = $_POST["price1"];
    $price2 = $_POST["price2"];
    $price3 = $_POST["price3"];
    $price4 = $_POST["price4"];
    $price1 = $_POST["price5"];
    $price2 = $_POST["price6"];
    $price3 = $_POST["price7"];
    $price4 = $_POST["price8"];

<<<<<<< HEAD
    $rubro1 = $_POST["rubro1"];
    $rubro2 = $_POST["rubro2"];
    $rubro3 = $_POST["rubro3"];
    $rubro4 = $_POST["rubro4"];
    $rubro5 = $_POST["rubro5"];
    $rubro6 = $_POST["rubro6"];
    $rubro7 = $_POST["rubro7"];
    $rubro8 = $_POST["rubro8"];
//$_post end
=======
>>>>>>> 67d42383c8020311d2003e2d119fa085abf40064
   for($i=1;$i<=8;$i++){

        $contador = $i;
        $valueName;
        switch($contador){
            case 1:
                $valueName = "nombre1";
                break;
            case 2:
                $valueName = "nombre2";
                break;
            case 3:
                $valueName = "nombre3";
                break;
            case 4:
                $valueName = "nombre4";
                break;
            case 5:
                $valueName = "nombre5";
                break;
            case 6:
                $valueName = "nombre6";
                break;
            case 7:
                $valueName = "nombre7";
                break;
            case 8:
                $valueName = "nombre8";
                break;
        }
        $sqlName;
        if($valueName == "nombre1") {
            $sqlName = $name1;
        }
        if($valueName == "nombre2") {
            $sqlName = $name2;
        }
        if($valueName == "nombre3") {
            $sqlName = $name3;
        }
        if($valueName == "nombre4") {
            $sqlName = $name4;
        }
        if($valueName == "nombre5") {
            $sqlName = $name5;
        }
        if($valueName == "nombre6") {
            $sqlName = $name6;
        }
        if($valueName == "nombre7") {
            $sqlName = $name7;
        }
        if($valueName == "nombre8") {
            $sqlName = $name8;
        }

        if(!$sqlName == null || !$sqlName == ""){
        
<<<<<<< HEAD
        $sql = "INSERT INTO ventas (NOMBRE, RUBRO, TOTAL) VALUES ('" . $sqlName . "','" . $rubro . "','" . $price . "')";
=======
        $sql = "INSERT INTO ventas (NOMBRE, TOTAL) VALUES ('" . $sqlName . "','" . $price . "')";
>>>>>>> 67d42383c8020311d2003e2d119fa085abf40064
        $k = $base->prepare($sql);
        $k->execute();

        }

        $contador++;
        

    }

    
    header("Location:compras.php");

?>