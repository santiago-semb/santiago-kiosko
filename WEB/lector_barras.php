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
        .delete-button {
            border: 3px solid red;
            background-color: red;
            color: white;
        }

        form {
            padding: 3px;
        }
    </style>

</head>

<body>
        <?php 
            require("../backend/conexion/conexion.php");
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
                $producto = $nombreProducto . " " . $litrosProducto;
                echo $producto;
                echo "<img src='productos/image-individual/$imagenProducto'>";
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

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <div>
            <label>barra</label>
            <input type="text" name="barcode" onmouseover="this.focus();">
            </div>
            <div>
            <input type="submit" name="boton-barras">
            </div>
        </form>

</body>
</html>
