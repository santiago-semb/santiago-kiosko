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
            margin: auto;
            width: 50%;
            border: 2px solid black;
            padding: 3px;
            background-color: blanchedalmond;
        }
        
        td{
            padding:5px 0px;
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
            <li><a href="../../WEB/compras.html" class="a-menu-li"><button class="button-li">Compras</button></a></li>
            <li><a href="../../WEB/ventas.html" class="a-menu-li"><button class="button-li">Ventas</button></a></li>
        </ul>
    </nav>

    <h1 style="text-align: center;">AÑADIR PRODUCTO</h1>


    <?php 
    
    require("../../backend/conexion/conexion.php");
        $base = Conectar::conexion();

        $nombre = $_GET["nom"];

        $tabla= 'producto_individual_' . $nombre;

        $query = "SELECT * FROM $tabla";
        $resultado = $base->prepare($query);
        $resultado->execute();
        $sentencia = $resultado->fetchAll(PDO::FETCH_OBJ);
    
    ?>


    <form action="../../backend/insertar-producto-individual/insertar-producto-individual.php" method="post" enctype="multipart/form-data" name="form1">
    <table>

        <tr>
            <td>Nombre del producto<label for="campo_titulo"></label></td>            
            <td><select name="nombre_producto">
                <option><?php echo $nombre ?></option>
            </select></td>         
        </tr>

        <tr>
            <td>Precio compra<label for="precio_compra"></label></td>
            <td><input type="number" name="precio_compra">
        </tr>

        <tr>
            <td>Precio venta<label for="precio_venta"></label></td>
            <td><input type="number" name="precio_venta">
        </tr>

        
        <tr>
            <td colspan="2" align="center">Seleccione una imagen con tamaño inferior a 2 MB</td>
        </tr>       
        <tr>
            <td><label for="imagen"></label></td>
            <td><input type="file" name="imagen" id="imagen"></td>
        </tr>

        <tr>
            <td>Proovedor<label for="proovedor"></label></td>
            <td><input type="text" name="proovedor">
        </tr>

        <tr>
            <td>Litros<label for="litros"></label></td>
            <td><input type="number" name="litros" step="any">
        </tr>

        <tr>
            <td>Linea del producto<label for="linea_producto"></label></td>
            <td><input type="text" name="linea_producto">
        </tr>
        
        <tr>
            <td>
            <input type="submit" name="btn_enviar" id="btn_enviar" value="Enviar"></td>
        </tr>

    </table>
    </form>

    
</body>
</html>