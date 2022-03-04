<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulator | Kiosko</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <style>

        table {
            margin: auto;
            width: 50%;
            border: 2px solid white;
            border-radius: 0.5em;
            padding: 10px;
            background-color: gray;
            color: white;
        }
        
        td{
            padding:5px 0px;
            
        }

        .h1-inicio {
            padding: 20px;
            text-align: center;
            font-size: 25px;
            
        }

        h4, h5, h6 {
            text-align: center;
        }

        .form-busqueda-barras {
            margin-top: 15px;
            margin-bottom: 15px;
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
            <li><a href="inicio.html" class="a-menu-li"><button class="button-li">Inicio</button></a></li>
            <li><a href="productos.php" class="a-menu-li"><button class="button-li">Productos</button></a></li>
            <li><a href="compras.php" class="a-menu-li"><button class="button-li">Compras</button></a></li>
            <li><a href="ventas.php" class="a-menu-li"><button class="button-li">Ventas</button></a></li>
        </ul>
    </nav>

    <h1 class="h1-inicio">PRODUCTS SIMULATOR</h1>
    <h4>Buscar producto</h4>

    <form method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form-busqueda-barras">
            <input type="text" placeholder=" Buscar producto..." class="input-buscador" name="search">
            <button class="search-button" type="submit" name="busqueda"><i class="fas fa-search"></i></button>
        </form>


        <div id="div-barcode-search">
<?php
    require("../backend/conexion/conexion.php");
    $base = Conectar::conexion();

        if(isset($_GET["busqueda"])){
                $busqueda = $_GET["search"];

                $sql = "SELECT * FROM barcode_products WHERE NOMBRE LIKE '%$busqueda%'";
                $result = $base->prepare($sql);
                $result->execute();


            while($registro=$result->fetch(PDO::FETCH_OBJ)){

                if($registro->IMAGEN != ""){

                    echo "<div class='cuadro-individual-productos'>"; 
            
                    echo "<a href='simulator/backend_simulador.php?id=$registro->ID' class='cuadro-producto'><img id='imagen-productos' src='../WEB/productos/image-individual/" . $registro->IMAGEN . "'/></a>";
            
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
            endif;
?>


</body>
</html>