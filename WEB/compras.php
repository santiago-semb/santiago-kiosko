<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Kiosko</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="../WEB/compras/botonBarcode.js"></script>
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

        th {
            padding: 5px;
            border: 1px solid black;
        }

        td{
            padding: 7px;
            border: 1px solid gray;
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
        /* prueba estilo */
        .menu, .header{
            background-color: whitesmoke;
        }

        body {
            background-color: #ccc;
        }

        .header h1{
            color: black;
        }

        .button-li{
            background-color: #ccc;
        }

    </style>
</head>

<body>

    <header class="header">
        <h1>KIOSKITO</h1>
    </header>

    <nav class="menu">
        <ul>
            <li><a href="inicio.html" class="a-menu-li"><button class="button-li">Inicio</button></a></li>
            <li><a href="productos.php" class="a-menu-li"><button class="button-li">Productos</button></a></li>
            <li><a href="compras.php" class="a-menu-li"><button class="button-li">Compras</button></a></li>
            <li><a href="ventas.php" class="a-menu-li"><button class="button-li">Ventas</button></a></li>
        </ul>
    </nav>

    <h1 class="h1-inicio">Compras</h1>

    <?php

        require("../backend/conexion/conexion.php");
        $base = Conectar::conexion();

            $sql = "SELECT * FROM compras";
            $resultado = $base->prepare($sql);
            $resultado->execute();
            $row = $resultado->fetch(PDO::FETCH_ASSOC);
            if(isset($row["NOMBRE"]) && isset($row["FECHA"]) && isset($row["TOTAL"])){ 
                $name = $row["NOMBRE"];
                $fecha = $row["FECHA"];
                $total = $row["TOTAL"];
                $rubro = $row["RUBRO"];
            }
    ?>

    

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form-barcode" name="form-barcode-id">
            <div id="barcode-div">
            <label><b>BARRA</b></label>
            <input type="text" name="barcode" class="input-barcode" id="input-barcode-id" required autocomplete="off">
            <input type="submit" name="boton-barras" class="button-barcode" id="button-barcode" value="Search">
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
                if($sentencia) {
                $imagenProducto = $sentencia->IMAGEN;
                $nombreProducto = $sentencia->NOMBRE;
                $rubro = $sentencia->RUBRO;

                if($sentencia->LITROS > 3){
                    $litrosProducto = $sentencia->LITROS . "ML";
                }elseif($sentencia->LITROS <= 3 && $sentencia->LITROS > 1){
                    $litrosProducto = $sentencia->LITROS . "L";
                }else{
                    $litrosProducto = "";
                }

                $precioProducto = $sentencia->PRECIOventa;
                $producto = $nombreProducto . " " . $litrosProducto;   
                $imagen = "<img src='productos/image-individual/$imagenProducto'>";
                }

                if($sentencia) {
                $sqlInsertarComprasBarras = "INSERT INTO COMPRAS (NOMBRE, RUBRO, TOTAL, IMAGEN) VALUES ('" . $producto . "','" . $rubro . "','" . $precioProducto . "','" . $imagenProducto . "')";
                $resulset = $base->prepare($sqlInsertarComprasBarras);
                $resulset->execute();
                }else{
                    echo "<h3 style='color: red;'>NO SE ENCONTRO EL PRODUCTO</h3>";
                }
            }
        
        
        ?>
        
                <tr>
                    <th>FECHA | HORA</th>
                    <th>DESCRIPCION</th>
                    <th>IMPUESTOS</th>
                    <th>TOTAL</th>
                </tr>      
                    <?php 
                        $sql = "SELECT * FROM compras";
                        $resultad = $base->prepare($sql);
                        $resultad->execute();
                    ?>         
                    <?php while($row = $resultad->fetch(PDO::FETCH_OBJ)) : ?>
                <tr>
                    <?php
                     //solo para pasar por url 
                        $rubro = $row->RUBRO;
                     ?>
                        <td><?php $fecha = $row->FECHA; echo $fecha; ?></td>
                        <td><b><?php $name = $row->NOMBRE; echo strtoupper($name); ?></b></td>                       
                        <td>$ 0</td>
                        <td>$ <?php $total = $row->TOTAL; echo $total; ?></td> 
                                   
                        <td id="td-button"><a href="../WEB/compras/eliminar_compra.php?ID=<?php echo $row->ID ?>&url=<?php echo 'compras' ?>"><button name="bot-delete">Eliminar</button></a></td>
                
                </tr>
                    <?php endwhile; ?>  
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <?php 
                                $query = "SELECT SUM(TOTAL) as preciototal FROM COMPRAS";
                                $resultado = $base->prepare($query);
                                $resultado->execute();
                                $totales = $resultado->fetch(PDO::FETCH_OBJ);
                                $totaltotal = $totales->preciototal;
                                echo "<td><b>$ " . $totaltotal . "</b></td>";
                    
                
                    
                        

                        
                    //name
                    $sql = "SELECT * FROM compras";
                    $r = $base->prepare($sql);
                    $r->execute();
                        while($reg = $r->fetchAll(PDO::FETCH_COLUMN,2)) {
                            $nombresArray = $reg;
                        }
                    //precio
                    $sql = "SELECT * FROM compras";
                    $re = $base->prepare($sql);
                    $re->execute();
                        while($reg = $re->fetchAll(PDO::FETCH_COLUMN,3)) {
                            $preciosArray = $reg;
                        }
                    
                    //rubro
                    $sql = "SELECT * FROM compras";
                    $res = $base->prepare($sql);
                    $res->execute();
                        while($reg = $res->fetchAll(PDO::FETCH_COLUMN,4)) {
                            $rubrosArray = $reg;
                        }
                    ?>


            <form method="post" action="prueba_ventas.php">
                    <?php
                        if(isset($nombresArray)) :
                            for($i=1;$i<=count($nombresArray);$i++) : 
                        
                     ?>
                    <?php 
                        $contador = $i;
                        $contadorValueOfInput = $i-1;
                        $nombreHtml = "nombre$contador";
                        $precioHtml = "precio$contador";
                        $rubroHtml = "rubro$contador";
                    ?>
<!-- inputs para pasar el $_post de nombre, precio y rubro -->
<!-- estan dentro de un bucle para repetirse las veces que sea necesaria (registros) -->
                <!-- inputs nombre -->
                <input type="hidden" name="<?php echo $nombreHtml ?>" value="<?php if(isset($nombresArray[$contadorValueOfInput])){echo $nombresArray[$contadorValueOfInput];} ?>">
                <input type="hidden" name="<?php echo $precioHtml ?>" value="<?php if(isset($preciosArray[$contadorValueOfInput])){echo $preciosArray[$contadorValueOfInput];} ?>">
                <input type="hidden" name="<?php echo $rubroHtml ?>" value="<?php if(isset($rubrosArray[$contadorValueOfInput])){echo $rubrosArray[$contadorValueOfInput];} ?>">
                
                    <?php 
                        $contador++; 
                        $contadorValueOfInput++; 
                        endfor;
                        endif;
                    ?>
                <a href="prueba_ventas.php"><button>Insertar compra (avanzado)</button></a>
            </form>



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
                        
                                echo "<a href='../WEB/compras/insertar_compra.php?ID=$registro->ID & nproducto=$registro->NOMBRE & total=$registro->PRECIOventa & img=$registro->IMAGEN & nom=compras & rubro=$registro->RUBRO' class='cuadro-producto'><img id='imagen-productos' src='../WEB/productos/image-individual/" . $registro->IMAGEN . "'/></a>";
                        
                                echo "</div>";


                                    
                                }
                                
                        
                            }
                        }


                
            
        ?>
                        
        </table>
         
        </div>

        <div id="sidebar">
        <!-- boton eliminar todo -->
            <a href="../WEB/compras/eliminar_todas_las_compras.php?url=<?php echo 'compras'?>" class="a-eliminar-todo"><button>Eliminar todo</button></a>
            <a href="../WEB/compras/cambiar_vista.php" class="a-cambiar-vista"><button>Cambiar vista</button></a>
        </div>

    </div>
    <!--end container-->

    

    <footer>Las compras estan configuradas para enviar datos a la BBDD</footer>

</body>

</html>