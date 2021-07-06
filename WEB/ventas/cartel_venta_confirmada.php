<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Kiosko</title>
    <link rel="stylesheet" href="../../WEB/assets/styles/styles.css">
    <style>
        #h1-su-venta {
            text-align: center;
            font-size: 25px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            text-transform: uppercase;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .tabla-venta-confirmada {
            border: 2px solid black;
            width: 70%;
            margin: auto;
            min-height: 500px;
            max-width: 70%;
        }

        tr {
            
        }

        td, th {
            text-align: center;
        }

        .numero-compra-y-fecha {
            border-bottom: 1px solid black;
            height: 40px;
        }

        .tr-producto {
            border: 1px solid green;
        }

        .tr-total {
            border: 1px solid violet;
            height: 25px;
        }

        #td-producto {
            border-bottom: 1px solid gray;
        }

        .boton-finish {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>KIOSKITO</h1>
    </header>

    <h1 id="h1-su-venta">Su venta</h1>

    <?php 

        require("../../backend/conexion/conexion.php");
        $base = Conectar::conexion();

        $precio = $_GET["precio"];
        $nombre = $_GET["nom"];

    ?>
    <?php 
        $query = "SELECT * FROM ventas ORDER BY ID DESC LIMIT 1";
        $result = $base->prepare($query);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_OBJ);
    ?>
    
    <?php 
        $sql = "SELECT NOMBRE, TOTAL FROM compras";
        $r = $base->prepare($sql);
        $r->execute();
    ?>

        <table class="tabla-venta-confirmada">
            <tr>
                <th class="numero-compra-y-fecha">Numero de compra</th>
                <th class="numero-compra-y-fecha">FECHA</th>         
            </tr>
            <tr>
                <td class="numero-compra-y-fecha"><b><?php echo $row->ID ?></b></td>
                <td class="numero-compra-y-fecha"><mark><?php echo $row->FECHA ?></mark></td>
            </tr>

            <tr>
                <th class="tr-producto">PRODUCTOS</th>
                <th class="tr-producto">PRECIO</th>    
         
                <?php while($fila = $r->fetch(PDO::FETCH_OBJ)) : ?>
                </tr>
                <td id="td-producto"><?php echo $fila->NOMBRE ?></td>
                <td id="td-producto">$ <?php echo $fila->TOTAL; ?></td>
                <?php endwhile; ?>
                
           
            
            <tr>
                <th class="tr-total">TOTAL</th>
                <td class="tr-total">$<?php 
                                $query = "SELECT SUM(TOTAL) as preciototal FROM COMPRAS";
                                $resultado = $base->prepare($query);
                                $resultado->execute();
                                $totales = $resultado->fetch(PDO::FETCH_OBJ);
                                $totaltotal = $totales->preciototal;
                                echo $totaltotal;
                    ?></td>
            </tr>
        </table>

<div class="boton-finish">
<a href="../compras/eliminar_todas_las_compras.php"><button>Terminar compra</button></a>
</div>

</body>
</html>