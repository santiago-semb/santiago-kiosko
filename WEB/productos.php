<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos | Kiosko</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="temas.js"></script>

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

<body onload="cambiarAmodoEstablecido()">

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

    <div class="div-3">
        <div class="div-into-div-3">

            <form method="get" action="busqueda_productos.php">
                <input type="text" placeholder=" Buscar producto..." class="input-buscador" name="buscar">
                <button class="search-button" type="submit" name="busqueda"><i class="fas fa-search"></i></button>
            </form>

            <form method="post" action="../backend/eliminar-producto(general)/eliminar-producto-general.php">
                <input type="text" placeholder=" Eliminar producto..." class="input-buscador" name="nombre_producto">
                <button class="delete-button" type="submit"><i class="fas fa-trash-alt" style="font-size:17px;"></i></button>
            </form>
            <b>NOTA: para eliminar un producto hay que poner el nombre tal cual esta escrito en el campo "NOMBRE" en la BBDD.</b>
        </div>
    </div>

    

    <div class="productos-all">


        <?php
        require("../backend/conexion/conexion.php");
        $base = Conectar::conexion();

        //ordenando todos los blogs (el mas reciente primero)
        $query = "SELECT * FROM productoslogo ORDER BY FECHA";
        $resultado = $base->prepare($query);
        $resultado->execute();


        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {

            if ($registro['IMAGEN'] != "") {

                echo "<div class='cuadro-individual-productos'>";

                echo "<a href='../WEB/productos/" . $registro['NOMBRE'] . ".php' class='cuadro-producto'><img id='imagen-productos' src='../WEB/assets/logos/" . $registro['IMAGEN'] . "'/></a>";

                echo "</div>";
            }
        }

        ?>

    </div>





</body>

</html>