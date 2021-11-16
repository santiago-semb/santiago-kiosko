<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos | Kiosko</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style>

        .form-barras {
            text-align: center;
            border:1px solid black;
            width: 50%;
            margin: 0px auto;
            margin-top: 25px;
            background-color: gray;
            height: 425px;
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
            color: green;
            border-bottom: 2px solid black;
        }
        
        #select-option {
            width: 150px;
        }
    </style>

</head>

<body>
        <?php 
            require("../backend/conexion/conexion.php");
            $base = Conectar::conexion();
        
            if(isset($_POST["boton-barras"])) {
                
                $nombre = $_POST["productName"];
                $precioCompra = $_POST["productPrice"];
                $precioVenta = $_POST["productSellPrice"];
                $imagen = $_POST["image"];
                $proovedor = $_POST["supplier"];
                $litros = $_POST["liters"];      
                $rubro = $_POST ["rubro"];            
                $lineaProducto = $_POST["lineProduct"];
                $codigoBarra = $_POST["barcode"];

                $sql = "INSERT INTO barcode_products (NOMBRE, PRECIOcompra, PRECIOventa, IMAGEN, PROOVEDOR, LITROS, RUBRO, LINEAproducto, CODIGOBARRA)
                VALUES ('" . $nombre . "','" . $precioCompra . "','" . $precioVenta . "','" . $imagen . "','" . $proovedor . "','" . $litros . "',
                '" . $rubro . "','" . $lineaProducto . "','" . $codigoBarra . "')";
                $resultado = $base->prepare($sql);
                $resultado->execute();
                
            }
        
        ?>

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


        <h3>Cuando sepa poner codigo de barra, lo voy a poner</h3>
        <h6>Atte. santiago del pasado</h6>

        <a href="../WEB/lector_barras/editar_barcode.php"><button>Editar</button></a>

        <h3 style="text-align: center; color:white;">PRUEBA CODIGO BARRA (llenar formulario)</h3>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form-barras">
        <div id="div-mayor-barras">
            <div id="div-form-barras">
            <label>barra</label>
            <input type="text" name="barcode">
            </div>

            <div id="div-form-barras">
            <label>nombre</label>
            <input type="text" name="productName">
            </div>

            <div id="div-form-barras">
            <label>precio compra</label>
            <input type="text" name="productPrice">
            </div>

            <div id="div-form-barras">
            <label>precio venta</label>
            <input type="text" name="productSellPrice">
            </div>

            <div id="div-form-barras">
            <label>imagen</label>
            <input type="file" name="image">
            </div>

            <div id="div-form-barras">
            <label>proovedor</label>
            <input type="text" name="supplier">
            </div>

            <div id="div-form-barras">
            <label>litros</label>
            <input type="text" name="liters">
            </div>

            <div id="div-form-barras">
            <label>rubro</label>
            <select name="rubro" id="select-option">
                <option disbaled value="">Seleccionar rubro</option>
                <option>cigarillos</option>
                <option>bebidas</option>
                <option>golosinas</option>
                <option>galletas</option>
                <option>varios</option>
                <option>sandiwches</option>
                <!--<option></option>-->
                <!--<option></option>-->
                <!--<option></option>-->
            </select>
            </div>

            <div id="div-form-barras">
            <label>linea producto</label>
            <input type="text" name="lineProduct">
            </div>

            <div id="div-form-barras">
            <input type="submit" name="boton-barras">
            </div>
        </div>
        </form>

</body>
</html>
