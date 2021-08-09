<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coca Cola | Kiosko</title>
    <link rel="stylesheet" href="../../WEB/assets/styles/styles.css">

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

        img {
            border: 5px solid white;  
        }

        strong {
            margin-left: 5px;
            color: black;
        }

        b {
            text-transform: uppercase;
        }

        img {
            font-size: 45px;
        }



    </style>

</head>
<body>
    <header class="header">
        <h1>KIOSKITO</h1>
    </header>

    <nav class="menu">
        <ul>
            <li><a href="../../WEB/inicio.html" class="a-menu-li"><button class="button-li">Inicio</button></a></li>
            <li><a href="../../WEB/productos.php" class="a-menu-li"><button class="button-li">Productos</button></a></li>
            <li><a href="../../WEB/compras.html" class="a-menu-li"><button class="button-li">Compras</button></a></li>
            <li><a href="../../WEB/ventas.html" class="a-menu-li"><button class="button-li">Ventas</button></a></li>
        </ul>
    </nav>


    <?php 

        require("../../backend/conexion/conexion.php");
        $base = Conectar::conexion();

        $id = $_GET["ID"];
        $nombre = $_GET["nom"];

        $tabla= 'producto_individual_' . $nombre;

        $query = "SELECT * FROM $tabla WHERE ID=$id";
        $resultado = $base->prepare($query);
        $resultado->execute();
        $sentencia = $resultado->fetchAll(PDO::FETCH_OBJ);

    ?>

    <?php
        foreach($sentencia as $datos) : ?>

        <table>
            <tr>
                <td><img src='../../WEB/productos/image-individual/<?php echo $datos->IMAGEN ?>'></td>
                <td><?php 
                if($datos->NOMBRE . ".png" && $datos->NOMBRE . ".jpg"){
    
                    $sql = "SELECT * FROM productoslogo WHERE NOMBRE='$nombre'";
                    $resulset = $base->prepare($sql);
                    $resulset->execute();
                    $sentencias = $resulset->fetch(PDO::FETCH_OBJ);
                        
                        echo "<img src='../../WEB/assets/logos/$sentencias->IMAGEN'>";
                    
                
            } ?></td>
            </tr>
            <tr>
                <td><b>nombre:</b><strong name="nombre"><?php echo $datos->NOMBRE ?><strong></td>
            </tr>
            <tr>
                <td><b>precio compra:</b><strong>$ <?php echo $datos->PRECIOcompra ?></strong></td>
            </tr>
            <tr>
                <td><b>precio venta:</b><strong name="total">$ <?php echo $datos->PRECIOventa ?></strong></td>
            </tr>
            <tr>
                <td><b>proovedor:</b><strong><?php echo $datos->PROOVEDOR ?></strong></td>
            </tr>
            <tr>
                <td><b>litros:</b><strong><?php echo $datos->LITROS ?>
                 <?php if($datos->LITROS<=3){
                     echo "L";
                }else{
                    echo "ML";
                } ?></strong></td>
            </tr>
            <tr>
                <td><b>linea del producto:</b><strong><?php echo $datos->LINEAproducto ?></strong></td>
            </tr>

            <tr>
                <td><a href="../../backend/calculadora.php?nom=cocacola & precio=<?php echo $datos->PRECIOventa ?>" style="list-style: none;"><button>Calculadora</button></a></td>
            </tr>

            
        </table>   

    <?php endforeach ?>
    




</body>
</html>