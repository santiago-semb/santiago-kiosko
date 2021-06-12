<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pepsi | Kiosko</title>
    <link rel="stylesheet" href="../../../WEB/assets/styles/styles.css">

    <style>

        table{
            margin: auto;
            border: 1px solid black;
            text-align: center;
            width: 90%;
        }

        td {
            text-transform: uppercase;
            height: 25px;
        }

        img {
            border: 5px dotted white;
            
        }


    </style>

</head>
<body>
    <header class="header">
        <h1>KIOSKITO</h1>
    </header>

    <nav class="menu">
        <ul>
            <li><a href="../../../WEB/inicio.html" class="a-menu-li"><button class="button-li">Inicio</button></a></li>
            <li><a href="../../../WEB/productos.php" class="a-menu-li"><button class="button-li">Productos</button></a></li>
            <li><a href="../../../WEB/compras.html" class="a-menu-li"><button class="button-li">Compras</button></a></li>
            <li><a href="../../../WEB/ventas.html" class="a-menu-li"><button class="button-li">Ventas</button></a></li>
        </ul>
    </nav>


    <?php 

        require("../../../backend/conexion/conexion.php");
        $base = Conectar::conexion();

        $id = $_GET["ID"];

        $query = "SELECT * FROM producto_individual_pepsi WHERE ID=$id";
        $resultado = $base->prepare($query);
        $resultado->execute();
        $sentencia = $resultado->fetchAll(PDO::FETCH_OBJ);

    ?>

    <?php
        foreach($sentencia as $datos) : ?>
        <table>
            <tr>
                <td><img src='../../../WEB/productos/image-individual/<?php echo $datos->IMAGEN ?>'></td>
            </tr>
            <tr>
                <td><b>nombre:</b> <?php echo $datos->NOMBRE ?> </td>
            </tr>
            <tr>
                <td><b>precio compra:</b> <?php echo $datos->PRECIOcompra ?> </td>
            </tr>
            <tr>
                <td><b>precio venta:</b> <?php echo $datos->PRECIOventa ?> </td>
            </tr>
            <tr>
                <td><b>proovedor:</b> <?php echo $datos->PROOVEDOR ?> </td>
            </tr>
            <tr>
                <td><b>litros:</b> <?php echo $datos->LITROS ?> </td>
            </tr>
            <tr>
                <td><b>linea del producto:</b> <?php echo $datos->LINEAproducto ?> </td>
            </tr>
        </table>   
    <?php endforeach ?>
    




</body>
</html>