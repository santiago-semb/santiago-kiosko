<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coca Cola | Kiosko</title>
    <link rel="stylesheet" href="../../WEB/assets/styles/styles.css">
</head>
<body>
    <header class="header">
        <h1>KIOSKITO</h1>


        <style>

        table {
            margin: auto;
            width: 50%;
            border: 2px solid black;
            padding: 3px;
            background-color: white;
        }
        
        td{
            padding:5px 0px;
        }

    </style>
    </header>

    <nav class="menu">
        <ul>
            <li><a href="../../WEB/inicio.html" class="a-menu-li"><button class="button-li">Inicio</button></a></li>
            <li><a href="../../WEB/productos.php" class="a-menu-li"><button class="button-li">Productos</button></a></li>
            <li><a href="../../WEB/compras.html" class="a-menu-li"><button class="button-li">Compras</button></a></li>
            <li><a href="../../WEB/ventas.html" class="a-menu-li"><button class="button-li">Ventas</button></a></li>
        </ul>
    </nav>


    <?php 

    require("../../backend/conexion/conexion.php");
    $base = Conectar::conexion();

    if(!isset($_POST["bot-editar"])) {

        $id=$_GET["ID"];
        $nombre=$_GET["nom"];
        $precioCompra=$_GET["pcompra"];
        $precioVenta=$_GET["pventa"];
        $imagen=$_GET["img"];
        $proovedor=$_GET["prov"];
        $litros=$_GET["litros"];
        $lineaProducto=$_GET["lineap"];

    }else{

        $id=$_POST["id"];
        $nombre=$_POST["nombre_producto"];
        $precioCompra=$_POST["precio_compra"];
        $precioVenta=$_POST["precio_venta"];
        $imagen=$_POST["imagen"];
        $proovedor=$_POST["proovedor"];
        $litros=$_POST["litros"];
        $lineaProducto=$_POST["linea_producto"];

        $tabla= 'producto_individual_' . $nombre;

    $sql="UPDATE $tabla SET NOMBRE=:nombre, PRECIOcompra=:pcompra, PRECIOventa=:pventa, IMAGEN=:img, PROOVEDOR=:proovedor, LITROS=:litros, LINEAproducto=:lineaproducto WHERE ID=:id";
        $resultado=$base->prepare($sql);
        $resultado->bindParam(":id", $id);
        $resultado->bindParam(":nombre", $nombre);
        $resultado->bindParam(":pcompra", $precioCompra);
        $resultado->bindParam(":pventa", $precioVenta);
        $resultado->bindParam(":img", $imagen);
        $resultado->bindParam(":proovedor", $proovedor);
        $resultado->bindParam(":litros", $litros);
        $resultado->bindParam(":lineaproducto", $lineaProducto);
        
        $resultado->execute();
        header("Location:'../../../../WEB/productos/" . $nombre . ".php");

    }

?>

<h2>EDITAR PRODUCTO</h2>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <table>
        <tr>
            <input type="hidden" name="id" value="<?php echo $id ?>">
        </tr>

        <tr>
            <td>Nombre del producto<label for="campo_titulo"></label></td>            
            <td><select name="nombre_producto">
                <option><?php echo $nombre ?></option>
            </select></td>         
        </tr>

        <tr>
            <td>Precio compra<label for="precio_compra"></label></td>
            <td><input type="number" name="precio_compra" value="<?php echo round($precioCompra); ?>">
        </tr>

        <tr>
            <td>Precio venta<label for="precio_venta"></label></td>
            <td><input type="number" name="precio_venta" value="<?php echo round($precioVenta); ?>">
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
            <td><input type="text" name="proovedor" value="<?php echo $proovedor ?>">
        </tr>

        <tr>
            <td>Litros<label for="litros"></label></td>
            <td><input type="number" name="litros" step="any" value="<?php echo round($litros); ?>">
        </tr>

        <tr>
            <td>Linea del producto<label for="linea_producto"></label></td>
            <td><input type="text" name="linea_producto" value="<?php echo $lineaProducto ?>">
        </tr>
        
        <tr style='text-align:center;'>
        <td colspan="2"><input type="submit" value="editar" name="bot-editar"></td>
        </tr>      
</table>
        
    </div> 

</form>   



</body>
</html>

