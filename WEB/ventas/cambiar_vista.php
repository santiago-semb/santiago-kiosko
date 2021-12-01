<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas | Kiosko</title>
    <link rel='stylesheet' href='../assets/styles/styles.css'>
    <script src="temas.js"></script>

    <style>
        #div-ventas {
            margin: auto;
            width: 40%;
            height: auto;
            margin-bottom: 20px;
        }

        .paginacion {
            text-align: center;
            height: 100px;
            width: 100%;
            margin: 0px;
            line-height: 100px;
            
        }

        .paginacion {
            line-height: 92px;
        }
 
        .paginacion ul {
            list-style:none;
            text-align: center;
            margin: 0px;
            padding: 0px;
        }
        
        .paginacion ul li a {
            text-decoration: none;
            color: black;
        }

        .a-pag {
            border: 2px solid rgb(56, 26, 126);
            padding: 4px;
            transition: 300ms all;
            background-color: whitesmoke;
            border-radius: 0.5em;
        }

        .a-pag:hover {
            background: rgb(56, 26, 126);
            color: whitesmoke;
        }

        ::selection {
            background-color: rgb(56, 26, 126);
            color: whitesmoke;
        }

        footer {
            position: relative;
            bottom: 0;
            background-color: rgb(56, 26, 126);
            width: 100%;
            text-align: center;
            color: whitesmoke;
        }

        .boton-finish-ventas {
            text-align:center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .producto-individual {
            width: 100%;
            max-height: 40px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .producto-individual-nombre {
            width: 100%;
            border-top: 2px solid gray;
            border-bottom: 2px solid gray;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .b-name {
            color: black;
        }

    
        .cambiar-vista-table-ventas {
            margin: 0px auto;
            width: 90%;
            border: 1px solid black;
            margin-bottom: 25px;
        }

        .tr-cambiar-vista-ventas {
            text-align: center;
        }
        .td-cambiar-vista-ventas {
            border: 1px solid black;
            text-transform: uppercase;
            color: blue;
        }
    </style>
</head>
<body>
    <header class="header" id="id-header">
        <h1>KIOSKITO</h1>
    </header>

    <nav class="menu" id="id-menu">
        <ul>
            <li><a href="../inicio.html" class="a-menu-li"><button class="button-li">Inicio</button></a></li>
            <li><a href="../productos.php" class="a-menu-li"><button class="button-li">Productos</button></a></li>
            <li><a href="../compras.php" class="a-menu-li"><button class="button-li">Compras</button></a></li>
            <li><a href="../ventas.php" class="a-menu-li"><button class="button-li">Ventas</button></a></li>
        </ul>
    </nav>

    <h1 style="text-align: center;">VENTAS</h1>

        <p>Usted esta en la paguina: 
            <?php 
                 
                if(isset($_GET["paguina"])){
                    $paguina = $_GET["paguina"];
                }else{
                    $paguina = 1;
                }
                echo $paguina; 
            ?>
        </p>
        <?php 

        require("../../backend/conexion/conexion.php");
        $base = Conectar::conexion();

        $sql = "SELECT SUM(TOTAL) as ventasTotales FROM ventas";
        $resultado = $base->prepare($sql);
        $resultado->execute();
        $sentencia = $resultado->fetch(PDO::FETCH_OBJ);
        $totalTotal = $sentencia->ventasTotales;

        ?>
        <p>Ventas totales: <?php echo $totalTotal; ?></p>
        
        <div class="boton-finish-ventas">
        <a href="../../WEB/ventas/eliminar_todas_las_ventas.php"><button name="boton-eliminar-venta">Eliminar todas las ventas</button></a>
        </div>
        <div class="boton-finish-ventas">
            <a href="../ventas.php"><button>Cambiar vista</button></a>
        </div>


    <?php 

    

        //paginacion
            $tamano_paguinas=ceil(12);

            if(isset($_GET["paguina"])) {
                if($_GET["paguina"]==1) {
                    
                    header("location:cambiar_vista.php");
                }else{
                    $paguina=$_GET["paguina"];
                }
            }else{
                $paguina=1;
            }    

            $sql_total="SELECT * FROM ventas";
            $sentencia=$base->prepare($sql_total);
            $sentencia->execute(array());

            $num_filas=$sentencia->rowCount();
            $total_paguinas=ceil($num_filas/$tamano_paguinas);
            $empezar_desde=ceil(($paguina-1)*$tamano_paguinas);
            $result=$sentencia->fetchAll(PDO::FETCH_OBJ);
        //paginacion   

        //para recorrer los registros con limit (para la paginacion)
        $sql_limite=$base->prepare("SELECT * FROM ventas ORDER BY ID DESC LIMIT ?,?");
        $sql_limite->bindParam(1, $empezar_desde, PDO::PARAM_INT);
        $sql_limite->bindParam(2, $tamano_paguinas, PDO::PARAM_INT);
        $sql_limite->execute();
        $resultado=$sql_limite->fetchAll(PDO::FETCH_OBJ);

    ?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . "?pag=" ?>">
        <h6>buscar por rubro</h6>
        <div>
            <select name="rubro-busqueda">
            <option disbaled value="">Seleccionar rubro</option>
                    <option>cigarrillos</option>
                    <option>bebidas</option>
                    <option>golosinas</option>
                    <option>galletas</option>
                    <option>varios</option>
                    <option>sandiwches</option>
                    <option>cervezas</option>
                    <option>lacteos</option>
            </select>
            <input type="submit" value="Search" name="boton-busqueda-select-option">
        </div>
    </form>


    <?php
    if(isset($_POST["boton-busqueda-select-option"])) :
        $rubroBusqueda = $_POST["rubro-busqueda"];

        $sql = "SELECT * FROM VENTAS WHERE RUBRO='$rubroBusqueda'";
        $resultado = $base->prepare($sql);
        $resultado->execute();
        $row = $resultado->fetch(PDO::FETCH_OBJ);
        if(isset($row->NOMBRE) && isset($row->RUBRO) && isset($row->FECHA) && isset($row->TOTAL)){ 
            $name = $row->NOMBRE;
            $fecha = $row->FECHA;
            $total = $row->TOTAL;
            $rubro = $row->RUBRO;
        }
        
        ?>
        
    <table class='cambiar-vista-table-ventas'>
        <tr>
            <th>FECHA</th>
            <th>PRODUCTO</th>
            <th>RUBRO</th>
            <th>TOTAL</th>
        </tr>
        <?php
            $query = "SELECT * FROM VENTAS WHERE RUBRO='$rubroBusqueda'";
            $res = $base->prepare($query);
            $res->execute();
        ?>
      <?php while($row = $res->fetch(PDO::FETCH_OBJ)) : ?>
        <tr class='tr-cambiar-vista-ventas'>
            <td class='td-cambiar-vista-ventas'><mark><?php $fecha = $row->FECHA; echo $fecha; ?></mark></td>
            <td class='td-cambiar-vista-ventas'><?php $nombre = $row->NOMBRE; echo $nombre; ?></td>
            <td class='td-cambiar-vista-ventas'><?php $rubro = $row->RUBRO; echo $rubro;?></td>
            <td class='td-cambiar-vista-ventas'><?php $total = $row->TOTAL; echo $total;?></td>
        </tr>
        <?php endwhile; ?>

        <?php 
            $query = "SELECT SUM(TOTAL) as ventasTotalesRd FROM VENTAS WHERE RUBRO='$rubroBusqueda'";
            $res = $base->prepare($query);
            $res->execute();
            $sentencia = $res->fetch(PDO::FETCH_OBJ);
            $total_rubro_detallado = $sentencia->ventasTotalesRd;
        ?>
        <h3 style="margin: 0px auto;text-align: center; border: 2px solid black; width: 20%; margin-bottom: 5px;"><b>TOTAL: </b><b style="color: green;"><?php echo $total_rubro_detallado ?></b></h3>

    <?php endif; ?>
 
    </table>

         

     




    
<?php if(!isset($_POST["boton-busqueda-select-option"])) : ?>
    <table class="cambiar-vista-table-ventas">
        <tr>
            <th>FECHA</th>
            <th>PRODUCTO</th>
            <th>RUBRO</th>
            <th>TOTAL</th>
        </tr>
        <?php foreach($resultado as $rows) :?>
        <tr class="tr-cambiar-vista-ventas">
            <td class="td-cambiar-vista-ventas"><mark><?php echo $rows->FECHA ?></mark></td>
            <td class="td-cambiar-vista-ventas"><?php echo $rows->NOMBRE ?></td>
            <td class="td-cambiar-vista-ventas"><?php echo $rows->RUBRO ?></td>
            <td class="td-cambiar-vista-ventas"><?php echo $rows->TOTAL ?></td>
        </tr>
        <?php endforeach; ?>

    </table>

    <nav>
    <div class="paginacion">
        <ul class="pagination">
            <li class="li-pag">
                <?php
                for($i=1; $i<=$total_paguinas; $i++) {
                    echo "<strong><a class='a-pag' href='?paguina=" . $i . "'>" . $i . "</a></strong>  ";
                }
                ?>
            </li>
        </ul>
    </div>
    </nav>
<?php  endif; ?>




<!--<footer>Las ventas estan recibiendo datos de la BBDD a traves de una consulta SQL que recorre toda la tabla y trae estos registros (ventas)</footer>
-->

</body>
</html>