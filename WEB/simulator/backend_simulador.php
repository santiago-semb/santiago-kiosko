<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulator | Kiosko</title>
    <link rel="stylesheet" href="../assets/styles/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <style>

        table {
            margin: auto;
            width: 50%;
            border: 2px solid white;
            border-radius: 0.5em;
            padding: 10px;
            background-color: gray;
            color: white;
        }
        
        td{
            padding:5px 0px;
            
        }

        .h1-inicio {
            padding: 20px;
            text-align: center;
            font-size: 25px;
            
        }

        h4, h5, h6 {
            text-align: center;
        }

        .form-busqueda-barras {
            margin-top: 15px;
            margin-bottom: 15px;
            text-align: center;
        }

        #div-simulator-product {
            margin: 0px auto;
        }
        
        #div-porcentaje {
            margin: 0px auto;
            padding: 5px;
            text-align: center;

        }

        #porcentaje {
            margin-top: 5px;
            margin-bottom: 5px;
            width: 40px;
            height: 20px;
            
        }

        .form-porcentaje { 
            border: 1px solid gray;
            width: 85%;
            margin: 0px auto;
            height: 500px;
            margin-bottom: 30px;
        }

        #div-button {
            padding: 5px;
            text-align: center;
        }

        #div-informacion-producto {
            padding: 5px;
        }

        .info-p {
            border-bottom: 1px solid red;
            margin: 0px auto;
            width: 15%;
        }

        .info-por {
            border-bottom: 1px solid green;
            margin: 0px auto;
            width: 5%;
        }

        .info-p-final {
            border-bottom: 1px solid greenyellow;
            margin: 0px auto;
            width: 15%;
        }

        .button-porcentaje {
            border: 1px solid white;
            background-color: whitesmoke;
            color: blue;
            border-radius: 0.2em;
            width: 30%;
            height: 20px;
            line-height: 10px;
        }

    </style>
</head>
<body>
    <header class="header">
        <h1>KIOSKITO</h1>
    </header>

    <nav class="menu">
        <ul>
            <li><a href="../inicio.html" class="a-menu-li"><button class="button-li">Inicio</button></a></li>
            <li><a href="../productos.php" class="a-menu-li"><button class="button-li">Productos</button></a></li>
            <li><a href="../compras.php" class="a-menu-li"><button class="button-li">Compras</button></a></li>
            <li><a href="../ventas.php" class="a-menu-li"><button class="button-li">Ventas</button></a></li>
        </ul>
    </nav>

    <h1 class="h1-inicio">PRODUCTS SIMULATOR</h1>


        <div id="div-barcode-search">
<?php
    require("../../backend/conexion/conexion.php");
    $base = Conectar::conexion();
    $id = $_GET["id"];

    $sql = "SELECT * FROM barcode_products WHERE ID=$id";
    $resultado = $base->prepare($sql);
    $resultado->execute();
    $sentencia = $resultado->fetch(PDO::FETCH_OBJ);
    if($sentencia->LITROS > 3){
        $nombreProducto = $sentencia->NOMBRE . " " . $sentencia->LITROS . " ML";
    }elseif($sentencia->LITROS == 0){
        $nombreProducto = $sentencia->NOMBRE;
    }else{
        $nombreProducto = $sentencia->NOMBRE . " " . $sentencia->LITROS . " L";
    }
    $precioCompraProducto = $sentencia->PRECIOcompra;
    $precioVentaProducto = $sentencia->PRECIOventa;
    $idProducto = $sentencia->ID;


    function simularPorcentaje($valorQueAniade, $porcentaje){
        $porcentajeD100 = $porcentaje / 100;
        $resultado = $porcentajeD100 * $valorQueAniade;
        $valor = $valorQueAniade + $resultado;
        return $valor;
    }

    if(isset($_GET['porcentajeAAñadir'])){
        $porcentajeForm = $_GET['porcentajeAAñadir'];
    }else{
        $porcentajeForm = 0;
    }

?>

        <form class="form-porcentaje" action="<?php echo $_SERVER['PHP_SELF']?>" method="GET">
        <input type="hidden" name="id" value="<?php echo $idProducto ?>">
            <div id="div-simulator-product">
                <h4>SU PRODUCTO</h4>
                <div id="div-informacion-producto">
                <h6 class="info-p"><?php echo $nombreProducto ?></h6>
                <h6 class="info-p">COMPRA $<?php echo $precioCompraProducto ?></h6>
                <h6 class="info-p">VENTA $<?php echo $precioVentaProducto ?></h6>
                </div>
            </div>
            <div id="div-porcentaje">
                <h4>PORCENTAJE A AÑADIR (precio compra)</h4>
                <input type="number" name="porcentajeAAñadir" id="porcentaje">%
            </div>
            <div id="div-final">
                <h5>RESULTADO</h5>
                <div id="div-informacion-producto">
                <h4 class="info-p-final">COMPRA $<?php echo $precioCompraProducto ?></h4>
                <?php
                    if(isset($_GET['porcentajeAAñadir'])){
                        $porcentajeGET = $_GET['porcentajeAAñadir'];
                    }else{
                        $porcentajeGET = 0;
                    }
                 
                 ?>
                <h6 class="info-por">+<?php echo $porcentajeGET ?>%</h6>
                <h4 class="info-p-final">VENTA $<?php $resultado = simularPorcentaje($precioCompraProducto, $porcentajeGET); echo $resultado; ?></h4>
                </div>
            </div>

            <div id="div-button">
                <input type="submit" class="button-porcentaje">
            </div>
        </form>




</body>
</html>