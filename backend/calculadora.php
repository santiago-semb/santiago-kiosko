<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Kiosko</title>
    <link rel="stylesheet" href="../WEB/assets/styles/styles.css">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    
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
            line-height: 50px;
            border: 2px solid gray;
            border-radius: 0.5em;
        }

        #div-form {
            margin: auto;
            text-align: center;
        }

        #div-form label {
            text-align: center;
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

        .div-boton-10 {
            text-align: center;
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
    $rubro=$_GET["rubro"];
    
}else{
    $nombre= $_GET["nom"];
    //$fecha=$_GET["fecha"];
    $rubro=$_GET["rubro"];

    $precioVenta = $_GET["precio"];
    $vuelto=0;
    
}

if($vuelto<=-1){
    $vuelto = "Error.";
}

if(isset($_POST["porcentaje"])){

        $agregado = $precioVenta * 0.1;
        $resultado = $agregado + $precioVenta;
        $precioVenta = $resultado;

}




$nombresproductos = $_GET["nom"];

?>


    <form action="<?php echo $_SERVER['PHP_SELF'] . '?nom=' . $_GET["nom"] . '&precio=' . $_GET["precio"] . '&rubro=' . $_GET["rubro"];?>" method="post" name="form1" class="formulario-inicio">
    <div id="div-form">
        <label for="total">Total:</label>
        <input type="text" name="total" value="<?php echo $precioVenta ?>" readonly="readonly" class="total">
    </div>
    <div id="div-form">
        <label for="pagacon">Paga con:</label>
        <input type="number" name="pagacon">
    </div>
    <div class="div-boton-10" id="div-form">
        <button name="porcentaje" class="boton-10">Añadir 10%</button>
    </div>
    <div id="div-form">
        <label for="vuelto">Vuelto:</label>
        <input type="text" name="vuelto" value="<?php echo $vuelto ?>" readonly="readonly" class="vuelto">
    </div>
    <div class="boton-calculadora" id="div-form">
        <a href=""><button name="boton-enviar">Vender</button></a>
    </div>
    </form>

    <div id="div-button-confirmar-compra">
        <a href="../WEB/ventas/insertar_ventas.php?precio=<?php echo $precioVenta ?> & nom=<?php  echo $nombresproductos ?> & rubro=<?php echo $rubro ?>"><button id="boton-confirmar-compra" name="boton-compra">confirmar compra</button></a>
    </div>

    <div id="div-button-confirmar-compra">
        <a href="../WEB/compras/eliminar_todas_las_compras.php"><button id="boton-eliminar-compra">eliminar compra</button></a>
    </div>
</body>
</html>