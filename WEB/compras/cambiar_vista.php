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

        .form-barcode, .form-busqueda-barras {
            text-align: center;
            padding: 10px;
        }

        #barcode-div, .div-busqueda-barras {
            padding: 2px;
            width: 50%;
            margin: 0px auto;
        }

        .input-barcode, .input-busqueda-barras {
            width: 200px;
            height: 20px;
        }

        .button-barcode, .button-busqueda-barras {
            height: 25px;
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
            <li><a href="../../WEB/compras.php" class="a-menu-li"><button class="button-li">Compras</button></a></li>
            <li><a href="../../WEB/ventas.php" class="a-menu-li"><button class="button-li">Ventas</button></a></li>
        </ul>
    </nav>

    <h1 class="h1-inicio">Compras</h1>

    <?php 
    
    require("../../backend/conexion/conexion.php");
    $base = Conectar::conexion();

            
    ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form-barcode">
            <div id="barcode-div">
            <label><b>BARRA</b></label>
            <input type="text" name="barcode" class="input-barcode" id="input-barcode-id" required autocomplete="off">
            <input type="submit" name="boton-barras" class="button-barcode" value="Search">
            </div>
        </form>

        <form method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form-busqueda-barras">
        <div class="div-busqueda-barras">
            <label><b>BUSCAR</b></label>
            <input type="text" placeholder=" Buscar producto..." class="input-busqueda-barras" name="search" autocomplete="off">
            <button class="button-busqueda-barras" type="submit" name="busqueda">Search</button>
        </div>
        </form>

        <script>
            let inputBarra = document.getElementById("input-barcode-id");
            inputBarra.focus();
        </script>

    <div id="container">

        <div id="main">

        <h1 id="h1-lista-productos">LISTA PRODUCTOS</h1>

        <table style="width: 100%;">

        <?php 
            
            if(isset($_POST["boton-barras"])) {
                $barcode = $_POST["barcode"];
                $nombre_tabla = "barcode_products";

                $sql = "SELECT * FROM $nombre_tabla WHERE CODIGOBARRA=$barcode";
                $resultado = $base->prepare($sql);
                $resultado->execute();
                $sentencia = $resultado->fetch(PDO::FETCH_OBJ);
                if(isset($sentencia->NOMBRE) && isset($sentencia->IMAGEN) && isset($sentencia->TOTAL)) { 
                    $imagenProducto = $sentencia->IMAGEN;
                    $nombreProducto = $sentencia->NOMBRE;
                    $litrosProducto = $sentencia->LITROS;
                    $precioProducto = $sentencia->PRECIOventa;
                    $producto = $nombreProducto . " " . $litrosProducto;   
                    $imagen = "<img src='productos/image-individual/$imagenProducto'>";
                }
                

                if($sentencia) {
                    $imagenProducto = $sentencia->IMAGEN;
                    $nombreProducto = $sentencia->NOMBRE;
    
                    if($sentencia->LITROS > 3){
                        $litrosProducto = $sentencia->LITROS . "ML";
                    }elseif($sentencia->LITROS <= 3 && $sentencia->LITROS > 1){
                        $litrosProducto = $sentencia->LITROS . "L";
                    }else{
                        $litrosProducto = "";
                    }
    
                    $rubroProducto =  $sentencia->RUBRO;
                    $precioProducto = $sentencia->PRECIOventa;
                    $producto = $nombreProducto . " " . $litrosProducto;   
                    $imagen = "<img src='productos/image-individual/$imagenProducto'>";

    
                    if($sentencia) {
                    $sqlInsertarComprasBarras = "INSERT INTO COMPRAS (NOMBRE, TOTAL, RUBRO, IMAGEN) VALUES ('" . $producto . "','" . $precioProducto . "','" . $rubroProducto . "','" . $imagenProducto . "')";
                    $resulset = $base->prepare($sqlInsertarComprasBarras);
                    $resulset->execute();
                    }else{
                        echo "<h3 style='color: red;'>NO SE ENCONTRO EL PRODUCTO</h3>";
                    }

                
            }

     }


                
            
        ?>
   
                    <?php 
                        $sql = "SELECT * FROM compras";
                        $resultad = $base->prepare($sql);
                        $resultad->execute();
                    ?>         
                    <?php while($row = $resultad->fetch(PDO::FETCH_OBJ)) : ?>
                <tr>
                    <?php
                        $name2 = $row->NOMBRE;
                        $rubro = $row->RUBRO;   
                    ?>
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
                        $sql = "SELECT * FROM compras";
                        $r = $base->prepare($sql);
                        $r->execute();
                        $row = $r->fetch(PDO::FETCH_ASSOC);

                        if(isset($row["NOMBRE"]) && isset($row["FECHA"]) && isset($row["TOTAL"]) && isset($row["RUBRO"])){ 
                            $fecha = $row["FECHA"];
                            $total = $row["TOTAL"];
                        }
                    ?>

                <td id="td-button"><a href="../backend/calculadora.php?precio=<?php echo $totaltotal ?> & nom=<?php if(isset($name)){echo $name;} ?>
                    & rubro=<?php if(isset($rubro)){echo $rubro;} ?>"><button name="bot-delete">calculadora</button></a></td>
                </tr>  
                   
        <?php  
                if(isset($_GET["busqueda"])){
                $search = $_GET["search"];

                $sql = "SELECT * FROM barcode_products WHERE NOMBRE LIKE '%$search%'";
                $result = $base->prepare($sql);
                $result->execute();


            while($registro=$result->fetch(PDO::FETCH_OBJ)){

                if($registro->IMAGEN != ""){

                    
                    echo "<div class='cuadro-individual-productos'>"; 
            
                    echo "<a href='../../WEB/compras/insertar_compra.php?ID=$registro->ID & nproducto=$registro->NOMBRE & total=$registro->PRECIOventa & img=$registro->IMAGEN & nom=cambiar_vista' class='cuadro-producto'><img id='imagen-productos' src='../../WEB/productos/image-individual/" . $registro->IMAGEN . "'/></a>";
            
                    echo "</div>";


                        
                    }
                    
               
                }
            }
        ?>

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