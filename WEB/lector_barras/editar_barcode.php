<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos | Kiosko</title>
    <link rel="stylesheet" href="../assets/styles/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style>

        .form-busqueda-barras {
            text-align: center;
            margin-top: 10px;
        }

        .form-barras {
            text-align: center;
            border:1px solid black;
            width: 50%;
            margin: 0px auto;
            margin-top: 25px;
            background-color: gray;
            height: 400px;
        }

        #div-mayor-barras {
            padding: 5px;
        }

        #div-form-barras {
            padding: 5px;
            width: 50%;
            margin: 0px auto;
            background-color: white;
        }

        #div-form-barras label {
            text-transform: uppercase;
            text-align: center;
            color: red;
        }

        #div-barcode-search{
            text-align: center;
        }

        #div-barcode-search h1 {
            text-align: center;
            text-transform: uppercase;
            font-size: 15px;
            margin-top: 15px;
        }

    </style>

</head>

<body>
        <?php 
            require("../../backend/conexion/conexion.php");
            $base = Conectar::conexion();
        
            if(isset($_POST["boton-barras"])) {
                
                $nombre = $_POST["productName"];
                $precioCompra = $_POST["productPrice"];
                $precioVenta = $_POST["productSellPrice"];
                $proovedor = $_POST["supplier"];
                $litros = $_POST["liters"];                   
                $lineaProducto = $_POST["lineProduct"];
                $codigoBarra = $_POST["barcode"];

                $query2 = "UPDATE barcode_products SET NOMBRE=:nombre, PRECIOcompra=:pcompra, PRECIOventa=:pventa,
                PROOVEDOR=:proov, LITROS=:l, LINEAproducto=:lproducto, CODIGOBARRA=:bcode";
                $res2 = $base->prepare($query2);
                $res2->bindParam(":nombre", $nombre);
                $res2->bindParam(":pcompra", $precioCompra);
                $res2->bindParam(":pventa", $precioVenta);
                $res2->bindParam(":proov", $proovedor);
                $res2->bindParam(":l", $litros);
                $res2->bindParam(":lproducto", $lineaProducto);
                $res2->bindParam(":bcode", $codigoBarra);
                $res2->execute();

            }
           
        
        ?>

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


        <h3>Cuando sepa poner codigo de barra, lo voy a poner</h3>
        <h6>Atte. santiago del pasado</h6>


        <h3 style="text-align: center; color:white;">EDITAR CODIGO BARRA</h3>

        <form method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form-busqueda-barras">
            <input type="text" placeholder=" Buscar producto..." class="input-buscador" name="search">
            <button class="search-button" type="submit" name="busqueda"><i class="fas fa-search"></i></button>
        </form>


        <div id="div-barcode-search">
            <h1>Su busqueda:</h1>
    <?php
        if(isset($_GET["busqueda"])){
                $busqueda = $_GET["search"];

                $sql = "SELECT * FROM barcode_products WHERE NOMBRE LIKE '%$busqueda%'";
                $result = $base->prepare($sql);
                $result->execute();


            while($registro=$result->fetch(PDO::FETCH_OBJ)){

                if($registro->IMAGEN != ""){

                    echo "<div class='cuadro-individual-productos'>"; 
            
                    echo "<a href='editar_barcode.php?id=$registro->ID' class='cuadro-producto'><img id='imagen-productos' src='../../WEB/productos/image-individual/" . $registro->IMAGEN . "'/></a>";
            
                    echo "</div>";
                        
                    }
                    
               
                }
            }
            if(isset($_GET["id"])) {
                $idBusqueda = $_GET["id"];
            }else{
                $idBusqueda = 0;
            }
            if(isset($_GET["id"]) != 0) :
                $query = "SELECT * FROM barcode_products WHERE ID=$idBusqueda";
                $res = $base->prepare($query);
                $res->execute();
                $sentencia = $res->fetch(PDO::FETCH_ASSOC);

                
            
        ?>
        </div>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form-barras">
        <div id="div-mayor-barras">
            <div id="div-form-barras">
            <label>barra</label>
            <input type="text" name="barcode" value="<?php echo $sentencia["CODIGOBARRA"] ?>">
            </div>

            <div id="div-form-barras">
            <label>nombre</label>
            <input type="text" name="productName" value="<?php echo $sentencia["NOMBRE"] ?>">
            </div>

            <div id="div-form-barras">
            <label>precio compra</label>
            <input type="text" name="productPrice" value="<?php echo $sentencia["PRECIOcompra"] ?>">
            </div>

            <div id="div-form-barras">
            <label>precio venta</label>
            <input type="text" name="productSellPrice" value="<?php echo $sentencia["PRECIOventa"] ?>">
            </div>

            <div id="div-form-barras">
            <label>imagen</label>
            <p><?php echo $sentencia["IMAGEN"] ?></p>
            </div>

            <div id="div-form-barras">
            <label>proovedor</label>
            <input type="text" name="supplier" value="<?php echo $sentencia["PROOVEDOR"] ?>">
            </div>

            <div id="div-form-barras">
            <label>litros</label>
            <input type="text" name="liters" value="<?php echo $sentencia["LITROS"] ?>">
            </div>

            <div id="div-form-barras">
            <label>linea producto</label>
            <input type="text" name="lineProduct" value="<?php echo $sentencia["LINEAproducto"] ?>">
            </div>

            <div id="div-form-barras">
            <input type="submit" name="boton-barras" value="Editar">
            </div>
        </div>
        </form>
                <?php endif; ?>
</body>
</html>
