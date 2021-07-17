<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Kiosko</title>
    <link rel="stylesheet" href="../WEB/assets/styles/styles.css">
    <style>
        .h1-inicio {
            text-align:center;
            text-transform: uppercase;
            background-color: rgb(56, 26, 126);
            color: white;
            margin-bottom: 50px;
        }

        form {
            margin: auto;
            background-color: white;
            color: black;
            width: 20%;
            height: 250px;
            line-height: 50px;
            border: 2px solid gray;
            border-radius: 0.5em;
        }

        .boton-calculadora {
            text-align:center;
            padding: 5px;
        }

        .vuelto {
            background-color: gray;
            color: white;
            border:3px solid gray;
        }

        .vuelto:hover {
            border: 3px solid gray;
        }

        #div-button-confirmar-compra {
            margin-top: 25px;
            text-align: center;
        }

        #boton-confirmar-compra {
            width: 18%;
            font-size: 16px;
            background-color: white;
            color: black;
            border: 2px solid white;
            border-radius: 0.2em;
            text-transform: uppercase;
            transition: 100ms all;
        }

        #boton-confirmar-compra:hover {
            background-color: green;
            color: white;
            border: 2px solid green;
        }

        #boton-eliminar-compra {
            font-size: 16px;
            width: 18%;
            background-color: white;
            color: black;
            border: 2px solid white;
            border-radius: 0.2em;
            text-transform: uppercase;
            transition: 100ms all;
        }

        #boton-eliminar-compra:hover {
            background-color: red;
            color: white;
            border: 2px solid red;
        }

    </style>
</head>
<body>
    <header class="header">
        <h1>KIOSKITO</h1>
    </header>

    <nav class="menu">
        <ul>
            <li><a href="../WEB/inicio.html" class="a-menu-li"><button class="button-li">Inicio</button></a></li>
            <li><a href="../WEB/productos.php" class="a-menu-li"><button class="button-li">Productos</button></a></li>
            <li><a href="../WEB/compras.php" class="a-menu-li"><button class="button-li">Compras</button></a></li>
            <li><a href="../WEB/ventas.php" class="a-menu-li"><button class="button-li">Ventas</button></a></li>
        </ul>
    </nav>

    <h1 class="h1-inicio">calculadora</h1>


<?php

if(isset($_POST["boton-enviar"])) {

    $pagaCon=$_POST["pagacon"]; 
    $precioVenta = $_POST["total"];
    $vuelto = $pagaCon - $precioVenta;

    $nombre= $_GET["nom"];
    $fecha=$_GET["fecha"];
    
}else{
    $nombre= $_GET["nom"];
    $fecha=$_GET["fecha"];

    $precioVenta = $_GET["precio"];
    $vuelto=0;
    
}

if($vuelto<=-1){
    $vuelto = "Error.";
}
if($pagaCon<$precioVenta){
    $vuelto = "Error.";
}


$nombresproductos = $_GET["anom"];

?>


    <form action="<?php echo $_SERVER['PHP_SELF'] . '?nom=' . $_GET["nom"] . '&fecha=' . $_GET["fecha"] . '&anom=' . $_GET["anom"];?>" method="post" name="form1" class="formulario-inicio">
    <div>
        <label for="total">Total:</label>
        <input type="text" name="total" value="<?php echo $precioVenta ?>" readonly="readonly" class="total">
    </div>
    <div>
        <label for="pagacon">Paga con:</label>
        <input type="number" name="pagacon">
    </div>
    <div>
        <label>Efectivo <input type="radio" name="metodopago"></label>
        <label>Tarjeta <input type="radio" name="metodopago"></label>
    </div>
    <div>
        <label for="vuelto">Vuelto:</label>
        <input type="text" name="vuelto" value="<?php echo $vuelto ?>" readonly="readonly" class="vuelto">
    </div>
    <div class="boton-calculadora">
        <a href=""><button name="boton-enviar">Vender</button></a>
    </div>
    </form>

    <div id="div-button-confirmar-compra">
        <a href="../WEB/ventas/insertar_ventas.php?precio=<?php echo $precioVenta ?> & nom=<?php  echo $nombresproductos ?>"><button id="boton-confirmar-compra" name="boton-compra">confirmar compra</button></a>
    </div>

    <div id="div-button-confirmar-compra">
        <a href="../WEB/compras/eliminar_todas_las_compras.php"><button id="boton-eliminar-compra">eliminar compra</button></a>
    </div>
</body>
</html>