<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schweppes | Kiosko</title>
    <link rel="stylesheet" href="../../WEB/assets/styles/styles.css">

    <style>
        a {
            list-style: none;
            text-decoration: none;
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

    <div id="h1-productos">
        <a href="../../backend/insertar-producto-individual/formulario-producto-individual.php?nom=schweppes" style="list-style: none;"><button>Añadir producto</button></a>
    </div>

    <div class="productos-all">


    <?php 
    
    require("../../backend/conexion/conexion.php");
    $base = Conectar::conexion();

    //ordenando todos los blogs (el mas reciente primero)
    $query = "SELECT * FROM producto_individual_schweppes ORDER BY ID DESC";
    $resultado = $base->prepare($query);
    $resultado->execute();
    $sentencia = $resultado->fetchAll(PDO::FETCH_OBJ)

    ?>


    <?php
        foreach($sentencia as $datos) : ?>

  
        <div style='display: inline-block; height: 300px;'>
            <!-- imagen con el producto individual -->
            <a class='cuadro-producto'><img id='imagen-productos' src='image-individual/<?php echo $datos->IMAGEN ?>'></a>
            <!-- botones de editar, eliminar, ver -->
            <div class='div-boton-producto-ind'>
            
            <!-- boton ver -->
            <a href='../../backend/ver-producto-individual/ver-producto-individual.php?ID=<?php echo $datos->ID ?> & nom=<?php echo $datos->NOMBRE ?>'>   
            <input type='button' value='vista'>
            </a>
            <!-- boton editar -->
            <a href='../../backend/editar-producto-individual/editar-producto-individual.php?ID=<?php echo $datos->ID ?> & nom=<?php echo $datos->NOMBRE?> & pcompra=<?php echo $datos->PRECIOcompra?> & pventa=<?php echo $datos->PRECIOventa?> & img=<?php echo $datos->IMAGEN?> & prov=<?php echo $datos->PROOVEDOR?> & litros=<?php echo $datos->LITROS?> & lineap=<?php echo $datos->LINEAproducto?>"'>   
            <input type='button' value='editar'>
            </a>
            <!-- boton eliminar -->
            <a href='../../backend/eliminar-producto-individual/eliminar_producto_individual.php?ID=<?php echo $datos->ID ?> & prov=<?php echo $datos->PROOVEDOR ?> & nom=<?php echo $datos->NOMBRE ?>'>      
            <input type='button' value='eliminar'>
            </a>
        
            </div>

        </div>



    <?php  endforeach;  ?>


    </div>

</body>
</html>