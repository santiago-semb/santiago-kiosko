<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Kiosko</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
    <style>
        body {
            font-family: Verdana;
            font-size: 12px;
            color: #444;
        }


        #container {
            width: 700px;
            margin: auto;
            background-color: #eee;
            overflow: hidden;
            /* Set overflow: hidden to clear the floats on #main and #sidebar */
            padding: 15px;
        }

        #main {
            width: 490px;
            float: left;
        }

        #sidebar {
            width: 200px;
            float: left;
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
            <li><a href="ventas.html" class="a-menu-li"><button class="button-li">Ventas</button></a></li>
        </ul>
    </nav>

    <h1 class="h1-inicio">Compras</h1>

    <?php
            require("../backend/conexion/conexion.php");
            $base = Conectar::conexion();

            $sql = "SELECT * FROM compras";
            $resultado = $base->prepare($sql);
            $resultado->execute();
    ?>

    <div id="container">

        <div id="main">

        <h1>LISTA PRODUCTOS</h1>
    
        <table>
                <tr>
                    <th>FECHA | HORA</th>
                    <th>DESCRIPCION</th>
                    <th>IMPUESTOS</th>
                    <th>TOTAL</th>
                </tr>
                
                    <?php while($row = $resultado->fetch(PDO::FETCH_OBJ)) : ?>
                <tr>
                        <td><?php echo $row->FECHA ?></td>
                        <td><?php echo $row->NOMBRE ?></td>
                        <td>$ 0</td>
                        <td>$ <?php echo $row->TOTAL ?></td>
                        
                        <td id="td-button"><a href="eliminar_compra.php?ID=<?php echo $row->ID ?>"><button name="bot-delete">Eliminar</button></a></td>
                </tr>
                    <?php endwhile; ?> 
                                       

        </table>
         
        </div>

        <div id="sidebar">

        </div>

    </div>
    <!--end container-->



</body>

</html>