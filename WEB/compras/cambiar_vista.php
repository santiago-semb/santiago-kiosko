<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Kiosko</title>
    <link rel="stylesheet" href="../../WEB/assets/styles/styles.css">
    
    <style>
        table {
            font-family: Verdana;
            font-size: 12px;
            color: #444;
        }

        #h1-lista-productos {
            font-family: Verdana;
            font-size: 20px;
            color: #444;
        }

        #container {
            width: 700px;
            margin: auto;
            background-color: #eee;
            overflow: hidden;
            min-height: 500px;
            /* Set overflow: hidden to clear the floats on #main and #sidebar */
            padding: 15px;
            margin-bottom: 35px;
        }

        #main {
            width: 490px;
            float: left;
        }

        #sidebar {
            width: 200px;
            float: left;
            min-height: 500px;
        }

        .h1-inicio {
            padding: 20px;
            text-align: center;
            font-size: 25px;

        }

        td{
            padding: 7px;
        }

        #td-button {
            border: none;
        }

        .a-eliminar-todo {
            float: right;
        }

        .a-cambiar-vista {
            float: right;
            margin-right: 5px;
        }

        .img-producto {
            border: 5px solid white; 
        }


        footer {
            position: relative;
            bottom: 0;
            background-color: rgb(56, 26, 126);
            width: 100%;
            text-align: center;
            color: whitesmoke;
        }


    </style>
</head>

<body>

<?php 
            require("../../backend/conexion/conexion.php");
            $base = Conectar::conexion();
        
            if(isset($_POST["boton-barras"])) {
                $barcode = $_POST["barcode"];
                $nombre_tabla = "producto_individual_cocacola";

                $sql = "SELECT * FROM $nombre_tabla WHERE CODIGOBARRA=$barcode";
                $resultado = $base->prepare($sql);
                $resultado->execute();
                $sentencia = $resultado->fetch(PDO::FETCH_OBJ);
                $imagenProducto = $sentencia->IMAGEN;
                $nombreProducto = $sentencia->NOMBRE;
                $litrosProducto = $sentencia->LITROS;
                $precioProducto = $sentencia->PRECIOventa;
                $producto = $nombreProducto . " " . $litrosProducto;   
                $imagen = "<img src='productos/image-individual/$imagenProducto'>";


                $sqlInsertarComprasBarras = "INSERT INTO COMPRAS (NOMBRE, TOTAL, IMAGEN) VALUES ('" . $nombreProducto . "','" . $precioProducto . "','" . $imagenProducto . "')";
                $resulset = $base->prepare($sqlInsertarComprasBarras);
                $resulset->execute();
            }
        
        ?>

    <header class="header">
        <h1>KIOSKITO</h1>
    </header>

    <nav class="menu">
        <ul>
            <li><a href="../../WEB/inicio.html" class="a-menu-li"><button class="button-li">Inicio</button></a></li>
            <li><a href="../../WEB/productos.php" class="a-menu-li"><button class="button-li">Productos</button></a></li>
            <li><a href="../../WEB/compras.php" class="a-menu-li"><button class="button-li">Compras</button></a></li>
            <li><a href="../../WEB/ventas.php" class="a-menu-li"><button class="button-li">Ventas</button></a></li>
        </ul>
    </nav>

    <h1 class="h1-inicio">Compras</h1>

    <?php

            $sql = "SELECT * FROM compras";
            $resultado = $base->prepare($sql);
            $resultado->execute();
            $row = $resultado->fetch(PDO::FETCH_ASSOC);
            $name = $row["NOMBRE"];
            $fecha = $row["FECHA"];
            $total = $row["TOTAL"];
                       
    ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <div>
            <label>barra</label>
            <input type="text" name="barcode" onmouseover="this.focus();">
            </div>
            <div>
            <input type="submit" name="boton-barras">
            </div>
        </form>

    <div id="container">

        <div id="main">

        <h1 id="h1-lista-productos">LISTA PRODUCTOS</h1>

        <table style="width: 100%;">
   
                    <?php 
                        $sql = "SELECT * FROM compras";
                        $resultad = $base->prepare($sql);
                        $resultad->execute();
                    ?>         
                    <?php while($row = $resultad->fetch(PDO::FETCH_OBJ)) : ?>
                <tr>

                        <td>$ <?php $total = $row->TOTAL; echo $total ?></td>
                        <td><img class="img-producto" src="../productos/image-individual/<?php $img = $row->IMAGEN; echo $img; ?>"></td>
                                   
                        <td id="td-button"><a href="../../WEB/compras/eliminar_compra.php?ID=<?php echo $row->ID ?>&url=<?php echo 'cambiar_vista'?>"><button name="bot-delete">Eliminar</button></a></td>
                
                </tr>
                    <?php endwhile; ?>      
                <tr>
                    <td></td>
                    <td></td>
                    <?php 
                                $query = "SELECT SUM(TOTAL) as preciototal FROM COMPRAS";
                                $resultado = $base->prepare($query);
                                $resultado->execute();
                                $totales = $resultado->fetch(PDO::FETCH_OBJ);
                                $totaltotal = $totales->preciototal;
                                echo "<td style='border: 2px solid black; background-color:black;color:white; width: 15px;'>TOTAL <b>$ " . $totaltotal . "</b></td>";
                    ?>

                <?php 
                                /*$query = "SELECT NOMBRE as nombres FROM COMPRAS";
                                $resultado = $base->prepare($query);
                                $resultado->execute();
                                while($consulta = $resultado->fetch(PDO::FETCH_OBJ)){
                                $arrayNombres = $consulta->nombres;                            
                                echo "<p>" . $arrayNombres . "</p>";
                                }*/
                ?>
                
                    <?php 
                        $sql = "SELECT NOMBRE, TOTAL FROM compras";
                        $r = $base->prepare($sql);
                        $r->execute();
                    ?>

                    <td id="td-button"><a href="../../backend/calculadora.php?precio=<?php echo $totaltotal ?> & nom=<?php echo $name ?> & fecha=<?php echo $fecha ?>
                    & anom=<?php while($nombres = $r->fetch(PDO::FETCH_OBJ)){
                        echo "<p>" . $nombres->NOMBRE . "</p>";
                    } ?>"><button name="bot-delete">calculadora</button></a></td>
                </tr>  
                        
        </table>
         
        </div>

        <div id="sidebar">
        <!-- boton eliminar todo -->
            <a href="../../WEB/compras/eliminar_todas_las_compras.php?url=<?php echo 'cambiar_vista'?>" class="a-eliminar-todo"><button>Eliminar todo</button></a>
            <a href="../../WEB/compras.php" class="a-cambiar-vista"><button>Cambiar vista</button></a>
        </div>

    </div>
    <!--end container-->

    <footer>Las compras estan configuradas para enviar datos a la BBDD</footer>

</body>

</html>